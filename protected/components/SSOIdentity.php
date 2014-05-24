<?php

/*
 * The _autoload.php will register SimpleSAMLphp's own autoloader, which shall be prepended before Yii's autoloader.
 * Therefore we will unregister and then register again the autoloader of Yii, which is the same process Yii:: registerAutoloader() would do.
 */
spl_autoload_unregister(array('YiiBase','autoload'));
require_once "/var/www/simplesamlphp-1.12.0/lib/_autoload.php";
require_once "/var/www/simplesamlphp-1.12.0/lib/SimpleSAML/Auth/Simple.php";
spl_autoload_register(array('YiiBase','autoload'));

/**
 * Defines an identity authenticated with the SSO academic registry system through SimpleSAMLphp.
 * The SSO system is used at severel hungarian universities.
 * 
 * @property string $id The SSO code of the user, which uniquely represents the identity.
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
	 * Creates a new SSOIdentity instance.
	 */
	public function __construct()
	{
		$this->_simpleSaml = new SimpleSAML_Auth_Simple('default-sp');
		$this->_attributes = $this->_simpleSaml->getAttributes();
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
	 * Returns the SSO code of the user.
	 * The SSO code uniquely represents the identity.
	 * @return string The SSO code of the user.
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
	 * Returns the display alamat for the identity.
	 * @return string The alamat of the user.
	 */
	public function getAlamat()
	{
		return $this->alamat;
	}

        
	/**
	 * Returns the display telp for the identity.
	 * @return string The telp of the user.
	 */
	public function getTelp()
	{
		return $this->telp;
	}

	/**
	 * Returns the display email_address for the identity.
	 * @return string The email_address of the user.
	 */
	public function getEmail()
	{
		return $this->email_address;
	}
        
	/**
	 * Returns the display kode_kab for the identity.
	 * @return string The kode_kab of the user.
	 */
	public function getKab()
	{
		return $this->kode_kab;
	}
        
	/**
	 * Returns the display kode_provinsi for the identity.
	 * @return string The kode_provinsi of the user.
	 */
	public function getProv()
	{
		return $this->kode_provinsi;
	}
        
	/**
	 * Returns the display level for the identity.
	 * @return string The level of the user.
	 */
	public function getLevel()
	{
		return $this->level;
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