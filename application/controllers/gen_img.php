<?php 

class gen_img extends CI_Controller {

	
	function __construct() {
		parent::__construct();	
	}

	public function index(){
		$data['img'] = '';
		$this->load->view('template/header');
		$this->load->view('home/choose_background', $data);
		$this->load->view('template/footer');
	}

	public function generate_profile(){
		$data['msg'] = '';
		$this->load->view('template/header');
		$this->load->view('home/choose_background', $data);
		$this->load->view('template/footer');
	}

	public function gen_blackwhite($change){
		$source_file = $change;

		$im = ImageCreateFromJpeg($source_file); 

		$imgw = imagesx($im);
		$imgh = imagesy($im);

		for ($i=0; $i<$imgw; $i++)
		{
		        for ($j=0; $j<$imgh; $j++)
		        {

		                // get the rgb value for current pixel

		                $rgb = ImageColorAt($im, $i, $j); 

		                // extract each value for r, g, b

		                $rr = ($rgb >> 16) & 0xFF;
		                $gg = ($rgb >> 8) & 0xFF;
		                $bb = $rgb & 0xFF;

		                // get the Value from the RGB value

		                $g = round(($rr + $gg + $bb) / 3);

		                // grayscale values have r=g=b=g

		                $val = imagecolorallocate($im, $g, $g, $g);

		                // set the gray value

		                imagesetpixel ($im, $i, $j, $val);
		        }
		}

		return imagejpeg($im);
	}

	public function gen_black_n_white(){

		// create base image
		$this->load->library('facebook');
		$get_user = $this->facebook->api('/me?fields=id,name');					
		$user_profile = array(
			'photo'	=> 'https://graph.facebook.com/'.$get_user['id'].'/picture',
		);	

		$url = 'https://graph.facebook.com/'.$get_user['id'].'/picture?width=220&height=220';

		$img = $get_user['id'].'.jpg';
		file_put_contents($img, file_get_contents($url));

 		$im = ImageCreateFromJpeg($img); 

		$imgw = imagesx($im);
		$imgh = imagesy($im);

		for ($i=0; $i<$imgw; $i++)
		{
		        for ($j=0; $j<$imgh; $j++)
		        {

		                // get the rgb value for current pixel

		                $rgb = ImageColorAt($im, $i, $j); 

		                // extract each value for r, g, b

		                $rr = ($rgb >> 16) & 0xFF;
		                $gg = ($rgb >> 8) & 0xFF;
		                $bb = $rgb & 0xFF;

		                // get the Value from the RGB value

		                $g = round(($rr + $gg + $bb) / 3);

		                // grayscale values have r=g=b=g

		                $val = imagecolorallocate($im, $g, $g, $g);

		                // set the gray value

		                imagesetpixel ($im, $i, $j, $val);
		        }
		}

    	$destinationFileName = "uploads/".$get_user['id'].'nld2'.time().'.jpg';

    	//$destinationFileName = 'uploads/screens.jpg';

		//header('Content-Type: image/jpeg');
    // $fullPath = explode(".",$im);
    // $lastIndex = sizeof($fullPath) - 1;
    // $extension = $fullPath[$lastIndex];
    // if (preg_match("/jpg|jpeg|JPG|JPEG/", $extension)){
    //     $sourceImage = imagecreatefromjpeg($im);
    // }

    	$sourceImage = $im;
    // get image dimensions
    $img_width  = imageSX($sourceImage);
    $img_height = imageSY($sourceImage);

    // convert to grayscale
    // note: this will NOT affect your original image, unless
    // originalFileName and destinationFileName are the same
    for ($y = 0; $y <$img_height; $y++) {
        for ($x = 0; $x <$img_width; $x++) {
            $rgb = imagecolorat($sourceImage, $x, $y);
            $red   = ($rgb >> 16) & 0xFF;
            $green = ($rgb >> 8)  & 0xFF;
            $blue  = $rgb & 0xFF;

            $gray = round(.299*$red + .587*$green + .114*$blue);
           
            // shift gray level to the left
            $grayR = $gray << 16;   // R: red
            $grayG = $gray << 8;    // G: green
            $grayB = $gray;         // B: blue
           
            // OR operation to compute gray value
            $grayColor = $grayR | $grayG | $grayB;

            // set the pixel color
            imagesetpixel ($sourceImage, $x, $y, $grayColor);
            imagecolorallocate ($sourceImage, $gray, $gray, $gray);
        }
    }

    		// copy pixel values to new file buffer
    		$destinationImage = ImageCreateTrueColor($img_width, $img_height);
    		imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

    
		    // create file on disk
		    //imagejpeg($destinationImage, $destinationFileName);

		// create base image
		//$photo = imagecreatefromjpeg($as);
		$frame = imagecreatefrompng('nld_bg2.png');

		// get frame dimentions
		$frame_width = imagesx($frame);
		$frame_height = imagesy($frame);

		// get photo dimentions
		$photo_width = imagesx($destinationImage);
		$photo_height = imagesy($destinationImage);

		// creating canvas of the same dimentions as of frame
		$canvas = imagecreatetruecolor($frame_width,$frame_height);

		// make $canvas transparent
		imagealphablending($canvas, false);
		$col=imagecolorallocatealpha($canvas,0, 0, 0,127);
		imagefilledrectangle($canvas,0,0,$frame_width,$frame_height,$col);
		imagealphablending($canvas,true);    
		imagesavealpha($canvas, true);

		// merge photo with frame and paste on canvas
		imagecopyresized($canvas, $destinationImage, 0, 0, 0, 0, $frame_width, $frame_height,$photo_width, $photo_height); // resize photo to fit in frame
		imagecopy($canvas, $frame, 0, 0, 0, 0, $frame_width, $frame_height);

 		//header('Content-type: image/jpeg');
		imagejpeg($canvas, $destinationFileName);
		
		imagedestroy($destinationImage);
		imagedestroy($frame);
		imagedestroy($canvas);
		$this->session->set_flashdata('msg', 'nld2'.time());
		redirect(base_url().'home/display_image');		

	}

	public function output_profile($bg_type) {
		$data['msg'] = $this->session->flashdata('msg');
		if($bg_type == 'nld'){
			$imtype = 'nld_bg.png';
		}
		else if($bg_type == 'shan'){
			$imtype = 'shan.png';
		}
		else if($bg_type == 'manu1'){
			$imtype = 'manu_1.png';
		}		
		else{
			show_404();
		}

		// create base image
		$this->load->library('facebook');
		$get_user = $this->facebook->api('/me?fields=id,name');					
		$user_profile = array(
			'photo'	=> 'https://graph.facebook.com/'.$get_user['id'].'/picture',
		);	

		$url = 'https://graph.facebook.com/'.$get_user['id'].'/picture?width=220&height=220';

		$img = $get_user['id'].$bg_type.'.jpg';
		file_put_contents($img, file_get_contents($url));
		//$img = '1161216487240959.jpg';
 		$originalFileName    = $img;
    	$destinationFileName = "uploads/".$get_user['id'].$bg_type.time().'.jpg';

    	//$destinationFileName = 'uploads/screens.jpg';

		//header('Content-Type: image/jpeg');
    $fullPath = explode(".",$originalFileName);
    $lastIndex = sizeof($fullPath) - 1;
    $extension = $fullPath[$lastIndex];
    if (preg_match("/jpg|jpeg|JPG|JPEG/", $extension)){
        $sourceImage = imagecreatefromjpeg($originalFileName);
    }

    // get image dimensions
    $img_width  = imageSX($sourceImage);
    $img_height = imageSY($sourceImage);

    // convert to grayscale
    // note: this will NOT affect your original image, unless
    // originalFileName and destinationFileName are the same
    for ($y = 0; $y <$img_height; $y++) {
        for ($x = 0; $x <$img_width; $x++) {
            $rgb = imagecolorat($sourceImage, $x, $y);
            $red   = ($rgb >> 16) & 0xFF;
            $green = ($rgb >> 8)  & 0xFF;
            $blue  = $rgb & 0xFF;

            $gray = round(.299*$red + .587*$green + .114*$blue);
           
            // shift gray level to the left
            $grayR = $gray << 16;   // R: red
            $grayG = $gray << 8;    // G: green
            $grayB = $gray;         // B: blue
           
            // OR operation to compute gray value
            $grayColor = $grayR | $grayG | $grayB;

            // set the pixel color
            imagesetpixel ($sourceImage, $x, $y, $grayColor);
            imagecolorallocate ($sourceImage, $gray, $gray, $gray);
        }
    }

    		// copy pixel values to new file buffer
    		$destinationImage = ImageCreateTrueColor($img_width, $img_height);
    		imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

    
		    // create file on disk
		    //imagejpeg($destinationImage, $destinationFileName);

		// create base image
		//$photo = imagecreatefromjpeg($as);
		$frame = imagecreatefrompng($imtype);

		// get frame dimentions
		$frame_width = imagesx($frame);
		$frame_height = imagesy($frame);

		// get photo dimentions
		$photo_width = imagesx($destinationImage);
		$photo_height = imagesy($destinationImage);

		// creating canvas of the same dimentions as of frame
		$canvas = imagecreatetruecolor($frame_width,$frame_height);

		// make $canvas transparent
		imagealphablending($canvas, false);
		$col=imagecolorallocatealpha($canvas,0, 0, 0,127);
		imagefilledrectangle($canvas,0,0,$frame_width,$frame_height,$col);
		imagealphablending($canvas,true);    
		imagesavealpha($canvas, true);

		// merge photo with frame and paste on canvas
		imagecopyresized($canvas, $destinationImage, 0, 0, 0, 0, $frame_width, $frame_height,$photo_width, $photo_height); // resize photo to fit in frame
		imagecopy($canvas, $frame, 0, 0, 0, 0, $frame_width, $frame_height);

		// return file
		//header('Content-Type: image/png');
		//imagepng($canvas);
		//$newmpng = imagecreatefrompng($aa);
		  // $image = imagecreatefrompng($newmpng);
		  // filter_opacity( $newmpimageng, 65 );
		  // header('Content-Type: image/png');
		imagepng($canvas, $destinationFileName);
		  // imagedestroy($image);

		// destroy images to free alocated memory
		imagedestroy($destinationImage);
		imagedestroy($frame);
		imagedestroy($canvas);
		$this->session->set_flashdata('msg', $bg_type.time());
		redirect(base_url().'home/display_image');

		// $data['get_user'] = $get_user;
		// $this->load->view('template/header');
		// $this->load->view('currency_rate/display_image', $data);
		// $this->load->view('template/footer');		
	}		
		//$url = 'https://graph.facebook.com/newbalance/picture?type=large';

		//$headers = get_headers('https://graph.facebook.com/newbalance/picture',1); 
		//$url = $headers['Location'];

// 	public function generate_image($get_user){

// $url = 'https://graph.facebook.com/'.$get_user['id'].'/picture?width=168&height=168';
// $data = file_get_contents($url);



// // exit;
// // $fileName = 'fbss_profilepic.jpg';
// // $file = fopen($fileName, 'w+');
// // fputs($file, $data);
// // fclose($file);
		
// 		//$result = json_decode(file_get_contents("https://graph.facebook.com/". $get_user['id'] ."?fields=picture.type(normal)"),true);
// 		//$result = file_get_contents($result['picture']['data']['url']);
// 		//$akk = file_put_contents("desired_filename.jpg",$result);
// 		//$result = json_decode($result);
// 		//print_out($akk);
// 		//exit;
// 		//$userpic = imagecreatefromjpeg($data);

// 		// You may download the image first
// 		$img = $get_user['id'].'.jpg';
// 		file_put_contents($img, file_get_contents($url));

//  		$originalFileName    = $img;
//     	$destinationFileName = base_url()."public/test/gen_".$get_user['id'].'.jpg';

// 		//header('Content-Type: image/jpeg');
//     $fullPath = explode(".",$originalFileName);
//     $lastIndex = sizeof($fullPath) - 1;
//     $extension = $fullPath[$lastIndex];
//     if (preg_match("/jpg|jpeg|JPG|JPEG/", $extension)){
//         $sourceImage = imagecreatefromjpeg($originalFileName);
//     }

//     // get image dimensions
//     $img_width  = imageSX($sourceImage);
//     $img_height = imageSY($sourceImage);

//     // convert to grayscale
//     // note: this will NOT affect your original image, unless
//     // originalFileName and destinationFileName are the same
//     for ($y = 0; $y <$img_height; $y++) {
//         for ($x = 0; $x <$img_width; $x++) {
//             $rgb = imagecolorat($sourceImage, $x, $y);
//             $red   = ($rgb >> 16) & 0xFF;
//             $green = ($rgb >> 8)  & 0xFF;
//             $blue  = $rgb & 0xFF;

//             $gray = round(.299*$red + .587*$green + .114*$blue);
           
//             // shift gray level to the left
//             $grayR = $gray << 16;   // R: red
//             $grayG = $gray << 8;    // G: green
//             $grayB = $gray;         // B: blue
           
//             // OR operation to compute gray value
//             $grayColor = $grayR | $grayG | $grayB;

//             // set the pixel color
//             imagesetpixel ($sourceImage, $x, $y, $grayColor);
//             imagecolorallocate ($sourceImage, $gray, $gray, $gray);
//         }
//     }

//     		// copy pixel values to new file buffer
//     		$destinationImage = ImageCreateTrueColor($img_width, $img_height);
//     		imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

    
// 		    // create file on disk
// 		    //imagejpeg($destinationImage, $destinationFileName);

// 		// create base image
// 		//$photo = imagecreatefromjpeg($as);
// 		$frame = imagecreatefrompng("nld_bg.png");

// 		// get frame dimentions
// 		$frame_width = imagesx($frame);
// 		$frame_height = imagesy($frame);

// 		// get photo dimentions
// 		$photo_width = imagesx($destinationImage);
// 		$photo_height = imagesy($destinationImage);

// 		// creating canvas of the same dimentions as of frame
// 		$canvas = imagecreatetruecolor($frame_width,$frame_height);

// 		// make $canvas transparent
// 		imagealphablending($canvas, false);
// 		$col=imagecolorallocatealpha($canvas,0, 0, 0,127);
// 		imagefilledrectangle($canvas,0,0,$frame_width,$frame_height,$col);
// 		imagealphablending($canvas,true);    
// 		imagesavealpha($canvas, true);

// 		// merge photo with frame and paste on canvas
// 		imagecopyresized($canvas, $destinationImage, 0, 0, 0, 0, $frame_width, $frame_height,$photo_width, $photo_height); // resize photo to fit in frame
// 		imagecopy($canvas, $frame, 0, 0, 0, 0, $frame_width, $frame_height);

// 		// return file
// 		//header('Content-Type: image/png');
// 		imagepng($canvas);

// 		//$newmpng = imagecreatefrompng($aa);
// 		  // $image = imagecreatefrompng($newmpng);
// 		  // filter_opacity( $newmpimageng, 65 );
// 		  // header('Content-Type: image/png');
// 		//imagepng($canvas);
// 		  // imagedestroy($image);

// 		// destroy images to free alocated memory
// 		imagedestroy($destinationImage);
// 		imagedestroy($frame);
// 		imagedestroy($canvas);

// 	}

}
?>