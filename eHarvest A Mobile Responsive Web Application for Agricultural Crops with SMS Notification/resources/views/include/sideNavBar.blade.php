<nav class="navbar navbar-expand-md  navbar-dark bg-success fixed-top" id="mobilenav">
    <div class="container">
        {{-- for mobile icon nav --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="btn-group ml-auto mr-auto" id="bells">
        <a class="navbar-brand  mr-3" href="/home"><img class="img-fluid" id="elogo"
                src={{asset("/images/eHarvestLogoFinal.png")}}></a>

        <div class="d-block d-xl-none d-md-none">
            {{-- basket button --}}


            {{-- <a class="btn btn-success" aria-label="Right Align" href="/shoppingBasket">
                        <span class="fa fa-shopping-basket" aria-hidden="true" id=shop></span>
                    </a> --}}

            {{-- notification button  --}}
            {{-- <a class="btn btn-success" aria-label="Right Align" href="/shoppingBasket">
                        <span class="fa fa-bell" aria-hidden="true" id=shop></span>
                    </a> --}}
 
 
                     
 
             
                <button type="button" class="btn btn-success dropdown" data-toggle="dropdown">
                    <i class="fa fa-bell"></i><span id="numberOfNotifsMobile">{{count(auth()->user()->unreadNotifications)}}
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right scrollable-menu" id="notify-2" role="menu">
                {{-- <ul class="dropdown-menu dropdown-menu-right scrollable-menu" id="notify" role="menu"> --}}
                    <h6 class="dropdown-header">Notifcation</h6>
                    <ul id="ulMobile">
                    @foreach(auth()->user()->unreadNotifications as $notifications)
                    
                    <li><a title="Mark as Read" onclick = "markAsRead('{{$notifications->id}}')" id="text_notif">{{$notifications->data['message']}}"</a>
                             
                            <p class="text-right"> {{$notifications->created_at}} </p>
                            

                    </li>
                    @endforeach
                    </ul>
                    <li class="divider" role="presentation"></li>
                    <li role="presentation"><a  tabindex="-1" style="cursor:pointer;text-decoration: underline;" href="/notification">View All Notification</a></li>
                            {{-- <a  href="/notification">
                                <span class="text"style="cursor:pointer;text-decoration: underline;" >View All Notification</span></a> --}}
                {{-- </ul> --}}
                </div>
 
                
            {{-- search button  --}}
            <a  href="/profile">
            <button type="button" class="btn btn-success" href="/profile">
         
                <i class="fa fa-user"></i>   <span aria-hidden="true" id=shop></span>
                    </a>
                </button>
 
            </div>




        </div>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <div class="ml-md-5">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="mr-sm-2 ml-sm-2 nav-link" id="link" href="/home">Home</a>
                    </li>
                    @if (\Auth::user()->type == 'Admin' || Auth::user()->type == 'Farmer')
                    <li class="nav-item dropdown">
                        <a href="/tracking" class="mr-sm-2 ml-sm-2 nav-link  dropdown-toggle" id="link"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
                        <div class="dropdown-menu">
                            @if (\Auth::user()->type == 'Admin')
                            <a class="dropdown-item" href="/orders">Orders</a>
                            <a class="dropdown-item" href="/users">Users</a>
                            <a class="dropdown-item" href="/supply">Supply</a>
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            
                            @endif
                            <a class="dropdown-item" href="/product">Products</a>
                        </div>
                    </li>
                    @endif
                    @if (Auth::user()->type == 'Admin' || Auth::user()->type == 'Consumer')
                    <li class="nav-item">
                        <a class="mr-sm-2 ml-sm-2 nav-link" id="link" href="/tracking">Track</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="mr-sm-2 ml-sm-2 nav-link" id="link" href="/sales">Sales</a>
                    </li>
                    @if(Auth::user()->type=='Admin'||Auth::user()->type=='Driver')
                    <li class="nav-item">
                            <a class="mr-sm-2 ml-sm-2 nav-link" id="link" href="/delivery">Deliver</a>
                        </li>
                    @endif





                    {{-- div for logout button on mobile device --}}
                    <div class="d-block d-xl-none d-md-none">

                        <li class="nav-item">
                            <a class="mr-sm-2 ml-sm-2 nav-link" id="link" href="/shoppingBasket">
                                Basket
                                {{-- <span class="fa fa-shopping-basket" id=shop> --}}
                                    {{Session::has('cart') ? Session::get('cart')->getBasketDetails(Session::get('cart')) : ''}}
                                {{-- </span> --}}
                            </a>

                        </li>



                        {{-- logout --}}
                        <li class="nav-item">
                            <a class="nav-link" id="link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </div>


                </ul>

            </div>


            {{-- right side of nav --}}
        </div>


        <div class="d-none d-sm-block">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav">

                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else

                    {{-- <button type="button" class="btn btn-success" aria-label="Right Align" href="/shoppingBasket">

                                <i  class="fa fa-shopping-basket"></i><span id=shop> {{Session::has('cart') ? Session::get('cart')->getBasketDetails(Session::get('cart')) : ''}}</span>
                    </button> --}}

                    <div class="btn-group">
                        {{-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> --}}
                                <button type="button" class="btn btn-success dropdown" data-toggle="dropdown">
                            <i class="fa fa-bell"></i><span
                                id="numberOfNotifsWeb">{{count(auth()->user()->unreadNotifications)}} </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right scrollable-menu" id="style-2" role="menu">
                            {{-- <ul class="dropdown-menu dropdown-menu-right scrollable-menu" role="menu"> --}}

                            <h6 class="dropdown-header" id="notifhead">Notifcation</h6>
                            <ul id = "ulWeb">
                            @foreach(auth()->user()->unreadNotifications as $notifications)
                            <div class="dropdown-divider"></div>
                            <li><a title="Mark as Read" onclick = "markAsRead('{{$notifications->id}}')" id="text_notif">{{$notifications->data['message']}}"</a><br>

                                    <p class="text-right"> {{$notifications->created_at}} </p>
                            </li>

                            @endforeach
                            
                            </ul>
                            <li class="divider" role="presentation"></li>

                         <li role="presentation"><a  tabindex="-1" style="cursor:pointer;text-decoration: underline;" href="/notification">View All Notification</a></li>
                            {{-- <li>
                            <div class="dropdown-divider"></div>

                            <a  data-toggle="modal" data-target="#notification" role="button">
                                    <span class="text"style="cursor:pointer;text-decoration: underline;" >View All Notification</span></a>
                                    </li> --}}




                            {{-- </ul> --}}
                        </div>

                    </div>





                    <a class="btn btn-success" aria-label="Right Align" href="/shoppingBasket">

                        <i class="fa fa-shopping-basket"></i><span id=shop>
                            {{Session::has('cart') ? Session::get('cart')->getBasketDetails(Session::get('cart')) : ''}}</span>
                    </a>
                    {{-- <a class="btn btn-success" aria-label="Right Align" href="/shoppingBasket">
                                <span class="fa fa-bell" aria-hidden="true" id=shop></span>
                            </a>   --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <font color="white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</font>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            {{-- profile --}}

                            <a class="dropdown-item" href="/profile">
                                <i class="fa fa-btn fa-user" style="color: black"></i>
                                {{ __('Profile') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fa fa-btn fa-sign-out" style="color: black"></i>
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </li>

                    @endguest





                </ul>
            </div>
        </div>

        <div>
</nav>

{{-- Modal for editing product price --}}
<div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="notfication" aria-hidden="true">


    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">All Notification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Notifcation</th>
                            <th>Date</th>

                        </tr>
                    </thead>
                    <tbody id="ordersTable">




                        @foreach(auth()->user()->unreadNotifications->paginate(5) as $notifications)
                        <tr>
                            <td>{{$notifications->data['message']}}"</td>
                            <td>{{$notifications->created_at}}</td>
                        </tr>
                        @endforeach




                    </tbody>
                    <div>
                </table>








            </div>

            {!! auth()->user()->unreadNotifications()->paginate(5)->render() !!}






          </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary" id="updatePrice"s>Save changes</button>


            </div> --}}

        </div>
      </div>
    </div>
  </div>
  </div>

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
function markAsRead(notifID)
{
    
    var notificationID = notifID;
    event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $.ajax({
               type:'POST',
               url:'/markAsRead',

               data:{notificationID:notificationID},
               success:function(data) {

                document.getElementById('numberOfNotifsWeb').innerHTML=data.count;  
                document.getElementById('numberOfNotifsMobile').innerHTML=data.count;                        
                    $("#ulWeb").empty();
                    $("#ulMobile").empty();
                    
                    for(var i =0; i<data.notif.length;i++){
                        var onclick = "'"+data.notif[i]['id']+"'";
                        $("#ulWeb").append('<div class="dropdown-divider"></div>');
                        $("#ulWeb").append('<li><a title="Mark as Read" onclick="markAsRead('+onclick+')" id="text_notif"> '+data.notif[i]["data"]["message"]+'</a><br>');
                        $("#ulWeb").append('<p class="text-right">'+data.notif[i]["created_at"]+'</p> </li>');
                        
        
                        $("#ulMobile").append('<li><a title="Mark as Read" onclick="markAsRead('+onclick+')" id="text_notif"> '+data.notif[i]["data"]["message"]+'');
                        $("#ulMobile").append('<p class="text-right">'+data.notif[i]["created_at"]+'</p> </a><br></li>');
                        
                    }
                   
               },
                error: function(data) {
                    console.log(data);
                }
    });
}
    $('.navbar-nav nav-link').click(function(e){

    $('.navbar-nav nav-link').removeClass("active");
    $(this).addClass("active");
});


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('10b5eee0a0fdb64e0c92', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('order-placed', function(data) {
        console.log("asd");
        console.log({{count(auth()->user()->unreadNotifications)}});

        document.getElementById('numberOfNotifsMobile').innerHTML=data.numberOfNotifications;
        document.getElementById('numberOfNotifsWeb').innerHTML=data.numberOfNotifications;

        // alert(JSON.stringify(data));
    });
    channel.bind('order-accepted', function(data) {
        // alert(JSON.stringify(data));
        // console.log({{count(auth()->user()->unreadNotifications)}});

        document.getElementById('numberOfNotifsMobile').innerHTML=data.numberOfNotifications;
        document.getElementById('numberOfNotifsWeb').innerHTML=data.numberOfNotifications;

        // alert(JSON.stringify(data));
    });
    channel.bind('supply-acknowledged', function(data) {
        // alert(JSON.stringify(data));
        // console.log({{count(auth()->user()->unreadNotifications)}});

        document.getElementById('numberOfNotifsMobile').innerHTML=data.numberOfNotifications;
        document.getElementById('numberOfNotifsWeb').innerHTML=data.numberOfNotifications;

        // alert(JSON.stringify(data));
    });
    channel.bind('supply-restocked', function(data) {
        // alert(JSON.stringify(data));
        // console.log({{count(auth()->user()->unreadNotifications)}});

        document.getElementById('numberOfNotifsMobile').innerHTML=data.numberOfNotifications;
        document.getElementById('numberOfNotifsWeb').innerHTML=data.numberOfNotifications;

        // alert(JSON.stringify(data));
    });


</script>
