@extends('layouts.app')

@section('title', 'Publier une offre - YouConnect')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-slate-900 font-outfit tracking-tight">Nouvelle Opportunité</h1>
        <p class="text-slate-500 mt-2 font-medium">Créez une offre qui attirera les meilleurs talents.</p>
    </div>

    <div class="glass-card rounded-[2.5rem] border border-white/60 shadow-2xl overflow-hidden p-8 sm:p-12 relative animate-in fade-in slide-in-from-bottom-8 duration-700">
        <!-- Glow accent -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-100 rounded-full blur-3xl opacity-60"></div>

        <form action="{{ route('recruiter.jobs.store') }}" method="POST" class="space-y-8 relative z-10">
            @csrf
            
            <div class="space-y-4">
                <div class="space-y-1">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Titre du poste</label>
                    <input type="text" name="title" placeholder="Ex: Développeur React Senior" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 font-bold focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Lieu</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 font-bold focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none appearance-none">
                            <option>Casablanca</option>
                            <option>Rabat</option>
                            <option>Tanger</option>
                            <option>Marrakech</option>
                            <option>Distanciel (Remote)</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Type de contrat</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 font-bold focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none appearance-none">
                            <option>CDI</option>
                            <option>Stage (PFE)</option>
                            <option>Freelance</option>
                            <option>CDD</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Description du poste</label>
                    <textarea rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 font-medium focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none resize-none" placeholder="Décrivez les responsabilités et les compétences requises..."></textarea>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 ml-1">Salaire (Optionnel)</label>
                    <input type="text" placeholder="Ex: 8000 - 12000 DH" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 font-bold focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('recruiter.dashboard') }}" class="text-slate-500 font-bold hover:text-slate-700 transition-colors text-sm">Annuler</a>
                <button type="submit" class="bg-slate-900 text-white font-black py-4 px-8 rounded-2xl hover:bg-primary-600 hover:shadow-xl hover:shadow-primary-500/20 transition-all flex items-center gap-2 active:scale-95">
                    <span>Publier l'Offre</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
