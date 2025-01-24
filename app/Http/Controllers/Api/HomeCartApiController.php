<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomecartResource;
use App\Models\Homecart;
use Illuminate\Http\Request;

class HomecartApiController extends Controller
{
    public function index()
    {
        $homecart = Homecart::all();
        return HomecartResource::collection($homecart);
    }

    public function show($id)
    {
        try {
            $homecart = Homecart::findOrFail($id);
            return new HomecartResource($homecart);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Homecart not found'], 404);
        }
    }

    // Diğer yöntemleri (create, store, edit, update, destroy) API yapısına uygun hale getirin
    // ... mevcut kodu API yapısına uygun hale getirin ...
} 