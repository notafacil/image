<?php
namespace Notafacil\Image\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Notafacil\Image\Entity\Image;

/**
 * Get Authenticated User Entity
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
class RequestedImageFactory implements FactoryInterface
{
    /**
     * Create a service for Authenticated User
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $router  = $serviceLocator->get('Router');
        $request = $serviceLocator->get('Request');
        $routeMatch  = $router->match($request);
        $imageId = $routeMatch->getParam('image_id');
        $requestedEntity = null;
        if ($imageId === null) {
            $requestedEntity = new Image();
        } else {
            $imageMapper = $serviceLocator->get('Notafacil\\Image\\Mapper\\Image');
            $requestedEntity = $imageMapper->fetchOne($imageId);
        }
        
        return $requestedEntity;
    }
}
