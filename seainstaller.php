<?php
$github_data = [
    'owner' => 'Averagemaipuperson',
    'repo' => 'SeaFuncs',
];

function get_raw_github_data(string $filePath) {
    global $github_data;
    $path = "https://api.github.com/repos/".$github_data['owner']."/".$github_data['repo']."/contents/seafuncs/".$filePath;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_USERAGENT, "PHP GitHub Client");

    $response = curl_exec($ch);
    curl_close($ch);

    $returned_data = json_decode($response, true);
    return base64_decode($returned_data['content']);
}

function insert(string $name, bool $dir = false, string $file_contents = '') {
    switch($dir) {
        case true:
            $dir_created = mkdir($name);
            if(!$dir_created) die("Fatal error: Failed creating ".$name." folder.");
        break;
        case false:
            $handle = fopen($name, "w");
            if(!$handle) die("Fatal error: File handle for ".$name." failed.");

            fwrite($handle, $file_contents);
            fclose($handle);
        break;
        default:
            die("Fatal error: \$dir bool is invalid.");
    }
    return;
}

$orig_dir = getcwd();
insert("seafuncs", true);
chdir("./seafuncs");

$folder_array = [
    'lib',
    'settings',
    'assets',
];

foreach($folder_array as $folder) {
    insert($folder, true);
}

$files_array = [
'seafuncs.php',
'lib/nanoLib.php',
'settings/config.php',
'assets/background.png',
'assets/function.png',
'assets/object.png'
];

foreach($files_array as $file) {
$raw_data = get_raw_github_data($file);
insert($file, false, $raw_data);
}

chdir($orig_dir);
$current_dir = realpath("./seafuncs");
exit("Done installing, your current SeaFuncs directory should be ".$current_dir);
