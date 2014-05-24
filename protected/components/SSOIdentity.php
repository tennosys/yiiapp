<?php

/*
 * We assume that the SimpleSAMLphp is installed in the webroot. Modify if necessary.
 * The _autoload.php will register SimpleSAMLphp's own autoloader, which shall be prepended before Yii's autoloader.
 * Therefore we will unregister and then register again the autoloader of Yii, which is the same process Yii:: registerAutoloader() would do.
 */
spl_autoload_unregister(array('YiiBase','autoload'));
require_once "/var/www/simplesamlphp-1.12.0/lib/_autoload.php";
require_once "/var/www/simplesamlphp-1.12.0/lib/SimpleSAML/Auth/Simple.php";
spl_autoload_register(array('YiiBase','autoload'));

/**
 * Defines an identity authenticated with the Neptun academic registry system through SimpleSAMLphp.
 * The Neptun system is used at severel hungarian universities.
 * 
 * @property string $id The Neptun code of the user, which uniquely represents the identity.
 * @property-read string $name The display name for the identity.
 * @property-read boolean $isAuthenticated Whether the identity is valid.
 * @property-read array $persistentStates Additional identity information that needs to be persistent during the user session (excluding {@link id}).
 * @property-read string $loginURL The login URL provided by SimpleSAMLphp.
 * @property-read string $logoutURL The logout URL provided by SimpleSAMLphp.
 */
class SSOIdentity extends CComponent implements IUserIdentity
{
	/**
	 * @var SimpleSAML_Auth_Simple Stores the SAML authenticator.
	 */
	protected $_simpleSaml;
	/**
	 * @var array Stores the received attributes of the identity.
	 */
	protected $_attributes = array();
	
	/**
	 * Creates a new NeptunIdentity instance.
	 */
	public function __construct()
	{
		$this->_simpleSaml = new SimpleSAML_Auth_Simple('default-sp');
		$this->_attributes = $this->_simpleSaml->getAttributes();
	}
	
        public static function getInstance() {
            if (self::$instance == null) {
                self::$instance = new SSOIdentity();
            }
            return self::$instance;
        }
        
	/**
	 * Authenticates the user.
	 * 
	 * This method must succeed if returns.
	 * @return boolean True if the authentication succeded, otherwise false.
	 */
	public function authenticate()
	{
		$this->_simpleSaml->requireAuth();
		if($this->_simpleSaml->isAuthenticated())
		{
			$this->_attributes = $this->_simpleSaml->getAttributes();
			return true;
		}
		else
			return false;
	}

	/**
	 * Returns the Neptun code of the user.
	 * The Neptun code uniquely represents the identity.
	 * @return string The Neptun code of the user.
	 */
	public function getId()
	{
		return $this->nrm;
	}
	
	/**
	 * Returns the display name for the identity.
	 * @return string The name of the user.
	 */
	public function getName()
	{
		return $this->nama;
	}

	/**
	 * Returns a value indicating whether the identity is authenticated.
	 * @return boolean Whether the identity is valid.
	 */
	public function getIsAuthenticated()
	{
		return !empty($this->_attributes);
	}

	/**
	 * Returns the additional identity information that needs to be persistent during the user session.
	 * @return array Additional identity information that needs to be persistent during the user session (excluding {@link id}).
	 */
	public function getPersistentStates()
	{
		return $this->_attributes;
	}
	
	/**
	 * Returns the login URL.
	 * @return string The login URL.
	 */
	public function getLoginURL()
	{
		return $this->_simpleSaml->getLoginURL();
	}
	
	/**
	 * Returns the logout URL.
	 * @param string $returnUrl The URL to return the user to after the logout.
	 * @return string The logout URL.
	 */
	public function getLogoutURL($returnUrl = null)
	{
		return $this->_simpleSaml->getLogoutURL($returnUrl);
	}
	
	/**
	 * Returns the value of an attribute.
	 * @param string $name Name of the attribute.
	 * @return mixed The value of the attribute.
	 * @throws CException if the attribute does not exist.
	 */
	public function getAttribute($name)
	{
		if(isset($this->_attributes[$name]))
			return $this->_attributes[$name];
		throw new CException("The requested attribute '{$name}' does not exist.");
	}
	
	/**
	 * Checks if a property value is null.
	 * @param string $name Name of the property.
	 * @return boolean True if the property is not null, otherwise false.
	 * @see __get
	 */
	public function __isset($name)
	{
		return isset($this->_attributes[$name]) || parent::__isset($name);
	}
	
	/**
	 * Returns the value of a property.
	 * @param string $name Name of the property.
	 * @return mixed The value of the property.
	 * @see __isset
	 */
	public function __get($name)
	{
		if(!isset($this->_attributes[$name]))
			return parent::__get($name);
		if(is_array($this->_attributes[$name]) && count($this->_attributes[$name]) == 1)
			return $this->_attributes[$name][0];
		else
			return $this->_attributes[$name];
	}
}