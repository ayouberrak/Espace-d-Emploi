@extends('layouts.app')

@section('title', 'Mon Réseau - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <div class="mb-16 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <h2 class="text-2xl font-black text-slate-900 font-outfit mb-8 flex items-center gap-3">
            Invitations en attente 
            <span class="bg-primary-600 text-white text-xs px-2.5 py-1 rounded-lg">{{ count($requests) }}</span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($requests as $req)
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:border-primary-100 transition-all group">
                <div class="flex items-start gap-4 mb-6">
                    <img src="{{ $req['receiver']['photo'] }}" 
                         class="w-16 h-16 rounded-[1.2rem] object-cover shadow-sm group-hover:scale-105 transition-transform duration-500" 
                         alt="{{ $req['receiver']['name'] }}">
                    <div>
                        <h3 class="font-black text-slate-900 text-lg leading-tight mb-1">{{ $req['receiver']['name'] }}</h3>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">{{ $req['receiver']['title'] ?? 'Sans titre' }}</p>
                        <p class="text-[10px] text-slate-400 mt-2 font-bold flex items-center gap-1">
                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                            Reçue le {{ \Carbon\Carbon::parse($req['invitation']['created_at'])->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    {{-- Bouton Accepter --}}
                    <form action="{{route('acceptInvi',$req['invitation']['id'])}}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                            Accepter
                        </button>
                    </form>

                    {{-- Bouton Refuser --}}
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-3 border border-slate-200 text-slate-500 font-bold rounded-xl text-xs hover:bg-slate-50 transition-all">
                            Refuser
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-900 font-outfit">Vos Relations</h2>
            <div class="relative">
                <input type="text" placeholder="Rechercher..." class="bg-white border border-slate-200 rounded-full py-2 px-4 text-xs font-bold outline-none ring-0 focus:border-primary-500 transition-all">
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($friends as $friend)
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex flex-col items-center text-center hover:shadow-lg transition-all group cursor-pointer">
                <div class="relative w-20 h-20 mb-4">
                    <img src="{{ $friend['receiver']['photo'] }}" 
                         class="w-full h-full rounded-2xl object-cover shadow-sm group-hover:rotate-3 transition-transform" 
                         alt="{{ $friend['receiver']['name'] }}">
                    <span class="absolute bottom-[-4px] right-[-4px] w-4 h-4 rounded-full border-2 border-white {{ ($friend['online'] ?? false) ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                </div>
                
                <h3 class="font-black text-slate-900 text-sm mb-1">{{ $friend['receiver']['name'] }}</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">{{ $friend['receiver']['title']}}</p>
                
                <a href="" class="w-full py-2 bg-slate-50 text-slate-600 font-bold rounded-xl text-xs hover:bg-primary-50 hover:text-primary-600 transition-all flex items-center justify-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Message
                </a>
            </div>
            @endforeach
            
            <a href="" class="border-2 border-dashed border-slate-200 rounded-[2rem] flex flex-col items-center justify-center text-center p-6 text-slate-400 hover:border-primary-300 hover:text-primary-500 hover:bg-primary-50/50 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-xs font-black uppercase tracking-wide">Ajouter</span>
            </a>
        </div>
    </div>
</div>
@endsection