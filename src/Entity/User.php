<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nucleos\UserBundle\Model\User as BaseUser;


 #[ORM\Entity]
 #[ORM\Table(name:"nucleos_user__user")]

class User extends BaseUser
{

     #[ORM\Id]
     #[ORM\Column(type:"integer")]
     #[ORM\GeneratedValue(strategy:"AUTO")]
     
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}