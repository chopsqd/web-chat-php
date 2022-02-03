<?php

while($row = mysqli_fetch_assoc($sql)) {
    $sql_last_msg = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND 
                                                  (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    $query_last_msg = mysqli_query($connection, $sql_last_msg);
    $row_last_msg = mysqli_fetch_assoc($query_last_msg);
    if(mysqli_num_rows($query_last_msg) > 0) {
        $result = $row_last_msg['msg'];
    } else {
        $result = "No message found...";
    }

    (strlen($result) > 28) ? $msg = substr($result, 0, 25).'...' : $msg = $result;
    ($outgoing_id == $row_last_msg['outgoing_msg_id']) ? $you = "You: " : $you = "";
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="../backend/images/'.$row['img'].'" alt="">                            
                            <div class="details">
                                <span>'.$row['fname'] . " " . $row['lname'].'</span>
                                <p>'. $you . $msg .'</p>
                            </div>
                        </div>
                        <span class="status-dot '.$offline.'"><i class="fas fa-circle"></i></span>
                        </a>';
}

?>
