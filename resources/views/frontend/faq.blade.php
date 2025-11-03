@extends('frontend.layouts.app')

@section('title', 'FAQ - Frequently Asked Questions')

@section('content')
<!-- Hero Section -->
<div class="faq-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-icon mb-3">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h1 class="hero-title mb-3">Frequently Asked Questions</h1>
                <p class="hero-subtitle">Temukan jawaban atas pertanyaan yang sering diajukan mengenai layanan LPPM LPKIA</p>
                <div class="hero-search mt-4">
                    <div class="search-box">
                        <input type="text" id="faqSearch" class="form-control form-control-lg" placeholder="Cari pertanyaan atau kata kunci...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- FAQ Categories -->
    <div class="faq-categories-section mb-5">
        <div class="text-center mb-4">
            <h2 class="section-title">Kategori FAQ</h2>
            <p class="section-subtitle">Pilih kategori sesuai dengan pertanyaan Anda</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @php
            $faqCategories = [
                [
                    'title' => 'UMUM',
                    'icon' => 'fas fa-info-circle',
                    'color' => '#007bff',
                    'description' => 'Informasi umum tentang LPPM',
                    'count' => 8
                ],
                [
                    'title' => 'PENGAJUAN INSENTIF',
                    'icon' => 'fas fa-money-bill-wave',
                    'color' => '#28a745',
                    'description' => 'Prosedur pengajuan insentif',
                    'count' => 12
                ],
                [
                    'title' => 'PERTEMUAN ILMIAH',
                    'icon' => 'fas fa-users',
                    'color' => '#ffc107',
                    'description' => 'Seminar dan konferensi',
                    'count' => 6
                ],
                [
                    'title' => 'PENELITIAN & PENGABDIAN',
                    'subtitle' => 'RISTEK',
                    'icon' => 'fas fa-microscope',
                    'color' => '#dc3545',
                    'description' => 'Panduan penelitian dan pengabdian',
                    'count' => 15
                ],
                [
                    'title' => 'HAK KEKAYAAN INTELEKTUAL',
                    'subtitle' => 'HKI',
                    'icon' => 'fas fa-copyright',
                    'color' => '#6f42c1',
                    'description' => 'Perlindungan kekayaan intelektual',
                    'count' => 10
                ],
                [
                    'title' => 'ITHENTICATE / TURNITIN',
                    'icon' => 'fas fa-search-plus',
                    'color' => '#fd7e14',
                    'description' => 'Layanan plagiarisme checker',
                    'count' => 7
                ],
                [
                    'title' => 'REPOSITORY & SINTA',
                    'icon' => 'fas fa-database',
                    'color' => '#20c997',
                    'description' => 'Repositori dan indexing',
                    'count' => 9
                ],
                [
                    'title' => 'LAIN-LAIN',
                    'icon' => 'fas fa-ellipsis-h',
                    'color' => '#6c757d',
                    'description' => 'Pertanyaan lainnya',
                    'count' => 5
                ]
            ];
            @endphp

            @foreach ($faqCategories as $index => $category)
            <div class="col">
                <div class="faq-category-card" data-category="{{ strtolower(str_replace(' ', '-', $category['title'])) }}">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="category-icon mb-3" style="color: {{ $category['color'] }}">
                                <i class="{{ $category['icon'] }}"></i>
                            </div>
                            <h5 class="card-title fw-bold text-uppercase mb-2">{{ $category['title'] }}</h5>
                            @if(isset($category['subtitle']))
                            <small class="text-muted d-block mb-2">{{ $category['subtitle'] }}</small>
                            @endif
                            <p class="card-text text-muted small mb-3">{{ $category['description'] }}</p>
                            <span class="badge rounded-pill" style="background-color: {{ $category['color'] }}">
                                {{ $category['count'] }} FAQ
                            </span>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center pb-3">
                            <a href="{{ route('frontend.faq.detail', strtolower(str_replace([' ', '&'], ['-', '-'], $category['title']))) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-right me-1"></i>Lihat FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Popular FAQs -->
    <div class="popular-faqs-section mb-5">
        <div class="text-center mb-4">
            <h2 class="section-title">FAQ Populer</h2>
            <p class="section-subtitle">Pertanyaan yang paling sering diajukan</p>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="popularFAQAccordion">
                    @php
                    $popularFAQs = [
                        [
                            'question' => 'Bagaimana cara mengajukan proposal penelitian?',
                            'answer' => 'Untuk mengajukan proposal penelitian, Anda perlu mengikuti langkah berikut: 1) Daftar akun di sistem LPPM, 2) Lengkapi profil peneliti, 3) Upload proposal sesuai template, 4) Tunggu proses review dari tim evaluator.'
                        ],
                        [
                            'question' => 'Kapan deadline pengajuan insentif publikasi?',
                            'answer' => 'Deadline pengajuan insentif publikasi biasanya dibuka 2 kali dalam setahun, yaitu periode Januari-Maret dan Juli-September. Silakan pantau pengumuman resmi di website atau email blast.'
                        ],
                        [
                            'question' => 'Bagaimana cara menggunakan layanan Turnitin?',
                            'answer' => 'Layanan Turnitin dapat diakses melalui akun institusi. Hubungi admin LPPM untuk mendapatkan akses. Pastikan dokumen dalam format yang didukung (.doc, .docx, .pdf) dan maksimal 40MB.'
                        ],
                        [
                            'question' => 'Apa saja syarat pengajuan HKI?',
                            'answer' => 'Syarat pengajuan HKI meliputi: 1) Karya harus original dan belum dipublikasikan, 2) Melengkapi formulir pengajuan, 3) Menyertakan dokumen pendukung, 4) Membayar biaya administrasi sesuai ketentuan.'
                        ],
                        [
                            'question' => 'Bagaimana status pengajuan saya?',
                            'answer' => 'Status pengajuan dapat dilihat melalui dashboard akun Anda di sistem LPPM. Anda juga akan mendapat notifikasi email setiap ada update status pengajuan.'
                        ]
                    ];
                    @endphp

                    @foreach($popularFAQs as $index => $faq)
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                <i class="fas fa-question-circle me-2 text-primary"></i>
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#popularFAQAccordion">
                            <div class="accordion-body">
                                <i class="fas fa-lightbulb me-2 text-warning"></i>
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <!-- <div class="contact-support-section">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body text-center text-white p-5">
                <div class="support-icon mb-3">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="fw-bold mb-3">Tidak Menemukan Jawaban?</h3>
                <p class="mb-4">Tim support kami siap membantu Anda menyelesaikan pertanyaan atau masalah</p>
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3">
                        <a href="mailto:lppm@lpkia.ac.id" class="btn btn-light btn-lg w-100">
                            <i class="fas fa-envelope me-2"></i>Email
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="https://wa.me/6281234567890" class="btn btn-success btn-lg w-100" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="tel:+6221234567890" class="btn btn-info btn-lg w-100">
                            <i class="fas fa-phone me-2"></i>Telepon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Share Section -->
    <!-- <div class="share-section mt-5 text-center">
        <h5 class="mb-3">Bagikan Halaman Ini</h5>
        <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
                <i class="fab fa-facebook-f me-1"></i> Facebook
            </a>
            <a class="btn btn-info text-white" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text=FAQ LPPM LPKIA" target="_blank">
                <i class="fab fa-twitter me-1"></i> Twitter
            </a>
            <a class="btn btn-success" href="https://wa.me/?text=FAQ LPPM LPKIA {{ urlencode(request()->fullUrl()) }}" target="_blank">
                <i class="fab fa-whatsapp me-1"></i> WhatsApp
            </a>
            <button class="btn btn-secondary" onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                <i class="fas fa-copy me-1"></i> Copy Link
            </button>
        </div>
    </div> -->
</div>

@push('styles')
<style>
/* Hero Section */
.faq-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.faq-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
    opacity: 0.3;
}

.hero-icon i {
    font-size: 4rem;
    opacity: 0.9;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.95;
    max-width: 600px;
    margin: 0 auto;
}

.search-box {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
}

.search-box .form-control {
    padding-right: 60px;
    border-radius: 50px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-box .btn {
    position: absolute;
    right: 5px;
    top: 5px;
    bottom: 5px;
    border-radius: 50px;
    width: 50px;
    border: none;
}

/* Section Titles */
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #718096;
    margin-bottom: 0;
}

/* FAQ Category Cards */
.faq-category-card .card {
    transition: all 0.3s ease;
    cursor: pointer;
    border-radius: 15px;
}

.faq-category-card .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.category-icon i {
    font-size: 3rem;
    margin-bottom: 15px;
}

.hover-card {
    transition: all 0.3s ease;
}

/* Accordion Styling */
.accordion-item {
    border-radius: 10px !important;
    overflow: hidden;
}

.accordion-button {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    padding: 20px;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.accordion-button:focus {
    box-shadow: none;
}

.accordion-body {
    padding: 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

/* Support Section */
.support-icon i {
    font-size: 4rem;
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .category-icon i {
        font-size: 2.5rem;
    }
    
    .faq-hero-section {
        padding: 50px 0 40px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.faq-category-card {
    animation: fadeInUp 0.6s ease-out;
}

.faq-category-card:nth-child(1) { animation-delay: 0.1s; }
.faq-category-card:nth-child(2) { animation-delay: 0.2s; }
.faq-category-card:nth-child(3) { animation-delay: 0.3s; }
.faq-category-card:nth-child(4) { animation-delay: 0.4s; }
.faq-category-card:nth-child(5) { animation-delay: 0.5s; }
.faq-category-card:nth-child(6) { animation-delay: 0.6s; }
.faq-category-card:nth-child(7) { animation-delay: 0.7s; }
.faq-category-card:nth-child(8) { animation-delay: 0.8s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('faqSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            // Implement search logic here
            console.log('Searching for:', searchTerm);
        });
    }
});

function showCategoryFAQ(category) {
    // Implement category filter logic
    console.log('Showing FAQ for category:', category);
    // You can implement AJAX call to load specific category FAQs
    alert('Menampilkan FAQ untuk kategori: ' + category.replace('-', ' ').toUpperCase());
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Success
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
        btn.classList.remove('btn-secondary');
        btn.classList.add('btn-success');
        
        setTimeout(function() {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-secondary');
        }, 2000);
    }, function(err) {
        console.error('Could not copy text: ', err);
        alert('Gagal menyalin link');
    });
}
</script>
@endpush
@endsection