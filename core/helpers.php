<?php

use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;

function view($name, $data = [])
{
    $edge = new Edge(new EdgeFileLoader(['app/views']));
    echo $edge->render($name, $data);
}

function redirect($path)
{
    header("Location: /{$path}");
}

function redirectBack()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
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