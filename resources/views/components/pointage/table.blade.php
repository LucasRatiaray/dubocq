<div class="mx-auto w-screen flex justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-400" style="width: 92vw;">
        <div>
            <h1 id="title" class="text-2xl font-bold flex justify-center border rounded py-6 bg-gray-100 border-gray-300"></h1>
        </div>

        <div class="mt-4 flex justify-center bg-white">
            <div class="flex justify-center gap-4 p-2 bg-gray-100 border rounded">
            <button type="submit" class="bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">Jour</button>
            <button type="submit" class="bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">Nuit</button>
            <button type="submit" class="bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">Férié</button>
            <button type="submit" class="bg-white hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">RTT</button>
            </div>
        </div>

        <div id="handsontable" class="w-full h-full mt-5"></div>

        <div class="mt-4 flex justify-between">
            <form class="flex items-center gap-4" action="{{ route('pointage.add', ['id' => $project->id]) }}" method="POST">
                @csrf
                <div class="flex">
                    <label for="employee" class="sr-only">Choisir un employé</label>
                    <select name="employee_id" id="employee" class="w-auto bg-gray-100 border border-gray-300 text-gray-900 font-bold text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choisir un employé</option>
                        @foreach ($allEmployees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="month" value="{{ $month }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <div>
                    <button type="submit" class="bg-gray-100 hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">Ajouter un employé</button>
                </div>
            </form>
            <button id="save" class="bg-gray-100 hover:bg-custom-900 text-black font-bold py-2 px-4 rounded text-sm hover:bg-blue-500 hover:text-white border border-gray-300">Sauvegarder</button>
        </div>
    </div>
</div>
