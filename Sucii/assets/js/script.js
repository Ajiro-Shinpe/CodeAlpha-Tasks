// For post image preview
let input = document.getElementById("Sucii_select_post");
input.addEventListener("change", preview);

function preview() {
  let fileobject = this.files[0];
  let filereader = new FileReader();
  filereader.readAsDataURL(fileobject);

  filereader.onload = function () {
    let image_src = filereader.result;
    let image = document.getElementById("preview_post_img");
    image.setAttribute("src", image_src);
    image.style.display = "block"; // Ensure the image is displayed
  };
}

// for folllow user
$(".followbtn").click(function () {
  let user_id_v = $(this).data("userId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?follow",
    method: "post",
    dataType: "json",
    data: { user_id: user_id_v },
    success: function (response) {
      if (response.status) {
        $(button).attr("disabled", true);
        $(button).data("user-id", 0);
        $(button).html('Following <i class="bi bi-check-circle"></i>');
        location.reload();
      } else {
        $(button).attr("disabled", false);
        alert(response.message || "An error occurred. Please try again.");
      }
    },
  });
});

// for unfolllow user
$(".unfollowbtn").click(function () {
  let user_id_v = $(this).data("userId");
  let button = this;
  $(button).attr("disabled", true);
  $.ajax({
    url: "assets/php/ajax.php?unfollow",
    method: "post",
    dataType: "json",
    data: { user_id: user_id_v },
    success: function (response) {
      if (response.status) {
        $(button).data("user-id", 0);
        $(button).html("Unfolloed");
        location.reload();
      } else {
        $(button).attr("disabled", false);
        alert(response.message || "An error occurred. Please try again.");
      }
    },
  });
});

$(document).on("click", ".like_btn, .unlike_btn", function () {
  let post_id_v = $(this).data("postId");
  let button = this;
  $(button).attr("disabled", true);

  // Determine the action (like or unlike) based on the current button class
  let action = $(button).hasClass("like_btn") ? "like" : "unlike";
  let toggleClass =
    action === "like"
      ? "bi-heart-fill text-danger unlike_btn"
      : "bi-heart like_btn";
  let url =
    action === "like"
      ? "assets/php/ajax.php?like"
      : "assets/php/ajax.php?unlike";

  $.ajax({
    url: url,
    method: "post",
    dataType: "json",
    data: { post_id: post_id_v },
    success: function (response) {
      if (response.status) {
        $(button).attr("disabled", false);
        // Toggle the button class and appearance
        $(button).toggleClass(
          "bi-heart bi-heart-fill text-danger like_btn unlike_btn"
        );
        location.reload();
      } else {
        $(button).attr("disabled", false);
        alert(response.message || "An error occurred. Please try again.");
      }
    },
  });
});

// ----------------------- for message-------------------var chatting_user_id = null;

// Sync all messages and update the off-canvas chat list in real-time
function SyncMsg() {
  $.ajax({
      url: "./assets/php/ajax.php?msg",
      method: "POST",
      dataType: "json",
      success: function (response) {
          console.log("SyncMsg AJAX response:", response); // Debugging
          
          if (response.error) {
              $(".offcanvas-body").html("<p>" + response.error + "</p>");
          } else {
              $(".offcanvas-body").html(response.chat_list);

              // If a chat is open, refresh it as well
              if (chatting_user_id) {
                  loadChatMessages(chatting_user_id);
              }
          }
      },
      error: function (xhr, status, error) {
          console.error("SyncMsg AJAX error:", error); // Log error
          $(".offcanvas-body").html("<p>Failed to load messages.</p>");
      }
  });
}

// Function to load chat messages into the modal
function loadChatMessages(user_id) {
  chatting_user_id = user_id;
  $.ajax({
      url: "./assets/php/ajax.php?msg",
      method: "POST",
      data: { chatter_id: chatting_user_id },
      dataType: "json",
      success: function (response) {
          if (response.error) {
              $("#user_chat").html("<p>" + response.error + "</p>");
          } else {
              $("#user_chat").html(response.chat.msg);
              $("#chat_full_name").text(
                  response.chat.userdata.first_name + " " + response.chat.userdata.last_name
              );
              $("#chat_name").text(response.chat.userdata.username);
              $("#profile_pic").attr(
                  "src", "./assets/images/profile/" + response.chat.userdata.profile_pic
              );
              $("#send_msg").attr("data-user-id", user_id);
          }
      },
      error: function (xhr, status, error) {
          console.error("Error loading chat messages:", error);
          $("#user_chat").html("<p>Failed to load chat messages.</p>");
      }
  });
}

// Send message functionality
$("#send_msg").click(function () {
  var msg = $("#msg_inp").val();
  if (!msg) return;

  $("#send_msg").attr("disabled", true);
  $("#msg_inp").attr("disabled", true);

  $.ajax({
      url: "./assets/php/ajax.php?send_msg",
      method: "POST",
      data: { user_id: chatting_user_id, msg: msg },
      dataType: "json",
      success: function (response) {
          if (response.status) {
              $("#msg_inp").val("");
              $("#send_msg").attr("disabled", false);
              $("#msg_inp").attr("disabled", false);

              // Reload chat messages in modal for real-time update
              loadChatMessages(chatting_user_id);
          } else {
              alert("Something went wrong");
          }
      },
      error: function (xhr, status, error) {
          console.error("Error sending message:", error);
          $("#send_msg").attr("disabled", false);
          $("#msg_inp").attr("disabled", false);
      }
  });
});

// Auto-refresh messages every second for real-time sync
setInterval(() => {
  SyncMsg(); // Refresh the off-canvas and modal if open
}, 1000);

// Trigger SyncMsg when the off-canvas is opened
document.getElementById("messageSideBar").addEventListener("show.bs.offcanvas", function () {
  SyncMsg();
});

