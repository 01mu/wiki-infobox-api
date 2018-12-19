<?php
/*
 * wiki-infobox-api
 * github.com/01mu
 */

include_once 'wiki-infobox-api.php';

$infobox = new infobox('Nikola Tesla');

$arr = $infobox->infobox_arr;

foreach($arr as $val)
{
    printf($val->value . "\n");
}
