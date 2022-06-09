<?php
namespace App\Controller;


use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class WorldController extends AbstractController
{

    /**
     * @var UserService
    */
    private UserService $userService;


    /**
     * @param UserService $userService
    */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }



    /**
     * @return Response
     */
    public function hello(): Response
    {
        // List users
        // $users = $this->userService->findUsersByLogin('Ivan Ivanov');

        $users = $this->userService->findUsersByCriteria('Tolkien');

        // Json format
        return $this->json(
            array_map(static fn(User $user) => $user->toArray(), $users)
        );
    }


    /*
    public function hello5(): Response
    {
        // Создание User
        $author = $this->userService->create('J.R.R. Tolkien');
        $follower = $this->userService->create('Ivan Ivanov');

        // Subscribe User (Follower)
        $this->userService->subscribeUser($author, $follower);


        // Add Subscription
        $this->userService->addSubscription($author, $follower);


        // Json format
        return $this->json([$author->toArray(), $follower->toArray()]);
    }


    public function hello4(): Response
    {
        // Создание User
        $author = $this->userService->create('My User');

        // Создание Tweet
        $this->userService->postTweet($author, 'The Lord of the Rings');
        $this->userService->postTweet($author, 'The Hobbit');

        return $this->json($author->toArray());
    }


    public function hello3(): Response
    {
        // Создание User
        $author = $this->userService->create('My User');

        // Создание Tweet
        $this->userService->postTweet($author, 'The Lord of the Rings');
        $this->userService->postTweet($author, 'The Hobbit');

        // ID author
        $authorId = $author->getId();

        // Сбросим Entity Manager
        $this->userService->clearEntityManager();


        // Перезапрошиваем пользователя
        $author = $this->userService->findUser($authorId);

        return $this->json($author->toArray());
    }


    public function hello2(): Response
    {
        // Создание User
        $author = $this->userService->create('My User');

        // Создание Tweet
        $this->userService->postTweet($author, 'The Lord of the Rings');
        $this->userService->postTweet($author, 'The Hobbit');

        // Перезапрошиваем пользователя
        $author = $this->userService->findUser($author->getId());

        return $this->json($author->toArray());
    }

    public function hello1(): Response
    {
        $user = $this->userService->create('My User');

        return $this->json($user->toArray());
    }
    */

}