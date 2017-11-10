<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
     body {
        font-family: "Calibri";
         font-size: 5pt;
        width: 100%;
        height: 100%;
        margin: 0;
        color: black !important;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;     
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
     table
     {
         font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
         width:100%;
         border-collapse:collapse;
     }
     table td, #table th
     {
         border:1px solid #666;
     }
     table th
     {
         background-color:#666;
         color:#ffffff;
     }
     table tr.alt td
     {
         color:#000000;
         background-color:#A9E2F3;
     }
    .center {
        text-align: center;
    }
    .right {
        text-align: right;
    }
    hr {
        border: 3px solid #000000;
        margin: 0px;
    } 
    .long {
        width:100%;
        font: 7pt "calibri" !important;
    }

    .reimbursement {
        font-size: 32pt;
        text-align: center;
        font-weight: bold;
        padding-top: -20px;
        padding-bottom: 20px;
    }
    .font {
        font-size: 12pt;
        text-align: center;
    }
    .font2 {
        font-size: 8pt;
        font-weight: 600;
    }
    .font3 {
        font-size: 10pt;
        text-align: center;
    }
    .font4 {
        font-size: 8pt;
        text-align: center;
    }
    .remarks {
        font-size: 8pt;
    }
    .list {
        font-size: 8pt;
        padding: 0;
    }
    </style>
</head>
<body>
<div>
    <div>
        @yield('content')
        <hr>
        <div class="font4">PT. GLOBALINDO EXPRESS CARGO</div>
        <div class="font4">JALAN PANGERAN JAYAKARTA NO. 8, KOMPLEK ARTHA
        CENTER E17 - 18, JAKARTA BARAT 11110 - INDONESIA</div>
        <div class="font4">TEL +62.21.6591218 ACT1@GEXINDO.COM</div>
    </div>
</div>
</body>
</html>