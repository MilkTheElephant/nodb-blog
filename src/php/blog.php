<?php

//  1 or "blog" = displays all posts, takes max posts as auxinfo
//  2 = or "folder" =  displays folder


function nodb_blog($content, $auxinfo)
{
    include "funcs/blog_out.php";    
    include "funcs/folder_display.php";

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

}
?>
