<?php
/*
Template Name: Custom Vote Template
*/
?>

<?php
session_start();

// Session Management
if (!isset($_SESSION['username'])) {
    header("Location: /auth/login");
    exit;
}

require_once("{$_SERVER['DOCUMENT_ROOT']}/config/db-connection.php");

try {
    // Database Connection
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbPassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve candidate information from the database
    $candidatesStmt = $dbh->prepare("SELECT name, votes FROM candidates ORDER BY id ASC LIMIT 2");
    $candidatesStmt->execute();
    $candidates = $candidatesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the user has voted
    $user_id = $_SESSION['user_id'];
    $checkVoteStmt = $dbh->prepare("SELECT voted FROM users WHERE id = :user_id");
    $checkVoteStmt->bindParam(':user_id', $user_id);
    $checkVoteStmt->execute();
    $hasVoted = $checkVoteStmt->fetchColumn();

    // Voting Logic: Process vote if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$hasVoted) {
        $vote = $_POST['vote'];

        $updateStmt = $dbh->prepare("UPDATE candidates SET votes = votes + 1 WHERE name = :name");
        $updateStmt->bindParam(':name', $vote);
        $updateStmt->execute();

        $updateVotedStmt = $dbh->prepare("UPDATE users SET voted = 1 WHERE id = :user_id");
        $updateVotedStmt->bindParam(':user_id', $user_id);
        $updateVotedStmt->execute();

        header("Location: vote.php");
        exit;
    } elseif ($hasVoted) {
        $message = "You have already voted.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vote for Class Head</title>
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>
    <div class="main-container">
        <div class="side-panel">
            <h1>Vote for Class Head</h1>
            <?php if (!empty($message)) : ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <a href="/auth/logout" class="logout-button">Logout</a>
        </div>
        <div class="candidates-panel">
            <?php foreach ($candidates as $index => $candidate) : ?>
                <div class="candidate">
                    <img src="/path/to/placeholder/image<?php echo $index + 1; ?>.jpg" alt="Candidate <?php echo $index + 1; ?>" class="candidate-img">
                    <h2 class="candidate-name"><?php echo htmlspecialchars($candidate['name']); ?></h2>
                    <p class="votes-count">Votes: <?php echo htmlspecialchars($candidate['votes']); ?></p>
                    <?php if (!$hasVoted) : ?>
                        <form method="POST" action="vote.php">
                            <input type="hidden" name="vote" value="<?php echo htmlspecialchars($candidate['name']); ?>">
                            <input type="submit" value="Vote" class="vote-button">
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
