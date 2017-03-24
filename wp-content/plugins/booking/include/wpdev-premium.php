<?php
/*
This is COMMERSIAL SCRIPT
We are do not guarantee correct work and support of Booking Calendar, if some file(s) was modified by someone else then wpdevelop.
If you want to have customization, please contact by email - info@wpdevelop.com
*/
if (!function_exists ('get_option')) { die('You do not have permission to direct access to this file !!!'); } 
if (file_exists(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-hotel.php')) { require_once(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-hotel.php' ); }

if (!class_exists('wpdev_bk_premium')) {
    class wpdev_bk_premium {

        var $wpdev_bk_hotel;

        // Constructor
        function wpdev_bk_premium() {

            add_bk_action('wpdev_booking_settings_show_content', array(&$this, 'settings_menu_content'));

            add_filter('wpdev_booking_form', array(&$this, 'add_paypal_form'));                     // Filter for inserting paypal form
            add_action('wpdev_new_booking', array(&$this, 'show_paypal_form_in_ajax_request'),1,5); // Make showing Paypal in Ajax

            add_action('wpdev_bk_general_settings_end', array(&$this, 'show_advanced_settings'));    // Write General Settings

            add_action('wpdev_bk_js_define_variables', array(&$this, 'js_define_variables') );      // Write JS variables
            add_action('wpdev_bk_js_write_files', array(&$this, 'js_write_files') );                // Write JS files

            add_filter('wpdev_booking_form' , array(&$this, 'wpdev_booking_form'),10,2 );
            add_filter('wpdev_booking_calendar' , array(&$this, 'wpdev_booking_form'),10,2 );
            
            add_filter('wpdev_booking_form_content', array(&$this, 'wpdev_booking_form_content'),10,2 );


            add_filter('wpdev_get_booking_cost', array(&$this, 'get_booking_cost'),10,3 );

            add_bk_action('wpdev_booking_activation', array(&$this, 'pro_activate'));
            add_bk_action('wpdev_booking_deactivation', array(&$this, 'pro_deactivate'));

            add_bk_action('show_payment_status', array(&$this, 'show_payment_status'));
            add_bk_action('show_booking_table_status_header', array(&$this, 'show_booking_table_status_header'));

            add_bk_action('wpdev_booking_post_inserted', array(&$this, 'booking_post_inserted'));
            add_bk_filter('get_booking_cost_from_db', array(&$this, 'get_booking_cost_from_db'));

            if ( class_exists('wpdev_bk_hotel')) {
                    $this->wpdev_bk_hotel = new wpdev_bk_hotel();
            } else { $this->wpdev_bk_hotel = false; }
        }

     //   S U P P O R T     F U N C T I O N S    //////////////////////////////////////////////////////////////////////////////////////////////////

        // Get booking types from DB
        function get_booking_type($booking_id) {
            global $wpdb;
            $types_list = $wpdb->get_results( "SELECT title, cost FROM ".$wpdb->prefix ."bookingtypes  WHERE booking_type_id = " . $booking_id );
            return $types_list;
        }

        // Get booking types from DB
        function get_booking_types() {
            global $wpdb;
            $types_list = $wpdb->get_results( "SELECT booking_type_id as id, title, cost FROM ".$wpdb->prefix ."bookingtypes  ORDER BY title" );
            return $types_list;
        }


        // Check if table exist
        function is_field_in_table_exists( $tablename , $fieldname) {
            global $wpdb;
            if (strpos($tablename, $wpdb->prefix) ===false) $tablename = $wpdb->prefix . $tablename ;
            $sql_check_table = "SHOW COLUMNS FROM " . $tablename ;

            $res = $wpdb->get_results($sql_check_table);

            foreach ($res as $fld) {
                if ($fld->Field == $fieldname) return 1;
            }

            return 0;

        }


        // Function call after booking is inserted or modificated in post request
        function booking_post_inserted($booking_id, $booking_type, $booking_days_count, $times_array){
               global $wpdb;
//debuge($booking_type, $booking_days_count, $times_array);
               $summ        = $this->get_booking_cost( $booking_type, $booking_days_count, $times_array );
//die;
               $summ = floatval(  $summ);
               $summ = round($summ,2);

                $update_sql = "UPDATE ".$wpdb->prefix ."booking AS bk SET bk.cost='$summ' WHERE bk.booking_id=$booking_id;";
                if ( false === $wpdb->query( $update_sql ) ) {
                    ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating cost in BD', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }/**/

        }

        function get_booking_cost_from_db($booking_cost, $booking_id) {
            global $wpdb;
            $slct_sql = "SELECT cost FROM ".$wpdb->prefix ."booking WHERE booking_id IN ($booking_id) LIMIT 0,1";
            $slct_sql_results  = $wpdb->get_results( $slct_sql );
            if ( count($slct_sql_results) > 0 ) { return $slct_sql_results[0]->cost; }
            return '';
        }
     //   C L I E N T     S I D E    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Define JavaScript variables
        function js_define_variables(){
            ?>
                    <script  type="text/javascript">
                        var days_select_count= <?php if (get_option( 'booking_range_selection_days_count') == '') echo '5'; else echo (0+get_option( 'booking_range_selection_days_count')); ?>;
                        var range_start_day= <?php if (get_option( 'booking_range_start_day') == '') echo '-1'; else echo (0+get_option( 'booking_range_start_day')); ?>;
                        var days_select_count_dynamic= <?php if (get_option( 'booking_range_selection_days_count_dynamic') == '') echo '0'; else echo (0+get_option( 'booking_range_selection_days_count_dynamic')); ?>;
                        var range_start_day_dynamic= <?php if (get_option( 'booking_range_start_day_dynamic') == '') echo '-1'; else echo (0+get_option( 'booking_range_start_day_dynamic')); ?>;
                        <?php if ( get_option( 'booking_range_selection_is_active') == 'On' ) { ?>
                            <?php if ( get_option( 'booking_range_selection_type') == 'dynamic' ) { ?>
                                var is_select_range = 0;
                                wpdev_bk_is_dynamic_range_selection = true;
                                multiple_day_selections = 0;  // if we set range selections so then nomultiple selections
                            <?php } else { ?>
                                var is_select_range = 1;
                            <?php }  ?>
                        <?php } else { ?>
                            var is_select_range = 0;
                        <?php }  ?>
                        var message_starttime_error = '<?php _e('Start Time is invalid, probably by requesting time(s) already booked, or already in the past!', 'wpdev-booking'); ?>';
                        var message_endtime_error   =   '<?php _e('End Time is invalid, probably by requesting time(s) already booked, or already in the past, or less then start time if only 1 day selected.!', 'wpdev-booking'); ?>';
                        var message_rangetime_error   =   '<?php _e('Probably by requesting time(s) already booked, or already in the past!', 'wpdev-booking'); ?>';
                        var message_durationtime_error   =   '<?php _e('Probably by requesting time(s) already booked, or already in the past!', 'wpdev-booking'); ?>';
                    </script>
            <?php
        }

        // Write JS files
        function js_write_files(){
            ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/include/js/wpdev.bk.premium.js"></script>  <?php
        }


        function show_booking_table_status_header() { 
            echo '<th>';
            _e('Costs','wpdev-booking');
            echo '</th>';
        }
        // Show Payment status at the booking form
        function show_payment_status($bk_id, $bk, $alternative_color){

            echo '<td '.$alternative_color.' style="text-align:center;">';

            $cost_currency = get_option( 'booking_paypal_curency' );
            if ($cost_currency == 'USD' ) $cost_currency = '$';
            elseif ($cost_currency == 'EUR' ) $cost_currency = '&euro;'; ?>

            <?php if ( ! empty( $bk['cost'] ) ) { ?>
            <span style="font-weight:bold;"> <?php echo $cost_currency . '&nbsp;'. $bk['cost']; ?> </span><br/>
            <?php } ?>

            <?php if ( ! empty( $bk['pay_status'] ) ) { ?>
                <?php if (  ( strpos($bk['pay_status'], 'PayPal') !== false ) || ( strpos($bk['pay_status'], 'Sage') !== false )  ) { ?>
                    <div style="<?php if ( ($bk['pay_status'] == 'PayPal:OK') || ($bk['pay_status'] == 'Sage:OK') || ($bk['pay_status'] == 'OK') || ($bk['pay_status'] == 'success') ) echo 'background: #5f0;'; else echo 'background: #f74;';?>padding:1px 3px; margin:0px auto; -moz-border-radius:4px; -webkit-border-radius:4px;font-size:11px;"><?php  echo $bk['pay_status']; ?></div>
                <?php } else { ?>
                    <!--div style="background: #ef0;padding:1px 3px; margin:0px auto; -moz-border-radius:4px; -webkit-border-radius:4px;font-size:11px;"><?php  echo _e('Pending','wpdev-booking'); ?></div-->
                <?php } ?>
            <?php } ?>



            <?php
            echo '</td>';
        }



        // Add Paypal place for inserting to the Booking FORM
        function add_paypal_form($form_content) {

            $paypal_is_active            =  get_option( 'booking_paypal_is_active' );
            $sage_is_active         =  get_option( 'booking_sage_is_active' );
            if (($sage_is_active == 'Off') && ($paypal_is_active == 'Off')) return $form_content ;
            if (strpos($_SERVER['REQUEST_URI'],'booking.php')!==false) return $form_content ;

            $str_start = strpos($form_content, 'booking_form');
            $str_fin = strpos($form_content, '"', $str_start);

            $my_boook_type = substr($form_content,$str_start, ($str_fin-$str_start) );

            $form_content .= '<div  id="paypal'.$my_boook_type.'"></div>';
            return $form_content;
        }


        function get_booking_cost($booking_type, $booking_days_count, $times_array){

                    $days_array     = explode(',', $booking_days_count);
                    $days_count     = count($days_array);

                    $bk_title               = $this->get_booking_type($booking_type);

                    $paypal_dayprice        = $bk_title[0]->cost;
                    $paypal_dayprice_orig   = $paypal_dayprice;
                    $paypal_price_period    = get_option( 'booking_paypal_price_period' );

                    $paypal_dayprice        = apply_bk_filter('wpdev_season_rates', $paypal_dayprice, $days_array, $booking_type, $times_array);  // Its return array with day costs
                    if (is_array($paypal_dayprice)) { $summ = 0.0; for ($ki = 0; $ki < count($paypal_dayprice); $ki++) { $summ += $paypal_dayprice[$ki]; }
                    } else                            $summ = (1* $paypal_dayprice * $days_count );


                    if( $this->wpdev_bk_hotel == false ){
                                        if ($paypal_price_period == 'day') {
                                            if (is_array($paypal_dayprice)) {
                                                $summ = 0;
                                                for ($ki = 0; $ki < count($paypal_dayprice); $ki++) {
                                                    $summ += $paypal_dayprice[$ki];
                                                }
                                            } else  $summ = (1* $paypal_dayprice * $days_count );
                                        } elseif ($paypal_price_period == 'night') {
                                            if ($days_count>1) $days_count--;
                                            if (is_array($paypal_dayprice)) {
                                                $summ = 0;
                                                if (count($paypal_dayprice)>1) $one_night = 1;
                                                else                           $one_night = 0;
                                                for ($ki = 0; $ki < (count($paypal_dayprice)- $one_night); $ki++) {
                                                    $summ += $paypal_dayprice[$ki];
                                                }
                                            } else  $summ = (1* $paypal_dayprice * $days_count );
                                        } elseif ($paypal_price_period == 'hour') {
                                            //adebug($times_array);
                                            $start_time = $times_array[0];
                                            $end_time   = $times_array[1];
                                            if ($end_time == array('00','00','00')) $end_time = array('24','00','00');
                                            if ($days_count == 1 ) {                                      // Selected only 1 day so need to calculate diference in time
                                                if (is_array($paypal_dayprice))  $paypal_dayprice = $paypal_dayprice[0];
                                                $m_dif =  ($end_time[0] * 60 + intval($end_time[1]) ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                $h_dif = intval($m_dif / 60) ;
                                                $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                $summ = round( ( 1 * $h_dif * $paypal_dayprice ) + ( 1 * $m_dif * $paypal_dayprice ) , 2);
                                            } else {                                                    // Selected several days so need to calculate full days price and then some parts of start end end day

                                                if (is_array($paypal_dayprice)) {
                                                    $full_days_cost = 0;
                                                    for ($ki = 1; $ki < (count($paypal_dayprice)- 1); $ki++)  { $full_days_cost += (24*$paypal_dayprice[$ki]); }
                                                    $end_cost = round( ( $end_time[0] * 1 +  ( intval($end_time[1]) / 60 ) ) * $paypal_dayprice[ (count($paypal_dayprice)-1) ], 2) ;   // End day cost
                                                    $m_dif =  (24 * 60 ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                    $h_dif = intval($m_dif / 60) ;
                                                    $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                    $start_cost =  round( ( 1 * $h_dif * $paypal_dayprice[0] ) + ( 1 * $m_dif * $paypal_dayprice[0] ) , 2);   // Start daycost
                                                    $paypal_dayprice = $start_cost + $full_days_cost + $end_cost;
                                                } else {
                                                    $full_day_count = $days_count - 2;
                                                    $full_days_cost = ($full_day_count * 24 * $paypal_dayprice);                                        // Full day price
                                                    $end_cost = round( ( $end_time[0] * 1 +  ( intval($end_time[1]) / 60 ) ) * $paypal_dayprice, 2) ;   // End day cost
                                                    $m_dif =  (24 * 60 ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                    $h_dif = intval($m_dif / 60) ;
                                                    $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                    $start_cost =  round( ( 1 * $h_dif * $paypal_dayprice ) + ( 1 * $m_dif * $paypal_dayprice ) , 2);   // Start daycost
                                                    $paypal_dayprice = $start_cost + $full_days_cost + $end_cost;
                                                }
                                                $summ =  1* $paypal_dayprice;
                                            }

                                        } else {
                                            $summ =  1* $paypal_dayprice_orig;
                                        }
                    }
                    $summ = round($summ,2);
                    $summ = apply_bk_filter('advanced_cost_apply', $summ , $_POST["form"], $_POST[  "bktype" ], $days_array ); // Apply advanced cost managemnt
                    return $summ;
        }


        // Show Paypal form from Ajax request
        function show_paypal_form_in_ajax_request($booking_id, $booking_type, $booking_days_count, $times_array , $booking_form ){

/*
                    $days_array     = explode(',', $booking_days_count);
                    $days_count     = count($days_array);
                    
                    $bk_title               = $this->get_booking_type($booking_type);

                    $paypal_dayprice        = $bk_title[0]->cost;
                    $paypal_dayprice_orig   = $paypal_dayprice;
                    $paypal_price_period    = get_option( 'booking_paypal_price_period' );

                    $paypal_dayprice        = apply_bk_filter('wpdev_season_rates', $paypal_dayprice, $days_array, $booking_type, $times_array);  // Its return array with day costs
                    if (is_array($paypal_dayprice)) { $summ = 0.0; for ($ki = 0; $ki < count($paypal_dayprice); $ki++) { $summ += $paypal_dayprice[$ki]; }
                    } else                            $summ = (1* $paypal_dayprice * $days_count );


                    if( $this->wpdev_bk_hotel == false ){
                                        if ($paypal_price_period == 'day') {
                                            if (is_array($paypal_dayprice)) {
                                                $summ = 0;
                                                for ($ki = 0; $ki < count($paypal_dayprice); $ki++) {
                                                    $summ += $paypal_dayprice[$ki];
                                                }
                                            } else  $summ = (1* $paypal_dayprice * $days_count );
                                        } elseif ($paypal_price_period == 'night') {
                                            if ($days_count>1) $days_count--;
                                            if (is_array($paypal_dayprice)) {
                                                $summ = 0;
                                                if (count($paypal_dayprice)>1) $one_night = 1;
                                                else                           $one_night = 0;
                                                for ($ki = 0; $ki < (count($paypal_dayprice)- $one_night); $ki++) {
                                                    $summ += $paypal_dayprice[$ki];
                                                }
                                            } else  $summ = (1* $paypal_dayprice * $days_count );
                                        } elseif ($paypal_price_period == 'hour') {
                                            //adebug($times_array);
                                            $start_time = $times_array[0];
                                            $end_time   = $times_array[1];
                                            if ($end_time == array('00','00','00')) $end_time = array('24','00','00');
                                            if ($days_count == 1 ) {                                      // Selected only 1 day so need to calculate diference in time
                                                if (is_array($paypal_dayprice))  $paypal_dayprice = $paypal_dayprice[0];
                                                $m_dif =  ($end_time[0] * 60 + intval($end_time[1]) ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                $h_dif = intval($m_dif / 60) ;
                                                $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                $summ = round( ( 1 * $h_dif * $paypal_dayprice ) + ( 1 * $m_dif * $paypal_dayprice ) , 2);
                                            } else {                                                    // Selected several days so need to calculate full days price and then some parts of start end end day

                                                if (is_array($paypal_dayprice)) {
                                                    $full_days_cost = 0;
                                                    for ($ki = 1; $ki < (count($paypal_dayprice)- 1); $ki++)  { $full_days_cost += (24*$paypal_dayprice[$ki]); }
                                                    $end_cost = round( ( $end_time[0] * 1 +  ( intval($end_time[1]) / 60 ) ) * $paypal_dayprice[ (count($paypal_dayprice)-1) ], 2) ;   // End day cost
                                                    $m_dif =  (24 * 60 ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                    $h_dif = intval($m_dif / 60) ;
                                                    $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                    $start_cost =  round( ( 1 * $h_dif * $paypal_dayprice[0] ) + ( 1 * $m_dif * $paypal_dayprice[0] ) , 2);   // Start daycost
                                                    $paypal_dayprice = $start_cost + $full_days_cost + $end_cost;
                                                }else {
                                                    $full_day_count = $days_count - 2;
                                                    $full_days_cost = ($full_day_count * 24 * $paypal_dayprice);                                        // Full day price
                                                    $end_cost = round( ( $end_time[0] * 1 +  ( intval($end_time[1]) / 60 ) ) * $paypal_dayprice, 2) ;   // End day cost
                                                    $m_dif =  (24 * 60 ) - ($start_time[0] * 60 + intval($start_time[1]) ) ;
                                                    $h_dif = intval($m_dif / 60) ;
                                                    $m_dif = ($m_dif - ($h_dif*60) ) / 60 ;
                                                    $start_cost =  round( ( 1 * $h_dif * $paypal_dayprice ) + ( 1 * $m_dif * $paypal_dayprice ) , 2);   // Start daycost
                                                    $paypal_dayprice = $start_cost + $full_days_cost + $end_cost;
                                                }
                                                $summ =  1* $paypal_dayprice;
                                            }

                                        } else {
                                            $summ =  1* $paypal_dayprice_orig;
                                        }
                    }
                    $summ = round($summ,2);
                    $summ = apply_bk_filter('advanced_cost_apply', $summ , $_POST["form"], $_POST[  "bktype" ] ); // Apply advanced cost managemnt
                    /**/
                    $bk_title    = $this->get_booking_type( $booking_type );
                    $summ        = $this->get_booking_cost( $booking_type, $booking_days_count, $times_array );

                    ///////////////////////////////////////////////////////////////////////////

                    global $wpdb;
                    $wp_nonce = ceil( time() / ( 86400 / 2 ));

                    $update_sql = "UPDATE ".$wpdb->prefix ."booking AS bk SET bk.pay_status='$wp_nonce' WHERE bk.booking_id=$booking_id;";
                    if ( false === $wpdb->query( $update_sql ) ) {
                        ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating wp_nonce status in BD', 'wpdev-booking'); ?></div>'; </script> <?php
                        die();
                    }


                    $output ='';
                    
                    if (get_option( 'booking_paypal_is_active' ) == 'On')
                        $output .= $this->definePaypalFormRequest($booking_id, $summ,$bk_title, $booking_days_count, $booking_type, $_POST["form"], $wp_nonce);

                    if (get_option( 'booking_sage_is_active' ) == 'On')
                        $output .= $this->defineSageFormRequest($booking_id, $summ,$bk_title, $booking_days_count, $booking_type, $_POST["form"], $wp_nonce);

                    $output = str_replace("'",'"',$output);

                    if ( ($summ + 0) == 0)  $output = '';
                    else {
          ?>
                    <script type="text/javascript">
                       document.getElementById('submiting<?php echo $booking_type; ?>').innerHTML ='';
                       document.getElementById('paypalbooking_form<?php echo $booking_type; ?>').innerHTML = '<div class=\"\" style=\"height:200px;margin:20px 0px;\" ><?php echo $output; ?></div>';
                    </script>
          <?php
                    }
        }


        // Generate Paypal Form
        function definePaypalFormRequest( $booking_id,$summ,$bk_title, $booking_days_count, $booking_type, $bkform, $wp_nonce ){

                    $paypal_emeil               =  get_option( 'booking_paypal_emeil' );
                    $paypal_curency             =  get_option( 'booking_paypal_curency' );
                    $paypal_subject             =  get_option( 'booking_paypal_subject' );
                    $paypal_is_reference_box    =  get_option( 'booking_paypal_is_reference_box' );           // checkbox
                    $paypal_reference_title_box =  get_option( 'booking_paypal_reference_title_box' );
                    $paypal_return_url          =  get_option( 'booking_paypal_return_url' );
                    $paypal_cancel_return_url   =  get_option( 'booking_paypal_cancel_return_url' );
                    $paypal_button_type         =  get_option( 'booking_paypal_button_type' );  // radio

                    $paypal_subject = str_replace('[bookingname]',$bk_title[0]->title,$paypal_subject);
                    $paypal_subject = str_replace('[dates]',$booking_days_count,$paypal_subject); //$paypal_subject .= ' Booking type: ' . $bk_title[0]->title . '. For period: ' . $booking_days_count;

                    $output = '<div  class="paypal_div" style="text-align:left;clear:both;"><form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" style="text-align:left;"> <input type=\"hidden\" name=\"cmd\" value=\"_xclick\" /> ';

                    // Get all fields for biling info
                    $form_fields = get_form_content ($bkform, $booking_type);
                    $form_fields = $form_fields['_all_'];

                    if (  get_option( 'booking_billing_customer_email' )  !== false ) {
                      $billing_customer_email  = (string) trim( get_option( 'booking_billing_customer_email' ) . $booking_type );
                      if ( isset($form_fields[$billing_customer_email]) !== false ){
                          $email      = substr($form_fields[$billing_customer_email], 0, 127);
                          $output .= "<input type=\"hidden\" name=\"email\" value=\"$email\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_firstnames' )  !== false ) {
                      $billing_firstnames      = (string) trim( get_option( 'booking_billing_firstnames' ) . $booking_type );
                      if ( isset($form_fields[$billing_firstnames]) !== false ){
                          $first_name = substr($form_fields[$billing_firstnames], 0, 32);
                          $output .= "<input type=\"hidden\" name=\"first_name\" value=\"$first_name\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_surname' )  !== false ) {
                      $billing_surname         = (string) trim( get_option( 'booking_billing_surname' ) . $booking_type );
                      if ( isset($form_fields[$billing_surname]) !== false ){
                          $last_name  = substr($form_fields[$billing_surname], 0, 64);
                          $output .= "<input type=\"hidden\" name=\"last_name\" value=\"$last_name\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_address1' )  !== false ) {
                      $billing_address1        = (string) trim( get_option( 'booking_billing_address1' ) . $booking_type) ;
                      if ( isset($form_fields[$billing_address1]) !== false ){
                          $address1   = substr($form_fields[$billing_address1], 0, 100);
                          $output .= "<input type=\"hidden\" name=\"address1\" value=\"$address1\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_city' )  !== false ) {
                      $billing_city            = (string) trim( get_option( 'booking_billing_city' ) . $booking_type );
                      if ( isset($form_fields[$billing_city]) !== false ){
                          $city       = substr($form_fields[$billing_city], 0, 40);
                          $output .= "<input type=\"hidden\" name=\"city\" value=\"$city\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_country' )  !== false ) {
                      $billing_country         = (string) trim( get_option( 'booking_billing_country' ) . $booking_type );
                      if ( isset($form_fields[$billing_country]) !== false ){
                          $country    = substr($form_fields[$billing_country], 0, 2);
                          $output .= "<input type=\"hidden\" name=\"country\" value=\"$country\" />";
                      }
                    }
                    if ( get_option( 'booking_billing_post_code' )  !== false ) {
                          $billing_post_code       = (string) trim( get_option( 'booking_billing_post_code' ) . $booking_type );
                          if ( isset($form_fields[$billing_post_code]) !== false ){
                              $zip        = substr($form_fields[$billing_post_code], 0, 32);
                              $output .= "<input type=\"hidden\" name=\"zip\" value=\"$zip\" />";
                          }
                    }/**/
                                // P a y P a l      f o r m  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    
                    $output .= "<input type=\"hidden\" name=\"business\" value=\"$paypal_emeil\" />";
                    $output .= "<input type=\"hidden\" name=\"item_name\" value=\"$paypal_subject\" />";
                    $output .= "<input type=\"hidden\" name=\"currency_code\" value=\"$paypal_curency\" />";
                    //$output .= "<span style=\"font-size:10.0pt\"><strong> $paypal_subject</strong></span><br /><br />";
                    $output .= "<strong>".__('Cost', 'wpdev-booking')." : ". $summ ." " . $paypal_curency ."</strong><br/>";
                    $output .= '<input type=\"hidden\" name=\"amount\" size=\"10\" title=\"Cost\" value=\"'. $summ .'\" />';

                    // Show the reference text box
                    if ($paypal_is_reference_box == 'On') {
                        $output .= "<br/><strong> $paypal_reference_title_box :</strong>";
                        $output .= '<input type=\"hidden\" name=\"on0\" value=\"Reference\" />';
                        $output .= '<input type=\"text\" name=\"os0\" maxlength=\"60\" /><br/><br/>';
                    }
                    $output .= '<input type=\"hidden\" name=\"no_shipping\" value=\"2\" /> <input type=\"hidden\" name=\"no_note\" value=\"1\" /> <input type=\"hidden\" name=\"mrb\" value=\"3FWGC6LFTMTUG\" /> <input type=\"hidden\" name=\"bn\" value=\"IC_Sample\" /> ';

                    $paypal_order_Successful  =  WPDEV_BK_PLUGIN_URL .'/'. WPDEV_BK_PLUGIN_FILENAME . '?payed_booking=' . $booking_id .'&wp_nonce=' . $wp_nonce . '&pay_sys=paypal&stats=OK' ;
                    $output .= '<input type=\"hidden\" name=\"return\" value=\"'.$paypal_order_Successful.'\" />';

                    $paypal_order_Failed      =  WPDEV_BK_PLUGIN_URL .'/'. WPDEV_BK_PLUGIN_FILENAME . '?payed_booking=' . $booking_id .'&wp_nonce=' . $wp_nonce . '&pay_sys=paypal&stats=FAILED' ;   //get_option( 'booking_sage_order_Failed' );
                    $output .= '<input type=\"hidden\" name=\"cancel_return\" value=\"'.$paypal_order_Failed.'\" />';

                    /*
                    // Return URL
                    if (!empty($paypal_return_url))  {   $output .= '<input type=\"hidden\" name=\"return\" value=\"'.$paypal_return_url.'\" />'; }
                    else    {                            $output .='<input type=\"hidden\" name=\"return\" value=\"'. get_bloginfo('home') .'\" />'; }
                    // Cancel URL
                    if (!empty($paypal_cancel_return_url))  {   $output .= '<input type=\"hidden\" name=\"cancel_return\" value=\"'.$paypal_cancel_return_url.'\" />'; }
                    else    {                                   $output .='<input type=\"hidden\" name=\"cancel_return\" value=\"'. get_bloginfo('home') .'\" />'; }
                     */
                    $output .= "<input type=\"image\" src=\"$paypal_button_type\" name=\"submit\" style=\"border:none;\" alt=\"".__('Make payments with payPal - its fast, free and secure!', 'wpdev-booking')."\" />";
                    $output .= '</form></div>';
                    // P a y P a l      f o r m  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    return $output;
        }

        // Generate Sage Form
        function defineSageFormRequest( $booking_id,$summ, $bk_title, $booking_days_count, $bktype, $form, $wp_nonce ){
                // Need to set status of bookings
                // Pending, Aproved, Payed

                $form_fields = get_form_content ($form, $bktype);
                $form_fields = $form_fields['_all_'];

                $sage_is_active         =  get_option( 'booking_sage_is_active' );
                if ($sage_is_active != 'On')  return '';

                $sage_subject           =  get_option( 'booking_sage_subject' );
                $sage_subject = str_replace('[bookingname]',$bk_title[0]->title,$sage_subject);
                $sage_subject = str_replace('[dates]',$booking_days_count,$sage_subject); //$paypal_subject .= ' Booking type: ' . $bk_title[0]->title . '. For period: ' . $booking_days_count;
                $subject_payment = $sage_subject;



                $sage_test              =  get_option( 'booking_sage_test' );
                $sage_order_Successful  =  WPDEV_BK_PLUGIN_URL .'/'. WPDEV_BK_PLUGIN_FILENAME . '?payed_booking=' . $booking_id .'&wp_nonce=' . $wp_nonce . '&pay_sys=sage&stats=OK' ;   //get_option( 'booking_sage_order_Successful' );
                $sage_order_Failed      =  WPDEV_BK_PLUGIN_URL .'/'. WPDEV_BK_PLUGIN_FILENAME . '?payed_booking=' . $booking_id .'&wp_nonce=' . $wp_nonce . '&pay_sys=sage&stats=FAILED' ;   //get_option( 'booking_sage_order_Failed' );
                $sage_vendor_name       =  get_option( 'booking_sage_vendor_name' );
                $sage_encryption_password =  get_option( 'booking_sage_encryption_password' );
                $sage_curency           =  get_option( 'booking_sage_curency' );
                $sage_transaction_type  =  get_option( 'booking_sage_transaction_type' );

                if ( empty( $sage_test ) ) return '';
                if ( empty( $sage_order_Successful ) ) return '';
                if ( empty( $sage_order_Failed ) ) return '';
                if ( empty( $sage_vendor_name ) ) return '';
                if ( empty( $sage_encryption_password ) ) return '';
                if ( empty( $sage_curency ) ) return '';
                if ( empty( $sage_transaction_type ) ) return '';

                // Get all fields for biling info
                $sage_billing_customer_email  = (string) trim(get_option( 'booking_billing_customer_email' ) . $bktype );
                $sage_billing_firstnames      = (string) trim( get_option( 'booking_billing_firstnames' ) . $bktype );
                $sage_billing_surname         = (string) trim( get_option( 'booking_billing_surname' ) . $bktype );
                $sage_billing_address1        = (string) trim( get_option( 'booking_billing_address1' ) . $bktype) ;
                $sage_billing_city            = (string) trim( get_option( 'booking_billing_city' ) . $bktype );
                $sage_billing_country         = (string) trim( get_option( 'booking_billing_country' ) . $bktype );
                $sage_billing_post_code       = (string) trim( get_option( 'booking_billing_post_code' ) . $bktype );

                // Check if all fields set, if no so then return empty
                if ( isset($form_fields[$sage_billing_customer_email]) === false ) return '';
                if ( isset($form_fields[$sage_billing_firstnames]) === false ) return '';
                if ( isset($form_fields[$sage_billing_surname]) === false ) return '';
                if ( isset($form_fields[$sage_billing_address1]) === false ) return '';
                if ( isset($form_fields[$sage_billing_city]) === false ) return '';
                if ( isset($form_fields[$sage_billing_country]) === false ) return '';
                if ( isset($form_fields[$sage_billing_post_code]) === false ) return '';


                    $strConnectTo=$sage_test;                                   //Set to SIMULATOR for the Simulator expert system, TEST for the Test Server and LIVE in the live environment
                    $orderSuccessful = $sage_order_Successful;
                    $orderFailed     = $sage_order_Failed ;
                    $strYourSiteFQDN= get_option('siteurl') . "/";              //"http://wp/";  // IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **** This should start http:// or https:// and should be the name by which our servers can call back to yours **** i.e. it MUST be resolvable externally, and have access granted to the Sage Pay servers **** examples would be https://www.mysite.com or http://212.111.32.22/ **** NOTE: You should leave the final / in place.


                    $strVendorName=$sage_vendor_name;                           // Set this value to the Vendor Name assigned to you by Sage Pay or chosen when you applied **/
                    $strEncryptionPassword=$sage_encryption_password;           // Set this value to the XOR Encryption password assigned to you by Sage Pay **/
                    $strCurrency=$sage_curency;                                 // Set this to indicate the currency in which you wish to trade. You will need a merchant number in this currency **/
                    $strTransactionType=$sage_transaction_type;                 // This can be DEFERRED or AUTHENTICATE if your Sage Pay account supports those payment types **/
                    $strPartnerID="";                                           // Optional setting. If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id set it here. **/
                    $bSendEMail=0;                                              // Optional setting. ** 0 = Do not send either customer or vendor e-mails, ** 1 = Send customer and vendor e-mails if address(es) are provided(DEFAULT). ** 2 = Send Vendor Email but not Customer Email. If you do not supply this field, 1 is assumed and e-mails are sent if addresses are provided.
                    $strVendorEMail="";                                         // Optional setting. Set this to the mail address which will receive order confirmations and failures
                    $strProtocol="2.23";

                    if ($strConnectTo=="LIVE")      $strPurchaseURL="https://live.sagepay.com/gateway/service/vspform-register.vsp";
                    elseif ($strConnectTo=="TEST")  $strPurchaseURL="https://test.sagepay.com/gateway/service/vspform-register.vsp";
                    else                            $strPurchaseURL="https://test.sagepay.com/simulator/vspformgateway.asp";


//TODO: get from booking form (or from other form ?

  

$strCustomerEMail      = $form_fields[$sage_billing_customer_email] ;

$strBillingFirstnames  = $form_fields[$sage_billing_firstnames];
$strBillingSurname     = $form_fields[$sage_billing_surname];
$strBillingAddress1    = $form_fields[$sage_billing_address1];
$strBillingAddress2    = "";
$strBillingCity        = $form_fields[$sage_billing_city];
$strBillingPostCode    = $form_fields[$sage_billing_post_code];
$strBillingCountry     = $form_fields[$sage_billing_country];
$strBillingState       = "";
$strBillingPhone       = "";

                        $bIsDeliverySame       = true;//$_SESSION["bIsDeliverySame"];
                        if ($bIsDeliverySame == true) {
                            $strDeliveryFirstnames = $strBillingFirstnames;
                            $strDeliverySurname    = $strBillingSurname;
                            $strDeliveryAddress1   = $strBillingAddress1;
                            $strDeliveryAddress2   = $strBillingAddress2;
                            $strDeliveryCity       = $strBillingCity;
                            $strDeliveryPostCode   = $strBillingPostCode;
                            $strDeliveryCountry    = $strBillingCountry;
                            $strDeliveryState      = $strBillingState;
                            $strDeliveryPhone      = $strBillingPhone;
                        } else {
                            $strDeliveryFirstnames = "";//$_SESSION["strDeliveryFirstnames"];
                            $strDeliverySurname    = "";//$_SESSION["strDeliverySurname"];
                            $strDeliveryAddress1   = "";//$_SESSION["strDeliveryAddress1"];
                            $strDeliveryAddress2   = "";//$_SESSION["strDeliveryAddress2"];
                            $strDeliveryCity       = "";//$_SESSION["strDeliveryCity"];
                            $strDeliveryPostCode   = "";//$_SESSION["strDeliveryPostCode"];
                            $strDeliveryCountry    = "";//$_SESSION["strDeliveryCountry"];
                            $strDeliveryState      = "";//$_SESSION["strDeliveryState"];
                            $strDeliveryPhone      = "";//$_SESSION["strDeliveryPhone"];
                        }
                        $intRandNum = rand(0,32000)*rand(0,32000);                  // Okay, build the crypt field for Form using the information in our session ** First we need to generate a unique VendorTxCode for this transaction **  We're using VendorName, time stamp and a random element.  You can use different methods if you wish *  but the VendorTxCode MUST be unique for each transaction you send to Server
                        $strVendorTxCode=$strVendorName . $intRandNum;
                        /** Now to calculate the transaction total based on basket contents.  For security **
                        *** we recalculate it here rather than relying on totals stored in the session or hidden fields **
                        *** We'll also create the basket contents to pass to Form. See the Form Protocol for **
                        *** the full valid basket format.  The code below converts from our "x of y" style into **
                        *** the system basket format (using a 17.5% VAT calculation for the tax columns) **

                        $sngTotal=0.0;
                        $strThisEntry=$strCart;

                        $strBasket="";
                        $iBasketItems=0;

                        //TODO check this items here
                        $arrProducts[0][0]="Shaolin Soccer";
                        $arrProducts[0][1]="9.95";
                        debuge($arrProducts);
                        //while (strlen($strThisEntry)>0) {
                                // Extract the Quantity and Product from the list of "x of y," entries in the cart
                                $iQuantity=1;//cleanInput(substr($strThisEntry,0,1),"Number");
                                $iProductId=1;//substr($strThisEntry,strpos($strThisEntry,",")-1,1);
                                // Add another item to our Form basket
                                $iBasketItems=$iBasketItems+1;

                                $sngTotal=$sngTotal + $iQuantity * $arrProducts[$iProductId-1][1];
                                $strBasket=$strBasket . ":" . $arrProducts[$iProductId-1][0] . ":" . $iQuantity;
                                $strBasket=$strBasket . ":" . number_format($arrProducts[$iProductId-1][1]/1.175,2);
                                $strBasket=$strBasket . ":" . number_format($arrProducts[$iProductId-1][1]*7/47,2);
                                $strBasket=$strBasket . ":" . number_format($arrProducts[$iProductId-1][1],2);
                                $strBasket=$strBasket . ":" . number_format($arrProducts[$iProductId-1][1]*$iQuantity,2);

                                // Move to the next cart entry, if there is one
                                $pos=strpos($strThisEntry,",");
                                if ($pos==0)                    $strThisEntry="";
                                else                            $strThisEntry=substr($strThisEntry,strpos($strThisEntry,",")+1);
                        //}

                        // We've been right through the cart, so add delivery to the total and the basket
                        $sngTotal=$sngTotal+1.50;
                        $strBasket=$iBasketItems+1 . $strBasket . ":Delivery:1:1.50:---:1.50:1.50";
                        /**/
                        $subject_payment = str_replace(':','.',$subject_payment);
                        $summ = str_replace(',','.',$summ);
                        $strBasket = '1:'.$subject_payment.':::::'.$summ;

                        $strPost="VendorTxCode=" . $strVendorTxCode;                                    // Now to build the Form crypt field.  For more details see the Form Protocol 2.23 As generated above
            
                        if (strlen($strPartnerID) > 0) $strPost=$strPost . "&ReferrerID=" . $strPartnerID;      // Optional: If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id, it should be passed here
                        $strPost=$strPost . "&Amount=" . number_format($summ,2); // Formatted to 2 decimal places with leading digit
                        $strPost=$strPost . "&Currency=" . $strCurrency;
                        $strPost=$strPost . "&Description=" . substr($subject_payment,0,100);                         // Up to 100 chars of free format description
                        $strPost=$strPost . "&SuccessURL=" . /*$strYourSiteFQDN .*/ $orderSuccessful  ;    // The SuccessURL is the page to which Form returns the customer if the transaction is successful. You can change this for each transaction, perhaps passing a session ID or state flag if you wish
                        $strPost=$strPost . "&FailureURL=" . /*$strYourSiteFQDN .*/ $orderFailed      ;    // The FailureURL is the page to which Form returns the customer if the transaction is unsuccessful You can change this for each transaction, perhaps passing a session ID or state flag if you wish
                        $strPost=$strPost . "&CustomerName=" . $strBillingFirstnames . " " . $strBillingSurname;        // This is an Optional setting. Here we are just using the Billing names given.
                        $strPost=$strPost . "&SendEMail=0";
                        /* Email settings:
                        ** Flag 'SendEMail' is an Optional setting.
                        ** 0 = Do not send either customer or vendor e-mails,
                        ** 1 = Send customer and vendor e-mails if address(es) are provided(DEFAULT).
                        ** 2 = Send Vendor Email but not Customer Email. If you do not supply this field, 1 is assumed and e-mails are sent if addresses are provided. **
                        if ($bSendEMail == 0) $strPost=$strPost . "&SendEMail=0";
                        else {

                            if ($bSendEMail == 1) {
                                $strPost=$strPost . "&SendEMail=1";
                            } else {
                                $strPost=$strPost . "&SendEMail=2";
                            }

                            if (strlen($strCustomerEMail) > 0)
                                $strPost=$strPost . "&CustomerEMail=" . $strCustomerEMail;  // This is an Optional setting

                            if (($strVendorEMail <> "[your e-mail address]") && ($strVendorEMail <> ""))
                                    $strPost=$strPost . "&VendorEMail=" . $strVendorEMail;  // This is an Optional setting

                            // You can specify any custom message to send to your customers in their confirmation e-mail here
                            // The field can contain HTML if you wish, and be different for each order.  This field is optional
                            $strPost=$strPost . "&eMailMessage=Thank you so very much for your order.";
                        }
                        */

$strPost=$strPost . "&BillingFirstnames=" . $strBillingFirstnames;              // Billing Details:
$strPost=$strPost . "&BillingSurname=" . $strBillingSurname;
$strPost=$strPost . "&BillingAddress1=" . $strBillingAddress1;
if (strlen($strBillingAddress2) > 0) $strPost=$strPost . "&BillingAddress2=" . $strBillingAddress2;
$strPost=$strPost . "&BillingCity=" . $strBillingCity;
$strPost=$strPost . "&BillingPostCode=" . $strBillingPostCode;
$strPost=$strPost . "&BillingCountry=" . $strBillingCountry;
if (strlen($strBillingState) > 0) $strPost=$strPost . "&BillingState=" . $strBillingState;
if (strlen($strBillingPhone) > 0) $strPost=$strPost . "&BillingPhone=" . $strBillingPhone;


$strPost=$strPost . "&DeliveryFirstnames=" . $strDeliveryFirstnames;            // Delivery Details:
$strPost=$strPost . "&DeliverySurname=" . $strDeliverySurname;
$strPost=$strPost . "&DeliveryAddress1=" . $strDeliveryAddress1;
if (strlen($strDeliveryAddress2) > 0) $strPost=$strPost . "&DeliveryAddress2=" . $strDeliveryAddress2;
$strPost=$strPost . "&DeliveryCity=" . $strDeliveryCity;
$strPost=$strPost . "&DeliveryPostCode=" . $strDeliveryPostCode;
$strPost=$strPost . "&DeliveryCountry=" . $strDeliveryCountry;
if (strlen($strDeliveryState) > 0) $strPost=$strPost . "&DeliveryState=" . $strDeliveryState;
if (strlen($strDeliveryPhone) > 0) $strPost=$strPost . "&DeliveryPhone=" . $strDeliveryPhone;


                        $strPost=$strPost . "&Basket=" . $strBasket; // As created above
                        $strPost=$strPost . "&AllowGiftAid=0";                                          // For charities registered for Gift Aid, set to 1 to display the Gift Aid check box on the payment pages
                        if ($strTransactionType!=="AUTHENTICATE") $strPost=$strPost . "&ApplyAVSCV2=0"; // Allow fine control over AVS/CV2 checks and rules by changing this value. 0 is Default. It can be changed dynamically, per transaction, if you wish.  See the Server Protocol document
                        $strPost=$strPost . "&Apply3DSecure=0";                                         // Allow fine control over 3D-Secure checks and rules by changing this value. 0 is Default. It can be changed dynamically, per transaction, if you wish.  See the Form Protocol document

                        $strCrypt = $this->base64Encode($this->SimpleXor($strPost,$strEncryptionPassword));           // Encrypt the plaintext string for inclusion in the hidden field


                        $output = '<div style="width:100%;clear:both;margin-top:20px;"></div><div class="sage_div" style="text-align:left;clear:both;">';   // This form is all that is required to submit the payment information to the system -->
                        $output .= '<form action=\"'.$strPurchaseURL.'\" method=\"POST\" id=\"SagePayForm\" name=\"SagePayForm\" style=\"text-align:left;\" class=\"booking_SagePayForm\">';
                        $output .= '<input type=\"hidden\" name=\"navigate\" value=\"\" />';
                        $output .= '<input type=\"hidden\" name=\"VPSProtocol\" value=\"'.$strProtocol.'\">';
                        $output .= '<input type=\"hidden\" name=\"TxType\" value=\"'.$strTransactionType.'\">';
                        $output .= '<input type=\"hidden\" name=\"Vendor\" value=\"'.$strVendorName.'\">';
                        $output .= '<input type=\"hidden\" name=\"Crypt\" value=\"'.$strCrypt.'\">';
                        $output .= "<strong>".__('Cost', 'wpdev-booking')." : ". $summ ." " . $sage_curency ."</strong><br/>";
                        $output .= '<input type=\"submit\" name=\"submitsagebutton\" value=\"'.__('Pay now','wpdev-booking').'\" class=\"button\">';
                        $output .= "<br/><span style=\"font-size:11px;\">".sprintf(__('Pay using %s payment service', 'wpdev-booking'), '<a href="http://www.sagepay.com/" target="_blank">Sage Pay</a>').".</span>";
                        //$output .= '<a href=\"javascript:SagePayForm.submit();\" title=\"Proceed to Form registration\"><img src=\"images/proceed.gif\" alt=\"Proceed to Form registration\" border=\"0\"></a>';
                        $output .= '</form></div>';

                        return $output;
        }

                // Base 64 Encoding function ** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function
                function base64Encode($plain) {
                  // Initialise output variable
                  $output = "";

                  // Do encoding
                  $output = base64_encode($plain);

                  // Return the result
                  return $output;
                }

                //  The SimpleXor encryption algorithm **  NOTE: This is a placeholder really.  Future releases of Form will use AES or TwoFish.  Proper encryption **  This simple function and the Base64 will deter script kiddies and prevent the "View Source" type tampering **  It won't stop a half decent hacker though, but the most they could do is change the amount field to something **  else, so provided the vendor checks the reports and compares amounts, there is no harm done.  It's still **  more secure than the other PSPs who don't both encrypting their forms at all
                function simpleXor($InString, $Key) {
                  // Initialise key array
                  $KeyList = array();
                  // Initialise out variable
                  $output = "";

                  // Convert $Key into array of ASCII values
                  for($i = 0; $i < strlen($Key); $i++){
                    $KeyList[$i] = ord(substr($Key, $i, 1));
                  }

                  // Step through string a character at a time
                  for($i = 0; $i < strlen($InString); $i++) {
                    // Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
                    // % is MOD (modulus), ^ is XOR
                    $output.= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
                  }

                  // Return the result
                  return $output;
                }




        // Filter for showing booking form
        function wpdev_booking_form($my_form, $bk_type){

            $my_form .= '<div class="tooltips" id="demotip'.$bk_type.'">&nbsp;'. $bk_type .' </div> ';
            return $my_form;
        }


        function wpdev_booking_form_content ($my_form_content, $bk_type){
            if( get_option( 'booking_range_selection_time_is_active') == 'On' )  {
                if ( strpos($my_form_content, 'name="starttime') !== false )  $my_form_content = str_replace( 'name="starttime', 'name="advanced_stime', $my_form_content);
                if ( strpos($my_form_content, 'name="endtime') !== false )  $my_form_content = str_replace( 'name="endtime', 'name="advanced_etime', $my_form_content);

                $my_form_content .= '<input name="starttime'.$bk_type.'"  id="starttime'.$bk_type.'" type="text" value="'.get_option( 'booking_range_selection_start_time').'" style="display:none;">';
                $my_form_content .= '<input name="endtime'.$bk_type.'"  id="endtime'.$bk_type.'" type="text" value="'.get_option( 'booking_range_selection_end_time').'"  style="display:none;">';
            }
            return $my_form_content;
        }


     //   A D M I N     S I D E    //////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Show settings page depends from selecting TAB
        function settings_menu_content(){
                switch ($_GET['tab']) {

                 case 'paypal':
                    $this->show_settings_content();
                    return false;
                    break;

                 default:
                    return true;
                    break;
                }

        }


        // Show Settings page booking cost window
        function show_booking_types_cost(){
            if ( isset( $_POST['submit_costs'] ) ) {
                $bk_types = $this->get_booking_types();
                global $wpdb;
                foreach ($bk_types as $bt) {
                    if ( false === $wpdb->query( "UPDATE ".$wpdb->prefix ."bookingtypes SET cost = '".$_POST['type_price'.$bt->id]."' WHERE booking_type_id = " .  $bt->id) ) {
                           echo __('Error during updating to DB booking costs', 'wpdev-booking');  
                    }
                }
                update_option( 'booking_paypal_price_period' , $_POST['paypal_price_period'] );

            } ?>

                      <div class='meta-box'>  <div  class="postbox" > <h3 class='hndle'><span><?php _e('Cost of each booking resource', 'wpdev-booking'); ?></span></h3> <div class="inside">

                            <form  name="post_option_cost" action="" method="post" id="post_option_cost" >

                                <?php
                                    $bk_types = $this->get_booking_types();
                                    foreach ($bk_types as $bt) { ?>
                                        <div style="float:left; border:0px solid grey; margin:0px; padding:10px">
                                            <strong><?php echo $bt->title; ?> </strong>:
                                            <input  style="width:70px;" maxlength="7" type="text" value="<?php echo $bt->cost; ?>" name="type_price<?php echo $bt->id; ?>" id="type_price<?php echo $bt->id; ?>">
                                        </div>
                                    <?php
                                    }
                                ?>
                                <div class="clear" style="height:10px;"></div>
                                 <span class="description"><?php 
                                    _e('Please, enter cost', 'wpdev-booking');
                                    ?>
                                     <select id="paypal_price_period" name="paypal_price_period">
                                         <option <?php if( get_option( 'booking_paypal_price_period' ) == 'day') echo "selected"; ?> value="day"><?php _e('for 1 day', 'wpdev-booking'); ?></option>
                                         <option <?php if( get_option( 'booking_paypal_price_period' ) == 'night') echo "selected"; ?> value="night"><?php _e('for 1 night', 'wpdev-booking'); ?></option>
                                         <option <?php if( get_option( 'booking_paypal_price_period' ) == 'fixed') echo "selected"; ?> value="fixed"><?php _e('fixed deposit', 'wpdev-booking'); ?></option>
                                         <?php //if ( class_exists('wpdev_bk_time')) { ?>
                                         <option <?php if( get_option( 'booking_paypal_price_period' ) == 'hour') echo "selected"; ?> value="hour"><?php _e('for 1 hour', 'wpdev-booking'); ?></option>
                                         <?php //} ?>
                                     </select>
                                    <?php 
                                    _e('of each booking resource. Enter only digits.', 'wpdev-booking');
                                 ?></span>
                                 <div class="clear" style="height:10px;"></div>
                                <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save costs', 'wpdev-booking'); ?>" name="submit_costs"/>
                                <div class="clear" style="height:10px;"></div>

                            </form>

                       </div> </div> </div>

            <?php
        }


        //Show Settings page
        function show_settings_content() {


            ?>

                        <div class="clear" style="height:20px;"></div>
                        <div id="ajax_working"></div>
                        <div id="poststuff" class="metabox-holder">

                        <?php $this->show_booking_types_cost();    ?>
                        <?php $this->show_paypal_settings();       ?>
                        <?php $this->show_sage_settings();         ?>
                        <?php $this->show_billing_settings();      ?>
                        <?php make_bk_action('advanced_cost_management_settings');    ?>
                            
                        </div>

        <?php
        }


        // Get fields from booking form at the settings page or return false if no fields
        function get_fields_from_booking_form(){
            $booking_form  = get_option( 'booking_form' );
            $types = 'text[*]?|email[*]?|time[*]?|textarea[*]?|select[*]?|checkbox[*]?|radio|acceptance|captchac|captchar|file[*]?|quiz';
            $regex = '%\[\s*(' . $types . ')(\s+[a-zA-Z][0-9a-zA-Z:._-]*)([-0-9a-zA-Z:#_/|\s]*)?((?:\s*(?:"[^"]*"|\'[^\']*\'))*)?\s*\]%';
            $regex2 = '%\[\s*(country[*]?|starttime[*]?|endtime[*]?)(\s*[a-zA-Z]*[0-9a-zA-Z:._-]*)([-0-9a-zA-Z:#_/|\s]*)*((?:\s*(?:"[^"]*"|\'[^\']*\'))*)?\s*\]%';
            $fields_count = preg_match_all($regex, $booking_form, $fields_matches) ;
            $fields_count2 = preg_match_all($regex2, $booking_form, $fields_matches2) ;

            //Gathering togather 2 arrays $fields_matches  and $fields_matches2
            foreach ($fields_matches2 as $key => $value) {
                if ($key == 2) $value = $fields_matches2[1];
                foreach ($value as $v) {
                    $fields_matches[$key][count($fields_matches[$key])]  = $v;
                }
            }
            $fields_count += $fields_count2;

            if ($fields_count>0) return array($fields_count, $fields_matches);
            else return false;
        }


        // Settings page for   S a g e
        function show_sage_settings(){
                if ( isset( $_POST['sagesubmit'] ) ) {
                      if (isset( $_POST['sage_is_active'] ))     $sage_is_active = 'On';
                      else                                       $sage_is_active = 'Off';
                      update_option( 'booking_sage_is_active', $sage_is_active );
                      update_option( 'booking_sage_subject', $_POST['sage_subject'] );
                      update_option( 'booking_sage_test', $_POST['sage_test'] );
                      update_option( 'booking_sage_order_Successful', $_POST['sage_order_Successful'] );
                      update_option( 'booking_sage_order_Failed', $_POST['sage_order_Failed'] );
                      update_option( 'booking_sage_vendor_name', $_POST['sage_vendor_name'] );
                      update_option( 'booking_sage_encryption_password', $_POST['sage_encryption_password'] );
                      update_option( 'booking_sage_curency', $_POST['sage_curency'] );
                      update_option( 'booking_sage_transaction_type', $_POST['sage_transaction_type'] );
                }

                $sage_is_active         =  get_option( 'booking_sage_is_active' );
                $sage_subject           =  get_option( 'booking_sage_subject' );
                $sage_test              =  get_option( 'booking_sage_test' );
                $sage_order_Successful  =  get_option( 'booking_sage_order_Successful' );
                $sage_order_Failed      =  get_option( 'booking_sage_order_Failed' );
                $sage_vendor_name       =  get_option( 'booking_sage_vendor_name' );
                $sage_encryption_password =  get_option( 'booking_sage_encryption_password' );
                $sage_curency           =  get_option( 'booking_sage_curency' );
                $sage_transaction_type  =  get_option( 'booking_sage_transaction_type' );


                ?>
                        <div class='meta-box'>  <div  class="postbox" > <h3 class='hndle'><span><?php _e('Sage payment customization', 'wpdev-booking'); ?></span></h3> <div class="inside">
                            <form  name="post_option_sage" action="" method="post" id="post_option_sage" >
                                <center><?php printf(__('If you have no account of this payment system, please visit %s for creation of Simulator Account. Simulator emulates the Sage Pay Test and Live systems.','wpdev-booking'), '<a href="https://support.sagepay.com/apply/RequestSimAccount.aspx"  target="_blank">sagepay.com</a>');?></center>
                                <table class="form-table settings-table">
                                    <tbody>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="sage_is_active" ><?php _e('Sage payment active', 'wpdev-booking'); ?>:</label>
                                            </th>
                                            <td>
                                                <input <?php if ($sage_is_active == 'On') echo "checked"; ?>  value="<?php echo $sage_is_active; ?>" name="sage_is_active" id="sage_is_active" type="checkbox" />
                                                <span class="description"><?php _e(' Tick this checkbox for using Sage payment.', 'wpdev-booking');?></span>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row" >
                                            <label for="sage_subject" ><?php _e('Payment description', 'wpdev-booking'); ?>:</label><br/><br/>
                                            <span class="description"><?php printf(__('Enter the service name or the reason for the payment here.', 'wpdev-booking'),'<br/>','</b>');?></span>
                                          </th>
                                          <td>

                                                <div style="float:left;margin:10px 0px;width:100%;">
                                                <input id="sage_subject" name="sage_subject" class="darker-border"  type="text" maxlength="150" size="59" value="<?php echo $sage_subject; ?>" />

                                                </div>
                                                <div style="float:left;margin:10px 0px;width:375px;" class="code_description">
                                                    <div style="border:1px solid #cccccc;margin-bottom:10px;padding:3px 0px;">
                                                      <span class="description">&nbsp;<?php printf(__(' Use these shortcodes for customization: ', 'wpdev-booking'));?></span><br/><br/>
                                                      <span class="description"><?php printf(__('%s[bookingname]%s - inserting name of booking resource, ', 'wpdev-booking'),'<code>','</code>');?></span><br/>
                                                      <span class="description"><?php printf(__('%s[dates]%s - inserting list of reserved dates ', 'wpdev-booking'),'<code>','</code>');?></span><br/>
                                                    </div>
                                                </div>
                                              <div class="clear"></div>


                                          </td>
                                        </tr>



                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_test" ><?php _e('Choose live or test environment', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_test" name="sage_test">
                                                <option <?php if($sage_test == 'SIMULATOR') echo "selected"; ?> value="SIMULATOR"><?php _e('SIMULATOR', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_test == 'TEST') echo "selected"; ?> value="TEST"><?php _e('TEST', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_test == 'LIVE') echo "selected"; ?> value="LIVE"><?php _e('LIVE', 'wpdev-booking'); ?></option>
                                             </select>
                                             <span class="description"><?php printf(__('Select SIMULATOR for the Simulator expert system, TEST for the Test Server and LIVE in the live environment', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_order_Successful" ><?php _e('Return URL after Successful order', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $sage_order_Successful; ?>" name="sage_order_Successful" id="sage_order_Successful" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('Enter a return relative Successful URL. Sage will redirect visitors to this page after Successful Payment', 'wpdev-booking'),'<b>','</b>');?><br/>
                                               <?php printf(__('Please test this URL. Its have to be valid', 'wpdev-booking'),'<b>','</b>');?> <a href="<?php echo  $sage_order_Successful; ?>" target="_blank"><?php echo  $sage_order_Successful; ?></a></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_order_Failed" ><?php _e('Return URL after Failed order', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $sage_order_Failed; ?>" name="sage_order_Failed" id="sage_order_Failed" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('Enter a return relative Failed URL. Sage will redirect visitors to this page after Failed Payment', 'wpdev-booking'),'<b>','</b>');?><br/>
                                               <?php printf(__('Please test this URL. Its have to be valid', 'wpdev-booking'),'<b>','</b>');?> <a href="<?php echo   $sage_order_Failed; ?>" target="_blank"><?php  echo $sage_order_Failed; ?></a></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_vendor_name" ><?php _e('Vendor Name', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $sage_vendor_name; ?>" name="sage_vendor_name" id="sage_vendor_name" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('Set this value to the Vendor Name assigned to you by Sage Pay or chosen when you applied.', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_encryption_password" ><?php _e('XOR Encryption password', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $sage_encryption_password; ?>" name="sage_encryption_password" id="sage_encryption_password" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('Set this value to the XOR Encryption password assigned to you by Sage Pay', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_curency" ><?php _e('Choose Payment Currency', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_curency" name="sage_curency">
                                                <option <?php if($sage_curency == 'USD') echo "selected"; ?> value="USD"><?php _e('U.S. Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'EUR') echo "selected"; ?> value="EUR"><?php _e('Euros', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'GBP') echo "selected"; ?> value="GBP"><?php _e('Pounds Sterling', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'JPY') echo "selected"; ?> value="JPY"><?php _e('Yen', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'AUD') echo "selected"; ?> value="AUD"><?php _e('Australian Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'CAD') echo "selected"; ?> value="CAD"><?php _e('Canadian Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'NZD') echo "selected"; ?> value="NZD"><?php _e('New Zealand Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'CHF') echo "selected"; ?> value="CHF"><?php _e('Swiss Franc', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'HKD') echo "selected"; ?> value="HKD"><?php _e('Hong Kong Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'SGD') echo "selected"; ?> value="SGD"><?php _e('Singapore Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'SEK') echo "selected"; ?> value="SEK"><?php _e('Swedish Krona', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'DKK') echo "selected"; ?> value="DKK"><?php _e('Danish Krone', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'PLN') echo "selected"; ?> value="PLN"><?php _e('Polish Zloty', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'NOK') echo "selected"; ?> value="NOK"><?php _e('Norwegian Krone', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'HUF') echo "selected"; ?> value="HUF"><?php _e('Hungarian Forint', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'CZK') echo "selected"; ?> value="CZK"><?php _e('Czech Koruna', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'ILS') echo "selected"; ?> value="ILS"><?php _e('Israeli Shekel', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'MXN') echo "selected"; ?> value="MXN"><?php _e('Mexican Peso', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'BRL') echo "selected"; ?> value="BRL"><?php _e('Brazilian Real (only for Brazilian users)', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'MYR') echo "selected"; ?> value="MYR"><?php _e('Malaysian Ringgits (only for Malaysian users)', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'PHP') echo "selected"; ?> value="PHP"><?php _e('Philippine Pesos', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'TWD') echo "selected"; ?> value="TWD"><?php _e('Taiwan New Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_curency == 'THB') echo "selected"; ?> value="THB"><?php _e('Thai Baht', 'wpdev-booking'); ?></option>
                                             </select>
                                             <span class="description"><?php printf(__('This is the currency for your visitors to make Payments', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_transaction_type" ><?php _e('Transaction type', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_transaction_type" name="sage_transaction_type">
                                                <option <?php if($sage_transaction_type == 'PAYMENT') echo "selected"; ?> value="PAYMENT"><?php _e('PAYMENT', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_transaction_type == 'DEFERRED') echo "selected"; ?> value="DEFERRED"><?php _e('DEFERRED', 'wpdev-booking'); ?></option>
                                                <option <?php if($sage_transaction_type == 'AUTHENTICATE') echo "selected"; ?> value="AUTHENTICATE"><?php _e('AUTHENTICATE', 'wpdev-booking'); ?></option>
                                             </select>
                                             <span class="description"><?php printf(__('This can be DEFERRED or AUTHENTICATE if your Sage Pay account supports those payment types', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row" colspan="2">
                                              <span style="font-size:11px;color:#f00;" class="description"><?php printf(__('Please, %sconfigure billing fields at the billing form fields customization%s, Sage payment system is required it!', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </th>
                                        </tr>
<?php
$strCustomerEMail      = "info@wpdevelop.com";

$strBillingFirstnames  = "Dima";
$strBillingSurname     = "Sereda";
$strBillingAddress1    = "Street";
$strBillingAddress2    = "";
$strBillingCity        = "Kiev";
$strBillingPostCode    = "04119";
$strBillingCountry     = "UA";
$strBillingState       = "";
$strBillingPhone       = "";

$strConnectTo="SIMULATOR";                                  //Set to SIMULATOR for the Simulator expert system, TEST for the Test Server and LIVE in the live environment
$orderSuccessful = 'good.php';
$orderFailed = 'bad.php';
$strYourSiteFQDN= get_option('siteurl') . "/";              //"http://wp/";  // IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **** This should start http:// or https:// and should be the name by which our servers can call back to yours **** i.e. it MUST be resolvable externally, and have access granted to the Sage Pay servers **** examples would be https://www.mysite.com or http://212.111.32.22/ **** NOTE: You should leave the final / in place.
//TODO: Define from settings page
$strVendorName="wpdevelop";                                 // Set this value to the Vendor Name assigned to you by Sage Pay or chosen when you applied **/
$strEncryptionPassword="FfCDQjLiM524VtE7";                  // Set this value to the XOR Encryption password assigned to you by Sage Pay **/
$strCurrency="USD";                                         // Set this to indicate the currency in which you wish to trade. You will need a merchant number in this currency **/
$strTransactionType="PAYMENT";                              // This can be DEFERRED or AUTHENTICATE if your Sage Pay account supports those payment types **/
$strPartnerID="";                                           // Optional setting. If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id set it here. **/
$bSendEMail=0;                                              // Optional setting. ** 0 = Do not send either customer or vendor e-mails, ** 1 = Send customer and vendor e-mails if address(es) are provided(DEFAULT). ** 2 = Send Vendor Email but not Customer Email. If you do not supply this field, 1 is assumed and e-mails are sent if addresses are provided.
$strVendorEMail="";                                         // Optional setting. Set this to the mail address which will receive order confirmations and failures
$strProtocol="2.23";

?>
                                        
                                    </tbody>
                                </table>

                                <div class="clear" style="height:10px;"></div>
                                <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="sagesubmit"/>
                                <div class="clear" style="height:10px;"></div>

                            </form>
                       </div> </div> </div>
                  <?php
        }


        // Settings page for    P a y P a l
        function show_paypal_settings(){
                        if ( isset( $_POST['paypal_emeil'] ) ) {
                     if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) $_POST['paypal_emeil'] = 'booking@wpdevelop.com';
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_emeil =  ($_POST['paypal_emeil']);
                     if ( get_option( 'booking_paypal_emeil' ) !== false  )   update_option( 'booking_paypal_emeil' , $paypal_emeil );
                     else                                                     add_option('booking_paypal_emeil' , $paypal_emeil );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_curency =  ($_POST['paypal_curency']);
                     if ( get_option( 'booking_paypal_curency' ) !== false  )   update_option( 'booking_paypal_curency' , $paypal_curency );
                     else                                                     add_option('booking_paypal_curency' , $paypal_curency );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_subject =  ($_POST['paypal_subject']);
                     if ( get_option( 'booking_paypal_subject' ) !== false  )   update_option( 'booking_paypal_subject' , $paypal_subject );
                     else                                                     add_option('booking_paypal_subject' , $paypal_subject );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     if (isset( $_POST['paypal_is_active'] ))     $paypal_is_active = 'On';
                     else                                         $paypal_is_active = 'Off';
                     if ( get_option( 'booking_paypal_is_active' ) !== false  )   update_option( 'booking_paypal_is_active' , $paypal_is_active );
                     else                                                     add_option('booking_paypal_is_active' , $paypal_is_active );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     if (isset( $_POST['paypal_is_reference_box'] ))     $paypal_is_reference_box = 'On';
                     else                                                $paypal_is_reference_box = 'Off';
                     if ( get_option( 'booking_paypal_is_reference_box' ) !== false  )   update_option( 'booking_paypal_is_reference_box' , $paypal_is_reference_box );
                     else                                                     add_option('booking_paypal_is_reference_box' , $paypal_is_reference_box );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_reference_title_box =  ($_POST['paypal_reference_title_box']);
                     if ( get_option( 'booking_paypal_reference_title_box' ) !== false  )   update_option( 'booking_paypal_reference_title_box' , $paypal_reference_title_box );
                     else                                                     add_option('booking_paypal_reference_title_box' , $paypal_reference_title_box );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_return_url =  ($_POST['paypal_return_url']);
                     if ( get_option( 'booking_paypal_return_url' ) !== false  )   update_option( 'booking_paypal_return_url' , $paypal_return_url );
                     else                                                     add_option('booking_paypal_return_url' , $paypal_return_url );
                     update_option( 'booking_paypal_cancel_return_url' , $_POST['paypal_cancel_return_url'] );
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     $paypal_button_type =  ($_POST['paypal_button_type']);
                     if ( get_option( 'booking_paypal_button_type' ) !== false  )   update_option( 'booking_paypal_button_type' , $paypal_button_type );
                     else                                                     add_option('booking_paypal_button_type' , $paypal_button_type );


            }
            $paypal_emeil               =  get_option( 'booking_paypal_emeil' );
            $paypal_curency             =  get_option( 'booking_paypal_curency' );
            $paypal_subject             =  get_option( 'booking_paypal_subject' );
            $paypal_is_active           =  get_option( 'booking_paypal_is_active' );
            $paypal_is_reference_box    =  get_option( 'booking_paypal_is_reference_box' );           // checkbox
            $paypal_reference_title_box =  get_option( 'booking_paypal_reference_title_box' );
            $paypal_return_url          =  get_option( 'booking_paypal_return_url' );
            $paypal_cancel_return_url   =  get_option( 'booking_paypal_cancel_return_url' );
            $paypal_button_type         =  get_option( 'booking_paypal_button_type' );  // radio
            ?>

                        <div class='meta-box'>  <div  class="postbox" > <h3 class='hndle'><span><?php _e('PayPal customization', 'wpdev-booking'); ?></span></h3> <div class="inside">

                            <form  name="post_option" action="" method="post" id="post_option" >

                                <table class="form-table settings-table">
                                    <tbody>

                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="paypal_is_active" ><?php _e('PayPal active', 'wpdev-booking'); ?>:</label>
                                            </th>
                                            <td>
                                                <input <?php if ($paypal_is_active == 'On') echo "checked";/**/ ?>  value="<?php echo $paypal_is_active; ?>" name="paypal_is_active" id="paypal_is_active" type="checkbox" />
                                                <span class="description"><?php _e(' Tick this checkbox for using PayPal payment.', 'wpdev-booking');?></span>
                                            </td>
                                        </tr>


                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_emeil" ><?php _e('Paypal Email address to receive payments', 'wpdev-booking'); ?>:</label>
                                            <br/><?php //printf(__('%syour emeil%s adress'),'<span style="color:#888;font-weight:bold;">','</span>'); ?>
                                          </th>
                                          <td>
                                              <input value="<?php echo $paypal_emeil; ?>" name="paypal_emeil" id="paypal_emeil" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('This is the Paypal Email address where the payments will go', 'wpdev-booking'),'<b>','</b>');?></span>
                                              <?php  if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) { ?> <span class="description">You do not allow to change emeil because right now you test DEMO</span> <?php } ?>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_curency" ><?php _e('Choose Payment Currency', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="paypal_curency" name="paypal_curency">
                                                <option <?php if($paypal_curency == 'USD') echo "selected"; ?> value="USD"><?php _e('U.S. Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'EUR') echo "selected"; ?> value="EUR"><?php _e('Euros', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'GBP') echo "selected"; ?> value="GBP"><?php _e('Pounds Sterling', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'JPY') echo "selected"; ?> value="JPY"><?php _e('Yen', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'AUD') echo "selected"; ?> value="AUD"><?php _e('Australian Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'CAD') echo "selected"; ?> value="CAD"><?php _e('Canadian Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'NZD') echo "selected"; ?> value="NZD"><?php _e('New Zealand Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'CHF') echo "selected"; ?> value="CHF"><?php _e('Swiss Franc', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'HKD') echo "selected"; ?> value="HKD"><?php _e('Hong Kong Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'SGD') echo "selected"; ?> value="SGD"><?php _e('Singapore Dollar', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'SEK') echo "selected"; ?> value="SEK"><?php _e('Swedish Krona', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'DKK') echo "selected"; ?> value="DKK"><?php _e('Danish Krone', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'PLN') echo "selected"; ?> value="PLN"><?php _e('Polish Zloty', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'NOK') echo "selected"; ?> value="NOK"><?php _e('Norwegian Krone', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'HUF') echo "selected"; ?> value="HUF"><?php _e('Hungarian Forint', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'CZK') echo "selected"; ?> value="CZK"><?php _e('Czech Koruna', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'ILS') echo "selected"; ?> value="ILS"><?php _e('Israeli Shekel', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'MXN') echo "selected"; ?> value="MXN"><?php _e('Mexican Peso', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'BRL') echo "selected"; ?> value="BRL"><?php _e('Brazilian Real (only for Brazilian users)', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'MYR') echo "selected"; ?> value="MYR"><?php _e('Malaysian Ringgits (only for Malaysian users)', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'PHP') echo "selected"; ?> value="PHP"><?php _e('Philippine Pesos', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'TWD') echo "selected"; ?> value="TWD"><?php _e('Taiwan New Dollars', 'wpdev-booking'); ?></option>
                                                <option <?php if($paypal_curency == 'THB') echo "selected"; ?> value="THB"><?php _e('Thai Baht', 'wpdev-booking'); ?></option>
                                             </select>
                                             <span class="description"><?php printf(__('This is the currency for your visitors to make Payments', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                      

                                        <tr valign="top">
                                          <th scope="row" >
                                            <label for="paypal_subject" ><?php _e('Payment description', 'wpdev-booking'); ?>:</label><br/><br/>
                                            <span class="description"><?php printf(__('Enter the service name or the reason for the payment here.', 'wpdev-booking'),'<br/>','</b>');?></span>
                                          </th>
                                          <td>


                                    <div style="float:left;margin:10px 0px;width:100%;">
                                    <input id="paypal_subject" name="paypal_subject" class="darker-border"  type="text" maxlength="50" size="59" value="<?php echo $paypal_subject; ?>" />
                                    
                                    </div>
                                    <div style="float:left;margin:10px 0px;width:375px;" class="code_description">
                                        <div style="border:1px solid #cccccc;margin-bottom:10px;padding:3px 0px;">
                                          <span class="description">&nbsp;<?php printf(__(' Use these shortcodes for customization: ', 'wpdev-booking'));?></span><br/><br/>
                                          <span class="description"><?php printf(__('%s[bookingname]%s - inserting name of booking resource, ', 'wpdev-booking'),'<code>','</code>');?></span><br/>
                                          <span class="description"><?php printf(__('%s[dates]%s - inserting list of reserved dates ', 'wpdev-booking'),'<code>','</code>');?></span><br/>
                                        </div>
                                    </div>
                                              <div class="clear"></div>

                                              
                                          </td>
                                        </tr>



                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="paypal_is_reference_box" ><?php _e('Show Reference Text Box', 'wpdev-booking'); ?>:</label>
                                            </th>
                                            <td>
                                                <input <?php if ($paypal_is_reference_box == 'On') echo "checked";/**/ ?>  value="<?php echo $paypal_is_reference_box; ?>" name="paypal_is_reference_box" id="paypal_is_reference_box" type="checkbox"
                                                                                                                           onMouseDown="javascript: document.getElementById('paypal_reference_title_box').disabled=this.checked; "/>
                                                <span class="description"><?php _e(' Tick this checkbox if you want your visitors be able to enter a reference like email or web address.', 'wpdev-booking');?></span>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_reference_title_box" ><?php _e('Reference Text Box Title', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input <?php if ($paypal_is_reference_box !== 'On') echo " disabled "; ?>  value="<?php echo $paypal_reference_title_box; ?>" name="paypal_reference_title_box" id="paypal_reference_title_box" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('Enter a title for the Reference text box (i.e. Your emeil). The visitors will see this text', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_return_url" ><?php _e('Return URL from PayPal', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $paypal_return_url; ?>" name="paypal_return_url" id="paypal_return_url" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('The URL to which the payer’s browser is redirected after completing the payment; for example, a URL on your site that displays a {Thank you for your payment page}.', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_cancel_return_url" ><?php _e('Cancel Return URL from PayPal', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                              <input value="<?php echo $paypal_cancel_return_url; ?>" name="paypal_cancel_return_url" id="paypal_cancel_return_url" class="regular-text code" type="text" size="45" />
                                              <span class="description"><?php printf(__('A URL to which the payer’s browser is redirected if payment is cancelled, for example, a URL on your website that displays a {Payment Canceled} page.', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>


                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="paypal_button_type" ><?php _e('Button types', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                                <div style="width:150px;margin:auto;float:left;margin:5px;text-align:center;">
                                                        <img src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" /><br/>
                                                        <input <?php if ($paypal_button_type == 'https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif') echo ' checked="checked" '; ?> type="radio" name="paypal_button_type" value="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" style="margin:10px;" />
                                                </div>
                                                <div style="width:150px;margin:auto;float:left;margin:5px;text-align:center;">
                                                        <img src="https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif" /><br/>
                                                        <input <?php if ($paypal_button_type == 'https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif') echo ' checked="checked" '; ?>  type="radio" name="paypal_button_type" value="https://www.paypal.com/en_US/i/btn/btn_paynow_LG.gif" style="margin:10px;" />
                                                </div>
                                                <div style="width:150px;margin:auto;float:left;margin:5px;text-align:center;">
                                                        <img src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" /><br/>
                                                        <input <?php if ($paypal_button_type == 'https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif') echo ' checked="checked" '; ?>  type="radio" name="paypal_button_type" value="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" style="margin:10px;" />
                                                </div>
                                               <span class="description"><?php printf(__('Select type of submittal button', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </td>
                                        </tr>

                                    </tbody>
                                </table>


                                <div class="clear" style="height:10px;"></div>
                                <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="Submit"/>
                                <div class="clear" style="height:10px;"></div>

                            </form>

                       </div> </div> </div>
                        
            <?php
        }


        // Show settings for autofill options at the Payment form.
        function show_billing_settings(){

                if ( isset( $_POST['billing_form_submit'] ) ) {
                      update_option( 'booking_billing_customer_email', $_POST['sage_billing_customer_email'] );
                      update_option( 'booking_billing_firstnames', $_POST['sage_billing_firstnames'] );
                      update_option( 'booking_billing_surname', $_POST['sage_billing_surname'] );
                      update_option( 'booking_billing_address1', $_POST['sage_billing_address1'] );
                      update_option( 'booking_billing_city', $_POST['sage_billing_city'] );
                      update_option( 'booking_billing_country', $_POST['sage_billing_country'] );
                      update_option( 'booking_billing_post_code', $_POST['sage_billing_post_code'] );
                }

                $sage_billing_customer_email =  get_option( 'booking_billing_customer_email' );
                $sage_billing_firstnames =  get_option( 'booking_billing_firstnames' );
                $sage_billing_surname    =  get_option( 'booking_billing_surname' );
                $sage_billing_address1  =  get_option( 'booking_billing_address1' );
                $sage_billing_city      =  get_option( 'booking_billing_city' );
                $sage_billing_country   =  get_option( 'booking_billing_country' );
                $sage_billing_post_code =  get_option( 'booking_billing_post_code' );


            ?>
                <div class='meta-box'>  <div  class="postbox" > <h3 class='hndle'><span><?php _e('Billing form fields customization', 'wpdev-booking'); ?></span></h3> <div class="inside">
                            <form  name="post_option_billing_form" action="" method="post" id="post_option_billing_form" >
                                <table class="form-table settings-table">
                                    <tbody>

                                        <?php $all_form_fields = $this->get_fields_from_booking_form();
                                        //debuge($all_form_fields[1][2]);
                                        $fields_orig_names = $all_form_fields[1][2];
                                        ?>

                                        <tr valign="top">
                                          <th scope="row" colspan="2">
                                            <h2 style="padding:0px;margin:0px;" ><?php printf(__('Please set requred billing fields, which will %sassign automatically to billing form%s from booking form', 'wpdev-booking'),'<b>','</b>' ); ?>:</h2>
                                          </th>
                                        </tr>
                                        <tr valign="top">
                                          <th scope="row" colspan="2">
                                            <span class="description"><?php printf(__('Please, select form field from your booking form. This field will automatically assign to current field from biilling form.', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </th>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_customer_email" ><?php _e('Customer EMail', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_customer_email" name="sage_billing_customer_email">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_customer_email == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_firstnames" ><?php _e('First Name(s)', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_firstnames" name="sage_billing_firstnames">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_firstnames == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_surname" ><?php _e('Surname', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_surname" name="sage_billing_surname">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_surname == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_address1" ><?php _e('Billing Address', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_address1" name="sage_billing_address1">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_address1 == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_city" ><?php _e('Billing City', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_city" name="sage_billing_city">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_city == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_post_code" ><?php _e('Post Code', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_post_code" name="sage_billing_post_code">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_post_code == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>

                                        <tr valign="top">
                                          <th scope="row">
                                            <label for="sage_billing_country" ><?php _e('Country', 'wpdev-booking'); ?>:</label>
                                          </th>
                                          <td>
                                             <select id="sage_billing_country" name="sage_billing_country">
                                                <?php foreach ( $fields_orig_names as $key => $field_names) { ?>
                                                  <option <?php if($sage_billing_country == $field_names) echo "selected"; ?> value="<?php echo $field_names; ?>"><?php echo $field_names; ?></option>
                                                <?php } ?>
                                             </select>
                                          </td>
                                        </tr>
                                        <?php if (get_option( 'booking_sage_is_active' ) == 'On') { ?>
                                        <tr valign="top">
                                          <th scope="row" colspan="2">
                                              <span style="font-size:11px;color:#f00;" class="description"><?php printf(__('These %sfields confuguration is obligatory, for Sage payment%s system!', 'wpdev-booking'),'<b>','</b>');?></span>
                                          </th>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="clear" style="height:10px;"></div>
                                <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="billing_form_submit"/>
                                <div class="clear" style="height:10px;"></div>
                            </form>
               </div> </div> </div>
            <?php
        }

        // Show Settings at the 1-st page
        function show_advanced_settings(){

            if (isset($_POST['submit_settings_propay'])) {

                     if (isset( $_POST['range_selection_is_active'] ))     $range_selection_is_active = 'On';
                     else                                                  $range_selection_is_active = 'Off';
                     update_option( 'booking_range_selection_is_active' ,  $range_selection_is_active );

                     if (isset( $_POST['range_selection_time_is_active'] ))     $range_selection_time_is_active = 'On';
                     else                                                  $range_selection_time_is_active = 'Off';
                     update_option( 'booking_range_selection_time_is_active' ,  $range_selection_time_is_active );

                     $range_selection_days_count =  $_POST['range_selection_days_count'];
                     update_option( 'booking_range_selection_days_count' , $range_selection_days_count );

                     $range_start_day =  $_POST['range_start_day'];
                     update_option( 'booking_range_start_day' , $range_start_day );

                     $range_selection_days_count_dynamic =  $_POST['range_selection_days_count_dynamic'];
                     update_option( 'booking_range_selection_days_count_dynamic' , $range_selection_days_count_dynamic );

                     $range_start_day_dynamic =  $_POST['range_start_day_dynamic'];
                     update_option( 'booking_range_start_day_dynamic' , $range_start_day_dynamic );


                     $range_selection_start_time =  $_POST['range_selection_start_time'];
                     update_option( 'booking_range_selection_start_time' , $range_selection_start_time );

                     $range_selection_end_time =  $_POST['range_selection_end_time'];
                     update_option( 'booking_range_selection_end_time' , $range_selection_end_time );

                     $booking_time_format = $_POST['booking_time_format'];
                     update_option( 'booking_time_format' , $booking_time_format );

                     $range_selection_type = $_POST['range_selection_type'];
                     update_option( 'booking_range_selection_type' , $range_selection_type );

            }
                    $range_selection_type = get_option( 'booking_range_selection_type'); if( get_option( 'booking_range_selection_type') == false) $range_selection_type = 'fixed';
                    $range_selection_is_active = get_option( 'booking_range_selection_is_active');
                    $range_selection_days_count = get_option( 'booking_range_selection_days_count');
                    $range_start_day = get_option( 'booking_range_start_day');
                    $range_selection_days_count_dynamic = get_option( 'booking_range_selection_days_count_dynamic');
                    $range_start_day_dynamic   = get_option( 'booking_range_start_day_dynamic');

                    $range_selection_time_is_active = get_option( 'booking_range_selection_time_is_active');
                    $range_selection_start_time  = get_option( 'booking_range_selection_start_time');
                    $range_selection_end_time  = get_option( 'booking_range_selection_end_time');
                    $booking_time_format = get_option( 'booking_time_format');
            ?>
                        <div class="clear" style="height:20px;"></div>
                        <div  style="width:99%; ">

                            <div class='meta-box'>
                                <div  class="postbox" > <h3 class='hndle'><span><?php _e('Advanced Settings', 'wpdev-booking'); ?></span></h3>
                                    <div class="inside">
                                            <form  name="post_option" action="" method="post" id="post_option" >
                                                <table class="form-table"><tbody>

                                                        <tr valign="top">
                                                        <th scope="row"><label for="booking_time_format" ><?php _e('Time Format', 'wpdev-booking'); ?>:</label><br/>
                                                        </th>
                                                            <td>
                                                                <fieldset>
                                                                <?php
                                                                        $time_formats =  array( __('g:i a'), 'g:i A', 'H:i' ) ;
                                                                        $custom = TRUE;
                                                                        foreach ( $time_formats as $format ) {
                                                                                echo "\t<label title='" . esc_attr($format) . "'>";
                                                                                echo "<input type='radio' name='booking_time_format' value='" . esc_attr($format) . "'";
                                                                                if ( get_option('booking_time_format') === $format ) {  echo " checked='checked'"; $custom = FALSE; }
                                                                                echo ' /> ' . date_i18n( $format ) . "</label> &nbsp;&nbsp;&nbsp; \n";
                                                                        }
                                                                        echo '	<label><input type="radio" name="booking_time_format" id="time_format_custom_radio" value="'.$booking_time_format.'"';
                                                                        if ( $custom )  echo ' checked="checked"';
                                                                        echo '/> ' . __('Custom', 'wpdev-booking') . ': </label>';?>
                                                                            <input id="booking_time_format_custom" class="regular-text code" type="text" size="45" value="<?php echo $booking_time_format; ?>" name="booking_time_format_custom"
                                                                                   onchange="javascript:document.getElementById('time_format_custom_radio').value = this.value;document.getElementById('time_format_custom_radio').checked=true;"
                                                                                   />
                                                               <?php
                                                                        echo ' ' . date_i18n( $booking_time_format ) . "\n";
                                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                ?>
                                                                            <?php printf(__('Type your time format for showing in emeils and booking table. %sDocumentation on time formatting.%s', 'wpdev-booking'),'<br/><a href="http://php.net/manual/en/function.date.php" target="_blank">','</a>');?>
                                                                </fieldset>
                                                                
                                                            </td>
                                                        </tr>


                                                        <tr valign="top">
                                                            <th scope="row">
                                                                <label for="range_selection_is_active" ><?php _e('Range selection', 'wpdev-booking'); ?>:</label>
                                                            </th>
                                                            <td>
                                                                <input <?php if ($range_selection_is_active == 'On') echo "checked";/**/ ?>  value="<?php echo $range_selection_is_active; ?>" name="range_selection_is_active" id="range_selection_is_active" type="checkbox"
                                                                     onclick="javascript: if (this.checked) jQuery('#togle_settings_range_type_selection').slideDown('normal'); else  jQuery('#togle_settings_range_type_selection').slideUp('normal');"
                                                                                                                                             />
                                                                <span class="description"><?php _e(' Tick this checkbox if you want to use range selection in calendar. For example select week or only 5 days for booking.', 'wpdev-booking');?></span>
                                                            </td>
                                                        </tr>

                                                        <tr valign="top"><td colspan="2">

                                                                <table id="togle_settings_range_type_selection" style="<?php if ($range_selection_is_active != 'On') echo "display:none;";/**/ ?>" class="hided_settings_table">
                                                            <tr valign="top"><td>

                                                                    <div style="width:100%;">
                                                                        <div style="float:left;width:180px;height: 30px;"></div>
                                                                        <div style="float:left;width:400px;font-weight: bold;"><label for="range_start_day" ><?php _e('Selection of FIXED number of days by ONE mouse click', 'wpdev-booking'); ?>: </label><input  <?php if ($range_selection_type == 'fixed') echo 'checked="checked"';/**/ ?> value="fixed" type="radio" id="range_selection_type"  name="range_selection_type"  onclick="javascript: jQuery('#togle_settings_range').slideDown('normal');jQuery('#togle_settings_range_dynamic').slideUp('normal');"  /></div>
                                                                        <div style="float:left;width:420px;font-weight: bold;"><label for="range_start_day" ><?php _e('Selection of DYNAMIC number of days by TWO mouse click', 'wpdev-booking'); ?>: </label><input  <?php if ($range_selection_type == 'dynamic') echo 'checked="checked"';/**/ ?> value="dynamic" type="radio" id="range_selection_type"  name="range_selection_type"  onclick="javascript: jQuery('#togle_settings_range').slideUp('normal');jQuery('#togle_settings_range_dynamic').slideDown('normal');"  /></div>
                                                                    </div>
                                                                    <div style="width:100%;clear: both;"></div>

                                                                    <table id="togle_settings_range" style="<?php if ($range_selection_type != 'fixed') echo 'display:none;';/**/ ?>" class="hided_settings_table">
                                                                        <tr valign="top">
                                                                        <th scope="row"><label for="range_selection_days_count" ><?php _e('Count of days', 'wpdev-booking'); ?>:</label><br><?php printf(__('in %srange to select%s', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                                                            <td><input value="<?php echo $range_selection_days_count; ?>" name="range_selection_days_count" id="range_selection_days_count" class="regular-text code" type="text" size="45"  />
                                                                                <span class="description"><?php printf(__('Type your %snumber of days for range selection%s', 'wpdev-booking'),'<b>','</b>');?></span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr valign="top">
                                                                            <th scope="row"><label for="range_start_day" ><?php _e('Start day of range', 'wpdev-booking'); ?>:</label></th>
                                                                            <td>
                                                                                <select id="range_start_day" name="range_start_day" style="width:150px;">
                                                                                    <option <?php if($range_start_day == '-1') echo "selected"; ?> value="-1"><?php _e('Any day of week', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '0') echo "selected"; ?> value="0"><?php _e('Sunday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '1') echo "selected"; ?> value="1"><?php _e('Monday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '2') echo "selected"; ?> value="2"><?php _e('Thuesday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '3') echo "selected"; ?> value="3"><?php _e('Wednesday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '4') echo "selected"; ?> value="4"><?php _e('Thursday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '5') echo "selected"; ?> value="5"><?php _e('Friday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day == '6') echo "selected"; ?> value="6"><?php _e('Saturday', 'wpdev-booking'); ?></option>
                                                                                </select>
                                                                                <span class="description"><?php _e('Select your start day of range selection at week', 'wpdev-booking');?></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                    <table id="togle_settings_range_dynamic" style="<?php if ($range_selection_type != 'dynamic') echo 'display:none;';/**/ ?>" class="hided_settings_table">
                                                                        <tr valign="top">
                                                                        <th scope="row"><label for="range_selection_days_count_dynamic" ><?php _e('Minimum days count', 'wpdev-booking'); ?>:</label><br><?php printf(__('in %srange to select%s', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                                                            <td><input value="<?php echo $range_selection_days_count_dynamic; ?>" name="range_selection_days_count_dynamic" id="range_selection_days_count_dynamic" class="regular-text code" type="text" size="45"  />
                                                                                <span class="description"><?php printf(__('Type your %sminimum number of days for range selection%s', 'wpdev-booking'),'<b>','</b>');?></span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr valign="top">
                                                                            <th scope="row"><label for="range_start_day_dynamic" ><?php _e('Start day of range', 'wpdev-booking'); ?>:</label></th>
                                                                            <td>
                                                                                <select id="range_start_day_dynamic" name="range_start_day_dynamic" style="width:150px;">
                                                                                    <option <?php if($range_start_day_dynamic == '-1') echo "selected"; ?> value="-1"><?php _e('Any day of week', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '0') echo "selected"; ?> value="0"><?php _e('Sunday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '1') echo "selected"; ?> value="1"><?php _e('Monday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '2') echo "selected"; ?> value="2"><?php _e('Thuesday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '3') echo "selected"; ?> value="3"><?php _e('Wednesday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '4') echo "selected"; ?> value="4"><?php _e('Thursday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '5') echo "selected"; ?> value="5"><?php _e('Friday', 'wpdev-booking'); ?></option>
                                                                                    <option <?php if($range_start_day_dynamic == '6') echo "selected"; ?> value="6"><?php _e('Saturday', 'wpdev-booking'); ?></option>
                                                                                </select>
                                                                                <span class="description"><?php _e('Select your start day of range selection at week', 'wpdev-booking');?></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>


                                                            </td></tr>
                                                            </table>

                                                        </td></tr>




                                                        <tr valign="top">
                                                            <th scope="row">
                                                                <label for="range_selection_time_is_active" ><?php _e('Use fixed time', 'wpdev-booking'); ?>:</label><br/><?php _e('in range selections', 'wpdev-booking'); ?>
                                                            </th>
                                                            <td>
                                                                <input <?php if ($range_selection_time_is_active == 'On') echo "checked";/**/ ?>  value="<?php echo $range_selection_time_is_active; ?>" name="range_selection_time_is_active" id="range_selection_time_is_active" type="checkbox"
                                                                     onclick="javascript: if (this.checked) jQuery('#togle_settings_range_times').slideDown('normal'); else  jQuery('#togle_settings_range_times').slideUp('normal');"
                                                                                                                                                  />
                                                                <span class="description"><?php _e(' Tick this checkbox if you want to use for booking part of the day (not full day) at start and end day of range selection. Its will overwrite starttime and endtime from from customization.', 'wpdev-booking');?></span>
                                                            </td>
                                                        </tr>

                                                        <tr valign="top"><td colspan="2">
                                                            <table id="togle_settings_range_times" style="<?php if ($range_selection_time_is_active != 'On') echo "display:none;";/**/ ?>" class="hided_settings_table">
                                                                <tr>
                                                                <th scope="row"><label for="range_selection_start_time" ><?php _e('Start time', 'wpdev-booking'); ?>:</label><br><?php printf(__('%sstart booking time%s', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                                                    <td><input value="<?php echo $range_selection_start_time; ?>" name="range_selection_start_time" id="range_selection_start_time" class="wpdev-validates-as-time" type="text" size="5"  />
                                                                        <span class="description"><?php printf(__('Type your %sstart%s time of booking for range selection', 'wpdev-booking'),'<b>','</b>');?></span>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                <th scope="row"><label for="range_selection_end_time" ><?php _e('End time', 'wpdev-booking'); ?>:</label><br><?php printf(__('%send booking time%s', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                                                <td><input value="<?php echo $range_selection_end_time; ?>" name="range_selection_end_time" id="range_selection_end_time" class="wpdev-validates-as-time" type="text" size="5"   />
                                                                        <span class="description"><?php printf(__('Type your %send%s time of booking for range selection', 'wpdev-booking'),'<b>','</b>');?></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td></tr>

                                                        <?php do_action('wpdev_bk_advanced_settings_end') ?>

                                                </tbody></table>

                                                <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save Changes', 'wpdev-booking'); ?>" name="submit_settings_propay"/>
                                                <div class="clear" style="height:10px;"></div>
                                            </form>

                                            
                                    </div>
                                </div>
                             </div>

                        </div>


            <?php
        }


     //   A C T I V A T I O N   A N D   D E A C T I V A T I O N    O F   T H I S   P L U G I N  ///////////////////////////////////////////////////

            // Activate
            function pro_activate() {
                global $wpdb;
                add_option( 'booking_paypal_emeil', get_option('admin_email') );
                add_option( 'booking_paypal_curency', 'USD' );
                add_option( 'booking_paypal_subject', sprintf(__('Payment for booking of the %s for days: %s' , 'wpdev-booking'),'[bookingname]','[dates]'));
                add_option( 'booking_paypal_is_active','On' );
                add_option( 'booking_paypal_is_reference_box', 'Off' );           // checkbox
                add_option( 'booking_paypal_reference_title_box', __('Enter your phone' , 'wpdev-booking'));
                add_option( 'booking_paypal_return_url', get_option('siteurl') );
                add_option( 'booking_paypal_cancel_return_url', get_option('siteurl') );
                add_option( 'booking_paypal_button_type', 'https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif' );  // radio
                add_option( 'booking_paypal_price_period' , 'day' );

                // Sage Account /////////////////////////////////////////////////////////////////////////////////////////////
                add_option( 'booking_sage_is_active', 'Off' );
                add_option( 'booking_sage_subject', sprintf(__('Payment for booking of the %s for days: %s' , 'wpdev-booking'),'[bookingname]','[dates]'));
                add_option( 'booking_sage_test', 'SIMULATOR' );
                add_option( 'booking_sage_order_Successful', get_option('siteurl') );
                add_option( 'booking_sage_order_Failed', get_option('siteurl') );
                if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) {
                    add_option( 'booking_sage_vendor_name', 'wpdevelop' );
                    add_option( 'booking_sage_encryption_password', 'FfCDQjLiM524VtE7' );
                    add_option( 'booking_sage_curency', 'USD' );
                    add_option( 'booking_sage_transaction_type', 'PAYMENT' );                    
                } else {
                    add_option( 'booking_sage_vendor_name', '' );
                    add_option( 'booking_sage_encryption_password', '' );
                    add_option( 'booking_sage_curency', '' );
                    add_option( 'booking_sage_transaction_type', '' );
                }
                add_option( 'booking_billing_customer_email', '' );
                add_option( 'booking_billing_firstnames', '' );
                add_option( 'booking_billing_surname', '' );
                add_option( 'booking_billing_address1', '' );
                add_option( 'booking_billing_city', '' );
                add_option( 'booking_billing_country', '' );
                add_option( 'booking_billing_post_code', '' );
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                add_option( 'booking_range_selection_type', 'fixed');
                add_option( 'booking_range_selection_is_active', 'Off');
                add_option( 'booking_range_selection_days_count','3');
                add_option( 'booking_range_start_day' , '-1' );
                add_option( 'booking_range_selection_days_count_dynamic','1');
                add_option( 'booking_range_start_day_dynamic' , '-1' );
                add_option( 'booking_range_selection_time_is_active', 'Off');
                add_option( 'booking_range_selection_start_time','12:00');
                add_option( 'booking_range_selection_end_time','14:00');

                add_option( 'booking_time_format', 'H:i');

                if  ($this->is_field_in_table_exists('bookingtypes','cost') == 0){
                    $simple_sql = "ALTER TABLE ".$wpdb->prefix ."bookingtypes ADD cost VARCHAR(100) NOT NULL DEFAULT '0'";
                    $wpdb->query($simple_sql);
                    $wpdb->query( "UPDATE ".$wpdb->prefix ."bookingtypes SET cost = '25'");
                }

                if  ($this->is_field_in_table_exists('booking','pay_status') == 0){ // Add remark field
                    $simple_sql = "ALTER TABLE ".$wpdb->prefix ."booking ADD pay_status VARCHAR(200) NOT NULL DEFAULT ''";
                    $wpdb->query($simple_sql);
                }


                if  ($this->is_field_in_table_exists('booking','cost') == 0){ // Add remark field
                    $simple_sql = "ALTER TABLE ".$wpdb->prefix ."booking ADD cost FLOAT(7,2) NOT NULL DEFAULT 0.00";
                    $wpdb->query($simple_sql);
                }

            }

            //Decativate
            function pro_deactivate(){

                delete_option( 'booking_paypal_emeil' );
                delete_option( 'booking_paypal_curency' );
                delete_option( 'booking_paypal_subject' );
                delete_option( 'booking_paypal_is_active' );
                delete_option( 'booking_paypal_is_reference_box' );           // checkbox
                delete_option( 'booking_paypal_reference_title_box' );
                delete_option( 'booking_paypal_return_url' );
                delete_option( 'booking_paypal_cancel_return_url' );
                delete_option( 'booking_paypal_button_type' );  // radio
                delete_option( 'booking_paypal_price_period' );

                // Sage account
                delete_option( 'booking_sage_is_active' );
                delete_option( 'booking_sage_subject' );
                delete_option( 'booking_sage_test' );
                delete_option( 'booking_sage_order_Successful' );
                delete_option( 'booking_sage_order_Failed' );
                delete_option( 'booking_sage_vendor_name' );
                delete_option( 'booking_sage_encryption_password' );
                delete_option( 'booking_sage_curency' );
                delete_option( 'booking_sage_transaction_type' );
                delete_option( 'booking_billing_customer_email' );
                delete_option( 'booking_billing_firstnames' );
                delete_option( 'booking_billing_surname' );
                delete_option( 'booking_billing_address1' );
                delete_option( 'booking_billing_city' );
                delete_option( 'booking_billing_country' );
                delete_option( 'booking_billing_post_code' );


                delete_option( 'booking_range_selection_type');
                delete_option( 'booking_range_selection_is_active');
                delete_option( 'booking_range_selection_days_count');
                delete_option( 'booking_range_start_day'   );
                delete_option( 'booking_range_selection_days_count_dynamic');
                delete_option( 'booking_range_start_day_dynamic'   );
                delete_option( 'booking_range_selection_time_is_active');
                delete_option( 'booking_range_selection_start_time');
                delete_option( 'booking_range_selection_end_time');

                delete_option( 'booking_time_format');
            }


    }
}

// Its called, when returned from Paymant system
function wpdev_bk_update_pay_status(){

    global $wpdb;
    $status = '';  $booking_id = '';  $pay_system = ''; $wp_nonce = '';

    if (isset($_GET['payed_booking']))  $booking_id = $_GET['payed_booking'];
    if (isset($_GET['stats']))          $status = $_GET['stats'];
    if (isset($_GET['pay_sys']))        $pay_system = $_GET['pay_sys'];
    if (isset($_GET['wp_nonce']))       $wp_nonce   = $_GET['wp_nonce'];

    $slct_sql = "SELECT pay_status FROM ".$wpdb->prefix ."booking WHERE booking_id IN ($booking_id) LIMIT 0,1";
    $slct_sql_results  = $wpdb->get_results( $slct_sql );
    
    $is_go_on = false;
    if ( count($slct_sql_results) > 0 )
        if ($slct_sql_results[0]->pay_status == $wp_nonce)  $is_go_on = true; // Evrything GOOD

    if ($is_go_on == false) { // Some Unautorize request, die
        wpdev_redirect( get_option('siteurl')  );
    }

    if ($pay_system == 'sage') {
        $strCrypt=$_REQUEST["crypt"];
        $strEncryptionPassword =  get_option( 'booking_sage_encryption_password' );
        $strDecoded=wpdev_simpleXor(wpdev_Base64Decode($strCrypt),$strEncryptionPassword);
        $values = wpdev_getToken($strDecoded);
        $status = 'Sage:' . $values['Status'];
       // debuge($values, $booking_id, $status, $pay_system, get_option( 'booking_sage_order_Successful' ), get_option( 'booking_sage_order_Failed' ));
    }

    if ($pay_system == 'paypal') { $status = 'PayPal:' . $status; }

    if ( ($booking_id =='') || ($status =='') || ($pay_system =='') || ($wp_nonce =='') ) wpdev_redirect( get_option('siteurl')  )   ;

    $update_sql = "UPDATE ".$wpdb->prefix ."booking AS bk SET bk.pay_status='$status' WHERE bk.booking_id=$booking_id;";
    if ( false === $wpdb->query( $update_sql ) ) {
        if ($pay_system == 'sage')   { wpdev_redirect( get_option( 'booking_sage_order_Failed' ) )   ; }
        if ($pay_system == 'paypal') { wpdev_redirect( get_option( 'booking_paypal_cancel_return_url' ) )   ; }
        wpdev_redirect( get_option('siteurl')  )   ;
    }
    
    if ($pay_system == 'sage') {
        if ($status == 'OK') wpdev_redirect( get_option( 'booking_sage_order_Successful' ) )   ;
        else                 wpdev_redirect( get_option( 'booking_sage_order_Failed' ) )   ;
    }

    if ($pay_system == 'paypal') {
        if ($status == 'OK') wpdev_redirect( get_option( 'booking_paypal_return_url' ) )   ;
        else                 wpdev_redirect( get_option( 'booking_paypal_cancel_return_url' ) )   ;
    }

     wpdev_redirect( get_option('siteurl')  )   ;
}




//Function to redirect browser to a specific page
function wpdev_redirect($url) {
   //if (!headers_sent()) header('Location: '.$url . '/');
   //else
       {
       echo '<script type="text/javascript">';
       echo 'window.location.href="'.$url.'";';
       echo '</script>';
       echo '<noscript>';
       echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
       echo '</noscript>';
   }
}

function wpdev_getToken($thisString) {

// List the possible tokens
$Tokens = array(
"Status",
"StatusDetail",
"VendorTxCode",
"VPSTxId",
"TxAuthNo",
"Amount",
"AVSCV2",
"AddressResult",
"PostCodeResult",
"CV2Result",
"GiftAid",
"3DSecureStatus",
"CAVV",
    "AddressStatus",
    "CardType",
    "Last4Digits",
    "PayerStatus","CardType");



// Initialise arrays
$output = array();
$resultArray = array();

// Get the next token in the sequence
for ($i = count($Tokens)-1; $i >= 0 ; $i--){
// Find the position in the string
$start = strpos($thisString, $Tokens[$i]);
    // If it's present
if ($start !== false){
  // Record position and token name
  $resultArray[$i]->start = $start;
  $resultArray[$i]->token = $Tokens[$i];
}
}

// Sort in order of position
sort($resultArray);
    // Go through the result array, getting the token values
for ($i = 0; $i<count($resultArray); $i++){
// Get the start point of the value
$valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
    // Get the length of the value
if ($i==(count($resultArray)-1)) {
  $output[$resultArray[$i]->token] = substr($thisString, $valueStart);
} else {
  $valueLength = $resultArray[$i+1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
      $output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
}

}

// Return the ouput array
return $output;
}

function wpdev_base64Decode($scrambled) {
  // Initialise output variable
  $output = "";

  // Fix plus to space conversion issue
  $scrambled = str_replace(" ","+",$scrambled);

  // Do encoding
  $output = base64_decode($scrambled);

  // Return the result
  return $output;
}

//  The SimpleXor encryption algorithm **  NOTE: This is a placeholder really.  Future releases of Form will use AES or TwoFish.  Proper encryption **  This simple function and the Base64 will deter script kiddies and prevent the "View Source" type tampering **  It won't stop a half decent hacker though, but the most they could do is change the amount field to something **  else, so provided the vendor checks the reports and compares amounts, there is no harm done.  It's still **  more secure than the other PSPs who don't both encrypting their forms at all
function wpdev_simpleXor($InString, $Key) {
  // Initialise key array
  $KeyList = array();
  // Initialise out variable
  $output = "";

  // Convert $Key into array of ASCII values
  for($i = 0; $i < strlen($Key); $i++){
    $KeyList[$i] = ord(substr($Key, $i, 1));
  }

  // Step through string a character at a time
  for($i = 0; $i < strlen($InString); $i++) {
    // Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
    // % is MOD (modulus), ^ is XOR
    $output.= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
  }

  // Return the result
  return $output;
}
/*
// Function to check validity of email address entered in form fields
function is_valid_email($email) {
  $result = TRUE;
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
    $result = FALSE;
  }
  return $result;
}

// Filters unwanted characters out of an input string.  Useful for tidying up FORM field inputs.
function cleanInput($strRawText,$strType) {

	if ($strType=="Number") {
		$strClean="0123456789.";
		$bolHighOrder=false;
	}
	else if ($strType=="VendorTxCode") {
		$strClean="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
		$bolHighOrder=false;
	}
	else {
  		$strClean=" ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,'/{}@():?-_&�$=%~<>*+\"";
		$bolHighOrder=true;
	}

	$strCleanedText="";
	$iCharPos = 0;

	do
		{
    		// Only include valid characters
			$chrThisChar=substr($strRawText,$iCharPos,1);

			if (strspn($chrThisChar,$strClean,0,strlen($strClean))>0) {
				$strCleanedText=$strCleanedText . $chrThisChar;
			}
			else if ($bolHighOrder==true) {
				// Fix to allow accented characters and most high order bit chars which are harmless
				if (bin2hex($chrThisChar)>=191) {
					$strCleanedText=$strCleanedText . $chrThisChar;
				}
			}

		$iCharPos=$iCharPos+1;
		}
	while ($iCharPos<strlen($strRawText));

  	$cleanInput = ltrim($strCleanedText);
	return $cleanInput;

}

/**/
?>