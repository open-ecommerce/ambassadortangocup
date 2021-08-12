<?php

require '../data/evote.php';
require '../data/Dialogue.php';
$evote = new Evote();
session_start();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'getcode') {
        $dialogue = new dialogue();
        $ok = true;
        echo "viva peron";
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['email'])) {
            $ok = false;
            $dialogue->appendMessage('You need to enter a valid email', 'error');
            echo "no hay email";
        } elseif (!$evote->votermailExists($_POST['email'])) {
//            $ok = false;
//            $dialogue->appendMessage('The email entered was already used', 'error');
//            echo "email duplicado";
        }
        if ($ok) {
            $email = $_POST['email'];

            if ($evote->sendCode($email)) {
                $dialogue->appendMessage('Your code has being sent to your email', 'success');
            } else {
                $dialogue->appendMessage('Problems to send the code. This could be because you entered an invalid email', 'error');
            }
            echo "is ok";
        } else {
            echo "is not ok";
        }

//        $_SESSION['message'] = serialize($dialogue);
//        header('Location: index');
    }
}
