<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $map = Map::first(); 
        return view('back.pages.maps.index', compact('map'));
    }

    public function create()
    {
       
        if (Map::count() >= 1) {
            return redirect()->route('back.pages.maps.index')->with('error', 'Xəritə əlavə edilə bilməz.');
        }
        return view('back.pages.maps.create');
    }

    public function store(Request $request)
    {
        if (Map::count() >= 1) {
            return redirect()->route('back.pages.maps.index')->with('error', 'Xəritə əlavə edilə bilməz.');
        }

        $request->validate([
            'description' => 'nullable|string',
        ]);

        Map::create([
            'description' => $request->description,
        ]);

        return redirect()->route('back.pages.maps.index')->with('success', 'Xəritə uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $map = Map::findOrFail($id);
        return view('back.pages.maps.edit', compact('map'));
    }

    public function update(Request $request, $id)
    {
        $map = Map::findOrFail($id);

        $request->validate([
            'description' => 'nullable|string',
        ]);

        $map->update([
            'description' => $request->description,
        ]);

        return redirect()->route('back.pages.maps.index')->with('success', 'Xəritə uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $map = Map::findOrFail($id);
        $map->delete();

        return redirect()->route('back.pages.maps.index')->with('success', 'Xəritə uğurla silindi.');
    }

    public function show($id)
    {
        $map = Map::findOrFail($id);
        return view('back.pages.maps.show', compact('map'));
    }
} 