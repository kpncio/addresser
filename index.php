<?php

require 'ip.inc.php';
require '2l.inc.php';

$version = v6(ip(), true);
$address = ip();
$decimal = dc(ip(), v6(ip(), false));
$system = os();
$browser = br();

$ip2l = all(v6(ip(), false), dc(ip(), v6(ip(), false)));

if ($browser == "unknown" || $_GET["api"] == "true") {
    header('Content-Type: text/plain');

    echo "{ \n";
    # echo "\t \t \"\": \"{$}\" \n";
    echo "\t \"generated\": { \n";
    echo "\t \t \"version\": \"{$version}\", \n";
    echo "\t \t \"address\": \"{$address}\", \n";
    echo "\t \t \"decimal\": \"{$decimal}\", \n";
    echo "\t \t \"system\": \"{$system}\", \n";
    echo "\t \t \"browser\": \"{$browser}\" \n";
    echo "\t }, \"extracted\": { \n";
    echo "\t \t \"zone\": \"{$ip2l[0][9]}\", \n";
    echo "\t \t \"country\": \"{$ip2l[0][2]}\", \n";
    echo "\t \t \"region\": \"{$ip2l[0][4]}\", \n";
    echo "\t \t \"city\": \"{$ip2l[0][5]}\", \n";
    echo "\t \t \"zip\": \"{$ip2l[0][8]}\", \n";
    echo "\t \t \"latitude\": \"{$ip2l[0][6]}\", \n";
    echo "\t \t \"longitude\": \"{$ip2l[0][7]}\", \n";
    echo "\t \t \"cidr\": \"{$ip2l[1][2]}\", \n";
    echo "\t \t \"asn\": \"{$ip2l[1][3]}\", \n";
    echo "\t \t \"isp\": \"{$ip2l[1][4]}\" \n";
    echo "\t } \n";
    echo "} \n";
} else {
    echo "
    <!doctype html>
    <html lang='en'>
        <head>
            <title>APROX Addressio</title>
            <meta charset='UTF-8'>
            <meta name='theme-color' content='#FF7B2F'>
            <meta name='author' content='APROX Project'>
            <meta name='description' content='APROX Project: Addressio'>
            <meta name='viewport' content='width=device-width, height=device-height, initial-scale=1.0'>
            <meta name='keywords' content='APROX Project, APROX, AAOS, Albie, Addressio'>
            <meta http-equiv='X-UA-Compatible' content='ie=edge'>
            <link href='https://cdn.aprox.us/img/aprox3/aproxiconorg.png' rel='icon'>
            <style>
                html {
                    margin: 0;
                    padding: 0;
                    height: 100%;
                    max-width: 100%;
					max-height: 100%;
					overflow-x: hidden;
					overflow-y: hidden;
                    scroll-behavior: smooth;
                }
    
                body {
                    margin: 0;
                    padding: 0;
                    color: white;
                    background: #FF7B2F;
                    background: linear-gradient(232deg, rgba(255,251,0,1) 0%, rgba(226,30,14,1) 100%);
                    background: -moz-linear-gradient(232deg, rgba(255,251,0,1) 0%, rgba(226,30,14,1) 100%);
                    background: -webkit-linear-gradient(232deg, rgba(255,251,0,1) 0%, rgba(226,30,14,1) 100%);
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffb00', endColorstr='#e21e0e', GradientType=1);
                    background-attachment: fixed;
                }
    
                iframe {
                    margin: 0;
                    padding: 0;
                    width: 100vw;
                    height: 100vh;
                    color: white;
                }
            </style>
        </head>
        <body>
            <iframe src='https://cdn.aprox.us/lib/addressio/frame.html?version={$version}&address={$address}&decimal={$decimal}&system={$system}&browser={$browser}&isp={$ip2l[1][4]}&cidr={$ip2l[1][2]}&asn={$ip2l[1][3]}&time={$ip2l[0][9]}&country={$ip2l[0][2]}&region={$ip2l[0][4]}&city={$ip2l[0][5]}&zip={$ip2l[0][8]}&lat={$ip2l[0][6]}&long={$ip2l[0][7]}' frameborder='0'>
            Loading GUI. For plain JSON responses do not use a user-agent or set the 'api' query string...
            </iframe>
        </body>
    </html>
    ";
}