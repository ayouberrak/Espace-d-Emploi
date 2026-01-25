@extends('layouts.app')

@section('title', 'Messages - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 h-[calc(100vh-5rem)]">
    <div class="flex gap-6 h-full">
        
        <!-- Left Sidebar: Conversations -->
        <div class="w-full md:w-96 flex flex-col glass-card rounded-[2.5rem] border border-white/60 shadow-xl overflow-hidden h-full flex-shrink-0">
            <!-- Header -->
            <div class="p-6 pb-2 flex-shrink-0">
                <h1 class="text-2xl font-black text-slate-900 font-outfit mb-6 px-2">Messages</h1>
                <!-- Search -->
                <div class="relative">
                    <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" placeholder="Rechercher..." class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-12 pr-4 font-bold text-sm focus:ring-2 focus:ring-primary-500/50 transition-all outline-none text-slate-900">
                </div>
            </div>

            <!-- Conversation List -->
            <div class="flex-grow overflow-y-auto px-4 py-2 space-y-2 custom-scrollbar">
                @foreach($conversations as $conv)
                <div class="group p-4 rounded-2xl flex items-start gap-4 cursor-pointer transition-all {{ $loop->first ? 'bg-white shadow-lg shadow-slate-200/50 scale-[1.02] ring-1 ring-slate-100' : 'hover:bg-white/50 hover:scale-[1.01]' }}">
                    <!-- Avatar -->
                    <div class="relative shrink-0">
                        <img src="{{ $conv['avatar'] }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm" alt="">
                        @if($conv['online'])
                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                        @endif
                    </div>
                    
                    <div class="flex-grow min-w-0">
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h3 class="font-black text-slate-900 text-sm truncate">{{ $conv['name'] }}</h3>
                            <span class="text-[10px] font-bold text-slate-400">{{ $conv['time'] }}</span>
                        </div>
                        <p class="text-xs font-medium truncate {{ $loop->first ? 'text-slate-900' : 'text-slate-500' }}">
                            {{ $conv['last_message'] }}
                        </p>
                    </div>

                    @if($conv['unread'] > 0)
                    <div class="w-5 h-5 bg-primary-600 rounded-full flex items-center justify-center text-[10px] font-black text-white shadow-lg shadow-primary-500/40">
                        {{ $conv['unread'] }}
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right Area: Chat Window -->
        <div class="hidden md:flex flex-1 flex-col glass-card rounded-[2.5rem] border border-white/60 shadow-xl overflow-hidden h-full relative">
            
            <!-- Chat Header (Fixed Top) -->
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white/80 backdrop-blur-md z-20 absolute top-0 left-0 right-0">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="{{ $activeConversation['user']['avatar'] }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm" alt="">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-slate-900 leading-none">{{ $activeConversation['user']['name'] }}</h2>
                        <span class="text-xs font-bold text-primary-600 uppercase tracking-wider">{{ $activeConversation['user']['role'] }}</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-primary-600 hover:bg-white hover:shadow-md transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                    </button>
                    <button class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-primary-600 hover:bg-white hover:shadow-md transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </button>
                </div>
            </div>

            <!-- Messages Area (Scrollable) -->
            <div class="flex-grow overflow-y-auto p-8 pt-28 pb-32 space-y-6 custom-scrollbar bg-slate-50/30">
                <div class="text-center mb-8">
                    <span class="px-3 py-1 bg-slate-100 rounded-full text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aujourd'hui</span>
                </div>

                @foreach($activeConversation['messages'] as $msg)
                <div class="flex w-full {{ $msg['sender'] === 'me' ? 'justify-end' : 'justify-start' }} animate-in fade-in slide-in-from-bottom-2 duration-500">
                    <div class="max-w-[70%] {{ $msg['sender'] === 'me' ? 'bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-br-none shadow-xl shadow-slate-900/10' : 'bg-white text-slate-700 shadow-sm border border-slate-100 rounded-bl-none' }} p-4 rounded-[1.5rem]">
                        <p class="text-sm font-medium leading-relaxed">{{ $msg['text'] }}</p>
                        <p class="text-[9px] font-bold uppercase mt-2 opacity-50 {{ $msg['sender'] === 'me' ? 'text-right' : 'text-left' }}">{{ $msg['time'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Input Area (Floating Dock) -->
            <div class="absolute bottom-6 left-6 right-6 z-20">
                <div class="bg-white/80 backdrop-blur-xl border border-white/50 p-2 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.08)] ring-1 ring-slate-900/5 flex items-center gap-2">
                    <button class="p-3 text-slate-400 hover:text-primary-600 hover:bg-slate-50 rounded-full transition-all flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                    </button>
                    
                    <input type="text" placeholder="Écrivez votre message..." class="flex-grow bg-transparent border-none focus:ring-0 text-sm font-bold text-slate-700 placeholder:text-slate-400 h-10 outline-none">
                    
                    <div class="flex items-center gap-1 pr-1">
                        <button class="p-2 text-slate-300 hover:text-slate-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                        <button class="p-3 bg-slate-900 text-white rounded-full shadow-lg shadow-slate-900/20 hover:scale-105 hover:bg-primary-600 active:scale-95 transition-all flex-shrink-0">
                            <svg class="w-5 h-5 translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
