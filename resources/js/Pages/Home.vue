<script setup>
import { onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import NavBar          from '@/Components/sections/NavBar.vue'
import HeroSection     from '@/Components/sections/HeroSection.vue'
import AboutSection    from '@/Components/sections/AboutSection.vue'
import SkillsSection   from '@/Components/sections/SkillsSection.vue'
import ProjectsSection from '@/Components/sections/ProjectsSection.vue'
import SecuritySection from '@/Components/sections/SecuritySection.vue'
import ContactSection  from '@/Components/sections/ContactSection.vue'

// Props dari PortfolioController (DB)
const props = defineProps({
    projects: Array,
    comments: Array,
    settings: Object,
})

// Scroll reveal — intersect observer sederhana
onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80)
                observer.unobserve(entry.target)
            }
        })
    }, { threshold: 0.08 })

    document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el))
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

        <footer class="border-t border-[rgba(0,180,216,0.1)] py-8 text-center">
            <p class="font-mono text-xs text-[#0a2347] tracking-widest">
                © {{ new Date().getFullYear() }} {{ settings?.name ?? 'YourName' }}
                &nbsp;·&nbsp; Built with Laravel + Vue.js
            </p>
        </footer>
    </div>
</template>