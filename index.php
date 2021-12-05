<?php

header('Content-Type: text/plain');

require 'ip.inc.php';
require 'db.inc.php';
require '2l.inc.php';

$version = v6(ip(), true);
$address = ip();
$decimal = dc(ip(), v6(ip(), false));
$system = os();
$browser = br();

echo "{ \n";
echo "\t \"version\": \"{$version}\", \n";
echo "\t \"address\": \"{$address}\", \n";
echo "\t \"decimal\": \"{$decimal}\", \n";
echo "\t \"system\": \"{$system}\", \n";
echo "\t \"browser\": \"{$browser}\" \n";
echo "} \n";