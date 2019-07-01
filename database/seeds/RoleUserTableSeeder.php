<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Dando a los usuarios de escuela el rol 2
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [2,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [3,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [4,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [5,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [6,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [7,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [8,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [9,2]);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [10,2]);

        //Dando al admin el rol 1
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [1,1]);

    }
}
