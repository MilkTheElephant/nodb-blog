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
    include_once "funcs/unshorten.php";

    $return = "";

    if ($content == "blog" or $content == 1)
    {
        $return = blog_out($auxinfo);
        return $return;
    }
    else if ($content == "folder" or $content == 2)
    {
        $return = folder_display();
        return "";

    }
    else if ($content == "post" or $content == 3)
    {
        $return = posts_display($auxinfo);
        return "";
    }
    else if ($content == "short" or $content == 4)
    {
        $return = unshorten($auxinfo);
        if ($return != False)
        {
            $post = $return;
        }
        posts_display($post);
    }


}
?>
