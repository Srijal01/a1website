@extends('layouts.app')

@section('meta_title', 'Technologies - ' . config('app.name'))
@section('meta_description', 'Explore the cutting-edge technologies we use to build robust and scalable solutions.')

@section('content')
<section class="bg-gradient-to-br from-blue-600 to-indigo-800 pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold text-white">Technologies</h1>
        <p class="mt-4 text-blue-100 text-lg max-w-2xl mx-auto">We work with the latest and most reliable technologies in the industry.</p>
    </div>
</section>

<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @forelse ($categories as $category => $techs)
            <div class="mb-12 last:mb-0">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $category ?: 'Other' }}</h2>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-6">
                    @foreach ($techs as $tech)
                        <div class="flex flex-col items-center gap-3 p-5 bg-gray-50 rounded-xl hover:shadow-md hover:-translate-y-1 transition-all">
                            @if ($tech->logo)
                                <img src="{{ asset($tech->logo) }}" alt="{{ $tech->name }}" class="h-12 w-auto">
                            @else
                                <div class="h-12 flex items-center text-center text-sm font-semibold text-blue-700">{{ $tech->name }}</div>
                            @endif
                            <span class="text-sm font-medium text-gray-700">{{ $tech->name }}</span>
                            @if ($tech->description)
                                <p class="text-xs text-gray-500 text-center">{{ Str::limit($tech->description, 60) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500">No technologies listed yet.</div>
        @endforelse
    </div>
</section>
@endsection
