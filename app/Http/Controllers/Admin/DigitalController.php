<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Digital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class DigitalController extends Controller
{
    public function index()
    {

        // Artisan::call('migrate');
        $digitals = Digital::latest()->get();
        return view('back.pages.digital.index', compact('digitals'));


    }

    public function create()
    {
        return view('back.pages.digital.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'text_az' => 'required|string',
                'text_en' => 'required|string',
                'text_ru' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'file_az' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_en' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_ru' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'image_alt_az' => 'required|string|max:255',
                'image_alt_en' => 'required|string|max:255',
                'image_alt_ru' => 'required|string|max:255',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
                'description_az' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ru' => 'nullable|string',
                'slug_az' => 'nullable|string|max:255',
                'slug_en' => 'nullable|string|max:255',
                'slug_ru' => 'nullable|string|max:255',
            ]);

            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('storage/digitals');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFileName = str_replace(' ', '_', $originalFileName);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $imagePath = 'digitals/' . $webpFileName;
                }
            }

            $filePaths = [];
            foreach (['az', 'en', 'ru'] as $lang) {
                if ($request->hasFile('file_' . $lang)) {
                    $file = $request->file('file_' . $lang);
                    $fileDirectory = 'digitals/files/' . $lang;
                    $publicPath = public_path('storage/' . $fileDirectory);
                    
                    if (!file_exists($publicPath)) {
                        mkdir($publicPath, 0755, true);
                    }
                    
                    $originalName = $file->getClientOriginalName();
                    $safeFileName = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', $originalName);
                    
                    $file->move($publicPath, $safeFileName);
                    $filePaths['file_' . $lang] = $fileDirectory . '/' . $safeFileName;
                }
            }

            Digital::create(array_merge($validated, [
                'image' => $imagePath ?? null,
                'file_az' => $filePaths['file_az'] ?? null,
                'file_en' => $filePaths['file_en'] ?? null,
                'file_ru' => $filePaths['file_ru'] ?? null
            ]));

            return redirect()->route('back.pages.digitals.index')->with('success', 'Digital uğurla yaradıldı.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit(Digital $digital)
    {
        return view('back.pages.digital.edit', compact('digital'));
    }

    public function update(Request $request, Digital $digital)
    {
        try {
            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'text_az' => 'required|string',
                'text_en' => 'required|string',
                'text_ru' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'file_az' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_en' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_ru' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'image_alt_az' => 'required|string|max:255',
                'image_alt_en' => 'required|string|max:255',
                'image_alt_ru' => 'required|string|max:255',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
                'description_az' => 'nullable|string',
                'description_en' => 'nullable|string',
                'description_ru' => 'nullable|string',
                'slug_az' => 'nullable|string|max:255',
                'slug_en' => 'nullable|string|max:255',
                'slug_ru' => 'nullable|string|max:255',
            ]);

            $data = $validated;

            if ($request->hasFile('image')) {
                if ($digital->image) {
                    Storage::disk('public')->delete($digital->image);
                }

                $file = $request->file('image');
                $destinationPath = public_path('storage/digitals');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $originalFileName = str_replace(' ', '_', $originalFileName);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $data['image'] = 'digitals/' . $webpFileName;
                }
            }

            foreach (['az', 'en', 'ru'] as $lang) {
                if ($request->hasFile('file_' . $lang)) {
                    // Delete old file if exists
                    if ($digital->{'file_' . $lang}) {
                        Storage::disk('public')->delete($digital->{'file_' . $lang});
                    }

                    $file = $request->file('file_' . $lang);
                    $fileDirectory = 'digitals/files/' . $lang;
                    $publicPath = public_path('storage/' . $fileDirectory);
                    
                    if (!file_exists($publicPath)) {
                        mkdir($publicPath, 0755, true);
                    }
                    
                    $originalName = $file->getClientOriginalName();
                    $safeFileName = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', $originalName);
                    
                    $file->move($publicPath, $safeFileName);
                    $data['file_' . $lang] = $fileDirectory . '/' . $safeFileName;
                }
            }

            $digital->update($data);

            return redirect()->route('back.pages.digitals.index')->with('success', 'Digital uğurla yeniləndi.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function destroy(Digital $digital)
    {
        try {
            if ($digital->image) {
                Storage::disk('public')->delete($digital->image);
            }
            
      
            if ($digital->file_az || $digital->file_en || $digital->file_ru) {
                foreach (['az', 'en', 'ru'] as $lang) {
                    if ($digital->{'file_' . $lang}) {
                        Storage::disk('public')->delete($digital->{'file_' . $lang});
                    }
                }
            }

            $digital->delete();

            return redirect()->route('back.pages.digitals.index')->with('success', 'Digital uğurla silindi.');

        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
} 