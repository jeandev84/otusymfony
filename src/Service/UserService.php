<?php
namespace App\Service;

use App\Entity\Subscription;
use App\Entity\Tweet;
use App\Entity\User;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;


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
      * @param string $name
      * @return array<User>
     */
     public function findUsersByLogin(string $name): array
     {
         $repository = $this->em->getRepository(User::class);

         return $repository->findBy([
             'login'     => $name,
             'id'        => 8,
             // 'createdAt' => new \DateTime('2021-02-12 18:11:46')
         ]);
     }



     /**
      * Find users by criteria
      *
      * @param string $login
      * @return array<User>
     */
     public function findUsersByCriteria(string $login): array
     {
         $criteria = Criteria::create();

         /** @noinspection NullPointerExceptionInspection */
         // $criteria->andWhere(Criteria::expr()->eq('login', $login));

         /** @noinspection NullPointerExceptionInspection */
         $criteria->andWhere(Criteria::expr()->contains('login', $login)); // LIKE
         $criteria->andWhere(Criteria::expr()->lte('id', 12));

         /** @var EntityRepository $repository */
         $repository = $this->em->getRepository(User::class);


         return $repository->matching($criteria)->toArray();

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



     /**
      * @param User $author
      * @param User $follower
      * @return void
     */
     public function addSubscription(User $author, User $follower)
     {
         $subscription = new Subscription();
         $subscription->setAuthor($author);
         $subscription->setFollower($follower);
         $subscription->setCreatedAt();
         $subscription->setUpdatedAt();
         $author->addSubscriptionFollower($subscription);
         $follower->addSubscriptionAuthor($subscription);
         $this->em->persist($subscription);
         $this->em->flush();
     }
}