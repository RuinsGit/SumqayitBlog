<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Socialshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SocialshareController extends Controller
{
    private $destinationPath;

    public function __construct()
    {   
        // Artisan::call('migrate');
        $this->destinationPath = public_path('uploads');
        
        if (!file_exists($this->destinationPath)) {
            mkdir($this->destinationPath, 0775, true);
        }
    }

    public function index()
    {
        $socialshares = Socialshare::orderBy('order')->get();
        return view('back.pages.socialshare.index', compact('socialshares'));
    }

    public function create()
    {
        $sitelink = Socialshare::first()?->sitelink;
        return view('back.pages.socialshare.create', compact('sitelink'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'link' => 'required|string|max:255',
            'sitelink' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($this->destinationPath, $fileName);
            $data['image'] = 'uploads/' . $fileName;
        }

        if (!isset($data['order'])) {
            $data['order'] = Socialshare::max('order') + 1;
        }

        $data['status'] = 1;

        Socialshare::create($data);

        return redirect()->route('back.pages.socialshare.index')
            ->with('success', 'Sosial paylaşım uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $socialshare = Socialshare::findOrFail($id);
        $sitelink = Socialshare::first()?->sitelink;
        return view('back.pages.socialshare.edit', compact('socialshare', 'sitelink'));
    }

    public function update(Request $request, $id)
    {
        $socialshare = Socialshare::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'link' => 'required|string|max:255',
            'sitelink' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:7',
            'order' => 'nullable|integer|min:0',
            'status' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($socialshare->image) {
                $oldImagePath = public_path($socialshare->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($this->destinationPath, $fileName);
            $data['image'] = 'uploads/' . $fileName;
        }

        $data['status'] = 1;

        $socialshare->update($data);

        return redirect()->route('back.pages.socialshare.index')
            ->with('success', 'Sosial paylaşım uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $socialshare = Socialshare::findOrFail($id);

        if ($socialshare->image) {
            $imagePath = public_path($socialshare->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $socialshare->delete();

        return redirect()->route('back.pages.socialshare.index')
            ->with('success', 'Sosial media uğurla silindi.');
    }

    public function toggleStatus($id)
    {
        $socialshare = Socialshare::findOrFail($id);
        $socialshare->status = !$socialshare->status;
        $socialshare->save();

        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }

    public function updateSitelink(Request $request)
    {
        $request->validate([
            'sitelink' => 'required|string|max:255'
        ], [
            'sitelink.required' => 'Site linki mütləq daxil edilməlidir',
            'sitelink.string' => 'Site linki düzgün formatda olmalıdır',
            'sitelink.max' => 'Site linki maksimum 255 simvol olmalıdır'
        ]);

       
        Socialshare::query()->update(['sitelink' => $request->sitelink]);

        return redirect()->back()->with('success', 'Site linki uğurla yeniləndi.');
    }
} 