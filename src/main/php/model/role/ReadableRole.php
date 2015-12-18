<?php
namespace mpstyle\mtoolkit\mentity\model\role;

interface ReadableRole
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();
}