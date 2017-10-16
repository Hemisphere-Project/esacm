<?php
/*
Element Description: VC Intro Text
*/
 
// Element Class 
class vcDottedHr extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_dottedhr_mapping' ) );
        add_shortcode( 'vc_dottedhr', array( $this, 'vc_dottedhr_html' ) );
    }
     
    // Element Mapping
    public function vc_dottedhr_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('VC Ligne pointillé', 'text-domain'),
                'base' => 'vc_dottedhr',
                'description' => __('Ligne horizontale en pointillé', 'text-domain'), 
                'params' => array()
            )
        );                                
        
    }
     
     
    // Element HTML
    public function vc_dottedhr_html( $atts ) {
         
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
        $html = '<hr class="vc-dottedhr">';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcDottedHr(); 

?>
