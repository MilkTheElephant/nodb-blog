<?php

function posts_display($post)
{
    include "nodb-blog/src/php/conf.php";
    echo "<style>
        .date {
            text-align: left;
            width: 49%;
            float: left;
            }
        .tags {
            text-align: right;
            width: 49%;
            float: right;
            }
        </style>";


    echo '<div style="width: 100%;">';
    echo "<div class='date'>";
    if ($show_dates == True) //show the dates if specified.
    {
        echo "<i style='text-align:left;'>".date($date_format,intval(substr($post, 0, strpos($post, "_"))))."</i><br>";
    }
    echo "</div>";
    echo "<div class='tags'>"; //Show the post's tags if specified.
    if ($show_tags  == True)
    {
        $tagfile = $post_dir."/.".$post."_tags";
        $tags = fopen($tagfile, "r");
        if ($tags == FALSE)
        {
            echo 'ERROR: No tags file';
        }
        else
        {
            while (($line = fgets($tags)) !== FALSE )
            {
                echo "<a href='/sbarratt/blog.php?tag=".$line."'>#".$line."</a>";
            }
        }
    }
    echo "</div></div><br>";
    $out = file_get_contents($post_dir."/".$post); //Get post. TODO replace this with getting specific lines so that we can use plain text files instead of  HTML>
    if ($out == FALSE)
    {
        echo "ERROR: Cannot find file:".$dir."/".$post."";
    }
    else
    {
        echo $out;
    }
    
    return "";
    }

?>
