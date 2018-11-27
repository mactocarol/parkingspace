<?php       
		date_default_timezone_set("Asia/Kolkata");
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {

	          
				$fname=uniqid().'.jpg';
				$image = file_get_contents($user_profile->photoURL); // sets $image to the contents of the url
			   
				$uname=$user_profile->displayName;
				$email=$user_profile->email;
				$cdt=date("Y-m-d H:i:s");
				
				$sql="select id,type,photo,ophoto from user where email='".$email."'";
				$query=mysqli_query($con,$sql);

				if(mysqli_num_rows($query)>0)
				{
					if($row=mysqli_fetch_array($query))
					{
					$id=$row['id'];
					
					if($row['photo']!="")
					{
					@unlink("upload/user/".$row['photo']);
					@unlink("upload/user/".$row['ophoto']);
					}

                    file_put_contents('/home2/macto4j1/public_html/pewnyparking/upload/user/'.$fname.'', $image);
				
						
						$sql="update user set email='".$email."',photo='".$fname."',ophoto='".$fname."' where id='".$id."'";
						$q=mysqli_query($con,$sql);
						
					}
					
				}	
				else
				{
                    file_put_contents('/home2/macto4j1/public_html/pewnyparking/upload/user/'.$fname.'', $image);
					$sql="insert into user(name,email,created_dt,email_status,type,photo,ophoto,fb) values('".$uname."','".$email."','".$cdt."',1,'User','".$fname."','".$fname."',1)";
					$q=mysqli_query($con,$sql);
					$id=mysqli_insert_id($con);
										
				}
				
				?>
				<script>
				window.location="<?php echo $base_url; ?>Home/checkuser/<?php echo $id; ?>";
				</script>
				<?php
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : header("location: $base_url"); break;
                        case 1 : header("location: $base_url"); break;
                        case 2 : header("location: $base_url"); break;
                        case 3 : header("location: $base_url"); break;
                        case 4 : header("location: $base_url"); break;
                        case 5 : header("location: $base_url"); break;
                        case 6 : header("location: $base_url"); break;
                        case 7 : header("location: $base_url"); $twitter->logout(); break;
                        case 8 : header("location: $base_url"); break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>