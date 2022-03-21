<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\menu;
use App\Models\menuitem;
use View;
use DB;
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
        view()->composer(
            
            ['menu.header',
            'menu.footer',
             'menu.sidebar'], 
                // '*', // any where display 
                function ($view) {
                $topNavItems='';
                $topNavItems2 ='';            
                $topNavItems3 ='';            
                $topNav = menu::where('location', 1)->first();
                $topNavItems = json_decode($topNav->content);
                $topNavItems = $topNavItems[0];             
                foreach($topNavItems as $menu){                
            
                $menu->title = menuitem::where('id',$menu->id)->value('title');
                $menu->name = menuitem::where('id',$menu->id)->value('name');
                $menu->slug = menuitem::where('id',$menu->id)->value('slug');
                $menu->target = menuitem::where('id',$menu->id)->value('target');
                $menu->type = menuitem::where('id',$menu->id)->value('type');
                if(!empty($menu->children[0])){
                    foreach ($menu->children[0] as $child) {
                        $child->title = menuitem::where('id',$child->id)->value('title');
                        $child->name = menuitem::where('id',$child->id)->value('name');
                        $child->slug = menuitem::where('id',$child->id)->value('slug');
                        $child->target = menuitem::where('id',$child->id)->value('target');
                        $child->type = menuitem::where('id',$child->id)->value('type');
                             if(isset($child->children[0])){
                                foreach ($child->children[0] as $chil) {
                                    $chil->title = menuitem::where('id',$chil->id)->value('title');
                                    $chil->name = menuitem::where('id',$chil->id)->value('name');
                                    $chil->slug = menuitem::where('id',$chil->id)->value('slug');
                                    $chil->target = menuitem::where('id',$chil->id)->value('target');
                                    $chil->type = menuitem::where('id',$chil->id)->value('type');
                                            // print_r($chil->title);
                                } 
                            }
                        }  
                    }
                }
                // ============Footer Menu=================
                 $topNav2 = menu::where('location',2)->first();
                 if(isset($topNav2->content)){
                $topNavItems2 = json_decode($topNav2->content);
                $topNavItems2 = $topNavItems2[0];             
                foreach($topNavItems2 as $menu){
                $menu->title = menuitem::where('id',$menu->id)->value('title');
                $menu->name = menuitem::where('id',$menu->id)->value('name');
                $menu->slug = menuitem::where('id',$menu->id)->value('slug');
                $menu->target = menuitem::where('id',$menu->id)->value('target');
                $menu->type = menuitem::where('id',$menu->id)->value('type');
                if(!empty($menu->children[0])){
                    foreach ($menu->children[0] as $child) {                        
                        $child->title = menuitem::where('id',$child->id)->value('title');
                        $child->name = menuitem::where('id',$child->id)->value('name');
                        $child->slug = menuitem::where('id',$child->id)->value('slug');
                        $child->target = menuitem::where('id',$child->id)->value('target');
                        $child->type = menuitem::where('id',$child->id)->value('type');
                            if(isset($child->children[0])){
                                foreach ($child->children[0] as $chil) {
                                    $chil->title = menuitem::where('id',$chil->id)->value('title');
                                    $chil->name = menuitem::where('id',$chil->id)->value('name');
                                    $chil->slug = menuitem::where('id',$chil->id)->value('slug');
                                    $chil->target = menuitem::where('id',$chil->id)->value('target');
                                    $chil->type = menuitem::where('id',$chil->id)->value('type');
                                            // print_r($chil->title);
                                } 
                            }
                        }  
                        
                    }
                }
             }
              // =============Sidebar================
                $topNav3 = menu::where('location', 3)->first();  
            if($topNav3){
             $topNavItems3 = json_decode($topNav3->content);
            $topNavItems3 = $topNavItems3[0];   
      
            foreach($topNavItems3 as $menu){      
              $menu->title = menuitem::where('id',$menu->id)->value('title');
              $menu->name = menuitem::where('id',$menu->id)->value('name');
              $menu->slug = menuitem::where('id',$menu->id)->value('slug');
              $menu->target = menuitem::where('id',$menu->id)->value('target');
              $menu->type = menuitem::where('id',$menu->id)->value('type');
              if(!empty($menu->children[0])){
                  foreach ($menu->children[0] as $child) {
                      $child->title = menuitem::where('id',$child->id)->value('title');
                      $child->name = menuitem::where('id',$child->id)->value('name');
                      $child->slug = menuitem::where('id',$child->id)->value('slug');
                      $child->target = menuitem::where('id',$child->id)->value('target');
                      $child->type = menuitem::where('id',$child->id)->value('type');
                       if(isset($child->children[0])){

                          foreach ($child->children[0] as $chil) {
                              $chil->title = menuitem::where('id',$chil->id)->value('title');
                              $chil->name = menuitem::where('id',$chil->id)->value('name');
                              $chil->slug = menuitem::where('id',$chil->id)->value('slug');
                              $chil->target = menuitem::where('id',$chil->id)->value('target');
                              $chil->type = menuitem::where('id',$chil->id)->value('type');
                                    // print_r($chil->title);
                          } 
                        }
                      
                    }  

                  }
    
                }
            }
                
                $view->with([
                    'topNavItems'=> $topNavItems,
                    'topNavItems2'=> $topNavItems2,
                    'topNavItems3'=> $topNavItems3]);
            }
        );
   
        Paginator::useBootstrap();
    }
}
