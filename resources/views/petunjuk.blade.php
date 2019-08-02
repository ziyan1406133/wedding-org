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
        <li class="nav-item"><a href="/">LANDING PAGE</a></li>
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
            <li class="nav-item"><a href="/">LANDING PAGE</a></li>
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
            <div class="section home subpage">
                <div class="container">
                    <div class="row home-row">
                        <div class="col-12 col-xl-5 col-lg-12 col-md-12">
                            <div class="home-text">
                                <div class="display-1">
                                    Petunjuk Penggunaan
                                </div>
                                
                                <p class="white mb-5">
                                    Nikmati kenyamanan merencanakan masa depan bersama
                                    Wedding Organizer terpercaya dan kemudahan mobile.
                                    Berikut adalah petunjuk penggunaan aplikasi ini
                                </p>
                                <a class="btn btn-outline-semi-light btn-xl" href="/home">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#content" id="homeCircleButton"><i
                        class="simple-icon-arrow-down"></i></a>
            </div>

            <div class="section">
                <div class="container" id="content">
                    <div class="row screenshots">
                        <div class="col-12 mb-4">
                            <ul class="nav nav-tabs justify-content-center mb-4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#library" role="tab">
                                        <p>Customer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#survey" role="tab">
                                        <p>Wedding Organizer</p>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="library" role="tabpanel">
                                    <div class="col-12 ">
                                        <h2 class="mt-5">Getting Started</h2>
                                        <p>
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <img src="{{asset('storage/misc/no_image.png')}}" alt="" class="app-image mt-5 mb-5">
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                        <br />
            
                                        <div class="mb-5">
                                            <h3>Game Changing Features</h3>
                                            <ol>
                                                <li>
                                                    Preliminary thinking systems
                                                </li>
                                                <li>
                                                    Bandwidth efficient
                                                </li>
                                                <li>
                                                    Green space
                                                </li>
                                                <li>
                                                    Social impact
                                                </li>
                                            </ol>
                                        </div>
            
            
            
                                        <h2>Unprecedented Challenge</h2>
                                        <p>
                                            Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                        <br />
                                        <h2>Thought Partnership</h2>
                                        <p>
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                            <br /> <br />
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social
                                            entrepreneurship.Mass incarceration, preliminary thinking systems thinking vibrant
                                            thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade justify-content-center" id="survey" role="tabpanel">
                                    <div class="col-12 ">
                                        <h2 class="mt-5">Getting Started</h2>
                                        <p>
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                        <br />
            
                                        <div class="mb-5">
                                            <h3>Game Changing Features</h3>
                                            <ol>
                                                <li>
                                                    Preliminary thinking systems
                                                </li>
                                                <li>
                                                    Bandwidth efficient
                                                </li>
                                                <li>
                                                    Green space
                                                </li>
                                                <li>
                                                    Social impact
                                                </li>
                                            </ol>
                                        </div>
            
            
            
                                        <h2>Unprecedented Challenge</h2>
                                        <p>
                                            Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                        <br />
            
                                        <h2>Thought Partnership</h2>
                                        <p>
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social entrepreneurship.
                                            <br />
                                            <br />
                                            Mass incarceration, preliminary thinking systems thinking vibrant thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                            <br /> <br />
                                            Blended value human-centered social innovation resist scale and impact issue
                                            outcomes bandwidth efficient. A; social return on investment, change-makers,
                                            support a, co-create commitment because sustainable. Rubric when vibrant black
                                            lives matter benefit corporation human-centered. Save the world, problem-solvers
                                            support silo mass incarceration. Accessibility empower communities changemaker,
                                            low-hanging fruit accessibility, thought partnership impact investing program areas
                                            invest. Contextualize optimism unprecedented challenge, empower inclusive. Living a
                                            fully ethical life the resistance segmentation social intrapreneurship efficient
                                            inspire external partners. Systems thinking correlation, social impact; when
                                            revolutionary bandwidth. Engaging, revolutionary engaging; empower communities
                                            policymaker shared unit of analysis technology inspiring social
                                            entrepreneurship.Mass incarceration, preliminary thinking systems thinking vibrant
                                            thought
                                            leadership corporate social responsibility. Green space global, policymaker; shared
                                            value disrupt segmentation social capital. Thought partnership, optimism
                                            citizen-centered commitment, relief scale and impact the empower communities
                                            circular. Contextualize boots on the ground; uplift big data, co-creation co-create
                                            segmentation youth inspire. Innovate innovate overcome injustice.
                                        </p>
                                    </div>
                                </div>
                            </div>
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