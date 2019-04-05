<?php

function view($name, $data = [])
{
    extract($data);

    require "app/views/$name.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}

function includeMainStyles()
{
    foreach (glob('public/css{/*,,/*/*}/*.css', GLOB_BRACE) as $file)
    {
        if (! preg_match('/.*admin.*/', $file))
        {
            echo "<link rel='stylesheet' href='/{$file}'>\n";
        }
    }
}

function includeMainScripts()
{
    foreach (glob('public/js{/*,,/*/*}/*.js', GLOB_BRACE) as $file)
    {
        if (! preg_match('/.*admin.*/', $file))
        {
             echo "<script src='/{$file}'></script>\n";
        }
    }
}

function includeAdminStyles()
{
    foreach (glob('public/css{/*,,/*/*}/*.css', GLOB_BRACE) as $file)
    {
        if (preg_match('/.*admin.*/', $file))
        {
            echo "<link rel='stylesheet' href='/{$file}'>\n";
        }
    }
}

function includeAdminScripts()
{
    foreach (glob('public/js{/*,,/*/*}/*.js', GLOB_BRACE) as $file)
    {
        if (preg_match('/.*admin.*/', $file))
        {
             echo "<script src='/{$file}'></script>\n";
        }
    }
}