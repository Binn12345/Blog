<?php
require_once('../config/functions.php');

?>

<div class="mb-5"></div>
<main>

    <div class="container">

        <section class="section dashboard">

            <div class="row">

                <div class="col-lg-3"></div>
                <!-- center columns -->
                <div class="col-lg-6">
                    <div class="row">
                        <!-- Sales Card -->
                        <!-- Newsfeed Post Card -->
                        <div class="col-12 mt-4">

                            <div class="card shadow-sm border-0 mb-5">
                                <br>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="../assets/img/profile-img.jpg" class="rounded-circle me-2 border" style="width: 50px; height: 50px; object-fit: cover;" alt="User">
                                        <textarea class="form-control border-0" id="postInput" data-bs-toggle="modal" data-bs-target="#largeModal" rows="2" placeholder="What's on your mind, <?= $user['name']; ?>?" style="resize: none;" readonly></textarea>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between px-2">
                                        <button class="btn btn-light text-primary fw-semibold fs-6"><i class="bi bi-camera-video-fill me-1"></i> Live Video</button>
                                        <button class="btn btn-light text-success fw-semibold fs-6"><i class="bi bi-images me-1"></i> Photo/Video</button>
                                        <button class="btn btn-light text-warning fw-semibold fs-6"><i class="bi bi-emoji-smile me-1"></i> Feeling/Activity</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- <hr> -->
                        <div class="col-lg-12">
                            <br>
                            <div class="card shadow-sm">
                                <div class="card-body">

                                    <!-- Skeleton Loader (Before Data is Loaded) -->
                                    <div id="loadingSkeleton">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light me-3" style="width: 50px; height: 50px;"></div>
                                            <div class="flex-grow-1">
                                                <div class="bg-light mb-2" style="width: 40%; height: 12px;"></div>
                                                <div class="bg-light" style="width: 60%; height: 12px;"></div>
                                            </div>
                                        </div>
                                        <div class="bg-light mt-3" style="width: 100%; height: 150px;"></div>
                                    </div>
                                    <br>
                                    <!-- Fetched Data (Initially Hidden) -->
                                    <div id="postContent" class="d-none">
                                        <div class="d-flex align-items-center">
                                            <img src="../assets/img/profile-img.jpg" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;" alt="User">
                                            <div>

                                                <h6 class="mb-0" style="text-transform: capitalize; font-weight:bold">&nbsp;<?= $user['name']; ?></h6>
                                                <small class="text-muted">&nbsp;<?php echo timeAgo(date("Y-m-d H:i:s")); ?></small>

                                            </div>
                                        </div>
                                        <p class="mt-3">
                                            <?= getRandomParagraph() ?>
                                        </p>
                                        <div class="rounded bg-light p-3">
                                            <div class="row g-2">
                                                <div class="col-12" id="imageContainer">
                                                    <!-- Images will be added dynamically here -->
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between px-2">
                                                <button class="btn btn-light text-primary fw-semibold fs-6"><i class="bi bi-hand-thumbs-up me-1"></i> Like</button>
                                                <button class="btn btn-light text-success fw-semibold fs-6"><i class="bi bi-chat-dots me-1"></i> Comment</button>
                                                <button class="btn btn-light text-warning fw-semibold fs-6"><i class="bi bi-share me-1"></i> Share</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Newsfeed Post Card -->
                            <!-- End Sales Card -->
                        </div>
                    </div>
                    <!-- <div class="col-lg-8">
                    <div class="row">
                        
                    </div>
                </div> -->
                    <!-- End center columns -->
                    <div class="col-lg-3"></div>
                </div>
        </section>
    </div>

</main>