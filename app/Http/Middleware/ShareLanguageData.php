<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class ShareLanguageData
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentLanguage = $user->languageable ?? $this->getAvailableLanguages()->first();

            View::share('currentLanguage', $currentLanguage);
            View::share('availableLanguages', $this->getAvailableLanguages());

            App::setLocale($currentLanguage->canonical ?? 'vn');
            session(['currentLanguage' => $currentLanguage]);
        }

        return $next($request);
    }

    private function getAvailableLanguages()
    {
        $languageRepository = resolveInstance('Language', '', "Repositories", "Repository");
        return $languageRepository->all()->where('publish', 2);
    }
}