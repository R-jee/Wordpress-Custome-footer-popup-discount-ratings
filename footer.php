<div class="clear"></div>
</div><!-- .container /-->
<?php tie_banner('banner_bottom' , '<div class="e3lan e3lan-bottom">' , '</div>' ); ?>

<?php get_sidebar( 'footer' ); ?>				
<div class="clear"></div>

<style>
.modal-wrapper{
    display: none;
}
@media screen and (max-width:767px) {
.btn-close {
  cursor: pointer;
  position: relative;
}
.btn-close i.fa {
    color: #fff;
}
.clear {
  clear: both;
}


.top_text p {
    color: #fff;
}


.modal-wrapper {
  display: flex;
  z-index: 999;
  width: 100%;
  height: 100%;
  position: fixed;
  visibility: hidden;
  top: 0;
  left: 0;
  background: rgba(25, 18, 12, 0.3);
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.modal-wrapper.open {
  visibility: visible;
  opacity: 1;
  filter: alpha(opacity=1);
}

.modal {
  display: inline-block;
  height: auto;
  width: 100%;
  position: fixed;
  bottom:0;
  margin: auto;
  background: #e8e8e8;
  background: -webkit-linear-gradient(bottom, #e8e8e8, #fff);
  background: -o-linear-gradient(bottom, #e8e8e8, #fff);
  background: linear-gradient(to top, #e8e8e8, #fff);
  box-shadow: 0px 16px 16px -6px rgba(47, 46, 38, 0.5);
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  -ms-transform: scale(0.7);
  /* IE 9 */
  -webkit-transform: scale(0.7);
  /* Safari */
  transform: scale(0.7);
}
.modal_topbar {
    display: flex;
    justify-content: space-around;
    align-items: center;
    background: #eb6e58;
    padding: .5rem 0 .65rem;
}
.prod_img img {
    max-width: 130px!important;
    position: relative;
    width: 100%;
    padding: 5px;
    border-radius: 10px;
    background: #fff;
    max-height: 130px;
    object-fit: contain;
}
.modal-wrapper.open .modal {
  opacity: 1;
  filter: alpha(opacity=100);
  -ms-transform: scale(1);
  /* IE 9 */
  -webkit-transform: scale(1);
  /* Safari */
  transform: scale(1);
}

.content {
    padding: 10px;
    background: linear-gradient(90deg,rgba(65,68,116,1) 0%,rgba(10,14,73,1) 100%);
    display: flex;
    justify-content: space-around;
    align-items: flex-end;
}
.product_details {
    width: 60%;
    padding: 0 15px;
}
.prod_rating_column {
    width: 40%;
}
.prod_rating_column, .product_details {
    text-align: center;
}
p.deal_time {
    font-size: 11px;
    color: #fff;
    margin-top: 0;
    margin-bottom: 17px;
}
.discount_head {
    color: #fff;
    font-size: 1.6rem;
    font-weight:700;
    margin-top: 0;
    margin-bottom: 17px;
    line-height: normal;
}
a.get_deal_btn {
    background: #0dc342;
    display: block;
    text-decoration: none;
    width: 100%;
    box-shadow: 0 2px 4px 0 rgb(0 0 0 / 16%);
    border-radius: 2px;
    font-size: 14px!important;
    text-transform: uppercase;
    letter-spacing: .75px;
    color: #fff;
    padding: 13px 3px!important;
}
.rating_container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 9%;
}
.stars_rating .fa {
    color: #efc529;
    font-size: 14px;
}
span.number_rating {
    color: #fff;
    font-size: 16px;
    font-weight: 400;
    margin-left: 8px;
    position: relative;
}
}

@media screen and (max-width:425px) {
a.get_deal_btn {
    padding: 8px 3px!important;
}
.discount_head {
    font-size: 1.2rem;
}
}
</style>




<?php  



// print_r(get_option("popup_settings__options"));

$popup_header_text_use = "";
$popup_ratings_use = ""; 
$popup_discountBoldtext_use = ""; 
$popup_discountText_use = ""; 
$popup_discountBtn_url_use = ""; 
$popup_image_url_use = ""; 


if ( get_option("popup_settings__options") ){
    $my_popup_settings__options = get_option('popup_settings__options');
    // print_r($my_popup_settings__options);
    $popup_header_text_use = $my_popup_settings__options['popup_data']['popup_header_text'];
    $popup_ratings_use = $my_popup_settings__options['popup_data']['popup_ratings'];
    $popup_discountBoldtext_use = $my_popup_settings__options['popup_data']['popup_discountBoldtext'];
    $popup_discountText_use = $my_popup_settings__options['popup_data']['popup_discountText'];
    $popup_discountBtn_url_use = $my_popup_settings__options['popup_data']['popup_discountBtn_url'];
    $popup_image_url_use = $my_popup_settings__options['popup_data']['popup_image_url'];
}


function popup_custom_startRatings($star_no, $star_ratings, $start_ratings_total){
	  if($start_ratings_total == 10){
        $popup_ratings_use = $star_ratings;
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
?>

<div class="amr_footer_newsletter">
<div class="nl_container">
<h2>Contact Us</h2>
<?php echo do_shortcode('[wpforms id="1153" title="false"]');?>
</div>
</div>

<div class="footer-bottom">
	<div class="container">
		<div class="alignright">
			<?php
				$footer_vars = array('%year%' , '%site%' , '%url%');
				$footer_val  = array( date('Y') , get_bloginfo('name') , home_url() );
				$footer_two  = str_replace( $footer_vars , $footer_val , tie_get_option( 'footer_two' ));
				echo htmlspecialchars_decode( $footer_two );?>
		</div>
		<?php if( tie_get_option('footer_social') ) tie_get_social( true , false, 'ttip-none' ); ?>
		
		<div class="alignleft">
			<?php
				$footer_one  = str_replace( $footer_vars , $footer_val , tie_get_option( 'footer_one' ));
				echo htmlspecialchars_decode( $footer_one );?>
		</div>
		<div class="clear"></div>
	</div>
	<!-- .Container -->
	
	<!---- start Custom popup  --->
	
	    
	    <!--<div class="modal-wrapper" style="display:none;">-->
	    <div class="modal-wrapper">
        <div class="modal">
          <div class="modal_topbar">
            <div class="top_text"> <p><?php echo $popup_header_text_use;  ?></p>
                </div>
          <div class="btn-close"><i class="fa fa-angle-down close-down" aria-hidden="true"></i></div>
          </div>
          <div class="clear"></div>
          <div class="content">
              <div class="prod_rating_column">
                <div class="prod_img">
                    <img src="<?php echo $popup_image_url_use;  ?>" alt="">
                </div>
                <div class="rating_container">
                    <div class="stars_rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <span class="number_rating"><?php echo $popup_ratings_use;  ?></span>
                </div>
              </div>
              <div class="product_details">
               <h2 class="discount_head"><?php echo $popup_discountBoldtext_use; ?></h2>
               <p class="deal_time"><?php echo $popup_discountText_use; ?></p>
               <a href="<?php echo $popup_discountBtn_url_use;  ?>" class="get_deal_btn">GET DEAL</a>
              </div>
          </div>
        </div>
      </div>
      
      <!-- just add "btn-open" class to any element to trigger popup-->
      <!--<button class="btn-open">show me popup</button>-->
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script>
        jQuery(document).ready(function() {
          var $=jQuery;
            // $('.btn-open').click(function() {
                $('.modal-wrapper').addClass('open')
            // });
          
            $('.btn-close').click(function() {
                $('.modal-wrapper').removeClass('open')
            });
          
        });
        </script>
	    
	    
	
	<!---- end  Custom popup  --->
	
	
	
</div><!-- .Footer bottom -->

</div><!-- .inner-Wrapper -->
</div><!-- #Wrapper -->
</div><!-- .Wrapper-outer -->
<?php if( tie_get_option('footer_top') ): ?>
	<div id="topcontrol" class="fa fa-angle-up" title="<?php _eti( 'Scroll To Top' ); ?>"></div>
<?php endif; ?>
<div id="fb-root"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php wp_footer();?>
<script>
$('.amr-header-mobile-search #s-header').click(function() {
  $('.search-form').animate({right: 0}, 50);
  $('.search-popup').show();
  $('.search-bg').click(function() {
    $('.search-popup').hide();
    $('.search-form').animate({right: '-100%'}, 50);
  });
});

// HUZAIFA JS
$('#huzi-cate-selectbox').on("change", function(){
  $val = $(this).val();
  window.location = $val;
});
</script>
</body>
</html>
