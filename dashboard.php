
<?php
require_once __DIR__ . '/../config/auth.php';
require_login();

$page_title = 'لوحة التحكم';

$usersCount = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$citiesCount = (int)$pdo->query('SELECT COUNT(*) FROM cities')->fetchColumn();
$customersCount = (int)$pdo->query('SELECT COUNT(*) FROM customers')->fetchColumn();
$shipmentsCount = (int)$pdo->query('SELECT COUNT(*) FROM shipments')->fetchColumn();

require __DIR__ . '/../includes/header.php';
?>
<h1>لوحة التحكم</h1>
<p>مرحبًا <?= e($_SESSION['full_name'] ?? '') ?>.</p>

<div class="cards">
    <div class="stat-card"><h3>المستخدمون</h3><strong><?= $usersCount ?></strong></div>
    <div class="stat-card"><h3>المدن</h3><strong><?= $citiesCount ?></strong></div>
    <div class="stat-card"><h3>العملاء</h3><strong><?= $customersCount ?></strong></div>
    <div class="stat-card"><h3>الشحنات</h3><strong><?= $shipmentsCount ?></strong></div>
</div>

<h2>إدارة النظام</h2>
<ul>
    <li><a href="/smartship/public/users/index.php">إدارة المستخدمين</a></li>
    <li><a href="/smartship/public/cities/index.php">إدارة المدن</a></li>
    <li><a href="/smartship/public/customers/index.php">إدارة العملاء</a></li>
    <li><a href="/smartship/public/shipments/index.php">إدارة الشحنات وتتبعها</a></li>
</ul>
<?php require __DIR__ . '/../includes/footer.php'; ?>