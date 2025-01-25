<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMarketing;

class ContactMarketingController extends Controller
{
    public function index()
    {
       
        $contacts = ContactMarketing::all();
        return view('back.pages.contact_marketing.index', compact('contacts'));
    }

    public function create()
    {
        
        return view('back.pages.contact_marketing.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMarketing::create($request->all());

        return redirect()->route('back.pages.contact_marketing.index')->with('success', 'Mesajınız Uğurla Gönderildi.');
    }

    public function show($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        return view('back.pages.contact_marketing.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = ContactMarketing::findOrFail($id);
        $contact->delete();

        return redirect()->route('back.pages.contact_marketing.index')->with('success', 'Mesaj uğurla silindi.');
    }

        
}
