<div class="sidenav">
    <div class="sidenav__header">
        <div class="sidenav__header-user">
            <span>Welcome <?php echo isset($punya_user['nama_lengkap']) ? $punya_user['nama_lengkap'] : ''; ?></span>
        </div>
        <div class="sidenav__header-user-logo">
            <center>
                <img src="../assets/img/<?php echo $logo ?>"
                alt="WebsiteLogo" width="180">
            </center>
        </div>
        <?php
        if ($id_login == false) {
            ?>
            <div class="sidenav__header-button">
                <div class="sidenav-button-title">Please Login or Register</div>
                <div class="sidenav-button">
                    <button class="btn-login sidenav-login" type="button" data-toggle="modal"
                    data-target="#loginModal">Login</button>
                    <button class="btn-register"
                    onclick="window.location.href = '?page=daftar'">Register</button>
                </div>
                <div class="sidenav-password">
                    <a class="" href="#">Forgot Password?</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="sidenav__list">
        <ul>
            <a href="?page=home">
                <li class="active">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </li>
            </a>
            <?php
            if ($id_login == true) {
                ?>
                <a href="?page=transaksi">
                    <li class="">
                        <i class="fas fa-credit-card"></i>
                        <span>Transactions</span>
                    </li>
                </a>
                <a href="?page=profile">
                    <li class="">
                        <i class="fas fa-user-circle"></i>
                        <span>My Account</span>
                    </li>
                </a>
                <a href="?page=refferal">
                    <li class="">
                        <i class="fas fa-users"></i>
                        <span>Referral</span>
                    </li>
                </a>
                <?php
            }
            ?>

            <a href="?page=promosi">
                <li class="">
                    <i class="fas fa-percentage"></i>
                    <span>Promotions</span>
                </li>
            </a>
            
            <?php
            if ($id_login == true) {
                ?>
                <a href="function/logout.php">
                    <li>
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </li>
                </a>
                <?php
            }
            ?>
            

            <?php
            if ($id_login == false) {
                ?>
                <a href="">
                    <li>
                        <i class="fas fa-download"></i>
                        <span>Download App</span>
                    </li>
                </a>
                <a href="?page=contact">
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>Contact Us</span>
                    </li>
                </a>
                <?php
            }
            ?>
        </ul>
    </div>


    <div id="header-currency" class="header-flag">
        <span>INR (Rupee)</span>
        <i class="fas fa-caret-down"></i>

        <div id="currency-dropdown" class="flag-dropdown">
            <a href="<?php echo $urlweb ?>">
                <div class="flag-item">
                    <span>INR (Rupee)</span>
                </div>
            </a>
        </div>
    </div>
    <div id="header-lang" class="header-flag">
        <img src="https://flagcdn.com/w20/in.png" width="20" height="14" alt="in">
        <i class="fas fa-caret-down"></i>

        <div id="lang-dropdown" class="flag-dropdown">
            <a href="javascript:;" data-locale="en-IN" name="locale-switch">
                <div class="flag-item">
                    <img src="https://flagcdn.com/w20/in.png" alt="in">
                    <span>India (English)</span>
                </div>
            </a>
        </div>
    </div>
</div>