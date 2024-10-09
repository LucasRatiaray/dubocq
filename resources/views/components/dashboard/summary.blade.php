{{--summary.blade.php--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="flex mt-1 bg-gray-50">
        <!-- Sidebar -->
        <aside class="min-h-screen w-72 text-white">
            <!-- Menu -->
            <nav class="sticky top-0 my-6 pl-4 py-10">
                <ul>
                    <li class="mb-2">
                        <x-side-link href="{{ route('dashboard.show') }}" :active="request()->routeIs('dashboard.show')"
                                     class="flex">
                            <svg
                                class="{{ request()->routeIs('dashboard.show') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                                <path
                                    d="M261.56,101.28a8,8,0,0,0-11.06,0L66.4,277.15a8,8,0,0,0-2.47,5.79L63.9,448a32,32,0,0,0,32,32H192a16,16,0,0,0,16-16V328a8,8,0,0,1,8-8h80a8,8,0,0,1,8,8l0,136a16,16,0,0,0,16,16h96.06a32,32,0,0,0,32-32l0-165.06a8,8,0,0,0-2.47-5.79Z"></path>
                                <path
                                    d="M490.91,244.15l-74.8-71.56,0-108.59a16,16,0,0,0-16-16h-48a16,16,0,0,0-16,16l0,32L278.19,40.62C272.77,35.14,264.71,32,256,32h0c-8.68,0-16.72,3.14-22.14,8.63L21.16,244.13c-6.22,6-7,15.87-1.34,22.37A16,16,0,0,0,43,267.56L250.5,69.28a8,8,0,0,1,11.06,0L469.08,267.56a16,16,0,0,0,22.59-.44C497.81,260.76,497.3,250.26,490.91,244.15Z"></path>
                            </svg>
                            Tableau de bord
                        </x-side-link>
                    </li>
                    @if(auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Conducteur'))
                        <li class="mb-2">
                            <x-side-link href="{{ route('dashboard.showProject') }}"
                                         :active="request()->routeIs('dashboard.showProject')" class="flex">
                                <svg
                                    class="{{ request()->routeIs('dashboard.showProject') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M4.606 12.97a.75.75 0 0 1-.134 1.051 2.494 2.494 0 0 0-.93 2.437 2.494 2.494 0 0 0 2.437-.93.75.75 0 1 1 1.186.918 3.995 3.995 0 0 1-4.482 1.332.75.75 0 0 1-.461-.461 3.994 3.994 0 0 1 1.332-4.482.75.75 0 0 1 1.052.134Z"
                                          clip-rule="evenodd"></path>
                                    <path fill-rule="evenodd"
                                          d="M5.752 12A13.07 13.07 0 0 0 8 14.248v4.002c0 .414.336.75.75.75a5 5 0 0 0 4.797-6.414 12.984 12.984 0 0 0 5.45-10.848.75.75 0 0 0-.735-.735 12.984 12.984 0 0 0-10.849 5.45A5 5 0 0 0 1 11.25c.001.414.337.75.751.75h4.002ZM13 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                Par Chantier
                            </x-side-link>
                        </li>
                    @endif
                    @if(auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Super Admin'))
                        <li class="mb-2">
                            <x-side-link href="{{ route('dashboard.showEmployee') }}"
                                         :active="request()->routeIs('dashboard.showEmployee')" class="flex">
                                <svg
                                    class="{{ request()->routeIs('dashboard.showEmployee') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                          d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                Par Salarié
                            </x-side-link>
                        </li>
                        <li class="mb-2">
                            <x-side-link href="{{ route('dashboard.showSummary') }}" :active="request()->routeIs('dashboard.showSummary')"
                                         class="flex">
                                <svg
                                    class="{{ request()->routeIs('dashboard.showSummary') ? 'h-6 w-6 text-customColor' : 'h-6 w-6 text-gray-400' }} mr-3"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M2.25 2.25a.75.75 0 0 0 0 1.5H3v10.5a3 3 0 0 0 3 3h1.21l-1.172 3.513a.75.75 0 0 0 1.424.474l.329-.987h8.418l.33.987a.75.75 0 0 0 1.422-.474l-1.17-3.513H18a3 3 0 0 0 3-3V3.75h.75a.75.75 0 0 0 0-1.5H2.25Zm6.54 15h6.42l.5 1.5H8.29l.5-1.5Zm8.085-8.995a.75.75 0 1 0-.75-1.299 12.81 12.81 0 0 0-3.558 3.05L11.03 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 1 0 1.06 1.06l2.47-2.47 1.617 1.618a.75.75 0 0 0 1.146-.102 11.312 11.312 0 0 1 3.612-3.321Z" clip-rule="evenodd"></path>
                                </svg>
                                Récapitulatif
                            </x-side-link>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 pt-4">
            <div class="flex gap-2 flex-col mb-2">
                <!-- Formulaire de Filtrage par Statut des Employés -->
                <form class="flex items-center gap-5" action="{{ route('dashboard.showProject') }}" method="GET">
                    @csrf

                </form>
                <!-- Navigation du mois -->
                <nav>
                    <ul class="inline-flex -space-x-px text">
                        <!-- Bouton mois précédent -->
                        <li>
                            <button type="button" id="prev-month-btn" class="group flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-customColor hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white group-hover:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                                </svg>
                            </button>
                        </li>

                        <!-- Mois et année -->
                        <li>
                            <span id="month-year" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-900 font-bold text-sm bg-white border border-gray-300 hover:cursor-default dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                  style="width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; text-align: center;">
                            </span>
                        </li>

                        <!-- Bouton mois suivant -->
                        <li>
                            <button type="button" id="next-month-btn" class="group flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-customColor hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-4 h-4 text-gray-900 dark:text-white group-hover:text-white transition-transform duration-100 ease-in-out" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Conteneur du tableau -->
            <div id="project-table-container" class="bg-white p-6 rounded-lg shadow-md col-span-2" hidden>
                <h3 class="text-xl font-semibold mb-4 flex justify-between">
                    <span>Tableau coût et heure :</span>
                    <span id="selected-project-name"></span>
                    <span id="selected-project-type" class="px-1 font-medium rounded"></span>
                </h3>
                <!-- Table HTML du projet avec ligne total -->
                <table id="project" class="min-w-full bg-white text-sm">
                    <thead>
                    <tr class="w-full">
                        <th class="py-1 px-2 text-left">Salariés</th>
                        <th class="py-1 px-2 text-left">Heures pour le mois</th>
                        <th class="py-1 px-2 text-left">Coûts pour le mois (€)</th>
                        <th class="py-1 px-2 text-left">Heures depuis le début</th>
                        <th class="py-1 px-2 text-left">Coût depuis le début (€)</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="font-bold border-t border-stroke">
                        <td class="py-1 px-2 text-left">Total</td>
                        <td class="py-1 px-2 text-left" id="total-monthly-hours">-</td>
                        <td class="py-1 px-2 text-left" id="total-monthly-cost">-</td>
                        <td class="py-1 px-2 text-left" id="total-hours">-</td>
                        <td class="py-1 px-2 text-left" id="total-cost">-</td>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </main>
    </div>

    <!-- Inclure jQuery et DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script></script>

</x-app-layout>
