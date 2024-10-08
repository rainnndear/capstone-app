<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Create;
use App\Models\Transaction;
use App\Models\Client;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $attrs = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Fetch the user based on the email provided
    $user = User::where('email', $attrs['email'])->first();

    // Debugging: Log user object to check if it is null or missing ID
    Log::info('User fetched:', ['user' => $user]);

    // Check if user is null
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Check if password matches
    if (!Hash::check($attrs['password'], $user->password)) {
        return response()->json(['error' => 'Invalid password'], 401);
    }

    // Debugging: Check if user ID is null
    if (!$user->user_id) {
        Log::error('User ID is null', ['user' => $user]);
        return response()->json(['error' => 'User ID is null'], 500);
    }

    // Create a token for the authenticated user
    $token = $user->createToken('secret')->plainTextToken;

    // Fetch counts for data and user
    $supplier = Create::count();
    $user = User::count(); 
    $users = User::all();
    $transaction = Transaction::count();
    $client = Client::count();
    // Return the admin dashboard view with the data and user count
    return redirect()->route('admin.dashboard')
                     ->with(['supplier' => $supplier, 'user' => $user, 'client' => $client
                    ,'transaction' => $transaction, 'users' => $users]);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function person($id){

        $user = User::where('user_id', $id)->first();

        return view('admin.person', compact('user'));
    }

    
    public function register(Request $request){

        try {
            $attrs = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'account_type' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'department' => 'required'
            ]);
            
            User::create([
                'email' => $attrs['email'],
                'password' => bcrypt($attrs['password']), // Make sure to hash the password
                'lastname' => $attrs['lastname'],
                'gender' => $attrs['gender'],
                'account_type' => $attrs['account_type'],
                'firstname' => $attrs['firstname'],
                'department' => $attrs['department'],
            ]);
    
            return response([
                'response' => 'success'
            ], 200);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error($e->getMessage());
            return response([
                'error' => 'An error occurred'
            ], 500);
        }

    }

    public function login_users(Request $request){
        
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(!Auth::attempt($attrs)){
            return Response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
        
    }



}
