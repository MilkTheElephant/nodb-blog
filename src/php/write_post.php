<?php

    function new_post_form()
    {
        echo "
            <form action='create_post.php' method='post'
            <input type='textfield' name='title' id='title'>
            <input type='textfiled' name='body' id='body'>
            <input type='textfield' name='tags' id='tags'>
            <input type='submit' name='Post' id='submit'>
            </form>
            "
    }
