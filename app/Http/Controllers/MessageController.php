<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Cart;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'Admin') {
            $messages = Message::all();
            $nav_admins = Cart::where('status', 'Event Selesai')->orderBy('updated_at', 'desc')->limit(4)->get();
    
            return view('admin.messages', compact('messages', 'nav_admins'));
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
        $message = new Message;
        $message->name = $request->input('name');
        $message->email = $request->input('email');
        $message->pesan = $request->input('pesan');
        $message->save();
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
        if(auth()->user()->role == 'Admin') {
            $message = Message::findOrFail($id);
            $nav_admins = Cart::where('status', 'Event Selesai')->orderBy('updated_at', 'desc')->limit(4)->get();

            return view('admin.showmessage', compact('message', 'nav_admins'));
        } else {
            return redirect('/home')->with('error', 'Unauthorized Access.');
        }
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
        //
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect('/message')->with('success', 'Pesan berhasil dihapus');
    }
}
