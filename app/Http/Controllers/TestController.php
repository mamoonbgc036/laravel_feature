<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class TestController extends Controller
{
    public function test()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }

    public function edit(User $user){
        return view('edit', [
            'user' => $user
        ]);
    }
}
