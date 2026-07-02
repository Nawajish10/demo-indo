<?php

class WalletService
{
    private $ggrService;
    private $koneksi;

    public function __construct($ggrService, $db_connection)
    {
        $this->ggrService = $ggrService;
        $this->koneksi = $db_connection;
    }

    private function generateTxId()
    {
        return uniqid('TXN_') . time();
    }

    public function getLocalBalance($user_code)
    {
        $query = mysqli_query($this->koneksi, "SELECT active FROM tb_saldo WHERE id_user = '$user_code'");
        if ($row = mysqli_fetch_assoc($query)) {
            return (float)$row['active'];
        }
        return 0.00;
    }

    private function updateLocalBalance($user_code, $amount, $type)
    {
        // type: 'add' or 'subtract'
        $current = $this->getLocalBalance($user_code);
        $new_balance = ($type === 'add') ? ($current + $amount) : ($current - $amount);
        
        if ($new_balance < 0) return false;

        $update = mysqli_query($this->koneksi, "UPDATE tb_saldo SET active = '$new_balance' WHERE id_user = '$user_code'");
        return $update;
    }

    private function logTransaction($user_code, $amount, $type, $tx_id, $provider = 'GGR')
    {
        $date = date('Y-m-d H:i:s');
        $saldo_after = $this->getLocalBalance($user_code);
        $transaksi_type = ($type === 'add') ? 'WITHDRAW_FROM_PROVIDER' : 'DEPOSIT_TO_PROVIDER';
        
        $sql = "INSERT INTO tb_trxgame (kd_transaksi, date, transaksi, total, saldo, note, provider, id_user, status) 
                VALUES ('$tx_id', '$date', '$transaksi_type', '$amount', '$saldo_after', 'Transfer $transaksi_type', '$provider', '$user_code', 1)";
        mysqli_query($this->koneksi, $sql);
    }

    // Transfer FROM local TO provider
    public function transferIn($user_code, $amount)
    {
        if ($amount <= 0) return ['status' => 0, 'msg' => 'Invalid amount'];

        $local_balance = $this->getLocalBalance($user_code);
        if ($local_balance < $amount) {
            return ['status' => 0, 'msg' => 'INSUFFICIENT_LOCAL_FUNDS'];
        }

        $agent_sign = $this->generateTxId();
        
        // 1. Deduct locally first
        if (!$this->updateLocalBalance($user_code, $amount, 'subtract')) {
            return ['status' => 0, 'msg' => 'Failed to deduct local balance'];
        }

        // 2. Call provider API (deposit into provider API wallet)
        $resp = $this->ggrService->deposit($user_code, $amount, $agent_sign);
        
        if (isset($resp['status']) && $resp['status'] == 1) {
            $this->logTransaction($user_code, $amount, 'subtract', $agent_sign, 'GGR');
            return ['status' => 1, 'msg' => 'Success', 'user_balance' => $resp['user_balance'] ?? 0];
        } else {
            // Rollback local deduction
            $this->updateLocalBalance($user_code, $amount, 'add');
            return ['status' => 0, 'msg' => 'API Error: ' . ($resp['msg'] ?? 'Unknown error')];
        }
    }

    // Transfer FROM provider TO local
    public function transferOut($user_code, $amount)
    {
        if ($amount <= 0) return ['status' => 0, 'msg' => 'Invalid amount'];

        $agent_sign = $this->generateTxId();

        // Call provider API (withdraw from provider API wallet)
        $resp = $this->ggrService->withdraw($user_code, $amount, $agent_sign);

        if (isset($resp['status']) && $resp['status'] == 1) {
            // Add to local balance
            if ($this->updateLocalBalance($user_code, $amount, 'add')) {
                $this->logTransaction($user_code, $amount, 'add', $agent_sign, 'GGR');
                return ['status' => 1, 'msg' => 'Success', 'local_balance' => $this->getLocalBalance($user_code)];
            } else {
                return ['status' => 0, 'msg' => 'Local balance update failed, but provider withdraw succeeded. Need manual adjustment.'];
            }
        } else {
            return ['status' => 0, 'msg' => 'API Error: ' . ($resp['msg'] ?? 'Unknown error')];
        }
    }
}
?>
