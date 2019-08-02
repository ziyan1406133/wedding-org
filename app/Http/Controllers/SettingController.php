<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Bank;
use App\Cart;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'Admin') {
            $setting = Setting::first();
            $banks = Bank::all();
    
            $nav_admins = Cart::where('status', 'Event Selesai')->orderBy('updated_at', 'desc')->limit(4)->get();
            return view('admin.setting', compact('setting', 'banks', 'nav_admins'));
        } else {
            return redirect('/home')->with('error', 'Unauthorized Access.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->address = $request->input('address'); 
        $setting->email = $request->input('email');
        $setting->phone = $request->input('phone');
        $setting->bank_id = $request->input('bank');
        $setting->rekening = $request->input('rekening');
        $setting->atas_nama = $request->input('atas_nama');
        $setting->save();

        return redirect('/setting')->with('success', 'Info aplikasi berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/');
    }
}
