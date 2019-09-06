<!DOCTYPE html>
<html>
<head>
	<title>qagaz daiyn - Сервис печатающих терминалов</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#1d3d51">
	<link rel="icon" sizes="192x192" href="images/icon.png">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mstyles.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery.min.js"></script>
	<script src="https://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>
	<!-- VK button -->
	<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
</head>
<body>
	<div id="badge">
		<div id="badge-cont">
			<div class="badge-img"></div>
			<div class="badge-text">
				<p class="badge-title">daiyn.com</p>
				<p class="badge-desc">Доступно для Android</p>
			</div>
			<a style="text-decoration: none;" href="https://play.google.com/store/apps/details?id=com.daiyngroup.personal.daiyn&hl=ru">
				<div class="badge-btn">Скачать</div>
			</a>
		</div>
	</div>
	<div id="nav">
		<div id="logo"></div>
	</div>
	<div id="body">
		<div id="order" class="cont">
			<p>Номер Вашего заказа <span class="order-id"><?php if(!empty($_GET['order_id'])){echo $_GET['order_id'];} ?></span></p>
			<p>Не забудьте! Письмо с номером заказа было выслано на почту <span class="contact"><?php if(!empty($_GET['email'])){echo $_GET['email'];} ?></span></p>
			<div id="load-more">Загрузить ещё</div>
		</div>
		<div id="popular" class="cont">
			<p>Помогите другим узнать наш сервис</p>
			<a href="https://www.facebook.com/sharer.php?u=https://daiyn.com"><div id="fb-btn" class="soc-btn">Facebook</div></a>
			<a href="https://vk.com/share.php?url=https://daiyn.com" target="_blank"><div id="vk-btn" class="soc-btn">Вконтакте</div></a><a href="http://twitter.com/share?url=https://daiyn.com&text=qagaz daiyn - Сервис печатающих терминалов&" target="_blank"><div id="twit-btn" class="soc-btn">Twitter</div></a>
		</div>
		<div id="terminals" class="cont">
			<p>Ближайшие от Вас терминалы</p>
			<div id="map"></div>
		</div>
	</div>
	<div id="footer">
		<div id="footer-cont">
			<div id="about" class="footer-col">
				<p class="footer-col-head">О сервисе</p>
				<p class="footer-col-text">qagaz daiyn предоставляет круглосуточную качественную печать в любом месте и в любое время. Загружайте свои изображения и документы.</p>
			</div>
			<div id="jobs" class="footer-col">
				<p class="footer-col-head">Вакансии</p>
				<p class="footer-col-text">
					<a href="#">Системный администратор</a><br>
					<a href="#">Back-end разработчик</a><br>
					<a href="#">Веб-дизайнер</a><br>
					<a href="#">Техник</a><br>
				</p>
			</div>
			<div id="contacts" class="footer-col">
				<p class="footer-col-head">Контакты</p>
				<p class="footer-col-text">
					qagaz.daiyn@gmail.com<br>
					+7 708 627 33 47<br>
				</p>
			</div>
			<div id="help" class="footer-col">
				<p class="footer-col-head">Служба поддержки</p>
				<p class="footer-col-text">Круглосуточная поддержка клиентов по контактам, указанным выше</p>
			</div>
		</div>
		<div id="socials">
			<a href="https://vk.com/qagaz.daiyn" target="_blank">
				<img id="soc-vk" class="soc-img" src="images/vk.png">
			</a>
			<a href="https://t.me/qagazdaiyn" target="_blank">
				<img id="soc-tg" class="soc-img" src="images/tg.png">
			</a>
			<a href="https://www.youtube.com/channel/UCdVdMUEZ9LGwyoWQ_3UYBHA" target="_blank">
				<img id="soc-youtube" class="soc-img" src="images/youtube.png">
			</a>
			<a href="https://www.instagram.com/qagaz.daiyn/" target="_blank">
				<img id="soc-insta" class="soc-img" src="images/inst.png">
			</a>
			<a href="https://api.whatsapp.com/send?phone=77086273347" target="_blank">
				<img id="soc-wp" class="soc-img" src="images/wp.png">
			</a>
			<a href="https://www.facebook.com/qagaz.daiyn/" target="_blank">
				<img id="soc-fb" class="soc-img" src="images/fb.png">
			</a>
		</div>
		<div id="copyright">
			&copy; Daiyn Group <?php echo date("Y");?>
		</div>
	</div>
</body>
<script src="js/map.js"></script>
<script src="js/loadMore.js"></script>
</html>