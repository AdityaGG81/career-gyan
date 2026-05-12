@if ($paginator->hasPages())
    <nav class="career-pagination">
        <div class="pagination-wrapper">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="pagination-btn disabled" disabled>
                    <i class="fa-solid fa-chevron-left"></i>
                    Previous
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">
                    <i class="fa-solid fa-chevron-left"></i>
                    Previous
                </a>
            @endif

            {{-- Pagination Numbers --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="pagination-btn active" disabled>{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">
                    Next
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            @else
                <button class="pagination-btn disabled" disabled>
                    Next
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @endif
        </div>
    </nav>

    <style>
    /* ── Career Gyan Pagination Styles ── */
    .career-pagination {
        margin: 60px 0 40px;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        border: 2px solid #3b82f6;
        background: transparent;
        color: #3b82f6;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        font-family: 'Sora', sans-serif;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        min-width: 44px;
        justify-content: center;
    }

    .pagination-btn:hover:not(.disabled):not(.active) {
        background: #3b82f6;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .pagination-btn.active {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: #fff;
        border-color: #1d4ed8;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .pagination-btn.disabled {
        opacity: 0.4;
        cursor: not-allowed;
        border-color: #94a3b8;
        color: #94a3b8;
    }

    .pagination-btn.disabled:hover {
        transform: none;
        box-shadow: none;
    }

    .pagination-dots {
        display: flex;
        align-items: center;
        padding: 0 8px;
        color: #94a3b8;
        font-weight: 600;
        font-size: 16px;
    }

    /* Dark theme adjustments */
    body {
        /* Pagination will inherit from body background */
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .pagination-wrapper {
            gap: 6px;
        }
        
        .pagination-btn {
            padding: 8px 12px;
            font-size: 13px;
            min-width: 40px;
        }
        
        .pagination-btn i {
            font-size: 12px;
        }
    }

    /* Hide the default pagination info text */
    .pagination-info {
        display: none !important;
    }
    </style>
@endif
