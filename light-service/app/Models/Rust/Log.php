<?php
namespace App\Models\Rust;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    protected $guarded = [];

    protected $table = 'rust_treasure_logs';

    public function treasure() {
        return $this->belongsTo(Treasure::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
