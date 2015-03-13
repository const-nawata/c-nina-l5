<?php namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
// use Illuminate\Routing\Controller;
use Response;
use View;

// use Illuminate\Http\Request;

// use Request;
// use Auth;

class UsersController extends MainController {

	public function getLogin(){
		return view('users/login');
	}
//______________________________________________________________________________

	public function postLogin( LoginFormRequest $request ){




		return Response::make('Login processed!');








// 	    $creds = [
// 	        'password' => Input::get('password'),
// 	        'isActive'  => 1, // Only activated users can authorise
// 	    ];
// echo '<pre>'.print_r( $creds ,1).'</pre>';
// 	    $username 		= Input::get('username');

// 	    $creds['username']	= $username;


// 	    $creds = [
// 	    	'username' => 'admin',
// 	        'password' => 'admin',
// // 	        'isActive'  => 1, // Only activated users can authorise
// 	    ];

// echo "KKKKKKKKKKKKKKKKKKKKKKKK JJJ";exit;

// 	    $result	= Auth::attempt($creds, Input::has('remember'));

// 	    $result	= Auth::attempt($creds);

	    // Try to authorise user
// 	    if (Auth::attempt($creds, Input::has('remember'))) {
// 	        Log::info( trans( 'messages.login_success', ['username'=>$username] ) );
// 	        return Redirect::intended();
// 	    }

// 	    Log::info( trans( 'messages.login_failed', ['username'=>$username] ) );

// 	    return Redirect::back()->withAlert( trans('messages.login_wrong') );

// 		return view('users/login');

	}
//______________________________________________________________________________

	public function getLogout() {
	    Auth::logout();
	    return Redirect::to('/');
	}
//______________________________________________________________________________

}//	Class end

