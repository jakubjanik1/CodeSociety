<?php

use Windwalker\Edge\Edge;
use Windwalker\Edge\Loader\EdgeFileLoader;
use Core\Session;

function view($name, $data = [])
{
    $edge = new Edge(new EdgeFileLoader(['app/views']));

    echo $edge->render($name, $data);

    renderFlash($edge);
}

function renderFlash($edge)
{
    $flashMessages = Session::get('flash_messages');
    if ($flashMessages)
    {
        $level = array_keys($flashMessages)[0];
        echo $edge->render('flash', ['message' => $flashMessages[$level][0], 'level' => $level]);
        Session::unset('flash_messages');
    }
}

function redirect($path)
{
    header("Location: /{$path}");
}

function redirectBack()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

function json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
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