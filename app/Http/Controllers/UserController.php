<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Retrieve the users.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user =  new User();
        $user->fill($request->all());
        $user->saveOrFail();

        return $user;
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the user in storage.
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'sometimes|required|string|min:3',
            'email' => [
                'sometimes',
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user->fill($request->all());
        $user->saveOrFail();

        return $user;
    }

    /**
     * Remove the user from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
