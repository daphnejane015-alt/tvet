<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * The attributes that should be cast.
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
    
    /**
     * Relationship: satu user boleh ada banyak permohonan
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Relationship: permohonan Google Form UP_TVET / Kursus TVET (boleh banyak)
     */
    public function upTvetApplications()
    {
        return $this->hasMany(UpTvetApplication::class);
    }

    /**
     * Relationship: permohonan TVET terkini (atau tunggal)
     */
    public function upTvetApplication()
    {
        return $this->hasOne(UpTvetApplication::class)->latestOfMany();
    }

    /**
     * Semak sama ada pengguna sudah mengisi sekurang-kurangnya satu borang TVET
     */
    public function hasCompletedUpTvet(): bool
    {
        return $this->upTvetApplications()->exists();
    }

    /**
     * Semak kalau user ni admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
