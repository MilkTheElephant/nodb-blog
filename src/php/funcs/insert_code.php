<?php



function insert_code($file)
{
    echo "somethign"; 
    if (file_exists($file))
    {

        $linecount = 0;
        $handle = fopen($file,"r"); //Open fille
        echo $file;
    

        while (!feof($handle))
        {
            $line = fgets($handle);
            $linecount++;
            //echo $linecount;
        }
        fclose($handle);

        if ($linecount > 0)
        {
            echo '<div class="CodeBox">';
            echo '<pre class="LineNumbers">';
            for ($x=0;$x<=$linecount-2;++$x)
            {
              
               echo $x."\n";
            }
            echo '</pre>';
            echo '<pre class="Source">';
            echo htmlspecialchars(file_get_contents($file));
            echo '</pre></div>';
        }
    }
    else
    {
        echo 'Cannot Open source file:'.$file.'';

    }
}
?>
