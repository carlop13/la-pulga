<?='<?xml version="1.0" encoding="UTF-8" ?>'?>
<factura> 

<emisor> 
<razonsocial>Almacén La Pulga</razonsocial>
<domicilio>Col. Aguas Blancas. mpio. de tecpan de Galeana Gro., México</domicilio>
<correo>almacen.la.pulga@gmail.com</correo>
<telefono>+52 (742) 100 48 43</telefono>
</emisor>

<?php 
foreach ($factura as $row):
?>

<datos>
<?php 
foreach ($row as $campo => $valor):
?>

<<?= $campo ?>><?= $valor ?></<?= $campo ?>>

<?php 
endforeach;
?>
</datos>
<?php 
endforeach;
?>

<agradecer>Merci beaucoup pour votre achat</agradecer>

</factura>