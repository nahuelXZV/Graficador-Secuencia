<x-app-layout>
    <div class="max-w-7xl mx-auto pt-2 pb-5 sm:px-6 lg:px-8 h-full">

        <div class="w-full h-16 mb-2">
            {{-- botones --}}
            <div class="col-span-2 w-full h-full bg-white ">
                <div class="flex flex-row items-center justify-end w-full h-full space-x-2">
                    <a href="" class="  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Codigo Java
                    </a>
                    <a href="" class="  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Codigo Python
                    </a>
                    <a href="" class="  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Codigo Javascript
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 h-full">

            <div class="col-span-2 w-full h-full bg-white border border-y-2">
                <div class="flex justify-between">
                    <p class="text-2xl font-bold text-left py-2 px-2">
                        {{ $diagrama->nombre }}
                    </p>

                    <button class="px-1 m-1" type="button" data-modal-target="small-modal"
                        data-modal-toggle="small-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-full px-2 pb-14">
                    <textarea name="" id="editor" class="w-full h-full " cols="30" rows="18">
                        {{ $diagrama->markdown }}
                    </textarea>
                    <button
                        class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        onclick="exportar()">
                        Exportar
                    </button>
                </div>
            </div>

            <div class="col-span-3 w-full h-full bg-white border border-y-2">
                <p class="text-2xl font-bold text-left py-1 px-2">
                    Vista previa
                </p>
                <div class="flex flex-col items-center justify-center w-full h-full">
                    <pre id="grafico" class="w-full h-full grafico p-4" name="grafico">
                    </pre>
                </div>
            </div>

        </div>
        <div id="small-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Small modal
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="small-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            With less than a month to go before the European Union enacts new consumer privacy laws for
                            its citizens, companies around the world are updating their terms of service agreements to
                            comply.
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May
                            25 and is meant to ensure a common set of data rights in the European Union. It requires
                            organizations to notify users as soon as possible of high-risk data breaches that could
                            personally affect them.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="small-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                            accept</button>
                        <button data-modal-hide="small-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="module">
        import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
        let grafico = document.querySelector("#grafico");
        let editor = document.getElementById("editor");
        mermaid.initialize({
            startOnLoad: false,
            theme: 'neutral',
            securityLevel: 'loose',
            flowchart: {
                useMaxWidth: false,
                htmlLabels: true
            }
        });
        editor.onkeyup = async function() {
            const {
                svg
            } = await mermaid.render('theGraph', editor.value);
            grafico.innerHTML = svg;
        }

        // cuando se carga la pagina se renderiza el grafico
        window.onload = async function() {
            const {
                svg
            } = await mermaid.render('theGraph', editor.value);
            grafico.innerHTML = svg;
        }


        setInterval(function() {
            let id = {{ $diagrama->id }};
            let markdown = editor.value;
            let _token = "{{ csrf_token() }}";
            let url = "{{ route('actualizar_diagrama', ['id' => $diagrama->id]) }}";
            let data = {
                id,
                markdown,
                _token
            };
            fetch(url, {
                    method: 'PUT',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': _token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => console.log(error));
        }, 20000);
    </script>
</x-app-layout>
