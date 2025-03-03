<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ContactRequestResource;

class ContactRequestApiController extends Controller
{
    public function index()
    {
        try {
            $contactRequests = ContactRequest::latest()->get();
            return response()->json([
                'status' => 'success',
                'data' => $contactRequests
            ], 200);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'number' => 'required|string|max:20',
                'text' => 'required|string'
            ]);

            DB::beginTransaction();
            
            $contactRequest = ContactRequest::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'number' => $validated['number'],
                'text' => $validated['text'],
                'status' => ContactRequest::STATUS_NEW
            ]);

            // Mail gönderme işlemi
            Mail::to('etimad.musaoglu@gmail.com')->send(new ContactMail($contactRequest));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Mail uğurla göndərildi',
                'data' => new ContactRequestResource($contactRequest)
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $contactRequest
            ], 200);
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e, 'Request not found', 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'number' => 'sometimes|string|max:20',
            'text' => 'sometimes|string',
            'status' => ['required', Rule::in(['pending', 'processed'])]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contactRequest = ContactRequest::findOrFail($id);
            $contactRequest->update($request->all());
            
            return response()->json([
                'status' => 'success',
                'data' => $contactRequest
            ], 200);

        } catch (\Exception $e) {
            return $this->sendErrorResponse($e);
        }
    }

    public function destroy($id)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($id);
            $contactRequest->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Request deleted successfully'
            ], 204);

        } catch (\Exception $e) {
            return $this->sendErrorResponse($e, 'Delete failed', 500);
        }
    }

    private function sendErrorResponse(\Exception $e, $message = 'Server error', $code = 500)
    {
        if (env('APP_DEBUG')) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], $code);
        }

        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}