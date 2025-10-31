<?php
$arreglo=array();
$cont=20;

while($cont>0){
 array_push($arreglo,rand(1,20));
 $cont--;
}

echo"<pre>";
var_dump($arreglo);
echo"</pre>";
$numero=rand(1,20);

echo encontrarPos($numero,$arreglo);

function encontrarPos($numero,$arreglo){

  for($i=0;$i<count($arreglo);$i++){

    for($j=$i+1;$j<count($arreglo);$j++){

        if($arreglo[$i]+$arreglo[$j]==$numero)
            return " Las posiciones donde la suma de los numeros es igual a $numero son $i y $j (".$arreglo[$i].'+'.$arreglo[$j]."=$numero)";
    }

  }

  return "No se encontraron coincidencias";

}
?>