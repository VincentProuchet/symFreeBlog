<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;

/**
 *
 * @author Vincent
 *        
 */
interface UserService
{
    public function getUser($id);
    public function getUsers();
    
    public function create(User $u);
    public function update(User $u);
    
    public function delete(User $u);
}

