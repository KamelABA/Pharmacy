<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('register');
    }

    // Handle the registration form submission
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in automatically after registration
        auth()->login($user);

        // Flash success message to the session
        session()->flash('success', 'You have successfully registered and logged in!');

        // Redirect to the intended page or default dashboard
        return redirect()->route('welcome');
    }
}
