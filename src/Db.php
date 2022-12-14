<?php
    namespace Bendzsi\Vote;
    use PDO;
    use BadMethodCallException;

    class Db
    {
        private $pdo;
    
        public function __construct(string $host, string $dbName, string $muser, string $mpass)
        {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $muser, $mpass);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    
        public function __get($name)
        {
                    return $name == 'pdo' ? $this->pdo : null;
        }
    
        public function getQuestionWithAnswers(int $dayOfYear)
        {
            $stmt = $this->pdo->prepare(
                'SELECT * FROM questions 
                INNER JOIN answers 
                ON answers.question_id = questions.id 
                WHERE questions.id = ?'
            );
            $stmt->execute([$dayOfYear]);
            $result = $stmt->fetchAll();
            if ($result) {
                return $result;
            }
            throw new BadMethodCallException('Question not found');
        }
    
        public function saveNewAnswer(int $question_id, string $answer)
        {
            $stmt = $this->pdo->prepare('INSERT INTO answers (question_id, answer, votes) VALUES (?, ?, 1)');
            $stmt->bindValue(1, $question_id);
            $stmt->bindValue(2, $answer);
            $stmt->execute();
        }
    
        public function saveVote(int $answer_id)
        {
            $stmt = $this->pdo->prepare(
                'UPDATE answers 
                SET votes = votes + 1
                WHERE id = ?'
            );
            $stmt->bindValue(1, $answer_id);
            $stmt->execute();
        }
    }
    