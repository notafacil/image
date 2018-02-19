<?php
namespace NotafacilAPI\Image\V1\Rest\Images;

use ZF\ApiProblem\ApiProblem;
use NotafacilAPI\Image\V1\Rest\AbstractResourceListener;

class ImagesResource extends AbstractResourceListener
{
    /**
     * Fetch all or a subset of resources
     * Obter tudo ou um subconjunto de recursos
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $imageService = $this->getServiceLocator()->get('NotafacilAPI\\Image\\Service\\Image');
        return $imageService->getCollection($params->toArray());
    }
}
