<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
       // [ $loginName, $loginPassword ] = $request;
        $incomingRequest = $request->validate([
            'loginName' => 'required',
            'loginPassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingRequest['loginName'], 'password' => $incomingRequest['loginPassword']])) {
            $request->session()->regenerate();
            
        };

        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:3', 'max:10']
        ]);

        $incomingField['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth() -> login($user);
        return redirect('/');
    }


    public function logout() {
        auth() -> logout(); 
        return redirect('/');
    }

 
    
// you can ignore the codes commmented below as different trial and attempts 
// to replicate result above in different way 


    // public function login(Request $request) {
    //     $incomingFields = $request->validate([
    //         'name'=> ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
    //         'email'=> ['required', 'email'],
    //         'password'=> ['required', 'min:8', 'max:200']
    //     ]);

    //     $incomingField['password'] = bcrypt($incomingFields['password']);
    //     if (auth::User($request)) {
    //         return "welcome user";
    //     };

    //     return view('home');
        
    // }
}
