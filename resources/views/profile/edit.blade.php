@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-24">
    <!-- Header -->
    <div class="space-y-4">
        <h2 class="text-6xl lg:text-9xl font-black tracking-tighter leading-none">CONFIG<span class="nadi-text-gradient">.</span></h2>
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-white/30">Personalize your hub</p>
    </div>

    <!-- Main Settings -->
    <form action="{{ route('profile.update') }}" method="POST" class="space-y-16">
        @csrf
        <div class="flex items-center gap-10 pb-16 border-b border-white/10">
            <div class="relative group">
                <div class="absolute -inset-2 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-full blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                <img class="relative h-24 w-24 rounded-full object-cover border-2 border-white/20" src="{{ $user['photo'] }}" alt="">
                <button type="button" class="absolute -bottom-2 -right-2 w-10 h-10 bg-black border border-white/20 text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
                    <i class="fa-solid fa-camera text-xs"></i>
                </button>
            </div>
            <div>
                <h3 class="text-lg font-black tracking-tight">Space Identity</h3>
                <p class="text-xs text-white/40 mt-1 uppercase tracking-widest font-bold">Image & Avatar Config</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-4">
                <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">Display Name</label>
                <input type="text" name="name" value="{{ $user['name'] }}" 
                       class="w-full py-6 bg-white/5 border-b-2 border-white/10 focus:border-pink-500 transition-all outline-none text-2xl font-black text-white px-4 rounded-t-xl">
            </div>
            <div class="space-y-4">
                <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">Core Specialty</label>
                <input type="text" name="specialty" value="{{ $user['specialty'] }}" 
                       class="w-full py-6 bg-white/5 border-b-2 border-white/10 focus:border-indigo-500 transition-all outline-none text-2xl font-black text-white px-4 rounded-t-xl">
            </div>
        </div>

        <div class="space-y-4">
            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">Hub Biography</label>
            <textarea name="bio" rows="4" 
                      class="w-full py-8 bg-white/5 border-b-2 border-white/10 focus:border-purple-500 transition-all outline-none text-2xl font-black text-white px-6 rounded-t-2xl leading-relaxed">{{ $user['bio'] }}</textarea>
        </div>

        <div class="flex justify-end pt-10">
            <button type="submit" class="btn-ultimate-nadi px-16 py-5">Push Changes</button>
        </div>
    </form>

    <!-- Security -->
    <div class="pt-32 border-t border-white/10 space-y-16">
        <h2 class="text-3xl font-black tracking-tighter">SECURE ACCESS</h2>
        <form action="{{ route('profile.password') }}" method="POST" class="space-y-12">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">Current Key</label>
                    <input type="password" name="old_password" class="w-full py-6 bg-white/5 border-b-2 border-white/10 focus:border-indigo-500 transition-all outline-none text-2xl font-black text-white px-4 rounded-t-xl">
                </div>
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/30">New Protocol</label>
                    <input type="password" name="new_password" class="w-full py-6 bg-white/5 border-b-2 border-white/10 focus:border-pink-500 transition-all outline-none text-2xl font-black text-white px-4 rounded-t-xl">
                </div>
            </div>
            <div class="flex justify-start">
                <button type="submit" class="text-xs font-black uppercase tracking-[0.5em] text-indigo-400 border-b-2 border-indigo-400 pb-2 hover:text-white hover:border-white transition-all">Update Access Key</button>
            </div>
        </form>
    </div>
</div>
@endsection
