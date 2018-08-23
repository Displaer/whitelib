<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!doctype html>
<html lang="ru_RU">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru_RU">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--<title>White-Soft Library</title>-->

	<!-- Bootstrap core CSS -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/additional.css" media="screen, projection">

	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/print.css" media="print">-->
	<!--[if lt IE 8]>
	<!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl;*/ ?>/css/ie.css" media="screen, projection">-->
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/form.css">-->

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</head>
<body>

<header>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="#">WS Lib</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
		// todo: implement current remark for small screen.
		// <span class="sr-only">(current)</span>
		$currentRoute =  Yii::app()->request->getParam('r');
		$classBooks ='';
		$classAuthor ='';
		$classIndex ='';
		switch ($currentRoute) {
			case 'site/books':
				$classBooks = 'active';
				break;
			case 'site/authors':
				$classAuthor = 'active';
				break;
			default:
				$classIndex = 'active';
				break;
		}
		?>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?=$classIndex;?>">
					<a class="nav-link" href="<?php echo $this->createUrl('site/index');?>">Читалка</a>
				</li>
				<li class="nav-item <?=$classAuthor;?>">
					<a class="nav-link" href="<?php echo $this->createUrl('site/authors');?>">Авторы</a>
				</li>
				<li class="nav-item <?=$classBooks;?>">
					<a class="nav-link" href="<?php echo $this->createUrl('site/books');?>">Книги</a>
				</li>

				<?php
				if(!Yii::app()->user->isGuest) {
					printf('<li class="nav-item"><a class="nav-link" href="%s">*Книги*</a></li>', $this->createUrl('books/index'));
					printf('<li class="nav-item"><a class="nav-link" href="%s">*Авторы*</a></li>', $this->createUrl('authors/index'));
				}
				?>
			</ul>

			<ul class="navbar-nav right">
				<li class="nav-item">
					<?php
					if(Yii::app()->user->isGuest) {
						printf('<a class="nav-link" href="%s">Вход</a>', $this->createUrl('site/login'));
					} else {
						printf('<a class="nav-link" href="%s">Выход(%s)</a>', $this->createUrl('site/logout'), Yii::app()->user->name);
					}
					?>
				</li>
			</ul>
		</div>
	</nav>
</header>

<main role="main" style="margin-top: 70px; margin-bottom: 70px;">

	<div class="container marketing">

		<section>
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
		</section>


	<?php echo $content; ?>
	</div><!-- /.container -->

	<!-- FOOTER -->

	<footer class="footer">
		<div class="container">
			<span class="text-muted">&copy; <?php echo date("Y");?> White-Sofr LLC. &middot;</span>
		</div>
	</footer>

</main>
</body>
</html>
