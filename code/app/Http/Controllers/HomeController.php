<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Sanitize;

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
        if ( sizeof( auth()->user()->accounts()->get() ) == 0 ) {
            return redirect('accounts/add')->with('info', '<b>Om te beginnen</b>, moet u eerst een bankrekening toevoegen.');
        }

        $PaymentRequests = auth()->user()->requests()->orderBy('updated_at', 'desc')->get();

        return view('home', [
            'requests' => $PaymentRequests
        ]);
    }


    public function profile( $id )
    {
        $id = Sanitize::Input( $id );

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
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'max:255',
            'password_confirm' => 'max:255'
        ]);

        $id = Sanitize::Input( $id );

        $user = \App\User::find($id);

        $user->name = Sanitize::Input( $request->name );
        $user->email = Sanitize::Input( $request->email );

        if ( 
            isset($request->password) && !empty($request->password) &&
            isset($request->password_confirm) && 
            $request->password_confirm === $request->password
        ) {
            $user->password = Hash::make( $request->password );
        }

        $user->save();

        $request->session()->flash('successUser', [__('text.success'), __('text.dataEdited')]);
        return redirect('profile/'.$user->id);
    }
}
