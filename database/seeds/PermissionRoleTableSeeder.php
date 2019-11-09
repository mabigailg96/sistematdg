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
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [28, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [29, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [30, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [31, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [32, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [33, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [34, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [35, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [36, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [37, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [39, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [46, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [47, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [49, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [50, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [51, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [52, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [53, 1]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [54, 1]);

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
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [27, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [38, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [46, 2]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [48, 2]);

        //Secretarias escuela
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [7, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [8, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [9, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [40, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [41, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [42, 3]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [43, 3]);

        //Administracion academica
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [10, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [11, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [44, 4]);
        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [45, 4]);
        
    }
}
