<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Http\Controllers\API\UserController;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUser;
use Tests\TestCase;
use Mockery;


class UserUnitTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUnitCreateUser()
    {
        $userRepository = Mockery::mock(UserRepository::class);
        $userData = [
            'email' => $this->faker->unique()->safeEmail,
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
        ];
        $mockedUserObject = (object) $userData;
        $userRepository->shouldReceive('create')
                       ->once()
                       ->with($userData)
                       ->andReturn($mockedUserObject);
        $request = new StoreUser($userData);
        $controller = new UserController($userRepository);
        $response = $controller->create($request);
        $this->assertNotNull($response);
        $responseData = $response->getData();

        $this->assertEquals($userData['firstName'], $responseData->data->firstName);
        $this->assertEquals($userData['lastName'], $responseData->data->lastName);
        $this->assertEquals($userData['email'], $responseData->data->email);

        $this->assertEquals(201, $response->status());
    }
    
}
