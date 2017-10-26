<?php $this->load->view('widgets/header');?>

<main class="main main-container section-color-primary ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget widget-box box-container widget-invoice">
                                <div class="widget-header text-uppercase">
                                    صورت حساب
                                </div>
                                <div class="">
                                    <header id="header">
                                        <div class="invoice-intro invoice-logo ">
                                            <a href="<?php echo base_url();?>">
                                                <img data-src="assets/img/logo.png" alt="مشاوران املاک خانه رویایی" />
                                            </a>
                                        </div>
                                        <dl class="invoice-meta">
                                            <dt class="invoice-number">کدپیگیری:</dt>
                                            <dd><?php echo $invoice_id;?></dd>
                                            <dt class="invoice-date">تاریخ</dt>
                                            <dd><?php echo date("Y/m/d");?></dd>
                                           
                                            <dt class="invoice-due">وضعیت پرداخت</dt>
                                            <dd>پرداخت نشده</dd>
                                        </dl>
                                    </header>
                                    <section id="parties" class=''>
                                        <div class="invoice-from">
                                            <h2 class="text-color-primary">صورت حساب صادر شده از طرف:</h2>
                                            <div id="hcard-Admiral-Valdore" class="vcard">
                                                <a class="url fn" >مشاوران املاک خانه رویایی</a>
                                                <a class="email" href="mailto:info@Royalstate.ir">Info@RoyalState.ir</a>
                                                
                                                <div class="tel">02166177804</div>
                                            </div>
                                        </div>
                                        <div class="invoice-to">
                                            <h2 class="text-color-primary">صورت حساب صادر شده برای:</h2>
                                            <div id="hcard-Hiram-Roth" class="vcard">
                                                <a class="url fn" href="#"><?php echo $title;?></a>
                                                <div class="tel"><?php echo $telphone;?></div>
                                            </div>
                                        </div>
                                    </section>
                                    <section >
                                        <h4 class="hidden">جدول توضحیات</h4>
                                        <div >
                                            <table>
                                                <caption>عنوان تبلیغ</caption>
                                                <thead>
                                                    <tr  class='text-right'>
                                                        <th>عنوان</th>
                                                        <th class="text-right">مدت زمان</th>
                                                        <th>هزینه</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($query as $result):?>
                                                    <?php $total_price+=$result->price;?>
                                                    <tr>
                                                        <td><?php echo $result->name;?></td>
                                                        <td><?php echo $result->days;?></td>
                                                        <td><?php echo $result->price;?></td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">هزینه تبلیغات به تومان میباشد.</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="invoice-totals">
                                            <div class="clearfix">
                                                <table>
                                                    <caption>مجموع:</caption>
                                                    <tbody>
                                                        <tr>
                                                            <th style="color: black;">هزینه تبلیغات:</th>
                                                            
                                                            <td><?php echo $total_price;?> تومان</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="color: black;">مالیات:</th>
                                                            
                                                            <td>0 تومان</td>
                                                        </tr>
                                                        <tr>
                                                            <th style="color: black;">هزینه کل:</th>
                                                           
                                                            <td class="text-color-primary"><?php echo $total_price;?> تومان</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="invoice-pay text-right">
                                                <form  name="myform" id='myform' Method='post' Action='https://pep.shaparak.ir/gateway.aspx'>
                                                     <input class="btn btn-success" type='submit' name='submit' id="submit" value='پرداخت ' />
                                                        <input type='hidden' name='invoiceNumber' value='<?= $invoice_id ?>' />
                                                        <input type='hidden' name='invoiceDate' value='<?= $bank['invoiceDate'] ?>' />
                                                        <input type='hidden' name='amount' value='<?= $total_price ?>' /><br />
                                                        <input type='hidden' name='terminalCode' value='<?= $bank['terminalCode'] ?>' />
                                                        <input type='hidden' name='merchantCode' value='<?= $bank['merchantCode'] ?>' />
                                                        <input type='hidden' name='redirectAddress' value='<?= $bank['redirectAddress'] ?>' />
                                                        <input type='hidden' name='timeStamp' value='<?= $bank['timeStamp'] ?>' />
                                                        <input type='hidden' name='action' value='<?= $bank['action'] ?>' />
                                                        <input type='hidden' name='sign' value='<?= $bank['result'] ?>' />
                                                    <div></div>
                                                   

                                                </form>
                                            </div>
                                        </div>
                                        <div class="invoice-notes">
                                            <p>
                                                * این صورت حساب صرفا برای پیگیری و پرداخت تبلیغات شما صادر شده است.
                                            </p>
                                        </div>
                                    </section>
                                </div>
                            </div><!-- /. widget-gallery -->       
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main><!-- /.main-part--> 
<?php $this->load->view('widgets/footer');?>

