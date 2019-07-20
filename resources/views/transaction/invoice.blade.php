<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/storage/img/storage-icon.png"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style>
    html {
        position: relative;
        min-height: 100%;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .table {
      width: 100%;
      margin-bottom: 1rem;
      background-color: transparent;
    }

    .table th,
    .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #dee2e6;
    }

    .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
      border-top: 2px solid #dee2e6;
    }

    .table .table {
      background-color: #fff;
    }

    .table-sm th,
    .table-sm td {
      padding: 0.3rem;
    }

    .table-bordered {
      border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead td {
      border-bottom-width: 2px;
    }

    .table-borderless th,
    .table-borderless td,
    .table-borderless thead th,
    .table-borderless tbody + tbody {
      border: 0;
    }
    .table-condensed tbody>tr>td {
    padding-top: 0;
    padding-bottom: 0;
    }

    .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    }
    </style>

</head>
<body style="margin:0; padding:0;">
<table  class="table table-borderless">
    <tr>
        <td><strong>SISTEM INFORMASI WEDDING ORGANIZER</strong></td>
        <td style="text-align: right;" rowspan="2"><strong>INVOICE</strong></td>
    </tr>
    <tr>
        <td>
            {{$setting->address}} No. Telp ({{$setting->phone}})
        </td>
    </tr>
</table>
<hr>
<table class="table table-borderless">
    <tr>
        <td>{{$transaction->user->name}}</td>
        <td style="text-align: right;" rowspan="2">#{{$transaction->invoice}}</td>
    </tr>
    <tr>
        <td>{{$transaction->user->address}}, {{ucwords(strtolower($transaction->user->district['name']))}}, {{ucwords(strtolower($transaction->user->regency['name']))}}, {{ucwords(strtolower($transaction->user->province['name']))}}</td>
    </tr>
</table>
<br>
<table class="table table-bordered table-condensed">
    <tr>
        <th>Nama Paket</th>
        <th>Tgl Event</th>
        <th>Harga Paket</th>
        <th>Biaya Operasional</th>
        <th style="text-align: right;">Sub Total</th>
    </tr>
    @foreach($carts as $cart)
        <tr>
            <td>{{$cart->package->nama}}</td>
            <td>{{$cart->event_date}}</td>
            <td style="text-align: right;">Rp. {{ number_format($cart->package->price,0,",",".") }}</td>
            <td style="text-align: right;">Rp. {{ number_format($cart->tambahan,0,",",".") }}</td>
            <td style="text-align: right;">Rp. {{ number_format($cart->package->price + $cart->tambahan,0,",",".") }}</td>
        </tr>
    @endforeach
    <tr>
        <th colspan="4" style="text-align: right;">Total</th>
        <th style="text-align: right;">Rp. {{ number_format($total,0,",",".") }}</th>
    </tr>
</table>
<div class="footer">
    2019 © Sekolah Tinggi Teknologi Garut
</div>
</body>
</html>
