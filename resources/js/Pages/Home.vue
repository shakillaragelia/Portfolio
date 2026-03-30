<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import NavBar from '../Components/sections/NavBar.vue';
import HeroSection from '../Components/sections/HeroSection.vue';
import AboutSection from '../Components/sections/AboutSection.vue';
import SkillsSection from '../Components/sections/SkillsSection.vue';
import ProjectsSection from '../Components/sections/ProjectsSection.vue';
import SecuritySection from '../Components/sections/SecuritySection.vue';
import ContactSection from '../Components/sections/ContactSection.vue';

// The 'portfolio' prop is passed automatically by Inertia from PortfolioController
const props = defineProps({
    portfolio: Object,
});
</script>

<template>
    <Head title="Home" />
    
    <div class="min-h-screen bg-slate-950 text-slate-200 selection:bg-indigo-500 selection:text-white">
        <!-- Floating Navigation -->
        <NavBar />

        <main class="space-y-32 pb-32">
            <!-- Hero Section -->
            <HeroSection :data="portfolio.hero" />

            <!-- About Section -->
            <AboutSection :data="portfolio.about" />

            <!-- Skills Section -->
            <SkillsSection :skills="portfolio.skills" />

            <!-- Projects Section -->
            <ProjectsSection :projects="portfolio.projects" />

            <!-- Cyber Security Interests -->
            <SecuritySection :interests="portfolio.security_interests" />

            <!-- Contact Section -->
            <ContactSection :contact="portfolio.contact" />
        </main>

        <footer class="py-10 border-t border-slate-800 text-center text-slate-500 text-sm">
            <p>&copy; {{ new Date().getFullYear() }} {{ portfolio.hero.name }}. All rights reserved.</p>
        </footer>
    </div>
</template>
