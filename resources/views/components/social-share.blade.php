@props(['url', 'title', 'description' => '', 'image' => null, 'type' => 'post', 'compact' => false])

@php
    $eu = urlencode($url);
    $et = urlencode($title);
    $ed = urlencode(Str::limit(strip_tags($description), 160));

    $platforms = [
        'facebook' => [
            'href'  => "https://www.facebook.com/sharer/sharer.php?u={$eu}",
            'bg'    => '#1877F2', 'hover' => '#166fe5',
            'icon'  => 'fab fa-facebook-f',
            'label' => 'Facebook',
        ],
        'twitter' => [
            'href'  => "https://twitter.com/intent/tweet?url={$eu}&text={$et}",
            'bg'    => '#000000', 'hover' => '#333333',
            'icon'  => 'fab fa-twitter',
            'label' => 'Twitter / X',
        ],
        'whatsapp' => [
            'href'  => "https://api.whatsapp.com/send?text={$et}%20{$eu}",
            'bg'    => '#25D366', 'hover' => '#1ebe5d',
            'icon'  => 'fab fa-whatsapp',
            'label' => 'WhatsApp',
        ],
        'telegram' => [
            'href'  => "https://t.me/share/url?url={$eu}&text={$et}",
            'bg'    => '#2AABEE', 'hover' => '#229ed9',
            'icon'  => 'fab fa-telegram',
            'label' => 'Telegram',
        ],
        'linkedin' => [
            'href'  => "https://www.linkedin.com/sharing/share-offsite/?url={$eu}",
            'bg'    => '#0A66C2', 'hover' => '#004182',
            'icon'  => 'fab fa-linkedin-in',
            'label' => 'LinkedIn',
        ],
        'email' => [
            'href'  => "mailto:?subject={$et}&body={$ed}%20{$eu}",
            'bg'    => '#4B5563', 'hover' => '#374151',
            'icon'  => 'fas fa-envelope',
            'label' => 'Email',
        ],
    ];
@endphp

@if($compact)
    {{-- ── Compact: icon-only (used in cards / lists) ── --}}
    <div class="flex items-center flex-wrap gap-1.5">
        @foreach($platforms as $key => $p)
            @if(in_array($key, ['facebook','twitter','whatsapp','telegram']))
            <a href="{{ $p['href'] }}"
               target="_blank" rel="noopener noreferrer"
               title="{{ $p['label'] }}"
               aria-label="Share on {{ $p['label'] }}"
               style="background:{{ $p['bg'] }}"
               onmouseover="this.style.background='{{ $p['hover'] }}'"
               onmouseout="this.style.background='{{ $p['bg'] }}'"
               class="w-8 h-8 flex items-center justify-center text-white rounded-lg transition-transform duration-150 hover:scale-110">
                <i class="{{ $p['icon'] }} text-xs"></i>
            </a>
            @endif
        @endforeach
        <button type="button"
                data-copy-url="{{ $url }}"
                title="Copy link" aria-label="Copy link"
                class="copy-link-btn w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-transform duration-150 hover:scale-110">
            <i class="fas fa-link text-xs"></i>
        </button>
    </div>

@else
    {{-- ── Full: buttons with text labels (used on single post / post detail page) ── --}}
    <div class="flex flex-wrap gap-2">
        @foreach($platforms as $key => $p)
        <a href="{{ $p['href'] }}"
           target="_blank" rel="noopener noreferrer"
           title="{{ $p['label'] }}"
           style="background:{{ $p['bg'] }}"
           onmouseover="this.style.background='{{ $p['hover'] }}'"
           onmouseout="this.style.background='{{ $p['bg'] }}'"
           class="inline-flex items-center gap-2 px-4 py-2 text-white rounded-lg text-sm font-medium transition-transform duration-150 hover:scale-105">
            <i class="{{ $p['icon'] }}"></i>
            <span>{{ $p['label'] }}</span>
        </a>
        @endforeach
        <button type="button"
                data-copy-url="{{ $url }}"
                class="copy-link-btn inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg text-sm font-medium transition-transform duration-150 hover:scale-105">
            <i class="fas fa-link"></i>
            <span>Copy Link</span>
        </button>
    </div>
@endif

@once
<script>
(function () {
    /* ── Clipboard copy ───────────────────────────────────── */
    function copyText(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text)
                .then(function () { toast('Link copied to clipboard!'); })
                .catch(function () { legacyCopy(text); });
        } else {
            legacyCopy(text);
        }
    }

    function legacyCopy(text) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0';
        document.body.appendChild(ta);
        ta.focus();
        ta.select();
        try { document.execCommand('copy'); toast('Link copied to clipboard!'); }
        catch (e) { window.prompt('Copy this link (Ctrl+C / Cmd+C):', text); }
        document.body.removeChild(ta);
    }

    /* ── Toast notification ───────────────────────────────── */
    function toast(msg) {
        // Remove existing toast
        var old = document.getElementById('__ss_toast');
        if (old) old.remove();

        var el = document.createElement('div');
        el.id = '__ss_toast';
        el.textContent = msg;
        el.style.cssText = [
            'position:fixed', 'bottom:24px', 'left:50%', 'transform:translateX(-50%)',
            'z-index:99999', 'background:#111827', 'color:#fff',
            'padding:10px 22px', 'border-radius:999px', 'font-size:14px',
            'font-weight:500', 'box-shadow:0 4px 20px rgba(0,0,0,.3)',
            'pointer-events:none', 'opacity:1', 'transition:opacity .4s'
        ].join(';');
        document.body.appendChild(el);
        setTimeout(function () {
            el.style.opacity = '0';
            setTimeout(function () { el.remove(); }, 400);
        }, 2500);
    }

    /* Expose for gallery page and any other pages that need it */
    window.SS = { copy: copyText, toast: toast };

    /* ── Delegated click for copy buttons ────────────────── */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.copy-link-btn[data-copy-url]');
        if (btn) {
            e.preventDefault();
            copyText(btn.getAttribute('data-copy-url'));
        }
    });
})();
</script>
@endonce
