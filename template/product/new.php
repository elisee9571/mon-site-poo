<h1><?= $title ?></h1>

<form action="" method="post">

    <div>
        <label for="title">Titre</label>
        <input id="title" type="text" name="title" placeholder="Saissisez un titre" required>
    </div>

    <div>
        <label for="price">Price</label>
        <input id="price" type="number" name="price" placeholder="Saissisez un prix" required>
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Saisissez une description" style="resize: none;" required></textarea>
    </div>

    <button type="submit">Créer</button>

</form>
