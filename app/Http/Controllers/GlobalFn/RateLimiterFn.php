<?php

namespace App\Http\Controllers\GlobalFn;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\RateLimiter;

class RateLimiterFn extends BaseController
{
    //this name is due to 'RateLimiter' already used by facade

    /**
     * rate limit request from user to protect from ddos and bruteforce
     * usage =  
     * use App\Http\Controllers\GlobalFn\RateLimiterFn; 
     * RateLimiterFn::checkTooManyFailedAttempts();
     * if ($this->checkTooManyFailedAttempts() == 0) {
     *     return back()->with('danger', 'spam detected, wait ' . RateLimiter::availableIn($this->throttleKey()) . 's');
     * }
     * if (// something //) {
     * // do something
     * } else {
     * RateLimiter::hit($this->throttleKey(), $seconds = 300);
     * return back()->with('error', 'message');
     * }
     * }
     */

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    static function throttleKey()
    {
        return request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return object
     */

    static function checkTooManyFailedAttempts()
    {
        $result = new \stdClass;
        $result->pass = !RateLimiter::tooManyAttempts(self::throttleKey(), 3);
        $result->time = $result->pass? 0 : RateLimiter::availableIn(self::throttleKey());

        return $result;
    }

    /**
     * hit rate limiter
     *
     * @return void
     */
    static function hit($seconds = 300){
        RateLimiter::hit(self::throttleKey(), $seconds);
    }
}
