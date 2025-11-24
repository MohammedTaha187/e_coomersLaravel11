<?php
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Session\SymfonySessionDecorator;
use Illuminate\Contracts\Session\Session;
use Mockery;

// Mock the Session interface
$store = Mockery::mock(Session::class);
$decorator = new SymfonySessionDecorator($store);

echo "Class: " . get_class($decorator) . "\n";
echo "Store property exists: " . (property_exists($decorator, 'store') ? 'Yes' : 'No') . "\n";

try {
    $val = $decorator->store;
    echo "Store access success\n";
} catch (Throwable $e) {
    echo "Store access failed: " . $e->getMessage() . "\n";
}
