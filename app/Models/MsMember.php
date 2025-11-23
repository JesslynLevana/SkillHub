<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MsMember extends Model
{
    use HasFactory;

    protected $table = 'ms_members';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(MsClass::class, 'tr_class_members', 'ms_member_id', 'ms_class_id')
            ->withTimestamps();
    }
}
