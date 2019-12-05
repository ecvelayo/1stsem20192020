<?php
    class Calendar_Model extends CI_Model {
        public function index (){
			$data['calendar'] = $this->Calendar_model->get_bookings();
			$data['event_name'] = null;
			
			if($data['calendar']){
				foreach($data['calendar'] as $d){
					$event_date = date('j', strtotime($d['event_date']));
					$event_month = date('m', strtotime($d['event_date']));
					$event_year = date('Y', strtotime($d['event_date']));
					$temp[$event_date] = base_url().'calendar_info/'.$event_year.'/'.$event_month.'/'.$event_date;
					// echo '<pre>';
					// print_r($d);
					// echo '</pre>';
					// $data['event_name'][$event_date] = $d['event_name'];
					$data['event_name'][$event_date] = $this->Calendar_model->get_event_name($event_date, $event_month, $event_year);
				}
				$data['booked_event'] = $temp;
			}else{
				$data['booked_event'] = null;
			}
			$calendar_template = '
				{table_open}<div class="col-md-10 offset-md-1"> <table class="table table-bordered">{/table_open}
					{heading_row_start}<tr>{/heading_row_start}
						{heading_previous_cell}<th class="prev_sign"><a href="{previous_url}" class="text-primary"><i class="fas fa-angle-double-left fa-2x"></i></a></th>{/heading_previous_cell}
						{heading_title_cell}<th colspan="{colspan}"><p class="h4 font-weight-bold">{heading}</p></th>{/heading_title_cell}
						{heading_next_cell}<th class="next_sign"><a href="{next_url}" class="text-primary"><i class="fas fa-angle-double-right fa-2x"></i></a></th>{/heading_next_cell}
					{heading_row_end}</tr>{/heading_row_end}

					//Deciding where to week row start
					{week_row_start}<tr class="week_name" >{/week_row_start}
						//Deciding  week day cell and  week days
						{week_day_cell}<td ><p class="h5">{week_day}</p></td>{/week_day_cell}
						//week row end
					{week_row_end}</tr>{/week_row_end}

					{cal_row_start}<tr>{/cal_row_start}
						{cal_cell_start}<td class="bg-light h6">{/cal_cell_start}
							{cal_cell_content}<a href="{content}" id="{day}" class="unstyled-link" data-toggle="tooltip" data-placement="top" title="hi"><p class="h5 font-weight-bold text-danger">{day}</p></a>{/cal_cell_content}
							{cal_cell_content_today}<a href="{content}" id="{day}" class="unstyled-link" data-toggle="tooltip" data-placement="top" title="hello"><p class="h5 font-weight-bold text-warning">{day}</p></a>{/cal_cell_content_today}
							{cal_cell_no_content}<p class="">{day}</p>{/cal_cell_no_content}
							{cal_cell_no_content_today}<a href="#" data-toggle="tooltip" data-placement="top" title="Today" class="unstyled-link"><p class="h5 font-weight-bold text-info">{day}</p></a>{/cal_cell_no_content_today}
							{cal_cell_blank}&nbsp;{/cal_cell_blank}
						{cal_cell_end}</td>{/cal_cell_end}
					{cal_row_end}</tr>{/cal_row_end}
				{table_close}</table>{/table_close}
				';			
			$prefs = array(
				'template' 			=> $calendar_template,
				'start_day'    		=> 'sunday',
				'month_type'   		=> 'long',
				'day_type'    	 	=> 'short',
				'show_next_prev'  	=> TRUE,
				'next_prev_url'   	=> base_url().'clients/calendar/',
				'show_other_days'	=> TRUE,				
			);

			$templates['title'] = 'Calendar';
			$this->calendar->initialize($prefs);
			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/calendar', $data);
			$this->load->view('inc/footer');
		}        
		public function get_bookings(){

			if(base_url(uri_string()) == base_url().'clients/calendar'){
				$first_day = date('Y-m-01', strtotime(date('Y-m-d')));
				$last_day = date('Y-m-t', strtotime(date('Y-m-d')));	
			}else{
				$year = $this->uri->segment(3);
				$month = $this->uri->segment(4);
				
				$query_first_day = $year.'-'.$month.'-01';
				$query_last_day = $year.'-'.$month.'-27';

				$first_day = date('Y-m-01', strtotime($query_first_day));
				$last_day = date('Y-m-t', strtotime($query_last_day));	
			}			
			$query = $this->db->query("SELECT * FROM `bookings` WHERE event_date between '$first_day' and '$last_day' GROUP BY event_date ");
			// echo $this->db->last_query();
			return $query->result_array();
		}
		public function calendar_info(){
			$data['booked_events'] = $this->Calendar_model->get_specific_bookings();

			$templates['title'] = 'List of Events';
			$this->load->view('inc/header-client', $templates);
			$this->load->view('client/calendar_info', $data);
			$this->load->view('inc/footer');
		}
		public function get_specific_bookings(){
			$date = $this->uri->segment(2).'-'.$this->uri->segment(3).'-'.$this->uri->segment(4);
			$query = $this->db->get_where('bookings', array('event_date'=>$date));
			return $query->result_array();
		}
		public function get_event_name($day, $month, $year){
			$date = $year.'-'.$month.'-'.$day;
			$query = $this->db->get_where('bookings', array('event_date'=>$date));
			$data = $query->result_array();
			
			// echo '<pre>';
			// print_r($data[0]['event_name']);
			// echo '</pre>';

			if(count($data) > 1){
				foreach($data as $d){
					$temp[] = $d['event_name'];
				}
				return $temp;
			}else{
				return $data[0]['event_name'];
			}
		}
    }