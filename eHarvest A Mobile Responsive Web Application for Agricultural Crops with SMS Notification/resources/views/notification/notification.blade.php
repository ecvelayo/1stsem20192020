@extends('layouts.template')

@section('content')


<div class="containter">
    <div class="row">
        <div class="col-sm-8 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto">
            <div class="card" id="ordercard">

                <div class="card-body" id="background">
                    <div class="menu">
                        <br>
                        <h1>All Notifications</h1><br>
                    </div><br>


                    <div class="row" id="notiftable">
                        {{-- <div class="col-sm-4 ">

                            <form method="GET" action="/orderSearch" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">

                                    <input type="text" class="form-control" name="searchOrders" id="searchOrders"
                                        placeholder="Search Orders">

                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4"></div>

                        <div class="col-sm-4">
                            <form method="GET" action="/orderFilter">
                                @csrf
                                <div class="input-group">
                                    <select id="selectType" name="selectType" class="form-control">
                                        <option value="" selected>All Orders</option>
                                        <option value="for approval">For Approval</option>
                                        <option value="for delivery">For Delivery</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Select Type</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div> --}}


                   
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="d-flex">
                                    <th class="col-sm-9" id="managetd">Notification</th>
                                    <th class="col-sm-3" id="managetd">Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="ordersTable">
                               
                                @foreach(auth()->user()->notifications->paginate(5) as $notifications)
                                <tr class="d-flex">
                                    <td class="col-sm-9" id="notiftd">{{$notifications->data['message']}}"</td>
                                    <td class="col-sm-3" style="text-align:center;" id="notiftd">{{$notifications->created_at}}</td>
                                </tr>
                                @endforeach
                                
                               

                            </tbody>
                            <div>
                            
                        </table>
                        
                        <!-- <tr>
                            <h2 style="text-align: center;"> No Notification </h2>
                        </tr> -->
<!--                         
{{-- 
                        @if($errors->any())
                            <h2 style="text-align: center;">{{$errors->first()}}</h2>
                        @endif --}} -->







                    </div>
                    {!! auth()->user()->notifications->paginate(5)->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
  

    <script>
       
    </script>
    @endsection
