<?php
 
/**
 * Description of Simplesaml
 *
 * @author asasmoyo
 */
class Simplesaml {
 
    private static $instance;
    private static $path = '/var/www/simplesamlphp-1.12.0/lib/_autoload.php';
    private static $authSource = 'default-sp';
    private $authSimple;
    private $attributes;
 
    private function __construct() {
        require_once self::$path;
        //kalo yii
        YiiBase::registerAutoloader('SimpleSAML_autoload', true);
        
        $this->authSimple = new \SimpleSAML_Auth_Simple(self::$authSource);
        $this->attributes = $this->authSimple->getAttributes();
    }
 
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Simplesaml;
        }
        return self::$instance;
    }
 
    public function requireAuth() {
        $this->authSimple->requireAuth();
    }
 
    public function login(array $params = array()) {
        $this->authSimple->login($params);
    }
 
    public function logout() {
        $this->authSimple->logout();
    }
 
    public function getLoginURL($returnTo = null) {
        $this->authSimple->getLogoutUrl($returnTo);
    }
 
    public function getLogoutURL($returnTo = null) {
        $this->authSimple->getLogoutUrl($returnTo);
    }
 
    public function getAttributes() {
        return $this->attributes;
    }
 
    public function isAuthenticated() {
        return $this->authSimple->isAuthenticated();
    }
 
    public function __get($name) {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
 
}