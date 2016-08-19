<?php
include "Stack.php";

$stack = new Stack();
$stack->push(1);
$stack->push(2);
print_r($stack);
$stack->pop();
echo "<br>----------------------------------------------------------------------------<br>";
print_r($stack);
?>