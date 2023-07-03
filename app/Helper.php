<?php

use App\Models\Role;
use App\Models\User;

class Helper 
{
   /**
    * Method to verify if specified role_id belongs to ADMIN role
    */
   public static function is_admin_role(?int $role_id): bool
   {
      $role = Role::find($role_id);

      if (!isset($role)) {
         return false;
      }

      return $role->name == 'ADMIN' ? true : false;
   }

   /**
    * Method to check if the user role meets the allowed roles condition
    */
   public static function role_is_allowed(string $user_role, string ...$allowed_roles)
   {
      $role = strtolower($user_role);

      if ($role == 'dev') {
         return true;
      }

      $roles = collect($allowed_roles)->map(function ($value) {
         return strtolower($value);
      })->toArray();

      return in_array(strtolower($role), $roles);
   }

   /**
    * Method to check if the user owns or its allowed a model
    */
   public static function is_owner_or_allowed(User $user, $model)
   {
      if (in_array($user->role->name, ['DEV', 'ADMIN'])) {
         return true;
      }

      if ($model->user_id == $user->id) {
         return true;
      }

      return false;
   }
}
