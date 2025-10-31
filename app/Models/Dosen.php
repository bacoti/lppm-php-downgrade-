<?php

namespace App\Models;

use Database\Factories\DosenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    /** @use HasFactory<DosenFactory> */
    use HasFactory;

    protected $fillable = [
        'nidn_nip',
        'nama_lengkap',
        'photo',
        'gelar_akademik',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'role',
        'affiliation',
        'email',
        'scopus_id',
        'google_id',
        'wos_researcher_id',
        'garuda_id',
        'level_department',
        'department',
        'academic_grade',
        'country',
        'id_card',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }


    public function researches()
    {
        return $this->hasMany(Research::class);
    }

    // Helper methods untuk mendapatkan label
    public function getRoleLabel()
    {
        switch($this->role) {
            case 'lecturer':
                return 'Dosen';
            case 'researcher':
                return 'Peneliti';
            default:
                return 'Tidak Diketahui';
        }
    }

    public function getLevelDepartmentLabel()
    {
        switch($this->level_department) {
            case 'd1':
                return 'Diploma 1';
            case 'd2':
                return 'Diploma 2';
            case 'd3':
                return 'Diploma 3';
            case 'd4':
                return 'Diploma 4';
            case 's1':
                return 'Sarjana';
            case 's2':
                return 'Magister';
            case 's3':
                return 'Doktor';
            case 'profesi':
                return 'Profesi';
            case 'spesialis':
                return 'Spesialis';
            default:
                return 'Tidak Diketahui';
        }
    }

    public function getJenisKelaminLabel()
    {
        switch($this->jenis_kelamin) {
            case 'L':
                return 'Laki-laki';
            case 'P':
                return 'Perempuan';
            default:
                return 'Tidak Diketahui';
        }
    }
}
