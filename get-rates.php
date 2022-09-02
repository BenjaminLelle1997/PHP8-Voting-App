<?php
    use Bendzsi\Vote\Requester;
    require __DIR__ . './vendor/autoload.php';
    require __DIR__ . './config/config_cmd.php';

    $requester = new Requester($config);
    $rates=$requester->getRates('ETH','HUF'); // bitcoin in USD
    
    $fh= fopen(__DIR__ .  '/data.csv', 'a');
    fputcsv($fh,[date('Y-m-d H:i:s'), $rates['HUF']]);
    fclose($fh);

?>