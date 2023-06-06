<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Users;
use App\Controller\UsersController;

class SecurityController extends AbstractController
{
    private $jwtEncoder;
    
    public function __construct(JWTEncoderInterface $jwtEncoder)
    {
        $this->jwtEncoder = $jwtEncoder;
    }
    #[Route('/api/login', name: 'app_login', methods: ["POST"])]
    public function getToken(Request $request, SerializerInterface $serializer): JsonResponse
    {   
        $session = $request->getSession();
        $json = file_get_contents("http://localhost:8000/api/users");
        $jsonUsers = json_decode($json);

        $test =$serializer->deserialize($request->getContent(), Users::class,'json');
        $name = $test->getName();
        $password = $test->getPassword();
        $email = $test->getEmail();
        $description = $test ->getDescription();
        foreach ($jsonUsers as $user){
            if($email == $user->email && $password == $user->password)
            {
                $token = $this->jwtEncoder->encode([
                    'name' => $user->name,
                    'description' => $user->description,
                    "email" => $email,
                    "id" => $user->id

                ]);
                return $this->json(['token' => $token]);
            }
        } 
        return $this->json(['Réponse' =>"Non"]);      
    }
}
