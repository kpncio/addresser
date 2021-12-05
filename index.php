<?php

header('Content-Type: text/plain');

require 'ip.inc.php';
require '2l.inc.php';

$version = v6(ip(), true);
$address = ip();
$decimal = dc(ip(), v6(ip(), false));
$system = os();
$browser = br();

$ip2l = all(v6(ip(), false), dc(ip(), v6(ip(), false)));

echo "{ \n";
# echo "\t \t \"\": \"{$}\" \n";
echo "\t \"generated\": { \n";
echo "\t \t \"version\": \"{$version}\", \n";
echo "\t \t \"address\": \"{$address}\", \n";
echo "\t \t \"decimal\": \"{$decimal}\", \n";
echo "\t \t \"system\": \"{$system}\", \n";
echo "\t \t \"browser\": \"{$browser}\" \n";
echo "\t }, \n";
echo "\t \"extracted\": { \n";
echo "\t \t \"zone\": \"{$ip2l[0][9]}\" \n";
echo "\t \t \"country\": \"{$ip2l[0][2]}\" \n";
echo "\t \t \"region\": \"{$ip2l[0][4]}\" \n";
echo "\t \t \"city\": \"{$ip2l[0][5]}\" \n";
echo "\t \t \"zip\": \"{$ip2l[0][8]}\" \n";
echo "\t \t \"latitude\": \"{$ip2l[0][6]}\" \n";
echo "\t \t \"longitude\": \"{$ip2l[0][7]}\" \n";
echo "\t \t \"cidr\": \"{$ip2l[1][2]}\" \n";
echo "\t \t \"asn\": \"{$ip2l[1][3]}\" \n";
echo "\t \t \"isp\": \"{$ip2l[1][4]}\" \n";
echo "\t } \n";
echo "} \n";