<?php

namespace App\Controller;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UsersController extends AbstractController
{
    #[Route('/', name : 'app_login')]
    public function login()
    {
        return $this -> render('users/login.html.twig');
    }

    #[Route('/addUser', name: 'app_addUser')]
    public function addUserPage()
    {
        return $this-> render('users/addUser.html.twig');
    }

    #[Route('/users', name : 'app_users')]
    public function showUsers(){

        $url = "http://localhost:8000/api/getUsers";
        $json = file_get_contents($url);
        $jo = json_decode($json);

        return $this ->render('users/showUsers.html.twig', [
            'users' => $jo
        ]);
    }




    #[Route('/api/getUsers', name: 'getAllUsers',methods : ['GET'])]
    public function getAllUsers(UsersRepository $usersRepository, SerializerInterface $serializer): JsonResponse
    {
        $userList = $usersRepository->findAll();
        $jsonBookList = $serializer->serialize($userList, 'json');
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/getUser/{id}', name: 'getUser', methods: ['GET'])]
    public function getDetailBook(Users $users, SerializerInterface $serializer): JsonResponse
    {
        $jsonBook = $serializer->serialize($users, 'json');
        return new JsonResponse($jsonBook, Response::HTTP_OK, ['accept' => 'json'], true);
    }

    #[Route('/api/deleteUser/{id}',name: 'deleteUser', methods : ['DELETE'])]
    public function deleteUser(Users $user, EntityManagerInterface $em) : JsonResponse
    {
        $em -> remove($user);
        $em ->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('api/addUser',name: 'addUser', methods : ['POST'])]
    public function addUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        $user = $serializer->deserialize($request->getContent(), Users::class, 'json');
        $em -> persist($user);
        $em -> flush();

        $jsonUser = $serializer->serialize($user, 'json');
        $location = $urlGenerator -> generate('getUser', ['id' => $user ->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED,['Location' => $location], true);
    }
}
