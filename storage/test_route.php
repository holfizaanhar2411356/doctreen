<?php
define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Bootstrap the application!
$kernel->bootstrap();

// Force login user with ID 3 so we bypass authentication and auth.petani middleware
$user = \App\Models\User::find(3);
if ($user) {
    \Illuminate\Support\Facades\Auth::login($user);
}

try {
    $request = Illuminate\Http\Request::create('/petani/dashboard', 'GET');
    $response = $kernel->handle($request);
    echo "STATUS CODE: " . $response->getStatusCode() . "\n";
    if ($response->getStatusCode() !== 200) {
        if ($response instanceof \Illuminate\Http\Response || method_exists($response, 'getContent')) {
            echo "RESPONSE BODY:\n" . substr($response->getContent(), 0, 1000) . "\n";
        } else {
            echo "RESPONSE TYPE: " . get_class($response) . "\n";
        }
    } else {
        echo "SUCCESSFULLY RENDERED DASHBOARD!\n";
    }
} catch (\Throwable $e) {
    echo "EXCEPTION THROWN:\n";
    echo $e->getMessage() . "\n";
    echo "FILE: " . $e->getFile() . " LINE: " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}

The above content shows the entire, complete file contents of the requested file.