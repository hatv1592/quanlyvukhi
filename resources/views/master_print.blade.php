<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{App\Lib\SEO::$title}}</title>
    @yield('extension.style')
    @include('partial.head')
    <style>
        body {
            background-color: #fff !important;
        }
        .red {
            color: red;
        }
        .print {
            color: #000 !important;
            /*size: 21cm 29.7cm;*/
            /*margin: 30mm 45mm 30mm 45mm; /!* change the margins as you want them to be. *!/*/
            width: 800px;
            padding: 10px;
        }

        .print .line {
            border: none;
            border-top: 1px #000 solid;
            width: 180px;
            margin: 5px 0 0 10px;
            padding: 0;
        }

        .print .bold {
            font-weight: bold;
        }

        .print .top {
            margin: 10px auto;
        }

        .print .bottom {
            margin: 10px auto;
        }

        .print .body {
            margin: 10px auto;
        }

        .print .body th, .print .body table td {
            padding: 5px;
        }

        .print .title {
            font-weight: bold;
            font-size: 35px;
            text-align: center;
            margin: 10px auto;
        }

        .print ._label {
            font-weight: bold;
            font-size: 13px;
            padding-right: 10px;
        }
        .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid #aaa !important;
        }
        .col-xs-3 {
            padding: 0;
        }
    </style>
</head>
<body class="nav-md">
@yield('content')
</body>
</html>
