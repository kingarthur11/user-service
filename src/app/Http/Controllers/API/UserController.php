<?php

namespace App\Http\Controllers\API;

use App\Repositories\IUserRepository;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CreateUserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends AppBaseController
{
    private $iUserRepository;
    public function __construct(IUserRepository $iUserRepository)
    {
        $this->iUserRepository = $iUserRepository;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(StoreUser $request)
    {
        $userData = [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
        ];
        $user = $this->iUserRepository->create($userData);
        return $this->sendResponse($user, 'User data saved successfully');
    }
}
