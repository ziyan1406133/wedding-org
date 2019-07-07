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
                <li class="active">
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

                <h1>Paket Wedding</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Packages
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>
                
                @if(count($packages) > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($packages as $package)
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
                                            <footer>
                                                <a href="/user/{{$package->user['id']}}" class="text-muted text-small mb-0 font-weight-light">{{$package->user['name']}}</a>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$packages->links()}}
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
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection