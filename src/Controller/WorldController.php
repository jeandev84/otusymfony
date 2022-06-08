<?php
namespace App\Controller;


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


    /*
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