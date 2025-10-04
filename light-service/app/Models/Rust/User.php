<?php
namespace App\Models\Rust;

use App\Models\Rust\Log;
use App\Models\Rust\Treasure;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'rust_users';

    protected $guarded = [];

    public function logs() {
        return $this->hasMany(Log::class);
    }

    public function treasures() {
        return $this->hasManyThrough(
            Treasure::class,
            Log::class,
            'user_id',
            'id',
            'id',
            'treasure_id'
        )->where('rust_treasure_logs.status', 'success');
    }
}
