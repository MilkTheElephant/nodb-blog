<?php
function add_table_data($file, $td_count)
{
    if ($td_count < 3)
    {
        echo '<td> 
            <div class="project_table_div" >
            <div class="project_table_inner_div">';
            
        if (file_exists($file))
        {
            echo file_get_contents($file); //Open file and put text into td
            echo '</td></div></div>';
        }
        else
        {
            echo '<p>Error opening data file</p></div></div>';
        }
        $td_count = $td_count + 1;
    }
    else if ($td_count >= 3)
    {

        echo '</tr><tr><td> 
            <div class="project_table_div" ><div class="project_table_inner_div">';
        if (file_exists($file))
        {
            echo file_get_contents($file); //Open file and put text into td
            echo '</td></div></div>';
        }
        else
        {
            echo '<p>Error opening data file</p></div></div>';
        }
        $td_count = $td_count = 1 ;
    }
return $td_count; 
}

function create_table()
{
    echo '<table class="project_table"; margin-left: auto; margin-right: auto; width: auto;>';
}

