<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hmsphr
 */

?>
	<?php if(!is_search()){ ?>

	<div class="spacer shadowedBox"></div>

	<form class="searchform typo_beta footer_search_form" role="search" method="get" class="search-form" action="http://lab.airlab.fr/esacm/">
		<label>
			<input class="search-field" placeholder="rechercher" value="<?php echo get_search_query(); ?>" name="s" type="search">
		</label>
		<input class="search-submit" value="Rechercher" type="submit">
	</form>

	<?php } ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="spacer shadowedBox"></div>
		<div class="site-info">
			<div class="site-info-colonne typo_alpha">
<<<<<<< HEAD
				<a href="<?php echo site_url(); ?>" class="footer_lien_accueil">
					ÉCOLE</br>SUPÉRIEURE</br>D’ART</br>DE CLERMONT</br>MÉTROPOLE
				</a>
=======
				<a class="" title="ESACM" href="<?php echo site_url(); ?>">ÉCOLE</br>SUPÉRIEURE</br>D’ART</br>DE CLERMONT</br>MÉTROPOLE</a>
>>>>>>> f4030e9e7efc12adafb82fffc88d55150506d565
			</div>
			<div class="site-info-colonne typo_epsilon">
				25 rue Kessler</br>
				63000 Clermont-Ferrand</br>
				04 73 17 36 10</br>
				<a href="mailto:esa@esacm.fr">esa@esacm.fr</a>
			</div>
			<div class="site-info-colonne footer-links typo_epsilon">
				<a href="<?php echo get_permalink(get_page_by_title('infos pratiques'));?>">infos pratiques</a></br>
				<a href="<?php echo get_permalink(get_page_by_title('newsletter'));?>">newsletter</a></br>
				<a target="_blank" href="https://www.facebook.com/esacm.clermont/">facebook</a></br>
				<a target="_blank" href="https://www.instagram.com/esacm_clermont/">instagram</a></br>
				<a target="_blank" href="https://twitter.com/esacm_clermont">twitter</a></br>
			</div>
			<div class="site-info-colonne footer-links typo_epsilon">
				<a href="<?php echo get_permalink(get_page_by_title('mentions légales'));?>">mentions légales</a></br>
				<a href="<?php echo get_permalink(get_page_by_title('recrutement'));?>">recrutement</a></br>
				<a href="<?php echo get_permalink(get_page_by_title('appels d’offre et marchés publics'));?>">appels d’offre &amp; marchés publics</a></br>
				<a href="<?php echo get_permalink(get_page_by_title('instances'));?>">instances</a></br>
			</div>
		</div>
		<?php if( is_home() ){?>
		<div class="site-info">
			<div class="site-info-colonne">
				<a target="_blank" href="https://www.clermontmetropole.eu/">
					<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo_clermont_metropole_blanc.svg">
				</a>
			</div>
			<div class="site-info-colonne">
				<a target="_blank" href="https://www.auvergnerhonealpes.fr/">
					<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo_region_blanc.svg">
				</a>
			</div>
			<div class="site-info-colonne">
				<a target="_blank" href="http://www.culturecommunication.gouv.fr/">
					<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo_ministere_blanc.svg">
				</a>
			</div>
			<div class="site-info-colonne">
				<a target="_blank" href="https://clermont-ferrand.fr/">
					<img alt="Logo ESACM" src="<?php echo get_stylesheet_directory_uri();?>/img/logo_clermont_blanc.svg">
				</a>
			</div>
		</div>
		<?php } ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
