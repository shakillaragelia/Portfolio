<script setup>
const groups = [
    {
        label: 'Backend',
        icon: '⚙',
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
        label: 'Frontend',
        icon: '🖥',
        skills: [
            { name: 'Vue.js 3',    icon: '💚' },
            { name: 'JavaScript',  icon: '🟡' },
            { name: 'Inertia.js',  icon: '🟣' },
            { name: 'Tailwind CSS',icon: '🌊' },
            { name: 'HTML / CSS',  icon: '🎨' },
            { name: 'Alpine.js',   icon: '❄️' },
        ],
    },
    {
        label: 'Security',
        icon: '🔒',
        skills: [
            { name: 'Burp Suite', icon: '🕷' },
            { name: 'OWASP Top10',icon: '🛡️' },
            { name: 'SQLi / XSS', icon: '💉' },
            { name: 'Nmap',       icon: '📡' },
            { name: 'Metasploit', icon: '💀' },
            { name: 'CTF',        icon: '🚩' },
        ],
    },
    {
        label: 'DevOps & Tools',
        icon: '🛠',
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
    <section id="skills" class="py-24 relative"
             style="background: linear-gradient(180deg, rgba(4,18,38,0.4) 0%, transparent 100%)">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.2), transparent)"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="section-label mb-3" data-reveal>03 / Skills</div>
            <h2 class="font-extrabold tracking-tight mb-14" data-reveal
                style="font-size: clamp(2rem, 4vw, 2.8rem)">
                Tech <span class="text-[#00b4d8]">Stack</span>
            </h2>

            <!-- Grouped grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div v-for="group in groups" :key="group.label"
                     class="glass-card p-5" data-reveal>

                    <!-- Group header -->
                    <div class="flex items-center gap-2.5 mb-4 pb-3
                                border-b border-[rgba(0,180,216,0.1)]">
                        <span class="text-lg">{{ group.icon }}</span>
                        <span class="font-mono text-xs text-[#00b4d8] tracking-widest uppercase">{{ group.label }}</span>
                    </div>

                    <!-- Skill tags -->
                    <div class="flex flex-wrap gap-2">
                        <span v-for="skill in group.skills" :key="skill.name"
                              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                     bg-[rgba(0,180,216,0.04)] border border-[rgba(0,180,216,0.12)]
                                     font-mono text-xs text-[#90e0ef]
                                     hover:border-[rgba(0,180,216,0.35)] hover:bg-[rgba(0,180,216,0.09)]
                                     transition-all duration-200 cursor-default">
                            <span>{{ skill.icon }}</span>
                            {{ skill.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
