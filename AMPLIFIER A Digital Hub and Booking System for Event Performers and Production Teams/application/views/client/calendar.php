	<!-- <div class="container mt-3">
		<div class="text-center">
			<p class="h4">Calendar Module is not available at this time</p>
			<img src="<?php echo base_url() ?>assets/img/website/events.svg" class="mt-3" width="50%" alt="">
		</div>
	</div> -->

	<div class="container my-5 text-center">
	<?php 
		if(base_url(uri_string()) == base_url().'clients/calendar'){
			$year = date('Y');
			$month = date('m');
			// echo $this->calendar->generate($year, $month, $booked_event, $this->uri->segment(3), $this->uri->segment(4)); 	
			redirect('clients/calendar/'.$year.'/'.$month);
		}else{	
			$year = $this->uri->segment(3);
			$month = $this->uri->segment(4);
			echo $this->calendar->generate($year, $month, $booked_event, $this->uri->segment(3), $this->uri->segment(4)); 	
		}
		$this->session->set_userdata('previous_calendar_link', base_url(uri_string()));
	?>
</div>

<?php

// $re_index_data = array_values($booked_event);

// echo '<pre>';
// print_r($myarray);
// echo '</pre>';

?>
<script>
	var event_name = <?php echo json_encode($event_name) ?>;
	
	// var data = document.getElementById("29").setAttribute("title", "https://www.w3schools.com");
	
	var i;
	for (i = 0; i < 32; i++) {
		// var value = document.getElementById(i).getAttribute("id");
		if(event_name[i]){

			document.getElementById(i).setAttribute("title", event_name[i]);
			// console.log(event_name[i]);
		}
	}
	// var value = document.getElementById(u).getAttribute("href");
	
	// console.log(event_name[27]);
	// console.log(event_name[]);
	// console.log(u);
	

// 	function populatePage(arry) {
//   var i;

//   for (i = 0; i < arry.length; i++) {
//     var id = "forecastDay" + (i + 1);
//     document.getElementById(id).innerHTML = arry[i];
//   }
// }

// // Test it
// populatePage(["Day 1", "Day 2"]);
</script>
