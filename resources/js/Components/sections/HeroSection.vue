<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({ settings: Object })

// Typewriter
const words   = ['Developer.', 'Pentester.', 'Engineer.', 'Builder.']
const typed   = ref('')
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

// Bar animations
const bars = ref([0, 0, 0])
onMounted(() => {
    tick()
    setTimeout(() => { bars.value = [88, 78, 72] }, 700)
})

const stacks  = ['PHP', 'Laravel', 'Filament', 'Vue.js', 'MySQL', 'Burp Suite', 'OWASP']
const vizRows = [
    { icon: '$_', name: 'Laravel Backend',    sub: 'REST API · Eloquent · Filament' },
    { icon: '▷',  name: 'Vue.js Frontend',    sub: 'Composition API · Inertia.js'  },
    { icon: '🔒', name: 'Penetration Testing',sub: 'OWASP Top 10 · Burp Suite'     },
]
</script>

<template>
    <!-- Hero — asymmetric grid -->
    <section id="hero" class="relative min-h-screen flex items-center overflow-hidden">

        <!-- Ocean depth glow blobs -->
        <div class="absolute top-0 left-0 w-[600px] h-[600px] rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(0,119,182,0.18) 0%, transparent 70%)"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full pointer-events-none"
             style="background:radial-gradient(circle, rgba(2,62,138,0.14) 0%, transparent 70%)"></div>

        <div class="relative z-10 w-full max-w-6xl mx-auto px-6 lg:px-8 pt-28 pb-16
                    grid grid-cols-1 lg:grid-cols-[1.15fr_1fr] gap-12 items-center">

            <!-- ── LEFT: Content ── -->
            <div data-reveal>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                            border border-[rgba(0,180,216,0.22)] bg-[rgba(0,180,216,0.06)]
                            font-mono text-xs text-[#00b4d8] tracking-widest mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00b4d8] animate-pulse"></span>
                    Open to Freelance & Collaboration
                </div>

                <!-- Heading -->
                <h1 class="font-sans font-extrabold leading-[1.05] tracking-tight mb-4"
                    style="font-size: clamp(2.8rem, 6vw, 5rem)">
                    Full Stack<br>
                    <span class="text-[#00b4d8]">{{ typed }}</span
                    ><span class="border-r-2 border-[#00b4d8] ml-0.5 animate-[blink_1s_step-end_infinite]"></span>
                </h1>

                <p class="text-[#7ab8cc] leading-relaxed mb-6 max-w-md"
                   style="font-size:0.97rem">
                    {{ settings?.bio ?? 'Passionate full-stack web developer from Indonesia. Building robust apps with PHP, Laravel & Vue.js — and hardening them with penetration testing.' }}
                </p>

                <!-- Stack pills -->
                <div class="flex flex-wrap gap-2 mb-7">
                    <span v-for="s in stacks" :key="s"
                          class="px-3 py-1 rounded-full font-mono text-xs text-[#7ab8cc]
                                 border border-[rgba(0,180,216,0.15)] bg-[rgba(0,180,216,0.04)]">
                        {{ s }}
                    </span>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="#projects" class="btn-ocean" @click.prevent="$el.closest('section').nextElementSibling?.scrollIntoView({behavior:'smooth'})">
                        View Projects →
                    </a>
                    <a href="#contact" class="btn-ghost">
                        ✉ Contact Me
                    </a>
                </div>

                <!-- Socials -->
                <div class="flex gap-2">
                    <a v-if="settings?.github"    :href="settings.github"    target="_blank" class="social-pill">GH</a>
                    <a v-if="settings?.linkedin"  :href="settings.linkedin"  target="_blank" class="social-pill">in</a>
                    <a v-if="settings?.instagram" :href="settings.instagram" target="_blank" class="social-pill">IG</a>
                    <a v-if="settings?.hackthebox":href="settings.hackthebox" target="_blank" class="social-pill">HTB</a>
                </div>
            </div>

            <!-- ── RIGHT: Terminal visual ── -->
            <div class="hidden lg:block" data-reveal>
                <div class="glass-card p-5 ocean-glow">
                    <!-- Terminal header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#ff5f57]"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-[#febc2e]"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-[#28c840]"></span>
                        </div>
                        <span class="font-mono text-[0.6rem] text-[#0a2347] tracking-widest">SYSTEM ONLINE</span>
                        <span class="font-mono text-[0.6rem] text-[#00b4d8] bg-[rgba(0,180,216,0.1)] px-2 py-0.5 rounded">● ACTIVE</span>
                    </div>

                    <!-- Skill bars -->
                    <div class="space-y-2.5 mb-4">
                        <div v-for="(row, i) in vizRows" :key="row.name"
                             class="bg-[rgba(0,180,216,0.04)] border border-[rgba(0,180,216,0.1)] rounded-xl p-3 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[rgba(0,180,216,0.1)] border border-[rgba(0,180,216,0.15)]
                                        flex items-center justify-center font-mono text-[0.7rem] text-[#00b4d8] shrink-0">
                                {{ row.icon }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-[0.8rem] text-[#caf0f8] mb-0.5">{{ row.name }}</div>
                                <div class="font-mono text-[0.65rem] text-[#0a2347] mb-1.5">{{ row.sub }}</div>
                                <div class="h-1 bg-[rgba(0,180,216,0.08)] rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-[1200ms] ease-out"
                                         style="background: linear-gradient(90deg, #0077b6, #00b4d8)"
                                         :style="{ width: bars[i] + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats row -->
                    <div class="grid grid-cols-3 gap-2">
                        <div v-for="s in [['20+','Projects'],['5+','Yrs Exp'],['10+','CTF Wins']]" :key="s[1]"
                             class="bg-[rgba(0,180,216,0.04)] border border-[rgba(0,180,216,0.1)] rounded-xl p-2.5 text-center">
                            <div class="font-extrabold text-[#00b4d8] text-lg leading-none">{{ s[0] }}</div>
                            <div class="font-mono text-[0.58rem] text-[#0a2347] mt-1 tracking-wide">{{ s[1] }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5
                    font-mono text-[0.58rem] text-[#0a2347] tracking-widest animate-bounce">
            <div class="w-px h-8 bg-gradient-to-b from-[#00b4d8] to-transparent"></div>
            scroll
        </div>
    </section>
</template>

<style scoped>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
.social-pill {
    width: 36px; height: 36px;
    border-radius: 10px;
    border: 1px solid rgba(0,180,216,0.2);
    background: rgba(4,18,38,0.6);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 700;
    color: #7ab8cc;
    text-decoration: none;
    transition: all 0.2s;
}
.social-pill:hover {
    border-color: #00b4d8;
    color: #00b4d8;
}
</style>
