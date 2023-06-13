<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends BaseController
{
    public function __construct(
        /**
         * Authentication Interface
         */
        private Factory $auth,

        /**
         * Response Interface
         */
        private ResponseFactory $response
    ) {}

    /**
     * Fetch the auth user
     */
    public function user(Request $request): Response
    {
        return $request->user();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->response->noContent();
    }

    /**
     * Handle an incoming authentication logout request.
     */
    public function logout(Request $request): Response 
    {
        $this->auth->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->response->noContent();
    }
}