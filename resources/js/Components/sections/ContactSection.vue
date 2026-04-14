<script setup>
import { ref, reactive, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    settings: Object,
    comments: Array,
})

// Contact form
const form    = reactive({ name: '', email: '', phone: '', message: '' })
const sending = ref(false)
const sent    = ref(false)

function submitContact() {
    sending.value = true
    router.post('/contact', { ...form }, {
        onSuccess: () => {
            sent.value = true
            Object.assign(form, { name: '', email: '', phone: '', message: '' })
            setTimeout(() => sent.value = false, 4000)
        },
        onFinish: () => sending.value = false,
        preserveScroll: true,
    })
}

// WhatsApp
const waUrl = () => {
    const num = props.settings?.whatsapp ?? ''
    const msg = encodeURIComponent(props.settings?.whatsapp_msg ?? 'Halo!')
    return `https://wa.me/${num}?text=${msg}`
}

// Socials
const socials = computed(() => {
    const s = props.settings ?? {}
    return [
        { label: 'GitHub',     short: 'GH',  handle: s.github     ? '@' + (s.github.split('/').pop()     ?? 'handle') : '@handle', href: s.github     ?? '#', color: 'rgba(255,255,255,0.1)' },
        { label: 'LinkedIn',   short: 'in',  handle: "Let's Connect",                                                               href: s.linkedin   ?? '#', color: 'rgba(10,102,194,0.2)' },
        { label: 'Instagram',  short: 'IG',  handle: s.instagram   ? '@' + (s.instagram.split('/').pop()   ?? 'handle') : '@handle', href: s.instagram  ?? '#', color: 'rgba(225,48,108,0.2)' },
        { label: 'HackTheBox', short: 'HTB', handle: '@yourprofile',                                                                 href: s.hackthebox ?? '#', color: 'rgba(0,180,216,0.15)'  },
    ]
})
</script>

<template>
    <section id="contact" class="py-20 relative">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.3), transparent)"></div>

        <div class="w-full px-8 lg:px-16 xl:px-24">

            <!-- Header -->
            <div class="mb-14">
                <div class="section-label mb-3">06 / Contact</div>
                <h2 class="font-extrabold tracking-tight text-white mb-3"
                    style="font-size: clamp(2rem, 4vw, 3rem)">
                    Hubungi <span class="text-[#00b4d8]">Saya</span>
                </h2>
                <p class="text-[#90e0ef] text-base max-w-xl">
                    Punya project menarik atau butuh security audit? Let's talk — saya akan balas sesegera mungkin.
                </p>
            </div>

            <!-- Grid: Form kiri, Info kanan -->
            <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_1fr] gap-8 items-start">

                <!-- KIRI: Form -->
                <div class="glass-card p-8">
                    <h3 class="font-bold text-xl text-[#48cae4] mb-1">Kirim Pesan</h3>
                    <p class="text-[#90e0ef] text-sm mb-6 opacity-70">Isi form di bawah dan saya akan segera menghubungi kamu.</p>

                    <form @submit.prevent="submitContact" class="space-y-4">

                        <!-- Name & Email row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="input-wrap">
                                <span class="input-icon">👤</span>
                                <input v-model="form.name" type="text" placeholder="Nama Anda" required
                                       class="input-field" />
                            </div>
                            <div class="input-wrap">
                                <span class="input-icon">✉</span>
                                <input v-model="form.email" type="email" placeholder="Email Anda" required
                                       class="input-field" />
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="input-wrap">
                            <span class="input-icon">📱</span>
                            <input v-model="form.phone" type="text" placeholder="Nomor WhatsApp (opsional)"
                                   class="input-field" />
                        </div>

                        <!-- Message -->
                        <textarea v-model="form.message" rows="5" placeholder="Ceritakan project atau kebutuhanmu..." required
                                  class="w-full bg-[rgba(0,180,216,0.04)] border border-[rgba(0,180,216,0.2)] rounded-xl
                                         px-4 py-3 text-white text-sm placeholder-[rgba(144,224,239,0.4)]
                                         outline-none resize-none font-sans
                                         focus:border-[rgba(0,180,216,0.5)] focus:bg-[rgba(0,180,216,0.07)]
                                         transition-all">
                        </textarea>

                        <button type="submit" :disabled="sending"
                                class="w-full btn-ocean justify-center py-3.5 text-base font-bold
                                       disabled:opacity-50 disabled:cursor-not-allowed">
                            <span v-if="!sending">✈ Kirim Pesan</span>
                            <span v-else class="flex items-center gap-2">
                                <span class="w-4 h-4 border-2 border-[#010b18] border-t-transparent rounded-full animate-spin"></span>
                                Mengirim...
                            </span>
                        </button>

                        <!-- Success message -->
                        <div v-if="sent"
                             class="flex items-center gap-3 p-4 rounded-xl
                                    bg-[rgba(0,180,216,0.1)] border border-[rgba(0,180,216,0.3)]">
                            <span class="text-[#48cae4] text-lg">✓</span>
                            <p class="text-[#90e0ef] text-sm">Pesan terkirim! Terima kasih, saya akan segera membalas. 🌊</p>
                        </div>
                    </form>
                </div>

                <!-- KANAN: Info + Connect -->
                <div class="space-y-5">

                    <!-- Direct contact info -->
                    <div class="glass-card p-6">
                        <h3 class="font-bold text-base text-white mb-4 flex items-center gap-2">
                            <span class="w-5 h-px bg-[#00b4d8]"></span>
                            Kontak Langsung
                        </h3>

                        <!-- Email -->
                        <a v-if="settings?.email" :href="'mailto:' + settings.email"
                           class="flex items-center gap-3 p-3 rounded-xl
                                  bg-[rgba(0,180,216,0.05)] border border-[rgba(0,180,216,0.15)]
                                  hover:border-[rgba(0,180,216,0.4)] hover:bg-[rgba(0,180,216,0.1)]
                                  transition-all group mb-3">
                            <div class="w-9 h-9 rounded-lg bg-[rgba(0,180,216,0.12)] flex items-center justify-center text-base shrink-0">✉</div>
                            <div>
                                <div class="font-mono text-[0.6rem] text-[#48cae4] uppercase tracking-widest opacity-60 mb-0.5">Email</div>
                                <div class="text-sm font-semibold text-[#90e0ef] group-hover:text-[#caf0f8]">{{ settings.email }}</div>
                            </div>
                            <span class="ml-auto text-[#00b4d8] opacity-0 group-hover:opacity-100 transition-opacity">↗</span>
                        </a>

                        <!-- WhatsApp -->
                        <a :href="waUrl()" target="_blank"
                           class="flex items-center gap-3 p-3 rounded-xl
                                  bg-[rgba(0,200,100,0.05)] border border-[rgba(0,200,100,0.15)]
                                  hover:border-[rgba(0,200,100,0.4)] hover:bg-[rgba(0,200,100,0.1)]
                                  transition-all group">
                            <div class="w-9 h-9 rounded-lg bg-[rgba(0,200,100,0.12)] flex items-center justify-center text-base shrink-0">💬</div>
                            <div>
                                <div class="font-mono text-[0.6rem] text-green-400 uppercase tracking-widest opacity-60 mb-0.5">WhatsApp</div>
                                <div class="text-sm font-semibold text-[#90e0ef] group-hover:text-[#caf0f8]">Chat di WhatsApp</div>
                                <div class="font-mono text-[0.65rem] text-[#90e0ef] opacity-50">Respon lebih cepat</div>
                            </div>
                            <span class="ml-auto text-green-400 opacity-0 group-hover:opacity-100 transition-opacity">↗</span>
                        </a>
                    </div>

                    <!-- Social links -->
                    <div class="glass-card p-6">
                        <h3 class="font-bold text-base text-white mb-4 flex items-center gap-2">
                            <span class="w-5 h-px bg-[#00b4d8]"></span>
                            Temukan Saya Di
                        </h3>
                        <div class="grid grid-cols-2 gap-2.5">
                            <a v-for="s in socials" :key="s.label"
                               :href="s.href" target="_blank"
                               class="flex items-center gap-2.5 p-3 rounded-xl
                                      border border-[rgba(0,180,216,0.12)]
                                      hover:border-[rgba(0,180,216,0.35)]
                                      transition-all group"
                               :style="{ background: s.color }">
                                <div class="w-8 h-8 rounded-lg bg-[rgba(255,255,255,0.05)]
                                            flex items-center justify-center
                                            font-mono text-xs font-bold text-[#90e0ef] shrink-0">
                                    {{ s.short }}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-semibold text-white leading-none">{{ s.label }}</div>
                                    <div class="font-mono text-[0.6rem] text-[#90e0ef] opacity-60 mt-0.5 truncate">{{ s.handle }}</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Availability badge -->
                    <div class="glass-card p-5 flex items-center gap-4">
                        <div class="relative">
                            <div class="w-3 h-3 rounded-full"
                                 :class="settings?.available === 'true' ? 'bg-green-400' : 'bg-yellow-400'"></div>
                            <div class="absolute inset-0 w-3 h-3 rounded-full animate-ping opacity-50"
                                 :class="settings?.available === 'true' ? 'bg-green-400' : 'bg-yellow-400'"></div>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-white">
                                {{ settings?.available === 'true' ? 'Available for Projects' : 'Currently Busy' }}
                            </div>
                            <div class="font-mono text-[0.65rem] text-[#90e0ef] opacity-60">
                                {{ settings?.available === 'true' ? 'Siap menerima project baru' : 'Hubungi untuk diskusi dulu' }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<style scoped>
.input-wrap {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(0,180,216,0.04);
    border: 1px solid rgba(0,180,216,0.2);
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    transition: all 0.2s;
}
.input-wrap:focus-within {
    border-color: rgba(0,180,216,0.5);
    background: rgba(0,180,216,0.07);
}
.input-icon { font-size: 0.85rem; color: rgba(144,224,239,0.5); flex-shrink: 0; }
.input-field {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: white;
    font-family: inherit;
    font-size: 0.88rem;
}
.input-field::placeholder { color: rgba(144,224,239,0.4); }
</style>
