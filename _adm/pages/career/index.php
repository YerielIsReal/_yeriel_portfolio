<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/header.php';

    // setting
    $page       =   @$_GET['page']?@$_GET['page']:1;
    $page_cut   =   5;
    $limit      =   10;
    $start      =   ($page-1)*$limit;

    $my->conn();
    $gets = $my->gets("SELECT * FROM career ORDER BY date_e DESC");
    $tt = $my->get("SELECT count(uid) AS c FROM career");
    $my->stop();

    // pagination
	$page_max	=	ceil($tt['c']/$limit);
	$page_s		=	(floor(($page-1)/$page_cut)*$page_cut)+1;
	$page_e		=	$page_s+($page_cut-1);
	$page_e		=	$page_e>$page_max?$page_max:$page_e;    
?>

<div class="row">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-header text-secondary pb-0">
                <div class="float-start">Career</div>
                <a href="write.php" class="btn btn-sm bg-gradient-primary float-end">New</a>
            </div>
            <hr class="horizontal dark mt-0" />

            <div class="card-body">
                <table class="w-100 text-center text-sm">
                    <tr class="border-top border-bottom">
                        <th class='p-2'>No.</th>
                        <th class="p-2">Language</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Company</th>
                        <th class="p-2">Position</th>
                        <th class='p-2'>Contents</th>
                        <th class="p-2" style='width:80px;'>Edit</th>
                        <th class="p-2" style='width:80px;'>Delete</th>
                    </tr>
                    <?
                        if(!$gets){
                            ?><tr class='border-bottom'><td class='py-3' colspan=6>No career</td></tr><?
                        }
                        $n=$tt['c'];
                        foreach($gets AS $v){
                            $conts = str_replace('<br />','',text_unprocess($v['conts']));
                            ?>
                            <tr class="border-bottom">
                                <td class="p-2"><?=$n?></td>
                                <td class="p-2"><?=$v['gb']?></td>
                                <td class="p-2"><?=$v['date_s']?> ~ <?=$v['date_e']?></td>
                                <td class="p-2"><?=$v['company']?></td>
                                <td class="p-2"><?=$v['position']?></td>
                                <td class="conts p-2 text-start"><?=$conts?></td>
                                <td class="p-2">
                                    <a href="edit.php?id=<?=$v['uid']?>" class="btn btn-sm bg-white border mb-0 px-3">Edit</a>
                                </td>
                                <td class="p-2"><a href="javascript:void(0);" onclick="career_del_proc('<?=$v['uid']?>');" class='btn btn-sm btn-danger mb-0 px-3'>Del</a></td>
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
    let limit = 30;
    let textBox = document.getElementsByClassName('conts').length;
    let text = '';

    for(i=0;i<textBox;i++){
        text = document.getElementsByClassName('conts')[i].innerText;
        if(text.length > limit){
            text = text.substr(0, limit-2)+' ...';
            document.getElementsByClassName('conts')[i].innerText = text;
        }
    }

    //
    career_del_proc = function(id){
        $_POST('form','career_del_proc.php?id='+id);
    }


    
</script>


<? include_once $_SERVER['DOCUMENT_ROOT'].'/_adm/inc/footer.php'; ?>