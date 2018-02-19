<?php
/**
 * Image Module
 *
 * @link
 * @copyright Copyright (c) 2018
 */
namespace NotafacilAPI\Image\V1\Rest;

use ZF\Rest\AbstractResourceListener as ResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Rest AbstractResourceListener

 * @author  Sergio Hermes <hermes.sergio@gmail.com>
 *
 * @SuppressWarnings(PHPMD)
 */
class AbstractResourceListener extends ResourceListener implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{
    use ServiceLocatorAwareTrait;

    use EventManagerAwareTrait;
}
