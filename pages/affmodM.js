// JavaScript Document

$(document).ready(function () {

    /* Data Insert Starts Here */ //Afficher le message sur la page de modification
    $(document).on('submit', '#emp-Save', function () {

        $.post("validationModif.php", $(this).serialize())
                .done(function (data) {
                    $("#dis").fadeOut();
                    $("#dis").fadeIn('slow', function () {
                        if (data === "La date de notification n\'est pas valide !") {
                            $("#dis").html('<div class="alert alert-danger">' + data + '</div>');
                        } else {
                            $("#dis").html('<div class="alert alert-info">' + data + '</div>');
                        }
                    });
                });
        return false;
    });
    //Pour afficher le message sur la page d'accueil après l'ajout.
    $(document).on('submit', '#emp-SaveForm', function () {

        $.post("create.php", $(this).serialize())
                .done(function (data) {
                    $("#dis").fadeOut();
                    $("#dis").fadeIn('slow', function () {
                        if (data === "La date de notification n\'est pas valide !") {
                            $("#dis").html('<div class="alert alert-danger">' + data + '</div>');
                        } else {
                            $("#dis").html('<div class="alert alert-info">' + data + '</div>');
                        }
                        /* $("#emp-SaveForm")[0].reset();*/
                    });
                });
        return false;
    });
    //Pour afficher le message sur la page de supression après la suppression.
    $(document).on('submit', '#formSupp', function () {

        $.post("validerSupp.php", $(this).serialize())
                .done(function (data) {
                    $("#dis").fadeOut();
                    $("#dis").fadeIn('slow', function () {
                        if (data === "Erreur de suppression") {
                            $("#dis").html('<div class="alert alert-danger">' + data + '</div>');
                        } else {
                            $("#dis").html('<div class="alert alert-info">' + data + '</div>');
                        }
                        $("#formSupp")[0].reset();
                    });
                });
        return false;
    });
});

