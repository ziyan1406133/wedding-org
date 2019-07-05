<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use App\Transaction;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('status', 'Cart')->get();

        return view('transaction.cart', compact('carts'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organizer = User::where('id', $request->input('organizer_id'))->first();
        $id = $request->input('package_id');
        $regency_id = $request->input('regencies');
        if($regency_id == $organizer['regency_id']) {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->package_id = $id;
            $cart->event_date = $request->input('date');
            $cart->province_id = $request->input('provinces');
            $cart->regency_id = $request->input('regencies');
            $cart->district_id = $request->input('districts');
            $cart->address = $request->input('address');
            $cart->save();

            return redirect('/package')->with('success', 'Paket Berhasil Dipesan, <a href="/cart">lihat keranjang belanja</a>');
        } else {
            return redirect('/package/'.$id)->with('error', 'Alamat event harus berada di kabupaten yang sama dengan WO');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        
        return redirect('/cart')->with('success', 'Item berhasil dihapus dari keranjang belanja.');
    }
}
