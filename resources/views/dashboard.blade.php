<x-modern-layout title="Dashboard">
    <div class="card">
        <div class="card-body">
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
