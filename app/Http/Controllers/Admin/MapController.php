<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $map = Map::first(); // Sadece bir tane veri al
        return view('back.pages.maps.index', compact('map'));
    }

    public function create()
    {
        // Eğer zaten bir kayıt varsa, create sayfasına yönlendirin
        if (Map::count() >= 1) {
            return redirect()->route('back.pages.maps.index')->with('error', 'Zaten bir harita kaydı mevcut.');
        }
        return view('back.pages.maps.create');
    }

    public function store(Request $request)
    {
        // Sadece bir kayıt oluşturulmasına izin ver
        if (Map::count() >= 1) {
            return redirect()->route('back.pages.maps.index')->with('error', 'Zaten bir harita kaydı mevcut.');
        }

        $request->validate([
            'description' => 'nullable|string',
        ]);

        Map::create([
            'description' => $request->description,
        ]);

        return redirect()->route('back.pages.maps.index')->with('success', 'Harita başarıyla eklendi.');
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

        return redirect()->route('back.pages.maps.index')->with('success', 'Harita başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $map = Map::findOrFail($id);
        $map->delete();

        return redirect()->route('back.pages.maps.index')->with('success', 'Harita başarıyla silindi.');
    }

    public function show($id)
    {
        $map = Map::findOrFail($id);
        return view('back.pages.maps.show', compact('map'));
    }
} 