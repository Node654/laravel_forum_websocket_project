<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\Message\DTO\StoreMessageData;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? url('storage/'.$this->avatar) : null;
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'message_user_likes', 'user_id', 'message_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->where('is_read', false);
    }

    public static function getFilteredUserId(StoreMessageData $data): Collection
    {
        return getId($data)->filter(function (int $item) {
            return User::query()->where('id', $item)->exists();
        });
    }

    public function complaintedMessages(): BelongsToMany
    {
        return $this->belongsToMany(Message::class, 'complaints', 'user_id', 'message_id', 'id', 'id');
    }
}
