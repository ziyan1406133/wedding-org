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
                        <li>
                            <a href="/cart">
                                <i class="iconsmind-Full-Cart"></i> Cart
                            </a>
                        </li>
                        <li>
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
                        <li>
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
            <div class="col-12">

                <h1>{{$package->nama}} </h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/package">Package</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/user/{{$package->user['id']}}">{{$package->user['username']}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$package->nama}}
                        </li>
                    </ol>
                </nav>
                @auth
                    @if(auth()->user()->status == 'Belum Terverifikasi')
                        <div class="alert alert-warning alert-dismissible fade show rounded mb-0" role="alert">
                            Akun tidak bisa melakukan transaksi apabila belum diverifikasi oleh admin, 
                            pastikan anda telah <a href="/user/{{auth()->user()->id}}/edit">melengkapi profil</a>,
                            kemudian tunggu selama 24 jam hari kerja.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                    @elseif(auth()->user()->status == 'Ditolak')
                        <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                            Akun anda telah ditolak pada tahap verifikasi oleh admin,
                            silahkan <a href="/user/{{auth()->user()->id}}/edit">perbaiki profil</a> 
                            anda sesuai arahan dari admin yang bisa terlihat pada halaman edit profil.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endauth
                @include('inc.messages')

                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <img src="{{ asset('/storage/package/'.$package->image) }}" alt="Detail Picture" class="card-img-top">

                            <div class="card-body">
                                <p class="text-muted text-small mb-2">Wedding Organizer</p>
                                <p class="mb-3">
                                   <a href="/user/{{$package->user->id}}">{{$package->user->name}}</a>
                                </p>
                                <p class="text-muted text-small mb-2">Alamat WO</p>
                                <p class="mb-3">
                                    {{$package->user->address}}, {{ucwords(strtolower($user->district['name']))}}, {{ucwords(strtolower($user->regency['name']))}}, {{ucwords(strtolower($user->province['name']))}};
                                </p>
                                <p class="text-muted text-small mb-2">Jenis Paket</p>
                                <p class="mb-3">
                                    Paket {{$package->jenis}}
                                </p>
                                <p class="text-muted text-small mb-2">Deskripsi</p>
                                <p class="mb-3">
                                    {!!$package->description!!}
                                </p>
                                <p class="text-muted text-small mb-2">Price</p>
                                <p class="mb-3">Rp. {{ number_format($package->price,0,",",".") }} (Belum termasuk biaya operasional)</p>
                                @auth
                                    @if($package->hidden == FALSE)
                                        @if(auth()->user()->role == 'Customer')
                                            <a class="btn default btn-primary card-img-bottom"  data-toggle="modal" data-target="#bookevent" href="#"><i class="simple-icon-book-open"></i> Book Event</a>
                                            <div class="modal fade" id="bookevent" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        {!! Form::open(['action' => 'CartController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                                        <div class="modal-body">
                                                            <div class="form-group mb-1">
                                                                <label>Tanggal Event</label>
                                                                <div class="input-group date">
                                                                    <input type="date" name="date" id="date" class="form-control" required>
                                                                    <span class="input-group-text input-group-append input-group-addon">
                                                                        <i class="simple-icon-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <label class="mt-5">Alamat Event</label>
                                                                <label class="form-group has-float-label">
                                                                    <select class="form-control select2-single" name="provinces" id="provinces" required>
                                                                        <option value="0" disable="true"></option>
                                                                        @foreach ($provinces as $key => $value)
                                                                            <option value="{{$value->id}}">{{ $value->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span>Provinsi*</span>
                                                                </label>
                                                                <br>
                                                                <label class="form-group has-float-label">
                                                                    <select class="form-control select2-single" name="regencies" id="regencies" required>
                                                                        <option value="0" disable="true"></option>
                                                                    </select>
                                                                    <span>Kabupaten*</span>
                                                                </label>
                                                                <br>
                                                                <label class="form-group has-float-label">
                                                                    <select class="form-control select2-single" name="districts" id="districts" required>
                                                                        <option value="0" disable="true"></option>
                                                                    </select>
                                                                    <span>Kecamatan*</span>
                                                                </label>
                                                                <br>
                                                                <label class="form-group has-float-label">
                                                                    <textarea class="form-control select2-single" name="address" rows="3" required maxlength="190"></textarea>
                                                                    <span>Alamat Lengkap*</span>
                                                            </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="text" name="organizer_id" id="organizer_id" value="{{$package->user->id}}" hidden>
                                                            <input type="text" name="package_id" id="package_id" value="{{$package->id}}" hidden>
                                                            <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary btn-md"><i class="simple-icon-book-open"></i></button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(auth()->user()->id == $user->id)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn default btn-secondary card-img-bottom" href="/package/{{$package->id}}/edit"><i class="simple-icon-pencil"></i></a>
                                            </div>
                                            <div class="col">
                                                <a class="btn default btn-danger card-img-bottom" data-toggle="modal" data-target="#deletpackage{{$package->id}}" href="#"><i class="simple-icon-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deletpackage{{$package->id}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin untuk menghapus paket ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!!Form::open(['action' => ['PackageController@destroy', $package->id], 'method' => 'POST'])!!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                                <button type="button" class="btn  btn-md" data-dismiss="modal">Batal</button>
                                                                {{Form::submit('Ya', ['class' => 'btn btn-danger btn-md'])}}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <p>Paket ini telah dihapus.</p>
                                    @endif
                                @else
                                <p class="text-muted text-small mb-2">
                                    Silahkan <a href="/login">login</a> untuk memesan paket,
                                    atau <a href="/register">buat akun baru</a>.
                                </p>
                                @endauth
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