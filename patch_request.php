<?php
$file = __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Request.php';
$content = file_get_contents($file);
$search = 'return $this->session->store;';
$replace = 'if (! property_exists($this->session, "store")) { file_put_contents(__DIR__ . "/debug_session_error.txt", "Class: " . get_class($this->session) . "\n"); } return $this->session->store;';
$newContent = str_replace($search, $replace, $content);
file_put_contents($file, $newContent);
echo "Patched Request.php\n";
