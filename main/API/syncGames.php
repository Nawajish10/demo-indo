<?php
// Sync Games and Providers from NexusGGR
// Run this script to populate tb_gamelist and tb_provider
include '../../function/connect.php';
include 'config.php';
include 'GGRService.php';

$ggrService = new GGRService($provider, $koneksi);

echo "Starting Sync...\n";

// 1. Fetch Providers
$providersRes = $ggrService->providerList();

if (!isset($providersRes['status']) || $providersRes['status'] != 1) {
    die("Failed to fetch providers: " . json_encode($providersRes) . "\n");
}

$providers = $providersRes['data'];
echo "Found " . count($providers) . " providers.\n";

foreach ($providers as $prov) {
    $provCode = mysqli_real_escape_string($koneksi, $prov['provider_code']);
    $provName = mysqli_real_escape_string($koneksi, $prov['provider_name']);
    
    // Insert or update provider
    $checkProv = mysqli_query($koneksi, "SELECT * FROM tb_provider WHERE providerid = '$provCode'");
    if (mysqli_num_rows($checkProv) == 0) {
        $slug = strtolower(str_replace(' ', '', $provName));
        mysqli_query($koneksi, "INSERT INTO tb_provider (providerid, slug, providername, gambar) VALUES ('$provCode', '$slug', '$provName', '$slug.png')");
        echo "Inserted Provider: $provName\n";
    }

    // 2. Fetch Games for this provider
    echo "Fetching games for $provName...\n";
    $gamesRes = $ggrService->gameList($provCode);
    if (isset($gamesRes['status']) && $gamesRes['status'] == 1) {
        $games = $gamesRes['data'];
        echo "Found " . count($games) . " games for $provName.\n";
        
        foreach ($games as $game) {
            $gameCode = mysqli_real_escape_string($koneksi, $game['game_code']);
            $gameName = mysqli_real_escape_string($koneksi, $game['game_name']);
            $banner = mysqli_real_escape_string($koneksi, $game['banner'] ?? '');
            
            $checkGame = mysqli_query($koneksi, "SELECT * FROM tb_gamelist WHERE provider = '$provCode' AND gameid = '$gameCode'");
            if (mysqli_num_rows($checkGame) == 0) {
                mysqli_query($koneksi, "INSERT INTO tb_gamelist (provider, image, gameid, gamename, category, gametypeid, platform, demogame, aspectratio, technology, jurisdictions, frbavailable, datatype, features, gameidnumeric, technologyid) 
                VALUES ('$provCode', '$banner', '$gameCode', '$gameName', 'slot', '1', 'html5', '0', '16:9', 'html5', '', '0', '', '', '', '')");
            } else {
                mysqli_query($koneksi, "UPDATE tb_gamelist SET gamename = '$gameName', image = '$banner' WHERE provider = '$provCode' AND gameid = '$gameCode'");
            }
        }
    } else {
        echo "Failed to fetch games for $provName\n";
    }
}

echo "Sync Complete!\n";
?>
