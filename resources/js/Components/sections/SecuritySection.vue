<script setup>
defineProps({
    interests: Array
});
</script>

<template>
    <section id="security" class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] z-[-1]"></div>
        
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl lg:text-5xl font-bold mb-10 text-teal-400 drop-shadow-[0_0_15px_rgba(45,212,191,0.5)]">Cyber Security Focus</h2>
            <div class="p-8 lg:p-12 bg-slate-950 border-2 border-slate-800 rounded-3xl shadow-[0_0_50px_rgba(20,184,166,0.1)] relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-500/20 blur-3xl rounded-full"></div>
                <div class="flex flex-col gap-6">
                    <div v-for="(interest, i) in interests" :key="i" class="flex items-center gap-4 text-left p-4 bg-slate-900 border border-slate-800 rounded-xl hover:border-teal-500/50 transition-colors">
                        <div class="flex-shrink-0 w-12 h-12 bg-slate-800 rounded-lg flex items-center justify-center text-teal-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <span class="text-lg text-slate-300 font-medium">{{ interest }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
