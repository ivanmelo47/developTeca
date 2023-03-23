<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT *,(SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    /*print_r($registro);*/
    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];
    $nombreCompleto=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido;

    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $idpuesto=$registro["idpuesto"];
    $puesto=$registro["puesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    /* Funcion en PHP para calcular años */
    $fechaInicio = new DateTime($fechadeingreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            /* background-color: blue; */
        }
        .ajustar {
            text-align: justify;
        }
        .centrar {
            text-align: center;
        }
        @page {
		margin: 2cm;
	    }
    </style>

    <title>Carta de recomendacion</title>
</head>
<body>
    <div class="ajustar">
    <h1>Carta de recomendacion Laboral</h1>
    <br><br>
    Merida Yucatan, Mexico a <strong> <?php echo date('d M Y'); ?> </strong>
    <br><br>
    A quien pueda interesar:
    <br><br>
    Reciba un cordial y respetuoso saludo.
    <br><br>
    A traves de estas lineas deseo hacer de su conocimiento que el(a) Sr(a) <strong> <?php echo $nombreCompleto ?></strong>,
    quien laboro en mi organizacion durante <strong> <?php echo $diferencia->y;?> año(s) </strong>
    es un ciudadano con una conducta intachable. Ha desmostrado ser una gran trabajador,
    comprometido, responsable y fiel cumplidor de sus tareas.
    Siempre ha manifestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos.
    <br><br>
    Durante estos anios se ha desempenado como: <strong> <?php echo $puesto?></strong>.
    Es por ello le sugiero considere esta recomendacion, con la confianza de que estara siempre a la altura de sus compromisos y responsabilidades.
    <br><br>
    Sin mas nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi numero de contacto para cualquier informacion de interes.
    <br><br><br><br><br><br><br><br>
    <div class="centrar">
    ____________________________________
    <br>
    Atentamente,
    <br>
    Ing. Marcos Aguilera Uh.
    </div>
    </div>
</body>
</html>

<?php
/* -->TODA ESTA SECCION DE CODIGO SE USARA PARA RECOLECTAR LA INFORMACION DEL HTML ANTERIOR E IMPRIMIRLA EN UN PDF */
$HTML=ob_get_clean();

require_once("../../libs/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('Letter'); /* Tamanio del papel del PDF */
$dompdf->render();
$dompdf->stream("carta_$nombreCompleto.pdf", array("Attachment"=>false));


?>