<?php
/*
Template Name: Depose Annonce Page
*/

get_header();
?>
<section class="container section">
    <article class="dark-panel">
        <p class="chip">Deposer une annonce</p>
        <h1>Creer un produit / une annonce</h1>
        <p>Remplissez les informations du materiel puis publiez votre annonce.</p>
    </article>
</section>

<section class="container section">
    <article class="card">
        <form id="createProductForm" class="stack">
            <div class="grid cols-3 gap-sm">
                <div id="stepBadge1" class="chip">1. Choisir categorie</div>
                <div id="stepBadge2" class="chip muted">2. Choisir sous categorie</div>
                <div id="stepBadge3" class="chip muted">3. Creer materiel</div>
            </div>

            <section id="step1" class="stack">
                <h2>Etape 1: Categorie</h2>
                <input id="category" type="text" class="hidden" required />
                <div id="categoryGrid" class="grid cols-4 gap-md">
                    <button type="button" class="category-card btn btn-outline" data-category="Materiels TP">Materiels TP</button>
                    <button type="button" class="category-card btn btn-outline" data-category="Manutention">Manutention</button>
                    <button type="button" class="category-card btn btn-outline" data-category="Poids Lourds">Poids Lourds</button>
                    <button type="button" class="category-card btn btn-outline" data-category="Agricole">Agricole</button>
                </div>
                <button id="toStep2" type="button" class="btn btn-brand">Continuer</button>
            </section>

            <section id="step2" class="stack hidden">
                <h2>Etape 2: Sous categorie</h2>
                <input id="subcategory" type="text" class="hidden" required />
                <div id="subcategoryGrid" class="grid cols-4 gap-md"></div>
                <div class="row gap-sm">
                    <button id="backToStep1" type="button" class="btn btn-outline">Retour</button>
                    <button id="toStep3" type="button" class="btn btn-brand">Continuer</button>
                </div>
            </section>

            <section id="step3" class="stack hidden">
                <h2>Etape 3: Informations materiel</h2>
                <div class="grid cols-2 gap-md">
                    <div class="form-group"><label>Titre *</label><input required /></div>
                    <div class="form-group"><label>Prix (MAD)</label><input type="number" /></div>
                    <div class="form-group"><label>Constructeur</label><input /></div>
                    <div class="form-group"><label>Modele</label><input /></div>
                    <div class="form-group"><label>Annee</label><input type="number" /></div>
                    <div class="form-group"><label>Ville</label><input /></div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="5"></textarea>
                </div>
                <div class="row gap-sm">
                    <button id="backToStep2" type="button" class="btn btn-outline">Retour</button>
                    <button type="submit" class="btn btn-brand">Publier l'annonce</button>
                </div>
            </section>
        </form>
    </article>
</section>
<?php
get_footer();
