<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php';

    $id = $_GET['id'];
    if(!$id) msg_url('존재하지 않는 게시물입니다.','index.php',1);

    $my->conn();
    $get = $my->get("SELECT * FROM career WHERE uid='{$id}'");
    $my->stop();
?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">Edit Career</div>
                <div class="float-end">
                    <div class="float-start pt-1 me-4">
                        <div class="form-check form-check-inline">
                            <input type="radio" id="gb_kr" name="gb" value='kr' class="form-check-input" <?=$get['gb']=='kr'?'checked':''?> />
                            <label for="gb_kr" class="form-check-label">KR</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="gb_en" name="gb" value='en' class="form-check-input" <?=$get['gb']=='en'?'checked':''?> />
                            <label for="gb_en" class="form-check-label">EN</label>
                        </div>                            
                    </div>
                    <a href="javascript:void(0);" onclick="career_edit_proc();" class="btn btn-sm bg-gradient-success">Save</a>
                    <a href="javascript:void(0);" onclick="career_del_proc()" class="btn btn-sm bg-gradient-danger px-3">Del</a>
                </div>
            </div>
            <hr class="horizontal dark mt-0" />

            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Company</span>
                            <input type="text" id="company" name="company" value='<?=$get['company']?>' class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Position</span>
                            <input type="text" id="position" name="position" value='<?=$get['position']?>' class="form-control ps-2" />
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 mb-2">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Date Start</span>
                            <input type="month" id="date_s" name="date_s" value='<?=$get['date_s']?>' class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Date End</span>
                            <input type="month" id="date_e" name="date_e" value='<?=$get['date_e']?>' class="form-control ps-2" />
                        </div>
                    </div>
                </div>                

                <div class="row">
                    <div class="col-12 ps-3 text-bold">Contents</div>
                    <div class="col-12">
                        <?  
                            $conts = text_unprocess($get['conts']);
                            $conts = str_replace('<br />','&#10;',$conts);
                        ?>
                        <textarea id="conts" name='conts' class="form-control" style="height:400px;"><?=$conts?></textarea>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="javascript:void(0);" onclick="career_edit_proc();" class="btn btn-sm bg-gradient-success float-end">Save</a>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    //
    career_edit_proc = function(){
        $_POST('form','career_edit_proc.php?id=<?=$id?>');
    }

    //
    career_del_proc = function(){
        $_POST('form','career_del_proc.php?id=<?=$id?>');
    }
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>