<?php $this->load->view('widgets/header');?>
<link rel="stylesheet" href="assets/css/fileinput.min.css" />
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
        <div id="wrapper" class="widget  widget-box box-container widget-form form-main">
            <div id="content" class="mob-max">
                <div class="rightContainer">
                    <h3>اطلاعات ملک خود را وارد نمایید.</h3>
                    <form enctype="multipart/form-data" role="form" class="form-additional" action="newhome" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label>عنوان</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>قیمت</label>
                                    <div class="input-group">
                                        
                                        <input class="form-control" name="price"  type="text" required>
                                        <div class="input-group-addon">تومان</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea class="form-control" rows="4" name="description"  required></textarea>
                        </div>
                        <div class="form-group">
                            <label>آدرس <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="address"  type="text" id="address" autocomplete="off" required>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>استان</label>
                                            <select required  id="ostan" name="city[]" class="form-control  ">
                                                <option value=''>انتخاب کنید</option>
                                            </select>                                                   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>شهر</label>
                                            <select id="shar" name="city[]" class="form-control">

                                            </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>ناحیه</label>
                                            <select id="mantage" name="city[]" class="form-control">

                                            </select>                                                   
                                    </div>
                                </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>نوع ملک</label>
                                    <select name="home-type" class="form-control" required>
                                        <option value="flat">آپارتمان</option>
                                        <option value="home">خانه و ویلا</option>
                                        <option value="land">زمین و گلنگی</option>
                                        <option value="office">دفتر کار،اتاق اداری و مطب</option>
                                        <option value="shop">مغازه و غرفه</option>
                                        <option value="farm">صنعتی،کشاورزی و تجاری</option>
                                        <option value="other">متفرقه</option>
                                     </select> 
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>نوع معامله</label>
                                    <select name="deal-type" class="form-control" required>
                                        <option value="sell">خرید و فروش</option>
                                        <option value="rent">رهن و اجاره</option>
                                        <option value="other">سایر موارد</option>
                                     </select> 
                                    
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>شماره تماس</label>
                                    <div class="input-group">
                                        
                                        <input class="form-control" name="contact"  type="text" required>
                                        <div class="input-group-addon">موبایل</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <label>عبارت امنیتی</label>
                                <div class="control-group">
                                    <label class="control-label captcha" id="captcha"></label>
                                    <div class="controls">
                                        <input class="captcha form-control" name="captcha" type="text" autocomplete="off" placeholder="کد داخل تصویر را وارد نمایید" value=""  required/>
                                    </div>
                                 </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>گالری تصاویری</label>
                                    <input type="file" name="image[]" multiple class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="ارسال تصاویر">
                                    <p class="help-block">شما میتوانید چندین تصویر را یکباره انتخاب و ارسال کنید.</p>
                                </div>
                            </div>
                        </div>
                        <?php $this->load->view('widgets/choose_ads_pay');?>
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg isThemeBtn">افزودن ملک</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main><!-- /.main-part--> 

<?php $this->load->view('widgets/footer');?>
<?php $this->load->view('widgets/city_search_js_script');?>
<script src="assets/js/fileinput.min.js"></script>
<script type="text/javascript" defer>
            //added by mahdi abedi for creating captcha
        function create_captcha(){
            $.get("<?php echo base_url();?>captcha",'',function(data){
                $('#captcha').html(data);
                $('#captcha1').html(data);
            });     
        }
        $(document).ready(function(){create_captcha();});
</script>