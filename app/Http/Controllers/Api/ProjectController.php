<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        
        // Her bir makalenin view_count değerini artır
        foreach ($projects as $project) {
            $project->increment('view_count');
        }

        return response()->json([
            'success' => true,
            'message' => 'Layihələr uğurla gətirildi',
            'data' => ProjectResource::collection($projects)
        ], 200);
    }

    public function show($id)
    {
        $project = Project::find($id);
        
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Layihə tapılmadı',
                'data' => null
            ], 404);
        }

        // View count artırma
        $project->increment('view_count');

        // Kontrol için log ekleyin
        \Log::info('View count for project ID ' . $id . ' increased to ' . $project->view_count);

        return response()->json([
            'success' => true,
            'message' => 'Layihə uğurla gətirildi',
            'data' => new ProjectResource($project)
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

            // Ana görsel yükleme
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('storage/projects');
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
                    $imagePath = 'projects/' . $webpFileName;
                }
            }

            $project = Project::create(array_merge($validated, ['image' => $imagePath]));

            return response()->json([
                'success' => true,
                'message' => 'Layihə uğurla yaradıldı',
                'data' => new ProjectResource($project)
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
            $project = Project::find($id);
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Layihə tapılmadı',
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
                if ($project->image) {
                    Storage::disk('public')->delete($project->image);
                }

                $file = $request->file('image');
                $destinationPath = public_path('storage/projects');
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
                    $data['image'] = 'projects/' . $webpFileName;
                }
            }

            $project->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Layihə uğurla yeniləndi',
                'data' => new ProjectResource($project)
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
            $project = Project::find($id);
                if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Layihə tapılmadı',
                    'data' => null
                ], 404);
            }

            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Layihə uğurla silindi',
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