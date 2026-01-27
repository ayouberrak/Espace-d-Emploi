@extends('layouts.app')

@section('title', $user->name . ' - Profil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-slate-50 min-h-screen">
    
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 auto-rows-min">
        
        <div class="md:col-span-2 lg:col-span-2 row-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute inset-x-0 h-40 bg-gradient-to-r from-slate-100 to-white top-0"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <div class="w-40 h-40 rounded-[2.5rem] p-1.5 bg-white shadow-xl rotate-0 group-hover:rotate-2 transition-all duration-500 mb-6">
                    <div class="w-full h-full rounded-[2rem] overflow-hidden bg-slate-50 relative">
                        @if($user->photo)
                            <img src="{{ $user->photo }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-slate-300 text-5xl uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <h1 class="text-3xl font-black text-slate-900 font-outfit mb-2">{{ $user->name }}</h1>
                
                @if($user->profile && $user->profile->title)
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-50 rounded-full border border-slate-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600">{{ $user->profile->title }}</span>
                </div>
                @endif
                
                <p class="text-slate-500 font-medium leading-relaxed max-w-sm mx-auto mb-8">
                    {{ $user->profile->bio ?? $user->bio ?? 'Aucune bio disponible.' }}
                </p>

                <div class="flex gap-3">
                    <button class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-xl shadow-slate-900/10 hover:shadow-slate-900/20 hover:-translate-y-1 transition-all active:scale-95">
                        Contacter
                    </button>
                    @if($isMe ?? false)
                    <button class="bg-white border border-slate-200 text-slate-900 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">
                        Modifier
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group flex flex-col justify-center">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/20 blur-3xl rounded-full group-hover:bg-indigo-500/30 transition-colors"></div>
            
            <h3 class="font-black font-outfit text-lg mb-6 flex items-center justify-between z-10">
                Compétences
            </h3>
            
            <div class="flex flex-wrap gap-2 z-10">
                @if($user->profile && $user->profile->skills)
                    {{-- Kan-supposé anna skills deja casté l array f Model, sinon zid json_decode --}}
                    @foreach($user->profile->skills as $skill)
                    <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10 text-xs font-bold hover:bg-white/20 transition-colors cursor-default">
                        {{ $skill }}
                    </span>
                    @endforeach
                @else
                    <span class="text-slate-500 text-sm">Aucune compétence ajoutée</span>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm flex flex-col justify-between group">
            
            <div>
                <h3 class="font-black font-outfit text-slate-400 text-[10px] uppercase tracking-widest mb-4">Contact</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-900 truncate">{{ $user->email }}</p>
                    </div>

                    @if($user->phone)
                    <div class="flex items-center gap-3">
                         <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-900">{{ $user->phone }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 grid grid-cols-2 gap-4">
                <div>
                    <span class="block text-2xl font-black text-slate-900">
                        {{ is_array($user->amis) ? count($user->amis) : 0 }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Amis</span>
                </div>
                <div>
                    <span class="block text-2xl font-black text-slate-900">
                        {{ $user->created_at->format('Y') }}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Membre</span>
                </div>
            </div>
        </div>

        <div class="md:col-span-3 lg:col-span-4 mt-4">
            <h2 class="text-2xl font-black text-slate-900 font-outfit mb-6 px-2 flex items-center gap-4">
                Projets Réalisés
                <span class="h-px bg-slate-200 flex-grow"></span>
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($user->profile && $user->profile->projects)
                    @foreach($user->profile->projects as $project)
                    <div class="group relative rounded-[2rem] overflow-hidden aspect-[4/3] cursor-pointer bg-slate-100">
                        {{-- Vérification que l'image existe sinon placeholder --}}
                        <img src="{{ $project['image'] ?? 'https://via.placeholder.com/400x300' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <span class="text-indigo-400 text-xs font-black uppercase tracking-widest mb-1 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                {{ $project['category'] ?? 'Projet' }}
                            </span>
                            <h3 class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                                {{ $project['title'] ?? 'Sans titre' }}
                            </h3>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-slate-400 italic pl-2">Aucun projet à afficher pour le moment.</p>
                @endif
            </div>
        </div>

        <div class="md:col-span-3 lg:col-span-4 bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-200 shadow-sm mt-4">
            <h3 class="font-black font-outfit text-xl mb-8 flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center text-sm">💼</span>
                Expérience Professionnelle
            </h3>
            
            <div class="relative pl-4 border-l-2 border-slate-100 space-y-10">
                @if($user->profile && $user->profile->experiances)
                    @foreach($user->profile->experiances as $exp)
                    <div class="relative pl-8 group">
                        <div class="absolute -left-[23px] top-1.5 w-4 h-4 bg-white border-4 border-slate-200 rounded-full group-hover:border-indigo-500 transition-colors"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                            <h4 class="text-lg font-bold text-slate-900">{{ $exp['role'] ?? 'Poste' }}</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-50 text-xs font-bold text-slate-500 border border-slate-100 whitespace-nowrap">
                                {{ $exp['duration'] ?? 'Date' }}
                            </span>
                        </div>
                        
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-wide mb-3">
                            {{ $exp['company'] ?? 'Entreprise' }}
                        </p>
                        
                        <p class="text-slate-600 leading-relaxed max-w-2xl">
                            {{ $exp['description'] ?? '' }}
                        </p>
                    </div>
                    @endforeach
                @else
                    <p class="text-slate-400 italic pl-8">Aucune expérience renseignée.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection