<?php

namespace Tenolo\Bundle\RefererBundle\EventListener;

use League\Uri\Http;
use League\Uri\Modifiers\RemoveQueryParams;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Tenolo\Bundle\RefererBundle\Service\RefererManager;

/**
 * Class RefererListener
 *
 * @package Tenolo\Bundle\RefererBundle\EventListener
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class RefererListener implements EventSubscriberInterface
{

    /** @var RefererManager */
    protected $manager;

    /** @var bool */
    protected $removeParams;

    /**
     * @param RefererManager $manager
     * @param                $removeParams
     */
    public function __construct(RefererManager $manager, $removeParams)
    {
        $this->manager = $manager;
        $this->removeParams = $removeParams;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onRequest',
        ];
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request === null) {
            return;
        }

        if ($request->query->has('ref')) {
            $this->manager->setCurrentReferer($request->query->get('ref'));

            if ($this->removeParams === true) {
                $uri = Http::createFromString($request->getUri());
                $modifier = new RemoveQueryParams(['ref']);
                $uri = $modifier->process($uri);

                $event->setResponse(new RedirectResponse($uri->__toString()));
                $event->stopPropagation();
            }
        }

        if ($request->query->has('reset_ref')) {
            $this->manager->resetCurrentReferer();

            if ($this->removeParams === true) {
                $uri = Http::createFromString($request->getUri());
                $modifier = new RemoveQueryParams(['reset_ref']);
                $uri = $modifier->process($uri);

                $event->setResponse(new RedirectResponse($uri->__toString()));
                $event->stopPropagation();
            }
        }
    }

}
