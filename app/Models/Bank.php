<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = ['user_id', 'name', 'amount'];

    
    
    public function getKeyType()
    {
        return 'string';  
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
