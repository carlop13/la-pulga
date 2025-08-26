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


<div class="d-flex justify-content-between">
	<a href="<?=base_url()?>frontend/historial/<?=$this->session->id_usu?>/<?=$this->session->token?>"><button class="bg-warning">Regresar a mis compras</button></a>

<?php 
$usua=$this->db->select("nombre")->from("usuario")->where("id",$this->session->id_usu)->get()->result_array();
$usuario=$usua["0"]["nombre"];

$fec=$this->db->select("fech")->from("venta")->where("id",$idvent)->get()->result_array();

if (!empty($fec)) {
    $fecha=$fec["0"]["fech"];
} else {
    $fecha = " ";
    $idvent=0;
    $nombre="";
    $ap="";
    $am="";
    $usuario = "";
}


$consulta = $this->db->select("nombre,ap,am")->from("venta")->join("cliente","venta.id_cli = cliente.id")->where("venta.id",$idvent)->get()->result_array();

if (!empty($fec)) {
$nombre = $consulta["0"]["nombre"];

$ap = $consulta["0"]["ap"];

$am = $consulta["0"]["am"];
}

?>

<?php if (!empty($fec)) : ?>
	<span>
		<small>
			Hola : <?=$this->session->nombre?>
		</small>
	</span>
<?php else : ?>
	<span>
		<small>
			Hola :
		</small>
	</span>
<?php endif; ?>

</div>


<div class="row mt-3">
<div class="col col-md-3">
<table class="table table-bordered table-secondary">
		<tr>
			<th class="col-md-1">Folio:</th>
			<td><?=$idvent?></td>
		</tr>
		<tr>
			<th>Fecha:</th>
			<td><?=$fecha?></td>
		</tr>
		<tr>
			<th>Usuario:</th>
			<td><?=$usuario?></td>
		</tr>
		<tr>
			<th>Cliente:</th>
			<td><?=$nombre?> <?=$am?> <?=$ap?></td>
		</tr>
</table>
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