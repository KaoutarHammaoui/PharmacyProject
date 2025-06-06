{{-- resources/views/components/sidebar.blade.php --}}
<style>
    .backdrop-blur-custom {
        backdrop-filter: blur(10px);
    }
</style>
<aside class="sidebar text-white w-70 min-h-screen" style="width: 280px; background-image: url('/images/sidebar.jpg'); background-size: cover; background-position: center;">
<div class="sidebar-header mb-4 flex justify-center pt-3">
        <div class="w-full backdrop-blur-custom flex justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Pharmacylogo" width="150">
        </div>
    </div>

    <nav class="sidebar-nav p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                   <img src="{{ asset('images/dash-pic.svg') }}" alt="dashboard vector" class="w-4 h-4 mr-3.5">
                   Tableau de Bord
                </a>
            </li>                   


             <li x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2 rounded text-white bg-gray-800 hover:bg-gray-700 focus:outline-none {{ request()->routeIs('medsInfos.*') ? 'bg-lime-900' : '' }}">
                    <span class="flex items-center">
                        <img src="{{ asset('images/inv-pic.svg') }}" alt="contacts vector" class="w-4 h-4 mr-3.5">
                        Gestion d'inventaire
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200"
                         :class="{ 'rotate-180': open }"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-4" 
                     style="display: none;" 
                     >
                    <ul class="space-y-1">
                        <li>
                        <a href="{{ route('medsInfos') }}"
                               class="flex items-center w-full px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 ">
                                Medicaments
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('medsShortage') }}" 
                               class="flex items-center w-full px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 ">
                               Pénurie
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2 rounded text-white bg-gray-800 hover:bg-gray-700 focus:outline-none">
                    <span class="flex items-center">
                        <img src="{{ asset('images/cont-pic.svg') }}" alt="contacts vector" class="w-4 h-4 mr-3.5">
                        Gestion des contacts
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-200"
                         :class="{ 'rotate-180': open }"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-4" 
                     style="display: none;" 
                     >
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('usersInfos') }}"
                               class="flex items-center w-full px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-lime-800 text-white font-semibold' : '' }}">
                                Utilisateurs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('suppliersinfos') }} " 
                               class="flex items-center w-full px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('suppliers.*') ? 'bg-lime-800 text-white font-semibold' : '' }}">
                                Fournisseurs
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{ route('reports') }}"
                   class="flex items-center px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('salesReport', 'reports') ? 'bg-lime-900' : '' }}"> {{-- Adjusted routeIs to include reports too --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z"></path>
                    </svg>
                    Rapports de ventes
                </a>
            </li>
             <li>
                <a href="{{ route('backUp') }}"
                   class="flex items-center px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('backUp') ? 'bg-lime-900' : '' }}">
                   <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    Récupération des utilisateurs
                </a>
            </li>
            <li>
                <a href="{{ route('settings') }}"
                   class="flex items-center px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 {{ request()->routeIs('settings') ? 'bg-lime-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Paramètres utilisateur
                </a>
            </li>
        </ul>

        <div class="mt-8 pt-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logOut') }}">
                @csrf
                <button type="submit" class="flex items-center px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 text-red-400 hover:text-red-300 w-full text-left">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>