<?php
/*
Template Name: Login Register Page
*/

get_header();
?>
<section class="container section">
    <div class="grid cols-12 gap-md">
        <section class="col-span-5">
            <article class="dark-panel">
                <p class="chip">Espace client</p>
                <h1>Connectez-vous et gerez vos annonces en 1 endroit</h1>
                <p>Publiez un vehicule, suivez les messages clients et mettez a jour vos informations rapidement.</p>
            </article>
        </section>

        <section class="col-span-7">
            <article class="card auth-panel">
                <div class="tabs">
                    <button id="tabLogin" class="tab active">Connexion</button>
                    <button id="tabRegister" class="tab">Inscription</button>
                </div>

                <form id="loginForm" class="stack">
                    <h2>Connexion</h2>
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input id="loginEmail" type="email" placeholder="exemple@btp360.ma" />
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Mot de passe</label>
                        <input id="loginPassword" type="password" placeholder="Votre mot de passe" />
                    </div>
                    <button type="submit" class="btn btn-brand">Se connecter</button>
                </form>

                <form id="registerForm" class="stack hidden">
                    <h2>Inscription</h2>
                    <div class="form-group">
                        <label for="registerName">Nom complet</label>
                        <input id="registerName" type="text" placeholder="Ahmed El Idrissi" />
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input id="registerEmail" type="email" placeholder="contact@societe.ma" />
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Mot de passe</label>
                        <input id="registerPassword" type="password" placeholder="Min. 8 caracteres" />
                    </div>
                    <button type="submit" class="btn btn-dark">Creer mon compte</button>
                </form>
            </article>
        </section>
    </div>
</section>
<?php
get_footer();
