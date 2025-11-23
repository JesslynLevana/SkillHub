<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrClassMember extends Model
{
    use HasFactory;

    protected $table = 'tr_class_members';

    protected $fillable = [
        'ms_class_id',
        'ms_member_id',
    ];
}
