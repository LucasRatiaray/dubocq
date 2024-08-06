<div class="mx-auto w-screen flex justify-center">
    <div class="bg-white shadow-md rounded-lg p-6" style="width: 92vw;">
        <h1 id="title" class="text-2xl font-bold mb-4"></h1>

        <form class="py-6 flex items-center gap-4">
            <div class="flex">
                <label for="project" class="sr-only">Choisir un employé</label>
                <select id="project" class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Choisir un employé</option>
                    <option value="CA">California</option>
                    <option value="TX">Texas</option>
                    <option value="WH">Washington</option>
                    <option value="FL">Florida</option>
                    <option value="VG">Virginia</option>
                    <option value="GE">Georgia</option>
                    <option value="MI">Michigan</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded">Ajouter un employé</button>
            </div>
        </form>

        <div id="handsontable" class="w-full h-full"></div>
        <button id="save" class="mt-4 bg-gray-500 hover:bg-custom-900 text-white font-bold py-2 px-4 rounded">Sauvegarder</button>
    </div>
</div>
