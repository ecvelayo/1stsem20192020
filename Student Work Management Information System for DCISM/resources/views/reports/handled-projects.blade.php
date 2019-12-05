@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                      <form class="form-inline mb-3" method="get">
                        <div class="form-group">
                              <label for="" class="mr-2 ml-2">From</label>
                              <select name="from_year" id="" class="form-control select2 ml-2">
                                  <?php
                                    $firstYear = (int)date('Y');
 
                                    $lastYear = $firstYear - 19;
                                    $selectedYear = isset($_GET["from_year"]) ? $_GET["from_year"] : 2015;
                                    for($i=$firstYear;$i>=$lastYear;$i--)
                                    {
                                        $selected = $selectedYear == $i ? 'selected' : '';
                                        echo '<option value='.$i.' '.$selected.'>'.$i.'</option>';
                                    }
                                  ?>
                              </select>
                              <label for="" class="mr-2 ml-2">To</label>
                              <select name="to_year" id="" class="form-control select2 ml-2">
                                  <?php
                                    $firstYear = (int)date('Y');
 
                                    $lastYear = $firstYear - 19;
                                    $selectedToYear = isset($_GET["to_year"]) ? $_GET["to_year"] : (int)date('Y');
                                    for($i=$firstYear;$i>=$lastYear;$i--)
                                    {
                                        $selected = $selectedToYear == $i ? 'selected' : '';
                                        echo '<option value='.$i.' '.$selected.'>'.$i.'</option>';
                                    }
                                  ?>
                              </select>
                          </div>
                        @if(Auth::user()->isRole(\App\User::USER_TYPE_ADMIN))
                          <div class="form-group">
                              <label for="" class="mr-2 ml-2">Adviser</label>
                              <select name="adviser" id="" class="form-control select2 ml-2">
                                  <option value="">All</option>
                                  @foreach($advisers AS $id => $name)
                                      <option value="{{ $id }}" {{ (isset($_GET["adviser"]) && $id == $_GET["adviser"]) ? 'selected' : '' }}>{{ $name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <button type="submit" class="btn btn-secondary ml-2">Go</button>
                        @elseif(Auth::user()->isRole(\App\User::USER_TYPE_ADVISER)) 
                          <div class="form-group">
                              <label for="" class="mr-2">Role</label>
                              <select name="role" class="form-control select2 ml-2">
                                  <option value="Adviser" {{ (isset($_GET["role"]) && $_GET["role"] == "Adviser") ? 'selected' : '' }}>Adviser</option>
                                  <option value="Chair Panel" {{ (isset($_GET["role"]) && $_GET["role"] == "Chair Panel") ? 'selected' : '' }}>Chair Panel</option>
                                 <option value="Panel" {{ (isset($_GET["role"]) && $_GET["role"] == "Panel") ? 'selected' : '' }}>Panel</option>
                              </select>
                          </div>
                          <button type="submit" class="btn btn-secondary ml-2">Go</button>
                          @else (Auth::user()->isRole(\App\User::USER_TYPE_FACULTY))
                          <div class="form-group">
                                <label for="" class="mr-2">Role</label>
                                <select name="role" class="form-control select2 ml-2">
                                   <option value="Panel" {{ (isset($_GET["role"]) && $_GET["role"] == "Panel") ? 'selected' : '' }}>Panel</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary ml-2">Go</button>
                          @endif

                        </form>
                        
                        <canvas id="canvas"></canvas>
                        <div class="row" id="projectTable" style="display: none">
                          <table class="table mb-0 table-hover table-striped">
                            <form action="{{ url('print-report') }}" method="POST" target="_blank">
                              {{ csrf_field() }}
                              <input type="hidden" name="year">
                              <input type="hidden" name="semester">
                              <input type="hidden" name="role">
                              <input type="hidden" name="adviserId">
                             
                              <div class="text-right"><button type="submit" class="btn btn-primary text-right">Print</button>
                              </div>
                          </form>
                            <br>
                            <thead>
                              @if(Auth::user()->isRole(\App\User::USER_TYPE_ADMIN))
                              <tr class="bg-primary text-white">
                                  <th></th>
                                  <th>Project Title</th>
                                  <th>Authors</th>
                                  <th>Panelist</th>
                                  <th>Adviser</th>
                                  <th>Subject Area</th>
                                  <th>Defense Date</th>
                                  <th>Call Number</th>
                                  <th></th>
                              </tr>
                              @else 
                                <tr class="bg-primary text-white">
                                  <th>Project Title</th>
                                  <th>Authors</th>
                                  <!-- <th>Panelist</th> -->
                                  <th>Adviser</th>
                                  <th>Subject Area</th>
                                  <th>Date</th>
                              </tr>
                              @endif
                            </thead>
                            <tbody id="projectTableData">
                             
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript" src="{{ asset('js/e.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        var urlParams = new URLSearchParams(window.location.search);
        var adviserId = urlParams.has('adviser') ? urlParams.get('adviser') : '';
        var role = urlParams.has('role') ? urlParams.get('role') : 'Adviser';
        var data = @json($data ?? []);

        var semesterGroup = {
          '1st': [],
          '2nd': [],
          'Summer': [],
          'Tri-sem': []
        };

        var result = [];
        for (var year in data) {
          semesterGroup['1st'].push(data[year]['1']);
          semesterGroup['2nd'].push(data[year]['2']);
          semesterGroup['Summer'].push(data[year]['3']);
          semesterGroup['Tri-sem'].push(data[year]['4']);
        }


        var ctx = document.getElementById("canvas").getContext("2d");

        var data = {
          labels: Object.keys(data),
          datasets: [{
            label: "1st Semester",
            backgroundColor: "#ffe0e6",
            data: semesterGroup['1st']
          },{
            label: "2nd Semester",
            backgroundColor: "#dbf2f2",
            data: semesterGroup['2nd']
          },{
            label: "Summer",
            backgroundColor: "#A9A9A9",
            data: semesterGroup['Summer']
          },{
            label: "Transition Term",
            backgroundColor: "#000",
            data: semesterGroup['Tri-sem']
          }]
        };

        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
            onClick: function(evt, array){


              if (array.length > 0) {
                var e =  array[0];
                var activePoint = myBarChart.getElementAtEvent(evt)[0];
                var data = activePoint._chart.data;
                var semester = activePoint._datasetIndex;
                var label = data.datasets[semester].label;
                var value = data.datasets[semester].data[activePoint._index];
                var year = data.labels[e._index];

                $('input[name="year"]').val(year);
                $('input[name="semester"]').val(semester);
                $('input[name="adviserId"]').val(adviserId);
                $('input[name="role"]').val(role);

                if (year) {
                  $.ajax({
                    url:'get-project-by-semester',
                    data: {
                      year: year,
                      semester: semester + 1,
                      adviserId: adviserId,
                      role: role
                    },
                    method: 'GET',
                    success: function(data) {
                      $("#projectTableData").html("");
                      var count = 1;
                      $.each( data.results, function( key, result ) {
                        var authors = "";
                        var panels = "";
                        panels +=result.chair_panel ? "Chair Panel: " + result.chair_panel.fullname  + "</br></br>Members: </br>" : "";
                        var authorCount = 1;
                        var panelCount = 1;
 
                        $.each( result.authors, function( key, author ) {
                          authors += authorCount + ". " + author.fullname + "</br>";
                          authorCount++;
                        });

                        $.each( result.panel, function( key, panel ) {
                          panels += panelCount + ". " + panel.fullname + "</br>";
                          panelCount++;
                        });

                        var actions = "";
                        if (data.isAdviser) {
                          var url = "my-handled-projects/" + result.id;
                          actions += '<a href="' + url + '" class="mr-2">Review</a>';
                          
                          if(result.project_status == 'pending') {
                            var editUrl = "projects/" + result.id + "/edit";
                            actions += '<a href="' + editUrl + '" class="btn btn-info btn-block mb-2">Edit</a>';
                          }
                        // } else {
                        //   var editUrl = "projects/" + result.id + "/edit";
                        //   actions += '<a href="' + editUrl + '" class="btn btn-info btn-block mb-2">Edit</a>';
                        //   if(result.project_status == 'pending') {
                        //     actions += '<button class="btn btn-danger btn-block">Delete</button>';
                        //   }
                        }

                        if (data.isAdviser || data.currentRole == 'faculty') {
                          var html = "<tr>";
                              html += "<td>";
                              html += result.title;
                              html += "</td>";
                              html += "<td>";
                              html += authors;
                              html += "</td>";
                              // html += "<td>";
                              // html += panels;
                              // html += "</td>";
                              html += "<td>";
                              html += result.adviser ? result.adviser.fullname : '';
                              html += "</td>";
                              html += "<td>";
                              html += result.area ? result.area.name : '';
                              html += "</td>";
                              html += "<td>";
                              html += result.date_submitted; 
                              html += "</td>";
                            html += "</tr>";
                        } else { //admin
                          var html = "<tr>";
                              html += "<td>";
                              html += count;
                              html += "</td>";
                              html += "<td>";
                              html += result.title;
                              html += "</td>";
                              html += "<td>";
                              html += authors;
                              html += "</td>";
                              html += "<td>";
                              html += panels;
                              html += "</td>";
                              html += "<td>";
                              html += result.adviser ? result.adviser.fullname : '';
                              html += "</td>";
                              html += "<td>";
                              html += result.area ? result.area.name : '';
                              html += "</td>";
                              html += "<td>";
                              html += result.date_submitted;
                              html += "</td>";
                              html += "<td>";
                              html += result.call_number;
                              html += "</td>";
                              html += "<td>";
                              html += status;
                              html += actions;
                              html += "</td>";
                            html += "</tr>";
                        }

                        $("#projectTableData").append(html);
                        count++;
                      });

                      $('#projectTable').attr('style', 'display:block');
                    }
                  })
                }
              } else {
                $('#projectTable').attr('style', 'display:none');
              }
            },
            barValueSpacing: 15,
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                  precision: 0
                }
              }]
            }
          }
        });

      })
    </script>
@endpush