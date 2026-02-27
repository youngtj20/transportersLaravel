@extends('website.layout')

@section('title', 'Events - Transporters for Tinubu 2027')
@section('description', 'Stay updated with our upcoming events, rallies, and community gatherings supporting the Transporters for Tinubu 2027 movement.')
@section('keywords', 'events, rallies, community gatherings, tinubu events, nigeria politics')

@php
    $eventsJson = $upcomingEvents->map(fn($e) => [
        'id'          => $e->id,
        'title'       => $e->title,
        'slug'        => $e->slug,
        'description' => $e->description,
        'event_date'  => $e->event_date?->toISOString(),
        'date_label'  => $e->event_date?->format('M d, Y'),
        'day'         => $e->event_date?->format('d'),
        'month'       => $e->event_date?->format('M'),
        'year'        => $e->event_date?->format('Y'),
        'time'        => $e->event_date?->format('g:i A'),
        'location'    => $e->location,
        'speakers'    => $e->speakers ?? [],
        'agenda'      => $e->agenda ?? [],
        'featured_image' => $e->featured_image ? asset($e->featured_image) : null,
    ])->values();

    $pastJson = $pastEvents->map(fn($e) => [
        'id'          => $e->id,
        'title'       => $e->title,
        'description' => $e->description,
        'event_date'  => $e->event_date?->toISOString(),
        'date_label'  => $e->event_date?->format('M d, Y'),
        'day'         => $e->event_date?->format('d'),
        'month'       => $e->event_date?->format('M'),
        'year'        => $e->event_date?->format('Y'),
        'location'    => $e->location,
        'featured_image' => $e->featured_image ? asset($e->featured_image) : null,
    ])->values();
@endphp

@section('content')
<div class="pt-16">

{{-- ═══════════════════════════ HERO ═══════════════════════════ --}}
<div class="relative bg-gradient-to-br from-green-700 via-green-600 to-green-500 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 rounded-full bg-white blur-3xl"></div>
        <div class="absolute bottom-0 right-20 w-80 h-80 rounded-full bg-white blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold px-4 py-2 rounded-full mb-6">
            <i class="fas fa-calendar-alt"></i>
            <span>Events & Gatherings</span>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Our Events</h1>
        <p class="text-xl text-green-100 max-w-3xl mx-auto mb-10">
            Join us at rallies, forums, and community gatherings as we build momentum for progressive leadership across Nigeria.
        </p>
        {{-- Stats bar --}}
        <div class="flex flex-wrap justify-center gap-8">
            <div class="text-center">
                <div class="text-3xl font-bold">{{ $upcomingEvents->count() }}</div>
                <div class="text-green-200 text-sm">Upcoming Events</div>
            </div>
            <div class="w-px bg-white/30 hidden sm:block"></div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ $upcomingEvents->pluck('location')->filter()->unique()->count() }}</div>
                <div class="text-green-200 text-sm">Locations</div>
            </div>
            <div class="w-px bg-white/30 hidden sm:block"></div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ $pastEvents->count() }}</div>
                <div class="text-green-200 text-sm">Past Events</div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════ FILTER TABS ═══════════════════════════ --}}
<div class="sticky top-16 z-30 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-none">
            <button onclick="filterEvents('all')" id="tab-all"
                class="filter-tab active-tab flex-shrink-0 flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                <i class="fas fa-th-list"></i>
                All Events
                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">
                    {{ $upcomingEvents->count() + $pastEvents->count() }}
                </span>
            </button>
            <button onclick="filterEvents('upcoming')" id="tab-upcoming"
                class="filter-tab flex-shrink-0 flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                <i class="fas fa-calendar-check"></i>
                Upcoming
                <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full" id="badge-upcoming">
                    {{ $upcomingEvents->count() }}
                </span>
            </button>
            <button onclick="filterEvents('past')" id="tab-past"
                class="filter-tab flex-shrink-0 flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                <i class="fas fa-history"></i>
                Past Events
                <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full" id="badge-past">
                    {{ $pastEvents->count() }}
                </span>
            </button>
        </div>
    </div>
</div>

<style>
.filter-tab { color: #6b7280; background: transparent; }
.filter-tab:hover { background: #f0fdf4; color: #16a34a; }
.active-tab { background: #16a34a !important; color: #ffffff !important; }
.active-tab span { background: rgba(255,255,255,0.25) !important; color: #fff !important; }
.scrollbar-none::-webkit-scrollbar { display: none; }
</style>

{{-- ═══════════════════════════ MAIN CONTENT ═══════════════════════════ --}}
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ─── EVENTS COLUMN ─── --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Upcoming Events Section --}}
                <div id="section-upcoming">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-8 bg-green-600 rounded-full"></div>
                        <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
                        <span class="bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $upcomingEvents->count() }}
                        </span>
                    </div>

                    @forelse($upcomingEvents as $event)
                    <div class="event-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 mb-5">
                        <div class="flex flex-col sm:flex-row">
                            {{-- Date Badge --}}
                            <div class="sm:w-32 flex-shrink-0 bg-gradient-to-br from-green-600 to-green-700 flex flex-row sm:flex-col items-center justify-center gap-3 sm:gap-0 p-4 sm:p-6 text-white">
                                <div class="text-center">
                                    <div class="text-4xl font-black leading-none">{{ $event->event_date?->format('d') }}</div>
                                    <div class="text-sm font-bold uppercase tracking-widest opacity-90 mt-1">{{ $event->event_date?->format('M') }}</div>
                                    <div class="text-xs opacity-75 mt-0.5">{{ $event->event_date?->format('Y') }}</div>
                                </div>
                                @if($event->featured_image)
                                <div class="sm:hidden w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ asset($event->featured_image) }}" class="w-full h-full object-cover" alt="">
                                </div>
                                @endif
                            </div>
                            {{-- Content --}}
                            <div class="flex-1 p-5 sm:p-6">
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 text-xs font-semibold px-3 py-1 rounded-full border border-green-100">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                        Upcoming
                                    </span>
                                    @if($event->location)
                                    <span class="inline-flex items-center gap-1.5 text-gray-500 text-xs">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        {{ $event->location }}
                                    </span>
                                    @endif
                                    <span class="inline-flex items-center gap-1.5 text-gray-500 text-xs">
                                        <i class="fas fa-clock text-gray-400"></i>
                                        {{ $event->event_date?->format('g:i A') }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 leading-snug">{{ $event->title }}</h3>
                                @if($event->description)
                                <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($event->description), 180) }}
                                </p>
                                @endif
                                {{-- Speakers preview --}}
                                @if(!empty($event->speakers) && count($event->speakers) > 0)
                                <div class="flex items-center gap-2 mb-4">
                                    <i class="fas fa-microphone text-green-600 text-xs"></i>
                                    <span class="text-xs text-gray-500">
                                        {{ implode(', ', array_slice(array_column($event->speakers, 'name') ?: $event->speakers, 0, 3)) }}
                                        @if(count($event->speakers) > 3) <span class="text-green-600">+{{ count($event->speakers) - 3 }} more</span> @endif
                                    </span>
                                </div>
                                @endif
                                {{-- Actions --}}
                                <div class="flex flex-wrap items-center gap-3 pt-3 border-t border-gray-100">
                                    <button
                                        onclick="openEventModal({{ $loop->index }})"
                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-info-circle"></i>
                                        View Details
                                    </button>
                                    <a href="{{ 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' . urlencode($event->title) . '&dates=' . $event->event_date?->format('Ymd\THis') . '/' . $event->event_date?->copy()->addHours(3)->format('Ymd\THis') . '&details=' . urlencode(Str::limit(strip_tags($event->description ?? ''), 300)) . '&location=' . urlencode($event->location ?? '') }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-green-300 hover:bg-green-50 text-gray-700 hover:text-green-700 text-sm font-medium px-4 py-2 rounded-lg transition-all duration-200">
                                        <i class="fas fa-calendar-plus text-green-600"></i>
                                        Add to Calendar
                                    </a>
                                    <button
                                        onclick="shareEvent('{{ $event->title }}', '{{ url('/events') }}')"
                                        class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-green-300 hover:bg-green-50 text-gray-700 hover:text-green-700 text-sm font-medium px-3 py-2 rounded-lg transition-all duration-200">
                                        <i class="fas fa-share-alt text-green-600"></i>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">No Upcoming Events</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">
                            Check back soon — new events are being planned. Follow us on social media for the latest updates.
                        </p>
                    </div>
                    @endforelse
                </div>

                {{-- Past Events Section --}}
                <div id="section-past">
                    <div class="flex items-center gap-3 mb-6 mt-4">
                        <div class="w-1 h-8 bg-gray-400 rounded-full"></div>
                        <h2 class="text-2xl font-bold text-gray-900">Past Events</h2>
                        <span class="bg-gray-100 text-gray-600 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $pastEvents->count() }}
                        </span>
                    </div>

                    @forelse($pastEvents as $event)
                    <div class="past-event-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-4">
                        <div class="flex gap-4 p-5">
                            {{-- Date square --}}
                            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-xl flex flex-col items-center justify-center text-center">
                                <div class="text-xl font-black text-gray-700 leading-none">{{ $event->event_date?->format('d') }}</div>
                                <div class="text-xs font-bold text-gray-500 uppercase mt-0.5">{{ $event->event_date?->format('M Y') }}</div>
                            </div>
                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3 mb-1">
                                    <h3 class="text-base font-bold text-gray-800 leading-snug">{{ $event->title }}</h3>
                                    <span class="flex-shrink-0 bg-gray-100 text-gray-500 text-xs font-semibold px-2 py-1 rounded-full">Completed</span>
                                </div>
                                @if($event->location)
                                <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $event->location }}
                                </div>
                                @endif
                                @if($event->description)
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                                    {{ Str::limit(strip_tags($event->description), 140) }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                        <p class="text-gray-400">No past events recorded yet.</p>
                    </div>
                    @endforelse
                </div>

            </div>

            {{-- ─── SIDEBAR ─── --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Dynamic Calendar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-gray-900">Event Calendar</h3>
                        <div class="flex items-center gap-1">
                            <button onclick="calPrev()" class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-500 transition-colors">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </button>
                            <button onclick="calNext()" class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-500 transition-colors">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <div id="cal-month" class="text-sm font-semibold text-gray-600 mb-3 text-center"></div>
                    <div class="grid grid-cols-7 gap-0.5 text-center mb-2">
                        @foreach(['S','M','T','W','T','F','S'] as $d)
                        <div class="text-xs font-bold text-gray-400 py-1">{{ $d }}</div>
                        @endforeach
                    </div>
                    <div id="cal-grid" class="grid grid-cols-7 gap-0.5 text-center"></div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-3 h-3 rounded-full bg-green-600 inline-block"></span> Has event
                        <span class="w-3 h-3 rounded-full bg-blue-500 inline-block ml-2"></span> Today
                    </div>
                </div>

                {{-- Upcoming quick list --}}
                @if($upcomingEvents->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Next Up</h3>
                    <div class="space-y-3">
                        @foreach($upcomingEvents->take(4) as $ev)
                        <div class="flex items-start gap-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition-colors"
                             onclick="openEventModal({{ $loop->index }})">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-600 rounded-lg flex flex-col items-center justify-center text-white text-center leading-tight">
                                <span class="text-sm font-black">{{ $ev->event_date?->format('d') }}</span>
                                <span class="text-xs uppercase">{{ $ev->event_date?->format('M') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 leading-tight line-clamp-2">{{ $ev->title }}</p>
                                @if($ev->location)
                                <p class="text-xs text-gray-400 mt-0.5">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $ev->location }}
                                </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Stay Updated CTA --}}
                <div class="bg-gradient-to-br from-green-700 to-green-600 rounded-2xl p-6 text-white">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-bell text-xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Never Miss an Event</h3>
                    <p class="text-green-100 text-sm mb-5 leading-relaxed">
                        Stay informed about upcoming rallies, meetings, and community activities near you.
                    </p>
                    <a href="{{ url('/contact') }}"
                        class="block text-center bg-white text-green-700 hover:bg-green-50 font-bold py-3 px-4 rounded-xl transition-colors duration-200">
                        <i class="fas fa-envelope mr-2"></i>Get Notified
                    </a>
                </div>

                {{-- Share page --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Share This Page</h3>
                    <x-social-share
                        :url="url('/events')"
                        title="Transporters for Tinubu 2027 Events"
                        description="Check out upcoming events and rallies supporting Transporters for Tinubu 2027"
                        :compact="true"
                    />
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ EVENT DETAIL MODAL ═══════════════ --}}
<div id="eventModal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeEventModal()"></div>
    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            {{-- Modal header --}}
            <div id="modal-header" class="relative bg-gradient-to-br from-green-700 to-green-600 text-white p-8 rounded-t-2xl">
                <button onclick="closeEventModal()"
                    class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center bg-white/20 hover:bg-white/30 rounded-lg transition-colors">
                    <i class="fas fa-times text-white text-sm"></i>
                </button>
                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0 text-center bg-white/20 rounded-xl p-3 min-w-[64px]">
                        <div id="modal-day" class="text-4xl font-black leading-none"></div>
                        <div id="modal-month" class="text-sm font-bold uppercase tracking-wider mt-1"></div>
                        <div id="modal-year" class="text-xs opacity-75 mt-0.5"></div>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center gap-1.5 bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-300 rounded-full animate-pulse"></span>
                                <span id="modal-status"></span>
                            </span>
                        </div>
                        <h2 id="modal-title" class="text-2xl font-black leading-tight mb-2"></h2>
                        <div class="flex flex-wrap gap-3 text-sm text-green-100">
                            <span id="modal-location-wrap" class="hidden">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span id="modal-location"></span>
                            </span>
                            <span id="modal-time-wrap">
                                <i class="fas fa-clock mr-1"></i>
                                <span id="modal-time"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal body --}}
            <div class="p-6 space-y-6">
                {{-- Description --}}
                <div id="modal-desc-wrap">
                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">About This Event</h4>
                    <div id="modal-description" class="text-gray-700 leading-relaxed prose prose-sm max-w-none"></div>
                </div>

                {{-- Speakers --}}
                <div id="modal-speakers-wrap" class="hidden">
                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Speakers</h4>
                    <div id="modal-speakers" class="flex flex-wrap gap-3"></div>
                </div>

                {{-- Agenda --}}
                <div id="modal-agenda-wrap" class="hidden">
                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Agenda</h4>
                    <div id="modal-agenda" class="space-y-2"></div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                    <a id="modal-gcal-link" href="#" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors duration-200">
                        <i class="fas fa-calendar-plus"></i>
                        Add to Google Calendar
                    </a>
                    <a id="modal-ical-link" href="#" download
                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-5 py-2.5 rounded-xl transition-colors duration-200">
                        <i class="fas fa-download"></i>
                        Download .ics
                    </a>
                </div>

                {{-- Share --}}
                <div class="pt-2">
                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Share This Event</h4>
                    <div id="modal-share-area"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ SHARE POPOVER ═══════════════ --}}
<div id="sharePopover" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0" onclick="closeSharePopover()"></div>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-white rounded-2xl shadow-2xl border border-gray-100 p-5 w-80">
        <div class="flex items-center justify-between mb-4">
            <h4 class="font-bold text-gray-900">Share Event</h4>
            <button onclick="closeSharePopover()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="sharePopoverContent"></div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
    /* ── Data ─────────────────────────────────────────────────── */
    const upcoming = @json($eventsJson);
    const past     = @json($pastJson);
    const allEventDates = upcoming.map(e => e.event_date ? new Date(e.event_date) : null).filter(Boolean);

    /* ── Filter tabs ─────────────────────────────────────────── */
    function filterEvents(tab) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active-tab'));
        document.getElementById('tab-' + tab).classList.add('active-tab');

        const su = document.getElementById('section-upcoming');
        const sp = document.getElementById('section-past');

        if (tab === 'all') {
            su.style.display = '';
            sp.style.display = '';
        } else if (tab === 'upcoming') {
            su.style.display = '';
            sp.style.display = 'none';
        } else {
            su.style.display = 'none';
            sp.style.display = '';
        }
    }
    window.filterEvents = filterEvents;

    /* ── Calendar widget ─────────────────────────────────────── */
    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    let calYear, calMonth;
    const now = new Date();
    calYear  = now.getFullYear();
    calMonth = now.getMonth();

    function renderCal() {
        document.getElementById('cal-month').textContent = months[calMonth] + ' ' + calYear;
        const grid = document.getElementById('cal-grid');
        grid.innerHTML = '';

        const firstDay = new Date(calYear, calMonth, 1).getDay();
        const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();

        // Blanks
        for (let i = 0; i < firstDay; i++) {
            const el = document.createElement('div');
            el.className = 'h-8';
            grid.appendChild(el);
        }

        const todayStr = now.toDateString();
        const eventDaySet = new Set(
            allEventDates
                .filter(d => d.getFullYear() === calYear && d.getMonth() === calMonth)
                .map(d => d.getDate())
        );

        for (let d = 1; d <= daysInMonth; d++) {
            const el = document.createElement('div');
            el.textContent = d;
            const thisDate = new Date(calYear, calMonth, d);
            const isToday = thisDate.toDateString() === todayStr;
            const hasEvent = eventDaySet.has(d);

            el.className = 'h-8 flex items-center justify-center text-xs rounded-full cursor-default transition-all';
            if (isToday) {
                el.classList.add('bg-blue-500', 'text-white', 'font-bold');
            } else if (hasEvent) {
                el.classList.add('bg-green-600', 'text-white', 'font-bold', 'cursor-pointer', 'hover:bg-green-700');
                el.title = 'Event on this day';
                el.addEventListener('click', function () {
                    const idx = upcoming.findIndex(e => {
                        const ed = new Date(e.event_date);
                        return ed.getFullYear() === calYear && ed.getMonth() === calMonth && ed.getDate() === d;
                    });
                    if (idx !== -1) openEventModal(idx);
                });
            } else {
                el.classList.add('text-gray-600', 'hover:bg-gray-100');
            }
            grid.appendChild(el);
        }
    }

    function calPrev() { if (--calMonth < 0) { calMonth = 11; calYear--; } renderCal(); }
    function calNext() { if (++calMonth > 11) { calMonth = 0; calYear++; } renderCal(); }
    window.calPrev = calPrev;
    window.calNext = calNext;
    renderCal();

    /* ── Event detail modal ──────────────────────────────────── */
    function openEventModal(idx) {
        const ev = upcoming[idx];
        if (!ev) return;

        const isUpcoming = new Date(ev.event_date) >= new Date();
        document.getElementById('modal-status').textContent = isUpcoming ? 'Upcoming' : 'Past';
        document.getElementById('modal-day').textContent   = ev.day   || '';
        document.getElementById('modal-month').textContent = ev.month || '';
        document.getElementById('modal-year').textContent  = ev.year  || '';
        document.getElementById('modal-title').textContent = ev.title || '';
        document.getElementById('modal-time').textContent  = ev.time  || '';

        const locWrap = document.getElementById('modal-location-wrap');
        if (ev.location) {
            document.getElementById('modal-location').textContent = ev.location;
            locWrap.classList.remove('hidden');
        } else {
            locWrap.classList.add('hidden');
        }

        // Description
        const descWrap = document.getElementById('modal-desc-wrap');
        const descEl   = document.getElementById('modal-description');
        if (ev.description) {
            descEl.innerHTML = ev.description; // safe — server-rendered
            descWrap.style.display = '';
        } else {
            descWrap.style.display = 'none';
        }

        // Speakers
        const speakersWrap = document.getElementById('modal-speakers-wrap');
        const speakersEl   = document.getElementById('modal-speakers');
        if (ev.speakers && ev.speakers.length > 0) {
            speakersEl.innerHTML = ev.speakers.map(function(s) {
                const name = typeof s === 'object' ? (s.name || '') : s;
                const role = typeof s === 'object' ? (s.role || '') : '';
                return '<div class="flex items-center gap-2 bg-gray-50 rounded-lg px-3 py-2">'
                    + '<div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">'
                    + '<i class="fas fa-microphone text-green-600 text-xs"></i></div>'
                    + '<div><p class="text-sm font-semibold text-gray-800">' + escHtml(name) + '</p>'
                    + (role ? '<p class="text-xs text-gray-500">' + escHtml(role) + '</p>' : '')
                    + '</div></div>';
            }).join('');
            speakersWrap.classList.remove('hidden');
        } else {
            speakersWrap.classList.add('hidden');
        }

        // Agenda
        const agendaWrap = document.getElementById('modal-agenda-wrap');
        const agendaEl   = document.getElementById('modal-agenda');
        if (ev.agenda && ev.agenda.length > 0) {
            agendaEl.innerHTML = ev.agenda.map(function(item, i) {
                const label = typeof item === 'object' ? (item.time || '') : '';
                const text  = typeof item === 'object' ? (item.title || item.text || '') : item;
                return '<div class="flex gap-3">'
                    + '<div class="flex flex-col items-center">'
                    + '<div class="w-2 h-2 bg-green-600 rounded-full mt-1.5 flex-shrink-0"></div>'
                    + (i < ev.agenda.length - 1 ? '<div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>' : '')
                    + '</div>'
                    + '<div class="pb-3">'
                    + (label ? '<span class="text-xs font-bold text-green-600 block">' + escHtml(label) + '</span>' : '')
                    + '<span class="text-sm text-gray-700">' + escHtml(text) + '</span>'
                    + '</div></div>';
            }).join('');
            agendaWrap.classList.remove('hidden');
        } else {
            agendaWrap.classList.add('hidden');
        }

        // Google Calendar link
        if (ev.event_date) {
            const start = new Date(ev.event_date);
            const end   = new Date(start.getTime() + 3 * 3600000);
            const fmt   = d => d.toISOString().replace(/[-:]/g,'').split('.')[0];
            const gcal  = 'https://calendar.google.com/calendar/render?action=TEMPLATE'
                + '&text=' + encodeURIComponent(ev.title)
                + '&dates=' + fmt(start) + '/' + fmt(end)
                + '&details=' + encodeURIComponent((ev.description || '').replace(/<[^>]+>/g,'').substring(0, 300))
                + '&location=' + encodeURIComponent(ev.location || '');
            document.getElementById('modal-gcal-link').href = gcal;

            // iCal
            const ics = 'BEGIN:VCALENDAR\r\nVERSION:2.0\r\nBEGIN:VEVENT\r\n'
                + 'DTSTART:' + fmt(start) + '\r\n'
                + 'DTEND:' + fmt(end) + '\r\n'
                + 'SUMMARY:' + (ev.title || '').replace(/,/g,'\\,') + '\r\n'
                + 'LOCATION:' + (ev.location || '').replace(/,/g,'\\,') + '\r\n'
                + 'END:VEVENT\r\nEND:VCALENDAR';
            document.getElementById('modal-ical-link').href =
                'data:text/calendar;charset=utf-8,' + encodeURIComponent(ics);
            document.getElementById('modal-ical-link').download = (ev.slug || 'event') + '.ics';
        }

        // Share area in modal
        const shareArea = document.getElementById('modal-share-area');
        const eu = encodeURIComponent('{{ url("/events") }}');
        const et = encodeURIComponent(ev.title);
        shareArea.innerHTML = buildShareButtons(et, eu);

        document.getElementById('eventModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    window.openEventModal = openEventModal;

    function closeEventModal() {
        document.getElementById('eventModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    window.closeEventModal = closeEventModal;

    /* ── Share popover ───────────────────────────────────────── */
    function shareEvent(title, url) {
        const et = encodeURIComponent(title);
        const eu = encodeURIComponent(url);
        document.getElementById('sharePopoverContent').innerHTML = buildShareButtons(et, eu);
        document.getElementById('sharePopover').classList.remove('hidden');
    }
    window.shareEvent = shareEvent;

    function closeSharePopover() {
        document.getElementById('sharePopover').classList.add('hidden');
    }
    window.closeSharePopover = closeSharePopover;

    /* ── Share buttons builder ───────────────────────────────── */
    function buildShareButtons(et, eu) {
        const platforms = [
            { href: 'https://www.facebook.com/sharer/sharer.php?u=' + eu, bg: '#1877F2', icon: 'fab fa-facebook-f', label: 'Facebook' },
            { href: 'https://twitter.com/intent/tweet?url=' + eu + '&text=' + et, bg: '#000', icon: 'fab fa-twitter', label: 'Twitter / X' },
            { href: 'https://api.whatsapp.com/send?text=' + et + '%20' + eu, bg: '#25D366', icon: 'fab fa-whatsapp', label: 'WhatsApp' },
            { href: 'https://t.me/share/url?url=' + eu + '&text=' + et, bg: '#2AABEE', icon: 'fab fa-telegram', label: 'Telegram' },
        ];
        let html = '<div class="flex flex-wrap gap-2">';
        platforms.forEach(function(p) {
            html += '<a href="' + p.href + '" target="_blank" rel="noopener noreferrer"'
                + ' style="background:' + p.bg + '"'
                + ' class="inline-flex items-center gap-2 px-4 py-2 text-white rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">'
                + '<i class="' + p.icon + '"></i><span>' + p.label + '</span></a>';
        });
        // Copy link
        const rawUrl = decodeURIComponent(eu);
        html += '<button type="button" data-copy-url="' + rawUrl + '"'
            + ' class="copy-link-btn inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg text-sm font-medium">'
            + '<i class="fas fa-link"></i><span>Copy Link</span></button>';
        html += '</div>';
        return html;
    }

    /* ── Keyboard esc close ──────────────────────────────────── */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeEventModal(); closeSharePopover(); }
    });

    /* ── HTML escape helper ──────────────────────────────────── */
    function escHtml(str) {
        return String(str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>
@endpush
