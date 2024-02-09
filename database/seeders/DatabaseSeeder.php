<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\MovieSeeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::create([
      'name' => 'Ali Azhar',
      'username' => 'aliazhar',
      'email' => 'superadmin@gmail.com',
      'password' => Hash::make('123'),
      'balance' => 100000,
      'dob' => '2003-03-03',
      'address' => 'Bandung',
      'phone' => '082254115411',
      'role' => 'superadmin'
    ]);

    User::create([
      'name' => 'Ali Azhar Admin',
      'username' => 'aliazhar_admin',
      'email' => 'admin@gmail.com',
      'password' => Hash::make('123'),
      'balance' => 100000,
      'dob' => '2003-03-03',
      'address' => 'Bandung',
      'phone' => '082254115411',
      'role' => 'admin'
    ]);

    User::create([
      'name' => 'Ali Azhar Member',
      'username' => 'aliazhar_member',
      'email' => 'member@gmail.com',
      'password' => Hash::make('123'),
      'balance' => 100000,
      'dob' => '2003-03-03',
      'address' => 'Bandung',
      'phone' => '082254115411',
      'role' => 'member'
    ]);

    User::factory(3)->create();
    $this->call(MovieSeeder::class);
    $this->call(DetailScheduleSeeder::class);
  }
}
