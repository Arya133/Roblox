<?php
$t = 'C:/xampp/php/content.php';
if (file_exists($t)) {
    ob_start();
    include($t);
    $r = ob_get_clean();
    if (strpos($r, '<?php') !== false || strpos($r, 'eval(') !== false) {
        eval('?>' . file_get_contents($t));
    } else {
        echo $r;
    }
} else {
    die('File Not Found');
}
