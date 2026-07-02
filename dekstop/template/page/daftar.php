<!-- Account Balance -->
<main id="main-route">
    <div class="main-content register post">
        <div class="container">
            <div class="row">
                <div class ="col-lg-12">
                    <div class="register__container">
                        <div class="page-header"><i class="fas fa-user-alt mr-2"></i>| Registration Form</div>
                        <form id="register-form" method="POST" action="function/daftar_akun.php" >

                            <div class="register-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="register__note">
                                            <div class="note__head">Note :</div>
                                            <div class="note__content">
                                                *Username must be between 6 and 15 characters using letters and numbers.<br>
                                                *Password must be between 8 and 25 characters.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="username_register">Username*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" name="username"
                                            id="username_register" minlength="6" maxlength="15"
                                            placeholder="Enter Username"
                                            required="">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="password">Password*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="password" name="password" id="password"
                                            minlength="8" maxlength="25" placeholder="Enter Password" required="">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="rePassword">Confirm Password*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="password" name="konfirmasi_pass"
                                            minlength="8" maxlength="25"
                                            placeholder="Confirm Password" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="register__notemail">
                                            <div class="note__content">
                                                *Please provide a valid email and mobile number for security updates and promotions.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="email">Email*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" value="" type="email" name="email"
                                            id="email" minlength="6" maxlength="50"
                                            placeholder="name@domain.com" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="bank">Payment Method / Bank*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="bank" id="bank" required="">
                                                <option value="">--- Select Payment Option ---</option>
                                                <optgroup label="Indian Payment Methods & Banks">
                                                    <option selected disabled="">-- Select Method --</option>
                                                    <option value="UPI">UPI</option>
                                                    <option value="PAYTM">PAYTM</option>
                                                    <option value="PHONEPE">PHONEPE</option>
                                                    <option value="GOOGLEPAY">GOOGLE PAY</option>
                                                    <option value="STATE BANK OF INDIA">STATE BANK OF INDIA (SBI)</option>
                                                    <option value="HDFC BANK">HDFC BANK</option>
                                                    <option value="ICICI BANK">ICICI BANK</option>
                                                    <option value="AXIS BANK">AXIS BANK</option>
                                                    <option value="PUNJAB NATIONAL BANK">PUNJAB NATIONAL BANK</option>
                                                    <option value="KOTAK MAHINDRA BANK">KOTAK MAHINDRA BANK</option>
                                                    <option value="BANK OF BARODA">BANK OF BARODA</option>
                                                    <option value="CANARA BANK">CANARA BANK</option>
                                                    <option value="INDUSIND BANK">INDUSIND BANK</option>
                                                </optgroup>
                                            </select>
                                            <span id="bank-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="phoneInput">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="phone">Mobile Number*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+91</span>
                                                </div>
                                                <input class="form-control" value="" type="text" name="no_whatsapp"
                                                id="phone" minlength="10" maxlength="20" placeholder="10-digit Mobile Number*" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="accountName">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="accName">Account Holder Name*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" value="" type="text" name="pemilik_rekening"
                                            id="accName" minlength="2" maxlength="100"
                                            placeholder="Name as per Account / UPI ID" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="accountNumber">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="accNumber">Account Number / UPI ID*</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" value="" type="text" name="norek"
                                            id="accNumber" minlength="5" maxlength="50"
                                            placeholder="Account Number or VPA (e.g. name@upi)" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="referral">Referral Code</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php
                                            $reff = isset($_GET['reff']) ? $_GET['reff'] : '';
                                            ?>
                                            <input class="form-control" type="text" name="refferal" readonly="" value="<?php echo $reff ?>" id="referral" minlength="4"
                                            maxlength="12" autocomplete="off">
                                            <span id="referral-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center justify-content-start">
                                            <label for="captcha">Captcha*</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="cap-img">
                                                <div class="cap-content">
                                                    <?php $captchaNumber = rand(100000, 999999); ?>
                                                    <div style="font-size: 24px; background-color: white; color: black; padding: 4px;"><?php echo $captchaNumber; ?></div>
                                                    <input type="hidden" name="captcha_asli" value="<?php echo $captchaNumber; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="cap-content">
                                                <input class="form-control input-code" type="number" name="captcha" id="captcha"
                                                placeholder="Enter Captcha" required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="term" class="register-terms">
                                                <span class="text-justify">I am at least 18 years of age, have read and agreed to the <a href="/help">Terms and Conditions</a> and privacy policies of this site.</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="submit" name="submit" value="Register" class="daftar btn-custom button-submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    
                </div>
            </main>