<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\User;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'Customer') {
            $carts = Cart::where('status', 'Event Selesai')->where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        } else {
            $mypackages = auth()->user()->allpackages;
            foreach($mypackages as $mypackage) {
                $mypackagesid[] =  $mypackage->id;
            }
            $carts = Cart::where('status', 'Event Selesai')->whereIn('package_id', $mypackagesid)->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('review.index', compact('carts'));
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
        //
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
        return view('review.show', compact('cart'));

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
        $cart = Cart::findOrFail($id);
        
        $cart->rate = $request->input('rate');
        $cart->ulasan = $request->input('ulasan');
        $cart->ubah = true;
        $cart->save();

        return redirect('/review/'.$id)->with('success', 'Ulasan diperbaharui.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function response(Request $request, $id)
    {
        $response = $request->input('response');
        $cart = Cart::findOrFail($id);

        $user = User::findOrFail($cart->user_id);
        if($response == 'Sangat Buruk') {
            $user->reputasi = $user->reputasi - 100;
        } elseif($response == 'Buruk') {
            $user->reputasi = $user->reputasi - 50;
        } elseif($response == 'Cukup') {
            $user->reputasi = $user->reputasi + 10;
        } elseif($response == 'Memuaskan') {
            $user->reputasi = $user->reputasi + 50;
        } elseif($response == 'Sangat Memuaskan') {
            $user->reputasi = $user->reputasi + 100;
        } 
        $user->save();

        $cart->respon = $response;
        $cart->save();

        return redirect('/review/'.$id)->with('success', 'Response telah diberikan');
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
