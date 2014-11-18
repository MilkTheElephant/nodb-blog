<?php

    include "conf.php";
    
    $dir = $_GET["dir"]; //get directory
    if ($dir == "")
    {
        $dir = $post_dir;   //If the folder wasnt specified, then use the posts folder
    }
    $dh = opendir("/home/samathy/Git Projects/nodb-blog/src/php/posts");
    if ($dh == False)
    {
        echo "Could'nt open posts directory";
        return 0;
    }

    while (false !== ($filename = readdir($dh)))
    {
        $files[] = $filename;
    }
    
    foreach ($files as $f)
    {

        if ($f != "." && $f != "..")
        {

            echo "<div style='text-align: left'>";
            echo "<i style='text-align:left;'>".date("d-m-Y",intval(substr($f, 0, strpos($f, "_"))))."</i><br></div><br>";
            $out = include $dir."/".$f;
            echo $out."<br><br>";
        }
    }

    return ""
?>
