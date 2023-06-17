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
}
