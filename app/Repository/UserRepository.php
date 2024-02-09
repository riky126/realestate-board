<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\Protocols\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param  $email
     * @return mixed
     */
    public function getUserByUserEmail(string $email): User {
        return $this->model->where('email', $email)->first();
    }
}
