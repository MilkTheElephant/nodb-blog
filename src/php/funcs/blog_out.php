<?php
require_once "blog_out.php";

function blog_out($max_posts) //main blog out function. Prints out and formats posts. takes int as max number of posts to print.
{    
    include "conf.php";
    include $small_link_dir."/src/php/small_link.php"; 
   
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
        $tag = $_GET["tag"];
        
        if ($dir == "" && $tag == "")
        {
            $dir = $post_dir;   //If the folder wasnt specified, then use the posts folder
        }

        else if (!empty($tag))
        {
            $dir = $tags_dir."/".$tag."/";
        }

        $dh = opendir($dir);
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
        rsort($files); 
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
                    $tagfile = $post_dir."/.".$f."_tags";
                    $tags = fopen($tagfile, "r");
                    if ($tags == FALSE)
                    {
                        echo 'ERROR: No tags file';
                    }
                    else
                    {
                        while (($line = fgets($tags)) !== FALSE )
                        {
                            echo "<a href='blog.php?tag=".$line."'>#".$line."</a>";
                        }
                    }
                }
                echo "</div>";
                if ($show_short_link == True)
                {
                    echo "<div class='date'>";
                    $hash = md5($f);
                    $hash = substr($hash, 0, 6);
                    echo "<a href='".$domain."/blog.php?p=".$hash."'>/".$hash."</a></div><br>";
                }

                
                echo "</div><br>";
                $out = file_get_contents($dir."/".$f); //Get post. TODO replace this with getting specific lines so that we can use plain text files instead of  HTML>
                if ($small_link == True)
                {
                       //If small link is enabled then generate a small url and put oit at the bottom.
                    small_link($small_link_domain."/".$display_page."?post=".$f); 
                }
                if ($out == FALSE)
                {
                    echo "ERROR: Cannot find file:".$dir."/".$f."";
                }
                else
                {
                    echo $out."<br>";
                }
            }
            $count++;
        }
    echo '<br><div align="right">Powered by: <a href="https://github.com/MilkTheElephant/nodb-blog">Nodb-Blog - Version: '.$version.'</a></div>';
        return;
}

?>

