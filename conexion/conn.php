<?php

$mysqli = new mysqli("10.1.3.73", "consulta_ipaseal", "Jyva33w0th", "ipaseal_planos");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>