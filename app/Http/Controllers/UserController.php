<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Bank;
use App\Province;
use App\Regency;
use App\District;
use App\Package;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['organizer', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status', '!=', NULL)->orderBy('created_at', 'desc')->get();
        return view('admin.user.all', compact('users'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function organizer()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifieduser()
    {
        $users = User::where('status', 'Terverifikasi')->get();
        return view('admin.user.verified', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unverifieduser()
    {
        $users = User::where('status', 'Belum Terverifikasi')->get();
        return view('admin.user.pending', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejecteduser()
    {
        $users = User::where('status', 'Ditolak')->get();
        return view('admin.user.rejected', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect ('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect ('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if($user->role == 'Admin') {
            return view('admin.profil', compact('user'));
        } elseif ($user->role == 'Wedding Organizer') {
            return view('organizer.profil', compact('user'));
        } else {
            return view('customer.profil', compact('user'));
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
        $user = User::findOrFail($id);
        $provinces = Province::all();

        if((auth()->user()->role == 'Admin') || (auth()->user()->id == $id)) {
            if($user->role == 'Customer') {
                return view('customer.edit', compact('user', 'provinces'));
            } elseif($user->role == 'Wedding Organizer') {
                $banks = Bank::orderBy('nama', 'asc')->get();
                return view('organizer.edit', compact('user', 'provinces', 'banks'));
            } else {
                return view('admin.edit', compact('user', 'provinces'));
            }
        } else {
            return redirect ('/home')->with('error', 'Anda tidak memiliki hak untuk mengakses halaman tersebut.');
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
        $this->validate($request, [
            'avatar' => 'image|max:1999',
            'legal_doc' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1999'
        ],
        [
            'avatar.image' => 'Foto avatar yang diupload harus berupa gambar',
            'legal_doc.mimes' => 'Dokumen yang diupload harus berupa Gambar atau PDF',
            'max' => 'Maksimum ukuran file yang diupload adalah 1.9 MB'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile_no = $request->input('mobile_no');
        $user->bio = $request->input('bio');
        $user->province_id = $request->input('provinces');
        $user->regency_id = $request->input('regencies');
        $user->district_id = $request->input('districts');
        $user->address = $request->input('address');
        $user->bank_id = $request->input('bank');
        $user->rekening = $request->input('rekening');
        $user->atas_nama = $request->input('atas_nama');
        if($request->hasFile('avatar')){
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $FileNameToStore = $filename.'_'.time().'_.'.$extension;
            $path = $request->file('avatar')->storeAs('public/avatar/', $FileNameToStore);
            
            if ($user->avatar !== 'no_avatar.png') {
                Storage::delete('public/avatar/'.$user->avatar);
            }
            $user->avatar = $FileNameToStore;
        }
        if($request->hasFile('legal_doc')){
            $filenameWithExt1 = $request->file('legal_doc')->getClientOriginalName();
            $filename1 = pathInfo($filenameWithExt1, PATHINFO_FILENAME);
            $extension1 = $request->file('legal_doc')->getClientOriginalExtension();
            $FileNameToStore1 = $filename1.'_'.time().'_.'.$extension1;
            $path1 = $request->file('legal_doc')->storeAs('public/legaldoc/', $FileNameToStore1);
            
            if ($user->legal_doc !== 'no_image.png') {
                Storage::delete('public/legaldoc/'.$user->legal_doc);
            }
            $user->legal_doc = $FileNameToStore1;
        }
        if($user->status == 'Ditolak') {
            $user->status = 'Belum Terverifikasi';
        }
        $user->save();
        return redirect('user/'.$id)->with('success', 'Profil anda telah diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $packages = Package::where('user_id', $id)->get();
        if(count($packages) > 0) {
            foreach($packages as $package) {
                if($package->image !== 'no_image.png') {
                    Storage::delete('/public/avatar/'.$package->image);
                }
                $package->delete();
            }
        }
        if($user->avatar !== 'no_avatar.png') {
            Storage::delete('/public/avatar/'.$user->avatar);
        }
        if($user->legal_doc !== 'no_image.png') {
            Storage::delete('/public/avatar/'.$user->legal_doc);
        }
        $user->delete();
        return redirect('/user')->with('success', 'Akun Berhasil Dihapus');
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


    //Edit Password
    public function editpassword($id) {
        if(auth()->user()->id == $id) {
            $user = User::findOrFail($id);
            return view('auth.editpassword', compact('user'));

        } else {
            return redirect('/home')->with('error', 'Anda tidak memiliki hak akses.');
        }

    }

    public function editpassword1(Request $request, $id) {

        $this->validate($request, [
            'password1' => 'same:password2'
            ],
            [
                'same' => 'Konfirmasi Password Baru Tidak Sesuai'
            ]);
        $oldpassword = $request->input('oldpassword');
        $user = User::findOrFail($id);
        if (Hash::check($oldpassword, $user->password)) {
            $user->password = Hash::make($request->input('password1'));
            $user->save();

            return redirect('/user/'.$id)->with('success', 'Password Berhasil Diperbaharui.');
        } else {
            return redirect('/editpassword/'.$id.'/user')->with('error', 'Password Lama Tidak Sesuai.');
        }
    }

    public function verifikasi(Request $request)
    {
        $user = User::findOrFail($request->input('id'));

        if($user->address == NULL) {
            return redirect('/user/'.$request->input('id'))->with('error', 'Tidak bisa memverifikasi akun user yang belum lengkap.');
        }

        $user->status = $request->input('status');
        $user->alasan = $request->input('alasan');
        $user->save();
        if($request->input('status') == 'Terverifikasi'){

            return redirect('/user/'.$request->input('id'))->with('success', 'User berhasil diverifikasi');
        } elseif($request->input('status') == 'Ditolak') {

            return redirect('/user/'.$request->input('id'))->with('success', 'User berhasil ditolak dengan alasan "'.$request->input('alasan').'"');
        }
    }
}
