<script>
    console.log("DENTRO");
    $("#form-login").submit(function (evt) {
        var self = this;
        alertify.log("Realizando peticion");
        console.log("DENTRO1");
        $.post("procesa.php", $(this).serialize(), function (resultado) {
            console.log("DENTRO2");
            alertify.log("Realizando peticion2");
<!--            --><?php
//            header("Location: http://localhost/funerariagallego/erp/index.php");
//            ?>
        });
        return false;
    });
</script>
