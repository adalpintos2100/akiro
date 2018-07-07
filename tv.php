<?php
if(!empty($_GET)) {
$url = $_GET["url"];
$tv = $_GET["tv"];
  $m3ufile = file_get_contents($url);
    //$m3ufile = str_replace('tvg-', 'tvg_', $m3ufile);
$m3ufile = str_replace('group-title', 'tvgroup', $m3ufile);
$m3ufile = str_replace("tvg-", "tv", $m3ufile);
//$re = '/#(EXTINF|EXTM3U):(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
$re = '/#EXTINF:(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
$attributes = '/([a-zA-Z0-9\-]+?)="([^"]*)"/';
preg_match_all($re, $m3ufile, $matches);
// Print the entire match result
//print_r($matches);
$i = 1;
$items = array();
 foreach($matches[0] as $list) {
    
     //echo "$list <br>";
	 
   preg_match($re, $list, $matchList);
   //$mediaURL = str_replace("\r\n","",$matchList[4]);
   //$mediaURL = str_replace("\n","",$matchList[4]);
   //$mediaURL = str_replace("\n","",$mediaURL);
   $mediaURL = preg_replace("/[\n\r]/","",$matchList[3]);
   $mediaURL = preg_replace('/\s+/', '', $mediaURL);
   //$mediaURL = preg_replace( "/\r|\n/", "", $matches[4] );
   
   $newdata =  array (
    //'ATTRIBUTE' => $matchList[2],
    'id' => $i++,
    'tvtitle' => $matchList[2],
    'tvmedia' => $mediaURL
    );
    
    preg_match_all($attributes, $list, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
       $newdata[$match[1]] = $match[2];
    }
    
    //array_push($newdata,$attribute);
    //$newdata[] = $attribute;
	 
	 $items[] = $newdata;
	 //$items[] = $matchList[2];
    
 }
//print_r($items);
$callback= isset($_GET['callback']);
  if($callback){
    echo $callback. '(' . json_encode($items) . ')';  // jsonP callback
  }
  else{
   }
   $key = preg_grep('/'.$tv.'$/iu', array_column($items, 'tvtitle'));
   if (!empty($key)){
   $media = $items[array_keys($key)[0]]['tvmedia'];
   $qq = file_get_contents('https://iptv-paste.herokuapp.com/check.php?url='.$media);
   $nn = preg_match('/\<data\>(.*)\<\/data\>/', $qq, $title);
   if($title[1] == "true"){
   $html =
'<tr>
 <td>true</td>
 <td>'.$media.'</td>
</tr>';
   echo $html;
   }else{
   $html =
'<tr>
 <td>false</td>
</tr>';
   echo $html;
   }
   }else{
$html =
'<tr>
 <td>false</td>
</tr>';
   echo $html;
   }
} else {
echo '<html><head><title>CAT</title></head><body><a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a></body></html>';
}
?>
