<? 
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';
    if(!$_SESSION)  go('/_adm/login.php',1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YERIEL | ADMIN</title>

    <!-- core -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- theme -->
    <link rel="stylesheet" href="/_yeriel/bts/argon/assets/css/argon-dashboard.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/_adm/_static/css/common.css" rel="stylesheet" />

    <!-- core -->
    <script src="/_yeriel/js/jquery.min.js"></script>
    <script src="/_yeriel/js/jquery.form.js"></script>
    <script src="/_yeriel/js/yeriel.js"></script>    
    <script src="/_yeriel/js/bootstrap.min.js"></script>
    <script src="/_yeriel/bts/argon/assets/js/core/popper.min.js"></script>
</head>


<body class="g-sidenav-show bg-gray-10">

<div class="min-height-300 bg-primary position-absolute w-100" style="z-index:-1;"></div>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header text-center">
        <a href="/_adm/pages/dashboard/" class="d-block m-0 py-3"><img src="/_static/asset/img/logo_bk.png" alt="logo"></a>
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    </div>
    <hr class="horizontal dark mt-3" />
    
    <nav class="collapse navbar-collapse w-auto ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?
                $menu=array('dashboard','about','career','works','gallery','resume');
                $icon=array(
                    "<i class='fa-solid fa-house'></i>",
                    "<i class='fa-solid fa-user-pen'></i>",
                    "<i class='fa-solid fa-briefcase'></i>",
                    "<i class='fa-solid fa-display'></i>",
                    "<i class='fa-solid fa-images'></i>",
                    "<i class='fa-solid fa-regular fa-file'></i>"
                );
                $color  =   array('text-primary','text-danger','text-warning','text-info','text-success','text-pink');
                $uri    =   explode('/',trim($_SERVER['REQUEST_URI']));

                foreach($menu AS $i=>$m){
                    ?>
                    <li class="nav-item">
                        <a href="/_adm/pages/<?=$m?>/" class="nav-link <?=$uri[3]==$m?'active':''?>">
                            <div class="icon text-center me-2 <?=$color[$i]?>"><?=$icon[$i]?></div>
                            <span class="nav-link-text ms-1" style="text-transform:uppercase;"><?=$m?></span>
                        </a>
                    </li>
                    <?
                }        
            ?>
        </ul>
    </nav>
</aside>

<main class="main-content position-relative border-radius-lg">
    <!-- form start -->
    <form id='form' name='form' method='post'>


        <div class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
            <div aria-label="breadcrumb">
                <h6 class="font-weight-bolder text-white mb-0 mt-3" style="text-transform:uppercase;"><?=$uri[3]?></h6>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="w-100 navbar-nav justify-content-end">
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="https://yeriel.co.kr/" class="nav-link text-white p-0" target="_blank"><i class="fa-solid fa-globe"></i></a>
                    </li>                    
                    <li class="nav-item ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0 d-xl-none" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- contents -->
        <div class="container-fluid py-4">