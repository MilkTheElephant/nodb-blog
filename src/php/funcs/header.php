<?php


function header_output($file, $quote)
{

    echo'
        <title>Samuel Barratt</title>
        <div class="container">
        <div class="stickyheader">
        <div class="header">
            <div class="copyright">
                <p class="copyrighttext">Copyright &copy Samuel Barratt 2014</p>
            </div>        
                <h1>Samuel Barratt</h1>
                <div class="head_quote">';
                echo '<h2>'.$quote.'</h2>';
                echo '</div>';
           echo ' <div class="linksdiv">';
    if (file_exists($file))
    {
        echo file_get_contents($file);
    }
    echo '  </div>
            </div>
            </div>';
    return;
}

?>
