<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({ settings: Object })

const words = ['Developer.', 'Pentester.', 'Engineer.', 'Builder.']
const typed = ref('')
let wi = 0, ci = 0, deleting = false

function tick() {
    const w = words[wi]
    if (!deleting) {
        typed.value = w.slice(0, ++ci)
        if (ci === w.length) { deleting = true; setTimeout(tick, 1800); return }
    } else {
        typed.value = w.slice(0, --ci)
        if (ci === 0) { deleting = false; wi = (wi + 1) % words.length }
    }
    setTimeout(tick, deleting ? 55 : 85)
}

const bars = ref([0, 0, 0])
onMounted(() => {
    tick()
    setTimeout(() => { bars.value = [88, 78, 72] }, 700)
})

const stacks  = ['PHP', 'Laravel', 'Filament', 'Vue.js', 'MySQL', 'Burp Suite', 'OWASP']
const vizRows = [
    { icon: '$_', name: 'Laravel Backend',     sub: 'REST API · Eloquent · Filament' },
    { icon: '▷',  name: 'Vue.js Frontend',     sub: 'Composition API · Inertia.js'  },
    { icon: '🔒', name: 'Penetration Testing', sub: 'OWASP Top 10 · Burp Suite'     },
]
</script>

<template>
    <section id="hero" class="relative min-h-screen overflow-hidden flex items-center">

        <!-- Background glows -->
        <div class="absolute top-0 left-0 w-[700px] h-[700px] rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(0,119,182,0.18) 0%, transparent 70%)"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(2,62,138,0.15) 0%, transparent 70%)"></div>

        <!-- Content -->
        <div class="relative z-10 w-full px-8 lg:px-16 xl:px-24 pt-24 pb-16
                    grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-16 items-center">

            <!-- LEFT -->
            <div>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-8
                            border border-[rgba(0,180,216,0.3)] bg-[rgba(0,180,216,0.08)]
                            font-mono text-xs text-[#48cae4] tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#48cae4] animate-pulse"></span>
                    Open to Freelance & Collaboration
                </div>

                <!-- Heading -->
                <h1 class="font-extrabold leading-[1.05] tracking-tight mb-5 text-white"
                    style="font-size: clamp(3rem, 6vw, 5.5rem)">
                    Full Stack<br>
                    <span class="text-[#00b4d8]">{{ typed }}</span
                    ><span class="border-r-2 border-[#00b4d8] ml-0.5 animate-[blink_1s_step-end_infinite]"></span>
                </h1>

                <!-- Description -->
                <p class="leading-relaxed mb-7 text-[#90e0ef]"
                   style="font-size:1.05rem; max-width: 500px">
                    {{ settings?.bio ?? 'Passionate full-stack web developer from Indonesia. Building robust apps with PHP, Laravel & Vue.js — and hardening them with penetration testing.' }}
                </p>

                <!-- Stack pills -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <span v-for="s in stacks" :key="s"
                          class="px-3 py-1.5 rounded-full font-mono text-xs text-[#90e0ef]
                                 border border-[rgba(0,180,216,0.25)] bg-[rgba(0,180,216,0.06)]
                                 hover:border-[rgba(0,180,216,0.5)] hover:text-[#caf0f8] transition-all">
                        {{ s }}
                    </span>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-3 mb-10">
                    <a href="#projects" class="btn-ocean"
                       @click.prevent="document.getElementById('projects')?.scrollIntoView({behavior:'smooth'})">
                        ⊞ View Projects →
                    </a>
                    <a href="#contact" class="btn-ghost"
                       @click.prevent="document.getElementById('contact')?.scrollIntoView({behavior:'smooth'})">
                        ✉ Contact Me
                    </a>
                </div>

                <!-- Socials -->
                <div class="flex gap-2.5">
                    <a v-if="settings?.github"     :href="settings.github"     target="_blank" class="social-pill">GH</a>
                    <a v-if="settings?.linkedin"   :href="settings.linkedin"   target="_blank" class="social-pill">in</a>
                    <a v-if="settings?.instagram"  :href="settings.instagram"  target="_blank" class="social-pill">IG</a>
                    <a v-if="settings?.hackthebox" :href="settings.hackthebox" target="_blank" class="social-pill">HTB</a>
                </div>
            </div>

            <!-- RIGHT: Terminal visual -->
            <div class="hidden lg:block">
                <div class="glass-card p-6 ocean-glow">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-[#ff5f57]"></span>
                            <span class="w-3 h-3 rounded-full bg-[#febc2e]"></span>
                            <span class="w-3 h-3 rounded-full bg-[#28c840]"></span>
                        </div>
                        <span class="font-mono text-[0.65rem] text-[#48cae4] tracking-widest opacity-50">SYSTEM ONLINE</span>
                        <span class="font-mono text-[0.65rem] text-[#00b4d8] bg-[rgba(0,180,216,0.12)] px-2.5 py-1 rounded-lg">● ACTIVE</span>
                    </div>

                    <!-- Skill bars -->
                    <div class="space-y-3 mb-5">
                        <div v-for="(row, i) in vizRows" :key="row.name"
                             class="bg-[rgba(0,180,216,0.05)] border border-[rgba(0,180,216,0.12)] rounded-xl p-3.5 flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-[rgba(0,180,216,0.12)] border border-[rgba(0,180,216,0.2)]
                                        flex items-center justify-center font-mono text-sm text-[#48cae4] shrink-0">
                                {{ row.icon }}
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-sm text-white mb-0.5">{{ row.name }}</div>
                                <div class="font-mono text-[0.68rem] text-[#48cae4] opacity-60 mb-2">{{ row.sub }}</div>
                                <div class="h-1.5 bg-[rgba(0,180,216,0.1)] rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-[1200ms] ease-out"
                                         style="background: linear-gradient(90deg, #0096c7, #48cae4)"
                                         :style="{ width: bars[i] + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-3">
                        <div v-for="s in [['20+','Projects'],['5+','Yrs Exp'],['10+','CTF Wins']]" :key="s[1]"
                             class="bg-[rgba(0,180,216,0.05)] border border-[rgba(0,180,216,0.12)] rounded-xl p-3 text-center">
                            <div class="font-extrabold text-[#48cae4] text-2xl leading-none">{{ s[0] }}</div>
                            <div class="font-mono text-[0.6rem] text-[#90e0ef] opacity-60 mt-1 tracking-wide">{{ s[1] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5
                    font-mono text-[0.58rem] text-[#48cae4] tracking-widest animate-bounce opacity-50">
            <div class="w-px h-8 bg-gradient-to-b from-[#00b4d8] to-transparent"></div>
            scroll
        </div>
    </section>
</template>

<style scoped>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
.social-pill {
    width: 40px; height: 40px;
    border-radius: 10px;
    border: 1px solid rgba(0,180,216,0.25);
    background: rgba(0,180,216,0.06);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.72rem; font-weight: 700;
    color: #90e0ef;
    text-decoration: none;
    transition: all 0.2s;
}
.social-pill:hover {
    border-color: rgba(0,180,216,0.6);
    color: #48cae4;
    background: rgba(0,180,216,0.12);
}
</style>
