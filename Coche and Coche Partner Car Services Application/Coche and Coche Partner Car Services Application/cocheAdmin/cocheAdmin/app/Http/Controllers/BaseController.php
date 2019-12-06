<?php
namespace App\Http\Controllers;


use Parse\ParseClient;

use App\Http\Controllers\Controller;


class BaseController extends Controller {
    
    public function __construct()
    {
        //parent::__construct();
		
		ParseClient::initialize( "D5tEJTTnYCyj4YIP33SNJHfOMB5JYmAbdOHB2epG", "CYgCSPKd5C2p59ssYYwPGbIVSKy6E690qctJWjox", "9zxgYaUGOTUdpgpTd9h4owEytqpxOK0or4fqhcBh" );
		ParseClient::setServerURL('https://parseapi.back4app.com', '/');

    }

}