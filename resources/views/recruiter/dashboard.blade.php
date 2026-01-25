@extends('layouts.app')

@section('title', 'Command Center - Recruteur')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Top Bar with Date & Action -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 animate-in fade-in slide-in-from-top-4 duration-700">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Espace Recruteur</p>
            <h1 class="text-4xl font-black text-slate-900 font-outfit tracking-tight">Vue d'ensemble</h1>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-bold text-slate-500 bg-white px-4 py-2 rounded-full border border-slate-200 shadow-sm">{{ now()->format('d M Y') }}</span>
            <a href="{{ route('chat.index') }}" class="bg-white text-slate-900 border border-slate-200 px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                Messages
            </a>
            <a href="{{ route('recruiter.jobs.create') }}" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-xl shadow-slate-900/10 hover:bg-primary-600 hover:shadow-primary-600/20 transition-all flex items-center gap-2 active:scale-95 group">
                <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Créer une offre
            </a>
        </div>
    </div>

    <!-- Analytics Grid (Fintech Style) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:border-slate-200 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-slate-50 rounded-2xl group-hover:bg-indigo-50 transition-colors">
                    <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <div class="text-3xl font-black text-slate-900 font-outfit mb-1">{{ $stats['active_jobs'] ?? 2 }}</div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Offres Actives</p>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:border-slate-200 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-slate-50 rounded-2xl group-hover:bg-pink-50 transition-colors">
                    <svg class="w-6 h-6 text-slate-400 group-hover:text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+24%</span>
            </div>
            <div class="text-3xl font-black text-slate-900 font-outfit mb-1">{{ $stats['total_applicants'] ?? 17 }}</div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Total Candidats</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:border-slate-200 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-slate-50 rounded-2xl group-hover:bg-blue-50 transition-colors">
                    <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">~ 0%</span>
            </div>
            <div class="text-3xl font-black text-slate-900 font-outfit mb-1">{{ $stats['views_this_week'] ?? 234 }}</div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Vues (7j)</p>
            
            <!-- Mini Chart Area -->
            <div class="h-8 w-full mt-4 flex items-end gap-1 opacity-50">
                <div class="w-1/6 bg-blue-100 rounded-t-sm h-[30%]"></div>
                <div class="w-1/6 bg-blue-100 rounded-t-sm h-[50%]"></div>
                <div class="w-1/6 bg-blue-100 rounded-t-sm h-[40%]"></div>
                <div class="w-1/6 bg-blue-100 rounded-t-sm h-[70%]"></div>
                <div class="w-1/6 bg-blue-100 rounded-t-sm h-[60%]"></div>
                <div class="w-1/6 bg-blue-500 rounded-t-sm h-[90%]"></div>
            </div>
        </div>

        <!-- Card 4 (CTA) -->
        <div class="bg-slate-900 p-6 rounded-[2rem] shadow-xl text-white relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-500 rounded-full blur-3xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
            <h3 class="font-black font-outfit text-lg mb-2">Passez Pro</h3>
            <p class="text-slate-400 text-xs font-medium mb-6 leading-relaxed">Débloquez les analytics avancés et le sourcing IA.</p>
            <button class="w-full bg-white/10 border border-white/20 rounded-xl py-3 text-xs font-bold hover:bg-white hover:text-slate-900 transition-all">
                Voir les plans
            </button>
        </div>
    </div>

    <!-- Main Section: Jobs Table -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <h2 class="text-xl font-black text-slate-900 font-outfit">Vos Offres</h2>
                    <div class="flex gap-2">
                         <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg></button>
                         <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg></button>
                    </div>
                </div>
                
                <div class="w-full">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] font-black uppercase tracking-widest text-slate-400 border-b border-slate-50">
                                <th class="px-8 py-4">Offre</th>
                                <th class="px-8 py-4 text-center">Candidats</th>
                                <th class="px-8 py-4 text-center">Status</th>
                                <th class="px-8 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($myJobs as $job)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 font-black text-xs shrink-0">
                                            {{ substr($job['title'], 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 group-hover:text-primary-600 transition-colors">{{ $job['title'] }}</div>
                                            <div class="text-xs font-semibold text-slate-400">{{ $job['location'] }} • {{ $job['created_at'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-slate-100 rounded-full shadow-sm">
                                        <div class="flex -space-x-2">
                                            <div class="w-5 h-5 rounded-full bg-slate-200 border border-white"></div>
                                            <div class="w-5 h-5 rounded-full bg-slate-300 border border-white"></div>
                                        </div>
                                        <span class="text-xs font-bold text-slate-600">{{ $job['applicants_count'] }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wide {{ $job['status'] === 'Actif' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                        @if($job['status'] === 'Actif')
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                                        @endif
                                        {{ $job['status'] }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-slate-400 hover:text-slate-600 p-2 hover:bg-white rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" /></svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar / Activity -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                <h3 class="font-black font-outfit text-slate-900 mb-6">Activité Récente</h3>
                <div class="space-y-6 relative before:absolute before:left-3.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-0.5 w-7 h-7 bg-white border border-slate-100 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                        </div>
                        <p class="text-sm font-bold text-slate-900">Nouvelle candidature</p>
                        <p class="text-xs text-slate-500 font-medium">Ahmed B. pour "Développeur React"</p>
                        <span class="text-[10px] font-bold text-slate-300 uppercase tracking-wide mt-1 block">Il y a 2m</span>
                    </div>
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-0.5 w-7 h-7 bg-white border border-slate-100 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                        </div>
                        <p class="text-sm font-bold text-slate-900">Offre expirée</p>
                        <p class="text-xs text-slate-500 font-medium">"Designer UI/UX" a atteint la date limite.</p>
                        <span class="text-[10px] font-bold text-slate-300 uppercase tracking-wide mt-1 block">Il y a 4h</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
