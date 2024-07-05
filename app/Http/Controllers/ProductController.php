<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
     protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_URL'); 
    }


    public function index()
    {
        try {
            $token = Session::get('token');
            $response = Http::withToken($token)->get($this->baseUrl . 'products');
            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] === 'success') {
                return view('products.index', ['products' => $data['products']]);
            } else {
                return redirect()->route('login')->with('error', 'Verileri görmek için giriş yapmalısınız.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }


 public function create()
{
    try {
        $token = Session::get('token');
        
        // Oturum bilgisi kontrolü yapabilirsiniz, token varsa devam edin
        if (!$token) {
            return redirect()->route('login')->with('error', 'Ürün eklemek için giriş yapmalısınız.');
        }
        
        // Yeni ürün eklemek için boş bir form gösteriyoruz
        return view('products.create');
        
    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
    }
}

    
public function store(Request $request)
{
    try {
        $token = Session::get('token');
        $response = Http::withToken($token)->post($this->baseUrl . 'products/create', $request->all());
        $data = $response->json();

        if ($response->successful() && isset($data['status']) && $data['status'] === 'success') {
            return redirect()->route('products.index')->with('success', $data['message']);
        }

        if ($response->status() === 422 && isset($data['errors'])) {
            return back()->withErrors($data['errors'])->withInput();
        }

        return back()->withErrors($data['message'])->withInput();
    } catch (\Exception $e) {
        return back()->withErrors('Bir hata oluştu: ' . $e->getMessage())->withInput();
    }
}

    public function show($id)
    {
        try {
            $token = Session::get('token');
            $response = Http::withToken($token)->get($this->baseUrl . "products/show/{$id}");
            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] === 'success') {
                return view('products.show', ['product' => $data['product']]);
            } else {
                return redirect()->route('products.index')->with('error', 'Ürün bulunamadı.');
            }
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $token = Session::get('token');
            $response = Http::withToken($token)->get($this->baseUrl . "products/show/{$id}");
            $data = $response->json();
    
            if ($response->successful() && isset($data['status']) && $data['status'] === 'success') {
                return view('products.update', ['product' => $data['product']]);
            } else {
                return redirect()->route('products.index')->with('error', 'Ürün bulunamadı.');
            }
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $token = Session::get('token');
            $response = Http::withToken($token)->put($this->baseUrl . "products/update/{$id}", $request->all());
            $data = $response->json();
    
            if ($response->successful() && isset($data['status']) && $data['status'] === 'success') {
                return redirect()->route('products.index')->with('success', $data['message']);
            }
    
            if ($response->status() === 422 && isset($data['errors'])) {
                return back()->withErrors($data['errors'])->withInput();
            }
    
            return back()->withErrors($data['message'])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors('Bir hata oluştu: ' . $e->getMessage())->withInput();
        }
    }
    
    
    public function destroy($id)
    {
        try {
            $token = Session::get('token');
            $response = Http::withToken($token)->delete($this->baseUrl . "products/{$id}");
            $data = $response->json();

            if ($response->successful()) {
                return redirect()->route('products.index')->with('success', $data['message']);
            }

            return back()->withErrors($response->json()['errors']);
        } catch (\Exception $e) {
            return back()->withErrors('Bir hata oluştu: ' . $e->getMessage());
        }
    }


}
