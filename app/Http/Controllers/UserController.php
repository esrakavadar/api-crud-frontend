<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;



class UserController extends Controller
{

    public function login(){
        return view('auth/login');
    }



    public function loginPost(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/auth/login',[
            'email' => $request->email,
            'password'=> $request->password,
        ]);
        $data=$response->json();
        //dd($data);

        if ($response->status() === 200) {
            if (isset($data['token'])) {
                session(['token' => $data['token']]);
                return redirect()->route('products');
            } 
            else {
                return redirect()->route('login')->withErrors('Login failed. Please try again.');
            }
        } else {
            return redirect()->route('login');
        }
    }




    public function register(){
        return view('auth/register');
    }




    public function registerPost(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/auth/register', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),

        ]);
        $data=$response->json();
        //dd($data);

        if ($data['status'] === true) {
        return redirect()->route('login')->with('success', 'Kayıt başarılı, lütfen giriş yapın.');
    } else {
        return back()->withErrors('Kayıt oluşturulamadı, tekrar deneyin.');
    }

    }




    public function logout(Request $request)
    {
        $token = session('token');
        if (!$token) {
            return redirect()->route('login'); 
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
           ])->post('http://127.0.0.1:8000/api/logout',)->json();
           
        session(['token'=>'']);  
        return redirect()->route('login');
    }
}

