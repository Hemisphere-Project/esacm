<?php
/*
Element Description: VC Intro Text
*/
 
// Element Class 
class vcExergue extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_exergue_mapping' ) );
        add_shortcode( 'vc_exergue', array( $this, 'vc_exergue_html' ) );
    }
     
    // Element Mapping
    public function vc_exergue_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('VC Exergue', 'text-domain'),
                'base' => 'vc_exergue',
                'description' => __('Exergue', 'text-domain'), 
                'params' => array(   
                         
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'exergue',
                        'heading' => __( 'Exergue', 'text-domain' ),
                        'param_name' => 'exergue',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Exergue', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    )                    
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    public function vc_exergue_html( $atts ) {
         
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
        <div class="vc-exergue-wrap">
         
            <p class="vc-exergue">' . $exergue . '</p>
             
        </div>';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcExergue(); 

?>
