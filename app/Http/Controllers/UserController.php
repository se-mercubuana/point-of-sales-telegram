<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use \Faker\Provider\Uuid;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'users' => User::active()->get()
        ];

        return view('user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::all()
        ];

        return view('user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userExists = User::username($request->username)->get();

        if (count($userExists) == 0) {
            $username = self::createSlug(User::class, 'username', $request->username);

            \App\User::insert([
                'id' => Uuid::uuid(),
                'name' => $request->name,
                'username' => $username,
                'password' => bcrypt('12345678'),
                'role_id' => $request->role,
                'is_active' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } else {
            return redirect('/user/create');
        }


        return redirect('/user');
    }

    public static function createSlug($model, $field, $word)
    {
        $slug = Str::slug($word);

        $slugs = $model::where($field, 'like', "{$slug}%")->get();

        $slugs = $slugs->pluck('alias')->toArray();
        if (count($slugs) !== 0 and in_array($slug, $slugs)) {
            $max = 0;

            //keep incrementing $max until a space is found
            while (in_array(($slug . '-' . ++$max), $slugs)) {
            }

            //update $slug with the appendage
            $slug .= '-' . $max;
        }

        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'roles' => Role::all()
        ];

        return view('user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $username = self::createSlug(User::class, 'username', $request->username);
        $userExists = User::notUsername($user->username)->username($username)->get();

        if (count($userExists) == 0) {
            $user->update(['name' => $request->name, 'username' => $username, 'role_id' => $request->role]);
        } else {
            return redirect('/user/' . $user->id . '/edit');
        }

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->update(['is_active' => 0]);
        return redirect('/user');
    }


    public function resetPassword($userId)
    {
        $user = User::find($userId);
        $user->update(['password' => bcrypt('12345678')]);
        return redirect('/user');
    }
}
