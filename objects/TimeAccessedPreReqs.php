<?php

/**
 * Created by PhpStorm.
 * User: Seth
 * Date: 2/15/2017
 * Time: 1:34 PM
 */
class TimeAccessedPreReqs
{
    private $maxTimeEntered;
    private $minTimeAccessed;
    private $maxTimeAccessed;

    /**
     * @return mixed
     */
    public function getMaxTimeEntered()
    {
        return $this->maxTimeEntered;
    }

    /**
     * @param mixed $maxTimeEntered
     */
    public function setMaxTimeEntered($maxTimeEntered)
    {
        $this->maxTimeEntered = $maxTimeEntered;
    }

    /**
     * @return mixed
     */
    public function getMinTimeAccessed()
    {
        return $this->minTimeAccessed;
    }

    /**
     * @param mixed $minTimeAccessed
     */
    public function setMinTimeAccessed($minTimeAccessed)
    {
        $this->minTimeAccessed = $minTimeAccessed;
    }

    /**
     * @return mixed
     */
    public function getMaxTimeAccessed()
    {
        return $this->maxTimeAccessed;
    }

    /**
     * @param mixed $maxTimeAccessed
     */
    public function setMaxTimeAccessed($maxTimeAccessed)
    {
        $this->maxTimeAccessed = $maxTimeAccessed;
    }
}