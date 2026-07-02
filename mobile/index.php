<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

$id_login = $_SESSION['id'];
$extplayer = $_SESSION['extplayer'];
include '../main/API/functions.php'; 
include '../function/connect.php';

$query1 = mysqli_query($koneksi, "SELECT active FROM tb_saldo WHERE id_user = '$extplayer' ");
$liat = mysqli_fetch_array($query1);

$query2 = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id = '$id_login' ");
$punya_user = mysqli_fetch_array($query2);

$query3 = mysqli_query($koneksi, "SELECT * FROM tb_bank WHERE id_user = '$extplayer' ");
$bank_user = mysqli_fetch_array($query3);

$query3 = mysqli_query($koneksi, "SELECT * FROM tb_bank WHERE id_user = '$extplayer' ");
$b = mysqli_fetch_array($query3);

$query1010 = mysqli_query($koneksi, "SELECT * FROM tb_contact");
$ssa = mysqli_fetch_array($query1010);

$whatsapp = $ssa['no_whatsapp'];
$id_livechat = $ssa['id_livechat'];

$cuk = mysqli_query($koneksi, "SELECT * FROM tb_web");
$cek_web = mysqli_fetch_array($cuk);
$urlweb = $cek_web['url'];
$logo = $cek_web['logo'];
$warna = $cek_web['warna'];
$min_depo = $cek_web['min_depo'];
$min_wd = $cek_web['min_wd'];
$icon = $cek_web['icon_web'];
$title = $cek_web['title'];
$deskripsi = $cek_web['deskripsi'];
$keyword = $cek_web['keyword'];

$pisah = explode('|', $title);
$judul = trim($pisah[0]);

if ($punya_user['status'] == "Suspend") {
  session_start();
  session_destroy();
  header("Location:index.php?pesan=29");
}



?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
  <meta name="description" content="<?php echo $deskripsi ?>">
  <meta name="keywords" content="<?php echo $keyword ?>">
  <meta property="og:description" content="<?php echo $deskripsi ?>" />
  <meta property="og:image" content="<?php echo $urlweb ?>/assets/img/<?php echo $logo ?>">
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo $urlweb ?>">
  <meta name="robots" content="index, follow">
  <meta name="author" content="<?php echo $urlweb ?>">
  <meta name="theme-color" content="linear-gradient(to bottom, #ebf4f9 0%, #c3c0cc 100%)">
  <meta name="msapplication-TileColor" content="linear-gradient(to bottom, #ebf4f9 0%, #c3c0cc 100%)">
  <meta name="msapplication-navbutton-color" content="linear-gradient(to bottom, #ebf4f9 0%, #c3c0cc 100%)">
  <meta name="apple-mobile-web-app-status-bar-style" content="linear-gradient(to bottom, #ebf4f9 0%, #c3c0cc 100%)">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="https://images.linkcdn.cloud/V2/350/favicon/favicon-1815075327.png">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="googlebot-news" content="noindex">
  <!-- Canonical -->
  <link rel="canonical" href="<?php echo $urlweb ?>" />
  <!-- End Canonical -->
  <meta name="description" itemprop="description" content="<?php echo $deskripsi ?>" />
  <meta name="keywords" content="<?php echo $keyword ?>" />
  <title><?php echo $title; ?></title>
  <!-- Custom Tags -->
  <meta name="robots" content="index, follow" />
  <meta name="copyright" content="lexusmpo">
  <meta name="rating" content="general" />
  <meta name="geo.placename" content="Indonesia" />
  <meta name="geo.country" content="ID" />
  <meta name="language" content="ID" />
  <meta name="tgn.nation" content="Indonesia" />
  <meta name="rating" content="general" />
  <meta name="author" content="lexusmpo" />
  <!-- End Custom Tags -->
  <link rel="preload" as="font" href="themes/default/font/font-awesome/webfonts/fa-solid-900.woff2" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" as="font" href="themes/default/font/font-awesome/webfonts/fa-brands-400.woff2" type="font/woff2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="themes/default/css/global.css">
  <link rel="stylesheet" type="text/css" href="themes/default/font/font-awesome/css/all.min.css">
  <?php
  if ($warna == "abu-hitam") {
  ?>
    <link rel="stylesheet" id="templateStyle" type="text/css" href="abu-hitam/custom/css/style.css">
  <?php
  } else if ($warna == "merah-kuning") {
  ?>
    <link rel="stylesheet" id="templateStyle" type="text/css" href="merah-kuning/custom/css/style.css">
  <?php
  } else if ($warna == "biru-kuning") {
  ?>
    <link rel="stylesheet" id="templateStyle" type="text/css" href="biru-kuning/custom/css/style.css">
  <?php
  }
  ?>


  <link rel="stylesheet" type="text/css" href="themes/default/sass/custom.css">
</head>

<body>

  <header class="header">
    <div class="header__mid">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 d-flex align-items-center">
            <div class="header-logo">
              <a href="?page=home">
                <h1 style="color: #fff; font-weight: 900; font-style: italic; font-size: 36px; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.7); letter-spacing: 2px; font-family: 'Arial Black', sans-serif;">CASHINO</h1>
              </a>
            </div>
          </div>

          <div class="col-lg-9">
            <br>
            <div class="header-form">
              <?php
              if ($id_login == "") {
              ?>
                <a href="?page=daftar" class="button-login">Register</a>
                <button data-target="slide-out" class="btn-daftar sidenav-toggle btn-sm"><i class="fas fa-bars"></i></button>
              <?php
              } else {
              ?>
                <div class="mobile-button--transaksi" href="#" data-toggle="modal" data-target="#accountBalance">
                  <a class="wallet-amount" id="wallet-amount"><i class="fas fa-coins m-auto"></i> INR <span name="mainBalance">₹<?php echo format_indian_currency($liat['active']); ?></span></a>
                </div>
                <button data-target="slide-out" class="btn-daftar sidenav-toggle btn-sm"><i class="fas fa-bars"></i></button>
              <?php
              }

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="header-mobile">
    <div class="header-mobile__top">
      <div class="mobile-logo">
        <a href="?page=home">
          <h2 style="color: #fff; font-weight: 900; font-style: italic; font-size: 24px; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.7); letter-spacing: 1px; font-family: 'Arial Black', sans-serif;">CASHINO</h2>
        </a>
      </div>
      <div class="mobile-button">
        <?php
        if ($id_login == true) {
        ?>
          <div class="mobile-button--transaksi" href="#" data-toggle="modal" data-target="#accountBalance">
            <i class="fas fa-coins m-auto"></i> INR
            <a class="wallet-amount" id="wallet-amount"><span name="mainBalance">₹<?php echo format_indian_currency($liat['active']); ?></span></a>
          </div>
          <div data-target="slide-out" class="mobile-button--menu sidenav-toggle">
            <i class="fas fa-bars"></i>
          </div>
        <?php
        } else {
        ?>
          <a class="mobile-button--register" href="?page=daftar">Register</a>
          <div data-target="slide-out" class="mobile-button--menu sidenav-toggle">
            <i class="fas fa-bars"></i>
          </div>
        <?php
        }

        ?>


      </div>

    </div>
    <div class="header-mobile__marquee">
      <i class="fas fa-bullhorn"></i>
      <marquee class="marquee"><?php echo $title; ?></marquee>
      <a href="" style="line-height: 0;"><img class="pr-2" src="" alt="Event" width="85px"></a>
    </div>
  </div>


  <div id="overlay"></div>

  <?php include 'template/sidenav.php'; ?>


  <?php
  if ($_GET['page'] == "home") {
    include 'template/page/home.php';
  } else if ($_GET['page'] == "promosi") {
    include 'template/page/promosi.php';
  } else if ($_GET['page'] == "daftar") {
    include 'template/page/daftar.php';
  } else if ($_GET['page'] == "popular") {
    include 'template/page/popular.php';
  } else if ($_GET['page'] == "slot") {
    include 'template/page/slot.php';
  } else if ($_GET['page'] == "livegame") {
    include 'template/page/livegame.php';
  } else if ($_GET['page'] == "casino") {
    include 'template/page/casino.php';
  } else if ($_GET['page'] == "sport") {
    include 'template/page/sport.php';
  } else if ($_GET['page'] == "lottery") {
    include 'template/page/lottery.php';
  } else if ($_GET['page'] == "poker") {
    include 'template/page/poker.php';
  } else if ($_GET['page'] == "arcade") {
    include 'template/page/arcade.php';
  } else if ($_GET['page'] == "contact") {
    include 'template/page/contact.php';
  } else if ($_GET['page'] == "transaksi") {
    include 'template/page/transaksi.php';
  } else if ($_GET['page'] == "refferal") {
    include 'template/page/refferal.php';
  } else if ($_GET['page'] == "profile") {
    include 'template/page/profil.php';
  } else if ($_GET['page'] == "slot_pragmatic") {
    include 'template/page/menu_game/slot/pragmaticPlay.php';
  } else if ($_GET['page'] == "slot_evoplay") {
    include 'template/page/menu_game/slot/evoplay.php';
  } else if ($_GET['page'] == "slot_habanero") {
    include 'template/page/menu_game/slot/habanero.php';
  }else if ($_GET['page'] == "slot_playson") {
    include 'template/page/menu_game/slot/playson.php';
  } else if ($_GET['page'] == "slot_booongo") {
    include 'template/page/menu_game/slot/booongo.php';
  } else if ($_GET['page'] == "slot_pgsoft") {
    include 'template/page/menu_game/slot/pgsoft.php';
  } else if ($_GET['page'] == "slot_playngo") {
    include 'template/page/menu_game/slot/playngo.php';
  } else if ($_GET['page'] == "slot_cq9") {
    include 'template/page/menu_game/slot/cq9.php';
  } else if ($_GET['page'] == "slot_toptrend") {
    include 'template/page/menu_game/slot/toptrend.php';
  } else if ($_GET['page'] == "slot_dreamtech") {
    include 'template/page/menu_game/slot/dreamtech.php';
  } else if ($_GET['page'] == "slot_reelkingdom") {
    include 'template/page/menu_game/slot/reelkingdom.php';
  } else if ($_GET['page'] == "slot_novomatic") {
    include 'template/page/menu_game/slot/novomatic.php';
  } else if ($_GET['page'] == "slot_apollo") {
    include 'template/page/menu_game/slot/apollo.php';
  }else if ($_GET['page'] == "slot_amatic") {
    include 'template/page/menu_game/slot/amatic.php';
  }else if ($_GET['page'] == "slot_kajot") {
    include 'template/page/menu_game/slot/kajot.php';
  }else if ($_GET['page'] == "slot_ainsworth") {
    include 'template/page/menu_game/slot/ainsworth.php';
  }else if ($_GET['page'] == "slot_quickspin") {
    include 'template/page/menu_game/slot/quickspin.php';
  }else if ($_GET['page'] == "slot_netent") {
    include 'template/page/menu_game/slot/netent.php';
  }else if ($_GET['page'] == "slot_igt") {
    include 'template/page/menu_game/slot/igt.php';
  }else if ($_GET['page'] == "slot_aristocrat") {
    include 'template/page/menu_game/slot/aristocrat.php';
  }else if ($_GET['page'] == "slot_igrosoft") {
    include 'template/page/menu_game/slot/igrosoft.php';
  }else if ($_GET['page'] == "slot_apex") {
    include 'template/page/menu_game/slot/apex.php';
  }else if ($_GET['page'] == "slot_merkur") {
    include 'template/page/menu_game/slot/merkur.php';
  }else if ($_GET['page'] == "slot_egt") {
    include 'template/page/menu_game/slot/egt.php';
  }



  else if ($_GET['page'] == "casino_pragmatic") {
    include 'template/page/menu_game/casino/pragmatic_play.php';
  } 
  else if ($_GET['page'] == "casino_evolution") {
    include 'template/page/menu_game/casino/evolution.php';
  } 
  else if ($_GET['page'] == "casino_ezugi") {
    include 'template/page/menu_game/casino/ezugi.php';
  } 


  else if ($_GET['page'] == "poker_amatic") {
    include 'template/page/menu_game/poker/amatic.php';
  } 

  else if ($_GET['page'] == "arcade_fishing") {
    include 'template/page/menu_game/arcade/arcade_fishing.php';
  } else if ($_GET['page'] == "detail_promo") {
    include 'template/page/menu_promosi/detail.php';
  } else {
    include 'template/page/home.php';
  }
  ?>
  <div class="footer-mobile">
    <a class="footer-item active" href="?page=home">
      <div class="footer-icon"><i class="fas fa-home"></i></div>
      <div class="footer-title">Home</div>
    </a>
    <?php
    if ($id_login == false) {
    ?>
      <a class="footer-item" href="../rtp.php">
        <div class="footer-icon"><i class="fab fa-android"></i></div>
        <div class="footer-title">RTP</div>
      </a>
    <?php
    } else {
    ?>
      <a class="footer-item" href="?page=transaksi">
        <div class="footer-icon"><i class="fas fa-credit-card"></i></div>
        <div class="footer-title">Deposit</div>
      </a>
    <?php
    }
    ?>
    <?php
    if ($id_login == false) {
    ?>
      <a class="footer-item footer-login" href="#" data-toggle="modal" data-target="#loginModal">
        <div class="footer-icon"><i class="fas fa-user-alt"></i></div>
        <div class="footer-title">Masuk</div>
      </a>
    <?php
    } else {
    ?>
      <a class="footer-item footer-login" href="?page=slot">
        <div class="footer-icon"><i class="fas fa-user-alt"></i></div>
        <div class="footer-title">Permainan</div>
      </a>
    <?php
    }
    ?>
    <a class="footer-item " href="?page=promosi">
      <div class="footer-icon"><i class="fas fa-tags"></i> <i class="fas fa-percent"></i></div>
      <div class="footer-title">Promosi</div>
    </a>
    <a class="footer-item" target="_blank" rel="noreferrer" href="https://direct.lc.chat/<?php echo $id_livechat ?>//">
      <div class="footer-icon"><i class="fas fa-comments"></i></div>
      <div class="footer-title">Live Chat</div>
    </a>
  </div>
  <!-- Modal -->
  <div class="modal fade custom-popup" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Formulir Login</h5>
        </div>

        <div class="modal-body">
          <div class="modal-body-form">
            <form name="login-form" action="function/cek_login.php" method="POST">
              <div class="form-item">
                <div class="item-title">Nama Pengguna*</div>
                <input value="" minlength="1" maxlength="25" name="username" type="text" placeholder="Nama Pengguna*" autocomplete="off" required>
              </div>
              <div class="form-item">
                <div class="item-title">Kata Sandi*</div>
                <input value="" minlength="5" maxlength="50" name="password" type="password" placeholder="Kata Sandi*" autocomplete="off" required>
              </div>
              <div class="form-button">
                <button name="submit" type="submit" class="button-login">Masuk</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Account Balance -->
  <div class="modal custom-popup fade" id="accountBalance" tabindex="-1" aria-labelledby="accountBalanceLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <div class="modal-body">
          <div class="popup-account-balance">
            <div class="balance-header">
              <h6>DOMPET</h6>
              <div class="acc-balance"><span name="mainBalance"></span></div>
            </div>
            <div class="balance-category d-flex align-items-center">
              <div class="category-name m-0">DOMPET UTAMA</div>
              <div class="acc-balance ml-auto"><span id="balance-common-total"><?php echo number_format($liat['active'], 2, ',', '.'); ?></span></div>
            </div>


          </div>
          <div class="balance-button">
            <a href="?page=transaksi" id="depositModal" type="button" class="btn-custom">Tambah Dana</a>
            <a href="?page=transaksi" id="withdrawModal" type="button" class="btn-custom">Tarik Dana</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  </div>

  </div>


  <div style="position: fixed; bottom: 150px; left: 15px; z-index: 10; opacity: 0.98;"><a href="../rtp.php" rel="noopener" target="_blank"><img alt="rtp slot hari ini" class="wabutton" src="../assets/img/rtpslot.gif" style="height:70px; width:70px" title="Rtp Slot Hari Ini" /></a></div>

  <div style="position: fixed; bottom: 70px; left: 15px; z-index: 10; opacity: 0.98;"><a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp ?>&text=Hallo." rel="noopener" target="_blank"><img alt="rtp slot hari ini" class="wabutton" src="../assets/img/img/wa.gif" style="height:70px; width:70px" title="Rtp Slot Hari Ini" /></a></div>



  <script src="themes/default/js/vendor.js"></script>
  <script src="themes/default/js/global.js"></script>

  <script src="themes/default/js/index.js"></script>

  <script src="themes/default/vendor/jquery-validate/jquery.validate.min.js"></script>
  <script>
    autoTarik();
    function autoTarik() {
      var username = '<?= $_SESSION["username"] ?>';
      $.ajax({
        url: 'function/getBalances.php',
        data: {
          username
        },
        type: "POST",
        success: function(data) {}
      })
    }

    function tarikSaldo() {
      var username = '<?= $_SESSION["username"] ?>';
      $.ajax({
        url: '../main/API/pullBalance.php',
        data: {
          username
        },
        type: "POST",
        success: function(data) {
          Swal.fire({
            icon: 'success',
            title: 'Saldo berhasil ditarik',
            text: 'Saldo Anda telah berhasil ditarik.',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Tutup',
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(true);
            }
          });
        },
        error: function(xhr, status, error) {
          console.error("Error:", error);
          Swal.fire({
            icon: 'error',
            title: 'Saldo gagal ditarik',
            text: 'Penarikan saldo anda gagal.',
            timerProgressBar: true,
            timer: 5000,
          });
        }
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      $(this).scrollTop(0);

      $('#homePopup').modal('hide');


    });

    function handler(e) {
      e.stopPropagation();
      e.preventDefault();
    }
  </script>
  <script>
    window.showError = (title, message) => {
      return Swal.fire({
        icon: 'info',
        title: title,
        html: message,
        timerProgressBar: true,
        timer: 5000,
      });
    }

    $(".game-search>.form-control-sm").on("focus", function() {
      if ($(this).val().length == 0) {
        $(".game-search").width('100%');
        $(".form-control-sm").width('100%');
      }
    })

    $(".game-search>.form-control-sm").on("focusout", function() {
      if ($(this).val().length == 0) {
        $(".game-search").width('');
        $(".form-control-sm").width('');
      }
    })


    function gameAlert() {
      return Swal.fire({
        icon: 'info',
        title: "Warning",
        html: "Please login to play!",
        timerProgressBar: true,
        timer: 5000,
      });
    }

    function gamemaintenance() {
      return Swal.fire({
        icon: 'info',
        title: "Warning",
        html: "This provider is currently under maintenance!",
        timerProgressBar: true,
        timer: 5000,
      });
    }
  </script>

  <?php
  // TODO: Replace Indonesian image text with English assets
  if (!empty($_GET['pesan'])) {
    if ($_GET['pesan'] == 1) {
  ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Email is already in use. Please try another email.'
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 2) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Incorrect CAPTCHA. Please check the CAPTCHA you entered.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 3) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Your account has been successfully created.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 4) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Password and confirm password must match.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 5) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Account registration failed.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 6) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Your account has been suspended by admin.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 7) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Your username and password are incorrect.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 8) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'You have successfully logged out',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 9) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Deposit successful. Please contact admin for confirmation.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 10) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to upload image.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 11) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'File size is too large.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 12) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Image extension must be JPG or PNG.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 13) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'You still have a pending deposit process.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 14) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Sorry, this promotion is only valid for new members.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 15) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Sorry, deposit amount does not meet the bonus requirements.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 16) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'Minimum deposit is <?php echo $min_depo; ?>',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 17) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'Sorry, you have not reached the required turnover target. Please play more to complete your turnover requirement.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 18) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Your balance is insufficient to process a withdrawal.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 19) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'Minimum withdrawal is <?php echo $min_wd; ?>',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 20) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Withdrawal successful. Please contact admin for confirmation.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 21) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'You still have a pending withdrawal process.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 22) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'Please contact admin immediately.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 23) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'You must login first.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 24) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Password change failed.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 25) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Your old password is incorrect.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 26) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'New password and confirmation password must match.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }
    if ($_GET['pesan'] == 27) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Your password has been changed successfully.',
          timerProgressBar: true,
          timer: 5000,
        });
      </script>
    <?php
    }

    if ($_GET['pesan'] == 28) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'info',
          title: 'Warning',
          text: 'Please login to play.'
        });
      </script>
    <?php
    }


    if ($_GET['pesan'] == 29) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Sorry, your account has been suspended by admin.'
        });
      </script>
    <?php
    }


    if ($_GET['pesan'] == 30) {
    ?>
      <script type="text/javascript">
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Username is already taken. Please choose another username.'
        });
      </script>
  <?php
    }
  }


  ?>


  ?>
</body>

</html>