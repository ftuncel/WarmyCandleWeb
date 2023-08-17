<?php
if (isset($_SESSION['status']) && $_SESSION['status'] === "ok") { ?>

    <div class="alert alert-success">
        <p> Güncelleme başarılı </p>
    </div>

<?php

} else if (isset($_SESSION['status']) && $_SESSION['status'] === "fail") { ?>

    <div class="alert alert-danger">
        <p> Güncelleme başarısız ! </p>
    </div>

<?php }
unset($_SESSION['status']);
?>