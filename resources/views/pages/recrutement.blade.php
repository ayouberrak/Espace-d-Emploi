@extends('layouts.app')

@section('title', 'Recruteurs - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    
    <div class="flex flex-col md:flex-row items-end justify-between gap-8 mb-16 px-4">
        <div>
            <h1 class="text-5xl font-black text-slate-900 font-outfit tracking-tight mb-2">Top Recruteurs</h1>
            <p class="text-slate-500 text-lg font-medium">Connectez-vous avec les leaders de la tech.</p>
        </div>
        <div class="flex items-center -space-x-4">
            @foreach($recruiters as $recruiter)
                @if($loop->iteration <= 4)
                <img class="w-14 h-14 rounded-full border-4 border-slate-50 object-cover" src="{{ $recruiter['avatar'] ?? 'https://i.pravatar.cc/150?u='.$recruiter['id'] }}" alt="">
                @endif
            @endforeach
            <div class="w-14 h-14 rounded-full border-4 border-slate-50 bg-slate-900 text-white flex items-center justify-center font-black text-xs z-10">
                +{{ count($recruiters) }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($recruiters as $recruiter)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-b from-primary-500 to-indigo-600 rounded-[2.5rem] rotate-0 group-hover:rotate-2 transition-transform duration-500 opacity-0 group-hover:opacity-100 blur-sm"></div>
            
            <div class="relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-2 transition-transform duration-500 flex flex-col items-center text-center h-full">
                
                <div class="w-28 h-28 rounded-full p-1 bg-gradient-to-tr from-primary-100 to-indigo-100 mb-6">
                    <img class="w-full h-full rounded-full object-cover border-4 border-white" src="{{ $recruiter['avatar'] ?? 'https://i.pravatar.cc/150?u='.$recruiter['id'] }}" alt="{{ $recruiter['name'] }}">
                </div>

                <h3 class="text-xl font-black text-slate-900 font-outfit mb-1">{{ $recruiter['name'] }}</h3>
                <p class="text-xs font-bold text-primary-600 uppercase tracking-widest mb-4">{{ $recruiter['company'] }}</p>
                
                <p class="text-sm text-slate-500 font-medium leading-relaxed mb-8 line-clamp-3">
                    {{ $recruiter['bio'] }}
                </p>

                <div class="mt-auto w-full space-y-3">
                    <button class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-primary-600 transition-all text-xs uppercase tracking-wide">
                        Voir Profil
                    </button>
                    <button class="w-full bg-white border border-slate-200 text-slate-900 font-bold py-3 rounded-xl hover:bg-slate-50 transition-all text-xs uppercase tracking-wide">
                        Message
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
