<?php

    session_start();
    include_once "config.php";

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($connection, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0) {
                echo "$email already exist!";
            } else {
                if(isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name']; // photo.png
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    //$img_explode = ['photo', 'png']
                    $img_ext = end($img_explode);
                    //$img_ext = 'png'

                    $extensions = ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $extensions) === true) {
                        $time = time();
                        $new_img_name = $time.$img_name;

                        if(move_uploaded_file($tmp_name, "images/".$new_img_name)) {
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            //insert all user data inside the table
                            $sql_to_insert = mysqli_query($connection, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                            if($sql_to_insert) {
                                $sql_inserted = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql_inserted) > 0) {
                                    $row = mysqli_fetch_assoc($sql_inserted);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            } else {
                                echo "Something went wrong!";
                            }
                        }

                    } else {
                        echo "Use images with png/jpg/jpeg extension!";
                    }

                } else {
                    echo "Please select an image file!";
                }
            }
        } else {
            echo "$email looks like invalid email";
        }
    } else {
        echo "All input fields are required!";
    }

?>
