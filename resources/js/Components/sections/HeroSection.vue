<script setup>
defineProps({
    data: Object
});
</script>

<template>
    <section class="relative pt-40 pb-20 lg:pt-48 lg:pb-32 overflow-hidden overflow-x-clip px-6 lg:px-8 max-w-6xl mx-auto flex flex-col-reverse lg:flex-row items-center justify-between gap-16">
        
        <!-- Background Glow -->
        <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-teal-500/20 rounded-full blur-[120px] pointer-events-none -z-10"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none -z-10"></div>

        <!-- Content -->
        <div class="flex-1 text-center lg:text-left z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/50 border border-slate-700/50 mb-6 font-mono text-sm text-teal-300">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                Available for New Projects
            </div>
            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 bg-gradient-to-br from-white via-slate-200 to-slate-400 bg-clip-text text-transparent leading-[1.1]">
                Hi, I'm <br class="hidden lg:block"/>
                <span class="text-teal-400">{{ data.name }}</span>
            </h1>
            <p class="text-xl lg:text-2xl text-slate-400 font-medium mb-4">
                {{ data.role }}
            </p>
            <p class="text-slate-500 text-lg max-w-xl mx-auto lg:mx-0 mb-10 leading-relaxed">
                {{ data.tagline }} <br>
                {{ data.description }}
            </p>

            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
                <a href="#projects" class="px-8 py-4 bg-teal-500 hover:bg-teal-400 text-slate-950 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(20,184,166,0.3)] hover:shadow-[0_0_30px_rgba(20,184,166,0.5)] transform hover:-translate-y-1">
                    View My Work
                </a>
                <a href="#contact" class="px-8 py-4 bg-slate-800 hover:bg-slate-700 text-white rounded-xl font-bold transition-all border border-slate-700 hover:border-slate-500">
                    Get in Touch
                </a>
            </div>
        </div>

        <!-- Image -->
        <div class="relative w-64 h-64 lg:w-96 lg:h-96 shrink-0 z-10">
            <div class="absolute inset-0 bg-gradient-to-tr from-teal-500/20 to-indigo-500/20 rounded-full blur-3xl animate-pulse"></div>
            <!-- Dummy Photo Box (If image doesn't exist, this box styling will look cool) -->
            <div class="w-full h-full p-2 rounded-3xl bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm relative overflow-hidden group">
                <img :src="data.image" alt="Avatar" class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-700 filter grayscale group-hover:grayscale-0" onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=600&auto=format&fit=crop'" />
                <div class="absolute inset-0 ring-1 ring-inset ring-white/10 rounded-2xl"></div>
            </div>
        </div>
    </section>
</template>
