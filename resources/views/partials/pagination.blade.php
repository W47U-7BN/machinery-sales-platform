@props(['paginator' => null])
@if($paginator && $paginator->hasPages())
    <nav class="flex items-center justify-center space-x-2 mt-8" aria-label="Pagination">
        @if($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed"><i class="fas fa-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if($page == $paginator->currentPage())
                <span class="px-4 py-2 text-sm font-semibold text-white bg-primary border border-primary rounded-lg">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-4 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all">{{ $page }}</a>
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-all"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed"><i class="fas fa-chevron-right"></i></span>
        @endif
    </nav>
@endif
