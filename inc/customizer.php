<?php

include_once "customizer_class.php";

function hauboldmedia_customizer_settings($wp_customize) {

    /**
	 * ================================
	 * ## Additional Functions / Extends
	 * ================================
	 */
	class pro_info extends WP_Customize_Control {
		public $type = 'info';
		public $label = '';
		public function render_content() {
			?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}

	/**
	 * ================================
	 * ## Options
	 * ================================
	 */

	/**
	 * Wieviele Teammitglieder im Customizer angezeigt werden sollen
	 */
	$anzahlTeam     = 6;
	$anzahlGalerie  = 8;
	$anzahlSlider   = 6;
	$anzahlTeaser 	= 2;
	$anzahlTeaser2  = 4;
	$anzahlTeaser3  = 3;
	$anzahlTeaser4  = 1;

	/**
	 * prioritys | Reihenfolge der Customizer Module
	 */
	$sliderPrio     = 120;
	$galeriePrio    = 125;
	$teamPrio       = 130;
	$teaserPrio		= 135;
	$teaser2Prio	= 140;
	$teaser3Prio	= 145;
	$teaser4Prio	= 150;

	/**
	 * ================================
	 * ## Initialisiere Module
	 * ================================
	 */

	/**
	 * Create Slider Module
	 */
	$slider = new customizer_class();
	$slider->slider_module($wp_customize, $anzahlSlider, $sliderPrio, 1920, 700);

	/**
	 * Create Galerie Module
	 */
	/*
    $galerie = new customizer_class();
    $galerie->galerie_module($wp_customize, $anzahlGalerie, $galeriePrio);
*/
    /**
     * Create Team Module
     */
	/*
    $team = new customizer_class();
	$team->team_module($wp_customize, $anzahlTeam, $teamPrio);
	*/
	
    /**
     * Create Teaser Module
	 * @param $wp_customize = Wordpress Customizer Global Class
	 * @param $anzahlTeaser = Ziehe die Daten aus der Anzahl Tabelle
	 * @param $teaserPrio   = Prio / Reihenfolge der Customizer Felder
	 * @param 4. & 5. Feld  = Width & Height der Teaser Icons in Pixel
	 * @param 6. & 7. Feld  = Width & Height des Parallax Bildes im Hintergrund des Teaser-Blocks in Pixel
     */
    $teaser = new customizer_class();
    $teaser->teaser_module($wp_customize, $anzahlTeaser, $teaserPrio, 30, 30, 1920, 1080);

	// 2. Teaser-Block
	$team = new customizer_class();
	$team->teaser_module_2($wp_customize, $anzahlTeaser2, $teaser2Prio, 30, 30, 1920, 1080);
	
	// 3. Teaser-Block
	//$team = new customizer_class();
	//$team->teaser_module_3($wp_customize, $anzahlTeaser3, $teaser3Prio, 250, 250, 1920, 1080);
	
	// 4. Teaser-Block
	//$team = new customizer_class();
    //$team->teaser_module_4($wp_customize, $anzahlTeaser4, $teaser4Prio, 250, 250, 1920, 1080);
}
add_action('customize_register', 'hauboldmedia_customizer_settings');

