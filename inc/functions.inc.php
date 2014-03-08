<?php

//redirect to a URL
function redirect($to) 
{
	header("Location: $to");
	die();
}

?>