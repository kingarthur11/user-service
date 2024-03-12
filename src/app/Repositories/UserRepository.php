<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\IUserRepository;
use App\Jobs\CreateUserJob;


class UserRepository implements IUserRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }
    public function create($request)
    {
        $user = User::create([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email'],
        ]);
       
        CreateUserJob::dispatch($user->toArray());

        return $user;
    }
}
