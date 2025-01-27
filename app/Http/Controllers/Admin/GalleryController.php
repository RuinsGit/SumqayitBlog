<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class GalleryController extends Controller
{
    public function index()
    {
    Artisan::call('migrate');
        $galleries = Gallery::latest()->get();
        return view('back.pages.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('back.pages.galleries.create');
    }

    public function store(Request $request)
    {
        try {
            // Veritabanında en az bir kayıt var mı kontrolü
            

            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'description_az' => 'required|string',
                'description_en' => 'required|string',
                'description_ru' => 'required|string',
                'main_image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'main_image_alt_az' => 'required|string|max:255',
                'main_image_alt_en' => 'required|string|max:255',
                'main_image_alt_ru' => 'required|string|max:255',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
            ]);

            // Ana görsel yükleme
            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $destinationPath = public_path('storage/gallery/main');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $mainImagePath = 'gallery/main/' . $webpFileName;
                }
            }

            // Galeri oluştur
            Gallery::create([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'description_az' => $request->description_az,
                'description_en' => $request->description_en,
                'description_ru' => $request->description_ru,
                'main_image' => $mainImagePath,
                'main_image_alt_az' => $request->main_image_alt_az,
                'main_image_alt_en' => $request->main_image_alt_en,
                'main_image_alt_ru' => $request->main_image_alt_ru,
                'meta_title_az' => $request->meta_title_az,
                'meta_title_en' => $request->meta_title_en,
                'meta_title_ru' => $request->meta_title_ru,
                'meta_description_az' => $request->meta_description_az,
                'meta_description_en' => $request->meta_description_en,
                'meta_description_ru' => $request->meta_description_ru,
            ]);

            return redirect()
                ->route('back.pages.galleries.index')
                ->with('success', 'Qalereya uğurla əlavə edildi');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit(Gallery $gallery)
    {
        return view('back.pages.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        try {
            $request->validate([
                'title_az' => 'required',
                'title_en' => 'required',
                'title_ru' => 'required',
                'description_az' => 'required',
                'description_en' => 'required',
                'description_ru' => 'required',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'main_image_alt_az' => 'required',
                'main_image_alt_en' => 'required',
                'main_image_alt_ru' => 'required',
            ]);

            $data = $request->except(['main_image']);

            if ($request->hasFile('main_image')) {
                if ($gallery->main_image) {
                    Storage::disk('public')->delete($gallery->main_image);
                }

                $file = $request->file('main_image');
                $destinationPath = public_path('storage/gallery/main');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '.webp';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $data['main_image'] = 'gallery/main/' . $webpFileName;
                }
            }

            $gallery->update($data);

            return redirect()
                ->route('back.pages.galleries.index')
                ->with('success', 'Qalereya uğurla yeniləndi');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function destroy(Gallery $gallery)
    {
        try {
            
            if ($gallery->main_image) {
                Storage::disk('public')->delete($gallery->main_image);
            }

            $gallery->delete();

            return redirect()
                ->route('back.pages.galleries.index')
                ->with('success', 'Qalereya uğurla silindi');

        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
} 