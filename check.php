<?php

    ini_set('default_socket_timeout', 5);
	ini_set('user_agent', 'Kodi/16.0');

    if(!$fp = @fopen($_GET['url'], "r")) {
        echo '<data>false<data>';
    } else {
        echo '<data>true<data>';
        fclose($fp);
    }

?>
