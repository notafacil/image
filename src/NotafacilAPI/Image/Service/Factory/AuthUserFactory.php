<?php
namespace NotafacilAPI\Image\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use NotafacilAPI\Image\Entity\User;

/**
 * Get Authenticated User Entity
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
class AuthUserFactory implements FactoryInterface
{
    /**
     * Create a service for Authenticated User
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authentication = $serviceLocator->get('authentication');
        $identity = $authentication->getIdentity();
        $authUser = null;
        if ($identity instanceof \ZF\MvcAuth\Identity\GuestIdentity) {
            $authUser = new User;
        } elseif ($identity instanceof \ZF\MvcAuth\Identity\AuthenticatedIdentity) {
            $authIdentity = $identity->getAuthenticationIdentity();
            $userMapper   = $serviceLocator->get('NotafacilAPI\\Image\\Mapper\\User');
            $authUser = $userMapper->fetchOne($authIdentity['user_id']);
        }
        
        return $authUser;
    }
}
