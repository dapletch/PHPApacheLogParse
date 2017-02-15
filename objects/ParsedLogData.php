<?php

/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/13/2017
 * Time: 8:56 PM
 */
class ParsedLogData
{
    private $ipAddress;
    private $remoteUser;
    private $timeAccessed;
    private $request;
    private $statCd;
    private $bytesSent;
    private $timeEntered;

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return mixed
     */
    public function getRemoteUser()
    {
        return $this->remoteUser;
    }

    /**
     * @param mixed $remoteUser
     */
    public function setRemoteUser($remoteUser)
    {
        $this->remoteUser = $remoteUser;
    }

    /**
     * @return mixed
     */
    public function getTimeAccessed()
    {
        return $this->timeAccessed;
    }

    /**
     * @param mixed $timeAccessed
     */
    public function setTimeAccessed($timeAccessed)
    {
        $this->timeAccessed = $timeAccessed;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getStatCd()
    {
        return $this->statCd;
    }

    /**
     * @param mixed $statCd
     */
    public function setStatCd($statCd)
    {
        $this->statCd = $statCd;
    }

    /**
     * @return mixed
     */
    public function getBytesSent()
    {
        return $this->bytesSent;
    }

    /**
     * @param mixed $bytesSent
     */
    public function setBytesSent($bytesSent)
    {
        $this->bytesSent = $bytesSent;
    }

    /**
     * @return mixed
     */
    public function getTimeEntered()
    {
        return $this->timeEntered;
    }

    /**
     * @param mixed $timeEntered
     */
    public function setTimeEntered($timeEntered)
    {
        $this->timeEntered = $timeEntered;
    }
}
?>