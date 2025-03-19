<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DigitalResource;
use App\Models\Digital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalController extends Controller
{
    public function index()
    {
        $digitals = Digital::all();
        
      
        foreach ($digitals as $digital) {
            $digital->increment('view_count');
        }

        return response()->json([
            'success' => true,
            'message' => 'Digital uğurla gətirildi',
            'data' => DigitalResource::collection($digitals)
        ], 200);
    }

    public function show($id)
    {
        $digital = Digital::find($id);
        
        if (!$digital) {
            return response()->json([
                'success' => false,
                'message' => 'Digital tapılmadı',
                'data' => null
            ], 404);
        }

     
        $digital->increment('view_count');

       
        \Log::info('View count for digital ID ' . $id . ' increased to ' . $digital->view_count);

        return response()->json([
            'success' => true,
            'message' => 'Digital uğurla gətirildi',
            'data' => new DigitalResource($digital)
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
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
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
                $destinationPath = public_path('storage/digitals');
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
                    $imagePath = 'digitals/' . $webpFileName;
                }
            }

      
            $filePath = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('digitals/files', 'public');
            }

            $digital = Digital::create(array_merge($validated, [
                'image' => $imagePath ?? null,
                'file' => $filePath
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Digital uğurla yaradıldı',
                'data' => new DigitalResource($digital)
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
            $digital = Digital::find($id);
            if (!$digital) {
                return response()->json([
                    'success' => false,
                    'message' => 'Digital tapılmadı',
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
                'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
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
                if ($digital->image) {
                    Storage::disk('public')->delete($digital->image);
                }

                $file = $request->file('image');
                $destinationPath = public_path('storage/digitals');
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
                    $data['image'] = 'digitals/' . $webpFileName;
                }
            }

     
            if ($request->hasFile('file')) {
                if ($digital->file) {
                    Storage::disk('public')->delete($digital->file);
                }
                $file = $request->file('file');
                $filePath = $file->store('digitals/files', 'public');
                $data['file'] = $filePath;
            }

            $digital->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Digital uğurla yeniləndi',
                'data' => new DigitalResource($digital)
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
            $digital = Digital::find($id);
            if (!$digital) {
                return response()->json([
                    'success' => false,
                    'message' => 'Digital tapılmadı',
                    'data' => null
                ], 404);
            }

            if ($digital->image) {
                Storage::disk('public')->delete($digital->image);
            }
            
         
            if ($digital->file) {
                Storage::disk('public')->delete($digital->file);
            }

            $digital->delete();

            return response()->json([
                'success' => true,
                'message' => 'Digital uğurla silindi',
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