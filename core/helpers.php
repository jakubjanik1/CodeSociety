<?php

function view($name, $data = [])
{
    extract($data);

    require "app/views/$name.view.php";
}

function includeStyles()
{
    foreach (glob('public/css{/*,,}/*.css', GLOB_BRACE) as $file)
    {
        echo "<link rel='stylesheet' href='/{$file}'>\n";
    }
}

function includeScripts()
{
    foreach (glob('public/js{/*,,}/*.js', GLOB_BRACE) as $file)
    {
        echo "<script src='/{$file}'></script>\n";
    }
}