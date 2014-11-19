<?php


/**************************************************8
 * Config file for nodb-blog.
 *
 * This file is ran as PHP, so be careful that anything in here is valid PHP syntax.
*****************************************************/


// Directory to find posts in.
$post_dir = getcwd()."/posts";


//Page to send requests for specific posts/tags/postlists too:
$display_page = "localhost/blog.php";





// Blog post display settings:

$border = False;
$show_dates = True;
$show_tags = True;
