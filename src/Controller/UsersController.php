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
    private $em;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    
    }

//         #[Route('/api/getUsers', name: 'getAllUsers', methods: ['GET'])]
//     public function getAllUsers(UsersRepository $usersRepository, SerializerInterface $serializer): JsonResponse
//     {
//         $userList = $usersRepository->findAll();
//         $jsonBookList = $serializer->serialize($userList, 'json');
//         return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
//     }

//     #[Route('/api/getUser/{id}', name: 'getUser', methods: ['GET'])]
//     public function getDetailBook(Users $users, SerializerInterface $serializer): JsonResponse
//     {
//         $jsonBook = $serializer->serialize($users, 'json');
//         return new JsonResponse($jsonBook, Response::HTTP_OK, ['accept' => 'json'], true);
//     }

//     #[Route('/api/deleteUser/{id}', name: 'deleteUser', methods: ['DELETE'])]
//     public function deleteUser(Users $user): JsonResponse
//     {
//         $this->em->remove($user);
//         $this->em->flush();

//         return new JsonResponse(null, Response::HTTP_NO_CONTENT);
//     }

//     #[Route('/api/addUser', name: 'addUser', methods: ['POST'])]
//     public function addUser(Request $request, SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator)
//     {
//         $user = $serializer->deserialize($request->getContent(),Users::class,'json');
//         $this->em->persist($user);
//         $this->em->flush();

//         $jsonUser = $serializer->serialize($user,'json');
//         $location = $urlGenerator->generate('getUser', ['id' => $user->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

//         return new JsonResponse($jsonUser, Response::HTTP_CREATED, ['Location' => $location], true);
//     }

//   #[Route('/api/updateUser/{id}', name : 'updateUser', methods :['PUT'])]

//     public function updateUser(Request $request, SerializerInterface $serializer, Users $user) : JsonResponse
//     {
//         if($request)
//         {
//             $data = json_decode($request->getContent());
//             $code = 200;
//             if (!$user)
//             {
//                 $user = new Users();
//                 $code =201;
//             }

//             $user -> setName($data->name);
//             $user -> setEmail($data->email);
//             $user -> setPassword($data -> password);
//             $user -> setDescription($data -> description);

//             $this->em-> persist($user);
//             $this->em-> flush();


//             return new JsonResponse('ok', $code);

//         }
//         return new JsonResponse('Failed', 404);
//     }
}