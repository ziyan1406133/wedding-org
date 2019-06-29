@extends('layouts.app')


@section('style')
<link rel="stylesheet" href="{{ asset('css/vendor/jquery.contextMenu.min.css') }}" />
@endsection

@section('content')
@include('inc.navbar')
@include('inc.sidebar')
<main> <!-- Isi dashboard beda-beda tergantung role akun -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Dashboard Ecommerce</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


            </div>
            <div class="col-lg-12 col-xl-6">

                <div class="icon-cards-row">
                    <div class="owl-container">
                        <div class="owl-carousel dashboard-numbers">
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsmind-Alarm"></i>
                                    <p class="card-text mb-0">Pending Orders</p>
                                    <p class="lead text-center">16</p>
                                </div>
                            </a>
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsmind-Basket-Coins"></i>
                                    <p class="card-text mb-0">Completed Orders</p>
                                    <p class="lead text-center">32</p>
                                </div>
                            </a>

                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsmind-Arrow-Refresh"></i>
                                    <p class="card-text mb-0">Refund Requests</p>
                                    <p class="lead text-center">2</p>
                                </div>
                            </a>

                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsmind-Mail-Read"></i>
                                    <p class="card-text mb-0">New Comments</p>
                                    <p class="lead text-center">25</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="position-absolute card-top-buttons">

                                <button class="btn btn-header-light icon-button" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="simple-icon-refresh"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right mt-3">
                                    <a class="dropdown-item" href="#">Sales</a>
                                    <a class="dropdown-item" href="#">Orders</a>
                                    <a class="dropdown-item" href="#">Refunds</a>
                                </div>

                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sales</h5>
                                <div class="dashboard-line-chart">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button">
                            <i class="simple-icon-refresh"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent Orders</h5>
                        <div class="scroll dashboard-list-with-thumbs">
                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/marble-cake-thumb.jpg" alt="Marble Cake" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-2 position-absolute badge-top-right">NEW</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Marble Cake</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Latashia Nagy - 100-148 Warwick
                                                Trfy, Kansas City, USA</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/fruitcake-thumb.jpg" alt="Fruitcake" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-2 position-absolute badge-top-right">NEW</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Fruitcake</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Marty Otte - 166-156 Rue de
                                                Varennes, Gatineau, QC J8T 8G4, Canada</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/chocolate-cake-thumb.jpg" alt="Chocolate Cake" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-1 position-absolute badge-top-right">PROCESS</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Chocolate Cake</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Linn Ronning - Rasen 2-14, 98547
                                                Kühndorf, Germany</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/fat-rascal-thumb.jpg" alt="Fat Rascal" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-3 position-absolute badge-top-right">DONE</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Fat Rascal</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Rasheeda Vaquera - 37 Rue des
                                                Grands Prés, 03100 Montluçon, France</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/streuselkuchen-thumb.jpg" alt="Streuselkuchen" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-3 position-absolute badge-top-right">DONE</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Streuselkuchen</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Mimi Carreira - 36-71 Victoria
                                                St, Birmingham, UK</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3">
                                <a class="d-block position-relative" href="#">
                                    <img src="img/cremeschnitte-thumb.jpg" alt="Cremeschnitte" class="list-thumbnail border-0" />
                                    <span class="badge badge-pill badge-theme-3 position-absolute badge-top-right">DONE</span>
                                </a>
                                <div class="pl-3 pt-2 pr-2 pb-2">
                                    <a href="#">
                                        <p class="list-item-heading">Cremeschnitte</p>
                                        <div class="pr-4 d-none d-sm-block">
                                            <p class="text-muted mb-1 text-small">Lenna Majeed - 6 Hertford St
                                                Mayfair, London, UK</p>
                                        </div>
                                        <div class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Product Categories</h5>
                        <div class="dashboard-donut-chart">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card dashboard-link-list">
                    <div class="card-body">
                        <h5 class="card-title">Cakes</h5>
                        <div class="d-flex flex-row">
                            <div class="w-50">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1">
                                        <a href="#">Marble Cake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Fruitcake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Chocolate Cake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Fat Rascal</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Financier</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Genoise</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Gingerbread</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Goose Breast</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Parkin</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Petit Gâteau</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Salzburger Nockerl</a>
                                    </li>
                                    <li>
                                        <a href="#">Soufflé</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="w-50">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1">
                                        <a href="#">Streuselkuchen</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Tea Loaf</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Napoleonshat</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Merveilleux</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Magdalena</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Cremeschnitte</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Cheesecake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Bebinca</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Fruitcake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Chocolate Cake</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Fat Rascal</a>
                                    </li>
                                    <li class="mb-1">
                                        <a href="#">Financier</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tickets</h5>

                        <div class="scroll dashboard-list-with-user">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Mayra Sibley</p>
                                        <p class="text-muted mb-0 text-small">09.08.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-7.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Mimi Carreira</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 10:20</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-6.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Philip Nelms</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 09:12</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-3.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Terese Threadgill</p>
                                        <p class="text-muted mb-0 text-small">01.08.2018 - 18:20</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-5.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Kathryn Mengel</p>
                                        <p class="text-muted mb-0 text-small">27.07.2018 - 11:45</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-4.jpg" alt="Profile Picture" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 " data-line="1">Esperanza Lodge</p>
                                        <p class="text-muted mb-0 text-small">24.07.2018 - 15:00</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Calendar</h5>
                        <div class="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Best Sellers</h5>
                        <table class="data-table responsive nowrap" data-order="[[ 1, &quot;desc&quot; ]]">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sales</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Marble Cake</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">1452</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">62</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cupcakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Fruitcake</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">1245</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">65</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Desserts</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Chocolate Cake</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">1200</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">45</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Desserts</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Bebinca</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">1150</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">4</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cupcakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Napoleonshat</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">1050</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">41</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Magdalena</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">998</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">24</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Salzburger Nockerl</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">924</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">20</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Desserts</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Soufflé</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">905</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">64</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cupcakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Cremeschnitte</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">845</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">12</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Desserts</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Cheesecake</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">830</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">36</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Desserts</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Gingerbread</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">807</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">21</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cupcakes</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="list-item-heading">Goose Breast</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">795</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">9</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">Cupcakes</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('js/vendor/jquery.contextMenu.min.js') }}"></script>
@endsection