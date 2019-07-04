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
                    <a href="/organizer">
                        <i class="iconsmind-Conference"></i> Wedding Organizer
                    </a>
                </li>
                <li>
                    <a href="/package">
                        <i class="iconsmind-Box-withFolders"></i> Paket Wedding
                    </a>
                </li>
            </ul>
            @auth   
                @if(auth()->user()->role == 'Customer')
                    <ul class="list-unstyled" data-link="transactions">
                        <li>
                            <a href="/finishedt">
                                <i class="iconsmind-Money-Bag"></i> Transaksi Selesai
                            </a>
                        </li>
                        <li>
                            <a href="/pendingt">
                                <i class="iconsmind-Waiter"></i> Transaksi Berjalan
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
                                <i class="simple-icon-people"></i> All Users
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
                            <a href="/adminpackage">
                                <i class="iconsmind-Box-withFolders"></i> Packages
                            </a>
                        </li>
                        <li>
                            <a href="/transaction">
                                <i class="iconsmind-Money-2"></i> Transactions
                            </a>
                        </li>
                    </ul>

                @elseif(auth()->user()->role == 'Wedding Organizer')
                    <ul class="list-unstyled" data-link="organizer">
                        <li>
                            <a href="/finishedt">
                                <i class="iconsmind-Money-Bag"></i> Transaksi Selesai
                            </a>
                        </li>
                        <li>
                            <a href="/pendingt">
                                <i class="iconsmind-Waiter"></i> Transaksi Berjalan
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

                <h1>Paket Wedding </h1>
                @if(auth()->user()->id == $package->user_id)
                    <div class="float-right">
                        <button type="button" class="btn btn-lg btn-empty dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="iconsmind-Gear"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/package/{{$package->id}}/edit">Edit Paket</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#confirmdelete" href="#">Hapus Paket</a>
                        </div>
                    </div>
                    <div class="modal fade" id="confirmdelete" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi</h4>
                                </div>
                                <div class="modal-body">
                                    <p align="left">Apakah anda yakin untuk menghapus paket ini?</p>
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
                @endif
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/package">Package</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/user/{{$package->user['id']}}">{{$package->user['username']}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$package->nama}}
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

                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <img src="{{ asset('/storage/package/'.$package->image) }}" alt="Detail Picture" class="card-img-top">

                            <div class="card-body">
                                <p class="text-muted text-small mb-2">Wedding Organizer</p>
                                <p class="mb-3">
                                   <a href="/user/{{$package->user->id}}">{{$package->user->name}}</a>
                                </p>
                                <p class="text-muted text-small mb-2">Alamat WO</p>
                                <p class="mb-3">
                                    {{$package->user->address}}, {{$user->district['name']}}, {{$user->regency['name']}}, {{$user->province['name']}};
                                </p>
                                <p class="text-muted text-small mb-2">Deskripsi</p>
                                <p class="mb-3">
                                    {!!$package->description!!}
                                </p>
                                <p class="text-muted text-small mb-2">Price</p>
                                <p class="mb-3">{{ number_format($package->price,0,",",".") }}</p>
                            </div>
                        </div>
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