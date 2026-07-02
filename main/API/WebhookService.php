<?php

class WebhookService
{
    private $koneksi;

    public function __construct($db_connection)
    {
        $this->koneksi = $db_connection;
    }

    public function handleRequest($payload)
    {
        // For a Transfer Wallet architecture, real-time bet settlements 
        // are not strictly required unless the provider pushes game logs 
        // via webhook. This logs the webhook payload for debugging.
        
        $method = $payload['method'] ?? 'unknown_webhook';
        $req = json_encode($payload);
        
        $this->logWebhook($method, $req, "RECEIVED");
        
        // Respond to the provider to acknowledge receipt
        return ['status' => 1, 'msg' => 'SUCCESS'];
    }

    private function logWebhook($method, $request, $status)
    {
        if (!$this->koneksi) return;
        $method_safe = mysqli_real_escape_string($this->koneksi, 'WEBHOOK_' . $method);
        $req_safe = mysqli_real_escape_string($this->koneksi, $request);
        $status_safe = mysqli_real_escape_string($this->koneksi, $status);
        $date = date('Y-m-d H:i:s');
        mysqli_query($this->koneksi, "INSERT INTO tb_provider_logs (provider, request, response, created_at) VALUES ('$method_safe', '$req_safe', '$status_safe', '$date')");
    }
}
?>
