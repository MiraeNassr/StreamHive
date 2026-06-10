<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['title']); ?> - StreamHive</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
        color: #333;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .video-wrapper {
        width: 100%;
        background: #000;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    video {
        width: 100%;
        height: auto;
        display: block;
    }

    .video-info {
        margin-top: 15px;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .comments-section {
        margin-top: 30px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .comment-form textarea {
        width: 100%;
        height: 80px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        resize: none;
        box-sizing: border-box;
    }

    .comment-form button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    .comment-form button:hover {
        background-color: #218838;
    }

    .comment-list {
        margin-top: 20px;
    }

    .comment-item {
        border-bottom: 1px solid #eee;
        padding: 12px 0;
    }

    .comment-item:last-child {
        border-bottom: none;
    }

    .comment-user {
        font-weight: bold;
        color: #007bff;
        font-size: 0.9em;
    }

    .comment-date {
        font-size: 0.8em;
        color: #777;
        margin-left: 10px;
    }

    .comment-text {
        margin-top: 5px;
        font-size: 0.95em;
    }

    .related-section {
        margin-top: 40px;
    }

    .related-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .related-card {
        border: 1px solid #ddd;
        padding: 10px;
        width: 200px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    </style>
</head>

<body>

    <div class="container">
        <p><a href="index.php" style="text-decoration: none; color: #007bff; font-weight: bold;">
                <-Terug naar Homepage</a>
        </p>

        <div class="video-wrapper">
            <video controls autoplay>
                <source src="<?php echo htmlspecialchars($video['filename']); ?>" type="video/mp4">
                Je browser ondersteunt deze video niet.
            </video>
        </div>

        <div class="video-info">
            <h2><?php echo htmlspecialchars($video['title']); ?></h2>
            <p><?php echo htmlspecialchars($video['description']); ?></p>
        </div>
        <div class="comments-section">
            <h3>Reacties</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
            <form action="index.php?action=add_comment" method="POST" class="comment-form">
                <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                <textarea name="comment_text" placeholder="Schrijf een reactie..." required></textarea>
                <button type="submit">Plaats Reactie</button>
            </form>
            <?php else: ?>
            <p><a href="index.php?action=login">Log in</a> om een reactie achter te laten.</p>
            <?php endif; ?>

            <div class="comment-list">
                <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                <div class="comment-item">
                    <div>
                        <span class="comment-user"><?php echo htmlspecialchars($comment['email']); ?></span>
                        <span class="comment-date"><?php echo $comment['created_at']; ?></span>
                    </div>
                    <div class="comment-text">
                        <?php echo nl2br(htmlspecialchars($comment['content'])); ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p style="color: #777;">Er zijn nog geen reacties. Wees de eerste!</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="related-section">
            <h3>Aanbevolen Video's</h3>
            <div class="related-grid">
                <?php if (!empty($related_videos)): ?>
                <?php foreach ($related_videos as $rel): ?>
                <div class="related-card">
                    <a href="index.php?action=watch&id=<?php echo $rel['id']; ?>"
                        style="text-decoration: none; color: #000;">
                        <h4 style="margin: 5px 0;"><?php echo htmlspecialchars($rel['title']); ?></h4>
                        <video width="100%" muted onmouseover="this.play()"
                            onmouseout="this.pause(); this.currentTime = 0;">
                            <source src="<?php echo htmlspecialchars($rel['filename']); ?>" type="video/mp4">
                        </video>
                    </a>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Geen andere video's beschikbaar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>