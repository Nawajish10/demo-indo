<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Provider API Dashboard</h4>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sync Game List</h5>
                        <p>Synchronize game list from the provider to the local database.</p>
                        <button class="btn btn-primary" onclick="syncGames()">Sync Now</button>
                        <div id="syncResult" class="mt-3"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent API Logs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Provider / Action</th>
                                        <th>Request</th>
                                        <th>Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $logs = mysqli_query($koneksi, "SELECT * FROM tb_provider_logs ORDER BY created_at DESC LIMIT 20");
                                    while ($l = mysqli_fetch_array($logs)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $l['created_at']; ?></td>
                                        <td><?php echo $l['provider']; ?></td>
                                        <td><pre style="max-width: 200px; max-height: 100px; overflow: auto;"><?php echo htmlspecialchars($l['request']); ?></pre></td>
                                        <td><pre style="max-width: 200px; max-height: 100px; overflow: auto;"><?php echo htmlspecialchars($l['response']); ?></pre></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function syncGames() {
    $('#syncResult').html('<div class="alert alert-info">Syncing...</div>');
    $.ajax({
        url: 'page/sync_games_ajax.php',
        method: 'POST',
        success: function(response) {
            $('#syncResult').html('<div class="alert alert-success">' + response + '</div>');
        },
        error: function(xhr) {
            $('#syncResult').html('<div class="alert alert-danger">Sync failed: ' + xhr.responseText + '</div>');
        }
    });
}
</script>
