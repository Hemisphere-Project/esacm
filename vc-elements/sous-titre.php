<?php
/*
Element Description: VC Intro Text
*/

// Element Class
class vcSousTitre extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_soustitre_mapping' ) );
        add_shortcode( 'vc_soustitre', array( $this, 'vc_soustitre_html' ) );
    }

    // Element Mapping
    public function vc_soustitre_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __('VC Sous Titre', 'text-domain'),
                'base' => 'vc_soustitre',
                'description' => __('Sous-titre', 'text-domain'),
                'params' => array(

                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title',
                        'heading' => __( 'Sous Titre', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Sous Titre', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    )

                ),
            )
        );

    }


    // Element HTML
    public function vc_soustitre_html( $atts ) {

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                ),
                $atts
            )
        );

        // Fill $html var with data
        $html = '<h3 class="vc-soustitre-title subtitle typo_gamma shadowed">' . $title . '</h3>';

        return $html;

    }

} // End Element Class


// Element Class Init
new vcSousTitre();

?>
