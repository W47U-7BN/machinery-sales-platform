<div x-show="searchModal" x-cloak style="position:fixed;inset:0;z-index:1060;display:flex;align-items:flex-start;justify-content:center;padding-top:15vh;">
    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);" @click="searchModal = false"></div>
    <div style="position:relative;width:100%;max-width:560px;margin:0 16px;" x-show="searchModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
        <div style="background:var(--lp-white);border-radius:var(--lp-radius-2xl);box-shadow:var(--lp-shadow-2xl);overflow:hidden;">
            <div style="padding:16px 20px;border-bottom:1px solid var(--lp-gray-200);">
                <form action="{{ route('products.index') }}" method="GET" style="position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--lp-gray-400);"></i>
                    <input type="text" name="q" placeholder="Cari produk, kategori, atau brand..." class="lp-input" style="padding-left:44px;border:none;background:var(--lp-gray-50);" autofocus x-ref="searchInput">
                    <button type="submit" style="position:absolute;right:6px;top:50%;transform:translateY(-50%);padding:8px 20px;background:var(--lp-primary);color:white;font-size:14px;font-weight:600;border:none;border-radius:var(--lp-radius-md);cursor:pointer;">Cari</button>
                </form>
            </div>
            <div style="padding:16px 20px;max-height:320px;overflow-y:auto;">
                <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:var(--lp-gray-400);margin:0 0 12px;">Pencarian Populer</p>
                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                    <a href="{{ route('products.index') }}?q=excavator" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">Excavator</a>
                    <a href="{{ route('products.index') }}?q=bulldozer" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">Bulldozer</a>
                    <a href="{{ route('products.index') }}?q=crane" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">Crane</a>
                    <a href="{{ route('products.index') }}?q=generator" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">Generator</a>
                    <a href="{{ route('products.index') }}?q=traktor" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">Traktor</a>
                    <a href="{{ route('products.index') }}?q=cnc" style="padding:6px 16px;background:var(--lp-gray-100);color:var(--lp-gray-600);border-radius:var(--lp-radius-full);font-size:13px;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">CNC</a>
                </div>
            </div>
        </div>
    </div>
</div>
