<?php $this->load->view("widgets/header");?>
<?php $this->load->view("widgets/search");?>
<main class="main section-color-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="widget"></div>

                <div id="results"></div>
                
                <div class="loading-info">
                    <img data-src="<?php echo base_url().'assets/img/ajax-loader.gif';?>" />
                </div>
                
            </div><!-- /.center-content -->
        <?php $this->load->view("widgets/sidebar");?>
        </div>
    </div>
</main><!-- /.main-part--> 

<?php $this->load->view("widgets/footer");?>
<?php $this->load->view('widgets/city_search_js_script');?>


<script type="text/javascript">
//########################<< AUTO LAOD >>########################
var track_page = 0; //track user scroll as page number, right now page number is 1
var loading  = false; //prevents multiple loads

load_contents(track_page); //initial content load

$(window).scroll(function() { //detect page scroll
	if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
		track_page++; //page number increment
		load_contents(track_page); //load content	
	}
});	

//########################<< Ajax load function >>########################
function load_contents(track_page){
    if(loading == false){
		loading = true;  //set loading flag on
		$('.loading-info').show(); //show loading animation 
        
		$.post( '<?php echo base_url()."more_searh_result";?>', {'page': track_page,'category':'<?php echo $home_type;?>',
        'sell-type':'<?php echo $deal_type;?>','city':'<?php echo $region_id;?>'}, function(data){
			loading = false; //set loading flag off once the content is loaded
			if(data.trim().length == 0){
				//notify user if nothing to load
				$('.loading-info').html("اطلاعات بیشتری موجود نمیباشد!");
				return;
			}
			$('.loading-info').hide(); //hide loading animation once data is received
			$("#results").append(data); //append data into #results element
		
		}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
			alert(thrownError); //alert with HTTP error
		})
	}
}

</script>
