 <section class="search-form color-primary parallax">
                        <h3 class="hidden">جستجو</h3>
                        <div class="container">
                            <form method="post" action="<?php echo base_url().'search';?>" class="form-horisontal">
                                <div class="row">
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                            <select required  id="ostan" name="city[]" class="form-control color-secondary ">
                                                <option value=''>انتخاب کنید</option>
                                            </select>                                                   
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                            <select id="shar" name="city[]" class="color-secondary form-control">

                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                            <select id="mantage" name="city[]" class="color-secondary form-control">

                                            </select>                                                   
                                    </div>
                                </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control color-secondary " name="sell-type" >
                                                <option value="rent">رهن و اجاره</option>
                                                <option value="sell">خرید و فروش</option>
                                                <option value="other">سایر موارد</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control color-secondary" name="category" >
                                                <option value="flat">آپارتمان</option>
                                                <option value="home">خانه و ویلا</option>
                                                <option value="land">زمین و گلنگی</option>
                                                <option value="office">دفتر کار،اتاق اداری و مطب</option>
                                                <option value="shop">مغازه و غرفه</option>
                                                <option value="farm">صنعتی،کشاورزی و تجاری</option>
                                                <option value="other">متفرقه</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <button type="submit" class="btn btn-search focus-color"><i class="fa fa-search icon-white"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section><!-- /.header-search-->
                    
                    
