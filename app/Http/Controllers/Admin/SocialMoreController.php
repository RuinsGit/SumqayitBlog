<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class SocialMoreController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $socialmore = SocialMore::orderBy('order')->get();
        return view('back.admin.socialmore.index', compact('socialmore'));
    }

    public function create()
    {
        return view('back.admin.socialmore.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'link' => 'required|url',
            'title' => 'required|string|max:255'
        ], [
            'image.required' => 'Şəkil mütləq yüklənməlidir',
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'link.required' => 'Link mütləq daxil edilməlidir',
            'link.url' => 'Düzgün link daxil edin',
            'title.required' => 'Başlıq mütləq daxil edilməlidir',
            'title.string' => 'Başlıq düzgün formatda olmalıdır',
            'title.max' => 'Başlıq maksimum 255 simvol olmalıdır'
        ]);

        $socialmore = new SocialMore();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/socialmore'), $imageName);
            $socialmore->image = 'uploads/socialmore/' . $imageName;
        }

        $socialmore->link = $request->link;
        $socialmore->title = $request->title;
        $socialmore->order = SocialMore::max('order') + 1;
        $socialmore->status = 1;
        $socialmore->save();

        return redirect()->route('back.pages.socialmore.index')->with('success', 'Sosial media uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $socialmore = SocialMore::findOrFail($id);
        return view('back.admin.socialmore.edit', compact('socialmore'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'link' => 'required|url',
            'title' => 'required|string|max:255'
        ], [
            'image.image' => 'Fayl şəkil formatında olmalıdır',
            'link.required' => 'Link mütləq daxil edilməlidir',
            'link.url' => 'Düzgün link daxil edin',
            'title.required' => 'Başlıq mütləq daxil edilməlidir',
            'title.string' => 'Başlıq düzgün formatda olmalıdır',
            'title.max' => 'Başlıq maksimum 255 simvol olmalıdır'
        ]);

        $socialmore = SocialMore::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($socialmore->image && File::exists(public_path($socialmore->image))) {
                File::delete(public_path($socialmore->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/socialmore'), $imageName);
            $socialmore->image = 'uploads/socialmore/' . $imageName;
        }

        $socialmore->link = $request->link;
        $socialmore->title = $request->title;
        $socialmore->status = 1;
        $socialmore->save();

        return redirect()->route('back.pages.socialmore.index')->with('success', 'Sosial media uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $socialmore = SocialMore::findOrFail($id);
        
        if ($socialmore->image && File::exists(public_path($socialmore->image))) {
            File::delete(public_path($socialmore->image));
        }
        
        $socialmore->delete();

        return redirect()->route('back.pages.socialmore.index')->with('success', 'Sosial media uğurla silindi');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $key => $order) {
            SocialMore::where('id', $order['id'])->update(['order' => $order['position']]);
        }

        return redirect()->route('back.admin.socialmore.index')
        ->with('success', 'Sosial media uğurla silindi.');
    }

    public function toggleStatus($id)
    {
        $socialmore = SocialMore::findOrFail($id);
        $socialmore->status = !$socialmore->status;
        $socialmore->save();

        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }
}
