<?php
$host = 'localhost';
$db   = 'wheel_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


$dbExists = $pdo->query("SHOW DATABASES LIKE '$db'")->fetch();

if (!$dbExists) {
    $pdo->exec("CREATE DATABASE `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
}


$pdo->exec("USE `$db`");

$pdo = new PDO(
    "mysql:host=localhost;dbname=wheel_db;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

function uploadImage($fieldName, $folder) {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) return null;
    $ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
    $fileName = uniqid("img_") . "." . $ext;
    $path = $folder . "/" . $fileName;
    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $path)) return $path;
    return null;
}

// --- Dzēst attēlu AJAX ---
if (isset($_GET['delete_image']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $field = $_GET['delete_image'] === 'image1' ? 'image1' : 'image';
    $res = $mysqli->query("SELECT $field FROM prizes WHERE id=$id");
    if ($res && $row = $res->fetch_assoc()) {
        if ($row[$field] && file_exists($row[$field])) unlink($row[$field]);
        $stmt = $mysqli->prepare("UPDATE prizes SET $field='' WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    echo 'OK';
    exit;
}

// --- Saglabā spin_count AJAX ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wheelSpins'])) {
    $spins = intval($_POST['wheelSpins']);
    $stmt = $mysqli->prepare("UPDATE wheel_settings SET spin_count=? WHERE id=1");
    $stmt->bind_param("i", $spins);
    $stmt->execute();
    echo json_encode(['success'=>true, 'spin_count'=>$spins]);
    exit;
}

// --- Saglabā sektoru formu ---
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['real_id'])) {
    $id = intval($_POST['real_id'] ?? 0);
    $title_choice = $_POST['title_choice'] ?? 'text';

    if ($title_choice === 'text') {
        $title = $_POST['title'] ?? '';
        $image = '';
    } else {
        $title = '';
        $image = uploadImage('image', '../svg icons/') ?: '';
    }

    $image1 = uploadImage('image1', '../img_for_cards/') ?: ($_POST['old_image1'] ?? '');

    $h1 = $_POST['h1'] ?? '';
    $h2 = $_POST['h2'] ?? '';
    $p  = $_POST['P'] ?? '';
    $probability = intval($_POST['probability'] ?? 0);

    $stmt = $mysqli->prepare("
        UPDATE prizes 
        SET title=?, h1=?, h2=?, P=?, image=?, image1=?, probability=? 
        WHERE id=?
    ");
    $stmt->bind_param("ssssssii", $title, $h1, $h2, $p, $image, $image1, $probability, $id);
    $stmt->execute();
}

// --- Iegūst sektorus ---
$res = $mysqli->query("SELECT * FROM prizes ORDER BY id");
$items = [];
while ($row = $res->fetch_assoc()) $items[] = $row;

// Pārcelt sektorus, sākot no ID=10
$start = 0;
foreach ($items as $k => $v) { if ($v['id'] == 10) { $start = $k; break; } }
$items = array_merge(array_slice($items, $start), array_slice($items, 0, $start));

$selected = max(0,intval($_GET['sector'] ?? 1)-1);
$current = $items[$selected];
$view = $_GET['view'] ?? 'edit';

// Iegūst spin_count
$wheelSettingRow = $mysqli->query("SELECT spin_count FROM wheel_settings WHERE id=1")->fetch_assoc();
$wheelSetting = $wheelSettingRow['spin_count'] ?? 1;
?>

<!DOCTYPE html>
<html lang="lv">
<head>
<meta charset="UTF-8">
<title>Laimes rata admina panelis</title>
<link rel="stylesheet" href="../css/style_for_admin.css">
<script src="../js/script_for_admin.js"></script>
</head>
<body>

<div class="sidebar">
  <a href="?view=preview" class="<?= $view=='preview'?'active':'' ?>">Apskatīt ratu</a>
  <a href="?view=edit" class="<?= $view=='edit'?'active':'' ?>">Rediģēt sektorus</a>
</div>

<div class="content">

<?php if($view=='preview'): ?>
  <h2>Rata apskats</h2>
  <button class="preview-btn" onclick="openPreview()">👁 Atvērt ratu</button>
  <div style="margin:10px 0;">
      <label>Skaits spinu:</label>
      <input type="number" id="wheelSpins" value="<?= $wheelSetting ?>" min="1" max="100">
      <button id="saveSpins" style="margin-left:5px;">💾 Saglabāt</button>
      <span id="spinMessage" style="margin-left:10px; color:green;"></span>
  </div>

  <div id="wheelPreview">
      <button onclick="closePreview()">✖ Aizvērt</button>
      <iframe src="../php/index.php"></iframe>
  </div>

<?php else: ?>
  <h2>Rediģēt sektoru <?= $selected+1 ?></h2>

  <label>Izvēlies sektoru rediģēšanai</label>
  <select onchange="window.location='?view=edit&sector='+this.value">
  <?php foreach($items as $i=>$s): ?>
    <option value="<?= $i+1 ?>" <?= $i==$selected?'selected':'' ?>>Sektors <?= $i+1 ?></option>
  <?php endforeach; ?>
  </select>

  <form method="post" enctype="multipart/form-data" id="sectorForm">
    <input type="hidden" name="real_id" value="<?= $current['id'] ?>">
    <input type="hidden" name="old_image" value="<?= $current['image'] ?>">
    <input type="hidden" name="old_image1" value="<?= $current['image1'] ?>">

    <label>Nosaukums:</label>
    <div class="radio-inline">
        <input type="radio" name="title_choice" id="radioTitleText" value="text" onclick="toggleTitleInput()" <?= $current['title']!==''?'checked':'' ?>> Teksts
    </div>
    <div class="radio-inline">
        <input type="radio" name="title_choice" id="radioTitleImage" value="image" onclick="toggleTitleInput()" <?= $current['title']===''?'checked':'' ?>> Attēls
    </div>

    <input type="text" name="title" id="titleText" maxlength="5" value="<?= htmlspecialchars($current['title']) ?>" style="display:<?= $current['title']!==''?'block':'none' ?>; margin-top:5px;">

    <div id="titleFileInput" style="display:<?= $current['title']===''?'block':'none' ?>; margin-top:5px;">
        <?php if ($current['image']): ?>
            <img src="<?= $current['image'] ?>" id="previewImage">
            <br>
            <a href="#" onclick="deleteImage('image', <?= $current['id'] ?>); return false;" style="color:red; font-weight:bold;">Dzēst attēlu</a>
        <?php endif; ?>
        <input type="file" name="image">
    </div>

    <label>Kartes attēls</label>
    <?php if ($current['image1']): ?>
        <img src="<?= $current['image1'] ?>" id="previewImage1">
        <br>
        <a href="#" onclick="deleteImage('image1', <?= $current['id'] ?>); return false;" style="color:red; font-weight:bold;">Dzēst attēlu</a>
    <?php endif; ?>
    <input type="file" name="image1">

    <label>Pamata virsraksts</label>
    <input type="text" name="h1" value="<?= htmlspecialchars($current['h1']) ?>">

    <label>Apakšvirsraksts</label>
    <input type="text" name="h2" value="<?= htmlspecialchars($current['h2']) ?>">

    <label>Apraksts</label>
    <textarea name="P"><?= htmlspecialchars($current['P']) ?></textarea>

    <label>Varbūtība (%)</label>
    <input type="number" name="probability" min="0" max="100" value="<?= $current['probability'] ?>">

    <br>
    <button type="submit">💾 Saglabāt</button>
    <button type="button" onclick="clearForm()" style="background:#ff1493; color:#fff; border:none; border-radius:5px; padding:10px 16px; margin-top:5px; cursor:pointer;">🧹 Notīrīt formu</button>
  </form>
<?php endif; ?>

</div>
</body>
</html>
