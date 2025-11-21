<?php

use App\Http\Controllers\PlazosController;
use App\Http\Controllers\RecargosController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\FormController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\crud\ProductosController; // Usado para CRUD
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Auth;

// --- Funciones de Ayuda (Helper Functions) ---

function getAge(int $year): int
{
    return 2025 - $year;
}

function calculate(int $num1, string $op, int $num2): float|int|string
{
    return match ($op) {
        "suma" => $num1 + $num2,
        "resta" => $num1 - $num2,
        "multiplicacion" => 	$num1 * $num2
    };
}

function getTotal(float $amount): float
{
    $iva = 16;
    return $amount + $amount * $iva / 100;
};

// --- Rutas de Ejemplos y Personalizadas ---

Route::get('/', function () {
    return view('welcome');
});

Route::get("/5/{year}", function (int $year): string {
    $age = getAge($year);
    return "Tu edad es " . $age . ".";
});

Route::get("/cal/{num1}/{op}/{mun2}", function (int $num1, string $op, int $num2): string {
    $result = calculate($num1, $op, $num2);
    return "El resultado es: " . $result . ".";
});

Route::get("/total/{amount}", function (float $amount): string {
    $total = getTotal($amount);
    return "El total con impuestos es: " . $total . ".";
});

//Ejercicio 1: Limpiador y Validador de Nombres de archivo
function validateFileName(string $name, string $ext): string
{
    $validExtensions = ['jpg', 'png', 'gif', 'pdf', 'docx'];
    $cleanName = str_replace(' ', '_', $name);
    if (!in_array($ext, $validExtensions)) {
        return "Error: Extension no valida. Usa una de las siguientes: " . implode(', ', $validExtensions) . ".";
    }
    return $cleanName . "." . $ext;
}
Route::get("/file/{name}/{ext}", function (string $name, string $ext): string {
    $cleanName = validateFileName($name, $ext);
    return "El nombre del archivo limpio es: " . $cleanName;
});

//Ejercicio 2: Calculador de Dias Laborales Futuros (Carbon)
function getFechaExacta(int $days): DateTime
{
    $currentDate = new DateTime();
    $daysAdded = 0;
    while ($daysAdded < $days) {
        $currentDate->modify('+1 day');
        if ($currentDate->format('N') < 6) {
            $daysAdded++;
        }
    }
    return $currentDate;
}
Route::get("/date/{days}", function (int $days): string {
    $currentDate = getFechaExacta($days);
    return "La fecha despues de " . $days . " dias habiles es: " . $currentDate->format('Y-m-d') . ".";
});

//Ejercicio 3: Extraccion de Extracto de Parrafo
function truncateText(string $text, int $maxLength): string
{
    if (strlen($text) <= $maxLength) {
        return $text;
    }
    return substr($text, 0, $maxLength) . '...';
}
Route::get("/paragraph/{text}/{maxLength}", function (string $text, int $maxLength): string {
    $truncatedText = truncateText($text, $maxLength);
    return "El texto truncado es " . $truncatedText;
});


//Ejercicio 4: Verificador de Fin de Mes (Carbon)
function getLastDayOfMonth(int $year, int $month): string
{
    $date = Carbon::createFromFormat('Y-m', "$year-$month");
    return $date->format('t');
}
Route::get("/lastday/{year}/{month}", function (int $year, int $month): string {
    $lastDay = getLastDayOfMonth($year, $month);
    return "El ultimo dia del mes es: " . $lastDay;
});

//Ejercicio 5: Mensajes
function email()
{
    return "Este es un mensaje de correo simple";
}

function notificacion()
{
    return " Este es una notificacion.";
}

function sms()
{
    return "Este es un sms";
}

Route::get("/mensaje/{type}", function (string $type): string {
    $types = [
        'correo' => 'email',
        'notificacion' => 'notificacion',
        'sms' => 'sms',
    ];
    if (array_key_exists($type, $types)) {
        // Usamos la variable como nombre de función
        return $types[$type]();
    }
    return "Tipo de mensaje no valido, usa 'correo', 'notificacion' o 'sms' ";
});

//Ejercicio 6: Formato de Nombres
function nameToUppercase($name)
{
    return strtoupper($name);
}
function nameToLowercase($name)
{
    return strtolower($name);
}
function nameToTitlecase($name): string
{
    return ucwords(strtolower($name));
}
Route::get("/name/{name}/{format}", function (string $name, string $format): string {
    $formats = [
        'uppercase' => 'nameToUppercase',
        'lowercase' => 'nameToLowercase',
        'titlecase' => 'nameToTitlecase',
    ];
    if (array_key_exists($format, $formats)) {
        // Usamos la variable como nombre de función
        return $formats[$format]($name);
    }
    return "Formato no valido, usa 'uppercase', 'lowercase', 'titlecase' ";
});

//Ejercicio 7: Calculadora
function sumar($num1, $num2): string
{
    return $num1 + $num2;
}
function restar($num1, $num2): string
{
    return $num1 - $num2;
}
function multiplicar($num1, $num2): string
{
    return $num1 * $num2;
}
function dividir($num1, $num2): string
{
    // Verificación de división por cero
    if ($num1 === 0 || $num2 === 0) {
        return "NaN";
    }
    return $num1 / $num2;
}

Route::get("/cal2/{num1}/{num2}/{op}", function (int $num1, int $num2, $op): string {
    $operaciones = [
        "sumar" => 'sumar',
        "restar" => 'restar',
        "multiplicar" => 'multiplicar',
        "dividir" => 'dividir',
    ];
    if (array_key_exists($op, $operaciones)) {
        return $operaciones[$op]($num1, $num2);
    }
    return "Opcion no valida";
});

//Ejercicio 8: Suma de días
function Semana($date): string
{
    // Clonamos la fecha para evitar modificar la original en las llamadas de función
    $clonedDate = clone $date;
    return $clonedDate->modify('+7 day')->format('d-m-y');
}
function agregar15dias($date): string
{
    $clonedDate = clone $date;
    return $clonedDate->modify('+15 day')->format('d-m-Y');
}

function mes($date): string
{
    $clonedDate = clone $date;
    return $clonedDate->modify('+1 month')->format('d-m-Y');
}

Route::get("/addDays/{folio}/{date}/{op}", function (int $folio, string $date, int $op): string {
    $dateObj = DateTime::createFromFormat('d-m-Y', $date);
    if (!$dateObj) {
        return "Error: Fecha no válida. Usa el formato 'DD-MM-YYYY'.";
    }

    $operations = [
        1 => 'Semana',
        2 => 'agregar15dias',
        3 => 'mes',
    ];

    if (array_key_exists($op, $operations)) {
        return $operations[$op]($dateObj);
    }
    return "Operacion no válida. Usa 1 para una semana, 2 para quince días o 3 para un mes.";
});

//Ejercicio 9: Impuestos con Closures
function addTaxes($amount, $tax): string
{
    return "El monto " . $amount . " con impuesto se vuelven " . $tax($amount) . ".";
}

Route::get("/importe/{amount}/{tax}", function (float $amount, int $tax): string {
    $small = function (float $total): float {
        return $total * 1.01;
    };
    $medium = function (float $total): float {
        return $total * 1.08;
    };
    $large = function (float $total): float {
        return $total * 1.16;
    };

    return match ($tax) {
        1 => addTaxes($amount, $small),
        8 => addTaxes($amount, $medium),
        16 => addTaxes($amount, $large),
        default => "Tipo de impuesto no válido. Usa 1, 8 o 16.",
    };
});

//Ejercicio 10: Generador de Nombre de Usuario
function generarNombreUsuario(array $nombres, string $separador): array
{
    //La variable separador se inyecta en la closure
    $closureUsuario = function (string $nombreCompleto) use ($separador): string {
        //convertir a minusculas
        $limpio = strtolower($nombreCompleto);
        //REEMPLAZAR ESPACIOS POR EL SEPARADOR
        return str_replace(' ', $separador, $limpio);
    };
    return array_map($closureUsuario, $nombres);
}
Route::get('/nombres-usuario/{sep}', function (string $sep) {
    $clientes = ['Juan perez', 'Ana Maria Garcia', 'Luis Echeverria'];
    $usuarios = generarNombreUsuario($clientes, $sep);
    return "<p>Separador usado: '{$sep}</p>" . implode('<br>', $usuarios);
});

// --- Rutas de Controladores ---

// Rutas de Formularios
Route::get('/formulario', [FormController::class, 'showForm']);
Route::get('/guardar', [FormController::class, 'storeText']);

// Rutas de Conteo de Sesión
Route::get('/session/count', [CountController::class, 'showForm']);
Route::get('/session/count/añadir', [CountController::class, 'añadir']);
Route::get('/session/count/quitar', [CountController::class, 'quitar']);

// Rutas de Operaciones
Route::get("/operacion/formulario", [OperationController::class, "showForm"]);
Route::post("/operacion/calcular", [OperationController::class, "calcular"]);
Route::get("/operacion/resultado", [OperationController::class, "showResult"]);

// Rutas de Plazos
Route::get('/plazo/todos', [PlazosController::class, "showTerm"]);
Route::get('/plazo/form', [PlazosController::class, "showTermForm"]);
Route::post('/plazo/form/añadir', [PlazosController::class, "setTerm"]);

// Rutas de Recargos
Route::get("recargos/agregar-multa/{porcentaje}", [RecargosController::class, "setFine"]);
Route::get("recargos/{tipoOperacion}/{valorOperacion}", [RecargosController::class, "getFine"]);

// Rutas CRUD de Productos (Ajuste para usar el URI /productos/mostrar)

// 1. Definir explícitamente la ruta de lectura con el URI deseado.
Route::get('/productos/mostrar', [ProductosController::class, 'read'])->name('productos.mostrar');

// 2. Usar Route::resource para el resto de las operaciones (crear, almacenar, actualizar, eliminar)
//    y excluir la ruta 'index' para evitar conflictos.
Route::resource('productos', ProductosController::class)->names([
    'create' => 'productos.crear',
    'store' => 'productos.almacen',
    'update' => 'productos.update',
    'destroy' => 'productos.destroy',
])->parameters([
    'productos' => 'producto' 
])->except([
    'index', 'show', 'edit' // Excluímos 'index' (read) y las no implementadas (show, edit)
]);


// Rutas de Autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');