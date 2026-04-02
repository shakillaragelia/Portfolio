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
    { id: 'security', label: 'Security' },
    { id: 'contact',  label: 'Contact'  },
]

function scrollTo(id) {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    menuOpen.value = false
}

function onScroll() {
    scrolled.value = window.scrollY > 80
    // Detect active section
    for (let i = links.length - 1; i >= 0; i--) {
        const el = document.getElementById(links[i].id)
        if (el && window.scrollY >= el.offsetTop - 140) {
            activeSection.value = links[i].id
            break
        }
    }
}

onMounted(()  => window.addEventListener('scroll', onScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', onScroll))
</script>

<template>
    <header class="fixed top-0 inset-x-0 z-50 flex justify-center pt-4 px-4">
        <nav
            class="w-full max-w-4xl transition-all duration-300"
            :class="scrolled
                ? 'bg-[rgba(2,12,27,0.85)] backdrop-blur-xl border border-[rgba(0,180,216,0.15)] rounded-2xl px-5 py-3 shadow-lg shadow-black/30'
                : 'px-5 py-3'"
        >
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a
                    href="#hero"
                    class="font-mono text-sm font-semibold text-[#00b4d8] tracking-wide"
                    @click.prevent="scrollTo('hero')"
                >
                    <span class="text-[rgba(0,180,216,0.4)]">&lt;</span>
                    {{ (settings?.name ?? 'Dev').split(' ')[0] }}
                    <span class="text-[rgba(0,180,216,0.4)]">/&gt;</span>
                </a>

                <!-- Desktop links -->
                <ul class="hidden md:flex items-center gap-1">
                    <li v-for="link in links" :key="link.id">
                        <a
                            :href="'#' + link.id"
                            class="px-3 py-1.5 rounded-lg font-mono text-xs tracking-widest uppercase transition-all duration-200"
                            :class="activeSection === link.id
                                ? 'text-[#00b4d8] bg-[rgba(0,180,216,0.1)]'
                                : 'text-[#7ab8cc] hover:text-[#caf0f8] hover:bg-[rgba(0,180,216,0.05)]'"
                            @click.prevent="scrollTo(link.id)"
                        >
                            {{ link.label }}
                        </a>
                    </li>
                </ul>

                <!-- CTA -->
                <a
                    href="#contact"
                    class="hidden md:inline-flex items-center gap-1.5 px-4 py-1.5 rounded-lg border border-[rgba(0,180,216,0.3)] font-mono text-xs text-[#00b4d8] tracking-wide transition-all duration-200 hover:bg-[#00b4d8] hover:text-[#010b18] hover:border-[#00b4d8]"
                    @click.prevent="scrollTo('contact')"
                >
                    Let's Talk
                </a>

                <!-- Hamburger -->
                <button
                    class="md:hidden flex flex-col gap-1.5 p-1"
                    @click="menuOpen = !menuOpen"
                >
                    <span
                        v-for="i in 3" :key="i"
                        class="block w-5 h-0.5 bg-[#7ab8cc] rounded transition-all"
                    ></span>
                </button>
            </div>

            <!-- Mobile menu -->
            <div v-show="menuOpen" class="md:hidden pt-3 mt-3 border-t border-[rgba(0,180,216,0.1)] flex flex-col gap-1">
                <a
                    v-for="link in links" :key="link.id"
                    :href="'#' + link.id"
                    class="px-3 py-2 rounded-lg font-mono text-xs tracking-widest uppercase text-[#7ab8cc] hover:text-[#caf0f8] hover:bg-[rgba(0,180,216,0.06)]"
                    @click.prevent="scrollTo(link.id)"
                >
                    {{ link.label }}
                </a>
            </div>
        </nav>
    </header>
</template>