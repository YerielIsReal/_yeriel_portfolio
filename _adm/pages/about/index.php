<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php';

    $my->conn();
    
    $about      =   $my->get("SELECT * FROM about");
    $about_lan  =   $my->gets("SELECT * FROM about_lan");
    $about_cer  =   $my->gets("SELECT * FROM about_cer");
    $about_edu  =   $my->gets("SELECT * FROM about_edu");

    $my->stop();
?>

<style>
    .btn_plus{display:none;}
</style>

<div class="row">
    <div class="col-xl-8">
        <div id="card_profile" class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">Profile</div>
                <a href="javascript:void(0);" onclick="profile_edit(this);" id="btn_profile_edit" class="float-end btn btn-sm bg-gradient-primary">Edit</a>
                <a href="javascript:void(0);" onclick="profile_save(this);" id="btn_profile_save" class="float-end btn btn-sm bg-gradient-success" style="display:none;">Save</a>
            </div>
            <hr class="horizontal dark mt-0" />
            <div class="card-body pt-0">
                <!-- personal info -->
                <div class="row mb-5">
                    <div class="col-12 text-bold mb-2 text-sm">Perfonal Infomation</div>
                    <div class="col-lg-6 mb-4">
                        <div class="input-group input-group-md mb-1">
                            <span class="input-group-text">Name (Kr)</span>
                            <input type="text" id="name_kr" name="name_kr" class="form-control ps-2" value="<?=$about['name_kr']?>" readonly />
                        </div>
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Name (En)</span>
                            <input type="text" id="name_en" name="name_en" class="form-control ps-2"  value="<?=$about['name_en']?>" readonly />
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="input-group input-group-md mb-1">
                            <span class="input-group-text">Birth</span>
                            <input type="text" id="birth" name="birth" class="form-control ps-2" value="<?=$about['birth']?>" readonly />
                        </div>
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Contact</span>
                            <input type="email" id="contact" name="contact" class="form-control ps-2" value="<?=$about['contact']?>" readonly />
                        </div>
                    </div>
                </div>

                <!-- language -->
                <div class="row mb-5">
                    <div class="col-12 d-flex align-items-end justify-content-between text-bold mb-2 text-sm">
                        <div class="float-start">Language</div>
                        <button type='button' onclick="add_input('lan')" class="btn_plus float-end btn btn-xs border m-0 px-2 py-1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <?  
                        if(!sizeof($about_lan)){
                            ?>
                            <div class="lan col-lg-6 mb-4">
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Language (Kr)</span>
                                    <input type="text" id="lan_kr_1" name="lan_kr[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                                <div class="input-group input-group-md">
                                    <span class="input-group-text">Language (En)</span>
                                    <input type="text" id="lan_en_1" name="lan_en[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                            </div>                            
                            <?
                        }else{
                            $n=0;
                            foreach($about_lan AS $v){
                                $n++;
                                ?>
                                <div class="lan col-lg-6 mb-4">
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Language (Kr)</span>
                                        <input type="text" id="lan_kr_<?=$n?>" name="lan_kr[]" class="form-control ps-2" 
                                        value="<?=$v['lan_kr']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-text">Language (En)</span>
                                        <input type="text" id="lan_en_<?=$n?>" name="lan_en[]" class="form-control ps-2" 
                                        value="<?=$v['lan_en']?>" readonly />
                                    </div>
                                </div>
                                <?
                            }
                        }
                    ?>
                </div>

                <!-- certification -->
                <div class="row mb-5">
                    <div class="col-12 d-flex align-items-end justify-content-between text-bold mb-2 text-sm">
                        <div class="float-start">Certification</div>
                        <button type='button' onclick="add_input('cer')" class="btn_plus float-end btn btn-xs border m-0 px-2 py-1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <?
                        if(!sizeof($about_cer)){
                            ?>
                            <div class="cer col-lg-6 mb-4">
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Date</span>
                                    <input type="text" id="cer_date_1" name="cer_date[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Type (Kr)</span>
                                    <input type="text" id="cer_type_kr_1" name="cer_type_kr[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                                <div class="input-group input-group-md">
                                    <span class="input-group-text">Type (En)</span>
                                    <input type="text" id="cer_type_en_1" name="cer_type_en[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                            </div>
                            <?
                        }else{
                            $n=0;
                            foreach($about_cer AS $v){
                                $n++;
                                ?>
                                <div class="cer col-lg-6 mb-4">
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Date</span>
                                        <input type="text" id="cer_date_<?=$n?>" name="cer_date[]" class="form-control ps-2" 
                                        value="<?=$v['date']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Type (Kr)</span>
                                        <input type="text" id="cer_type_kr_<?=$n?>" name="cer_type_kr[]" class="form-control ps-2" 
                                        value="<?=$v['type_kr']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md">
                                        <span class="input-group-text">Type (En)</span>
                                        <input type="text" id="cer_type_en_<?=$n?>" name="cer_type_en[]" class="form-control ps-2" 
                                        value="<?=$v['type_en']?>" readonly />
                                    </div>                        
                                </div>
                                <?
                            }
                        }
                    ?>

                </div>

                <!-- education -->
                <div class="row mb-5">
                    <div class="col-12 d-flex align-items-end justify-content-between text-bold mb-2 text-sm">
                        <div class="float-start">Education</div>
                        <button type='button' onclick="add_input('edu')" class="btn_plus float-end btn btn-xs border m-0 px-2 py-1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <?
                        if(!sizeof($about_edu)){
                            ?>
                            <div class="edu col-lg-6 mb-4">
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Institution (Kr)</span>
                                    <input type="text" id="edu_kr_1" name="edu_kr[]" class="form-control ps-2" readonly />
                                </div>
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Institution (En)</span>
                                    <input type="text" id="edu_en_1" name="edu_en[]" class="form-control ps-2" readonly />
                                </div>
                                <div class="col-6 input-group input-group-md mb-1">
                                    <span class="input-group-text">Date</span>
                                    <input type="text" id="edu_date_1" name="edu_date[]" class="form-control ps-2" readonly />
                                </div>
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Cont (Kr)</span>
                                    <input type="text" id="edu_cont_kr_1" name="edu_cont_kr[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                                <div class="input-group input-group-md mb-1">
                                    <span class="input-group-text">Cont (En)</span>
                                    <input type="text" id="edu_cont_en_1" name="edu_cont_en[]" class="form-control ps-2" 
                                    readonly />
                                </div>
                            </div>
                            <?
                        }else{
                            $n=0;
                            foreach($about_edu AS $v){
                                $n++;
                                ?>
                                <div class="edu col-lg-6 mb-4">
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Institution (Kr)</span>
                                        <input type="text" id="edu_kr_<?=$n?>" name="edu_kr[]" class="form-control ps-2" value="<?=$v['ins_kr']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Institution (En)</span>
                                        <input type="text" id="edu_en_<?=$n?>" name="edu_en[]" class="form-control ps-2" value="<?=$v['ins_en']?>" readonly />
                                    </div>
                                    <div class="col-6 input-group input-group-md mb-1">
                                        <span class="input-group-text">Date</span>
                                        <input type="text" id="edu_date_<?=$n?>" name="edu_date[]" class="form-control ps-2" value="<?=$v['date']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Cont (Kr)</span>
                                        <input type="text" id="edu_cont_kr_<?=$n?>" name="edu_cont_kr[]" class="form-control ps-2" 
                                        value="<?=$v['cont_kr']?>" readonly />
                                    </div>
                                    <div class="input-group input-group-md mb-1">
                                        <span class="input-group-text">Cont (En)</span>
                                        <input type="text" id="edu_cont_en_<?=$n?>" name="edu_cont_en[]" class="form-control ps-2" 
                                        value="<?=$v['cont_en']?>" readonly />
                                    </div>
                                </div>
                                <?
                            }
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?
        if(sizeof($about)){
            ?>
            <div class="col-md-4">
                <div id='profile_img_card' class="card">
                    <div class="card-header text-secondary pb-0">
                        <div class="float-start">Profile Image</div>
                        <a href="javascript:void(0)" onclick="profile_img_edit(this);" id="btn_profile_img_edit" class="float-end btn btn-sm bg-gradient-primary">Edit</a>
                        <a href="javascript:void(0);" onclick="profile_img_save(this);" id="btn_profile_img_save" class="float-end btn btn-sm bg-gradient-success" style="display:none;">Save</a>
                    </div>
                    <hr class="horizontal dark my-0" />
                    <div class="card-body">
                        <!-- img -->
                        <div class="preview_box border" style='width:100%; min-height:200px;'>
                            <img src="<?=$about['img']?'/_static/asset/upload/about/'.$about['img']:''?>" id='profile_img_preview' style='width:100%;' />
                            <? 
                                if($about['img']){
                                    ?>
                                    <button onclick="profile_img_del();" class="btn btn-xs btn-danger position-absolute px-2" style="display:none; top:10px; right:10px;"><i class="fas fa-times"></i></button>
                                    <?
                                }
                            ?>
                        </div>
                        <!-- // img -->
                    </div>
                    <hr class="horizontal dark my-0" />
                    <div class="card-footer pb-0" style="display:none; position:relative;">
                        <input type="file" id="profile_img" name='profile_img' onchange="readURL(this)" style="opacity:0;" />
                        <label for='profile_img' class="btn btn-sm bg-gradient-secondary w-90 position-absolute top-0" style="left:4.5%;"><i class="fas fa-upload"></i>&nbsp; Upload</label>
                    </div>
                </div>
            </div>
            <?
        }
    ?>
</div>

<script type="text/javascript">
    //
    profile_edit = function(e){
        $('input').attr('readonly',false);
        $(e).hide();
        $('.btn_plus').show();
        $('#btn_profile_save').show();
    }

    //
    profile_save = function(e){
        $_POST('form','profile_save_proc.php');
    }

    //
    profile_img_edit = function(e){
        $(e).hide();
        $('#btn_profile_img_save').show();
        $('#profile_img_card .card-body button').show();
        $('#profile_img_card .card-footer').show();
    }

    //
    profile_img_save = function(e){
        $_POST('form','profile_img_save_proc.php');

        $(e).hide();
        $('#btn_profile_img_edit').show();
        $('#profile_img_card .card-body button').hide();
        $('#profile_img_card .card-footer').hide();
    }

    //
    profile_img_del = function(){
        if(confirm('이미지를 삭제하시겠습니까?')){
            $_POST('form','profile_img_del.php');
        }else{
            return false;
        }
    }

    //
    add_input = function(gb){
        var length = $('.'+gb).length;
        var html_conts  = $('.'+gb).eq(0).html();

        var html = '';
        html += "<div class='"+ gb +" col-lg-6 mb-4'>";
        html += html_conts;
        html += "</div>";
        
        $('.'+gb).eq(0).parent($('div')).append(html);
        $('.'+gb).eq(length).find('input').val('');
        
        if(gb=='lan'){
            $('.'+gb).eq(length).find('input').eq(0).attr('id',gb+'_kr_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(1).attr('id',gb+'_en_'+(length+1));
        }else if(gb=='cer'){
            $('.'+gb).eq(length).find('input').eq(0).attr('id',gb+'_date_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(1).attr('id',gb+'_type_kr_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(2).attr('id',gb+'_type_en_'+(length+1)); 
        }else if(gb=='edu'){
            $('.'+gb).eq(length).find('input').eq(0).attr('id',gb+'_kr_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(1).attr('id',gb+'_en_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(2).attr('id',gb+'_date_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(3).attr('id',gb+'_cont_kr_'+(length+1));
            $('.'+gb).eq(length).find('input').eq(4).attr('id',gb+'_cont_en_'+(length+1));           
        }       
    }

    //
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile_img_preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else return;
    }    
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>