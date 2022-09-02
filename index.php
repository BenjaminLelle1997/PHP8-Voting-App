<?php

declare(strict_types=1);
use Bendzsi\Vote\BruteForceChecker;
use Bendzsi\Vote\Db;
use \Waavi\Sanitizer\Sanitizer;

require './vendor/autoload.php';
require './config/config.php';
// require './functions.php';

set_exception_handler(function(Throwable $e){
    echo $e->getMessage() . 'in' . $e->getFile() . 'on line ' . $e->getLine();
});




   $dayOfYear=213;
    //$dayOfYear = date('z')+1;

    // $data = json_decode(file_get_contents('./' . $dayOfYear . '.json'),true);
    // $totalVotes= array_sum($data['answers']);

    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $db_name = "frontend_voting";


    $db = new Db(
        host: $config['mysql']['host'],
        dbName: $config['mysql']['dbName'],
        muser: $config['mysql']['muser'],
        mpass: $config['mysql']['mpass'],
    );
    

    //$db= new Db($host,$db_name,$user,$pass);

    // echo substr(offset: 4, string: "Bendzsi", length:5); // named arguments ->zsi


    // try{
    //     $_data= $db->getQuestionWithAnswers($dayOfYear);

    // }catch(Exception $e){
    //     echo $e->getMessage() . 'in' . $e->getFile() . 'on line ' . $e->getLine();
    // }

    $_data = $db->getQuestionWithAnswers($dayOfYear);

    $data['question'] = $_data[0]['question'];
    foreach ($_data as $d) {
        $data['answers'][$d['answer']] = $d['votes'];
        $data['answer_ids'][$d['answer']] = (int) $d['id'];
    }
    unset($_data);
    
    $totalVotes = array_sum($data['answers']);
    
    // new answer
    if ($_POST['new-option']) {
    
    
        $sanitizer  = new Sanitizer($_POST, ['new-option' => 'trim|escape|capitalize']);
        $cleanedPost = $sanitizer->sanitize();
        $data['answers'][$cleanedPost['new-option']] = 1;
        $totalVotes++;
        $db->saveNewAnswer($dayOfYear, $cleanedPost['new-option']);
    }
    
    if ($_POST['vote']) {
        // brute force check
        $bruteForceChecker = new BruteForceChecker($db->pdo);
        $userVoted = $bruteForceChecker->isUserVotedInDelay();
        $bruteForceChecker->save();
    
        if (!$userVoted) {
            if (in_array($_POST['vote'], array_keys($data['answers']))) {
                $data['answers'][$_POST['vote']]++;
                $totalVotes++;
                $db->saveVote($data['answer_ids'][$_POST['vote']]);
            }
        }
    }
    
    require './template.php';
    