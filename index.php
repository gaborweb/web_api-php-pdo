<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title>Final exam</title>
</head>
<body>

	<div class="container">

		<h3>Termék értékesítések</h3>

		<div align="right" style="margin-bottom:10px;">
			<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Hozzáadás</button>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Terméktípus</th>
						<th>Darabszám</th>
						<th>Terméknév</th>
						<th>Ár</th>
						<th>Vásárló</th>
						<th>Szerkesztés</th>
						<th>Törlés</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>

		<div align="left">
			<button type="button" class="btn btn-dark btn-sm" onclick="location.href='login.php'">Kilépés</button>
		</div>
	</div>

	<div id="apicrudModal" class="modal fade" role="dialog">

		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" id="api_crud_form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Adatrögzítés</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Terméktípus</label>
							<select id="termekId" name="termekId" class="form-control col-lg-10 form-control-sm" required>
								<option value="1">élelmiszer</option>
								<option value="2">elektronika</option>
								<option value="3">háztartás</option>
								<option value="4">élvezeti cikk</option>
							</select>
						</div>
						<div class="form-group">
							<label>Darabszám</label>
							<input type="text" name="darab" id="darab" class="form-control">
						</div>
						<div class="form-group">
							<label>Terméknév</label>
							<input type="text" name="termeknev" id="termeknev" class="form-control">
						</div>
						<div class="form-group">
							<label>Ár</label>
							<input type="text" name="ar" id="ar" class="form-control">
						</div>
						<div class="form-group">
							<label>Vásárló</label>
							<input type="text" name="vasarlo" id="vasarlo" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="hidden_id" id="hidden_id">
						<input type="hidden" name="action" id="action" value="insert">
						<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Rögzít">
						<button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
					</div>
				</form>
			</div>
		</div>

	</div>

	<script>

		$(document).ready(function() {

			fetch_data();

			function fetch_data() {

				$.ajax({

					url: "fetch.php",
					success: function(data) {
						$("tbody").html(data);
					}
				});
			}

			$("#add_button").click(function() {

				$("#api_crud_form").trigger("reset");

				$("#action").val("insert");
				$("#button_action").val("Rögzít");
				$(".modal-title").val("Add Data");
				$("#apicrudModal").modal("show");
			});

			$("#api_crud_form").on("submit", function(event) {

				event.preventDefault();

				if ($("#darab").val() == "") {

					alert("Adja meg a darabszámot");
				} else if ($("#termeknev").val() == "") {

					alert("Adja meg a termék nevét");
				} else if ($("#ar").val() == "") {

					alert("Adja meg a termék árát");
				} else if ($("#vasarlo").val() == "") {

					alert("Adja meg a vásárló nevét");
				} else {

					var form_data = $(this).serialize();

					$.ajax({

						url: "action.php",
						method: "POST",
						data: form_data,
						success: function(data) {

							fetch_data();
							$("#api_crud_form")[0].reset();
							$("#apicrudModal").modal("hide");
							if (data == "insert") {

								alert("Sikeres rögzítés");
							}
							if (data == "update") {

								alert("Adat frissítve");
							}
						}
					});
				}
			});

			$(document).on('click', '.edit', function() {

				var id = $(this).attr("id");
				var action = "fetch_single";

				$.ajax({

					url: "action.php",
					method: "POST",
					data: {
						id: id,
						action: action
					},
					dataType: "json",
					success: function(data) {

						$("#hidden_id").val(id);
						$("#termekId").val(data.termekId);
						$("#darab").val(data.darab);
						$("#termeknev").val(data.termeknev);
						$("#ar").val(data.ar);
						$("#vasarlo").val(data.vasarlo);
						$("#action").val("update");
						$("#button_action").val("Szerkeszt");
						$(".modal-title").text("Edit Data");
						$("#apicrudModal").modal("show");
					}
				});
			});

			$(document).on("click", ".delete", function() {

				var id = $(this).attr("id");
				var action = "delete";

				if (confirm("Biztos törölni szeretne?")) {

					$.ajax({

						url: "action.php",
						method: "POST",
						data: {
							id: id,
							action: action
						},
						success: function(data) {

							fetch_data();
							alert("Törölve");
						}
					});
				}
			});

		});
	</script>

</body>

</html>