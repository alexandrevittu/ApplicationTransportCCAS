$(document).ready(function () {
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