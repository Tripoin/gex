<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = array(
            ['code' => 'ADM001', 'name' => 'admin', 'username' => 'admin', 'email' => 'test1@test.com', 'password' => bcrypt('admin'),  'role' => 'admin', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'ADM002', 'name' => 'admin 2', 'username' => 'admin2', 'email' => 'tesla@test.com', 'password' => bcrypt('admin'),  'role' => 'admin2', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'ADM003', 'name' => 'rintis', 'username' => 'rintis', 'email' => 'test6@test.com', 'password' => bcrypt('admin'),  'role' => 'admin', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'OP001', 'name' => 'operation', 'username' => 'operation', 'email' => 'test2@test.com', 'password' => bcrypt('admin'),  'role' => 'operation', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'OP002', 'name' => 'operation2', 'username' => 'operation2', 'email' => 'test222@test.com', 'password' => bcrypt('admin'),  'role' => 'operation', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PR001', 'name' => 'pricing', 'username' => 'pricing', 'email' => 'test4@test.com', 'password' => bcrypt('admin'),  'role' => 'pricing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PR002', 'name' => 'pricing2', 'username' => 'pricing2', 'email' => 'test444@test.com', 'password' => bcrypt('admin'),  'role' => 'pricing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'INV001', 'name' => 'invoice', 'username' => 'invoice', 'email' => 'test5@test.com', 'password' => bcrypt('admin'),  'role' => 'invoice', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'INV002', 'name' => 'invoice2', 'username' => 'invoice2', 'email' => 'test555@test.com', 'password' => bcrypt('admin'),  'role' => 'invoice', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PAY001', 'name' => 'payable', 'username' => 'payable', 'email' => 'test7@test.com', 'password' => bcrypt('admin'),  'role' => 'payable', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PAY002', 'name' => 'payable2', 'username' => 'payable2', 'email' => 'test777@test.com', 'password' => bcrypt('admin'),  'role' => 'payable', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK001', 'name' => 'ANITA', 'username' => 'anita', 'email' => 'test3@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK002', 'name' => 'DEVITA', 'username' => 'devita', 'email' => 'test30@gex.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK003', 'name' => 'DIAH', 'username' => 'diah', 'email' => 'test31@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK004', 'name' => 'TRIANA', 'username' => 'triana', 'email' => 'test32@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK005', 'name' => 'SYINDI', 'username' => 'syindi', 'email' => 'test33@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK006', 'name' => 'TRIYAWATI', 'username' => 'triyawati', 'email' => 'test34@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK007', 'name' => 'DEWI', 'username' => 'dewi', 'email' => 'test35@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK008', 'name' => 'JOHAN', 'username' => 'johan', 'email' => 'test36@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK009', 'name' => 'VINSEN', 'username' => 'vinsen', 'email' => 'test37@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK010', 'name' => 'IIN', 'username' => 'iin', 'email' => 'test38@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK011', 'name' => 'WINA', 'username' => 'wina', 'email' => 'test39@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'MRK012', 'name' => 'RIRI', 'username' => 'riri', 'email' => 'test310@test.com', 'password' => bcrypt('admin'),  'role' => 'marketing', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'APP001', 'name' => 'app', 'username' => 'manager', 'email' => 'test41@test.com', 'password' => bcrypt('admin'),  'role' => 'manager', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'APP002', 'name' => 'app2', 'username' => 'manager2', 'email' => 'test411@test.com', 'password' => bcrypt('admin'),  'role' => 'manager', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PJK001', 'name' => 'pajak', 'username' => 'pajak', 'email' => 'test42@test.com', 'password' => bcrypt('admin'),  'role' => 'pajak', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'PJK002', 'name' => 'pajak2', 'username' => 'pajak2', 'email' => 'test422@test.com', 'password' => bcrypt('admin'),  'role' => 'pajak', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'RPAY001', 'name' => 'receivable', 'username' => 'receivable', 'email' => 'test51@test.com', 'password' => bcrypt('admin'),  'role' => 'receivable', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],
            ['code' => 'APR001', 'name' => 'apr', 'username' => 'manager3', 'email' => 'test523@test.com', 'password' => bcrypt('admin'),  'role' => 'manager', 'created_at' => new DateTime, 'updated_at' => new DateTime, 'deleted_at' => new DateTime],


        );
        DB::table('users')->insert($user);
    }
}
