<?php

namespace App\Providers;

use App\Models\Contest;
use App\Models\ContestFilter;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\Order;
use App\Models\Policies\EntityPolicy;
use App\Models\Policies\FilterPolicy;
use App\Models\Policies\OrderPolicy;
use App\Models\Policies\ProductPolicy;
use App\Models\Policies\SettingPolicy;
use App\Models\Policies\ContestPolicy;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Policies\ContestFilterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
        Setting::class => SettingPolicy::class,
        Entity::class => EntityPolicy::class,
        Contest::class => ContestPolicy::class,
        Filter::class => FilterPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        ContestFilter::class => ContestFilterPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Gate::define('view-setting-gate', function ($user, $setting) {
            return false;
        });*/

        Gate::define('access-dashboard', function ($user) {
            return true;
        });

        //
    }
}
