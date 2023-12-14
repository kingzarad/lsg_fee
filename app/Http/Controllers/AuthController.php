<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Course;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function User()
    {
        if (auth('web')->check()) {
            return redirect()->route('dashboard');
        }
        if (auth('students')->check()) {
            return redirect()->route('users.home');
        }

        return response()->view('login_users')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    public function Admin()
    {
        if (auth('web')->check()) {
            return redirect()->route('dashboard');
        }
        if (auth('students')->check()) {
            return redirect()->route('users.home');
        }

        return response()->view('login_admin')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    public function Register()
    {
        if (auth('web')->check()) {
            return redirect()->route('dashboard');
        }
        if (auth('students')->check()) {
            return redirect()->route('users.home');
        }

        return response()->view('register',['courses' => Course::orderBy('created_at', 'DESC')->get()])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }

    public function Authenticate_User()
    {
        $validated = request()->validate([
            'id_number' => ['required', 'regex:/^\d{4}-\d{4}$/'],
            'password' => 'required|min:5|max:50',
        ], [
            'id_number.regex' => 'Invalid ID number. ex. 0000-0000.',
        ]);

        if (Auth::guard('students')->attempt($validated)) {

            request()->session()->regenerate();

            return redirect()->route('users.home')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'No matching user found with the provided id number and password');
    }

    public function Authenticate_Admin()
    {

        $validated = request()->validate([
            'username' => 'required|max:50',
            'password' => 'required|min:5|max:50'
        ]);

        if (Auth::guard('web')->attempt($validated)) {
            request()->session()->regenerate();
            // dd(session()->all());
            return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
        }

        return redirect()->route('login_admin')->with('error', 'No matching user found with the provided username and password');
    }

    public function Store()
    {
        request()->validate([
            'idnum' => [
                'required',
                'regex:/^\d{4}-\d{4}$/',
                Rule::unique('students', 'id_number')
            ],
            'fname' => 'required|min:3|max:50',
            'lname' => 'required|min:3|max:50',
            'mname' => 'nullable|min:3|max:50',
            'course' => 'required',
            'yrlevel' => ['required', 'regex:/^(1st|2nd|3rd|4th) year$/i'],
            'sex' => 'required|min:3|max:50',
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('students', 'email')
            ],
            'password' => 'required|min:3|max:50'
        ], [
            'fname' => 'Firstname is required',
            'lname' => 'Lastname is required',
            'mname' => 'Middlename is required',
            'idnum.unique' => 'The ID number is already taken.',
            'email.unique' => 'The email is already taken.',
            'idnum.regex' => 'Invalid ID number. ex. 0000-0000.',
            'yrlevel' => 'Invalid year level. ex. 1st year, 2nd year',
        ]);

        $existingUser = Students::where('fname', request()->get('fname'))
            ->where('lname', request()->get('lname'))
            ->where(function ($query) {
                $query->where('mname', request()->get('mname'))
                    ->orWhereNull('mname');
            })
            ->first();

        if ($existingUser) {
            return back()->with('error', 'User with the same name already exists.');
        }

        Students::create([
            'fname' => request()->get('fname'),
            'lname' => request()->get('lname'),
            'mname' => request()->get('mname'),
            'id_number' => request()->get('idnum'),
            'year_level' => request()->get('yrlevel'),
            'sex' => request()->get('sex'),
            'course_id' => request()->get('course'),
            'email' => request()->get('email'),
            'password' => Hash::make(request()->get('password'))
        ]);
        return back()->with('success', 'Account created successfully! <a href="' . route('login_users') . '">Login</a>');
    }

    public function StoreAdmin()
    {
        User::create([
            'username' => 'administrator',
            'roles' => 'superadmin',
            'password' => Hash::make('admin123')
        ]);
        return back()->with('success', 'Administrator created successfully!');
    }

    public function LogoutUser()
    {
        auth('students')->logout();

        return response()->view('login_users')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');

    }

    public function LogoutAdmin()
    {
        auth('web')->logout();
        return response()->view('login_admin')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }
}
