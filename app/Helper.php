<?php

use App\Models\Role;

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
}
