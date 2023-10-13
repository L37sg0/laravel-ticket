<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDelete;
use App\Http\Requests\UserGet;
use App\Http\Requests\UserPost;
use App\Http\Requests\UserPut;
use App\Models\User;
use Illuminate\Routing\Controller;
use Throwable;

class UserController extends Controller
{
    public function index(UserGet $request)
    {
        $resultsPerPage = 10;
        if ($filterPageResults = $request->get('per_page')) {
            $resultsPerPage = $filterPageResults;
        }
        $collection = User::Paginate($resultsPerPage);
//        if ($search = $request->get('search')){
//            $collection = User::search($search)->paginate($resultsPerPage);
//        }
        return response()->json($collection);

    }

    public function create(UserPost $request)
    {
        try {
            $user = new User();
            foreach (User::FILLABLE as $key) {
                $user->setAttribute($key, $request->get($key));
            }
            $user->save();
            return response()->json(['message' => 'User created.' . $user->getAttribute(User::FIELD_ID)], 201);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function read(UserGet $request)
    {
        $user = User::find($request->get('user_id'));
        if (!empty($user)) {
            return response()->json($user);
        }
        return response()->json(["error" => "Not found " . $request->get('user_id')], 404);

    }

    public function update(UserPut $request)
    {
        try {
            $user = User::find($request->get('user_id'));
            foreach (User::FILLABLE as $key) {
                $user->setAttribute($key, $request->get($key));
            }
            $user->save();
            return response()->json(['message' => 'User updated.'], 201);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function destroy(UserDelete $request)
    {
        try {
            $user = User::find($request->get('user_id'));
            $user->delete();
            return response()->json(['message' => 'User deleted.'], 201);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

}
