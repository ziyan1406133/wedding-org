<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Cart;
use App\Bank;
use App\Setting;
use PDF;
use Illuminate\Support\Facades\Storage;

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
        if(auth()->user()->role == 'Admin') {
            return view('admin.transaction.index');
        } elseif(auth()->user()->role == 'Customer') {
            return view('transaction.index');
        } else {
            return redirect('/dashboard')->with('danger', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm()
    {
        if(auth()->user()->role == 'Admin') {
            $transactions = Transaction::where('status', 'Bayar DP')->get();
            return view('admin.transaction.confirm', compact('transactions'));
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
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $setting = Setting::first();
        $transaction = Transaction::findOrFail($id);
        $carts = Cart::where('transaction_id', $id)
                    ->where(function($q) {
                        $q->where('status', '=', 'Deal')
                        ->orWhere('status', '=', 'Event Selesai');
                    })->get();
        $harga[] = 0;
        foreach($carts as $cart) {
            $harga[] = $cart->package->price;
            $harga[] = $cart->tambahan;
        }
        $total = array_sum($harga);


        $pdf = PDF::loadview('transaction.invoice',
                            compact('setting', 'transaction', 'carts', 'total'))->setPaper('a4', 'landscape');

        return $pdf->stream($transaction->invoice.' - '.time().'.pdf');
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

        $transaction1 = Transaction::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();

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
        $banks = Bank::all();
        $transaction = Transaction::findOrFail($id);
        $setting = Setting::first();
        $harga[] = 0;
        $dp1[] = 0;
        foreach($transaction->carts as $cart) {
            if($cart->status == 'Deal') {
                
                $harga[] = $cart->package->price;
                $harga[] = $cart->tambahan;

                $bayar_dp = $cart->package->price + $cart->tambahan;
                $dp1[] = round(($cart->dp / 100) * ($bayar_dp));
            }
        }
        $dp = array_sum($dp1);
        $total = array_sum($harga);
        return view('transaction.show', compact('transaction', 'banks', 'total', 'setting', 'dp'));
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
        redirect('/transaction/'.$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayardp(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'image|max:1999'
        ],
        [
            'image' => 'Bukti pembayaran harus berupa gambar'
        ]);
        $transaction = Transaction::findOrFail($id);

        $transaction->bank_id = $request->input('bank');
        $transaction->rekening = $request->input('rekening');
        $transaction->atas_nama = $request->input('atas_nama');
        $transaction->status = 'Bayar DP';
        $transaction->jml_bayar = $request->input('jml_bayar');
        
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $FileNameToStore = $filename.'_'.time().'_.'.$extension;
        $path = public_path('storage/legaldoc/');
        $request->file('image')->move($path, $FileNameToStore);
        
        //$path = $request->file('image')->storeAs('public/legaldoc/', $FileNameToStore);
        
        if ($transaction->image !== NULL) {
            $file = public_path('storage/legaldoc/'.$transaction->image);
            unlink($file);
        }

        $transaction->image = $FileNameToStore;

        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran telah diupload. Silahkan tunggu konfirmasi dari Admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolakdp(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'Menunggu Pembayaran';
        
        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran dibatalkan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmdp(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'DP Confirmed';
        $transaction->alasan = NULL;
        
        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran Diterima.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bayarlunas(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'image|max:1999'
        ],
        [
            'image' => 'Bukti pembayaran harus berupa gambar'
        ]);
        $transaction = Transaction::findOrFail($id);

        $transaction->bank_id1 = $request->input('bank');
        $transaction->rekening1 = $request->input('rekening');
        $transaction->atas_nama1 = $request->input('atas_nama');
        $transaction->status = 'Bayar Lunas';
        $transaction->jml_bayar =$transaction->jml_bayar + $request->input('jml_bayar');
        
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $FileNameToStore = $filename.'_'.time().'_.'.$extension;
        $path = public_path('storage/legaldoc/');
        $request->file('image')->move($path, $FileNameToStore);
        
        //$path = $request->file('image')->storeAs('public/legaldoc/', $FileNameToStore);
        
        if ($transaction->image1 !== NULL) {
            $file = public_path('storage/legaldoc/'.$transaction->image1);
            unlink($file);
        }

        $transaction->image1 = $FileNameToStore;

        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran telah diupload. Silahkan tunggu konfirmasi dari Admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancellunas(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'DP Confirmed';
        
        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran dibatalkan.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolaklunas(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'DP Confirmed';
        $transaction->alasan = $request->input('alasan');
        
        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran Ditolak dengan alasan "'.$transaction->alasan.'"');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmlunas(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'Payment Confirmed';
        $transaction->alasan = NULL;
        
        $transaction->save();

        return redirect('/transaction/'.$id)->with('success', 'Bukti pembayaran Diterima.');
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
