<?php 
$postdata = http_build_query(
    array(
        'string' => $_GET['link']
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

$result = file_get_contents('https://psbdmp.ws//', false, $context);
echo $result;
?>
