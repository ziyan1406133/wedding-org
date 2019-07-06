<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\User;
use App\Province;
use App\Regency;
use App\District;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('created_at', 'desc')->paginate(10);

        return view('package.index', compact('packages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myindex()
    {
        if(auth()->user()->role == 'Wedding Organizer') {
            $packages = Package::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
    
            return view('package.myindex', compact('packages'));
        } else {
            return redirect('/home')->with('error', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role == 'Wedding Organizer') {
            
            return view('package.create');
        } else {
            return redirect('/home')->with('error', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = new Package;
        $package->user_id = auth()->user()->id;
        $package->nama = $request->input('nama');
        $package->price = $request->input('price');
        $package->description = $request->input('description');
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;
            $path = $request->file('image')->storeAs('public/package/', $FileNameToStore);
            $package->image = $FileNameToStore;
        }
        $package->save();

        return redirect('/mypackage')->with('success', 'Paket Baru Telah Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::findOrFail($id);
        $user = User::where('id', $package->user_id)->first();
        $provinces = Province::all();
        return view('package.show', compact('package', 'user', 'provinces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        if(auth()->user()->id == $package->user_id) {
            
            return view('package.edit', compact('package'));
        } else {
            return redirect('/home')->with('error', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
        }
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
        $package = Package::findOrFail($id);
        $package->user_id = auth()->user()->id;
        $package->nama = $request->input('nama');
        $package->price = $request->input('price');
        $package->description = $request->input('description');
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;
            $path = $request->file('image')->storeAs('public/package/', $FileNameToStore);
            if ($package->image !== 'no_image.png') {
                Storage::delete('public/package/'.$package->image);
            }
            $package->image = $FileNameToStore;
        }
        $package->save();

        return redirect('/package/'.$id)->with('success', 'Paket Telah Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        if($package->image !== 'no_image.png') {
            Storage::delete('/public/avatar/'.$package->image);
        }
        $package->delete();
        return redirect('/mypackage')->with('success', 'Paket Berhasil Dihapus');
    }
    
    //dynamic select form
    public function regencies(){
        $provinces_id = Input::get('province_id');
        $regencies = Regency::where('province_id', '=', $provinces_id)->get();
        return response()->json($regencies);
    }
  
    public function districts(){
        $regencies_id = Input::get('regencies_id');
        $districts = District::where('regency_id', '=', $regencies_id)->get();
        return response()->json($districts);
    }

}