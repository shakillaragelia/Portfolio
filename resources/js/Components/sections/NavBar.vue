<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

defineProps({ settings: Object })

const scrolled      = ref(false)
const activeSection = ref('hero')
const menuOpen      = ref(false)

const links = [
    { id: 'hero',     label: 'Home'     },
    { id: 'about',    label: 'About'    },
    { id: 'skills',   label: 'Skills'   },
    { id: 'projects', label: 'Projects' },
    { id: 'contact',  label: 'Contact'  },
]

function scrollTo(id) {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    menuOpen.value = false
}

function onScroll() {
    scrolled.value = window.scrollY > 80
    for (let i = links.length - 1; i >= 0; i--) {
        const el = document.getElementById(links[i].id)
        if (el && window.scrollY >= el.offsetTop - 140) {
            activeSection.value = links[i].id
            break
        }
    }
}

// Custom cursor
let cx = 0, cy = 0, rx = 0, ry = 0, animId = null

function onMouseMove(e) { cx = e.clientX; cy = e.clientY }

function onMouseOver(e) {
    const dot  = document.getElementById('c-dot')
    const ring = document.getElementById('c-ring')
    if (!dot || !ring) return
    if (e.target.closest('a,button,[data-cursor-hover]')) {
        ring.style.width  = '48px'; ring.style.height = '48px'
        ring.style.borderColor = 'rgba(72,202,228,0.7)'
        dot.style.transform = 'translate(-50%,-50%) scale(0.3)'
    } else {
        ring.style.width  = '30px'; ring.style.height = '30px'
        ring.style.borderColor = 'rgba(0,180,216,0.4)'
        dot.style.transform = 'translate(-50%,-50%) scale(1)'
    }
}

function animateCursor() {
    const dot  = document.getElementById('c-dot')
    const ring = document.getElementById('c-ring')
    if (dot)  { dot.style.left  = cx + 'px'; dot.style.top  = cy + 'px' }
    rx += (cx - rx) * 0.1; ry += (cy - ry) * 0.1
    if (ring) { ring.style.left = rx + 'px'; ring.style.top = ry + 'px' }
    animId = requestAnimationFrame(animateCursor)
}

onMounted(() => {
    window.addEventListener('scroll', onScroll, { passive: true })
    window.addEventListener('mousemove', onMouseMove)
    window.addEventListener('mouseover', onMouseOver)
    animId = requestAnimationFrame(animateCursor)
})

onUnmounted(() => {
    window.removeEventListener('scroll', onScroll)
    window.removeEventListener('mousemove', onMouseMove)
    window.removeEventListener('mouseover', onMouseOver)
    if (animId) cancelAnimationFrame(animId)
})
</script>

<template>
    <!-- Custom Cursor -->
    <div id="c-dot"
         class="fixed w-2 h-2 rounded-full bg-[#48cae4] pointer-events-none z-[9999] hidden md:block"
         style="transform:translate(-50%,-50%); transition:transform 0.15s"></div>
    <div id="c-ring"
         class="fixed rounded-full border border-[rgba(0,180,216,0.4)] pointer-events-none z-[9998] hidden md:block"
         style="width:30px;height:30px;transform:translate(-50%,-50%);transition:width 0.15s,height 0.15s,border-color 0.2s"></div>

    <header class="fixed top-0 inset-x-0 z-50 px-6 lg:px-10 pt-4">
        <nav class="w-full transition-all duration-300"
             :class="scrolled
                ? 'bg-[rgba(2,12,27,0.92)] backdrop-blur-xl border border-[rgba(0,180,216,0.15)] rounded-2xl px-6 py-3 shadow-lg shadow-black/30'
                : 'px-2 py-3'">
            <div class="flex items-center justify-between">

                <!-- Logo -->
                <a href="#hero" class="font-mono text-sm font-semibold text-[#48cae4] tracking-wide"
                   @click.prevent="scrollTo('hero')">
                    <span style="color:rgba(72,202,228,0.4)">&lt;</span>
                    {{ (settings?.name ?? 'Dev').split(' ')[0] }}
                    <span style="color:rgba(72,202,228,0.4)">/&gt;</span>
                </a>

                <!-- Desktop links -->
                <ul class="hidden md:flex items-center gap-1">
                    <li v-for="link in links" :key="link.id">
                        <a :href="'#' + link.id"
                           class="px-3 py-1.5 rounded-lg font-mono text-xs tracking-widest uppercase transition-all duration-200"
                           :class="activeSection === link.id
                               ? 'text-[#48cae4] bg-[rgba(0,180,216,0.12)] border border-[rgba(0,180,216,0.2)]'
                               : 'text-[#90e0ef] hover:text-white hover:bg-[rgba(0,180,216,0.07)]'"
                           @click.prevent="scrollTo(link.id)">
                            {{ link.label }}
                        </a>
                    </li>
                </ul>

                <!-- CTA -->
                <a href="#contact"
                   class="hidden md:inline-flex px-4 py-1.5 rounded-lg
                          border border-[rgba(0,180,216,0.35)] font-mono text-xs text-[#48cae4] tracking-wide
                          hover:bg-[#48cae4] hover:text-[#020c1b] hover:border-[#48cae4]
                          transition-all duration-200 font-semibold"
                   @click.prevent="scrollTo('contact')">
                    Let's Talk
                </a>

                <!-- Hamburger -->
                <button class="md:hidden flex flex-col gap-1.5 p-1" @click="menuOpen = !menuOpen">
                    <span v-for="i in 3" :key="i" class="block w-5 h-0.5 bg-[#90e0ef] rounded"></span>
                </button>
            </div>

            <!-- Mobile menu -->
            <div v-show="menuOpen" class="md:hidden pt-3 mt-3 border-t border-[rgba(0,180,216,0.1)] flex flex-col gap-1">
                <a v-for="link in links" :key="link.id" :href="'#' + link.id"
                   class="px-3 py-2 rounded-lg font-mono text-xs tracking-widest uppercase text-[#90e0ef] hover:text-white"
                   @click.prevent="scrollTo(link.id)">
                    {{ link.label }}
                </a>
            </div>
        </nav>
    </header>
</template>

<style>
@media (min-width: 768px) { * { cursor: none !important; } }
</style>
