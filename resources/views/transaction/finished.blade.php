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
                    <a href="#organizer">
                        <i class="iconsmind-Box-Full"></i> Menu WO
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
            <ul class="list-unstyled" data-link="organizer">
                <li class="active">
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

                <h1>Pesanan</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transaction</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cart Item
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
            </div>
        </div>
        @if(count($carts) > 0)
            @foreach($carts as $cart)
                @if($cart->package->user_id == auth()->user()->id)
                    <div class="card d-flex flex-row mb-3">
                        <a class="d-flex" href="/cart/{{$cart->id}}">
                            <img src="{{ asset('/storage/package/'.$cart->package->image)}}" alt="Fat Rascal" class="list-thumbnail responsive border-0" />
                        </a>
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <a href="/cart/{{$cart->id}}" class="w-40 w-sm-100">
                                    <p class="list-item-heading mb-1 truncate">{{$cart->package->nama}}</p>
                                </a>
                                <p class="mb-1 text-muted text-small w-15 w-sm-100">Rp. {{ number_format($cart->package->price + $cart->tambahan,0,",",".") }}</p>
                                <p class="mb-1 text-muted text-small w-15 w-sm-100">{{ date('d-m-20y', strtotime($cart->event_date)) }}</p>
                                <div class="w-15 w-xs-100">
                                    @if($cart->status == 'Event Selesai')
                                        <span class="badge badge-pill badge-success">EVENT SELESAI</span>
                                    @elseif($cart->status == 'Deal')
                                        <span class="badge badge-pill badge-primary">DEAL</span>
                                    @elseif($cart->status == 'Pending')
                                        <span class="badge badge-pill badge-warning">PENDING</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">CANCELED by {{$cart->cancel->role}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            {{$carts->links()}}
        @else
            <p>Belum ada pesanan yang diselesaikan.</p>
        @endif
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection