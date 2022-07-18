<?php

require 'ip.inc.php';
require '2l.inc.php';

$version = v6(ip(), true);
$address = ip();
$decimal = dc(ip(), v6(ip(), false));
$system = os();
$browser = br();

$ip2l = all(v6(ip(), false), dc(ip(), v6(ip(), false)));

$proxy = false;
if ($decimal >= $ip2l[1][0] && $decimal <= $ip2l[1][1]) {
	$proxy = true;
}

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
    echo "\t \t \"cidr\": \"{$ip2l[2][2]}\", \n";
    echo "\t \t \"asn\": \"{$ip2l[2][3]}\", \n";
    echo "\t \t \"isp\": \"{$ip2l[2][4]}\" \n";
    echo "\t }, \"proxy\": { \n";
	if ($proxy) {
		echo "\t \t \"detected\": \"true\" \n";
		echo "\t \t \"provider\": \"{$ip2l[1][7]}\", \n";
		echo "\t \t \"type\": \"{$ip2l[1][2]}\", \n";
		echo "\t \t \"usage\": \"{$ip2l[1][9]}\", \n";
		echo "\t \t \"threat\": \"{$ip2l[1][13]}\", \n";
	} else {
		echo "\t \t \"detected\": \"false\" \n";
	}
	echo "\t } \n";
    echo "} \n";
} else {
	echo "
		<!DOCTYPE html>
		<html lang='en'>
			<head>
				<title>KPNC Addresser</title>
				<meta charset='UTF-8'>
				<meta name='theme-color' content='#1472FC'>
				<meta name='author' content='KPNC Project'>
				<meta name='description' content='KPNC Project: Addresser: IP Address Lookup...'>
				<meta name='viewport' content='width=device-width, height=device-height, initial-scale=1.0'>
				<meta http-equiv='X-UA-Compatible' content='ie=edge'>
				<link href='https://content.kpnc.io/' rel='preconnect'>
				<link href='https://content.kpnc.io/css/addresser.css' rel='stylesheet'>
				<link href='https://content.kpnc.io/css/roboto-mono.css' rel='stylesheet'>
				<link href='https://content.kpnc.io/img/kpnc/addresser.png' rel='icon'>
				<link href='https://content.kpnc.io/lib/leaflet/leaflet.css' rel='stylesheet'>
				<script src='https://content.kpnc.io/lib/leaflet/leaflet.js'></script>
			</head>
			<body>
				<div id='m1' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c1' class='close'>&times;</span>
							
							<p>
								RFC Memos: <a href='https://www.rfc-editor.org/rfc/rfc6864' target='_blank'>IPv4</a> & <a href='https://www.rfc-editor.org/rfc/rfc8200' target='_blank'>IPv6</a>
							</p>
		
							<p>
								After the initial use and creation of IPv4 in the early 1980s (DARPA and DoD [<a href='https://www.rfc-editor.org/rfc/rfc760' target='_blank'>760</a>]) the internet started gaining popularity in big institutions and connected much of the early networks (SATNET and ARPANET). When the internet reached the consumer, it was inevitable that they would run out of available numbers with only ~4 billion unique addresses for 22 billion IoTs connected now. The solution, a new standard called IPv6 in 1995 (Xerox PARC [<a href='https://www.rfc-editor.org/rfc/rfc1883' target='_blank'>1883</a>]) that could handle ~3.4E38 addresses and was officially available for worldwide use in 2012.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m2' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c2' class='close'>&times;</span>
		
							<p>
								RFC Memos: <a href='https://www.rfc-editor.org/rfc/rfc6864' target='_blank'>IPv4</a> & <a href='https://www.rfc-editor.org/rfc/rfc8200' target='_blank'>IPv6</a>
							</p>
		
							<p>
								The client IP address inputted into (through the 'ip' query string) or determined by the webserver (Apache HTTPD). PHP API defines <a href='https://www.php.net/manual/en/reserved.variables.server.php' target='_blank'>$_SERVER</a> variables in order of:<br><br>'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR',<br> 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR',<br> 'HTTP_FORWARDED', 'REMOTE_ADDR'.<br><br> If your device and infrastructure supports both protocols 4 and 6, then whatever protocol is faster will be displayed here (usually IPv6 in unoptimized situations). However, some services have still not moved towards IPv6 and have limited support for the newer protocol.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m3' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c3' class='close'>&times;</span>
		
							<p>
								RFC Memos: <a href='https://www.rfc-editor.org/rfc/rfc6864' target='_blank'>IPv4</a> & <a href='https://www.rfc-editor.org/rfc/rfc8200' target='_blank'>IPv6</a>
							</p>
		
							<p>
								The decimal representation of the IP address that is, at its core, binary. This number is mainly used for looking up specific addresses in databases. In an IPv4 address there are 4 numbers, each between 0 and 255. Thinking of each number as a single base 256 digit, the last digit would add only 1 in decimal (256<sup>0</sup> = 1), the next would add 256 in decimal (256<sup>1</sup>), then 65536 (256<sup>2</sup>), and finally 16777216 (256<sup>3</sup>). Therefore the address 1.2.3.4 would convert to:
								<br><br>
								(1*16777216) + (2*65536) + (3*256) + (4*1) = 16909060
								<br><br>
								*The example uses IPv4 (2<sup>32</sup> as 256<sup>4</sup>) out of simplicity, for information on IPv6 (2<sup>128</sup> as 16<sup>32</sup>) see <a href='https://www.rfc-editor.org/rfc/rfc8200' target='_blank'>RFC8200</a>.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m4' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c4' class='close'>&times;</span>
		
							<p>
								WhatsMyUA: <a href='https://www.whatsmyua.info/' target='_blank'>Whats My User Agent</a>
							</p>
		
							<p>
								The <a href='https://www.britannica.com/technology/operating-system' target='_blank'>operating system</a> as defined in the user-agent header. See <a href='https://www.rfc-editor.org/rfc/rfc7231' target='_blank'>RFC7231-5.5.3</a> for further information on the user-agent.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m5' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c5' class='close'>&times;</span>
		
							<p>
								WhatsMyUA: <a href='https://www.whatsmyua.info/' target='_blank'>Whats My User Agent</a>
							</p>
		
							<p>
								The <a href='https://www.britannica.com/technology/browser' target='_blank'>browser</a> as defined in the user-agent header. See <a href='https://www.rfc-editor.org/rfc/rfc7231' target='_blank'>RFC7231-5.5.3</a> for further information on the user-agent.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m6' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c6' class='close'>&times;</span>
		
							<p>
								ARIN Resource: <a href='https://search.arin.net/rdap/' target='_blank'>ARIN Whois/RDAP</a>
							</p>
		
							<p> 
								<a href='https://www.britannica.com/technology/Internet-service-provider' target='_blank'>ISP</a> (Internet Service Provider) is a commercial organization responsible for connecting its customers to the greater internet. As not all IP addresses are residential (in that they do not have direct access to an RIR or their own infrastructure) in nature, this 'ISP' value may not be an actual ISP. However, the organization listed owns the connected IP/CIDR/ASN and is responsible for providing internet service either way. Further information can be found through a Whois or RDAP form (see modal header).
							</p>
						</div>
					</div>
				</div>
		
				<div id='m7' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c7' class='close'>&times;</span>
		
							<p>
								ARIN Resources: <a href='https://www.arin.net/reference/materials/cidr.pdf' target='_blank'>CIDR Datasheet</a> &
								<a href='https://account.arin.net/public/cidrCalculator' target='_blank'>CIDR Calculator</a>
							</p>
		
							<p> 
								<a href='https://www.rfc-editor.org/rfc/rfc4632' target='_blank'>CIDR</a> (Classless Inter-domain Routing) notation define continuous blocks of IP addresses. CIDR notation is usually used when describing ASNs (see below) and other network groups. For example 1.1.1.0/24 (Cloudflare Inc.) is a block starting at 1.1.1.0 and has 256 addresses (1.1.1.0 -> 1.1.1.255 including 0). The amount can be calculated by taking the maximum IPv4 addresses (32 bits = 2<sup>32</sup>) and dividing by the CIDR bits (in this case 24 bits = 2<sup>24</sup>) equaling 256 total addresses.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m8' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c8' class='close'>&times;</span>
		
							<p>
								ARIN Resource: <a href='https://www.arin.net/resources/guide/asn/' target='_blank'>ASN Guide</a>
							</p>
		
							<p>
								<a href='https://www.rfc-editor.org/rfc/rfc7020' target='_blank'>ASN</a> (Autonomous System Numbers) define Autonomous Systems ultimately controlled by IANA. IANA distributes the numbers to the five regional RIRs (APNIC, ARIN, RIPE NCC, LACNIC, and AFRINIC). These numbers were only 2-bytes (16-bit = 2<sup>16</sup>), but as the internet grew, more numbers were needed leading to 4-byte (2<sup>32</sup>) ASNs. ASNs define ownership, policies, and other external information that must be available for interconnectivity.
							</p>
						</div>
					</div>
				</div>
		
				<div id='m9' class='modal'>
					<div class='modal-content'>
						<div class='modal-body'>
							<span id='c9' class='close'>&times;</span>
		
							<p>
								IP2Location: <a href='https://lite.ip2location.com/' target='_blank'>Free Database</a>
							</p>
							
							<p>
								The information shown in the 'Provider Data', 'Proxy Data', and 'Location Data' sections is provided by a <a href='https://www.ip2location.com' target='_blank'>IP2Location</a> database. Locational data is not guaranteed accurate (the inaccuracy can be seen <a href='https://www.ip2location.com/data-accuracy' target='_blank'>here</a>).
							</p>
						</div>
					</div>
				</div>
		
				<main>
					<header>
						<a href='https://www.kpnc.io'>
							<img src='https://content.kpnc.io/img/kpnc/logodark.webp' alt='~KPNC~'>
						</a>
		
						<small>2022 &copy; KPNC Technology // Addresser: <a href='https://github.com/kpncio/addresser' target='_blank'>GitHub</a></small>
					</header>
		
					<div class='container'>
						<p><strong>Generated Data:</strong></p><br>

						<table>
							<tbody>
								<tr>
									<td><p>&rtrif; IP Version<sup><a id='i1'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$version}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; IP Address<sup><a id='i2'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$address}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; IP Decimal<sup><a id='i3'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$decimal}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; System<sup><a id='i4'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$system}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; Browser<sup><a id='i5'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$browser}'/></td>
								</tr>
							</tbody>
						</table>
					</div>
		
					<br>
					<div class='container'>
						<p><strong>Provider Data<sup><a id='i9'>?</a></sup>:</strong></p><br>

						<table>
							<tbody>
								<tr>
									<td><p>&rtrif; ISP<sup><a id='i6'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$ip2l[2][4]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; CIDR<sup><a id='i7'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$ip2l[2][2]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; ASN<sup><a id='i8'>?</a></sup></p></td>
									<td><input type='text' class='data' value='{$ip2l[2][3]}'/></td>
								</tr>
							</tbody>
						</table>
					</div>

					<br>
					<div class='container'>
						<p><strong>Proxy Data<sup><a id='i10'>?</a></sup>:</strong></p><br>

						<table>
							<tbody>
	";

	if ($proxy) {
		echo "
			<tr>
				<td><p>&rtrif; Listed</p></td>
				<td><input type='text' class='data' value='True'/></td>
			</tr>
			<tr>
				<td><p>&rtrif; Provider</p></td>
				<td><input type='text' class='data' value='{$ip2l[1][7]}'/></td>
			</tr>
			<tr>
				<td><p>&rtrif; Type</p></td>
				<td><input type='text' class='data' value='{$ip2l[1][2]}'/></td>
			</tr>
			<tr>
				<td><p>&rtrif; Usage</p></td>
				<td><input type='text' class='data' value='{$ip2l[1][9]}'/></td>
			</tr>
			<tr>
				<td><p>&rtrif; Threat</p></td>
				<td><input type='text' class='data' value='{$ip2l[1][13]}'/></td>
			</tr>
		";
	} else {
		echo "
			<tr>
				<td><p>&rtrif; Listed</p></td>
				<td><input type='text' class='data' value='False'/></td>
			</tr>
		";
	}

	echo "			
							</tbody>
						</table>
					</div>

					<br>
					<div class='container'>
						<p><strong>Location Data<sup><a id='i0'>?</a></sup>:</strong></p><br>

						<table>
							<tbody>
								<tr>
									<td><p>&rtrif; Time Zone</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][9]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; Country</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][2]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; Region</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][4]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; City</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][5]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; ZIP</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][8]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; Latitude</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][6]}'/></td>
								</tr>
								<tr>
									<td><p>&rtrif; Longitude</p></td>
									<td><input type='text' class='data' value='{$ip2l[0][7]}'/></td>
								</tr>
							</tbody>
						</table>
					</div>

					<br>
					<div class='container'>
						<p><strong>Mapped Visualization:</strong></p><br>
						<div id='map' style='height: 250px; font-size: 11px; text-align: center;'>*Map loading...</div>
					</div>
		
					<br>
					<div class='container'>
						<small>*Raw JSON will be sent if no browser is detected or the query string 'api' equals true...</small>
					</div>
				</main>
		
				<script>
					var map = L.map('map').setView([{$ip2l[0][6]}, {$ip2l[0][7]}], 11);
							
					var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
					 	maxZoom: 18,
					 	attribution: \"Map Data & Imagery &copy; <a href='https://www.openstreetmap.org/copyright' target='_blank'>OpenStreetMap</a> & <a href='https://www.mapbox.com/' target='_blank'>Mapbox</a>\",
					 	id: 'mapbox/dark-v10',
					 	tileSize: 512,
					 	zoomOffset: -1,
					 	accessToken: 'pk.eyJ1IjoiYWxiaWU2NTQ0IiwiYSI6ImNsMjV1YmdmMTJkcTMza3BkZTdmbnY1bTcifQ.YpT_p-H1WckYccV8_HoLHg'
					}).addTo(map);
		
					var circle = L.circle([{$ip2l[0][6]}, {$ip2l[0][7]}], {
						color: '#1472FC',
						fillColor: '#1472FC',
						fillOpacity: 0.5,
						radius: 5000
					}).addTo(map);
		
					var m1 = document.getElementById('m1');
					var i1 = document.getElementById('i1');
					var c1 = document.getElementById('c1');
		
					var m2 = document.getElementById('m2');
					var i2 = document.getElementById('i2');
					var c2 = document.getElementById('c2');
		
					var m3 = document.getElementById('m3');
					var i3 = document.getElementById('i3');
					var c3 = document.getElementById('c3');
		
					var m4 = document.getElementById('m4');
					var i4 = document.getElementById('i4');
					var c4 = document.getElementById('c4');
		
					var m5 = document.getElementById('m5');
					var i5 = document.getElementById('i5');
					var c5 = document.getElementById('c5');
		
					var m6 = document.getElementById('m6');
					var i6 = document.getElementById('i6');
					var c6 = document.getElementById('c6');
		
					var m7 = document.getElementById('m7');
					var i7 = document.getElementById('i7');
					var c7 = document.getElementById('c7');
		
					var m8 = document.getElementById('m8');
					var i8 = document.getElementById('i8');
					var c8 = document.getElementById('c8');
		
					var m9 = document.getElementById('m9');
					var i9 = document.getElementById('i9');
					var i10 = document.getElementById('i10');
					var i0 = document.getElementById('i0');
					var c9 = document.getElementById('c9');
		
					i1.onclick = function() { m1.style.display = 'block'; }
					c1.onclick = function() { m1.style.display = 'none'; }
		
					i2.onclick = function() { m2.style.display = 'block'; }
					c2.onclick = function() { m2.style.display = 'none'; }
		
					i3.onclick = function() { m3.style.display = 'block'; }
					c3.onclick = function() { m3.style.display = 'none'; }
		
					i4.onclick = function() { m4.style.display = 'block'; }
					c4.onclick = function() { m4.style.display = 'none'; }
		
					i5.onclick = function() { m5.style.display = 'block'; }
					c5.onclick = function() { m5.style.display = 'none'; }
		
					i6.onclick = function() { m6.style.display = 'block'; }
					c6.onclick = function() { m6.style.display = 'none'; }
		
					i7.onclick = function() { m7.style.display = 'block'; }
					c7.onclick = function() { m7.style.display = 'none'; }
		
					i8.onclick = function() { m8.style.display = 'block'; }
					c8.onclick = function() { m8.style.display = 'none'; }
		
					i9.onclick = function() { m9.style.display = 'block'; }
					i10.onclick = function() { m9.style.display = 'block'; }
					i0.onclick = function() { m9.style.display = 'block'; }
					c9.onclick = function() { m9.style.display = 'none'; }
		
					window.onclick = function(event) {
						if (event.target == m1) { m1.style.display = 'none'; }
						if (event.target == m2) { m2.style.display = 'none'; }
						if (event.target == m3) { m3.style.display = 'none'; }
						if (event.target == m4) { m4.style.display = 'none'; }
						if (event.target == m5) { m5.style.display = 'none'; }
						if (event.target == m6) { m6.style.display = 'none'; }
						if (event.target == m7) { m7.style.display = 'none'; }
						if (event.target == m8) { m8.style.display = 'none'; }
						if (event.target == m9) { m9.style.display = 'none'; }
					}
				</script>
			</body>
		</html>
	";
}