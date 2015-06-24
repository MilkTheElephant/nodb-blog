<?php

function unshorten($content)
{
    include "conf.php";
    $dh = opendir($post_dir);
    if ($dh == False)
    {
        echo "Couldent open posts directory";
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
        $hash = md5($f);
        $hash = substr($hash, 0, 6);

        if ($hash == $content)
        { // This file matches the short hash we were looking for - here we enforce a redirect
            header("Location: /blog.php?p=".$f); // Assuming no output before this point, will send a HTTP Redirect
        }
     }
    echo "Invalid link";
    return False;
}
?>

