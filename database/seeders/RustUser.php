<?php
namespace Database\Seeders;

use App\Models\Rust\User;
use Illuminate\Database\Seeder;

class RustUser extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::create([
            'username' => 'Arman',
            'code' => '888888',
        ]);

        User::create([
            'username' => 'Taha',
            'code' => '232323',
        ]);

    }
}
