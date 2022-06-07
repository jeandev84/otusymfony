<?php
namespace App\Controller;


use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


/**
 * @WorldController
*/
class WorldController extends AbstractController
{

    /**
     * @var UserManager
    */
    private UserManager $userManager;


    /**
     * @param UserManager $userManager
    */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }


    /**
     * @return Response
    */
    public function hello(): Response
    {
        return $this->render('user-table.twig', [
            'users' => $this->userManager->getUserList()
        ]);
    }



    /*
    public function userTable(): Response
    {
        return $this->render('user-table.twig', [
            'users' => $this->userManager->getUserList()
        ]);
    }


    public function listUsersWithBlock(): Response
    {
        return $this->render('user/user-content.twig', [
            'users' => $this->userManager->getUserList()
        ]);
    }


    public function listUsers(): Response
    {
        return $this->render('list.twig', [
            'users' => $this->userManager->getUserList()
        ]);
    }


    public function helloWorld(): Response
    {
        return new Response('<html><body><h1><b>Hello,</b> <i>world</i>!</h1></body></html>');
    }
    */
}