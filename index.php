<?php 
$postdata = http_build_query(
    array(
        'string' => "iptv+latino"
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
if ($_GET['data'] == "true") {
    $result = file_get_contents('https://psbdmp.ws//', false, $context);
}else{
	echo "<h2>NO</h2>"
}
?>
