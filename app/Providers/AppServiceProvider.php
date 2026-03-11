<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;  // Ye line add karo
use Illuminate\Support\Facades\View;
use App\Models\SidebarMenus;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Sidebar menu composer
        View::composer('admin.partials.sidebar', function ($view) {
            $adminRole = Auth::guard('admin')->user()->role_id ?? null;

            $menus = SidebarMenus::where('is_active', 1)
                ->whereNull('parent_id')
                ->orderBy('order')
                ->with('children')
                ->get()
                ->filter(function ($menu) use ($adminRole) {
                    return $menu->isVisibleForRole($adminRole);
                });

            $view->with('menus', $menus);
        });

        // ✅ Global settings share
        $settings = Setting::pluck('value','key')->toArray();
        View::share('settings', $settings);
    }
}