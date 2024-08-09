<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 mt-6">
    <form class="flex justify-center items-center gap-4" action="{{ route('pointage.show') }}" method="GET">
        @csrf
        <div class="flex">
            <label for="project_id" class="sr-only">Choisir un chantier</label>
            <select name="project_id" id="project_id" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 font-bold text-sm rounded-l-lg focus:ring-cyan-500 focus:border-cyan-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" required>
                <option disabled selected>Choisir un chantier</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->business }} - {{ $project->city }}</option>
                @endforeach
            </select>
            <label for="month" class="sr-only">Choisir un mois</label>
            <select name="month" id="month" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 font-bold text-sm focus:ring-cyan-500 focus:border-cyan-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" required>
                <option disabled selected>Choisir un mois</option>
                @php
                    $months = [
                        1 => 'Janvier',
                        2 => 'Février',
                        3 => 'Mars',
                        4 => 'Avril',
                        5 => 'Mai',
                        6 => 'Juin',
                        7 => 'Juillet',
                        8 => 'Août',
                        9 => 'Septembre',
                        10 => 'Octobre',
                        11 => 'Novembre',
                        12 => 'Décembre'
                    ];
                @endphp
                @foreach($months as $key => $month)
                    <option value="{{ $key }}">{{ $month }}</option>
                @endforeach
            </select>
            <label for="year" class="sr-only">Choisir une année</label>
            <select name="year" id="year" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 font-bold text-sm rounded-r-lg focus:ring-cyan-500 focus:border-cyan-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" required>
                <option selected value="2024">2024</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-gray-100 hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-cyan-500 hover:text-white border border-gray-300">Afficher le chantier</button>
        </div>
    </form>
</div>
