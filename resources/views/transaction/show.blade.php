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
                <li class="active">
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
            <div class="col">

                <h1>{{$transaction->invoice}}</h1>
                
                <div class="float-right">
                    <a class="btn btn-secondary" href="/pdf/{{$transaction->id}}"><i class="simple-icon-printer"></i></a>
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
            <div class="card d-flex flex-row mb-3">
                <div class="d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                        <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/cart/{{$cart->id}}">
                            {{$cart->package->nama}}
                        </a>
                        <p class="mb-1 text-muted text-small w-15 w-xs-100">{{date('d/m/20y', strtotime($cart->event_date))}}</p>
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
                    @if(($cart->status != 'Dibatalkan') && (($transaction->status == 'Pending') || ($transaction->status == 'Cart')))
                        <div class="align-self-cente align-items-md-centerr">
                            <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cancel{{$cart->id}}" href="#"><i class="simple-icon-action-undo"></i></a>
                        </div>
                    @endif
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
                    <div class="card mt-5 mb-5">
                        <div class="card-body">
                            @if(($transaction->alasan != NULL) && (auth()->user()->role == 'Customer'))
                            <div class="alert alert-danger default alert-dismissible fade show rounded mt-2" role="alert">
                                Bukti pembayaran ditolak dengan alasan "{{$transaction->alasan}}"
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <h2 class="">Total : Rp. {{ number_format($total,0,",",".") }}</h2>
                            <hr>
                            @if(auth()->user()->role == 'Customer')
                            <h5 class="mb-5">Silahkan bayar ke rekening berikut :</h5>
                            <h5 class="mb-5">{{$setting->rekening}} ({{$setting->bank->nama}})</h5>
                            <h5 class="mb-2">Atas nama :</h5>
                            <h5 class="mb-5">{{$setting->atas_nama}}</h5>
                            <a class="btn btn-primary default card-img-bottom" data-toggle="modal" data-target="#uploadbukti" href="#">Upload Bukti Pembayaran</a>
                            @else
                            <h5>Silahkan tunggu sementara customer membayar dan mengupload bukti pembayaran.</h5>
                            @endif
                        </div>
                    </div>
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
            <div class="card mt-3 mb-5">
                <div class="card-body">
                    <h2 class="text-center mt-5 mb-5">Total : Rp. {{ number_format($total,0,",",".") }}</h2>
                    @if(auth()->user()->role != 'Wedding Organizer')
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
                    @endif
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
                                        {!! Form::open(['action' => 'TransactionController@confirm', 'method' => 'POST']) !!}
                                                <input type="text" value="{{$transaction->id}}" name="id" id="id" hidden>  
                                                <input type="text" value="Payment Confirmed" name="status" id="status" hidden>
                                                <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                {{Form::submit('Ya', ['class' => 'btn btn-primary btn-md'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="modal fade" id="tolak{{$transaction->id}}" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                {!! Form::open(['action' => 'TransactionController@confirm', 'method' => 'POST']) !!}
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="mb-5">Alasan Penolakan</h5>
                                        {!! Form::text('id', $transaction->id, ['hidden' => 'hidden']) !!}
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
                        @if(auth()->user()->role == 'Customer')
                        {!! Form::model($transaction, array('route' => array('transaction.update', $transaction->id), 'method' => 'PUT')) !!}
                            <input type="text" name="status" value="Menunggu Pembayaran" hidden>
                            <button type="submit" class="btn btn-warning default btn-md card-img-bottom">Batalkan Pembayaran</button>
                        {!! Form::close() !!}
                        @endif
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