<!DOCTYPE html>
<html>
<head>
    <style>
        /* optional styles */
        @page {
            /* size: auto; */
            margin-top: 4cm;
            margin-header: 1cm;
            margin-footer: 1cm;
            header: page-header;
            footer: page-footer;
            text-align: center;
        }
        p {
            padding: -5px 0px;
        }

        table {
            width: 100%;
            border: 1px black;
            font-size:12px;
            overflow:wrap;
        }

        table, th, tr, td {
        	border: 1px black;
            padding: 3px;
            font-size:12px;
        }

        .table tr {
		   border: 1px solid black;
		}

    </style>
</head>
<body>
    <!-- optional -->
    <htmlpageheader name="page-header">
    	<table>
    		<tr>
    			<td align="center"><img src="{{ public_path() . '/img/usclogo.jpg' }}" height="50px"><img src="{{ public_path() . '/img/dcism.jpg' }}" height="50px"></td>
    		</tr>
    	</table>
		<div align="center">University of San Carlos <br> School of Arts and Sciences<br> Department of Computer and Information Sciece and Mathematics</div><br><br>

    </htmlpageheader> 
    <!-- optional -->
    <htmlpagefooter name="page-footer">
        <table>
            <tr>
                <td align="right">
                    Page {PAGENO} of {nb}
                </td>
            </tr>
        </table>
    </htmlpagefooter>

    <br>
    <div>
        <div>

		<br>@if($isAdviser) <div align="center">@if($role == 'Panel')<span>Panelist</span>@else<span>Adviser</span>@endif Undergraduate Thesis</div>@else<div align="center">List of All Undergraduate Thesis / Capstone</div>@endif
        	<h3 align="center">{{ $semester }}</h3>
            <table class="table table-bordered">
            	<thead>

            		@if ($isAdviser || $currentRole == 'faculty')
						<tr class="text-left">
						  <th></th>
	                      <th align="left">Project Title</th>
                          <th align="left">Authors</th>
                          <th align="left">Adviser</th>
                          <th align="left">Subject Area</th>
                          <th align="left">Date</th>
                          <th align="left">Role</th>
	                  	</tr>
                  	@else 
                  		<tr class="text-left">
	                      <th></th>
	                      <th align="left">Project Title</th>
	                      <th align="left">Authors</th>
	                      <th align="left">Panelist</th>
	                      <th align="left">Adviser</th>
	                      <th align="left">Subject Area</th>
	                      <th align="left">Defense Date</th>
	                      <th align="left">Call Number</th>
	                  	</tr>
                  	@endif
            	</thead>
            	<?php $count = 1; ?>
                @foreach($results as $result)
                <?php 
                	$authors = "";
            		$panels = $result->chair_panel ? "Chair Panel: " . $result->chair_panel->fullname . " Members: " : "";

            		$authorCount = count($result->authors) - 1;
	            	foreach ($result->authors as $key => $author) {
		            	$authors = $authors . " " . $author->fullname;
		            	$authors = $authorCount == $key ? $authors : $authors .  ", ";
		            }
		            $panelCount = count($result->panel) - 1;
		            foreach ($result->panel as $key => $panel) {
		            	$panels = $panels . " " . $panel->fullname;
		            	$panels = $panelCount == $key ? $panels : $panels .  ", ";
		            }
                ?>
                @if ($isAdviser)
                    <tr>
                    	<td width="3%">{{ $count }}</td>
                        <td>{{ $result->title }}</td>
                        <td>{{ $authors }}</td>
                        <td>{{ $result->adviser ? $result->adviser->fullname : '' }}</td>
                        <td>{{ $result->area ? $result->area->name : ''}}</td>
                        <td>{{ $result->date_submitted }}</td>
                        <td>{{ $role }}</td>
                    </tr>
                @else
                  	<tr>
                    	<td width="3%">{{ $count }}</td>
                        <td>{{ $result->title }}</td>
                        <td>{{ $authors }}</td>
                        <td>{{ $panels }}</td>
                        <td width="10%">{{ $result->adviser ? $result->adviser->fullname : '' }}</td>
                        <td width="8%">{{ $result->area ? $result->area->name : '' }}</td>
                        <td width="8%">{{ $result->date_submitted }}</td>
                        <td width="8%">{{ $result->call_number }}</td>
                    </tr>
                @endif

                <?php $count++ ?>
                @endforeach
            </table>
        </div> 
    </div>
</body>
</html>

foreach ($results as $key => $result) {
	            	$authorCount = 1;
	            	$panelCount = 1;

	            	foreach ($result->authors as $author) {
		            	$authors = $authors . $authorCount . ". " . $author->fullname . "<br>";
		            	$authorCount++;
		            }

		            foreach ($result->panel as $panel) {
		            	$panels = $panels . $panelCount . ". " . $panel->fullname . "<br>";
		            	$panelCount++;
		            }
	            }