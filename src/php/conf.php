<?php


/**************************************************
 * Config file for nodb-blog.
 *
 * This file is ran as PHP, so be careful that anything in here is valid PHP syntax.
*****************************************************/

//Set include directory.
set_include_path(getcwd()."/nodb-blog/src/php/");


//Directory in which the folder for nodb-blog resides.
//If you installed nodb-blog to anywhere else other than here you'll need to change this.
$master_dir = "/var/www/"; 



// Directory to find posts in.
$post_dir = getcwd()."/posts";
// Directory to find tags in.
$tags_dir = getcwd()."/tags";


//Page to send requests for specific posts/tags/postlists too
//Loads this page when tags, Read More links, or links in a list of posts is clicked.
//This page must call the blog() function somewhere on the page.
$display_page = getcwd()."/blog.php";

//Format of date displayed everywhere.
//See http://php.net/manual/en/function.date.php for formatting options.

//$date_format = "d-m-y"; //10-09-14
//$date_format = "D-M-Y"; //Mon-Oct-2014
//$date_format = "d-F-y"; //10-October-2014
//$date_format = "d-M-y";  //10-Oct-14 
$date_format = "dS F Y";  //10th October 2014



// Blog post display settings:

$show_hr  = False; //shows/hides horizontal line under post title.
$show_dates = True; //shows/hides tags in post display
$show_tags = True; //shows/hides date in post display
$show_short_link = True; //shows/hides shortened link. REQURES domain to be populated
$short_link_prefix = "Sharing Link: "; //Text to prefix the sharing link with. Can be left blank

$domain = "";




//The version of nodb-blog Changing this may cause some features to be disabled.
$version = "1.0.4-beta.php";
?>
