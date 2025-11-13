<? 
    include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php';

    $page       =   @$_GET['page']?@$_GET['page']:1;
    $page_cut   =   5;
    $limit      =   10;
    $start      =   ($page-1)*$limit;
    
    $my->conn();

    $row = $my->gets("SELECT * FROM works ORDER BY uid DESC LIMIT {$start},{$limit}");
    $tt = $my->get("SELECT count(uid) AS c FROM works");

    $my->stop();

    // pagination
	$page_max	=	ceil($tt['c']/$limit);
	$page_s		=	(floor(($page-1)/$page_cut)*$page_cut)+1;
	$page_e		=	$page_s+($page_cut-1);
	$page_e		=	$page_e>$page_max?$page_max:$page_e;
?>

<style>
    .img_box{width:50px; height:50px; background:#f8f9fa; margin:auto; display:flex; justify-content:center; align-items:center;}
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">Works</div>
                <div class="float-end"><a href="write.php" class="btn btn-sm bg-gradient-primary">New</a></div>
            </div>
            <hr class="horizontal dark mt-0">
            <div class="card-body">
                <table class="w-100 text-center text-sm">
                    <tr class="border-top border-bottom">
                        <th class="p-2">No.</th>
                        <th class="p-2">Thumb</th>
                        <th class="p-2">Project Name</th>
                        <th class="p-2">Position</th>
                        <th class="p-2" style='width:80px;'>Edit</th>
                        <th class="p-2" style='width:80px;'>Delete</th>
                    </tr>
                    <?
                        if(!$row){
                            ?><tr class='border-bottom'><td class='py-3' colspan='6'>No works</td></tr><?
                        }
                        $n=$tt['c'];
                        foreach($row AS $v){
                            if($v['thumb_l']||$v['thumb_s']){
                                $thumb      =   $v['thumb_l']?$v['thumb_l']:$v['thumb_s'];
                                $dir_img    =   "/_static/asset/upload/works/".$thumb;
                                $style      =   'width:100%; opacity:1;';
                            }else{
                                $dir_img    =   "/_static/assetimg/logo_bk.png";
                                $style      =   "width:50%; opacity:0.2;";
                            }
                            ?>
                            <tr class="border-bottom">
                                <td class="p-2"><?=$n?></td>
                                <td class="p-2">
                                    <div class='img_box border'>
                                        <img src="<?=$dir_img?>" style="<?=$style?>" />
                                    </div>
                                </td>
                                <td class="p-2"><?=$v['title']?></td>
                                <td class="p-2"><?=$v['position']?></td>
                                <td class="p-2">
                                    <a href="edit.php?id=<?=$v['uid']?>" class="btn btn-sm bg-white border mb-0 px-3">Edit</a>
                                </td>
                                <td class="p-2">
                                <a href="javascript:void(0);" onclick="works_del_proc('<?=$v['uid']?>')" class="btn btn-sm btn-danger border mb-0 px-3">Del</a>
                                </td>
                            </tr>
                            <?
                            $n--;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- pagination -->
    <div class="col-12 mt-4">
        <div class="pagination-container justify-content-center">
            <ul class="pagination pagination-default justify-content-center">

                <?
                    if($page_s!=1){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=" aria-label="Previous">
                                <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                            </a>
                        </li>
                        <?
                    }

                    for($i=$page_s;$i<=$page_e;$i++){
                        ?>
                        <li class="page-item <?=$i==$page? ' active':''?>">
                            <a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a>
                        </li>
                        <?
                    }

                    if($page_e!=$page_max){
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=<?=$page_max?>" aria-label="Next">
                                <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                            </a>
                        </li>
                        <?
                    }
                ?>
            </ul>
        </div>        
    </div>
    <!-- // pagination -->
</div>


<script type='text/javascript'>
    //
    works_del_proc = function(id){
        if(confirm('해당 works를 삭제하시겠습니가?')){
            $_POST('form','works_del_proc.php?id='+id);
        }else{
            return false;
        }
    }
</script>

<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>