<?php
namespace SocialAuth\Auth\Identity;

use SocialAuth\Resource\Facebook as Resource;

class Facebook extends Generic {
	protected $_api;
	
	public function __construct($token) {
		$this->_api = new Resource ( $token );
		$this->_name = 'facebook';
		$this->_id = $this->_api->getId ();
	}
	
	public function getApi() {
		return $this->_api;
	}
}

