<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Package;
use App\User;
use App\Transaction;
use App\Message;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = Setting::first();
        $packages = Package::where('hidden', FALSE)->inRandomOrder()->limit(4)->get();
        return view('landing', compact('setting', 'packages'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        if(Auth::check()) {
            if(auth()->user()->role == 'Admin') {
                $cusers = User::where('status', 'Belum Terverifikasi')->get();
                $ctransactions = Transaction::where('status', 'Bayar DP')->orWhere('status', 'Bayar Lunas')->get();

                $users = User::where('status', 'Belum Terverifikasi')->orWhere('status', 'Bayar Lunas')->orderBy('updated_at','desc')->limit(4)->get();
                $transactions = Transaction::where('status', 'Bayar DP')->orWhere('status', 'Bayar Lunas')->orderBy('updated_at','desc')->limit(4)->get();

                $messages = Message::all();
                return view('admin.dashboard', compact('users', 'transactions', 'messages', 'cusers', 'ctransactions'));
            } elseif(auth()->user()->role == 'Customer') {
                
                return view('customer.dashboard');
            } elseif(auth()->user()->role == 'Wedding Organizer') {
    
                $cpendcarts[] = 0;
                foreach(auth()->user()->orgpendcarts as $pendingcart) {
                    if($pendingcart->status == 'Pending') {
                        $cpendcarts[] = $pendingcart->id;
                    }
                }

                $cdonecarts[] = 0;
                foreach(auth()->user()->orgdonecarts as $donecart) {
                    if($donecart->status == 'Pending') {
                        $cdonecarts[] = $donecart->id;
                    }
                }
                return view('organizer.dashboard', compact('cpendcarts', 'cdonecarts'));
            }
        } else {
            $packages = Package::where('hidden', FALSE)->orderBy('created_at')->limit(4)->get();
            $cpackages = Package::where('hidden', FALSE)->get();

            return view('home', compact('packages', 'cpackages'));
        }
    }
}
