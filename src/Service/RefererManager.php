<?php

namespace Tenolo\Bundle\RefererBundle\Service;

use League\Uri\Http;
use League\Uri\Modifiers\AppendQuery;
use League\Uri\Modifiers\MergeQuery;
use League\Uri\Modifiers\RemoveQueryParams;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class RefererManager
 *
 * @package Tenolo\Bundle\RefererBundle\Service
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class RefererManager implements RefererManagerInterface
{

    /** @var RequestStack */
    protected $requestStack;

    /** @var SessionInterface */
    protected $session;

    /** @var string */
    protected $sessionName;

    /**
     * @param RequestStack     $requestStack
     * @param SessionInterface $session
     * @param                  $sessionName
     */
    public function __construct(RequestStack $requestStack, SessionInterface $session, $sessionName)
    {
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->sessionName = $sessionName;
    }

    /**
     * @inheritdoc
     */
    public function addRefererQuery($url)
    {
        $uri = Http::createFromString($url);
        $request = $this->requestStack->getMasterRequest();

        if ($request !== null) {
            $refererUri = Http::createFromString($request->getUri());

            $modifier = new RemoveQueryParams(['reset_ref']);
            $refererUri = $modifier->process($refererUri);

            $modifier = new AppendQuery('ref='.urlencode($refererUri));
            $uri = $modifier->process($uri);
        }

        return $uri;
    }

    /**
     * @inheritdoc
     */
    public function getReferer($default = null)
    {
        $referer = $this->session->get($this->sessionName);

        if ($referer === null) {
            $referer = $this->requestStack->getMasterRequest()->headers->get('referer', $default);
        }

        return $referer;
    }

    /**
     * @inheritdoc
     */
    public function getRefererUri($default = null)
    {
        $referer = $this->getReferer($default);

        $uri = Http::createFromString($referer);

        if ($this->hasCurrentReferer()) {
            $modifier = new MergeQuery('reset_ref');
            $uri = $modifier->process($uri);
        }

        return $uri;
    }

    /**
     * @inheritdoc
     */
    public function hasCurrentReferer()
    {
        return $this->session->has($this->sessionName);
    }

    /**
     * @inheritdoc
     */
    public function getCurrentReferer()
    {
        return $this->session->get($this->sessionName);
    }

    /**
     * @inheritdoc
     */
    public function setCurrentReferer($currentReferer)
    {
        $this->session->set($this->sessionName, $currentReferer);
    }

    /**
     * @inheritdoc
     */
    public function resetCurrentReferer()
    {
        $this->session->remove($this->sessionName);
    }

}
