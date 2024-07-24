<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    private $authenticated_user;

    public function __construct()
    {
        $this->authenticated_user = Auth::user();
    }

    public function show()
    {
        return view('user.profile.show', [
            'user' => $this->authenticated_user,
        ]);
    }

    public function details(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($this->authenticated_user->update($data)) {
            return redirect()->back()->with(['success' => "Magic has been spelled!"]);
        } else {
            return redirect()->back()->with(['failure' => "Magic has failed to spell!"]);
        }
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if (Hash::check($request->current_password, $this->authenticated_user->password)) {
            $data = [
                'password' => $request->password,
            ];

            if ($this->authenticated_user->update($data)) {
                return redirect()->back()->with(['success' => "Magic has been spelled!"]);
            } else {
                return redirect()->back()->with(['failure' => "Magic has failed to spell!"]);
            }
        } else {
            return redirect()->back()->withErrors([
                'current_password' => 'Current password does not match'
            ]);
        }
    }

    public function picture(Request $request)
    {
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ]);

        $target_directory = 'template/img/photos/';

        if ($this->authenticated_user->picture && File::exists($target_directory . $this->authenticated_user->picture)) {
            unlink($target_directory . $this->authenticated_user->picture);
        }

        $file_name = "ACI-SHOPPERS-" . microtime(true) . "." . $request->picture->extension();

        if ($request->picture->move(public_path($target_directory), $file_name)) {
            $data = [
                'picture' => $file_name,
            ];

            if ($this->authenticated_user->update($data)) {
                return redirect()->back()->with(['success' => 'Magic has been spelled!']);
            } else {
                return redirect()->back()->with(['failure' => 'Magic has failed to spell!']);
            }
        } else {
            return redirect()->back()->with(['failure' => 'Unable to upload picture!']);
        }
    }
}
