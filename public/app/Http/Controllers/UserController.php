<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return view('user.index', ['users' => $users]);

    }


    public function create()
    {

        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('user.index')->with('success', 'プロジェクトを入力しました');
    }


    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user,]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $updateData = $request->validated();

        $user->update($updateData);
        // return view('user.edit', ['user' => $user]);
        return redirect()->route('user.index')->with('success', 'ブログを更新しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


}
