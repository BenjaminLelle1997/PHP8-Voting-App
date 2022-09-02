<?php
    error_reporting(E_ALL);

    $name='Bendzsi';
    // ternary
    $channel = ($name == 'Bendzsi') ? 'Benjamin Sassak' : 'null';

    echo $search = $_GET['search'] ?: 'all'; // if true ?: no repeat get search
    //http://localhost/PHP/Voting App/operators.php?search=Bendzsi

    // null coalescing -> 0 or not 0
    echo $search = $_GET['search'] ?? 'all'; // 0 

    // older version for this isset function
    //if(isset($_GET['search'])) ...

    // optional chaining or null safe -> objects calling in REST API
    $users=[
        [
            'name' => 'Bendzsi',
            'stack' => [
                'frontend' => 'JS'
            ]
        ],
        [
            'name' => 'Bendzsi',
            'stack' => null
        ]
    ];

    echo "\n\n";
    $users = json_decode(json_encode($users), true);
    foreach($users as $u){
        echo $u->name . ': ' . $u->stack?->frontend . "\n";
    }
?>