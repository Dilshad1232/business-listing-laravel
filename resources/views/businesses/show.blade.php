@extends('layouts.main')
@section('title', $business->name . ' | Lokora')
@section('description', $business->meta_description ?: $business->description)
@section('content')

@php
    /* ---------- Shared helpers ---------- */
    $card  = 'bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm';
    $glass = 'inline-flex items-center justify-center gap-2 px-5 py-3 bg-white/10 hover:bg-white/15 border border-white/10 text-white font-semibold rounded-xl transition-all';
    $side  = 'w-full inline-flex items-center justify-center gap-2 px-5 py-3 font-semibold rounded-xl transition-all';
    $head  = fn($icon, $label, $title) => new \Illuminate\Support\HtmlString(
        '<div class="flex items-center gap-3"><div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0"><i class="' . $icon . ' text-primary"></i></div><div>'
        . '<span class="text-xs font-semibold text-primary uppercase tracking-wider">' . e($label) . '</span>'
        . '<h2 class="text-2xl font-bold text-dark-900">' . e($title) . '</h2></div></div>'
    );
    $emptyBox = fn($icon, $title, $text) => new \Illuminate\Support\HtmlString(
        '<div class="text-center py-10"><div class="w-16 h-16 rounded-full bg-dark-50 mx-auto flex items-center justify-center"><i class="' . $icon . ' text-2xl text-dark-300"></i></div>'
        . '<h3 class="font-bold text-dark-900 mt-4">' . e($title) . '</h3><p class="text-sm text-dark-400 mt-1">' . e($text) . '</p></div>'
    );

    $products      = $business->products->where('status', true);
    $activeOffers  = $business->offers ? $business->offers->where('status', true)->sortBy('sort_order') : collect();
    $reviewList    = $business->reviews ? $business->reviews->where('status', 'approved') : collect();
    $totalApproved = $reviewList->count();
    $hasServices   = $business->services && $business->services->count();
    $hasHours      = $business->businessHours && $business->businessHours->count();
    $hasPhotos     = $business->photos && $business->photos->count();
    $days          = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];
    $badge         = 'inline-flex items-center justify-center min-w-[24px] h-6 px-2 rounded-full bg-red-50 text-red-500 text-xs font-bold';

    // [key, icon, label, visible, badge]
    $tabs = [
        ['overview', 'fas fa-building', 'Overview', true, null],
        ['services', 'fas fa-screwdriver-wrench', 'Services', $hasServices, null],
        ['location', 'fas fa-location-dot', 'Location', true, null],
        ['hours', 'far fa-clock', 'Hours', $hasHours, null],
        ['gallery', 'fas fa-images', 'Gallery', $hasPhotos, null],
        ['products', 'bi bi-box-seam', 'Products', true, $business->products->count()],
        ['offers', 'bi bi-percent', 'Offers & Deals', true, $activeOffers->count()],
        ['reviews', 'fas fa-star', 'Reviews', true, null],
        ['contact', 'fas fa-address-card', 'Contact', true, null],
    ];

    $locationItems = [
        ['fas fa-map-marker-alt', 'Address', $business->address],
        ['fas fa-map-pin', 'Area', $business->area?->name],
        ['fas fa-city', 'City', $business->city?->name],
        ['fas fa-map', 'State', $business->state?->name],
        ['fas fa-globe', 'Country', $business->country?->name],
        ['fas fa-location-crosshairs', 'Pincode', $business->pincode],
    ];

    // [href, icon, label, value, value class, external]
    $contactItems = [
        ['tel:' . $business->phone, 'fas fa-phone', 'Phone', $business->phone, '', false],
        ['mailto:' . $business->email, 'fas fa-envelope', 'Email', $business->email, 'break-all', false],
        [$business->website, 'fas fa-globe', 'Website', $business->website, 'text-primary break-all', true],
    ];
@endphp

{{-- ================= HERO ================= --}}
<section class="bg-dark-900 relative overflow-hidden">

    <div class="bg-grid-dark absolute inset-0"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16 relative">

        {{-- BREADCRUMB --}}
        <div class="flex flex-wrap items-center gap-2 text-sm mb-8" data-aos="fade-up">
            <a href="{{ url('/') }}" class="text-dark-400 hover:text-primary transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs text-dark-600"></i>
            <a href="{{ route('businesses.index') }}" class="text-dark-400 hover:text-primary transition-colors">Businesses</a>
            @if($business->category)
                <i class="fas fa-chevron-right text-xs text-dark-600"></i>
                <span class="text-dark-400">{{ $business->category->name }}</span>
            @endif
            <i class="fas fa-chevron-right text-xs text-dark-600"></i>
            <span class="text-primary truncate max-w-[220px]">{{ $business->name }}</span>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-center" data-aos="fade-up">

            {{-- IMAGE --}}
            <div class="lg:col-span-4">
                <div class="relative">
                    <div class="relative h-64 sm:h-72 lg:h-80 rounded-2xl overflow-hidden border border-white/10 bg-dark-800">
                        @if($business->cover_image)
                            <img src="{{ asset('storage/' . $business->cover_image) }}" alt="{{ $business->name }}" class="w-full h-full object-cover" loading="eager">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-dark-800"><i class="fas fa-building text-6xl text-dark-600"></i></div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        @if($business->is_featured)
                            <span class="absolute top-5 left-5 inline-flex items-center gap-2 px-3 py-1.5 bg-primary text-white text-xs font-semibold rounded-lg shadow-lg">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif

                        @if($hasPhotos)
                            <button type="button" onclick="openGallery(0)" class="absolute bottom-5 right-5 inline-flex items-center gap-2 px-4 py-2.5 bg-black/60 hover:bg-black/80 backdrop-blur text-white text-sm font-semibold rounded-xl transition-all">
                                <i class="fas fa-images"></i> {{ $business->photos->count() }} Photos
                            </button>
                        @endif
                    </div>

                    {{-- LOGO --}}
                    <div class="absolute left-5 sm:left-6 bottom-0 translate-y-1/2 z-10">
                        @if($business->logo)
                            <div class="w-24 h-24 sm:w-28 sm:h-28 bg-white rounded-2xl p-2 shadow-2xl border border-gray-200">
                                <img src="{{ asset('storage/' . $business->logo) }}" alt="{{ $business->name }} Logo" class="w-full h-full object-contain rounded-xl">
                            </div>
                        @else
                            <div class="w-24 h-24 sm:w-28 sm:h-28 bg-white rounded-2xl shadow-2xl border border-gray-200 flex items-center justify-center">
                                <i class="fas fa-building text-3xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="lg:col-span-8">
                @if($business->category)
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/10 border border-primary/20 text-primary text-sm font-medium rounded-lg">
                            <i class="fas fa-layer-group"></i> {{ $business->category->name }}
                        </span>
                        @if($business->subcategory)
                            <i class="fas fa-chevron-right text-xs text-dark-600"></i>
                            <span class="text-dark-400 text-sm">{{ $business->subcategory->name }}</span>
                        @endif
                    </div>
                @endif

                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">{{ $business->name }}</h1>
                        @if($business->tagline)
                            <p class="text-lg text-dark-300 mt-4 max-w-3xl">{{ $business->tagline }}</p>
                        @endif
                    </div>
                    <button type="button" onclick="shareBusiness()" class="shrink-0 inline-flex items-center justify-center gap-2 px-4 py-3 bg-white/10 hover:bg-white/15 border border-white/10 text-white rounded-xl transition-all">
                        <i class="fas fa-share-nodes"></i><span class="hidden sm:inline">Share</span>
                    </button>
                </div>

                {{-- RATING --}}
                <div class="flex flex-wrap items-center gap-5 mt-6">
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                        <span class="text-white font-semibold">{{ number_format((float) $business->rating, 1) }}</span>
                        <span class="text-dark-400 text-sm">({{ $business->reviews_count }} reviews)</span>
                    </div>
                    @if($business->city || $business->state)
                        <div class="flex items-center gap-2 text-dark-300 text-sm">
                            <i class="fas fa-location-dot text-primary"></i>
                            <span>{{ $business->city?->name }}@if($business->state), {{ $business->state->name }}@endif</span>
                        </div>
                    @endif
                </div>

                {{-- ACTIONS --}}
                <div class="flex flex-wrap gap-3 mt-8">
                    @if($business->phone)
                        <a href="tel:{{ $business->phone }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/20">
                            <i class="fas fa-phone"></i> Call Business
                        </a>
                    @endif
                    @if($business->email)
                        <a href="mailto:{{ $business->email }}" class="{{ $glass }}"><i class="fas fa-envelope"></i> Email</a>
                    @endif
                    @if($business->website)
                        <a href="{{ $business->website }}" target="_blank" rel="noopener noreferrer" class="{{ $glass }}"><i class="fas fa-globe"></i> Website</a>
                    @endif
                    <button type="button" onclick="toggleFavorite(this)" class="{{ $glass }}"><i class="far fa-heart"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= TABS NAV ================= --}}
<div class="business-tabs-wrapper">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="business-tabs" id="businessTabs" aria-label="Business sections">
            @foreach($tabs as [$key, $icon, $label, $visible, $count])
                @if($visible)
                    <button type="button" class="business-tab {{ $key === 'overview' ? 'active' : '' }}" data-tab="{{ $key }}">
                        <i class="{{ $icon }}"></i><span>{{ $label }}</span>
                        @if(!is_null($count))<span class="{{ $badge }}">{{ $count }}</span>@endif
                    </button>
                @endif
            @endforeach
        </nav>
    </div>
</div>

{{-- ================= CONTENT ================= --}}
<section class="py-12 lg:py-20 bg-dark-50 relative overflow-hidden">
    <div class="bg-grid absolute inset-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-12 gap-8">

            {{-- ===== LEFT ===== --}}
            <div class="lg:col-span-8">

                {{-- OVERVIEW --}}
                <div class="business-tab-panel active" data-panel="overview">
                    <div class="space-y-8">
                        <div class="{{ $card }}" data-aos="fade-up">
                            <div class="mb-6">{{ $head('fas fa-building', 'About Business', 'About ' . $business->name) }}</div>
                            @if($business->description)
                                <div class="text-dark-500 leading-7 whitespace-pre-line">{{ $business->description }}</div>
                            @else
                                <p class="text-dark-400">No business description has been added yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- SERVICES --}}
                @if($hasServices)
                    <div class="business-tab-panel" data-panel="services">
                        <div class="space-y-8">
                            <div class="{{ $card }}" data-aos="fade-up">
                                <div class="flex items-center justify-between gap-3 mb-6">
                                    {{ $head('fas fa-screwdriver-wrench', 'What We Offer', 'Services') }}
                                    <span class="hidden sm:inline-flex px-3 py-1.5 rounded-lg bg-dark-50 text-dark-500 text-sm font-medium">
                                        {{ $business->services->count() }} {{ Str::plural('Service', $business->services->count()) }}
                                    </span>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-4">
                                    @foreach($business->services->where('status', true) as $service)
                                        <a href="{{ route('businesses.services.show', $service) }}" class="group block border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="w-10 h-10 shrink-0 rounded-xl bg-primary/10 text-primary flex items-center justify-center"><i class="fas fa-check"></i></div>
                                                @if($service->price !== null)
                                                    <span class="text-primary font-bold text-sm">₹{{ number_format((float) $service->price, 2) }}</span>
                                                @endif
                                            </div>
                                            <h3 class="font-bold text-dark-900 mt-4 group-hover:text-primary transition-colors">{{ $service->name }}</h3>
                                            @if($service->short_description || $service->description)
                                                <p class="text-sm text-dark-500 mt-2 leading-6">{{ $service->short_description ?: Str::limit($service->description, 130) }}</p>
                                            @endif
                                            @if($service->duration)
                                                <div class="flex items-center gap-2 mt-4 text-xs text-dark-400"><i class="far fa-clock text-primary"></i> {{ $service->duration }}</div>
                                            @endif
                                            <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">
                                                <span class="text-xs text-dark-400 group-hover:text-primary transition-colors">View Service</span>
                                                <span class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-dark-300 group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all">
                                                    <i class="fas fa-arrow-right text-xs"></i>
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- LOCATION --}}
                <div class="business-tab-panel" data-panel="location">
                    <div class="space-y-8">
                        <div class="{{ $card }}" data-aos="fade-up">
                            <div class="mb-6">{{ $head('fas fa-location-dot', 'Location', 'Business Location') }}</div>
                            <div class="grid sm:grid-cols-2 gap-5">
                                @foreach($locationItems as [$icon, $label, $value])
                                    @if($value)
                                        <div class="flex gap-4">
                                            <div class="w-10 h-10 shrink-0 rounded-xl bg-dark-50 flex items-center justify-center"><i class="{{ $icon }} text-primary"></i></div>
                                            <div>
                                                <p class="text-xs text-dark-400 mb-1">{{ $label }}</p>
                                                <p class="text-sm font-medium text-dark-900">{{ $value }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HOURS --}}
                @if($hasHours)
                    <div class="business-tab-panel" data-panel="hours">
                        <div class="space-y-8">
                            <div class="{{ $card }}" data-aos="fade-up">
                                <div class="mb-6">{{ $head('far fa-clock', 'Schedule', 'Business Hours') }}</div>
                                <div class="divide-y divide-gray-100">
                                    @foreach($business->businessHours as $hour)
                                        <div class="flex items-center justify-between gap-4 py-3">
                                            <span class="text-sm font-semibold text-dark-900">{{ $days[$hour->day_of_week] ?? 'Day' }}</span>
                                            @if((bool) ($hour->is_closed ?? false))
                                                <span class="text-sm text-red-500 font-medium">Closed</span>
                                            @else
                                                <span class="text-sm text-dark-500">
                                                    {{ $hour->open_time ? \Carbon\Carbon::parse($hour->open_time)->format('h:i A') : '--' }}
                                                    <span class="mx-1">–</span>
                                                    {{ $hour->close_time ? \Carbon\Carbon::parse($hour->close_time)->format('h:i A') : '--' }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- GALLERY --}}
                @if($hasPhotos)
                    <div class="business-tab-panel" data-panel="gallery">
                        <div class="space-y-8">
                            <div class="{{ $card }}" data-aos="fade-up">
                                <div class="flex items-center justify-between gap-3 mb-6">
                                    {{ $head('fas fa-images', 'Gallery', 'Business Photos') }}
                                    <span class="text-sm text-dark-400">{{ $business->photos->count() }} Photos</span>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($business->photos as $index => $photo)
                                        <button type="button" onclick="openGallery({{ $index }})" class="group relative aspect-[4/3] rounded-2xl overflow-hidden bg-dark-50 border border-gray-100">
                                            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->caption ?: $business->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/35 transition-all"></div>
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                                <span class="w-11 h-11 rounded-full bg-white text-dark-900 flex items-center justify-center shadow-lg"><i class="fas fa-expand"></i></span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- PRODUCTS --}}
                <div class="business-tab-panel space-y-6" data-panel="products">
                    @if($products->count())
                        <div class="{{ $card }}" data-aos="fade-up" id="products">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                {{ $head('fas fa-box-open', 'Products', 'Products & Offers') }}
                                <span class="inline-flex self-start sm:self-auto items-center gap-2 px-3 py-1.5 rounded-lg bg-dark-50 text-dark-500 text-sm font-medium">
                                    <i class="fas fa-box text-primary"></i> {{ $products->count() }} {{ Str::plural('Product', $products->count()) }}
                                </span>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-5">
                                @foreach($products->sortBy('sort_order') as $product)
                                    @php
                                        $primaryImage    = $product->images->firstWhere('is_primary', true) ?: $product->images->first();
                                        $hasDiscount     = !is_null($product->price) && !is_null($product->discount_price) && (float) $product->discount_price < (float) $product->price;
                                        $discountPercent = $hasDiscount ? round((((float) $product->price - (float) $product->discount_price) / (float) $product->price) * 100) : 0;
                                    @endphp

                                    <article class="group border border-gray-100 rounded-2xl overflow-hidden bg-white hover:border-primary/30 hover:shadow-xl transition-all duration-300">
                                        <a href="{{ route('products.show', $product->slug) }}" class="block relative aspect-[4/3] bg-dark-50 overflow-hidden">
                                            @if($primaryImage)
                                                <img src="{{ asset('storage/' . $primaryImage->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-dark-50 to-gray-100"><i class="fas fa-box-open text-4xl text-dark-300"></i></div>
                                            @endif
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            @if($product->is_featured)
                                                <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-primary text-white text-xs font-semibold shadow-lg"><i class="fas fa-star"></i> Featured</span>
                                            @endif
                                            @if($hasDiscount)
                                                <span class="absolute top-3 right-3 px-2.5 py-1.5 rounded-lg bg-red-500 text-white text-xs font-bold shadow-lg">-{{ $discountPercent }}%</span>
                                            @endif
                                        </a>

                                        <div class="p-5">
                                            @if($product->category)
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="text-[11px] font-semibold text-primary uppercase tracking-wider">{{ $product->category->name }}</span>
                                                    @if($product->subcategory)
                                                        <span class="text-dark-300 text-xs">•</span>
                                                        <span class="text-[11px] text-dark-400 truncate">{{ $product->subcategory->name }}</span>
                                                    @endif
                                                </div>
                                            @endif

                                            <h3 class="text-lg font-bold text-dark-900 group-hover:text-primary transition-colors line-clamp-2">{{ $product->name }}</h3>

                                            @if($product->short_description || $product->description)
                                                <p class="text-sm text-dark-500 leading-6 mt-2 line-clamp-2">{{ $product->short_description ?: Str::limit($product->description, 120) }}</p>
                                            @endif

                                            <div class="flex flex-wrap items-center justify-between gap-3 mt-5 pt-4 border-t border-gray-100">
                                                <div>
                                                    @if($hasDiscount)
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-lg font-bold text-primary">₹{{ number_format((float) $product->discount_price, 2) }}</span>
                                                            <span class="text-sm text-dark-400 line-through">₹{{ number_format((float) $product->price, 2) }}</span>
                                                        </div>
                                                    @elseif(!is_null($product->price))
                                                        <span class="text-lg font-bold text-primary">₹{{ number_format((float) $product->price, 2) }}</span>
                                                    @else
                                                        <span class="text-sm text-dark-400">Price on request</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-primary/10 text-primary hover:bg-primary hover:text-white text-sm font-semibold transition-all">
                                                    View Product <i class="fas fa-arrow-right text-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl border border-gray-100 p-10 shadow-sm text-center">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-4"><i class="fas fa-box-open text-2xl"></i></div>
                            <h2 class="text-xl font-bold text-dark-900">No Products Available</h2>
                            <p class="text-sm text-dark-500 mt-2">This business has not added any products yet.</p>
                        </div>
                    @endif
                </div>

                {{-- OFFERS & DEALS --}}
                <div class="business-tab-panel space-y-6" data-panel="offers">
                    <div class="{{ $card }}">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center"><i class="bi bi-percent text-xl"></i></div>
                                <div>
                                    <span class="text-xs font-semibold text-red-500 uppercase tracking-wider">Special Offers</span>
                                    <h2 class="text-2xl font-bold text-gray-900">Offers &amp; Deals</h2>
                                    <p class="text-sm text-gray-500 mt-1">Exclusive offers and special deals from this business.</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-bold">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                </span>
                                {{ $activeOffers->count() }} {{ Str::plural('Offer', $activeOffers->count()) }}
                            </span>
                        </div>

                        @if($activeOffers->count())
                            <div class="grid sm:grid-cols-2 gap-5">
                                @foreach($activeOffers as $offer)
                                    @php
                                        $discountText = null;
                                        if ($offer->discount_value !== null) {
                                            if ($offer->discount_type === 'percentage') {
                                                $discountText = rtrim(rtrim(number_format((float) $offer->discount_value, 2), '0'), '.') . '%';
                                            } elseif ($offer->discount_type === 'fixed') {
                                                $discountText = '₹' . number_format((float) $offer->discount_value, 2);
                                            }
                                        }
                                        $rows = [];
                                        if ($offer->minimum_purchase !== null) {
                                            $rows[] = ['bi bi-cart-check', 'Minimum purchase:', $offer->minimum_purchase];
                                        }
                                        if ($offer->maximum_discount !== null && $offer->discount_type === 'percentage') {
                                            $rows[] = ['bi bi-shield-check', 'Maximum discount:', $offer->maximum_discount];
                                        }
                                    @endphp

                                    <a href="{{ route('bookings.create', $business) }}" class="relative block overflow-hidden rounded-2xl border border-gray-200 bg-gradient-to-br from-white to-gray-50 p-5 sm:p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg cursor-pointer">

                                        @if($offer->is_featured)
                                            <div class="absolute top-0 right-0">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-bl-xl bg-amber-400 text-white text-xs font-bold"><i class="bi bi-star-fill"></i> Featured</span>
                                            </div>
                                        @endif

                                        <div class="flex items-start justify-between gap-4 mb-5">
                                            <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0"><i class="bi bi-ticket-perforated text-2xl"></i></div>
                                            @if($discountText)
                                                <div class="text-right">
                                                    <div class="text-2xl sm:text-3xl font-extrabold text-red-500 leading-none">{{ $discountText }}</div>
                                                    <div class="text-xs text-gray-500 font-medium mt-1">Discount</div>
                                                </div>
                                            @endif
                                        </div>

                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">{{ $offer->title }}</h3>

                                        @if($offer->short_description || $offer->description)
                                            <p class="text-sm text-gray-600 leading-6 mb-5">{{ $offer->short_description ?: Str::limit(strip_tags($offer->description), 150) }}</p>
                                        @endif

                                        @foreach($rows as [$rowIcon, $rowLabel, $rowValue])
                                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                                <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center"><i class="{{ $rowIcon }} text-gray-500"></i></span>
                                                <span>{{ $rowLabel }} <strong class="text-gray-800">₹{{ number_format((float) $rowValue, 2) }}</strong></span>
                                            </div>
                                        @endforeach

                                        @if($offer->coupon_code)
                                            <div class="flex items-center justify-between gap-3 p-3.5 rounded-xl bg-gray-100 border border-dashed border-gray-300 mt-4 mb-5">
                                                <div class="min-w-0">
                                                    <div class="text-[10px] uppercase tracking-wider text-gray-500 font-bold mb-1">Coupon Code</div>
                                                    <div class="font-mono font-bold text-gray-900 tracking-wide text-sm sm:text-base break-all">{{ $offer->coupon_code }}</div>
                                                </div>
                                                <button type="button" onclick="copyOfferCode(@js($offer->coupon_code), this)" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-gray-900 text-white text-xs font-semibold hover:bg-gray-800 transition flex-shrink-0">
                                                    <i class="bi bi-copy"></i><span>Copy</span>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="flex items-center gap-2 text-xs text-gray-500 pt-1">
                                            <i class="bi bi-calendar-event text-gray-400"></i>
                                            @if($offer->ends_at)
                                                <span>Valid until <strong class="text-gray-700">{{ $offer->ends_at->format('d M Y, h:i A') }}</strong></span>
                                            @elseif($offer->starts_at)
                                                <span>Available from <strong class="text-gray-700">{{ $offer->starts_at->format('d M Y, h:i A') }}</strong></span>
                                            @else
                                                <span>No expiry date</span>
                                            @endif
                                        </div>

                                        @if($offer->terms_conditions)
                                            <details class="mt-5">
                                                <summary class="cursor-pointer text-xs font-semibold text-gray-600 hover:text-gray-900 select-none">
                                                    <span class="inline-flex items-center gap-1.5"><i class="bi bi-info-circle"></i> View terms &amp; conditions</span>
                                                </summary>
                                                <div class="mt-3 p-3.5 rounded-xl bg-gray-50 border border-gray-100 text-xs text-gray-600 leading-5 whitespace-pre-line">{{ $offer->terms_conditions }}</div>
                                            </details>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-14">
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mb-4"><i class="bi bi-percent text-2xl"></i></div>
                                <h3 class="text-lg font-bold text-gray-900">No Active Offers</h3>
                                <p class="text-sm text-gray-500 mt-1">This business currently has no active offers or deals.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- REVIEWS --}}
                <div class="business-tab-panel" data-panel="reviews">
                    <div class="space-y-8">
                        <div class="{{ $card }}" id="reviews" data-aos="fade-up">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

                                {{ $head('fas fa-star', 'Customer Feedback', 'Reviews') }}

                                {{-- WRITE A REVIEW BUTTON --}}
                                <button
                                    type="button"
                                    onclick="openReviewModal()"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-primary/10 text-primary hover:bg-primary hover:text-white border border-primary/10 hover:border-primary rounded-xl text-sm font-semibold transition-all"
                                >
                                    <i class="fas fa-pen"></i>
                                    Write a Review
                                </button>

                                {{-- WRITE A REVIEW MODAL --}}
                                <div id="reviewModal" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
                                    <div class="absolute inset-0 bg-dark-900/60 backdrop-blur-sm" onclick="closeReviewModal()"></div>
                                    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-6">
                                        <div id="reviewModalContent" class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 max-h-[92vh] overflow-y-auto">

                                            <div class="relative px-6 sm:px-8 py-6 border-b border-gray-100">
                                                <button type="button" onclick="closeReviewModal()" class="absolute top-5 right-5 w-9 h-9 rounded-xl bg-gray-100 text-dark-500 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition-all" aria-label="Close review modal">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <div class="flex items-center gap-4 pr-10">
                                                    <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0"><i class="fas fa-star text-lg"></i></div>
                                                    <div>
                                                        <span class="text-xs font-bold text-primary uppercase tracking-wider">Customer Feedback</span>
                                                        <h2 class="text-xl sm:text-2xl font-bold text-dark-900 mt-1">Write a Review</h2>
                                                        <p class="text-sm text-dark-400 mt-1">Share your experience with this business.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <form method="POST" action="{{ route('businesses.reviews.store', ['business' => $business->slug]) }}" class="p-6 sm:p-8">
                                                @csrf
                                                @php $input = 'w-full h-12 pl-11 pr-4 rounded-xl border border-gray-200 bg-gray-50/50 text-dark-900 placeholder-dark-300 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all'; @endphp

                                                <div class="grid sm:grid-cols-2 gap-5">
                                                    @foreach([
                                                        ['reviewer_name', 'text', 'Your Name', 'fas fa-user', 100, 'Enter your name'],
                                                        ['reviewer_email', 'email', 'Email Address', 'fas fa-envelope', 255, 'you@example.com'],
                                                    ] as [$f, $type, $lbl, $ico, $max, $ph])
                                                        <div>
                                                            <label for="{{ $f }}" class="block text-sm font-semibold text-dark-700 mb-2">{{ $lbl }} <span class="text-red-500">*</span></label>
                                                            <div class="relative">
                                                                <i class="{{ $ico }} absolute left-4 top-1/2 -translate-y-1/2 text-dark-300"></i>
                                                                <input type="{{ $type }}" id="{{ $f }}" name="{{ $f }}" value="{{ old($f) }}" required maxlength="{{ $max }}" placeholder="{{ $ph }}" class="{{ $input }}">
                                                            </div>
                                                            @error($f)<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                                        </div>
                                                    @endforeach
                                                </div>

                                                {{-- STAR RATING --}}
                                                <div class="mt-6">
                                                    <label class="block text-sm font-semibold text-dark-700 mb-3">Your Rating <span class="text-red-500">*</span></label>
                                                    <div class="flex items-center gap-2" id="reviewStarRating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <button type="button" class="review-star w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-gray-100 text-gray-300 hover:bg-yellow-50 hover:text-yellow-400 transition-all" data-rating="{{ $i }}" aria-label="{{ $i }} star rating"><i class="fas fa-star"></i></button>
                                                        @endfor
                                                        <span id="ratingText" class="ml-2 text-sm font-semibold text-dark-400">Select a rating</span>
                                                    </div>
                                                    <input type="hidden" name="rating" id="reviewRatingInput" value="{{ old('rating') }}" required>
                                                    @error('rating')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                                                </div>

                                                <div class="mt-6">
                                                    <label for="review_title" class="block text-sm font-semibold text-dark-700 mb-2">Review Title <span class="text-xs font-normal text-dark-400">(Optional)</span></label>
                                                    <input type="text" id="review_title" name="title" value="{{ old('title') }}" maxlength="255" placeholder="Example: Excellent service" class="w-full h-12 px-4 rounded-xl border border-gray-200 bg-gray-50/50 text-dark-900 placeholder-dark-300 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                                    @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                                </div>

                                                <div class="mt-6">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <label for="review_comment" class="block text-sm font-semibold text-dark-700">Your Review <span class="text-red-500">*</span></label>
                                                        <span id="reviewCharCount" class="text-xs text-dark-400">0 / 5000</span>
                                                    </div>
                                                    <textarea id="review_comment" name="comment" rows="5" required minlength="5" maxlength="5000" placeholder="Tell others about your experience..." class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50/50 text-dark-900 placeholder-dark-300 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all resize-none">{{ old('comment') }}</textarea>
                                                    @error('comment')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                                </div>

                                                <div class="flex items-start gap-3 mt-6 p-4 rounded-xl bg-primary/5 border border-primary/10">
                                                    <i class="fas fa-info-circle text-primary mt-0.5"></i>
                                                    <p class="text-xs sm:text-sm text-dark-500 leading-6">Your review will be published after it has been reviewed and approved.</p>
                                                </div>

                                                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-7">
                                                    <button type="button" onclick="closeReviewModal()" class="w-full sm:w-auto px-5 py-3 rounded-xl border border-gray-200 text-dark-600 hover:bg-gray-50 font-semibold transition-all">Cancel</button>
                                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white hover:opacity-90 shadow-lg shadow-primary/20 font-semibold transition-all">
                                                        <i class="fas fa-paper-plane"></i> Submit Review
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- RATING SUMMARY --}}
                            <div class="grid md:grid-cols-3 gap-6 mb-8">
                                <div class="text-center md:border-r border-gray-100">
                                    <div class="text-5xl font-bold text-dark-900">{{ number_format((float) $business->rating, 1) }}</div>
                                    <div class="flex justify-center gap-1 text-yellow-400 mt-2">@for($i = 1; $i <= 5; $i++)<i class="fas fa-star text-sm"></i>@endfor</div>
                                    <p class="text-sm text-dark-400 mt-2">{{ $business->reviews_count }} total reviews</p>
                                </div>

                                <div class="md:col-span-2">
                                    @for($star = 5; $star >= 1; $star--)
                                        @php
                                            $starCount  = $reviewList->where('rating', $star)->count();
                                            $percentage = $totalApproved > 0 ? ($starCount / $totalApproved) * 100 : 0;
                                        @endphp
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="w-8 text-xs font-semibold text-dark-500">{{ $star }} <i class="fas fa-star text-yellow-400"></i></span>
                                            <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden"><div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div></div>
                                            <span class="w-8 text-right text-xs text-dark-400">{{ $starCount }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            {{-- REVIEW LIST --}}
                            @if($totalApproved)
                                <div class="space-y-5">
                                    @foreach($reviewList as $review)
                                        @php $reviewer = $review->reviewer_name ?: $review->user?->name ?: null; @endphp
                                        <article class="border border-gray-100 rounded-2xl p-5 sm:p-6">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-11 h-11 rounded-full bg-primary text-white flex items-center justify-center font-bold">{{ strtoupper(substr($reviewer ?: 'G', 0, 1)) }}</div>
                                                    <div>
                                                        <h3 class="font-semibold text-dark-900">{{ $reviewer ?: 'Guest Reviewer' }}</h3>
                                                        <p class="text-xs text-dark-400">{{ $review->created_at?->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                                @if($review->is_featured)
                                                    <span class="hidden sm:inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-50 text-yellow-600 rounded-lg text-xs font-semibold"><i class="fas fa-star"></i> Featured</span>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-1 mt-4 text-yellow-400">@for($i = 1; $i <= 5; $i++)<i class="fas fa-star text-xs"></i>@endfor</div>

                                            @if($review->title)<h4 class="font-bold text-dark-900 mt-3">{{ $review->title }}</h4>@endif
                                            <p class="text-sm text-dark-500 leading-7 mt-2">{{ $review->comment }}</p>

                                            @if($review->admin_reply)
                                                <div class="mt-5 p-4 rounded-xl bg-primary/5 border-l-4 border-primary">
                                                    <div class="text-xs font-bold text-primary mb-1"><i class="fas fa-reply me-1"></i> Business Response</div>
                                                    <p class="text-sm text-dark-500 leading-6">{{ $review->admin_reply }}</p>
                                                </div>
                                            @endif

                                            <div class="flex flex-wrap items-center justify-between gap-3 mt-4">
                                                <div class="flex items-center gap-2 text-xs text-dark-400"><i class="far fa-thumbs-up"></i> {{ $review->helpful_count }} people found this helpful</div>
                                                <button type="button" onclick="openReportReviewModal({{ $review->id }})" class="inline-flex items-center gap-2 text-xs font-semibold text-dark-400 hover:text-red-500 transition-colors">
                                                    <i class="fas fa-flag"></i> Report Review
                                                </button>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                {{ $emptyBox('far fa-star', 'No reviews yet', 'Be the first person to review this business.') }}
                            @endif
                        </div>
                    </div>
                </div>

                {{-- CONTACT --}}
                <div class="business-tab-panel" data-panel="contact">
                    <div class="space-y-8">
                        <div class="{{ $card }}" data-aos="fade-up">
                            <div class="mb-6">{{ $head('fas fa-address-card', 'Contact', 'Contact Information') }}</div>
                            <div class="space-y-3">
                                @foreach($contactItems as [$href, $icon, $label, $value, $valueClass, $external])
                                    @if($value)
                                        <a href="{{ $href }}" @if($external) target="_blank" rel="noopener noreferrer" @endif class="flex items-center gap-4 p-4 rounded-xl bg-dark-50 hover:bg-primary/5 transition-all">
                                            <div class="w-11 h-11 rounded-xl bg-white flex items-center justify-center"><i class="{{ $icon }} text-primary"></i></div>
                                            <div>
                                                <p class="text-xs text-dark-400">{{ $label }}</p>
                                                <p class="text-sm font-semibold text-dark-900 {{ $valueClass }}">{{ $value }}</p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== SIDEBAR ===== --}}
            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-24 space-y-6">

                    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm" data-aos="fade-left">
                        <h3 class="text-xl font-bold text-dark-900">Connect with Business</h3>
                        <p class="text-sm text-dark-400 mt-1 mb-6">Contact {{ $business->name }} directly.</p>

                        <div class="space-y-3">
                            @if($business->phone)
                                <a href="tel:{{ $business->phone }}" class="{{ $side }} bg-primary hover:bg-primary-dark text-white"><i class="fas fa-phone"></i> Call Business</a>
                            @endif
                            <a href="{{ route('bookings.create', $business) }}" class="{{ $side }} bg-primary hover:bg-primary-dark text-white"><i class="fas fa-calendar-check"></i> Book Appointment</a>
                            @if($business->email)
                                <a href="mailto:{{ $business->email }}" class="{{ $side }} bg-dark-50 hover:bg-primary/5 text-dark-900"><i class="fas fa-envelope text-primary"></i> Send Email</a>
                            @endif
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" rel="noopener noreferrer" class="{{ $side }} border border-gray-200 hover:border-primary hover:text-primary text-dark-900"><i class="fas fa-globe"></i> Visit Website</a>
                            @endif
                            <button type="button" onclick="shareBusiness()" class="{{ $side }} border border-gray-200 hover:border-primary hover:text-primary text-dark-900"><i class="fas fa-share-nodes"></i> Share Business</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm" data-aos="fade-left">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-dark-900">{{ number_format((float) $business->rating, 1) }}</div>
                            <div class="flex justify-center gap-1 mt-2 text-yellow-400">@for($i = 1; $i <= 5; $i++)<i class="fas fa-star text-sm"></i>@endfor</div>
                            <p class="text-sm text-dark-400 mt-2">Based on {{ $business->reviews_count }} reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= ENQUIRY CTA ================= --}}
<section class="py-16 bg-primary relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full border-[50px] border-white"></div>
        <div class="absolute -bottom-40 -left-20 w-96 h-96 rounded-full border-[60px] border-white"></div>
    </div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8" data-aos="fade-up">
            <div class="text-center md:text-left">
                <span class="text-white/70 text-sm font-semibold uppercase tracking-wider">Need more information?</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-white mt-2">Get in touch with {{ $business->name }}</h2>
                <p class="text-white/75 mt-3 max-w-xl">Contact the business directly for services, pricing, availability or any other enquiry.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-3 shrink-0">
                @if($business->phone)
                    <a href="tel:{{ $business->phone }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-white text-primary hover:bg-white/90 font-bold rounded-xl transition-all shadow-xl"><i class="fas fa-phone"></i> Call Now</a>
                @endif
                @if($business->email)
                    <a href="mailto:{{ $business->email }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-black/15 hover:bg-black/25 text-white font-bold rounded-xl transition-all border border-white/20"><i class="fas fa-envelope"></i> Email</a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ================= RELATED BUSINESSES ================= --}}
@if(isset($relatedBusinesses) && $relatedBusinesses->count())
<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-semibold text-primary uppercase tracking-wider">You may also like</span>
                <h2 class="text-3xl font-bold text-dark-900 mt-1">Related Businesses</h2>
            </div>
            <a href="{{ route('businesses.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary">View All <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedBusinesses as $related)
                <a href="{{ route('businesses.show', $related->slug) }}" class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="relative h-48 bg-dark-50 overflow-hidden">
                        @if($related->cover_image)
                            <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center"><i class="fas fa-building text-4xl text-gray-300"></i></div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="font-bold text-dark-900 group-hover:text-primary transition-colors truncate">{{ $related->name }}</h3>
                            <span class="shrink-0 text-sm font-semibold text-dark-700"><i class="fas fa-star text-yellow-400"></i> {{ number_format((float) $related->rating, 1) }}</span>
                        </div>
                        @if($related->category)<p class="text-xs text-primary mt-2">{{ $related->category->name }}</p>@endif
                        @if($related->city)<p class="text-sm text-dark-400 mt-2"><i class="fas fa-location-dot me-1"></i> {{ $related->city->name }}</p>@endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ================= GALLERY MODAL ================= --}}
@if($hasPhotos)
<div id="galleryModal" class="fixed inset-0 z-[9999] hidden bg-black/95 p-4 sm:p-8">
    <button type="button" onclick="closeGallery()" class="absolute top-5 right-5 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center"><i class="fas fa-times"></i></button>
    <div class="w-full h-full flex items-center justify-center">
        <button type="button" onclick="previousImage()" class="absolute left-3 sm:left-8 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center"><i class="fas fa-chevron-left"></i></button>
        <div class="max-w-5xl max-h-[85vh] text-center">
            <img id="galleryMainImage" src="" alt="{{ $business->name }}" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-2xl mx-auto">
            <p id="galleryCaption" class="text-white/70 text-sm mt-4"></p>
        </div>
        <button type="button" onclick="nextImage()" class="absolute right-3 sm:right-8 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>
@endif

{{-- ================= SUCCESS MESSAGE ================= --}}
@if(session('success'))
    <div id="reportSuccessMessage" class="fixed top-5 right-5 z-[20000] flex items-center gap-3 max-w-md rounded-xl bg-green-600 px-5 py-4 text-white shadow-2xl">
        <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-check"></i></div>
        <div class="flex-1">
            <p class="font-semibold text-sm">Success</p>
            <p class="text-sm text-white/90 mt-0.5">{{ session('success') }}</p>
        </div>
        <button type="button" onclick="document.getElementById('reportSuccessMessage')?.remove()" class="text-white/80 hover:text-white"><i class="fas fa-times"></i></button>
    </div>
@endif

{{-- ================= REPORT REVIEW MODAL ================= --}}
<div id="reportReviewModal" class="fixed inset-0 z-[10000] hidden bg-black/60 backdrop-blur-sm p-4">
    <div class="min-h-full flex items-center justify-center">
        <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between gap-4 p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-xl font-bold text-dark-900">Report Review</h3>
                    <p class="text-sm text-dark-400 mt-1">Tell us why you are reporting this review.</p>
                </div>
                <button type="button" onclick="closeReportReviewModal()" class="w-10 h-10 rounded-xl bg-dark-50 hover:bg-gray-100 text-dark-500 flex items-center justify-center transition-all"><i class="fas fa-times"></i></button>
            </div>

            <form id="reportReviewForm" method="POST" action="">
                @csrf
                <div class="p-6">
                    <div>
                        <label for="report_reason" class="block text-sm font-semibold text-dark-900 mb-2">Reason <span class="text-red-500">*</span></label>
                        <select id="report_reason" name="reason" required class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-dark-900 focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                            <option value="">Select a reason</option>
                            @foreach(['Spam or fake content', 'Offensive or inappropriate content', 'False or misleading information', 'Personal information', 'Other'] as $reason)
                                <option value="{{ $reason }}">{{ $reason }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-5">
                        <label for="report_message" class="block text-sm font-semibold text-dark-900 mb-2">Additional details</label>
                        <textarea id="report_message" name="message" rows="4" maxlength="2000" placeholder="Add any additional information..." class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-dark-900 focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none resize-none"></textarea>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 p-6 pt-0">
                    <button type="button" onclick="closeReportReviewModal()" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-dark-50 hover:bg-gray-100 text-dark-700 font-semibold text-sm transition-all">Cancel</button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold text-sm transition-all"><i class="fas fa-flag"></i> Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= MOBILE ACTION BAR ================= --}}
<div class="fixed bottom-0 left-0 right-0 z-50 lg:hidden bg-white border-t border-gray-200 shadow-2xl">
    <div class="grid grid-cols-3 gap-1 p-2">
        @if($business->phone)
            <a href="tel:{{ $business->phone }}" class="flex flex-col items-center justify-center gap-1 py-2 text-primary"><i class="fas fa-phone"></i><span class="text-[11px] font-semibold">Call</span></a>
        @else
            <button type="button" onclick="shareBusiness()" class="flex flex-col items-center justify-center gap-1 py-2 text-dark-500"><i class="fas fa-share-nodes"></i><span class="text-[11px] font-semibold">Share</span></button>
        @endif
        <button type="button" onclick="activateBusinessTab('reviews')" class="flex flex-col items-center justify-center gap-1 py-2 text-dark-500"><i class="fas fa-star"></i><span class="text-[11px] font-semibold">Reviews</span></button>
        <button type="button" onclick="shareBusiness()" class="flex flex-col items-center justify-center gap-1 py-2 text-dark-500"><i class="fas fa-share-nodes"></i><span class="text-[11px] font-semibold">Share</span></button>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
const $id = (id) => document.getElementById(id);
const lockBody = (lock) => document.body.classList.toggle('overflow-hidden', lock);

/* ---------- Tabs ---------- */
function activateBusinessTab(target) {
    const tabs = document.querySelectorAll('.business-tab');
    const panels = document.querySelectorAll('.business-tab-panel');
    if (!tabs.length || !panels.length) return;

    const exists = [...tabs].some(t => t.dataset.tab === target);
    tabs.forEach(t => t.classList.toggle('active', t.dataset.tab === target));
    panels.forEach(p => p.classList.toggle('active', exists && p.dataset.panel === target));

    // keep active tab visible in the nav (no page scroll)
    const active = document.querySelector('.business-tab[data-tab="' + target + '"]');
    const nav = $id('businessTabs');
    if (active && nav) {
        const left = active.offsetLeft, right = left + active.offsetWidth;
        if (left < nav.scrollLeft) nav.scrollLeft = left - 20;
        else if (right > nav.scrollLeft + nav.clientWidth) nav.scrollLeft = right - nav.clientWidth + 20;
    }
}

/* ---------- Share ---------- */
function shareBusiness() {
    const url = window.location.href;
    if (navigator.share) {
        navigator.share({ title: @json($business->name), text: @json($business->tagline ?: 'Check out this business on Lokora.'), url }).catch(() => {});
    } else if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url)
            .then(() => alert('Business link copied successfully.'))
            .catch(() => prompt('Copy this business link:', url));
    } else {
        prompt('Copy this business link:', url);
    }
}

/* ---------- Favorite ---------- */
function toggleFavorite(button) {
    const icon = button.querySelector('i');
    if (!icon) return;
    const on = icon.classList.contains('far');
    icon.classList.toggle('far', !on);
    icon.classList.toggle('fas', on);
    button.classList.toggle('text-red-500', on);
}

/* ---------- Gallery ---------- */
const galleryImages = @json(
    $business->photos
        ? $business->photos->map(fn ($p) => ['image' => asset('storage/' . $p->image), 'caption' => $p->caption ?: ''])->values()
        : []
);
let currentGalleryIndex = 0;

function updateGalleryImage() {
    if (!galleryImages.length) return;
    const img = galleryImages[currentGalleryIndex];
    if ($id('galleryMainImage')) $id('galleryMainImage').src = img.image;
    if ($id('galleryCaption')) $id('galleryCaption').textContent = img.caption;
}
function openGallery(index = 0) {
    if (!galleryImages.length) return;
    currentGalleryIndex = index;
    updateGalleryImage();
    if ($id('galleryModal')) { $id('galleryModal').classList.remove('hidden'); lockBody(true); }
}
function closeGallery() {
    if ($id('galleryModal')) { $id('galleryModal').classList.add('hidden'); lockBody(false); }
}
function nextImage() {
    if (!galleryImages.length) return;
    currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
    updateGalleryImage();
}
function previousImage() {
    if (!galleryImages.length) return;
    currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
    updateGalleryImage();
}

/* ---------- Copy offer code ---------- */
function copyOfferCode(code, button) {
    if (!navigator.clipboard || !navigator.clipboard.writeText) {
        alert('Copy is not supported in this browser.');
        return;
    }
    navigator.clipboard.writeText(code).then(() => {
        const original = button.innerHTML;
        button.innerHTML = '<i class="bi bi-check-lg"></i><span>Copied</span>';
        button.classList.remove('bg-gray-900', 'hover:bg-gray-800');
        button.classList.add('bg-green-600');
        setTimeout(() => {
            button.innerHTML = original;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-gray-900', 'hover:bg-gray-800');
        }, 1800);
    }).catch(() => alert('Unable to copy coupon code.'));
}

/* ---------- Report review ---------- */
function openReportReviewModal(reviewId) {
    const modal = $id('reportReviewModal'), form = $id('reportReviewForm');
    if (!modal || !form) return;
    form.action = "{{ url('/reviews') }}/" + reviewId + "/report";
    form.reset();
    modal.classList.remove('hidden');
    lockBody(true);
}
function closeReportReviewModal() {
    const modal = $id('reportReviewModal');
    if (!modal) return;
    modal.classList.add('hidden');
    lockBody(false);
}

/* ---------- Review modal ---------- */
function openReviewModal() {
    const modal = $id('reviewModal'), content = $id('reviewModalContent');
    if (!modal || !content) return;
    modal.classList.remove('hidden');
    lockBody(true);
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 20);
}
function closeReviewModal() {
    const modal = $id('reviewModal'), content = $id('reviewModalContent');
    if (!modal || !content) return;
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); lockBody(false); }, 250);
}

/* ---------- Global keyboard + backdrop handlers ---------- */
document.addEventListener('keydown', (e) => {
    const gallery = $id('galleryModal'), report = $id('reportReviewModal');
    if (e.key === 'Escape') {
        if (gallery && !gallery.classList.contains('hidden')) closeGallery();
        if (report && !report.classList.contains('hidden')) closeReportReviewModal();
        closeReviewModal();
    }
    if (gallery && !gallery.classList.contains('hidden')) {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
    }
});
document.addEventListener('click', (e) => {
    if (e.target === $id('galleryModal')) closeGallery();
    if (e.target === $id('reportReviewModal')) closeReportReviewModal();
});

/* ---------- Init ---------- */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.business-tab').forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            activateBusinessTab(this.dataset.tab);
        });
    });
    activateBusinessTab('overview');

    /* Star rating */
    const stars = document.querySelectorAll('.review-star');
    const ratingInput = $id('reviewRatingInput');
    const ratingText = $id('ratingText');
    if (stars.length && ratingInput) {
        const labels = { 1: 'Poor', 2: 'Fair', 3: 'Good', 4: 'Very Good', 5: 'Excellent' };

        const updateStars = (rating) => {
            stars.forEach(s => {
                const on = parseInt(s.dataset.rating) <= rating;
                s.classList.toggle('bg-yellow-50', on);
                s.classList.toggle('text-yellow-400', on);
                s.classList.toggle('bg-gray-100', !on);
                s.classList.toggle('text-gray-300', !on);
            });
            if (ratingText) {
                ratingText.textContent = labels[rating] || 'Select a rating';
                ratingText.classList.toggle('text-yellow-500', !!labels[rating]);
                ratingText.classList.toggle('text-dark-400', !labels[rating]);
            }
        };

        stars.forEach(s => {
            s.addEventListener('mouseenter', () => updateStars(parseInt(s.dataset.rating)));
            s.addEventListener('click', () => { ratingInput.value = parseInt(s.dataset.rating); updateStars(parseInt(s.dataset.rating)); });
        });
        if ($id('reviewStarRating')) {
            $id('reviewStarRating').addEventListener('mouseleave', () => updateStars(parseInt(ratingInput.value) || 0));
        }
        updateStars(parseInt(ratingInput.value) || 0); // restore old value after validation error
    }

    /* Character counter */
    const comment = $id('review_comment'), charCount = $id('reviewCharCount');
    if (comment && charCount) {
        const update = () => { charCount.textContent = comment.value.length + ' / 5000'; };
        comment.addEventListener('input', update);
        update();
    }

    @if($errors->any())
        openReviewModal();
    @endif
});

/* ---------- Auto-hide success message ---------- */
setTimeout(() => $id('reportSuccessMessage')?.remove(), 4000);
</script>

{{-- ================= CSS ================= --}}
<style>
.business-tabs-wrapper { top: 0; z-index: 1000; background: rgba(255,255,255,.97); border-bottom: 1px solid #e5e7eb; box-shadow: 0 4px 18px rgba(15,23,42,.06); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); }
.business-tabs { display: flex; align-items: center; gap: 2px; min-height: 68px; overflow-x: auto; overflow-y: hidden; scrollbar-width: none; -webkit-overflow-scrolling: touch; }
.business-tabs::-webkit-scrollbar { display: none; }
.business-tab { position: relative; flex: 0 0 auto; display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 68px; padding: 0 18px; border: 0; outline: none; background: transparent; color: #64748b; font-size: 14px; font-weight: 600; white-space: nowrap; cursor: pointer; transition: color .25s ease, background .25s ease; }
.business-tab i { font-size: 14px; transition: transform .25s ease; }
.business-tab:hover, .business-tab.active { color: #fc3c3c; }
.business-tab:hover i { transform: translateY(-1px); }
.business-tab.active::after { content: ""; position: absolute; left: 14px; right: 14px; bottom: 0; height: 3px; border-radius: 999px 999px 0 0; background: #fc3c3c; }
.business-tab-panel { display: none; width: 100%; }
.business-tab-panel.active { display: block; animation: businessTabFade .25s ease; }
@keyframes businessTabFade { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

@media (max-width: 640px) {
    .business-tabs { min-height: 60px; gap: 0; }
    .business-tab { min-height: 60px; padding: 0 14px; font-size: 13px; gap: 7px; }
    .business-tab i { font-size: 13px; }
    .business-tab.active::after { left: 10px; right: 10px; }
}
@media (max-width: 1023px) { body { padding-bottom: 72px; } }
</style>
@endsection
