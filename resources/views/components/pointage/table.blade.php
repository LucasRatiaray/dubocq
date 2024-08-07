<div class="mx-auto w-screen flex justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-400" style="width: 92vw;">
        <h1 id="title" class="text-2xl font-bold flex justify-center"></h1>

        <form class="py-6 flex items-center gap-4" action="{{ route('pointage.add', ['id' => $project->id]) }}" method="POST">
            @csrf
            <div class="flex">
                <label for="employee" class="sr-only">Choisir un employé</label>
                <select name="employee_id" id="employee" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Choisir un employé</option>
                    @foreach ($allEmployees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">
            <div>
                <button type="submit" class="bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded text-sm hover:bg-blue-500">Ajouter un employé</button>
            </div>
        </form>

        <div id="handsontable" class="w-full h-full"></div>
        <button id="save" class="mt-4 bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded text-sm hover:bg-blue-500">Sauvegarder</button>
    </div>
</div>
