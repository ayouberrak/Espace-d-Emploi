@extends('layouts.app')

@section('title', 'Tableau de Bord - Recruteur')

@section('content')
<div class="min-h-screen bg-slate-50/50 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header Section with Greeting and Actions -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 animate-in fade-in slide-in-from-top-4 duration-700">
            <div>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Espace Recruteur</p>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight font-outfit">Tableau de Bord</h1>
                <p class="text-slate-500 font-medium mt-2 text-lg">Heureux de vous revoir, {{ Auth::user()->name }} 👋</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <span class="bg-white px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 border border-slate-200 shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    {{ now()->translatedFormat('d F Y') }}
                </span>
                <a href="{{ route('recruiter.jobs.create') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-xl shadow-slate-900/10 transition-all flex items-center gap-2 active:scale-95 group">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Nouvelle Offre
                </a>
            </div>
        </div>

        <!-- KPI Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            
            <!-- Card: Active Jobs -->
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all group relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-indigo-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3.5 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                            Actif
                        </span>
                    </div>
                    <div class="text-5xl font-black text-slate-900 font-outfit mb-2 tracking-tight">{{ $stats['active_jobs'] }}</div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wide">Offres en cours</p>
                </div>
            </div>

            <!-- Card: Total Applicants -->
            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all group relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-rose-50 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3.5 bg-rose-50 text-rose-600 rounded-2xl group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                    </div>
                    <div class="text-5xl font-black text-slate-900 font-outfit mb-2 tracking-tight">{{ $stats['total_applicants'] }}</div>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wide">Candidatures Reçues</p>
                </div>
            </div>

            <!-- Card: Profile Views (Stylized) -->
            <div class="bg-slate-900 p-8 rounded-[2rem] border border-slate-800 shadow-xl text-white relative overflow-hidden group">
                <!-- Decorative Elements -->
                <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500 rounded-full blur-[60px] opacity-20 group-hover:opacity-40 transition-opacity duration-700"></div>
                <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <div class="p-3.5 bg-white/10 rounded-2xl backdrop-blur-md border border-white/10">
                            <svg class="w-6 h-6 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </div>
                        <span class="text-xs font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1 rounded-full">Cette semaine</span>
                    </div>
                    
                    <div class="flex items-baseline gap-2 mb-2">
                        <div class="text-5xl font-black font-outfit tracking-tight text-white">{{ $stats['views_this_week'] }}</div>
                        <span class="text-sm text-slate-400 font-medium">vues</span>
                    </div>
                    <div class="w-full bg-slate-800/50 rounded-full h-1.5 mt-4 overflow-hidden">
                        <div class="bg-indigo-500 h-1.5 rounded-full w-[70%] shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Jobs Section -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/30">
                <div>
                    <h2 class="text-xl font-black text-slate-900 font-outfit flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        Vos Dernières Offres
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 font-medium ml-8">Gérez vos recrutements en cours et suivez les candidatures.</p>
                </div>
                <a href="{{ route('mesoffres') }}" class="group flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold text-sm hover:border-indigo-200 hover:text-indigo-600 transition-all shadow-sm hover:shadow-md">
                    Tout voir
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50">
                            <th class="px-8 py-5 pl-10">Détails de l'offre</th>
                            <th class="px-8 py-5 text-center">Candidats</th>
                            <th class="px-8 py-5 text-center">Statut</th>
                            <th class="px-8 py-5 text-right pr-10">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @forelse($myJobs as $job)
                        <tr class="group hover:bg-slate-50/80 transition-colors duration-200">
                            <td class="px-8 py-6 pl-10">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xl shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm group-hover:shadow-indigo-500/20 group-hover:scale-105 duration-300">
                                        {{ $job['title'] ? substr($job['title'], 0, 1) : '?' }}
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors mb-1">{{ $job['title'] }}</div>
                                        <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                {{ $job['location'] }}
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                {{ $job['created_at'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-100 rounded-full shadow-sm group-hover:border-indigo-100 transition-colors">
                                    <div class="flex -space-x-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-100 border-2 border-white"></div>
                                        <div class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white"></div>
                                        <div class="w-6 h-6 rounded-full bg-slate-300 border-2 border-white flex items-center justify-center text-[8px] font-bold text-slate-500">+</div>
                                    </div>
                                    <span class="text-sm font-bold text-slate-700 ml-1">{{ $job['applicants_count'] }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold shadow-sm {{ $job['raw_status'] ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    @if($job['raw_status'])
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                    @endif
                                    {{ $job['status'] }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right pr-10">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('recruiter.jobs.toggle', $job['id']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-2.5 rounded-xl border border-slate-200 text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors" title="{{ $job['status'] === 'Clôturé' ? 'Réactiver' : 'Clôturer' }}">
                                            @if($job['status'] === 'Clôturé')
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            @endif
                                        </button>
                                    </form>
                                    <a href="{{ route('recruiter.jobs.show', $job['id']) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-900 hover:text-white hover:border-slate-900 transition-all shadow-sm hover:shadow-lg active:scale-95">
                                        Gérer
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="mx-auto w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 font-outfit mb-2">Aucune offre active</h3>
                                <p class="text-slate-500 max-w-sm mx-auto mb-8">Vous n'avez pas encore publié d'offres. Commencez dès maintenant pour trouver vos futurs talents.</p>
                                <a href="{{ route('recruiter.jobs.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-600/20">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                    Créer une Offre
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(count($myJobs) > 0)
            <div class="p-6 border-t border-slate-50 bg-slate-50/30 flex justify-center">
                <a href="{{ route('mesoffres') }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
                    Voir tout l'historique
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
