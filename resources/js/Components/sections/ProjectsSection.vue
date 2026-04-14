<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ projects: Array })

const activeTab    = ref('projects')

const activeFilter = ref('all')
const filters = [
    { value: 'all',       label: 'Semua'      },
    { value: 'fullstack', label: 'Full Stack'  },
    { value: 'backend',   label: 'Backend'     },
    { value: 'security',  label: 'Security'    },
    { value: 'frontend',  label: 'Frontend'    },
]

const filteredProjects = computed(() =>
    activeFilter.value === 'all'
        ? (props.projects ?? [])
        : (props.projects ?? []).filter(p => p.type === activeFilter.value)
)

// Modal detail
const selected = ref(null)

import { onMounted, onUnmounted } from 'vue'
function onKey(e) { if (e.key === 'Escape') selected.value = null }
onMounted(()  => window.addEventListener('keydown', onKey))
onUnmounted(() => window.removeEventListener('keydown', onKey))

// ── Security / CTF data 
const ctfs = [
    {
        badge: 'Web Exploitation',
        badgeColor: 'rgba(255,100,100,0.15)',
        badgeTextColor: '#ff6b6b',
        title: 'SQL Injection Bypass — CTF National',
        desc: 'Exploitasi blind SQLi pada login form dengan custom filter. Bypass dilakukan via time-based injection dan automasi Python script.',
        event: 'CTF Indonesia 2024',
        diff: 4,
    },
    {
        badge: 'IDOR / Auth Bypass',
        badgeColor: 'rgba(255,165,0,0.15)',
        badgeTextColor: '#ffaa44',
        title: 'Broken Object Level Authorization',
        desc: 'IDOR pada endpoint API yang memungkinkan akses data user lain hanya dengan mengganti ID parameter. Ditemukan saat audit web application.',
        event: 'Bug Bounty 2024',
        diff: 3,
    },
    {
        badge: 'XSS + CSRF Chain',
        badgeColor: 'rgba(180,100,255,0.15)',
        badgeTextColor: '#c77dff',
        title: 'Stored XSS → Account Takeover',
        desc: 'Chained Stored XSS dengan CSRF untuk account takeover tanpa interaksi korban lebih lanjut. Dilaporkan via responsible disclosure.',
        event: 'Private Program 2023',
        diff: 5,
    },
    {
        badge: 'SQL Injection',
        badgeColor: 'rgba(255,100,100,0.15)',
        badgeTextColor: '#ff6b6b',
        title: 'Error-Based SQLi Extraction',
        desc: 'Ekstraksi data sensitif via error-based SQLi pada aplikasi legacy yang tidak menggunakan prepared statement.',
        event: 'CTF Local 2023',
        diff: 3,
    },
]

const tools = [
    'Burp Suite', 'OWASP ZAP', 'Nmap', 'Metasploit',
    'SQLMap', 'Nikto', 'Gobuster', 'Ffuf',
    'Wireshark', 'Hydra', 'John the Ripper', 'Python',
]
</script>

<template>
    <section id="projects" class="py-20 relative">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.3), transparent)"></div>

        <div class="w-full px-8 lg:px-16 xl:px-24">

            <!-- Header -->
            <div class="section-label mb-3">04 / Work</div>
            <h2 class="font-extrabold tracking-tight text-white mb-10"
                style="font-size: clamp(2rem, 4vw, 3rem)">
                Projects & <span class="text-[#48cae4]">Security</span>
            </h2>

            <!-- ── TABS ── -->
            <div class="flex gap-1 p-1 mb-8 rounded-xl w-fit
                        bg-[rgba(0,180,216,0.06)] border border-[rgba(0,180,216,0.15)]">
                <button
                    :class="['tab-btn', activeTab === 'projects' ? 'tab-btn--active' : '']"
                    @click="activeTab = 'projects'">
                    <span class="tab-icon">⊞</span> Projects
                </button>
                <button
                    :class="['tab-btn', activeTab === 'security' ? 'tab-btn--active tab-btn--sec' : '']"
                    @click="activeTab = 'security'">
                    <span class="tab-icon">🔒</span> Security & CTF
                </button>
            </div>

            <!-- TAB: PROJECTS -->
            <div v-if="activeTab === 'projects'">

                <!-- Filter pills -->
                <div class="flex flex-wrap gap-2 mb-7">
                    <button v-for="f in filters" :key="f.value"
                            class="px-4 py-1.5 rounded-full font-mono text-xs tracking-wide transition-all"
                            :class="activeFilter === f.value
                                ? 'bg-gradient-to-r from-[#0096c7] to-[#48cae4] text-[#020c1b] font-bold'
                                : 'border border-[rgba(0,180,216,0.25)] text-[#90e0ef] hover:border-[rgba(0,180,216,0.5)] hover:text-white'"
                            @click="activeFilter = f.value">
                        {{ f.label }}
                    </button>
                </div>

                <!-- Project grid -->
                <div v-if="filteredProjects.length > 0"
                     class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <article v-for="p in filteredProjects" :key="p.id"
                             class="glass-card overflow-hidden cursor-pointer group
                                    transition-all duration-300 hover:-translate-y-1.5
                                    hover:border-[rgba(0,180,216,0.35)] hover:shadow-[0_8px_30px_rgba(0,180,216,0.1)]"
                             @click="selected = p">

                        <!-- Thumbnail -->
                        <div class="relative h-48 bg-[#041226] overflow-hidden">
                            <img v-if="p.thumbnail" :src="p.thumbnail" :alt="p.title"
                                 class="w-full h-full object-cover object-top
                                        transition-transform duration-500 group-hover:scale-105
                                        brightness-75 group-hover:brightness-90" />
                            <div v-else class="w-full h-full flex flex-col items-center justify-center gap-2">
                                <span class="text-3xl opacity-30">⊞</span>
                                <span class="font-mono text-[0.6rem] text-[#48cae4] opacity-40 tracking-widest">PROJECT</span>
                            </div>
                            <div class="absolute inset-0"
                                 style="background: linear-gradient(to top, rgba(2,12,27,0.85) 0%, transparent 55%)"></div>
                            <!-- Type badge -->
                            <div class="absolute top-3 right-3 font-mono text-[0.6rem] tracking-widest
                                        px-2 py-0.5 rounded backdrop-blur-sm"
                                 :class="p.type === 'security'
                                    ? 'bg-[rgba(255,100,100,0.15)] border border-[rgba(255,100,100,0.25)] text-[#ff9090]'
                                    : 'bg-[rgba(0,180,216,0.15)] border border-[rgba(0,180,216,0.25)] text-[#90e0ef]'">
                                {{ p.type }}
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-4">
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-1.5 mb-2.5">
                                <span v-for="tag in (p.tags ?? []).slice(0,3)" :key="tag"
                                      class="font-mono text-[0.6rem] px-2 py-0.5 rounded"
                                      :class="p.type === 'security'
                                        ? 'bg-[rgba(255,100,100,0.1)] border border-[rgba(255,100,100,0.2)] text-[#ff9090]'
                                        : 'bg-[rgba(0,180,216,0.08)] border border-[rgba(0,180,216,0.2)] text-[#90e0ef]'">
                                    {{ tag }}
                                </span>
                            </div>

                            <h3 class="font-bold text-white text-sm mb-2
                                       group-hover:text-[#48cae4] transition-colors leading-snug">
                                {{ p.title }}
                            </h3>
                            <p class="text-[#90e0ef] text-xs leading-relaxed mb-3 opacity-75 line-clamp-2">
                                {{ p.description }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex gap-2.5">
                                    <a v-if="p.demo_url && p.demo_url !== '#'"
                                       :href="p.demo_url" target="_blank"
                                       class="font-mono text-[0.68rem] text-[#90e0ef] hover:text-[#48cae4] transition-colors"
                                       @click.stop>↗ Live</a>
                                    <a v-if="p.github_url && p.github_url !== '#'"
                                       :href="p.github_url" target="_blank"
                                       class="font-mono text-[0.68rem] text-[#90e0ef] hover:text-[#48cae4] transition-colors"
                                       @click.stop>⌥ GitHub</a>
                                </div>
                                <span class="font-mono text-[0.65rem] text-[#48cae4]
                                             bg-[rgba(0,180,216,0.08)] border border-[rgba(0,180,216,0.2)]
                                             px-2.5 py-1 rounded-lg
                                             group-hover:bg-[#48cae4] group-hover:text-[#020c1b]
                                             transition-all duration-200">
                                    Detail →
                                </span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Empty state -->
                <div v-else class="text-center py-16 text-[#90e0ef] opacity-40 font-mono text-sm">
                    Belum ada project di kategori ini.
                </div>
            </div>

            <!-- TAB: SECURITY & CTF -->
            <div v-if="activeTab === 'security'"
                 class="grid grid-cols-1 lg:grid-cols-[1fr_1.1fr] gap-8">

                <!-- Kiri: Terminal + Tools -->
                <div class="space-y-5">
                    <!-- Terminal -->
                    <div class="glass-card p-5 font-mono text-sm">
                        <div class="flex gap-1.5 mb-4">
                            <span class="w-3 h-3 rounded-full bg-[#ff5f57]"></span>
                            <span class="w-3 h-3 rounded-full bg-[#febc2e]"></span>
                            <span class="w-3 h-3 rounded-full bg-[#28c840]"></span>
                        </div>
                        <div class="space-y-1 text-[0.82rem]">
                            <p><span class="text-[#48cae4]">$</span> <span class="text-white">whoami</span></p>
                            <p class="text-[#90e0ef] opacity-70">&gt; penetration tester · ctf player · owasp enthusiast</p>
                            <br>
                            <p><span class="text-[#48cae4]">$</span> <span class="text-white">cat focus.txt</span></p>
                            <p class="text-[#90e0ef] opacity-70">&gt; Web App Security · OWASP Top 10</p>
                            <p class="text-[#90e0ef] opacity-70">&gt; Pentest & Bug Bounty · CTF Competition</p>
                            <br>
                            <p><span class="text-[#48cae4]">$</span> <span class="text-white">cat platforms.txt</span></p>
                            <p class="text-[#90e0ef] opacity-70">&gt; HackTheBox · TryHackMe · CTF.id</p>
                        </div>
                    </div>

                    <!-- Tools -->
                    <div class="glass-card p-5">
                        <div class="font-mono text-xs text-[#48cae4] tracking-widest uppercase mb-3">
                            Tools & Arsenal
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="t in tools" :key="t"
                                  class="font-mono text-xs px-2.5 py-1 rounded-lg
                                         border border-[rgba(0,180,216,0.2)] bg-[rgba(0,180,216,0.05)]
                                         text-[#90e0ef] hover:border-[rgba(0,180,216,0.45)] hover:text-white
                                         transition-all cursor-default">
                                {{ t }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kanan: CTF writeups -->
                <div class="space-y-4">
                    <div class="font-mono text-xs text-[#90e0ef] tracking-widest uppercase opacity-60 mb-1">
                        CTF Writeups & Bug Bounty
                    </div>

                    <div v-for="c in ctfs" :key="c.title"
                         class="glass-card p-5 group relative overflow-hidden
                                transition-all duration-300 hover:-translate-y-0.5
                                hover:border-[rgba(255,100,100,0.25)]">

                        <!-- Top accent line -->
                        <div class="absolute top-0 left-0 h-0.5 w-0 group-hover:w-full transition-all duration-500"
                             style="background: linear-gradient(90deg, #ff6b6b, transparent)"></div>

                        <!-- Badge -->
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded mb-3 text-[0.62rem] font-mono tracking-widest uppercase"
                             :style="{ background: c.badgeColor, color: c.badgeTextColor, border: '1px solid ' + c.badgeTextColor + '33' }">
                            {{ c.badge }}
                        </div>

                        <h3 class="font-bold text-white text-sm mb-1.5">{{ c.title }}</h3>
                        <p class="text-[#90e0ef] text-xs leading-relaxed mb-3 opacity-75">{{ c.desc }}</p>

                        <div class="flex items-center justify-between">
                            <span class="font-mono text-[0.62rem] text-[#90e0ef] opacity-50">{{ c.event }}</span>
                            <!-- Difficulty dots -->
                            <div class="flex gap-1">
                                <span v-for="n in 5" :key="n"
                                      class="w-2 h-2 rounded-full transition-colors"
                                      :style="n <= c.diff
                                          ? 'background:' + c.badgeTextColor
                                          : 'background:rgba(0,180,216,0.15)'">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL PROJECT -->
        <Transition name="modal">
            <div v-if="selected"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-8"
                 style="background: rgba(2,12,27,0.9); backdrop-filter: blur(10px)"
                 @click.self="selected = null">

                <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl
                             border border-[rgba(0,180,216,0.2)]"
                     style="background: #041226">

                    <!-- Close -->
                    <button class="absolute top-4 right-4 z-10 w-8 h-8 rounded-lg
                                   border border-[rgba(0,180,216,0.2)] bg-[rgba(0,180,216,0.06)]
                                   text-[#90e0ef] hover:text-white flex items-center justify-center text-sm transition-all"
                            @click="selected = null">✕</button>

                    <div class="p-6 md:p-8">
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 font-mono text-xs text-[#90e0ef] opacity-50 mb-6">
                            <span class="cursor-pointer hover:text-[#48cae4] transition-colors"
                                  @click="selected = null">Projects</span>
                            <span>›</span>
                            <span class="text-[#90e0ef]">{{ selected.title }}</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Kiri -->
                            <div>
                                <h2 class="font-extrabold text-[#48cae4] leading-tight mb-2"
                                    style="font-size: clamp(1.4rem, 3vw, 2rem)">
                                    {{ selected.title }}
                                </h2>
                                <div class="w-12 h-0.5 mb-4"
                                     style="background: linear-gradient(90deg, #0096c7, #48cae4)"></div>
                                <p class="text-[#90e0ef] text-sm leading-relaxed mb-5">
                                    {{ selected.long_description ?? selected.description }}
                                </p>

                                <!-- Meta -->
                                <div class="grid grid-cols-2 gap-2 mb-5">
                                    <div v-for="m in [
                                        { label:'Role',     val: selected.role     },
                                        { label:'Duration', val: selected.duration },
                                        { label:'Year',     val: selected.year     },
                                        { label:'Type',     val: selected.type     },
                                    ]" :key="m.label"
                                    class="glass-card px-3 py-2.5">
                                        <div class="font-mono text-[0.55rem] text-[#48cae4] uppercase tracking-widest opacity-60 mb-0.5">{{ m.label }}</div>
                                        <div class="font-bold text-xs text-white">{{ m.val }}</div>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="flex gap-2.5 mb-5">
                                    <a v-if="selected.demo_url" :href="selected.demo_url" target="_blank" class="btn-ocean text-sm px-4 py-2">↗ Live Demo</a>
                                    <a v-if="selected.github_url" :href="selected.github_url" target="_blank" class="btn-ghost text-sm px-4 py-2">⌥ GitHub</a>
                                </div>

                                <!-- Tech -->
                                <div class="font-mono text-[0.6rem] text-[#90e0ef] opacity-60 tracking-widest uppercase mb-2">&lt;/&gt; Technologies</div>
                                <div class="flex flex-wrap gap-1.5">
                                    <span v-for="t in (selected.tech_stack ?? [])" :key="t"
                                          class="font-mono text-[0.68rem] px-2.5 py-1 rounded-full
                                                 border border-[rgba(0,180,216,0.2)] bg-[rgba(0,180,216,0.05)] text-[#90e0ef]">
                                        · {{ t }}
                                    </span>
                                </div>
                            </div>

                            <!-- Kanan -->
                            <div>
                                <div class="rounded-xl overflow-hidden border border-[rgba(0,180,216,0.15)]
                                            h-48 bg-[#071a36] flex items-center justify-center mb-4">
                                    <img v-if="selected.thumbnail" :src="selected.thumbnail" :alt="selected.title"
                                         class="w-full h-full object-cover object-top" />
                                    <div v-else class="flex flex-col items-center gap-2 text-[#90e0ef] opacity-30">
                                        <span class="text-3xl">🌊</span>
                                        <span class="font-mono text-xs">Screenshot Preview</span>
                                    </div>
                                </div>

                                <!-- Features -->
                                <div class="glass-card p-4">
                                    <div class="font-bold text-[#48cae4] text-sm mb-3 flex items-center gap-2">
                                        <span>⭐</span> Key Features
                                    </div>
                                    <ul class="space-y-2">
                                        <li v-for="f in (selected.features ?? [])" :key="f"
                                            class="flex items-start gap-2.5 text-xs text-[#90e0ef] leading-relaxed">
                                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#48cae4] shrink-0"></span>
                                            {{ f }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </section>
</template>

<style scoped>
.tab-btn {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.55rem 1.2rem;
    border-radius: 10px;
    font-size: 0.82rem;
    font-weight: 600;
    color: #90e0ef;
    transition: all 0.2s;
    border: 1px solid transparent;
}
.tab-btn:hover { color: #caf0f8; background: rgba(0,180,216,0.08); }
.tab-btn--active {
    background: rgba(0,180,216,0.12);
    border-color: rgba(0,180,216,0.3);
    color: #48cae4;
}
.tab-btn--sec.tab-btn--active {
    background: rgba(255,100,100,0.1);
    border-color: rgba(255,100,100,0.3);
    color: #ff9090;
}
.tab-icon { font-size: 0.9rem; }

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.modal-enter-active, .modal-leave-active { transition: opacity 0.25s; }
.modal-enter-from, .modal-leave-to { opacity: 0; }
</style>
