<?php

namespace Tenolo\Bundle\RefererBundle\Service;

use Psr\Http\Message\UriInterface;

/**
 * Interface RefererManagerInterface
 *
 * @package Tenolo\Bundle\RefererBundle\Service
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface RefererManagerInterface
{

    /**
     * @param $url
     *
     * @return UriInterface
     */
    public function addRefererQuery($url);

    /**
     * @param null $default
     *
     * @return string|null
     */
    public function getReferer($default = null);

    /**
     * @param null $default
     *
     * @return UriInterface
     */
    public function getRefererUri($default = null);

    /**
     * @return string|null
     */
    public function hasCurrentReferer();

    /**
     * @return string|null
     */
    public function getCurrentReferer();

    /**
     * @param string|null $currentReferer
     */
    public function setCurrentReferer($currentReferer);

    /**
     *
     */
    public function resetCurrentReferer();

}
