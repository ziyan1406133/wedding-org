@extends('layouts.app')

@section('style')
<link href="{{ asset('css/dore.light.blue.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" rel="stylesheet">
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
                        <li class="active">
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

                <h1>Pesanan Paket</h1>
                
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/transaction">Transaction</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cart
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                <br>

                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <img src="{{ asset('/storage/package/'.$cart->package->image) }}" alt="Detail Picture" class="card-img-top">

                            <div class="card-body">
                                <p class="text-muted text-small mb-2">Nama Paket</p>
                                <p class="mb-3">
                                    <a href="/package/{{$cart->package->id}}">{{$cart->package->nama}}</a>
                                </p>
                                <p class="text-muted text-small mb-2">Wedding Organizer</p>
                                <p class="mb-3">
                                    <a href="/user/{{$cart->package->user->id}}">{{$cart->package->user->name}}</a>
                                </p>
                                <p class="text-muted text-small mb-2">Alamat Wedding Organizer</p>
                                <p class="mb-3">
                                    {{$cart->package->user->address}}, {{ucwords(strtolower($cart->package->user->district['name']))}}, {{ucwords(strtolower($cart->package->user->regency['name']))}}, {{ucwords(strtolower($cart->package->user->province['name']))}};
                                </p>
                                <p class="text-muted text-small mb-2">Customer</p>
                                <p class="mb-3">
                                    <a href="/user/{{$cart->user->id}}">{{$cart->user->name}}</a>
                                </p>
                                <p class="text-muted text-small mb-2">Alamat Event</p>
                                <p class="mb-3">
                                    {{$cart->address}}, {{ucwords(strtolower($cart->district['name']))}}, {{$cart->regency['name']}}, {{$cart->province['name']}};
                                </p>
                                <p class="text-muted text-small mb-2">Tanggal Event</p>
                                <p class="mb-3">
                                    {{ date('d-m-20y', strtotime($cart->event_date)) }}
                                </p>
                                <p class="text-muted text-small mb-2">Price</p>
                                <p class="mb-3">Rp. {{ number_format($cart->package->price,0,",",".") }}</p>
                                @if($cart->status == 'Pending')
                                    @if(auth()->user()->id == $cart->user->id)
                                        <a class="btn default btn-danger card-img-bottom" data-toggle="modal" data-target="#cancel{{$cart->id}}" href="#">Batal</a>
                                    @elseif(auth()->user()->id == $cart->package->user_id)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn default btn-secondary card-img-bottom" data-toggle="modal" data-target="#deal{{$cart->id}}" href="#"><i class="iconsmind-Handshake"></i> Deal</a>
                                            </div>
                                            <div class="col">
                                                <a class="btn default btn-danger card-img-bottom" data-toggle="modal" data-target="#cancel{{$cart->id}}" href="#"><i class="simple-icon-close"></i> No Deal</a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deal{{$cart->id}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                {!! Form::model($cart, array('route' => array('cart.update', $cart->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3>Konfirmasi</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" value="Deal" name="status" id="status" hidden>
                                                        <p>Apakah anda yakin untuk menerima pesanan ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary btn-md">Ya</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="modal fade" id="cancel{{$cart->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            {!! Form::model($cart, array('route' => array('cart.update', $cart->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
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
                                @elseif($cart->status == 'Dibatalkan')
                                    <p>Pesanan paket ini telah dibatalkan oleh {{$cart->cancel->role}}</p>
                                @elseif($cart->status == 'Event Selesai')
                                    <p>Event telah selesai dilaksanakan.</p>
                                @elseif($cart->status == 'Deal')
                                    @if(auth()->user()->role == 'Customer')
                                        <p>Pesanan paket ini telah disetujui, silahkan upload bukti pembayaran apabila semua paket di <a href="/transaction/{{$cart->transaction_id}}">transaksi ini</a> telah disetujui.</p>
                                        @if($cart->package->status == 'Payment Confirmed')
                                        <a class="btn default btn-success card-img-bottom" data-toggle="modal" data-target="#selesai{{$cart->id}}" href="#"> Event Selesai</a>
                                        <div class="modal fade" id="selesai{{$cart->id}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                {!! Form::model($cart, array('route' => array('cart.update', $cart->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3>Konfirmasi</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" value="Event Selesai" name="status" id="status" hidden>
                                                        <p>Klik "Selesaikan" apabila event ini telah selesai dilaksanakan.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success btn-md">Selesaikan</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        @endif
                                    @elseif(auth()->user()->role == 'Wedding Organizer')
                                        <p>Pesanan berhasil diterima, admin akan memberi tahu lewat email atau SMS apabila pembayaran telah dikonfirmasi. Pastikan rekening dan kontak di profil anda bisa digunakan.</p>
                                    @else
                                        <p>Paket ini telah disetujui oleh Wedding Organizer. <a href="/transaction/{{$cart->transaction_id}}">Lihat transaksi</a>.</p>
                                    @endif
                                @endif
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
<script type="text/javascript">

    $('#provinces').on('change', function(e){
        console.log(e);
        var province_id = e.target.value;
        $.get('/json-regencies?province_id=' + province_id,function(data) {
            console.log(data);
            $('#regencies').empty();
            $('#regencies').append('<option value="0" disable="true" selected="true"></option>');

            $('#districts').empty();
            $('#districts').append('<option value="0" disable="true" selected="true"></option>');

            $.each(data, function(index, regenciesObj){
                $('#regencies').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.name +'</option>');
            })
        });
    });

    $('#regencies').on('change', function(e){
        console.log(e);
        var regencies_id = e.target.value;
        $.get('/json-districts?regencies_id=' + regencies_id,function(data) {
            console.log(data);
            $('#districts').empty();
            $('#districts').append('<option value="0" disable="true" selected="true"></option>');

            $.each(data, function(index, districtsObj){
            $('#districts').append('<option value="'+ districtsObj.id +'">'+ districtsObj.name +'</option>');
            })
        });
    });
</script>
@endsection