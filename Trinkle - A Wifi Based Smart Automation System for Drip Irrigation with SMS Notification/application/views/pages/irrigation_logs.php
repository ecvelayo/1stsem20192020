
<div class="container" id="usertable-container">
	<div class="row">
		
	<h2>Irrigation Data</h2> 
	</div>

	<div id="irrigation-data-table-div">
		<table class="display" id="irrigation_data_table" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Crop Name</th>
						<th>Start Date</th>	
						<th>Start Time</th>
						<th>Stop Date</th>	
						<th>Stop Time</th>
						<th>Start Soil Moisture</th>
						<th>Stop Soil Moisture</th>
						<th>Start Soil Moisture</th>
						<th>Stop Soil Moisture</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
						$x = 0;
						while($x < count($irrigation_data)){
							$dateTimeArray = explode(" ",$irrigation_data[$x]->start_date_time);
							$Startdate = $dateTimeArray[0];
							$Stoptime = $dateTimeArray[1];
							echo "<tr>";
							echo "<td>{$irrigation_data[$x]->irrigation_data_id}</td>";
							echo "<td>{$irrigation_data[$x]->crop_name}</td>";
							echo "<td style = 'color:green'>{$Startdate}</td>";
							echo "<td style = 'color:green'>{$Stoptime}</td>";
							$dateTimeArray = explode(" ",$irrigation_data[$x]->stop_date_time);
							$Stopdate = $dateTimeArray[0];
							$Stoptime = $dateTimeArray[1];
							echo "<td style = 'color:red'>{$Startdate}</td>";
							echo "<td style = 'color:red'>{$Stoptime}</td>";
							echo "<td style='text-align: center'>{$irrigation_data[$x]->start_soil_moisture}</td>";
							echo "<td style='text-align: center'>{$irrigation_data[$x]->stop_soil_moisture}</td>";
							echo "<td style='text-align: center'>{$irrigation_data[$x]->start_temperature}</td>";
							echo "<td style='text-align: center'>{$irrigation_data[$x]->stop_temperature}</td>";

							echo "</tr>";


							$x++;
						}
					?>
				</tbody>
			</table>
	</div>
</div>
<script>
	$('document').ready(function(){
		$('#irrigation_data_table').DataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    });
		
	});
	
	
</script>