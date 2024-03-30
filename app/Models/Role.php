<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    use HasFactory;
    protected $table="role";
    protected $fillable = [
        'id_role',
        'name',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_role', 'id_role');
    }



}
