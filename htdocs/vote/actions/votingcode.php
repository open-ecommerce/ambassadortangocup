<?php

require '../data/evote.php';
require '../data/Dialogue.php';
$evote = new Evote();
session_start();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $dialogue = new dialogue();
        $ok = true;
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['email'])) {
            $ok = false;
            $dialogue->appendMessage('You need to enter a valid email', 'error');
        } elseif (!$evote->checkEmail($_POST['email'])) {
            $ok = false;
            $dialogue->appendMessage('Please try again', 'error');
        }

        if ($ok) {
            $email = $_POST['email'];

            if ($evote->sendCode($email)) {
                $dialogue->appendMessage('Your code has being sent to your email', 'success');
            } else {
                $dialogue->appendMessage('Problems to send the code. This could be because you entered an invalid email', 'error');
            }
        }

        $_SESSION['message'] = serialize($dialogue);
        header('Location: /index');
    }
}
