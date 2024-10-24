<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Accueil') }}
        </h2>
    </x-slot>

{{--    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-customGrayLight overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-2">
                    {{ __("Bonjour :name !", ['name' => Auth::user()->firstname]) }}
                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M17.924 17.315c-.057.174-.193.367-.416.432-.161.047-5.488 1.59-5.652 1.633-.469.125-.795.033-1.009-.156-.326-.287-4.093-2.85-8.845-3.092-.508-.025-.259-1.951 1.193-1.951.995 0 3.904.723 4.255.371.271-.272.394-1.879-.737-4.683L4.438 4.232a1.045 1.045 0 0 1 1.937-.781L8.361 8.37c.193.48.431.662.69.562.231-.088.279-.242.139-.709L7.144 2.195A1.043 1.043 0 0 1 7.796.871a1.042 1.042 0 0 1 1.325.652l1.946 5.732c.172.504.354.768.642.646.173-.073.161-.338.115-.569l-1.366-5.471a1.045 1.045 0 1 1 2.027-.506l1.26 5.042c.184.741.353 1.008.646.935.299-.073.285-.319.244-.522l-.872-4.328a.95.95 0 0 1 1.86-.375l.948 4.711.001.001v.001l.568 2.825c.124.533.266 1.035.45 1.527 1.085 2.889.519 5.564.334 6.143z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- ====== Hero Section Start -->
    <div
        class="relative dark:bg-dark pt-[120px] pb-[110px] lg:pt-[150px] max-w-7xl mx-auto sm:px-6 lg:px-8"
    >
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4 lg:w-5/12">
                    <div class="hero-content">
                        <h1
                            class="mb-5 text-4xl font-bold !leading-[1.208] text-dark dark:text-white sm:text-[42px] lg:text-[40px] xl:text-5xl"
                        >
                            Dubocq <span class="text-customColor">Pointage</span> Gérez vos heures efficacement.
                        </h1>
                        <p
                            class="mb-8 max-w-[480px] text-base text-body-color dark:text-dark-6"
                        >
                            Simplifiez la gestion des heures de travail de vos équipes grâce à notre solution de pointage sur mesure, conçue pour répondre aux besoins spécifiques de chaque projet. Que vous soyez en déplacement ou au bureau, suivez en temps réel les heures travaillées, gérez les chantiers et optimisez la productivité de vos salariés.
                        </p>

                        <div class="clients pt-16">
                            <h6
                                class="flex items-center mb-6 text-xs font-normal text-body-color dark:text-dark-6"
                            >
                                Votre partenaire informatique :
                                <span class="inline-block w-8 h-px ml-3 bg-body-color"></span>
                            </h6>
                            <div class="flex items-center gap-4 xl:gap-[50px]">
                                <a href="javascript:void(0)" class="block py-3">
                                    <img
                                        src="/images/logo-m2i.png"
                                        alt="M2i"
                                        class="w-36"
                                    />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden px-4 lg:block lg:w-1/12"></div>
                <div class="w-full px-4 lg:w-6/12">
                    <div class="lg:ml-auto lg:text-right">
                        <div class="relative z-10 inline-block pt-11 lg:pt-0">
                            <img
                                src="/images/constructors.jpg"
                                alt="hero"
                                class="max-w-full lg:ml-auto rounded-3xl"
                            />
                            <span class="absolute -left-8 -bottom-8 z-[-1]">
                     <svg
                         width="93"
                         height="93"
                         viewBox="0 0 93 93"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg"
                     >
                        <circle cx="2.5" cy="2.5" r="2.5" fill="#049ce3" />
                        <circle cx="2.5" cy="24.5" r="2.5" fill="#049ce3" />
                        <circle cx="2.5" cy="46.5" r="2.5" fill="#049ce3" />
                        <circle cx="2.5" cy="68.5" r="2.5" fill="#049ce3" />
                        <circle cx="2.5" cy="90.5" r="2.5" fill="#049ce3" />
                        <circle cx="24.5" cy="2.5" r="2.5" fill="#049ce3" />
                        <circle cx="24.5" cy="24.5" r="2.5" fill="#049ce3" />
                        <circle cx="24.5" cy="46.5" r="2.5" fill="#049ce3" />
                        <circle cx="24.5" cy="68.5" r="2.5" fill="#049ce3" />
                        <circle cx="24.5" cy="90.5" r="2.5" fill="#049ce3" />
                        <circle cx="46.5" cy="2.5" r="2.5" fill="#049ce3" />
                        <circle cx="46.5" cy="24.5" r="2.5" fill="#049ce3" />
                        <circle cx="46.5" cy="46.5" r="2.5" fill="#049ce3" />
                        <circle cx="46.5" cy="68.5" r="2.5" fill="#049ce3" />
                        <circle cx="46.5" cy="90.5" r="2.5" fill="#049ce3" />
                        <circle cx="68.5" cy="2.5" r="2.5" fill="#049ce3" />
                        <circle cx="68.5" cy="24.5" r="2.5" fill="#049ce3" />
                        <circle cx="68.5" cy="46.5" r="2.5" fill="#049ce3" />
                        <circle cx="68.5" cy="68.5" r="2.5" fill="#049ce3" />
                        <circle cx="68.5" cy="90.5" r="2.5" fill="#049ce3" />
                        <circle cx="90.5" cy="2.5" r="2.5" fill="#049ce3" />
                        <circle cx="90.5" cy="24.5" r="2.5" fill="#049ce3" />
                        <circle cx="90.5" cy="46.5" r="2.5" fill="#049ce3" />
                        <circle cx="90.5" cy="68.5" r="2.5" fill="#049ce3" />
                        <circle cx="90.5" cy="90.5" r="2.5" fill="#049ce3" />
                     </svg>
                  </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Hero Section End -->
</x-app-layout>
