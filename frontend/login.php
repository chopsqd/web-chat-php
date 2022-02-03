<?php
session_start();
if(isset($_SESSION['unique_id'])) {
    header("location:../frontend/login.php");
}
?>
<?php include_once "header.php"; ?>
<body>

    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#">
                <div class="error-txt">Error!</div>
                    <div class="field input">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email...">
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Chatting!">
                    </div>
            </form>
            <div class="link">Not yet signed up? <a href="../index.php">Signup now</a></div>
        </section>
    </div>

    <script src="../js/pass-show-hide.js"></script>
    <script src="../js/login.js"></script>
</body>
</html>