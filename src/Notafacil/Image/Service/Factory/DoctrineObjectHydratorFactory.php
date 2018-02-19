<?php
namespace Notafacil\Image\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use \Notafacil\Image\Stdlib\Hydrator\Strategy as HydratorStrategy;

/**
 * Hydrator for Doctrine Entity
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
class DoctrineObjectHydratorFactory implements FactoryInterface
{
    /**
     * Create a service for DoctrineObject Hydrator
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentServiceLocator = $serviceLocator->getServiceLocator();
        $entityManager = $parentServiceLocator->get('Doctrine\\ORM\\EntityManager');
        $amResolverStrategy = $parentServiceLocator
                                ->get('Notafacil\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy');
        $hydrator = new DoctrineObject($entityManager);
        $hydrator->addStrategy('user', new HydratorStrategy\UsernameStrategy);
        $hydrator->addStrategy('ctime', new HydratorStrategy\ISODateTimeStrategy);
        $hydrator->addStrategy('utime', new HydratorStrategy\ISODateTimeStrategy);
        $hydrator->addStrategy('path', $amResolverStrategy);
        $hydrator->addStrategy('thumbPath', $amResolverStrategy);
        return $hydrator;
    }
}
