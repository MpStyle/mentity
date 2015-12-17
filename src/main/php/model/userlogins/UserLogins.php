<?php
namespace mpstyle\mtoolkit\mentity\model\userlogins;

class UserLogins
{
    private $id=-1;
    
    /**
     * @var string
     */
    private $loginProvider="";

    /**
     * @var string
     */
    private $providerKey="";

    /**
     * @var string
     */
    private $userId="";

    /**
     * @return string
     */
    public function getLoginProvider()
    {
        return $this->loginProvider;
    }

    /**
     * @param string $loginProvider
     * @return UserLogins
     */
    public function setLoginProvider($loginProvider)
    {
        $this->loginProvider = $loginProvider;
        return $this;
    }

    /**
     * @return string
     */
    public function getProviderKey()
    {
        return $this->providerKey;
    }

    /**
     * @param string $providerKey
     * @return UserLogins
     */
    public function setProviderKey($providerKey)
    {
        $this->providerKey = $providerKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return UserLogins
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserLogins
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    
}