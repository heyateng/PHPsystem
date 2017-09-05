<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>欢迎光临CMS内容管理系统后台</title>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="../include/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style/admin.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include "top.php"; ?>
<div class="container">
	<div id="sidebar" class="col-md-3">
		<?php include "sidebar.php"; ?>
	</div>
	<div id="main" class="col-md-9">
		<?php include "main.php"; ?>
	</div>
</div>



<script type="text/javascript" src="../include/jquery.js"></script>
<script type="text/javascript" src="../include/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	//alert($);
</script>

</body>
</html>