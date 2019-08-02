
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

        </div>


        <a class="navbar-logo" href="/">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">

            <div class="header-icons d-inline-block align-middle">

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

                @auth
                <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        @if(auth()->user()->role != 'Admin')
                            @if((auth()->user()->role == 'Customer') && ((count(auth()->user()->hmin2_customer) > 0) || (count(auth()->user()->hmin5) > 0)))
                                <span class="count">{{count(auth()->user()->hmin2_customer) + count(auth()->user()->hmin5)}}</span>
                            @elseif((auth()->user()->role == 'Wedding Organizer') && ((count(auth()->user()->hmin2_organizer) > 0) || (count(auth()->user()->nav_done) > 0)))
                                <span class="count">{{count(auth()->user()->hmin2_organizer) + count(auth()->user()->nav_done)}}</span>
                            @endif
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 scroll position-absolute" id="notificationDropdown">
                        @if(auth()->user()->role == 'Wedding Organizer')
                            @if((count(auth()->user()->nav_done) > 0) || (count(auth()->user()->hmin2_organizer) > 0))
                                @if(count(auth()->user()->nav_done) > 0)
                                <p>Event Selesai.</p>
                                    @foreach(auth()->user()->nav_done as $event)    
                                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                            <a href="/review/{{$event->id}}">
                                                <img src="{{asset('storage/package/'.$event->package->image)}}" alt="Notification Image" style="width: 50px" />
                                            </a>
                                            <div class="pl-3 pr-2">
                                                <a href="/review/1">
                                                    <p class="font-weight-medium mb-1">{{$event->package->nama}}</p>
                                                    <p class="text-muted mb-0 text-small">{{$event->event_date}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="separator"></div>
                                @endif
                                @if(count(auth()->user()->hmin2_organizer) > 0)
                                    <div class="d-flex flex-row mt-3 mb-3 pb-3 border-bottom">
                                        <a href="/upcoming">
                                            <img src="{{asset('storage/misc/wedding.jpg')}}" alt="Notification Image" style="width: 50px"/>
                                        </a>
                                        <div class="pl-3 pr-2">
                                            <a href="/upcoming">
                                                <p class="font-weight-medium mb-1">Anda memiliki {{count(auth()->user()->hmin2_organizer)}} event yang akan berlangsung kurang dari dua hari lagi.</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p>Tidak ada notifikasi.</p>
                            @endif
                        @elseif(auth()->user()->role == 'Admin')
                            @if(count($nav_admins) > 0)
                                @foreach($nav_admins as $finishedevent)    
                                    <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                        <a href="/cart/{{$finishedevent->id}}">
                                            <img src="{{asset('storage/package/'.$finishedevent->package->image)}}" alt="Notification Image" style="width: 50px" />
                                        </a>
                                        <div class="pl-3 pr-2">
                                            <a href="/cart/{{$finishedevent->id}}">
                                                <p class="font-weight-medium mb-1">{{$finishedevent->package->nama}}</p>
                                                <p class="text-muted mb-0 text-small">{{$finishedevent->event_date}}</p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada notifikasi.</p>
                            @endif
                        @elseif(auth()->user()->role == 'Customer')
                            @if((count(auth()->user()->hmin2_customer) > 0) || (count(auth()->user()->hmin5) > 0))
                                @if(count(auth()->user()->hmin2_customer) > 0)
                                    <div class="d-flex flex-row mt-3 mb-3 pb-3 border-bottom">
                                        <a href="/transaction">
                                            <img src="{{asset('storage/misc/wedding.jpg')}}" alt="Notification Image" style="width: 50px"/>
                                        </a>
                                        <div class="pl-3 pr-2">
                                            <a href="/transaction">
                                                <p class="font-weight-medium mb-1">Anda memiliki {{count(auth()->user()->hmin2_customer)}} event yang akan berlangsung kurang dari dua hari lagi.</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @if(count(auth()->user()->hmin5) > 0)
                                    <div class="d-flex flex-row mt-3 mb-3 pb-3 border-bottom">
                                        <a href="/transaction">
                                            <img src="{{asset('storage/misc/transaction.jpg')}}" alt="Notification Image" style="width: 50px"/>
                                        </a>
                                        <div class="pl-3 pr-2">
                                            <a href="/transaction">
                                                <p class="font-weight-medium mb-1">Anda memiliki {{count(auth()->user()->hmin5)}} pesanan yang memasuki masa H-5, harap segera lunasi.</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <p>Tidak ada notifikasi.</p>
                            @endif
                        @elseif(auth()->user()->role == 'Wedding Organizer')
                        @endif
                    </div>
                </div>
            </div>
            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{auth()->user()->username}}</span>
                    <span>
                        <img alt="Profile Picture" src="{{asset('/storage/avatar/'.auth()->user()->avatar)}}" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="/home">Dashboard</a>
                    <a class="dropdown-item" href="/user/{{auth()->user()->id}}">My Profile</a>
                    @if((auth()->user()->role == 'Wedding Organizer') && (auth()->user()->status == 'Terverifikasi'))
                    <a class="dropdown-item" href="/package">My Packages</a> <!-- Khusus Organizer -->
                    @elseif((auth()->user()->role == 'Customer') && (auth()->user()->status == 'Terverifikasi'))
                        <a class="dropdown-item" href="/cart">Cart</a> <!-- Khusus Costumer -->
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
            @else
            <div class="header-icon btn btn-empty d-none d-sm-inline-block user">
                <a class="btn btn-empty" href="/login"> Sign In
                </a>
                <a class="btn btn-outline-primary" href="/register"> Sign Up
                </a>
            </div>
            @endauth
        </div>
    </nav>