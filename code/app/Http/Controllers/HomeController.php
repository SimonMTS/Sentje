<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'cPage' => 'index'
        ]);
    }


    public function profile( $id )
    {
        $user = \App\User::find($id);
        if ( !isset($user) ) {
            return abort(404);
        }

        return view('auth.profile', [
            'user' => $user
        ]);
    }

    public function profilePOST( Request $request, $id )
    {
        $user = \App\User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ( 
            isset($request->password) && !empty($request->password) &&
            isset($request->password_confirm) && 
            $request->password_confirm === $request->password
        ) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('successUser', ['Gelukt!', ' je gegevens zijn aangepast.']);
        return redirect('profile/'.$user->id);
    }
}
