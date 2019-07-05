<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Cart;

class TransactionController extends Controller
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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingt()
    {
        if(auth()->user()->role == 'Admin') {
            return view('admin.pending');
        } else {
            return redirect('/dashboard')->with('danger', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
        }
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
        
        $invoice1 = date('dmy', strtotime(now()));
        $invoice2 = mt_rand(100, 999);

        $transaction = new Transaction;
        $transaction->user_id = auth()->user()->id;
        $transaction->invoice = 'INV/'.$invoice1.'/'.$invoice2;

        $transaction->save();

        $transaction1 = Transaction::where('user_id', auth()->user()->id)->first();

        $carts = Cart::where('status', 'cart')->where('user_id', auth()->user()->id)->get();
        foreach($carts as $cart) {
            $cart->transaction_id = $transaction1->id;
            $cart->status = 'Pending';
            $cart->save();
        }

        return redirect('/home')->with('success', 'Paket wedding berhasil dipesan, silahkan tunggu kesepakatan dari Wedding Organizer');
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
        //
    }
}
