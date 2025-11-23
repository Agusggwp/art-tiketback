<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = ['key', 'value', 'logo'];

    // Atau pakai guarded kalau mau lebih fleksibel (saya sarankan ini)
    // protected $guarded = ['id'];

    protected $table = 'settings';

    // Tambahkan ini agar logo selalu mengembalikan full URL (opsional tapi sangat berguna)
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/default-logo.png'); // fallback logo
    }

    // Helper untuk ambil setting dengan mudah (bisa dipakai di seluruh aplikasi)
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting?->value ?? $default;
    }

    public static function getLogo()
    {
        $setting = static::where('key', 'logo')->first();
        return $setting?->logo_url ?? asset('images/default-logo.png');
    }
}