<?php
namespace App\Repository;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserRepo
{
    /**
     * @var string
     */
    private $class = 'App\Entity\User';

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function update(User $user, $data)
    {
        $user->setName($data['name']);
        $user->setInfo($data['info']);
        $this->em->persist($user);
        $this->em->flush();
    }

    public function userOfName($name)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'name' => $name
        ]);
    }

    public function delete(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    /**
     * @param $data
     * @return User
     */
    private function prepareData($data)
    {
        return new User($data);
    }
}