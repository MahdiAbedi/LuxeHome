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
                                    <section id="parties">
                                        
                                        <div class="alert alert-success">
                                            <strong>Success!</strong> Indicates a successful or positive action.
                                          </div>                      
                                    </section>
                                   
                                </div>
                            </div><!-- /. widget-gallery -->       
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main><!-- /.main-part--> 
<?php $this->load->view('widgets/footer');?>

