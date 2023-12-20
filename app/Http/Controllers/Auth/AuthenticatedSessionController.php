<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use Kreait\Firebase\Contract\Auth as FirebaseAuth; 
use Illuminate\Validation\ValidationException;
class AuthenticatedSessionController extends Controller
{
    protected $authFirebase;

    public function __construct(FirebaseAuth $auth)
    {
        $this->middleware('guest')->except('logout');
        $this->authFirebase = $auth;
    }
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        //$request->authenticate();

        //$request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        try {
            $signInResult = $this->authFirebase->signInWithEmailAndPassword($request["email"], $request["password"]);
    
            $loginuid = $signInResult->firebaseUserId();
            $user = $this->authFirebase->getUser($loginuid);
            $verify = $user->emailVerified;
            if ($verify == 1) {
                Session::put('uid',$loginuid);
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                //$this->authFirebase->sendEmailVerificationLink($request["email"]);
                throw ValidationException::withMessages([
                    'email' => ["Debe de verificar el email."],
                ]);
            }
        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            throw ValidationException::withMessages([
                'email' => [trans("auth.failed")],
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Session::flush();

        return redirect('/login');
    }
}
