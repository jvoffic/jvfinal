<?php
require_once '../components/navbar.php';
// Session start
session_start();

// Mainīgie/globalscope
$postby = $_SESSION['username'] ?? "";
$title = $_POST['title'] ?? "";
$dsc = $_POST['description'] ?? "";

// Check Session-Loggedin or not
if($_SESSION['username']) {

} else {
    header('Location: login.php');
}

// Logout
if(isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
}
?>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

<main>
    <div class="userpanel">
        <h1><?php echo "Hello, " . $_SESSION['username'] . "!"; ?> </h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <button name="logout">Logout</button>
        </form>
    </div>
    <?php
    // Izveidot postu
    if(isset($_POST['create'])) {
        require_once 'db.php';

    // Insert information INTO database
        $sql = "INSERT INTO posts (username, title, description) VALUES ('$postby', '$title', '$dsc')";

    // Ieraksta ievietošana datubāzē - pārbaude
        if($conn->query($sql) === TRUE) {
            echo "Ieraksts veiksmīgi saglabāts!";
            header('refresh: 1.5; profile.php');
        } else {
            echo "Kaut kas nogāja greizi";
        }
    } ?>
    <div class="posts">
        <h1> POSTS </h1>
        <?php 
        require_once 'db.php';
        // Paņemam datus no datubāzes
        $select = "SELECT id, username, title, description, created_at FROM posts";
        $result = $conn->query($select);

        //Delete
        if(isset($_POST['delete'])) {
            $id = $_POST['deleteid'];
            $delete = "DELETE FROM posts WHERE username='$postby' AND id='$id'";
            if ($conn->query($delete)) {
                echo "Ieraksts veiksmīgi dzēsts!";
                header('Location: profile.php');
            } else {
                echo "Ieraksts netika dzēsts!";
            }
        }
        // Display
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hid = $row['id'];
                echo "<p class='ptitle'>Title: " . $row['title'] . "</p><br>";
                echo "<p class='pdsc'>Description:<br><br> " . $row['description'] . "</p><br>";
                echo "<p class='postby'> Posted By: " . $row['username'] . "</p><br>";
                echo "<p class='createdat'> Post Made: " . $row['created_at'] . "</p>";

                echo '<form action="" method="post">
                <input class="deletebtn" type="submit" name="delete" value="Delete">
                <input type="hidden" name="deleteid" value="'. $hid .'">
                </form>';
                echo '
                <a class="btn-edit" href="/jvfinal/pages/edit.php?postid='.$hid .'">Edit</a>
                ';
                echo "<hr><br>";
            }
        } else {
            echo "Nav ierakstu";
        } ?>
    </div>
    </div>
    <div class="mcontent">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="mt-5">
            <div class="mb-3">
                <label for="inputPostTitle" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="inputPostTitle" aria-describedby="postTitle" name="title">
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="inputDescription" name="description">
            </div>
            <button type="submit" class="btn btn-primary" id="crt" name="create">Create</button>
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
        color: black;
    }

    .posts {
        margin: 50px 80px 50px 80px;
        background-color: white;
        border: 1px solid black;
    }

    .posts h1 {
        font-size: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .ptitle {
        font-size: 1.2rem;
        margin-left: 15px;
    }

    .pdsc {
        margin: -25px 15px 0px 15px;
        
    }

    .postby {
        margin: -10px 0px 0px 15px;
        color:red;
    }

    .createdat {
        margin: -10px 0px 0px 15px;
    }

    .deletebtn {
        margin: 15px 0px 0px 15px;
    }

    .btn-edit {
        color: black;
        margin: 15px 0px 0px 5px;
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
</style>
<?php 
require_once '../components/footer.php';

?>