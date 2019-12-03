@extends('layouts.template')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="containter">
    <div class="row">
        <div class="col-sm-8 ml-sm-auto mr-sm-auto  col-12 mr-auto ml-auto">
            <div class="card" id="ordercard">
                <div class="card-body" id="background">
                    <div class="menu">
                        <br><h1>List of Users</h1><br>
                        <!-- <button class="btn btn-link" id="menulink" onclick="thisType('')">All Users</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('Admin')">Admin</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('Consumer')">Consumer</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('Farmer')">Farmer</button>&nbsp;/&nbsp;
                        <button class="btn btn-link" id="menulink" onclick="thisType('Driver')">Driver</button> -->
                    </div><br>




                    <div class="row">
                            <div class="col-sm-4 ">
                                <form method="GET" action="searchUsers">
                                    {{ csrf_field() }}
                                    <div class="input-group">

                                      <input type="text" class="form-control"  name="searchUser" id="searchUser" placeholder="Search User">

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
                              <form method="GET" action="filterUsers">
                                @csrf
                                <div class="input-group">
                                  <select id="selectType" name="selectType" class="form-control">
                                    <option value="" selected>All Users</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Consumer">Consumer</option>
                                    <option value="Farmer">Farmer</option>
                                    <option value="Driver">Driver</option>
                                  </select>
                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">Select Type</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>



                    @if(isset($data))
                    <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%" id="managetd"> User ID </th>
                                <th style="width:20%" id="managetd"> First Name</th>
                                <th style="width:20%" id="managetd"> Last Name</th>
                                <th style="width:35%" id="managetd"> User Type </th>
                                <th style="width:15%" id="managetd"> Action </th>
                            </tr>
                        </thead>
                        <tbody id="usersTable">
                            @foreach ($data as $user)
                            <tr>
                                <td id="managetd">{{$user->id}} </td>
                                <td id="managetd">{{$user->firstname}}</td>
                                <td id="managetd">{{$user->lastname}}</td>
                                <td id="managetd">{{$user->type}}</td>
                                <td id="managetd">
                                  <span data-toggle="modal" data-target="#show">
                                  <a onclick="showDetails({{$user->id}})" class="btn btn-primary"
                                          data-toggle="tooltip" data-placement="top" title="View User"><i class="fa fa-eye"></i></a></span>
                                  <span data-toggle="modal" data-target="#edit">
                                  <a onclick="editType({{$user->id}})" class="btn btn-warning"
                                          data-toggle="tooltip" data-placement="top" title="Change User Type"><i class="fa fa-pencil"></i></a></span>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </div>
                    </table>
                    {!! $data->render() !!}
                    @else
                    {{ $message }}
                    @endif

                    @if($errors->any())
                        <h2 style="text-align: center;">{{$errors->first()}}</h2>
                    @endif
                </div>
            </div>



        </div>
    </div>
</div>
</div>
</div>



{{-- modal for viewing user details --}}
@if(isset($user))
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" id="usermodal">
      <div class="modal-header">
        <h4 class="modal-title">User Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="usermodalphoto"><img src="{{$user->photo}}" class="modalProductImage"></div>
        <div id="userleftdiv">
        <table id="usermodaltable">
          <tr>
            <td id="usermodaltd">First Name:</td>
            <td id="usermodaltd"><strong><span id="firstname"></span></strong></td>
          </tr>
          <tr>
            <td id="usermodaltd">Last Name:</td>
            <td id="usermodaltd"><strong><span id="lastname"></span></strong></td>
          </tr>
          <tr>
            <td id="usermodaltd">Email Address:</td>
            <td id="usermodaltd"><strong><span id="email"></span></strong></td>
          </tr>
          <tr>
            <td id="usermodaltd">Contact Number:&nbsp;&nbsp;</td>
            <td id="usermodaltd"><strong><span id="contact"></span></strong></td>
          </tr>
          <tr>
            <td id="usermodaltd">Address:</td>
            <td id="usermodaltd"><strong><span id="address"></span></strong></td>
          </tr>
          <tr>
            <td id="usermodaltd">Birthdate:</td>
            <td id="usermodaltd"><strong><span id="birthdate"></span></strong></td>
          </tr>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-remove"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>
@endif


{{-- modal for changing user type --}}
@if(isset($user))
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Change User Type</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group-row">

                <div id="usermodalphoto"><img src="{{$user->photo}}" class="modalProductImage"></div>
                <h4 class="modal-title"><span id="fullname"></span></h4>
            </div>

                <div class="form-group row">
                  <br>
                    <label for="address" class="col-md-4 col-form-label text-md-right">User Type</label>

                    <div class="dropdown col-md-6">
                        <select id="user_type" class="form-control" name="user_type" autofocus>
                                <option selected disabled>Choose...</option>
                                <option value="Admin">Admin</option>
                                <option value="Consumer">Consumer</option>
                                <option value="Driver">Driver</option>
                                <option value="Farmer">Farmer</option>
                        </select>
                    </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" id="updateType" onclick="updateType({{$user->id}})">
              <i class="fa fa-check"></i> Confirm
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-remove"></i> Close
            </button>
          </div>
    </div>
  </div>
</div>
@endif

<script>
// for viewing user details
function showDetails(valueId){
     id = valueId;
     event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/showDetails',

               data:{id:id},
               success:function(data) {
                 //alert(JSON.stringify(data));
                    $('#photo').attr("src" + data.user[0].photo);
                    $('#firstname').html(data.user[0].firstname);
                    $('#lastname').html(data.user[0].lastname);
                    $('#email').html(data.user[0].email);
                    $('#contact').html('0' + data.user[0].contact.substring(2));
                    $('#address').html(data.user[0].address);
                    $('#birthdate').html(data.user[0].birthdate);

               }
    });

}

// for editing user type
function editType (valueId){
     id = valueId;
     name = "";
     event.preventDefault();
     $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({
               type:'GET',
               url:'/showDetails',

               data:{id:id},
               success:function(data) {
                    // alert(JSON.stringify(data));
                    $('#photo1').attr("src" + data.user[0].photo);
                    $('#fullname').html(data.user[0].firstname + " " + data.user[0].lastname);
                    name = data.user[0].firstname;
              }
    });

    $("#updateType").click(function (){

          type = $('#user_type option:selected').text();
          // name = "User";

          swal({
            title: "Are you sure?",
            text: "Are you sure you want to change "+name+"'s' user type to " + type,
            icon: "warning",
            buttons: true,
            dangerMode: true
          }).then((willDelete) => {
            if (willDelete) {

              $.ajax({
                         type:'POST',
                         url:'/edit',

                         data:{id:id, type:type},
                         success:function(data){
                            // alert(JSON.stringify(data));
                            window.location.replace("/users");
                         }
              });

            } else {
              swal(name+"'s user type was not changed");
            }
          });

    });
}

// //for searching users
// $(document).ready(function(){
//   $("#searchUser").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#usersTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });
//
// //for filtering user types
// function thisType(userType){
//
//   $(document).ready(function(){
//       var value = userType;
//       console.log(value);
//       $("#usersTable tr").filter(function() {
//         $(this).toggle($(this).text().indexOf(value) > -1)
//       });
//     });
//
//
// }

$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});
</script>

@endsection
