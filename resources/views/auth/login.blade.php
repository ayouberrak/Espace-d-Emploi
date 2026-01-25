@extends('layouts.app')

@section('title', 'Connexion - YouConnect')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
    
    <!-- Left: Brand Art (Hidden on mobile) -->
    <div class="hidden lg:flex flex-col justify-between bg-slate-900 relative overflow-hidden p-12 lg:p-20">
        <!-- Abstract Art -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary-600/20 rounded-full blur-[120px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[100px] -ml-20 -mb-20"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        </div>

        <div class="relative z-10">
            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-glow">
                <svg class="w-6 h-6 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <h1 class="text-5xl font-black text-white font-outfit tracking-tight leading-tight mb-6">
                Construisez votre <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-indigo-400">Héritage Pro.</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed max-w-md">
                Rejoignez une communauté d'élite où les opportunités rencontrent le talent. Une plateforme conçue pour l'excellence.
            </p>
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-4">
                <div class="flex -space-x-4">
                    <img class="w-12 h-12 rounded-full border-4 border-slate-900" src="https://i.pravatar.cc/150?u=1" alt="">
                    <img class="w-12 h-12 rounded-full border-4 border-slate-900" src="https://i.pravatar.cc/150?u=5" alt="">
                    <img class="w-12 h-12 rounded-full border-4 border-slate-900" src="https://i.pravatar.cc/150?u=8" alt="">
                </div>
                <div class="text-sm">
                    <p class="text-white font-bold">10k+ Talents</p>
                    <p class="text-slate-500">nous font confiance</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Login Form -->
    <div class="flex items-center justify-center p-8 bg-white relative">
        <div class="w-full max-w-md space-y-10">
            
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-black text-slate-900 font-outfit mb-2">Bon retour.</h2>
                <p class="text-slate-500 font-medium">Entrez vos identifiants pour accéder à votre espace.</p>
            </div>

            <form action="{{ route('dashboard') }}" method="GET" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-900">Email</label>
                    <input type="email" value="ayoub@eligence.ma" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 px-5 font-semibold focus:bg-white focus:ring-2 focus:ring-slate-900 focus:border-transparent transition-all outline-none text-slate-900">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-900">Mot de passe</label>
                        <a href="#" class="text-xs font-bold text-slate-400 hover:text-slate-900">Oublié ?</a>
                    </div>
                    <input type="password" value="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-4 px-5 font-semibold focus:bg-white focus:ring-2 focus:ring-slate-900 focus:border-transparent transition-all outline-none text-slate-900">
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-primary-600 hover:shadow-lg transition-all flex items-center justify-center gap-2 group">
                    Se Connecter
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </form>

            <div class="relative">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-4 text-slate-400 font-bold tracking-widest">Ou continuer avec</span></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all font-bold text-slate-700 text-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.536-6.033-5.696  c0-3.159,2.701-5.696,6.033-5.696c1.192,0,2.373,0.366,3.35,1.06l2.875-2.571C17.027,3.673,14.92,2.697,12.545,2.697  C7.28,2.697,3.011,6.671,3.011,11.573c0,4.902,4.269,8.877,9.534,8.877c3.957,0,7.702-2.181,8.927-5.597h-8.927V10.239z"/></svg>
                    Google
                </button>
                <button class="flex items-center justify-center gap-2 py-3 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all font-bold text-slate-700 text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 17.607c-.786 2.28-3.139 3.631-5.105 3.631-2.43 0-3.37-1.589-3.37-3.926 0-3.37 2.656-6.736 6.55-6.736 2.052 0 3.522 1.093 3.522 3.327 0 3.755-3.003 7.729-6.315 7.729-1.282 0-2.399-.798-2.399-1.957 0-.74.316-2.036 1.41-3.692l-.254-.367c-1.479 1.879-2.227 3.527-2.227 5.253 0 2.215 1.71 4.116 4.331 4.116 3.036 0 6.07-2.152 7.21-5.132L22 17.607z"/></svg>
                    Apple
                </button>
            </div>

            <p class="text-center text-sm text-slate-500 font-medium">
                Pas de compte ? <a href="{{ route('register') }}" class="text-primary-600 font-black hover:underline">S'inscrire</a>
            </p>
        </div>
    </div>
</div>
@endsection
