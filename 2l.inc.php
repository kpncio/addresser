<?php

require 'db.inc.php';

function sdb($ip6, $dec, $tbl, $col, $ary) {
    $con = odb();

    $response = "unknown";

    if (!$ip6) {
        $ver = "";
    } else {
        $ver = "_ipv6";
    }

    // USE ip2location;
    // CREATE TABLE ip2location_version_memory SELECT * FROM ip2location_version WHERE 1=2;
    // ALTER TABLE ip2location_version_memory ENGINE=memory;
    // INSERT INTO ip2location_version_memory SELECT * FROM ip2location_version;

    // IP2Location uses the MyISAM engine by default. It is recommended to upgrade to InnoDB or ARIA engines or use MEMORY (~8.5Gb)...
    $query = "SELECT * FROM `ip2location_{$tbl}{$ver}` WHERE `ip_to` >= {$dec} LIMIT 1;";


    if ($result = $con -> query($query)) {
        $row = $result -> fetch_assoc();

        // This is fucking stupid...
        // "$response = $row[$col]" didn't work...
        $response = implode(",", $row);
        $response = explode(",", $response);
        if (!$ary) {
            $response = $response[$col];
        }

        $result -> free_result();
    }

    cdb($con);

    return $response;
}

function all($ip6, $dec) {
    $loc = sdb($ip6, $dec, "db11", 0, true);
    $asn = sdb($ip6, $dec, "asn", 0, true);

    return array($loc, $asn);
}

//function zone($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 9, false);
//}

//function country($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 2, false);
//}

//function region($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 4, false);
//}

//function city($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 5, false);
//}

//function zip($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 8, false);
//}

//function latitude($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 6, false);
//}

//function longitude($ip6, $dec) {
//    return sdb($ip6, $dec, "db11", 7, false);
//}

//function cidr($ip6, $dec) {
//    return sdb($ip6, $dec, "asn", 2, false);
//}

//function asn($ip6, $dec) {
//    return sdb($ip6, $dec, "asn", 3, false);
//}

//function isp($ip6, $dec) {
//    return sdb($ip6, $dec, "asn", 4, false);
//}