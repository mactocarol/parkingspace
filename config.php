<?php
//$con = mysqli_connect("localhost","root","","realestate");
$con=mysqli_connect("localhost","macto4j1_park","@Parking123","macto4j1_park");
$base_url="https://mactosys.com/pewnyparking/";


$sql="select ophoto,best,support from front_setting";
$logoq=mysqli_query($con,$sql);
$web_logo=$base_url."images/logo.png";

$ldata=mysqli_fetch_array($logoq);
$limg=$ldata['ophoto'];
$regards=$ldata['best'];
$web_logo=$base_url."images/".$limg;
$sender_email=$ldata['support'];
$support_email=$ldata['support'];

$config =array(
		"base_url" => $base_url."hybridauth/", 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "797353433483-g68hru756k4sngq5qmoujhp7qhor1tt8.apps.googleusercontent.com",
				"secret" => "Y7tlZCahTd2iMju7_UAjfwbg" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "258947264768676", "secret" => "ed5e7f06f3a84b6a55a01982c8f41d4f" ),
                "scope"   => ['email', 'user_about_me', 'user_birthday', 'user_hometown'], // optiona				
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "uhRsWpVuv5cNDy4KMOZuu9ydF", "secret" => "DZGISBfczI1itjYzKI7ziU6cddxrcEUw0LtVdciZjKvkD4kSeH" ), 
			     "includeEmail" => true
			),
			/*
			"LinkedIn" => array ( // 'key' is your twitter application consumer key
               "enabled" => true,
               "keys" => array ( "key" => "", "secret" => "" )
            ),*/
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "",
	);