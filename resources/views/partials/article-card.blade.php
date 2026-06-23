@props(['article' => null])
<article {{ $attributes->merge(['class' => 'lp-article-card']) }}>
    <div class="lp-article-image">
        <img src="{{ $article['image'] ?? asset('images/placeholder.jpg') }}" alt="{{ $article['title'] ?? 'Artikel' }}" loading="lazy">
        @if(isset($article['category']))
            <span class="lp-article-category">{{ $article['category'] }}</span>
        @endif
    </div>
    <div class="lp-article-body">
        <div class="lp-article-meta">
            <span><i class="far fa-calendar"></i> {{ $article['date'] ?? date('d M Y') }}</span>
            @if(isset($article['author']))
                <span><i class="far fa-user"></i> {{ $article['author'] }}</span>
            @endif
        </div>
        <h3 class="lp-article-title">{{ $article['title'] ?? 'Judul Artikel' }}</h3>
        <p class="lp-article-excerpt">{{ $article['excerpt'] ?? '' }}</p>
        <a href="{{ route('articles.show', $article['slug'] ?? '#') }}" class="lp-card-link">
            <span>Baca Selengkapnya</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</article>
