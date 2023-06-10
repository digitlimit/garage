<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
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