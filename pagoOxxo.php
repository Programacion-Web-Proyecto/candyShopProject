<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="css/style7.css" media="all" rel="stylesheet" type="text/css">
		<title>Pago Oxxo</title>
	</head>
	<body>
		<div class="opps">
			<div class="opps-header">
				<div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
				<div class="opps-info">
					<div class="opps-brand"><img src="media/oxxoimg.png" alt="OXXOPay"></div>
					<div class="opps-ammount">
						<h3>Monto a pagar</h3>
						<h2>$ 0,000.00 <sup>MXN</sup></h2>
						<p>OXXO cobrará una comisión adicional al momento de realizar el pago.</p>
					</div>
				</div>
				<div class="opps-reference">
					<h3>Referencia</h3>
					<h1><?php  
					$a=mt_rand(1000,9999); 
					$b=mt_rand(1000,9999); 
					$c=mt_rand(1000,9999); 
					$d=mt_rand(10,99); 
					echo $a,"-",$b,"-",$c,"-",$d ;?></h1>
				</div>
			</div>
			<div class="opps-instructions">
				<h3>Instrucciones</h3>
				<ol>
					<li>Acude a la tienda OXXO más cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encuéntrala aquí</a>.</li>
					<li>Indica en caja que quieres realizar un pago de servicio<strong></strong>.</li>
					<li>Dicta al cajero el número de referencia en esta ficha para que tecleé directamete en la pantalla de venta.</li>
					<li>Realiza el pago correspondiente con dinero en efectivo.</li>
					<li>Al confirmar tu pago, el cajero te entregará un comprobante impreso. <strong>En el podrás verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
				</ol>
				<div class="opps-footnote">Al completar estos pasos recibirás un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
			</div>
		</div>	
    </body>
	<?php
    include "html/footer.html";
    ?>
</html>	
