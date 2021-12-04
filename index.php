<?php

$ipv6 = false;

function os() : string {

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$platform = "unknown";
	
	$os_array = array(
		'/windows nt 10/i'      =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		'/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/iphone/i'             =>  'iPhone',
		'/ipod/i'               =>  'iPod',
		'/ipad/i'               =>  'iPad',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'WebOS'
	);

	foreach ( $os_array as $regex => $value ) { 
		if ( preg_match($regex, $user_agent ) ) {
			$platform = $value;
		}
	}   
	return $platform;
}

function br() : string {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	$browser = "unknown";
	
	$browser_array = array(
		'/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/edge/i'       =>  'Edge',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Mobile'
	);

	foreach ( $browser_array as $regex => $value ) { 
		if ( preg_match( $regex, $user_agent ) ) {
			$browser = $value;
		}
	}
	
	return $browser;
}

function ip() : string {
	$keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

	foreach($keys as $k)
	{
		if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
		{


			return $_SERVER[$k];
		}
	}

	return "unknown";
}

function dec($ip, $ipv6) : string {
    if (!$ipv6) {
        $nums = explode('.', $ip);

        return strval(($nums[0] * 16777216) + ($nums[1] * 65536) + ($nums[2] * 256) + ($nums[3] * 1));
    } else {
        $str = '';
        foreach (unpack('C*', inet_pton($ip)) as $byte) {
            $str .= str_pad(decbin($byte), 8, '0', STR_PAD_LEFT);
        }
        $str = ltrim($str, '0');
        if (function_exists('bcadd')) {
            $numeric = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                $right  = base_convert($str[$i], 2, 10);
                $numeric = bcadd(bcmul($numeric, 2), $right);
            }
            $str = $numeric;
        } else {
            $str = base_convert($str, 2, 10);
        }

        return $str;
    }
}

echo '{"address":"' . ip() . '","decimal":"' . dec(ip(), $ipv6) . '","system":"' . os() . '","browser":"' . br() . '"}';
echo '{';
echo '  "version":"{}",';
echo '  "address":"{ip()}",';
echo '  "decimal":"{dec(ip(), $ipv6)}",';
echo '  "system":"{os()}",';
echo '  "browser":"{br()}",';
echo '  "":"{}",';
echo '}';