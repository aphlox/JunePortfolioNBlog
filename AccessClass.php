<?php
session_start();

if (isset($_SESSION['ip'])) {

    echo "isset" . "<br/>";
    echo session_id() . "</br>";


} else {
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    echo "noset" . "<br/>";
    echo session_id() . "</br>";
    AccessLog();

}


// 접속 기록
function AccessLog()
{
    echo "hello";

    // 테이블 구조 : uid, ipaddr, date, time, OS, browser, userID, hit
    // SESSION 이 살아있는 동안에는 카운트 안되도록 처리
    $conn = new mysqli("127.0.0.1", "root", "Midarlk3134!", "juneblog");
    mysqli_query ($conn, 'SET NAMES utf8');

    $accessIp = $_SERVER['REMOTE_ADDR'];
    $getOS = getOS(); // 접속 OS 정보
    $getBrowser = getBrowser(); // 브라우저 접속 정보
    $date = date("Ymd"); // 오늘날짜
    $time = date("H:i:s"); // 시간
    $country = "undefined";

    $queryGetCountry = @unserialize(file_get_contents('http://ip-api.com/php/' . $accessIp));
    if ($queryGetCountry && $queryGetCountry['status'] == 'success') {
        $country = $queryGetCountry['country'];
    }

    echo $accessIp."<br/>";
    echo $date."<br/>";
    echo $time."<br/>";
    echo $getOS."<br/>";
    echo $getBrowser."<br/>";
    echo $country."<br/>";
    $sql = "select *from vistor where ip ='$accessIp' and date ='$date'";
    $result = $conn->query($sql);
    echo $result->num_rows;


    if ($result->num_rows == 0) { // 오늘 접속날짜 기록이 없으면
        echo "check";
            $sql = "INSERT INTO vistor (ip,date,time,OS,browser,country ,hit) 
            VALUES ('$accessIp','$date','$time','$getOS','$getBrowser','$country','1')";
            $conn->query($sql);
    } else { // 접속 기록이 있으면 해당 IP주소의 카운트만 증가시켜라.
        $sql = "UPDATE vistor SET hit=hit+1 Where ip='" . $accessIp . "'";
         $conn->query($sql);
    }





}


// 접속 Device
function user_agent()
{
    $iPod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
    $iPhone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $iPad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
    if ($iPad || $iPhone || $iPod) {
        return 'ios';
    } else if ($android) {
        return 'android';
    } else {
        return 'etc';
    }
}

function getOS()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    return $os_platform;
}


function getBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Mobile Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }
    return $browser;
}

/*//방문자 ip 얻어서 나라 도시 위치 알기
function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    if ($query && $query['status'] == 'success') {
        echo "ISP:" . $query['isp'] . "<br/>";
        echo "COUNTRY:" . $query['country'] . "<br/>";
        echo "COUNTRY CODE:" . $query['countryCode'] . "<br/>";
        echo "REGION NAME:" . $query['regionName'] . "<br/>";
        echo "CITY:" . $query['city'] . "<br/>";
        echo "ZIP:" . $query['zip'] . "<br/>";
        echo "LATITUDE:" . $query['latitude'] . "<br/>";
        echo "LONGITUDE:" . $query['longitude'] . "<br/>";
        echo "TIMEZONE:" . $query['timezone'] . "<br/>";
        echo "ORG:" . $query['org'] . "<br/>";
        echo "AS:" . $query['as'] . "<br/>";
    } else {
        echo 'Something Is Wrong !!';
    }

}*/
/*echo user_agent();
echo getOS();
echo getBrowser();
echo "<br/>";
echo getIp();
$date = date("Ymd"); // 오늘날짜
echo $date."<br/>";
$time = date("H:i:s"); // 시간
echo $time."<br/>";*/

?>


<?php
/*require_once("geoip2.phar");
use GeoIp2\Database\Reader;
// City DB
$reader = new Reader('/path/to/GeoLite2-City.mmdb');
$record = $reader->city($_SERVER['REMOTE_ADDR']);
// or for Country DB
// $reader = new Reader('/path/to/GeoLite2-Country.mmdb');
// $record = $reader->country($_SERVER['REMOTE_ADDR']);
print($record->country->isoCode . "\n");
print($record->country->name . "\n");
print($record->country->names['zh-CN'] . "\n");
print($record->mostSpecificSubdivision->name . "\n");
print($record->mostSpecificSubdivision->isoCode . "\n");
print($record->city->name . "\n");
print($record->postal->code . "\n");
print($record->location->latitude . "\n");
print($record->location->longitude . "\n");
echo $record->country->isoCode;
*/ ?>
