<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php'; ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">New Career</div>
                <div class="float-end">
                    <div class="float-start pt-1 me-4">
                        <div class="form-check form-check-inline">
                            <input type="radio" id="gb_kr" name="gb" value='kr' class="form-check-input" checked />
                            <label for="gb_kr" class="form-check-label">KR</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="gb_en" name="gb" value='en' class="form-check-input" />
                            <label for="gb_en" class="form-check-label">EN</label>
                        </div>                            
                    </div>
                    <a href="javascript:void(0);" onclick="career_write_proc();" class="btn btn-sm bg-gradient-success">Save</a>
                </div>
            </div>
            <hr class="horizontal dark my-0" />

            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Company</span>
                            <input type="text" id="company" name="company" class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Position</span>
                            <input type="text" id="position" name="position" class="form-control ps-2" />
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 mb-2">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Date Start</span>
                            <input type="month" id="date_s" name="date_s" class="form-control ps-2" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-md">
                            <span class="input-group-text">Date End</span>
                            <input type="month" id="date_e" name="date_e" class="form-control ps-2" />
                        </div>
                    </div>
                </div>                

                <div class="row">
                    <div class="col-12 ps-3 text-bold">Contents</div>
                    <div class="col-12">
                        <textarea id="conts" name='conts' class="form-control" style="height:400px;"></textarea>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="javascript:void(0);" onclick="career_write_proc();" class="btn btn-sm btn-success float-end">Save</a>
            </div>
        </div>
    </div>
</div>



<script type='text/javascript'>
    career_write_proc = function(){
        $_POST('form','career_write_proc.php');
    }
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>