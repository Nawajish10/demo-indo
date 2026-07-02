<?php
include '../../../function/connect.php';
include '../../../main/API/functions.php';

global $ggrService, $koneksi;

// We will sync PRAGMATIC provider games as per API docs
$provider = 'PRAGMATIC';
$res = $ggrService->gameList($provider);

if (isset($res['status']) && $res['status'] == 1 && !empty($res['games'])) {
    $inserted = 0;
    $updated = 0;

    foreach ($res['games'] as $game) {
        $code = mysqli_real_escape_string($koneksi, $game['game_code']);
        $name = mysqli_real_escape_string($koneksi, $game['game_name']);
        $image = mysqli_real_escape_string($koneksi, $game['banner']);

        // Check if game exists in tb_gamelist
        $cek = mysqli_query($koneksi, "SELECT * FROM tb_gamelist WHERE gameid = '$code' AND provider = '$provider'");
        if (mysqli_num_rows($cek) > 0) {
            // Update
            mysqli_query($koneksi, "UPDATE tb_gamelist SET gamename = '$name', image = '$image' WHERE gameid = '$code' AND provider = '$provider'");
            $updated++;
        } else {
            // Insert
            mysqli_query($koneksi, "INSERT INTO tb_gamelist (gameid, gamename, image, provider) VALUES ('$code', '$name', '$image', '$provider')");
            $inserted++;
        }
    }
    
    echo "Sync Successful! Inserted: $inserted, Updated: $updated games.";
} else {
    echo "Sync Failed. Response: " . json_encode($res);
}
?>
