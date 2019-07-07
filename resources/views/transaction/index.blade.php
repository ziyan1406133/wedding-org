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
                    <a href="/upcoming">
                        <i class="simple-icon-calendar"></i> Upcoming Event
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="transactions">
                <li class="active">
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

                <h1>Invoices</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transactions</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Pending
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>
            </div>
        </div>
        @if(count(auth()->user()->transactions) > 0)
            @foreach(auth()->user()->transactions as $transaction)
                <div class="card d-flex flex-row mb-3">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/transaction/{{$transaction->id}}">
                                {{$transaction->invoice}}
                            </a> 
                            <p class="mb-1 text-muted text-small w-15 w-xs-100">created at {{date('d/m/20y', strtotime($transaction->created_at))}}</p>
                            <div class="w-15 w-xs-100">
                                @if($transaction->status == 'Pending')
                                    <span class="badge badge-pill badge-warning">PENDING</span>
                                @elseif($transaction->status == 'Menunggu Pembayaran')
                                    <span class="badge badge-pill badge-secondary">MENUNGGU PEMBAYARAN</span>
                                @elseif($transaction->status == 'Dibatalkan')
                                    <span class="badge badge-pill badge-danger">CANCELED</span>
                                    @elseif($transaction->status == 'Payment Confirmed')
                                        <span class="badge badge-pill badge-success">PAYMENT CONFIRMED</span>
                                @elseif($transaction->status == 'Sudah Dibayar')
                                    <span class="badge badge-pill badge-success">SUDAH DIBAYAR</span>
                                @endif
                            </div>
                        </div>
                        @if(($transaction->status == 'Pending') || ($transaction->status == 'Menunggu Pembayaran'))
                            <div class="float-right align-self-center">
                                <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cancel{{$transaction->id}}" href="#"><i class="simple-icon-action-undo"></i></a>
                                <div class="modal fade" id="cancel{{$transaction->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        {!! Form::model($transaction, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT')) !!}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Konfirmasi</h3>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" value="Dibatalkan" name="status" id="status" hidden>
                                                <p>Apakah anda yakin untuk membatalkan pesanan?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger btn-md">Ya</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="float-right">
                {!! Form::open(['action' => 'TransactionController@store', 'method' => 'POST']) !!}
                        <button type="submit" class="btn btn-primary btn-md"><i class="simple-icon-book-open"></i></button>
                {!! Form::close() !!}
            </div>
        @else
        <div class="card">
            <div class="card-body">
                <p>Belum ada transaksi apapun, silahkan pesan paket di halaman <a href="/package">paket wedding</a>.</p>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection