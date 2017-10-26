<?php
    $this->db->order_by('price');
    $this->db->where('published',true);
    $this->db->where('group','home');
    $ads=$this->db->get('ads_group')->result();
?>
<div class="row">
                        <div class="col-md-12">
                              
                            <div class="widget widget-box box-container">
                                <div class="widget-header text-uppercase">
                                    <h2>پکیج تبلیغات</h2>
                                </div>
                                <div class="">
                                    <table class="table table-striped footable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: auto;">عنوان پکیج</th>
                                                <th style="width: auto;">هزینه</th>
                                                <th style="width: auto;">وضعیت فعال سازی</th>
                                                <th  style="width: auto;">زمان تبلیغات</th>
                                                <th style="width: auto;">توضیحات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($ads as $ad):?>
                                            
                                            <tr>
                                                <td class="active"><input name="ads_price[<?php echo $ad->id;?>]"type="checkbox" value="<?php echo $ad->id;?>"></td>
                                                <td class="success">
                                                    <?php echo $ad->name;?>
                                                </td>
                                                <td class="info">
                                                    <?php echo $ad->price;?> تومان
                                                </td>
                                                
                                                <td class="warning">
                                                    <?php echo $ad->run_state;?>                                       
                                                </td>
                                                <td class="danger">
                                                   <?php echo $ad->days;?>                                        
                                                </td>
                                                <td >
                                                   <?php echo $ad->description;?>                                        
                                                </td>
                                            </tr>
                                            <?php  endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /. widget-table-->   
                            <div class="widget widget-box box-container">
                                <div class="widget-header text-uppercase">
                                    <h3>جهت کسب اطلاعات بیشتر و یا مشاوره با همکاران ما در تماس باشید</h3>
                                </div>
                                <div class="widget-content">
                                    شماره تماس: <a href="tel:02166177804">66177804-021</a><br />
                                    تلگرام: <a href="tel:09395187902">5187902-0939</a><br />
                                    ایمیل: <a href="mailto:info@royalstate.ir">Info@RoyalState.ir</a>
                                </div>
                            </div> <!-- /. widget-->   
                        </div><!-- /.center-content -->
                    </div>