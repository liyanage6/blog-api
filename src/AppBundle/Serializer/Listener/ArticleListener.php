<?php

namespace AppBundle\Serializer\Listener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class ArticleListener implements EventSubscriberInterface
{

    /**
     * Returns the events to which this class has subscribed.
     *
     * Return format:
     *     array(
     *         array('event' => 'the-event-name', 'method' => 'onEventName', 'class' => 'some-class', 'format' => 'json'),
     *         array(...),
     *     )
     *
     * The class may be omitted if the class wants to subscribe to events of all classes.
     * Same goes for the format key.
     *
     * @return array
     */
    public static function getSubscribedEvents ()
    {
        return [
            [
                'event'     => Events::POST_SERIALIZE,
                'format'    => 'json',
                'class'     => 'AppBundle\Entity\Article',
                'method'    => 'onPostSerialize'
            ]
        ];
    }

    public static function onPostSerialize (ObjectEvent $event)
    {
        // Possibilité de récupérer l'objet qui a été sérialisé
        $object = $event->getObject();

        $date = new \DateTime();

        dump($event->getVisitor(), $object);die;
        // Possibilité de modifier le tableau après sérialisation
        /**
         * TODO: Erreur ajout heure non prise en charge
         */
//        $event->getVisitor()->addData('delivered_at ', $date->format('l jS \of F Y h:i:s A'));
    }
}