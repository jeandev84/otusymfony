<?php
namespace App\Service;

use App\Entity\Tweet;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


/**
 * User Service
*/
class UserService
{

     /**
      * @var EntityManagerInterface
     */
     private EntityManagerInterface $em;


     /**
      * @param EntityManagerInterface $em
     */
     public function __construct(EntityManagerInterface $em)
     {
          $this->em = $em;
     }



     /**
      * @param string $login
      * @return User
     */
     public function create(string $login): User
     {
         $user = new User();
         $user->setLogin($login);
         $user->setCreatedAt();
         $user->setUpdatedAt();

         $this->em->persist($user);
         $this->em->flush();

         return $user;
     }



     public function postTweet(User $author, string $text): void
     {
          $tweet = new Tweet();
          $tweet->setAuthor($author);
          $tweet->setText($text);
          $tweet->setCreatedAt();
          $tweet->setUpdatedAt();
          $author->addTweet($tweet);
          $this->em->persist($tweet);
          $this->em->flush();

          //можно добавить $author->addTweet($tweet); после flush()
     }



     public function clearEntityManager(): void
     {
         $this->em->clear();
     }



     /**
      * @param int $id
      * @return User|null
     */
     public function findUser(int $id): ?User
     {
          $repository = $this->em->getRepository(User::class);
          $user = $repository->find($id);

          return $user instanceof User ? $user : null;
     }


     /**
      * @param User $author
      * @param User $follower
      * @return void
     */
     public function subscribeUser(User $author, User $follower): void
     {
          $author->addFollower($follower);
          $follower->addAuthor($author);
          $this->em->flush();
     }
}