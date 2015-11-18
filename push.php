<?php

require_once 'autoload.php';

$params = json_decode($_POST['body'], true);

if(!$params['deviceType']) {
    echo 'Invalid request';
    break;
}

$className = 'classes\\' . ucfirst(strtolower($params['deviceType']));

$pushNotificationObj = new $className($params);
echo $pushNotificationObj->send();