<?php

class LanguageGame
{
    private array $words;
    private ?Word $currentWord = null;

    public function __construct()
    {
        // :: is used for static functions
        // They can be called without an instance of that class being created
        // and are used mostly for more *static* types of data (a fixed set of translations in this case)
        foreach (Data::words() as $frenchTranslation => $englishTranslation) {
            // TODO: create instances of the Word class to be added to the words array
            $this->words[] = new Word($frenchTranslation, $englishTranslation);
        }
    }

    public function run(): void
    {
        // TODO: check for option A or B
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'new_word') {
            $this->handleAnswer();
        } else {
            $this->currentWord = $this->getRandomWord();
        }

        // Option A: user visits site first time (or wants a new word)
        // TODO: select a random word for the user to translate

        // Option B: user has just submitted an answer
      
  

    }

    private function handleAnswer(): void {
        //Get the user's answer from the form submission
        $userAnswer = $_POST['user_answer'];

        $currentWord = $this->currentWord;

        // TODO: verify the answer (use the verify function in the word class) - you'll need to get the used word from the array first
        $isCorrect = $currentWord->verify($userAnswer);

        // TODO: generate a message for the user that can be shown
        $message = $isCorrect ? 'Correct! Well done!' : 'Incorrect. Try again.';
        echo $message;

    }

    private function getRandomWord():Word {
        return $this->words[array_rand($this->words)];
    }
}