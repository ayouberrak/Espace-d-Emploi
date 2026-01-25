@extends('layouts.app')

@section('content')
<div class="space-y-32">
    <!-- Header -->
    <div class="max-w-3xl">
        <h1 class="text-6xl lg:text-8xl font-black tracking-tighter leading-none mb-8">
            ELITE <br> <span class="nadi-text-gradient">NETWORK.</span>
        </h1>
        <p class="text-xl text-white/40 font-bold max-w-xl leading-relaxed">
            Connect with the world's most talented creators and engineers in an immersive NADI environment.
        </p>
    </div>

    <!-- Dev List -->
    <div class="space-y-6">
        @foreach($developers as $dev)
            <div class="nadi-glass-card group p-8 lg:p-12 flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="flex items-center gap-10">
                    <div class="relative">
                        <div class="absolute -inset-2 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-[2.5rem] blur opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <img class="relative h-28 w-28 rounded-[2.5rem] object-cover border-2 border-white/10" src="{{ $dev['photo'] }}" alt="">
                    </div>
                    <div>
                        <h3 class="text-3xl font-black tracking-tight group-hover:text-pink-400 transition-colors">{{ $dev['name'] }}</h3>
                        <p class="text-xs font-black text-white/40 mt-2 uppercase tracking-[0.3em]">{{ $dev['specialty'] }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-16 text-center md:text-left">
                    <div class="hidden lg:block space-y-2">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em]">Status</p>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                            <span class="text-sm font-bold">AVAILABLE</span>
                        </div>
                    </div>
                    <div class="hidden lg:block space-y-2">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em]">Base</p>
                        <p class="text-sm font-bold">CASABLANCA</p>
                    </div>
                </div>

                <a href="{{ route('profile.show', $dev['id']) }}" class="btn-ultimate-nadi px-12">Open Space</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
