@extends('main')

@section('style')

<style type="text/css">

    .dot {
  height: 15px;
  width: 15px;
  border-radius: 50%;
  display: inline-block;
}

</style>
@endsection



@section('content')

        <ol class="breadcrumb">
          <li class="breadcrumb-item"> 
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>Calendar</b></li>
        </ol>

 <div style="background-color: white;border-radius: 5px;height: 800px">
        <div class="row" style=""> 
          <div class="col-md-4">
            <div class="text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 40px"><b>Calendar of Events</b></p> 
              </div>
                @include('flash::message')
            </div>
        </div>
        <div class="col-md-8" style="padding-top: 30px">
            <div class="row">
              <div class="col-md-8">
                <div id='calendar' style="background-color: white;width:850px;height: 50px">
              </div>
            </div>
            </div>
          </div>
      </div>
        <div class="col-md-4">
            <div class="card border-dark mb-3" style="max-width: 28rem;margin-left: 20px">
                <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                <div class="card-header" style="background-color: #343a40;color: white">Legend</div>
                  <div class="card-body text-dark">
                    <p style="text-align: left; margin-left: 20px"><span class="dot"  style="background-color: #32CD32;" ></span>&nbsp;&nbsp;&nbsp;Inpatient Events</p>
                    <p style="text-align: left; margin-left: 20px"><span class="dot"  style="background-color: #428bca;" ></span>&nbsp;&nbsp;&nbsp;Outpatient Events</p>
                    <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #5bc0de;" ></span>&nbsp;&nbsp;&nbsp;Aftacare Events</p>
                    <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #d9534f;" ></span>&nbsp;&nbsp;&nbsp;Cancelled Events</p>
                    <p style="text-align: left;  margin-left: 20px"><span class="dot"  style="background-color: #f0ad4e;" ></span>&nbsp;&nbsp;&nbsp;Other Events</p>
                </div>
              </div>
          </div>



@endsection

@section('script')
<script type="text/javascript">

  $(function () {

    var evt = [];
     $.ajax({ 
          url:"{{URL::route('getEvent')}}",
          type:"GET",
          dataType:"JSON",
          async:false
    }).done(function(r){

          evt = r;
          evt_color = r.eventColor;
    });
    
            
      $("#calendar").fullCalendar({



      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,listWeek'
      },

      eventTextColor: '#FFFFFF',




      minTime: "06:00:00",
      maxTime: "20:00:00",
      events: evt,
      select: function(start, end) {
          if(start.isBefore(moment())) {
              $('#calendar').fullCalendar('unselect');
              return false;
          }
      },

       dayRender: function(date, cell){

             var current_date = moment().format('YYYY-MM-DD');

             

              if(current_date > date.format()) {

                  cell.css("background", "#e8e8e8");


              }
       
      },


   

      
       eventClick: function(calEvent, jsEvent, view) {

              var id = calEvent.id;

                var url = '{{ URL::to('/view_event') }}'+'/'+id;

                window.location.href=url;

       },
  


      
    });

      })

</script>
@endsection


