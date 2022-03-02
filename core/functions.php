<?php

function getUri()
{
	$uri = $_SERVER['REQUEST_URI'];

	if (false !== $pos = strpos($uri, '?')) {
	    $uri = substr($uri, 0, $pos);
	}

	$uri = trim($uri, '/');
	
	return rawurldecode($uri);
}

/*
* Dump & die
*
*/
function dd($arr)
{
	echo "<pre>";
	var_dump($arr);
    echo "</pre>";
    exit();
}

/*
 * Redirect
 *
 */
function redirect(string $path)
{
	if($path === 'home')
	{
		$path = '/';
	}

	header("Location: {$path}");
	exit();
}

/**
* Clear input data
*
*/
function clearInput(string $data)
{
	$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}