@extends('layouts.app')

@section('content')
<div class="space-y-32">
    <!-- Header -->
    <div class="max-w-3xl">
        <h1 class="text-6xl lg:text-8xl font-black tracking-tighter leading-none mb-8">
            GAME <br> <span class="nadi-text-gradient">CHANGERS.</span>
        </h1>
        <p class="text-xl text-white/40 font-bold max-w-xl leading-relaxed">
            Join the companies that are defining the next era of digital existence.
        </p>
    </div>

    <!-- Jobs/Companies List -->
    <div class="space-y-8">
        @foreach($recruiters as $recruiter)
            <div class="nadi-glass-card group p-10 lg:p-16 flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="flex items-center gap-12">
                    <div class="w-24 h-24 bg-white/5 rounded-3xl flex items-center justify-center border border-white/10 group-hover:border-pink-500/50 transition-colors shadow-2xl">
                        <img src="{{ $recruiter['logo'] }}" class="w-14 h-14 object-contain" alt="">
                    </div>
                    <div>
                        <h3 class="text-4xl font-black tracking-tight mb-2 group-hover:text-pink-400 transition-colors">{{ $recruiter['name'] }}</h3>
                        <div class="flex items-center gap-4">
                            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em]">{{ $recruiter['industry'] }}</span>
                            <div class="w-1.5 h-1.5 rounded-full bg-white/20"></div>
                            <span class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em]">GLOBAL HQ</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-20">
                    <div class="hidden lg:block space-y-2">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em]">Opportunities</p>
                        <p class="text-4xl font-black tracking-tighter nadi-text-gradient">{{ $recruiter['jobs'] }}</p>
                    </div>
                    <div class="hidden lg:block space-y-2">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em]">Nadi Rating</p>
                        <div class="flex text-pink-500 text-lg items-center gap-2 font-black">
                            <i class="fa-solid fa-star text-sm"></i> 4.9
                        </div>
                    </div>
                </div>

                <button class="btn-ultimate-nadi px-16 py-5">Apply</button>
            </div>
        @endforeach
    </div>

    <!-- Bottom Action -->
    <div class="pt-32 text-center space-y-12">
        <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.5em]">TRUSTED BY LEADERS</p>
        <div class="flex flex-wrap justify-center gap-20 opacity-30 grayscale group">
            <img src="https://logo.clearbit.com/stripe.com" class="h-8 group-hover:grayscale-0 transition-all duration-700" alt="">
            <img src="https://logo.clearbit.com/airbnb.com" class="h-8 group-hover:grayscale-0 transition-all duration-700 delay-75" alt="">
            <img src="https://logo.clearbit.com/spotify.com" class="h-8 group-hover:grayscale-0 transition-all duration-700 delay-100" alt="">
            <img src="https://logo.clearbit.com/notion.so" class="h-8 group-hover:grayscale-0 transition-all duration-700 delay-150" alt="">
        </div>
    </div>
</div>
@endsection
