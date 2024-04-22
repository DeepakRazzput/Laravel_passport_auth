<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{

  public function index()
  {
      return view('pagination');
  }

    public function getEmployees(Request $request) {

      $perPage = $request->input('perPage', 10); // Number of records per page, default is 10
      $page = $request->input('page', 1); // Current page, default is 1
      $offset = ($page - 1) * $perPage;
      $employees = DB::table('employees')
      ->skip($offset)
      ->take(10)
      ->get();
      return response()->json($employees);
    }




    //Register Api
    public function register(Request $request){
      $request->validate([
        "name"=>"required",
        "email"=>"required|email|unique:users",
        "password"=>"required|confirmed",
      ]);
      User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>Hash::make($request->password),
      ]);

      return response()->json([
        "status"=>true,
        "message"=>"user created Sunccessfully"
      ]);
    } 
    //login
    public function login(Request $request){
        $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);
          
        //Checking user login
        
        if (Auth::attempt(['email' =>$request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken("myToken")->accessToken;
            return response()->json([
                "status"=>false,
                "message"=>"User Logged",
                "token"=>$token
              ]);
        } else {
            return response()->json([
                "status"=>false,
                "message"=>"Invalied login details"
              ]);
        }
        ;
        

    }
    //profile
    public function profile() {
        $user = Auth::user();
        return response()->json([
            "status"=>true,
            "message"=>"profile info",
            "data"=>$user,
          ]);
    }
    //logout
    public function logout(){
        auth->user()->token()->revoke();
        return response()->json([
            "status"=>true,
            "message"=>"User logOut",
          ]);
    }
        
}
