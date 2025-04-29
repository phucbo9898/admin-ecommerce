<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
