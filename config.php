<?php

define("GCM_API_URL", "https://android.googleapis.com/gcm/send");

define("NOTIFICATION_EXPIRY_TIME", 600);//10 min

define("APNS_DEV_API_URL", "ssl://gateway.sandbox.push.apple.com:2195");
define("APNS_PROD_API_URL", "ssl://gateway.push.apple.com:2195");

define("DEV_CERTIFICATE_PATH", "certificates/certificates-dev-push-notification.pem");
define("PROD_CERTIFICATE_PATH", "certificates/certificates-push-notification.pem");