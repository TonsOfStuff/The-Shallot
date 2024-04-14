<?php
    try{
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM articles ORDER BY pageViews DESC LIMIT 15";
        $result = $db->query($query);
        $articles = $result->fetch_all(MYSQLI_ASSOC);

        $db->close();
    }
    catch (PDOException $e)
    {
        die("Query Incomplete: " . $e->getMessage());
    }


?>

<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Search Title</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>


        <link rel = "styleSheet" type = "text/css" href = "css/styleSheet.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>



    <header>
        <div class = "Header">
            <img src = "shallotLogo.png" class = "logoImage">
            <div class = "Logo">THE SHALLOT</div>
            <form action = "search.php" method = "post">
                <div class = "formSearch">
                    <span class="searchIcon material-symbols-outlined">search</span>
                    <input class = "searchfield" type = "search" placeholder="Search" name = "searcharticle">
                </div>
            </form>
        </div>
        <nav class = "Navbar">
            
            <div class = "Home"><a href = "index.php" style = "color: white;">Home</a></div>
            <div class = "AboutUs"><a href = "aboutUs.html" style = "color: white;" class = "aboutUsClass">About Us</a></div>
            <div class = "Contacts"><a href = "contacts.html" style = "color: white;">Contacts</a></div>
            <div class = "Competitions"><a href = "competitions.html" style = "color:white">Competitions</a></div>
            <div class = "Special"><a href = "#" id = "specialID" style = "color: white;">Special</a></div>
            <script src='script.js'></script>
        </nav>
    </header>


    <div class = "mainScreenTrending">
        <?php if (empty($articles)): ?>
            <div>No results!</div>
        <?php else:?>
            <?php foreach ($articles as $article): ?>
                <div class = "trendingArticleContainer">                   
                    <div class = "trendingArticleInfo">
                        <a href = "Articles/article.php?id=<?=$article["id"]?>">
                            <div class = trendingArticleAuthor style = "color: green"><?= htmlspecialchars($article["articleType"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "trendingArticleTitle"><?= htmlspecialchars($article["articleName"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "trendingArticleAuthor"><?= htmlspecialchars($article["articleAuthor_First"] . " " . $article["articleAuthor_Last"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "trendingArticleDate"><?= htmlspecialchars($article["articlePublicationDate"], ENT_QUOTES, 'UTF-8')?></div>
                        </a>
                    </div>

                    <?php if ($article["articleImage1"]): ?>
                        <img src = "images/<?=$article["articleImage1"]?>" alt = "Article Image" class = "trendingArticleImage">
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php endif;?>
                
    </div>


    <footer>
        <div class = "Footer-Motto"><b>The Shallot</b> loves providing engaging and entertaining stories to you and many others</div>
        <div class = "Useful-Links">
            <b>Useful Links:</b>
            <a href = "index.php"><div class = "Footer-Home">Home</div></a>
            <a href = "contacts.html"><div class = "Footer-Contacts">Contact</div></a>
            <a href = "aboutUs.html"><div class = "Footer-About">About Us</div></a>
            <a href = "special.php"><div class = "Footer-Special">Special Articles</div></a>
        </div>
    </footer>


</html>