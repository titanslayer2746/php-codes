<?php
// Define a safe directory to store PDFs
$directory = __DIR__ . "/files/";

// Get file name from GET and sanitize it (prevent directory traversal)
if (isset($_GET["file"])) {
    $filename = basename($_GET["file"]) . ".pdf";
    $filepath = $directory . $filename;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set headers for download
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . urlencode($filename));
        header("Content-Length: " . filesize($filepath));
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Expires: 0");

        // Read and output the file
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    } else {
        echo "Error: File not found.";
    }
} else {
    echo "Error: No file specified.";
}
?>
