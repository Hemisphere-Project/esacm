<?php
/*
Element Description: VC Intro Text
*/

// Element Class
class vcTitreAncre extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_titreancre_mapping' ) );
        add_shortcode( 'vc_titreancre', array( $this, 'vc_titreancre_html' ) );
    }

    // Element Mapping
    public function vc_titreancre_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __('VC Titre Ancre', 'text-domain'),
                'base' => 'vc_titreancre',
                'description' => __('Sous-titre d\'une page accessible par le sous-menu en en-tête', 'text-domain'),
                'params' => array(

                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title',
                        'heading' => __( 'Titre Ancre', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Titre Ancre', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    )

                ),
            )
        );

    }


    // Element HTML
    public function vc_titreancre_html( $atts ) {

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
        $html = '
        <div class="vc-titreancre-wrap">

            <h2 class="vc-titreancre-title title" id="' . custom_url_encode(str_replace(' ', '-', $title)) . '">' . $title . '</h2>

        </div>';

        return $html;

    }

} // End Element Class


// Element Class Init
new vcTitreAncre();

?>
