<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $incomingField = $request->validate([
            'loginName' => 'required',
            'loginPassword'=> 'required',
        ]);
        if(auth()->attempt(['name' => $incomingField['loginName'], 'password' => $incomingField['loginPassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function register(Request $request){
        $incomingField = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=> ['required', 'min:8', 'max:200']
        ]);

        $incomingField['password'] = bcrypt($incomingField['password']);
        $user = User::create($incomingField);
        auth()->login($user);
        return redirect('/');
    }
}
