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
                'title_az' => 'nullable|string|max:255',
                'title_en' => 'nullable|string|max:255',
                'title_ru' => 'nullable|string|max:255',
                'text_az' => 'nullable|string',
                'text_en' => 'nullable|string',
                'text_ru' => 'nullable|string',
                'image_az' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'image_en' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'image_ru' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'file_az' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_en' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_ru' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'image_alt_az' => 'nullable|string|max:255',
                'image_alt_en' => 'nullable|string|max:255',
                'image_alt_ru' => 'nullable|string|max:255',
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

            $imagePaths = [];
            
            foreach (['az', 'en', 'ru'] as $lang) {
                if ($request->hasFile('image_' . $lang)) {
                    $file = $request->file('image_' . $lang);
                    $destinationPath = public_path('storage/digitals/' . $lang);
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
                        $imagePaths['image_' . $lang] = 'digitals/' . $lang . '/' . $webpFileName;
                    }
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

            Digital::create(array_merge($validated, $imagePaths, $filePaths));

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
                'title_az' => 'nullable|string|max:255',
                'title_en' => 'nullable|string|max:255',
                'title_ru' => 'nullable|string|max:255',
                'text_az' => 'nullable|string',
                'text_en' => 'nullable|string',
                'text_ru' => 'nullable|string',
                'image_az' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'image_en' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'image_ru' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'file_az' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_en' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'file_ru' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:20480',
                'image_alt_az' => 'nullable|string|max:255',
                'image_alt_en' => 'nullable|string|max:255',
                'image_alt_ru' => 'nullable|string|max:255',
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

            foreach (['az', 'en', 'ru'] as $lang) {
                if ($request->hasFile('image_' . $lang)) {
                    if ($digital->{'image_' . $lang}) {
                        Storage::disk('public')->delete($digital->{'image_' . $lang});
                    }

                    $file = $request->file('image_' . $lang);
                    $destinationPath = public_path('storage/digitals/' . $lang);
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
                        $data['image_' . $lang] = 'digitals/' . $lang . '/' . $webpFileName;
                    }
                }
            }

            foreach (['az', 'en', 'ru'] as $lang) {
                if ($request->hasFile('file_' . $lang)) {
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
            foreach (['az', 'en', 'ru'] as $lang) {
                if ($digital->{'image_' . $lang}) {
                    Storage::disk('public')->delete($digital->{'image_' . $lang});
                }
                
                if ($digital->{'file_' . $lang}) {
                    Storage::disk('public')->delete($digital->{'file_' . $lang});
                }
            }

            $digital->delete();

            return redirect()->route('back.pages.digitals.index')->with('success', 'Digital uğurla silindi.');

        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
} 