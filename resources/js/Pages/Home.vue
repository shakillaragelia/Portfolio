<script setup>
import NavBar           from '@/Components/sections/NavBar.vue'
import HeroSection      from '@/Components/sections/HeroSection.vue'
import AboutSection     from '@/Components/sections/AboutSection.vue'
import PortfolioSection from '@/Components/sections/PortfolioSection.vue'
import ContactSection   from '@/Components/sections/ContactSection.vue'
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
            <HeroSection      :settings="settings" />
            <AboutSection     :settings="settings" />
            <PortfolioSection :projects="projects" />
            <ContactSection   :settings="settings" :comments="comments" />
        </main>
        <footer class="border-t border-[rgba(0,180,216,0.1)] py-6 text-center">
            <p class="font-mono text-xs tracking-widest"
               style="color: rgba(144,224,239,0.35)">
                © {{ new Date().getFullYear() }} {{ settings?.name ?? 'YourName' }}
                &nbsp;·&nbsp; Built with Laravel + Vue.js
            </p>
        </footer>
    </div>
</template>
