<?php
if ($c['level'] == "superadmin") {
	?>

	<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$query = mysqli_query($koneksi, "DELETE FROM tb_bank WHERE id = '$id' ");
		if ($query) {
			?>
			<script type="text/javascript">
				alert('Bank Data Deleted Successfully');
				window.location = '?page=bank';
			</script>
			<?php
		}
	}
	?>

	<?php
}else{
	?>
	<script type="text/javascript">
		window.location = "?page=dashboard";
	</script>
	<?php
}
?>