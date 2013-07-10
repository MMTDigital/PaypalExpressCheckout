<?php
chdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src');

spl_autoload_register(
    function ($c)
    {
        @include preg_replace('#\\\|_(?!.*\\\)#', '/', $c) . '.php';
    }
);