<?php

function blog_out($max_posts) //main blog out function. Prints out and formats posts. takes int as max number of posts to print.
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
    
        $dir = $_GET["dir"]; //get directory
        if ($dir == "")
        {
            $dir = $post_dir;   //If the folder wasnt specified, then use the posts folder
        }
        $dh = opendir($post_dir);
        if ($dh == False)
        {
            echo "Could'nt open posts directory";
            return 0;
        }
    
        while (false !== ($filename = readdir($dh)))
        {
            $files[] = $filename;
        }
        
        $count = 0;         //variable that holds how many posts we've printed. 
        foreach ($files as $f)
        {

            if ($count >= $max_posts)
            {
                break;
            }
            if ($f != "." && $f != ".." && $f[0] != ".") //Don't print files starting with "." including the files "." and "..". 
            {
                echo '<div style="width: 100%;">';
                echo "<div class='date'>";
                if ($show_dates == True) //show the dates if specified.
                {
                    echo "<i style='text-align:left;'>".date($date_format,intval(substr($f, 0, strpos($f, "_"))))."</i><br>";
                }
                echo "</div>";
                echo "<div class='tags'>"; //Show the post's tags if specified.
                if ($show_tags  == True)
                {
                    $tagfile = $dir."/.".$f."_tags";
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
                $out = file_get_contents($dir."/".$f); //Get post. TODO replace this with getting specific lines so that we can use plain text files instead of  HTML>
                if ($out == FALSE)
                {
                    echo "ERROR: Cannot find file:".$dir."/".$f."";
                }
                else
                {
                    echo $out;
                }
            }
            $count++;
        }
        echo '<br><div align="right">Powered by: <a href="https://github.com/MilkTheElephant/nodb-blog">Nodb-Blog - Version: '.$version.'</a></div>';
        return "";
}
?>
