<script>
$(document).ready(function(){
//#############################<<<GET OSTAN ON LOAD>>>########################################## 

            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>city',
               
                success:function(html){
                    
                    $('#ostan').html(html);
                    $('#shar').html('<option value="">نام شهر خود را انتخاب کنید</option>'); 
                    $('#mantage').html('<option value="">نام شهر خود را انتخاب کنید</option>'); 
                }
            }); 
 
//#############################<<<GET SHAHR>>>##########################################  
    $('#ostan').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>city/'+countryID,
               
                success:function(html){
                    //alert('ostan code='+countryID);
                    $('#shar').html(html);
                    $('#mantage').html('<option value="">نام شهر خود را انتخاب کنید</option>'); 
                }
            }); 
        }else{
            $('#shar').html('<option value="">استان مورد نظر را انتخاب بفرمایید</option>');
            $('#mantage').html('<option value="">شهر مورد نظر را انتخاب نمایید</option>'); 
        }
    });
 //#############################<<<GET MANTAGE>>>##########################################    
    $('#shar').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url();?>city/'+countryID,
                
                success:function(html){
                   
                    $('#mantage').html(html);
                }
            }); 
        }else{
            $('#mantage').html('<option value="">نام شهر خود را انتخاب نمایید</option>'); 
        }
    });
    
    //###############################END OF JQUERY############################
})
</script>