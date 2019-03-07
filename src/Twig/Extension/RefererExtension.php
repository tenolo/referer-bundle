<?php

namespace Tenolo\Bundle\RefererBundle\Twig\Extension;

use Psr\Http\Message\UriInterface;
use Tenolo\Bundle\RefererBundle\Service\RefererManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class RefererExtension
 *
 * @package Tenolo\Bundle\RefererBundle\Twig\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class RefererExtension extends AbstractExtension
{

    /** @var RefererManagerInterface */
    protected $manager;

    /**
     * @param RefererManagerInterface $manager
     */
    public function __construct(RefererManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('referer_reset', [$this, 'resetReferer']),
            new TwigFunction('referer_get', [$this, 'getReferer']),
            new TwigFunction('referer_set', [$this, 'setReferer']),
            new TwigFunction('referer_has', [$this, 'hasReferer']),
            new TwigFunction('referer_uri', [$this, 'getRefererUri']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('referer_query', [$this, 'addRefererQuery']),
        ];
    }

    /**
     * @param $url
     *
     * @return UriInterface
     */
    public function addRefererQuery($url)
    {
        return $this->manager->addRefererQuery($url);
    }

    /**
     *
     */
    public function resetReferer()
    {
        $this->manager->resetCurrentReferer();
    }

    /**
     * @return bool
     */
    public function hasReferer()
    {
        return $this->manager->getReferer() !== null;
    }

    /**
     * @param null $default
     *
     * @return string|null
     */
    public function getReferer($default = null)
    {
        return $this->manager->getReferer($default);
    }

    /**
     * @param null $default
     *
     * @return UriInterface
     */
    public function getRefererUri($default = null)
    {
        return $this->manager->getRefererUri($default);
    }

    /**
     * @param $referer
     */
    public function setReferer($referer)
    {
        $this->manager->setCurrentReferer($referer);
    }

}
