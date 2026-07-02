<main id="main-route">
    <div class="main-content transaksi">
       <div class="container">
          <ul class="component-tabs nav nav-tabs" id="transactionTabs">
             <li class="nav-item">
                <a class="button-pills nav-link active" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit"
                role="tab" aria-controls="nav-deposit" aria-expanded="false">
                <i class="fas fa-wallet"></i>
                <span>Deposit</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="button-pills nav-link" id="nav-withdraw-tab" data-toggle="tab" href="#nav-withdraw" role="tab"
            aria-controls="nav-withdraw" aria-expanded="false">
            <i class="fas fa-coins"></i>
            <span>Withdraw</span>
        </a>
    </li>

</ul>
<div class="component-tab-content tab-content" id="pills-tabContent">
 <div class="tab-pane fade show active" id="nav-deposit" role="tabpanel" aria-labelledby="nav-deposit-tab">
    <div class="transaksi-grid">
       <div class="transaksi-payment">
        <?php
        $bank_online = mysqli_query($koneksi, "SELECT * FROM tb_bank WHERE level = 'admin' ");
        while ($dambe = mysqli_fetch_array($bank_online)) {
            ?>
            <div class="payment-item">
                <div class="payment-status online">ONLINE</div>
                <div class="payment-body">
                    <div class="payment-icon">
                        <img src="../uploads/bank/<?php echo $dambe['icon'] ?>" alt="<?php echo $dambe['nama_bank'] ?>">
                    </div>
                    <div class="payment-content">
                        <div class="title"><?php echo $dambe['nama_bank']; ?></div>
                        <div class="desc"></div>
                        <div class="desc">Min Deposit ₹<?php echo format_indian_currency($min_depo); ?></div>
                        <div class="desc"></div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>
    <div class="transaksi-form">
      <form id="formDeposit" enctype="multipart/form-data" method="post" action="function/deposit.php">
        <div class="transaksi-formulir flip-card">
            <div class="flip-front">
                <div class="formulir-title"><i class="fas fa-wallet"></i> | Deposit Form</div>
                <div class="formulir-form">
                    <div class="row mb-3">
                        <div class="col-lg-12 d-flex flex-row">
                            <label class="note_addbank">Always ensure sender details match registered info. Supported options include UPI, Paytm, PhonePe, Google Pay, and Bank Transfer.</label>
                        </div>
                    </div>
                    <div class="text-white" style="background: #000; color: #fff; padding: 20px 10px;">
                        <p>Main Wallet</p>
                        <h5 class="text-warning">INR ₹<?php echo format_indian_currency($liat['active']); ?></h5>    

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Account Details</label>
                            </div>
                            <div class="col-lg-6">
                                <span><?php echo $b['nama_bank']; ?> - <?php echo $b['nomor_rekening']; ?> - A.n (<?php echo $b['nama_pemilik']; ?>)</span>
                                <input type="hidden" name="dari_bank" value="<?php echo $b['id'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Deposit Amount (INR)</label>
                            </div>
                            <div class="col-lg-6">
                                <input name="nominal" required="" id="depositAmount" class="form-control" type="number" placeholder="500">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">

                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Payment Option</label>
                            </div>
                            <div class="col-lg-6">
                                <select  id="bankSelect" name="metode">
                                    <option value="" selected="" disabled="">--- Select Payment Option ---</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM tb_bank WHERE level = 'admin'");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_bank = $data['id'];
                                        $nama_bank = $data['nama_bank'];
                                        ?>
                                        <option value="<?php echo $id_bank; ?>"><?php echo $nama_bank; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Select Promotion</label>
                            </div>
                            <div class="col-lg-6">
                                <select name="bonus">
                                    <option value="tanpabonus">No Promotion</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM tb_bonus");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_bonus = $data['id'];
                                        $nama_bonus = $data['nama_bonus'];
                                        ?>
                                        <option value="<?php echo $id_bonus; ?>"><?php echo $nama_bonus; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Payment Proof (Optional)</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="file" class="form-control-file" name="bukti_transfer">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Notes</label>
                            </div>
                            <div class="col-lg-6">
                                <textarea name="keterangan" class="form-control" placeholder="Optional notes..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">

                            </div>
                            <div class="col-lg-6">
                             <button type="submit" name="submit" class="btn-custom button-submit">Submit Deposit</button>

                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </form>
</div>
</div>
</div>

<div class="tab-pane fade" id="nav-withdraw" role="tabpanel" aria-labelledby="nav-withdraw-tab">
    <div class="transaksi-grid">
       <div class="transaksi-payment">

    </div>
    <div class="transaksi-form">
      <form id="formWithdraw" method="post" action="function/withdraw.php">
        <div class="transaksi-formulir flip-card">
            <div class="flip-front">
                <div class="formulir-title"><i class="fas fa-coins"></i> | Withdrawal Form</div>
                <div class="formulir-form">
                    <div class="row mb-3">
                        <div class="col-lg-12 d-flex flex-row">
                            <label class="note_addbank">Withdrawals are processed directly to your registered Bank Account or UPI VPA.</label>
                        </div>
                    </div>
                    <div class="text-white" style="background: #000; color: #fff; padding: 20px 10px;">
                        <p>Main Wallet</p>
                        <h5 class="text-warning">INR ₹<?php echo format_indian_currency($liat['active']); ?></h5>    

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Account Details</label>
                            </div>
                            <div class="col-lg-6">
                                <span><?php echo $b['nama_bank']; ?> - <?php echo $b['nomor_rekening']; ?> - A.n (<?php echo $b['nama_pemilik']; ?>)</span>
                                <input type="hidden" name="dari_bank" value="<?php echo $b['id'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Withdrawal Amount (INR)</label>
                            </div>
                            <div class="col-lg-6">
                                <input name="nominal" required="" id="withdrawAmount" class="form-control" type="number" placeholder="500">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">

                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">
                                <label>Destination Account</label>
                            </div>
                            <div class="col-lg-6">
                                <select  id="bankSelect" name="metode">
                                    <option value="<?php echo $b['id']; ?>"><?php echo $b['nama_bank']; ?> - <?php echo $b['nomor_rekening']; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="row">
                            <div class="col-lg-3 d-flex align-items-center">

                            </div>
                            <div class="col-lg-6">
                             <button type="submit" name="submit" class="btn-custom button-submit">Submit Withdrawal</button>

                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </form>
</div>
</div>
</div>

</div>
</div>
</div>
</main>