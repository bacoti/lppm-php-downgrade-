@extends('frontend.layouts.app')

@section('title', 'FAQ Detail - ' . ucwords(str_replace('-', ' ', $category)))

@section('content')
<!-- Hero Section -->
<div class="faq-detail-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-10 mx-auto">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.faq') }}" class="text-white-50">FAQ</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ ucwords(str_replace('-', ' ', $category)) }}</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center">
                    <div class="hero-icon me-4">
                        <i class="{{ $categoryIcon }}"></i>
                    </div>
                    <div>
                        <h1 class="hero-title mb-2">FAQ {{ ucwords(str_replace('-', ' ', $category)) }}</h1>
                        <p class="hero-subtitle mb-0">{{ $categoryDescription }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Search & Filter -->
    <div class="search-filter-section mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="faqDetailSearch" class="form-label small text-muted">
                            <i class="fas fa-search me-1"></i>Cari dalam kategori ini
                        </label>
                        <input type="text" id="faqDetailSearch" class="form-control form-control-lg" 
                               placeholder="Cari pertanyaan atau kata kunci...">
                    </div>
                    <div class="col-md-2">
                        <select id="sortFAQ" class="form-select form-select-lg">
                            <option value="popular">Terpopuler</option>
                            <option value="latest">Terbaru</option>
                            <option value="alphabetical">A-Z</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('frontend.faq') }}" class="btn btn-outline-secondary btn-lg w-100">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Content -->
    <div class="faq-content-section">
        <div class="row">
            <div class="col-lg-8">
                <!-- FAQ List -->
                <div id="faqList">
                    @foreach($faqs as $index => $faq)
                    <div class="faq-item mb-4" data-tags="{{ implode(',', $faq['tags']) }}">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0 p-0">
                                <button class="btn btn-link text-decoration-none w-100 text-start p-4" 
                                        type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq{{ $index }}" 
                                        aria-expanded="false" aria-controls="faq{{ $index }}">
                                    <div class="d-flex align-items-start">
                                        <div class="faq-icon me-3">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-2 fw-bold text-dark">{{ $faq['question'] }}</h5>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary me-2">{{ $faq['popularity'] }} views</span>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ $faq['updated_at'] }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="toggle-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div id="faq{{ $index }}" class="collapse" data-bs-parent="#faqList">
                                <div class="card-body pt-0">
                                    <div class="answer-content">
                                        <div class="answer-text mb-4">
                                            {!! $faq['answer'] !!}
                                        </div>
                                        
                                        @if(isset($faq['attachments']) && count($faq['attachments']) > 0)
                                        <div class="attachments mb-4">
                                            <h6 class="fw-bold mb-3">
                                                <i class="fas fa-paperclip me-2"></i>Lampiran
                                            </h6>
                                            <div class="row g-2">
                                                @foreach($faq['attachments'] as $attachment)
                                                <div class="col-md-6">
                                                    <a href="{{ $attachment['url'] }}" class="btn btn-outline-primary btn-sm w-100" target="_blank">
                                                        <i class="fas fa-download me-2"></i>{{ $attachment['name'] }}
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($faq['related_links']) && count($faq['related_links']) > 0)
                                        <div class="related-links mb-4">
                                            <h6 class="fw-bold mb-3">
                                                <i class="fas fa-external-link-alt me-2"></i>Link Terkait
                                            </h6>
                                            <ul class="list-unstyled">
                                                @foreach($faq['related_links'] as $link)
                                                <li class="mb-2">
                                                    <a href="{{ $link['url'] }}" class="text-decoration-none" target="_blank">
                                                        <i class="fas fa-link me-2 text-primary"></i>{{ $link['title'] }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="faq-actions">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="rating">
                                                    <span class="me-2">Apakah jawaban ini membantu?</span>
                                                    <button class="btn btn-sm btn-outline-success me-1" onclick="rateFAQ({{ $index }}, 'helpful')">
                                                        <i class="fas fa-thumbs-up me-1"></i>Ya
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="rateFAQ({{ $index }}, 'not-helpful')">
                                                        <i class="fas fa-thumbs-down me-1"></i>Tidak
                                                    </button>
                                                </div>
                                                <div class="share">
                                                    <button class="btn btn-sm btn-outline-secondary" onclick="shareFAQ({{ $index }})">
                                                        <i class="fas fa-share me-1"></i>Bagikan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <nav aria-label="FAQ pagination" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Navigation -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Navigasi Cepat
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($quickNav as $nav)
                            <a href="#faq{{ $nav['index'] }}" class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ Str::limit($nav['question'], 40) }}</span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Other Categories -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-folder me-2"></i>Kategori Lainnya
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($otherCategories as $otherCategory)
                            <a href="{{ route('frontend.faq.detail', $otherCategory['slug']) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <i class="{{ $otherCategory['icon'] }} me-3 text-{{ $otherCategory['color'] }}"></i>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">{{ $otherCategory['name'] }}</div>
                                        <small class="text-muted">{{ $otherCategory['count'] }} FAQ</small>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <!-- <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <i class="fas fa-headset fa-3x mb-3 opacity-75"></i>
                        <h5 class="fw-bold mb-3">Butuh Bantuan Lebih Lanjut?</h5>
                        <p class="mb-4 opacity-90">Tim support kami siap membantu Anda</p>
                        <div class="d-grid gap-2">
                            <a href="mailto:lppm@lpkia.ac.id" class="btn btn-light">
                                <i class="fas fa-envelope me-2"></i>Email Support
                            </a>
                            <a href="https://wa.me/6281234567890" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Hero Section */
.faq-detail-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 40px;
    color: white;
    position: relative;
}

.hero-icon i {
    font-size: 4rem;
    opacity: 0.9;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.breadcrumb-item a {
    text-decoration: none;
}

/* FAQ Items */
.faq-item .card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.faq-item .card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.faq-icon i {
    font-size: 1.5rem;
    color: #667eea;
}

.toggle-icon {
    transition: transform 0.3s ease;
}

.btn[aria-expanded="true"] .toggle-icon {
    transform: rotate(180deg);
}

.answer-content {
    border-top: 2px solid #f8f9fa;
    padding-top: 20px;
}

.answer-text {
    line-height: 1.8;
    font-size: 1rem;
}

.answer-text p {
    margin-bottom: 1rem;
}

.answer-text ul, .answer-text ol {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.answer-text li {
    margin-bottom: 0.5rem;
}

/* Attachments and Links */
.attachments, .related-links {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

/* FAQ Actions */
.faq-actions {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.rating button {
    min-width: 80px;
}

/* Sidebar */
.list-group-item:hover {
    background-color: #f8f9fa;
}

/* Search & Filter */
.search-filter-section .card {
    border-radius: 12px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-icon i {
        font-size: 3rem;
    }
    
    .faq-detail-hero-section {
        padding: 40px 0 30px;
    }
    
    .d-flex.align-items-center {
        flex-direction: column;
        text-align: center;
    }
    
    .hero-icon {
        margin-bottom: 1rem !important;
        margin-right: 0 !important;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.faq-item {
    animation: fadeInUp 0.6s ease-out;
}

.faq-item:nth-child(1) { animation-delay: 0.1s; }
.faq-item:nth-child(2) { animation-delay: 0.2s; }
.faq-item:nth-child(3) { animation-delay: 0.3s; }
.faq-item:nth-child(4) { animation-delay: 0.4s; }
.faq-item:nth-child(5) { animation-delay: 0.5s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('faqDetailSearch');
    const sortSelect = document.getElementById('sortFAQ');
    const faqItems = document.querySelectorAll('.faq-item');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filterFAQs(searchTerm, sortSelect.value);
        });
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const searchTerm = searchInput.value.toLowerCase();
            filterFAQs(searchTerm, this.value);
        });
    }

    function filterFAQs(searchTerm, sortBy) {
        let visibleItems = [];
        
        faqItems.forEach(item => {
            const question = item.querySelector('h5').textContent.toLowerCase();
            const answer = item.querySelector('.answer-text').textContent.toLowerCase();
            const tags = item.dataset.tags.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm) || tags.includes(searchTerm)) {
                item.style.display = 'block';
                visibleItems.push(item);
            } else {
                item.style.display = 'none';
            }
        });

        // Sort visible items
        if (sortBy === 'alphabetical') {
            visibleItems.sort((a, b) => {
                const titleA = a.querySelector('h5').textContent;
                const titleB = b.querySelector('h5').textContent;
                return titleA.localeCompare(titleB);
            });
        } else if (sortBy === 'popular') {
            visibleItems.sort((a, b) => {
                const viewsA = parseInt(a.querySelector('.badge').textContent);
                const viewsB = parseInt(b.querySelector('.badge').textContent);
                return viewsB - viewsA;
            });
        }

        // Reorder DOM elements
        const container = document.getElementById('faqList');
        visibleItems.forEach(item => {
            container.appendChild(item);
        });
    }

    // Smooth scroll for quick navigation
    document.querySelectorAll('a[href^="#faq"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Open the collapse first
                const collapseElement = targetElement.querySelector('.collapse');
                if (collapseElement) {
                    const bsCollapse = new bootstrap.Collapse(collapseElement, {
                        show: true
                    });
                }
                
                // Scroll to element
                setTimeout(() => {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 300);
            }
        });
    });
});

function rateFAQ(index, rating) {
    // Implement rating functionality
    const button = event.target.closest('button');
    const allButtons = button.parentElement.querySelectorAll('button');
    
    // Reset all buttons
    allButtons.forEach(btn => {
        btn.classList.remove('btn-success', 'btn-danger');
        btn.classList.add(btn.textContent.includes('Ya') ? 'btn-outline-success' : 'btn-outline-danger');
    });
    
    // Highlight selected button
    if (rating === 'helpful') {
        button.classList.remove('btn-outline-success');
        button.classList.add('btn-success');
    } else {
        button.classList.remove('btn-outline-danger');
        button.classList.add('btn-danger');
    }
    
    // Show feedback
    const feedback = document.createElement('small');
    feedback.className = 'text-muted d-block mt-2';
    feedback.textContent = 'Terima kasih atas feedback Anda!';
    button.parentElement.appendChild(feedback);
    
    setTimeout(() => {
        feedback.remove();
    }, 3000);
    
    console.log(`FAQ ${index} rated as ${rating}`);
}

function shareFAQ(index) {
    const faqElement = document.querySelector(`#faq${index}`).closest('.faq-item');
    const question = faqElement.querySelector('h5').textContent;
    const url = window.location.href + `#faq${index}`;
    
    if (navigator.share) {
        navigator.share({
            title: question,
            text: 'FAQ: ' + question,
            url: url
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            const button = event.target.closest('button');
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check me-1"></i>Link Disalin!';
            button.classList.add('btn-success');
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-secondary');
            }, 2000);
        });
    }
}
</script>
@endpush
@endsection