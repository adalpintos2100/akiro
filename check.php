<?php 
if (!empty($_GET)){
$postdata = http_build_query(
    array(
        'url' => $_GET['url'],
		'timeout' => 3,
		'userAgent' => 'Mozilla/5.0 (Linux; Android 6.0.1; SM-G935S Build/MMB29K; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.91 Mobile Safari/537.36'
        
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
$result = file_get_contents('http://www.iptvtools.net/ajax.aspx?svc=check_link', false, $context);
echo $result;
}else{
echo '<html><head><title>CAT</title></head><body><a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a></body></html>';
}
?>
