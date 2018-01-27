<?php

namespace ProjectBundle\Annotation\Date;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpKernel\KernelEvents;

class DateListener implements EventSubscriber {

    /**
     * @var LabelReader
     */
    private $reader;
    private $accessor;
    private $reflection;

    public function __construct($reader)
    {
        $this->reader = $reader;
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    // prePersist
    public function preFlush (EventArgs $event) 
    {   
        // entity
        $em = $event->getEntityManager();
        $uow = $em->getUnitOfWork();
        $entities = [];

        $cu = $uow->getScheduledEntityUpdates();
        // extract
        foreach($uow->getScheduledEntityInsertions() as $entity) 
            $entities[] = $entity;
        foreach($uow->getScheduledEntityUpdates() as $entity) 
            $entities[] = $entity;

        // setting
        $this->setToSave($entities);
    }

    // preLoad
    public function preUpdate (EventArgs $event) 
    {
        // entity
        $entity = $event->getEntity();
        $this->setToSave([$entity]);
    }

    // preLoad
    public function postLoad (EventArgs $event) 
    {
        // entity
        $entity = $event->getEntity();
        // setting
        $this->setToList([$entity]);
    }

    // event list
    public function getSubscribedEvents()
    {
        return [
            'preFlush',
            'preUpdate',
            // 'postLoad',
        ];
    }

    // is a LabelClass Annotation
    protected function isDateClass ($entity) 
    {
        // test if annotation own LabelClass
        $this->reflection = new \ReflectionClass(get_class($entity));
        return $this->reader->getClassAnnotation($this->reflection, DateClass::class);
    }

    // settting to save label
    protected function setToSave ($entities) 
    {
        foreach($entities as $entity)
        {
            // stop if not label class
            if( !$this->isDateClass($entity) ) continue;

            // retrieve data date
            $properties = $this->retrieveDate();
            if(!count($properties)) return;

            // set value label to lib
            foreach($properties as $property)
            {
                $date = $this->accessor->getValue($entity, $property->getName());
                if(is_object($date)) continue;
                $date = str_replace('-', '/', $date);
                $date = strlen($date) ? $date : '0000-00-00';
                if( !$date ) continue;
                $this->accessor->setValue($entity, $property->getName(), new \DateTime($date));
            }
        }
    }

    // to retrieve
    protected function retrieveDate () 
    {
        $properties = [];
        foreach( $this->reflection->getProperties() as $property )
            if(strpos($property->getName(), 'date') === 0)
                $properties[] = $property;

        // return properties
        return $properties;
    }

    // setting value to retrieve
    // protected function setToList($entities)
    // {
        // foreach($entities as $entity)
        // {
        //     // stop if not label class
        //     if( !$this->isDateClass($entity) ) return;

        //     // retrieve data date
        //     $properties = $this->retrieveDate();
        //     if(!count($properties)) return;
        
        //     // set value label to lib
        //     foreach($properties as $property)
        //     {
        //         $date = $this->accessor->getValue($entity, $property->getName());
        //         if( !$date ) continue;
        //         $this->accessor->setValue($entity, $property->getName(), (new \DateTime($date))->format('Y-m-d'));
        //     }
        // }

    // }
}