<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function welcome(Request $request)
    {
        // Ambil data dari form
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');

        // Kirim data ke view 'welcome'
        return view('welcome', [
            'firstName' => $firstName,
            'lastName' => $lastName
        ]);
    }
}
