<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialMoreResource;
use App\Models\SocialMore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SocialMoreApiController extends Controller
{
    public function index()
    {
        $socials = SocialMore::orderBy('order')->where('status', 1)->get();
        return SocialMoreResource::collection($socials);
    }

    public function show($id)
    {
        $social = SocialMore::find($id);
        if (!$social) {
            return response()->json(['message' => 'Social media not found'], 404);
        }
        return new SocialMoreResource($social);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'link' => 'required|url'
        ]);

        $social = new SocialMore();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/socialmore'), $imageName);
            $social->image = 'uploads/socialmore/' . $imageName;
        }

        $social->link = $request->link;
        $social->order = SocialMore::max('order') + 1;
        $social->status = $request->has('status') ? 1 : 0;
        $social->save();

        return response()->json(new SocialMoreResource($social), 201);
    }

    public function update(Request $request, $id)
    {
        $social = SocialMore::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'link' => 'required|url'
        ]);

        if ($request->hasFile('image')) {
            if ($social->image && File::exists(public_path($social->image))) {
                File::delete(public_path($social->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/socialmore'), $imageName);
            $social->image = 'uploads/socialmore/' . $imageName;
        }

        $social->link = $request->link;
        $social->status = $request->has('status') ? 1 : 0;
        $social->save();

        return response()->json(new SocialMoreResource($social), 200);
    }

    public function destroy($id)
    {
        $social = SocialMore::findOrFail($id);
        
        if ($social->image && File::exists(public_path($social->image))) {
            File::delete(public_path($social->image));
        }
        
        $social->delete();

        return response()->json(['message' => 'Social media successfully deleted'], 204);
    }

    public function toggleStatus($id)
    {
        $social = SocialMore::findOrFail($id);
        $social->status = !$social->status;
        $social->save();

        return response()->json(['message' => 'Status successfully updated'], 200);
    }
} 