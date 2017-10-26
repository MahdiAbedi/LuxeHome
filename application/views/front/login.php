<?php $this->load->view('widgets/header');?>
<main class="main section-color-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="widget">
                            </div> <!-- /. widget-AVAILABLE PACKAGES --> 
                            
                            <!-- Errors container -->
                                <?php  if (isset($_SESSION['error'])) :?>
                                    <div class="row">			
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">
                                                        <span aria-hidden="true">×</span>
                                                        <span class="sr-only">بستن</span>
                                                </button>

                                                <strong>هشدار!</strong></br>  
                                                <?php echo $_SESSION['error'];?>

                                            </div>
                                        </div>


                                    </div>
                                <?php endif;?>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="widget  widget-box box-container widget-form form-main" id="form">
                                        <div class="widget-header">
                                            <h2>ورود به سایت</h2>
                                        </div>
                                        <form action="login-user" method="post" class="form-additional"> 
                                            <div class="control-group">
                                                <label class="control-label" for="inputUsername2">ایمیل</label>
                                                <div class="controls">
                                                    <input type="text" name="username" value="" class="form-control" id="inputUsername2"  />                      
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword1">رمز عبور</label>
                                                <div class="controls">
                                                    <input type="password" name="password" value="" class="form-control" id="inputPassword1" />                      
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label captcha" id="captcha"></label>
                                                <div class="controls">
                                                    <input class="captcha form-control" name="captcha" type="text" autocomplete="off" placeholder="کد داخل تصویر را وارد نمایید" value="" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-danger">ورود</button>
                                                    <a href="#"><em>رمز خود را فراموش کرده اید؟</em></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.widget-form--> 
                                </div> 
                                <div class="col-lg-6">
                                    <div class="widget  widget-box box-container widget-form form-main" id="form2">
                                        <div class="widget-header">
                                            <h2>ثبت نام در سایت</h2>
                                        </div>
                                        <form action="register_user" method="post" class="form-additional" enctype="multipart/form-data" >                                                 
                                            <div class="control-group">
                                                <label class="control-label">نام و نام خانوادگی</label>
                                                <div class="controls">
                                                    <input type="text" name="name" value="" class="form-control" id="inputNameSurname" />                                  
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label">ایمیل</label>
                                                <div class="controls">
                                                    <input type="text" name="email" value="" class="form-control" id="inputMail" />                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="inputPassword2">رمز عبور</label>
                                                <div class="controls">
                                                    <input type="text" name="password" value="" class="form-control" id="inputPassword2" autocomplete="off" />                                  
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <label class="control-label">درباره خودتان</label>
                                                <div class="controls">
                                                    <textarea name="description" cols="40" rows="3" class="form-control"></textarea>                                  
                                                </div>
                                            </div>          

                                            <div class="control-group">
                                                <label class="control-label">شماره تماس</label>
                                                <div class="controls">
                                                    <input type="text" name="contact" value="" class="form-control" id="inputPhone" />                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">استان</label>
                                                <div class="controls">
                                                    <select id="ostan" name="city[]" class="form-control "></select>                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">شهر</label>
                                                <div class="controls">
                                                    <select id="shar" name="city[]" class="form-control "></select>                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">ناحیه</label>
                                                <div class="controls">
                                                    <select id="mantage" name="city[]" class="form-control "></select>                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">تصویر پروفایل</label>
                                                <div class="controls">
                                                   <input name="image[]" type="file" class="form-control" multiple accept="image/*">                                  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label captcha" id="captcha1"></label>
                                                <div class="controls">
                                                    <input class="captcha form-control" name="captcha" type="text" autocomplete="off" placeholder="کد داخل تصویر را وارد نمایید" value="" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-danger">ثبت نام</button>
                       
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.widget-form--> 
                                </div>
                            </div>
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main><!-- /.main-part--> 
<?php $this->load->view('widgets/footer');?>
<?php $this->load->view('widgets/city_search_js_script');?>
<script type="text/javascript">
            //added by mahdi abedi for creating captcha
        function create_captcha(){
            $.get("<?php echo base_url();?>captcha",'',function(data){
                $('#captcha').html(data);
                $('#captcha1').html(data);
            });     
        }
        $(document).ready(function(){create_captcha();});
</script>