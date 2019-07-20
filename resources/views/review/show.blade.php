@extends('layouts.app')

@section('style')
<link href="{{ asset('css/dore.light.blue.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/bootstrap-stars.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/select2.min.css') }}" rel="st  ylesheet">
<link href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" rel="stylesheet">
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
                    <li class="active">
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
                    <li class="active">
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
                </li class="active">
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
                        <li class="active">
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
                        <li class="active">
                            <a href="/review">
                                <i class="simple-icon-star"></i> Ulasan
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
            <div class="col">

                <h1>Ulasan Event</h1>
                @auth
                    @if((auth()->user()->id == $cart->user_id) && ($cart->ubah == false))
                        <div class="float-right">
                            <a class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#edit" href="#">Edit</a>
                        </div>
                        <div class="modal fade" id="edit" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                {!! Form::model($cart, array('route' => array('review.update', $cart->id), 'method' => 'PUT')) !!}
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <h5 class="mb-5">Anda hanya bisa mengubah ulasan satu kali.</h5>
                                            <p>Rating</p>
                                            <div class="form-group mb-3">
                                                <select class="rating" name="rate" id="rate" required>
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if($cart->rate == $i)
                                                            <option value="{{$i}}" selected>{{$i}}</option>
                                                        @else
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endif
                                                    @endfor
                                                </select>
                                            </div>
                                            <p class="mb-2">Ulasan</p>
                                        </div>
                                        <textarea class="form-control" name="ulasan" id="ulasan" rows="5" placeholder="Beri ulasan mengenai paket yang dipesan (seperti kesesuaian dengan deskripsi atau kualitas paket)">{{$cart->ulasan}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-md" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                @endauth
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transaction</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/review">Ulasan Saya</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$cart->id}}
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                           <a href="/cart/{{$cart->id}}"> <img src="{{ asset('/storage/package/'.$cart->package->image) }}" alt="Detail Picture" class="card-img-top"></a>
                            <div class="card-body">
                                <div class="text-center">
                                    <p class="mb-5">
                                        <a href="/cart/{{$cart->id}}"><strong>{{$cart->package->nama}}</strong></a>
                                    </p>
                                    @auth
                                        @if($cart->respon == NULL)
                                            @if(auth()->user()->id == $cart->user_id)
                                                <p class="mb-5">Penilaian Dari WO Belum Diberikan.</p>
                                            @elseif(auth()->user()->id == $cart->package->user_id)
                                            {!! Form::model($cart, array('route' => array('review.response', $cart->id), 'method' => 'PUT')) !!}
                                            <label class="form-group has-float-label">
                                                <select class="form-control" name="response" id="response" required>
                                                    <option value="" selected>-- Pilih Salah Satu --</option>
                                                    <option value="Sangat Buruk">Sangat Buruk</option>
                                                    <option value="Buruk">Buruk</option>
                                                    <option value="Cukup">Cukup</option>
                                                    <option value="Memuaskan">Memuaskan</option>
                                                    <option value="Sangat Memuaskan">Sangat Memuaskan</option>
                                                </select>
                                                <span>Bagaimana penilaian anda tentang customer ini?</span>
                                            </label>
                                            <button type="submit" class="btn btn-primary btn-md mb-5">Beri Penilaian</button>
                                            {!! Form::close() !!}
                                            @endif
                                        @else
                                            @if(auth()->user()->id == $cart->user_id)
                                                <p class="mb-5">WO memberikan penilaian "{{$cart->respon}}" kepada anda.</p>
                                            @elseif(auth()->user()->id == $cart->package->user_id)
                                                <p class="mb-5">Anda memberikan penilaian "{{$cart->respon}}" kepada costumer.</p>
                                            @endif
                                        @endif
                                    @endauth
                                    <p class="mb-5">Penilaian dari customer : {{$cart->penilaian}}</p>
                                    <div class="form-group mb-0">
                                        <select class="rating" data-current-rating="{{$cart->rate}}" data-readonly="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <p class="mb-3">Ulasan</p>
                                    <p class="mb-5">{{$cart->ulasan}}</p>
                                </div>
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
<script src="{{ asset('js/vendor/select2.full.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.barrating.min.js') }}"></script>
@endsection