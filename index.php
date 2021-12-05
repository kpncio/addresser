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

$zone = zone(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$country = country(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$region = region(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$city = city(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$zip = zip(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$latitude = latitude(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$longitude = longitude(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$cidr = cidr(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$asn = asn(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));
$isp = isp(odb(), v6(ip(), false), dc(ip(), v6(ip(), false)));

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
echo "\t \t \"zone\": \"{$zone}\" \n";
echo "\t \t \"country\": \"{$country}\" \n";
echo "\t \t \"region\": \"{$region}\" \n";
echo "\t \t \"city\": \"{$city}\" \n";
echo "\t \t \"zip\": \"{$zip}\" \n";
echo "\t \t \"latitude\": \"{$latitude}\" \n";
echo "\t \t \"longitude\": \"{$longitude}\" \n";
echo "\t \t \"cidr\": \"{$cidr}\" \n";
echo "\t \t \"asn\": \"{$asn}\" \n";
echo "\t \t \"isp\": \"{$isp}\" \n";
echo "\t } \n";
echo "} \n";