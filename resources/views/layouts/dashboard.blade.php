<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navegación Superior -->
        <nav class="bg-indigo-700 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-white text-xl font-bold">Panel de Control</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-white text-sm hidden sm:block">
                            <!-- Acceder al usuario autenticado usando la fachada Auth -->
                            Bienvenido, {{ Auth::user()->user_name }}
                        </span>
                        
                        <!-- Formulario de Logout -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-indigo-200 hover:text-white transition duration-150 p-2 rounded-lg bg-indigo-600 hover:bg-indigo-800">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tarjeta de Productos -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-indigo-500">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Gestión de Productos</h2>
                        <p class="text-gray-600 mb-4">Revisa, crea y modifica los registros de productos en el inventario.</p>
                        <a href="{{ route('productos.mostrar') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Ver Productos
                            <!-- Icono SVG -->
                            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm4-1a1 1 0 000 2h6a1 1 0 100-2H7zM4 10a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 000 2h6a1 1 0 100-2H5z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    <!-- Tarjeta de Creación Rápida -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-yellow-500">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Añadir Nuevo</h2>
                        <p class="text-gray-600 mb-4">Acceso rápido al formulario de creación de nuevos productos.</p>
                        <a href="{{ route('productos.crear') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Crear Producto
                            <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>