<?php

    $dir = $_GET["dir"]; //get directory
    if ($dir == "")
    {
        $dir = "posts";   //If the folder wasnt specified, then use the posts folder
    }
    $post = $_GET["post"];
    
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
