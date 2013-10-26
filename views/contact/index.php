<?php if(isset($_GET['mail']) && $_GET['mail'] == "ok" ): ?>
  <div class="alert alert-success">Email Envoyé</div>
<?php endif; ?>

<section class="pattern">
  <form action="/contact/contact" method="POST" id="contact">
    <fieldset>
      <legend> <i class="icon-envelope-alt"></i> Contact</legend>
       <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control validate[required]" id="nom" name="nom" placeholder="Entrez  nom">
      </div>
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control validate[required]" id="prenom" name="prenom" placeholder="Entrez  prénom">
      </div>
      <div class="form-group">
        <label for="email">Adresse Email</label>
        <input type="text" class="form-control validate[required, custom[email]]" id="email" name="email" placeholder="Entrez email">
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
       <textarea class="form-control" id="message" name="message" rows="9"></textarea>
      </div>
     <button type="submit" name="contact" class="btn btn-primary btn-large btn-block">Envoyer</button>
     <br>
    </fieldset>
  </form>
</section>