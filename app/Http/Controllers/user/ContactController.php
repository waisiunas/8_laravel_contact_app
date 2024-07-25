<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.contact.create', [
            'categories' => Category::where('user_id', '=', Auth::id())->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'category_id' => ['numeric', 'nullable'],
            'email' => ['email', 'nullable'],
            'mobile' => ['required', 'string'],
            'dob' => ['date', 'nullable'],
            'facebook' => ['string', 'nullable'],
            'instagram' => ['string', 'nullable'],
            'youtube' => ['string', 'nullable'],
            'picture' => ['image', 'mimes:png,jpg,jpeg,webp', 'nullable'],
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'category_id' => $request->category_id,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'address' => $request->address,
        ];

        if (Contact::create($data)) {
            return redirect()->back()->with(['success' => "Magic has been spelled!"]);
        } else {
            return redirect()->back()->with(['failure' => "Magic has failed to spell!"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
