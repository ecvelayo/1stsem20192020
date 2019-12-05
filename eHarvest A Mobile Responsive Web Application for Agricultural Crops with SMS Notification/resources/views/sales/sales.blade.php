@extends('layouts.template')

@section('content')
{{-- <canvas id="myChart" ></canvas> --}}
{{-- <div class="d-md-inline-block d-block"> --}}
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-sm-3 py-5">
                <div class="d-md-inline d-block">

                        <div class="card">
                                <div class="card-header" id="header">{{ __('Select Year and Month') }}</div>
            
                                <div class="card-body">
                                    <form enctype="multipart-form-data">
                                        @csrf
            
                                        <div class="form-group row">
                                            <label for="email"
                                                class="col-md-12 col-form-label text-md-left">{{ __('Year') }}</label>
            
                                            <div class="col-md-12">
            
                                                <select id="year"
                                                    class="form-control @error('product_type') is-invalid @enderror" required
                                                    name="year" value="{{ old('product_type') }}" required
                                                    autocomplete="product_type" autofocus>
                                                    <option selected disabled>Choose...</option>
                                                    <option value="2019">2019</option>
                                                </select>
                                                <span id = "yearError" class="text-danger d-none"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="password"
                                                class="col-md-12 col-form-label text-md-left">{{ __('Month') }}</label>
            
                                            <div class="col-md-12">
                                                <select id="month"
                                                    class="form-control @error('product_type') is-invalid @enderror" required
                                                    name="month" value="{{ old('product_type') }}" required
                                                    autocomplete="product_type" autofocus>
                                                    <option selected disabled>Choose...</option>
                                                    @foreach($result as $months)
                                                    <option value = "{{$months['value']}}"> {{$months['monthName']}} </option>}
                                                    @endforeach
                                                  
                                                </select>
                                                <span id = "monthError" class="text-danger d-none"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="mr-sm-auto ml-sm-auto mr-auto ml-auto">
                                                <button onclick="sendData()" type="submit" class="btn btn-primary">
                                                    {{ __('Search') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                </div>

            </div>
            <div class="col-sm-8">
                    <div class="d-md-inline d-block">
                        
                            <div class="card">
                                    <div class="card-header" id="header">{{ __('Products Statistic') }}</div>
                
                                    <div class="card-body">
                                            <div class="myChart"  id="saleschart">
                                         <canvas id="myChart"></canvas>
                                            </div>
                                    </div>
                                </div>
                            
                    </div>
    
                </div>




        </div>

    </div>
{{-- </div> --}}

{{-- <div class="d-md-inline-block d-block"> --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-sm-12 offset-sm-1">

                

                
                <div class="card" id="cardi">
                    <div class="card-header" id="header">{{ __('Products Statistic') }}</div>

                    <div class="card-body">
                            <div class="myChart"  id="saleschart">
                         <canvas id="myChart"></canvas>
                            </div>
                    </div>
                </div>


            </div>
        </div>




    </div> --}}
{{-- </div> --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> --}}
<script>

function sendData()
{
    event.preventDefault();
    var month = $("#month").val();
    var year = $("#year").val();
    $("#yearError").addClass("d-none");
    $("#monthError").addClass("d-none");
    $.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });

    $.ajax({
               type:'POST',
               url:'/getYearMonth',

               data:{month:month,year:year},
               success:function(data) {

                //  alert(JSON.stringify(data));
                //  alert(myChart.options.title.text);
                 myChart.options.title.text = "Products sold in the month of " + data.monthName;
                $i =0;
                if($.isEmptyObject(data.items) == false){
                    $.each(data.items,function(index,value){
                    // alert(index);
                    myChart.data.labels[$i] = index;
                    myChart.data.datasets[0].data[$i] = value.qty;
                    $i++;
                    
                    // alert(value.qty);
                })
                }else{
                    myChart.data.labels = [];
                    myChart.data.datasets[0].data = [];
                }
                myChart.update();
                
                // $.each(data,function(index,value){
                //     // alert(index);
                //     myChart.data.labels[$i] = index;
                //     myChart.data.datasets[0].data[$i] = value.qty;
                //     $i++;
                //     myChart.update();
                //     // alert(value.qty);
                // })
                
               },
               error:function(data){
                var errors = data.responseJSON;
                   if($.isEmptyObject(errors) == false){
                       $.each(errors.errors,function(key,value){
                           var errorID = '#' + key + 'Error';
                           $(errorID).removeClass("d-none");
                           $(errorID).text(value);
                       })
                   }
               }
    });
}
</script>
 
{{-- 
@endsection --}}