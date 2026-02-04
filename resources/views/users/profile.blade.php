@extends('layouts.app')

@section('title', $user->name . ' - Profil')

@section('content')
<div x-data="profileManager()" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-slate-50 min-h-screen">
    
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 auto-rows-min">
        
        <!-- Carte Profil Principale -->
        <div class="md:col-span-2 lg:col-span-2 row-span-2 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
            <!-- Cover Image -->
            <div class="absolute inset-x-0 top-0 h-48 bg-slate-200">
                @if($user->cover_image)
                    <img src="{{ Str::startsWith($user->cover_image, 'http') ? $user->cover_image : asset('storage/' . $user->cover_image) }}" class="w-full h-full object-cover" alt="Cover">
                @else
                    <div class="w-full h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                @endif
                @if($isMe)
                    <button @click="openModal('general')" class="absolute top-4 right-4 p-2 bg-white/20 hover:bg-white/40 backdrop-blur-md rounded-full text-white transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </button>
                @endif
            </div>

            <div class="relative z-10 flex flex-col items-start pt-32 px-8 pb-8">
                <div class="w-40 h-40 rounded-full p-1.5 bg-white shadow-xl mb-4 relative group/avatar">
                    <div class="w-full h-full rounded-full overflow-hidden bg-slate-50 relative">
                        @if($user->photo)
                            <img src="{{ Str::startsWith($user->photo, 'http') ? $user->photo : asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100 font-black text-slate-300 text-5xl uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        @if($isMe)
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/avatar:opacity-100 flex items-center justify-center transition-opacity cursor-pointer" @click="openModal('general')">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="flex flex-col gap-1 w-full">
                    <h1 class="text-3xl font-black text-slate-900 font-outfit">{{ $user->name }}</h1>
                    
                    <div x-show="title" class="text-lg font-medium text-slate-600 mb-2" x-text="title"></div>

                    <p class="text-slate-500 text-sm leading-relaxed mb-6 max-w-lg" x-text="bio || 'Aucune bio disponible.'"></p>

                    <div class="flex flex-wrap gap-4 text-sm text-slate-500 mb-6">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Casablanca, Maroc
                        </div>
                        <div class="flex items-center gap-1.5 text-indigo-600 font-bold hover:underline cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                            Coordonnées
                        </div>
                    </div>

                    <div class="flex gap-3 mt-auto">
                        @if($isMe)
                            <button @click="openModal('general')" class="bg-indigo-600 text-white px-8 py-2.5 rounded-full font-bold text-sm shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 hover:shadow-indigo-500/30 transition-all">
                                Modifier le profil
                            </button>
                            <button class="bg-slate-100 text-slate-700 px-6 py-2.5 rounded-full font-bold text-sm hover:bg-slate-200 transition-all">
                                Plus
                            </button>
                        @else
                            <button class="bg-indigo-600 text-white px-8 py-2.5 rounded-full font-bold text-sm shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 hover:shadow-indigo-500/30 transition-all">
                                Se connecter
                            </button>
                            <button class="bg-white border border-slate-300 text-slate-700 px-6 py-2.5 rounded-full font-bold text-sm hover:bg-slate-50 transition-all">
                                Message
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Contact & Skills -->
        <div class="md:col-span-1 lg:col-span-2 space-y-6">
            
            <!-- Contact Box -->
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm flex flex-col justify-between group h-full max-h-[300px]">
                <div>
                    <h3 class="font-black font-outfit text-slate-400 text-[10px] uppercase tracking-widest mb-4">Contact</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $user->email }}</p>
                        </div>

                        <div x-show="phone" class="flex items-center gap-3">
                             <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <p class="text-sm font-bold text-slate-900" x-text="phone"></p>
                        </div>
                    </div>
                </div>

                <div class="mt-auto pt-6 border-t border-slate-100 grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-2xl font-black text-slate-900">
                            {{ is_array($user->amis) ? count($user->amis) : 0 }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Amis</span>
                    </div>
                    <div>
                        <span class="block text-2xl font-black text-slate-900">
                            {{ $user->created_at->format('Y') }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Membre</span>
                    </div>
                </div>
            </div>

            <!-- Skills Box -->
            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group flex flex-col justify-center min-h-[200px]">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/20 blur-3xl rounded-full group-hover:bg-indigo-500/30 transition-colors"></div>
                
                <div class="flex items-center justify-between mb-6 z-10">
                    <h3 class="font-black font-outfit text-lg">Compétences</h3>
                    @if($isMe)
                    <button @click="openModal('skills')" class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors text-xs font-bold">
                        + Gérer
                    </button>
                    @endif
                </div>
                
                <div class="flex flex-wrap gap-2 z-10">
                    <template x-if="skills.length > 0">
                        <template x-for="skill in skills" :key="skill">
                            <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10 text-xs font-bold hover:bg-white/20 transition-colors cursor-default" x-text="skill"></span>
                        </template>
                    </template>
                    <template x-if="skills.length === 0">
                        <span class="text-slate-500 text-sm">Aucune compétence ajoutée</span>
                    </template>
                </div>
            </div>
            
            <!-- Entreprise Box (Only for Recruiter) -->
            @if(isset($entreprise) || ($user->role === 'recruiter' && $isMe))
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm flex flex-col justify-between group min-h-[200px]">
                <div class="flex items-center justify-between mb-4">
                     <h3 class="font-black font-outfit text-slate-400 text-[10px] uppercase tracking-widest">Entreprise</h3>
                     @if($isMe)
                     <button @click="openModal('entreprise')" class="p-2 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors text-xs font-bold text-slate-600">
                        Modifier
                     </button>
                     @endif
                </div>
                
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-xl bg-slate-50 mb-3 overflow-hidden border border-slate-100 relative">
                         <template x-if="entreprise.logo">
                            <img :src="getProjectImageUrl(entreprise.logo)" class="w-full h-full object-cover">
                         </template>
                         <template x-if="!entreprise.logo">
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m8-2a2 2 0 01-2-2 2 2 0 012-2h.01M9 17h.01M9 13h.01M15 21v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5h6z" /></svg>
                            </div>
                         </template>
                    </div>
                    <h4 class="font-bold text-slate-900 text-lg" x-text="entreprise.nom || 'Nom de l\'entreprise'"></h4>
                    <p class="text-xs text-slate-500 font-medium mb-2" x-text="entreprise.location || 'Localisation'"></p>
                    <p class="text-sm text-slate-600 line-clamp-3" x-text="entreprise.description || 'Description de l\'entreprise...'"></p>
                </div>
            </div>
            @endif
            
        </div>

        <!-- Projets Réalisés -->
        <div class="md:col-span-3 lg:col-span-4 mt-4">
            <h2 class="text-2xl font-black text-slate-900 font-outfit mb-6 px-2 flex items-center gap-4">
                Projets Réalisés
                <span class="h-px bg-slate-200 flex-grow"></span>
                @if($isMe)
                <button @click="openModal('projects')" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-xs font-bold hover:bg-slate-800 transition-colors">
                    + Ajouter / Modifier
                </button>
                @endif
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="project in projects" :key="project.title">
                    <div class="group relative rounded-[2rem] overflow-hidden aspect-[4/3] cursor-pointer bg-slate-100">
                        <img :src="getProjectImageUrl(project.image) || 'https://via.placeholder.com/400x300'" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <span class="text-indigo-400 text-xs font-black uppercase tracking-widest mb-1 translate-y-4 group-hover:translate-y-0 transition-transform duration-300" x-text="project.category || 'Projet'"></span>
                            <h3 class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75" x-text="project.title || 'Sans titre'"></h3>
                        </div>
                    </div>
                </template>
                <template x-if="projects.length === 0">
                    <p class="text-slate-400 italic pl-2">Aucun projet à afficher pour le moment.</p>
                </template>
            </div>
        </div>

        <!-- Expérience Professionnelle -->
        <div class="md:col-span-3 lg:col-span-4 bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-200 shadow-sm mt-4">
            <h3 class="font-black font-outfit text-xl mb-8 flex items-center justify-between">
                <span class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center text-sm">💼</span>
                    Expérience Professionnelle
                </span>
                @if($isMe)
                <button @click="openModal('experiances')" class="px-4 py-2 bg-slate-100 text-slate-900 rounded-lg text-xs font-bold hover:bg-slate-200 transition-colors">
                    Modifier
                </button>
                @endif
            </h3>
            
            <div class="relative pl-4 border-l-2 border-slate-100 space-y-10">
                <template x-for="exp in experiances" :key="exp.role + exp.company">
                    <div class="relative pl-8 group">
                        <div class="absolute -left-[23px] top-1.5 w-4 h-4 bg-white border-4 border-slate-200 rounded-full group-hover:border-indigo-500 transition-colors"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                            <h4 class="text-lg font-bold text-slate-900" x-text="exp.role || 'Poste'"></h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-50 text-xs font-bold text-slate-500 border border-slate-100 whitespace-nowrap" x-text="exp.duration || 'Date'"></span>
                        </div>
                        
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-wide mb-3" x-text="exp.company || 'Entreprise'"></p>
                        
                        <p class="text-slate-600 leading-relaxed max-w-2xl" x-text="exp.description || ''"></p>
                    </div>
                </template>
                <template x-if="experiances.length === 0">
                    <p class="text-slate-400 italic pl-8">Aucune expérience renseignée.</p>
                </template>
            </div>
        </div>

    </div>

    <!-- Modals (Alpine.js) -->
    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4 sm:px-6">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="modalOpen = false"></div>
        
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-float">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-white z-10 relative">
                <h3 class="text-xl font-black font-outfit text-slate-900" x-text="modalTitle"></h3>
                <button @click="modalOpen = false" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 max-h-[70vh] overflow-y-auto">
                
                <!-- General Info Form -->
                <div x-show="activeTab === 'general'">
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="general">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Photo de profil</label>
                                <input type="file" name="photo" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Photo de couverture</label>
                                <input type="file" name="cover_image" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Titre du Profil</label>
                            <input type="text" name="title" x-model="title" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="Ex: Développeur Fullstack">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Biographie</label>
                            <textarea name="bio" x-model="bio" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="Parlez-nous de vous..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Téléphone</label>
                            <input type="text" name="phone" x-model="phone" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="+212 6...">
                        </div>
                        <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Enregistrer</button>
                    </form>
                </div>

                <!-- Skills Form -->
                <div x-show="activeTab === 'skills'">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="section" value="skills">
                        
                        <div class="flex gap-2 mb-6">
                            <input type="text" x-model="newSkill" @keydown.enter.prevent="addSkill()" class="flex-grow px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Nouvelle compétence (ex: React)">
                            <button type="button" @click="addSkill()" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors">Ajouter</button>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(skill, index) in skills" :key="index">
                                <div class="flex items-center gap-2 px-3 py-2 bg-slate-100 rounded-lg group">
                                    <span class="text-sm font-bold text-slate-700" x-text="skill"></span>
                                    <input type="hidden" name="skills[]" :value="skill">
                                    <button type="button" @click="removeSkill(index)" class="text-slate-400 hover:text-red-500">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button type="submit" class="w-full mt-8 py-4 bg-slate-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Enregistrer les compétences</button>
                    </form>
                </div>

                <!-- Experiences Form -->
                <div x-show="activeTab === 'experiances'">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="section" value="experiances">
                        
                        <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-900 mb-4" x-text="editingExperience !== null ? 'Modifier l\'expérience' : 'Ajouter une expérience'"></h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <input type="text" x-model="tempExperience.role" class="px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Poste (ex: Senior Dev)">
                                <input type="text" x-model="tempExperience.company" class="px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Entreprise">
                            </div>
                            <input type="text" x-model="tempExperience.duration" class="w-full mb-4 px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Durée (ex: 2020 - 2022)">
                            <textarea x-model="tempExperience.description" class="w-full mb-4 px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Description..."></textarea>
                            
                            <div class="flex gap-3">
                                <button type="button" @click="saveExperienceLocally()" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors" x-text="editingExperience !== null ? 'Mettre à jour' : 'Ajouter à la liste'"></button>
                                <button type="button" x-show="editingExperience !== null" @click="cancelEditExperience()" class="px-4 py-3 bg-slate-200 text-slate-700 rounded-xl font-bold hover:bg-slate-300">Annuler</button>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(exp, index) in experiances" :key="index">
                                <div class="p-4 border border-slate-100 rounded-xl flex justify-between items-start bg-white hover:border-indigo-100 transition-colors">
                                    <div>
                                        <h5 class="font-bold text-slate-900" x-text="exp.role"></h5>
                                        <p class="text-sm text-slate-500" x-text="exp.company + ' | ' + exp.duration"></p>
                                        
                                        <input type="hidden" :name="'experiances['+index+'][role]'" :value="exp.role">
                                        <input type="hidden" :name="'experiances['+index+'][company]'" :value="exp.company">
                                        <input type="hidden" :name="'experiances['+index+'][duration]'" :value="exp.duration">
                                        <input type="hidden" :name="'experiances['+index+'][description]'" :value="exp.description">
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="button" @click="editExperience(index)" class="text-indigo-600 hover:text-indigo-800 text-xs font-bold px-2 py-1 bg-indigo-50 rounded-lg">Modifier</button>
                                        <button type="button" @click="removeExperience(index)" class="text-red-500 hover:text-red-700 text-xs font-bold px-2 py-1 bg-red-50 rounded-lg">Supprimer</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <button type="submit" class="w-full mt-6 py-4 bg-slate-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Enregistrer les expériences</button>
                    </form>
                </div>

                <!-- Projects Form -->
                <div x-show="activeTab === 'projects'">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="section" value="projects">
                        
                        <!-- Add New Project Form (Metadata only) -->
                        <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-900 mb-4">Ajouter un nouveau projet</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <input type="text" x-model="tempProject.title" class="px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Titre du projet">
                                <input type="text" x-model="tempProject.category" class="px-4 py-3 rounded-xl bg-white border border-slate-200 focus:ring-2 focus:ring-indigo-500" placeholder="Catégorie (ex: Web App)">
                            </div>
                            <p class="text-xs text-slate-500 mb-4">Ajoutez le projet à la liste, puis vous pourrez télécharger l'image directement sur la carte du projet ci-dessous.</p>
                            
                            <button type="button" @click="saveProjectLocally()" class="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors">
                                Ajouter à la liste
                            </button>
                        </div>

                        <div class="space-y-6">
                            <template x-for="(proj, index) in projects" :key="index">
                                <div class="p-6 border border-slate-200 rounded-[2rem] bg-white relative group">
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                        <!-- Image Section -->
                                        <div class="sm:col-span-1">
                                            <div class="aspect-video rounded-xl overflow-hidden bg-slate-100 relative mb-3 border border-slate-100">
                                                <template x-if="proj.image">
                                                    <img :src="getProject   ImageUrl(proj.image)" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!proj.image">
                                                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    </div>
                                                </template>
                                            </div>
                                            <!-- File Input for THIS project -->
                                            <input type="file" :name="'projects['+index+'][image]'" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                            <input type="hidden" :name="'projects['+index+'][image]'" :value="proj.image" x-if="proj.image">
                                        </div>

                                        <!-- Details Section -->
                                        <div class="sm:col-span-2 flex flex-col justify-center">
                                            <div class="mb-3">
                                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Titre</label>
                                                <input type="text" :name="'projects['+index+'][title]'" x-model="proj.title" class="w-full px-3 py-2 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-bold text-slate-900">
                                            </div>
                                            <div class="mb-3">
                                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Catégorie</label>
                                                <input type="text" :name="'projects['+index+'][category]'" x-model="proj.category" class="w-full px-3 py-2 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 text-sm font-medium">
                                            </div>
                                            
                                            <button type="button" @click="removeProject(index)" class="self-start text-red-500 hover:text-red-700 text-xs font-bold flex items-center gap-1 mt-2">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                Supprimer le projet
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <button type="submit" class="w-full mt-6 py-4 bg-slate-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Enregistrer les projets</button>
                    </form>
                </div>

                <!-- Entreprise Form -->
                <div x-show="activeTab === 'entreprise'">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="section" value="entreprise">
                        
                        <div class="flex items-center gap-6">
                             <div class="w-24 h-24 rounded-xl bg-slate-50 border border-slate-100 overflow-hidden relative flex-shrink-0">
                                <template x-if="entreprise.logo">
                                    <img :src="getProjectImageUrl(entreprise.logo)" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!entreprise.logo">
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m8-2a2 2 0 01-2-2 2 2 0 012-2h.01M9 17h.01M9 13h.01M15 21v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5h6z" /></svg>
                                    </div>
                                </template>
                             </div>
                             <div class="flex-grow">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Logo de l'entreprise</label>
                                <input type="file" name="entreprise_logo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                             </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nom de l'entreprise</label>
                            <input type="text" name="entreprise_nom" x-model="entreprise.nom" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="TechSolutions SARL">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Localisation</label>
                            <input type="text" name="entreprise_location" x-model="entreprise.location" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="Casablanca, Maroc">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                            <textarea name="entreprise_description" x-model="entreprise.description" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 transition-all font-medium" placeholder="Ce que fait votre entreprise..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Enregistrer l'entreprise</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    window.storageUrl = "{{ asset('storage') }}";
</script>

<script>
function profileManager() {
    @php
        $defaultEntreprise = [
            'nom' => '',
            'description' => '',
            'location' => '',
            'logo' => ''
        ];
    @endphp
    return {

        title: @json($user->profile->title ?? ''),
        bio: @json($user->profile->bio ?? ''),
        phone: @json($user->phone ?? ''),
        skills: @json($user->profile->skills ?? []),
        experiances: @json($user->profile->experiances ?? []),
        projects: @json($user->profile->projects ?? []),
        entreprise: @json($entreprise ?? $defaultEntreprise),
        
        modalOpen: false,     
        activeTab: 'general',
        newSkill: '',
        
        editingExperience: null, 
        editingProject: null, 
        

        getProjectImageUrl(image) {
            if (!image) return null;
            if (image.startsWith('http') || image.startsWith('data:')) {
                return image;
            }
            const cleanImage = image.replace(/^\/+/, '');
            return window.storageUrl + '/' + cleanImage;
        }, 

        tempExperience: { role: '', company: '', duration: '', description: '' },
        tempProject: { title: '', category: '', image: '' },

        get modalTitle() {
            const titles = {
                'general': 'Modifier le profil',
                'skills': 'Gérer les compétences',
                'experiances': 'Expériences professionnelles',
                'projects': 'Mes projets',
                'entreprise': 'Mon Entreprise'
            };
            return titles[this.activeTab] || 'Modifier';
        },

        openModal(tab) {
            this.activeTab = tab;
            this.modalOpen = true;
            this.cancelEditExperience(); 
            this.cancelEditProject();   
        },

        addSkill() {
            if (this.newSkill.trim()) {
                this.skills.push(this.newSkill.trim()); 
                this.newSkill = ''; 
            }
        },
        removeSkill(index) {
            this.skills.splice(index, 1);
        },

        saveExperienceLocally() {
            if (this.tempExperience.role && this.tempExperience.company) {
                if (this.editingExperience !== null) {
                    this.experiances[this.editingExperience] = {...this.tempExperience};
                } else {
                    this.experiances.push({...this.tempExperience});
                }
                this.cancelEditExperience(); 
            }
        },
        editExperience(index) {
            this.editingExperience = index; 
            this.tempExperience = {...this.experiances[index]};
        },
        removeExperience(index) {
            this.experiances.splice(index, 1);
            if (this.editingExperience === index) this.cancelEditExperience();
        },
        cancelEditExperience() {
            this.editingExperience = null;
            this.tempExperience = { role: '', company: '', duration: '', description: '' };
        },

        saveProjectLocally() {
            if (this.tempProject.title) {
                if (this.editingProject !== null) {
                    this.projects[this.editingProject] = {...this.tempProject};
                } else {
                    this.projects.push({...this.tempProject});
                }
                this.cancelEditProject();
            }
        },
        editProject(index) {
            this.editingProject = index;
            this.tempProject = {...this.projects[index]};
        },
        removeProject(index) {
            this.projects.splice(index, 1);
            if (this.editingProject === index) this.cancelEditProject();
        },
        cancelEditProject() {
            this.editingProject = null;
            this.tempProject = { title: '', category: '', image: '' };
        }
    }
}
</script>
@endsection