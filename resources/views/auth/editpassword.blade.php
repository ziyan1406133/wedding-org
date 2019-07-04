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
                        <a href="/package/{{auth()->user()->id}}">
                            <i class="iconsmind-Box-withFolders"></i> My Package
                        </a>
                    </li>
                </ul>
            @endif

            <ul class="list-unstyled" data-link="myaccount">
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
            </ul>
        </div>
    </div>
</div>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Profil {{$user->username}} </h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/user">Users</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/user/{{$user->id}}">{{$user->username}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>

                <div class="card">
                    <div class="card-body">
                        {!! Form::model($user, array('route' => array('password', $user->id), 'method' => 'PUT')) !!}
                            <label class="form-group has-float-label">
                                <input type="password" class="form-control" 
                                    name="oldpassword" value="" required>
                                <span>Password Lama</span>
                            </label>

                            <label class="form-group has-float-label">
                                <input type="password" class="form-control" 
                                    name="password1"value=""  maxlength="16" required>
                                <span>Password Baru</span>
                            </label>
                            <label class="form-group has-float-label">
                                <input type="password" class="form-control" 
                                    name="password2" value="" required>
                                <span>Konfirmasi Password Baru</span>
                            </label>
                            {{Form::submit('Submit', ['class' => 'btn btn-primary btn-md float-right'])}}
                        {!! Form::close() !!}           
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