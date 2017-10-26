<section class="section agents section-color-primary">  
    
    <div class="item agents-corousel-item"> 
        <div class="widget-header text-uppercaser">
            <h4>مشاوران املاک برگزیده</h4>
        </div>
         <?php 
        $this->db->like('region_id',$region_id);
        $this->db->limit($limit_number);
        $this->db->order_by('special','desc');
        $this->db->order_by('id','desc');
        $agents=$this->db->get('agents')->result();
       foreach ($agents as $agent) :?>
        <div class=" box-container media">
            <div class="agent-logo media-left media-top">
                <a  class='img-circle-cover'>
                    <img data-src="<?php echo $agent->img_src;?>" alt="<?php echo $agent->name;?>" class="img-circle" />
                </a>
                
            </div>
            <div class="agent-details media-right media-top">
                <a  class="agent-name text-color-primary"><?php echo $agent->name;?> </a>
                <span class="phone"> <a href="tel:<?php echo $agent->telephone;?>" class="mail"><?php echo $agent->telephone;?></a></span>
                <a href="mailto:<?php echo $agent->email;?>" class="mail"><?php echo $agent->email;?></a>
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
        <?php    endforeach;?>
    </div>
</section><!-- /.agencies --><!-- End blueimp  -->