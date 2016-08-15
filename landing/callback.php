<!DOCTYPE html>
<html>
<head>
	<title>DNA Wi-Fi Callback</title>
	<meta charset="UTF-8">
	<link rel="icon" href="img/favicon.png" type="image/gif" sizes="16x16">
	<!--favicon-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--tipografía-->
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="estilos_like.css">
	<link rel="stylesheet" type="text/css" href="estilos_footer.css">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.6&appId=133364597074539";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

	<div id="wrapper">
		<div id="header">
			<div id="tit">
				<h1>Síguenos en nuestras redes sociales</h1>
			</div>
			<div id="img">
				<img src="restaurante/logo.png">
			</div>
		</div><!--header-->
		<div id="sigue">
			<ul>
			<li id="like_face">
				<div id="cont_face" class="red">
					<img src="img/like.png">
				</div>
				<div id="face_bt" class="fb-like" data-href="https://facebook.com/brainssolvers" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
			</li>
			<li id="sigue_tw">
				<div id="tw" class="red">
					<img src="img/twitter.png">
				</div>
				<div id="tw_bt">
					<a href="https://twitter.com/BrainsSolvers" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @BrainsSolvers</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
			</li>
			<li id="follow_insta">
				<div id="inst" class="red">
					<img src="img/instagram.png">
				</div>
				<div id="inst_bt">
					<a href="https://www.instagram.com/annaba09/?ref=badge" class="ig-b- ig-b-v-24"><img src="img/inst_follow.png" alt="Instagram" /></a>
				</div>
			</li>
			</ul>
		</div><!--sigue-->
		<div id="nogracias" class="nogracias">
					<a href="http://www.ardente.com.mx">Siguiente</a>
		</div><!--nogracias-->
		<div id="footer">
			<div id="creado">
				<img src="img/herramienta.png" class="herramienta">
				<h2>Powered by</h2>
					<a href="http://www.brains.mx">
						<img src="img/brains.png" class="brains">
					</a>
					<a href="http://www.grupolirun.com.mx">
						<img src="img/lirun.png" class="lirun">
					</a>
			</div><!--creado-->
		</div><!--footer-->
	</div><!--wrapper-->

</body>
</html>
