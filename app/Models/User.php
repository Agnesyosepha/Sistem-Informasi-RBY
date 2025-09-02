<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi mass-assignment.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (misalnya ke JSON).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Gunakan username untuk autentikasi, bukan email.
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
