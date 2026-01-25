@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-32">
    <!-- Identity Header -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 blur-[120px] -z-10"></div>
        <div class="flex flex-col items-center text-center space-y-12">
            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                <img class="relative h-60 w-60 rounded-full object-cover border-4 border-white shadow-2xl" src="{{ $user['photo'] }}" alt="{{ $user['name'] }}">
                <div class="absolute bottom-4 right-4 w-12 h-12 rounded-2xl bg-black border border-white/20 flex items-center justify-center shadow-2xl">
                    <i class="fa-solid fa-crown text-yellow-400"></i>
                </div>
            </div>
            
            <div class="space-y-6">
                <h1 class="text-6xl lg:text-8xl font-black tracking-tighter">{{ $user['name'] }}</h1>
                <div class="flex flex-wrap justify-center gap-4">
                    <span class="px-6 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 text-sm font-black uppercase tracking-widest">{{ $user['specialty'] ?? 'Talent' }}</span>
                    <span class="px-6 py-2 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-400 text-sm font-black uppercase tracking-widest">NADI MEMBER</span>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                @if($user['id'] == 1)
                    <a href="{{ route('profile.edit') }}" class="btn-ultimate-nadi">Update Space</a>
                @else
                    <form action="{{ route('friends.add', $user['id']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-ultimate-nadi">Connect Profile</button>
                    </form>
                    <button class="px-10 py-4 rounded-2xl bg-white/5 border border-white/10 font-black uppercase tracking-widest text-white hover:bg-white hover:text-black transition-all">Direct Message</button>
                @endif
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        @foreach(['Connections' => '1.2k', 'Views' => '4.8k', 'Posts' => '156', 'Projects' => '42'] as $label => $val)
            <div class="nadi-glass-card p-8 text-center space-y-2">
                <p class="text-3xl font-black">{{ $val }}</p>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <!-- Content Sections -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-24 pt-12">
        <div class="md:col-span-4 space-y-8">
            <div class="space-y-2">
                <h2 class="text-xs font-black uppercase tracking-[0.5em] nadi-text-gradient">Biography</h2>
                <div class="h-1 w-12 bg-gradient-to-r from-indigo-500 to-pink-500"></div>
            </div>
            <p class="text-white/40 text-sm font-black uppercase tracking-widest">Details</p>
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-4 text-sm font-bold">
                    <i class="fa-solid fa-envelope text-pink-500"></i>
                    <span>{{ $user['email'] }}</span>
                </div>
                <div class="flex items-center gap-4 text-sm font-bold">
                    <i class="fa-solid fa-location-dot text-indigo-500"></i>
                    <span>Casablanca, MA</span>
                </div>
                <div class="flex items-center gap-4 text-sm font-bold">
                    <i class="fa-solid fa-briefcase text-purple-500"></i>
                    <span>{{ $user['role'] }}</span>
                </div>
            </div>
        </div>
        
        <div class="md:col-span-8 space-y-16">
            <p class="text-2xl lg:text-4xl font-bold leading-tight text-white/90">
                {{ $user['bio'] }}
            </p>

            <!-- Experience Timeline -->
            <div class="space-y-12 pt-12 border-t border-white/10">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 border border-indigo-500/40 flex items-center justify-center text-indigo-400">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black">Lead Software Architect</h3>
                        <p class="text-sm font-bold text-white/40 uppercase tracking-widest">Google • 2022 — Present</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/20 border border-purple-500/40 flex items-center justify-center text-purple-400">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black">Senior UX Designer</h3>
                        <p class="text-sm font-bold text-white/40 uppercase tracking-widest">Adobe • 2021 — 2022</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
