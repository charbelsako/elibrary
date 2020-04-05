<?php

	//this web service can handle 7 types of requets based on a parameter op
    /*
	 op=1 (login) passing 2 more parameters uname, and upwd
	 op=2 (check if username) passing 1 more parameter uname
	 op=3 (add user) passing 4 more parameters uname,uuname, upwd, utype
	 op=4 (update user) passing 5 more parameters uid,uname, upwd, utype,uactive
	 op=5 (deactivate user) passing 1 more parameter uid
	 op=6 (logout)
	 op=7 (get users lists) passing 1 optional parameter search	 
	*/

	header('Access-Control-Allow-Origin: *');
	require_once('user.class.php');
	
	$user = new user();
	$result;

	
	try {	
		if(isset($_GET["op"]))//check is op exists
		{
			$op=$_GET["op"];
						
			
			switch ($op){ //login
				case 1:
					$result = $user->getLogin($_GET["uname"],$_GET["upwd"]);
				
					if(is_object($result))
					{
						session_start();
						
						//store id, uname, type in session, so it can be accessible in any php file
						$_SESSION["uid"]=$result->getUID();
						$_SESSION["uname"]=$result->getName();
						$_SESSION["utype"]=$result->getType();
						
						//store the type in result so to return it
						//$result=$result->getType();
						$result=1;
					}
							
				break;
				
				case 2:     //check if username exists
					$result = $user->checkUsername($_GET["uname"]);			
				break;
				
				case 3:     //add user
					$result = $user->addUser($_GET["uname"],$_GET["uuname"],$_GET["upwd"],$_GET["utype"]);
				break;
				
				case 4:     //update user
					$result = $user->updateUser(
						$_GET["id"],$_GET["name"],$_GET["uname"],$_GET["upwd"],$_GET["type"],$_GET["active"] );
					
				break;
				
				case 5:  //deactivate user
					$result = $user->deactivateUser($_GET["id"],$_GET["val"]);
				break;
								
				case 6:     //Logout
					session_start();
					session_unset(); 

					// destroy the session 
					session_destroy();
					
					$result =1;
				break;				
				
				case 7:   //get users
					if(isset($_GET["search"]))
						$search=$_GET["search"];
					else
						$search=null;
					
					$result=$user->getUsers($search);
				break;
					
				default:
			    break;
				;
			}

		}
	
		header("Content-type:application/json"); 						
		echo json_encode($result);
	}
	catch(Exception $e) {
		
		echo -1;
	}


		
?>