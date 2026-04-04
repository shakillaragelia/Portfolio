<script setup>
const ctfs = [
    {
        badge: 'Web Exploitation',
        title: 'SQL Injection Bypass — CTF National',
        desc:  'Exploitasi blind SQLi pada login form dengan custom filter. Bypass via time-based injection dan automasi Python.',
        event: 'CTF Indonesia 2024',
        diff:  4,
    },
    {
        badge: 'IDOR / Auth Bypass',
        title: 'Broken Object Level Authorization',
        desc:  'IDOR pada endpoint API yang memungkinkan akses data user lain hanya dengan mengganti ID parameter.',
        event: 'Bug Bounty 2024',
        diff:  3,
    },
    {
        badge: 'XSS + CSRF Chain',
        title: 'Stored XSS → Account Takeover',
        desc:  'Chained Stored XSS dengan CSRF untuk account takeover. Dilaporkan via responsible disclosure.',
        event: 'Private Program 2023',
        diff:  5,
    },
]

const tools = [
    'Burp Suite', 'OWASP ZAP', 'Nmap', 'Metasploit',
    'SQLMap', 'Nikto', 'Gobuster', 'Ffuf',
    'Wireshark', 'Hydra', 'John the Ripper', 'Python',
]
</script>

<template>
    <section id="security" class="py-16 relative">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.2), transparent)"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="section-label mb-3" data-reveal>05 / Security</div>
            <h2 class="font-extrabold tracking-tight mb-14" data-reveal
                style="font-size: clamp(2rem, 4vw, 2.8rem)">
                Cyber <span class="text-[#00b4d8]">Security</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.1fr] gap-8">

                <!-- Kiri: Terminal + tools -->
                <div class="space-y-5" data-reveal>

                    <!-- Terminal block -->
                    <div class="glass-card p-5 font-mono text-sm leading-8">
                        <div class="flex gap-1.5 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#ff5f57]"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-[#febc2e]"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-[#28c840]"></span>
                        </div>
                        <div class="text-[0.8rem] space-y-1">
                            <p><span class="text-[#00b4d8]">$</span> <span class="text-[#caf0f8]">whoami</span></p>
                            <p class="text-[#0a2347]">&gt; penetration tester · ctf player · owasp enthusiast</p>
                            <br>
                            <p><span class="text-[#00b4d8]">$</span> <span class="text-[#caf0f8]">cat focus.txt</span></p>
                            <p class="text-[#0a2347]">&gt; Web App Security · OWASP Top 10</p>
                            <p class="text-[#0a2347]">&gt; Pentest & Bug Bounty · CTF Competition</p>
                            <br>
                            <p><span class="text-[#00b4d8]">$</span> <span class="text-[#caf0f8]">cat platforms.txt</span></p>
                            <p class="text-[#0a2347]">&gt; HackTheBox · TryHackMe · CTF.id</p>
                        </div>
                    </div>

                    <!-- Tools used -->
                    <div class="glass-card p-5">
                        <div class="font-mono text-xs text-[#00b4d8] tracking-widest uppercase mb-3">
                            Tools & Arsenal
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="t in tools" :key="t"
                                  class="font-mono text-xs px-2.5 py-1 rounded-lg
                                         border border-[rgba(0,180,216,0.15)] bg-[rgba(0,180,216,0.04)]
                                         text-[#7ab8cc] hover:border-[rgba(0,180,216,0.35)]
                                         hover:text-[#caf0f8] transition-all cursor-default">
                                {{ t }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kanan: CTF writeups -->
                <div class="space-y-4" data-reveal>
                    <div class="font-mono text-xs text-[#0a2347] tracking-widest uppercase mb-2">
                        CTF Writeups & Bug Bounty
                    </div>

                    <div v-for="c in ctfs" :key="c.title"
                         class="glass-card p-5 group relative overflow-hidden
                                transition-all duration-300
                                hover:border-[rgba(255,68,102,0.25)] hover:-translate-y-0.5">

                        <!-- Top accent line -->
                        <div class="absolute top-0 left-0 h-0.5 w-0 group-hover:w-full transition-all duration-400"
                             style="background: #ff4466"></div>

                        <!-- Badge -->
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded mb-3
                                    border border-[rgba(255,68,102,0.2)] bg-[rgba(255,68,102,0.07)]
                                    font-mono text-[0.6rem] text-[#ff7096] tracking-widest uppercase">
                            {{ c.badge }}
                        </div>

                        <h3 class="font-bold text-sm text-[#caf0f8] mb-2">{{ c.title }}</h3>
                        <p class="text-[0.8rem] text-[#0a2347] leading-relaxed mb-3">{{ c.desc }}</p>

                        <div class="flex items-center justify-between">
                            <span class="font-mono text-[0.62rem] text-[#0a2347]">{{ c.event }}</span>
                            <!-- Difficulty dots -->
                            <div class="flex gap-1">
                                <span v-for="n in 5" :key="n"
                                      class="w-1.5 h-1.5 rounded-full transition-colors"
                                      :style="n <= c.diff ? 'background:#ff4466' : 'background:rgba(0,180,216,0.15)'">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
