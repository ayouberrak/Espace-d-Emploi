@extends('layouts.app')

@section('title', 'Profil - YouConnect')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 auto-rows-min">
        
        <!-- 1. Profile Main Card (Large) -->
        <div class="md:col-span-2 lg:col-span-2 row-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden group">
            <div class="absolute inset-x-0 h-40 bg-gradient-to-r from-slate-100 to-white top-0"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <div class="w-40 h-40 rounded-[2.5rem] p-1.5 bg-white shadow-xl rotate-0 group-hover:rotate-2 transition-all duration-500 mb-6">
                    <div class="w-full h-full rounded-[2rem] overflow-hidden bg-slate-50 relative">
                        @if($user['avatar'])
                            <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-slate-300 text-5xl">{{ substr($user['name'], 0, 1) }}</div>
                        @endif
                        @if($isMe)
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity cursor-pointer">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        @endif
                    </div>
                </div>
                
                <h1 class="text-3xl font-black text-slate-900 font-outfit mb-2">{{ $user['name'] }}</h1>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-50 rounded-full border border-slate-100 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-slate-600">{{ $user['specialty'] }}</span>
                </div>
                
                <p class="text-slate-500 font-medium leading-relaxed max-w-sm mx-auto mb-8">
                    {{ $user['bio'] }}
                </p>

                <div class="flex gap-3">
                    <button class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-xl shadow-slate-900/10 hover:shadow-slate-900/20 hover:-translate-y-1 transition-all active:scale-95">
                        Contacter
                    </button>
                    @if($isMe)
                    <button class="bg-white border border-slate-200 text-slate-900 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">
                        Editer
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- 2. Skills Card -->
        <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary-500/20 blur-3xl rounded-full group-hover:bg-primary-500/30 transition-colors"></div>
            
            <h3 class="font-black font-outfit text-lg mb-6 flex items-center justify-between">
                Skills
                @if($isMe) <button onclick="toggleModal('skillModal')" class="relative z-10 cursor-pointer text-slate-500 hover:text-white transition-colors text-2xl" type="button">+</button> @endif
            </h3>
            
            <div class="flex flex-wrap gap-2">
                @foreach($user['skills'] as $skill)
                <span class="px-3 py-1.5 rounded-lg bg-white/10 border border-white/10 text-xs font-bold hover:bg-white/20 transition-colors cursor-default">
                    {{ $skill }}
                </span>
                @endforeach
            </div>
        </div>

        <!-- 3. Stats / Contact -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm flex flex-col justify-between group hover:border-primary-100 transition-colors">
            <div>
                <h3 class="font-black font-outfit text-slate-400 text-xs uppercase tracking-widest mb-4">Location</h3>
                <p class="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    {{ $user['location'] }}
                </p>
            </div>
            <div class="mt-6">
                <h3 class="font-black font-outfit text-slate-400 text-xs uppercase tracking-widest mb-4">Email</h3>
                <p class="text-sm font-bold text-slate-900 truncate">{{ $user['email'] }}</p>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-50 text-center">
                 <span class="text-[10px] font-black uppercase text-slate-300">Member since 2023</span>
            </div>
        </div>

        <!-- 4. Portfolio (Full Width on mobile, 2 cols on lg) -->
        <div class="md:col-span-3 lg:col-span-4">
            <h2 class="text-2xl font-black text-slate-900 font-outfit mb-6 px-2 flex items-center gap-4">
                Portfolio Showcase 
                <span class="h-px bg-slate-200 flex-grow"></span>
                @if($isMe) <button onclick="toggleModal('projectModal')" class="text-xs font-bold text-primary-600 uppercase tracking-widest hover:underline">+ Add Project</button> @endif
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($user['projects'] as $project)
                <div class="group relative rounded-[2rem] overflow-hidden aspect-[4/3] cursor-pointer">
                    <img src="{{ $project['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                        <span class="text-primary-400 text-xs font-black uppercase tracking-widest mb-1 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">{{ $project['category'] }}</span>
                        <h3 class="text-white text-xl font-bold translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">{{ $project['title'] }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 5. Experience Timeline (Wide) -->
        <div class="md:col-span-3 lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
            <h3 class="font-black font-outfit text-lg mb-8">Expérience</h3>
            <div class="space-y-8 relative pl-4 border-l-2 border-slate-100">
                @foreach($user['experience'] as $exp)
                <div class="relative pl-6">
                    <div class="absolute -left-[21px] top-1.5 w-3 h-3 bg-white border-2 border-primary-500 rounded-full"></div>
                    <h4 class="font-bold text-slate-900">{{ $exp['role'] }}</h4>
                    <p class="text-xs font-bold text-primary-600 uppercase tracking-wide mb-1">{{ $exp['company'] }}</p>
                    <p class="text-xs text-slate-400 mb-2">{{ $exp['duration'] }}</p>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $exp['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

         <!-- 6. Education (Small) -->
         <div class="md:col-span-3 lg:col-span-2 bg-gradient-to-br from-slate-50 to-white rounded-[2.5rem] p-8 border border-slate-100 shadow-inner">
            <h3 class="font-black font-outfit text-lg mb-8">Éducation</h3>
            <div class="space-y-4">
                @foreach($user['education'] as $edu)
                <div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-lg">🎓</div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">{{ $edu['degree'] }}</h4>
                        <p class="text-xs text-slate-500">{{ $edu['school'] }}</p>
                    </div>
                    <span class="ml-auto text-xs font-black text-slate-300">{{ $edu['years'] }}</span>
                </div>
                @endforeach
            </div>
        </div>


    <!-- Modals -->
    
    <!-- Add Skill Modal -->
    <div id="skillModal" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 backdrop" onclick="toggleModal('skillModal')"></div>
        
        <!-- Modal Content -->
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-[2rem] w-full max-w-md p-8 shadow-2xl scale-95 opacity-0 transition-all duration-300 transform modal-content" id="skillModalContent">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-slate-900 font-outfit">Ajouter Skill</h3>
                    <button type="button" onclick="toggleModal('skillModal')" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-100 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form onsubmit="event.preventDefault(); toggleModal('skillModal'); alert('Compétence ajoutée ! (Simulation)');">
                    <div class="space-y-4 mb-8">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nom de la compétence</label>
                            <input type="text" placeholder="Ex: Alpine.js" class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-900 focus:ring-2 focus:ring-primary-500/50 outline-none">
                        </div>
                        <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Niveau</label>
                             <div class="flex gap-2">
                                 <span class="px-3 py-1 bg-primary-600 text-white rounded-lg text-xs font-bold cursor-pointer">Expert</span>
                                 <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold cursor-pointer hover:bg-slate-200">Intermédiaire</span>
                                 <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-bold cursor-pointer hover:bg-slate-200">Débutant</span>
                             </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-slate-900 text-white py-3.5 rounded-xl font-black text-sm hover:bg-primary-600 transition-colors shadow-lg shadow-slate-900/10 cursor-pointer">
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div id="projectModal" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 backdrop" onclick="toggleModal('projectModal')"></div>
        
        <!-- Modal Content -->
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-8 shadow-2xl scale-95 opacity-0 transition-all duration-300 transform modal-content" id="projectModalContent">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-slate-900 font-outfit">Nouveau Projet</h3>
                    <button type="button" onclick="toggleModal('projectModal')" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-slate-100 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                <form onsubmit="event.preventDefault(); toggleModal('projectModal'); alert('Projet ajouté ! (Simulation)');">
                    <div class="space-y-4 mb-8">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Titre du projet</label>
                            <input type="text" placeholder="Ex: Redesign Dashboard" class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-900 focus:ring-2 focus:ring-primary-500/50 outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Catégorie</label>
                                <input type="text" placeholder="Ex: UI/UX" class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-900 focus:ring-2 focus:ring-primary-500/50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Image URL</label>
                                <input type="text" placeholder="https://..." class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-900 focus:ring-2 focus:ring-primary-500/50 outline-none">
                            </div>
                        </div>
                        <div class="h-32 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 cursor-pointer hover:border-primary-300 hover:text-primary-500 transition-colors">
                            <svg class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span class="text-xs font-bold uppercase tracking-widest">Upload Image</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-slate-900 text-white py-3.5 rounded-xl font-black text-sm hover:bg-primary-600 transition-colors shadow-lg shadow-slate-900/10 cursor-pointer">
                        Publier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        const backdrop = modal.querySelector('.backdrop');
        const content = modal.querySelector('.modal-content');
        
        if (modal.classList.contains('hidden')) {
            // Open
            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            // Close
            backdrop.classList.add('opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }
</script>
@endsection
