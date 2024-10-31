<?php
global $user;
global $posts;
global $follow_suggestion;
?>
<div class="container-fluid bg-dark">
    <div class="row">
        <!-- Main Content Section -->
        <div class="col-lg-8 col-md-12">
            <?php
            showError('post_image');
            if (count($posts) < 1) {
                echo '<p class="text-muted bg-white text-center rounded border p-2">Follow some people you know, watch their posts, or post something you like to share with <b>Sucii</b>. Explore <b>Sucii</b> & Enjoy!</p>';
            } else {
                foreach ($posts as $post) {
                    $count_likes = countLikes($post['id']);
            ?>
                    <div class="card mt-4 bg-dark border">
                        <div class="card-title d-flex justify-content-between align-items-center p-3">
                        <a href="?user=<?= $post['username'] ?>" class="text-decoration-none text-white fw-bold">
                            <div class="d-flex align-items-center">
                                <img src="./assets/images/profile/<?= $post['profile_pic'] ?>" class="rounded-circle border" style="height:40px;width:40px;object-fit:cover;" alt="Profile Picture">
                                <span class="ms-2">
                                    <?= $post['first_name'] ?> <?= $post['last_name'] ?>
                                </span>
                                <span class="ms-1" style="font-size: 16px;" > ( <?= timeAgo($post['posted_at'] ?? '' ) ?> )</span>
                            </div>
                            </a>
                            <div>
                                <i class="bi bi-three-dots-vertical text-white"></i>
                            </div>
                        </div>
                        <?php if ($post['post_des']) { ?>
                            <div class="card-body text-white">
                                <p class="m-0 text-break"><?= $post['post_des'] ?></p>
                            </div>
                        <?php } ?>
                        <img src="./assets/images/posts/<?= $post['post_image'] ?>" class="img-fluid" alt="Post Image">
                        <div class="p-3 border-bottom text-white d-flex justify-content-between align-items-center">
                            <div>
                                <i class="bi <?= checkLikeStatus($post['id']) ? 'bi-heart-fill text-danger unlike_btn' : 'bi-heart like_btn' ?>" data-post-id="<?= $post['id'] ?>"></i>
                                &nbsp;&nbsp;<i class="bi bi-chat-left" data-bs-toggle="modal" data-bs-target="#commentsModal<?= $post['id'] ?>"></i>
                            </div>
                            <div>
                                <span style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#likesModal<?= $post['id'] ?>">
                                    <?= count($count_likes) ?>&nbsp;Likes
                                </span>
                                &nbsp;
                                <span style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#commentsModal<?= $post['id'] ?>">
                                    <?= countComments($post['id']) ?>&nbsp;Comments
                                </span>
                            </div>
                        </div>

                        <!-- Comment Section -->
                        <div class="input-group p-3">
                            <form method="post" action="./assets/php/actions.php?addcomment" class="w-100 d-flex">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <input type="text" name="comment_text" class="form-control" placeholder="Add a comment..." aria-label="Comment" id="commentInput">
                                <button class="btn btn-primary" type="submit" id="addCommentBtn">Post</button>
                            </form>
                        </div>

                        <!-- Likes Modal -->
                        <div class="modal fade" id="likesModal<?= $post['id'] ?>" tabindex="-1" aria-labelledby="likesModalLabel<?= $post['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title text-white">Likes</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <?php if (!empty($count_likes)): ?>
                                            <?php foreach ($count_likes as $fuser): ?>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <img src="./assets/images/profile/<?= htmlspecialchars($fuser['profile_pic'] ?? 'default.png') ?>" class="rounded-circle border" style="height:50px;width:50px;object-fit:cover;" alt="Profile Picture">
                                                        <div class="ms-2">
                                                            <h6 class="mb-0"><a href="?user=<?= htmlspecialchars($fuser['username'] ?? 'unknown') ?>" class="text-decoration-none text-white"><?= htmlspecialchars($fuser['first_name'] ?? 'Unknown') ?> <?= htmlspecialchars($fuser['last_name'] ?? '') ?></a></h6>
                                                            <small class="text-white"><?= htmlspecialchars($fuser['username'] ?? 'unknown') ?></small>
                                                        </div>
                                                    </div>
                                                    <?php if ($_SESSION['userdata']['id'] !== $fuser['id']): ?>
                                                        <?php if (checkFollowStatus($fuser['id'])): ?>
                                                            <button class="btn btn-sm btn-danger unfollowbtn" data-user-id="<?= htmlspecialchars($fuser['id']) ?>">Unfollow</button>
                                                        <?php else: ?>
                                                            <button class="btn btn-sm btn-primary followbtn" data-user-id="<?= htmlspecialchars($fuser['id']) ?>">Follow</button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-center">No likes to display.</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Modal -->
                        <div class="modal fade" id="commentsModal<?= $post['id'] ?>" tabindex="-1" aria-labelledby="commentsModalLabel<?= $post['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title text-white">Comments</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <?php
                                        $comments = getComments($post['id']);
                                        foreach ($comments as $comment):
                                        ?>
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="./assets/images/profile/<?= htmlspecialchars($comment['profile_pic'] ?? 'default.png') ?>" class="rounded-circle border" style="height:50px;width:50px;object-fit:cover;" alt="Profile Picture">
                                                <div class="ms-2">
                                                <h6 class="mb-0"><a href="?user=<?= htmlspecialchars($comment['username'] ?? 'unknown') ?>" class="text-decoration-none text-white"><?= htmlspecialchars($comment['first_name'] . ' ' . $comment['last_name']) ?></a></h6>

                                                    <strong></strong>
                                                    <p class="mb-1 text-break"><?= htmlspecialchars($comment['comment_text']) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
<!-- Follow Suggestions Section -->
<div class="col-lg-4 col-md-12">
<a href="?user=<?= $user['username']?>" class="text-decoration-none text-white">
    <div class="my-profile d-flex align-items-center my-4 px-3 border rounded py-2">
        <img src="./assets/images/profile/<?= $user['profile_pic'] ?>" 
             alt="Profile" 
             class="rounded-circle border" 
             style="aspect-ratio:1/1; object-fit:cover; height:60px; width:60px;">
        <div class="user-name ms-3">
            <h5 class="mb-0"><?= $user['first_name'] . ' ' . $user['last_name']?></h5>
            <small class="text-white"><?= $user['username']?></small>
        </div>
    </div>
    </a>
    <!-- Suggestions Section -->
    <div class="suggestions text-white p-3 border rounded bg-dark">
        <h6 class="fw-bold">Who to follow</h6>
        <hr class="text-white">

        <!-- Follow Suggestion Loop -->
        <div class="p-2">
            <?php if (count($follow_suggestion) < 1): ?>
                <p class="text-center">No suggestions to show.</p>
            <?php else: ?>
                <?php foreach ($follow_suggestion as $fuser): ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!-- User Info -->
                        <a href="?user=<?= htmlspecialchars($fuser['username'] ?? 'unknown') ?>" 
                        class="text-decoration-none text-white">
                        <div class="d-flex align-items-center">
                            <img src="./assets/images/profile/<?= htmlspecialchars($fuser['profile_pic'] ?? 'default.png') ?>" 
                                 alt="Profile Picture" 
                                 class="rounded-circle border"
                                 style="height:50px; width:50px; object-fit:cover; aspect-ratio:1/1;">
                            <div class="ms-3">
                                <h6 class="mb-0" style="font-size: small;">
                                        <?= htmlspecialchars($fuser['first_name'] ?? 'Unknown') ?>
                                        <?= htmlspecialchars($fuser['last_name'] ?? '') ?>
                                </h6>
                                <small class="text-white" style="font-size: 16px;"><?= htmlspecialchars($fuser['username'] ?? 'unknown') ?></small>
                            </div>
                        </div>
                        </a>

                        <!-- Follow/Unfollow Button -->
                        <div class="d-flex align-items-center">
                            <?php if (checkFollowStatus($fuser['id'])): ?>
                                <button class="btn btn-sm btn-danger unfollowbtn" 
                                        data-user-id="<?= htmlspecialchars($fuser['id']) ?>">
                                    Unfollow
                                </button>
                            <?php else: ?>
                                <button class="btn btn-sm btn-primary followbtn" 
                                        data-user-id="<?= htmlspecialchars($fuser['id']) ?>">
                                    Follow
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- View More Link -->
        <p class="text-center mt-3"><a href="#" class="text-decoration-none text-white">View more</a></p>
    </div>
</div>
