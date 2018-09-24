<?php

include_once 'wiki-infobox-api.php';

$infobox = new infobox();

$infobox->get_article('Adolf Hitler');
$infobox->get_infobox();
