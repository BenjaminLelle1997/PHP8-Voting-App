# PHP Voting App

1. Create the app
- create and votes for questions -> 1 question for a day 
   
  Day 213 -> What is your favourite JS frontend framework? 
          Vue 50%, React 3%, Svelte 1%, Angular 2%, jQuery 40%

- index.html->php + css -> the main page, embedded PHP with HTML syntax 
  <?php ... ?> , <?= ?> == <?php echo ...?>
    //$dayOfYear = date('z')+ 1; // return with the day or $day..=213

   // #<?= $dayOfYear ?> <? = data['questions'] ?> ?
      #Day 213     What is your favourite JS frontend framework? 

-> loop with foreach ( $data['answers'] ) the hashed answers (as $a=>$v ) + print out vote result with round function
-> rename template.php


- 213.php for a day 
  -> store questions and aswers in array($data = data['questions'],data['answers']), 
     answers have result in array as Hash (in template: data['answers'] as $key=>$value),
     in template require(213.php) and use $data variable 


- new index.php -> require(template.php), handling votes
  - store $data array and answers in new array variables( array function)
  - checking
   - if somebody voted (POST function as add answers (click on Vote,React...) ) and
   - if hash key(Vue,React..) exists is array 
   - compare posted answers and keys of array( in_array ("Vue", array_keys ($data['answers']) )
     -> increment the value of key (like a 2D array)
     -> print out result to JSON -> convert 213.php to json
     (need chmod 666 or 777 213.json)

2. Adding new answers
- template.php -> new input for new answer
- index.php -> check if somebody add new answers + saving original votes, file writing moved
  -> if new answer added to JSON the count is 1
- new functions.php -> implements votes saving and  file writing
- download Composer package manager (like npm for JS) 
-> Documentation Installation -> cmd php ... or Donwload
-> cmd: composer init -> src + vendor folders + gitignore
-> donwload waavi/sanitizer -> PHP package for filtering answers -> convert our app to PHP package
-> add some functions to template and index 
-> use instead of require, filters array(cut trims,escapes,first letter big)


3. Refactoring and Debugging

a) Refactoring - code optimaliziting, refreshing, updating
- composer updating -> if need new dependencies
- refactoring in index.php -> add true param to json_decode
- remove array functions for $data and $answers
- newOption changed to cleanedPost -> no clean all POST array
- bug fixing: if add "vue" as new answer -> result changed to 1 -> no good
- $filter used once -> delete -> content add sanitizer function

b) Debugging -> xdebug3 extension of PHP 
-> need install Wizard -> php -i or new file phpinfo -> tell me everything about PHP running -> copy content and paste to wizard install page -> Analize -> how to donwload and use in cmd and what file to change
-> PHP Debug extension -> Run and Debug -> create launch (it will run 9003 port) -> 3 config -> 1. Vs handling, 2. PHP script handling, 3. checking server

-> launch build-in-server  + using xdebug extension in chrome

- increment totalVotes 

4. Writing own objects and brute force security

- brute force attacks ->  when sy logged in and another one is hacking
-> need to stop cracking passwords
- a user can't vote again in 20 minutes 
 -> 213-votes.csv -> stores from which IP address and when sy voted for a day

- bruteforcechecker.php with basic OOP -> visibility: private,public -
  -> save() for csv ('a' for open file only to write) + check() for counting votes in 20 minutes
    (array_reverse for lines,explode for separate)-> still add votes
     -> add some function to index and template

5. Type hints

- PHP have lazy typed variables (not check type) 
  -> you can add any type to a variable
  -> add error to index.php to complete user voting
  -> refactoring error variable + reanem check to isuservotedindelay in bruteforcechecker -> return bool
  -> add some css

  -> type hinting + return -> int $dayOfYear, array $data : int or void or mixed or bool(at construct no add)  -> and setting in class
  - index add strict type checking
  -> minify css -> index-min.css

6. MYSQL
- PDO class -> prepared statements, SQL injection(prepare), type casting,get,binvalue(change 1.? to question_id) config file, saveVotes->saveNewAnswer, new savevotes function
- refactor bruteforce(db), template(error+db), index
-> index parallel arrays
- delete 213.json and csv,functions.php
- mwb -> mysql workbrench file
- 1 db, 3 tables
questions:id,question 1-N kapcsolat answers:id, question_id,answer,votes


7. Named arguments

- change args orders in function and named it
-refactoring DB: change args order at construct + add string type -> type hinting
- refactoring and naming config array of db construct in index.php: host:$config[mysql][host],db.. 

8. Operators (ternary,null coalescing, null safe )
- reduce noise of code
- operators.php  

9. PSR code standards
- php standards
- PHP intelliphense, code sniffer
php-fig.org/psr
squizlabs/PHP_CodeSniffers 
-> smell,analyze php 
phpcs --standard=PSR12 --colors src
phpcbf
GitKraken

10. Exceptions

- exception in Db at get question + add try-catch in index there,not need

11. Unit testing
- new class Profanity Filter -> test classes for Db,BruteForce and Profanity

phpunit
composer download -> vendor/bin/phpunit -> xml


TDT -> test driven
-> 1. test writing -> 2. app -> mulitpliewords

setup -> run before tests
teardown -> run after test (use for static variables, not allow to effect each of them test functions )

-> one function --> vendor... test/..php --filter testOK


- test has isolated running -> indepent from each parts of app e.g at BruteForce -> connect db,query
-> mocks -> create false object to test

code coverage -> xml settings -> create html


12. Frameworks
Slim,Symfony,Laravel,Yi,CakePHP,CodeIgniter

13. Using CMD
- money currency exchange
cmd,get-rate,Requester

php getrates

crontab -l