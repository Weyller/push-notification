<?php

namespace classes;

class Android extends Common {

	protected $title;

	protected $subTitle;

	protected $tickerText;

	protected $vibrate;

	public function __construct($params = array()) {

		parent::__construct($params);
		
		$this->setTitle($params['title']);
		$this->setSubTitle($params['subTitle']);
		$this->setTickerText($params['tickerText']);
		$this->setVibrate($params['vibrate']);
	}

	public function getTitle() {
		return $this->title;
	}	

	public function setTitle($title){
		$this->title = $title;
	}

	public function getSubTitle() {
		return $this->subTitle;
	}	

	public function setSubTitle($subTitle){
		$this->subTitle = $subTitle;
	}

	public function getTickerText() {
		return $this->tickerText;
	}	

	public function setTickerText($tickerText){
		$this->tickerText = $tickerText;
	}

	public function getVibrate() {
		return $this->vibrate;
	}	

	public function setVibrate($vibrate){
		$this->vibrate = $vibrate;
	}

	private function getPayload(){

		$fields = array(
	        'registration_ids' => array($this->getDeviceToken()),
	        'data' => array(
	            'message'       => $this->getMessage(),
	            'title'         => $this->getTitle(),
	            'subTitle'      => $this->getSubTitle(),
	            'tickerText'    => $this->getTickerText(),
	            'vibrate'       => $this->getVibrate(),
	            'sound'         => $this->getSound(),
            	'url' => $this->getRedirectUrl(),
            	'consultId' => $this->getConsultId()
	        ),
	        'time_to_live' => NOTIFICATION_EXPIRY_TIME
    	);

    	return $fields;
	}

	private function getHeaders() {

		$headers = array(
	        'Authorization: key=' . $this->getKey(),
	        'Content-Type: application/json'
    	);

    	return $headers;
	}

	public function send(){

		$ch = curl_init();
	    curl_setopt( $ch,CURLOPT_URL, GCM_API_URL );
	    curl_setopt( $ch,CURLOPT_POST, true );
	    curl_setopt( $ch,CURLOPT_HTTPHEADER, $this->getHeaders() );
	    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $this->getPayload() ) );
	    $result = curl_exec($ch );
	    curl_close( $ch );
	    return $result;
	}
}