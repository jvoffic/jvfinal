<?php
require_once '../components/navbar.php';
// Session start
session_start();

// Mainīgie
require_once 'db.php';

if(!isset($_POST['update'])) {
    $postid = $_GET['postid'];
    $select = "SELECT id, username, title, description, created_at FROM posts WHERE id='$postid'";
    $result = $conn->query($select);
    $row = $result->fetch_row();
    $title = $row['title'] ?? "";
    $dsc = $row['description'] ?? "";
}

// Check Session
if($_SESSION['username']) {

} else {
    header('Location: login.php');
}

// Logout
if(isset($_POST['submit'])) {
    session_destroy();
    header('Location: login.php');
}

?>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
<main>
    <div class="userpanel">
        <h1><?php echo "Hello, " . $_SESSION['username'] . "!"; ?> </h1>
        <form action="" method="POST">
            <button name="submit">Logout</button>
        </form>
    </div>
    <?php
    // Update Post
    if(isset($_POST['update'])) {
        $title = $_POST['title'];
        $dsc = $_POST['description'];
        $postby = $_SESSION['username'];
        $postid = $_POST['postid'];
    // Update information in Database

        $sql = "UPDATE posts SET title='$title', description='$dsc' WHERE username='$postby' AND id='$postid'";


    // Ieraksta ievietošana datubāzē - pārbaude 
        if($conn->query($sql) === TRUE ) {
            echo "<p class='done'>Ieraksts veiksmīgi saglabāts!</p>";
            header('refresh: 1.5; profile.php');
        } else {
            echo "Kaut kas nogāja greizi";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
    <div class="mcontent">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="mt-5">
        <input type="hidden" name="postid" value="<?= $postid ?>">
            <div class="mb-3">
                <label for="inputPostTitle" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="inputPostTitle" aria-describedby="postTitle" name="title" value="<?= $title ?>">
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="inputDescription" name="description" value="<?= $dsc ?>">
            </div>
            <button type="submit" class="btn btn-primary" id="crt" name="update">Update</button>
        </form>
    </div>
    <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
</main>
<!-- CSS Style -->
<style>
    .userpanel {
        height: 50px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        background-color: rgb(32, 32, 32);
    }

    .userpanel h1{
        color: white;
        margin-left: 20px;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
    }

    .userpanel button {
        margin-top: 10px;
        width: 70px;
        margin-right: 2em;
        color: black;
        border: 1px solid black;
    }

    .userpanel button:hover {
        color: crimson;
        transition: .3s ease;
    }

    .mcontent {
        width: 100%;
        height: 50vh;
    }
    
    .form-label {
        color: white;
        margin-left: 80px;
    }

    #inputPostTitle {
        width: 50%;
        margin-left: 80px;
    }

    #inputDescription {
        width: 70%;
        height: 25vh;
        margin-left: 80px;
    }

    #crt {
        margin-left: 80px;
    }

    .done {
        color: white;
    }

    .media-icons {
        z-index: 888;
        position: fixed;
        top: 300px;
        left: 10px;
        display: flex;
        flex-direction: column;
        transition: .5s ease;
    }  

    .media-icons a{
        color: #fff;
        font-size: 1.6em;
        transition: .3s ease;
    }

    .media-icons a:not(:last-child) {
        margin-bottom: 20px;
    }

    .media-icons a:hover {
        transform: scale(1.3);
    }

    .fwr {
        position: absolute;
        bottom: 0;
    }
</style>

<?php 
require_once '../components/footer.php';

?>