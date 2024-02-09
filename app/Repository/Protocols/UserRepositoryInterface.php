<?php
namespace App\Repository\Protocols;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function all(): Collection;

   public function getUserByUserEmail(string $email): User;
}