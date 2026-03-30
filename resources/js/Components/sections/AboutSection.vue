<script setup>
defineProps({
    data: Object
});
</script>

<template>
    <section id="about" class="py-20 bg-slate-900 border-y border-slate-800">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-5xl font-bold bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent mb-10 inline-block">{{ data.title }}</h2>
            <div class="p-8 lg:p-12 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <p class="text-lg lg:text-2xl text-slate-300 font-light leading-relaxed">
                    {{ data.content }}
                </p>
                <!-- Decorative Elements -->
                <div class="h-1 w-20 bg-teal-500 rounded-full mx-auto mt-8 opacity-50"></div>
            </div>
        </div>
    </section>
</template>
