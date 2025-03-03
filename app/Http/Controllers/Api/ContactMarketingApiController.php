<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMarketing;
use Illuminate\Http\Request;
use App\Http\Resources\ContactMarketingResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMarketingMail;

class ContactMarketingApiController extends Controller
{
    public function index()
    {
        $contacts = ContactMarketing::all();
        return ContactMarketingResource::collection($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactMarketing::create($request->all());
        
        Mail::to('museyibli.ruhin@gmail.com')->send(new ContactMarketingMail($contact));
        
        return new ContactMarketingResource($contact);
    }

    public function show($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        return new ContactMarketingResource($contact);
    }

    public function destroy($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }

    public function testMail()
    {
        $contactMarketing = new ContactMarketing([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'This is a test message.',
        ]);

        Mail::to('museyibli.ruhin@gmail.com')->send(new ContactMarketingMail($contactMarketing));

        return response()->json(['message' => 'Test mail sent!']);
    }
} 