<h2> Video uploaden</h2>

<form action="./index.php?action=upload" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Video Title</label>
        <input type="text" name="title" required>
    </div>

    <div>
        <label for="description">Beschrijving</label>
        <textarea name="description" required></textarea>
    </div>

    <div>
        <label for="video_file">Kies video bestand</label>
        <input type="file" name="video_file" accept="video/*" required>
    </div>
    <button type="submit">Video uploaden</button>

</form>

<p><a href="index.php">Terug naar Homepage</a></p>