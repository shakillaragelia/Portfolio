<script setup>
import { ref, reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const props = defineProps({
    settings: Object,
    comments: Array,
})

// Local copy comments
const localComments = ref([...(props.comments ?? [])])

// ─ Contact form ─
const form       = reactive({ name: '', email: '', phone: '', message: '' })
const sending    = ref(false)
const sent       = ref(false)

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

// // ── Comment form ──────────────────────────────
// const cmt            = reactive({ name: '', message: '' })
// const avatarFile     = ref(null)
// const postingComment = ref(false)

// function onAvatar(e) { avatarFile.value = e.target.files[0] ?? null }

// function submitComment() {
//     postingComment.value = true
//     const data = new FormData()
//     data.append('name',    cmt.name)
//     data.append('message', cmt.message)
//     if (avatarFile.value) data.append('avatar', avatarFile.value)

//     router.post('/comment', data, {
//         forceFormData: true,
//         preserveScroll: true,
//         onSuccess: () => {
//             localComments.value.unshift({
//                 id:     Date.now(),
//                 name:   cmt.name,
//                 msg:    cmt.message,
//                 date:   new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' }),
//                 avatar: avatarFile.value ? URL.createObjectURL(avatarFile.value) : null,
//             })
//             Object.assign(cmt, { name: '', message: '' })
//             avatarFile.value = null
//         },
//         onFinish: () => postingComment.value = false,
//     })
// }

// WhatsApp link
const waUrl = () => {
    const num = props.settings?.whatsapp ?? ''
    const msg = encodeURIComponent(props.settings?.whatsapp_msg ?? 'Halo!')
    return `https://wa.me/${num}?text=${msg}`
}
</script>

<template>
    <section id="contact" class="py-24 relative"
             style="background: rgba(4,18,38,0.35)">

        <div class="absolute top-0 inset-x-0 h-px"
             style="background: linear-gradient(90deg, transparent, rgba(0,180,216,0.2), transparent)"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="section-label mb-3" data-reveal>06 / Contact</div>
            <h2 class="font-extrabold tracking-tight mb-3" data-reveal
                style="font-size: clamp(2rem, 4vw, 2.8rem)">
                Hubungi <span class="text-[#00b4d8]">Saya</span>
            </h2>
            <p class="text-[#0a2347] text-sm mb-12 font-mono" data-reveal>
                Punya project menarik atau butuh security audit? Let's talk.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- ── KIRI: Form + socials ── -->
                <div class="space-y-5" data-reveal>

                    <!-- Form card -->
                    <div class="glass-card p-6">
                        <h3 class="font-bold text-lg text-[#00b4d8] mb-1">Hubungi</h3>
                        <p class="text-[#0a2347] text-xs font-mono mb-5">Kirim pesan, saya balas sesegera mungkin.</p>

                        <form @submit.prevent="submitContact" class="space-y-3">
                            <!-- Name -->
                            <div class="flex items-center gap-2.5 bg-[#041226]
                                        border border-[rgba(0,180,216,0.18)] rounded-xl px-4 py-2.5
                                        focus-within:border-[rgba(0,180,216,0.45)] transition-colors">
                                <span class="text-[#0a2347] text-sm shrink-0">👤</span>
                                <input v-model="form.name" type="text" placeholder="Nama Anda" required
                                       class="flex-1 bg-transparent border-none outline-none
                                              text-[#caf0f8] text-sm placeholder-[#0a2347]" />
                            </div>
                            <!-- Email -->
                            <div class="flex items-center gap-2.5 bg-[#041226]
                                        border border-[rgba(0,180,216,0.18)] rounded-xl px-4 py-2.5
                                        focus-within:border-[rgba(0,180,216,0.45)] transition-colors">
                                <span class="text-[#0a2347] text-sm shrink-0">✉</span>
                                <input v-model="form.email" type="email" placeholder="Email Anda" required
                                       class="flex-1 bg-transparent border-none outline-none
                                              text-[#caf0f8] text-sm placeholder-[#0a2347]" />
                            </div>
                            <!-- Phone -->
                            <div class="flex items-center gap-2.5 bg-[#041226]
                                        border border-[rgba(0,180,216,0.18)] rounded-xl px-4 py-2.5
                                        focus-within:border-[rgba(0,180,216,0.45)] transition-colors">
                                <span class="text-[#0a2347] text-sm shrink-0">📱</span>
                                <input v-model="form.phone" type="text" placeholder="Nomor WhatsApp (opsional)"
                                       class="flex-1 bg-transparent border-none outline-none
                                              text-[#caf0f8] text-sm placeholder-[#0a2347]" />
                            </div>
                            <!-- Message -->
                            <textarea v-model="form.message" rows="4" placeholder="Pesan Anda..." required
                                      class="w-full bg-[#041226] border border-[rgba(0,180,216,0.18)] rounded-xl
                                             px-4 py-2.5 text-[#caf0f8] text-sm placeholder-[#0a2347]
                                             outline-none resize-none font-sans
                                             focus:border-[rgba(0,180,216,0.45)] transition-colors">
                            </textarea>

                            <button type="submit" :disabled="sending"
                                    class="w-full btn-ocean justify-center py-3 disabled:opacity-60">
                                <span v-if="!sending">✈ Kirim Pesan</span>
                                <span v-else>Mengirim...</span>
                            </button>

                            <p v-if="sent" class="text-center text-[#00b4d8] text-xs font-mono">
                                ✓ Pesan terkirim! Terima kasih 🌊
                            </p>
                        </form>
                    </div>

                    <!-- Connect & Social -->
                    <div class="glass-card p-5">
                        <div class="flex items-center gap-2 font-bold text-sm mb-4">
                            <span class="w-5 h-px bg-[#00b4d8]"></span>
                            Connect With Me
                        </div>

                        <!-- WhatsApp CTA -->
                        <a :href="waUrl()" target="_blank"
                           class="flex items-center gap-3 bg-[rgba(0,180,216,0.06)]
                                  border border-[rgba(0,180,216,0.18)] rounded-xl p-3.5 mb-3
                                  hover:border-[rgba(0,180,216,0.35)] transition-all group">
                            <div class="w-9 h-9 rounded-lg bg-[rgba(0,180,216,0.1)] flex items-center justify-center text-lg shrink-0">💬</div>
                            <div>
                                <div class="font-semibold text-sm text-[#caf0f8]">Chat di WhatsApp</div>
                                <div class="font-mono text-xs text-[#0a2347]">Respon lebih cepat</div>
                            </div>
                            <span class="ml-auto text-[#00b4d8] group-hover:translate-x-0.5 transition-transform">↗</span>
                        </a>

                        <!-- Social grid -->
                        <div class="grid grid-cols-2 gap-2">
                            <a v-for="s in socials" :key="s.label"
                               :href="s.href" target="_blank"
                               class="flex items-center gap-2.5 bg-[#041226]
                                      border border-[rgba(0,180,216,0.12)] rounded-xl p-2.5
                                      hover:border-[rgba(0,180,216,0.3)] transition-all">
                                <div class="w-7 h-7 rounded-lg bg-[rgba(0,180,216,0.08)]
                                            flex items-center justify-center font-mono text-xs
                                            font-bold text-[#00b4d8] shrink-0">
                                    {{ s.short }}
                                </div>
                                <div>
                                    <div class="text-xs font-semibold text-[#caf0f8] leading-none">{{ s.label }}</div>
                                    <div class="font-mono text-[0.6rem] text-[#0a2347] mt-0.5">{{ s.handle }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ── KANAN: Comments ── -->
                <div class="glass-card p-6 flex flex-col" data-reveal>
                    <!-- Header -->
                    <div class="flex items-center gap-2.5 mb-5">
                        <span class="text-base">💬</span>
                        <span class="font-bold">Comments</span>
                        <span class="font-mono text-xs text-[#00b4d8] bg-[rgba(0,180,216,0.1)]
                                     border border-[rgba(0,180,216,0.2)] px-2 py-0.5 rounded-full">
                            {{ localComments.length }}
                        </span>
                    </div>

                    <!-- Post form -->
                    <form @submit.prevent="submitComment" class="space-y-2.5 mb-5">
                        <input v-model="cmt.name" type="text" placeholder="Nama kamu" required
                               class="w-full bg-[#041226] border border-[rgba(0,180,216,0.18)] rounded-xl
                                      px-4 py-2.5 text-[#caf0f8] text-sm placeholder-[#0a2347]
                                      outline-none focus:border-[rgba(0,180,216,0.45)] transition-colors font-sans" />

                        <textarea v-model="cmt.message" rows="3" placeholder="Tulis komentar..." required
                                  class="w-full bg-[#041226] border border-[rgba(0,180,216,0.18)] rounded-xl
                                         px-4 py-2.5 text-[#caf0f8] text-sm placeholder-[#0a2347]
                                         outline-none resize-none font-sans
                                         focus:border-[rgba(0,180,216,0.45)] transition-colors">
                        </textarea>

                        <!-- Upload avatar -->
                        <label class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl
                                      border border-dashed border-[rgba(0,180,216,0.25)]
                                      bg-[rgba(0,180,216,0.04)] font-mono text-xs text-[#00b4d8]
                                      cursor-pointer hover:bg-[rgba(0,180,216,0.09)] transition-all">
                            <span>📷</span>
                            {{ avatarFile ? avatarFile.name : 'Upload Foto Profil (opsional · maks 5MB)' }}
                            <input type="file" accept="image/*" class="hidden" @change="onAvatar" />
                        </label>

                        <button type="submit" :disabled="postingComment"
                                class="w-full btn-ocean justify-center py-2.5 disabled:opacity-60 text-sm">
                            <span v-if="!postingComment">✈ Post Comment</span>
                            <span v-else>Posting...</span>
                        </button>
                    </form>

                    <!-- Comment list -->
                    <div class="space-y-3 overflow-y-auto pr-1 flex-1"
                         style="max-height: 340px;
                                scrollbar-width: thin;
                                scrollbar-color: rgba(0,180,216,0.25) transparent">
                        <div v-if="localComments.length === 0"
                             class="text-center text-[#0a2347] font-mono text-xs py-8">
                            Belum ada komentar. Jadilah yang pertama! 🌊
                        </div>

                        <div v-for="c in localComments" :key="c.id"
                             class="flex gap-3 bg-[#041226] border border-[rgba(0,180,216,0.1)]
                                    rounded-xl p-3.5">
                            <!-- Avatar -->
                            <div class="w-9 h-9 rounded-full border border-[rgba(0,180,216,0.2)]
                                        bg-[rgba(0,180,216,0.1)] overflow-hidden
                                        flex items-center justify-center font-bold text-sm text-[#00b4d8] shrink-0">
                                <img v-if="c.avatar" :src="c.avatar" alt="" class="w-full h-full object-cover" />
                                <span v-else>{{ c.name[0]?.toUpperCase() }}</span>
                            </div>
                            <!-- Body -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-bold text-xs text-[#caf0f8]">{{ c.name }}</span>
                                    <span class="font-mono text-[0.6rem] text-[#0a2347]">{{ c.date }}</span>
                                </div>
                                <p class="text-xs text-[#0a2347] leading-relaxed">{{ c.msg }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
export default {
    computed: {
        socials() {
            const s = this.settings ?? {}
            return [
                { label: 'GitHub',     short: 'GH',  handle: '@yourhandle',  href: s.github    ?? '#' },
                { label: 'LinkedIn',   short: 'in',  handle: "Let's Connect", href: s.linkedin  ?? '#' },
                { label: 'Instagram',  short: 'IG',  handle: '@yourhandle',  href: s.instagram ?? '#' },
                { label: 'HackTheBox', short: 'HTB', handle: '@yourprofile', href: s.hackthebox ?? '#' },
            ].filter(x => x.href !== '#' || true) 
        }
    }
}
</script>
