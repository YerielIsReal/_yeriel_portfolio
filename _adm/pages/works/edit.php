<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php';

    $id =   $_GET['id'];
    if(!$id) msg_url('존재하지 않는 게시물입니다','index.php',1);

    $my->conn();
    $get=$my->get("SELECT * FROM works WHERE uid='{$id}'");
    $my->stop();
?>

<style>
    .preview_box a{position:absolute; top:10px; right:10px;}
</style>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">Edit Works</div>
                <div class="float-end">
                    <a href="javascript:void(0);" onclick="works_edit_proc();" class="btn btn-sm bg-gradient-success">Save</a>
                    <a href="javascript:void(0);" onclick="works_del_proc();" class="btn btn-sm bg-gradient-danger px-3">Del</a>
                </div>
            </div>
            <hr class="horizontal dark mt-0" />

            <div class="card-body">
                <!-- title, position, thumb2, works  -->
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Title</span>
                            <input type="text" id="title" name="title" value="<?=$get['title']?>" class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Position</span>
                            <input type="text" id="position" name="position" value="<?=$get['position']?>" class="form-control ps-2" />
                        </div>
                        <div class="w-100 mt-2 text-xs text-end pe-3">구분자 '·' 로 구분</div>
                    </div>
                </div>
                
                <hr class="horizontal dark mb-4" />

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class='text-bold mb-2'>Thumbnail Large</div>
                        <?
                            if(!$get['thumb_l']){
                                ?>
                                <div style='width:300px;' class='mb-1'>
                                    <input type="file" id='thumb_l' name='thumb_l' onchange="readURL(this,'thumb_l');" class='form-control form-control-md' />
                                </div>
                                <?
                                $thumb_l_src = '';
                            }else{
                                $thumb_l_src = '/_static/asset/upload/works/'.$get['thumb_l'];
                            }
                        ?>
                        <div style='width:300px; height:300px;' class='preview_box border'>
                            <img id='thumb_l_preview' class='preview_img'
                            src="<?=$thumb_l_src?>" />
                            <?
                                if($get['thumb_l']){
                                    ?>
                                    <a href="javascript:void(0);" onclick="works_img_del_proc('thumb_l');" class='btn btn-xs btn-danger px-2'>
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <?
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class='text-bold mb-2'>Thumbnail Small</div>
                        <?
                            if(!$get['thumb_s']){
                                ?>
                                <div style='width:300px;' class='mb-1'>
                                    <input type="file" id='thumb_s' name='thumb_s' onchange="readURL(this,'thumb_s');" class='form-control form-control-md' />
                                </div>
                                <?
                                $thumb_s_src = '';
                            }else{
                                $thumb_s_src = "/_static/asset/upload/works/".$get['thumb_s'];
                            }
                        ?>
                        <div style='width:300px; height:300px;' class='preview_box border'>
                            <img id='thumb_s_preview' class='preview_img'
                            src="<?=$thumb_s_src?>" />
                            <?
                                if($get['thumb_s']){
                                    ?>                            
                                    <a href="javascript:void(0);" onclick="works_img_del_proc('thumb_s');" class='btn btn-xs btn-danger px-2'>
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <?
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <hr class="horizontal dark mb-4" />

                <div class="row">
                    <div class="col-12">
                        <div class='text-bold mb-2'>Works</div>
                        <?
                            if(!$get['works']){
                                ?>
                                <div style='width:300px;' class='mb-1'>
                                    <input type="file" id='works' name='works' onchange="readURL(this,'works');" class='form-control form-control-md' />
                                </div>
                                <?
                                $works_src = '';
                            }else{
                                $works_src = "/_static/asset/upload/works/".$get['works'];
                            }
                        ?>
                        <div style='width:100%; min-height:300px;' class='preview_box border'>
                            <img id='works_preview' class='preview_img' src="<?=$works_src?>" />
                            <?
                                if($get['works']){
                                    ?>
                                    <a href="javascript:void(0);" onclick="works_img_del_proc('works');" class='btn btn-xs btn-danger px-2'>
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <?
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="javascript:void(0);" onclick="works_edit_proc();" class="btn btn-sm bg-gradient-success float-end">Save</a>
            </div>
        </div>
    </div>
</div>




<script type='text/javascript'>
    function readURL(input,gb) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(gb + '_preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }else return;
    }

    //
    works_img_del_proc = function(gb){
        if(confirm('이미지를 삭제하시겠습니까?')){
            $_POST('form',"works_img_del_proc.php?id=<?=$id?>&gb="+gb);
        }else{
            return false;
        }
        
    }

    //
    works_edit_proc = function(){
        $_POST('form','works_edit_proc.php?id=<?=$id?>');
    }

    //
    works_del_proc = function(){
        if(confirm('해당 works를 삭제하시겠습니가?')){
            $_POST('form','works_del_proc.php?id=<?=$id?>');
        }else{
            return false;
        }
    }    
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>