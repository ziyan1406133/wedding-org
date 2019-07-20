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
                    <a href="/package">
                        <i class="iconsmind-Box-withFolders"></i> Paket Wedding
                    </a>
                    <li>
                        <a href="/upcoming">
                            <i class="simple-icon-calendar"></i> Upcoming Event
                        </a>
                    </li>
                </li>
            </ul>
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
                <li class="active">
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

                <h1>Paket Wedding</h1>
                @if((auth()->user()->role == 'Wedding Organizer') && (auth()->user()->status == 'Terverifikasi'))
                    <div class="float-right">
                        <a class="btn btn-outline-primary btn-lg" href="/package/create">Tambah</a>
                    </div>
                @endif
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Packages
                        </li>
                    </ol>
                </nav>
                @include('inc.messages')
                
                @if(count($packages) > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($packages as $package)
                                <div class="col">
                                    <div class="card mb-3 shadow text-center">
                                        <div class="position-relative">
                                            <a href="/package/{{$package->id}}"><img class="card-img-top" src="{{asset('/storage/package/'.$package->image)}}" alt="Card image cap"></a>
                                        </div>
                                        <div class="card-body">
                                            <a href="/package/{{$package->id}}">
                                                <p class="list-item-heading">{{$package->nama}}</p>
                                                <p class="mb-4">Rp. {{ number_format($package->price,0,",",".") }}</p>
                                            </a>
                                            @if(auth()->user()->id == $package->user_id)
                                            <div class="text-center">
                                                <a class="btn default btn-secondary btn-sm" href="/package/{{$package->id}}/edit"><i class="simple-icon-pencil"></i></a>
                                                <a class="btn default btn-danger btn-sm" data-toggle="modal" data-target="#deletpackage{{$package->id}}" href="#"><i class="simple-icon-trash"></i></a>
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$packages->links()}}
                    </div>
                </div>
                

                @else
                    <div class="card">
                        <div class="card-body">
                            Tidak ada data yang tersedia.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
@endsection