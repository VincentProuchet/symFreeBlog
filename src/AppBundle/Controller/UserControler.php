<?php
namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Service\UserService;
use AppBundle\dto\UserDTO;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author Vincent
 *        
 */
class UserControler extends Controller
{

    private $userService;

    /**
     */
    public function __construct(UserService $srvUser)
    {
        $this->userService = $srvUser;
    }
/**
 * * @Route("/users" , methods={"GET"})
 * @return \Symfony\Component\HttpFoundation\JsonResponse
 */
    public function getAll()
    {
        // The second parameter is used to specify on what object the role is tested.
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        
        $data = $this->userService->getUsers();
        if (is_null($data)) {
            return $this->json(new \Exception("no users"), Response::HTTP_NOT_FOUND);
        }
        $usersDTO = [];
        foreach ($data as $value) {
            array_push($usersDTO, UserDTO::makePublic($value));
        }
        return $this->json($usersDTO);
    }
    /**
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function newUser(Request $request){
        $data = User::make(json_decode($request->getContent(),false));
        $data = $this->userService->create($data);
        return $this->json(UserDTO::make($data));
    }
    /**
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateUser(Request $request){
        $data = User::make(json_decode($request->getContent(),false));
        $data = $this->userService->update($data);
        return $this->json(UserDTO::make($data));
    }
    
    public function deleteaccount(Request $request){
        return $this->json($request->getContent());
    }
}

