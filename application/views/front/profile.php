<?php $this->load->view('widgets/header'); ?>
 <?php
    $this->db->where('id',$user_id);
    $this->db->limit(1);
    $user=$this->db->get('users')->row();
?>
<div class="top-box-mask"></div>
                <section class="top-title-widget color-primary">
                    <div class="container">
                        
                        <h1 class="top-title-t">مشاهده پروفایل <?php echo $user->name;?></h1> 
                    </div>
                </section><!-- /.top-title-->
<main class="main main-container section-color-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                           
                            <section class="widget widget-blog-listing widget-overflow widget-ask">
                                <div class="box-overflow-container box-container">
                                    <div class="box-container-title">
                                        <h2 class="title"><?php echo $user->name;?></h2> 
                                    </div> <!-- /. content-header --> 
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="agent-detail-picture">
                                                    <img data-src="assets/img/users_thumbs/<?php echo $user->id;?>_0.jpg" alt="" class="img-responsive" />
                                                </div><!-- /.agent-detail-picture -->
                                            </div>
                                            <div class="col-sm-9">
                                                <p>
                                                    <?php echo $user->about;?>
                                                </p>
                                                <div class="agent">
                                                    <div class="phone text-color-primary"><a href="tel:<?php echo $user->telephone;?>" class="primary-hover"><?php echo $user->telephone;?></a></div>
                                                    <div class="mail"><a href="mailto:<?php echo $user->email;?>" class="primary-hover"><?php echo $user->email;?></a></div>
                                                </div>
                                                <ul class="clearfix sharing-buttons">
                                                    <li>
                                                        <a class="facebook" href="#" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                                            <i class="fa fa-facebook fa-left no-margin"></i></a>
                                                    </li>
                                                    <li>
                                                        <a class="google-plus" href="#" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                                            <i class="fa fa-google-plus fa-left no-margin"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="twitter" href=".#" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                                            <i class="fa fa-twitter fa-left no-margin"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- /.row -->
                                    </div>
                                </div>
                            </section>
                            
                            
                            <div class="widget widget-profilelisting">
                                <div class="widget-body">
                                    <div class="widget-header text-uppercase">
                                        <h2>املاک ثبت شده توسط <?php echo $user->name;?></h2>
                                    </div>
                                </div>
                               <?php 
                               $data['user_id']=$user->id;
                               $this->load->view('widgets/home_list',$data); ?>
                            </div>  <!-- /. widget-properties -->    
                        </div><!-- /.center-content -->
                        <div class="col-md-3">
                           <?php 
                           $data['user_name']=$user->name; 
                           $this->load->view('widgets/send_msg_to_user',$data); ?>
                           
                        </div>
                        <!-- /.right side bar -->
                    </div>
                </div>
            </main><!-- /.main-part--> 
            
<?php $this->load->view('widgets/footer');?>
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
