<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, Uuid;

    const ADMIN = 1;

    const SYSTEM_ADMIN = 2;

    const USER = 3;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 2;

    const STATUS_PENDING = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ADMIN;
    }

    public function isSystemAdmin(): bool
    {
        return $this->role === self::SYSTEM_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::USER;
    }

    public function address(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }
}
