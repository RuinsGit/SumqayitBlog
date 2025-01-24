<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worklife;
use Illuminate\Http\Request;

class WorklifeController extends Controller
{
    public function index()
    {
        $worklife = Worklife::all();
        return view('back.pages.worklife.index', compact('worklife'));
    }

    public function create()
    {
        return view('back.pages.worklife.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
        ]);

        Worklife::create($request->all());
        return redirect()->route('back.pages.worklife.index')->with('success', 'Məlumatlar uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $worklife = Worklife::findOrFail($id);
        return view('back.pages.worklife.edit', compact('worklife'));
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
        return redirect()->route('back.pages.worklife.index')->with('success', 'Məlumatlar uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $worklife = Worklife::findOrFail($id);
        $worklife->delete();
        return redirect()->route('back.pages.worklife.index')->with('success', 'Məlumatlar uğurla silindi.');
    }
} 