<script setup>
defineProps({
    projects: Array
});
</script>

<template>
    <section id="projects" class="py-20 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl lg:text-5xl font-bold mb-16 inline-flex flex-col gap-2">
                <span class="text-slate-400 text-lg font-mono tracking-widest uppercase">Portfolio Portfolio</span>
                <span class="bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Selected Projects</span>
            </h2>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div v-for="(project, idx) in projects" :key="idx" 
                     class="group bg-slate-950 rounded-3xl overflow-hidden border border-slate-800/60 hover:border-teal-500/50 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-500/20">
                    
                    <!-- Image Wrapper -->
                    <div class="overflow-hidden aspect-video relative">
                        <div class="absolute inset-0 bg-slate-900/50 mix-blend-multiply z-10 group-hover:bg-transparent transition-colors duration-500"></div>
                        <img :src="project.image" :alt="project.title" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-teal-400 transition-colors">{{ project.title }}</h3>
                        <p class="text-slate-400 mb-6 leading-relaxed flex-grow">{{ project.description }}</p>
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span v-for="(tag, tIdx) in project.tags" :key="tIdx" 
                                  class="text-xs font-semibold px-3 py-1 bg-slate-800 text-teal-300 rounded-full border border-teal-500/20">
                                {{ tag }}
                            </span>
                        </div>

                        <!-- Link -->
                        <a :href="project.link" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-white hover:text-teal-400 transition-colors">
                            View Project 
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
