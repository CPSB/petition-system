<?php

namespace ActivismeBE\Http\Middleware;

use Closure;
Use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

/**
 * Class Language
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class Language
{
    /**
     * The supported languages array.
     *
     * @var array
     */
    protected static $supportedlanguage = ['nl', 'en', 'fr'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = (Input::get('lang')) ?: Session::get('lang');
        $this->setSupportedLanguage($language);

        return $next($request);
    }

    /**
     * Check if the language is supported.
     *
     * @param  string $lang
     * @return bool
     */
    public function isLanguageSupported($lang)
    {
        return in_array($lang, self::$supportedlanguage);
    }

    /**
     * Set the supported language to the session.
     *
     * @param string $lang
     * @return void
     */
    public function setSupportedLanguage($lang)
    {
       if ($this->isLanguageSupported($lang)) {
           App::setLocale($lang);
           Session::put('lang', $lang);
       }
    }
}
