<? 
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';
	$_SESSION='';
	session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YERIEL | ADMIN</title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- core -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- theme -->
    <link rel="stylesheet" href="/_yeriel/bts/argon/assets/css/argon-dashboard.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/_adm/css/common.css" rel="stylesheet" />

    <!-- core -->
    <script src="/_yeriel/js/jquery.min.js"></script>
    <script src="/_yeriel/js/jquery.form.js"></script>
    <script src="/_yeriel/js/yeriel.js"></script>
    <script src="/_yeriel/js/bootstrap.min.js"></script>
    <script src="/_yeriel/bts/argon/assets/js/core/popper.min.js"></script>
    
    
    <!-- theme -->
    <script src="/_yeriel/bts/argon/assets/js/argon-dashboard.min.js"></script>
</head>
<body class="bg-dark" style="height:100vh;">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center justify-content-center">
            <div class="card col-xl-5 col-lg-5">
                <div class="card-header border-bottom text-center">
                    <div>YERIEL ADMIN</div>
                    <h3>LOG IN</h3>
                </div>

                <form id="form" name="form" method="post">
                    <div class="card-body">
                        <input type="text" id='id' name='id' onkeydown="if(event.keyCode==13){login_check(); return;}" class="form-control form-control-md mb-3" placeholder="ID" />
                        <input type="password" id="password" name="password" onkeydown="if(event.keyCode==13){login_check(); return;}" class="form-control form-control-md" placeholder="password" />
                    </div>
                    <div class="card-footer border-top">
                        <button onclick="login_check()" type="button" class="btn btn-md btn-primary btn-lg w-100 mb-0">LOG IN</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('#id').focus();
        });

        login_check = function(){
            if(!$('#id').val()){
                alert('ID를 입력하세요.');
                $('#id').focus();
                return;
            }
            if(!$('#password').val()){
                alert('Password를 입력하세요.');
                $('#password').focus();
                return;
            }
            $_POST('form','./inc/login_check.php');
        }    
    </script>

   
</body>
</html>