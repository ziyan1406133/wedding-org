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

                <h1>{{$transaction->invoice}}</h1>
                
                <div class="float-right">

                </div>
                
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transaction</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Invoice
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>
            </div>
        </div>
        @foreach($transaction->carts as $cart)
            <div class="card">
                <div class="card-body">
                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/cart/{{$cart->id}}">
                        {{$cart->package->nama}}
                    </a>
                    @if(($cart->status != 'Dibatalkan') && (($transaction->status == 'Pending') || ($transaction->status == 'Cart')))
                        <div class="float-right align-self-center">
                            <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cancel{{$cart->id}}" href="#"><i class="simple-icon-action-undo"></i></a>
                        </div>
                    @endif
                    <p class="mb-1 text-muted text-small w-15 w-xs-100">{{date('d/m/y', strtotime($cart->event_date))}}</p>
                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Rp. {{ number_format($cart->package->price,0,",",".") }}</p>
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
            @if(($cart->status == 'Dibatalkan') && (($transaction->status == 'Pending') || ($transaction->status == 'Cart')))
            <div class="modal fade" id="cancel{{$cart->id}}" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    {!! Form::model($cart, array('route' => array('cart.update', $cart->id), 'method' => 'PUT')) !!}
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
            @endif
        @endforeach
        @if($transaction->status == 'Menunggu Pembayaran')
            <div class="row">
                <div class="col text-center">
                    <h2 class="mt-5 mb-5">Total : Rp. {{ number_format($total,0,",",".") }}</h2>
                    @if(auth()->user()->role == 'Customer')
                    <a class="btn btn-primary btn-sm mb-5" data-toggle="modal" data-target="#uploadbukti" href="#">Upload Bukti Pembayaran</a>
                    @endif
                </div>
            </div>
            @if(auth()->user()->role == 'Customer')
            <div class="modal fade" id="uploadbukti" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    {!! Form::model($transaction, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
                    <div class="modal-content">
                        <div class="modal-body">
                            <h2 class="mb-5">Bukti Pembayaran</h2>
                            <label class="form-group has-float-label">
                                <select class="form-control" name="bank" id="bank" required>
                                    <option value=""></option>
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank->id}}">{{ $bank->nama }}</option>
                                    @endforeach
                                </select>
                                <span>Bank Pengirim</span>
                            </label>
                            <label class="form-group has-float-label">
                                <input type="text" class="form-control select2-single" 
                                    name="rekening" value="" required>
                                <span>No. Rekening Pengirim</span>
                            </label>
                            <label class="form-group has-float-label">
                                <input type="text" class="form-control select2-single" 
                                    name="atas_nama" value="" required>
                                <span>Atas Nama</span>
                            </label>
                            <label class="form-group has-float-label">
                                <input type="file" class="form-control" id="image" name="image" required>
                                <span>Foto Bukti Transaksi</span>
                            </label>
                            <input type="text" name="status" value="Sudah Dibayar" hidden>
                            <small class="text-muted">semua field harus diisi.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-md"><i class="iconsmind-Mail-Money"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        @elseif($transaction->status == 'Pending')
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <p>Silahkan tunggu sampai tidak ada pesanan pending sebelum melakukan pembayaran.</p>
                </div>
            </div>
        @elseif($transaction->status == 'Sudah Dibayar')
            @if($transaction->alasan != NULL)
            <div class="alert alert-warning default alert-dismissible fade show rounded mb-0" role="alert">
                Bukti pembayaran ditolak dengan alasan {{$transaction->alasan}},
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <h2 class="text-center mt-5 mb-5">Total : Rp. {{ number_format($total,0,",",".") }}</h2>
                    <p class="text-muted text-small mb-2">Rekening Pengirim</p>
                    <p class="mb-3">
                            {{$transaction->rekening}} ({{$transaction->bank->nama}})
                    </p>
                    <p class="text-muted text-small mb-2">Atas Nama</p>
                    <p class="mb-3">
                        {{$transaction->atas_nama}}
                    </p>
                    <p class="text-muted text-small mb-2">Bukti Pembayaran</p>
                    <p class="mb-3">
                        <a class="btn btn-outline-primary btn-sm" 
                            href="{{ asset('/storage/legaldoc/'.$transaction->image) }}" >
                            Lihat</a>
                    </p>
                    @if(auth()->user()->role == 'Admin')
                        <div class="row">
                            <div class="col">
                                <a class="btn default btn-secondary card-img-bottom" data-toggle="modal" data-target="#confirm{{$transaction->id}}" href="#"><i class="iconsmind-Handshake"></i> Confirm</a>
                            </div>
                            <div class="col">
                                <a class="btn default btn-danger card-img-bottom" data-toggle="modal" data-target="#tolak{{$transaction->id}}" href="#"><i class="simple-icon-close"></i> Tolak</a>
                            </div>
                        </div>
                        <div class="modal fade" id="confirm{{$transaction->id}}" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                {!! Form::model($transaction, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT')) !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Konfirmasi</h3>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" value="Payment Confirmed" name="status" id="status" hidden>
                                        <p>Apakah anda yakin untuk menerima bukti pembayaran ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-md">Ya</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="modal fade" id="tolak{{$transaction->id}}" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                {!! Form::model($cart, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT')) !!}
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="mb-5">Alasan Penolakan</h5>
                                        {!! Form::text('status', 'Menunggu Pembayaran', ['hidden' => 'hidden']) !!}
                                        {!! Form::textarea('alasan', '', ['class' => 'form-control', 'rows' => '3', 'required' => 'required']) !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger btn-md">Ya</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @else
                        <p class="mb-5">Tagihan telah dibayar, silahkan tunggu sementara admin mengkonfirmasi pembayaran.</p>
                        {!! Form::model($transaction, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT')) !!}
                            <input type="text" name="status" value="Menunggu Pembayaran" hidden>
                            <button type="submit" class="btn btn-warning default btn-md card-img-bottom">Batalkan Pembayaran</button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        @elseif($transaction->status == 'Payment Confirmed')
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <p>Admin telah mengkonfirmasi pembayaran.</p>
                </div>
            </div>
        @else
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <p>Semua paket di transaksi ini telah dibatalkan.</p>
                </div>
            </div>
        @endauth
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection