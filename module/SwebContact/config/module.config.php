<?php

namespace SwebContact;

return array(
    'sweb_contact' => array(
        // This is simply configuration to pass to Zend\Captcha\Factory
        'captcha' => array(
            'class'   => 'Zend\Captcha\Dumb',/*
            'options' => array(
                'pubkey'  => 'RECAPTCHA_PUBKEY_HERE',
                'privkey' => 'RECAPTCHA_PRIVKEY_HERE',
            ),     */
        ),
        'form' => array(
            'name' => 'contact',
        ),
        // This sets the default "to" and "sender" headers for your message
        'message' => array(

            // These can be either a string, or an array of email => name pairs
            'to'     => 'matthew@tarryn.com',
            'from'   => 'noreply@tarryn.com',
            // This should be an array with minimally an "address" element, and
            // can also contain a "name" element
            /*
            'sender' => array(
                'address' => 'contact@your.tld'
            ),
             */
        ),

        // Transport consists of two keys:
        // - "class", the mail tranport class to use, and
        // - "options", any options to use to configure the
        //   tranpsort. Usually these will be passed to the
        //   transport-specific options class
        // This example configures GMail as your SMTP server
        'mail_transport' => array(
            'class'   => 'Zend\Mail\Transport\Smtp',
            'options' => array(
                'host'             => 'smtp.gmail.com',
                'port'             => 587,
                'connectionClass'  => 'login',
                'connectionConfig' => array(
                    'ssl'      => 'tls',
                    'username' => 'matthew@tarryn.com',
                    'password' => '$tarryn72',
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'SwebContact\Controller\Contact' => 'SwebContact\Service\ContactControllerFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/contact',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SwebContact\Controller',
                        'controller'    => 'Contact',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process',
                            'defaults' => array(
                                'action' => 'process'
                            ),
                        ),
                    ),
                    'thank-you' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/thank-you',
                            'defaults' => array(
                                'action' => 'thank-you'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'SwebContactCaptcha'       => 'SwebContact\Service\ContactCaptchaFactory',
            'SwebContactForm'          => 'SwebContact\Service\ContactFormFactory',
            'SwebContactMailMessage'   => 'SwebContact\Service\ContactMailMessageFactory',
            'SwebContactMailTransport' => 'SwebContact\Service\ContactMailTransportFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'sweb-contact/contact/index'     => __DIR__ . '/../view/contact/index.phtml',
            'sweb-contact/contact/thank-you' => __DIR__ . '/../view/contact/thank-you.phtml',
        ),
        'template_path_stack' => array(
            'sweb-contact' => __DIR__ . '/../view',
        ),
    ),
);