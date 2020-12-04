<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\UserCollection;
use App\Models\MyToken;
use App\Models\Role;
use App\Models\User;
use Exception;
use http\Env\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

class UserAPIController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        if (User::paginate(5)) {
            return new UserCollection(User::paginate(5));
        } else {
            return response()->json([
                'failed' => 'can\'t paginate Users',
            ]);
        }
    }

//    public function login()
//    {
//        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
//            $user = Auth::user();
//            $accessToken = Auth::user()->createToken('authToken' . $user->name)->plainTextToken;
//            return response()->json(['user' => $user, 'success' => $accessToken]);
//        } else {
//            return response()->json(['error' => 'Unauthorised'], 401);
//        }
//    }

    public function register(Request $request)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            User::create(['name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->pasword)])->sendEmailVerificationNotification();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'can u see this?'
            ], $e->getCode());
        }


        return response()->json([
            'success' => 'User created',
//            'newUser' => new UserResource($user),
        ]);
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
     * @param Request $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        if (User::find($request->id)) {
            return new UserResource(User::find($request->id));
        } else {
            return response()->json([
                'failed' => 'can\'t find user',
            ]);
        }

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
     * @return UserResource[]|array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            if ($request->name)
                $user->name = $request->name;
            if ($request->email)
                $user->email = $request->email;
            if ($request->profile_photo)
                $user->updateProfilePhoto($request->profile_photo);
            $user->save();

            return response()->json([
                'success' => 'user updated',
                'user' => new UserResource($user)
            ]);
        } else {
            return response()->json([
                'failed' => 'can\'t finde user',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if (User::onlyTrashed()->where('id', $request->id)->exists()) {
            return response()->json([
                'failed' => 'user is already deleted',
            ]);
        }
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json([
                'access' => 'user deleted',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'failed' => 'can\'t finde user',
                'user' => $user,
            ]);
        }
    }

    /**
     * update role from specified user
     */
    public function updateRole(Request $request, $id)
    {

        $user = User::find($id);

        $role = Role::find($request->role_id);

        try {
            if ($request->promote === 'true') {
                $user->roles()->attach($role);
            } else {
                $user->roles()->detach($role);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e,
            ]);
        }

        $user->save();

        return response()->json([
            'accept' => 'Role updated',
            'promoted' => $request->promote,
            'user' => $user,
            'role' => $role,
        ]);

    }

    public function allRoles()
    {
        return new RoleCollection(Role::all());
    }

}
