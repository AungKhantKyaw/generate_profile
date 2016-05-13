<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('is_login')) {
    function is_login($user = NULL) {
		$CI =& get_instance();
		// We need to use $CI->session instead of $this->session
		$valid = $CI->session->userdata('validate_user');	
		if(!$valid) {
			redirect('/adminlogin');
		}
		else {
			if($user != NULL) {
				$login_user = $CI->session->userdata('login_user');	
				if($login_user != $user) {
					show_404();
				}
			}
		}
	}   
}

if ( ! function_exists('check_role')) {
    function check_role($user = NULL) {
		$CI =& get_instance();
		// We need to use $CI->session instead of $this->session
		$valid = $CI->session->userdata('validate_user');	
		if(!$valid) {
			redirect('/login');
		}
		else {
			if($user != NULL) {
				$login_user = $CI->session->userdata('login_user');	
				if($user != 'user')
				{
					show_404();
				}
				// if($login_user != $user) {
				// 	show_404();
				// }
			}
		}
	}   
}

if ( ! function_exists('send_email')) {
    function send_email($fromname, $from, $to, $subject, $message , $cc = NULL, $bcc = NULL) {
      	$CI =& get_instance();
      	$CI->email->from($from, $fromname);
		$CI->email->to($to); 

		if($cc != NULL) {
			$CI->email->cc($cc);
		}

		if($bcc != NULL) {
			$CI->email->bcc($bcc); 
		}


		$CI->email->subject($subject);
		$CI->email->message($message);	
		$CI->email->send(); 
    }   
}

/*
 *
 * Just print out for array and object
 */
if ( ! function_exists('print_out')) {
    function print_out($arr) {
       print "<pre>";
       print_r($arr);
       print "</pre>";
    }   
}
if ( ! function_exists('get_timestamp')) {
	function get_timestamp($date, $symbol) {
		$dateparts = explode($symbol, $date);
		return mktime(0,0,0,$dateparts[1],$dateparts[0],$dateparts[2]);
	}
}

if ( ! function_exists('get_earliesttimestamp')) {
	function get_earliesttimestamp($date, $symbol) {
		$dateparts = explode($symbol, $date);
		return mktime(0,0,0,$dateparts[1],$dateparts[0],$dateparts[2]);
	}
}

if ( ! function_exists('get_latesttimestamp')) {
	function get_latesttimestamp($date, $symbol) {
		$dateparts = explode($symbol, $date);
		return mktime(23,59,59,$dateparts[1],$dateparts[0],$dateparts[2]);
	}
}

/**
 *
 *	get date from timestamp
 */
if ( ! function_exists('get_date')) {
	function get_date($timestamp) {
		return date("d-m-Y", $timestamp);
	}
}

/**
 *
 *	get time from timestamp
 */
if ( ! function_exists('get_time')) {
	function get_time($timestamp) {
		return date("H:i", $timestamp);
	}
}

/**
 *
 *	get timestamp by given date and time
 */
if ( ! function_exists('get_datetimestamp')) {
	function get_datetimestamp($date, $time, $datesymbol, $timesymbol) {
		$dateparts = explode($datesymbol, $date);
		$timeparts = explode($timesymbol, $time);
		return mktime($timeparts[0],$timeparts[1],0,$dateparts[1],$dateparts[0],$dateparts[2]);
	}
}

if(! function_exists('generateRandomString')){
	function generateRandomString($length = 6) {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
/**
 *
 *  Prepare config for bootstrap style pagination  
 */
if(! function_exists('create_pagination_config')) {
	function create_pagination_config($base_url, $total_rows, $per_page, $uri_segment) {
		$config = array(
			'base_url' 	  	 => $base_url,
			'total_rows'  	 => $total_rows,
			'per_page'	  	 => $per_page,
			'uri_segment'	 => $uri_segment,
			'full_tag_open'	 => '<ul class="pagination pagination-sm">', 
			'full_tag_close' => '</ul>', 
			'num_tag_open' 	 => '<li>',
			'num_tag_close'  => '</li>', 
			'cur_tag_open' 	 => '<li class="active"><span>',
			'cur_tag_close'  => '<span class="sr-only">(current)</span></span></li>', 
			'prev_tag_open'  => '<li>', 
			'prev_tag_close' => '</li>', 
			'next_tag_open'  => '<li>', 
			'next_tag_close' => '</li>',
			'first_link' 	 => '&laquo;first', 
			'prev_link' 	 => '&lsaquo;', 
			'last_link' 	 => 'last&raquo;', 
			'next_link' 	 => '&rsaquo;', 
			'first_tag_open' => '<li>',
			'first_tag_close'=> '</li>', 
			'last_tag_open'  => '<li>',
			'last_tag_close' => '</li>', 
			'additional_param' => '?pcp=88'
		);
		return $config;
	}
}


function in_multiarray($elem, $array,$field)
{
	$array = array_filter($array);
    $top = sizeof($array) - 1;
    $bottom = 0;
    while($bottom <= $top)
    {
        if($array[$bottom][$field] == $elem)
            return true;
        else 
            if(is_array($array[$bottom][$field]))
                if(in_multiarray($elem, ($array[$bottom][$field])))
                    return true;

        $bottom++;
    }        
    return false;
}

if ( ! function_exists('check_perm')) {
    function check_permission($role_id,$controller_name,$method) {
		$CI =& get_instance();
		$CI->load->model('permission_model');
		//echo $controller_name;
		$data = $CI->permission_model->check_perm($role_id,$controller_name);
		
		if(!empty($data)){
			$perm_methods = json_decode($data['perm'],true);

			// $aMethods = get_class_methods($controller_name);
			if (array_key_exists($method, $perm_methods)) {
	    		$result = 1;	
			}
			else {
				$method_ary = explode('_', $method);

				// print_out($perm_methods);
				// print_out($method);
				// print_out($method_ary);
				// exit();
				if($method == '__construct' || $method == '__get'||$method_ary[0] == 'aj' || $method_ary[0] == 'check') {
					$result = 1;
				}
				else {
					$result = 0;
				}
			}
		}
		else { 
			$method_ary = explode('_', $method);
			if($method == '__construct' || $method == '__get'||$method_ary[0] == 'aj' || $method_ary[0] == 'check') {
				$result = 1;
			}
			else {
				$result = 0;
			}
		}

		return $result;
	}   
}

if (! function_exists('create_pagination_msg')) {
	function create_pagination_msg($current_page, $per_page, $total_rows){
		$start_row = ($current_page-1) * $per_page + 1;
		$end_row = ($current_page * $per_page) < $total_rows? $current_page * $per_page : $total_rows;
		if ($total_rows==0) {
			return 'No Results Found';
		}
		return "Showing ".$start_row." to ".$end_row." record(s) of ".$total_rows." total result(s)";
	}
}

if(! function_exists('get_file_ex')){
	function get_file_ex($file_name){
		return substr(strrchr($file_name,'.'),1);
	}
}

if(! function_exists('base64_url_encode')){
	function base64_url_encode($input) {
	 return strtr(base64_encode($input), '+/=', '-_n');
	}
}

if(! function_exists('base64_url_decode')){
	function base64_url_decode($input) {
	 return base64_decode(strtr($input, '-_n', '+/='));
	}
}

/**
 *
 *	get timestamp by given date and time
 */
if ( ! function_exists('get_the_current_url')) {
	function get_the_current_url() {
	    
	    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
	    $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
	    
	    return $complete_url;   
	}
}

if ( ! function_exists('random_password')) {
	function random_password() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = "";
	    for ($i = 0; $i < 8; $i++) {
	        $pass .= $alphabet[rand(0, strlen($alphabet)-1)];
	    }
	    return $pass;
	}
}


function force_download( $filename = '', $data = '' )
{
    if( $filename == '' || $data == '' )
    {
        return false;
    }
    
    if( !file_exists( $data ) )
    {
        return false;
    }

    // Try to determine if the filename includes a file extension.
    // We need it in order to set the MIME type
    if( false === strpos( $filename, '.' ) )
    {
        return false;
    }

    // Grab the file extension
    $extension = strtolower( pathinfo( basename( $filename ), PATHINFO_EXTENSION ) );

    // our list of mime types
    $mime_types = array(

        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',

        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    // Set a default mime if we can't find it
    if( !isset( $mime_types[$extension] ) )
    {
        $mime = 'application/octet-stream';
    }
    else
    {
        $mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
    }
        
    // Generate the server headers
    if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
    {
        header( 'Content-Type: "'.$mime.'"' );
        header( 'Content-Disposition: attachment; filename="'.$filename.'"' );
        header( 'Expires: 0' );
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( "Content-Transfer-Encoding: binary" );
        header( 'Pragma: public' );
        header( "Content-Length: ".filesize( $data ) );
    }
    else
    {
        header( "Pragma: public" );
        header( "Expires: 0" );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Cache-Control: private", false );
        header( "Content-Type: ".$mime, true, 200 );
        header( 'Content-Length: '.filesize( $data ) );
        header( 'Content-Disposition: attachment; filename='.$filename);
        header( "Content-Transfer-Encoding: binary" );
    }
    readfile( $data );
    exit;

} //End force_download
