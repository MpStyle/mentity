<?php
namespace mpstyle\mtoolkit\mentity\model\provider;

interface ReadableProvider
{
    /**
     * @return string
     */
    public function getLoginProvider();

    /**
     * @return string
     */
    public function getProviderKey();

    /**
     * @return string
     */
    public function getUserId();

    /**
     * @return int
     */
    public function getId();
}