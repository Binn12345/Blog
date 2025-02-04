<div class="mb-5"></div>
<main>

    <div class="container">

        <section class="section dashboard">

            <div class="row">
                <div class="col-lg-2"></div>
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">
                        <!-- Sales Card -->
                        <!-- Newsfeed Post Card -->

                        <div class="col-12 mt-4">
                           <br>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                <br> 
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

                                                <h6 class="mb-0" style="text-transform: capitalize">&nbsp;<?= $user['name']; ?></h6>
                                                <small class="text-muted">2 hours ago</small>
                                            </div>
                                        </div>
                                        <p class="mt-3">
                                            This is an example post content. The data is dynamically loaded after a short delay to simulate fetching from a server.
                                        </p>
                                        <div class="rounded bg-light p-3">
                                            <img src="../assets/img/messages-3.jpg" class="img-fluid rounded" alt="Post Image">
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-hand-thumbs-up"></i> Like</button>
                                            <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chat-dots"></i> Comment</button>
                                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-share"></i> Share</button>
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



                <!-- End Left side columns -->
                <div class="col-lg-2"></div>
            </div>
        </section>
    </div>

</main>