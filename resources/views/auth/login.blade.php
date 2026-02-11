<x-guest-layout>
<div class="min-h-screen flex bg-slate-100">

    <!-- LEFT SIDE (BRANDING / ILUSTRASI) -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-teal-500 to-emerald-600 items-center justify-center relative">

        <!-- Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute w-72 h-72 bg-white rounded-full -top-10 -left-10"></div>
            <div class="absolute w-72 h-72 bg-white rounded-full bottom-0 right-0"></div>
        </div>

        <div class="text-center text-white px-10 relative z-10">
            <h1 class="text-5xl font-extrabold mb-4 tracking-wide">
                INVENTARIS ALAT
            </h1>

            <p class="text-lg opacity-90 mb-6">
                Sistem Peminjaman & Pengembalian  
                Alat Sarana Prasarana Sekolah
            </p>

            <div class="bg-white/20 backdrop-blur-md px-6 py-4 rounded-2xl shadow-xl">
                <p class="text-sm">
                    Kelola alat • Pinjam • Kembalikan • Monitoring
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE (FORM LOGIN) -->
    <div class="flex w-full lg:w-1/2 items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">

            <!-- Logo / Title -->
            <div class="text-center mb-10">
                <h2 class="text-4xl font-extrabold text-gray-800">
                    Login
                </h2>
                <p class="text-gray-500 mt-2">
                    Masuk untuk mengakses sistem
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm font-semibold text-gray-700">
                        Email
                    </label>

                    <input id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                        class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition"
                        placeholder="Masukkan email">

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm font-semibold text-gray-700">
                        Password
                    </label>

                    <input id="password"
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition"
                        placeholder="Masukkan password">

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-teal-600 hover:underline"
                           href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- BUTTON LOGIN -->
                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                    Masuk
                </button>
            </form>

            <!-- REGISTER -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="text-teal-600 font-semibold hover:underline">
                   Daftar sekarang
                </a>
            </p>

        </div>
    </div>

</div>
</x-guest-layout>
