<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2018
 */
namespace NotafacilAPI\Image;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Uri\UriFactory;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use ZF\MvcAuth\MvcAuthEvent;
use ZF\MvcAuth\Identity\GuestIdentity;

/**
 * Module Class para imagem
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */

class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri'); // add chrome-extension for API Client
        $serviceManager = $mvcEvent->getApplication()->getServiceManager();
        $eventManager   = $mvcEvent->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // anexar (incorporar) o ouvinte de eventos compartilhados de image
        $sharedEventManager->attachAggregate($serviceManager->get('NotafacilAPI\\Image\\SharedEventListener'));
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        // definir o papel com base no id do cliente oAuth
        $eventManager->attach(
            MvcAuthEvent::EVENT_AUTHENTICATION_POST,
            function ($mvcAuthEvent) {
                $identity     = $mvcAuthEvent->getIdentity();
                $authIdentity = $identity->getAuthenticationIdentity();
                if (!$identity instanceof GuestIdentity) {
                    $identity->setName($authIdentity['client_id']);
                }
            },
            100
        );
        // anexar (incorporar) ACL para verificar o Escopo
        $eventManager->attach(
            MvcAuthEvent::EVENT_AUTHORIZATION_POST,
            $serviceManager->get('NotafacilAPI\\Image\\Authorization\\AclScopeListener'),
            101
        );
        // anexar (incorporar) ACL para verificar proprietário da imagem
        $eventManager->attach(
            MvcAuthEvent::EVENT_AUTHORIZATION_POST,
            $serviceManager->get('NotafacilAPI\\Image\\Authorization\\AclImageListener'),
            100
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}
