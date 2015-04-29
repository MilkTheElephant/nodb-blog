<?php

function posts_display($post)
{
    include "conf.php";
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


    echo '<div class="post">';
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
    echo '</div>';
    if ($show_short_link == True)
    {
        echo "<div class='date'>";
        $hash = md5($post);
        $hash = substr($hash, 0, 6);
        echo "<a href='".$domain."/blog.php?p=".$hash."'>".$short_link_prefix."/".$hash."</a></div><br>";
    }
    echo "</div><br>";
    $pathFull = $post_dir."/".$post;
    if (pathinfo($pathFull, PATHINFO_EXTENSION ) == "html" || pathinfo($pathFull, PATHINFO_EXTENSION ) == "" )      //Get the file extension of the file. If it is html the treat as normal html file. Else parse as markdown
    {
        $out = file_get_contents($post_dir."/".$post); //Get post. TODO replace this with getting specific lines so that we can use plain text files instead of  HTML>
    }
    else if (  pathinfo($pathFull, PATHINFO_EXTENSION ) == "md")
    {
        $out = `markdown --html4tags $pathFull`;
    }

    if ($out == FALSE || $out == NULL)
    {
        echo "ERROR: Cannot find file:".$dir."/".$post."";
    }
    else
    {
        echo $out;
    }
    echo "</div>"; 
    return "";
    }

?>
