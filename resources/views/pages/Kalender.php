<!-- =========================
     CALENDAR
========================= -->
<section
    x-data="calendarPage()"
    x-init="
        $watch('showAddEvent', value => {
            document.body.classList.toggle('overflow-hidden', value)
        })
        $watch('selectedEvent', value => {
            document.body.classList.toggle('overflow-hidden', !!value)
        })
    "
    class="w-full min-w-0"
>

<section
    id="Calendar"
    x-data="calendarPage()"
    x-init="
        $watch('showAddEvent', value => {
            document.body.classList.toggle('overflow-hidden', value)
        })

        $watch('selectedEvent', value => {
            document.body.classList.toggle('overflow-hidden', !!value)
        })
    "
    class="w-full min-w-0"
>

    <div class="w-full">

        <!-- =========================
             PAGE HEADER
        ========================== -->
        <div class="flex flex-col md:flex-row justify-between">

            <!-- LEFT -->
            <div class="flex items-center gap-4 min-w-0">

                <div
                    class="hidden w-13 h-13 rounded-2xl bg-primary
                           border border-indigo-100/80 lg:flex
                           items-center justify-center shrink-0 shadow-sm"
                >
                    <i class="bx bx-calendar text-2xl text-white"></i>
                </div>

                <div class="min-w-0">

                    <div class="flex items-center gap-3 flex-wrap">
                        <h1 class="text-black dark:text-white font-black text-2xl">
                            Kalender
                        </h1>
                    </div>

                    <p class="text-sm text-gray-500 font-medium mt-1">
                        Kelola dan pantau jadwal serta acara kedai Anda.
                    </p>

                </div>
            </div>


            <!-- RIGHT ACTION -->
            <div class="hidden md:flex flex-row gap-x-3 mt-5">

                <!-- HARI INI -->
                <button
                    type="button"
                    @click="goToday()"
                    class="flex items-center justify-center gap-2
                           bg-white border-2 border-gray-200
                           text-slate-700 font-bold
                           px-6 py-3 rounded-xl
                           hover:border-primary hover:text-primary
                           transition-all"
                >
                    <i class="bx bx-calendar-check text-lg"></i>
                    Hari Ini
                </button>

                <!-- TAMBAH ACARA -->
                <button
                    type="button"
                    @click="openAddEvent()"
                    class="flex items-center justify-center gap-2
                           bg-primary text-white font-bold
                           px-6 py-3 rounded-xl
                           hover:bg-blue-700 transition-all"
                >
                    <i class="bx bx-plus text-lg"></i>
                    Tambah Acara
                </button>

            </div>

        </div>


        <!-- =========================
             CALENDAR
        ========================== -->
        <div class="my-8">

            <div
                class="w-full bg-white rounded-2xl
                       shadow-sm overflow-hidden
                       relative transition-all duration-200"
            >

                <!-- =========================
                     CALENDAR NAVIGATION
                ========================== -->
                <div class="px-7 py-5 md:px-8 border-b border-slate-200">

                    <div class="flex items-center gap-2">

                        <!-- PREVIOUS -->
                        <button
                            type="button"
                            @click="previousMonth()"
                            class="w-10 h-10 flex items-center justify-center
                                   rounded-xl border border-slate-200
                                   bg-white text-slate-700
                                   hover:bg-slate-50
                                   active:scale-95 transition"
                        >
                            <i class="bx bx-chevron-left text-xl"></i>
                        </button>

                        <!-- NEXT -->
                        <button
                            type="button"
                            @click="nextMonth()"
                            class="w-10 h-10 flex items-center justify-center
                                   rounded-xl border border-slate-200
                                   bg-white text-slate-700
                                   hover:bg-slate-50
                                   active:scale-95 transition"
                        >
                            <i class="bx bx-chevron-right text-xl"></i>
                        </button>

                        <!-- MONTH -->
                        <h2
                            class="text-xl sm:text-2xl font-black
                                   text-slate-900 ml-2"
                            x-text="monthName + ' ' + currentYear"
                        ></h2>

                    </div>

                </div>


                <!-- =========================
                     CALENDAR GRID
                ========================== -->
                <div class="overflow-x-auto">

                    <div class="min-w-[760px]">

                        <!-- DAY HEADER -->
                        <div class="grid grid-cols-7 border-b border-slate-200">

                            <template
                                x-for="day in days"
                                :key="day"
                            >
                                <div
                                    class="h-12 flex items-center justify-center
                                           text-xs sm:text-sm font-semibold
                                           text-slate-500"
                                    x-text="day"
                                ></div>
                            </template>

                        </div>


                        <!-- CALENDAR DAYS -->
                        <div class="grid grid-cols-7">

                            <template
                                x-for="(day, index) in calendarDays"
                                :key="index"
                            >

                                <div
                                    class="relative min-h-[125px] sm:min-h-[145px]
                                           border-b border-r border-slate-200
                                           p-3 transition-colors
                                           hover:bg-slate-50"
                                >

                                    <!-- DATE -->
                                    <div class="flex items-center justify-between">

                                        <span
                                            class="flex items-center justify-center
                                                   w-7 h-7 rounded-full
                                                   text-sm font-semibold"
                                            :class="{
                                                'bg-primary text-white font-black':
                                                    day.isToday,

                                                'text-slate-900':
                                                    !day.isToday && day.currentMonth,

                                                'text-slate-400':
                                                    !day.isToday && !day.currentMonth
                                            }"
                                            x-text="day.date"
                                        ></span>

                                    </div>


                                    <!-- EVENTS -->
                                    <div class="mt-2 space-y-1">

                                        <template
                                            x-for="event in getEvents(day.fullDate)"
                                            :key="event.id"
                                        >

                                            <button
                                                type="button"
                                                @click="showEvent(event)"
                                                class="w-full text-left px-2 py-1
                                                       rounded-md text-xs font-semibold
                                                       truncate transition-all
                                                       hover:brightness-95
                                                       active:scale-[0.98]"
                                                :class="{
                                                    'bg-primary text-white':
                                                        event.color === 'blue',

                                                    'bg-emerald-100 text-emerald-700':
                                                        event.color === 'green',

                                                    'bg-amber-100 text-amber-700':
                                                        event.color === 'yellow',

                                                    'bg-red-100 text-red-600':
                                                        event.color === 'red'
                                                }"
                                                :title="event.title"
                                                x-text="event.title"
                                            ></button>

                                        </template>

                                    </div>

                                </div>

                            </template>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             EVENT DETAIL MODAL
        ========================== -->
        <div
            x-show="selectedEvent"
            x-cloak
            @keydown.escape.window="selectedEvent = null"
            class="fixed inset-0 z-[999]
                   flex items-center justify-center p-4"
        >

            <!-- OVERLAY -->
            <div
                class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
                @click="selectedEvent = null"
            ></div>

            <!-- MODAL -->
            <div
                x-show="selectedEvent"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                class="relative z-10 w-full max-w-md
                       bg-white rounded-2xl
                       border border-slate-200
                       shadow-xl p-5 sm:p-6"
            >

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-primary text-white
                                   flex items-center justify-center
                                   shrink-0"
                        >
                            <i class="bx bx-calendar-event text-xl"></i>
                        </div>

                        <div>

                            <h3
                                class="text-lg font-black text-slate-900"
                                x-text="selectedEvent?.title"
                            ></h3>

                            <p
                                class="text-xs text-slate-400 mt-0.5"
                                x-text="selectedEvent?.date"
                            ></p>

                        </div>

                    </div>

                    <button
                        type="button"
                        @click="selectedEvent = null"
                        class="w-9 h-9 rounded-full
                               bg-slate-100 text-slate-500
                               hover:bg-primary hover:text-white
                               flex items-center justify-center
                               transition"
                    >
                        <i class="bx bx-x text-lg"></i>
                    </button>

                </div>


                <div class="mt-5">

                    <p
                        class="text-sm text-slate-600 leading-relaxed"
                        x-text="selectedEvent?.description"
                    ></p>

                </div>


                <div class="mt-6 flex justify-end">

                    <button
                        type="button"
                        @click="selectedEvent = null"
                        class="px-5 py-2.5 rounded-xl
                               bg-primary text-white
                               text-sm font-bold
                               hover:bg-blue-700
                               active:scale-95 transition"
                    >
                        Tutup
                    </button>

                </div>

            </div>

        </div>


        <!-- =========================
             TAMBAH ACARA MODAL
        ========================== -->
        <div
            x-show="showAddEvent"
            x-cloak
            @keydown.escape.window="showAddEvent = false"
            class="fixed inset-0 z-[999]
                   flex items-center justify-center
                   p-4 overflow-y-auto"
        >

            <!-- OVERLAY -->
            <div
                x-show="showAddEvent"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
                @click="showAddEvent = false"
            ></div>


            <!-- MODAL -->
            <div
                x-show="showAddEvent"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                class="relative z-10 w-full max-w-xl my-auto"
            >

                <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-5 md:p-7">

                    <!-- HEADER MODAL -->
                    <div class="flex items-start justify-between gap-5 mb-7">

                        <div class="flex items-center gap-4">

                            <div
                                class="w-13 h-13 rounded-2xl
                                       bg-primary text-white
                                       flex items-center justify-center
                                       shrink-0 shadow-sm"
                            >
                                <i class="bx bx-calendar-plus text-2xl"></i>
                            </div>

                            <div>

                                <h2 class="text-xl md:text-2xl font-black text-slate-900">
                                    Tambah Acara
                                </h2>

                                <p class="text-sm text-slate-500 font-medium mt-1">
                                    Tambahkan acara baru ke kalender.
                                </p>

                            </div>

                        </div>

                        <button
                            type="button"
                            @click="showAddEvent = false"
                            class="w-10 h-10 rounded-full
                                   bg-slate-100 text-slate-500
                                   hover:bg-primary hover:text-white
                                   flex items-center justify-center
                                   transition shrink-0"
                        >
                            <i class="bx bx-x text-lg"></i>
                        </button>

                    </div>


                    <!-- FORM -->
                    <form
                        @submit.prevent="addEvent()"
                        class="space-y-5"
                    >

                        <!-- NAMA ACARA -->
                        <div class="space-y-2">

                            <label
                                class="block text-xs font-bold uppercase
                                       tracking-wider text-slate-500"
                            >
                                Nama Acara
                            </label>

                            <div class="relative group">

                                <i
                                    class="bx bx-calendar-event
                                           absolute left-3.5 top-1/2
                                           -translate-y-1/2
                                           text-slate-400 text-lg
                                           group-focus-within:text-primary"
                                ></i>

                                <input
                                    type="text"
                                    x-model="newEvent.title"
                                    placeholder="Contoh: Rapat Tim"
                                    required
                                    class="w-full h-11 pl-10 pr-4
                                           text-sm font-medium text-slate-700
                                           border border-slate-200
                                           rounded-xl
                                           focus:outline-none
                                           focus:border-primary
                                           focus:ring-1 focus:ring-primary
                                           transition"
                                >

                            </div>

                        </div>


                        <!-- TANGGAL -->
                        <div class="space-y-2">

                            <label
                                class="block text-xs font-bold uppercase
                                       tracking-wider text-slate-500"
                            >
                                Tanggal
                            </label>

                            <div class="relative group">

                                <i
                                    class="bx bx-calendar
                                           absolute left-3.5 top-1/2
                                           -translate-y-1/2
                                           text-slate-400 text-lg
                                           group-focus-within:text-primary"
                                ></i>

                                <input
                                    type="date"
                                    x-model="newEvent.date"
                                    required
                                    class="w-full h-11 pl-10 pr-4
                                           text-sm font-medium text-slate-700
                                           border border-slate-200
                                           rounded-xl
                                           focus:outline-none
                                           focus:border-primary
                                           focus:ring-1 focus:ring-primary
                                           transition cursor-pointer"
                                >

                            </div>

                        </div>


                        <!-- WARNA -->
                        <div class="space-y-2">

                            <label
                                class="block text-xs font-bold uppercase
                                       tracking-wider text-slate-500"
                            >
                                Warna Acara
                            </label>

                            <div class="relative group">

                                <i
                                    class="bx bx-palette
                                           absolute left-3.5 top-1/2
                                           -translate-y-1/2
                                           text-slate-400 text-lg
                                           group-focus-within:text-primary"
                                ></i>

                                <select
                                    x-model="newEvent.color"
                                    class="w-full h-11 pl-10 pr-8
                                           text-sm font-medium text-slate-700
                                           border border-slate-200
                                           rounded-xl
                                           focus:outline-none
                                           focus:border-primary
                                           focus:ring-1 focus:ring-primary
                                           appearance-none transition cursor-pointer"
                                >
                                    <option value="blue">Biru</option>
                                    <option value="green">Hijau</option>
                                    <option value="yellow">Kuning</option>
                                    <option value="red">Merah</option>
                                </select>

                                <i
                                    class="bx bx-chevron-down
                                           absolute right-3 top-1/2
                                           -translate-y-1/2
                                           text-slate-400
                                           pointer-events-none text-lg"
                                ></i>

                            </div>

                        </div>


                        <!-- DESKRIPSI -->
                        <div class="space-y-2">

                            <label
                                class="block text-xs font-bold uppercase
                                       tracking-wider text-slate-500"
                            >
                                Deskripsi
                            </label>

                            <div class="relative group">

                                <i
                                    class="bx bx-notepad
                                           absolute left-3.5 top-3.5
                                           text-slate-400 text-lg
                                           group-focus-within:text-primary"
                                ></i>

                                <textarea
                                    x-model="newEvent.description"
                                    rows="4"
                                    placeholder="Tambahkan deskripsi acara..."
                                    class="w-full pl-10 pr-4 py-3
                                           text-sm font-medium text-slate-700
                                           border border-slate-200
                                           rounded-xl resize-none
                                           focus:outline-none
                                           focus:border-primary
                                           focus:ring-1 focus:ring-primary
                                           transition"
                                ></textarea>

                            </div>

                        </div>


                        <!-- BUTTON -->
                        <div
                            class="flex flex-col-reverse sm:flex-row
                                   sm:justify-end gap-3 pt-2"
                        >

                            <button
                                type="button"
                                @click="showAddEvent = false"
                                class="h-11 px-5 rounded-xl
                                       border border-slate-200
                                       text-slate-600 text-sm font-bold
                                       hover:bg-slate-50 transition"
                            >
                                Batal
                            </button>

                            <button
                                type="submit"
                                class="h-11 px-6 rounded-xl
                                       bg-primary text-white
                                       text-sm font-bold
                                       hover:bg-blue-700
                                       active:scale-95 transition"
                            >
                                <i class="bx bx-plus mr-1"></i>
                                Tambah Acara
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

    <!-- =========================
         CALENDAR CARD
    ========================== -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    
        <!-- HEADER -->
        <div class="px-5 sm:px-6 py-5 border-b border-slate-200">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">

               

                <!-- RIGHT ACTION -->
                <div class="flex items-center gap-3">

                    <!-- HARI INI -->
                    <button
                        type="button"
                        @click="goToday()"
                        class="inline-flex items-center justify-center gap-2
                               h-10 px-4 rounded-xl
                               bg-white border border-slate-200
                               text-sm font-bold text-slate-700
                               hover:border-primary hover:text-primary
                               active:scale-95 transition"
                    >
                        <i class="bx bx-calendar-check text-lg"></i>
                        <span>Hari Ini</span>
                    </button>

                    <!-- TAMBAH ACARA -->
                    <button
                        type="button"
                        @click="openAddEvent()"
                        class="inline-flex items-center justify-center gap-2
                               h-10 px-5 rounded-xl
                               bg-primary text-white
                               text-sm font-bold
                               hover:bg-blue-700
                               active:scale-95 transition"
                    >
                        <i class="bx bx-plus text-lg"></i>
                        <span>Tambah Acara</span>
                    </button>

                </div>

            </div>

        </div>


        <!-- =========================
             CALENDAR
        ========================== -->
        <div class="overflow-x-auto">

            <div class="min-w-[760px]">

                <!-- DAY HEADER -->
                <div class="grid grid-cols-7 border-b border-slate-200">

                    <template x-for="day in days" :key="day">

                        <div
                            class="h-12 flex items-center justify-center
                                   text-xs sm:text-sm font-semibold
                                   text-slate-500"
                            x-text="day"
                        ></div>

                    </template>

                </div>


                <!-- CALENDAR GRID -->
                <div class="grid grid-cols-7">

                    <template
                        x-for="(day, index) in calendarDays"
                        :key="index"
                    >

                        <div
                            class="relative min-h-[125px] sm:min-h-[145px]
                                   border-b border-r border-slate-200
                                   p-3 transition-colors
                                   hover:bg-slate-50"
                        >

                            <!-- DATE -->
                            <div class="flex items-center justify-between">

                                <span
                                    class="flex items-center justify-center
                                           w-7 h-7 rounded-full
                                           text-sm font-semibold"
                                    :class="{
                                        'bg-primary text-white font-black':
                                            day.isToday,

                                        'text-slate-900':
                                            !day.isToday && day.currentMonth,

                                        'text-slate-400':
                                            !day.isToday && !day.currentMonth
                                    }"
                                    x-text="day.date"
                                ></span>

                            </div>


                            <!-- EVENTS -->
                            <div class="mt-2 space-y-1">

                                <template
                                    x-for="event in getEvents(day.fullDate)"
                                    :key="event.id"
                                >

                                    <button
                                        type="button"
                                        @click="showEvent(event)"
                                        class="w-full text-left px-2 py-1 rounded-md
                                               text-xs font-semibold
                                               truncate transition-all
                                               hover:brightness-95
                                               active:scale-[0.98]"
                                        :class="{
                                            'bg-primary text-white':
                                                event.color === 'blue',

                                            'bg-emerald-100 text-emerald-700':
                                                event.color === 'green',

                                            'bg-amber-100 text-amber-700':
                                                event.color === 'yellow',

                                            'bg-red-100 text-red-600':
                                                event.color === 'red'
                                        }"
                                        :title="event.title"
                                        x-text="event.title"
                                    ></button>

                                </template>

                            </div>

                        </div>

                    </template>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================
         EVENT DETAIL MODAL
    ========================== -->
    <div
        x-show="selectedEvent"
        x-cloak
        @keydown.escape.window="selectedEvent = null"
        class="fixed inset-0 z-[999]
               flex items-center justify-center
               p-4"
    >

        <!-- OVERLAY -->
        <div
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
            @click="selectedEvent = null"
        ></div>


        <!-- MODAL -->
        <div
            x-show="selectedEvent"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="relative z-10 w-full max-w-md
                   bg-white rounded-2xl
                   border border-slate-200
                   shadow-xl p-5 sm:p-6"
        >

            <!-- HEADER -->
            <div class="flex items-start justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="w-11 h-11 rounded-xl
                               bg-primary text-white
                               flex items-center justify-center
                               shrink-0"
                    >
                        <i class="bx bx-calendar-event text-xl"></i>
                    </div>

                    <div>

                        <h3
                            class="text-lg font-black text-slate-900"
                            x-text="selectedEvent?.title"
                        ></h3>

                        <p
                            class="text-xs text-slate-400 mt-0.5"
                            x-text="selectedEvent?.date"
                        ></p>

                    </div>

                </div>


                <button
                    type="button"
                    @click="selectedEvent = null"
                    class="w-9 h-9 rounded-full
                           bg-slate-100 text-slate-500
                           hover:bg-primary hover:text-white
                           flex items-center justify-center
                           transition"
                >
                    <i class="bx bx-x text-lg"></i>
                </button>

            </div>


            <!-- DESCRIPTION -->
            <div class="mt-5">

                <p
                    class="text-sm text-slate-600 leading-relaxed"
                    x-text="selectedEvent?.description"
                ></p>

            </div>


            <!-- ACTION -->
            <div class="mt-6 flex justify-end">

                <button
                    type="button"
                    @click="selectedEvent = null"
                    class="px-5 py-2.5 rounded-xl
                           bg-primary text-white
                           text-sm font-bold
                           hover:bg-blue-700
                           active:scale-95 transition"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>


    <!-- =========================
         TAMBAH ACARA MODAL
    ========================== -->
    <div
        x-show="showAddEvent"
        x-cloak
        @keydown.escape.window="showAddEvent = false"
        class="fixed inset-0 z-[999]
               flex items-center justify-center
               p-4 overflow-y-auto"
    >

        <!-- OVERLAY -->
        <div
            x-show="showAddEvent"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-[2px]"
            @click="showAddEvent = false"
        ></div>


        <!-- MODAL -->
        <div
            x-show="showAddEvent"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="relative z-10 w-full max-w-xl my-auto"
        >

            <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-5 md:p-7">

                <!-- HEADER -->
                <div class="flex items-start justify-between gap-5 mb-7">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-13 h-13 rounded-2xl
                                   bg-primary text-white
                                   flex items-center justify-center
                                   shrink-0 shadow-sm"
                        >
                            <i class="bx bx-calendar-plus text-2xl"></i>
                        </div>

                        <div>

                            <h2 class="text-xl md:text-2xl font-black text-slate-900">
                                Tambah Acara
                            </h2>

                            <p class="text-sm text-slate-500 font-medium mt-1">
                                Tambahkan acara baru ke kalender.
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        @click="showAddEvent = false"
                        class="w-10 h-10 rounded-full
                               bg-slate-100 text-slate-500
                               hover:bg-primary hover:text-white
                               flex items-center justify-center
                               transition shrink-0"
                    >
                        <i class="bx bx-x text-lg"></i>
                    </button>

                </div>


                <!-- FORM -->
                <form @submit.prevent="addEvent()" class="space-y-5">

                    <!-- JUDUL -->
                    <div class="space-y-2">

                        <label
                            class="block text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Nama Acara
                        </label>

                        <div class="relative group">

                            <i
                                class="bx bx-calendar-event
                                       absolute left-3.5 top-1/2
                                       -translate-y-1/2
                                       text-slate-400 text-lg
                                       group-focus-within:text-primary"
                            ></i>

                            <input
                                type="text"
                                x-model="newEvent.title"
                                placeholder="Contoh: Rapat Tim"
                                required
                                class="w-full h-11 pl-10 pr-4
                                       text-sm font-medium text-slate-700
                                       border border-slate-200
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-primary
                                       focus:ring-1 focus:ring-primary
                                       transition"
                            >

                        </div>

                    </div>


                    <!-- TANGGAL -->
                    <div class="space-y-2">

                        <label
                            class="block text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Tanggal
                        </label>

                        <div class="relative group">

                            <i
                                class="bx bx-calendar
                                       absolute left-3.5 top-1/2
                                       -translate-y-1/2
                                       text-slate-400 text-lg
                                       group-focus-within:text-primary"
                            ></i>

                            <input
                                type="date"
                                x-model="newEvent.date"
                                required
                                class="w-full h-11 pl-10 pr-4
                                       text-sm font-medium text-slate-700
                                       border border-slate-200
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-primary
                                       focus:ring-1 focus:ring-primary
                                       transition cursor-pointer"
                            >

                        </div>

                    </div>


                    <!-- WARNA -->
                    <div class="space-y-2">

                        <label
                            class="block text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Warna Acara
                        </label>

                        <div class="relative group">

                            <i
                                class="bx bx-palette
                                       absolute left-3.5 top-1/2
                                       -translate-y-1/2
                                       text-slate-400 text-lg
                                       group-focus-within:text-primary"
                            ></i>

                            <select
                                x-model="newEvent.color"
                                class="w-full h-11 pl-10 pr-8
                                       text-sm font-medium text-slate-700
                                       border border-slate-200
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-primary
                                       focus:ring-1 focus:ring-primary
                                       appearance-none transition cursor-pointer"
                            >
                                <option value="blue">
                                    Biru
                                </option>

                                <option value="green">
                                    Hijau
                                </option>

                                <option value="yellow">
                                    Kuning
                                </option>

                                <option value="red">
                                    Merah
                                </option>
                            </select>

                            <i
                                class="bx bx-chevron-down
                                       absolute right-3 top-1/2
                                       -translate-y-1/2
                                       text-slate-400
                                       pointer-events-none text-lg"
                            ></i>

                        </div>

                    </div>


                    <!-- DESKRIPSI -->
                    <div class="space-y-2">

                        <label
                            class="block text-xs font-bold uppercase
                                   tracking-wider text-slate-500"
                        >
                            Deskripsi
                        </label>

                        <div class="relative group">

                            <i
                                class="bx bx-notepad
                                       absolute left-3.5 top-3.5
                                       text-slate-400 text-lg
                                       group-focus-within:text-primary"
                            ></i>

                            <textarea
                                x-model="newEvent.description"
                                rows="4"
                                placeholder="Tambahkan deskripsi acara..."
                                class="w-full pl-10 pr-4 py-3
                                       text-sm font-medium text-slate-700
                                       border border-slate-200
                                       rounded-xl resize-none
                                       focus:outline-none
                                       focus:border-primary
                                       focus:ring-1 focus:ring-primary
                                       transition"
                            ></textarea>

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <div class="flex flex-col-reverse sm:flex-row
                                sm:justify-end gap-3 pt-2">

                        <button
                            type="button"
                            @click="showAddEvent = false"
                            class="h-11 px-5 rounded-xl
                                   border border-slate-200
                                   text-slate-600
                                   text-sm font-bold
                                   hover:bg-slate-50
                                   transition"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="h-11 px-6 rounded-xl
                                   bg-primary text-white
                                   text-sm font-bold
                                   hover:bg-blue-700
                                   active:scale-95 transition"
                        >
                            <i class="bx bx-plus mr-1"></i>
                            Tambah Acara
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>


<script>

function calendarPage() {

    return {

        currentDate: new Date(2026, 1, 1),

        selectedEvent: null,

        showAddEvent: false,

        newEvent: {
            title: '',
            date: '',
            color: 'blue',
            description: ''
        },

        days: [
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat'
        ],

        events: [

            {
                id: 1,
                date: '2026-02-02',
                title: 'Team Standup',
                color: 'green',
                description: 'Agenda koordinasi tim dan pembaruan pekerjaan.'
            },

            {
                id: 2,
                date: '2026-02-04',
                title: 'Sprint Review',
                color: 'green',
                description: 'Review hasil pekerjaan dalam satu sprint.'
            },

            {
                id: 3,
                date: '2026-02-06',
                title: 'Client Call — Admin',
                color: 'yellow',
                description: 'Pertemuan bersama client untuk membahas kebutuhan proyek.'
            },

            {
                id: 4,
                date: '2026-02-06',
                title: 'Design Review',
                color: 'green',
                description: 'Review tampilan dan rancangan antarmuka.'
            },

            {
                id: 5,
                date: '2026-02-10',
                title: 'Product Launch',
                color: 'red',
                description: 'Agenda peluncuran produk baru.'
            },

            {
                id: 6,
                date: '2026-02-12',
                title: 'Lunch & Learn',
                color: 'green',
                description: 'Sesi berbagi pengetahuan bersama tim.'
            },

            {
                id: 7,
                date: '2026-02-13',
                title: 'Budget Meeting',
                color: 'yellow',
                description: 'Pembahasan anggaran dan kebutuhan operasional.'
            },

            {
                id: 8,
                date: '2026-02-14',
                title: '1:1 with Manager',
                color: 'green',
                description: 'Sesi diskusi pribadi bersama manager.'
            },

            {
                id: 9,
                date: '2026-02-17',
                title: 'Team Standup',
                color: 'green',
                description: 'Koordinasi rutin bersama tim.'
            },

            {
                id: 10,
                date: '2026-02-18',
                title: 'Sprint Planning',
                color: 'green',
                description: 'Perencanaan pekerjaan untuk sprint berikutnya.'
            },

            {
                id: 11,
                date: '2026-02-18',
                title: 'Stakeholder Discussion',
                color: 'yellow',
                description: 'Diskusi bersama stakeholder.'
            },

            {
                id: 12,
                date: '2026-02-20',
                title: 'Security Audit',
                color: 'red',
                description: 'Pemeriksaan keamanan sistem.'
            },

            {
                id: 13,
                date: '2026-02-22',
                title: 'UX Workshop',
                color: 'green',
                description: 'Workshop untuk membahas pengalaman pengguna.'
            },

            {
                id: 14,
                date: '2026-02-24',
                title: 'Client Call — Growth',
                color: 'yellow',
                description: 'Pembahasan perkembangan dan kebutuhan client.'
            },

            {
                id: 15,
                date: '2026-02-26',
                title: 'Code Freeze',
                color: 'red',
                description: 'Penghentian perubahan kode sebelum tahap rilis.'
            },

            {
                id: 16,
                date: '2026-02-27',
                title: 'Team Retrospective',
                color: 'green',
                description: 'Evaluasi pekerjaan dan proses tim.'
            },

            {
                id: 17,
                date: '2026-03-02',
                title: 'Q1 Review',
                color: 'green',
                description: 'Review pencapaian kuartal pertama.'
            },

            {
                id: 18,
                date: '2026-03-05',
                title: 'Conference Training',
                color: 'yellow',
                description: 'Pelatihan dan persiapan conference.'
            }

        ],


        get currentYear() {
            return this.currentDate.getFullYear();
        },


        get currentMonth() {
            return this.currentDate.getMonth();
        },


        get monthName() {

            return this.currentDate.toLocaleString('id-ID', {
                month: 'long'
            });

        },


        get calendarDays() {

            const year = this.currentYear;
            const month = this.currentMonth;

            const firstDay = new Date(year, month, 1);

            const startDay = firstDay.getDay();

            const daysInMonth = new Date(
                year,
                month + 1,
                0
            ).getDate();

            const daysInPreviousMonth = new Date(
                year,
                month,
                0
            ).getDate();

            const result = [];


            // Previous month
            for (let i = startDay - 1; i >= 0; i--) {

                const date = daysInPreviousMonth - i;

                const fullDate = this.formatDate(
                    new Date(year, month - 1, date)
                );

                result.push({
                    date: date,
                    fullDate: fullDate,
                    currentMonth: false,
                    isToday: false
                });

            }


            // Current month
            for (
                let date = 1;
                date <= daysInMonth;
                date++
            ) {

                const current = new Date(
                    year,
                    month,
                    date
                );

                result.push({

                    date: date,

                    fullDate: this.formatDate(current),

                    currentMonth: true,

                    isToday: this.isToday(current)

                });

            }


            // Next month
            let nextDate = 1;

            while (result.length < 42) {

                const current = new Date(
                    year,
                    month + 1,
                    nextDate
                );

                result.push({

                    date: nextDate,

                    fullDate: this.formatDate(current),

                    currentMonth: false,

                    isToday: false

                });

                nextDate++;

            }

            return result;

        },


        formatDate(date) {

            const year = date.getFullYear();

            const month = String(
                date.getMonth() + 1
            ).padStart(2, '0');

            const day = String(
                date.getDate()
            ).padStart(2, '0');

            return `${year}-${month}-${day}`;

        },


        isToday(date) {

            const today = new Date();

            return (

                date.getFullYear() === today.getFullYear() &&

                date.getMonth() === today.getMonth() &&

                date.getDate() === today.getDate()

            );

        },


        getEvents(date) {

            return this.events.filter(
                event => event.date === date
            );

        },


        previousMonth() {

            this.currentDate = new Date(
                this.currentYear,
                this.currentMonth - 1,
                1
            );

        },


        nextMonth() {

            this.currentDate = new Date(
                this.currentYear,
                this.currentMonth + 1,
                1
            );

        },


        goToday() {

            const today = new Date();

            this.currentDate = new Date(
                today.getFullYear(),
                today.getMonth(),
                1
            );

        },


        showEvent(event) {

            this.selectedEvent = {

                ...event,

                date: this.formatReadableDate(event.date)

            };

        },


        openAddEvent() {

            this.newEvent = {

                title: '',

                date: this.formatDate(
                    new Date(
                        this.currentYear,
                        this.currentMonth,
                        new Date().getDate()
                    )
                ),

                color: 'blue',

                description: ''

            };

            this.showAddEvent = true;

        },


        addEvent() {

            if (
                !this.newEvent.title ||
                !this.newEvent.date
            ) {
                return;
            }


            this.events.push({

                id: Date.now(),

                date: this.newEvent.date,

                title: this.newEvent.title,

                color: this.newEvent.color,

                description:
                    this.newEvent.description ||
                    'Tidak ada deskripsi acara.'

            });


            // Pindahkan kalender ke bulan acara
            const eventDate = new Date(
                this.newEvent.date + 'T00:00:00'
            );

            this.currentDate = new Date(
                eventDate.getFullYear(),
                eventDate.getMonth(),
                1
            );


            // Reset form
            this.newEvent = {

                title: '',

                date: '',

                color: 'blue',

                description: ''

            };


            this.showAddEvent = false;

        },


        formatReadableDate(date) {

            const [year, month, day] =
                date.split('-');

            const current = new Date(
                year,
                Number(month) - 1,
                day
            );

            return current.toLocaleDateString(
                'id-ID',
                {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }
            );

        }

    };

}

</script>