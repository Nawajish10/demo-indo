<?php
session_start();
include '../../function/connect.php';
include 'config.php';
include 'GGRService.php';
include 'WalletService.php';

header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 0, 'msg' => 'Unauthorized']);
    exit;
}

$user = $_SESSION['username'];
$getUser = mysqli_query($koneksi, "SELECT extplayer FROM tb_user WHERE username = '$user'");
$infouser = mysqli_fetch_array($getUser);
$extplayer = $infouser['extplayer'];

$ggrService = new GGRService($provider, $koneksi);
$walletService = new WalletService($ggrService, $koneksi);

// Get remote balance from provider (transfer_status or just assume they have balance and try to withdraw)
$remote_res = $ggrService->transferStatus($extplayer, uniqid());

// We can just try to transfer out whatever balance they have at the provider
// The transferStatus method returns the current balance in the API
if (isset($remote_res['status']) && $remote_res['status'] == 1 && isset($remote_res['balance']) && $remote_res['balance'] > 0) {
    $amount_to_pull = $remote_res['balance'];
    $pull_res = $walletService->transferOut($extplayer, $amount_to_pull);
    if ($pull_res['status'] == 1) {
        echo json_encode(['status' => 1, 'msg' => 'Success', 'local_balance' => $pull_res['local_balance']]);
        exit;
    } else {
        echo json_encode(['status' => 0, 'msg' => $pull_res['msg']]);
        exit;
    }
} else {
    // Nothing to pull, just return current local balance
    $local = $walletService->getLocalBalance($extplayer);
    echo json_encode(['status' => 1, 'msg' => 'No remote balance to pull', 'local_balance' => $local]);
}
?>
