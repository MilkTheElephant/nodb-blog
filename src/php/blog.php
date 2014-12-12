<?php

function blog_out($max_posts) //main blog out function. Prints out and formats posts. takes int as max number of posts to print.
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

function folder_display() //Function displays all the posts in a set directiory. This is passed by GET and can be tags.
{
    include getcwd()."/nodb-blog/src/php/conf.php";

    if (empty($_GET["tag"]))
    {
        $dir = $post_dir."/".$_GET["dir"];
    }
    else if (empty($_GET["dir"]))
    {
        $dir = $tags_dir."/".$_GET["tag"];
    }
    else if (empty($_GET["tag"]) || empty($_GET["dir"])) //if there wasnt a name specified, then ensure that the directory is .
    {
        $dir = $post_dir; //If there was no folder specified, display the posts directory.
    }


    $dh = opendir($dir);
    if ($dh == FALSE)
    {
        echo "Cannot find folder; Did you take a wrong turn?";
    }
    
    while (false !== ($filename = readdir($dh)))
    {
        $files[] = $filename;
    }
    
    sort($files);


    if (count($files) >2) //If there is only the files: . and .. in the directory, then display an error.
    {
        foreach ($files as $f) //for each file.....
        {
            if ($f != "." && $f != ".." && !strpos($f,"_desc") && substr($f, 0,1) != ".") //ignore . and .. and files beginning with .
            {
                echo'<div class="itemcontainer">
                     <div class="itemdetailsname">';
                        if (is_dir($dir."/".$f) == TRUE) //If filename is a dir make it a link to a dir.
                        {
                            echo '<a href="documents.php?dir='.$dir."/".$f.'">'.$f.'</a>';
                        }
                        else //else, just make it a file name.
                        {
                            if (!strpos($f, "_desc"))  //Make sure that we dont display _desc files.
                            {
                                echo $f; 
                            }
                        }
              echo '</div>
                    <div class="itemdetails">
                    <div class="details1">';
                      $desc = fopen($dir."/".$f."_desc", "r");
                      if ($desc != FALSE) //if exists...but a bad version
                      {
                            echo file_get_contents($dir."/".$f."_desc");
                      }
                      echo '</div>
                      <div class="details2">';
                      if(is_dir($dir."/".$f) == TRUE)
                      {
                          echo "Directory";
                      }
                      else 
                      {
                        if ($dir != "." && $dir != ".." && substr($dir, 1) != ".")
                        {
                            echo date($date_format,intval(substr($f, 0, strpos($f, "_"))));
                        }
                        else
                        {
                            echo "";
                        }
                      }
                      echo '</div>
                          </div>';
                          echo '</div>';
                        
            }
        }

        echo'</div>';
     }
     else
     {
        echo "<div style='text-align:center'><p>No documents to show. Did you take a wrong turn?</p></div></div>";
     }
        
    sidebarleft_output("resources/docinfo.html"); //Show some info
    echo '</div>';
}

?>
