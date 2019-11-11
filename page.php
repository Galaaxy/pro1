<?php

get_header();



if ( ! post_password_required() ) {
	$context = array();

	$args = array(
		'post_type' => 'post'
	);

	$context = Timber::get_context();
	$context["template"] = get_page_template_slug($post->ID);
	$context["post"]    = new TimberPost($post->ID);
	$context["beitrag"] = get_the_category_list("","",$post->ID);
	Timber::render("page.html.twig", $context);

}else if ( post_password_required() ){
	$context = array();

	$context = Timber::get_context();
	$context["template"] = get_page_template_slug($post->ID);
	$context["post"]    = new TimberPost($post->ID);
	$context["post"]->content    = get_the_password_form();
	Timber::render("page.html.twig", $context);
}





get_footer();
