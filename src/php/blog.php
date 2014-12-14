<?php

//  1 or "blog" = displays all posts, takes max posts as auxinfo
//  2 = or "folder" =  displays folder
//  3 = or "post" = Displays a specific post.


function nodb_blog($content, $auxinfo)
{
    //include "nodb-blog/src/php/funcs/blog_out.php";    
    include "nodb-blog/src/php/funcs/folder_display.php";
    include "nodb-blog/src/php/funcs/post.php";

    if ($content == "blog" or $content == 1)
    {
        ///blog_out($auxinfo);
        echo "Blog Out disabled because I didnt commit the file containing the function. Will commit when i can";
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
