<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Tip;
use App\Policies\AdminExercisePolicy;
use App\Policies\AdminSessionPolicy;
use App\Policies\AdminTipPolicy;
use App\Policies\SessionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Session::class => SessionPolicy::class,
        Exercise::class => ExercisePolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
