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
</head>
<body>
	<div id="overlay">
		<div class="overlay-container">
			<p>Не закрывайте страницу, Ваши файлы загружаются на сервер</p>
			<div class="loader"></div>
		</div>
	</div>
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
		<div id="exts" class="cont">
			<div>Расширения</div>
			<div id="doc-sm" class="icon-sm"></div>
			<div id="docx-sm" class="icon-sm"></div>
			<div id="pdf-sm" class="icon-sm"></div>
		</div>
		<div id="dropzone" class="cont">
			<div class="drop-cont">
				<div id="drop-icon" class="drop-icon"></div>
				<p id="drop-text" class="drop-text">Перетащите файлы сюда или нажмите</p>
			</div>
			<input id="dropzone-input" type="file" name="files[]" multiple accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,image/jpeg,image/jpg,image/png" style="display: none;">
		</div>
		<div id="files" class="cont">
			<p>Ваши файлы <span id="files-number">0</span></p>
			<div id="files-cont">
				<div id="left-btn" class="btn"></div>
				<div id="carousel-cont">
					<div id="carousel">
					</div>
				</div>
				<div id="right-btn" class="btn"></div>
			</div>
		</div>
		<div id="copies" class="cont">
			<p>Копий <span id="currentFileName"></span>
				<span id="copies-tool">
					<button id="copies-minus" class="tool-btn">-</button>
					<span id="copies-sum">1</span>
					<button id="copies-plus" class="tool-btn">+</button> шт.
				</span>
			</p>
		</div>
		<div id="personal" class="cont">
			<p>Введите свои данные</p>
			<input id="email" type="text" placeholder="example@domain.com"><input id="phone" type="number" placeholder="87076663344"><button id="print">На печать</button>
		</div>
		<form id="epay-form" name="SendOrder" method="POST" action="https://epay.kkb.kz/jsp/process/logon.jsp">
			<input id="epay-signed-order" type="hidden" name="Signed_Order_B64" value="">
			<input id="epay-email" type="hidden" name="email" size="50" maxlength="50" value="">
			<input type="hidden" name="Language" value="rus">
			<input id="epay-backlink" type="hidden" name="BackLink" value="https://daiyn.com/order.php">
			<input type="hidden" name="FailureBackLink" value="https://daiyn.com/order_fail.php">
			<input type="hidden" name="PostLink" value="https://daiyn.com/postlink.php">
			<input type="hidden" name="FailurePostLink" value="https://daiyn.com/postlink_fail.php">
		</form>
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
<script src="js/main.js" charset="utf-8"></script>
<script src="js/dropzone.js" charset="utf-8"></script>
<script src="js/createHash.js" charset="utf-8"></script>
<script src="js/isAppropriateFile.js" charset="utf-8"></script>
<script src="js/addFilteredFiles.js" charset="utf-8"></script>
<script src="js/filesNumber.js" charset="utf-8"></script>
<script src="js/filesNumberRefresh.js" charset="utf-8"></script>
<script src="js/carouselButtons.js" charset="utf-8"></script>
<script src="js/show.js" charset="utf-8"></script>
<script src="js/createChild.js" charset="utf-8"></script>
<script src="js/getExtension.js" charset="utf-8"></script>
<script src="js/getName.js" charset="utf-8"></script>
<script src="js/shortenName.js" charset="utf-8"></script>
<script src="js/email.js" charset="utf-8"></script>
<script src="js/phone.js" charset="utf-8"></script>
<script src="js/print.js" charset="utf-8"></script>
<script src="js/copies.js" charset="utf-8"></script>
</html>
