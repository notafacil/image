<?php
namespace NotafacilAPI\Image\Authorization;

use ZF\MvcAuth\MvcAuthEvent;
use Zend\Permissions\Acl\Acl;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\MvcAuth\Identity\GuestIdentity;

class AclScopeListener implements ServiceLocatorAwareInterface
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
        $imageService = $this->getServiceLocator()->get('NotafacilAPI\\Image\\Service\\Image');
        $authService  = $mvcAuthEvent->getAuthorizationService();
        $config = $this->getServiceLocator()->get('Config')['authorization'];
        $imageService->setUser($this->getServiceLocator()->get('image.authenticated.user'));
        $identity = $mvcAuthEvent->getIdentity();
        if ($identity instanceof GuestIdentity) {
            return;
        }

        // resource:method
        $requestedResource = $mvcAuthEvent->getResource() . ':' . $mvcAuthEvent->getMvcEvent()->getRequest()->getMethod();
        foreach ($config['scopes'] as $scope => $scopeConfig) {
            $resource = $scopeConfig['resource'] . ':' . $scopeConfig['method'];
            // se o recurso de autorização for igual ao recurso solicitado
            if ($resource == $requestedResource) {
                // verifique o escopo na identity
                if (!in_array($scope, explode(' ', $identity->getAuthenticationIdentity()['scope']))) {
                    return $mvcAuthEvent->getMvcEvent()->getResponse()->setStatusCode(401);
                }
            }
        }
    }
}
