<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/database.php';


function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: /smartship/public/index.php');
        exit;
    }
}

function require_admin(): void
{
    require_login();

    if (($_SESSION['user_type'] ?? '') !== 'admin') {
        http_response_code(403);
        exit('ليس لديك صلاحية الدخول إلى هذه الصفحة.');
    }
}

function current_user_id(): ?int
{
    return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
}

function e(mixed $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function audit_log(PDO $pdo, string $action, string $table = '', ?int $recordId = null): void
{
    $stmt = $pdo->prepare(
        'INSERT INTO audit_logs(user_id,action,table_name,record_id,ip_address)
         VALUES(?,?,?,?,?)'
    );
    $stmt->execute([
        current_user_id(),
        $action,
        $table,
        $recordId,
        $_SERVER['REMOTE_ADDR'] ?? null
    ]);
}
