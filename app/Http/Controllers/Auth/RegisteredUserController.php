<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Contract\Auth as FirebaseAuth; 

class RegisteredUserController extends Controller
{
    protected $authFirebase;

    public function __construct(FirebaseAuth $auth)
    {
        $this->middleware('guest');
        $this->authFirebase = $auth;
    }
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        /*$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);*/

        try {
            $userProperties = [
                'email' => $request->input('email'),
                'emailVerified' => false,
                'password' => $request->input('password'),
                'displayName' => $request->input('name'),
                'disabled' => false,
            ];
            $this->authFirebase->createUser($userProperties);
            $this->authFirebase->sendEmailVerificationLink($request->input('email'));
            return redirect()->route('login');
        } catch (FirebaseException $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
