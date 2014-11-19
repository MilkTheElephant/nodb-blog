<?php


/**************************************************
 * Config file for nodb-blog.
 *
 * This file is ran as PHP, so be careful that anything in here is valid PHP syntax.
*****************************************************/


// Directory to find posts in.
$post_dir = getcwd()."/posts";


//Page to send requests for specific posts/tags/postlists too:
$display_page = "localhost/blog.php";

//Format of date displayed everywhere.
//See http://php.net/manual/en/function.date.php for formatting options.

//$date_format = "d-m-y"; //10-09-14
//$date_format = "D-M-Y"; //Mon-Oct-2014
//$date_format = "d-F-y"; //10-October-2014
//$date_format = "d-M-y";  //10-Oct-14 
$date_format = "dS F Y";  //10th October 2014



// Blog post display settings:

$border = False;
$show_dates = True;
$show_tags = True;
