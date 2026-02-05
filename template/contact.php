<h1><?= $title ?></h1>

<form action="" method="post">

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="Saissisez votre mail" required>
    </div>

    <div>
        <label for="subject">Subject</label>
        <select name="subject" id="subject" required>
            <option value="refund">Remboursement</option>
            <option value="help">Aide</option>
            <option value="problem">Problème</option>
        </select>
    </div>

    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10" style="resize: none;" required></textarea>
    </div>

    <button type="submit">Soumettre</button>

</form>
