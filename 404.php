<!DOCTYPE html>
<html lang="ar-EG" dir="rtl">
    <head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name='viewport' content='width=device-width,initial-scale=1'/>
		<?php wp_head(); ?>
		<title><?php wp_title(); ?></title>
    </head>
    <body class="error">
		<div class="error__block">
			<div class="error__block-content">
				<span>خطأ 404</span>
				<p>هذه الصفحة غير موجودة، لكن الصفحة الرئيسية موجودة</p>
				<a class="btn" href="/">اذهب إلى الصفحة الرئيسية</a>
			</div>
		</div>
    </body>
</html>
