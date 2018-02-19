<?php
namespace Notafacil\Image\Authorization;

use ZF\MvcAuth\MvcAuthEvent;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

class AclImageListener implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Tentativa de autorizar a identidade descoberta com base nas ACL presentes
     *
     * @param MvcAuthEvent $mvcAuthEvent
     * @void
     */
    public function __invoke(MvcAuthEvent $mvcAuthEvent)
    {
        try {
            $requestedImage = $this->getServiceLocator()->get('image.requested.image');
        } catch (ServiceNotCreatedException $e) {
            // serviço não criado causado pelo retorno do serviço nulo (imagem não encontrada no banco de dados)
            return $mvcAuthEvent->getMvcEvent()
                    ->getResponse()
                    ->setStatusCode(404)
                    ->send();
        }

        $authenticatedUser = $this->getServiceLocator()->get('image.authenticated.user');
        // verifique se a imagem solicitada é de propriedade do usuário autenticado
        if ($requestedImage->getId() !== null &&
            $requestedImage->getUser()->getId() != $authenticatedUser->getId()) {
            $mvcAuthEvent->setIsAuthorized(false);
        }
    }
}
