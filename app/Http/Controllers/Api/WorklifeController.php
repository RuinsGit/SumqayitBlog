<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorklifeResource;
use App\Models\Worklife;
use Illuminate\Http\Request;

class WorklifeController extends Controller
{
    public function index()
    {
        $worklives = Worklife::all();
        return WorklifeResource::collection($worklives);
    }

    public function show($id)
    {
        $worklife = Worklife::findOrFail($id);
        return new WorklifeResource($worklife);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
        ]);

        $worklife = Worklife::create($request->all());
        return new WorklifeResource($worklife);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
        ]);

        $worklife = Worklife::findOrFail($id);
        $worklife->update($request->all());
        return new WorklifeResource($worklife);
    }

    public function destroy($id)
    {
        $worklife = Worklife::findOrFail($id);
        $worklife->delete();
        return response()->json(['message' => 'Məlumatlar uğurla silindi.']);
    }
} 