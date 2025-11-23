<nav class="bg-slate-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 font-bold text-xl tracking-wide text-teal-400">
                    <i class="fas fa-cubes mr-2"></i> SKILL HUB
                </div>         
                <div class="hidden md:flex ml-10 space-x-8">                    
                    <a href="/participants"
                       class="px-1 py-4 text-sm font-medium transition border-b-2 
                       {{ request()->is('participants*') ? 'border-teal-400 text-white' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500' }}">
                        Participants
                    </a>
                    <a href="/courses" 
                       class="px-1 py-4 text-sm font-medium transition border-b-2 
                       {{ request()->is('courses*') ? 'border-teal-400 text-white' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500' }}">
                        Courses
                    </a>    
                </div>
            </div>
            {{-- 
            <div class="flex items-center">
                <div class="h-8 w-8 rounded bg-teal-500 flex items-center justify-center text-xs font-bold text-white">
                    AD
                </div> 
            </div> 
            --}}
        </div>
    </div>
</nav>