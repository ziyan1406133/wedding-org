@extends('layouts.app')

@section('style')
<link href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dore.light.blue.min.css') }}" rel="stylesheet">
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
                <li>
                    <a href="#admin">
                        <i class="iconsmind-Administrator"></i> Menu Admin
                    </a> 
                </li>
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
            </ul>

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
                    <a href="/konfirmasibayar">
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
                @include('inc.messages')

                <div class="col-lg-12 col-xl-6">

                    <div class="icon-cards-row">
                        <div class="owl-container">
                            <div class="owl-carousel dashboard-numbers">
                                <a href="/confirmindex" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsmind-Money-2"></i>
                                        <p class="card-text mb-0">Menunggu Konfirmasi</p>
                                        <p class="lead text-center">{{count($ctransactions)}}</p>
                                    </div>
                                </a>
                                <a href="/unverifieduser" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-user-follow"></i>
                                        <p class="card-text mb-0">Menunggu Verifikasi</p>
                                        <p class="lead text-center">{{count($cusers)}}</p>
                                    </div>
                                </a>

                                <a href="/message" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsmind-Mail-Read"></i>
                                        <p class="card-text mb-0">Messages</p>
                                        <p class="lead text-center">{{count($messages)}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="position-absolute card-top-buttons">
                                    <a class="btn btn-outline-primary btn-sm" href="/unverifiedusers">See All</a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title flex-row mb-3">Menunggu Konfirmasi</h5>
                                    @if(count($transactions) > 0)
                                        @foreach($transactions as $transaction)
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                                <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/transaction/{{$transaction->id}}">
                                                    {{$transaction->invoice}}
                                                </a> 
                                                <p class="mb-1 text-muted text-small w-15 w-xs-100">Dibayar pada {{date('d/m/20y', strtotime($transaction->updated_at))}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <p>Tidak ada transaksi yang menunggu konfirmasi pembayaran.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="card">
                        <div class="position-absolute card-top-buttons">
                            <a class="btn btn-outline-primary btn-sm" href="/unverifiedusers">See All</a>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Menunggu Verifikasi</h5>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <div class="d-flex flex-row mb-3">
                                        <a class="d-block position-relative" href="/user/{{$user->id}}">
                                            <img src="{{ asset('/storage/avatar/'.$user->avatar)}}" alt="Marble Cake" class="list-thumbnail border-0" />
                                        </a>
                                        <div class="pl-3 pt-2 pr-2 pb-2">
                                            <a href="/user/{{$user->id}}">
                                                <p class="list-item-heading">{{$user->name}}</p>
                                                <div class="pr-4 d-none d-sm-block">
                                                    <p class="text-muted mb-1 text-small">
                                                        @if($user->address != NULL)
                                                            {{$user->address}}, 
                                                            {{ucwords(strtolower($user->district['name']))}}, 
                                                            {{ucwords(strtolower($user->regency['name']))}}, 
                                                            {{ucwords(strtolower($user->province['name']))}}
                                                        @else
                                                            Alamat belum diisi.
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="text-primary text-small font-weight-medium d-none d-sm-block">Bergabung pada {{date('d/m/20y', strtotime($user->created_at))}}</div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada transaksi yang menunggu konfirmasi pembayaran.</p>
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
@endsection