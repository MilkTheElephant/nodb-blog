<?php

function folder_display() //Function displays all the posts in a set directiory. This is passed by GET and can be tags.
{
    include "conf.php";


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
                        if (is_dir($dir."/".$f) == TRUE) //If filename is a dir M`make it a link to a dir.
                        {
                            echo '<a href="documents.php?dir='.$dir."/".$f.'">'.$f.'</a>';
                        }
                        else //else, just make it a file name.
                        {
                            echo '<a href="blog.php?post='.$f.'">'.str_replace("_", " ", substr($f, strpos($f, "_"), strlen($f))).'</a>'; 
                        }
              echo '</div>
                    <div class="itemdetails">
                    <div class="details1">';
                      $desc = fopen($dir."/".$f."_desc", "r");
                      if ($desc != FALSE) //if exists...but a bad version TODO use actual if exists
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

        //echo'</div>';
     }
     else
     {
        echo "<div style='text-align:center'><p>No documents to show. Did you take a wrong turn?</p></div></div>";
     }
        
    //echo '</div>';
}

?>
