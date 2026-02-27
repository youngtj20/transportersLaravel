@extends('website.layout')

@section('title', 'Gallery - Transporters for Tinubu 2027')
@section('description', 'View photos from our events, rallies, and community activities across Nigeria.')
@section('keywords', 'gallery, photos, events, tinubu, nigeria transportation')

@section('content')

@php
    /*
     * Group galleries by event_name.
     * We only need ONE cover image per event group for the initial page load.
     * The full image list is stored in JS but NOT rendered in the DOM
     * until the user clicks an event card.
     */
    $groupedByEvent = $eventGalleries->groupBy('event_name');
    $totalPhotos    = $eventGalleries->sum(fn($g) => count($g->formatted_images));

    /* Build a lean per-event summary for JS (cover + all image URLs) */
    $eventsData = [];
    foreach ($groupedByEvent as $evtName => $galleries) {
        $images    = [];
        $coverUrl  = '';
        $evtDate   = '';
        $evtDesc   = '';

        foreach ($galleries as $gallery) {
            $formatted = $gallery->formatted_images;
            if (empty($coverUrl) && !empty($formatted)) {
                $coverUrl = $formatted[0];
            }
            foreach ($formatted as $url) {
                $images[] = $url;
            }
            if (empty($evtDate) && $gallery->event_date) {
                $evtDate = $gallery->event_date->format('M d, Y');
            }
            if (empty($evtDesc) && $gallery->description) {
                $evtDesc = $gallery->description;
            }
        }

        if (empty($images)) continue;

        $eventsData[] = [
            'event_name'  => $evtName ?? 'Untitled Event',
            'cover'       => $coverUrl,
            'count'       => count($images),
            'date'        => $evtDate,
            'description' => $evtDesc,
            'images'      => $images,   // full list — only fetched when user opens the event
        ];
    }
@endphp

{{-- ══════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════ --}}
<div class="relative bg-gradient-to-br from-green-800 via-green-600 to-emerald-500 text-white overflow-hidden">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -right-20 w-80 h-80 bg-black/20 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <span class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white
                     text-sm font-semibold px-4 py-1.5 rounded-full mb-6">
            <i class="fas fa-camera-retro"></i> Event Photo Gallery
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight mb-5">
            Our Journey in Pictures
        </h1>
        <p class="text-lg md:text-xl text-green-100 max-w-2xl mx-auto mb-12">
            Every rally, meeting and community moment — captured across Nigeria
        </p>
        <div class="inline-flex flex-wrap justify-center gap-10">
            <div>
                <div class="text-4xl font-extrabold">{{ count($eventsData) }}</div>
                <div class="text-green-200 text-sm mt-1 font-medium">Events</div>
            </div>
            <div class="w-px bg-white/30 self-stretch"></div>
            <div>
                <div class="text-4xl font-extrabold">{{ $totalPhotos }}</div>
                <div class="text-green-200 text-sm mt-1 font-medium">Photos</div>
            </div>
            <div class="w-px bg-white/30 self-stretch"></div>
            <div>
                <div class="text-4xl font-extrabold">{{ $uniqueEvents->count() }}</div>
                <div class="text-green-200 text-sm mt-1 font-medium">Albums</div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     STICKY FILTER BAR
══════════════════════════════════════════════════════ --}}
<div class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 py-3 overflow-x-auto scrollbar-hide">
            <span class="flex-shrink-0 text-xs font-semibold text-gray-400 uppercase tracking-wide mr-1">Filter:</span>
            <a href="{{ route('gallery') }}"
               class="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium
                      transition-all duration-200 border
                      {{ !request()->has('event') || request()->event === 'all'
                         ? 'bg-green-600 text-white border-green-600 shadow-md'
                         : 'bg-white text-gray-600 border-gray-200 hover:border-green-400 hover:text-green-700' }}">
                <i class="fas fa-th text-xs"></i> All Events
            </a>
            @foreach($uniqueEvents as $evtName)
            <a href="{{ route('gallery', ['event' => $evtName]) }}"
               class="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium
                      transition-all duration-200 border
                      {{ request()->event === $evtName
                         ? 'bg-green-600 text-white border-green-600 shadow-md'
                         : 'bg-white text-gray-600 border-gray-200 hover:border-green-400 hover:text-green-700' }}">
                <i class="fas fa-calendar-alt text-xs"></i>
                <span>{{ Str::limit($evtName, 28) }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     EVENT ALBUM CARDS  — one card per event, cover image only
══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 min-h-[60vh] py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(empty($eventsData))
            <div class="text-center py-32">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-50 border border-green-100 mb-6">
                    <i class="fas fa-images text-4xl text-green-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-500 mb-2">No galleries yet</h3>
                <p class="text-gray-400">Event photos will appear here once they are published.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($eventsData as $i => $evt)
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300
                             cursor-pointer overflow-hidden border border-gray-100 hover:-translate-y-1"
                     onclick="openEventModal({{ $i }})">

                    {{-- Cover image — only ONE image loaded per card --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                        <img src="{{ $evt['cover'] }}"
                             alt="{{ $evt['event_name'] }}"
                             loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             onerror="this.src='{{ asset('images/hero-transport.jpg') }}'">

                        {{-- Dark gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        {{-- Photo count badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1.5 bg-black/60 backdrop-blur-sm
                                         text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                                <i class="fas fa-images text-[10px]"></i>
                                {{ $evt['count'] }} photo{{ $evt['count'] !== 1 ? 's' : '' }}
                            </span>
                        </div>

                        {{-- View icon on hover --}}
                        <div class="absolute inset-0 flex items-center justify-center
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white/90 rounded-full px-5 py-2.5 flex items-center gap-2
                                        shadow-xl text-gray-800 font-semibold text-sm">
                                <i class="fas fa-eye text-green-600"></i> View Photos
                            </div>
                        </div>
                    </div>

                    {{-- Card details --}}
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-base leading-snug mb-1 line-clamp-2">
                            {{ $evt['event_name'] }}
                        </h3>
                        @if($evt['date'])
                            <p class="text-xs text-gray-500 flex items-center gap-1.5 mb-2">
                                <i class="fas fa-calendar-alt text-green-500"></i>
                                {{ $evt['date'] }}
                            </p>
                        @endif
                        @if($evt['description'])
                            <p class="text-xs text-gray-400 line-clamp-2">{{ $evt['description'] }}</p>
                        @endif

                        {{-- Share buttons (compact, stops card click propagation) --}}
                        <div class="mt-3 pt-3 border-t border-gray-100" onclick="event.stopPropagation()">
                            <p class="text-xs text-gray-400 mb-1.5 font-medium">Share event</p>
                            <x-social-share
                                :url="route('gallery', ['event' => $evt['event_name']])"
                                :title="$evt['event_name']"
                                :description="$evt['description'] ?: 'Check out photos from this event!'"
                                type="gallery"
                                :compact="true" />
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     STATS BANNER
══════════════════════════════════════════════════════ --}}
<div class="bg-gradient-to-r from-green-700 to-emerald-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Our Impact in Pictures</h2>
            <p class="text-green-200">Thousands of moments captured across Nigeria</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                [count($eventsData) ?: '10+', 'Events Documented'],
                [$totalPhotos ?: '500+',       'Photos Taken'],
                ['36',                         'States Covered'],
                ['2027',                       'Campaign Year'],
            ] as $stat)
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center">
                <div class="text-4xl font-extrabold mb-1">{{ $stat[0] }}</div>
                <div class="text-green-200 text-sm font-medium">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     EVENT MODAL  — photos loaded ONLY when user opens it
══════════════════════════════════════════════════════ --}}
<div id="eventModal"
     style="display:none"
     class="fixed inset-0 z-[100] bg-black/95 flex flex-col">

    {{-- Header --}}
    <div class="flex-shrink-0 flex items-center justify-between px-5 py-4 bg-black/60 border-b border-white/10">
        <div>
            <h2 id="emTitle" class="text-white font-bold text-lg leading-tight"></h2>
            <p  id="emMeta"  class="text-white/50 text-sm mt-0.5"></p>
        </div>
        <button onclick="closeEventModal()"
                class="w-9 h-9 flex items-center justify-center text-white/70 hover:text-white
                       hover:bg-white/10 rounded-full transition-all ml-4 flex-shrink-0">
            <i class="fas fa-times"></i>
        </button>
    </div>

    {{-- Photo grid — dynamically filled, lazy loaded --}}
    <div class="flex-1 overflow-y-auto p-4">
        <div id="emGrid"
             class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     INDIVIDUAL LIGHTBOX
══════════════════════════════════════════════════════ --}}
<div id="lightboxModal"
     style="display:none"
     class="fixed inset-0 z-[200] bg-black/98 flex flex-col">

    {{-- Top bar --}}
    <div class="flex-shrink-0 flex items-center justify-between px-4 py-3 bg-black/40">
        <span id="lbCounter" class="text-white/60 text-sm font-mono"></span>
        <span id="lbEventTag" class="text-white text-sm font-semibold px-3 py-1 bg-green-700/80 rounded-full"></span>
        <button onclick="closeLightbox()"
                class="w-9 h-9 flex items-center justify-center text-white/70 hover:text-white hover:bg-white/10 rounded-full transition-all">
            <i class="fas fa-times"></i>
        </button>
    </div>

    {{-- Image area --}}
    <div class="flex-1 relative flex items-center justify-center overflow-hidden px-14 py-2">
        <button id="lbPrev" onclick="navigateLightbox(-1)"
                class="absolute left-2 z-10 w-12 h-12 flex items-center justify-center
                       text-white bg-white/10 hover:bg-white/25 rounded-full transition-all backdrop-blur-sm">
            <i class="fas fa-chevron-left text-lg"></i>
        </button>

        <div id="lbSpinner" class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-10 h-10 border-4 border-white/20 border-t-green-400 rounded-full animate-spin"></div>
        </div>

        <img id="lbImage" src="" alt=""
             class="max-h-full max-w-full object-contain rounded-xl shadow-2xl"
             style="opacity:0;transition:opacity .2s"
             onload="this.style.opacity=1;document.getElementById('lbSpinner').style.display='none'"
             onerror="this.style.opacity=.2;document.getElementById('lbSpinner').style.display='none'">

        <button id="lbNext" onclick="navigateLightbox(1)"
                class="absolute right-2 z-10 w-12 h-12 flex items-center justify-center
                       text-white bg-white/10 hover:bg-white/25 rounded-full transition-all backdrop-blur-sm">
            <i class="fas fa-chevron-right text-lg"></i>
        </button>
    </div>

    {{-- Bottom bar --}}
    <div class="flex-shrink-0 bg-black/40 px-4 py-3">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row sm:items-center gap-3">
            <div class="flex-1 min-w-0">
                <p id="lbTitle" class="text-white font-semibold text-sm truncate"></p>
                <p id="lbDate"  class="text-white/50 text-xs mt-0.5"></p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <button onclick="lbDownload()"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm transition-all">
                    <i class="fas fa-download"></i><span class="hidden sm:inline">Download</span>
                </button>
                <button onclick="lbShare()"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-lg text-sm font-semibold transition-all">
                    <i class="fas fa-share-alt"></i> Share
                </button>
            </div>
        </div>

        {{-- Thumbnail strip --}}
        <div id="lbThumbs" class="max-w-5xl mx-auto mt-3 flex gap-2 overflow-x-auto pb-1 scrollbar-hide"></div>
    </div>
</div>

{{-- ════════════════════════════════════════════
     JAVASCRIPT
     Images are NOT rendered in the DOM until
     the user opens an event — preventing 2000+
     requests on the initial page load.
════════════════════════════════════════════ --}}

@php
    /* Pass only the data structure — image URLs are in the array
       but NO <img> tags are created until an event is opened */
    $eventsJson = collect($eventsData);
@endphp

<script>
/* ── Event data from server ─────────────────────────────────────────── */
var EVENTS = @json($eventsJson);

/* ── State ──────────────────────────────────────────────────────────── */
var activeEventIdx = -1;   // which event is currently open in the modal
var lbImages       = [];   // flat list of images for the active lightbox session
var lbIndex        = 0;

/* ══════════════════════════════════════════
   EVENT MODAL  (album view)
══════════════════════════════════════════ */
function openEventModal(idx) {
    activeEventIdx = idx;
    var ev   = EVENTS[idx];
    var grid = document.getElementById('emGrid');

    /* Header */
    document.getElementById('emTitle').textContent = ev.event_name;
    document.getElementById('emMeta').textContent  =
        (ev.date ? ev.date + '  ·  ' : '') + ev.count + ' photos';

    /* Build photo tiles — lazy loading means images only download when visible */
    grid.innerHTML = '';
    ev.images.forEach(function(url, i) {
        var div = document.createElement('div');
        div.className = 'group relative aspect-square overflow-hidden rounded-xl cursor-pointer ' +
                        'shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 bg-gray-800';

        var img = document.createElement('img');
        img.src          = url;
        img.alt          = ev.event_name;
        img.loading      = 'lazy';              // ← browser only downloads when scrolled into view
        img.className    = 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110';
        img.onerror      = function() { this.closest('div').style.display = 'none'; };

        /* Overlay */
        var overlay = document.createElement('div');
        overlay.className = 'absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 ' +
                            'flex items-center justify-center';
        overlay.innerHTML = '<div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">' +
                            '<div class="bg-white/90 rounded-full w-10 h-10 flex items-center justify-center shadow-lg">' +
                            '<i class="fas fa-expand-alt text-gray-700"></i></div></div>';

        /* Photo number */
        var badge = document.createElement('div');
        badge.className = 'absolute top-2 right-2 bg-black/50 text-white text-xs font-mono ' +
                          'px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity';
        badge.textContent = (i + 1) + '/' + ev.images.length;

        div.appendChild(img);
        div.appendChild(overlay);
        div.appendChild(badge);

        /* Click → open individual lightbox */
        div.addEventListener('click', function() {
            openLightboxFromEvent(idx, i);
        });

        grid.appendChild(div);
    });

    document.getElementById('eventModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeEventModal() {
    document.getElementById('eventModal').style.display = 'none';
    if (document.getElementById('lightboxModal').style.display === 'none') {
        document.body.style.overflow = '';
    }
}

/* ══════════════════════════════════════════
   INDIVIDUAL LIGHTBOX
══════════════════════════════════════════ */
function openLightboxFromEvent(eventIdx, photoIdx) {
    var ev = EVENTS[eventIdx];
    lbImages = ev.images.map(function(url) {
        return { url: url, title: ev.event_name, date: ev.date };
    });
    lbIndex = photoIdx;

    /* Close event modal, open lightbox */
    document.getElementById('eventModal').style.display    = 'none';
    document.getElementById('lightboxModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';

    renderLightbox();
}

function closeLightbox() {
    document.getElementById('lightboxModal').style.display = 'none';
    /* Reopen event modal if one was active */
    if (activeEventIdx >= 0) {
        document.getElementById('eventModal').style.display = 'flex';
    } else {
        document.body.style.overflow = '';
    }
}

function navigateLightbox(dir) {
    lbIndex = (lbIndex + dir + lbImages.length) % lbImages.length;
    renderLightbox();
}

function renderLightbox() {
    var p   = lbImages[lbIndex];
    var img = document.getElementById('lbImage');

    img.style.opacity = '0';
    document.getElementById('lbSpinner').style.display = 'flex';

    img.src = p.url;
    img.alt = p.title;

    document.getElementById('lbCounter').textContent  = (lbIndex + 1) + ' / ' + lbImages.length;
    document.getElementById('lbEventTag').textContent = p.title;
    document.getElementById('lbTitle').textContent    = p.title;
    document.getElementById('lbDate').textContent     = p.date;

    var multi = lbImages.length > 1;
    document.getElementById('lbPrev').style.display = multi ? '' : 'none';
    document.getElementById('lbNext').style.display = multi ? '' : 'none';

    renderThumbs();
}

function renderThumbs() {
    var strip = document.getElementById('lbThumbs');
    strip.innerHTML = '';
    var half  = 5;
    var start = Math.max(0, lbIndex - half);
    var end   = Math.min(lbImages.length - 1, lbIndex + half);

    for (var i = start; i <= end; i++) {
        (function(idx) {
            var t = document.createElement('div');
            t.className = 'flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden cursor-pointer transition-all duration-200 ' +
                          (idx === lbIndex
                            ? 'ring-2 ring-green-400 ring-offset-2 ring-offset-black opacity-100'
                            : 'opacity-40 hover:opacity-75');
            t.innerHTML = '<img src="' + lbImages[idx].url + '" loading="lazy" ' +
                          'class="w-full h-full object-cover" onerror="this.parentElement.style.display=\'none\'">';
            t.addEventListener('click', function(e) { e.stopPropagation(); lbIndex = idx; renderLightbox(); });
            strip.appendChild(t);
        })(i);
    }
    setTimeout(function() {
        var active = strip.querySelector('.ring-2');
        if (active) active.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }, 60);
}

/* ── Download ────────────────────────────────────────────────────────── */
function lbDownload() {
    var p = lbImages[lbIndex];
    var a = document.createElement('a');
    a.href = p.url; a.download = (p.title || 'photo') + '-' + (lbIndex + 1) + '.jpg';
    a.target = '_blank';
    document.body.appendChild(a); a.click(); document.body.removeChild(a);
}

/* ── Share (self-contained, uses <a target="_blank"> — never blocked) ── */
function lbShare() {
    var p   = lbImages[lbIndex];
    var url = window.location.href;
    var eu  = encodeURIComponent(url);
    var et  = encodeURIComponent(p.title);

    /* Web Share API (mobile native) */
    if (navigator.share) {
        navigator.share({ title: p.title, url: url }).catch(function(){});
        return;
    }

    var platforms = [
        { label: 'Facebook',    icon: 'fab fa-facebook-f',  bg: '#1877F2', href: 'https://www.facebook.com/sharer/sharer.php?u=' + eu },
        { label: 'Twitter / X', icon: 'fab fa-twitter',     bg: '#000000', href: 'https://twitter.com/intent/tweet?url=' + eu + '&text=' + et },
        { label: 'WhatsApp',    icon: 'fab fa-whatsapp',    bg: '#25D366', href: 'https://api.whatsapp.com/send?text=' + et + '%20' + eu },
        { label: 'Telegram',    icon: 'fab fa-telegram',    bg: '#2AABEE', href: 'https://t.me/share/url?url=' + eu + '&text=' + et },
        { label: 'LinkedIn',    icon: 'fab fa-linkedin-in', bg: '#0A66C2', href: 'https://www.linkedin.com/sharing/share-offsite/?url=' + eu },
        { label: 'Email',       icon: 'fas fa-envelope',    bg: '#4B5563', href: 'mailto:?subject=' + et + '&body=' + et + '%20' + eu },
    ];

    var rows = platforms.map(function(pf) {
        return '<a href="' + pf.href + '" target="_blank" rel="noopener noreferrer" '
             + 'style="background:' + pf.bg + ';display:flex;align-items:center;gap:12px;'
             + 'padding:12px 16px;color:#fff;border-radius:12px;text-decoration:none;'
             + 'font-size:14px;font-weight:600;">'
             + '<i class="' + pf.icon + '" style="width:16px;text-align:center"></i>' + pf.label + '</a>';
    }).join('');

    var modal = document.createElement('div');
    modal.id = '__shareModal';
    modal.style.cssText = 'position:fixed;inset:0;z-index:300;background:rgba(0,0,0,.75);'
                        + 'display:flex;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(6px)';
    modal.innerHTML =
        '<div style="background:#fff;border-radius:20px;padding:24px;width:100%;max-width:340px;box-shadow:0 25px 60px rgba(0,0,0,.5)">'
      + '  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">'
      + '    <span style="font-size:17px;font-weight:700;color:#111">Share</span>'
      + '    <button onclick="document.getElementById(\'__shareModal\').remove()" '
      + '            style="width:32px;height:32px;border-radius:50%;background:#f3f4f6;border:none;'
      + '                   cursor:pointer;font-size:18px;color:#6b7280;display:flex;align-items:center;justify-content:center">'
      + '      &times;</button>'
      + '  </div>'
      + '  <div style="display:flex;flex-direction:column;gap:8px">' + rows + '</div>'
      + '  <button id="__copyBtn" data-url="' + url + '" '
      + '          onclick="lbCopyLink(this)" '
      + '          style="margin-top:12px;width:100%;padding:12px 16px;background:#f3f4f6;border:none;cursor:pointer;'
      + '                 border-radius:12px;font-size:14px;font-weight:600;color:#374151;display:flex;'
      + '                 align-items:center;justify-content:center;gap:8px">'
      + '    <i class="fas fa-link"></i> Copy Page Link'
      + '  </button>'
      + '</div>';

    document.body.appendChild(modal);
    modal.addEventListener('click', function(e) { if (e.target === modal) modal.remove(); });
}

function lbCopyLink(btn) {
    var url = btn.getAttribute('data-url');
    var done = function() {
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.style.cssText += 'background:#d1fae5;color:#065f46';
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-link"></i> Copy Page Link';
            btn.style.background = '#f3f4f6'; btn.style.color = '#374151';
        }, 2500);
    };
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(done).catch(done);
    } else {
        var ta = Object.assign(document.createElement('textarea'), { value: url });
        ta.style.cssText = 'position:fixed;top:-9999px;opacity:0';
        document.body.appendChild(ta); ta.select();
        try { document.execCommand('copy'); done(); } catch(e) {}
        document.body.removeChild(ta);
    }
}

/* ── Keyboard navigation ─────────────────────────────────────────────── */
document.addEventListener('keydown', function(e) {
    var lbOpen  = document.getElementById('lightboxModal').style.display !== 'none';
    var emOpen  = document.getElementById('eventModal').style.display    !== 'none';

    if (e.key === 'Escape') {
        if (lbOpen)  { closeLightbox();    return; }
        if (emOpen)  { closeEventModal();  return; }
    }
    if (lbOpen && e.key === 'ArrowLeft')  navigateLightbox(-1);
    if (lbOpen && e.key === 'ArrowRight') navigateLightbox(1);
});
</script>

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@endsection
