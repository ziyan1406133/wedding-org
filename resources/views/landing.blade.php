@extends('layouts.app')


@section('style')
<link href="{{ asset('css/vendor/video-js.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="landing-page">
    <div class="mobile-menu">
        <a href="#home" class="logo-mobile scrollTo">
            <span></span>
        </a>
        <ul class="navbar-nav">
        <li class="nav-item"><a href="#package" class="scrollTo">PAKET WEDDING</a></li>
        <li class="nav-item"><a href="#contact" class="scrollTo">KONTAK KAMI</a></li>
        <li class="nav-item">
            <div class="separator"></div>
        </li>
        @guest
            <li class="nav-item mt-2"><a href="/login">SIGN IN</a></li>
            <li class="nav-item"><a href="/register">SIGN UP</a></li>
        @else
            <li class="nav-item mt-2"><a href="/home">DASHBOARD</a></li>
            <li class="nav-item"><a  href="/user/{{auth()->user()->id}}">MY PROFILE</a></li>
            @if(auth()->user()->role == 'Wedding Organizer')
            <li class="nav-item"><a href="/mypackage">MY PACKAGES</a></li>
            @elseif(auth()->user()->role == 'Customer')
            <li class="nav-item"> <a href="/cart">CART</a></li>
            @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        SIGN OUT
                </a>
            </li>
        @endguest
        </ul>
    </div>

    <div class="main-container">
        <nav class="landing-page-nav">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-logo pull-left scrollTo" href="#home">
                <span class="white"></span>
                <span class="dark"></span>
            </a>
            <ul class="navbar-nav d-none d-lg-flex flex-row">
            <li class="nav-item"><a href="#package" class="scrollTo">PAKET WEDDING</a></li>
            <li class="nav-item"><a href="#contact" class="scrollTo">KONTAK KAMI</a></li>
            @guest
            <li class="nav-item mr-3"><a href="/login">SIGN IN</a></li>
            <li class="nav-item pl-2">
                <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" href="/register">SIGN UP</a>
            </li>
            @else
            <li class="nav-item pl-2">
                <a class="btn btn-outline-semi-light btn-sm pr-4 pl-4" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{auth()->user()->username}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="/home">Dashboard</a>
                    <a class="dropdown-item" href="/user/{{auth()->user()->id}}">My Profile</a>
                    @if(auth()->user()->role == 'Wedding Organizer')
                        <a class="dropdown-item" href="/mypackage">My Packages</a> <!-- Khusus Organizer -->
                    @elseif(auth()->user()->role == 'Customer')
                        <a class="dropdown-item" href="cart">Cart</a> <!-- Khusus Costumer -->
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
            </ul>
            <a href="#" class="mobile-menu-button">
            <i class="simple-icon-menu"></i>
            </a>
        </div>
        </nav>

        <div class="content-container" id="home">
            <div class="section home">
                <div class="container">
                    <div class="row home-row">
                        <div class="col-12 d-block d-md-none">
                        <a href="#">
                            <img alt="mobile hero" class="mobile-hero" src="/img/landing-page/home-hero-mobile.png" />
                        </a>
                        </div>

                        <div class="col-12 col-xl-4 col-lg-5 col-md-6">
                        <div class="home-text">
                            <div class="display-1">WEDDING <br />ORGANIZER</div>
                            <p class="white mb-5">
                            Rencanakan acara besar pernikahan anda dengan baik, 
                            dibantu oleh Wedding Organizer profesional kami. <br />
                            <br />
                            Pilih paket yang sesuai dengan kebutuhan anda. <br />
                            <br />
                            Selamat Menikmati
                            </p>
                            <a class="btn btn-outline-semi-light btn-xl" href="/home">See More</a>
                        </div>
                        </div>
                        <div class="col-12 col-xl-7 offset-xl-1 col-lg-7 col-md-6  d-none d-md-block">
                        <a href="#">
                            <img alt="hero" src="/img/landing-page/home-hero.png" />
                        </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 p-0">
                        <div class="owl-container">
                            <div class="owl-carousel home-carousel">
                            <div class="card">
                                <div class="card-body text-center">
                                <div>
                                    <i class="simple-icon-emotsmile large-icon"></i>
                                    <h5 class="mb-0 font-weight-semibold">
                                    WO Terpercaya
                                    </h5>
                                </div>
                                <div>
                                    <p class="detail-text">
                                        Kami hanya bekerja sama dengan Wedding Organizer
                                        yang terpercaya dan melewati seleksi terlebih dahulu
                                    </p>
                                </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body text-center">
                                <div>
                                    <i class="simple-icon-cup large-icon"></i>
                                    <h5 class="mb-0 font-weight-semibold">
                                    Mobile
                                    </h5>
                                </div>
                                <div>
                                    <p class="detail-text">
                                        Aplikasi bisa dibuka kapan dan dimana saja lewat aplikasi
                                        mobile, memudahkan penggunaan anda.
                                    </p>
                                </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body text-center">
                                <div>
                                    <i class="simple-icon-magic-wand large-icon"></i>
                                    <h5 class="mb-0 font-weight-semibold">
                                    Mudah Digunakan
                                    </h5>
                                </div>
                                <div>
                                    <p class="detail-text">
                                        Aplikasi sangat mudah digunakan dengan Interface yang User Friendly
                                    </p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#package" id="homeCircleButton"><i
                    class="simple-icon-arrow-down"></i></a>
            </div>


            <div class="section mb-0">
                <div class="container" id="package">
                    <div class="row">
                        <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center">
                        <h1>Paket Wedding</h1>
                        <p>
                            Berikut adalah paket event wedding yang mungkin
                            akan membuat anda tertarik. 
                            <!-- dipilih random -->
                        </p>
                        </div>
                    </div>

                    <div class="row mt-5">
                        @if(count($packages) > 0 )
                        @foreach($packages as $package)
                        <div class="col-12 col-lg-6 mb-4">
                            <div class="card flex-row mb-5 listing-card-container">
                                <div class="w-40 position-relative">
                                <a href="LandingPage.Blog.Image.html">
                                    <img class="card-img-left" src="{{asset('/storage/package/'.$package->image)}}" alt="Card image cap">
                                </a>
                                </div>
                                <div class="w-60 d-flex align-items-center">
                                <div class="card-body">
                                    <a href="/package/{{$package->id}}">
                                        <h3 class="mb-4 listing-heading ellipsis">{{$package->nama}}</h3>
                                    </a>
                                    <p class="listing-desc ellipsis">
                                            Rp. {{ number_format($package->price,0,",",".") }}
                                    </p>
                                    <footer>
                                    <p class="text-small mb-0">by {{$package->user->name}}</p>
                                    </footer>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="col-12 col-lg-6 mb-4">
                                <div class="card flex-row mb-5 listing-card-container">
                                    <div class="w-40 position-relative">
                                    <a href="LandingPage.Blog.Image.html">
                                        <img class="card-img-left" src="{{asset('/storage/package/no_image.png')}}" alt="Card image cap">
                                    </a>
                                    </div>
                                    <div class="w-60 d-flex align-items-center">
                                    <div class="card-body">
                                        <a href="/">
                                            <h3 class="mb-4 listing-heading ellipsis">NULL</h3>
                                        </a>
                                        <p class="listing-desc ellipsis">
                                                Belum ada paket yang dibuat.
                                        </p>
                                        <footer>
                                        <p class="text-small mb-0">NULL</p>
                                        </footer>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        <a href="/package" class="btn btn-primary btn-lg mb-1">Lihat Lebih Banyak</a>
                    </div>
                </div>
            </div>

            <div class="section background background-no-bottom mb-0">
                <div class="container" id="contact">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <h2>Contact Form</h2>
                            @include('inc.messages')
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::open(['action' => 'MessageController@store', 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            <input type="text" placeholder="Nama" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" placeholder="E-Mail" name="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="pesan" class="form-control" cols="auto" rows="5" placeholder="Pesan Lengkap"></textarea>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-primary btn-md" type="submit">Send</button>
                                        </div>
                                    {!! Form::close() !!}           
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 offset-lg-1 side-bar">
                            <h2>Contact Info</h2>

                            <p class="text-primary mb-2">Address</p>
                            <p class="mb-5">{{$setting->address}}

                            <p class="text-primary mb-2">Phone</p>
                            <p class="mb-5">{{$setting->phone}}</p>

                            <p class="text-primary mb-2">E-mail</p>
                            <p class="mb-0">{{$setting->email}}</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="section footer mb-0">
                <div class="container">
                    <div class="row footer-row">
                        <div class="col-12 text-right">
                        <a class="btn btn-circle btn-outline-semi-light footer-circle-button scrollTo" href="#home" id="footerCircleButton"><i
                            class="simple-icon-arrow-up"></i></a>
                        </div>
                        <div class="col-12 text-center footer-content">
                            <a href="#home" class="scrollTo">
                                <img class="footer-logo" alt="footer logo" src="/img/landing-page/logo-footer.svg" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="separator mt-5"></div>
                <div class="container copyright pt-5 pb-5">
                <div class="row">
                    <div class="col-12"></div>
                    <div class="col-6">
                    <p class="mb-0">2019 © Sekolah Tinggi Teknologi Garut</p>
                    </div>
                    <div class="col-6 text-right social-icons">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                        <a href="https://dore-jquery-docs.coloredstrategies.com/">Theme 'Dore' by ColoredStrategies</a>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/vendor/landing-page/headroom.min.js')}}"></script>
<script src="{{ asset('js/vendor/landing-page/jQuery.headroom.js')}}"></script>
<script src="{{ asset('js/vendor/landing-page/jquery.scrollTo.min.js')}}"></script>
<script src="{{ asset('js/vendor/landing-page/jquery.autoellipsis.js')}}"></script>
<script src="{{ asset('js/dore.scripts.landingpage.js')}}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>  
@endsection