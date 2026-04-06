<script setup>
import { computed } from 'vue'

const props = defineProps({ settings: Object })

const infoCards = computed(() => [
    { label: 'Based in',   value: props.settings?.location   ?? 'Indonesia 🇮🇩' },
    { label: 'Experience', value: (props.settings?.years_exp ?? '5') + '+ Years' },
    { label: 'Status',     value: props.settings?.available === 'true' ? '● Available' : '○ Busy', accent: true },
    { label: 'Focus',      value: 'FullStack + Security' },
])
</script>

<template>
    <section id="about" class="py-16 relative">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.25), transparent)"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="section-label mb-3" data-reveal>02 / About</div>
            <h2 class="font-extrabold tracking-tight mb-10 leading-none" data-reveal
                style="font-size: clamp(2rem, 4vw, 2.8rem)">
                About <span class="text-[#00b4d8]">Me</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <!-- Kiri: Avatar + info cards -->
                <div class="flex flex-col items-center gap-6" data-reveal>
                    <div class="relative">
                        <div class="absolute inset-[-16px] rounded-full border border-dashed border-[rgba(0,180,216,0.18)]"
                             style="animation: spin 25s linear infinite"></div>
                        <div class="absolute inset-[-8px] rounded-full border border-[rgba(0,180,216,0.12)]"
                             style="animation: spin 15s linear infinite reverse"></div>

                        <div class="w-52 h-52 rounded-full overflow-hidden border-2 border-[rgba(0,180,216,0.3)]"
                             style="box-shadow: 0 0 0 8px rgba(0,180,216,0.06), 0 0 50px rgba(0,180,216,0.15)">
                            <img v-if="settings?.photo"
                                 :src="settings.photo"
                                 alt="Photo"
                                 class="w-full h-full object-cover" />
                            <div v-else
                                 class="w-full h-full bg-[#041226] flex items-center justify-center text-6xl">
                                👨‍💻
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 w-full max-w-xs">
                        <div v-for="card in infoCards" :key="card.label"
                             class="glass-card px-4 py-3">
                            <div class="font-mono text-[0.58rem] text-[#0a2347] tracking-widest uppercase mb-1">{{ card.label }}</div>
                            <div class="font-bold text-sm"
                                 :class="card.accent ? 'text-[#00b4d8]' : 'text-[#caf0f8]'">
                                {{ card.value }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Teks -->
                <div data-reveal>
                    <div class="text-xl font-bold text-[#00b4d8] mb-1">Hello, I'm</div>
                    <div class="font-extrabold tracking-tight mb-5 leading-tight"
                         style="font-size: clamp(1.6rem, 3vw, 2.2rem)">
                        {{ settings?.name ?? 'Your Name' }}
                    </div>

                    <p class="text-[#7ab8cc] leading-relaxed mb-4" style="font-size:0.95rem">
                        A <strong class="text-[#caf0f8] font-semibold">full-stack web developer</strong> passionate about
                        building robust, secure, and scalable web applications.
                        My core stack is <strong class="text-[#caf0f8] font-semibold">PHP & Laravel</strong> for backend,
                        <strong class="text-[#caf0f8] font-semibold">Filament</strong> for rapid admin panels,
                        dan <strong class="text-[#caf0f8] font-semibold">Vue.js</strong> untuk frontend yang modern.
                    </p>
                    <p class="text-[#7ab8cc] leading-relaxed mb-6" style="font-size:0.95rem">
                        Di luar development, aku punya ketertarikan mendalam di bidang
                        <strong class="text-[#caf0f8] font-semibold">cybersecurity</strong> — khususnya
                        web application penetration testing. Aktif ikut CTF competition dan program bug bounty.
                    </p>

                    <div class="border-l-2 border-[#00b4d8] pl-4 mb-6 italic text-[#7ab8cc] text-sm">
                        "{{ settings?.quote ?? 'Security is not a product, but a process — and I build both.' }}"
                    </div>

                    <div class="flex gap-3 flex-wrap">
                        <a v-if="settings?.cv_url"
                           :href="settings.cv_url" target="_blank"
                           class="btn-ocean">
                            📄 Download CV
                        </a>
                        <a href="#projects" class="btn-ghost">
                            &lt;/&gt; View Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes spin { to { transform: rotate(360deg); } }
</style>
