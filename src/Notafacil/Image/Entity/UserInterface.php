<?php

namespace Notafacil\Image\Entity;

/**
 * Interface User Entity
 *
 * @author Sergio Hermes <hermes.sergio@gmail.com>
 */
interface UserInterface
{
    public function getId();
    
    public function getUsername();
    
    public function setUsername($username);
    
    public function getPassword();
    
    public function setPassword($password);
}
