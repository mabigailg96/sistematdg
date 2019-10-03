<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Coordinador general
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [3, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [4, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [5, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [6, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [22, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [23, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 1]);
   

        //Coordinador de escuela
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [1, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [2, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [12, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [13, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [14, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [15, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [16, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [17, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [18, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [19, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [20, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [21, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [24, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [25, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [26, 2]);

        //Secretarias escuela
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 3]);

        //Administracion academica
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 4]);
        
        
    }
}
