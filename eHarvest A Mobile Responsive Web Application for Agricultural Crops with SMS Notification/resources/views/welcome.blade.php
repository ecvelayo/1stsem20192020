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
    <!-- Styles -->

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            color: white;
            font-family: 'Work Sans', sans-serif;
            scroll-behavior: smooth;
        }

        /* #loading_layer {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999999;
            background-color: #FFF;
            text-align: center;
            margin: 0 auto;
        } */

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgb(255, 255, 196) !important;
            
        }
        .loader img{
            position: relative;
            left: 43%;
            top: 35%;
            width: %;
             
        }
        
@media only screen and (max-width: 414px) {
        .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgb(255, 255, 196) !important;
            
        }
        .loader img{
        position: relative;
        left: 30%;
        top: 30%;
        width:  ;
             
        }  
}
        .bg {
            background-image: url(images/landingPageBg2.jpg);
            height: 100%;
            width: 100%;
            /* Set a specific height */
            min-height: 500px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            text-align: center;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 100px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
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

        .btn {
            height: 70px;
            width: 300px;
            font-size: 30px;
        }

        .titlename {
            padding-top: 20%;
            font-size: 100px;
        }

        .about {
            background-color: #3aba64;
            height: 100%;
        }

        .why {
            height: 500px;
            background-color: rgb(255, 255, 196);
        }

        .footer {
            background-color: #3aba64;
        }

        .titlename2 {
            margin-top: 0px;
            text-align: center;
            padding: 5%;
        }

        .first {
            width: 33%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 0px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .second {
            width: 33%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 0px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .third {
            width: 33%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 0px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .first2 {
            width: 24%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 10px;
            
        }

        .second2 {
            width: 24%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 10px;
        }

        .third2 {
            width: 24%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 10px;
        }

        .fourth2 {
            width: 24%;
            height: 150px;
            float: left;
            text-align: center;
            margin-right: 1 0px;
        }

        .footerfirst {
            width: 33%;
            height: 150px;
            float: left;
            text-align: left;
            margin-right: 0px;
        }

        .footersecond {
            width: 33%;
            height: 150px;
            float: left;
            text-align: left;
            margin-right: 0px;
        }

        .footerthird {
            width: 33%;
            height: 150px;
            float: left;
            text-align: left;
            margin-right: 0px;
        }

        .aboutimage {
            height: 200px;
            width: 200px;
        }

        p,
        a {
            color: white;
            font-size: 20px;
            font-family: 'Work Sans', sans-serif;
        }

        a:hover {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .whytitle {
            margin-top: 0px;
            text-align: center;
            padding-top: 5%;
            color: black;
        }

        .whycard {
            margin-top: 15%;
            width: 300%;
        }

        .whydesc {
            color: black;
            text-align: center;
        }

        .footercard {
            margin-top: 3%;
            margin-bottom: 10%;
            width: 100%;
        }

        .footer{
            margin-top: 600px;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: white;
            color: #3aba64;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
        }

        #myBtn:hover {
            background-color: #3aba64;
            color: white;
        }

        /* On 375px screens, decrease text size */
        @media only screen and (max-width: 475px) {
            .titlename {
                font-size: 60px;
                padding-top: 50%;
            }

            .about {
                background-color: #3aba64;
                height: 180%;
            }

            .first {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 10px;
                padding: 0px 20px 20px;
            }

            .second {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
                padding: 0px 20px 20px;
            }

            .third {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
                padding: 0px 20px 20px;
            }

            .first2 {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 10px;
                padding: 0px 20px 20px;
            }

            .second2 {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
                padding: 0px 20px 20px;
            }

            .third2 {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
                padding: 0px 20px 20px;
            }

            .fourth2 {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
                padding: 0px 20px 20px;
            }

            .footerfirst {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
            }

            .footersecond {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
            }

            .footerthird {
                width: 100%;
                height: auto;
                float: left;
                text-align: center;
                margin-right: 0px;
                margin-top: 30px;
            }

            p,
            a {
                color: white;
                font-size: 14px;
            }

            h2 {
                font-size: 20px;
                font-family: 'Work Sans', sans-serif;
            }
        }

        /* On 375px screens, decrease text size */


        

        ) 50% 50% no-repeat rgb(249,
        249,
        249);

        }

        .loader img {
            position: relative;
            left: 40%;
            top: 40%;
        }


        #wlogo {

            width: 50%;
            margin-top: 15%;

        }


        @media only screen and (max-width: 420px) {
            #wlogo {
                width: 100%;
                margin-top: 50%;
            }
        }
        #steps{
            color:black;
            margin-top: 20px;
            font-family: 'Work Sans', sans-serif;
        }

        #who{
            margin-top: 20px;
            font-family: 'Work Sans', sans-serif;
        }
        @media only screen and (max-width: 360px) {
            .bg{
                width: 400px;
            }
            .about{
                width: 400px;
            }
            .why{
                width: 400px;
            }
            .footer{
                width: 400px;
            }
        }
        @media only screen and (max-width: 360px) {
            .navTop,.navBottom{
                width: 100% !important;
            }
            .about{
                height: 1200px;
            }
            .bg{
                height: 700px;
            }
        
        }
        @media only screen and (max-width: 375px) {
            .about{
                height: 1200px;
            }
        }
    </style>
</head>
{{-- <div id="loading_layer"><img src="{{asset("/images/eharvestloader.gif")}}" alt="" width="100%" height="100%" border="0" /></div> --}}
<div class="loader" ><img src="{{asset('/images/eharvestspinner.gif')}}"></div>
<body onload="hideLoadingLayer();">
{{-- <body> --}}
    <button class="fa fa-arrow-up" onclick="topFunction()" id="myBtn" title="Go to top"></button>

    <div class="bg justify-content-center">
        <div class="col-md-12 ml-md-auto ml-sm-auto col-sm-12">
            {{-- <h1 class="titlename"> eHarvest </h1> --}}
            <img class="img-fluid" id="wlogo" src={{asset("/images/welogo.png")}}>
            <div class="browseButton">
                <button type="button" class="btn btn-success" onclick="location.href = '/login'" ;>Browse
                    Products</button>
            </div>
        </div>
    </div>
    <div class="about">
        <h1 class="titlename2"> eHarvest </h1>
        <div class="container-fluid">
            <div class="row">
                <div class="aboutcard">
                    <div class="first">
                        <h2>WHO ARE WE</h2>
                        <img src="/images/who1.png" class="aboutimage">
                        <p id="who"> We are Eharvest: A Mobile Responsive Web Application for Agricultural Products with SMS
                            Notification</p>
                    </div>
                    <div class="second">
                        <h2>WHAT WE DO</h2>
                        <img src="/images/what.png" class="aboutimage">
                        <p id="who"> We sell fruits and vegetables from farmers online and delivered within Cebu City through cash on delivery
                        </p>
                    </div>
                    <div class="third">
                        <h2>WHY WE DO IT</h2>
                        <img src="/images/why.png" class="aboutimage">
                        <p id="who"> We do it for the convenience of the consumers and to help our local farmers to gain more
                            profit </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="why">
        <h1 class="whytitle"> SHOP NOW</h1>
        <div class="container-fluid">
            <div class="row">
                <div class="whycard">
                    <div class="first2">
                        <img src="/images/step1.png" class="aboutimage">
                        <h2 id="steps">STEP 1</h2>
                        <p id="steps"> Login as consumer.  </p>
                    </div>
                    <div class="second2">
                        <img src="/images/step2.png" class="aboutimage">
                        <h2 id="steps">STEP 2</h2>
                        <p id="steps"> Place your order to basket.  </p>
                    </div>
                    <div class="third2">
                        <img src="/images/step3.png" class="aboutimage">
                        <h2 id="steps">STEP 3</h2>
                        <p id="steps"> Checkout.  </p>
                    </div>
                    <div class="fourth2">
                        <img src="/images/step4.png" class="aboutimage">
                        <h2 id="steps">STEP 4</h2>
                        <p id="steps"> Acquire order via cash on delivery or pick up. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footercard">
                    <div class="footerfirst">
                        <h2>SHOP</h2>
                        <a href="/tc">Terms & Conditions</a><br>
                        <a href="/contact">Contact Us</a><br>
                    </div>
                    <div class="footersecond">
                        <h2>DELIVERY HOURS</h2>
                        <p> Wednesday: 9:00am - 4:00pm</p>
                        <p> Sunday: 9:00am - 4:00pm</p>
                    </div>
                    <div class="footerthird">
                        <h2>ADDRESS</h2>
                        <p> Nasipit Talamban, Cebu City </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navTop"></div>
    <div class="navBottom"></div>
    <!-- <div class="navBottom"></div> -->
</body>

</html>
<script>
//     function hideLoadingLayer(){
//         $('#loading_layer').delay(100).fadeOut('slow');
//         // $('body').delay(350).css({'overflow':'visible'});
//  document.getElementById("loading_layer").style.visibility="hidden";
//  }
window.onload = function() 
    {
        //display loader on page load 
        $('.loader').delay(600).fadeOut();
         
    }
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>