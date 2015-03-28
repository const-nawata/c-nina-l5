<?php namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Auth;

class UsersController extends MainController {

	public function getLogin(){
		return view('users/login');
	}
//______________________________________________________________________________

	public function postLogin( LoginFormRequest $request ){

		$username	=
	    $creds = [
			'username' => $request->input('username'),
	        'password' => $request->input('password'),
	        'isActive'  => 1
	    ];

	    if( Auth::attempt($creds, $request->has('remember'))){
// 	    	info(trans( 'messages.login_success', ['username'=>$creds['username']] ));
	    	return redirect()->intended();
	    }

	    info(trans( 'messages.login_wrong', ['username'=>$creds['username']] ));

	    return redirect()->back()->withErrors( [trans('messages.login_wrong')] );
	}
//______________________________________________________________________________

	public function getLogout() {
		Auth::logout();
		return redirect()->to('/');
	}
//______________________________________________________________________________

}//	Class end

