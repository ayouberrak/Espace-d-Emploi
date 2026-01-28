@extends('layouts.app')

@section('title', 'Dashboard - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    
    <!-- Hero Section -->
    <div class="text-center max-w-2xl mx-auto mb-20">
        <h1 class="text-5xl md:text-6xl font-black text-slate-900 font-outfit mb-6 tracking-tight leading-tight">
            Découvrez l'<span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-600">Excellence.</span>
        </h1>
        <!-- <p>Role: {{ session('role') }}</p>
        <p>User ID: {{ session('user_id') }}</p> -->

        <p class="text-lg text-slate-500 mb-10 font-medium">Rejoignez un réseau exclusif de talents et d'entreprises visionnaires.</p>

        <!-- Search Bar -->
        <form action="{{ route('dashboard') }}" method="GET" class="relative group max-w-lg mx-auto">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-primary-200 to-indigo-200 rounded-full opacity-50 blur transition duration-1000 group-hover:opacity-100 group-hover:duration-200"></div>
            <div class="relative flex items-center bg-white rounded-full p-2 pr-3 shadow-xl shadow-slate-200/50">
                <div class="pl-6 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" name="search"  placeholder="Rechercher..." class="flex-grow bg-transparent border-none py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:ring-0 font-semibold outline-none">
                <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-primary-600 transition-colors">Go</button>
            </div>
        </form>
    </div>

    <!-- Content Grid -->
    <div>
        @if(count($users) > 0)
            <div class="flex items-center justify-between mb-8 px-2">
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Talents Récents</h2>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ count($users) }} profils</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($users as $user)
                    <div class="group bg-white rounded-[2rem] border border-slate-100 p-6 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:border-slate-200 transition-all duration-300 relative flex flex-col items-center text-center">
                        
                        <!-- Role Badge -->
                        <div class="absolute top-6 right-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $user['role'] === 'recruiter' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-primary-50 text-primary-600 border border-primary-100' }}">
                                {{ $user['role'] === 'recruiter' ? 'Recruteur' : 'Talent' }}
                            </span>
                        </div>

                        <!-- Avatar -->
                        <div class="relative w-24 h-24 mb-6 transition-transform duration-500 group-hover:scale-105">
                            <div class="w-full h-full rounded-[1.8rem] overflow-hidden shadow-lg ring-1 ring-slate-900/5">
                                @if($user['avatar'])
                                    <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-slate-50 flex items-center justify-center font-black text-slate-300 text-2xl uppercase">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <!-- Pro Badge Indicator -->
                            <div class="absolute -bottom-2 -right-2 bg-white rounded-full p-1 shadow-sm border border-slate-50">
                                <div class="bg-green-500 w-3 h-3 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Info -->
                        <h3 class="text-lg font-black text-slate-900 mb-1 font-outfit">{{ $user['name'] }}</h3>
                        <p class="text-sm font-bold text-slate-500 mb-4">{{ $user['specialty'] }}</p>
                        
                        <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2 px-2 mb-6">
                            {{ $user['bio'] }}
                        </p>

                        <!-- Skills / Tags -->
                        <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                            @if(isset($user['skills']) && is_array($user['skills']))
                                @foreach(array_slice($user['skills'], 0, 3) as $skill)
                                    <span class="px-2 py-1 bg-slate-50 border border-slate-100 rounded-lg text-[10px] font-bold text-slate-500 uppercase tracking-wide group-hover:bg-white group-hover:shadow-sm transition-all">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Action -->
                        <div class="w-full flex flex-col gap-3 mt-auto">
                            <a href="{{ route('profile', $user['id']) }}"
                               class="w-full bg-slate-50 text-slate-900 font-bold py-3 rounded-xl text-xs uppercase tracking-wider hover:bg-slate-900 hover:text-white transition-all text-center">
                                Voir le profil
                            </a>

                        <form action="{{ route('inviStore', $user['id']) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider hover:bg-slate-700 transition-all text-center">
                                Se connecter
                            </button>
                        </form>

                            
                        </div>


                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-24 bg-white/50 border border-dashed border-slate-200 rounded-[2.5rem]">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Aucun résultat</h3>
                <p class="text-slate-500 text-sm mt-1">Essayez une autre recherche.</p>
            </div>
        @endif
    </div>
</div>
@endsection
