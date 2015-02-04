<?php


/**
 * \AppserverIo\Apps\WhoAmI\Entities\User
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/whoami
 * @link      http://www.appserver.io/
 */

namespace AppserverIo\Apps\WhoAmI\Entities;

use AppserverIo\Apps\WhoAmI\Interfaces\EntityInterface;

/**
 * User entity
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/whoami
 * @link      http://www.appserver.io/
 */
class User implements EntityInterface
{
    /**
     * @var integer
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $userLocale;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $password;

    /**
     * @var boolean
     *
     * @Column(type="boolean")
     */
    protected $enabled;

    /**
     * Returns the value of the class member userId.
     *
     * @return integer Holds the value of the class member userId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value for the class member userId.
     *
     * @param integer $id Holds the value for the class member userId
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the value of the class member email.
     *
     * @return string Holds the value of the class member email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value for the class member email.
     *
     * @param string $email Holds the value for the class member email
     *
     * @return void
     *
     * @ensures is_string(filter_var($this->email, FILTER_VALIDATE_EMAIL))
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the value of the class member username.
     *
     * @return string Holds the value of the class member username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the value for the class member username.
     *
     * @param string $username Holds the value for the class member username
     *
     * @return void
     *
     * @ensures !empty($this->username)
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Returns the value of the class member userLocale.
     *
     * @return string Holds the value of the class member userLocale
     */
    public function getUserLocale()
    {
        return $this->userLocale;
    }

    /**
     * Sets the value for the class member userLocale.
     *
     * @param string $userLocale Holds the value for the class member userLocale
     *
     * @return void
     */
    public function setUserLocale($userLocale)
    {
        $this->userLocale = $userLocale;
    }

    /**
     * Returns the value of the class member password.
     *
     * @return string Holds the value of the class member password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value for the class member password.
     *
     * @param string $password Holds the value for the class member password
     *
     * @return void
     *
     * !empty($this->password)
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the value of the class member enabled.
     *
     * @return boolean Holds the value of the class member enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Sets the value for the class member enabled.
     *
     * @param boolean $enabled Holds the value for the class member enabled
     *
     * @return void
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}
