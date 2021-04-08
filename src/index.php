<!DOCTYPE html>

<html lang="en">
<?php include 'head.inc.php'; ?>

<body>
    <?php include "nav.inc.php" ?>
    <span id="counter" hidden>5</span>  
    <main class="container">
        <br>
        <div class="announcementbox">
            <h2>Announcements</h2>
            <?php include "get_announcements.php"; ?>
        </div>
        <article>
            <br><br>
            <h1 class="h3">Trending posts</h1><br>
            <div id="cardcontainer">
                <?php
                include "loadtop.php";
                ?>
            </div>
            <div class="viewmorebut">
                <button onclick="viewMore()">View More</button>
            </div> 
        </article>
            <br>
    </main>
    <script>
        history.pushState(null, null, null);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, null);
        });
    </script>
</body>

</html>