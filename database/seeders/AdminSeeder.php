<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Sahitya Karn',
            'email' => 'sahityakarn@gmail.com',
            'password' => Hash::make('sahityakarn@gmail.com'),
            'is_admin' => '2',
            'branch_name' => 'Super Admin',
            'website' => 'superadmin.co.in',
            'branch_type' => 'Institute',
            'address' => 'Flat No 207 Maharani Enclave Hastal Uttam Nagar',
            'contact' => '9599007788',
            'state' => 'Delhi',
            'district' => 'West Delhi',
            'country' => 'India',
            'profile_photo' => 'super_admin_photo.jpg',
        ]);
    }
}
