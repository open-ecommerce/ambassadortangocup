<?php
if (!$evote->ongoingSession()) {
    echo "<p><h3>There is nothing to vote on at the moment.</h3></p><br>";
} else {
    $ongoing = $evote->ongoingRound();

    if (!$ongoing) {
        echo "<p><h3>There is nothing to vote on at the moment.</h3></p><br>";
    } else {
        $res = $evote->getOptions();
        if ($res->num_rows > 0) {
            ?>
            <div class="well small-centered"">
                <div class="logo">
                    <img id="logo-header" src="tango-vote-logo.png" />
                </div>
                <form action="actions/votingcode.php" method="POST" autocomplete="off">
                    <div class="vote-code">
                        <label >Enter your name:</label>
                        <input type="text" class="form-control" name="votername">
                        <label >Enter your email to get a code to vote:</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="vote-button text-center">
                        <button type="submit" class="btn-lg btn-primary" value="getcode" name="button" >Get your code to vote!</button>
                    </div>
                </form>
            </div>
            <?php
        }
    }
}
?>
