<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eHarvest</title>
    <link rel="icon" href={{asset("/images/link.png")}}>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->

    <style>
        i{
            color: black;
        }
        #info{
            text-align: center;
            padding-left: 30px;
            padding-right: 30px;
            margin-top: 30px;
            display: block;
            font-size: 20px;
        }
        #backbtn {
            text-align: center;
            font-size: 20px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
            background-color: #4dbd74;
            border-color: #4dbd74;
        }

        #backbtn span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        #backbtn span:after {
            content: '\00ab';
            position: absolute;
            opacity: 0;
            top: 0;
            left: -20px;
            transition: 0.5s;
        }

        #backbtn:hover span {
            padding-left: 20px;
        }

        #backbtn:hover span:after {
            opacity: 1;
            left: 0;
        }
        .navTop {
            background-color: #4dbd74;
            height: 5%;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .navBottom {
            background-color: #4dbd74;
            height: 5%;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<div class="containter">
    <div class="row">
        <div class="col-sm-6 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto">
            <div class="card" id="ordercard">
                <div class="card-body" id="background">
                    <div class="menu">
                        <br><h1>Contact Us</h1><br>
                    </div>
                    <br>
                    <a href="{{ URL::previous() }}" class="btn btn-success" id="backbtn"><span>Back</span></a>
                    
                    <div class="row" id="info">
                        <b>Mobile phone numbers: <i class="fa fa-mobile-phone"></i></b><p> 09983128845 </p><p> 09953216843 </p><p> 09950362331 </p>
                        <b>Be a farmer or driver inquiry: <i class="fa fa-mobile-phone"></i></b><p> 09055626875 </p>
                        <b>Social Media: <i class="fa fa-facebook-square"></i></b><br><a href="http://www.facebook.com/eharvest.ph" target="_blank">facebook.com/eharvest.ph</a><br>
                        <b>Email Address: <i class="fa fa-envelope"></i></b><p> eharvest@gmail.com </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="navTop"></div>
<div class="navBottom"></div>
</body>