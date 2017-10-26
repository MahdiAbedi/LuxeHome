
          <?php $this->load->view('widgets/header');?>
            </header><!-- /.header-->
            <main class="main section-color-primary">
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
                <div class="container">
                    <section class="top-title">
                        <h1 class="h-side-title page-title page-title-big text-color-primary"><?php echo $home->title;?></h1> 
                    </section> <!-- /. content-header --> 
                    <div class="row">
                        <div class="col-md-9">
                            <div class="widget widget-box box-container widget-property">
                            <?php 
                                if(!empty($home->img_src))
                                 {$this->load->view('widgets/ads_detail_slider');}
                            ?>
                                <div class="widget-body">
                                    <div class="widget-header widget-title text-uppercase">
                                        <h2>توضیحات ملک</h2> 
                                    </div>
                                    <div class="widget-content wide-p">
                                        <p class='clearfix'>
                                            <img data-src="assets/img/3_bed_floor_plan.png"  class="pull-right-img" alt="" />
                                            <?php echo $home->description;?>
                                        <hr>
                                        <?php echo $key_words;?>
                                        </p>
                                    </div>
                                    <div class="widget"></div>
                                    <?php 
                                    $data['home_type']=$home->home_type;
                                    $data['deal_type']=$home->deal_type;
                                    $data['region_id']=$home->region_id;
                                    $data['limit_number']=12;
                                    $this->load->view('widgets/home_list',$data);?>
                                </div> 
                                
                            </div> <!-- /. widget-body --> 
                            <div class="widget widget-box box-container widget-overview visible-sm visible-xs">
                                <div class="widget-header text-uppercase">
                                    <h2>جزییات ملک</h2> 
                                </div>
                               <ul class="list-overview">
                                    <li class="custom-address">
                                        <span class="list-overview-option">آدرس:</span>
                                        <span class="list-overview-value" title="<?php echo $home->address;?>"><?php echo $home->address;?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">نوع ملک: </span>
                                        <span class="list-overview-value"><?php echo home_type_en_to_fa($home->home_type);?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">نوع معامله: </span>
                                        <span class="list-overview-value"><?php echo deal_type_en_to_fa($home->deal_type);?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">قیمت کل:   </span>
                                        <span class="list-overview-value"><?php echo $home->price;?></span>
                                    </li>
                                    <li class="custom-en">
                                        <span class="list-overview-option">شماره تماس: </span>
                                        <span class="list-overview-value"><a class="btn btn-success" href="tel:<?php echo $home->telphone;?>"><?php echo $home->telphone;?></a></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">امتیاز</span>
                                        <span class="list-overview-value">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div><!-- /. widget-OVERVIEW -->   
                        </div><!-- /.center-content -->
                        <div class="col-md-3">
                            <div class="widget widget-box box-container widget-overview hidden-sm  hidden-xs">
                                <div class="widget-header text-uppercase">
                                    <h2>جزییات ملک</h2> 
                                </div>
                                <ul class="list-overview">
                                    <li class="custom-address">
                                        <span class="list-overview-option">آدرس:</span>
                                        <span class="list-overview-value" title="Vatikanska 11, Zagreb"><?php echo $home->address;?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">هدف: </span>
                                        <span class="list-overview-value"><span class="label label-default label-tag-primary"><?php echo deal_type_en_to_fa($home->deal_type);?></span></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">نوع ملک: </span>
                                        <span class="list-overview-value"><?php echo home_type_en_to_fa($home->home_type);?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">نوع معامله: </span>
                                        <span class="list-overview-value"><?php echo deal_type_en_to_fa($home->deal_type);?></span>
                                    </li>
                                    
                                    <li>
                                        <span class="list-overview-option">قیمت کل:   </span>
                                        <span class="list-overview-value"><?php echo $home->price;?></span>
                                    </li>
                                    <li class="custom-en">
                                        <span class="list-overview-option">شماره تماس: </span>
                                        <span class="list-overview-value"><?php echo $home->telphone;?></span>
                                    </li>
                                    <li>
                                        <span class="list-overview-option">امتیاز</span>
                                        <span class="list-overview-value">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div><!-- /. widget-OVERVIEW -->                               
                            <?php if($home->user_id>0):?>     
                            <div class="widget widget-box box-container widget-agent">
                                <div class="media">
                                    <div class="agent-logo media-left media-middle">
                                        <a href="<?php echo base_url()."profile/".$user->id?>" class="img-circle-cover">
                                            <img data-src="assets/img/users_thumbs/<?php echo $user->id; ?>_0.jpg" alt="<?php echo $user->name; ?>" class="img-circle" />
                                        </a>
                                    </div>
                                    <div class="agent-details media-right media-top">
                                        <a href="<?php echo base_url()."profile/".$user->id?>" class="agent-name text-color-primary"><?php echo $user->name; ?></a>
                                        <span class="phone"><?php echo $user->telephone; ?></span>
                                        <a href="mailto:<?php echo $user->email; ?>" class="mail text-color-primary"><?php echo $user->email; ?></a>
                                        <a class="btn btn-success" href="<?php echo base_url()."profile/".$user->id?>">مشاهده پروفایل</a>
                                        <span class="list-overview-value">
                                            <?php for ($index = 0; $index < $user->special; $index++)
                                                {
                                                echo '<i class="icon-star"></i>';
                                                }
                                            ?>

                                        </span>
             
                                    </div>
                                </div><!-- /.agent-card--> 
                            </div><!-- /. widget-agent --> 
                            
                            <?php 
                            $data['user_name']=$user->name;
                            $this->load->view('widgets/send_msg_to_user',$data);?>
                            
                            <?php endif;?>
                            <div class="widget widget-ads-right">
                                <img data-src="assets/img/180x150.jpg" alt="" class="center-block" />
                            </div><!-- /.widget-ads--> 
                        </div>
                        <!-- /.right side bar -->
                    </div>
                </div>
            </main><!-- /.main-part--> 
           <?php $this->load->view('widgets/footer');?>
            
<?php if($home->user_id>0):?>
<script type="text/javascript">
            //added by mahdi abedi for creating captcha
        function create_captcha(){
            $.get("<?php echo base_url();?>captcha",'',function(data){
                $('#captcha').html(data);});
        }
        $(document).ready(function(){create_captcha();});
//########################<< AJAX SUBMIT CONTACT FORM WITH USERS >>########################
    $("#contact-form").submit(function(e) {
        var url = "<?php echo base_url().'msg_to_user/'.$user->id;?>"; // the script where you handle the form input.
        $.ajax({
               type: "POST",
               url: url,
               data: $("#contact-form").serialize(), // serializes the form's elements.
               success: function(data)
               {
                   alert(data); // show response from the php script.
               }
             });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
      </script>
<?php endif;?>
            