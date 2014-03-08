<?php
class database
{
	public function connect()
	{
		global $db_host, $db_name, $db_user, $db_password;
		try {
			$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
		}
		catch(PDOException $e) {
		    echo $e->getMessage();
		    die();
		}
		return $db;
	}

	public function select($table,$query,$condition)
	{
		$db = $this->connect();
		$stmt = $db->prepare("SELECT $query FROM $table WHERE $condition");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$db = null;
		return $results;
	}

	//insert
	public function insert($table,$columns,$values)
	{
		$db = $this->connect();
		$stmt = $db->prepare("INSERT INTO $table ($columns) VALUES ($values)");
		$stmt->execute();
		$db = null;
		return 1;
	}

	//update
	public function update($table,$columns,$values,$condition)
	{
		$db = $this->connect();
		$i = 0;
	    $length = count($columns);
	    $data = '';
	    if($length > 1)
	        while($i < $length)
	        {
	            $data .= $columns[$i]."='".$values[$i];
	            if($i == $length-1)
	                $data .= "'";
	            else
	                $data .= "', ";
	            $i++;
	        }
	    else
	        $data .= $columns."='".$values."'";
	    $stmt = $db->prepare("UPDATE $table SET $data WHERE $condition");
		$stmt->execute();
		$db = null;
		return 1;
	}
}
?>