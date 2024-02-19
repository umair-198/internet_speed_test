<?php
if(isset($_POST['test_speed'])){
    // Get start time
    $start_time = microtime(true);
    
    // Simulate upload speed calculation
    usleep(3000000); // Simulate 3 seconds of upload time
    
    // Simulate download speed calculation
    usleep(2000000); // Simulate 2 seconds of download time
    
    // Get end time
    $end_time = microtime(true);
    
    // Calculate total time taken
    $total_time = $end_time - $start_time;
    
    // Calculate upload speed (bytes per second)
    $upload_speed = (1024 * 1024) / ($total_time); // 1MB divided by total time in seconds (bytes per second)
    
    // Simulate another download speed calculation
    usleep(1500000); // Simulate 1.5 seconds of download time
    
    // Get the new end time after the second download operation
    $end_time = microtime(true);
    
    // Calculate the new total time taken for download
    $total_time = $end_time - $start_time;
    
    // Calculate download speed (bytes per second)
    $download_speed = (1024 * 1024) / ($total_time); // 1MB divided by total time in seconds (bytes per second)
    
    // Calculate overall speed (average of upload and download speeds)
    $overall_speed = ($upload_speed + $download_speed) / 2;
    
    // Return results as JSON
    header('Content-Type: application/json');
    echo json_encode(array('upload_speed' => $upload_speed, 'download_speed' => $download_speed, 'overall_speed' => $overall_speed));
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Live Internet Speed Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Live Internet Speed Test</h2>
    <div id="result"></div>

    <script>
    $(document).ready(function() {
        // Function to fetch speed data from the server and update the display
        function fetchSpeedData() {
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: { test_speed: true },
                dataType: 'json',
                success: function(response) {
                    $('#result').html('<h3>Live Results:</h3>' +
                                     '<p>Upload Speed: ' + (response.upload_speed / 1024).toFixed(2) + ' KB/s</p>' +
                                     '<p>Download Speed: ' + (response.download_speed / 1024).toFixed(2) + ' KB/s</p>' +
                                     '<p>Overall Speed: ' + (response.overall_speed / 1024).toFixed(2) + ' KB/s</p>');
                }
            });
        }

        // Fetch speed data every 5 seconds
        setInterval(fetchSpeedData, 1000); // Adjust the interval as needed
    });
    </script>
</body>
</html>


