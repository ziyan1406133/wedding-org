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
                <li class="active">
                    <a href="/mypackage">
                        <i class="iconsmind-Box-withFolders"></i> My Package
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
            <div class="col-12">

                <h1>Buat Paket Baru </h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/mypackage">Package</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Create
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')

                <div class="card mt-5">
                    <div class="card-body">
                            {!! Form::model($package, array('route' => array('package.update', $package->id), 'method' => 'PUT', ' enctype' => 'multipart/form-data')) !!}
                            <label class="form-group has-float-label">
                                <input type="text" class="form-control" 
                                name="nama" value="{{$package->nama}}" required>
                                <span>Nama Paket</span>
                            </label>

                            <label class="form-group has-float-label">
                                <input type="text" class="form-control" 
                                    name="price"value="{{$package->price}}"  maxlength="16" required>
                                <span>Harga Paket</span>
                                <small id="price" class="form-text text-muted">Tulis tanpa tanda baca. Contoh: 5000000</small>
                            </label>
                            
                            <label class="form-group has-float-label">
                                <input type="file" class="form-control" id="image" name="image">
                                <span>Cover Image</span>
                            </label>
                            <img src="{{asset('/storage/package/'.$package->image)}}" width="50%">

                            <h5 class="mt-4">Deskripsi</h5>
                            <textarea name="description" id="article-ckeditor" rows="10" c;ass="form-control mb-4" required>
                                {{$package->description}}
                            </textarea>

                            
                            <small class="mt-5" id="price" class="form-text text-muted">Semua kolom harus diisi <small>
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
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection