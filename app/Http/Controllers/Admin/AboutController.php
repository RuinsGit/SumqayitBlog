<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();
        $aboutCount = $about->count();
        return view('back.pages.about.index', compact('about', 'aboutCount'));
    }

    public function create()
    {
        $aboutCount = About::count();
        return view('back.pages.about.create', compact('aboutCount'));
    }

    public function store(Request $request)
    {
        $aboutCount = About::count();

        if ($aboutCount >= 1) {
            return redirect()->route('back.pages.about.index')->with('error', 'Hal-hazirda bir about.');
        }

        $request->validate([
            'special_title_az' => 'required|string|max:255',
            'special_title_en' => 'required|string|max:255',
            'special_title_ru' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg',
        ], [
            'image.required' => 'Resim alanı zorunludur',
            'document_file.required' => 'Döküman dosyası zorunludur',
        ]);

        $about = new About();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $about->image = 'uploads/about/' . $imageName;
        }

        if ($request->hasFile('document_file')) {
            $document = $request->file('document_file');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('uploads/about/documents'), $documentName);
            $about->document_file = 'uploads/about/documents/' . $documentName;
        }

        $about->special_title_az = $request->special_title_az;
        $about->special_title_en = $request->special_title_en;
        $about->special_title_ru = $request->special_title_ru;
        $about->title_az = $request->title_az;
        $about->title_en = $request->title_en;
        $about->title_ru = $request->title_ru;
        $about->description_az = $request->description_az;
        $about->description_en = $request->description_en;
        $about->description_ru = $request->description_ru;
        $about->status = $request->status ?? 1;

        $about->save();

        return redirect()->route('back.pages.about.index')->with('success', 'About başarıyla eklendi.');
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('back.pages.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'special_title_az' => 'required|string|max:255',
            'special_title_en' => 'required|string|max:255',
            'special_title_ru' => 'required|string|max:255',
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image && File::exists(public_path($about->image))) {
                File::delete(public_path($about->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $about->image = 'uploads/about/' . $imageName;
        }

        if ($request->hasFile('document_file')) {
            if ($about->document_file && File::exists(public_path($about->document_file))) {
                File::delete(public_path($about->document_file));
            }

            $document = $request->file('document_file');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('uploads/about/documents'), $documentName);
            $about->document_file = 'uploads/about/documents/' . $documentName;
        }

        $about->special_title_az = $request->special_title_az;
        $about->special_title_en = $request->special_title_en;
        $about->special_title_ru = $request->special_title_ru;
        $about->title_az = $request->title_az;
        $about->title_en = $request->title_en;
        $about->title_ru = $request->title_ru;
        $about->description_az = $request->description_az;
        $about->description_en = $request->description_en;
        $about->description_ru = $request->description_ru;
        $about->status = $request->status ?? 1;

        $about->save();

        return redirect()->route('back.pages.about.index')->with('success', 'About Uğurla Redaktə edildi.');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        
        if ($about->image && File::exists(public_path($about->image))) {
            File::delete(public_path($about->image));
        }

        if ($about->document_file && File::exists(public_path($about->document_file))) {
            File::delete(public_path($about->document_file));
        }

        $about->delete();

        return redirect()->route('back.pages.about.index')->with('success', 'About Uğurla Silindi.');
    }

    public function toggleStatus($id)
    {
        $about = About::findOrFail($id);
        if ($about->status) {
            $about->status = null;
        } else {
            $about->status = 1;
        }
        $about->save();

        return redirect()->route('back.pages.about.index')->with('success', 'Status Uğurla Dəyişdirildi.');
    }
} 