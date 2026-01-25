@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-32">
    <!-- Header -->
    <div class="text-center space-y-6">
        <h1 class="text-6xl lg:text-9xl font-black tracking-tighter leading-none">
            ALERTS<span class="nadi-text-gradient">.</span>
        </h1>
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-white/30 text-center">System Feed</p>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="nadi-glass-card group p-10 flex items-start gap-10">
                <div class="relative pt-2">
                    <div class="w-2 h-2 rounded-full bg-pink-500 shadow-[0_0_10px_rgba(236,72,153,0.8)] {{ $notification['id'] > 1 ? 'opacity-20' : 'animate-pulse' }}"></div>
                </div>
                
                <div class="flex-grow space-y-6">
                    <p class="text-2xl font-bold leading-tight group-hover:text-pink-400 transition-colors">
                        {{ $notification['message'] }}
                    </p>
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white/30">{{ $notification['created_at'] }}</span>
                        <div class="w-1 h-1 rounded-full bg-white/10"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400">Live Feedback</span>
                    </div>
                    
                    @if($notification['type'] == 'friend_request')
                        <div class="flex gap-4 pt-4">
                            <button class="btn-ultimate-nadi text-[10px] px-8 py-3">Confirm</button>
                            <button class="px-8 py-3 rounded-xl bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Dismiss</button>
                        </div>
                    @endif
                </div>

                <button class="opacity-10 group-hover:opacity-100 transition-opacity">
                    <i class="fa-solid fa-bolt-lightning text-white hover:text-pink-500"></i>
                </button>
            </div>
        @empty
            <div class="py-60 text-center space-y-8 nadi-glass-card border-dashed">
                <div class="text-[100px] opacity-10 font-black">∅</div>
                <p class="text-sm font-black text-white/40 uppercase tracking-[0.5em]">System is quiet</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
