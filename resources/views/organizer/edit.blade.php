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
                </ul>

            @elseif(auth()->user()->role == 'Wedding Organizer')
                <ul class="list-unstyled" data-link="organizer">
                    <li>
                        <a href="/pesanandone">
                            <i class="iconsmind-Money-Bag"></i> Pesanan Selesai
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
                @auth
                    @if(auth()->user()->status == 'Ditolak')
                        <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                            Akun anda telah ditolak dengan alasan "{{$user->alasan}}". Silahkan perbaiki dengan form di bawah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endauth
                @include('inc.messages')
                <br>

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                    aria-controls="first" aria-selected="true">AKUN</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">ALAMAT</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">REKENING</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="fourth-tab" data-toggle="tab" href="#fourth" role="tab"
                                    aria-controls="fourth" aria-selected="false">FILES</a>
                            </li>
                        </ul> 
                        {!! Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
                        <div class="tab-content">
                            <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="name" value="{{$user->name}}" required>
                                    <span>Nama Lengkap*</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="username"value="{{$user->username}}"  maxlength="16" required>
                                    <span>Username*</span>
                                </label>
                                <label class="form-group has-float-label">
                                    <input type="email" class="form-control select2-single" 
                                        name="email" value="{{$user->email}}" required>
                                    <span>E-Mail*</span>
                                </label>
                                
                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="mobile_no" value="{{$user->mobile_no}}">
                                    <span>No HP</span>
                                </label>

                                @if(auth()->user()->role == "Admin")
                                    <label class="form-group has-float-label">
                                        {!! Form::select('role', ['Customer' => 'Customer',
                                                        'Wedding Organizer' => 'Wedding Organizer'], 
                                                        $user->role, ['class' => 'form-control select2-single']) !!}
                                        <span>Role*</span>
                                    </label>
                                @endif

                                <label class="form-group has-float-label">
                                    <textarea class="form-control select2-single" name="bio" rows="5" maxlength="1000">{{$user->bio}}</textarea>
                                    <span>Bio</span>
                                </label>

                            </div>
                            
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                                <label class="form-group has-float-label">
                                    <select class="form-control select2-single" name="provinces" id="provinces" required>
                                        <option value="0" disable="true"></option>
                                        @foreach ($provinces as $key => $value)
                                            <option value="{{$value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <span>Provinsi*</span>
                                    <small id="Province" class="form-text text-muted">Provinsi sebelumnya: {{$user->province['name']}}</small>
                                </label>
                                
                                <label class="form-group has-float-label">
                                    <select class="form-control select2-single" name="regencies" id="regencies" required>
                                        <option value="0" disable="true"></option>
                                    </select>
                                    <span>Kabupaten*</span>
                                    <small id="Province" class="form-text text-muted">Kabupaten sebelumnya: {{$user->regency['name']}}</small>
                                </label>
                                
                                <label class="form-group has-float-label">
                                    <select class="form-control select2-single" name="districts" id="districts" required>
                                        <option value="0" disable="true"></option>
                                    </select>
                                    <span>Kecamatan*</span>
                                    <small id="Province" class="form-text text-muted">Kecamatan sebelumnya: {{$user->district['name']}}</small>
                                </label>
                                
                                <label class="form-group has-float-label">
                                    <textarea class="form-control select2-single" name="address" rows="3" required maxlength="190">{{$user->address}}</textarea>
                                    <span>Alamat Lengkap*</span>
                                </label>
                            </div>

                            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">

                                <label class="form-group has-float-label">
                                    <select class="form-control select2-single" name="bank" id="bank" required>
                                        <option value=""></option>
                                        @foreach ($banks as $bank)
                                            @if($bank->id == $user->bank_id)
                                                <option value="{{$bank->id}}" selected>{{ $bank->nama }}</option>
                                            @else 
                                                <option value="{{$bank->id}}">{{ $bank->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span>Bank*</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="rekening" value="{{$user->rekening}}"  maxlength="16" required>
                                    <span>Nomor Reknening*</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="atas_nama" value="{{$user->atas_nama}}" required>
                                    <span>Atas Nama*</span>
                                </label>

                            </div>

                            <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
                                <label class="form-group has-float-label">
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                    <span>Avatar</span>
                                </label>
                                <img src="{{asset('/storage/avatar/'.$user->avatar)}}" class="mb-5" width="50%" alt="">
                                <label class="form-group has-float-label">
                                    @if($user->legal_doc == 'no_image.png')
                                    <input type="file" class="form-control" id="legal_doc" name="legal_doc" required>
                                    @else
                                    <input type="file" class="form-control" id="legal_doc" name="legal_doc">
                                    @endif
                                    <span>CV / SIUP / NPWP* (Gambar Atau PDF)</span>
                                </label>
                                @if($user->legal_doc != 'no_image.png')
                                <a class="btn btn-info btn-lg"  href="{{ asset('/storage/legaldoc/'.$user->legal_doc) }}"><i class="iconsmind-File"></i> Lihat File</a>
                                @endif
                            </div>
                        </div>
                            <small>*) harus diisi.</small>
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