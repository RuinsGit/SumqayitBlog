<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeCartResource;
use App\Models\HomeCart;
use Illuminate\Http\Request;

class HomeCartApiController extends Controller
{
    public function index()
    {
        $homecart = HomeCart::all();
        return HomeCartResource::collection($homecart);
    }

    public function show($id)
    {
        try {
            $homecart = HomeCart::findOrFail($id);
            return new HomeCartResource($homecart);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Homecart not found'], 404);
        }
    }

    // Diğer yöntemleri (create, store, edit, update, destroy) API yapısına uygun hale getirin
    // ... mevcut kodu API yapısına uygun hale getirin ...
} 