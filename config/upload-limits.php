<?php
// Override PHP limits for uploads
if (function_exists('ini_set')) {
    ini_set('upload_max_filesize', '100M');
    ini_set('post_max_size', '100M');
    ini_set('max_execution_time', '300');
    ini_set('memory_limit', '256M');
}
