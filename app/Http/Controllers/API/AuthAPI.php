<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthAPI extends Controller
{
    public function getAuth()
    {
        $auth = Auth::all();
        if ($auth->count() > 0) {
            return response()->json($auth);
        } else {
            return response()->json([
                'status' => 'No user'
            ]);
        }
    }
    public function postAuth(Request $request)
    {
        $profile = $request->file('profile');
        $fileName = rand(1, 1000) . '-' . $profile->getClientOriginalName();
        $profile->move('images', $fileName);
        $auth = Auth::create([
            'username' => $request->username,
            'password' => md5($request->password),
            'profile' => $fileName,
        ]);
        if ($auth) {
            return response()->json([
                'status' => 'Success'
            ]);
        } else {
            return response()->json([
                'status' => 'Not success'
            ]);
        }
    }
    public function loginAuth(Request $request)
    {
        $authId = DB::select("SELECT id FROM `auth` WHERE username=:username  AND password=:password ", [
            'username' => $request->username,
            'password' => md5($request->password),
        ], );
        return $authId;
    }
}
