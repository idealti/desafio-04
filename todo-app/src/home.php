<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/protect.php';

use \App\entity\task;



$where = 'user_id = ' . $_SESSION['id'];
$orderBy = null;
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'date') {
        $orderBy = 'date ASC';
    } elseif ($_GET['sort'] === 'is_completed') {
        $orderBy = 'is_completed ASC';
    }
}

$tasks = Task::getAll($where, $orderBy);


include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/tasks.php';
include __DIR__ . '/includes/footer.php';
