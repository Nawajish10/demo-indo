<?php

class GGRService
{
    private $api_url;
    private $agent_code;
    private $agent_token;
    private $koneksi;

    public function __construct($provider_config, $db_connection)
    {
        $this->api_url = $provider_config['api_url'];
        $this->agent_code = $provider_config['agent_code'];
        $this->agent_token = $provider_config['agent_token'];
        $this->koneksi = $db_connection;
    }

    public function callAPI($payload)
    {
        // Inject auth tokens automatically
        $payload['agent_code'] = $this->agent_code;
        $payload['agent_token'] = $this->agent_token;

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disabled for local XAMPP testing
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        $this->logProvider('GGR', json_encode($payload), $response ?: $error);

        if ($error) {
            return ['status' => 0, 'msg' => 'cURL Error: ' . $error];
        }

        $decoded = json_decode($response, true);
        if (!$decoded) {
            return ['status' => 0, 'msg' => 'Invalid JSON Response'];
        }

        return $decoded;
    }

    private function logProvider($provider, $request, $response)
    {
        if (!$this->koneksi) return;
        $req = mysqli_real_escape_string($this->koneksi, $request);
        $res = mysqli_real_escape_string($this->koneksi, $response);
        $date = date('Y-m-d H:i:s');
        mysqli_query($this->koneksi, "INSERT INTO tb_provider_logs (provider, request, response, created_at) VALUES ('$provider', '$req', '$res', '$date')");
    }

    public function providerList()
    {
        return $this->callAPI([
            'method' => 'provider_list'
        ]);
    }

    public function gameList($provider_code)
    {
        return $this->callAPI([
            'method' => 'game_list',
            'provider_code' => $provider_code
        ]);
    }

    public function launchGame($user_code, $provider_code, $game_code)
    {
        return $this->callAPI([
            'method' => 'game_launch', // Based on standard assumption
            'user_code' => $user_code,
            'provider_code' => $provider_code,
            'game_code' => $game_code
        ]);
    }

    public function getGameLog($user_code = '', $game_type = 'slot', $start = '', $end = '', $page = 0, $perPage = 1000)
    {
        $payload = [
            'method' => 'get_game_log',
            'game_type' => $game_type,
            'page' => $page,
            'perPage' => $perPage
        ];
        if (!empty($user_code)) $payload['user_code'] = $user_code;
        if (!empty($start)) $payload['start'] = $start;
        if (!empty($end)) $payload['end'] = $end;

        return $this->callAPI($payload);
    }

    public function getGameHistory($user_code, $provider_code, $game_code)
    {
        return $this->callAPI([
            'method' => 'get_game_history',
            'user_code' => $user_code,
            'provider_code' => $provider_code,
            'game_code' => $game_code
        ]);
    }

    public function deposit($user_code, $amount, $agent_sign)
    {
        return $this->callAPI([
            'method' => 'user_deposit',
            'user_code' => $user_code,
            'amount' => (float)$amount,
            'agent_sign' => $agent_sign
        ]);
    }

    public function withdraw($user_code, $amount, $agent_sign)
    {
        return $this->callAPI([
            'method' => 'user_withdraw',
            'user_code' => $user_code,
            'amount' => (float)$amount,
            'agent_sign' => $agent_sign
        ]);
    }

    public function transferStatus($user_code, $agent_sign)
    {
        return $this->callAPI([
            'method' => 'transfer_status',
            'user_code' => $user_code,
            'agent_sign' => $agent_sign
        ]);
    }
}
?>
