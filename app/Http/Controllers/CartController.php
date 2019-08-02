<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;
use App\Transaction;
use App\Package;

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
        if(auth()->user()->role == 'Customer') {
            $carts = Cart::where('user_id', auth()->user()->id)->where('status', 'Cart')->get();

            return view('transaction.cart', compact('carts'));
        } else {
            return redirect('/home')->with('error', 'Unauthorized Access.');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        if(auth()->user()->role == 'Wedding Organizer') {
            $carts = Cart::where('status', 'pending')->paginate(10);
            return view('transaction.pending', compact('carts'));
        } else {
            return redirect('/home')->with('error', 'Unauthorized Access.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function done()
    {
        if(auth()->user()->role == 'Wedding Organizer') {
            $carts = Cart::where('status', '!=', 'pending')->where('status', '!=', 'cart')->orderBy('updated_at', 'desc')->paginate(10);
            return view('transaction.finished', compact('carts'));
        } else {
            return redirect('/home')->with('error', 'Unauthorized Access.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming()
    {
        if(auth()->user()->role == 'Customer') {
            $carts = Cart::where('status', 'Deal')->where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        } elseif(auth()->user()->role == 'Wedding Organizer') {
            $mypackages = auth()->user()->allpackages;
            foreach($mypackages as $mypackage) {
                $mypackagesid[] =  $mypackage->id;
            }
            $carts = Cart::where('status', 'Deal')->whereIn('package_id', $mypackagesid)->orderBy('updated_at', 'desc')->paginate(10);
        } else {
            $carts = Cart::where('status', 'Deal')->whereIn('package_id', $mypackagesid)->orderBy('updated_at', 'desc')->paginate(10);
        }
        $nav_admins = Cart::where('status', 'Event Selesai')->orderBy('updated_at', 'desc')->limit(4)->get();
        return view('transaction.upcoming', compact('carts', 'nav_admins'));
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
        $cart = Cart::findOrFail($id);
        $nav_admins = Cart::where('status', 'Event Selesai')->orderBy('updated_at', 'desc')->limit(4)->get();

        return view('transaction.showcart', compact('cart', 'nav_admins'));
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
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eventdone(Request $request, $id)
    {
        $status = $request->input('status');
        $penilaian = $request->input('reputasi_wo');

        $cart = Cart::findOrFail($id);
        
        $user = User::findOrFail($cart->package->user->id);
        if($penilaian == 'Sangat Buruk') {
            $user->reputasi = $user->reputasi - 100;
        } elseif($penilaian == 'Buruk') {
            $user->reputasi = $user->reputasi - 50;
        } elseif($penilaian == 'Cukup') {
            $user->reputasi = $user->reputasi + 10;
        } elseif($penilaian == 'Memuaskan') {
            $user->reputasi = $user->reputasi + 50;
        } elseif($penilaian == 'Sangat Memuaskan') {
            $user->reputasi = $user->reputasi + 100;
        } 
        $user->save();

        $cart->status = $status;
        $cart->penilaian = $penilaian;
        $cart->rate = $request->input('rate');
        $cart->ulasan = $request->input('ulasan');
        $cart->save();

        return redirect('/cart/'.$id)->with('success', 'Event telah selesai.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->status = 'Dibatalkan';
        $cart->cancel_id = auth()->user()->id;
        $cart->save();

        return redirect('/transaction/'.$cart->transaction->id)->with('success', 'Pesanan Telah Dibatalkan.');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deal(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->status = 'Deal';
        $cart->dp = $request->input('dp');
        $cart->tambahan = $request->input('tambahan');
        $cart->save();

        $cartpendings = Cart::where('status', 'Pending')
                        ->where('user_id', $cart->user_id)->get();

        if(count($cartpendings) == '0') {
            $cartdone = Cart::findOrFail($id);
            
            $transaction = Transaction::findOrFail($cartdone->transaction_id);
            $transaction->status = 'Menunggu Pembayaran';
            $transaction->save();
        }

        return redirect('/cart/'.$id)->with('success', 'Pesanan telah diterima.');


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
