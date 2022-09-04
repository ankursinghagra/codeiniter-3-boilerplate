<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function json_output($statusHeader,$response)
	{
		$ci =& get_instance();
		header("Access-Control-Allow-Origin: *");
		//header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Headers: 'X-AuthTokenHeader,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since,auth-token");
		//header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		//header("Access-Control-Allow-Max-Age: 1728000");
		$ci->output->set_content_type('application/json');
		$ci->output->set_status_header($statusHeader);
		$ci->output->set_output(json_encode($response));
	}