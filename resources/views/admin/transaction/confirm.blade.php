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
                <li class="active">
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
                <li>
                    <a href="/upcoming">
                        <i class="simple-icon-calendar"></i> Upcoming Event
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="admin">
                <li class="active">
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
            <div class="col">

                <h1>Pesanan Pending</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transaction</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Pending
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
            </div>
        </div>
        @if(count($transactions) > 0)
            @foreach($transactions as $transaction)
                <div class="card d-flex flex-row mb-3">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/transaction/{{$transaction->id}}">
                                {{$transaction->invoice}}
                            </a>
                            <p class="mb-1 text-muted text-small w-15 w-xs-100">created at {{date('d/m/20y', strtotime($transaction->created_at))}}</p>
                            <div class="w-15 w-xs-100">
                                <span class="badge badge-pill badge-secondary">MENUNGGU PEMBAYARAN</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="card">
            <div class="card-body">
                <p>Tidak ada transaksi yang menunggu konfirmasi pembayaran.</p>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection