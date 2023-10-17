<x-app-layout>
    <div class="max-w-7xl mx-auto pt-2 pb-5 sm:px-6 lg:px-8 h-full">

        <div class="w-full h-16 mb-2">
            {{-- botones --}}
            <div class="col-span-2 w-full h-full bg-white flex justify-between ">
                <div class="flex flex-row items-center justify-start w-full h-full space-x-2">
                    <a href="{{ route('generar_java', $diagrama->id) }}" target="_blank"
                        class="text-sm  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg ml-1">
                        Codigo Java
                    </a>
                    <a href="{{ route('generar_php', $diagrama->id) }}" target="_blank"
                        class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Codigo php
                    </a>
                    <a href="{{ route('generar_csharp', $diagrama->id) }}" target="_blank"
                        class="text-sm  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Codigo C#
                    </a>
                </div>
                <div class="flex flex-row items-center justify-end w-full h-full mr-2 ">
                    <button type="button" onclick="copyToClipboard()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                        </svg>
                        <span class="sr-only">Compartir</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 h-full">

            <div class="col-span-2 w-full h-full bg-white border border-y-2">
                <div class="flex justify-between">
                    <p class="text-2xl font-bold text-left py-2 px-2">
                        {{ $diagrama->nombre }}
                    </p>
                    <button data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                        class="block text-black font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-full px-2 pb-14">
                    <textarea name="" id="editor" class="w-full h-full " cols="30" rows="18">{{ $diagrama->markdown }}</textarea>
                    {{-- <button class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                        onclick="exportar()">
                        Exportar
                    </button> --}}
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
        <div id="extralarge-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-xl max-h-full">
                <div class="relative bg-white rounded-lg shadow ">
                    <div class="flex items-center justify-between p-5 border-b rounded-t ">
                        <h3 class="text-xl font-medium text-gray-900 ">
                            Sintaxis
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center "
                            data-modal-hide="extralarge-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class=" p-6">

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Comando
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Ejemplo / Resultado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            participant
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/participant.png') }}" alt="" class="w-32">
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            actor
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/actor.png') }}" alt="" class="w-32">
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            <span class="font-bold text-base">
                                                Mensajes <br>
                                            </span>
                                            <span class="font-semibold">
                                                [Actor][Arrow][Actor]:Message text
                                            </span><br>
                                            Lista de flechas: <br>
                                            <ul class="text-base">
                                                <li>->: get </li>
                                                <li>-->: get </li>
                                                <li>->>: get </li>
                                                <li>-->>: get </li>
                                                <li>-x: get</li>
                                                <li>--x: get</li>
                                                <li>-): get</li>
                                                <li>--): get</li>
                                            </ul>
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/message.png') }}" alt="" class="w-80">
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            <span class="font-bold text-base">
                                                Activacion <br>
                                            </span>
                                            Zalazar->>Nahuel: Get <br>
                                            activate Nahuel <br>
                                            Nahuel-->>Zalazar: Get <br>
                                            deactivate Nahuel <br>
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/activate.png') }}" alt="" class="w-44">
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            <span class="font-bold text-base">
                                                Estructuras de control <br>
                                            </span>
                                            Nahuel->Zalazar: Get <br>
                                            loop Ciclo <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            end <br><br>
                                            alt Alternativa <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            else <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            end <br><br>
                                            par Nahuel to Zalazar <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            and Nahuel to Zalazar <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            end <br> <br>
                                            critical Critico <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            option Network timeout <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            option Credentials rejected <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            end <br> <br>
                                            break break <br>
                                            Nahuel-->Zalazar: Post! <br>
                                            end <br>

                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/control.png') }}" alt="" class="w-">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                        {{-- <button data-modal-hide="extralarge-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">I
                            accept</button>
                        <button data-modal-hide="extralarge-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Decline</button> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function copyToClipboard() {
            // sacar el valor de $compartir_url
            let textoACopiar = @json($compartir_url);
            console.log(textoACopiar);
            // Crea un elemento de texto oculto
            var elementoTemporario = document.createElement("textarea");
            elementoTemporario.value = textoACopiar;
            document.body.appendChild(elementoTemporario);

            // Selecciona y copia el texto
            elementoTemporario.select();
            document.execCommand("copy");

            // Elimina el elemento temporal
            document.body.removeChild(elementoTemporario);
            alert("Copiado al portapapeles");
        }
    </script>

    <script type="module">
        let editor = document.getElementById("editor");
        let grafico = document.querySelector("#grafico");
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
        import {
            getDatabase,
            ref,
            set,
            get,
            onValue
        } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-database.js";
        import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';

        // Mermaid
        mermaid.initialize({
            startOnLoad: false,
            theme: 'neutral',
            securityLevel: 'loose',
            flowchart: {
                useMaxWidth: false,
                htmlLabels: true
            }
        });

        let drawDiagram = async function(markdown) {
            const {
                svg
            } = await mermaid.render('theGraph', markdown);
            grafico.innerHTML = svg;
        }

        // cuando se carga la pagina se renderiza el grafico
        window.onload = async function() {
            // traer el markdown de firebase
            const nodoRef = ref(database, 'graficas/' + identificador);
            setInterval(async function() {
                const snapshot = await get(nodoRef);
                let markdown = snapshot.val().markdown;
                editor.value = markdown;
            }, 5000);
            await drawDiagram(markdown);
        }

        // Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyDRQdphfO-udl8UAIWJb7ZtTfDvZiKIHLI",
            authDomain: "graficador-295cc.firebaseapp.com",
            databaseURL: "https://graficador-295cc-default-rtdb.firebaseio.com",
            projectId: "graficador-295cc",
            storageBucket: "graficador-295cc.appspot.com",
            messagingSenderId: "920173213639",
            appId: "1:920173213639:web:8c183fda05d9acb36c4be2"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        const database = getDatabase(app);
        let identificador = @json($diagrama->identificador);

        //actualizar el valor del markdown en la base de datos con la key identificador
        editor.onkeyup = async function() {
            let markdown = editor.value;
            const nodoRef = ref(database, 'graficas/' + identificador);
            set(nodoRef, {
                    markdown: markdown
                })
                .then(async () => {
                    await drawDiagram(markdown);
                    console.log("Datos guardados exitosamente en Firebase.");
                })
                .catch((error) => {
                    console.error("Error al guardar datos en Firebase:", error);
                });
        }

        // recibir el diagrama en tiempo real
        const nodoRef = ref(database, 'graficas/' + identificador);
        onValue(nodoRef, async (snapshot) => {
            let markdown = snapshot.val().markdown;
            editor.value = markdown;
            await drawDiagram(markdown);
        });

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
        }, 10000);
    </script>
</x-app-layout>
