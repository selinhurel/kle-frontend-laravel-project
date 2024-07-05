<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.registration');
    }

    public function registerPost(Request $request)
    {
        $response = Http::post('http://host.docker.internal:81/api/register', $request->all());

        $data = $response->json();

        if ($response->successful()) {
            return redirect()->route('login')->with('success', $data['message']);

        }

        // Handle validation errors if any
        if ($response->status() === 422 && isset($data['errors'])) {
            return back()->withErrors($data['errors']);
        }

        // Handle general errors
        return back()->withErrors($data['message']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $response = Http::post('http://host.docker.internal:81/api/login', $request->all());

        $data = $response->json();

        if ($response->successful()) {
          
            Session::put('token', $data['token']);
            Session::put('user', $data['user']);

            return redirect()->route('products.index')->with('success', $data['message']);
        }
        if ($response->status() === 422 && isset($data['errors'])) {
            return back()->withErrors($data['errors']);
        }
        return back()->withErrors($data['message']);
    }

    public function logout()
    {
        $token = Session::get('token');
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->post('http://host.docker.internal:81/api/logout');
    
        // Yanıtın içeriğini kontrol et
        $data = $response->json();
    
        if ($response->successful()) {
            Session::forget('token');
            Session::forget('user');
            return redirect()->route('login')->with('success', $data['message']);
        }
    
        // Handle general errors with a check
        $errorMessage = isset($data['message']) ? $data['message'] : 'Çıkış yapılamadı, lütfen tekrar deneyin.';
        return back()->withErrors($errorMessage);
    }
    
}
