<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Profile Clone</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style type="text/css">


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f0f2f5;
}

.profile-container {
    width: 1200px;
    margin: 20px auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

/* Cover Photo */
.cover-photo img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}

/* Profile Section */
.profile-section {
    text-align: center;
    padding: 20px;
    position: relative;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid white;
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
}

.username {
    margin-top: 50px;
    font-size: 22px;
    font-weight: bold;
}

.bio {
    color: gray;
    font-size: 14px;
}

.profile-actions {
    margin-top: 10px;
}

.profile-actions button {
    padding: 8px 16px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-friend {
    background-color: #1877f2;
    color: white;
}

.message {
    background-color: #42b72a;
    color: white;
}

/* Friends List */
.friends-list {
    padding: 15px;
}

.friends-list h3 {
    margin-bottom: 10px;
}

.friends {
    display: flex;
    gap: 10px;
}

.friends img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

/* Posts */
.posts {
    padding: 15px;
}

.post {
    display: flex;
    align-items: center;
    background: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.post-user {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.post-content h4 {
    margin-bottom: 5px;
}

    </style>
</head>
<body>

    <div class="profile-container">
        <!-- Cover Photo -->
        <div class="cover-photo">
            <img src="../assets/img/news-1.jpg" alt="Cover Photo">
        </div>
        <!-- Profile Section -->
        <div class="profile-section">
            <img src="../assets/img/profile-img.jpg" alt="Profile Picture" class="profile-picture">
            <h2 class="username">John Doe</h2>
            <p class="bio">Web Developer | Tech Enthusiast | Gamer</p>
            <div class="profile-actions">
                <button class="add-friend">Add Friend</button>
                <button class="message">Message</button>
            </div>
        </div>

        <!-- Friends List -->
        <div class="friends-list">
            <h3>Friends</h3>
            <div class="friends">
                <img src="../assets/img/messages-1.jpg" alt="Friend 1">
                <img src="../assets/img/messages-2.jpg" alt="Friend 2">
                <img src="../assets/img/messages-3.jpg" alt="Friend 3">
            </div>
        </div>

        <!-- Posts Section -->
        <div class="posts">
            <h3>Posts</h3>
            <div class="post">
                <img src="profile.jpg" alt="User" class="post-user">
                <div class="post-content">
                    <h4>John Doe</h4>
                    <p>Just finished a new project! 🚀</p>
                </div>
            </div>
            <div class="post">
                <img src="profile.jpg" alt="User" class="post-user">
                <div class="post-content">
                    <h4>John Doe</h4>
                    <p>Exploring new places this weekend! 🌍</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
