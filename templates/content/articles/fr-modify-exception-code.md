---
title: "Modifier une exception à la volée avec l'EventSubscriberInterface"
publishedAt: "2019-11-28"
description: Pas si simple de modifier une exception à la volée...
tags: [Symfony, PHP]
image: "/public/build/images/logo/symfony.png"
category: "development"
lang: "fr"
---

## HowTo

````php

<?php

namespace EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;

/**
 * For a system that does not follow Unix / C++ conventions,
 * This subscriber will change on the fly commands return codes :
 *
 * - Common: 0 (unix-like)
 * - Warning: 1 (An anomaly was detected, no interruption, no opening of an incident needed.)
 * - Error: 2 (An anomaly was detected, no interruption, but opening an incident is needed.)
 * - Critical: 3 (An anomaly was detected, interruption of the program, opening of an incident.)
 * vs
 * @see http://www.tldp.org/LDP/abs/html/exitcodes.html
 *
 * @author Arnaud Tiérant <arnaud@tierant.fr>
 */
class ConsoleSubscriber implements EventSubscriberInterface
{
    /**
     * @see https://symfony.com/doc/3.4/components/console/events.html
     * @see https://symfony.com/doc/3.4/event_dispatcher.html#creating-an-event-subscriber
     */
    public static function getSubscribedEvents()
    {
        return [
           ConsoleEvents::ERROR => [
               ['processException', 0],
           ],
        ];
    }

    /**
     * @var ConsoleErrorEvent $event
     */
    public function processException(ConsoleErrorEvent $event)
    {
        // Implement Business logic here...
        $event->setExitCode(3);
    }
}

````
