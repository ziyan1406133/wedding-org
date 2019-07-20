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
                    <a href="#admin">
                        <i class="iconsmind-Administrator"></i> Menu Admin
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
            </ul>

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
                <li class="active">
                    <a href="/konfirmasibayar">
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

                <h1>Info Aplikasi</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Setting
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                    aria-controls="first" aria-selected="true">UMUM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">REKENING</a>
                            </li>
                        </ul> 
                        {!! Form::model($setting, array('route' => array('setting.update', $setting->id), 'method' => 'PUT')) !!}
                        <div class="tab-content">
                            <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="address" value="{{$setting->address}}" required>
                                    <span>Alamat</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="email" class="form-control select2-single" 
                                        name="email" value="{{$setting->email}}" required>
                                    <span>E-Mail*</span>
                                </label>
                                
                                <label class="form-group has-float-label" required>
                                    <input type="text" class="form-control select2-single" 
                                        name="phone" value="{{$setting->phone}}">
                                    <span>No Telepon</span>
                                </label>

                            </div>
                            
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                                <label class="form-group has-float-label">
                                    <select class="form-control select2-single" name="bank" id="bank" required>
                                        <option value=""></option>
                                        @foreach ($banks as $bank)
                                            @if($bank->id == $setting->bank_id)
                                                <option value="{{$bank->id}}" selected>{{ $bank->nama }}</option>
                                            @else 
                                                <option value="{{$bank->id}}">{{ $bank->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span>Bank</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="rekening" value="{{$setting->rekening}}"  maxlength="16" required>
                                    <span>Nomor Reknening</span>
                                </label>

                                <label class="form-group has-float-label">
                                    <input type="text" class="form-control select2-single" 
                                        name="atas_nama" value="{{$setting->atas_nama}}" required>
                                    <span>Atas Nama</span>
                                </label>
                            </div>
                            <small class="mt-5">Semua kolom harus diisi.</small>
                        </div>
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