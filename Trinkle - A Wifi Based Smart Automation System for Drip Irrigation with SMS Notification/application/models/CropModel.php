<?php
    class CropModel extends CI_Model {
            public function get_crop_parameters($crop_id){
                $result = $this->db->query("SELECT * FROM crop_parameters WHERE crop_id = '{$crop_id}'");
                return $result->row();
            }

            public function get_selected_crop_data(){
                $result = $this->db->query("SELECT * FROM crop_parameters AS cp JOIN selected_crop AS sc ON cp.crop_id = sc.crop_id LIMIT 1");
                return $result->row();
            }
            
            public function get_selected_crop(){
                $result = $this->db->query("SELECT crop_id FROM selected_crop");
                return $result->row()->crop_id;
            }


            public function check_crop_parameters($sensorValues){
                $CI =& get_instance();
                $CI->load->model('SensorModel');

                $crop = $this->get_selected_crop();
                $parameter = $this->get_crop_parameters($crop);
                $valveStatus = $this->SensorModel->get_valve_status();

                $ret = false;      

                if($sensorValues['moisturevalue'] < $parameter->soilmoisture_min && $sensorValues['temperaturevalue'] <= $parameter->temperature_max && $sensorValues['temperaturevalue'] >= $parameter->temperature_min){
                        $ret = true;

                        if(!$valveStatus){
                            $this->SensorModel->update_valve_status(1);
                            $this->db->query("INSERT INTO `irrigation_data`(`start_date_time`, `start_soil_moisture`, `start_temperature`, crop_id) VALUES (now(), '".$sensorValues['moisturevalue']."', '".$sensorValues['temperaturevalue']."', ".$crop." )");
                        }           

                }elseif($sensorValues['moisturevalue'] > $parameter->soilmoisture_max || $sensorValues['temperaturevalue'] > $parameter->temperature_max || $sensorValues['temperaturevalue'] < $parameter->temperature_min){
                    if($valveStatus){
                        $this->SensorModel->update_valve_status(0);
                        $this->db->query("UPDATE `irrigation_data` SET `stop_date_time`=now() , `stop_soil_moisture`= '".$sensorValues['moisturevalue']."' ,`stop_temperature`= '".$sensorValues['temperaturevalue']."' order by irrigation_data_id desc limit 1");
                    }
                }

                return $ret;
            }

            public function get_all_crop_specifications(){
                $result = $this->db->query("SELECT * FROM crop_parameters");
                return $result->result();
            }

            public function add_crop($data){
                $check_existing = $this->db->query("SELECT * FROM crop_parameters WHERE crop_name = '{$data['crop_name']}'");
                if($check_existing->num_rows() == 0){
                    $result = $this->db->query("INSERT INTO `crop_parameters`(`crop_name`, `soilmoisture_max`, `soilmoisture_min`, `temperature_max`, `temperature_min`, `min_carbon_dioxide`, `max_carbon_dioxide`) VALUES ('{$data['crop_name']}',{$data['max_soil']},{$data['min_soil']},{$data['max_temp']},{$data['min_temp']},{$data['min_carbon']},{$data['max_carbon']})");
                }
                redirect(base_url('pages/load_crop_specifications'));
            }

            public function delete_crop_func($id){
                $this->db->query("DELETE FROM `crop_parameters` WHERE crop_id = {$id}");
            }

            public function crop_update($data){
                 $max_temp = $data['max-temp'];
                 $min_temp = $data['min-temp'];
                 $max_carbon = $data['max-carbon'];
                 $min_carbon = $data['min-carbon'];
                 $max_moisture = $data['max-moisture'];
                 $min_moisture = $data['min-moisture'];
                 $crop_name = $data['crop-name'];
                 $crop_id = $data['crop-id'];

                $this->db->query("UPDATE `crop_parameters` SET `crop_name`='{$crop_name}',`soilmoisture_max`={$max_moisture},`soilmoisture_min`={$min_moisture},`temperature_max`={$max_temp},`temperature_min`={$min_temp},`humidity`= 0,`min_carbon_dioxide`={$min_carbon},`max_carbon_dioxide`={$max_carbon} WHERE crop_id = {$crop_id}");
                
                redirect(base_url('pages/load_crop_specifications'));
            }
            public function get_specific_crop_data($id){
                $result = $this->db->query("SELECT * FROM `crop_parameters` WHERE crop_id = {$id}");
                return $result->result();
            }



            public function check_carbon($sensorValues){
                $CI =& get_instance();
                $CI->load->model('SensorModel');

                $parameter = $this->get_crop_parameters($this->get_selected_crop());

                $ret = false;

                if($sensorValues['carbondioxidevalue'] < $parameter->min_carbon_dioxide && $sensorValues['carbondioxidevalue'] >= 1){
                        $ret = true;
              
                }   

                return $ret;
            }

            public function use_crop($data){
                $result = $this->db->query("UPDATE `selected_crop` SET `crop_id`={$data['crop_id']}");
                redirect(base_url('pages/main'));
            }
            
    }
?>