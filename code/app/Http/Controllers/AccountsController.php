<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{

    public function index()
    {
        $accounts = \App\Account::where('user_id', auth()->user()->id)->get();

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
        $account = new \App\Account;

        $account->user_id = auth()->user()->id;
        if ( empty($request->IBAN) ) {
            return abort(404);
        }
        $account->IBAN = $request->IBAN;

        $account->save();

        $request->session()->flash('success', [__('text.success'), __('text.accountAdded')]);
        return redirect('accounts');
    }


    public function edit( $id )
    {
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
        $account = \App\Account::find($id);
        if ( empty($request->IBAN) ) {
            return abort(404);
        }
        $account->IBAN = $request->IBAN;
        $account->save();

        $request->session()->flash('success', [__('text.success'), __('text.accountEdited')]);
        return redirect('accounts');
    }


    public function destroy( Request $request, $id )
	{
        $account = \App\Account::find($id);
        if ( isset($account) ) {
            $account->delete();
        }
        
		$request->session()->flash('success', [__('text.success'), __('text.accountDeleted')]);
		return redirect('accounts');
	}

}
