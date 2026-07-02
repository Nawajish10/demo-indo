<?php

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$query = mysqli_query($koneksi, "UPDATE tb_user SET status_game = 'offgame' WHERE id = '$id' ");

		if ($query) {
			?>
			<script type="text/javascript">
				alert('User Game Status Deactivated Successfully');
				window.location = "?page=user";
			</script>
			<?php
		}else{
		    ?>
			<script type="text/javascript">
				alert('Failed to Deactivate User Game Status');
				window.location = "?page=user";
			</script>
			<?php
		}
	}

	?>