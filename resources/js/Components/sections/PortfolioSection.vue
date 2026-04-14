<script setup>
import { ref, computed } from 'vue'
import { onMounted, onUnmounted } from 'vue'

const props = defineProps({ projects: Array })

// TAB
const activeTab = ref('projects')

// PROJECT FILTER
const activeFilter = ref('all')
const filters = [
    { value: 'all',   label: 'Semua',         icon: '⊞' },
    { value: 'web',   label: 'Web Dev',        icon: '🌐' },
    { value: 'cyber', label: 'Cybersecurity',  icon: '🔒' },
]

// Map type dari DB ke filter
function matchFilter(p) {
    if (activeFilter.value === 'all') return true
    if (activeFilter.value === 'web')
        return ['fullstack', 'frontend', 'backend'].includes(p.type)
    if (activeFilter.value === 'cyber')
        return p.type === 'security'
    return true
}

const filteredProjects = computed(() =>
    (props.projects ?? []).filter(matchFilter)
)

// Modal
const selected = ref(null)
function onKey(e) { if (e.key === 'Escape') selected.value = null }
onMounted(()  => window.addEventListener('keydown', onKey))
onUnmounted(() => window.removeEventListener('keydown', onKey))

// Certificates data
const certs = [
    {
        badge: 'Cybersecurity',
        title: 'Web Application Penetration Testing',
        issuer: 'EC-Council / OffSec',
        year: '2024',
        desc: 'Sertifikasi resmi web app pentesting — dari recon hingga exploitation dan reporting.',
        color: 'rgba(255,100,100,0.12)',
        borderColor: 'rgba(255,100,100,0.25)',
        badgeColor: '#ff9090',
    },
    {
        badge: 'Web Dev',
        title: 'Laravel & PHP Certification',
        issuer: 'Laracasts / Laravel',
        year: '2023',
        desc: 'Sertifikasi pengembangan aplikasi Laravel tingkat lanjut dengan best practices.',
        color: 'rgba(0,180,216,0.08)',
        borderColor: 'rgba(0,180,216,0.22)',
        badgeColor: '#48cae4',
    },
    {
        badge: 'Security',
        title: 'OWASP Top 10 Web Security',
        issuer: 'OWASP Foundation',
        year: '2023',
        desc: 'Pemahaman dan mitigasi OWASP Top 10 vulnerabilities secara menyeluruh.',
        color: 'rgba(255,165,0,0.08)',
        borderColor: 'rgba(255,165,0,0.22)',
        badgeColor: '#ffaa44',
    },
]

const techGroups = [
    {
        label: 'Backend', icon: '⚙',
        skills: [
            { name: 'PHP',        icon: '🐘' },
            { name: 'Laravel',    icon: '🔴' },
            { name: 'Filament',   icon: '⚡' },
            { name: 'MySQL',      icon: '🐬' },
            { name: 'PostgreSQL', icon: '🐘' },
            { name: 'REST API',   icon: '🔗' },
        ],
    },
    {
        label: 'Frontend', icon: '🖥',
        skills: [
            { name: 'Vue.js 3',     icon: '💚' },
            { name: 'JavaScript',   icon: '🟡' },
            { name: 'Inertia.js',   icon: '🟣' },
            { name: 'Tailwind CSS', icon: '🌊' },
            { name: 'HTML / CSS',   icon: '🎨' },
            { name: 'Alpine.js',    icon: '❄️' },
        ],
    },
    {
        label: 'Security', icon: '🔒',
        skills: [
            { name: 'Burp Suite',  icon: '🕷' },
            { name: 'OWASP Top10', icon: '🛡️' },
            { name: 'SQLi / XSS',  icon: '💉' },
            { name: 'Nmap',        icon: '📡' },
            { name: 'Metasploit',  icon: '💀' },
            { name: 'CTF',         icon: '🚩' },
        ],
    },
    {
        label: 'DevOps & Tools', icon: '🛠',
        skills: [
            { name: 'Git',    icon: '🔧' },
            { name: 'Docker', icon: '🐳' },
            { name: 'Linux',  icon: '🐧' },
            { name: 'Nginx',  icon: '🟢' },
            { name: 'Redis',  icon: '🔴' },
            { name: 'Vite',   icon: '⚡' },
        ],
    },
]
</script>

<template>
    <section id="portfolio" class="py-20 relative">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.3), transparent)"></div>

        <div class="w-full px-8 lg:px-16 xl:px-24">

            <!-- Header -->
            <div class="section-label mb-3">03 / Portfolio</div>
            <h2 class="font-extrabold tracking-tight text-white mb-3"
                style="font-size: clamp(2rem, 4vw, 3rem)">
                Portfolio <span class="text-[#48cae4]">Showcase</span>
            </h2>
            <p class="text-[#90e0ef] mb-10 max-w-xl" style="font-size:0.97rem">
                Projects, sertifikasi, dan tech stack — setiap bagian adalah milestone dalam perjalananku.
            </p>

            <!-- ── MAIN TABS ── -->
            <div class="grid grid-cols-3 gap-2 p-1.5 mb-10 rounded-2xl
                        bg-[rgba(0,180,216,0.05)] border border-[rgba(0,180,216,0.12)]">
                <button v-for="tab in [
                    { id:'projects', icon:'⊞', label:'Projects'   },
                    { id:'certs',    icon:'🎓', label:'Sertifikat' },
                    { id:'stack',    icon:'⚙',  label:'Tech Stack' },
                ]" :key="tab.id"
                :class="['main-tab', activeTab === tab.id ? 'main-tab--active' : '']"
                @click="activeTab = tab.id">
                    <span class="text-base">{{ tab.icon }}</span>
                    <span>{{ tab.label }}</span>
                </button>
            </div>

            <!-- TAB: PROJECTS -->
            <div v-if="activeTab === 'projects'">

                <!-- Sub-filter: All | Web | Cyber -->
                <div class="flex gap-2 mb-8">
                    <button v-for="f in filters" :key="f.value"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl
                                   font-mono text-xs font-semibold tracking-wide transition-all duration-200"
                            :class="activeFilter === f.value
                                ? 'bg-gradient-to-r from-[#0096c7] to-[#48cae4] text-[#020c1b] shadow-[0_4px_16px_rgba(72,202,228,0.3)]'
                                : 'border border-[rgba(0,180,216,0.2)] text-[#90e0ef] hover:border-[rgba(0,180,216,0.45)] hover:text-white'"
                            @click="activeFilter = f.value">
                        <span>{{ f.icon }}</span>
                        {{ f.label }}
                    </button>
                </div>

                <!-- Project grid -->
                <div v-if="filteredProjects.length > 0"
                     class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <article v-for="p in filteredProjects" :key="p.id"
                             class="glass-card overflow-hidden group cursor-pointer
                                    transition-all duration-300
                                    hover:-translate-y-1.5 hover:border-[rgba(0,180,216,0.35)]
                                    hover:shadow-[0_8px_30px_rgba(0,180,216,0.1)]"
                             @click="selected = p">

                        <!-- Thumbnail -->
                        <div class="relative h-48 bg-[#041226] overflow-hidden">
                            <img v-if="p.thumbnail" :src="p.thumbnail" :alt="p.title"
                                 class="w-full h-full object-cover object-top transition-transform duration-500
                                        group-hover:scale-105 brightness-75 group-hover:brightness-90" />
                            <div v-else class="w-full h-full flex flex-col items-center justify-center gap-2">
                                <div class="w-12 h-12 rounded-xl border border-[rgba(0,180,216,0.2)]
                                            bg-[rgba(0,180,216,0.06)] flex items-center justify-center">
                                    <span class="text-[#48cae4] text-xl opacity-50">
                                        {{ p.type === 'security' ? '🔒' : '⊞' }}
                                    </span>
                                </div>
                                <span class="font-mono text-[0.58rem] text-[#48cae4] opacity-30 tracking-widest uppercase">Project Portfolio</span>
                            </div>
                            <div class="absolute inset-0"
                                 style="background: linear-gradient(to top, rgba(2,12,27,0.85) 0%, transparent 55%)"></div>
                            <!-- Type badge -->
                            <div class="absolute top-3 right-3 font-mono text-[0.58rem] tracking-widest
                                        px-2 py-0.5 rounded-full backdrop-blur-sm"
                                 :class="p.type === 'security'
                                    ? 'bg-[rgba(255,100,100,0.15)] border border-[rgba(255,100,100,0.3)] text-[#ff9090]'
                                    : 'bg-[rgba(0,180,216,0.15)] border border-[rgba(0,180,216,0.3)] text-[#90e0ef]'">
                                {{ p.type === 'security' ? '🔒 Security' : '🌐 Web' }}
                            </div>
                            <div v-if="p.year" class="absolute top-3 left-3 font-mono text-[0.58rem] text-[#48cae4]
                                        bg-[rgba(2,12,27,0.7)] px-2 py-0.5 rounded">
                                {{ p.year }}
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-4">
                            <div class="flex flex-wrap gap-1.5 mb-2.5">
                                <span v-for="tag in (p.tags ?? []).slice(0,3)" :key="tag"
                                      class="font-mono text-[0.58rem] px-2 py-0.5 rounded-full
                                             bg-[rgba(0,180,216,0.07)] border border-[rgba(0,180,216,0.18)] text-[#90e0ef]">
                                    {{ tag }}
                                </span>
                            </div>
                            <h3 class="font-bold text-white text-sm mb-1.5 leading-snug
                                       group-hover:text-[#48cae4] transition-colors">
                                {{ p.title }}
                            </h3>
                            <p class="text-[#90e0ef] text-xs leading-relaxed mb-3 opacity-70 line-clamp-2">
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
                <div v-else class="flex flex-col items-center justify-center py-20 text-center">
                    <span class="text-4xl mb-3 opacity-30">{{ activeFilter === 'cyber' ? '🔒' : '⊞' }}</span>
                    <p class="font-mono text-sm text-[#90e0ef] opacity-40">Belum ada project di kategori ini.</p>
                </div>
            </div>

            <!-- TAB: SERTIFIKAT -->
            <div v-if="activeTab === 'certs'"
                 class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                <div v-for="c in certs" :key="c.title"
                     class="glass-card p-6 relative overflow-hidden group
                            transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(0,180,216,0.1)]"
                     :style="{ borderColor: c.borderColor }">

                    <!-- Left accent bar -->
                    <div class="absolute left-0 top-0 w-0.5 h-full rounded-l-2xl"
                         :style="{ background: c.badgeColor }"></div>

                    <!-- Badge -->
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full mb-4
                                font-mono text-[0.62rem] tracking-widest uppercase"
                         :style="{ background: c.color, color: c.badgeColor, border: '1px solid ' + c.badgeColor + '44' }">
                        {{ c.badge }}
                    </div>

                    <h3 class="font-bold text-white text-sm leading-snug mb-2">{{ c.title }}</h3>
                    <p class="text-[#90e0ef] text-xs leading-relaxed mb-4 opacity-70">{{ c.desc }}</p>

                    <div class="flex items-center justify-between font-mono text-[0.62rem]">
                        <span class="text-[#90e0ef] opacity-50">{{ c.issuer }}</span>
                        <span class="px-2 py-0.5 rounded-full border font-bold"
                              :style="{ color: c.badgeColor, borderColor: c.badgeColor + '44', background: c.color }">
                            {{ c.year }}
                        </span>
                    </div>
                </div>

                <!-- Empty hint -->
                <div class="glass-card p-6 border-dashed flex flex-col items-center justify-center gap-2 opacity-30">
                    <span class="text-2xl">🎓</span>
                    <span class="font-mono text-xs text-[#90e0ef]">Tambah sertifikat di PortfolioSection.vue</span>
                </div>
            </div>

            <!-- TAB: TECH STACK -->
            <div v-if="activeTab === 'stack'"
                 class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
                <div v-for="group in techGroups" :key="group.label"
                     class="glass-card p-5 transition-all duration-300
                            hover:border-[rgba(0,180,216,0.3)] hover:-translate-y-1">
                    <div class="flex items-center gap-2.5 mb-4 pb-3
                                border-b border-[rgba(0,180,216,0.12)]">
                        <span class="text-lg">{{ group.icon }}</span>
                        <span class="font-mono text-xs text-[#48cae4] tracking-widest uppercase">{{ group.label }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span v-for="skill in group.skills" :key="skill.name"
                              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                     bg-[rgba(0,180,216,0.04)] border border-[rgba(0,180,216,0.12)]
                                     font-mono text-xs text-[#90e0ef]
                                     hover:border-[rgba(0,180,216,0.35)] hover:bg-[rgba(0,180,216,0.09)]
                                     hover:text-white transition-all duration-200 cursor-default">
                            {{ skill.icon }} {{ skill.name }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <!-- MODAL DETAIL PROJECT -->
        <Transition name="modal">
            <div v-if="selected"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-8"
                 style="background: rgba(2,12,27,0.92); backdrop-filter: blur(12px)"
                 @click.self="selected = null">

                <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl
                             border border-[rgba(0,180,216,0.2)] scrollbar-thin"
                     style="background: #041226">

                    <button class="absolute top-4 right-4 z-10 w-8 h-8 rounded-lg
                                   border border-[rgba(0,180,216,0.2)] bg-[rgba(0,180,216,0.06)]
                                   text-[#90e0ef] hover:text-white flex items-center justify-center
                                   text-sm transition-all"
                            @click="selected = null">✕</button>

                    <div class="p-6 md:p-8">
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 font-mono text-xs text-[#90e0ef] opacity-50 mb-6">
                            <span class="cursor-pointer hover:text-[#48cae4] transition-colors"
                                  @click="selected = null">Portfolio</span>
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
                                <div class="w-12 h-0.5 mb-5"
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
                                    ]" :key="m.label" class="glass-card px-3 py-2.5" v-if="m.val">
                                        <div class="font-mono text-[0.55rem] text-[#48cae4] uppercase tracking-widest opacity-60 mb-0.5">{{ m.label }}</div>
                                        <div class="font-bold text-xs text-white">{{ m.val }}</div>
                                    </div>
                                </div>

                                <!-- Buttons -->
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
                                            h-52 bg-[#071a36] flex items-center justify-center mb-4">
                                    <img v-if="selected.thumbnail" :src="selected.thumbnail" :alt="selected.title"
                                         class="w-full h-full object-cover object-top" />
                                    <div v-else class="flex flex-col items-center gap-2 text-[#90e0ef] opacity-25">
                                        <span class="text-4xl">🌊</span>
                                        <span class="font-mono text-xs">Screenshot Preview</span>
                                    </div>
                                </div>

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
                                    <p v-if="!(selected.features ?? []).length"
                                       class="text-xs text-[#90e0ef] opacity-40 font-mono">
                                        Belum ada features yang ditambahkan.
                                    </p>
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
.main-tab {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.85rem;
    color: #90e0ef;
    transition: all 0.25s;
    border: 1px solid transparent;
}
.main-tab:hover { color: white; background: rgba(0,180,216,0.08); }
.main-tab--active {
    background: rgba(0,180,216,0.12);
    border-color: rgba(0,180,216,0.3);
    color: #48cae4;
    box-shadow: 0 0 20px rgba(0,180,216,0.1);
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.modal-enter-active, .modal-leave-active { transition: opacity 0.25s; }
.modal-enter-from, .modal-leave-to { opacity: 0; }
</style>
