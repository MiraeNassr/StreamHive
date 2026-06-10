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
    }

    video {
        width: 100%;
        height: auto;
        display: block;
    }

    .video-info {
        margin-top: 15px;
        padding: 10px;
        background: #fff;
        border-radius: 8px;
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
    }
    </style>
</head>

<body>

    <div class="container">
        <p><a href="index.php">⬅ Terug naar Homepage</a></p>

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