<?php
// cron_withdraw_all.php
// This script is meant to be executed periodically (e.g. via cron) to retrieve all player balances from the GGR provider.
include __DIR__ . '/function/connect.php';
include __DIR__ . '/main/API/functions.php';

global $ggrService, $koneksi;

echo "Starting Global Balance Retrieval...\n";

// Use GGRService to call user_withdraw_reset for all users
$payload = [
    'method' => 'user_withdraw_reset',
    'all_users' => true
];
$resp = $ggrService->callAPI($payload);

if (isset($resp['status']) && $resp['status'] == 1 && isset($resp['user_list'])) {
    $success_count = 0;
    foreach ($resp['user_list'] as $user) {
        $user_code = $user['user_code'];
        $withdraw_amount = (float)$user['withdraw_amount'];
        
        if ($withdraw_amount > 0) {
            // Update local balance
            $current_query = mysqli_query($koneksi, "SELECT active FROM tb_saldo WHERE id_user = '$user_code'");
            if ($row = mysqli_fetch_assoc($current_query)) {
                $current_balance = (float)$row['active'];
                $new_balance = $current_balance + $withdraw_amount;
                
                // Update
                mysqli_query($koneksi, "UPDATE tb_saldo SET active = '$new_balance' WHERE id_user = '$user_code'");
                
                // Log Transaction
                $tx_id = uniqid('CRON_TXN_') . time();
                $date = date('Y-m-d H:i:s');
                $transaksi_type = 'WITHDRAW_FROM_PROVIDER';
                
                $sql = "INSERT INTO tb_trxgame (kd_transaksi, date, transaksi, total, saldo, note, provider, id_user, status) 
                        VALUES ('$tx_id', '$date', '$transaksi_type', '$withdraw_amount', '$new_balance', 'Batch Balance Sync', 'GGR', '$user_code', 1)";
                mysqli_query($koneksi, $sql);
                
                $success_count++;
                echo "Processed user: $user_code | Amount: $withdraw_amount | New Balance: $new_balance\n";
            }
        }
    }
    echo "Global Balance Retrieval Complete. Synced $success_count active users.\n";
} else {
    echo "Failed to retrieve balances. API Error: " . ($resp['msg'] ?? 'Unknown Error') . "\n";
}
?>
