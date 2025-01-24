<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::where('status', 1)->first();
        
        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Haqqımızda məlumatı tapılmadı',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Haqqımızda məlumatı uğurla gətirildi',
            'data' => new AboutResource($about)
        ], 200);
    }

    public function show($id)
    {
        $about = About::find($id);
        
        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Haqqımızda məlumatı tapılmadı',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Haqqımızda məlumatı uğurla gətirildi',
            'data' => new AboutResource($about)
        ], 200);
    }
} 