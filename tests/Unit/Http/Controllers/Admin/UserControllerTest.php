<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Mockery as m;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Admin\UserController;

class UserControllerTest extends TestCase
{
    /**
     * @var UserService
     */
    protected $mockUserService;

    /**
     * @var UserController
     */
    protected $userController;

    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->mockUserService = m::mock(UserService::class)->makePartial();
        $this->userController = new UserController($this->mockUserService);
    }

    /**
     * Test create function.
     *
     * @test
     *
     * @return void
     */
    public function create_return_view()
    {
        $user = new User();
        $view = $this->userController->create();
        $this->assertEquals('admin.users.create', $view->getName());
        $this->assertArraySubset(['user' => $user], $view->getData());
    }

    /**
     * Test store function success.
     *
     * @test
     *
     * @return void
     */
    public function store_user_success()
    {
        $request = new UserRequest();
        $user = m::mock(User::class)->makePartial();
        $this->mockUserService->shouldReceive('createUser')
            ->once()
            ->with($request)
            ->andReturn($user);
        $response = $this->userController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@create'), $response->headers->get('Location'));
        $this->assertEquals('success', $response->getSession()->get('message_class'));
    }

    /**
     * Test store function success.
     *
     * @test
     *
     * @return void
     */
    public function store_user_fail()
    {
        $request = new UserRequest();
        $user = m::mock(User::class)->makePartial();
        $this->mockUserService->shouldReceive('createUser')
            ->once()
            ->with($request)
            ->andReturn(false);
        $response = $this->userController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@create'), $response->headers->get('Location'));
        $this->assertEquals('danger', $response->getSession()->get('message_class'));
    }

    /**
     * Test edit function.
     *
     * @test
     *
     * @return void
     */
    public function edit_return_view()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $userMock = m::mock(User::class)->makePartial();
        $this->mockUserService->shouldReceive('getUserById')
            ->with($userId)
            ->andReturn($userMock);
        $view = $this->userController->edit($userId);
        $this->assertEquals('admin.users.edit', $view->getName());
        $this->assertArraySubset(['user' => $userMock], $view->getData());
    }

    /**
     * Test update function success.
     *
     * @test
     *
     * @return void
     */
    public function update_user_success()
    {
        $request = new UserUpdateRequest();
        $user = factory(User::class)->create();
        $userId = $user->id;
        $user = m::mock(User::class)->makePartial();
        $this->mockUserService->shouldReceive('updateUser')
            ->once()
            ->with($userId, $request)
            ->andReturn($user);
        $response = $this->userController->update($userId, $request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@edit', $userId), $response->headers->get('Location'));
        $this->assertEquals('success', $response->getSession()->get('message_class'));
    }

    /**
     * Test update function fail.
     *
     * @test
     *
     * @return void
     */
    public function update_user_fail()
    {
        $request = new UserUpdateRequest();
        $user = factory(User::class)->create();
        $userId = $user->id;
        $this->mockUserService->shouldReceive('updateUser')
            ->once()
            ->with($userId, $request)
            ->andReturn(false);
        $response = $this->userController->update($userId, $request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@edit', $userId), $response->headers->get('Location'));
        $this->assertEquals('danger', $response->getSession()->get('message_class'));
    }

    /**
     * Test index function.
     *
     * @test
     *
     * @return void
     */
    public function index_return_view()
    {
        $request = new Request();
        $users = m::mock(User::class)->makePartial();
        $this->mockUserService->shouldReceive('getUsers')
            ->with($request)
            ->andReturn($users);
        $view = $this->userController->index($request);
        $this->assertEquals('admin.users.index', $view->getName());
        $this->assertArraySubset(['users' => $users], $view->getData());
    }

    /**
     * Test destroy user success.
     *
     * @test
     *
     * @return void
     */
    public function destroy_success()
    {
        $request = new Request();
        $this->mockUserService->shouldReceive('removeUser')
            ->with($request)
            ->andReturn(true);
        $response = $this->userController->destroy($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@index'), $response->headers->get('Location'));
        $this->assertEquals('success', $response->getSession()->get('message_class'));
    }

    /**
     * Test destroy user fail.
     *
     * @test
     *
     * @return void
     */
    public function destroy_fail()
    {
        $request = new Request();
        $this->mockUserService->shouldReceive('removeUser')
            ->with($request)
            ->andReturn(0);
        $response = $this->userController->destroy($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(action('Admin\UserController@index'), $response->headers->get('Location'));
        $this->assertEquals('danger', $response->getSession()->get('message_class'));
    }
}
