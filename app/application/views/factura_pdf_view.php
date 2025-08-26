  <script>
  var appData = {
    uri_app : "<?= base_url() ?>",
    uri_ws  : "<?= base_url() ?>../webservice/",
    id_venta : <?=$idvent?>,
    correo : "<?=$this->session->correo ?>",
    nombre: "<?= $this->session->nombre ?>",
    token : "<?=$this->session->token ?>",
    id_usu : "<?=$this->session->id_usu ?>",
    id_cli : "<?=$this->session->id_cli ?>"
  }
</script>

<script>
		function imprimir() {
			document.getElementById("miboton").style.visibility = "hidden";
			window.print();
		}
	</script>

<div class="d-flex justify-content-between">
	

<?php 

$fec=$this->db->select("fech")->from("venta")->where("id",$idvent)->get()->result_array();

if (!empty($fec)) {
    $fecha=$fec["0"]["fech"];
} else {
    $fecha = " ";
    $idvent=0;
    $nombre="";
    $ap="";
    $am="";
    $ciudad = "";
    $col  ="";
    $calle  = "";
    $noint = "";
    $noext = "";
    $cp = "";

}


$consulta = $this->db->select("nombre,ap,am,ciudad,col,calle,noint,noext,cp")->from("venta")->join("cliente","venta.id_cli = cliente.id")->where("venta.id",$idvent)->get()->result_array();
if (!empty($fec)) {
$nombre = $consulta["0"]["nombre"];

$ap = $consulta["0"]["ap"];

$am = $consulta["0"]["am"];

$ciudad = $consulta["0"]["ciudad"];

$col  = $consulta["0"]["col"];

$calle  = $consulta["0"]["calle"];

$noint = $consulta["0"]["noint"];

$noext = $consulta["0"]["noext"];

$cp = $consulta["0"]["cp"];
}

?>


</div>


<div class="row mt-3">
<div class="col col-md-3">
	<h2>FACTURA</h2>
<table class="table">
		<tr>
			<th class="col-md-1">No°</th>
			<td><?=$idvent?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?=$fecha?></td>
		</tr>

</table>
</div>

<div class="col col-md-3">
	<h2>FACTURAR A</h2>
<table class="table">
		<tr>
			<th>Cliente</th>
			<td><?=$nombre?> <?=$ap?> <?=$am?></td>
</table>
</div>

<div class="col col-md-3">
	<h2>ENVIAR A</h2>
<table class="table">
		<tr>
			<th>Dirección</th>
			<td><?=$ciudad?> <?=$col?> <?=$calle?> <?=$noint?> <?=$noext?> <br /> CP: <?=$cp?></td>
</table>
</div>

<div class="col col-md-3">
<img src="<?=base_url()?>static/images/logo.jpeg" style="height: 100px;">
</div>


</div>


<table class="table table-horver" id="tabla-productos">
	<thead class="table-primary">
		<tr class="text-center">
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio unitario</th>
			<th>Importe</th>
		</tr>
	</thead>
	<tbody>

</tbody>
</table>

<input type="button" name="imprimir" id="miboton" value="Descargar factura" onclick="imprimir()">