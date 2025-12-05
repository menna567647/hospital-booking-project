<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use ApiResponse;
    /**
     * register
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $client = Client::create($validated);
        $token = $client->createToken('ApiToken');

        $data = [
            'client' => $client,
            'token' => $token->plainTextToken,
        ];
        return $this->apiSuccessMessage('client created successfullly', $data);
    }

    /**
     * login
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $client = Client::where('email', $credentials['email'])->first();

        if (!$client || !Hash::check($credentials['password'], $client->password)) {
            return $this->apiResponse('error', 'Invalid credentials', [], 401);
        }

        $token = $client->createToken('ApiToken');

        $data = [
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'client' => $client,
        ];
        return $this->apiSuccessMessage('client logged in successfullly', $data);
    }


    /**
     * logout
     */
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();

        $data = [
            'deleted_token_id' => $token->id,
        ];
        return $this->apiSuccessMessage('Logged out successfully', $data);
    }

}
