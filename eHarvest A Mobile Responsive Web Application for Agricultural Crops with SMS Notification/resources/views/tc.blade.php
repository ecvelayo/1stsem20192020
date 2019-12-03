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
        #tc{
            padding-left: 50px;
            padding-right: 50px;
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
        #ordercard{
            margin-bottom: 100px;
        }
        #indent{
            padding-left: 50px;
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
                        <br><h1>Terms & Conditions</h1><br>
                    </div>
                    <br>
                    <a href="{{ URL::previous() }}" class="btn btn-success" id="backbtn"><span>Back</span></a>
                    
                    <div div class="row" id="tc">
                    <p>These terms and conditions outline the rules and regulations for the use of eharvest's Website.

                        By accessing this website we assume you accept these terms and conditions in full. Do not continue to use eharvest's website if you do not accept all of the terms and conditions stated on this page.
                        </p>
                    
                    <b>    About eHarvest:</b>
                    <p id="indent">   Welcome to E-harvest. A webbased application for farmers and consumers that caters the needs of a fresh produce agricultural crops. We believe that this will give you convenience and comfort while ordering the needed produce at the comfort of your home.
                        </p>
                    <b>    Registration of Service:</b>
                    <p id="indent">    1. If the consumer would like to access, order and purchase products from the platform, a registration is provided to make an account. In order to register, the consumer must provide the name, address, email address and contact number.
                     </p><p id="indent">
                        2. If the consumer wants to be a farmer or driver, just contact us.
                        </p>
                        <b>    Orders:</b>
                    <p id="indent">  At eHarvest, once the order is checked out the order cannot be cancelled. Users should then wait for the order to be accepted by the admin.
                        In the case that the order has been Cancelled/Declined an SMS notification would then be sent to the users with the reason along with  details concerning the cancellation of the order.
                    </p>
                    <b>    Shipping and Delivery:</b>
                    <p id="indent">    1. eHarvest will accept the buyer’s purchase and makes the necessary arrangements and provides details of the buyer such as the delivery date, the tracking number and amount to the buyer through sms.
                    </p><p id="indent">    2. eHarvest aims to deliver the products within the agreed day which is EVERY WEDNESDAY AND SUNDAY ONLY.
                    </p><p id="indent">    3. At eHarvest, our customers can avail the FREE SHIPPING OF ITEMS for orders Php 1000 and up. All orders below this amount will have a delivery charge worth Php 50.
                        </p>
                    <b>    Mode of Payment:</b>
                    <p id="indent">    eHarvest ONLY accepts payment through CASH ON DELIVERY, no any other payment method.
                            </p>
                    <b>    Product:</b>
                    <p id="indent">    Images of the product may vary and differ from the actual product.
                    </p>
                    <b>    Discount Offers:</b>
                    <p id="indent">    eHarvest offers promotional discounts to the products. Final price is already reflected as the price adjustment is already applied.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="navTop"></div>
<div class="navBottom"></div>
</body>