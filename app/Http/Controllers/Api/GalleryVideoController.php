<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryVideoResource;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryVideoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $galleryVideos = GalleryVideo::latest()->get();
            return response()->json([
                'success' => true,
                'message' => 'Qalereya videoları uğurla gətirildi',
                'data' => GalleryVideoResource::collection($galleryVideos)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $galleryVideo = GalleryVideo::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Qalereya videosu uğurla gətirildi',
                'data' => new GalleryVideoResource($galleryVideo)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }

    public function getBySlug($lang, $slug)
    {
        try {
            $galleryVideo = GalleryVideo::where('slug_' . $lang, $slug)->firstOrFail();
            return response()->json([
                'success' => true,
                'data' => new GalleryVideoResource($galleryVideo)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 404);
        }
    }

    public function getLatest($limit = 6)
    {
        try {
            $galleryVideos = GalleryVideo::latest()
                ->take($limit)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Son əlavə edilən videolar uğurla gətirildi',
                'data' => GalleryVideoResource::collection($galleryVideos)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPaginated(Request $request)
    {
        try {
            $perPage = $request->per_page ?? 10;
            $galleryVideos = GalleryVideo::latest()
                ->paginate($perPage);
            
            return response()->json([
                'success' => true,
                'message' => 'Qalereya videoları uğurla gətirildi',
                'data' => GalleryVideoResource::collection($galleryVideos),
                'pagination' => [
                    'total' => $galleryVideos->total(),
                    'per_page' => $galleryVideos->perPage(),
                    'current_page' => $galleryVideos->currentPage(),
                    'last_page' => $galleryVideos->lastPage(),
                    'from' => $galleryVideos->firstItem(),
                    'to' => $galleryVideos->lastItem()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi: ' . $e->getMessage()
            ], 500);
        }
    }
}
