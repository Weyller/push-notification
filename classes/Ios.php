<?php

namespace classes;

class Ios extends Common {

	protected $badge;

	public function __construct($params = array()) {

		parent::__construct($params);
		
		$this->setBadge($params['badge']);
	}

	public function getBadge() {
		return $this->badge;
	}	

	public function setBadge($badge){
		$this->badge = $badge;
	}

	private function getPayload(){

		$fields['aps'] = array(
	        'alert'  => $this->getMessage(),
	       	'sound'  => $this->getSound(),
	       	'badge'  => $this->getBadge(),
	       	'url' => $this->getRedirectUrl(),
            'consultId' => $this->getConsultId(),
            'content_available' => true
    	);

    	return json_encode($fields);
	}

	public function send() {
	    
	    $ctx = stream_context_create();
	    stream_context_set_option($ctx, 'ssl', 'local_cert', DEV_CERTIFICATE_PATH);
	    stream_context_set_option($ctx, 'ssl', 'passphrase', $this->getKey());

		// Open a connection to the APNS server
	    $fp = stream_socket_client(
	        APNS_DEV_API_URL, $err,
	        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	     
	    if (!$fp) {
	    	$status = "Failed to connect: $err $errstr" . PHP_EOL;
	    	return $status;
	    }
	     
	    echo 'Connected to APNS' . PHP_EOL;
	    
	    $msg = $this->buildBinaryMessage();
	    
	    // Send it to the server
	    $result = $this->sendMessage($fp, $msg);

	    if (!$result)
	        $status = 'Message not delivered' . PHP_EOL;
	    else
	        $status = 'Message successfully delivered' . PHP_EOL;
	     
	    // Close the connection to the server
	    fclose($fp);

	    return $status;
	}

	private function buildBinaryMessage(){

		// Build the binary notification
	    //$msg = chr(0) . pack('n', 32) . pack('H*', $this->getDeviceToken()) . pack('n', strlen($this->getFields())) . $this->getFields();

		$inner = chr(1)
			    . pack('n', 32)
			    . pack('H*', $this->getDeviceToken())

			    . chr(2)
			    . pack('n', strlen($this->getPayload()))
			    . $this->getPayload()

			    . chr(4)
			    . pack('n', 4)
			    . pack('N', time() + NOTIFICATION_EXPIRY_TIME);

		$msg = chr(2) . pack('N', strlen($inner)) . $inner;   

	    return $msg;
	}

	private function sendMessage($fp, $msg){

		return fwrite($fp, $msg, strlen($msg));
	}
}

?>