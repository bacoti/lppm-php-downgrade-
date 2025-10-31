<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'nama_jurnal',
        'issn',
        'e_issn',
        'penerbit',
        'volume',
        'nomor',
        'halaman',
        'tanggal_publikasi',
        'tahun',
        'doi',
        'url_jurnal',
        'jenis_jurnal',
        'status',
        'penulis',
        'kata_kunci',
        'bahasa',
        'abstrak',
        'file_pdf',
        'cover_image',
        'is_featured',
        'views',
        'downloads',
        'akreditasi',
        'catatan_admin'
    ];

    protected $casts = [
        'penulis' => 'array',
        'kata_kunci' => 'array',
        'tanggal_publikasi' => 'date',
        'is_featured' => 'boolean',
        'tahun' => 'integer',
        'views' => 'integer',
        'downloads' => 'integer'
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jurnal) {
            if (empty($jurnal->slug)) {
                $jurnal->slug = Str::slug($jurnal->judul);
            }
        });

        static::updating(function ($jurnal) {
            if ($jurnal->isDirty('judul')) {
                $jurnal->slug = Str::slug($jurnal->judul);
            }
        });
    }

    /**
     * Get jenis jurnal options
     */
    public static function getJenisJurnalOptions(): array
    {
        return [
            'nasional' => 'Nasional',
            'internasional' => 'Internasional'
        ];
    }

    /**
     * Get status options
     */
    public static function getStatusOptions(): array
    {
        return [
            'published' => 'Published',
            'in_press' => 'In Press',
            'accepted' => 'Accepted',
            'submitted' => 'Submitted',
            'draft' => 'Draft'
        ];
    }

    /**
     * Get akreditasi options
     */
    public static function getAkreditasiOptions(): array
    {
        return [
            'sinta_1' => 'Sinta 1',
            'sinta_2' => 'Sinta 2',
            'sinta_3' => 'Sinta 3',
            'sinta_4' => 'Sinta 4',
            'sinta_5' => 'Sinta 5',
            'sinta_6' => 'Sinta 6',
            'scopus' => 'Scopus',
            'wos' => 'Web of Science',
            'non_sinta' => 'Non Sinta'
        ];
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        switch($this->status) {
            case 'published':
                return 'badge-success';
            case 'in_press':
                return 'badge-info';
            case 'accepted':
                return 'badge-primary';
            case 'submitted':
                return 'badge-warning';
            case 'draft':
                return 'badge-secondary';
            default:
                return 'badge-secondary';
        }
    }

    /**
     * Get jenis jurnal badge class
     */
    public function getJenisJurnalBadgeClass(): string
    {
        switch($this->jenis_jurnal) {
            case 'internasional':
                return 'badge-primary';
            case 'nasional':
                return 'badge-info';
            default:
                return 'badge-secondary';
        }
    }

    /**
     * Get akreditasi badge class
     */
    public function getAkreditasiBadgeClass(): string
    {
        switch($this->akreditasi) {
            case 'sinta_1':
            case 'sinta_2':
                return 'badge-success';
            case 'sinta_3':
            case 'sinta_4':
                return 'badge-primary';
            case 'sinta_5':
            case 'sinta_6':
                return 'badge-info';
            case 'scopus':
            case 'wos':
                return 'badge-warning';
            case 'non_sinta':
                return 'badge-secondary';
            default:
                return 'badge-light';
        }
    }

    /**
     * Increment view count
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Increment download count
     */
    public function incrementDownloads(): void
    {
        $this->increment('downloads');
    }

    /**
     * Scope for published journals
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for featured journals
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for jenis jurnal
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis_jurnal', $jenis);
    }

    /**
     * Scope for year
     */
    public function scopeYear($query, $year)
    {
        return $query->where('tahun', $year);
    }

    /**
     * Get route key name
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
