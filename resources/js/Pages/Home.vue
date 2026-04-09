<script setup>
import NavBar          from '@/Components/sections/NavBar.vue'
import HeroSection     from '@/Components/sections/HeroSection.vue'
import AboutSection    from '@/Components/sections/AboutSection.vue'
import SkillsSection   from '@/Components/sections/SkillsSection.vue'
import ProjectsSection from '@/Components/sections/ProjectsSection.vue'
import SecuritySection from '@/Components/sections/SecuritySection.vue'
import ContactSection  from '@/Components/sections/ContactSection.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    projects: Array,
    comments: Array,
    settings: Object,
})
</script>

<template>
    <Head :title="settings?.name ?? 'Portfolio'" />
    <div class="min-h-screen">
        <NavBar :settings="settings" />
        <main>
            <HeroSection     :settings="settings" />
            <AboutSection    :settings="settings" />
            <SkillsSection />
            <ProjectsSection :projects="projects" />
            <SecuritySection />
            <ContactSection  :settings="settings" :comments="comments" />
        </main>
        <footer class="border-t border-[rgba(0,180,216,0.1)] py-6 text-center">
            <p class="font-mono text-xs text-[#7ab8cc] tracking-widest opacity-40">
                © {{ new Date().getFullYear() }} {{ settings?.name ?? 'YourName' }}
                &nbsp;·&nbsp; Built with Laravel + Vue.js
            </p>
        </footer>
    </div>
</template>
