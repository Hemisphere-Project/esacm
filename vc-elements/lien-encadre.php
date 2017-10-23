<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcLienEncadre extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_lienencadre_mapping' ) );
        add_shortcode( 'vc_lienencadre', array( $this, 'vc_lienencadre_html' ) );
    }
     
    // Element Mapping
    public function vc_lienencadre_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('VC Lien Encadré', 'text-domain'),
                'base' => 'vc_lienencadre',
                'description' => __('Lien encadré', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                         
                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Intitulé du lien', 'text-domain' ),
                        'param_name' => 'intitule',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Intitulé du lien', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    ),  
                     
                    array(
                        'type' => 'textfield',
                        'class' => 'text-class',
                        'heading' => __( 'URL du lien', 'text-domain' ),
                        'param_name' => 'url',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Adresse de destination du lien', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    ),                      
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    public function vc_lienencadre_html( $atts ) {
         
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
        <div class="vc-lienencadre-wrap">
         
            <a class="vc-lienencadre" href="'.$url.'">→&nbsp;' . $intitule . '</a>
         
        </div>';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcLienEncadre(); 

?>
