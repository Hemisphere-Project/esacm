<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcGlyphe extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_glyphe_mapping' ) );
        add_shortcode( 'vc_glyphe', array( $this, 'vc_glyphe_html' ) );
    }
     
    // Element Mapping
    public function vc_glyphe_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('VC Glyphe', 'text-domain'),
                'base' => 'vc_glyphe',
                'description' => __('Texte sous forme de Glyphe', 'text-domain'), 
                'category' => __('My Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                     
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text',
                        'value' => __( 'Default value', 'text-domain' ),
                        'description' => __( 'Box Text', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Custom Group',
                    ),                      
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    public function vc_glyphe_html( $atts ) {
         
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
        
        //ADD <wbr/> between each letter to avoid chrome not breaking word between slashes.
	/*for ($i = 0; $i < strlen($text); $i+=6){
	    if( substr($text, $i ,$i+5) == "</ br>" or substr($text, $i ,$i+5) == "</p>" ){
	    	//DONT PUT <wbr/> inside </br> tag
	    	$i=$i+4;
	    }
	    else{
	    	$text = substr($text,0,$i)."<wbr>".substr($text, $i);
	    }
	    
	}*/
         
        // Fill $html var with data
        $html = '
        <div class="vc-glyphe-wrap typo_glyphe">
         
            <p class="vc-glyphe-text">' . $text . '</p>
         
        </div>';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcGlyphe(); 

?>
