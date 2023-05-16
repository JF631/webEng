<!DOCTYPE html>

<html>
    
</html>

<?php
// Define the directory to scan
$dir = "/home/jfaust/WebEng/Woche2";

// Open the directory
if (is_dir($dir)){
    echo "<table>";
    echo "<tr><th>Name</th><th>Type</th><th>Size</th></tr>";
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if (substr($file, 0, 1) !== '.') {
                $path = $dir . '/' . $file;
                if (is_dir($path)) {
                    $type = 'Folder';
                    $size = '-';
                    echo "<tr><td><a href='?dir=$path'>$file</a></td><td>Folder</td><td>-</td></tr>";
                } else {
                    $type = pathinfo($dir.'/'.$file, PATHINFO_EXTENSION).' file';
                    $size = filesize($dir.'/'.$file).' bytes';
                    echo "<tr><td><a href='$dir/$file'>$file</a></td><td>$type</td><td>$size</td></tr>";
                }
            }
        }
        closedir($dh);
    }
    echo "</table>";

} else {
    echo "Directory not found.";
}
?>
