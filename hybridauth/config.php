<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
		array(
			"base_url" => "https://mactosys.com/pewnyparking/hybridauth/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => true
				),
				"Google" => array(
					"enabled" => true,
                    "keys"    => array ( "id" => "797353433483-g68hru756k4sngq5qmoujhp7qhor1tt8.apps.googleusercontent.com",
				"secret" => "Y7tlZCahTd2iMju7_UAjfwbg" ), 				
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "258947264768676", "secret" => "ed5e7f06f3a84b6a55a01982c8f41d4f"),
					"scope"   => ['email', 'user_about_me', 'user_birthday', 'user_hometown'], // optional
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "uhRsWpVuv5cNDy4KMOZuu9ydF", "secret" => "DZGISBfczI1itjYzKI7ziU6cddxrcEUw0LtVdciZjKvkD4kSeH"),
					"includeEmail" => true
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
					"fields" => array()
				),
				"Foursquare" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => false,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "",
);
