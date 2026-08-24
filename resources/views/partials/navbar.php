<nav class="sticky top-0 left-0 min-w-full h-fit bg-white sm:border-b border-gray-100 z-[999]">
    <div class="flex justify-between items-center px-4 sm:px-8 py-4">
        <div class="w-full flex lg:hidden justify-between items-center">
            <button type="button" @click="sidebarOpen = !sidebarOpen" id="IconSideBar" class="group flex justify-start items-center h-9 my-2 cursor-pointer translate-x-0 duration-[3s] transition-all ease-in-out">
                <div class="group-hover:hidden p-3 rounded-xl bg-primary flex items-center justify-center">
                    <i class="bx bxs-store text-xl text-white"></i>
                </div>
                <h1 class="flex lg:hidden font-black ml-3">
                    Caffe <span class="text-primary">PW</span>
                </h1>
            </button>
        </div>
         
       <button type="button" @click="sidebarOpen = !sidebarOpen" class="flex lg:hidden items-center justify-center p-2.5 rounded-xl bg-white text-slate-700 hover:text-primary active:scale-95 transition-all duration-200 focus:outline-none">
            <i class="bx text-2xl transition-transform duration-300" :class="sidebarOpen ? 'bx-x rotate-90' : 'bx-menu'"></i>
        </button>
        <div class="flex items-center">
            <div class="hidden lg:flex items-center space-x-4">
                <div class="flex flex-col text-left">
                    <span class="text-[10px] font-black text-primary uppercase tracking-widest leading-none">Super Admin</span>
                    <span class="text-base font-black text-slate-900 mt-1.5 leading-none">Achmad Riziq Al Azzim</span>
                </div>
            </div>
        </div>
        <div class="hidden sm:flex justify-end items-center gap-3">
            <div class="p-3 rounded-xl bg-primary flex items-center justify-center">
                <i class="bx bxs-store text-xl text-white"></i>
            </div>

            <div class="flex flex-col">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                    Outlet
                </span>
                <span class="text-sm font-black text-gray-900">
                    PW Caffe & Resto
                </span>
            </div>
        </div> 
    </div>
</nav>


