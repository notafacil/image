<?php

namespace NotafacilAPI\Image\Mapper;

use NotafacilAPI\Image\Entity\UserInterface as UserEntityInterface;

/**
 * Interface Image Mapper
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
interface UserInterface
{
    public function create(UserEntityInterface $entity);
    
    public function fetchOne($id);
    
    public function fetchAll(array $params);
    
    public function update(UserEntityInterface $entity);
    
    public function delete(UserEntityInterface $entity);
}
