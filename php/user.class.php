<?php
require("DAL.class.php");

class user{

	private $_db;
	private $_uId;
	private $_name;
	private $_uname;
	private $_type;
	private $_active;
	
	public function __construct() {
   		$this->db = new DAL();
	}	
	
	public function __destruct(){
	
		$this->db=null;
	}
	
	public function getUID()
	{
		return $this->_uId;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function getType()
	{
		return $this->_type;
	}
	
	
	public function getUsers($search)
	{
		
		$sql="select * from users";
	
		if(!is_null($search))
			$sql.=" where u_name like '$search%'";
		
		try
		{
			$data=$this->db->getData($sql);
			
		
			//No data
			if(is_null($data))			
				return 0;
			else
				return $data;
		}catch(Exception $e) {	
			throw $e;
		}
	}
	
	public function getLogin($username,$password)
	{
		$sql="select * from users where u_uname='$username' and u_pwd='$password' and u_active=1";
	
		
		try
		{
			$data=$this->db->getData($sql);
		
			//user credentials are not valid or user is not active
			if(is_null($data))			
				return 0;			
			else//user credentials are valid and user is active
			{
				$user = new user();
				$user->_uId = $data[0]["u_id"];
				$user->_name = $data[0]["u_name"];
				$user->_type = $data[0]["u_type"];
				return $user;
			}
		}catch(Exception $e) {	
			throw $e;
		}
	}
	
	//check if username exists in DB
	public function checkUsername($username)
	{
		try
		{
			$sql="select * from users where u_uname='$username'";
			
			$data=$this->db->getData($sql);
			
			if(is_null($data))
				$result=0;
			else
				$result=1;
			
			
			return $result;
			
		}catch(Exception $e) {	
			throw $e;
		}		
	}
	
	
	public function addUser($name,$uname,$pwd,$type)
	{
		try
		{
			$sql="insert into users (u_name,u_uname,u_pwd,u_type,u_active) values ('$name','$uname','$pwd',$type,1)";
			
			$result=$this->db->ExecuteQuery($sql);
			
			return $result;
			
		}catch(Exception $e) {	
			throw $e;
		}		
	}
	
	
	public function updateUser($id,$name,$uname,$pwd,$type,$active)
	{
		try
		{
			$sql="update users set u_name='$name',u_uname='$uname',u_pwd='$pwd',u_type=$type, u_active=$active where u_id=$id";
			
			$result=$this->db->ExecuteQuery($sql);
			
			return $result;
			
		}catch(Exception $e) {	
			throw $e;
		}		
	}
	
	public function deactivateUser($id,$val)
	{
		try
		{
			$sql="update users set u_active=$val where u_id=$id";
			
			$result=$this->db->ExecuteQuery($sql);
			
			return $result;
			
		}catch(Exception $e) {	
			throw $e;
		}		
	}


}

?>