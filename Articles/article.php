<?php
$articleId = isset($_GET['id']) ? $_GET['id'] : null;

if ($articleId) {
    try {
        require_once "../includes/dbh.inc.php";

        $query = "SELECT * FROM articles WHERE id = ?";
        
        $stmt = $db->prepare($query);

        $stmt->bind_param("i", $articleId);
        $stmt->execute();

        $result = $stmt->get_result();
        $article = $result->fetch_assoc();

        $query = "UPDATE articles SET pageViews = pageViews + 1 WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $articleId);
        $stmt->execute();

        $stmt->close();
        $db->close();

    } catch (mysqli_sql_exception $e) {
        die("Query Failed: " . $e->getMessage());
    }

    
} else {
    echo "<div>";
    echo "<p>Invalid article ID!</p>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Article Title</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='../css/styleSheet.css'>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>

    <header style = "position:relative; z-index:1">
        <div class = "Header">
            <img src = "../shallotLogo.png" class = "logoImage" alt = "Logo">
            <div class = "Logo">THE SHALLOT</div>
            <form action = "../search.php" method = "post">
                <div class = "formSearch">
                    <span class="searchIcon material-symbols-outlined">search</span>
                    <input class = "searchfield" type = "search" placeholder="Search" name = "searcharticle">
                </div>
            </form>
        </div>
        <nav class = "Navbar">
            
            <div class = "Home"><a href = "../index.php" style = "color: white;">Home</a></div>
            <div class = "AboutUs"><a href = "../aboutUs.html" style = "color: white;" class = "aboutUsClass">About Us</a></div>
            <div class = "Contacts"><a href = "../contacts.html" style = "color: white;">Contacts</a></div>
            <div class = "Competitions"><a href = "../competitions.html" style = "color:white">Competitions</a></div>
            <div class = "Special"><a href = "#" id = "specialID" style = "color: white;">Special</a></div>
            <script src='../script.js'></script>
        </nav>
        <div id = "scrollBar"></div>
        <script src = "scrollBar.js"></script>
    </header>

    <div class = "mainScreen">
        
        <?php if ($article) : ?>
            <?php if ($article["articleImage1"]): ?>
                <div class = "articleImageContainer">
                    <img src = "../images/<?=$article["articleImage1"]?>" class = "articleTopImage" alt = "ArticleImage">
                    <div class="articleImageOverlay">
                        <div class="articleImageTitleOverlay"><?= htmlspecialchars($article["articleName"]) ?></div>
                    </div>
                </div>
            <?php endif?>
            <div class="articleDiv">
                <div class = "articleCardTitle">
                    <h1 style = "margin: 20px 0px 0px 0px;"><?= htmlspecialchars($article["articleName"]) ?></h1>
                </div>
                <div class = "articleContent"><?= nl2br(htmlspecialchars($article["articleContent"])) ?></div>
            </div>
        <?php else : ?>
            <div>
                <p>Article not found!</p>
            </div>
        <?php endif; ?>
    </div>
    
    <footer>
        <div class = "Footer-Motto"><b>The Shallot</b> loves providing engaging and entertaining stories to you and many others</div>
        <div class = "Useful-Links">
            <b>Useful Links:</b>
            <a href = "../index.php"><div class = "Footer-Home">Home</div></a>
            <a href = "../contacts.html"><div class = "Footer-Contacts">Contact</div></a>
            <a href = "../aboutUs.html"><div class = "Footer-About">About Us</div></a>
            <a href = "../special.php"><div class = "Footer-Special">Special Articles</div></a>
        </div> 
    </footer>
</html>