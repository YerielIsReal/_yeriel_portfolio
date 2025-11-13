<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php'; ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">New Works</div>
                <div class="float-end"><a href="javascript:void(0);" onclick="works_write_proc();" class="btn btn-sm bg-gradient-success">Save</a></div>
            </div>
            <hr class="horizontal dark mt-0" />

            <div class="card-body">
                <!-- title, position, thumb2, works  -->
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Title</span>
                            <input type="text" id="title" name="title" class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Position</span>
                            <input type="text" id="position" name="position" class="form-control ps-2" />
                        </div>
                        <div class="w-100 mt-2 text-xs text-end pe-3">구분자 '·' 로 구분</div>
                    </div>
                </div>
                
                <hr class="horizontal dark mb-4" />

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class='text-bold mb-2'>Thumbnail Large</div>
                        <div style='width:300px;' class='mb-1'>
                            <input type="file" id='thumb_l' name='thumb_l' onchange="readURL(this,'thumb_l');" class='form-control form-control-md' />
                        </div>
                        <div style='width:300px; height:300px;' class='preview_box border'>
                            <img id='thumb_l_preview' class='preview_img' src="" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class='text-bold mb-2'>Thumbnail Small</div>
                        <div style='width:300px;' class='mb-1'>
                            <input type="file" id='thumb_s' name='thumb_s' onchange="readURL(this,'thumb_s');" class='form-control form-control-md' />
                        </div>
                        <div style='width:300px; height:300px;' class='preview_box border'>
                            <img id='thumb_s_preview' class='preview_img' src="" />
                        </div>
                    </div>
                </div>

                <hr class="horizontal dark mb-4" />

                <div class="row">
                    <div class="col-12">
                        <div class='text-bold mb-2'>Works</div>
                        <div style='width:300px;' class='mb-1'>
                            <input type="file" id='works' name='works' onchange="readURL(this,'works');" class='form-control form-control-md' />
                        </div>
                        <div style='width:100%; min-height:300px;' class='preview_box border'>
                            <img id='works_preview' class='preview_img' src="" />
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="javascript:void(0);" onclick="works_write_proc();" class="btn btn-sm bg-gradient-success float-end">Save</a>
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
    works_write_proc = function(){
        $_POST('form','works_write_proc.php');
    }
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>