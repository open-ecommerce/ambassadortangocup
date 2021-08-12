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
        }
        if ($ok) {
            $email = $_POST['email'];
            $votername = $_POST['votername'];
            if ($evote->sendVotingCode($email, $votername)) {
                $dialogue->appendMessage('Your code has being sent to your email', 'success');
            } else {
                $dialogue->appendMessage('Problems to send the code. This could be because you entered an invalid email', 'error');
            }
        }
        $_SESSION['message'] = serialize($dialogue);
        header('Location: /index');
    }
}
