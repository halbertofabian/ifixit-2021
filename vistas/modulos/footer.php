<br>
<br>

<footer class="main-footer">

	<strong>Copyright &copy; 2020 <a href="https://softmormx.com/" target="_blank">Softmor</a>.</strong>

	Todos los derechos reservados.
	<?php

	date_default_timezone_set($_SESSION["zona"]);
	$fecha = date('Y-m-d');
	$hora = date('H:i:s');

	echo $fechaActual = $fecha . ' ' . $hora; ?>

</footer>
<!-- <section class="chat-container">
	<div class="chat-btn">
		Regalanos un like
	</div>
	<div class="chat-content">
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fsoftmor%2F&tabs=Mensajes&width=340&height=154&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="154" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>
</section> -->