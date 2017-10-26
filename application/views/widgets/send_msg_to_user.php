<div class="widget widget-form" id="form">
    <form action="#" method="post" id="contact-form">
        <div class="box-container widget-body">
            <div class="widget-header text-uppercaser"><h2>ارسال پیام به <?php echo $user_name;?></h2></div>
            <div class="form-additional">
                <div class="form-group">
                    <input type="text" name='name' class="form-control" placeholder="نام و نام خانوادگی" />
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="شماره تماس" />
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="ایمیل"  />
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="پیام"  rows='3'></textarea>
                </div>
                <div class="form-group control-group control-group-captcha">

                    <div class="form-group" id="captcha"></div>
                    <div class="captcha-input-box">
                        <input class="form-control captcha" name="captcha" autocomplete="off" type="text" placeholder="کد امنیتی را وارد نمایید" value="" />
                    </div>
                </div>
                <div class="form-group form-group-submit">
                    <input type="submit" name='submit' class="btn btn-primary btn-wide color-primary btn-property" value="ارسال"  />
                </div>
            </div>
        </div>
    </form>
                            </div><!-- /.widget-form--> 
                            
                            <!--- create captcha--->
                            
                          