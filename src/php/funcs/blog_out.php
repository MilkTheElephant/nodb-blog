<?php
require_once "blog_out.php";

function blog_out($max_posts) //main blog out function. Prints out and formats posts. takes int as max number of posts to print.
{    
    include "conf.php";
    include $small_link_dir."/src/php/small_link.php"; 

    $return_string .= "<style>

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
            $return_string .= "Could'nt open posts directory";
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
                $return_string .= '<div class="post">';
                $return_string .= '<div style="width: 100%;">';
                $return_string .= "<div class='date'>";
                if ($show_dates == True) //show the dates if specified.
                {
                    $return_string .= "<i style='text-align:left;'>".date($date_format,intval(substr($f, 0, strpos($f, "_"))))."</i><br>";
                }
                $return_string .= "</div>";
                $return_string .= "<div class='tags'>"; //Show the post's tags if specified.
                if ($show_tags  == True)
                {
                    $tagfile = $post_dir."/.".$f."_tags";
                    $tags = fopen($tagfile, "r");
                    if ($tags == FALSE)
                    {
                        $return_string .= 'ERROR: No tags file';
                    }
                    else
                    {
                        while (($line = fgets($tags)) !== FALSE )
                        {
                            $return_string .= "<a href='blog.php?tag=".$line."'>#".$line."</a>";
                        }
                    }
                }
                $return_string .= "</div>";
                if ($show_short_link == True)
                {
                    $return_string .= "<div class='date'>";
                    $hash = md5($f);
                    $hash = substr($hash, 0, 6);
                    $return_string .= "<a href='".$domain."/blog.php?p=".$hash."'>".$short_link_prefix."/".$hash."</a></div><br>";
                }

                
                $return_string .= "</div><br>";
                $pathFull = $dir."/".$f;
                if (pathinfo($pathFull, PATHINFO_EXTENSION ) == "html" || pathinfo($pathFull, PATHINFO_EXTENSION ) == "" )      //Get the file extension of the file. If it is html the treat as normal html file. Else parse as markdown
                {
                    $out = file_get_contents($dir."/".$f); //Get post. TODO replace this with getting specific lines so that we can use plain text files instead of  HTML>
                }
                else if (  pathinfo($pathFull, PATHINFO_EXTENSION ) == "md")
                {
                    $out = `markdown --html4tags $pathFull`;
                }
                if ($small_link == True)
                {
                       //If small link is enabled then generate a small url and put oit at the bottom.
                    small_link($small_link_domain."/".$display_page."?post=".$f); 
                }
                if ($out == FALSE || $out == NULL)
                {
                    $return_string .= "ERROR: Cannot find file:".$dir."/".$f."";
                }
                else
                {
                    $return_string .= $out."<br>";
                }
            }
            $return_string .= "</div>";
            $count++;
        }
    $return_string .= '<br><div align="right">Powered by: <a href="https://github.com/MilkTheElephant/nodb-blog">Nodb-Blog - Version: '.$version.'</a></div>';
        return $return_string;
}

?>

