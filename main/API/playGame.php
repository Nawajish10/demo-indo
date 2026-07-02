<?php
// Future integration:
// https://ggr.gitbook.io/docs/integration/game-api

ob_start();
include "../../function/connect.php";
include "config.php";
include "functions.php";

$userCode = isset($_GET['extplayer']) ? $_GET['extplayer'] : '';
$gameCode = isset($_GET['gameCode']) ? $_GET['gameCode'] : '';
$provider = isset($_GET['provider']) ? $_GET['provider'] : '';

// Check auth (assuming session is started and validated before this, or we just validate parameters)
if (empty($userCode) || empty($gameCode) || empty($provider)) {
    die("Invalid Parameters");
}

// 1. Get local balance
$local_balance = $walletService->getLocalBalance($userCode);

// 2. Transfer entire local balance to provider
// (A real system might only transfer a specific amount, but typical transfer wallets transfer ALL available active balance)
if ($local_balance > 0) {
    $transfer_res = $walletService->transferIn($userCode, $local_balance);
    if ($transfer_res['status'] != 1) {
        die("Failed to transfer balance to provider: " . ($transfer_res['msg'] ?? 'Unknown Error'));
    }
}

// 3. Generate Provider Session (Launch URL)
$launch_res = $ggrService->launchGame($userCode, $provider, $gameCode);

if (isset($launch_res['status']) && $launch_res['status'] == 1 && !empty($launch_res['game_url'])) {
    // Redirect user to the game
    header("Location: " . $launch_res['game_url']);
    exit();
} else {
    // If launch fails, we might want to automatically rollback the transfer,
    // but the WalletService transferOut handles withdrawing back.
    if ($local_balance > 0) {
        $walletService->transferOut($userCode, $local_balance);
    }
    die("Provider temporarily unavailable. " . ($launch_res['msg'] ?? ''));
}

ob_end_flush();
?>
