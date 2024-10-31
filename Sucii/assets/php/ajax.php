
<?php
require_once 'function.php';

if(isset($_GET['send_msg'])){
    $user_id = $_POST['user_id'];
    $msg = $_POST['msg'];
    if(sendMessages($user_id, $msg)){
        $response['status'] = true;
    }
    else{
        $response['status'] = false;
    }
    echo json_encode($response);
}

if (isset($_GET['follow'])) {
    $user_id = $_POST['user_id'];
    // $response = ['status' => false];

    if (followUser($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}

if (isset($_GET['unfollow'])) {
    $user_id = $_POST['user_id'];
    // $response = ['status' => false];

    if (unfollowUser($user_id)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
        // $response['message'] = "Unable to follow user.";
    }

    echo json_encode($response);
}

// AJAX Code:

// The click event is handled for both like_btn and unlike_btn.
// Based on the button's current class, the script determines whether to like or unlike the post.
// The appropriate URL (like or unlike) is called.
// On success, the button's class and appearance are toggled to reflect the new state (liked or unliked).

if (isset($_GET['like'])) {
    $post_id = $_POST['post_id'];
    // $response = ['status' => false];
    if (!checkLikeStatus($post_id)) {
        if (likePost($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
            // $response['message'] = "Unable to follow user.";
        }

        echo json_encode($response);
    }
}


if (isset($_GET['unlike'])) {
    $post_id = $_POST['post_id'];
    // $response = ['status' => false];
    if (checkLikeStatus($post_id)) {
        if (unlikePost($post_id)) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
            // $response['message'] = "Unable to follow user.";
        }

        echo json_encode($response);
    }
}


if (isset($_GET['add_comment'])) {
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $user_id = $_SESSION['userdata']['id'];

    if (addComment($post_id, $user_id, $comment_text)) {
        $response['status'] = true;
    } else {
        $response['status'] = false;
    }

    echo json_encode($response);
}

if (isset($_GET['getcomments']) && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $comments = getComments($post_id); // Assume this function fetches comments from the DB
    echo json_encode(['status' => true, 'comments' => $comments]);
    exit();
}

// Initialize variables
$chat_list = ""; // For chats in the offcanvas
$chatmsg = "";   // For messages in the modal
$json = [];      // JSON response array

// Check if 'msg' parameter is set in GET request
if (isset($_GET['msg'])) {
    // Fetch all messages from the database
    $chats = getAllMessages(); 

    if (!$chats) {
        $json['error'] = "No chats found or an error occurred.";
        echo json_encode($json);
        exit;
    }

    // Loop through chats to create chat list in the offcanvas
    foreach ($chats as $chat) {
        if (isset($chat['user_id'])) {
            $ch_user = getUserData($chat['user_id']);
            $first_message = $chat['messages'][0] ?? null;
            $seen = $first_message && ($first_message['msg_status'] == 1 || $first_message['from_msg_id'] == ($_SESSION['userdata']['id'] ?? null));

            // Construct chat list item
            $chat_list .= '
            <div class="d-flex align-items-center p-2 mb-2 rounded border-bottom cursor-pointer" 
                 style="transition: background-color 0.2s ease; background-color: #1a1a1a;"
                 data-bs-toggle="modal" 
                 data-bs-target="#chatModal" 
                 onclick="loadChatMessages(' . (int)$chat['user_id'] . ')">
                
                <!-- Profile Picture -->
                <div style="position: relative;">
                    <img src="./assets/images/profile/' . htmlspecialchars($ch_user['profile_pic'] ?? 'default.jpg') . '" 
                         class="rounded-circle border" 
                         style="height: 55px; width: 55px; object-fit: cover; border: 2px solid #6c757d;">
                </div>
                
                <!-- Chat Details -->
                <div class="d-flex flex-column ms-3" style="flex-grow: 1;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-light fw-semibold" style="font-size: 0.9rem;">
                            ' . htmlspecialchars($ch_user['first_name'] ?? '') . ' ' . htmlspecialchars($ch_user['last_name'] ?? '') . '
                        </h6>
                        
                        <!-- Formatted Time -->
                        <time class="text-secondary" style="font-size: 0.75rem;">
                            ' . timeAgo($first_message['created_at'] ?? '') . '
                        </time>
                    </div>
                    
                    <!-- Last Message Preview -->
                    <p class="mb-1 text-white" style="font-size: 0.8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ' . htmlspecialchars(substr($first_message['msg'] ?? '', 0, 25)) . '...
                    </p>
                </div>
                
                <!-- Unread Indicator -->
                <div class="d-flex align-items-center">
                    <div class="rounded-circle ' . ($seen ? 'd-none' : '') . '" 
                         style="width: 10px; height: 10px; background-color: #007bff;">
                    </div>
                </div>
            </div>
        ';
        
                }
    }

    // Handle messages for a specific chatter
    if (!empty($_POST['chatter_id']) && is_numeric($_POST['chatter_id'])) {
        $messages = getMessages((int)$_POST['chatter_id']);

        // Loop through messages to construct chat content
        foreach ($messages as $msg) {
            $isCurrentUser = $msg['from_msg_id'] == ($_SESSION['userdata']['id'] ?? 0);
            $class_1 = $isCurrentUser 
                ? "text-light my-1 py-2 px-3 border rounded shadow d-inline-block col-8 align-self-end bg-primary"
                : "text-light my-1 py-2 px-3 border rounded shadow d-inline-block col-8 bg-secondary";
            
            $chatmsg .= '
                <div class="' . $class_1 . '">' . htmlspecialchars($msg['msg'] ?? '') . ' 
                    <br>
<span style="font-size:x-small;">' . htmlspecialchars(timeAgo($msg['created_at'] ?? '')) . '</span>
                </div>';
        }

        $json['chat']['msg'] = $chatmsg;
        $json['chat']['userdata'] = getUserData((int)$_POST['chatter_id']);
    } else {
        $json['chat']['msg'] = 'loading ... ';
    }

    // Output chat list and chat message data
    $json['chat_list'] = $chat_list;
    echo json_encode($json);
}

?>