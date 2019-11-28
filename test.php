<?php
$headers = header();

foreach ($headers as $header => $value) {
    echo "$header: $value <br />
";
}

echo "<br>-------------------<br>";

$headers = getallheaders();
while (list ($header, $value) = each ($headers)) {
echo "$header: $value <br><br>";
}
?>