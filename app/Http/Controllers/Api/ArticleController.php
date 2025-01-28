<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        
        foreach ($articles as $article) {
            $article->increment('view_count');
        }

        return response()->json([
            'success' => true,
            'message' => 'Məqalələr uğurla gətirildi',
            'data' => ArticleResource::collection($articles)
        ], 200);
    }

    public function show($id)
    {
        $article = Article::find($id);
        
        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Məqalə tapılmadı',
                'data' => null
            ], 404);
        }

        $article->increment('view_count');

        \Log::info('View count for article ID ' . $id . ' increased to ' . $article->view_count);

        return response()->json([
            'success' => true,
            'message' => 'Məqalə uğurla gətirildi',
            'data' => new ArticleResource($article)
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'text_az' => 'required|string',
                'text_en' => 'required|string',
                'text_ru' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'image_alt_az' => 'required|string|max:255',
                'image_alt_en' => 'required|string|max:255',
                'image_alt_ru' => 'required|string|max:255',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
                'description_az' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ru' => 'nullable|string',
                'slug_az' => 'nullable|string|max:255',
                'slug_en' => 'nullable|string|max:255',
                'slug_ru' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('storage/articles');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $imagePath = 'articles/' . $webpFileName;
                }
            }

            $article = Article::create(array_merge($validated, ['image' => $imagePath]));

            return response()->json([
                'success' => true,
                'message' => 'Məqalə uğurla yaradıldı',
                'data' => new ArticleResource($article)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Article::find($id);
            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Məqalə tapılmadı',
                    'data' => null
                ], 404);
            }

            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'text_az' => 'required|string',
                'text_en' => 'required|string',
                'text_ru' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'image_alt_az' => 'required|string|max:255',
                'image_alt_en' => 'required|string|max:255',
                'image_alt_ru' => 'required|string|max:255',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
                'description_az' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ru' => 'nullable|string',
                'slug_az' => 'nullable|string|max:255',
                'slug_en' => 'nullable|string|max:255',
                'slug_ru' => 'nullable|string|max:255',
            ]);

            $data = $validated;

            if ($request->hasFile('image')) {
                if ($article->image) {
                    Storage::disk('public')->delete($article->image);
                }

                $file = $request->file('image');
                $destinationPath = public_path('storage/articles');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $data['image'] = 'articles/' . $webpFileName;
                }
            }

            $article->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Məqalə uğurla yeniləndi',
                'data' => new ArticleResource($article)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $article = Article::find($id);
            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Məqalə tapılmadı',
                    'data' => null
                ], 404);
            }

            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'Məqalə uğurla silindi',
                'data' => null
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
} 