<?php

    $dir = str_replace("/","",$_GET["dir"]); // Get sub-directory and (basic) prevent escapes.
    if ($dir == "")
    {
        $dir = $post_dir;   //If the folder wasnt specified, then use the default posts folder (from config.php)
    } else {
        $dir = $post_dir."/".$dir; // If a sub was specified, append after the default folder
    }
    $post = str_replace("/","",$_GET["post"]); // Hacky way to fix major security hole
    
    if ($post == "")
    {
        echo "Cannot open specified post";
        return 0;
    }

    if ($post != "." && $post != "..")
    {
        echo "<div style='text-align: left'>";
        echo "<i style='text-align:left;'>".date("d-m-Y",$post)."</i><br></div><br>";
        $out = file_get_contents( $dir."/".$post);
        echo $out."<br><br>";
    }

    echo '</div>';
    echo "</div></div>";
?>
