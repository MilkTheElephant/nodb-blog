<?php

require_once 'rss.php';

function sidebarleft_output($file)
{
    echo '<div class="leftfloat">';

        if (file_exists($file))
        {
            echo file_get_contents($file);
        }
        else 
        {
            echo '<p>Error opening data file.</p>';
        }
         echo '</div></div>';
    return;
}

function sidebarright_output($file)
{

    echo '<div class="rightfloat">';

        if (file_exists($file))
        {
            echo file_get_contents($file);
        }
        else 
        {
            echo '<p>Error opening data file.</p>';
        }
         echo '</div></div>';
    return;
}

?>
