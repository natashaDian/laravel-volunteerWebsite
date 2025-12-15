{{-- resources/views/about.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Give2Grow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Theme -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7C3AED',
                        secondary: '#3B82F6',
                        accent: '#F5F3FF',
                        dark: '#1E1B4B'
                    },
                    boxShadow: {
                        soft: '0 10px 30px rgba(0,0,0,0.08)'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-700">

    {{-- NAVBAR SAMA KAYAK PAGE LAIN --}}
    @include('layouts.navigation')

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary to-secondary text-white">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,white,transparent_40%)]"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-14 items-center">
            <div>
                <span class="uppercase tracking-widest text-sm text-white/80">About Give2Grow</span>
                <h1 class="text-5xl font-extrabold leading-tight mt-4 mb-6">
                    Growing Impact<br>Through Volunteering
                </h1>
                <p class="text-lg text-white/90 mb-8">
                    A volunteer-driven platform connecting people, organizations, and meaningful social impact.
                </p>
                <a href="#contact" class="inline-flex items-center gap-2 bg-white text-primary font-semibold px-8 py-4 rounded-full shadow-lg hover:scale-105 transition">
                    Get in Touch
                    <span>→</span>
                </a>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac" class="rounded-3xl shadow-soft" alt="volunteer">
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="-mt-16 relative z-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-soft grid grid-cols-2 md:grid-cols-4 text-center">
                <div class="p-8">
                    <h3 class="text-4xl font-bold text-primary">1K+</h3>
                    <p class="text-sm mt-2">Volunteers</p>
                </div>
                <div class="p-8 border-l">
                    <h3 class="text-4xl font-bold text-primary">150+</h3>
                    <p class="text-sm mt-2">Activities</p>
                </div>
                <div class="p-8 border-l">
                    <h3 class="text-4xl font-bold text-primary">60+</h3>
                    <p class="text-sm mt-2">Organizations</p>
                </div>
                <div class="p-8 border-l">
                    <h3 class="text-4xl font-bold text-primary">10K+</h3>
                    <p class="text-sm mt-2">Lives Impacted</p>
                </div>
            </div>
        </div>
    </section>

    <!-- VISION & MISSION -->
    <section class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-slate-900">
            Our Vision & Mission
        </h2>
        <p class="mt-4 text-slate-500">
            The purpose and principles that guide everything we do at Give2Grow.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-10">

        <!-- VISION CARD -->
        <div
            class="bg-white rounded-3xl p-10
                   border border-slate-200
                   shadow-md hover:shadow-xl
                   transition-all duration-300">

            <span class="text-sm font-semibold tracking-widest text-purple-600">
                VISION
            </span>

            <h3 class="text-2xl font-bold mt-3 mb-4 text-slate-900">
                Empowered Communities
            </h3>

            <p class="text-slate-600 leading-relaxed">
                To build a world where everyone can contribute, grow,
                and create sustainable positive change together.
            </p>
        </div>

        <!-- MISSION CARD -->
        <div
            class="rounded-3xl p-10
                   bg-gradient-to-br from-purple-600 to-indigo-600
                   text-white
                   shadow-lg hover:shadow-2xl
                   transition-all duration-300">

            <span class="text-sm font-semibold tracking-widest text-white/80">
                MISSION
            </span>

            <h3 class="text-2xl font-bold mt-3 mb-4">
                Connecting People With Purpose
            </h3>

            <p class="text-white/90 leading-relaxed">
                We connect volunteers with impactful organizations,
                foster social responsibility, and strengthen communities
                through collaboration.
            </p>
        </div>

    </div>
</section>


    <!-- TEAM MEMBERS -->
    <section class="bg-white pt-16 pb-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <span class="uppercase tracking-widest text-sm text-secondary">Our Team</span>
            <h2 class="text-4xl font-bold text-dark mt-4">Meet Our Team Members</h2>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto">
                Dedicated people working together to grow impact and empower communities.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div class="bg-slate-50 rounded-3xl shadow-soft overflow-hidden hover:-translate-y-2 transition">
                <img src="{{ asset('img/syahira.png') }}" class="w-full h-72 object-cover object-top" alt="Syahira">
                <div class="p-6 text-center">
                    <div class="-mt-14 bg-orange-500 text-white rounded-xl py-3 px-4 inline-block shadow-lg">
                        <h4 class="font-semibold">Syifaa Syahira Almasyhur</h4>
                        <p class="text-sm opacity-90">CEO & Director</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl shadow-soft overflow-hidden hover:-translate-y-2 transition">
                <img src="{{ asset('img/kayla.jpeg') }}" class="w-full h-72 object-cover object-top" alt="Kayla">
                <div class="p-6 text-center">
                    <div class="-mt-14 bg-orange-500 text-white rounded-xl py-3 px-4 inline-block shadow-lg">
                        <h4 class="font-semibold">Flavia Kayla Wijaya</h4>
                        <p class="text-sm opacity-90">Head Manager</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl shadow-soft overflow-hidden hover:-translate-y-2 transition">
                <img src="{{ asset('img/natasha.jpeg') }}" class="w-full h-72 object-cover object-[70%_center] rounded-3xl" alt="Natasha">
                <div class="p-6 text-center">
                    <div class="-mt-14 bg-orange-500 text-white rounded-xl py-3 px-4 inline-block shadow-lg">
                        <h4 class="font-semibold">Natasha Dian Mahardita</h4>
                        <p class="text-sm opacity-90">Branch Manager</p>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl shadow-soft overflow-hidden hover:-translate-y-2 transition">
                <img src="{{ asset('img/valencia.jpeg') }}" class="w-full h-72 object-cover object-[70%_center] rounded-3xl" alt="Valencia">
                <div class="p-6 text-center">
                    <div class="-mt-14 bg-orange-500 text-white rounded-xl py-3 px-4 inline-block shadow-lg">
                        <h4 class="font-semibold">Valencia Jocelyn Zhiang</h4>
                        <p class="text-sm opacity-90">Supervisor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- CONTACT US -->
<section id="contact" class="max-w-7xl mx-auto px-6 pt-16 pb-24">
    <div class="grid md:grid-cols-2 gap-16 items-start">

        <!-- LEFT : FORM -->
        <div>
            <h2 class="text-4xl font-bold text-slate-900 mb-4">
                Contact Us
            </h2>
            <p class="text-slate-600 mb-10">
                Have questions or want to collaborate? Send us a message.
            </p>

            <form class="space-y-6">
                <!-- NAME -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input
                        type="text"
                        placeholder="First Name"
                        class="w-full rounded-xl bg-white px-4 py-4
                               border border-slate-300 shadow-sm
                               focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500
                               placeholder:text-slate-400"
                    />

                    <input
                        type="text"
                        placeholder="Last Name"
                        class="w-full rounded-xl bg-white px-4 py-4
                               border border-slate-300 shadow-sm
                               focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500
                               placeholder:text-slate-400"
                    />
                </div>

                <!-- EMAIL -->
                <input
                    type="email"
                    placeholder="Email Address"
                    class="w-full rounded-xl bg-white px-4 py-4
                           border border-slate-300 shadow-sm
                           focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500
                           placeholder:text-slate-400"
                />

                <!-- MESSAGE -->
                <textarea
                    rows="4"
                    placeholder="Your Message"
                    class="w-full rounded-xl bg-white px-4 py-4
                           border border-slate-300 shadow-sm
                           focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500
                           placeholder:text-slate-400 resize-none"></textarea>

                <!-- BUTTON -->
                <button
                    type="button"
                    class="inline-flex items-center justify-center
                           bg-gradient-to-r from-purple-600 to-indigo-600
                           text-white font-semibold
                           px-10 py-4 rounded-full
                           shadow-lg hover:scale-105 transition">
                    Send Message
                </button>
            </form>
        </div>

        <!-- RIGHT : REACH US -->
        <div
            class="bg-gradient-to-br from-purple-600 to-indigo-600
                   text-white rounded-3xl shadow-soft p-12">

            <h3 class="text-2xl font-bold mb-6">
                Reach Us
            </h3>

            <ul class="space-y-4 text-white/90 text-sm">
                <li class="flex items-center gap-3">
                    📍 <span>Jakarta, Indonesia</span>
                </li>
                <li class="flex items-center gap-3">
                    📞 <span>+62 812 3456 7890</span>
                </li>
                <li class="flex items-center gap-3">
                    ✉️ <span>hello@give2grow.org</span>
                </li>
            </ul>

            <!-- WORKING HOURS -->
            <div class="mt-8">
                <p class="text-sm uppercase tracking-wider text-white/70">
                    Working Hours
                </p>
                <p class="mt-2 text-white font-medium">
                    Mon – Fri, 09.00 – 17.00 WIB
                </p>
            </div>

            <!-- SOCIAL -->
            <div class="mt-8">
                <p class="text-sm uppercase tracking-wider text-white/70 mb-3">
                    Follow Us
                </p>
                <div class="flex gap-5 text-sm font-medium">
                    <a href="#" class="hover:opacity-80">Instagram</a>
                    <a href="#" class="hover:opacity-80">Twitter</a>
                    <a href="#" class="hover:opacity-80">LinkedIn</a>
                </div>
            </div>
        </div>

    </div>
</section>


    {{-- FOOTER SAMA KAYAK PAGE LAIN --}}
    @include('layouts.footer')


</body>
</html>
