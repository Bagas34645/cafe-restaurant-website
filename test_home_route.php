<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

use Illuminate\Http\Request;

try {
  echo "=== TEST HOME ROUTE ===\n";

  // Simulasi HTTP request ke home
  $request = Request::create('/', 'GET');
  $response = $kernel->handle($request);

  if ($response->getStatusCode() == 200) {
    echo "✅ Home route berhasil! Status: " . $response->getStatusCode() . "\n";
    echo "Response berhasil di-generate tanpa error MySQL.\n";
  } else {
    echo "❌ Error! Status: " . $response->getStatusCode() . "\n";
  }
} catch (Exception $e) {
  echo "❌ ERROR: " . $e->getMessage() . "\n";
  echo "Line: " . $e->getLine() . "\n";
  echo "File: " . $e->getFile() . "\n";
}
