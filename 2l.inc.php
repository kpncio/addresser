<?php

function zone($con, $ip6, $dec) {
    return null;
}

function country($con, $ip6, $dec) {
    if (!$ip6) {
        $ver = "";
    } else {
        $ver = "_ipv6";
    }

    $query = "SELECT * FROM `ip2location_db11{$ver}` WHERE `ip_from` <= {$dec} AND `ip_to` >= {$dec};";

    if ($result = $con -> query($query)) {
        return $result -> fetch_array; # join(" ", $result -> fetch_array);
    } else {
        return "unknown";
    }
}

function region($con, $ip6, $dec) {
    return null;
}

function city($con, $ip6, $dec) {
    return null;
}

function zip($con, $ip6, $dec) {
    return null;
}

function latitude($con, $ip6, $dec) {
    return null;
}

function longitude($con, $ip6, $dec) {
    return null;
}

function cidr($con, $ip6, $dec) {
    return null;
}

function asn($con, $ip6, $dec) {
    return null;
}

function isp($con, $ip6, $dec) {
    return null;
}