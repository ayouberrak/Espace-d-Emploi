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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Offer Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
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
                                {{ count($candidates) }} Candidats
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
        </div>

        <!-- Right Column: Candidates List -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-24">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center justify-between">
                    Candidatures
                    <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-md">{{ count($candidates) }}</span>
                </h2>

                <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($candidates as $candidate)
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 hover:border-indigo-100 hover:bg-indigo-50/30 transition-all group">
                            <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                @if($candidate->photo)
                                    <img src="{{ Str::startsWith($candidate->photo, 'http') ? $candidate->photo : asset('storage/' . $candidate->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-600 font-bold text-lg">
                                        {{ substr($candidate->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow min-w-0">
                                <h4 class="font-bold text-slate-900 truncate">{{ $candidate->name }}</h4>
                                <p class="text-xs text-slate-500 truncate">{{ $candidate->profile->title ?? 'Développeur' }}</p>
                                <div class="flex gap-2 mt-2">
                                    <a href="{{ route('profile', $candidate->id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-white border border-indigo-100 px-3 py-1 rounded-md shadow-sm">
                                        Voir Profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <p class="text-sm text-slate-500 font-medium">Aucun candidat pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
