
                                <div class="property-slider-box">
                                    <div id="property-slider" class="property-slider carousel slide" data-ride="carousel">
                                        <!-- Content -->
                                        <div class="carousel-inner" role="listbox">
                                            <?php $images=explode(';',$home->img_src);
                                            $index=0;
                                           // print_r($images);
                                             foreach ($images as $image) :?>
                                               <?php if($index==0):?>
                                                    <div class="item active">
                                                  <?php else:?>
                                                    <div class="item">
                                                  <?php endif;
                                                  $index++;
                                                  ?><?php if(!empty($image)):?>
                                                        <img data-src="<?php echo $image;?>" alt="<?php echo $home->title;?>" width="100%">
                                                        <?php endif;?>
                                                    </div>
                                            <?php endforeach;?>
                                        </div>
                                        <!-- Previous/Next controls -->
                                        <a class="left carousel-control" href="#property-slider" role="button" data-slide="prev">
                                            <span class="icon-prev" aria-hidden="true"></span>
                                            <span class="sr-only">قبلی</span>
                                        </a>
                                        <a class="right carousel-control" href="#property-slider" role="button" data-slide="next">
                                            <span class="icon-next" aria-hidden="true"></span>
                                            <span class="sr-only">بعدی</span>
                                        </a>
                                    </div>
                                </div>
