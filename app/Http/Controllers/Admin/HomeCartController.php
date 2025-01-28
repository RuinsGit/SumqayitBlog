<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeCartController extends Controller
{
    public function index()
    {
        $homecart = HomeCart::all();
        $homecartExists = HomeCart::count() >= 1;
        return view('back.admin.homecart.index', compact('homecart', 'homecartExists'));
    }

    public function create()
    {
        return view('back.admin.homecart.create');
    }

    public function store(Request $request)
    {
        if (HomeCart::count() >= 1) {
            return redirect()->route('back.pages.homecart.index')
                ->with('error', 'Hal hazırda homecart mövcuddur!');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt_az' => 'required|string',
            'image_alt_en' => 'required|string',
            'image_alt_ru' => 'required|string',
            'title_az' => 'required|string',
            'title_en' => 'required|string',
            'title_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/homecart');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $imagePath = 'uploads/homecart/' . $webpFileName;
                
                HomeCart::create([
                    'image' => $imagePath,
                    'image_alt_az' => $request->image_alt_az,
                    'image_alt_en' => $request->image_alt_en,
                    'image_alt_ru' => $request->image_alt_ru,
                    'title_az' => $request->title_az,
                    'title_en' => $request->title_en,
                    'title_ru' => $request->title_ru,
                    'description_az' => $request->description_az,
                    'description_en' => $request->description_en,
                    'description_ru' => $request->description_ru,
                ]);
            }
        }

        return redirect()->route('back.pages.homecart.index')
            ->with('success', 'Homecart uğurla əlavə edildi.');
    }

    public function edit(HomeCart $homecart)
    {
        return view('back.admin.homecart.edit', compact('homecart'));
    }

    public function update(Request $request, HomeCart $homecart)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_alt_az' => 'required|string',
            'image_alt_en' => 'required|string',
            'image_alt_ru' => 'required|string',
            'title_az' => 'required|string',
            'title_en' => 'required|string',
            'title_ru' => 'required|string',
            'description_az' => 'required|string',
            'description_en' => 'required|string',
            'description_ru' => 'required|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($homecart->image) {
                $oldImagePath = public_path($homecart->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/homecart');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['image'] = 'uploads/homecart/' . $webpFileName;
            }
        }

        $homecart->update($data);

        return redirect()->route('back.pages.homecart.index')
            ->with('success', 'Homecart uğurla yeniləndi.');
    }

    public function destroy(Homecart $homecart)
    {
        if ($homecart->image) {
            $imagePath = public_path($homecart->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $homecart->delete();

        return redirect()->route('back.pages.homecart.index')
            ->with('success', 'Homecart uğurla silindi.');
    }
}