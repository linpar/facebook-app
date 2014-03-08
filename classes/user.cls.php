<?php
class user
{
	var $first_name;
	var $last_name;
	var $email;
	var $location;
	var $college;
	var $username;
	var $level;
	var $last_correct_time;
	var $registration_time;
	var $guest;

	function __construct($db = NULL)
	{
		if(isset($_SESSION['email']))
		{
			$this->guest = 0;
			$this->email = $_SESSION['email'];
			if($db != NULL)
			{
				if($result = $db->select("nit_users","*","email='$this->email'"))
				{
					$this->first_name = $result[0]['first_name'];
					$this->last_name = $result[0]['last_name'];
					$this->location = $result[0]['location'];
					$this->college = $result[0]['college'];
					$this->username = $result[0]['username'];
					$this->level = $result[0]['level'];
					$this->last_correct_time = $result[0]['last_correct_time'];
					$this->registration_time = $result[0]['registration_time'];
				}
			}
		}
		else
			$this->guest = 1;
	}
	public function getUser($db)
	{
		if($result = $db->select("nit_users","*","email='$this->email'"))
		{
			$this->first_name = $result[0]['first_name'];
			$this->last_name = $result[0]['last_name'];
			$this->email = $result[0]['email'];
			$this->location = $result[0]['location'];
			$this->college = $result[0]['college'];
			$this->username = $result[0]['username'];
			$this->level = $result[0]['level'];
			$this->last_correct_time = $result[0]['last_correct_time'];
			$this->registration_time = $result[0]['registration_time'];
			return true;
		}
		else
			return false;
	}
	public function nextLevel($db)
	{
		global $base;
		$this->level += 1;
		$this->last_correct_time = time();
		if($db->update("nit_users","level",$this->level,"email='$this->email'") && $db->update("nit_users","last_correct_time",time(),"email='$this->email'"))
			redirect($base.'/level/'.$this->level);
		else
			return false;
	}
	public function password($pass,$rounds = 9)
	{
		$salt = "";
		$i = -1;
		$saltChars = array_merge(range(0,9),range('a','z'),range('A','Z'));
		while(++$i < 22)
			$salt .= $saltChars[array_rand($saltChars)];
		return crypt($pass, sprintf('$2y$%02d$', $rounds) . $salt);
	}
	
	public function login($db, $input_email, $input_password, $type, $url)
	{
		$this->email = $input_email;
		$this->password = urlencode($input_password);
		if($type == 'facebook' || $this->verify($db))
		{
			$this->guest = 0;
			$result =  $db->select("nit_users","*","email='$this->email'");
			$_SESSION['email'] = $this->email;
			$_SESSION['uid'] = $result[0]['uid'];
			redirect($url);
		}
		else 
		{
			echo '<div class="alert alert-danger alert-dismissable">Invalid email id or password.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
			$this->guest = 1;
			return false;
		}
	}
	
	public function logout($url)
	{
		$_SESSION = array();
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		session_destroy();
		redirect($url);
	}
	public function verify($db)
	{	
		$result =  $db->select("nit_users","password","email='$this->email'");
		$pass = $result[0]['password'];
		if(crypt($this->password,$pass) == $pass)
			return true;
		else
			return false;
	}
}
?>