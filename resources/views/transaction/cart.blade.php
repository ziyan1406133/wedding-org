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
                    <a href="#transactions">
                        <i class="iconsmind-Money-2"></i> Transaksi
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
                    <a href="/finishedevent">
                        <i class="iconsmind-Balloon"></i> Event Selesai
                    </a>
                </li>
                <li>
                    <a href="/upcoming">
                        <i class="simple-icon-calendar"></i> Upcoming Event
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="transactions">
                <li>
                    <a href="/transaction">
                        <i class="iconsmind-Money-Bag"></i> Invoice
                    </a>
                </li>
                <li class="active">
                    <a href="/cart">
                        <i class="iconsmind-Full-Cart"></i> Cart
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

                <h1>Cart</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/package">Package</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cart
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col list">
                <div class="card">
                    <div class="card-body">
                        @if(count($carts) > 0)
                            @foreach($carts as $cart)
                                <div class="card d-flex flex-row mb-3">
                                    <a class="d-flex" href="/package/{{$cart->package->id}}">
                                        <img src="{{ asset('/storage/package/'.$cart->package->image)}}" alt="Fat Rascal" class="list-thumbnail responsive border-0" />
                                    </a>
                                    <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                            <a href="/package/{{$cart->package_id}}" class="w-40 w-sm-100">
                                                <p class="list-item-heading mb-1 truncate">{{$cart->package->nama}}</p>
                                            </a>
                                            <p class="mb-1 text-muted text-small w-15 w-sm-100">Rp. {{ number_format($cart->package->price,0,",",".") }}</p>
                                            <p class="mb-1 text-muted text-small w-15 w-sm-100">{{ date('d-m-y', strtotime($cart->event_date)) }}</p>
                                        </div>
            
                                        <div class="float-right align-self-center">
                                            <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deletecart{{$cart->id}}" href="#"><i class="simple-icon-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deletecart{{$cart->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Konfirmasi</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin untuk menghapus paket ini dari keranjang belanja?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    {!!Form::open(['action' => ['CartController@destroy', $cart->id], 'method' => 'POST'])!!}
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
                            <div class="float-right">
                                {!! Form::open(['action' => 'TransactionController@store', 'method' => 'POST']) !!}
                                        <button type="submit" class="btn btn-primary btn-md"><i class="simple-icon-book-open"></i></button>
                                {!! Form::close() !!}
                            </div>
                        @else
                            <p>Belum ada item apapun di keranjang belanja, silahkan pesan paket di halaman <a href="/package">paket wedding</a>.</p>
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