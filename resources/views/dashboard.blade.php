<x-modern-layout title="Layout Demo">
    <div class="card">
        <div class="card-body">
{{--            <h5 class="card-title fw-semibold mb-4">Selamat Datang Modern Layout!</h5>--}}
{{--            <p class="card-text">--}}
{{--                Soo selamat datang ke zaman modern design. Kat belah kiri ada button untuk pergi ke--}}
{{--                original template so korang boleh tengok camna diorang kat sana guna template asalnya.--}}
{{--            </p>--}}
{{--            <p class="card-text">--}}
{{--                Korang boleh gak tengok file ni kat <span class="font-monospace">resources/views/modern.blade.php</span>--}}
{{--                untuk tengok camna nak guna layout modern dan baru ni!--}}
{{--            </p>--}}
{{--            <p class="card-text">--}}
{{--                Korang juga dialu-alukan untuk tengok kat dalam file <span class="font-monospace">modern-layout.blade.php</span>--}}
{{--                kat dalam folder components dalam folder view dalam folder resources untuk bende cam header ngan side bar tu.--}}
{{--            </p>--}}
{{--            <p class="card-text mb-0">--}}
{{--                <span class="fw-bold">PS/TIP:</span> Semua bende dalam template ni, specifically yang dalam body,--}}
{{--                semua guna card component dari bootstrap. kalau korang tengok dalam dashboard nyer page dalam template,--}}
{{--                ada banyak card and semua tersusun guna bootstrap punya GRID System.--}}
{{--                <a href="https://getbootstrap.com/docs/5.3/components/card/" target="_blank">Documentation--}}
{{--                Bootstrap.</a> <span class="fw-bold">DAN ALSO,</span> korang probably nak tengok camana template--}}
{{--                guna <span class="font-monospace">&lt;table&gt;</span> dalam page Dashboard tu.--}}
{{--            </p>--}}
            <h5 class="card-title fw-semibold fs-8 mb-4">Welcome to The Platinum Orbits, {{ in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP')) ? Auth::user()->platinum->plat_name : Auth::user()->userProfile->profile_name }}</h5>
            <p class="card-text fs-6">
                Unlocking Knowledge: A Journey of Discovery
            </p>
            <p class="card-text fs-4">
                “Embrace the challenges, persist through setbacks, and let curiosity guide your path. Remember, every step forward brings you closer to understanding the world.” 📚✨
            </p>
            <p class="card-text fs-6">
                “In the middle of difficulty lies opportunity.” -<strong>Albert Einstein</strong>
            </p>
            <p class="card-text fs-4">
                Even during challenging times, there’s potential for growth and advancement. View obstacles as chances to learn and innovate! 💪🌈
            </p>
        </div>
    </div>
</x-modern-layout>
