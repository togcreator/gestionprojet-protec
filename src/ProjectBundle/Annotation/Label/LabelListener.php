<?php

namespace ProjectBundle\Annotation\Label;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LabelListener implements EventSubscriber {

    /**
     * @var LabelReader
     */
    private $reader;
    private $accessor;
    private $request;

    public function __construct($reader, $container)
    {
        $this->reader = $reader;
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->request = $container->get('request_stack')->getCurrentRequest();
        $this->lib_lang = ['fr' => 'lib0', 'en' => 'lib1', 'nl' => 'lib2', 'de' => 'lib3', 'es' => 'lib4', 'it' => 'lib5'];

        // getting lang
        $this->locale = '';
        $this->default_locale = $this->lib_lang['fr'];
    }

    // prePersist
    public function prePersist (EventArgs $event) 
    {   
        // entity
        $entity = $event->getEntity();
        // setting
        $this->setToSave($entity);
    }

        // prePersist
    public function preUpdate (EventArgs $event) 
    {   
        // entity
        $entity = $event->getEntity();
        // setting
        $this->setToSave($entity);
    }

    // preLoad
    public function postLoad (LifecycleEventArgs $event) 
    {
        // entity
        $entity = $event->getEntity();

        // setting
        $this->setToList($entity);
    }

    public function postPersist (EventArgs $event) 
    {
        // entity
        $entity = $event->getEntity();
        // setting
        $this->setToList($entity);
    }

    // event list
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
        ];
    }

    // locale
    public function _locale () 
    {
        $locale = 'fr';

        if( $this->request !== null )
            $locale = $this->request->getLocale(); // bug in constructor

        // if( count($_SESSION) && array_key_exists('_sf2_attributes', $_SESSION) )
        //     if( array_key_exists('_locale', $_SESSION['_sf2_attributes']) )
        //         $locale = $_SESSION['_sf2_attributes']['_locale'];
        return $locale;
    }

    // is a LabelClass Annotation
    protected function isLabelClass ($entity) 
    {
        // test if annotation own LabelClass
        $reflection = new \ReflectionClass(get_class($entity));
        return $this->reader->getClassAnnotation($reflection, LabelClass::class);
    }

    // settting to save label
    protected function setToSave ($entity) 
    {
        // stop if not label class
        if( !$this->isLabelClass($entity) ) return;
        // getting locale
        $locale = $this->_locale();

        // set value label to lib
        foreach($this->lib_lang as $lang => $lib)
        {
            if( $lang == $locale )
                $this->accessor->setValue($entity, $lib, $this->accessor->getValue($entity, 'label'));

            if(empty($this->accessor->getValue($entity, $lib))) {
                $default = $this->accessor->getValue($entity, $this->default_locale);
                $this->accessor->setValue($entity, $lib, $default ? $default : $this->accessor->getValue($entity, 'label'));
            }
        }
    }

    // setting value to retrieve
    protected function setToList($entity)
    {
        // stop if not label class
        if( !$this->isLabelClass($entity) ) return;

        // getting locale
        $locale = $this->_locale();
        
        // for
        foreach($this->lib_lang as $lang => $lib)
            if( $lang == $locale )
            {   
                $value = $this->accessor->getValue($entity, $lib);
                $value = !empty($value) ? $value : $this->accessor->getValue($entity, $this->default_locale);
                $this->accessor->setValue($entity, 'label', $value);
            }
    }
}