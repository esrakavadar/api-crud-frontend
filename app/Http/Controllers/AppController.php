<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AppController extends Controller
{
    public function index()
    {
        $token = session('token');

        // Token kontrolü
        if (!$token) {
            return redirect()->route('login'); 
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://127.0.0.1:8000/api/products');
        //dd($response->json());

        if ($response->successful()) {
            $product = $response->json(); // API'den gelen ürün verilerini al
            $jsonData = $response->body();
            $product = json_decode($jsonData, true);//diziye dönüştürme
            if (is_array($product)) {
                return view('products.index', compact('product'));
            } else {
                return back()->withErrors('API verileri geçerli bir diziye çevrilemedi.');
            }
            //dd($response);
        } else {
            return back()->withErrors('Ürünler getirilemedi.');
        }
    }
  
  
    public function create()
    {
        return view('products.create');
    }
  

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'price' => 'required|numeric',
        'product_code' => 'required|string',
        'description' => 'required|string',
    ]);

    $token = session('token');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('http://127.0.0.1:8000/api/products/ekle',$data);

    // test etmek için
    
    if ($response->successful()) {
        return redirect()->route('products')->with('success', 'Yeni ürün başarıyla eklendi');
    } else {
        return back()->with('error', 'Ürün eklenirken bir hata oluştu. Lütfen tekrar deneyin.');
    }
}

public function show(Request $request, $id)
{

    $token = session('token');

    if (!$token) {
        return redirect()->route('login'); 
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('http://127.0.0.1:8000/api/products/show/' . $id);


    if ($response->successful()) {
        $product = $response->json(); // API'den ürün verilerini al
        return view('products.show',compact('product'));
    } else {
        return back()->withErrors('Ürün detayları getirilirken bir hata oluştu.');
    }
}


  
    public function edit($id)
{
    $token = session('token');

    if (!$token) {
        return redirect()->route('login'); 
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('http://127.0.0.1:8000/api/products/show/' . $id);


    if ($response->successful()) {
        $product = $response->json(); // API'den ürün verilerini al
        return view('products.edit',compact('product'));
    } else {
        return back()->withErrors('Ürün detayları getirilirken bir hata oluştu.');
    }
}
 
    public function update(Request $request, $id)
    {
        $token = session('token');
        if (!$token) {
            return redirect()->route('login'); 
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://127.0.0.1:8000/api/products/update/' . $id, [
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'), 
        ]);

        
    //dd($response);


        if ($response->successful()) {
            return redirect()->route('products')->with('success', 'Ürün başarıyla güncellendi');
        } else {
            return back()->withErrors('Ürün güncellenirken bir hata oluştu.');
        }
    }

  
    
    public function destroy($id)
    {
        $token = session('token');

        // Token kontrolü
        if (!$token) {
            return redirect()->route('login'); 
        }
        //dd('test');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('http://127.0.0.1:8000/api/products/' . $id);
        //dd('test');
        if ($response->successful()) {
            return redirect()->route('products')->with('success', 'Ürün başarıyla silindi');
        } else {
            return back()->withErrors('Ürün silinirken bir hata oluştu.');
        }
    }

}
