<?php 
if (!empty($_GET)){
$postdata = http_build_query(
    array(
        'string' => $_GET['data']
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
}else{
echo '<html><head></head><body><a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a></body></html>';
}
?>
