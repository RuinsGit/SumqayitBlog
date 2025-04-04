<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;


class SeoController extends Controller
{
    public function index()
    {
        $seos = Seo::all();
        return view('back.admin.seo.index', compact('seos'));
    }

    public function create()
    {
        return view('back.admin.seo.create');
    }

    public function store(Request $request)
    {
       
        if (Seo::count() >= 7) {
            return redirect()->route('back.pages.seo.index')->with('error', 'Maksimum 7 SEO məlumatı əlavə edilə bilər.');
        }

        $request->validate([
            'key' => 'required|unique:seos',
            'meta_title_az' => 'required',
            'meta_title_en' => 'required',
            'meta_title_ru' => 'required',
            'meta_description_az' => 'required',
            'meta_description_en' => 'required',
            'meta_description_ru' => 'required',
            'status' => 'required|in:0,1'
        ]);

        Seo::create($request->all());
        return redirect()->route('back.pages.seo.index')->with('success', 'SEO Məlumatları Uğurla Əlavə Edildi.');
    }

    public function edit(Seo $seo)
    {
        return view('back.admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, Seo $seo)
    {
        $request->validate([
            'key' => 'required|unique:seos,key,' . $seo->id,
            'meta_title_az' => 'required',
            'meta_title_en' => 'required',
            'meta_title_ru' => 'required',
            'meta_description_az' => 'required',
            'meta_description_en' => 'required',
            'meta_description_ru' => 'required',
            'status' => 'required|in:0,1'
        ]);

        $seo->update($request->all());
        return redirect()->route('back.pages.seo.index')->with('success', 'SEO Məlumatları Uğurla Yeniləndi.');
    }

    public function destroy(Seo $seo)
    {
        $seo->delete();
        return redirect()->route('back.pages.seo.index')->with('success', 'SEO Məlumatları Uğurla Silindi.');
    }
}
