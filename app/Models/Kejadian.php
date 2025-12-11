<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kejadian extends Model
{
    use HasFactory;

    // Nama tabel (pakai bahasa Indonesia)
    protected $table = 'kejadian';

    // Karena kita pakai UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    /**
     * Mass assignable
     */
    protected $fillable = [
        'jenis_kejadian',
        'objek',
        'lokasi',
        'waktu_kejadian',
        'terima_berita',
        'berangkat',
        'tiba_di_lokasi',
        'respon_time',
        'kembali_ke_pos',
        'foto',
    ];

    /**
     * Casts untuk tanggal/waktu agar selalu Carbon instance
     */
    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'terima_berita'   => 'datetime',
        'berangkat'       => 'datetime',
        'tiba_di_lokasi'  => 'datetime',
        'kembali_ke_pos'  => 'datetime',
    ];

    /**
     * Boot model untuk meng-generate UUID saat creating
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Accessor: url foto (public)
     * Gunakan $kejadian->foto_url
     */
    public function getFotoUrlAttribute()
    {
        if (! $this->foto) {
            return null;
        }

        // storage/app/public/incidents atau di sini kita simpan di storage/app/public/kejadian
        // asumsi: foto disimpan di disk 'public' dalam folder 'kejadian'
        return asset('storage/kejadian/' . $this->foto);
    }

    /**
     * Accessor: format lengkap waktu kejadian (Indonesia)
     * Gunakan $kejadian->waktu_kejadian_lengkap
     */
    public function getWaktuKejadianLengkapAttribute()
    {
        if (! $this->waktu_kejadian) return null;

        // pastikan locale sudah di-set di config/app.php ke 'id' bila ingin nama hari/bulan bahasa Indonesia
        return $this->waktu_kejadian->translatedFormat('l, d F Y') . ' pukul ' . $this->waktu_kejadian->format('H.i');
    }

    /**
     * Helper: jika mau menyimpan foto di folder 'kejadian' secara konsisten
     * Contoh penggunaan di Controller: $filename = $model->storeFoto($request->file('foto'));
     */
    public function storeFoto($uploadedFile)
    {
        if (! $uploadedFile) return null;

        $filename = Str::random(20) . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs('kejadian', $filename, 'public');

        // hapus foto lama kalau ada
        if ($this->foto && \Storage::disk('public')->exists('kejadian/' . $this->foto)) {
            \Storage::disk('public')->delete('kejadian/' . $this->foto);
        }

        // update model langsung (opsional)
        $this->foto = $filename;
        $this->save();

        return $filename;
    }
}
