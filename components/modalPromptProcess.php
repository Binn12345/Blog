
<div class="modal fade" id="largeModal" tabindex="-1">
<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title fs-6" >Create Post</h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="../assets/img/profile-img.jpg" alt="User" class="rounded-circle" width="40" height="40">
                    <span class="ms-2 fw-bold fs-6"><?=ucfirst($user['name']); ?></span>
                </div>
                <textarea class="form-control border-0 fs-6" rows="4" placeholder="What's on your mind, <?=ucfirst($user['name']); ?>?"></textarea>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-light w-100 me-2"><i class="bi bi-card-image fs-6"></i> Photo/Video</button>
                    <button class="btn btn-light w-100 me-2"><i class="bi bi-emoji-smile fs-6"></i> Feeling/Activity</button>
                    <button class="btn btn-light w-100"><i class="bi bi-tag fs-6"></i> Tag Friends</button>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                <button type="button" class="btn btn-primary">Post</button>
            </div>
        </div>
    </div>
</div><!-- End Large Modal-->