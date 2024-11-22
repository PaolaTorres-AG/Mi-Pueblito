<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Soporte;
use Illuminate\Support\Facades\DB;
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
    public function boot(Dispatcher $events): void
    {
        date_default_timezone_set('America/Mexico_City');
        
         $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
           
            
           
            $event->menu->add([
           'text'    => 'Incidencias',
        'url'  => 'MiPueblito/Incidencias',
        'icon'    => 'fa fa-solid  fa-headset',
        'icon_color' => 'gray-200',
        'classes'  => 'font-weight-normal text-sm',
         'can'=>'TI',
            // 'label'       => Soporte::count(),
            'label' => DB::table('soportes')->Where('estatus','PENDIENTE')->count(),
            'label_color' => 'success',
          
            ]);
        });
    }
}
