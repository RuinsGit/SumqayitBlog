<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMarketing;
use Illuminate\Http\Request;

class ContactMarketingApiController extends Controller
{
    public function index()
    {
        $contacts = ContactMarketing::all();
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactMarketing::create($request->all());
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }
} 