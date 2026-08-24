<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kedaiku | PW</title>

    <link rel="icon" type="image/png" href="/assets/svg/cursor.svg">
    <link rel="stylesheet" href="http://localhost:5174/resources/css/app.css">
    <link href="https://cdn.boxicons.com/3.0.7/fonts/basic/boxicons.min.css" rel="stylesheet">

    <script type="module" src="http://localhost:5174/resources/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
</head>

<body>

    <section id="Login">

        <div
            x-data="{
                showPassword: false
            }"
            class="h-screen bg-white dark:bg-slate-950 flex items-center justify-center p-5"
        >

            <div class="w-full max-w-xl">

                <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-6 md:p-8">

                    <div class="flex flex-col items-center text-center mb-8">

                        <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center mb-5">

                            <i class="bx bxs-store-alt text-3xl text-white"></i>

                        </div>

                        <h1 class="text-2xl font-black text-slate-900 dark:text-white">

                            Kedai<span class="text-primary">Ku</span>

                        </h1>

                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">

                            Sistem Manajemen Cafe

                        </p>

                    </div>

                    <div class="mb-7">

                        <h2 class="text-xl font-black text-slate-900 dark:text-white">

                            Selamat Datang 👋

                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mt-1">

                            Silakan masuk untuk melanjutkan.

                        </p>

                    </div>

                    <form action="" method="POST">

                        <div class="flex flex-col gap-5">

                            <div>

                                <label
                                    for="username"
                                    class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                >

                                    Username

                                </label>

                                <div class="relative mt-1.5">

                                    <i class="bx bxs-user absolute left-4 top-1/2 -translate-y-1/2 text-xl text-primary"></i>

                                    <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        placeholder="Masukkan username"
                                        autocomplete="username"
                                        class="w-full pl-12 pr-4 py-3.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                    >

                                </div>

                            </div>

                            <div>

                                <div class="flex items-center justify-between">

                                    <label
                                        for="password"
                                        class="text-xs font-black uppercase tracking-wide text-gray-600 dark:text-gray-400 ml-1"
                                    >

                                        Password

                                    </label>

                                    <a
                                        href="#"
                                        class="text-xs font-bold text-primary hover:text-blue-700 transition"
                                    >

                                        Lupa password?

                                    </a>

                                </div>

                                <div class="relative mt-1.5">

                                    <i class="bx bxs-lock absolute left-4 top-1/2 -translate-y-1/2 text-xl text-primary"></i>

                                    <input
                                        :type="showPassword ? 'text' : 'password'"
                                        id="password"
                                        name="password"
                                        placeholder="Masukkan password"
                                        autocomplete="current-password"
                                        class="w-full pl-12 pr-12 py-3.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm font-medium rounded-xl border border-gray-200 dark:border-slate-700 focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                    >

                                    <button
                                        type="button"
                                        @click="showPassword = !showPassword"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition"
                                    >

                                        <i
                                            class="bx text-xl"
                                            :class="showPassword ? 'bxs-show' : 'bxs-hide'"
                                        ></i>

                                    </button>

                                </div>

                            </div>

                            <div class="flex items-center justify-between">

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="checkbox"
                                        name="remember"
                                        class="w-4 h-4 accent-primary cursor-pointer"
                                    >

                                    <span class="text-sm font-bold text-slate-600 dark:text-slate-300">

                                        Ingat saya

                                    </span>

                                </label>

                            </div>

                            <button
                                type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-primary text-white font-black px-5 py-3.5 rounded-xl cursor-pointer hover:bg-blue-700 active:scale-[0.98] transition-all duration-200"
                            >

                                <i class="bx bxs-log-in text-xl"></i>

                                <span>

                                    Masuk

                                </span>

                            </button>

                        </div>

                    </form>

                    <div class="mt-7 pt-5 border-t border-gray-200 dark:border-slate-800 text-center">

                        <p class="text-xs text-gray-400 dark:text-gray-500 font-medium">

                            © 2026 KedaiKu · Sistem Manajemen Cafe

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

</body>

</html>