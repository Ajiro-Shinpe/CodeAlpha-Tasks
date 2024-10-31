<!-- Modal -->
<div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h1 class="modal-title text-light fs-5" id="exampleModalLabel">Add New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="row g-3" method="post" action="./assets/php/actions.php?addpost" enctype="multipart/form-data">
                    <img src="" id="preview_post_img" alt="Image Preview" style="display:none;" class="my-3 w-100 rounded border">
                    <div class="form-floating my-3">
                        <textarea class="form-control" name="post_des" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">What's on your mind</label>
                    </div>
                    <div class="my-3">
                        <input class="form-control" type="file" id="Sucii_select_post" accept="image/*" name="Sucii_select_post">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  ---------------------mmmssages side bar offcanvas  ----------------- -->
<!-- Off-canvas Sidebar -->
<div class="offcanvas offcanvas-start bg-dark text-light" tabindex="-1" id="messageSideBar">
    <div class="offcanvas-header border-bottom bg-dark text-light">
        <h5 class="offcanvas-title">Chat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body bg-dark text-light"></div>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="" id="profile_pic" class="rounded-circle border" style="height:40px;width:40px;object-fit:cover;" alt="">
                    <span class="fs-5" id="chat_name"></span> (<span class="fs-6" id="chat_full_name"></span>)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body d-flex flex-column-reverse overflow-auto" id="user_chat" style="max-height: 400px;"></div>
            <div class="modal-footer bg-dark text-light">
                <div class="input-group border-0">
                    <input type="text" class="form-control" id="msg_inp" placeholder="Type messages">
                    <button type="button" class="btn btn-primary" id="send_msg" data-user-id="0">Send <i class="bi bi-send-arrow-up"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/JQuery.js"></script>
<script src="assets/js/script.js?v=<?= time() ?>"></script>

</body>

</html>