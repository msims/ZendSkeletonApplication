<?php

namespace SwebContact\Service;

use Traversable;
use SwebContact\Form\ContactFilter;
use SwebContact\Form\ContactForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class ContactFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $name    = $config['sweb_contact']['form']['name'];
        $captcha = $services->get('SwebContactCaptcha');
        $filter  = new ContactFilter();
        $form    = new ContactForm($name, $captcha);
        $form->setInputFilter($filter);
        return $form;
    }
}