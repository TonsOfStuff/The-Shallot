<?php


    try{
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM articles ORDER BY id DESC LIMIT 3";
        $result = $db->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $query = "SELECT * FROM articles ORDER BY pageViews DESC LIMIT 5";
        $result = $db->query($query);
        $rowsPopular = $result->fetch_all(MYSQLI_ASSOC);

        $db->close();

    }catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }


?>




<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <title>The Shallot</title>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link rel = "styleSheet" type = "text/css" href = "css/styleSheet.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@100;300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    </head>
    
    <body>

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
            
            <div class = "Home" style = "background-color: #DCF7C4;"><a href = "index.php">Home</a></div>
            <div class = "AboutUs"><a href = "aboutUs.html" style = "color: white;" class = "aboutUsClass">About Us</a></div>
            <div class = "Contacts"><a href = "contacts.html" style = "color: white;">Contacts</a></div>
            <div class = "Competitions"><a href = "competitions.html" style = "color:white">Competitions</a></div>
            <div class = "Special"><a href = "#" id = "specialID" style = "color: white;">Special</a></div>
            <script src='script.js'></script>
        </nav>
    </header>

    <main>

        <!--Sidebar / Trending-->
        <div class = "Sidebar">
            <a href = "trending.php" style="color: green">Trending:</a>
            <?php if(empty($rowsPopular)): ?>
                <p>No results!</p>
            <?php else: ?>
                <?php foreach($rowsPopular as $rowPopular): ?>
                    <div class = "trendingArticles">
                        <a href="Articles/article.php?id=<?= $rowPopular['id'] ?>">
                            <div class = "sideArticleType"><?php echo htmlspecialchars($rowPopular["articleType"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "sideArticleAuthor"><?php echo htmlspecialchars($rowPopular["articleAuthor_First"] . " " . $rowPopular["articleAuthor_Last"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "sideArticleTitle"><?php echo htmlspecialchars($rowPopular["articleName"], ENT_QUOTES, 'UTF-8')?></div>
                            <div class = "sideArticleDate"><?php echo htmlspecialchars($rowPopular["articlePublicationDate"], ENT_QUOTES, 'UTF-8')?></div>
                        </a>
                    </div>
                <?php endforeach?>
            <?php endif?>
        </div>




        <!--1st Article-->
        <div class = "Article-1">
            <img src = "images/<?=$rows[0]["articleImage1"]?>" class = "Article-1-Image" alt = "Image1">
        
            <div class = "Article-1-Explanation">
                <!--Article Type-->
                <div class = "Article-Type">
                    <?php if (isset($rows[0]["articleType"])) : ?>
                        <?php echo htmlspecialchars($rows[0]["articleType"], ENT_QUOTES, 'UTF-8'); ?><br>
                    <?php else : ?>
                        <div>Breaking News</div>
                    <?php endif; ?>
                </div>
                <!--Article Title-->
                <div class = "Article-Title">
                    <?php if (isset($rows[0]["articleName"])) : ?>
                        <a href="Articles/article.php?id=<?= $rows[0]['id'] ?>"><?php echo htmlspecialchars($rows[0]["articleName"], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php else : ?>
                        <div>No article available</div>
                    <?php endif; ?>
                </div> <br>

                <!--Article Summaries-->
                <div class = "articleSummaries">            
                    <?php if (isset($rows[0]["summary1"])) : ?>
                        <div> -<?php echo htmlspecialchars($rows[0]["summary1"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                    <?php endif; ?>
                    <?php if (isset($rows[0]["summary2"]))  : ?>
                        <div> -<?php echo htmlspecialchars($rows[0]["summary2"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                    <?php endif; ?>
                    <?php if (isset($rows[0]["summary3"]))  : ?>
                        <div> -<?php echo htmlspecialchars($rows[0]["summary3"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                    <?php endif; ?>
                    <?php if (isset($rows[0]["summary4"]))  : ?>
                        <div> -<?php echo htmlspecialchars($rows[0]["summary4"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>



        <div class = "Article-2">
            <div class = "Article-Type">
                <?php if (isset($rows[1]["articleType"])) : ?>
                    <?php echo htmlspecialchars($rows[1]["articleType"], ENT_QUOTES, 'UTF-8'); ?><br>
                <?php else : ?>
                    <div>Breaking News</div>
                <?php endif; ?>
            </div>
            <div class = "Article-Title">
                <?php if (isset($rows[1]["articleName"])) : ?>
                    <a href="Articles/article.php?id=<?= $rows[1]['id'] ?>"><?php echo htmlspecialchars($rows[1]["articleName"], ENT_QUOTES, 'UTF-8'); ?></a>
                <?php else : ?>
                    <div>No article available</div>
                <?php endif; ?>
            </div><br>
            <!--Article Summaries-->
            <div class = "articleSummaries">            
                <?php if (isset($rows[1]["summary1"])) : ?>
                    <div> -<?php echo htmlspecialchars($rows[1]["summary1"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[1]["summary2"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[1]["summary2"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[1]["summary3"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[1]["summary3"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[1]["summary4"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[1]["summary4"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
            </div>
        </div>

        <div class = "Article-3">
            <div class = "Article-Type">
                <?php if (isset($rows[2]["articleType"])) : ?>
                    <?php echo htmlspecialchars($rows[2]["articleType"], ENT_QUOTES, 'UTF-8'); ?><br>
                <?php else : ?>
                    <div>Breaking News</div>
                <?php endif; ?>
            </div>
            <div class = "Article-Title">
                <?php if (isset($rows[2]["articleName"])) : ?>
                    <a href="Articles/article.php?id=<?= $rows[2]['id'] ?>"><?php echo htmlspecialchars($rows[2]["articleName"], ENT_QUOTES, 'UTF-8'); ?></a>
                <?php else : ?>
                    <div>No article available</div>
                <?php endif; ?>
            </div><br>
            <!--Article Summaries-->  
            
            <div class = "articleSummaries">
                <?php if (isset($rows[2]["summary1"])) : ?>
                    <div> -<?php echo htmlspecialchars($rows[2]["summary1"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[2]["summary2"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[2]["summary2"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[2]["summary3"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[2]["summary3"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
                <?php if (isset($rows[2]["summary4"]))  : ?>
                    <div> -<?php echo htmlspecialchars($rows[2]["summary4"], ENT_QUOTES, 'UTF-8'); ?><br></div>
                <?php endif; ?>
            </div>
        </div>
    </main>

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

    </body>


</html>