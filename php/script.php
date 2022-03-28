<?php

// Parameters passed in the command.
$file_path = $argv[1];
$selected_row = $argv[2];
$param = RemoveSpecialChar($argv[3]);

// Check requested file is avialbe in the location or not.
if (!file_exists($file_path)) {
    echo "File does not Exist";
    return 0;
}

// Open file for reading.
$handle = fopen($file_path, "r");
if ($handle !== FALSE) {
    try {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!array_key_exists($selected_row, $data)) {
                continue;
            }

            if (RemoveSpecialChar($data[$selected_row]) == $param) {
                print_r(implode(',', $data));
                break;
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
// CLose file after reading.
fclose($handle);

/**
 * Remove special characters from the string.
 */
function RemoveSpecialChar($str)
{
    $res = preg_replace('/[\@\.\;\" "]+/', '', $str);
    return $res;
}
