<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogHelper;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Factory;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends BaseController
{
    public function __construct(
        /**
         * Authentication Interface
         */
        readonly private Factory $auth,

        /**
         * Response helper
         */
        readonly private ResponseHelper $response,

        /**
         * Logger instance
         */
        readonly private LogHelper $log
    ) {}

    /**
     * Fetch the auth user
     */
    public function user(Request $request): JsonResponse
    {
        return $this->response->ok($request->user());
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try{
            $request->authenticate();
            $request->session()->regenerate();
            return $this->response->ok($request->user());
        } catch(\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }

    /**
     * Handle an incoming authentication logout request.
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $this->auth->guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return $this->response->noContent();
        } catch(\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }
}