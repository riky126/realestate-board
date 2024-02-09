<?php 
namespace App\Providers;

use Illuminate\Support\ServiceProvider; 

use App\Repository\Protocols\EloquentRepositoryInterface; 
use App\Repository\Protocols\UserRepositoryInterface;

use App\Repository\BaseRepository;  
use App\Repository\UserRepository; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
   }
}