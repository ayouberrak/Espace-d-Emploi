@extends('layouts.app')

@section('title', 'Détails de l\'Offre - ' . $offer->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('mesoffres') }}" class="flex items-center text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Retour à mes offres
        </a>
    </div>

    <!-- Offer Details Section (Full Width) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-12">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-slate-900 font-outfit mb-2">{{ $offer->title }}</h1>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-indigo-50 text-indigo-700 font-bold px-3 py-1 rounded-full text-sm">{{ $offer->ofres_type }}</span>
                    <span class="bg-slate-50 text-slate-600 font-medium px-3 py-1 rounded-full text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $offer->durre }}
                    </span>
                    <span class="bg-emerald-50 text-emerald-700 font-bold px-3 py-1 rounded-full text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        {{ $offer->applicants_count }} Candidats
                    </span>
                </div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none text-slate-600">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Description du poste</h3>
            <p class="whitespace-pre-line leading-relaxed">{{ $offer->description }}</p>

            <h3 class="text-lg font-bold text-slate-900 mt-6 mb-2">Compétences requises</h3>
            <div class="flex flex-wrap gap-2 not-prose">
                @foreach($offer->competences ?? [] as $skill)
                    <span class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg font-bold text-sm">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Candidates Section (Full Width) -->
    <div class="mt-12">
        <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center gap-3">
            Candidatures
            <span class="bg-indigo-600 text-white text-sm font-bold px-3 py-1 rounded-full">{{ $offer->applicants_count }}</span>
        </h2>

        <!-- Grid Layout for Candidates -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- AI Candidates -->
            @foreach($applications as $app)
            <div class="bg-white border border-slate-200 rounded-xl p-5 hover:border-indigo-300 hover:shadow-lg transition-all group h-full flex flex-col">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 overflow-hidden ring-2 ring-white shrink-0 shadow-sm">
                            @if($app->user->photo)
                                <img src="{{ Str::startsWith($app->user->photo, 'http') ? $app->user->photo : asset('storage/' . $app->user->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-500 font-bold text-lg">
                                    {{ substr($app->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-base line-clamp-1">{{ $app->user->name }}</h4>
                            <p class="text-xs text-slate-500 font-medium">Postulé {{ $app->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end shrink-0">
                        <span class="text-2xl font-black {{ $app->score >= 70 ? 'text-emerald-600' : ($app->score >= 40 ? 'text-amber-500' : 'text-rose-500') }}">
                            {{ $app->score }}%
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Compatibilité</span>
                    </div>
                </div>

                @if($app->ai_analysis)
                    <div class="space-y-3 pt-4 border-t border-slate-100 flex-grow">
                        @if(!empty($app->ai_analysis['details']['missing_skills']))
                            <div>
                                <p class="text-xs font-bold text-rose-500 uppercase tracking-wider mb-1.5">Manque</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(array_slice($app->ai_analysis['details']['missing_skills'], 0, 3) as $skill)
                                        <span class="px-2 py-0.5 bg-rose-50 text-rose-700 text-xs rounded font-medium border border-rose-100">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        @if(!empty($app->ai_analysis['details']['strengths']))
                            <div>
                                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1.5">Points Forts</p>
                                <ul class="space-y-1">
                                    @foreach(array_slice($app->ai_analysis['details']['strengths'], 0, 3) as $strength)
                                        <li class="text-xs text-slate-600 leading-snug pl-2 border-l-2 border-emerald-200">
                                            {{ Str::limit($strength, 50) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif
                
                <div class="mt-5 pt-3 border-t border-slate-50 flex gap-2">
                    <a href="{{ route('profile', $app->user->id) }}" class="flex-grow flex items-center justify-center py-2.5 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-indigo-600 transition-colors shadow-sm hover:shadow-indigo-500/30">
                        Voir le Profil Complet
                    </a>
                    <a href="{{ route('user.cv', $app->user->id) }}" class="flex items-center justify-center px-3 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors border border-indigo-100" title="Télécharger le CV">
                         <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Legacy Candidates -->
            @foreach($legacyCandidates as $candidate)
            <div class="bg-white border border-slate-100 rounded-xl p-5 hover:bg-slate-50 transition-all h-full flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden shrink-0">
                        @if($candidate->photo)
                            <img src="{{ Str::startsWith($candidate->photo, 'http') ? $candidate->photo : asset('storage/' . $candidate->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-300 text-slate-600 font-bold text-lg">
                                {{ substr($candidate->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base line-clamp-1">{{ $candidate->name }}</h4>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Candidat (Legacy)</span>
                    </div>
                </div>
                <div class="mt-auto flex gap-2">
                    <a href="{{ route('profile', $candidate->id) }}" class="flex-grow block text-center text-xs font-bold text-indigo-600 border border-indigo-100 hover:bg-indigo-50 py-2 rounded-lg transition-colors">
                        Voir Profil
                    </a>
                     <a href="{{ route('user.cv', $candidate->id) }}" class="flex items-center justify-center px-3 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors border border-indigo-100" title="Télécharger le CV">
                         <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($applications->count() == 0 && count($legacyCandidates) == 0)
            <div class="bg-slate-50 border border-dashed border-slate-200 rounded-xl p-12 text-center mt-6">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <h3 class="text-slate-900 font-bold">Aucune candidature pour le moment</h3>
                <p class="text-slate-500 text-sm mt-1">Les profils apparaîtront ici dès qu'ils postuleront.</p>
            </div>
        @endif
    </div>
</div>
@endsection
