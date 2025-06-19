<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'surname'     => 'required|string|max:255',
            'email'       => 'required|email|unique:member,email',
            'password'    => 'required|min:6|confirmed',
            'birthday'    => 'nullable|date',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
            'province'    => 'nullable|string',
            'district'    => 'nullable|string',
            'sub_district'=> 'nullable|string',
            'postcode'    => 'nullable|string|max:10',
        ]);

        $member = Member::create([
            'name'        => $request->name,
            'surname'     => $request->surname,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'birthday'    => $request->birthday,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'province'    => $request->province,
            'district'    => $request->district,
            'sub_district'=> $request->sub_district,
            'postcode'    => $request->postcode,
        ]);

        return redirect()->route('index')->with('register_success', true);

    }
}
