<?php

$date = new DateTime('now');
$date->modify('+7 day');
echo $date->format('Y-m-d');