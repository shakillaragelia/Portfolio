<script setup>
defineProps({
    skills: Array
});
</script>

<template>
    <section id="skills" class="py-20 relative">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl lg:text-5xl font-bold mb-16 text-center">
                <span class="bg-gradient-to-r from-teal-400 to-indigo-500 bg-clip-text text-transparent">Professional Skills</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(skill, index) in skills" :key="index" 
                     class="p-6 bg-slate-900/50 backdrop-blur-md border border-slate-800 rounded-2xl hover:border-teal-500/50 transition-colors group">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-slate-200 group-hover:text-teal-400 transition-colors">{{ skill.name }}</h3>
                        <span class="text-lg font-mono text-teal-500 font-bold bg-teal-500/10 px-2 py-1 rounded">{{ skill.level }}%</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden">
                        <div 
                            class="h-full bg-gradient-to-r from-teal-500 to-indigo-500 transition-all duration-1000 ease-out"
                            :style="{ width: skill.level + '%' }"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
