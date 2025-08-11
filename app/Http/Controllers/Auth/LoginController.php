<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the post-login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('home');
    }

    /**
     * Handle a successful authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Clean up any problematic intended URLs
        $intended = session('url.intended');
        
        // List of URLs/patterns that should not be used as redirect targets
        $forbiddenPatterns = [
            '/api/',
            '/notifications',
            '/calendar-data',
            '.json',
            '/logout'
        ];
        
        // Check if intended URL contains forbidden patterns
        if ($intended) {
            foreach ($forbiddenPatterns as $pattern) {
                if (strpos($intended, $pattern) !== false) {
                    // Clear the problematic intended URL
                    session()->forget('url.intended');
                    break;
                }
            }
        }
        
        // Log successful login for security
        logger()->info('User logged in', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        // Redirect to intended URL (if safe) or default home
        return redirect()->intended(route('home'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Log the logout for security
        if (Auth::check()) {
            logger()->info('User logged out', [
                'user_id' => Auth::id(),
                'user_email' => Auth::user()->email,
                'ip' => $request->ip(),
            ]);
        }

        // Perform logout
        Auth::logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Clear any intended URL to prevent redirect issues
        $request->session()->forget('url.intended');
        
        // Clear any other session data that might cause issues
        $request->session()->forget('_previous');
        
        // Flash success message
        $request->session()->flash('status', 'Anda telah berhasil logout.');
        
        // Redirect to login page
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
        
        return redirect()->route('login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // Clear any problematic session data when showing login form
        session()->forget(['url.intended', '_previous']);
        
        return view('auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            $this->username() . '.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // Log failed login attempt for security
        logger()->warning('Failed login attempt', [
            'email' => $request->input($this->username()),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}