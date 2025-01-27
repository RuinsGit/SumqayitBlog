<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class GalleryVideoController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $galleryVideos = GalleryVideo::latest()->get();
        return view('back.pages.gallery-videos.index', compact('galleryVideos'));
    }

    public function create()
    {
        return view('back.pages.gallery-videos.create');
    }

    public function store(Request $request)
    {
        try {
            // Veritabanında en az bir kayıt var mı kontrolü
            if (GalleryVideo::count() >= 1) {
                return back()->with('error', 'Zatən bir video qalereyası mövcuddur. Yeni video əlavə edilə bilməz.');
            }

            $validated = $request->validate([
                'title_az' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'main_video' => 'required|file|mimetypes:video/mp4,video/quicktime',
                'main_video_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
                'meta_title_az' => 'nullable|string|max:255',
                'meta_title_en' => 'nullable|string|max:255',
                'meta_title_ru' => 'nullable|string|max:255',
                'meta_description_az' => 'nullable|string',
                'meta_description_en' => 'nullable|string',
                'meta_description_ru' => 'nullable|string',
            ]);

            // Ana video yükleme
            $mainVideoPath = null;
            if ($request->hasFile('main_video')) {
                $mainVideo = $request->file('main_video');
                $mainVideoName = time() . '_' . $mainVideo->getClientOriginalName();
                $mainVideo->move(public_path('uploads/gallery-videos/main'), $mainVideoName);
                $mainVideoPath = 'uploads/gallery-videos/main/' . $mainVideoName;
            }

            // Ana video thumbnail yükleme ve WebP dönüşümü
            $mainThumbnailPath = null;
            if ($request->hasFile('main_video_thumbnail')) {
                $mainThumbnail = $request->file('main_video_thumbnail');
                $originalFileName = pathinfo($mainThumbnail->getClientOriginalName(), PATHINFO_FILENAME);
                $mainThumbnailName = time() . '_thumb_' . $originalFileName . '.webp';
                
                $imageResource = imagecreatefromstring(file_get_contents($mainThumbnail));
                $webpPath = public_path('uploads/gallery-videos/thumbnails/' . $mainThumbnailName);
                
                if ($imageResource) {
                    if (!file_exists(public_path('uploads/gallery-videos/thumbnails'))) {
                        mkdir(public_path('uploads/gallery-videos/thumbnails'), 0777, true);
                    }
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $mainThumbnailPath = 'uploads/gallery-videos/thumbnails/' . $mainThumbnailName;
                }
            }

            // Slugları oluştur
            $slugAz = str()->slug($request->title_az);
            $slugEn = str()->slug($request->title_en);
            $slugRu = str()->slug($request->title_ru);

            // Gallery Video oluştur
            GalleryVideo::create([
                'title_az' => $request->title_az,
                'title_en' => $request->title_en,
                'title_ru' => $request->title_ru,
                'slug_az' => $slugAz,
                'slug_en' => $slugEn,
                'slug_ru' => $slugRu,
                'main_video' => $mainVideoPath,
                'main_video_thumbnail' => $mainThumbnailPath,
                'meta_title_az' => $request->meta_title_az,
                'meta_title_en' => $request->meta_title_en,
                'meta_title_ru' => $request->meta_title_ru,
                'meta_description_az' => $request->meta_description_az,
                'meta_description_en' => $request->meta_description_en,
                'meta_description_ru' => $request->meta_description_ru,
            ]);

            return redirect()
                ->route('back.pages.gallery-videos.index')
                ->with('success', 'Video qalereyası uğurla əlavə edildi');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function edit(GalleryVideo $galleryVideo)
    {
        return view('back.pages.gallery-videos.edit', compact('galleryVideo'));
    }

    public function update(Request $request, GalleryVideo $galleryVideo)
    {
        try {
            $request->validate([
                'title_az' => 'required',
                'title_en' => 'required',
                'title_ru' => 'required',
                'main_video' => 'nullable|file|mimetypes:video/mp4,video/quicktime',
                'main_video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);

            // Ana video güncelleme
            if ($request->hasFile('main_video')) {
                // Eski videoyu sil
                if ($galleryVideo->main_video && file_exists(public_path($galleryVideo->main_video))) {
                    unlink(public_path($galleryVideo->main_video));
                }
                
                $mainVideo = $request->file('main_video');
                $mainVideoName = time() . '_' . $mainVideo->getClientOriginalName();
                $mainVideo->move(public_path('uploads/gallery-videos/main'), $mainVideoName);
                $galleryVideo->main_video = 'uploads/gallery-videos/main/' . $mainVideoName;
            }

            // Ana video thumbnail güncelleme
            if ($request->hasFile('main_video_thumbnail')) {
                // Eski thumbnail'ı sil
                if ($galleryVideo->main_video_thumbnail && file_exists(public_path($galleryVideo->main_video_thumbnail))) {
                    unlink(public_path($galleryVideo->main_video_thumbnail));
                }
                
                $mainThumbnail = $request->file('main_video_thumbnail');
                $originalFileName = pathinfo($mainThumbnail->getClientOriginalName(), PATHINFO_FILENAME);
                $mainThumbnailName = time() . '_thumb_' . $originalFileName . '.webp';
                
                $imageResource = imagecreatefromstring(file_get_contents($mainThumbnail));
                $webpPath = public_path('uploads/gallery-videos/thumbnails/' . $mainThumbnailName);
                
                if ($imageResource) {
                    if (!file_exists(public_path('uploads/gallery-videos/thumbnails'))) {
                        mkdir(public_path('uploads/gallery-videos/thumbnails'), 0777, true);
                    }
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);
                    $galleryVideo->main_video_thumbnail = 'uploads/gallery-videos/thumbnails/' . $mainThumbnailName;
                }
            }

            // Temel alanları güncelle
            $galleryVideo->title_az = $request->title_az;
            $galleryVideo->title_en = $request->title_en;
            $galleryVideo->title_ru = $request->title_ru;
            $galleryVideo->slug_az = str()->slug($request->title_az);
            $galleryVideo->slug_en = str()->slug($request->title_en);
            $galleryVideo->slug_ru = str()->slug($request->title_ru);

            // Meta alanlarını güncelle
            if ($request->filled('meta_title_az')) $galleryVideo->meta_title_az = $request->meta_title_az;
            if ($request->filled('meta_title_en')) $galleryVideo->meta_title_en = $request->meta_title_en;
            if ($request->filled('meta_title_ru')) $galleryVideo->meta_title_ru = $request->meta_title_ru;
            if ($request->filled('meta_description_az')) $galleryVideo->meta_description_az = $request->meta_description_az;
            if ($request->filled('meta_description_en')) $galleryVideo->meta_description_en = $request->meta_description_en;
            if ($request->filled('meta_description_ru')) $galleryVideo->meta_description_ru = $request->meta_description_ru;

            // Değişiklikleri kaydet
            if (!$galleryVideo->save()) {
                throw new \Exception('Güncelleme işlemi başarısız oldu.');
            }

            return redirect()->route('back.pages.gallery-videos.index')
                ->with('success', 'Video qalereyası uğurla yeniləndi');

        } catch (\Exception $e) {
            \Log::error('Güncelleme hatası:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function destroy(GalleryVideo $galleryVideo)
    {
        try {
            // Video ve thumbnail dosyalarını sil
            if ($galleryVideo->main_video && file_exists(public_path($galleryVideo->main_video))) {
                unlink(public_path($galleryVideo->main_video));
            }
            if ($galleryVideo->main_video_thumbnail && file_exists(public_path($galleryVideo->main_video_thumbnail))) {
                unlink(public_path($galleryVideo->main_video_thumbnail));
            }

            $galleryVideo->delete();

            return redirect()
                ->route('back.pages.gallery-videos.index')
                ->with('success', 'Video qalereyası uğurla silindi');

        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi: ' . $e->getMessage());
        }
    }
}
