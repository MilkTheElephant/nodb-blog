<?php

//  1 or "blog" = displays all posts, takes max posts as auxinfo
//  2 = or "folder" =  displays folder
//  3 = or "post" = Displays a specific post.


function nodb_blog($content, $auxinfo)
{
    include "conf.php";
    include_once "funcs/blog_out.php";    
    include_once "funcs/folder_display.php";
    include_once "funcs/post.php";

    if ($content == "blog" or $content == 1)
    {
        blog_out($auxinfo);
        return "";
    }
    else if ($content == "folder" or $content == 2)
    {
        folder_display();
        return "";

    }
    else if ($content == "post" or $content == 3)
    {
        posts_display($auxinfo);
        return "";
    }
}
?>
