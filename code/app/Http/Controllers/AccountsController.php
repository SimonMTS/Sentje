<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Sanitize;
use Illuminate\Support\Facades\URL;

class AccountsController extends Controller
{

    public function index()
    {
        $accounts = auth()->user()->accounts()->get();

        return view('accounts.index', [
            'accounts' => $accounts
        ]);
    }


    public function add()
    {
        return view('accounts.add');
    }

    public function addPOST( Request $request )
    {
        $request->validate([
            'IBAN' => 'required|max:255'
        ]);

        $account = new \App\Account;
    
        $account->user_id = auth()->user()->id;
        if ( empty($request->IBAN) ) {
            return abort(404);
        }
        $account->IBAN = encrypt( Sanitize::Input($request->IBAN) );

        $account->save();

        $request->session()->flash('success', [__('text.success'), __('text.accountAdded')]);
        if ( sizeof( auth()->user()->accounts()->get() ) > 1 ) {
            return redirect('accounts');
        } else {
            return redirect('accounts')->with('info', '<b>Nu u een account heeft toegevoegd</b>, kunt u een Sentje <a href="'.URL::to('/payment').'">aanvragen</a>.');
        }
    }


    public function edit( $id )
    {
        $id = Sanitize::Input( $id );

        $account = \App\Account::find($id);
        if ( !isset($account) ) {
            return abort(404);
        }

        return view('accounts.edit', [
            'account' => $account
        ]);
    }

    public function editPOST( Request $request, $id )
    {
        $request->validate([
            'IBAN' => 'required|max:255'
        ]);

        $id = Sanitize::Input( $id );

        $account = \App\Account::find($id);
        if ( empty($request->IBAN) ) {
            return abort(404);
        }
        $account->IBAN = encrypt( Sanitize::Input($request->IBAN) );
        $account->save();

        $request->session()->flash('success', [__('text.success'), __('text.accountEdited')]);
        return redirect('accounts');
    }


    public function destroy( Request $request, $id )
	{
        $id = Sanitize::Input( $id );

        $account = \App\Account::find($id);
        if ( isset($account) ) {
            $account->delete();
        }
        
		$request->session()->flash('success', [__('text.success'), __('text.accountDeleted')]);
		return redirect('accounts');
	}

}
