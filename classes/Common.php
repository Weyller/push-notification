<?php

namespace classes;

class Common {

	protected $deviceToken;

	protected $key;

	protected $message;

	protected $sound;

	protected $redirectUrl;

	protected $consultId;

	public function __construct($params = array()) {
		
		$this->setDeviceToken($params['deviceToken']);
		$this->setKey($params['key']);
		$this->setMessage($params['message']);
		$this->setSound($params['sound']);
		$this->setRedirectUrl($params['extra']['url']);
		$this->setConsultId($params['extra']['consultId']);
	}

	public function getDeviceToken() {
		return $this->deviceToken;
	}	

	public function setDeviceToken($deviceToken){
		$this->deviceToken = $deviceToken;
	}

	public function getKey() {
		return $this->key;
	}	

	public function setKey($key){
		$this->key = $key;
	}

	public function getMessage() {
		return $this->message;
	}	

	public function setMessage($message){
		$this->message = $message;
	}

	public function getSound() {
		return $this->sound;
	}	

	public function setSound($sound){
		$this->sound = $sound;
	}

	public function getRedirectUrl() {
		return $this->redirectUrl;
	}	

	public function setRedirectUrl($redirectUrl){
		$this->redirectUrl = $redirectUrl;
	}

	public function getConsultId() {
		return $this->consultId;
	}	

	public function setConsultId($consultId){
		$this->consultId = $consultId;
	}
}