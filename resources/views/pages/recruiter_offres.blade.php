@extends('layouts.app')

@section('title', 'Mes Offres - ' . $recruiter->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Top Section: Profile & Enterprise -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        
        <!-- Recruiter Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-indigo-500 to-violet-500"></div>
                <div class="relative pt-12 text-center">
                    <div class="w-24 h-24 mx-auto rounded-full border-4 border-white shadow-md overflow-hidden bg-white">
                         @if($recruiter->photo)
                            <img src="{{ Str::startsWith($recruiter->photo, 'http') ? $recruiter->photo : asset('storage/' . $recruiter->photo) }}" class="w-full h-full object-cover" alt="{{ $recruiter->name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($recruiter->name) }}&color=7F9CF5&background=EBF4FF" class="w-full h-full object-cover" alt="{{ $recruiter->name }}">
                        @endif
                    </div>
                    <h2 class="mt-4 text-xl font-bold text-slate-900">{{ $recruiter->name }}</h2>
                    <p class="text-sm text-slate-500 font-medium bg-indigo-50 text-indigo-700 py-1 px-3 rounded-full inline-block mt-2">Recruteur</p>
                    <p class="mt-4 text-slate-600 text-sm leading-relaxed">{{ $recruiter->bio ?? 'Aucune biographie disponible.' }}</p>
                    
                    <div class="mt-6 pt-6 border-t border-slate-100 grid grid-cols-1 gap-4 text-left">
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                             <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            {{ $recruiter->email }}
                        </div>
                        @if($recruiter->phone)
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                             <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $recruiter->phone }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Enterprise Info Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 h-full flex flex-col justify-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                     <svg class="w-64 h-64 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                </div>

                @if($entreprise)
                    <div class="relative z-10 flex items-start gap-6">
                        <div class="w-24 h-24 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-2 shadow-sm shrink-0">
                             @if($entreprise->logo)
                                <img src="{{ Str::startsWith($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" class="w-full h-full object-contain" alt="{{ $entreprise->nom }}">
                            @else
                                <span class="text-3xl font-bold text-indigo-600">{{ substr($entreprise->nom, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">{{ $entreprise->nom }}</h2>
                            <div class="flex items-center gap-2 mt-2 text-slate-500 text-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                {{ $entreprise->location }}
                            </div>
                            <p class="mt-4 text-slate-600 leading-relaxed max-w-2xl">{{ $entreprise->description }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 relative z-10">
                        <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Aucune entreprise associée</h3>
                        <p class="text-slate-500 mt-2">Veuillez compléter votre profil pour ajouter une entreprise.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Offers List -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-2xl font-bold text-slate-900 font-outfit">Mes Offres Publiées</h2>
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $offres->count() }} Offres</span>
            </div>

            @forelse($offres as $offre)
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow group relative">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $offre->title }}</h3>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="bg-emerald-50 text-emerald-700 text-xs font-bold px-2 py-1 rounded-md">{{ $offre->ofres_type }}</span>
                                <span class="text-slate-400 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $offre->durre }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                             <span class="text-xs font-medium text-slate-400">Publié le {{ \Carbon\Carbon::parse($offre->created_at)->format('d M Y') }}</span>
                             <div class="mt-2 text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full inline-block">
                                 {{ count($offre->candidat ?? []) }} Candidatures
                             </div>
                        </div>
                    </div>
                    
                    <p class="text-slate-600 text-sm line-clamp-2 mb-4">{{ $offre->description }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($offre->competences ?? [] as $skill)
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded-md font-medium">{{ $skill }}</span>
                        @endforeach
                    </div>

                    <div class="border-t border-slate-50 pt-4 flex justify-end gap-3 mt-4">
                        <a href="{{ route('recruiter.jobs.show', $offre->id) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Voir Détails &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="bg-slate-50 border border-dashed border-slate-200 rounded-xl p-12 text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </div>
                    <h3 class="text-slate-900 font-bold">Aucune offre publiée</h3>
                    <p class="text-slate-500 text-sm mt-1">Commencez par ajouter votre première offre d'emploi.</p>
                </div>
            @endforelse
        </div>

        <!-- Right Column: Add Offer Form -->
        <div class="lg:col-span-1">
            <div class="sticky top-32">
                <div class="bg-white rounded-2xl shadow-lg shadow-indigo-500/10 border border-indigo-100 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-indigo-600 p-2 rounded-lg text-white shadow-lg shadow-indigo-500/30">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Nouvelle Offre</h2>
                    </div>

                    <form action="{{ route('recruiter.jobs.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Titre du poste</label>
                            <input type="text" name="title" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm" placeholder="Ex: Développeur Full Stack">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Type de contrat</label>
                            <select name="ofres_type" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Stage">Stage</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Durée / Lieu</label>
                            <input type="text" name="durre" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm" placeholder="Ex: 6 mois / Paris (Télétravail)">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Compétences (séparées par des virgules)</label>
                            <input type="text" name="competences" placeholder="React, Laravel, MySQL" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Description du poste</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm" placeholder="Détaillez les missions, le profil recherché..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 bg-slate-900 hover:bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-slate-900/20 hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 mt-2">
                            Publier l'offre
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
