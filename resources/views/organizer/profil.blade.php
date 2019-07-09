@extends('layouts.app')

@section('style')
<link href="{{ asset('css/dore.light.blue.min.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('inc.navbar')
<!-- Sidebar -->
<div class="sidebar">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="#home">
                        <i class="iconsmind-Home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="#cari">
                        <i class="iconsmind-WomanMan"></i> Wedding
                    </a>
                </li>
                @auth   
                    @if((auth()->user()->role == 'Customer') && (auth()->user()->status == 'Terverifikasi'))
                    <li>
                        <a href="#transactions">
                            <i class="iconsmind-Money-2"></i> Transaksi
                        </a>
                    </li>
                    @elseif(auth()->user()->role == 'Admin')
                    <li>
                        <a href="#admin">
                            <i class="iconsmind-Administrator"></i> Menu Admin
                        </a> 
                    </li>
                    @elseif((auth()->user()->role == 'Wedding Organizer') && (auth()->user()->status == 'Terverifikasi'))
                    <li>
                        <a href="#organizer">
                            <i class="iconsmind-Box-Full"></i> Menu WO
                        </a> 
                    </li>
                    @endif
                @endauth
                <li class="active">
                    <a href="#myaccount">
                        <i class="iconsmind-User"></i> My Account
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="home">
                <li>
                    <a href="/home">
                        <i class="iconsmind-Line-Chart"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/">
                        <i class="simple-icon-rocket"></i>Landing Page
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled" data-link="cari">
                <li>
                    <a href="/package">
                        <i class="iconsmind-Box-withFolders"></i> Paket Wedding
                    </a>
                </li>
                @auth
                    @if(auth()->user()->role != 'Admin')
                    <li>
                        <a href="/upcoming">
                            <i class="simple-icon-calendar"></i> Upcoming Event
                        </a>
                    </li>
                    @endif
                @endauth
            </ul>
            @auth   
                @if(auth()->user()->role == 'Customer')
                    <ul class="list-unstyled" data-link="transactions">
                        <li>
                            <a href="/transaction">
                                <i class="iconsmind-Money-Bag"></i> Invoice
                            </a>
                        </li>
                        <li>
                            <a href="/cart">
                                <i class="iconsmind-Full-Cart"></i> Cart
                            </a>
                        </li>
                    </ul>

                @elseif(auth()->user()->role == 'Admin')
                    <ul class="list-unstyled" data-link="admin">
                        <li>
                            <a href="/user">
                                <i class="simple-icon-people"></i> Semua User
                            </a>
                        </li>
                        <li>
                            <a href="/verifieduser">
                                <i class="simple-icon-user-following"></i> User Terverifikasi
                            </a>
                        </li>
                        <li>
                            <a href="/unverifieduser">
                                <i class="simple-icon-user-follow"></i> User Pending
                            </a>
                        </li>
                        <li>
                            <a href="/rejecteduser">
                                <i class="simple-icon-user-unfollow"></i> User Ditolak
                            </a>
                        </li>
                        <li>
                            <a href="/confirmindex">
                                <i class="iconsmind-Money-2"></i> Confirm Pembayaran
                            </a>
                        </li>
                        <li>
                            <a href="/setting">
                                <i class="iconsmind-Gears"></i> Info Aplikasi
                            </a>
                        </li>
                        <li>
                            <a href="/message">
                                <i class="iconsmind-Mail-2"></i> Messages
                            </a>
                        </li>
                    </ul>

                @elseif(auth()->user()->role == 'Wedding Organizer')
                    <ul class="list-unstyled" data-link="organizer">
                        <li>
                            <a href="/pesanandone">
                                <i class="iconsmind-Money-Bag"></i> Pesanan
                            </a>
                        </li>
                        <li>
                            <a href="/pesananpending">
                                <i class="iconsmind-Waiter"></i> Pesanan Pending
                            </a>
                        </li> 
                        <li>
                            <a href="/mypackage">
                                <i class="iconsmind-Box-withFolders"></i> My Package
                            </a>
                        </li>
                    </ul>
                @endif
            @endauth

            <ul class="list-unstyled" data-link="myaccount">
                @auth
                    <li class="active">
                        <a href="/user/{{auth()->user()->id}}">
                            <i class="simple-icon-user"></i> Lihat Profil
                        </a>
                    </li>
                    <li>
                        <a href="/editpassword/{{auth()->user()->id}}/user">
                            <i class="iconsmind-Key"></i> Ganti Password
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="simple-icon-logout"></i> Sign Out
                        </a>
                    </li>
                @else
                    <li>
                        <a href="/login">
                            <i class="simple-icon-login"></i> Sign in
                        </a>
                    </li>
                    <li>
                        <a href="/register">
                            <i class="simple-icon-arrow-up-circle"></i> Sign Up
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Profil {{$user->username}} </h1>
                @auth
                <div class="float-right">
                    @if((auth()->user()->role == 'Admin') && ($user->status != 'Terverifikasi'))
                        <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#confirmverify" ><i class="simple-icon-check"></i>
                        </a>
                        <div class="modal fade" id="confirmverify" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    {!! Form::open(['action' => 'UserController@verifikasi', 'method' => 'POST']) !!}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Konfirmasi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            Anda yakin untuk memverifikasi akun ini?
                                            {!! Form::text('id', $user->id, ['hidden' => 'hidden']) !!}
                                            {!! Form::text('status', 'Terverifikasi', ['hidden' => 'hidden']) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                            {{Form::submit('Ya', ['class' => 'btn btn-success btn-md'])}}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmtolak" >
                            <i class="simple-icon-close"></i>
                        </a>
                        <div class="modal fade" id="confirmtolak" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    {!! Form::open(['action' => 'UserController@verifikasi', 'method' => 'POST']) !!}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Alasan Penolakan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {!! Form::text('id', $user->id, ['hidden' => 'hidden']) !!}
                                            {!! Form::text('status', 'Ditolak', ['hidden' => 'hidden']) !!}
                                            {!! Form::textarea('alasan', '', ['class' => 'form-control', 'rows' => '3', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                            {{Form::submit('Submit', ['class' => 'btn btn-danger btn-md'])}}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if((auth()->user()->role == 'Admin') || (auth()->user()->id == $user->id))
                        <a href="#" class="btn btn-empty dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="iconsmind-Gear"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/user/{{$user->id}}/edit">Edit Profil</a>
                            @if(auth()->user()->id == $user->id)
                                <a class="dropdown-item" href="/editpassword/{{$user->id}}/user">Edit Password</a>
                            @elseif((auth()->user()->role == 'Admin') && ($user->role != 'Admin'))
                                <a class="dropdown-item" data-toggle="modal" data-target="#confirmdelete" href="#">Hapus Akun</a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal fade" id="confirmdelete" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi</h4>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin untuk menghapus akun ini? Semua paket WO ini juga akan terhapus semua.</p>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                        <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                        {{Form::submit('Ya', ['class' => 'btn btn-danger btn-md'])}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endauth

                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/user">Organizer</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$user->username}}
                        </li>
                    </ol>
                </nav>
                @auth
                    @if(auth()->user()->status == 'Belum Terverifikasi')
                        <div class="alert alert-warning alert-dismissible fade show rounded mb-0" role="alert">
                            Akun tidak bisa melakukan transaksi apabila belum diverifikasi oleh admin, 
                            pastikan anda telah <a href="/user/{{auth()->user()->id}}/edit">melengkapi profil</a>,
                            kemudian tunggu selama 24 jam hari kerja.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                    @elseif(auth()->user()->status == 'Ditolak')
                        <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                            Akun anda telah ditolak pada tahap verifikasi oleh admin,
                            silahkan <a href="/user/{{auth()->user()->id}}/edit">perbaiki profil</a> 
                            anda sesuai arahan dari admin yang bisa terlihat pada halaman edit profil.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endauth
                @include('inc.messages')
                <br>
                <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">PROFIL</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">PAKET WEDDING</a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                        <div class="row">
                            <div class="col-lg-4 col-12 mb-4">
                                <div class="card mb-4">
                                    <img src="{{ asset('/storage/avatar/'.$user->avatar) }}" alt="Detail Picture" class="card-img-top">

                                    <div class="card-body">
                                        <p class="text-muted text-small mb-2">Alamat</p>
                                        <p class="mb-3">
                                            @if($user->address == NULL)
                                                <td>Belum diisi.</td>
                                            @else
                                                <td>{{$user->address}}, {{ucwords(strtolower($user->district['name']))}}, {{ucwords(strtolower($user->regency['name']))}}, {{ucwords(strtolower($user->province['name']))}}</td>
                                            @endif
                                        </p>
                                        <p class="text-muted text-small mb-2">Bio</p>
                                        <p class="mb-3">
                                            @if($user->bio !== null)
                                                {{$user->bio}}
                                            @else
                                                Belum diisi.
                                            @endif
                                        </p>
                                        <p class="text-muted text-small mb-2">Member Since</p>
                                        <p class="mb-3">{{ date('d-m-20y', strtotime($user->created_at)) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>: {{$user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Username</td>
                                                    <td>: {{$user->username}}</td>
                                                </tr>
                                                @auth
                                                @if((auth()->user()->role == 'Admin') || (auth()->user()->id == $user->id))
                                                    <tr>
                                                        <td>E-Mail</td>
                                                        <td>: {{$user->email}}</td>
                                                    </tr>
                                                @endif
                                                @if(auth()->user()->role == 'Admin')
                                                    <tr>
                                                        <td>Role</td>
                                                        <td>: {{$user->role}}</td>
                                                    </tr>
                                                @endif
                                                @endauth
                                                <tr>
                                                    <td>No HP</td>
                                                    @if($user->mobile_no == NULL)
                                                        <td>: -</td>
                                                    @else
                                                        <td>: {{$user->mobile_no}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    @if($user->address == NULL)
                                                        <td>: -</td>
                                                    @else
                                                        <td>: {{$user->address}}, {{ucwords(strtolower($user->district['name']))}}, {{ucwords(strtolower($user->regency['name']))}}, {{ucwords(strtolower($user->province['name']))}}</td>
                                                    @endif
                                                </tr>
                                                @auth
                                                @if((auth()->user()->role == 'Admin') || (auth()->user()->id == $user->id))
                                                <tr>
                                                    <td>No Rekening</td>
                                                    @if($user->rekening == NULL)
                                                        <td>: -</td>
                                                    @else
                                                        <td>: {{$user->rekening}} ({{$user->bank->nama}})</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>Atas Nama</td>
                                                    @if($user->atas_nama == NULL)
                                                        <td>: -</td>
                                                    @else
                                                        <td>: {{$user->atas_nama}}</td>
                                                    @endif
                                                </tr>
                                                    <tr>
                                                        <td>CV / SIUP / NPWP</td>
                                                        @if($user->legal_doc == 'no_image.png')
                                                            <td>: -</td>
                                                        @else
                                                        <td>: <a class="btn btn-outline-primary btn-sm" 
                                                            href="{{ asset('/storage/legaldoc/'.$user->legal_doc) }}" >
                                                            Lihat</a>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>: {{$user->status}}</td>
                                                    </tr>
                                                    @if($user->status == 'Ditolak')
                                                    <tr>
                                                        <td>Alasan Ditolak</td>
                                                        <td>: {{$user->alasan}}</td>
                                                    </tr>
                                                    @endif
                                                @endif
                                                @endauth
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                        @auth
                        @if((auth()->user()->role == 'Wedding Organizer') && (auth()->user()->status == 'Terverifikasi'))
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="float-right">
                                        <a class="btn btn-outline-primary btn-lg" href="/package/create">Tambah</a>
                                    </div>
                                </div>
                            </div>  
                        @endif
                        @endauth
                        @if(count($user->packages) > 0)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($user->packages as $package)
                                        <div class="col">
                                            <div class="card mb-3 shadow text-center">
                                                <div class="position-relative">
                                                    <a href="/package/{{$package->id}}"><img class="card-img-top" src="{{asset('/storage/package/'.$package->image)}}" alt="Card image cap"></a>
                                                </div>
                                                <div class="card-body">
                                                    <a href="/package/{{$package->id}}">
                                                        <p class="list-item-heading">{{$package->nama}}</p>
                                                        <p class="mb-4">Rp. {{ number_format($package->price,0,",",".") }}</p>
                                                    </a>
                                                    @auth
                                                    @if(auth()->user()->id == $user->id)
                                                    <div class="text-center">
                                                        <a class="btn default btn-secondary btn-sm" href="/package/{{$package->id}}/edit"><i class="simple-icon-pencil"></i></a>
                                                        <a class="btn default btn-danger btn-sm" data-toggle="modal" data-target="#deletpackage{{$package->id}}" href="#"><i class="simple-icon-trash"></i></a>
                                                    </div>
                                                    @endif
                                                    @endauth
                                                </div>
                                            </div>

                                            <div class="modal fade" id="deletpackage{{$package->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Konfirmasi</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus paket ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!!Form::open(['action' => ['PackageController@destroy', $package->id], 'method' => 'POST'])!!}
                                                                {{Form::hidden('_method', 'DELETE')}}
                                                                    <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                                    {{Form::submit('Ya', ['class' => 'btn btn-danger btn-md'])}}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        

                        @else
                            <div class="card">
                                <div class="card-body">
                                    Tidak ada data yang tersedia.
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection