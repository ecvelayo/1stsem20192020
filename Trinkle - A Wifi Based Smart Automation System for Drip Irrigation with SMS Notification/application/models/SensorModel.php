  <?php
        class SensorModel extends CI_Model {

            public function insert_sensor_value($sensorValues){
            $result = $this->db->query("INSERT INTO log (soilmoisture_value,temperature_value,humidity_value,carbondioxide_value) 
                                        VALUES ('".$sensorValues['moisturevalue']."',
                                                '".$sensorValues['temperaturevalue']."',
                                                '".$sensorValues['humidityvalue']."',
                                                '".$sensorValues['carbondioxidevalue']."')");
            }

            public function get_latest_sensor_value(){
                $result = $this->db->query("SELECT * FROM log ORDER BY log_id DESC LIMIT 1");
                return $result->row();
            }
			
            public function get_latest(){
                $result = $this->db->query("SELECT * FROM log ORDER BY log_id DESC LIMIT 1");
                return $result->result();
            }

            public function insert_system_logs($sensorValues){
            $result = $this->db->query("INSERT INTO system_logs (datetime,soilmoisture_value,temperature_value,humidity_value,carbondioxide_value) 
                                        VALUES (NOW(),
                                                '".$sensorValues['moisturevalue']."',
                                                '".$sensorValues['temperaturevalue']."',
                                                '".$sensorValues['humidityvalue']."',
                                                '".$sensorValues['carbondioxidevalue']."')");                    
            }
			
            public function get_all_system_logs(){
                $result = $this->db->query("SELECT * FROM log LIMIT 50");
                return $result->result();
            }

            public function get_valve_status(){
                $result = $this->db->query("SELECT * FROM valve_status LIMIT 1");
                return $result->row()->status;
            }

            public function update_valve_status($status){
                $this->db->query("UPDATE `valve_status` SET `status`= " . $status. "  WHERE 1");
            }

            public function get_all_irrigation_data(){
                $result = $this->db->query("SELECT * FROM crop_parameters JOIN irrigation_data ON crop_parameters.crop_id = irrigation_data.crop_id");
                return $result->result();
            }

        }
?>