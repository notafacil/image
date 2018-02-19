<?php

namespace NotafacilAPI\Image\Mapper;

use NotafacilAPI\Image\Entity\ImageInterface as ImageEntityInterface;

/**
 * Interface Image Mapper
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
interface ImageInterface
{
    public function create(ImageEntityInterface $entity);
    
    public function fetchOne($id);
    
    public function fetchAll(array $params);
    
    public function update(ImageEntityInterface $entity);
    
    public function delete(ImageEntityInterface $entity);
    
    public function buildListPaginatorAdapter(array $params);
}
