<?php
$this->db->like('region_id',$region_id);
$this->db->limit($limit_number,$offset*$limit_number);
//$this->db->limit(0,10);
$this->db->order_by('special','desc');
$this->db->order_by('id','desc');
$agents=$this->db->get('agents')->result();
?>
<?php if ($agents):?>

<div class="properties">
<div class="row">
    <?php 
       foreach ($agents as $agent) :?>
    <div class="col-sm-6 col-lg-4  box-container media">
        <div class="agent-card ">
            <div class="agent-logo media-left media-top">
                <a class='img-circle-cover'>
                   <?php if(!empty($agent->img_src)):?>
                    <img data-src="<?php echo $agent->img_src;?>" alt="<?php echo $agent->title;?>" />
                    <?php else :?>
                    <img data-src="<?php echo base_url().'assets/img/agents/noagent'.rand(1,6).'.jpg';?>" alt="<?php echo $agent->title;?>" />
                    <?php endif;?>
                    <?php if($agent->special):?>
                        <div class="budget">
                             <i class="fa fa-star"></i>
                        </div>
                    <?php endif;?>
                </a>
            </div>
            <div class="agent-details media-right media-top">
                <a class="agent-name text-color-primary"><?php echo $agent->name;?></a>
                <span class="phone"><a href="tel:<?php echo $agent->mobile;?>" class="mail"><?php echo $agent->mobile;?></a></span>
                <span class="phone"><a href="tel:<?php echo $agent->telephone;?>" class="mail"><?php echo $agent->telephone;?></a></span>
                <a href="mailto:<?php echo $agent->email;?>" class="mail text-color-primary"><?php echo $agent->email;?></a>
                <span class="property-card-value">
                    <span class="list-overview-value">
                        <?php for ($index = 0; $index < $agent->special; $index++)
                            {
                            echo '<i class="icon-star"></i>';
                            }
                        ?>

                    </span>
                </span>
            </div>
        </div><!-- /.agent-card--> 
    </div>
    
    
<?php    endforeach;?>
    </div><!-- /.properties -->
</div> <!-- /.properties--> 
<script type="text/javascript">
        [].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
            img.setAttribute('src', img.getAttribute('data-src'));
            img.onload = function() {
            img.removeAttribute('data-src');
            };
            });
        </script>
<?php endif;?>
  