@extends('layouts.app')

@section('style')
<link href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dore.light.blue.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('inc.navbar')
<!-- Sidebar -->
<div class="sidebar">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="active">
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
                <li>
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
                <li class="active">
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
                    <li>
                        <a href="/review">
                            <i class="simple-icon-star"></i> Ulasan
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
                    <li>
                        <a href="/review">
                            <i class="simple-icon-star"></i> Ulasan
                        </a>
                    </li>
                </ul>
            @endif

            <ul class="list-unstyled" data-link="myaccount">
                <li>
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
            </ul>
        </div>
    </div>
</div>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Dashboard</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item active" aria-current="page">
                            Home
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
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
                @include('inc.messages')
                <div class="col-lg-12 col-xl-6">

                    <div class="icon-cards-row">
                        <div class="owl-container">
                            <div class="owl-carousel dashboard-numbers">
                                <a href="/pesananpending" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsmind-Waiter"></i>
                                        <p class="card-text mb-0">Pesanan Pending</p>
                                        <p class="lead text-center">{{count(auth()->user()->orgpendcarts)}}</p>
                                    </div>
                                </a>
                                <a href="/upcoming" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-calendar"></i>
                                        <p class="card-text mb-0">Upcoming Event</p>
                                        <p class="lead text-center">{{count(auth()->user()->orgupcarts)}}</p>
                                    </div>
                                </a>

                                <a href="/pesanandone" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsmind-Mail-Read"></i>
                                        <p class="card-text mb-0">Pesanan Sukses</p>
                                        <p class="lead text-center">{{count(auth()->user()->orgdonecarts)}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="card">
                        <div class="position-absolute card-top-buttons">
                            <a class="btn btn-outline-primary btn-sm" href="/pesananpending">See All</a>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Pesanan Pending</h5>
                            @if(count(auth()->user()->orgpendcarts_lim) > 0)
                                @foreach(auth()->user()->orgpendcarts_lim as $cart)
                                    <div class="d-flex flex-row mb-3">
                                        <a class="d-block position-relative" href="/cart/{{$cart->id}}">
                                            <img src="{{ asset('/storage/package/'.$cart->package->image)}}" alt="Marble Cake" class="list-thumbnail border-0" />
                                        </a>
                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                            <a href="/cart/{{$cart->id}}">
                                                <p class="list-item-heading">{{$cart->package->nama}}</p>
                                                <div class="pr-4 d-none d-sm-block">
                                                    <p class="text-muted mb-1 text-small">
                                                        {{$cart->address}}, 
                                                        {{ucwords(strtolower($cart->district['name']))}}, 
                                                        {{ucwords(strtolower($cart->regency['name']))}}, 
                                                        {{ucwords(strtolower($cart->province['name']))}}
                                                    </p>
                                                </div>
                                                <div class="text-primary text-small font-weight-medium d-none d-sm-block">{{date('d/m/20y', strtotime($cart->event_date))}}</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada pesanan pending.</p>
                            @endif
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
<script src="{{ asset('js/vendor/select2.full.js') }}"></script>
@endsection