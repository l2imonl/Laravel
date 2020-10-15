<?php

namespace App\Http\Controllers\API;

use App\Helpers\EncodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\User as UserResource;
use DateTime;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAPIController extends Controller
{

    public function login(Request $request)
    {
        if ($user = Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return response()->json([
                'user' => new UserResource(Auth::User()),
                'token' => $this->createJWT(Auth::User()),
            ]);
        }
        return response()->json([
           'failed' => 'login failed'
        ]);
    }

    private function createJWT()
    {
        $secret = getenv('SECRET');

        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        $payload = json_encode([
            'user_id' => Auth::User()->getAuthIdentifier(),
            'roles' => new RoleCollection(Auth::User()->roles),
            'iat' => (new \DateTime)->getTimestamp(),
            'exp' => (new \DateTime)->getTimestamp() + 180,
        ]);

        $base64Header = (new EncodeHelper)->base64UrlEncode($header);
        $base64Payload = (new EncodeHelper)->base64UrlEncode($payload);

        $signatur = hash_hmac('sha256', $base64Header.".".$base64Payload, $secret, true);
        $base64Signatur = (new EncodeHelper)->base64UrlEncode($signatur);
        $jwt = $base64Header.".". $base64Payload . ".". $base64Signatur;
        return $jwt;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
