@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container py-5">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2>News Gallery</h2>
    {{-- <a   class="d-sm-inline-block btn btn-md btn-success shadow-sm" data-toggle="modal"
         data-target="#addNews"><i class="fa fa-plus fa-sm text-white-50"></i>Add News</a> --}}

    <button class="btn btn-success" href="/news" data-toggle="modal" data-target="#addNews"><i
        class="fa fa-plus fa-sm text-white-50"></i>Add News</button>


  </div>


  <div class="row py-5" id="rows">
    @foreach ($news as $new)
    <div class="col-sm-3">
      <div class="card text-center">
      <img class="card-img-top img-fluid" src="{{$new->photo}}"  width="400" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title">{{$new->news_name}}</h4>
          {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
          <a onclick="deleteProd({{$new->id}})" class="btn btn-danger">delete <i class="fa fa-trash" > </i></a>
        </div>
      </div>
    </div>

    @endforeach


  </div>
</div>
{{-- end of container --}}


{{--{{-- modal for add new  --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addnews" id="addNews">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="mowdal">
      <div class="modal-header">
        <h4 class="modal-title" id="addnews">Add News</h4>

        <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="addNewsForm" enctype="multipart/form-data">
          @csrf





          <div class="form-group row">
            <label for="news_name" class="col-md-4 col-form-label text-md-right">{{ __('News Name') }} <font
                color="red">*</font></label>


            <div class="col-sm-6">


              <input id="news_name" type="text" class="form-control {{$errors->has('news_name') ? ' is-invalid ' : ''}}"
                name="news_name" value="{{ old('news_name') }}" autocomplete="news_name">
              <span class="text-danger d-none" id="news_nameError"></span>

            </div>



          </div>


          <div class="form-group row">
            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('News Photo') }} <font
                color="red">*</font></label>

            <div class="col-sm-6">
              <input id="photo" type="file" class="form-control-file {{$errors->has('photo') ? ' is-invalid ' : ''}}"
                name="photo" autofocus>
              <span id="photoError" class="text-danger d-none"></span>
              <br>
              <p style="color:red;"> Choose .jpg or .png file only.. </p>

            </div>
          </div>






          <div class="modal-footer">

            <div class="col-sm-8 offset-sm-3 ">
              <button id="addNewsSubmit" type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i>
                {{ __('Add News') }}
              </button>
            </div>

        </form>

      </div>





    </div>

  </div>
</div>





<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).ready(function(){
    $('#addNewsForm').on('submit',function(event){

        event.preventDefault();

        // $("#addNewsSubmit").attr("disabled",true);
        $("#photoError").addClass("d-none");
        $("#news_nameError").addClass("d-none");



       $.ajaxSetup({

      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }

      });


      swal({
        title: "Are you sure?",
        text: "Do you want to add this news?",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then((willDelete) => {
        if (willDelete) {

          swal("Adding news. Please wait.");

          $.ajax({

            url:'/sampleAddNews',
            method:'POST',
            data:new FormData(this),
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){

              location.reload();

            },
            error: function(data) {

                var errors = data.responseJSON;
                console.log(errors);
                if($.isEmptyObject(errors) == false){
                  $("#addNewsSubmit").attr("disabled",false);
                    $.each(errors.errors,function(key,value){

                        var errorID = '#' + key + 'Error';
                        $(errorID).removeClass("d-none");
                        $(errorID).text(value);
                    })
        }
    }

    });


        } else {
          swal("News not added.");
        }
      });




    });
});


// for deleting products
function deleteProd(valueId){
  newsId = valueId;
  event.preventDefault();

 SwalDelete(newsId);

}

function SwalDelete(id){

  $.ajaxSetup({

     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }

 });

	swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this!",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willDelete) => {
    if (willDelete) {

      $.ajax({
                 type:'POST',
                 url:'/deleteNews',

                 data:{id:id},
                 success:function(data) {
                  location.reload();
                }
      });

    } else {
      swal("News was not deleted.");
    }
  });
}















</script>
@endsection
