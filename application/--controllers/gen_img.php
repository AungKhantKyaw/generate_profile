<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gen_img extends CI_Controller {

	
	function __construct() {
		parent::__construct();	
	}

	public function index() {
		// create base image
		$this->load->library('facebook');
		$get_user = $this->facebook->api('/me?fields=id,name');					
		$user_profile = array(
			'photo'	=> 'https://graph.facebook.com/'.$get_user['id'].'/picture',
		);	

		$url = 'https://graph.facebook.com/'.$get_user['id'].'/picture?width=220&height=220';
		//$data = file_get_contents($url);



// exit;
// $fileName = 'fbss_profilepic.jpg';
// $file = fopen($fileName, 'w+');
// fputs($file, $data);
// fclose($file);
		
		//$result = json_decode(file_get_contents("https://graph.facebook.com/". $get_user['id'] ."?fields=picture.type(normal)"),true);
		//$result = file_get_contents($result['picture']['data']['url']);
		//$akk = file_put_contents("desired_filename.jpg",$result);
		//$result = json_decode($result);
		//print_out($akk);
		//exit;
		//$userpic = imagecreatefromjpeg($data);

		// You may download the image first
		$img = $get_user['id'].'.jpg';
		file_put_contents($img, file_get_contents($url));

 		$originalFileName    = $img;
    	$destinationFileName = "uploads/".$get_user['id'].'.jpg';

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
		$frame = imagecreatefrompng("nld_bg.png");

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

	//get profile album
	// print_out($get_user);
	// $albums = $get_user['albums'];
	// print_out($albums);
	// exit;
	// $album_id = ""; 
	// foreach($albums["data"] as $item){
	// 	if($item["type"] == "profile"){
	// 		$album_id = $item["id"];
	// 		break;
	// 	}
	// }
 
	// //set photo atributes
	// $full_image_path = realpath("uploads/". $get_user['id'] . ".jpg");
	// $args = array('message' => 'Uploaded by generateyourprofile.com');
	// $args['image'] = '@' . $full_image_path;
 
	// //upload photo to Facebook
	// $updata 	= $this->facebook->api("/{$album_id}/photos", 'post', $args);
	// $pictue 	= $this->facebook->api('/'.$updata['id']);
 
	// $data['fb_image_link'] = $pictue['link']."&makeprofile=1";
 
	//redirect to uploaded photo url and change profile picture
	


		$data['get_user'] = $get_user;
		$this->load->view('template/header');
		$this->load->view('currency_rate/display_image', $data);
		$this->load->view('template/footer');		
	}		
		//$url = 'https://graph.facebook.com/newbalance/picture?type=large';

		//$headers = get_headers('https://graph.facebook.com/newbalance/picture',1); 
		//$url = $headers['Location'];

	public function generate_image($get_user){

$url = 'https://graph.facebook.com/'.$get_user['id'].'/picture?width=168&height=168';
$data = file_get_contents($url);



// exit;
// $fileName = 'fbss_profilepic.jpg';
// $file = fopen($fileName, 'w+');
// fputs($file, $data);
// fclose($file);
		
		//$result = json_decode(file_get_contents("https://graph.facebook.com/". $get_user['id'] ."?fields=picture.type(normal)"),true);
		//$result = file_get_contents($result['picture']['data']['url']);
		//$akk = file_put_contents("desired_filename.jpg",$result);
		//$result = json_decode($result);
		//print_out($akk);
		//exit;
		//$userpic = imagecreatefromjpeg($data);

		// You may download the image first
		$img = $get_user['id'].'.jpg';
		file_put_contents($img, file_get_contents($url));

 		$originalFileName    = $img;
    	$destinationFileName = base_url()."public/test/gen_".$get_user['id'].'.jpg';

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
		$frame = imagecreatefrompng("nld_bg.png");

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
		imagepng($canvas);

		//$newmpng = imagecreatefrompng($aa);
		  // $image = imagecreatefrompng($newmpng);
		  // filter_opacity( $newmpimageng, 65 );
		  // header('Content-Type: image/png');
		//imagepng($canvas);
		  // imagedestroy($image);

		// destroy images to free alocated memory
		imagedestroy($destinationImage);
		imagedestroy($frame);
		imagedestroy($canvas);

	}

}
?>