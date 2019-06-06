<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Users;
use Log;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('id', $request->input('id'))->first();


        if ($request->input('password') == $user->password) {
            $apikey = base64_encode(str_random(40));
            Users::where('id', $request->input('id'))->update(['api_key' => "$apikey"]);
//            return response()->download('test.rtf');
            return response()->json(['status' => 'success', 'api_key' => $apikey]);
        } else {
            Log::error('Invalid user: '.$user->id);
            return response()->json(['status' => 'fail'], 401);
        }
    }
}

?>
