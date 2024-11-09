<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configurePasswordValidation();
        $this->configureRateLimiter();
        $this->configureDates();


        Factory::macro('getImageUrl', function (int $width, int $height): string {
            return sprintf(
                'https://picsum.photos/%d/%d',
                $width,
                $height
            );
        });
    }


    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );
    }

    /**
     * Configure the dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
        Carbon::setLocale('fr_FR');
    }

    /**
     * Configure the models.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
        Model::unguard();
    }

    /**
     * Configure the password validation rules.
     */
    private function configurePasswordValidation(): void
    {
        Password::defaults(fn() => $this->app->isProduction() ? Password::min(8)->uncompromised() : null);
    }

    /**
     * Configure the RateLimiter.
     */
    private function configureRateLimiter(): void
    {

        RateLimiter::for('try', function (Request $request) {
            return Limit::perMinute(6)->by($request->user()?->id ?: $request->ip());
        });
    }
}
