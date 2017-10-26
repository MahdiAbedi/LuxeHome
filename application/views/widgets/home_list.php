<?php
    $this->db->like('region_id',$region_id);
    $this->db->like('home_type',$home_type);
    $this->db->like('deal_type',$deal_type);
    if($user_id>0){$this->db->where('user_id',$user_id);}
    $this->db->limit($limit_number,$offset*$limit_number);

    $this->db->order_by('special','desc');
    $this->db->order_by('id','desc');
    $homes=$this->db->get('homes')->result();
?>
<?php if($homes):?>

<div class="row">
    <?php foreach ($homes as $home) :?>
    <div class="col-md-4 col-sm-6">
        <div class="property-card card">
                <div class="property-card-header image-box">
                   <?php if(!empty($home->thumb_img_src)):?>
                    <img data-src="<?php echo $home->thumb_img_src;?>" alt="<?php echo $home->title;?>" />
                    <?php else :?>
                    <img data-src="<?php echo base_url().'assets/img/homes_thumbs/nohome'.rand(1,6).'.jpg';?>" alt="<?php echo $home->title;?>" />
                    <?php endif;?>
                    
                    <?php if($home->special):?>
                        <div class="budget">
                             <i class="fa fa-star"></i>
                        </div>
                    <?php endif;?>
                    
                    <a href="<?php echo base_url().'home/'.$home->id;?>" class="property-card-hover">
                        
                        <span class="left-icon small-icons">
                        <i class="fa fa-undo"></i>
                        </span>
                        <span class="center-icon small-icons" style="font-size: 45px;">
                        <i class="fa fa-plus"></i>
                        </span>
                        <span class="right-icon small-icons">
                        <i class="fa fa-heart"></i>
                        </span>
                    </a>
                    
                    <span class="property-card-value">
                        <span class="list-overview-value">
                            <?php for ($index = 0; $index < $home->special; $index++)
                                {
                                echo '<i class="icon-star"></i>';
                                }
                            ?>
                           
                        </span>
                    </span>
                </div>
                <div class="property-card-tags">
                    <span class="label label-default label-tag-primary"><?php  echo deal_type_en_to_fa($home->deal_type);?></span>
                </div>
                <div class="property-card-box card-box card-block">
                    <h3 class="property-card-title"><a href="<?php echo base_url().'home/'.$home->id;?>"><?php  echo substr($home->title, 0, 60).'...';?></a></h3>
                    <div class="property-card-descr"><?php  echo substr($home->description, 0, 160).'...';?></div>
                    <div class="property-preview-footer  clearfix">
                        <div class="property-preview-f-left text-color-primary">
                            <span class="property-card-value">
                                <i class="fa fa-home"></i><?php  echo home_type_en_to_fa($home->home_type);?>
                            </span>
                 
                            <span class="property-card-value">
                                <i class="fa fa-money"></i><?php echo $home->price;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php    endforeach;?>
    </div><!-- /.properties -->

  <script type="text/javascript">
        [].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
            img.setAttribute('src', img.getAttribute('data-src'));
            img.onload = function() {
            img.removeAttribute('data-src');
            };
            });
        </script>
<?php endif;?>
