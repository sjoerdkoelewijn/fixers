<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_image_size( 'lqip', 16, 16, false );


add_filter( 'the_content', 'filter_the_content_in_the_main_loop' );
 
function filter_the_content_in_the_main_loop( $content ) {
     // Check if we are in the main query and in a single page
     if ( is_page() /* && in_the_loop() && is_main_query()*/ ) {

        // Find all img elements from the page content

        $pattern = '/(<img[^>]+>)/i';

        if(preg_match_all($pattern, $content, $matches)){
            foreach($matches[0] as $index => $match){
                // Convert the string to DOM objects so that we can access element attributes easily
                $dom = new DOMDocument();
                @$dom->loadHTML($match);

                // The image element
                $img = $dom->getElementsByTagName("img")[0];
                $imgAttributes = $img->attributes;

                $xpath = new DOMXPath($dom);
                $imageClass = $xpath->evaluate("string(//img/@class)"); # "/images/image.jpg"

                // Store all attributes of the image to an array
                $newImageProperties = array();
                foreach($imgAttributes as $attr){
                    $newImageProperties[$attr->name] = $attr->value;
                }
           
                $end = strpos($imageClass, " ", strpos($imageClass, "wp-image-"));
                $end = $end ? $end : strlen($imageClass);

                $imageId = substr($imageClass, strpos($imageClass, "wp-image-")+9, $end);          
                
                // $imageId = '1172';    
                
                $smallImageSize = wp_get_attachment_image_src($imageId, 'lqip')[0]; 

                // These properties have to be changed since they need to be handled by lazyload
                $newImageProperties["class"] = $newImageProperties["class"]." lazyload";
                $newImageProperties["data-src"] = $newImageProperties["src"];
                $newImageProperties["src"] = $smallImageSize;
                $newImageProperties["data-srcset"] = $newImageProperties["srcset"];
                $newImageProperties["srcset"] = "#";
            
                // Create a new image with all the original attributes

                $newImage = "<img";
                foreach($newImageProperties as $prop => $propValue){
                    $newImage.=" $prop='$propValue'";
                }
                $newImage.= "/>";

                // Replace the old image with the new one.
                $content = str_replace($matches[1][$index], $newImage, $content);
            }
        }
    }
 
    return $content;
}