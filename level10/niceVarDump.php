<?php
function prv($var)
{
    static $int = 0;
    echo '<pre><b style="background: blue;padding: 1px 5px;">' . $int . '</b> ';
    var_dump($var);die;
    echo '</pre>';
    $int++;
}
