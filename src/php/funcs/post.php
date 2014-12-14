<?php

function posts_display($post)
{
    include "nodb-blog/src/php/conf.php";
    echo $post_dir."/".$post;
    echo file_get_contents($post_dir."/".$post);
    echo "Skeleton function to display a specific post";
    return "";
}

?>
