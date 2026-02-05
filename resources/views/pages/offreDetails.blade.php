@extends('layouts.app')

@section('title', $offre->title . ' - ' . $entreprise->name . ' - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Main Content (Left, 3 cols) -->
        <div class="lg:col-span-3 space-y-6">

            <!-- Header Card -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-primary-50 to-transparent rounded-bl-3xl"></div>
                
                <div class="flex flex-col md:flex-row gap-6 items-start relative z-10">
                    <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center shadow-lg border border-slate-100 text-3xl font-black text-slate-900 shrink-0 overflow-hidden">
                        @if($entreprise->logo)
                            <img src="{{ Str::startsWith($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" alt="{{ $entreprise->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($entreprise->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h1 class="text-3xl font-black text-slate-900 font-outfit mb-2">{{ $offre->title }}</h1>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500 font-medium mb-6">
                            <span class="text-slate-900 font-bold hover:underline cursor-pointer">{{ $entreprise->name }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $entreprise->location }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $offre->created_at ? \Carbon\Carbon::parse($offre->created_at)->diffForHumans() : 'Récemment' }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span class="text-green-600 bg-green-50 px-2 py-0.5 rounded border border-green-100 text-xs font-bold">{{ $offre->ofres_type }}</span>
                        </div>

                        <div class="flex flex-wrap gap-4">
                                @auth
                                @php
                                    $hasApplied = $offre->applications->contains('user_id', auth()->id()) || in_array(auth()->id(), $offre->candidat ?? []);
                                    $isRecruiter = auth()->user()->role === 'recruiter';
                                    $isOwner = $isRecruiter && ($offre->recruiter_id === auth()->id());
                                    $isClosed = $offre->status === 'Closed';
                                @endphp

                                @if($isOwner)
                                    <div class="px-6 py-2.5 rounded-full bg-indigo-50 text-indigo-700 font-bold border border-indigo-100 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <span>C'est votre offre</span>
                                    </div>
                                @elseif($isClosed)
                                    <div class="px-6 py-2.5 rounded-full bg-rose-50 text-rose-700 font-bold border border-rose-100 flex items-center gap-2 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                        <span>Offre Clôturée</span>
                                    </div>
                                @elseif($hasApplied)
                                    <button disabled class="bg-green-100 text-green-700 cursor-not-allowed px-6 py-2.5 rounded-full font-bold transition-all shadow-none flex items-center gap-2">
                                        <span>Candidature envoyée</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    </button>
                                @elseif(!$isRecruiter)
                                    <form action="{{ route('offre.postuler', $offre->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg shadow-primary-200 flex items-center gap-2">
                                            <span>Postuler</span>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                        </button>
                                    </form>
                                @endif
                            @else
                                @if($offre->status === 'Closed')
                                    <div class="px-6 py-2.5 rounded-full bg-rose-50 text-rose-700 font-bold border border-rose-100 flex items-center gap-2 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                        <span>Offre Clôturée</span>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="bg-slate-900 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg hover:bg-slate-800 flex items-center gap-2">
                                        <span>Se connecter pour postuler</span>
                                    </a>
                                @endif
                            @endauth
                            <button class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 px-6 py-2.5 rounded-full font-bold transition-all">
                                Sauvegarder
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">À propos de l'offre</h2>
                
                <div class="prose prose-slate max-w-none prose-p:text-slate-600 prose-headings:font-bold prose-headings:text-slate-900">
                    <p class="whitespace-pre-line leading-relaxed">{{ $offre->description }}</p>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-4">Compétences recherchées</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($offre->competences && is_array($offre->competences))
                            @foreach($offre->competences as $skill)
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-200 transition-colors cursor-default">{{ $skill }}</span>
                            @endforeach
                        @else
                            <span class="text-sm text-slate-500 italic">Aucune compétence spécifique listée.</span>
                        @endif
                    </div>
                </div>
            </div>

            @if(auth()->check() && auth()->user()->role === 'recruiter' && $offre->recruiter_id === auth()->id())
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm mt-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Candidats triés par IA</h2>
                
                @if($applications->count() > 0)
                    <div class="space-y-4">
                        @foreach($applications as $app)
                            <div class="border border-slate-200 rounded-xl p-6 hover:shadow-md transition-all bg-slate-50">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold text-xl">
                                            {{ substr($app->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900 text-lg">{{ $app->user->name }}</h3>
                                            <p class="text-sm text-slate-500">{{ $app->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col items-end">
                                            <span class="text-2xl font-black {{ $app->score >= 70 ? 'text-green-600' : ($app->score >= 40 ? 'text-amber-500' : 'text-red-500') }}">
                                                {{ $app->score }}%
                                            </span>
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Compatibilité</span>
                                        </div>
                                        <div class="w-12 h-12 rounded-full border-4 {{ $app->score >= 70 ? 'border-green-100 text-green-600' : ($app->score >= 40 ? 'border-amber-100 text-amber-500' : 'border-red-100 text-red-500') }} flex items-center justify-center">
                                            @if($app->score >= 70)
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            @elseif($app->score >= 40)
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                            @else
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('user.cv', $app->user->id) }}" class="ml-auto text-indigo-600 hover:text-indigo-900 p-2 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors" title="Télécharger le CV">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    </a>
                                </div>

                                @if($app->ai_analysis)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mt-4 pt-4 border-t border-slate-200">
                                        @if(!empty($app->ai_analysis['details']['missing_skills']))
                                            <div>
                                                <strong class="text-rose-600 block mb-1"> Compétences manquantes :</strong>
                                                <ul class="list-disc list-inside text-slate-600">
                                                    @foreach($app->ai_analysis['details']['missing_skills'] as $skill)
                                                        <li>{{ $skill }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        
                                        @if(!empty($app->ai_analysis['details']['strengths']))
                                            <div>
                                                <strong class="text-green-600 block mb-1"> Points forts :</strong>
                                                <ul class="list-disc list-inside text-slate-600">
                                                    @foreach($app->ai_analysis['details']['strengths'] as $strength)
                                                        <li>{{ $strength }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3 text-sm text-slate-500 italic">
                                        "{{ $app->ai_analysis['reason'] ?? '' }}"
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 text-slate-500">
                        <p>Aucun candidat pour le moment.</p>
                    </div>
                @endif
            </div>
            
            @if(count($legacyCandidates) > 0)
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm mt-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Autres Candidats (Sans analyse IA)</h2>
                <div class="space-y-4">
                    @foreach($legacyCandidates as $lUser)
                         <div class="border border-slate-200 rounded-xl p-6 hover:shadow-md transition-all bg-slate-50 flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-200 text-slate-600 rounded-full flex items-center justify-center font-bold text-xl">
                                {{ substr($lUser->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg">{{ $lUser->name }}</h3>
                                <p class="text-sm text-slate-500">Candidature standard</p>
                            </div>
                             <a href="{{ route('user.cv', $lUser->id) }}" class="ml-auto text-indigo-600 hover:text-indigo-900 p-2 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors" title="Télécharger le CV">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </a>
                         </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endif

             <!-- About Company (Clean LinkedIn style) -->
            <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">À propos de l'entreprise</h2>
                <div class="flex items-start gap-4 mb-4">
                     <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center border border-slate-100 text-xl font-black text-slate-900 shrink-0 overflow-hidden">
                        @if($entreprise->logo)
                            <img src="{{ Str::startsWith($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" alt="{{ $entreprise->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($entreprise->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg">{{ $entreprise->name }}</h3>
                        <p class="text-slate-500 text-sm">Services et conseil informatiques</p>
                        <p class="text-slate-500 text-sm">{{ $entreprise->location }}</p>
                    </div>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed mb-6">
                    Nous sommes une entreprise leader dans le domaine de la technologie, dédiée à l'innovation et à la création de solutions exceptionnelles pour nos clients.
                </p>
                <a href="#" class="text-primary-600 font-bold text-sm hover:underline flex items-center gap-1">
                    Voir la page entreprise
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </a>
            </div>

        </div>

        <!-- Sidebar (Right, 1 col) -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Quick Actions Card (Sticky potentially) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">Détails de l'offre</h3>
                <div class="space-y-4">
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Type de contrat</p>
                         <p class="text-sm font-bold text-slate-900">{{ $offre->ofres_type }}</p>
                     </div>
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Durée</p>
                         <p class="text-sm font-bold text-slate-900">{{ $offre->durre }}</p>
                     </div>
                     <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Localisation</p>
                         <p class="text-sm font-bold text-slate-900">{{ $entreprise->location }}</p>
                     </div>
                </div>
            </div>

            <!-- Similar Jobs (Placeholder) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">Offres similaires</h3>
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div class="flex gap-3 items-start group cursor-pointer">
                        <div class="w-10 h-10 bg-slate-50 rounded flex items-center justify-center shrink-0 font-bold text-slate-700 border border-slate-100">D</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-primary-600 group-hover:underline transition-colors">Développeur Full Stack</h4>
                            <p class="text-xs text-slate-500">Digital Solutions • Rabat</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">Il y a 2 jours</span>
                        </div>
                    </div>
                     <!-- Item 2 -->
                    <div class="flex gap-3 items-start group cursor-pointer">
                        <div class="w-10 h-10 bg-slate-50 rounded flex items-center justify-center shrink-0 font-bold text-slate-700 border border-slate-100">T</div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-primary-600 group-hover:underline transition-colors">Tech Lead PHP</h4>
                            <p class="text-xs text-slate-500">Tech Agency • Casa</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">Il y a 5 jours</span>
                        </div>
                    </div>
                </div>
                <button class="w-full mt-4 text-center text-sm font-bold text-slate-500 hover:text-slate-900 py-2 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all">
                    Voir plus d'offres
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
