<?php

$config['reuse_query_string'] = TRUE;

$config["full_tag_open"] = '<ul class="pagination">';
$config["full_tag_close"] = '</ul>';	

$config["first_link"] = "&laquo;";
$config["first_tag_open"] = "<li class='page-item'>";
$config["first_tag_close"] = "</li>";

$config["last_link"] = "&raquo;";
$config["last_tag_open"] = "<li class='page-item'>";
$config["last_tag_close"] = "</li>";

$config['next_link'] = 'Next'; // '&gt;';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '<li>';

$config['prev_link'] = 'Previous'; // '&lt;';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '<li>';
$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = array('class' => 'page-link');