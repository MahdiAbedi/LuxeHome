<?php $this->load->view('widgets/header'); ?>
<div class="container">
                    <section class="header-slider">
                        <!-- Carousel container -->
                        <div id="header-slider" class="carousel slide" data-ride="carousel">
                            
                            <!-- Content -->
                            <div class="carousel-inner" role="listbox">
                                <!-- Slide 1 -->
                                <div class="item active">
                                    <img data-src="assets/img/patterns/bg-villa-m.jpg" alt="مشاوران املاک خانه رویایی" />
                                    <div class="carousel-caption">
                                        <h3 class="carousel-caption-title"><span>خانه هرکس ، قلمرو فرمانروایی اوست.</span><i class="line-bottom color-primary"></i></h3>
                                        <div class="s-description"><p>خانه رویایی،رویای خانه دار شدن شماست</p></div>
                                        <a class="btn btn-primary color-primary"><span>بگرد،ببین و بپسند</span></a>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                        <!-- Carousel container -->
                    </section><!-- /.header-slider-->
                   <?php $this->load->view("widgets/search");?>
                </div>
            </header><!-- /.header-->

            <main class="main section-color-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="widget"></div>
                           <?php $this->load->view("widgets/home_list");?>
                        </div><!-- /.center-content -->
                    <?php $this->load->view("widgets/sidebar");?>
                    </div>
                </div>
            </main><!-- /.main-part-->  

            <section class="section section-ads section-parallax">
                <h3 class="hidden">Ads</h3>
                <div class="container">
                    <a href="goo.gl/Z7dnfU"> <img data-src="assets/img/ads/banner1.gif" alt="" class="center-block" /></a>
                </div>
            </section><!-- /. horizontal-ads--> 

        <?php $this->load->view('widgets/footer');?>
        <?php $this->load->view('widgets/city_search_js_script');?>
