<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Phone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-white text-gray-900">

<main>

    <section class="py-24">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 items-center gap-20">

            <div class="flex flex-col justify-center max-w-2xl">
                <h1 class="text-7xl font-bold mb-6 leading-tight">
                    Reparación
                    <span class="text-red-600 block">Profesional</span>
                </h1>

                <p class="text-gray-700 text-lg leading-relaxed mb-8">
                    Lorem ipsum dolor sit amet consectetur libero suscipit laboriosam officia nisi ad?
                </p>

                <div class="flex gap-4">
                    <a href="#" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition">
                        Agendar cita
                    </a>

                    <a href="#" class="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg hover:bg-gray-300 transition">
                        Servicios
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 grid-rows-2 gap-10">
                <div class="flex flex-col items-center text-center">
                    <i class="fa-solid fa-screwdriver-wrench text-5xl text-red-600 mb-2"></i>
                    <h2 class="text-lg font-semibold">Reparaciones</h2>
                    <p class="text-3xl font-bold text-red-600">150+</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <i class="fa-solid fa-clock text-5xl text-red-600 mb-2"></i>
                    <h2 class="text-lg font-semibold">Tiempo promedio</h2>
                    <p class="text-3xl font-bold text-red-600">24 hrs</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <i class="fa-solid fa-star text-5xl text-red-600 mb-2"></i>
                    <h2 class="text-lg font-semibold">Satisfacción</h2>
                    <p class="text-3xl font-bold text-red-600">99%</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <i class="fa-solid fa-user-clock text-5xl text-red-600 mb-2"></i>
                    <h2 class="text-lg font-semibold">Atenciones</h2>
                    <p class="text-3xl font-bold text-red-600">200+</p>
                </div>
            </div>

        </div>
    </section>


    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6 max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="flex items-start gap-4">
                <i class="fa-regular fa-star text-2xl text-red-600"></i>
                <div>
                    <h3 class="text-xl font-semibold mb-1">Técnicos Certificados</h3>
                    <p class="text-gray-700 text-sm">Reparamos una amplia gama de modelos de iPhone y iPad.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <i class="fa-regular fa-calendar-check text-2xl text-red-600"></i>
                <div>
                    <h3 class="text-xl font-semibold mb-1">Garantía</h3>
                    <p class="text-gray-700 text-sm">Ofrecemos garantía en todas nuestras reparaciones.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <i class="fa-solid fa-bolt-lightning text-2xl text-red-600"></i>
                <div>
                    <h3 class="text-xl font-semibold mb-1">Reparación Rápida</h3>
                    <p class="text-gray-700 text-sm">Servicio rápido para que vuelvas a usar tu dispositivo cuanto antes.</p>
                </div>
            </div>

        </div>
    </section>


    <section class="py-16">
        <div class="container mx-auto px-6 max-w-6xl">

            <h3 class="text-4xl font-bold mb-4">Servicios</h3>

            <p class="text-gray-700 text-lg">
                Ofrecemos una variedad de servicios para reparar tu dispositivo Apple.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10">

                <div class="bg-white p-8 shadow border border-gray-200 rounded-xl hover:border-red-600 transition">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xl font-semibold">Reparación de Pantalla</h4>
                        <p class="text-red-600 font-bold text-sm">$500</p>
                    </div>
                    <p class="text-gray-700">Cambio de pantallas rotas o dañadas con repuestos originales.</p>
                </div>

                <div class="bg-white p-8 shadow border border-gray-200 rounded-xl hover:border-red-600 transition">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xl font-semibold">Reemplazo de Batería</h4>
                        <p class="text-red-600 font-bold text-sm">$200</p>
                    </div>
                    <p class="text-gray-700">Sustitución de baterías para mejorar el rendimiento y duración.</p>
                </div>

                <div class="bg-white p-8 shadow border border-gray-200 rounded-xl hover:border-red-600 transition">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xl font-semibold">Reparación de Conectividad</h4>
                        <p class="text-red-600 font-bold text-sm">$150</p>
                    </div>
                    <p class="text-gray-700">Solución de problemas con Wi-Fi, Bluetooth y redes móviles.</p>
                </div>

            </div>

            <div class="flex justify-center mt-12">
                <a href="#" class="text-gray-800 px-8 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                    Ver más servicios
                </a>
            </div>

        </div>
    </section>


    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6 max-w-6xl">

            <h3 class="text-4xl font-bold mb-10">Ubicación</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

                <div class="flex flex-col space-y-6">

                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-crosshairs text-red-600 text-2xl"></i>
                        <div>
                            <p class="text-gray-900 font-semibold">Dirección:</p>
                            <p class="text-gray-700">Calle 60 #390, 1872672</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <i class="fa-regular fa-clock text-red-600 text-2xl"></i>
                        <div>
                            <p class="text-gray-900 font-semibold">Horario de Atención:</p>
                            <p class="text-gray-700">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-phone text-red-600 text-2xl"></i>
                        <div>
                            <p class="text-gray-900 font-semibold">Teléfono:</p>
                            <p class="text-gray-700">+57 123 456 7890</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <i class="fa-regular fa-envelope text-red-600 text-2xl"></i>
                        <div>
                            <p class="text-gray-900 font-semibold">Email:</p>
                            <p class="text-gray-700">contacto@doctorphone.com</p>
                        </div>
                    </div>

                </div>

                <div class="overflow-hidden rounded-xl shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799148192!2d-74.25986768771596!3d40.69767006370844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20EE.%20UU.!5e0!3m2!1ses!2sco!4v1600000000000!5m2!1ses!2sco"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>

            </div>

        </div>
    </section>

</main>


<footer class="bg-red-600 text-white py-12">
    <div class="container mx-auto px-6">

        <!-- Contenido principal -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Empresa -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Doctor Phone</h3>
                <p class="text-gray-100 text-sm leading-relaxed">
                    Especialistas en reparación profesional de dispositivos Apple.
                </p>
            </div>

            <!-- Enlaces -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Enlaces</h3>
                <ul class="space-y-2 text-gray-100 text-sm">
                    <li><a href="#" class="hover:underline">Servicios</a></li>
                    <li><a href="#" class="hover:underline">Agendar cita</a></li>
                    <li><a href="#" class="hover:underline">Ubicación</a></li>
                    <li><a href="#" class="hover:underline">Contacto</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Contacto</h3>

                <p class="text-sm text-gray-100 mb-2">
                    Calle 60 #390, 1872672
                </p>

                <p class="text-sm text-gray-100 mb-2">
                    +57 123 456 7890
                </p>

                <p class="text-sm text-gray-100">
                    contacto@doctorphone.com
                </p>
            </div>
        </div>

        <!-- Línea de separación -->
        <div class="border-t border-red-400 mt-10 pt-6 text-center">
            <p class="text-gray-200 text-sm">
                © 2024 Doctor Phone — Todos los derechos reservados.
            </p>

            <p class="text-gray-100 text-sm mt-2">
                Sitio desarrollado por <span class="font-bold">RC Consulting Software</span>.
            </p>
        </div>

    </div>
</footer>


</body>
</html>
