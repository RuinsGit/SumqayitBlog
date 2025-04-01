<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ContactRequestController extends Controller
{
    public function index()
    {
        // Artisan::call('migrate');
        $contactRequests = ContactRequest::orderBy('id', 'desc')->get();
        return view('back.pages.contact_requests.index', compact('contactRequests'));
    }


    public function create()
    {
        return view('back.pages.contact_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:20',
            'text' => 'required|string',
        ]);

        ContactRequest::create($request->all());

        return redirect()->route('back.pages.contact_requests.index')->with('success', 'Contact request created successfully.');
    }


    public function show(ContactRequest $contactRequest)
    {
        return view('back.pages.contact_requests.show', compact('contactRequest'));
    }

    public function edit(ContactRequest $contactRequest)
    {
        return view('back.pages.contact_requests.edit', compact('contactRequest'));
    }

    public function update(Request $request, ContactRequest $contactRequest)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'number' => 'sometimes|required|string|max:20',
            'text' => 'sometimes|required|string',
            'status' => 'required|string',
        ]);

        $contactRequest->update($request->only('name', 'email', 'number', 'text', 'status'));

        return redirect()->route('back.pages.contact_requests.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(ContactRequest $contactRequest)
    {
        $contactRequest->delete();
        return redirect()->route('back.pages.contact_requests.index')->with('success', 'Contact request deleted successfully.');
    }
} 