@extends('layouts.app')

@section('title', 'Stages - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    
    <!-- Creative Header -->
    <div class="text-center max-w-3xl mx-auto mb-20 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <span class="px-4 py-1.5 rounded-full border border-primary-100 bg-primary-50 text-primary-600 text-[10px] font-black uppercase tracking-widest mb-6 inline-block">Opportunités en Or</span>
        <h1 class="text-5xl md:text-7xl font-black text-slate-900 font-outfit tracking-tighter leading-none mb-6">
            Trouvez votre <br>
            <span class="relative inline-block">
                <span class="absolute inset-x-0 bottom-2 h-4 bg-primary-200/50 -rotate-2 transform scale-110"></span>
                <span class="relative">Future Mission.</span>
            </span>
        </h1>
        <p class="text-xl text-slate-500 font-medium max-w-xl mx-auto">
            Des stages pré-embauche et PFE validés par les meilleures entreprises du Maroc.
        </p>
    </div>

    <!-- Job Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($stages as $stage)
        <div class="group bg-white rounded-[2.5rem] p-1 border border-slate-100 hover:border-primary-100 shadow-sm hover:shadow-xl hover:shadow-primary-900/5 transition-all duration-500 flex flex-col h-full">
            <div class="bg-slate-50/50 rounded-[2rem] p-8 flex flex-col h-full relative overflow-hidden">
                
                <!-- Background Pattern -->
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-gradient-to-br from-primary-100/50 to-transparent rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>

                <!-- Top: Company & Badge -->
                <div class="flex justify-between items-start mb-6 relative z-10">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100 text-xl font-black text-slate-900 group-hover:scale-110 transition-transform">
                        {{ substr($stage['company'], 0, 1) }}
                    </div>
                    @if($stage['is_trending'])
                    <span class="px-3 py-1 bg-black text-white text-[10px] font-black uppercase tracking-wide rounded-full animate-pulse">
                        🔥 Trending
                    </span>
                    @endif
                </div>

                <!-- Content -->
                <div class="mb-8 relative z-10">
                    <h3 class="text-xl font-black text-slate-900 leading-tight mb-2 group-hover:text-primary-600 transition-colors">
                        {{ $stage['title'] }}
                    </h3>
                    <p class="text-sm font-bold text-slate-500 mb-4">{{ $stage['company'] }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            {{ $stage['location'] }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600 shadow-sm">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $stage['duration'] }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach($stage['tags'] as $tag)
                            <span class="px-2.5 py-1 bg-primary-50 text-primary-700 text-[10px] font-black uppercase tracking-wide rounded-md">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Bottom: Action -->
                <div class="mt-auto relative z-10">
                    <button class="w-full bg-slate-900 text-white font-black py-4 rounded-xl shadow-lg hover:bg-primary-600 hover:shadow-primary-500/30 transition-all flex justify-between px-6 items-center group/btn">
                        <span>Postuler maintenant</span>
                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
