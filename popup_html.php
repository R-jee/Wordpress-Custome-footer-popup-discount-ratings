<?php



$popup_header_text = "";
$popup_ratings = ""; 
$popup_discountBoldtext = ""; 
$popup_discountText = ""; 
$popup_discountBtn_url = ""; 
$popup_image_url = ""; 


if ( get_option("popup_settings__options") ){
    $my_popup_settings__options = get_option('popup_settings__options');
    // print_r($my_popup_settings__options);
    $popup_header_text = $my_popup_settings__options['popup_data']['popup_header_text'];
    $popup_ratings = $my_popup_settings__options['popup_data']['popup_ratings'];
    $popup_discountBoldtext = $my_popup_settings__options['popup_data']['popup_discountBoldtext'];
    $popup_discountText = $my_popup_settings__options['popup_data']['popup_discountText'];
    $popup_discountBtn_url = $my_popup_settings__options['popup_data']['popup_discountBtn_url'];
    $popup_image_url = $my_popup_settings__options['popup_data']['popup_image_url'];
}



if (!is_user_logged_in() && !is_admin()) {
    wp_redirect(site_url());
    exit;
} else {
    //store in one variable
    // print_r($_POST);
    if (isset($_POST['popup_submit'])) {
        $popup_settings_data_options = array(
            'popup_data' => array(
                'popup_header_text' => ( isset($_POST['popup_header_text']) ) ? $_POST['popup_header_text'] : "",
                'popup_ratings' => (isset($_POST['popup_ratings'])) ? $_POST['popup_ratings'] : "",
                'popup_discountBoldtext' => (isset($_POST['popup_discountBoldtext'])) ? $_POST['popup_discountBoldtext'] : "",
                'popup_discountText' => (isset($_POST['popup_discountText'])) ? $_POST['popup_discountText'] : "",
                'popup_discountBtn_url' => (isset($_POST['popup_discountBtn_url'])) ? $_POST['popup_discountBtn_url'] : "",
                'popup_image_url' => (isset($_POST['popup_image'])) ? $_POST['popup_image'] : "",
            )
        );
        // print_r($popup_settings_data_options);
        //Update entire array
        update_option('popup_settings__options', $popup_settings_data_options);
        // wp_redirect( "https://www.glamthoughts.com/wp-admin/admin.php" );
        if ( get_option("popup_settings__options") ){
            $my_popup_settings__options = get_option('popup_settings__options');
            // print_r($my_popup_settings__options);
            $popup_header_text = $my_popup_settings__options['popup_data']['popup_header_text'];
            $popup_ratings = $my_popup_settings__options['popup_data']['popup_ratings'];
            $popup_discountBoldtext = $my_popup_settings__options['popup_data']['popup_discountBoldtext'];
            $popup_discountText = $my_popup_settings__options['popup_data']['popup_discountText'];
            $popup_discountBtn_url = $my_popup_settings__options['popup_data']['popup_discountBtn_url'];
            $popup_image_url = $my_popup_settings__options['popup_data']['popup_image_url'];
        }
        //Get entire array
        // $my_multi_options = get_option('popup_settings__options');
        // echo "<br><pre>";
        // print_r($my_multi_options);
        // echo "</pre>";
    }
}
?>


<div class="wrap">
    <h1>Popup Settings</h1>

    <form method="POST" action="" novalidate="novalidate">
        <!-- <input type="hidden" name="option_page" value="general">
        <input type="hidden" name="action" value="update">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="c0922d37b4">
        <input type="hidden" name="_wp_http_referer" value="/wp-admin/options-general.php"> -->

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="popup_header_text">Pop up Header</label></th>
                    <td><input name="popup_header_text" type="text" id="popup_header_text" value="<?php echo  $popup_header_text; ?>" class="regular-text"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="popup_ratings">Ratings</label></th>
                    <td><input name="popup_ratings" type="text" id="popup_ratings" aria-describedby="tagline-description" value="<?php echo  $popup_ratings; ?>" class="regular-text">
                        <p class="description" id="tagline-description">Ratings from ( 0 ~ 10 )</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="popup_discountBoldtext">Discount Bold Text</label></th>
                    <td><input name="popup_discountBoldtext" type="text" id="popup_discountBoldtext" value="<?php echo  $popup_discountBoldtext; ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="popup_discountText">Discount Text</label></th>
                    <td><input name="popup_discountText" type="text" id="popup_discountText" value="<?php echo  $popup_discountText; ?>" class="regular-text"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="popup_discountBtn_url">Get Deal (URL)</label></th>
                    <td>
                        <input name="popup_discountBtn_url" type="url" id="popup_discountBtn_url" value="<?php echo  $popup_discountBtn_url; ?>" class="regular-text code">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="">Add Media</label></th>
                    <td>
                        <div class="thumbnail">
                            <div class="centered image_holder" >
                                <!-- <img name="popup_image_url" id="popup_image_url" src="" draggable="false" alt=""  class="thumbnail" style="width:200px"> -->
                                <input type="hidden" name="popup_image" id="popup_image" value="<?php echo  $popup_image_url; ?>" >
                                <input type="image" name="popup_image_url" id="popup_image_url" src="<?php echo  $popup_image_url; ?>" draggable="false" alt="popup_image_url" class="thumbnail popup_image_url" />
                            </div>
                            <p>
                                <input type="number" value="" class="regular-text process_custom_images_id" id="popup_image_uploader__id" name="" max="" min="1" step="1" disabled hidden>
                                <button class="set_custom_images button">Add Image</button>
                            </p>
                        </div>
                        <!-- <input name="popup_image_url" type="text" id="popup_image_url" value="" class="regular-text code"> -->
                    </td>
                </tr>
            
            </tbody>
        </table>
        
        <p class="submit"><input type="submit" name="popup_submit" id="popup_submit" class="button button-primary" value="Save Changes"></p>
    </form>
    <!-- <p>
        <input type="number" value="" class="regular-text process_custom_images_id" id="popup_image_uploader__id" name="" max="" min="1" step="1" disabled hidden>
        <button class="set_custom_images button">Add Image</button>
    </p> -->


</div>


<script>
    
jQuery(document).ready(function() {
    var $ = jQuery;

    $('#popup_image_url').on('click', function(e) {
        e.preventDefault();
    });
    console.log($("#popup_discountBtn_url").val());
    // console.log($('.set_custom_images').length);
    if ($('.set_custom_images').length > 0) {
        // console.log(( typeof wp !== 'undefined' && wp.media && wp.media.editor));
        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            $('.set_custom_images').on('click', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.prev();
                // var id = $("#popup_image_uploader");
                wp.media.editor.send.attachment = function(props, attachment) {
                    id.val(attachment.id);
                    attachmentURL = wp.media.attachment(attachment.id).get("url");
                    // console.log(attachment.id);
                    $("#popup_image_url").attr('src', attachmentURL );
                    $("#popup_image").val(attachmentURL );
                };
                wp.media.editor.open(button);
                return false;
            });
        }
    }
});



function popup_custom_startRatings($star_no, $star_ratings, $start_ratings_total){
      $popup_ratings_use = $star_ratings;
	  if($start_ratings_total == 10){
	    $popup_ratings_use = $popup_ratings_use / 2;
	  }else if($start_ratings_total == 5){
	    $popup_ratings_use = $star_ratings * 2; 
	  }
	//   echo $popup_ratings_use;
	  if($start_ratings_total == 10){
	    $popup_ratings_use = $popup_ratings_use - ( $star_no - 1)  ;
	  }else if($start_ratings_total == 5){
	    $popup_ratings_use = $popup_ratings_use - ( $star_no )  ;
	  }
	  
	//   echo $popup_ratings_use. PHP_EOL;
  	if( $popup_ratings_use < 0  ){
  	    $popup_ratings_use = 0;
  	}
	//   echo $popup_ratings_use. PHP_EOL;
  	if($popup_ratings_use > $star_no){
  	  $popup_ratings_use = 1;
  	}
  	return ( fmod( $popup_ratings_use ,  2) == 0 ) ? "fa-star-o" : (    ( fmod( $popup_ratings_use ,  2) == 1 ) ? "fa-star" : "fa-star-half");
}


</script>

<style>
    .image_holder {
        max-width: 342px;
        min-width: 342px;
        max-height: 200px;
        min-height: 200px;
        margin-bottom: 5px;
        border: 1px dashed lightgray;
    }#popup_image_url {
        width: 340px;
        height: 200px;
    }
</style>