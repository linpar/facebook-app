<?php
class level
{
	var $uid;
	var $level_id;
	var $question;
	var $image;
	var $answer;
	var $exists;

	function __construct($db = NULL, $level_id = NULL)
	{
		if($db != NULL && $level_id != NULL)
		{
			if($result = $db->select("nit_levels","*","level_id='$level_id'"))
			{
				$this->uid = $result[0]['uid'];
				$this->level_id = $result[0]['level_id'];
				$this->question = $result[0]['question'];
				$this->image = $result[0]['image'];
				$this->answer = $result[0]['answer'];
				$this->exists = true;
				return true;
			}
			else
			{
				$this->exists = false;
				return false;
			}
		}
	}
	public function insertLevel($db = NULL, $level_id = NULL, $question = NULL, $image = NULL, $answer = NULL)
	{

	}
	public function getLevel($db = NULL, $level_id = NULL)
	{
		if($db != NULL && $level_id != NULL)
		{
			if($result = $db->select("nit_levels","*","level_id='$level_id'"))
			{
				$this->uid = $result[0]['uid'];
				$this->level_id = $result[0]['level_id'];
				$this->question = $result[0]['question'];
				$this->image = $result[0]['image'];
				$this->answer = $result[0]['answer'];
				$this->exists = true;
				return true;
			}
			else
			{
				$this->exists = false;
				return false;
			}
		}
		else
			return false;
	}
	public function encode($answer,$rounds = 9)
	{
		$salt = "";
		$i = -1;
		$saltChars = array_merge(range(0,9),range('a','z'),range('A','Z'));
		while(++$i < 22)
			$salt .= $saltChars[array_rand($saltChars)];
		return crypt($answer, sprintf('$2y$%02d$', $rounds) . $salt);
	}

	public function checkAnswer($db, $level_id, $userAnswer)
	{	
		$result =  $db->select("nit_levels","answer","level_id='$level_id'");
		$answer = $result[0]['answer'];
		if(crypt($userAnswer,$answer) == $answer)
			return true;
		else
			return false;
	}
}
?>