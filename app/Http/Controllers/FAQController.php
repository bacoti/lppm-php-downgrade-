<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function detail($category)
    {
        // Define category data
        $categoryData = $this->getCategoryData($category);
        
        if (!$categoryData) {
            abort(404, 'Kategori FAQ tidak ditemukan');
        }

        // Get FAQs for this category
        $faqs = $this->getFAQsByCategory($category);
        
        // Get quick navigation items (first 5 FAQs)
        $quickNav = array_slice($faqs, 0, 5);
        $quickNav = array_map(function($faq, $index) {
            return [
                'question' => $faq['question'],
                'index' => $index
            ];
        }, $quickNav, array_keys($quickNav));

        // Get other categories
        $otherCategories = $this->getOtherCategories($category);

        return view('frontend.faq-detail', [
            'category' => $category,
            'categoryIcon' => $categoryData['icon'],
            'categoryDescription' => $categoryData['description'],
            'faqs' => $faqs,
            'quickNav' => $quickNav,
            'otherCategories' => $otherCategories
        ]);
    }

    private function getCategoryData($category)
    {
        $categories = [
            'umum' => [
                'icon' => 'fas fa-info-circle',
                'description' => 'Informasi umum tentang LPPM LPKIA'
            ],
            'pengajuan-insentif' => [
                'icon' => 'fas fa-money-bill-wave',
                'description' => 'Panduan pengajuan insentif dan bantuan dana'
            ],
            'pertemuan-ilmiah' => [
                'icon' => 'fas fa-users',
                'description' => 'Informasi seminar, konferensi, dan pertemuan ilmiah'
            ],
            'penelitian-dan-pengabdian' => [
                'icon' => 'fas fa-microscope',
                'description' => 'Panduan penelitian dan pengabdian masyarakat'
            ],
            'hak-kekayaan-intelektual' => [
                'icon' => 'fas fa-copyright',
                'description' => 'Panduan perlindungan kekayaan intelektual'
            ],
            'ithenticate-turnitin' => [
                'icon' => 'fas fa-search-plus',
                'description' => 'Layanan plagiarisme checker dan similarity check'
            ],
            'repository-sinta' => [
                'icon' => 'fas fa-database',
                'description' => 'Repositori institusi dan indexing SINTA'
            ],
            'lain-lain' => [
                'icon' => 'fas fa-ellipsis-h',
                'description' => 'Pertanyaan dan informasi lainnya'
            ]
        ];

        return $categories[$category] ?? null;
    }

    private function getFAQsByCategory($category)
    {
        // Sample FAQ data - In real application, this would come from database
        $allFAQs = [
            'umum' => [
                [
                    'question' => 'Apa itu LPPM LPKIA?',
                    'answer' => '<p>Lembaga Penelitian dan Pengabdian Masyarakat (LPPM) LPKIA adalah unit yang mengelola kegiatan penelitian dan pengabdian kepada masyarakat di Lembaga Pendidikan Komputer Indonesia Agung.</p><p>LPPM bertugas untuk:</p><ul><li>Mengoordinasikan kegiatan penelitian dosen dan mahasiswa</li><li>Mengelola program pengabdian kepada masyarakat</li><li>Memfasilitasi publikasi ilmiah</li><li>Mengelola kekayaan intelektual institusi</li></ul>',
                    'popularity' => 1250,
                    'updated_at' => '2 hari yang lalu',
                    'tags' => ['lppm', 'institusi', 'penelitian', 'pengabdian'],
                    'attachments' => [
                        ['name' => 'Profil LPPM LPKIA.pdf', 'url' => '/downloads/profil-lppm.pdf'],
                        ['name' => 'Struktur Organisasi.pdf', 'url' => '/downloads/struktur-organisasi.pdf']
                    ]
                ],
                [
                    'question' => 'Bagaimana cara menghubungi LPPM?',
                    'answer' => '<p>Anda dapat menghubungi LPPM LPKIA melalui beberapa cara:</p><p><strong>Alamat:</strong><br>Gedung LPKIA, Lantai 3<br>Jl. Diponegoro No. 123, Jakarta</p><p><strong>Kontak:</strong></p><ul><li>Email: lppm@lpkia.ac.id</li><li>Telepon: (021) 123-4567</li><li>WhatsApp: +62 812-3456-7890</li><li>Website: https://lppm.lpkia.ac.id</li></ul><p><strong>Jam Operasional:</strong><br>Senin - Jumat: 08:00 - 16:00 WIB<br>Sabtu: 08:00 - 12:00 WIB</p>',
                    'popularity' => 980,
                    'updated_at' => '1 minggu yang lalu',
                    'tags' => ['kontak', 'alamat', 'jam kerja'],
                    'related_links' => [
                        ['title' => 'Peta Lokasi LPPM', 'url' => 'https://maps.google.com/'],
                        ['title' => 'Email LPPM', 'url' => 'mailto:lppm@lpkia.ac.id']
                    ]
                ],
                [
                    'question' => 'Apa saja layanan yang disediakan LPPM?',
                    'answer' => '<p>LPPM LPKIA menyediakan berbagai layanan untuk mendukung kegiatan akademik:</p><p><strong>Layanan Penelitian:</strong></p><ul><li>Konsultasi proposal penelitian</li><li>Bantuan pendanaan penelitian</li><li>Pendampingan publikasi ilmiah</li><li>Workshop metodologi penelitian</li></ul><p><strong>Layanan Pengabdian Masyarakat:</strong></p><ul><li>Program KKN tematik</li><li>Pelatihan untuk masyarakat</li><li>Konsultasi teknologi</li><li>Program pemberdayaan komunitas</li></ul><p><strong>Layanan Penunjang:</strong></p><ul><li>Akses Turnitin/iThenticate</li><li>Pendaftaran HKI</li><li>Repository institusi</li><li>Sertifikasi kompetensi</li></ul>',
                    'popularity' => 1150,
                    'updated_at' => '3 hari yang lalu',
                    'tags' => ['layanan', 'penelitian', 'pengabdian', 'fasilitas']
                ]
            ],
            'pengajuan-insentif' => [
                [
                    'question' => 'Bagaimana cara mengajukan insentif publikasi?',
                    'answer' => '<p>Untuk mengajukan insentif publikasi, ikuti langkah-langkah berikut:</p><p><strong>Langkah 1: Persiapan Dokumen</strong></p><ul><li>Artikel yang telah dipublikasi</li><li>Bukti publikasi (certificate/letter of acceptance)</li><li>Surat pernyataan keaslian karya</li><li>Rekening bank aktif</li></ul><p><strong>Langkah 2: Pengajuan Online</strong></p><ol><li>Login ke sistem LPPM</li><li>Pilih menu "Insentif Publikasi"</li><li>Isi formulir pengajuan</li><li>Upload dokumen pendukung</li><li>Submit pengajuan</li></ol><p><strong>Langkah 3: Verifikasi</strong></p><p>Tim LPPM akan melakukan verifikasi dalam 5-7 hari kerja. Status dapat dipantau melalui dashboard.</p>',
                    'popularity' => 2100,
                    'updated_at' => '1 hari yang lalu',
                    'tags' => ['insentif', 'publikasi', 'pengajuan', 'prosedur'],
                    'attachments' => [
                        ['name' => 'Form Pengajuan Insentif.docx', 'url' => '/downloads/form-insentif.docx'],
                        ['name' => 'Panduan Lengkap Insentif.pdf', 'url' => '/downloads/panduan-insentif.pdf']
                    ]
                ],
                [
                    'question' => 'Berapa besar insentif yang diberikan?',
                    'answer' => '<p>Besaran insentif publikasi berdasarkan jenis dan tingkat publikasi:</p><p><strong>Jurnal Internasional:</strong></p><ul><li>Q1 (Quartile 1): Rp 15.000.000</li><li>Q2 (Quartile 2): Rp 12.000.000</li><li>Q3 (Quartile 3): Rp 10.000.000</li><li>Q4 (Quartile 4): Rp 8.000.000</li></ul><p><strong>Jurnal Nasional:</strong></p><ul><li>Sinta 1: Rp 7.000.000</li><li>Sinta 2: Rp 6.000.000</li><li>Sinta 3: Rp 5.000.000</li><li>Sinta 4-6: Rp 3.000.000</li></ul><p><strong>Prosiding Konferensi:</strong></p><ul><li>Internasional terindeks: Rp 4.000.000</li><li>Nasional terakreditasi: Rp 2.000.000</li></ul><p><em>*Besaran dapat berubah sesuai kebijakan institusi</em></p>',
                    'popularity' => 1890,
                    'updated_at' => '2 hari yang lalu',
                    'tags' => ['insentif', 'besaran', 'jurnal', 'publikasi']
                ]
            ]
            // Add more categories as needed...
        ];

        return $allFAQs[$category] ?? [];
    }

    private function getOtherCategories($currentCategory)
    {
        $categories = [
            [
                'name' => 'Umum',
                'slug' => 'umum',
                'icon' => 'fas fa-info-circle',
                'color' => 'primary',
                'count' => 8
            ],
            [
                'name' => 'Pengajuan Insentif',
                'slug' => 'pengajuan-insentif',
                'icon' => 'fas fa-money-bill-wave',
                'color' => 'success',
                'count' => 12
            ],
            [
                'name' => 'Pertemuan Ilmiah',
                'slug' => 'pertemuan-ilmiah',
                'icon' => 'fas fa-users',
                'color' => 'warning',
                'count' => 6
            ],
            [
                'name' => 'Penelitian & Pengabdian',
                'slug' => 'penelitian-dan-pengabdian',
                'icon' => 'fas fa-microscope',
                'color' => 'danger',
                'count' => 15
            ],
            [
                'name' => 'HKI',
                'slug' => 'hak-kekayaan-intelektual',
                'icon' => 'fas fa-copyright',
                'color' => 'purple',
                'count' => 10
            ],
            [
                'name' => 'Turnitin',
                'slug' => 'ithenticate-turnitin',
                'icon' => 'fas fa-search-plus',
                'color' => 'warning',
                'count' => 7
            ],
            [
                'name' => 'Repository & SINTA',
                'slug' => 'repository-sinta',
                'icon' => 'fas fa-database',
                'color' => 'info',
                'count' => 9
            ],
            [
                'name' => 'Lain-lain',
                'slug' => 'lain-lain',
                'icon' => 'fas fa-ellipsis-h',
                'color' => 'secondary',
                'count' => 5
            ]
        ];

        // Remove current category from the list
        return array_filter($categories, function($cat) use ($currentCategory) {
            return $cat['slug'] !== $currentCategory;
        });
    }
}