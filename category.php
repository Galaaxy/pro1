<?php

/**
 * Template Name: Beiträge
 */

get_header();


/**
 * Has the Page a Passwort? NO? Go this way
 */
if ( ! post_password_required() ) {
	
	$context = renderPage();

	
	Timber::render("page-mittagstisch.html.twig", $context);

/**
 * The Page has a Passwort? Yes? Go this way
 */
}else if ( post_password_required() ){
	
	$context = renderPage();

	$context["post"]->content    = get_the_password_form();
	Timber::render("page.html.twig", $context);
}

/**
 * Standard pageRender function gets the information and put them in Array to overgive them to the Template
 */
function renderPage(){

	$context = Timber::get_context();
	$context['posts'] = new Timber\PostQuery();
	$context[ 'category' ] = Timber::get_term(['taxonomy'=>'category']);

	return $context;
}




get_footer();
