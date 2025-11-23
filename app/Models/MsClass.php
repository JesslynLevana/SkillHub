<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MsClass extends Model
{
    use HasFactory;

    protected $table = 'ms_classes';

    protected $fillable = [
        'name',
        'description',
        'instructor',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(MsMember::class, 'tr_class_members', 'ms_class_id', 'ms_member_id')
            ->withTimestamps();
    }
}
