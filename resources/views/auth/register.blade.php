@extends('layouts.app')

@section('title', 'Inscription - YouConnect')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
    
    <!-- Left: Form (Dark Theme for Registration) -->
    <div class="flex items-center justify-center p-8 bg-slate-950 relative order-2 lg:order-1">
        <!-- Abstract BG -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-900/30 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-900/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="w-full max-w-md space-y-10 relative z-10">
            <div class="text-center lg:text-left">
                <span class="text-primary-500 font-black uppercase tracking-widest text-xs mb-2 block">Nouveau Membre</span>
                <h2 class="text-4xl font-black text-white font-outfit mb-2">Commencez Ici.</h2>
                <p class="text-slate-400 font-medium">Créez votre profil professionnel en quelques secondes.</p>
            </div>

            <form action="{{ route('registerPost') }}" method="post" class="space-y-5">
                @csrf 

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Prénom</label>
                        <input type="text" name="first_name" placeholder="Ayoub" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 px-4 font-bold text-white focus:bg-white/10 focus:border-primary-500 transition-all outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Nom</label>
                        <input type="text" name="last_name" placeholder="Errak" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 px-4 font-bold text-white focus:bg-white/10 focus:border-primary-500 transition-all outline-none">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Email</label>
                    <input type="email" name="email" placeholder="contact@example.com" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 px-4 font-bold text-white focus:bg-white/10 focus:border-primary-500 transition-all outline-none">
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 px-4 font-bold text-white focus:bg-white/10 focus:border-primary-500 transition-all outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <label class="cursor-pointer group">
                        <input type="radio" name="role" value="devloppeur" class="peer hidden" checked>
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:bg-primary-600 peer-checked:border-primary-600 transition-all text-center">
                            <span class="block text-white font-black text-sm">devloppeur</span>
                            <span class="block text-slate-400 text-[10px] peer-checked:text-primary-200">Je cherche un job</span>
                        </div>
                    </label>
                    <label class="cursor-pointer group">
                        <input type="radio" name="role" value="recruiter" class="peer hidden">
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:bg-primary-600 peer-checked:border-primary-600 transition-all text-center">
                            <span class="block text-white font-black text-sm">recruiter</span>
                            <span class="block text-slate-400 text-[10px] peer-checked:text-primary-200">Je recrute</span>
                        </div>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-white text-slate-950 font-black py-4 rounded-xl hover:bg-primary-50 transition-all flex items-center justify-center gap-2 shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                        Créer mon compte
                    </button>
                </div>
            </form>


            <p class="text-center text-sm text-slate-500 font-medium">
                Déjà membre ? <a href="{{ route('login') }}" class="text-white font-black hover:underline">Se Connecter</a>
            </p>
        </div>
    </div>

    <!-- Right: Brand Art Order 1 -->
    <div class="hidden lg:flex flex-col justify-center items-center bg-white relative overflow-hidden order-1 lg:order-2 p-12">
        <div class="relative w-full max-w-lg aspect-square">
            <!-- Decorative Circle -->
            <div class="absolute inset-0 border-[40px] border-slate-50 rounded-full animate-[spin_10s_linear_infinite]"></div>
            <div class="absolute inset-4 border-[2px] border-slate-100 rounded-full"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center space-y-4 relative z-10">
                    <div class="w-24 h-24 bg-primary-600 rounded-[2rem] mx-auto flex items-center justify-center shadow-2xl shadow-primary-500/40 rotate-12">
                        <span class="text-4xl">🚀</span>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 font-outfit">Boostez votre<br>Carrière.</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
