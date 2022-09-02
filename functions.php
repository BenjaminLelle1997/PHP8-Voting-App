<?php 
 
function saveVotes(int $dayOfYear,array $data): void {
    $fh= fopen('./' . $dayOfYear . '.json', 'w');
    fwrite($fh, json_encode($data));
    fclose($fh);
}
?>