<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcLienPageSuivante extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_lienpagesuivante_mapping' ) );
        add_shortcode( 'vc_lienpagesuivante', array( $this, 'vc_lienpagesuivante_html' ) );
    }
     
    // Element Mapping
    public function vc_lienpagesuivante_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('VC Lien Page Suivante', 'text-domain'),
                'base' => 'vc_lienpagesuivante',
                'description' => __('Lien page suivante', 'text-domain'), 
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
    public function vc_lienpagesuivante_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'intitule'   => '',
                    'url' => '',
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        $html = '
        <div class="vc-lienpagesuivante-wrap typo_beta"">
         
            <a class="vc-lienpagesuivante" href="'.$url.'">→&nbsp;' . $intitule . '</a>
         
        </div>';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcLienPageSuivante(); 

?>
