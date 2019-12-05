<?php
    class Message_Model extends CI_Model {
        public function success_message(){
            echo '<div class="my-3 alert alert-success d-flex justify-content-center alert-block">'; 
            echo $this->session->flashdata('success_message');
            echo '</div>';
        }
        public function danger_message(){
            echo '<div class="my-3 alert alert-danger d-flex justify-content-center alert-block">'; 
            echo $this->session->flashdata('danger_message');
            echo '</div>';
        }
        public function warning_message(){
            echo '<div class="my-3 alert alert-warning d-flex justify-content-center alert-block">'; 
            echo $this->session->flashdata('warning_message');
            echo '</div>';
        }
    }