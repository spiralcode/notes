<?php

/*PHP Ease makes coding easy in PHP.
 * Written by RajKrishnan R
 * 
 */


function post($identity)
{
	return $_POST[$identity];
}
function get($identity)
{
	return $_GET[$identity];
}
function sess($identity)
{
	return $_SESSION[$identity];
}
function globe($identity)
{
	return $GLOBALS[$identity];
}
function riskdata($variable)
{
	if($variable=='')
	{
		echo "<i>not available</i>";
	}
	else
	{
		echo $variable;
	}
}
function isBetween($start,$end,$value)
{
    if($start<$end)
    {
    if($value>$start&&$value<$end)
    {
        return true;
    }
    else
    {
        return false;
    }
    }
    else
    {
         if($value>$end&&$value<$start)
    {
        return true;
    }
    else
    {
        return false;
    }
    }
}

?>