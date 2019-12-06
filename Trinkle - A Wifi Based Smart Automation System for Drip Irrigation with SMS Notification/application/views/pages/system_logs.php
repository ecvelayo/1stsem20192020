


<div class="container" id="usertable-container">
	<div class="row">
		
	<h2>Sensor Logs</h2> 
	</div>

	<div id="user-table-div">
		<table class="display" id="sensor_log_table">
				<thead>Sensor Logs Table 
					<tr>
						<th>Soil Moisture</th>
						<th>Temperature</th>
						<th>Humidity</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
						$x = 0;
						while($x < count($system_logs)){
							echo "<tr>";
							echo "<td>{$system_logs[$x]->soilmoisture_value}</td>";
							echo "<td>{$system_logs[$x]->temperature_value}</td>";
							echo "<td>{$system_logs[$x]->humidity_value}</td>";
							
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
		$('#sensor_log_table').DataTable();
		
	});
	
	
</script>