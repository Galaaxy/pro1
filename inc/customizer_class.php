<?php
/**
 * Created by PhpStorm.
 * User: Freddy
 * Date: 01.03.2018
 * Time: 21:55
 */




class customizer_class{

	private $anzahl;
	private $prio;

	/**
	 * $wp_customize (Pflicht), $anzahl (Pflicht), $prio (Pflicht), $sliderWidth (Pflicht), $sliderHeight (Pflicht)
	 */
	public function slider_module($wp_customize, $anzahl, $prio, $sliderWidth, $sliderHeight){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Slider Module
		 * ================================
		 */

		$wp_customize->add_section('slider', array(
			'title' => __('Bild Slider'),
			'description' => sprintf(__('Bild Slider Verwaltung', 'slider')),
			'priority' => $this->prio
		));


		$wp_customize->add_setting('slider_speed', array(
			'type'  => 'theme_mod',
			'transport' => 'postMessage',
			'default' => '3000'
		));

		$wp_customize->add_control('slider_speed',array(
			'label' => __('Geschwindigkeit des Sliders in ms Default ist 3000 = 3 Sekunden'),
			'section' => 'slider',
			'priority' => 0
		));

		/**
		 * Befülle die Slider-Customizer Section mit so vielen Einträgen wie in $anzahlSlider angegeben
		 * theme_mods:
		 * slider_image_x == Bild
		 * slider_title_x == Titel des Sliders
		 * slider_subtitle_x == Sub-title des Sliders
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'slider_header_'.$i;
			$image = 'slider_image_'.$i;
			$title = 'slider_title_'.$i;
			$subtitle = 'slider_subtitle_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 3;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);

			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Slider '.$i),
					'section' => 'slider',
					'priority' => $priority
				) )
			);

			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $image, array(
				'label' => 'Bild Hochladen',
				'section' => 'slider',
				'settings' => $image,
				'priority' => $priority,
				'height'	=> $sliderHeight,
				'width'		=> $sliderWidth,
				'flex_width'=> false,
				'flex_height'=> false
			) ) );

			/**
			 * -------------------
			 * Title
			 * -------------------
			 */
			$wp_customize->add_setting($title, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control($title,array(
				'label' => __('Titel des Sliders'),
				'section' => 'slider',
				'priority' => $priority + 1
			));

			/**
			 * -------------------
			 * Sub-Title
			 * -------------------
			 */
			$wp_customize->add_setting($subtitle, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control($subtitle,array(
				'label' => __('Untertitel des Sliders'),
				'section' => 'slider',
				'priority' => $priority + 2
			));


		}

	}

	public function galerie_module($wp_customize, $anzahl, $prio){

		$this->anzahl = $anzahl;
		$this->prio = $prio;


		/**
		 * ================================
		 * ## Galerie Module
		 * ================================
		 */

		$wp_customize->add_section('galerie', array(
			'title' => __('Bild Galerie'),
			'description' => sprintf(__('Bild Galerie Verwaltung', 'galerie')),
			'priority' => $this->prio
		));

		/**
		 * Befülle die Galerie-Customizer Section mit so vielen Einträgen wie in $anzahlGalerie angegeben
		 * theme_mods:
		 * galerie_image_x == Bild
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'galerie_header_'.$i;
			$image = 'galerie_image_'.$i;


			$priority = $i;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);

			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Bild '.$i),
					'section' => 'galerie',
					'priority' => $priority
				) )
			);

			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $image,
				array(
					'label' => 'Bild Hochladen',
					'section' => 'galerie',
					'settings' => $image,
					'priority' => $priority
				) ) );


		}
	}


	public function team_module($wp_customize, $anzahl, $prio){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Team Module
		 * ================================
		 */

		/**
		 * Create new Section Team
		 */
		$wp_customize->add_section('team', array(
			'title' => __('Team'),
			'description' => sprintf(__('Team Verwaltung', 'team')),
			'priority' => $this->prio
		));


		$wp_customize->add_setting('team_title', array(
			'type'  => 'theme_mod',
			'transport' => 'postMessage',
			'default' => 'Team'
		));

		$wp_customize->add_control('team_title',array(
			'label' => __('Überschrift für das Team'),
			'section' => 'team',
			'priority' => 0
		));

		/**
		 * Befülle die Team-Customizer Section mit so vielen Personen wie in $anzahlTeam angegeben
		 * theme_mods:
		 * team_image_x == Bild
		 * team_name_x == Name der Person
		 * team_position_x == Position der Person
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'team_header_'.$i;
			$image = 'team_image_'.$i;
			$name = 'team_name_'.$i;
			$position = 'team_position_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 3;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Person '.$i),
					'section' => 'team',
					'priority' => $priority
				) )
			);

			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $image,
				array(
					'label' => 'Bild Hochladen',
					'section' => 'team',
					'settings' => $image,
					'priority' => $priority
				) ) );

			/**
			 * -------------------
			 * Name
			 * -------------------
			 */
			$wp_customize->add_setting($name, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control($name,array(
				'label' => __('Name'),
				'section' => 'team',
				'priority' => $priority + 1
			));

			/**
			 * -------------------
			 * Position
			 * -------------------
			 */
			$wp_customize->add_setting($position, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default'   => ''
			));

			$wp_customize->add_control($position,array(
				'label' => __('Position'),
				'section' => 'team',
				'priority' => $priority + 2
			));

		}
	}

	public function teaser_module($wp_customize, $anzahl, $prio, $teaserWidth, $teaserHeight, $parallaxWidth, $parallaxHeight){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Teaser Module
		 * ================================
		 */

		/**
		 * Create new Section Teaser
		 */
		$wp_customize->add_section('teaser', array(
			'title' => __($this->anzahl.'er Teaser'),
			'description' => sprintf(__('Teaser Verwaltung', 'teaser')),
			'priority' => $this->prio
		));

		/**
		 * -------------------
		 * Parallax-Image
		 * -------------------
		 */
		$wp_customize->add_setting('teaser_parallax',array(
			'type' => 'theme_mod',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'teaser_parallax', array(
			'label' => 'Parallax-Bild Hochladen',
			'section' => 'teaser',
			'settings' => 'teaser_parallax',
			'priority' => 3,
			'height'	=> $parallaxHeight,
			'width'		=> $parallaxWidth,
			'flex_width'=> false,
			'flex_height'=> false
		) ) );

		/**
		 * Befülle die Team-Customizer Section mit so vielen Personen wie in $anzahlTeam angegeben
		 * theme_mods:
		 * team_image_x == Bild
		 * team_name_x == Name der Person
		 * team_position_x == Position der Person
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'teaser_header_'.$i;
			$image = 'teaser_image_'.$i;
			$farbe = 'teaser_farbe_'.$i;
			$name = 'teaser_name_'.$i;
			$position = 'teaser_position_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 5;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Teaser '.$i),
					'section' => 'teaser',
					'priority' => $priority
				) )
			);

			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $image, array(
				'label' => 'Teaser-Bild Hochladen',
				'section' => 'teaser',
				'settings' => $image,
				'priority' => $priority + 1,
				'height'	=> $teaserHeight,
				'width'		=> $teaserWidth,
				'flex_width'=> false,
				'flex_height'=> false
			) ) );

			/**
			 * -------------------
			 * Farbe
			 * -------------------
			 */
			$wp_customize->add_setting($farbe, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $farbe, array(
				'label'      => 'Teaser Farbe',
				'section'    => 'teaser',
				'settings'   => $farbe,
				'priority'   => $priority + 2 
			)));


			/**
			 * -------------------
			 * Überschrift
			 * -------------------
			 */
			$wp_customize->add_setting($name, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control($name,array(
				'label' => __('Überschrift'),
				'section' => 'teaser',
				'priority' => $priority + 3
			));

			/**
			 * -------------------
			 * text
			 * -------------------
			 */
			$wp_customize->add_setting($position, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default'   => ''
			));

			$wp_customize->add_control($position,array(
				'type' => 'textarea',
				'label' => __('Text'),
				'section' => 'teaser',
				'priority' => $priority + 4
			));

		}
	}

	public function teaser_module_2($wp_customize, $anzahl, $prio, $teaserWidth, $teaserHeight, $parallaxWidth, $parallaxHeight){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Teaser Module
		 * ================================
		 */

		/**
		 * Create new Section Teaser
		 */
		$wp_customize->add_section('teaser2', array(
			'title' => __($this->anzahl.'er Teaser'),
			'description' => sprintf(__('Teaser Verwaltung', 'teaser2')),
			'priority' => $this->prio
		));

		/**
		 * -------------------
		 * Parallax-Image
		 * -------------------
		 */
		$wp_customize->add_setting('teaser2_parallax',array(
			'type' => 'theme_mod',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'teaser2_parallax', array(
			'label' => 'Parallax-Bild Hochladen',
			'section' => 'teaser2',
			'settings' => 'teaser2_parallax',
			'priority' => 3,
			'height'	=> $parallaxHeight,
			'width'		=> $parallaxWidth,
			'flex_width'=> false,
			'flex_height'=> false
		) ) );

		/**
		 * Befülle die Team-Customizer Section mit so vielen Personen wie in $anzahlTeam angegeben
		 * theme_mods:
		 * team_image_x == Bild
		 * team_name_x == Name der Person
		 * team_position_x == Position der Person
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'teaser2_header_'.$i;
			$image = 'teaser2_image_'.$i;
			$farbe = 'teaser2_farbe_'.$i;
			$name = 'teaser2_name_'.$i;
			$position = 'teaser2_position_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 5;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Teaser '.$i),
					'section' => 'teaser2',
					'priority' => $priority
				) )
			);


			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $image, array(
				'label' => 'Teaser-Bild Hochladen',
				'section' => 'teaser2',
				'settings' => $image,
				'priority' => $priority + 1,
				'height'	=> $teaserHeight,
				'width'		=> $teaserWidth,
				'flex_width'=> false,
				'flex_height'=> false
			) ) );

			/**
			 * -------------------
			 * Farbe
			 * -------------------
			 */
			$wp_customize->add_setting($farbe, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $farbe, array(
				'label'      => 'Teaser Farbe',
				'section'    => 'teaser2',
				'settings'   => $farbe,
				'priority'   => $priority + 2 
			)));

			/**
			 * -------------------
			 * Überschrift
			 * -------------------
			 */
			$wp_customize->add_setting($name, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control($name,array(
				'label' => __('Überschrift'),
				'section' => 'teaser2',
				'priority' => $priority + 3
			));

			/**
			 * -------------------
			 * text
			 * -------------------
			 */
			$wp_customize->add_setting($position, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default'   => ''
			));

			$wp_customize->add_control($position,array(
				'type' => 'textarea',
				'label' => __('Text'),
				'section' => 'teaser2',
				'priority' => $priority + 4
			));

		}
	}

	public function teaser_module_3($wp_customize, $anzahl, $prio, $teaserWidth, $teaserHeight, $parallaxWidth, $parallaxHeight){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Teaser Module
		 * ================================
		 */

		/**
		 * Create new Section Teaser
		 */
		$wp_customize->add_section('teaser3', array(
			'title' => __($this->anzahl.'er Teaser'),
			'description' => sprintf(__('Teaser Verwaltung', 'teaser3')),
			'priority' => $this->prio
		));

		/**
		 * -------------------
		 * Parallax-Image
		 * -------------------
		 */
		$wp_customize->add_setting('teaser3_parallax',array(
			'type' => 'theme_mod',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'teaser3_parallax', array(
			'label' => 'Parallax-Bild Hochladen',
			'section' => 'teaser3',
			'settings' => 'teaser3_parallax',
			'priority' => 3,
			'height'	=> $parallaxHeight,
			'width'		=> $parallaxWidth,
			'flex_width'=> false,
			'flex_height'=> false
		) ) );

		/**
		 * Befülle die Team-Customizer Section mit so vielen Personen wie in $anzahlTeam angegeben
		 * theme_mods:
		 * team_image_x == Bild
		 * team_name_x == Name der Person
		 * team_position_x == Position der Person
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'teaser3_header_'.$i;
			$image = 'teaser3_image_'.$i;
			$farbe = 'teaser3_farbe_'.$i;
			$name = 'teaser3_name_'.$i;
			$position = 'teaser3_position_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 5;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Teaser '.$i),
					'section' => 'teaser3',
					'priority' => $priority
				) )
			);


			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $image, array(
				'label' => 'Teaser-Bild Hochladen',
				'section' => 'teaser3',
				'settings' => $image,
				'priority' => $priority + 1,
				'height'	=> $teaserHeight,
				'width'		=> $teaserWidth,
				'flex_width'=> false,
				'flex_height'=> false
			) ) );

			/**
			 * -------------------
			 * Farbe
			 * -------------------
			 */
			$wp_customize->add_setting($farbe, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $farbe, array(
				'label'      => 'Teaser Farbe',
				'section'    => 'teaser3',
				'settings'   => $farbe,
				'priority'   => $priority + 2 
			)));

			/**
			 * -------------------
			 * Überschrift
			 * -------------------
			 */
			$wp_customize->add_setting($name, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control($name,array(
				'label' => __('Überschrift'),
				'section' => 'teaser3',
				'priority' => $priority + 3
			));

			/**
			 * -------------------
			 * text
			 * -------------------
			 */
			$wp_customize->add_setting($position, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default'   => ''
			));

			$wp_customize->add_control($position,array(
				'type' => 'textarea',
				'label' => __('Text'),
				'section' => 'teaser3',
				'priority' => $priority + 4
			));

		}
	}

	public function teaser_module_4($wp_customize, $anzahl, $prio, $teaserWidth, $teaserHeight, $parallaxWidth, $parallaxHeight){

		$this->anzahl = $anzahl;
		$this->prio = $prio;

		/**
		 * ================================
		 * ## Teaser Module
		 * ================================
		 */

		/**
		 * Create new Section Teaser
		 */
		$wp_customize->add_section('teaser4', array(
			'title' => __($this->anzahl.'er Teaser'),
			'description' => sprintf(__('Teaser Verwaltung', 'teaser4')),
			'priority' => $this->prio
		));

		/**
		 * -------------------
		 * Parallax-Image
		 * -------------------
		 */
		$wp_customize->add_setting('teaser4_parallax',array(
			'type' => 'theme_mod',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'teaser4_parallax', array(
			'label' => 'Parallax-Bild Hochladen',
			'section' => 'teaser4',
			'settings' => 'teaser4_parallax',
			'priority' => 3,
			'height'	=> $parallaxHeight,
			'width'		=> $parallaxWidth,
			'flex_width'=> false,
			'flex_height'=> false
		) ) );

		/**
		 * Befülle die Team-Customizer Section mit so vielen Personen wie in $anzahlTeam angegeben
		 * theme_mods:
		 * team_image_x == Bild
		 * team_name_x == Name der Person
		 * team_position_x == Position der Person
		 *
		 * x steht für eine beliebige Zahl
		 */
		for($i = 1; $i<=$this->anzahl; $i++){

			$header = 'teaser4_header_'.$i;
			$image = 'teaser4_image_'.$i;
			$farbe = 'teaser4_farbe_'.$i;
			$name = 'teaser4_name_'.$i;
			$position = 'teaser4_position_'.$i;

			/**
			 * Counter x Anzahl Einträge = priority
			 * Da wir hier 3 theme_mod einträge haben müssen wir immer mit x 3 Multiplizieren damit die Position stimmt.
			 */
			$priority = $i * 5;

			/**
			 * -------------------
			 * Header
			 * -------------------
			 */
			$wp_customize->add_setting($header, array(
					'type'              => 'info_control',
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			$wp_customize->add_control( new pro_info( $wp_customize, $header, array(
					'label' => __('Teaser '.$i),
					'section' => 'teaser4',
					'priority' => $priority
				) )
			);


			/**
			 * -------------------
			 * Image
			 * -------------------
			 */
			$wp_customize->add_setting($image,array(
				'type' => 'theme_mod',
				'transport' => 'postMessage'
			));

			$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, $image, array(
				'label' => 'Teaser-Bild Hochladen',
				'section' => 'teaser4',
				'settings' => $image,
				'priority' => $priority + 1,
				'height'	=> $teaserHeight,
				'width'		=> $teaserWidth,
				'flex_width'=> false,
				'flex_height'=> false
			) ) );

			/**
			 * -------------------
			 * Farbe
			 * -------------------
			 */
			$wp_customize->add_setting($farbe, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $farbe, array(
				'label'      => 'Teaser Farbe',
				'section'    => 'teaser4',
				'settings'   => $farbe,
				'priority'   => $priority + 2 
			)));

			/**
			 * -------------------
			 * Überschrift
			 * -------------------
			 */
			$wp_customize->add_setting($name, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default' => ''
			));

			$wp_customize->add_control($name,array(
				'label' => __('Überschrift'),
				'section' => 'teaser4',
				'priority' => $priority + 3
			));

			/**
			 * -------------------
			 * text
			 * -------------------
			 */
			$wp_customize->add_setting($position, array(
				'type'  => 'theme_mod',
				'transport' => 'postMessage',
				'default'   => ''
			));

			$wp_customize->add_control($position,array(
				'type' => 'textarea',
				'label' => __('Text'),
				'section' => 'teaser4',
				'priority' => $priority + 4
			));

		}
	}

}