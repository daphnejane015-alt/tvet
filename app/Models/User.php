<?php

namespace App\Models;

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

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification());
    }

    /**
     * Get the email verification URL.
     */
    public function getEmailVerificationUrl()
    {
        return \Illuminate\Support\Facades\URL::route(
            'verification.verify',
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ],
            true // absolute URL
        );
    }
}
