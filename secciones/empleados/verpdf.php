<!DOCTYPE html>
<html>
<head>
	<title>Visualizar PDF en HTML</title>
    <style>
		iframe {
            position: absolute;
			border: none;
			overflow: hidden;
		}
	</style>
</head>
<?php $docnom=(isset($_GET['docnom']))?$_GET['docnom']:"";
?>

<body>
	<iframe id="miIframe" src="<?php echo './cvEmpleados/'.$docnom ?>" width="100px" height="100px"></iframe>
    <script>
		var ancho = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		var alto = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

		var iframe = document.getElementById("miIframe");
		iframe.style.width = (ancho-20) + "px";
		iframe.style.height = (alto-20) + "px";
	</script>
</body>
</html>
