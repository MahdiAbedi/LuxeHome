<div class="widget card pad-all box-container media">
                    <hr class="mBtm-50 mTop-30" data-symbol="جستجوی مشاوران املاک">
                    <form action="<?php echo base_url().'agents';?>" method="post" class="form-additional">
                        <div class="form-group">
                            <select id="ostan" name="city[]" class="form-control "></select>
                        </div>
                        <div class="form-group">
                            <select id="shar" name="city[]" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <select id="mantage" name="city[]" class="form-control"></select>
                        </div>
                       
                       
                        <?php
                        $csrf = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                        );
                        ?>
                       <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <p>
                            <button id="search" data-style="slide-left" class="btn btn-lg btn-raised ripple-effect btn-danger btn-block" type="submit"> <i class="ti-search"></i>جستجو</button>
                        </p>
                    </form>
                </div>