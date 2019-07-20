@extends('layouts.app')


@section('style')
<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
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
                <li class="active">
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
<!-- End of Side Bar -->
<main> <!-- Isi dashboard beda-beda tergantung role akun -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Daftar Users</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Users
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
                @include('inc.messages')
            </div>
        </div>
            @if(count($messages)>0)
                <div class="table-responsive">
                        <table id="example" class="table table-bordered" style="width:100%">
                        <thead  class="text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td><a class="btn btn-empty" href="/message/{{$message->id}}">{{$message->name}}</a></td>
                                <td>{{$message->email}}</td>
                                <td>
                                    {{ date('d-m-20y', strtotime($message->created_at)) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
            <div class="card">
                <div class="card-body">
                    Belum ada data user yang tersedia.
                </div>
            </div>
            @endif
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/scripts.single.theme.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({        
            "scrollY": 300,
            "scrollX": true,
            "order": [[ 2, "desc" ]]
        });
    } );
</script>
@endsection