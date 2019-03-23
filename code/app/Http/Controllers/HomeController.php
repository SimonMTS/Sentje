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
        $requests[0] = [
            'amount' => '€10,50',
            'text' => 'Voor de film',
            'numberPaid' => [0, 3],
            'date' => '23/03/2019'
        ];
        $requests[1] = [
            'amount' => '£50,00',
            'text' => 'Van het eten gisteren',
            'numberPaid' => [1, 3],
            'date' => '14/03/2019'
        ];

        return view('home', [
            'requests' => $requests
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

        $request->session()->flash('successUser', [__('text.success'), __('text.dataEdited')]);
        return redirect('profile/'.$user->id);
    }
}
