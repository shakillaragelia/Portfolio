<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isScrolled = ref(false);

const checkScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
    window.addEventListener('scroll', checkScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', checkScroll);
});
</script>

<template>
    <div 
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
        :class="isScrolled ? 'py-4 backdrop-blur-md bg-slate-950/80 border-b border-slate-800 shadow-lg shadow-black/20' : 'py-6'"
    >
        <div class="max-w-6xl mx-auto px-6 lg:px-8 flex justify-between items-center">
            <a href="#" class="text-xl font-bold bg-gradient-to-r from-teal-400 to-indigo-500 bg-clip-text text-transparent tracking-tight">
                JOHN.DOE
            </a>
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-300">
                <a href="#about" class="hover:text-teal-400 transition-colors">About</a>
                <a href="#skills" class="hover:text-teal-400 transition-colors">Skills</a>
                <a href="#projects" class="hover:text-teal-400 transition-colors">Projects</a>
                <a href="#security" class="hover:text-teal-400 transition-colors">Security</a>
                <a href="#contact" class="px-4 py-2 rounded-full border border-slate-700 hover:border-teal-400 hover:text-teal-400 transition-all duration-300 font-semibold shadow-[0_0_15px_rgba(45,212,191,0)] hover:shadow-[0_0_15px_rgba(45,212,191,0.2)]">
                    Let's Talk
                </a>
            </nav>
        </div>
    </div>
</template>
