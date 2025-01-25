<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapResource;
use App\Models\Map;
use Illuminate\Http\Request;

class MapApiController extends Controller
{
    public function index()
    {
        $maps = Map::all();
        return MapResource::collection($maps);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);

        $map = Map::create($request->all());
        return response()->json($map, 201);
    }

    public function show($id)
    {
        $map = Map::findOrFail($id);
        return new MapResource($map);
    }

    public function update(Request $request, $id)
    {
        $map = Map::findOrFail($id);

        $request->validate([
            'description' => 'nullable|string',
        ]);

        $map->update($request->all());
        return response()->json($map);
    }

    public function destroy($id)
    {
        $map = Map::findOrFail($id);
        $map->delete();
        return response()->json(null, 204);
    }
} 