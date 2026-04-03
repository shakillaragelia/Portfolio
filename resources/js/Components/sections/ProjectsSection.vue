<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ projects: Array })

const activeFilter = ref('all')
const selected     = ref(null)

const filters = [
    { value: 'all',       label: 'Semua'      },
    { value: 'fullstack', label: 'Full Stack' },
    { value: 'backend',   label: 'Backend'    },
    { value: 'security',  label: 'Security'   },
    { value: 'frontend',  label: 'Frontend'   },
]

const filtered = computed(() =>
    activeFilter.value === 'all'
        ? (props.projects ?? [])
        : (props.projects ?? []).filter(p => p.type === activeFilter.value)
)

const isSecurity = (p) => p.type === 'security'

// Tutup modal saat Escape
import { onMounted, onUnmounted } from 'vue'
function onKey(e) { if (e.key === 'Escape') selected.value = null }
onMounted(() => window.addEventListener('keydown', onKey))
onUnmounted(() => window.removeEventListener('keydown', onKey))
</script>

<template>
    <section id="projects" class="py-24 relative"
             style="background: rgba(4,18,38,0.35)">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.2), transparent)"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="section-label mb-3" data-reveal>04 / Projects</div>
            <h2 class="font-extrabold tracking-tight mb-3" data-reveal
                style="font-size: clamp(2rem, 4vw, 2.8rem)">
                Selected <span class="text-[#00b4d8]">Work</span>
            </h2>
            <p class="text-[#0a2347] text-sm mb-10 font-mono" data-reveal>
                Klik card untuk melihat detail project
            </p>

            <!-- Filter -->
            <div class="flex flex-wrap gap-2 mb-8" data-reveal>
                <button v-for="f in filters" :key="f.value"
                        class="px-4 py-1.5 rounded-lg font-mono text-xs tracking-wide transition-all duration-200"
                        :class="activeFilter === f.value
                            ? 'bg-gradient-to-r from-[#0077b6] to-[#00b4d8] text-[#010b18] font-bold'
                            : 'border border-[rgba(0,180,216,0.2)] text-[#7ab8cc] hover:border-[rgba(0,180,216,0.45)] hover:text-[#caf0f8]'"
                        @click="activeFilter = f.value">
                    {{ f.label }}
                </button>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <article v-for="p in filtered" :key="p.id"
                         class="glass-card overflow-hidden cursor-pointer group
                                transition-all duration-300 hover:-translate-y-1.5
                                hover:border-[rgba(0,180,216,0.3)]"
                         data-reveal
                         @click="selected = p">

                    <!-- Thumbnail -->
                    <div class="relative h-48 bg-[#041226] overflow-hidden">
                        <img v-if="p.thumbnail"
                             :src="p.thumbnail"
                             :alt="p.title"
                             class="w-full h-full object-cover object-top
                                    transition-transform duration-500 group-hover:scale-105
                                    brightness-75 group-hover:brightness-90" />

                        <div v-else class="w-full h-full flex flex-col items-center justify-center gap-2
                                           font-mono text-[0.65rem] text-[#0a2347] tracking-wider">
                            <span class="text-3xl">⊞</span>
                            <span>PROJECT PORTFOLIO</span>
                        </div>

                        <!-- Overlay gradient -->
                        <div class="absolute inset-0"
                             style="background: linear-gradient(to top, rgba(2,8,24,0.85) 0%, transparent 55%)"></div>

                        <!-- Type badge -->
                        <div class="absolute top-3 right-3 font-mono text-[0.6rem] tracking-widest px-2 py-0.5 rounded
                                    backdrop-blur-sm"
                             :class="isSecurity(p)
                                ? 'bg-[rgba(255,68,102,0.15)] border border-[rgba(255,68,102,0.25)] text-[#ff7096]'
                                : 'bg-[rgba(0,180,216,0.12)] border border-[rgba(0,180,216,0.2)] text-[#00b4d8]'">
                            {{ p.type }}
                        </div>

                        <!-- Title overlay on image -->
                        <div v-if="p.thumbnail" class="absolute bottom-0 left-0 right-0 p-3">
                            <h3 class="font-bold text-sm text-white leading-tight">{{ p.title }}</h3>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-4">
                        <h3 v-if="!p.thumbnail"
                            class="font-bold text-[0.95rem] text-[#caf0f8] mb-2
                                   group-hover:text-[#00b4d8] transition-colors">
                            {{ p.title }}
                        </h3>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            <span v-for="tag in (p.tags ?? []).slice(0, 3)" :key="tag"
                                  class="font-mono text-[0.6rem] px-2 py-0.5 rounded"
                                  :class="isSecurity(p)
                                    ? 'bg-[rgba(255,68,102,0.08)] border border-[rgba(255,68,102,0.2)] text-[#ff7096]'
                                    : 'bg-[rgba(0,180,216,0.07)] border border-[rgba(0,180,216,0.18)] text-[#00b4d8]'">
                                {{ tag }}
                            </span>
                        </div>

                        <p class="text-[0.8rem] text-[#0a2347] leading-relaxed mb-3 line-clamp-2">
                            {{ p.description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex gap-3">
                                <a v-if="p.demo_url" :href="p.demo_url" target="_blank"
                                   class="font-mono text-[0.68rem] text-[#7ab8cc] hover:text-[#00b4d8] transition-colors"
                                   @click.stop>↗ Live</a>
                                <a v-if="p.github_url" :href="p.github_url" target="_blank"
                                   class="font-mono text-[0.68rem] text-[#7ab8cc] hover:text-[#00b4d8] transition-colors"
                                   @click.stop>⌥ GitHub</a>
                            </div>
                            <span class="font-mono text-[0.65rem] text-[#00b4d8] bg-[rgba(0,180,216,0.08)]
                                         px-2.5 py-1 rounded-lg border border-[rgba(0,180,216,0.2)]
                                         group-hover:bg-[#00b4d8] group-hover:text-[#010b18]
                                         transition-all duration-200">
                                Detail →
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <!-- MODAL DETAIL PROJECT -->
        <Transition name="modal">
            <div v-if="selected"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-8"
                 style="background: rgba(1,11,24,0.88); backdrop-filter: blur(10px)"
                 @click.self="selected = null">

                <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl
                             border border-[rgba(0,180,216,0.2)] shadow-2xl"
                     style="background: #040f2e">

                    <!-- Close -->
                    <button class="absolute top-4 right-4 z-10 w-8 h-8 rounded-lg
                                   border border-[rgba(0,180,216,0.2)] bg-[rgba(0,180,216,0.06)]
                                   text-[#7ab8cc] hover:text-[#caf0f8] hover:bg-[rgba(0,180,216,0.15)]
                                   flex items-center justify-center text-sm transition-all"
                            @click="selected = null">✕</button>

                    <div class="p-6 md:p-8">
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 font-mono text-xs text-[#0a2347] mb-6">
                            <span class="cursor-pointer hover:text-[#00b4d8] transition-colors"
                                  @click="selected = null">Projects</span>
                            <span>›</span>
                            <span class="text-[#7ab8cc]">{{ selected.title }}</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <!-- Kiri -->
                            <div>
                                <h2 class="font-extrabold text-[#00b4d8] leading-tight mb-2"
                                    style="font-size: clamp(1.4rem, 3vw, 2rem)">
                                    {{ selected.title }}
                                </h2>
                                <div class="w-12 h-0.5 mb-4"
                                     style="background: linear-gradient(90deg, #0077b6, #00b4d8)"></div>

                                <p class="text-[#7ab8cc] text-sm leading-relaxed mb-5">
                                    {{ selected.long_description ?? selected.description }}
                                </p>

                                <!-- Meta -->
                                <div class="grid grid-cols-2 gap-2.5 mb-5">
                                    <div v-for="m in [
                                            { label: 'Role',     val: selected.role },
                                            { label: 'Duration', val: selected.duration },
                                            { label: 'Year',     val: selected.year },
                                            { label: 'Type',     val: selected.type },
                                         ]" :key="m.label"
                                         class="glass-card px-3 py-2.5">
                                        <div class="font-mono text-[0.55rem] text-[#0a2347] tracking-widest uppercase mb-0.5">{{ m.label }}</div>
                                        <div class="font-bold text-xs text-[#caf0f8]">{{ m.val }}</div>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="flex gap-2.5 mb-5">
                                    <a v-if="selected.demo_url" :href="selected.demo_url" target="_blank"
                                       class="btn-ocean text-sm px-4 py-2">↗ Live Demo</a>
                                    <a v-if="selected.github_url" :href="selected.github_url" target="_blank"
                                       class="btn-ghost text-sm px-4 py-2">⌥ GitHub</a>
                                </div>

                                <!-- Tech stack -->
                                <div class="font-mono text-[0.6rem] text-[#0a2347] tracking-widest uppercase mb-2">
                                    &lt;/&gt; Technologies
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    <span v-for="t in (selected.tech_stack ?? [])" :key="t"
                                          class="font-mono text-[0.68rem] px-2.5 py-1 rounded-full
                                                 border border-[rgba(0,180,216,0.18)]
                                                 bg-[rgba(0,180,216,0.05)] text-[#90e0ef]">
                                        · {{ t }}
                                    </span>
                                </div>
                            </div>

                            <!-- Kanan -->
                            <div>
                                <!-- Screenshot -->
                                <div class="rounded-xl overflow-hidden border border-[rgba(0,180,216,0.15)]
                                            mb-4 h-48 bg-[#071442] flex items-center justify-center">
                                    <img v-if="selected.thumbnail"
                                         :src="selected.thumbnail" :alt="selected.title"
                                         class="w-full h-full object-cover object-top" />
                                    <div v-else class="flex flex-col items-center gap-2 text-[#0a2347] font-mono text-xs">
                                        <span class="text-3xl">🌊</span>
                                        <span>Screenshot Preview</span>
                                    </div>
                                </div>

                                <!-- Features -->
                                <div class="glass-card p-4">
                                    <div class="font-bold text-[#00b4d8] text-sm mb-3 flex items-center gap-2">
                                        <span>⭐</span> Key Features
                                    </div>
                                    <ul class="space-y-2">
                                        <li v-for="f in (selected.features ?? [])" :key="f"
                                            class="flex items-start gap-2.5 text-xs text-[#7ab8cc] leading-relaxed">
                                            <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#00b4d8] shrink-0"></span>
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
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.modal-enter-active, .modal-leave-active { transition: opacity 0.25s; }
.modal-enter-from, .modal-leave-to       { opacity: 0; }
</style>
