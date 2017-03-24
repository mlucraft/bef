<?php
/*
Plugin Name: Booking Calendar
Plugin URI: http://onlinebookingcalendar.com/
Description: Online reservation and availability checking service for your site.
Version: 9.Premium.2.0
Author: wpdevelop
Author URI: http://www.wpdevelop.com
*/

/*  Copyright 2009,  www.wpdevelop.com  (email: info@wpdevelop.com),

    www.wpdevelop.com - custom wp-plugins development & WordPress solutions.

    This file (and only this file wpdev-booking.php) is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/*
Tested WordPress Versions: 2.8.3 - 3.0
-----------------------------------------------
Change Log and Features for Future Releases :
-----------------------------------------------
M i n o r   T O D O   List:
 *   Showing booking from all booking types at admin panel, agregation of data into 1 calendar from severeal booking resources.  to have one calendar for a lot of ressource with the same type ?
 *   Posibility to add at the booking bookmark how many days to select in range there.
 *   I need to configure a minimum number of days (Not a specific range of days). The minimum number of days changes depending on seasons.
 *   when the tooltip is displayed with the time booking (12:00 - 14:00 for example) , i want the value of the field "name" to be displayed like  David 12:00 - 14:00 for exemple
 *   Different rental lengths for different types of items. For example, Room 1 is only available to rent 1 day at a time and Room 2 is available to rent for either 1, 3 or 7 days.
 *   Several range selections
 * Automatic expiration/cancellation when bookings aren't being confirmed within a certain timeframe
 * Possible to not allow the booking before the paypal payment has been made, meaning, to entry in the booking calendar, no email, etc. before the payment has been confirmed via paypal 
 * Ability to see the calculated price wen filling out the form (in the client side)
 * (Maybe at new CRM plugin) Google Calendar integration: it would be nice, someone books inserted into one of Google calendars of administraor, which is used to register all books. This way, it gets synchronized to desktop and iPhone as well
 * Send text messages after booking appointments, send Reminders via email and text messaging, SMS or text message option, to notify you immediately via your cell phone when you get a booking online
 * Setting management of each resource : Ressource1 ,   cost period : 1 hour ;   Ressource2   cost period : 1 day
 *
 * Is there a way to make impossible to book saturday without sunday, or friday without saturday. Just about dates, it's not "without" but "with" > (to book saturday WITH sunday, or friday WITH saturday). My client wants to rent room for 2 days at least because if 1 customer rent just 1 night on Saturday, mu client can't rent the friday and saturday for another one, so less money for him, you understand ?  For thomas and Fred.
 * Hiding time, which are already booked at the selection box during single day selections - for Andi


 M a j o r   T O D O   List:
 * Editing booking data of visitor by visitor in his uniq page, posibility to cancel this booking
 * Mail:
    * Payment link for visits in emails
    * New request emeil of payment sending by admin
 * Multi user support (so every form should send booking request email to a different address)
 * Customer support system (import/export to CSV, show old bookings, show other important info about customers...) - new plugin
 * Search functionality of available booking resource from all system. Example: Customer is shown a calendar Customer chooses day they wish the rental to start, hit "search" Table of items available to rent beginning THAT DAY come up customer selects desired rental customer is taken to the page with the reservation form for that rental item.



= 2.0 =
* Professional / Premium / Hotel version features:
 * Fixing issue with showing warnings during serialize exeution at WP3.0 ( Hotel Edition)
 * New design of selection booking resources items
* Features and issue fixings in All versions:
 * Optimize CSS at skins
 * New design of Settings Menu
 * Some new icons
 * Show help tooltips for some actions
 * Translation into Spanish by <a href="http://www.nortasundigitala.net" target="_blank">Nortasun Digitala (Basque Sarea S.L.)</a>
 * Add additional checking for issue: "500 Internal Server Error", and set link for solving it.
 * Optimize security of execution script. Restrict permission from listing of folders at some servers. Deny direct execution of script from browser. Show message about it.

= 1.9.3 =
* Professional / Premium / Hotel version features:
 * Show all new incoming bookings from all resources at one page - Incoming
 * Make disable some options at the rangetime selections (drop down list with time intervals), during single day selections at the calendar, when some time (in selected day) already booked.
 * Set posibility to show time in diferent formats (using AM/PM and not using it) at rangetime selections (Premium, Hotel Edition)
 * Fixing issue with editing of bookings with checkbox, which are include multiple values for checking (Professional, Premium, Hotel Edition)
* Features and issue fixings in All versions:
 * Fixing IE7 issue of showing calendar at some wordpress themes.
 * Fixing some spelling.

= 1.9.2 =
* Professional / Premium / Hotel version features:
 * Customization and sending email to visitor of site, after visitor is made booking. By default its turned Off.
 * Posibility to set costs of several days, depends from number of days during selection these days at the booking form. This new option is available at the advanced day cost, which is depends from number of selected days for booking. ( Hotel Edition )
* Features and issue fixings in All versions:
 * Inserted moderate link into email for admin after new booking is done.
 * Setting default date view as a short dates view ( its mean by default dates will show in format 05/15/2010 - 05/17/2010, but you can still chnage it at settings to this view 05/15/2010, 05/16/2010, 05/17/2010 )

= 1.9.1 =
* Professional / Premium / Hotel version features:
 * Advanced costs using checkbox option. You can add additional cost or discounts, which will calculated if visitor of your site will check ON specific check box (Hotel Edition)
 * Added posibility to set advanced day cost, which is depends from number of selected days for booking. This feature work only if cost per day is selected. If this feature is activated, rates season system will not work. (Hotel Edition)
 * Fixing issue with sorting dates at the booking table ( Hotel Edition version )
 * Fixing HTML at remark fields.
 * Optimizing of showing advanced costs at the settings page ( Hotel Edition version )
 * Cost implementation into emeil (Premium, Hotel Edition)
* Features and issue fixings in All versions:
 * CSS optimisation

 
= 1.9 =
* Professional / Premium / Hotel version features:
 * New Sage payment system
 * Added new countries field list ( Professional, Premium, Hotel Edition)
 * Multi booking form customization. Posibility to create and assign several booking forms into posts/pages for some booking resources.
 * Optimize workflow of Hotel Edition version for booking resource, which set maximum number of items (seats, rooms) to 1. In this situation its work in the same way as Premium version.
 * Optimize of workflow rates season, when payment set as "fixed deposit" (Hotel Edition)
 * Fixing issue with durationtime, when start time set as a select box (Premium, Hotel Edition)
 * Added feature of showing Name ([name]) and Second name ([secondname]) inside of emails subject  (Professional, Premium, Hotel Edition)
* Features and issue fixings in All versions:
 * Translation into Belorussian by <a href="http://pc.de" target="_blank">Marcis G</a>
 * Fixing some small IE7 issue
 * Fixing samall issue with user rights

= 1.8 =
* Professional / Premium / Hotel version features:
 * Discounts or additional costs at Advanced cost management - cost depends from any "select" fields (for example for using some objects or depends from number of visitors and so on). So you can set additional cost or discounts depends from option selected by visitor. This additional cost can be fixid cash or set in procent from original booking cost. Its very flexible. You can set it at the "Paypal and cost" settings page at advanced cost block.    ( Hotel Edition version )
 * Hourly season filter - rates. Beta! Rates depends from hour entered by visitor. ( Hotel Edition version )
* Features and issue fixings in All versions:
 * Admin booking emeil modification. From now toy can change admin emeil for bookings at the settings page at Booking Calendar Standard version (free version).
 * Setting maximum number of monthes inside of booking calendar. Early was 1 year. Right now can set from 1 month to 10 years

= 1.7.4 =
* Professional / Premium / Hotel version features:
 * Advanced cost management - cost depends from number of visitors ( Hotel Edition version )
 * Hourly season filter. Beta! Need additional testing !!! ( Hotel Edition version )
* Features and issue fixings in All versions:
 * WordPress 3.0 compatibility
 * Support new WordPress theme - Twenty Ten 0.7
 * Hide booking form, if the booking form with the same booking resource are already inside of actual page. Booking Calendar Standard have only 1 booking resource, so its can show only 1 booking form at the page (its actual for situation of showing widget and booking form inside of post/page).

= 1.7.3 =
* Professional / Premium / Hotel version features:
 * Instant (ajax) update of showing tooltip remarks during updating of remarks (Pro, Premium, Hotel Edition)
 * Time duration of booking at the (Premium, Hotel Edition)
* Features and issue fixings in All versions:
 * More easy managemnt of bookings using sort by Dates, ID, Name and Email at the booking table
 * Some grammatical changes at emeils and booking form.

= 1.7.2 =
* Professional / Premium / Hotel version features:
 * Fixing of showing bookings, which are belong to the default booking resource which are deleted, so then by default takes fisrst exist booking resource.
 * Add posibility to select time of booking using 1 selectbox, where in dropdown list hav values like these: "10:00 - 12:00" "12:00 - 14:00" and so on. Usefull whenbooking is possible only for prdefined times. (Premium and Hoel Edition version)
* Features and issue fixings in All versions:
 * Fixing several JS
 * Optimize CSS in standard skin at admin panel

= 1.7.1 =
* Professional / Premium / Hotel version features:
 * Posibility to enter direct cost of a day/night/hour in rate season filter.  Direct curency rate type have top prioritet in seson filters. For example: we have several seson filters: weekends, summer and winter. And we are have booking resource wih day cost $100, and we are set next rates: Weekend = 50%, Winter 75%, Summer = $300. So then its mean if we are select WORK DAY at Winter its will cost $100 + 75% = $175, if we are select WeekEnd day at winter $100 + 75% + 50% = $262,5  but if we select workday or weekend at the summer its will return $300, because of top prioritet for curency rate type.
* Features and issue fixings in All versions:
 * Posibility to insert into post/page only availability calendar. You can select whether to insert booking form or booking calendar.
 * Replaced text field for entering number of calendar month to dropdown lists.

= 1.7 =
* Professional / Premium / Hotel version features:
 * Added 2 new premium skins - Premium steel and Premium - marine (default for paid versions)
 * Admin edit bookings functionality - from now at paid versions you can edit booking (for some corrections), which was made by visitor of your site. Emeil according modifications is also will send to the visitor of site, after saving of modification.
 * New emeil template, which is sending after booking modifications are done by admin.
 * Remarks for bookings. From now admin also can add some own remarks to each bookings. Remarks are visible only for admin.
* Features and issue fixings in All versions:
 * Set additional checking for saving default count of calendars at admin panel
 * Set checking for posibility to show at admin booking page more then 3 monthes down to the page (for example 12 monthes)
 * Optimize CSS styles at skins for showing booking calendar at admin and client side

= 1.6 =
* Professional / Premium / Hotel version features:
 * Added 2 premium skins - Premium black and Premium - light
* Features and issue fixings in All versions:
 * New skins manager, from now all skins (CSS) will be at the folder booking/css/skins . So if you will create new sking you just need put it to this folder.
 * Added 1 new skin - Black
 * Remove top Today line from calendar, create it more compact and stylish.

= 1.5.8 =
* Professional / Premium / Hotel version features:
 *
* Features and issue fixings in All versions:
 * New shortcode [bookingcalendar] for showing only Booking Caendar without booking Form at post /page. For showing avalaibility. [bookingcalendar nummonths=2 type=1]
 * Added Danish language file
 * Optimize CSS style for showing booking form
 * New title icons
 * New screenshots and descriptions

= 1.5.7 =
* Professional / Premium / Hotel version features:
 *
* Features and issue fixings in All versions:
 * Optimize CSS at admin menu
 * Fixed compatibility with xLanguage plugin
 * Fixed compatibility with Pagemash plugin

= 1.5.6 =
* Professional / Premium / Hotel version features:
 * Do not link to the paypal, when cost price is 0 ( Premium, Hotel Edition )
 * Fixed issue of highlighting tooltip undefined showing info, after booking is done. ( Premium, Hotel Edition )
* Features and issue fixings in All versions:
 * Remove images descriptions of paid version from main Booking Calendar Admin panel page and from Booking Calendar General settings page (advnaced settings image description).
 * New Menu links design
 * Some CSS improvements

= 1.5.5 =
* Features and issue fixings in All versions:
 * Fixing error showing during updating plugin to version 1.5.4 at WordPress version 2.8 and older.

= 1.5.4 =
* Professional / Premium / Hotel version features:
 * Showing availability of booking resources at the highlighting tooltip ( Hotel Edition )
 * Setting start day of selection in dynamic range selection, using 2 mouse click for selection (Premium, Hotel Edition )
 * Setting minimum number of days for selection in dynamic range selection, using 2 mouse click for selection (Premium, Hotel Edition )
 * More easy selection/editing  of time format (Premium, Hotel Edition )
* Features and issue fixings in All versions:
 * More easy selection/editing  of date format

= 1.5.3 =
* Professional / Premium / Hotel version features:
 * Showing cost of day at the highlighting tooltip ( Hotel Edition )
* Features and issue fixings in All versions:
 * Short view of severeal days at emeils and booking table. For exmaple during booking 01.06.2010, 02.06.2010, 03.06.2010, 04.06.2010 now you can set option to show it like  01.06.2010 - 04.06.2010

= 1.5.2 =
* Professional / Premium / Hotel version features:
  * Rates feature - costs depends from the season. Example: Payment cost calculation depends from the period - July and August the price for a day is € 100,00. From January until March the price is € 50,00 and during April and May the price is € 70,00 and so on.  ( Hotel Edition )
  * Activate / Deactivate sending of emeils at the Profesional, Premium and Hotel edition version. [visitoremeil] - shortcode (at field "To" of form "Email to "Admin" after booking at site") for sending emeils also to the visitor after booking is made.  ( Pro, Premium,  Hotel Edition )
  * Added new way of range selections by mouse selection begin and end days of range (in 2 mouse clicks)  ( Premium, Hotel Edition )
  * Optimising of range selections: more correct selections checking on already booked days / times.  ( Premium, Hotel Edition )
 * Features and issue fixings in All versions:
  * Fixing some Internet Exploreer CSS issues
  * Added website url at emeils, where visitor made booking (at preofessional versions its customised feature)
  * Set showing of some settings only when its needed.
  * Optimize showing of inline hints inside of input box of cancelation reson

= 1.5.1 =
* Professional / Premium / Hotel version features:
  * Season avalaibility filter functionality             ( Hotel Edition )
  * Posibility to set avalaible / unavailable dates inside of calendar   ( Hotel Edition )

= 1.5 =
 * Professional / Premium / Hotel version features:
  * New version - Booking Calendar Hotel Edition
  * Posibility to set number of items inside of booking resource. For exmaple maximum number of rooms/seats/places/count of visitors of the specific type(booking resource). So days will be availbale untill all rooms (itms) are not reserved.  ( Hotel Edition )
  * Filter for showing only specific booking from selected items of some booking resource. In practice, for example, its mean that you can see only all bookings of standard (booking resource) room #101 (booking item)  ( Hotel Edition )
  * Fixing issue with not showing booking field value (at booking table and emeils), if field value consist some specific digits.  ( Pro, Premium, Hotel Edition )
 * Features and issue fixings in All versions:
  * Fixing issue of not showing Booking menu at Admin panel at PHP 4 and WordPress 2.9 combination
  * Optimisation of highliting days at the admin panel from booking tables and from calendar.
  * Legend of booking dates under booking calendar

= 1.4.3 =
 * Features and issue fixings in All versions:
  * Adding Captcha to the booking form. Activate/deactivate captcha from admin panel.
  * Optimising internal code structure.

= 1.4.2 =
 * Professional and Premium version features:
  * Improve highlighting of days at range (week) days selections.  ( Premium Edition )
 * Features and issue fixings in All versions:
  * 12,000 ms pause in error form message before the letters fade, gives slower readers time to figure it out!
  * Set user unavailable dayes for the booking, like Saturday, Sunday or any other days of week.
  * Improve some translations
  * New Booking calendar demo site adress - www.onlinebookingcalendar.com

= 1.4.1 =
 * Professional and Premium version features:
  * Fixing Checking of start time today if time is gone already. ( Premium Edition )
 * Features and issue fixings in All versions:
  * User roles management for access inside of plugin

= 1.4 =
 * Professional and Premium version features:
  * New versions of Booking Calendar - Booking Calendar Premium. Version Booking Calendar Deluxe is closed alternative - Booking Calendar Premium
  * Booking for specific time. Divide day to the parts according to the booking time (Booking Calendar Premium) ( Premium Edition )
  * Posibility to enter price per day, per night per hour and fixed price. ( Premium Edition )
  * Set start and end time at the range days selection (week selection) (Booking Calendar Premium)
 * Features and issue fixings in All versions:
  * Set time for showing thank you message after new booking is done
  * Multiple / Single day(s) selection feature
  * Admin panel checkbox - selection all booking in one time at booking tables (aproval, reserved)
  * Fixing bug with PHP 4 - "Fatal error: Nesting level too deep - recursive dependency" during activation of Widget
  * Fixing bug with PHP 5.3.0 - "Deprecated: Assigning the return value of new by reference is deprecated in ... "
  * Fixing issue of not correctly showing this ' symbol at the emeils and reservation forms.
  * Correct showing translation for the dates inside emeil and booking tables.

= 1.3.3 =
 * Features and issue fixings in All versions:
  * Show aproved and pending dates in diferent colors at client side view

= 1.3.2 =
 * Features and issue fixings in All versions:
  * Correction issue with Ajax error (this bug is apper when URL at the location bar was diferent from the saved location of blog. Common situation 'www' is not at location bar)
  * Set footer "powered by copyright" - not default during installation

= 1.3.1 =
 * Features and issue fixings in All versions:
  * Fixed some issues at calendar style
  * Fixed not showing booking calendar button at toolbar, when user deactivated visual editor.

= 1.3 =
 * Professional and Delux version features:
  * Paypal static Deposit payment do not depends from count of booking days for some booking properties (delux version).
 * Features and issue fixings in All versions:
  * Translation to other languages
  * Fixed issue with uncorrect showing dates at the Booking administration (approval / reserved) tables in some timezone (for example in Losangeles).

= 1.2 =
 * Professional and Delux version features:
  * Support of selection several days at once - range selection, for example make a minimum booking a 5 or 7 days (delux version).
  * Support of start day of week for range selection, for example make a selection from monday till friday only (delux version).
  * Rename "Booking Calendar Professional with paypal module" to "Booking Calendar Delux"
  * Added full list of 23 currencies, which are available at PayPal.
 * Features and issue fixings in All versions:
  * Fixing issue with not showing calendar, when theme or some plugin use other version of jQuery
  * Booking form widgets ( show only booking calendar or show full booking form)
  * Inseting booking form at any place not only into post or page, using action hook: "wpdev_bk_add_calendar" - showing only calendar, "wpdev_bk_add_form" - showing booking form. Check FAQ for usage of it.

= 1.1 =
 * Professional version features:
  * PayPal support online payment for booking. Enter price of day for each booking types.
  * Emeil customization form support new bookmrak - [name]. Its name of person, who made reservation.
 * Features and issue fixings in Free and Professional versions:
  * Customization of Date Format inside of emeils and booking table.
  * Posibility to enter message, which are show after reservation is done
  * Fixing issue with deactivation previous version before install new version, or during automatic update

= 1.0 =
 * Professional version features:
  * Multiple booking types (property) support. { Possibility to make several booking ( for example for different rooms) at the same date}
  * Email customization for approve, decline and new reservation (custom emails, subject, content... )
  * Booking fields customization from reservation form, customization of showing data from form after booking.
  * Time of start and finish booking, using additional time fields inside booking form
  * Time validation at the client side
  * Inserting calendar using 'Calendar TAG' in any place of booking form
 * Features and issue fixings in Free and Professional versions:
  * Fixed issue of showing calendar button at the TinyMCE at Safari and IE browsers
  * Fixing "Parse error: syntax error, unexpected T_VARIABLE, expecting T_FUNCTION in … wpdev-booking.php on line 1453"
  * Added decline reason of booking at the admin page
  * New Ajax message system
  * Solving problem with showing Ajax error window
  * Do not hiding reservation form after booking at the Admin part
  * New Validation of required fields and email field

= 0.7 =
 * Completly replaced calendar to new jQuery version
 * Solving issue with not showing calendar at client side of blog (because of conflicts mootols and prototype library from other wp-plugins)
 * New skin of calendar
 * Select startday of week

= 0.6 =
 * Fixed PHP4 issue of do not showing calendar at admin page
 * TiniMCE button at editor toolbar for inserting calendar
 * Created several sub menus pages - Booking calendar, Add booking from Admin page, Settings
 * New page - Admin reservation page, where admin can reserve some days
 * New Settings page - Save different options like start day of week, count of calendars, deactivation option and other
 * Adding Icons to the admin pages

= 0.5 =
* Inital beta release
*/



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!function_exists ('debuge')) {  function debuge() {  $numargs = func_num_args();   $var = func_get_args(); $makeexit = is_bool($var[count($var)-1])?$var[count($var)-1]:false; echo "<div style='text-align:left;background:#ffffff;border: 1px dashed #ff9933;font-size:11px;line-height:15px;font-family:'Lucida Grande',Verdana,Arial,'Bitstream Vera Sans',sans-serif;'><pre>"; print_r ( $var ); echo "</pre></div>"; if ($makeexit) { echo '<div style="font-size:18px;float:right;">' . get_num_queries(). '/'  . timer_stop(0, 3) . 'qps</div>'; exit;} } }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Internal plugin action system
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (true) {
        global $wpdev_bk_action, $wpdev_bk_filter;

        function add_bk_filter($filter_type, $filter) {
            global $wpdev_bk_filter;

            $args = array();
            if ( is_array($filter) && 1 == count($filter) && is_object($filter[0]) ) // array(&$this)
                $args[] =& $filter[0];
            else
                $args[] = $filter;
            for ( $a = 2; $a < func_num_args(); $a++ )
                $args[] = func_get_arg($a);

            if ( is_array($wpdev_bk_filter) )
                if ( is_array($wpdev_bk_filter[$filter_type]) )
                    $wpdev_bk_filter[$filter_type][]= $args;
                else
                    $wpdev_bk_filter[$filter_type]= array($args);
            else
                $wpdev_bk_filter = array( $filter_type => array( $args ) ) ;
        }

        function remove_bk_filter($filter_type, $filter) {
            global $wpdev_bk_filter;

            if ( isset($wpdev_bk_filter[$filter_type]) ) {
                for ($i = 0; $i < count($wpdev_bk_filter[$filter_type]); $i++) {
                    if ( $wpdev_bk_filter[$filter_type][$i][0] == $filter ) {
                        $wpdev_bk_filter[$filter_type][$i] = null;
                        return;
                    }
                }
            }
        }

        function apply_bk_filter($filter_type) {
            global $wpdev_bk_filter;


            $args = array();
            for ( $a = 1; $a < func_num_args(); $a++ )
                $args[] = func_get_arg($a);

            $value = $args[0];

            if ( is_array($wpdev_bk_filter) )
                if ( isset($wpdev_bk_filter[$filter_type]) )
                    foreach ($wpdev_bk_filter[$filter_type] as $filter) {
                        $filter_func = array_shift($filter);
                        $parameter = $args;
                        $value =  call_user_func_array($filter_func,$parameter );
                    }
            return $value;
        }

        function make_bk_action($action_type) {
            global $wpdev_bk_action;


            $args = array();
            for ( $a = 1; $a < func_num_args(); $a++ )
                $args[] = func_get_arg($a);

            //$value = $args[0];

            if ( is_array($wpdev_bk_action) )
                if ( isset($wpdev_bk_action[$action_type]) )
                    foreach ($wpdev_bk_action[$action_type] as $action) {
                        $action_func = array_shift($action);
                        $parameter = $action;
                        call_user_func_array($action_func,$args );
                    }
        }

        function add_bk_action($action_type, $action) {
            global $wpdev_bk_action;

            $args = array();
            if ( is_array($action) && 1 == count($action) && is_object($action[0]) ) // array(&$this)
                $args[] =& $action[0];
            else
                $args[] = $action;
            for ( $a = 2; $a < func_num_args(); $a++ )
                $args[] = func_get_arg($a);

            if ( is_array($wpdev_bk_action) )
                if ( is_array($wpdev_bk_action[$action_type]) )
                    $wpdev_bk_action[$action_type][]= $args;
                else
                    $wpdev_bk_action[$action_type]= array($args);
            else
                $wpdev_bk_action = array( $action_type => array( $args ) ) ;
        }

        function remove_bk_action($action_type, $action) {
            global $wpdev_bk_action;

            if ( isset($wpdev_bk_action[$action_type]) ) {
                for ($i = 0; $i < count($wpdev_bk_action[$action_type]); $i++) {
                    if ( $wpdev_bk_action[$action_type][$i][0] == $action ) {
                        $wpdev_bk_action[$action_type][$i] = null;
                        return;
                    }
                }
            }
        }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get header info from this file, just for compatibility with WordPress 2.8 and older versions.
function get_file_data_wpdev( $file, $default_headers, $context = '' ) {
	// We don't need to write to the file, so just open for reading.
	$fp = fopen( $file, 'r' );

	// Pull only the first 8kiB of the file in.
	$file_data = fread( $fp, 8192 );

	// PHP will close file handle, but we are good citizens.
	fclose( $fp );

	if( $context != '' ) {
		$extra_headers = array();//apply_filters( "extra_$context".'_headers', array() );

		$extra_headers = array_flip( $extra_headers );
		foreach( $extra_headers as $key=>$value ) {
			$extra_headers[$key] = $key;
		}
		$all_headers = array_merge($extra_headers, $default_headers);
	} else {
		$all_headers = $default_headers;
	}


	foreach ( $all_headers as $field => $regex ) {
		preg_match( '/' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, ${$field});
		if ( !empty( ${$field} ) )
			${$field} =  trim(preg_replace("/\s*(?:\*\/|\?>).*/", '',  ${$field}[1] ));
		else
			${$field} = '';
	}

	$file_data = compact( array_keys( $all_headers ) );

	return $file_data;
}

function wpdev_bk_define_static() {

    if (!function_exists ('get_option')) { die('You do not have permission to direct access to this file !!!'); } 

    $default_headers = array(
            'Name' => 'Plugin Name',
            'PluginURI' => 'Plugin URI',
            'Version' => 'Version',
            'Description' => 'Description',
            'Author' => 'Author',
            'AuthorURI' => 'Author URI',
            'TextDomain' => 'Text Domain',
            'DomainPath' => 'Domain Path'
    );
    $plugin_data = get_file_data_wpdev(  __FILE__, $default_headers, 'plugin' );

    if (!defined('WPDEV_BK_VERSION'))    define('WPDEV_BK_VERSION',  $plugin_data['Version'] );                             // 0.1
    if (!defined('WP_CONTENT_DIR'))   define('WP_CONTENT_DIR', ABSPATH . 'wp-content');                   // Z:\home\test.wpdevelop.com\www/wp-content
    if (!defined('WP_CONTENT_URL'))   define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');    // http://test.wpdevelop.com/wp-content
    if (!defined('WP_PLUGIN_DIR'))       define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');               // Z:\home\test.wpdevelop.com\www/wp-content/plugins
    if (!defined('WP_PLUGIN_URL'))       define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');               // http://test.wpdevelop.com/wp-content/plugins
    if (!defined('WPDEV_BK_PLUGIN_FILENAME'))  define('WPDEV_BK_PLUGIN_FILENAME',  basename( __FILE__ ) );              // menu-compouser.php
    if (!defined('WPDEV_BK_PLUGIN_DIRNAME'))   define('WPDEV_BK_PLUGIN_DIRNAME',  plugin_basename(dirname(__FILE__)) ); // menu-compouser
    if (!defined('WPDEV_BK_PLUGIN_DIR')) define('WPDEV_BK_PLUGIN_DIR', WP_PLUGIN_DIR.'/'.WPDEV_BK_PLUGIN_DIRNAME ); // Z:\home\test.wpdevelop.com\www/wp-content/plugins/menu-compouser
    if (!defined('WPDEV_BK_PLUGIN_URL')) define('WPDEV_BK_PLUGIN_URL', WP_PLUGIN_URL.'/'.WPDEV_BK_PLUGIN_DIRNAME ); // http://test.wpdevelop.com/wp-content/plugins/menu-compouser

    require_once(WPDEV_BK_PLUGIN_DIR. '/js/captcha/captcha.php' );   
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-pro.php')) { require_once(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-pro.php' ); }
    
    if ( ! loadLocale() ) { loadLocale('en_US');  }    //loadLocale('ru_RU');                                      // Localization
    
}

// Load locale
function loadLocale($locale = '') { // Load locale, if not so the  load en_EN default locale from folder "languages" files like "this_file_file_name-ru_RU.po" and "this_file_file_name-ru_RU.mo"
    if ( empty( $locale ) ) $locale = get_locale();
    if ( !empty( $locale ) ) {
        //Filenames like this  "microstock-photo-ru_RU.po",   "microstock-photo-de_DE.po" at folder "languages"
        $mofile = WPDEV_BK_PLUGIN_DIR  .'/languages/'.str_replace('.php','',WPDEV_BK_PLUGIN_FILENAME).'-'.$locale.'.mo';
        if (file_exists($mofile))   return load_textdomain(str_replace('.php','',WPDEV_BK_PLUGIN_FILENAME), $mofile);
        else                        return false;
    } return
    false;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Getting Ajax requests
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ( isset( $_POST['ajax_action'] ) ) {
    define('DOING_AJAX', true);
    require_once( dirname(__FILE__) . '/../../../wp-load.php' );
    @header('Content-Type: text/html; charset=' . get_option('blog_charset'));
    wpdev_bk_define_static();
    if ( class_exists('wpdev_bk_pro')) {
        $wpdev_bk_pro_in_ajax = new wpdev_bk_pro();
    }
    wpdev_bk_ajax_responder();
} 

if ( isset( $_GET['payed_booking'] ) ) {
    require_once( dirname(__FILE__) . '/../../../wp-load.php' );
    @header('Content-Type: text/html; charset=' . get_option('blog_charset'));
    wpdev_bk_define_static();
    if ( class_exists('wpdev_bk_pro')) {
        $wpdev_bk_pro_in_ajax = new wpdev_bk_pro();
    }
    if (function_exists ('wpdev_bk_update_pay_status')) wpdev_bk_update_pay_status();  die;
} /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


wpdev_bk_define_static();


if (!class_exists('wpdev_booking')) {
    class wpdev_booking {

        var $icon_button_url;
        var $prefix;
        var $settings;
        var $wpdev_bk_pro;
        var $captcha_instance;

        function wpdev_booking() {

            // Add settings top line before all other menu items.
            add_bk_action('wpdev_booking_settings_top_menu', array($this, 'settings_menu_top_line'));
            add_bk_action('wpdev_booking_settings_show_content', array(&$this, 'settings_menu_content'));

            $this->captcha_instance = new wpdevReallySimpleCaptcha();
            $this->prefix = 'wpdev_bk';
            $this->settings = array(  'custom_buttons' =>array(),
                    'custom_buttons_func_name_from_js_file' => 'set_bk_buttons', //Edit this name at the JS file of custom buttons
                    'custom_editor_button_row'=>1 );
            $this->icon_button_url = WPDEV_BK_PLUGIN_URL . '/img/calendar-16x16.png';

            if ( class_exists('wpdev_bk_pro')) {  $this->wpdev_bk_pro = new wpdev_bk_pro(); }
            else {                                $this->wpdev_bk_pro = false;              }

            // Create admin menu
            add_action('admin_menu', array(&$this, 'add_new_admin_menu'));

            // Client side print JSS
            add_action('wp_head',array(&$this, 'client_side_print_booking_head'));

            // Add custom buttons
            add_action( 'init', array(&$this,'add_custom_buttons') );               
            add_action( 'admin_head', array(&$this,'insert_wpdev_button'));

            //
            add_action( 'wp_footer', array(&$this,'wp_footer') );
            add_action( 'admin_footer', array(&$this,'print_js_at_footer') );

            // User defined
            add_action( 'wpdev_bk_add_calendar', array(&$this,'add_calendar_action') ,10 , 2);
            add_action( 'wpdev_bk_add_form',     array(&$this,'add_booking_form_action') ,10 , 2);

            add_filter( 'wpdev_bk_get_form',     array(&$this,'get_booking_form_action') ,10 , 2);

            // shortcode - Booking
            add_shortcode('booking', array(&$this, 'booking_shortcode'));
            add_shortcode('bookingcalendar', array(&$this, 'booking_calendar_only_shortcode'));



            // Add settings link at the plugin page
            add_filter('plugin_action_links', array(&$this, 'plugin_links'), 10, 2 );

            // Add widjet
            add_action( 'init', array(&$this,'add_booking_widjet') );               

            // Install / Uninstall
            register_activation_hook( __FILE__, array(&$this,'wpdev_booking_activate' ));
            register_deactivation_hook( __FILE__, array(&$this,'wpdev_booking_deactivate' ));

             if ( ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking')!==false) &&
                    ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking-reservation')===false )
            ) {
                wp_enqueue_script( 'jquery-ui-dialog' );
                wp_enqueue_style(  'wpdev-bk-jquery-ui', WPDEV_BK_PLUGIN_URL. '/css/jquery-ui.css', array(), 'wpdev-bk', 'screen' );
            }
       }


       ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       // ADMIN MENU SECTIONS  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       function add_new_admin_menu(){
            $users_roles = array(get_option( 'booking_user_role_booking' ), get_option( 'booking_user_role_addbooking' ), get_option( 'booking_user_role_settings' ) );

            for ($i = 0 ; $i < count($users_roles) ; $i++) {
                if ( $users_roles[$i] == 'administrator' )  $users_roles[$i] = 10;
                if ( $users_roles[$i] == 'editor' )         $users_roles[$i] = 7;
                if ( $users_roles[$i] == 'author' )         $users_roles[$i] = 2;
                if ( $users_roles[$i] == 'contributor' )    $users_roles[$i] = 1;
                if ( $users_roles[$i] == 'subscriber')      $users_roles[$i] = 0;
            }

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // M A I N     B O O K I N G
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $pagehook1 = add_menu_page( __('Booking services', 'wpdev-booking'), __('Booking', 'wpdev-booking'), $users_roles[0],
                   __FILE__ . 'wpdev-booking', array(&$this, 'on_show_booking_page_main'),  WPDEV_BK_PLUGIN_URL . '/img/calendar-16x16.png'  );
            add_action("admin_print_scripts-" . $pagehook1 , array( &$this, 'on_add_admin_js_files'));
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // A D D     R E S E R V A T I O N
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $pagehook2 = add_submenu_page(__FILE__ . 'wpdev-booking',__('Add booking', 'wpdev-booking'), __('Add booking', 'wpdev-booking'), $users_roles[1],
                    __FILE__ .'wpdev-booking-reservation', array(&$this, 'on_show_booking_page_addbooking')  );
            add_action("admin_print_scripts-" . $pagehook2 , array( &$this, 'client_side_print_booking_head'));
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // S E T T I N G S
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $pagehook3 = add_submenu_page(__FILE__ . 'wpdev-booking',__('Booking settings customizations', 'wpdev-booking'), __('Settings', 'wpdev-booking'), $users_roles[2],
                    __FILE__ .'wpdev-booking-option', array(&$this, 'on_show_booking_page_settings')  );
            add_action("admin_print_scripts-" . $pagehook3 , array( &$this, 'on_add_admin_js_files'));
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            // global $submenu, $menu;               // Change Title of the Main menu inside of submenu
            // this is make error in roleswhen we have first autor and then admin and admin roles
           // $submenu[plugin_basename( __FILE__ ) . 'wpdev-booking'][0][0] = __('Booking calendar', 'wpdev-booking');
       }

       //Booking
       function on_show_booking_page_main(){
           $this->on_show_page_adminmenu('wpdev-booking','/img/calendar-48x48.png', __('Booking services', 'wpdev-booking'),1);
       }
       //Add resrvation
       function on_show_booking_page_addbooking(){
           $this->on_show_page_adminmenu('wpdev-booking-reservation','/img/add-1-48x48.png', __('Add booking', 'wpdev-booking'),2);
       }
       //Settings
       function on_show_booking_page_settings(){
           $this->on_show_page_adminmenu('wpdev-booking-option','/img/application-48x48.png', __('Booking settings customizations', 'wpdev-booking'),3);
       }

       //Show content
       function on_show_page_adminmenu($html_id, $icon, $title, $content_type) {
           ?>
            <div id="<?php echo $html_id; ?>-general" class="wrap bookingpage">
            <?php
              if ($content_type == 3 )
                echo '<div class="icon32" style="margin:5px 40px 10px 10px;"><img src="'. WPDEV_BK_PLUGIN_URL . $icon .'"><br /></div>' ;
              else
                echo '<div class="icon32" style="margin:10px 25px 10px 10px;"><img src="'. WPDEV_BK_PLUGIN_URL . $icon .'"><br /></div>' ; ?>

            <h2><?php echo $title; ?></h2>
                <?php
                switch ($content_type) {
                    case 1: $this->content_of_booking_page(); break;
                    case 2: $this->content_of_reservation_page(); break;
                    case 3: $this->content_of_settings_page(); break;
                    default: break;
                } ?>
            </div>
          <?php
       }
       ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        //   F U N C T I O N S       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                // C u s t o m   b u t t o n s  /////////////////////////////////////////////////////////////////////
                function add_custom_buttons() {
                    // Don't bother doing this stuff if the current user lacks permissions
                    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;

                    // Add only in Rich Editor mode
                    if (  ( in_array( basename($_SERVER['PHP_SELF']),  array('post-new.php', 'page-new.php', 'post.php', 'page.php') ) ) /*&& ( get_user_option('rich_editing') == 'true')*/  ) {
                        //content_wpdev_bk_booking_insert
                        // 'content_' . $this->$prefix . '_' . $type
                        $this->settings['custom_buttons'] = array(
                                'booking_insert' => array(
                                        'hint' => __('Insert booking calendar', 'wpdev-booking'),
                                        'title'=> __('Booking calendar', 'wpdev-booking'),
                                        'img'=> $this->icon_button_url,
                                        'js_func_name_click' => 'booking_click',
                                        'bookmark' => 'booking',
                                        'class' => 'bookig_buttons',
                                        'is_close_bookmark' =>0
                                )
                        );


                        add_filter("mce_external_plugins", array(&$this, "mce_external_plugins"));
                        // add_action( 'admin_head', array(&$this, 'add_custom_button_function') );
                        add_action( 'edit_form_advanced', array(&$this, 'add_custom_button_function') );
                        add_action( 'edit_page_form', array(&$this, 'add_custom_button_function') );

                        if ( 1 == $this->settings['custom_editor_button_row'] )
                            add_filter( 'mce_buttons', array(&$this, 'mce_buttons') );
                        else
                            add_filter( 'mce_buttons_' . $this->settings['custom_editor_button_row'] , array(&$this, 'mce_buttons') );

                        add_action( 'admin_head', array(&$this, 'custom_button_dialog_CSS') );
                        add_action( 'admin_footer', array(&$this, 'custom_button_dalog_structure_DIV') );

                        wp_enqueue_script( 'jquery-ui-dialog' );
                        wp_enqueue_style(  'wpdev-bk-jquery-ui', WPDEV_BK_PLUGIN_URL. '/css/jquery-ui.css', array(), 'wpdev-bk', 'screen' );
                        //wp_enqueue_style( $this->prefix . '-jquery-ui',WPDEV_BK_PLUGIN_URL. '/js/custom_buttons/jquery-ui.css', array(), $this->prefix, 'screen' );
                    }
                }

                // Add button code to the tiny editor
                function insert_wpdev_button() {
                    if ( count($this->settings['custom_buttons']) > 0) {
                    ?>  <script type="text/javascript">
            var jWPDev = jQuery.noConflict();
                    <?php

                    echo '      function '. $this->settings['custom_buttons_func_name_from_js_file'].'(ed, url) {';

                    foreach ( $this->settings['custom_buttons'] as $type => $props ) {
                        echo "if ( typeof ".$props['js_func_name_click']." == 'undefined' ) return;";

                        echo "  ed.addButton('".  $this->prefix . '_' . $type ."', {";
                        echo "		title : '". $props['hint'] ."',";
                        echo "		image : '". $props['img'] ."',";
                        echo "		onclick : function() {";
                        echo "			". $props['js_func_name_click'] ."('". $type ."');";
                        echo "		}";
                        echo "	});";
                    }
                    echo '}';

                    ?> </script> <?php
                    }
                }

                // Load the custom TinyMCE plugin
                function mce_external_plugins( $plugins ) {
                    $plugins[$this->prefix . '_quicktags'] = WPDEV_BK_PLUGIN_URL.'/js/custom_buttons/editor_plugin.js';
                    return $plugins;
                }

                // Add the custom TinyMCE buttons
                function mce_buttons( $buttons ) {
                    //array_push( $buttons, "separator", 'wpdev_booking_insert', "separator" );
                    array_push( $buttons, "separator");
                    foreach ( $this->settings['custom_buttons'] as $type => $strings ) {
                        array_push( $buttons, $this->prefix . '_' . $type );
                    }

                    return $buttons;
                }

                // Add the old style buttons to the non-TinyMCE editor views and output all of the JS for the button function + dialog box
                function add_custom_button_function() {
                    $buttonshtml = '';
                    $datajs='';
                    foreach ( $this->settings['custom_buttons'] as $type => $props ) {

                        $buttonshtml .= '<input type="button" class="ed_button" onclick="'.$props['js_func_name_click'].'(\'' . $type . '\')" title="' . $props['hint'] . '" value="' . $props['title'] . '" />';

                        $datajs.= " wpdev_bk_Data['$type'] = {\n";
                        $datajs.= '		title: "' . $this->js_escape( $props['title'] ) . '",' . "\n";
                        $datajs.= '		tag: "' . $this->js_escape( $props['bookmark'] ) . '",' . "\n";
                        $datajs.= '		tag_close: "' . $this->js_escape( $props['is_close_bookmark'] ) . '",' . "\n";
                        $datajs.= '		cal_count: "' . get_option( 'booking_client_cal_count' )  . '"' . "\n";
                        $datajs.=  "\n	};\n";
                    }
                    ?>
        <script type="text/javascript">

            // <![CDATA[
            var wpdev_bk_Data={};
                    <?php echo $datajs; ?>

                // Set default heights (IE sucks)
                    <?php if( $this->wpdev_bk_pro !== false ) { ?>
                    var wpdev_bk_DialogDefaultHeight = 205;
                        <?php } else { ?>
                    var wpdev_bk_DialogDefaultHeight = 145;
                        <?php }  ?>
                     var wpdev_bk_DialogDefaultExtraHeight = 0;
                     var wpdev_bk_DialogDefaultWidth = 580;
                     if ( jWPDev.browser.msie ) {
                         var wpdev_bk_DialogDefaultHeight = wpdev_bk_DialogDefaultHeight + 8;
                         var wpdev_bk_DialogDefaultExtraHeight = wpdev_bk_DialogDefaultExtraHeight +8;
                     }


                     // This function is run when a button is clicked. It creates a dialog box for the user to input the data.
                     function booking_click( tag ) {
                         wpdev_bk_DialogClose(); // Close any existing copies of the dialog
                         wpdev_bk_DialogMaxHeight = wpdev_bk_DialogDefaultHeight + wpdev_bk_DialogDefaultExtraHeight;


                         // Open the dialog while setting the width, height, title, buttons, etc. of it
                         var buttons = { "<?php echo js_escape(__('Ok', 'wpdev-booking')); ?>": wpdev_bk_ButtonOk,
                             "<?php echo js_escape(__('Cancel', 'wpdev-booking')); ?>": wpdev_bk_DialogClose
                         };
                         var title = '<img src="<?php echo $this->icon_button_url; ?>" /> ' + wpdev_bk_Data[tag]["title"];
                         /*
                         jWPDev("#wpdev_bk-dialog").dialog({
                             autoOpen: false,
                             width: wpdev_bk_DialogDefaultWidth,
                             minWidth: wpdev_bk_DialogDefaultWidth,
                             height: wpdev_bk_DialogDefaultHeight,
                             minHeight: wpdev_bk_DialogDefaultHeight,
                             maxHeight: wpdev_bk_DialogMaxHeight,
                             title: title,
                             buttons: buttons
                         }); /**/
                         jWPDev("#wpdev_bk-dialog").dialog({
                            autoOpen: false,
                            width: 700,
                            buttons:buttons,
                            draggable:false,
                            hide: 'slide',
                            resizable: false,
                            modal: true,
                            title: title,
                            <?php 
                            if( $this->wpdev_bk_pro !== false ) {
                                $verion_width = '310';
                                if( $this->wpdev_bk_pro->wpdev_bk_premium !== false ) {
                                    $verion_width = '310';
                                    if( $this->wpdev_bk_pro->wpdev_bk_premium->wpdev_bk_hotel !== false ) {
                                        $verion_width = '380';
                                    }
                                }
                            echo " height: " . $verion_width . ' ';
                             } else {
                            echo " height: 250 ";
                             } ?>
                         });
                         // Reset the dialog box incase it's been used before
                         jWPDev("#wpdev_bk-dialog input").val("");
                         jWPDev("#calendar_tag_name").val(wpdev_bk_Data[tag]['tag']);
                         jWPDev("#calendar_tag_close").val(wpdev_bk_Data[tag]['tag_close']);
                         jWPDev("#calendar_count").val(wpdev_bk_Data[tag]['cal_count']);
                         // Style the jWPDev-generated buttons by adding CSS classes and add second CSS class to the "Okay" button
                         jWPDev(".ui-dialog button").addClass("button").each(function(){
                             if ( "<?php echo js_escape(__('Ok', 'wpdev-booking')); ?>" == jWPDev(this).html() ) jWPDev(this).addClass("button-highlighted");
                         });

                         // Do some hackery on any links in the message -- jWPDev(this).click() works weird with the dialogs, so we can't use it
                         jWPDev("#wpdev_bk-dialog-content a").each(function(){
                             jWPDev(this).attr("onclick", 'window.open( "' + jWPDev(this).attr("href") + '", "_blank" );return false;' );
                         });

                         // Show the dialog now that it's done being manipulated
                         jWPDev("#wpdev_bk-dialog").dialog("open");

                         // Focus the input field
                         jWPDev("#wpdev_bk-dialog-input").focus();
                     }

                     // Close + reset
                     function wpdev_bk_DialogClose() {
                         jWPDev(".ui-dialog").height(wpdev_bk_DialogDefaultHeight);
                         jWPDev(".ui-dialog").width(wpdev_bk_DialogDefaultWidth);
                         jWPDev("#wpdev_bk-dialog").dialog("close");
                     }

                     // Callback function for the "Okay" button
                     function wpdev_bk_ButtonOk() {

                         var cal_count = jWPDev("#calendar_count").val();
                         var cal_type = jWPDev("#calendar_type").val();
                         var cal_tag = jWPDev("#calendar_tag_name").val();
                         var cal_tag_close = jWPDev("#calendar_tag_close").val();
                         var calendar_or_form = jWPDev("#calendar_or_form").val();
                         var booking_form_type = jWPDev("#booking_form_type").val();

                         if (calendar_or_form == 'calendar') cal_tag = 'bookingcalendar';

                         if ( !cal_tag ) return wpdev_bk_DialogClose();

                         var text = '[' + cal_tag;

                         if (cal_count) text += ' ' + 'nummonths=' + cal_count;
                         if (cal_type) text += ' ' + 'type=' + cal_type;
                         if (booking_form_type) text += ' ' + 'form_type=\'' + booking_form_type + '\'';
                         text += ']';
                         if (cal_tag_close != 0) text += '[/' + cal_tag + ']';


                         if ( typeof tinyMCE != 'undefined' && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
                             ed.focus();
                             if (tinymce.isIE)
                                 ed.selection.moveToBookmark(tinymce.EditorManager.activeEditor.windowManager.bookmark);

                             ed.execCommand('mceInsertContent', false, text);
                         } else
                             edInsertContent(edCanvas, text);

                         wpdev_bk_DialogClose();
                     }


                     // On page load...
                     jWPDev(document).ready(function(){
                         // Add the buttons to the HTML view
                         jWPDev("#ed_toolbar").append('<?php echo $this->js_escape( $buttonshtml ); ?>');

                         // If the Enter key is pressed inside an input in the dialog, do the "Okay" button event
                         jWPDev("#wpdev_bk-dialog :input").keyup(function(event){
                             if ( 13 == event.keyCode ) // 13 == Enter
                                 wpdev_bk_ButtonOkay();
                         });

                         // Make help links open in a new window to avoid loosing the post contents
                         jWPDev("#wpdev_bk-dialog-slide a").each(function(){
                             jWPDev(this).click(function(){
                                 window.open( jWPDev(this).attr("href"), "_blank" );
                                 return false;
                             });
                         });
                     });
                     // ]]>
        </script>
                    <?php
                                        }

                // Output the <div> used to display the dialog box
                function custom_button_dalog_structure_DIV() { ?>
        <div class="hidden">
            <div id="wpdev_bk-dialog">
                <div class="wpdev_bk-dialog-content">
                    <div class="wpdev_bk-dialog-inputs">
                    <?php
                    if( $this->wpdev_bk_pro !== false ) {
                        $types_list = $this->wpdev_bk_pro->get_booking_types();

                        ?>
                        <div class="field">
                            <div style="float:left;">
                            <label for="calendar_type"><?php _e('Type of booking:', 'wpdev-booking'); ?></label>
                            <!--input id="calendar_type"  name="calendar_type" class="input" type="text" -->
                            <select id="calendar_type" name="calendar_type">
                        <?php foreach ($types_list as $tl) { ?>
                                <option value="<?php echo $tl->id; ?>"><?php echo $tl->title; ?></option>
                            <?php } ?>
                            </select>
                            </div>
                            <div class="description"><?php _e('For booking select type of booking resource', 'wpdev-booking'); ?></div>
                        </div>
                        <?php }/**/ ?>
                        <?php make_bk_action('wpdev_show_bk_form_selection') ?>
                        <div class="field">
                            <div style="float:left;">
                            <label for="calendar_count"><?php _e('Count of calendars:', 'wpdev-booking'); ?></label>
                            <!--input id="calendar_count"  name="calendar_count" class="input" type="text" value="<?php echo get_option( 'booking_client_cal_count' ); ?>" -->
                            <select  id="calendar_count"  name="calendar_count" >
                                <option value="1" <?php if (get_option( 'booking_client_cal_count' )== '1') echo ' selected="SELECTED" ' ?> >1</option>
                                <option value="2" <?php if (get_option( 'booking_client_cal_count' )== '2') echo ' selected="SELECTED" ' ?> >2</option>
                                <option value="3" <?php if (get_option( 'booking_client_cal_count' )== '3') echo ' selected="SELECTED" ' ?> >3</option>
                                <option value="4" <?php if (get_option( 'booking_client_cal_count' )== '4') echo ' selected="SELECTED" ' ?> >4</option>
                                <option value="5" <?php if (get_option( 'booking_client_cal_count' )== '5') echo ' selected="SELECTED" ' ?> >5</option>
                                <option value="6" <?php if (get_option( 'booking_client_cal_count' )== '6') echo ' selected="SELECTED" ' ?> >6</option>
                                <option value="7" <?php if (get_option( 'booking_client_cal_count' )== '7') echo ' selected="SELECTED" ' ?> >7</option>
                                <option value="8" <?php if (get_option( 'booking_client_cal_count' )== '8') echo ' selected="SELECTED" ' ?> >8</option>
                                <option value="9" <?php if (get_option( 'booking_client_cal_count' )== '9') echo ' selected="SELECTED" ' ?> >9</option>
                                <option value="10" <?php if (get_option( 'booking_client_cal_count' )== '10') echo ' selected="SELECTED" ' ?> >10</option>
                                <option value="11" <?php if (get_option( 'booking_client_cal_count' )== '11') echo ' selected="SELECTED" ' ?> >11</option>
                                <option value="12" <?php if (get_option( 'booking_client_cal_count' )== '12') echo ' selected="SELECTED" ' ?> >12</option>
                            </select>
                            </div>
                            <div class="description"><?php _e('Select number of month to show for calendar.', 'wpdev-booking'); ?></div>
                        </div>
                        <div class="field">
                            <div style="float:left;">
                            <label for="calendar_count"><?php _e('Show:', 'wpdev-booking'); ?></label>
                            <select id="calendar_or_form"  name="calendar_or_form" style="width:120px;">
                                <option value="form"><?php _e('Booking form', 'wpdev-booking'); ?></option>
                                <option value="calendar"><?php _e('Only calendar', 'wpdev-booking'); ?></option>
                            </select>
                            </div>
                            <div class="description"><?php _e('Select what you want to show: booking form or only availability calendar.', 'wpdev-booking'); ?></div>
                        </div>

                        <input id="calendar_tag_name"  name="calendar_tag_name" class="input" type="hidden" >
                        <input id="calendar_tag_close"  name="calendar_tag_close" class="input" type="hidden" >
                    </div>
                </div>
            </div>
        </div>
        <div id="wpdev_bk-precacher">
            <img src="<?php echo WPDEV_BK_PLUGIN_URL.'/js/custom_buttons//img_dialog_ui/333333_7x7_arrow_right.gif'; ?>" alt="" />
            <img src="<?php echo WPDEV_BK_PLUGIN_URL.'/js/custom_buttons/img_dialog_ui/333333_7x7_arrow_down.gif'; ?>" alt="" />
        </div>
                    <?php
                }

                // Hide TinyMCE buttons the user doesn't want to see + some misc editor CSS
                function custom_button_dialog_CSS() {
                    global $user_id;
                    // Attempt to match the dialog box to the admin colors
                    if ( 'classic' == get_user_option('admin_color', $user_id) ) {
                        $color = '#fff';
                        $background = '#777';
                    } else {
                        $color = '#fff';
                    $background = '#777';



                }?>
    <style type='text/css'>
        #wpdev_bk-precacher { display: none; }
        .ui-dialog-titlebar {
            color: <?php  echo $color; ?>;
            background: <?php  echo $background; ?>;
        }
                <?php foreach ($this->settings['custom_buttons'] as $type => $props) {
                    echo  '#content_' . $this->prefix  . '_' . $type  . ' img.mceIcon{
                                                        width:16px;
                                                        height:16px;
                                                        margin:2px auto;0
                                                   }';
                }
                ?>
        .ui-dialog-title img{
            margin:3px auto;
            width:16px;
            height:16px;
        }
        #wpdev_bk-dialog .field {height:30px;
    line-height:25px;
    margin:0px 0px 5px;}
        #wpdev_bk-dialog .field label {float:left; padding-right:10px;width:155px;text-align:left; font-weight:bold;}
        #wpdev_bk-dialog .wpdev_bk-dialog-inputs {float:left;}
        #wpdev_bk-dialog input ,#wpdev_bk-dialog select {  width:120px;  }
        #wpdev_bk-dialog .input_check {width:10px; margin:5px 10px;text-align:center;}
        #wpdev_bk-dialog .dialog-wraper {float:left;width:100%;}
        #wpdev_bk-dialog .description {color:#666666;
    float:right;

    padding:0 5px;
    text-align:left;
    width:350px;}

    </style>
                <?php
            }
                // E N D   C u s t o m   b u t t o n s  //////////////////////////////////////////////////////////////



        // Get array of images - icons inside of this directory
        function dirList ($directories) {

            // create an array to hold directory list
            $results = array();

            if (is_string($directories)) $directories = array($directories);
            foreach ($directories as $dir) {
                $directory = WPDEV_BK_PLUGIN_DIR . $dir ;
                // create a handler for the directory
                $handler = @opendir($directory);
                if ($handler !== false) {
                    // keep going until all files in directory have been read
                    while ($file = readdir($handler)) {

                        // if $file isn't this directory or its parent,
                        // add it to the results array
                        if ($file != '.' && $file != '..' && ( strpos($file, '.css' ) !== false ) )
                            $results[] = array($file, WPDEV_BK_PLUGIN_URL . $dir . $file,  ucfirst(strtolower( str_replace('.css', '', $file))) );
                    }

                    // tidy up: close the handler
                    closedir($handler);
                }
            }
            // done!
            return $results;

        }

        // Adds Settings link to plugins settings
        function plugin_links($links, $file) {

            $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin) {
                $settings_link = '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-option">'.__("Settings", 'wpdev-booking').'</a>';
                $settings_link2 = '<a href="http://wpdevelop.com/booking-calendar-professional/">'.__("Buy", 'wpdev-booking').' Pro</a>';
                array_unshift($links, $settings_link2);
                array_unshift($links, $settings_link);
            }
            return $links;
        }


        // WordPress' js_escape() won't allow <, >, or " -- instead it converts it to an HTML entity. This is a "fixed" function that's used when needed.
        function js_escape($text) {
            $safe_text = addslashes($text);
            $safe_text = preg_replace('/&#(x)?0*(?(1)27|39);?/i', "'", stripslashes($safe_text));
            $safe_text = preg_replace("/\r?\n/", "\\n", addslashes($safe_text));
            $safe_text = str_replace('\\\n', '\n', $safe_text);
            return apply_filters('js_escape', $safe_text, $text);
        }

        // Check if table exist
        function is_table_exists( $tablename ) {
            global $wpdb;
            if (strpos($tablename, $wpdb->prefix) ===false) $tablename = $wpdb->prefix . $tablename ;
            $sql_check_table = "
                SELECT COUNT(*) AS count
                FROM information_schema.tables
                WHERE table_schema = '". DB_NAME ."'
                AND table_name = '" . $tablename . "'";

            $res = $wpdb->get_results($sql_check_table);
            return $res[0]->count;

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

        // Check if nowday is tommorow from previosday
        function is_next_day($nowday, $previosday) {

            if ( empty($previosday) ) return false;

            $nowday_d = (date('m.d.Y',  mysql2date('U', $nowday ))  );
            $prior_day = (date('m.d.Y',  mysql2date('U', $previosday ))  );
            if ($prior_day == $nowday_d)    return true;                // if its the same date


            $previos_array = (date('m.d.Y',  mysql2date('U', $previosday ))  );
            $previos_array = explode('.',$previos_array);
            $prior_day =  date('m.d.Y' , mktime(0, 0, 0, $previos_array[0], ($previos_array[1]+1), $previos_array[2] ));


            if ($prior_day == $nowday_d)    return true;                // zavtra
            else                            return false;               // net
        }

        // Change date format
        function get_showing_date_format($mydate ) {
            $date_format = get_option( 'booking_date_format');
            if ($date_format == '') $date_format = "d.m.Y";

            $time_format = get_option( 'booking_time_format');
            if ( $time_format !== false  ) {
                $time_format = ' ' . $time_format;
                $my_time = date('H:i:s' , $mydate);
                if ($my_time == '00:00:00')     $time_format='';
            }
            else  $time_format='';

            // return date($date_format . $time_format , $mydate);
            return date_i18n($date_format,$mydate) .'<sup class="booking-table-time">' . date_i18n($time_format  , $mydate).'</sup>';

        }

        // Get dates
        function get_dates ($approved = 'all', $bk_type = 1) {

            global $wpdb;
            $dates_array = $time_array = array();

            if ($approved == 'all')
                $sql_req = apply_bk_filter('get_bk_dates_sql', "SELECT DISTINCT dt.booking_date

                     FROM ".$wpdb->prefix ."bookingdates as dt

                     INNER JOIN ".$wpdb->prefix ."booking as bk

                     ON    bk.booking_id = dt.booking_id

                     WHERE  dt.booking_date >= CURDATE()  AND bk.booking_type = $bk_type

                     ORDER BY dt.booking_date", $bk_type, 'all' );

            else
                $sql_req = apply_bk_filter('get_bk_dates_sql', "SELECT DISTINCT dt.booking_date

                     FROM ".$wpdb->prefix ."bookingdates as dt

                     INNER JOIN ".$wpdb->prefix ."booking as bk

                     ON    bk.booking_id = dt.booking_id

                     WHERE  dt.approved = $approved AND dt.booking_date >= CURDATE() AND bk.booking_type = $bk_type

                     ORDER BY dt.booking_date", $bk_type, $approved );

            $dates_approve = apply_bk_filter('get_bk_dates', $wpdb->get_results( $sql_req ), $approved, 0,$bk_type );

            // loop with all dates which is selected by someone
            foreach ($dates_approve as $my_date) {
                $my_date = explode(' ',$my_date->booking_date);

                $my_dt = explode('-',$my_date[0]);
                $my_tm = explode(':',$my_date[1]);

                array_push( $dates_array , $my_dt );
                array_push( $time_array , $my_tm );
            }
            return    array($dates_array,$time_array);  // $dates_array;
        }

        //Write Admin booking table
        function booking_table($approved = 0) {

            global $wpdb;
            $bk_type = $this->get_default_type();

            $sql = "SELECT *

                        FROM ".$wpdb->prefix ."booking as bk

                        INNER JOIN ".$wpdb->prefix ."bookingdates as dt

                        ON    bk.booking_id = dt.booking_id

                        WHERE approved = $approved AND dt.booking_date >= CURDATE()
";
if ($bk_type!=0) $sql .= "                       AND bk.booking_type = ". $bk_type ."";

 $sql .= "                        ORDER BY bk.booking_id DESC, dt.booking_date ASC
            ";
            $result = $wpdb->get_results( $sql );

             ///////////////////////////////////////////////////////////////////
             //transforms results into structure
             $result_structure = array();
             $old_id = '';
             $ns = -1;
             $last_date = $last_show_date = '';
             foreach ($result as $res) {

                 if ($old_id == $res->booking_id ) { // add only dates
                     $result_structure[$ns]['dates'][] = $res->booking_date;
                 } else { // new record
                     $ns++;
                     $old_id = $res->booking_id;
                     $result_structure[$ns]['dates'][] = $res->booking_date;
                     $result_structure[$ns]['id'] = $res->booking_id;
                                        $cont = get_form_content($res->form, $res->booking_type);//$bk_type);
                                        $search = array ("'(<br[ ]?[/]?>)+'si","'(<p[ ]?[/]?>)+'si","'(<div[ ]?[/]?>)+'si");
                                        $replace = array ("&nbsp;&nbsp;"," &nbsp; "," &nbsp; ");
                                        $cont['content'] = preg_replace($search, $replace, $cont['content']);
                     $result_structure[$ns]['form'] = $cont;
                     $result_structure[$ns]['remark'] = $res->remark;
                     $result_structure[$ns]['pay_status'] = $res->pay_status;
                     $result_structure[$ns]['cost'] = $res->cost;
                     $result_structure[$ns]['booking_type'] = $res->booking_type;
                 }
             }
             ///////////////////////////////////////////////////////////////////
             // Get short days
             foreach ($result_structure as $key=>$res) {
                    $last_day = '';
                    $last_show_day = '';
                    $short_days = array();
                    
                    foreach ($res['dates'] as $dte) {

                        if (empty($last_day)) { // First date
                            $short_days[]= $dte;
                            $last_show_day = $dte;
                        } else {                // All other days
                            if ( $this->is_next_day( $dte ,$last_day) ){
                                if ($last_show_day != '-') $short_days[]= '-';
                                $last_show_day = '-';
                            } else {
                                if ($last_show_day !=$last_day) $short_days[]= $last_day;
                                $short_days[]= ',';
                                $short_days[]= $dte;
                                $last_show_day = $dte;
                            }
                        }
                        $last_day = $dte;
                    }
                    if($last_show_day != $dte) $short_days[]= $dte;
                    $result_structure[$key]['short_days'] = $short_days;
             }
             ///////////////////////////////////////////////////////////////////
             // Sort this structure
             $sorted_structure = array();
             // Sort type
             if (isset($_GET['booking_sort_order'])) {
                 if ($_GET['booking_sort_order'] == 'date')      { $sort_type = 'date'; $sort_order = 'ASC'; }
                 if ($_GET['booking_sort_order'] == 'date_desc') { $sort_type = 'date'; $sort_order = 'DESC'; }
                 if ($_GET['booking_sort_order'] == 'id')      { $sort_type = 'id'; $sort_order = 'ASC'; }
                 if ($_GET['booking_sort_order'] == 'id_desc') { $sort_type = 'id'; $sort_order = 'DESC'; }
                 if ($_GET['booking_sort_order'] == 'name')      { $sort_type = 'name'; $sort_order = 'ASC'; }
                 if ($_GET['booking_sort_order'] == 'name_desc') { $sort_type = 'name'; $sort_order = 'DESC'; }
                 if ($_GET['booking_sort_order'] == 'email')      { $sort_type = 'email'; $sort_order = 'ASC'; }
                 if ($_GET['booking_sort_order'] == 'email_desc') { $sort_type = 'email'; $sort_order = 'DESC'; }
                 if ($_GET['booking_sort_order'] == 'visitors')      { $sort_type = 'visitors'; $sort_order = 'ASC'; }
                 if ($_GET['booking_sort_order'] == 'visitors_desc') { $sort_type = 'visitors'; $sort_order = 'DESC'; }
             } else {
                 $sort_type = 'id';
                 $sort_order = 'DESC';
             }
//debuge('$result_structure',$result_structure);
             foreach ($result_structure as $key=>$value) {
                switch ($sort_type) {
                    case 'date':      if ( ! empty($sorted_structure[$value['dates'][0]])) $sorted_structure[$value['dates'][0] . (time() * rand()) ] = $value; else $sorted_structure[$value['dates'][0]] = $value;  break;
                    case 'name':     if ( ! empty($sorted_structure[$value['form']['name']])) $sorted_structure[$value['form']['name'] . (time() * rand()) ] = $value; else $sorted_structure[strtolower($value['form']['name'])] = $value;  break;
                    case 'email':    if ( ! empty($sorted_structure[$value['form']['email']])) $sorted_structure[$value['form']['email'] . (time() * rand()) ] = $value; else $sorted_structure[strtolower($value['form']['email'])] = $value;  break;
                    case 'visitors': if ( ! empty($sorted_structure[$value['form']['visitors']])) $sorted_structure[$value['form']['visitors'] . (time() * rand()) ] = $value; else $sorted_structure[$value['form']['visitors']] = $value;  break;
                    case 'id':
                    default: $sorted_structure[$value['id']] = $value; break;
                }
             }
//debuge('$sorted_structure',$sorted_structure);             die;
             if ($sort_order == 'DESC') krsort($sorted_structure );
             else                       ksort($sorted_structure );


            $old_id = '';
            $alternative_color = '';
            if ($approved == 0) { $outColor = '#FFBB45'; $outColorClass = '0'; }
            if ($approved == 1) { $outColor = '#99bbee'; $outColorClass = '1'; }
            $booking_date_view_type = get_option( 'booking_date_view_type');
            if ($booking_date_view_type == 'short'){ $wide_days_class = ' hide_dates_view '; $short_days_class = ''; }
            else                                   { $wide_days_class = ''; $short_days_class = ' hide_dates_view '; }
            

            if (count($sorted_structure)>0) {
                $sort_url = '<a style="color:#fff;" href="admin.php?page='. WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME. 'wpdev-booking&booking_type=' .$bk['booking_type']. '&booking_sort_order=';
                $arr_asc  = '<span style="font-size:17px;color:#fff;"> &darr; </span>';
                $arr_desc = '<span style="font-size:17px;color:#fff;"> &uarr; </span>';
                ?>
                <table class='booking_table' cellspacing="0">
                    <tr>
                        <th style="width:15px;"> <input type="checkbox" onclick="javascript:setCheckBoxInTable(this.checked, 'booking_appr<?php echo $approved; ?>');" class="booking_allappr<?php echo $approved; ?>" id="booking_allappr_<?php echo $approved; ?>"  name="booking_allappr_<?php echo $approved; ?>" </th>
                        <th style="width:35px;"><?php echo $sort_url; ?><?php
                            if (isset($_GET['booking_sort_order'])) {  if ($_GET['booking_sort_order']=='id')  echo 'id_desc';    else echo 'id';  }
                            else echo 'id'; ?>"><?php _e('ID', 'wpdev-booking'); ?></a><?php
                            if ( ($_GET['booking_sort_order']=='id')  )      echo $arr_asc;
                            if ( ($_GET['booking_sort_order']=='id_desc') || (! isset( $_GET['booking_sort_order']) )  ) echo $arr_desc;
                            ?></th>
                        <th style="width:50%;"><?php _e('Info', 'wpdev-booking'); ?>
                            <?php
                                echo '<span style="font-size:10px;">(';

                                if (isset($_GET['booking_sort_order'])){ if ($_GET['booking_sort_order']=='name') $srt_url_tp='name_desc'; else $srt_url_tp='name';}
                                else $srt_url_tp='name';
                                echo $sort_url.$srt_url_tp.'">Name' . "</a> " ; if ($_GET['booking_sort_order']=='name') {echo $arr_asc;} if ($_GET['booking_sort_order']=='name_desc') {echo $arr_desc;}

                                if (isset($_GET['booking_sort_order'])){ if ($_GET['booking_sort_order']=='email') $srt_url_tp='email_desc'; else $srt_url_tp='email';}
                                else $srt_url_tp='email';
                                echo $sort_url.$srt_url_tp.'"> Email'. "</a> " ;if ($_GET['booking_sort_order']=='email') {echo $arr_asc;} if ($_GET['booking_sort_order']=='email_desc') {echo $arr_desc;}

                                // if (isset($_GET['booking_sort_order'])){ if ($_GET['booking_sort_order']=='visitors') $srt_url_tp='visitors_desc'; else $srt_url_tp='visitors';}
                                // else $srt_url_tp='visitors';
                                // echo $sort_url.$srt_url_tp.'"> Visitor number' . "</a> " ;if ($_GET['booking_sort_order']=='visitors') {echo $arr_asc;} if ($_GET['booking_sort_order']=='visitors_desc') {echo $arr_desc;}
                                echo ")</span>";
                            ?>
                        </th>
                        <th><?php echo $sort_url; ?><?php
                            if (isset($_GET['booking_sort_order'])) {  if ($_GET['booking_sort_order']=='date') echo 'date_desc'; else echo 'date'; }
                            else echo 'date_desc'; ?>"><?php _e('Dates', 'wpdev-booking'); ?></a><?php
                            if ( ($_GET['booking_sort_order']=='date')  ) echo $arr_asc;
                            if ($_GET['booking_sort_order']=='date_desc') echo $arr_desc;
                            ?><div style="float:right;">
                            <span  class="showwidedates<?php echo $short_days_class; ?>" style="cursor: pointer;text-decoration: underline;font-size:10px;" onclick="javascript:
                               jWPDev('.short_dates_view').addClass('hide_dates_view');
                               jWPDev('.short_dates_view').removeClass('show_dates_view');
                               jWPDev('.wide_dates_view').addClass('show_dates_view');
                               jWPDev('.wide_dates_view').removeClass('hide_dates_view');
                               jWPDev('#showwidedates').addClass('hide_dates_view');

                               jWPDev('.showwidedates').addClass('hide_dates_view');
                               jWPDev('.showshortdates').addClass('show_dates_view');
                               jWPDev('.showshortdates').removeClass('hide_dates_view');
                               jWPDev('.showwidedates').removeClass('show_dates_view');

                               "><?php _e('Show Wide Days view', 'wpdev-booking'); ?></span>
                            <span class="showshortdates<?php echo $wide_days_class; ?>" style="cursor: pointer;text-decoration: underline;font-size:10px;"  onclick="javascript:
                               jWPDev('.wide_dates_view').addClass('hide_dates_view');
                               jWPDev('.wide_dates_view').removeClass('show_dates_view');
                               jWPDev('.short_dates_view').addClass('show_dates_view');
                               jWPDev('.short_dates_view').removeClass('hide_dates_view');

                               jWPDev('.showshortdates').addClass('hide_dates_view');
                               jWPDev('.showwidedates').addClass('show_dates_view');
                               jWPDev('.showwidedates').removeClass('hide_dates_view');
                               jWPDev('.showshortdates').removeClass('show_dates_view');

                               "><?php _e('Show Short Days view', 'wpdev-booking'); ?></span>
                            </div>
                        </th>
                        <?php make_bk_action('show_booking_table_status_header'); ?>
                        <th style="width:45px;"><?php _e('Actions', 'wpdev-booking'); ?></th>
                    </tr>
                <?php
                 $type_items = array();
                 if( $this->wpdev_bk_pro !== false ) {
                    $types_list = $this->wpdev_bk_pro->get_booking_types();
                    foreach ($types_list as $type_item) {
                        $type_items[ $type_item->id ] = $type_item->title;
                    }
                 }
                foreach ($sorted_structure as $bk) {

                            if(isset($_GET['moderate_id'])) {
                                if ($bk['id'] !== $_GET['moderate_id']) {
                                    if ( $alternative_color == '')  $alternative_color = ' class="alternative_color moderate_blend" ';
                                    else                            $alternative_color = ' class="moderate_blend" ';
                                }
                            }
                            else {
                                if ( $alternative_color == '')  $alternative_color = ' class="alternative_color" ';
                                else                            $alternative_color = '';
                            }
                           // debuge($bk);die;
                        ?>
                            <tr id="booking_row<?php  echo $bk['id']  ?>"  <?php if ($_GET['booking_id_selection'] ==$bk['id']) echo ' class="raw_after_editing" '; ?>  >
                                <td <?php echo $alternative_color; ?> >
                                    <input type="checkbox" class="booking_appr<?php echo $approved; ?>" id="booking_appr_<?php  echo $bk['id']  ?>"  name="booking_appr_<?php  echo $bk['id']  ?>"
                                    <?php  if ($bk['id'] == $_GET['moderate_id']) echo 'checked="checked"';  ?>  />
                                </td>
                                <td <?php echo $alternative_color; ?> style="text-align:center;" > <?php make_bk_action('show_remark_hint',$bk['id'], $bk);    echo $bk['id'];  ?> </td>
                                <td <?php echo $alternative_color; ?> >
                                    <div style="display:block;font-size:11px;line-height:20px;" id="full<?php  echo $bk['id'];  ?>" >
                                    <?php echo $bk['form']['content']; ?>
                                    </div>
                                </td>
                                <td <?php echo $alternative_color; ?> style="" >
                                    <div id="wide_dates_view<?php echo $bk['id'];?>" class="wide_dates_view<?php echo $wide_days_class; ?>"  >
                                    <?php foreach ($bk['dates'] as $date_key => $bkdate) {
                                          $date_class = ( date('m',  mysql2date('U',$bkdate)) + 0 ) . '-' . ( date('d',  mysql2date('U',$bkdate)) + 0 ) . '-' . ( date('Y',  mysql2date('U',$bkdate)) + 0 );  ?>
                                          <span class="<?php echo "adate-" . $date_class; ?>"><a href="#" class="booking_overmause<?php echo $outColorClass; ?>"
                                                                                       onmouseover="javascript:highlightDay('<?php echo "cal4date-" . $date_class; ?>','#ff0000');"
                                                                                       onmouseout="javascript:highlightDay('<?php echo "cal4date-" . $date_class; ?>','<?php echo $outColor; ?>');"
                                                                                       ><?php echo $this->get_showing_date_format( mysql2date('U',$bkdate) );?></a></span><?php
                                        make_bk_action('show_subtype_num',$bk['booking_type'], $bk['id'], $bkdate);
                                        if ($date_key != (count($bk['dates'])-1)) echo ", ";
                                    }
                                    echo '</div><div id="short_dates_view'.$bk['id'].'"  class="short_dates_view'. $short_days_class. '"  >';
                                    // SHORT DAYS ECHO
                                    foreach ($bk['short_days'] as $bkdate) { //echo $bkdate;   continue;
                                        if ((trim($bkdate) != ',') && (trim($bkdate) != '-')) { //eco date
                                            $date_class = ( date('m',  mysql2date('U',$bkdate)) + 0 ) . '-' . ( date('d',  mysql2date('U',$bkdate)) + 0 ) . '-' . ( date('Y',  mysql2date('U',$bkdate)) + 0 );

                                            echo '<span class="adate-'.$date_class.'"><a href="#" class="booking_overmause'. $outColorClass.'"'.
                                                                                                   ' onmouseover="javascript:highlightDay(\'cal4date-' . $date_class. '\',\'#ff0000\');" ' .
                                                                                                   ' onmouseout="javascript:highlightDay(\'cal4date-' . $date_class. '\',\''.$outColor .'\');" ' . ' >' . $this->get_showing_date_format( mysql2date('U',$bkdate) ) .
                                                    '</a></span>';
                                            echo apply_bk_filter('filter_subtype_num','',$bk['booking_type'], $bk['id'], $bkdate);
                                            echo ' ';
                                        } else { // echo separator
                                            echo '<span class="date_tire">'.$bkdate.' </span>' ;
                                        }
                                    }
                                    ?>
                                    </div>
                                </td>
                                <?php make_bk_action('show_payment_status',$bk['id'], $bk, $alternative_color); ?>
                                <td <?php echo $alternative_color; ?> style="text-align:center;"  >
                                    <?php
                                    if ($bk_type==0)  if (isset($type_items[ $bk['booking_type'] ]))
                                        echo '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking'.'&booking_type='.$bk['booking_type'].'" class="bktypetitle" style="line-height:25px;background-color:#fff;padding:2px 5px;font-size:10px;white-space:nowrap;">' . $type_items[ $bk['booking_type'] ]  . '</a>';

                                    if( $this->wpdev_bk_pro !== false ) { ?>
                                     <a href="javascript:;" onclick='javascript:location.href=&quot;admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-reservation&booking_type=<?php echo $bk['booking_type']; ?>&booking_id=<?php echo $bk['id']; ?>&quot;;'><img  src="<?php  echo  WPDEV_BK_PLUGIN_URL . '/img/edit_type.png'; ?>" class="tipcy" title='<?php echo __('Edit reservation','wpdev-booking'); ?>' /></a>
                                    <?php } else { ?>
                                     <a href="javascript:;" onclick='javascript:openModalWindow(&quot;modal_content1&quot;);' ><img  src="<?php  echo  WPDEV_BK_PLUGIN_URL . '/img/edit_type.png'; ?>" class="tipcy" title='<?php echo __('Edit reservation','wpdev-booking'); ?>' /></a>
                                    <?php }

                                    //remark
                                    if( $this->wpdev_bk_pro !== false ) { ?>
                                     <a href="javascript:;" onclick='javascript:if (document.getElementById(&quot;remark_row<?php echo $bk['id'];?>&quot;).style.display==&quot;block&quot;) document.getElementById(&quot;remark_row<?php echo $bk['id'];?>&quot;).style.display=&quot;none&quot;; else document.getElementById(&quot;remark_row<?php echo $bk['id'];?>&quot;).style.display=&quot;block&quot;; '><img  src="<?php  echo  WPDEV_BK_PLUGIN_URL . '/img/notes.png'; ?>" class="tipcy"  title='<?php echo __('Edit notes','wpdev-booking'); ?>' /></a>
                                     
                                    <?php } else { ?>
                                     <a href="javascript:;" onclick='javascript:openModalWindow(&quot;modal_content1&quot;);' ><img  src="<?php  echo  WPDEV_BK_PLUGIN_URL . '/img/notes.png'; ?>" class="tipcy" title='<?php echo __('Edit Notes','wpdev-booking'); ?>' /></a>
                                    <?php }
                                        //echo "<input type='button' class='button' value='".__('Remark','wpdev-booking')."' onclick='javascript:openModalWindow(&quot;modal_content1&quot;);'>";

                                       make_bk_action('show_remark_editing_field',$bk['id'],$bk,"height:1px;padding:0px;margin:0px;border:none;");
                                    ?>
                                </td></tr>
                                    <?php
                } ?> </table>
                <?php
                return true;
            } else {
                return false;
            }

        }


        // Generate booking CAPTCHA fields  for booking form
        function createCapthaContent($bk_tp) {
            if (  get_option( 'booking_is_use_captcha' ) !== 'On'  ) return '';
            else {
                $this->captcha_instance->cleanup(1);

                $word = $this->captcha_instance->generate_random_word();
                $prefix = mt_rand();
                $this->captcha_instance->generate_image($prefix, $word);

                $filename = $prefix . '.png';
                $captcha_url = WPDEV_BK_PLUGIN_URL . '/js/captcha/tmp/' .$filename;
                $html  = '<input type="text" class="captachinput" value="" name="captcha_input'.$bk_tp.'" id="captcha_input'.$bk_tp.'">';
                $html .= '<img class="captcha_img"  id="captcha_img' . $bk_tp . '" alt="captcha" src="' . $captcha_url . '" />';
                $ref = substr($filename, 0, strrpos($filename, '.'));
                $html = '<input type="hidden" name="wpdev_captcha_challenge_' . $bk_tp . '"  id="wpdev_captcha_challenge_' . $bk_tp . '" value="' . $ref . '" />'
                        . $html
                        . '<div id="captcha_msg'.$bk_tp.'" class="wpdev-help-message" ></div>';
                return $html;
            }
        }

        //   A D M I N     S I D E   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Add widjet controlls
        function booking_widget_control() {

            if (isset($_POST['booking_widget_title'] )) {

                update_option('booking_widget_title', htmlspecialchars($_POST['booking_widget_title']));
                update_option('booking_widget_show',  $_POST['booking_widget_show']);
                if( $this->wpdev_bk_pro !== false ) {
                    update_option('booking_widget_type',  $_POST['booking_widget_type']);
                }
                update_option('booking_widget_calendar_count',  $_POST['booking_widget_calendar_count']);

                $booking_widget_last_field = htmlspecialchars($_POST['booking_widget_last_field']);
                $booking_widget_last_field = str_replace('\"', "'" , $booking_widget_last_field);
                $booking_widget_last_field = str_replace("\'", "'" , $booking_widget_last_field);
                update_option('booking_widget_last_field', $booking_widget_last_field );
            }
            $booking_widget_title = get_option('booking_widget_title');
            $booking_widget_show  =  get_option('booking_widget_show');
            if( $this->wpdev_bk_pro !== false ) {
                $booking_widget_type  =  get_option('booking_widget_type');
                    } else $booking_widget_type=1;
            $booking_widget_calendar_count  =  get_option('booking_widget_calendar_count');
                    $booking_widget_last_field = get_option('booking_widget_last_field');

            ?>

<p>
    <label><?php _e('Title', 'wpdev-booking'); ?>:</label><br/>
    <input value="<?php echo $booking_widget_title; ?>" name="booking_widget_title" id="booking_widget_title" type="text" style="width:100%;" />
</p>

<p>
    <label><?php _e('Show', 'wpdev-booking'); ?>:</label><br/>
    <select id="booking_widget_show" name="booking_widget_show"  style="width:100%;">
        <option <?php if($booking_widget_show == 'booking_calendar') echo "selected"; ?> value="booking_calendar"><?php _e('Booking calendar', 'wpdev-booking'); ?></option>
        <option <?php if($booking_widget_show == 'booking_form') echo "selected"; ?> value="booking_form"><?php _e('Booking form', 'wpdev-booking'); ?></option>
    </select>
</p>


                <?php
            if( $this->wpdev_bk_pro !== false ) {
                $types_list = $this->wpdev_bk_pro->get_booking_types();

                ?>
<p>
    <label><?php _e('Booking resource', 'wpdev-booking'); ?>:</label><br/>
    <!--input id="calendar_type"  name="calendar_type" class="input" type="text" -->
    <select id="booking_widget_type" name="booking_widget_type"  style="width:100%;">
                <?php foreach ($types_list as $tl) { ?>
        <option  <?php if($booking_widget_type == $tl->id ) echo "selected"; ?> value="<?php echo $tl->id; ?>"><?php echo $tl->title; ?></option>
                    <?php } ?>
    </select>

</p>
                <?php } ?>

<p>
    <label><?php _e('Count of calendars', 'wpdev-booking'); ?>:</label><br/>
    <input value="<?php echo $booking_widget_calendar_count; ?>" name="booking_widget_calendar_count" id="booking_widget_calendar_count" type="text" style="width:100%;" />
</p>

<p>
    <label><?php _e('Footer', 'wpdev-booking'); ?>:</label><br/>
    <input value="<?php echo $booking_widget_last_field; ?>" name="booking_widget_last_field" id="booking_widget_last_field" type="text" style="width:100%;" /><br/>
    <label><?php printf(__("Example: %sMake booking here%s", 'wpdev-booking'),"<code>&lt;a href='LINK'&gt;",'&lt;/a&gt;</code>'); ?></label>
</p>

<p>
            <?php printf(__("%sImportant!!!%s Please note, if you show booking calendar (inserted into post/page) with widget at the same page, then the last will not be visible.", 'wpdev-booking'),'<strong>','</strong><br/>'); ?>
</p>
            <?php
        }

        // Init widjets
        function add_booking_widjet() {

            $widget_options = array('classname' => 'widget_wpdev_booking', 'description' => __( "Display Booking.", 'wpdev-booking') );
            wp_register_sidebar_widget('wpdev_booking_widget', __('Booking', 'wpdev-booking'), 'show_booking_widget_php4', $widget_options);
            wp_register_widget_control('wpdev_booking_widget', __('Booking settings', 'wpdev-booking'), array(&$this, 'booking_widget_control') );
        }


        // add hook for printing scripts only at this plugin page
        function on_add_admin_js_files() {
            // Write inline scripts and CSS at HEAD
            add_action('admin_head', array(&$this, 'head_print_js_css_admin' ), 1);
        }



        // HEAD for ADMIN page
        function head_print_js_css_admin() {
            $this->print_js_css(1);
        }

        //JS at footer
        function print_js_at_footer() {
            if ( ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking')!==false) &&
                    ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking-reservation')===false )
            ) {

                $bk_type = $this->get_default_type();
                $my_boook_type = $bk_type ;

                $start_script_code = "<script type='text/javascript'>";
                $start_script_code .= "  jWPDev(document).ready( function(){";

                $start_script_code .= apply_filters('wpdev_booking_availability_filter', '', $bk_type);
                
                $start_script_code .= "  date2approve[". $bk_type. "] = [];";
                $dates_and_time_to_approve = $this->get_dates('0', $bk_type);
                $dates_to_approve = $dates_and_time_to_approve[0];
                $times_to_approve = $dates_and_time_to_approve[1];
                $i=-1;
                foreach ($dates_to_approve as $date_to_approve) {
                    $i++;

                    $td_class =   ($date_to_approve[1]+0). "-" . ($date_to_approve[2]+0). "-". $date_to_approve[0];

                    $start_script_code .= " if (typeof( date2approve[". $bk_type. "][ '". $td_class . "' ] ) == 'undefined'){ ";
                    $start_script_code .= " date2approve[". $bk_type. "][ '". $td_class . "' ] = [];} ";

                    $start_script_code .= "  date2approve[". $bk_type. "][ '". $td_class . "' ][  date2approve[".$bk_type."]['".$td_class."'].length  ] = [".
                            ($date_to_approve[1]+0).", ". ($date_to_approve[2]+0).", ". ($date_to_approve[0]+0).", ".
                            ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                            "];";
                }

                $start_script_code .= "  var date_approved_par = [];";
                //$dates_approved = $this->get_dates('1',$my_boook_type);// [ Year, Month,Day ]...
                $dates_and_time_to_approve = $this->get_dates('1', $my_boook_type);
                $dates_approved =   $dates_and_time_to_approve[0];
                $times_to_approve = $dates_and_time_to_approve[1];
                $i=-1;
                foreach ($dates_approved as $date_to_approve) {
                    $i++;

                    $td_class =   ($date_to_approve[1]+0)."-".($date_to_approve[2]+0)."-".($date_to_approve[0]);

                    $start_script_code .= " if (typeof( date_approved_par[ '". $td_class . "' ] ) == 'undefined'){ ";
                    $start_script_code .= " date_approved_par[ '". $td_class . "' ] = [];} ";

                    $start_script_code.=" date_approved_par[ '".$td_class."' ][  date_approved_par['".$td_class."'].length  ] = [".
                            ($date_to_approve[1]+0).",".($date_to_approve[2]+0).",".($date_to_approve[0]+0).", ".
                            ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                            "];";
                }

                $start_script_code .= "     init_datepick_cal('". $bk_type ."',   date_approved_par, ".
                        get_option( 'booking_admin_cal_count' ).", ".
                        get_option( 'booking_start_day_weeek' ) . " );";
                $start_script_code .= "});";
                $start_script_code .= "</script>";
                $start_script_code = apply_filters('wpdev_booking_calendar', $start_script_code , $my_boook_type);
                echo $start_script_code;
            }
            $is_use_hints = get_option( 'booking_is_use_hints_at_admin_panel'  );
            if ($is_use_hints == 'On')
              if (  ( ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.php')) !== false) && (   ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking-reservation'))  === false) ) { ?>
                <script type="text/javascript" >
                    jWPDev('.tipcy').tipsy({
                        delayIn: 1000,      // delay before showing tooltip (ms)
    delayOut: 0,     // delay before hiding tooltip (ms)
    fade: true,     // fade tooltips in/out?
    fallback: '',    // fallback text to use when no tooltip text
    gravity: 'n',    // gravity
    html: false,     // is tooltip content HTML?
    live: false,     // use live event support?
    offset: 40,       // pixel offset of tooltip from element
    opacity: 0.9,    // opacity of tooltip
    title: 'title'});
                </script> <?php }

        }

        // Print     J a v a S cr i p t   &    C S S    scripts for admin and client side.
        function print_js_css($is_admin =1 ) {

            if (! ( $is_admin))  wp_print_scripts('jquery');
            //wp_print_scripts('jquery-ui-core');

            //   J a v a S c r i pt
            ?> <!-- Booking Calendar Scripts --> <?php
            $is_use_hints = get_option( 'booking_is_use_hints_at_admin_panel'  );
            if ($is_use_hints == 'On') {
                if ( $is_admin) { ?>  <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/tooltip2/src/javascripts/jquery.tipsy.js"></script> <?php }
                if ( $is_admin) { ?>  <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/tooltip2/src/stylesheets/tipsy.css" rel="stylesheet" type="text/css" /> <?php }
            }
            ?>
<script  type="text/javascript">
    var jWPDev = jQuery.noConflict();
    var wpdev_bk_plugin_url = '<?php echo WPDEV_BK_PLUGIN_URL; ?>';
    var wpdev_bk_today = ['<?php echo  date('Y') .', '. date('m').', '. date('d').', '. date('H').', '. date('i') ; ?>'];
    var visible_booking_id_on_page = [];
    var booking_max_monthes_in_calendar = '<?php echo get_option( 'booking_max_monthes_in_calendar'); ?>';
    var user_unavilable_days = [];
            <?php
            if ( get_option( 'booking_unavailable_day0') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 0; ';
            if ( get_option( 'booking_unavailable_day1') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 1; ';
            if ( get_option( 'booking_unavailable_day2') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 2; ';
            if ( get_option( 'booking_unavailable_day3') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 3; ';
            if ( get_option( 'booking_unavailable_day4') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 4; ';
            if ( get_option( 'booking_unavailable_day5') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 5; ';
            if ( get_option( 'booking_unavailable_day6') == 'On' ) echo ' user_unavilable_days[user_unavilable_days.length] = 6; ';
            ?>
        // Check for correct URL based on Location.href URL, its need for correct aJax request
        var real_domain = window.location.href;
        var start_url = '';
        var pos1 = real_domain.indexOf('//'); //get http
        if (pos1 > -1 ) { start_url= real_domain.substr(0, pos1+2); real_domain = real_domain.substr(pos1+2);   }  //set without http
        real_domain = real_domain.substr(0, real_domain.indexOf('/') );    //setdomain
        var pos2 = wpdev_bk_plugin_url.indexOf('//');  //get http
        if (pos2 > -1 ) wpdev_bk_plugin_url = wpdev_bk_plugin_url.substr(pos2+2);    //set without http
        wpdev_bk_plugin_url = wpdev_bk_plugin_url.substr( wpdev_bk_plugin_url.indexOf('/') );    //setdomain
        wpdev_bk_plugin_url = start_url + real_domain + wpdev_bk_plugin_url;
        ///////////////////////////////////////////////////////////////////////////////////////

        var wpdev_bk_plugin_filename = '<?php echo WPDEV_BK_PLUGIN_FILENAME; ?>';
            <?php if (  ( get_option( 'booking_multiple_day_selections' ) == 'Off') && ( get_option( 'booking_range_selection_is_active') !== 'On' )  ) { ?>
        var multiple_day_selections = 0;
                <?php } else { ?>
        var multiple_day_selections = 50;
                <?php } ?>
        var wpdev_bk_pro =<?php if(  $this->wpdev_bk_pro !== false  ) {
                echo '1';
            } else {
                echo '0';
            } ?>;
        var wpdev_bk_is_dynamic_range_selection = false;
        var message_verif_requred = '<?php _e('This field is required', 'wpdev-booking'); ?>';
        var message_verif_emeil = '<?php _e('Incorrect email field', 'wpdev-booking'); ?>';
        var message_verif_selectdts = '<?php _e('Please, select reservation date(s) at Calendar.', 'wpdev-booking'); ?>';
</script>
            <?php do_action('wpdev_bk_js_define_variables');
            ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/datepick/jquery.datepick.js"></script>  <?php
            $locale = get_locale();  //$locale = 'ru_RU'; // Load translation for calendar
            if ( ( !empty( $locale ) ) && ( substr($locale,0,2) !== 'en')  )
                if (file_exists(WPDEV_BK_PLUGIN_DIR. '/js/datepick/jquery.datepick-'. substr($locale,0,2) .'.js'))
                    ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/datepick/jquery.datepick-<?php echo substr($locale,0,2); ?>.js"></script>  <?php
            ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/wpdev.bk.js"></script>  <?php
            ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/tooltip/tools.tooltip.min.js"></script>  <?php

            do_action('wpdev_bk_js_write_files')
                    ?> <!-- End Booking Calendar Scripts --> <?php

            //    C S S
            /* ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/js/datepick/wpdev_booking.css" rel="stylesheet" type="text/css" /> <?php /**/
            /*  ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/include/skins/modern-black.css" rel="stylesheet" type="text/css" /> <?php /**/
             //if (isset(get_option( 'booking_skin'))) {
                ?> <link href="<?php echo get_option( 'booking_skin'); ?>" rel="stylesheet" type="text/css" /> <?php
             //} else {
               /*  ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/css/skins/standard.css" rel="stylesheet" type="text/css" /> <?php /**/

             //}
            
            //   Admin and Client
            if($is_admin) { ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/css/admin.css" rel="stylesheet" type="text/css" />  <?php
                            ?>
                            <style type="text/css">
                                #wpdev-booking-general .datepick-inline {
                                    <?php $calendars__count = 1*get_option( 'booking_admin_cal_count'   ); if ($calendars__count>3) {$calendars__count =3;}  ?>
                                   <?php echo ' width:' . (309*$calendars__count) . 'px !important;'; ?>
                                }
                                .datepick-one-month  {height:320px;}
                            </style> <?php
            } else {
                if ( strpos($_SERVER['REQUEST_URI'],'wp-admin/admin.php?') !==false ) {
                    ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/css/admin.css" rel="stylesheet" type="text/css" />  <?php
                }
                ?> <link href="<?php echo WPDEV_BK_PLUGIN_URL; ?>/css/client.css" rel="stylesheet" type="text/css" /> <?php

                // Show dates in diferent colors: aproved and pending dates
                /* if (  get_option( 'booking_dif_colors_approval_pending'   ) == 'Off') { ?>
<style type="text/css">
    div.datepick-inline table.datepick  td.date2approve, div.datepick-inline table.datepick  td.date_approved, div.datepick-inline table.datepick  td.date2approve a, div.datepick-inline table.datepick  td.date_approved a{
        color:#aaa !important;
    }
</style> <?php
                }/**/
            }

        }

        function get_default_type(){
            if( $this->wpdev_bk_pro !== false ) {
                if (( isset( $_GET['booking_type'] )  )  && ($_GET['booking_type'] != '')) $bk_type = $_GET['booking_type'];
                else $bk_type = $this->wpdev_bk_pro->get_default_booking_resource_id();
            } else $bk_type =1;
            return $bk_type;
        }


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // A D M I N    M E N U    P A G E S
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // CONTENT OF THE ADMIN PAGE
        function content_of_booking_page () {
            ?>

<div id="ajax_working"></div>

<div style="display:none;" id="wpdev-bk-dialog-container"><div id="wpdev-bk-dialog" ><div id="wpdev-bk-dialog-content" >

            <!--div id="modal_content1" style="display:none;" class="modal_content_text" >
                <iframe src="http://wpdevelop.com/booking-calendar-professional/#content" style="border:1px solid red; width:1000px;height:500px;padding:0px;margin:0px;"></iframe>
            </div-->

            <div id="modal_content1" style="display:none;" class="modal_content_text" style="" >
            <p style="line-height:25px;text-align:left;"><?php printf(__('This functionality exist at other version of Booking Calendar: %sBooking Calendar Professional%s, %sBooking Calendar Premium%s or %sBooking Calendar Hotel Edition%s.','wpdev-booking'),'<a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank">','</a>','<a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank">','</a>','<a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank">','</a>'); ?></p>
            <p style="line-height:25px;text-align:left;">Please, check feature list for each versions <a href="http://onlinebookingcalendar.com/features/" target="_blank">here</a></p>
            <p style="line-height:25px;text-align:left;">Also, you can test <a href="http://onlinebookingcalendar.com/demo/" target="_blank">online demo</a> of  "<strong>Booking Calendar Premium</strong>" (<a href="http://onlinebookingcalendar.com/wp-admin/admin.php?page=booking/wpdev-booking.phpwpdev-booking" target="_blank">admin panel demo</a> )
or <a href="http://hotel.onlinebookingcalendar.com/" target="_blank">online demo</a> of  "<strong>Booking Calendar Hotel Edition</strong>" (<a href="http://hotel.onlinebookingcalendar.com/wp-admin/admin.php?page=booking/wpdev-booking.phpwpdev-booking" target="_blank">admin panel demo</a> )</p>
            <p style="line-height:25px;text-align:center;padding-top:15px;"><a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank" class="buttonlinktext">Buy now</a></p>
            </div>

</div></div></div>

<script type="text/javascript">   

    jWPDev(document).ready( function(){
        setTimeout("prepare_highlight();",1000);
    });

    function prepare_highlight(){
        jWPDev("td.datepick-days-cell").mouseover(
        function(){
            jWPDev('span').removeClass('admin_calendar_selection');
            td_class = jWPDev(this).attr("class");
            var start_pos = td_class.indexOf("cal4date-");
            if (start_pos > 0) {
                var end_pos = td_class.indexOf(" ",start_pos);
                if (end_pos == -1)  end_pos = td_class.length;
                var td_class_new = td_class.substr((start_pos+9), (end_pos - start_pos-9) );

                jWPDev('span.adate-'+td_class_new).addClass('admin_calendar_selection');
            }
        }
    );
    }

</script>
<div class="clear" style="height:1px;"></div>
            <?php if( $this->wpdev_bk_pro !== false ) $this->wpdev_bk_pro->booking_types_pages();
            else {
              /*  ?>    <div id="help_screeen_pro">
    <div style="clear:both;"></div>
    <div style="margin:0px 5px auto;text-align:left;">
        <img style="margin:0px 0px 0px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/top_line.png" >
    </div>
    <div class="clear" style="height:5px;border-bottom:1px solid #cccccc;"></div>
</div>
<script type="text/javascript">jWPDev('#help_screeen_pro').animate({opacity:1},5000).fadeOut(2000);</script>
                <?php/**/

        ?>  <div style="height:auto;">
                <div class="topmenuitemborder selected_bk_typenew" id="" style="">
                    <?php echo '<a class="bktypetitlenew" style="margin:0px;"  href="#" title="'.__('Standard', 'wpdev-booking').'"    >'  .__('Standard', 'wpdev-booking')  . '</a>'; ?>
                </div>
                <div class="topmenuitemborder " id="bk_type_plus" style="float:left;">
                    <?php echo '<a class="bktypetitlenew tipcy0" style="font-size:12px;"  href="#" onMouseDown="openModalWindow(&quot;modal_content1&quot;);"  title="'.__('Add new booking resource', 'wpdev-booking').'"    >' .  '+ ' .__('Add new booking resource', 'wpdev-booking')  . '</a>'; ?>
                </div>
            </div>
            <div class="clear topmenuitemseparatorv" style="height:0px;clear:both;" ></div>
               <?php

                //echo '<div style="float:right;height:24px;padding:0px;font-size:12px;font-weight:bold;line-height:24px;margin:-24px 0 0;" id="bk_type_plus"><div style="float:left;width:240px;height:20px; padding:0px 3px; vertical-align:top;"><a href="#" onMouseDown="openModalWindow(&quot;modal_content1&quot;);" style="border-color:#455;border:2px solid #899;padding:3px 13px;"   class="bktypetitle" >+ '.__('Add new booking resource', 'wpdev-booking').'  </a></div></div>';
//              echo '<div style="float:right;height:24px;padding:0px 2px 0px;font-size:12px;font-weight:bold;line-height:50px;" id="bk_type_plus"><a href="#" onMouseDown="openModalWindow(&quot;modal_content1&quot;);" style="border-color:#455;border:2px solid ;padding:3px 13px 3px 35px; "   class="bktypetitle" ><div style="font-size:17px;float:left;margin:0px -34px 0px 0px;padding:0 0 0 20px;">+</div> '.__('Add new booking resource', 'wpdev-booking').'  </a></div>';
                //echo '<div class="clear" style="height:20px;border-bottom:1px solid #cccccc;clear:both;"></div>';
            }
            ?>
<div id="ajax_respond"></div>
<div id="table_for_approve">
    <div class="selected_mark"></div><div style="float:right;"><?php
            $bk_type = $this->get_default_type();
            make_bk_action('show_subtype_filter',$bk_type);
            ?></div><h2><?php _e('Approve', 'wpdev-booking'); ?></h2>
            <?php  $res1 = $this->booking_table(0);  ?>
    <div style="float:left;">
        <input class="button-primary" type="button" style="margin:20px 10px;" value="<?php _e('Approve', 'wpdev-booking'); ?>" onclick="javascript:bookingApprove(0,0);" />
        <!--input class="button-primary" type="button" style="margin:20px 10px;" value="<?php _e('Delete', 'wpdev-booking'); ?>" onclick="javascript:bookingApprove(2,0);" /-->
        <input class="button-primary" type="button" style="margin:20px 10px;" value="<?php _e('Cancel', 'wpdev-booking'); ?>"  onclick="javascript:bookingApprove(1,0);"/>
    </div>
    <div style="float:left;border:none;margin-top:18px;"> 
        <div for="denyreason" class="inside_hint"><?php _e('Reason of cancellation here', 'wpdev-booking'); ?><br/></div>
        <input type="text" style="width:350px;" class="has-inside-hint" name="denyreason" id="denyreason" value="">
    </div>
    <div id="admin_bk_messages0"> </div>
    <div class="clear" style="height:1px;"></div>
</div>

            <?php if (! $res1) {
                echo '<div id="no-reservations"  class="warning_message textleft">';
                printf(__('%sThere are no reservations.%s Please, press this %s button, when you edit %sposts%s or %spage%s. %sAfter entering booking you can wait for making  reservation by somebody or you can make reservation %shere%s.', 'wpdev-booking'), '<b>', '</b><br>', '<img src="'.$this->icon_button_url.'" width="16" height="16" align="top">', '<a href="post-new.php">', '</a>', '<a href="page-new.php">', '</a>', '<br>', '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-reservation">', '</a>' );
                echo '</div><div style="clear:both;height:10px;"></div>';
            } ?>

            <?php if (! $res1) { ?><script type="text/javascript">document.getElementById('table_for_approve').style.display="none";jWPDev('#no-reservations').animate({opacity:1},20000).fadeOut(2000);</script><?php } ?>
<?php if ($_GET['booking_type']=='0') {
    ?><script type="text/javascript">jWPDev('#table_for_approve h2').html('<?php _e('All incoming bookings','wpdev-booking'); ?>');</script> <?php
    return;
}?>
            <?php //$bk_type = (string) $bk_type; debuge($bk_type);die;
            /*
            if ( isset($_GET['booking_type']) ) {
                $bk_type = $_GET['booking_type'];
            } else {
                $bk_type = '1';
            }/**/
            ?>

<div id="calendar_booking<?php echo $bk_type; ?>"></div><br><textarea rows="3" cols="50" id="date_booking<?php echo $bk_type; ?>" name="date_booking<?php echo $bk_type; ?>" style="display:none;"></textarea>
<div class="clear" style="height:30px;clear:both;"></div>

<div id="table_approved">
    <div class="reserved_mark"></div><div style="float:right;"><?php
            // $bk_type =1;
            // if ( isset( $_GET['booking_type'] ) ) $bk_type = $_GET['booking_type'];
            make_bk_action('show_subtype_filter',$bk_type);
            ?></div><h2><?php _e('Reserved', 'wpdev-booking'); ?></h2>
            <?php  $res2 = $this->booking_table(1);  ?>
    <div style="float:left;">
        <input class="button-primary" type="button" style="margin:20px 10px;" value="<?php _e('Cancel', 'wpdev-booking'); ?>"  onclick="javascript:bookingApprove(1,1);"/>
    </div>
    <div style="float:left;border:none;margin-top:18px;">
        <div for="cancelreason" class="inside_hint"><?php _e('Reason of cancellation here', 'wpdev-booking'); ?></div>
        <input type="text" style="width:350px;" class="has-inside-hint" name="cancelreason" id="cancelreason" value="">
    </div>
    <div id="admin_bk_messages1"> </div>
    <div class="clear" style="height:20px;"></div>
</div>

            <?php if (! $res2) { ?><script type="text/javascript">document.getElementById('table_approved').style.display="none";</script><?php } ?>

<div  class="copyright_info" style="">
    <div style="width:580px;height:10px;margin:auto;">
        <img alt="" src="<?php echo WPDEV_BK_PLUGIN_URL ; ?>/img/contact-32x32.png"  align="center" style="float:left;">
        <div style="margin: 2px 0px 0px 20px; float: left; text-align: center;">
            <?php _e('More Information about this Plugin can be found at the', 'wpdev-booking');?> <a href="http://onlinebookingcalendar.com/faq/" target="_blank" style="text-decoration:underline;"><?php _e('Booking calendar', 'wpdev-booking');?></a>.<br>
            <a href="http://www.wpdevelop.com" target="_blank" style="text-decoration:underline;"  valign="middle">www.wpdevelop.com</a> <?php _e(' - custom wp-plugins and wp-themes development, WordPress solutions', 'wpdev-booking');?><br>
        </div>
    </div>
</div>

            <?php

                 if( $this->wpdev_bk_pro == false )
                    $support_links = '<div id="support_links">\n\
                        <a href="http://onlinebookingcalendar.com/features/" target="_blank">'.__('Features','wpdev-booking').'</a> |\n\
                        <a href="http://onlinebookingcalendar.com/wp-admin/" target="_blank">'.__('Premium Live Demo','wpdev-booking').'</a> |\n\
                        <a href="http://hotel.onlinebookingcalendar.com/wp-admin/" target="_blank">'.__('Hotel Edition Live Demo','wpdev-booking').'</a> |\n\
                        <a href="http://onlinebookingcalendar.com/faq/" target="_blank">'.__('FAQ','wpdev-booking').'</a> |\n\
                        <a href="mailto:info@wpdevelop.com" target="_blank">'.__('Contact','wpdev-booking').'</a> |\n\
                        <a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank">'.__('Buy now','wpdev-booking').'</a>\n\
                                      </div>';
                 else
                    $support_links = '<div id="support_links">\n\
                        <a href="http://onlinebookingcalendar.com/faq/" target="_blank">'.__('FAQ','wpdev-booking').'</a> |\n\
                        <a href="mailto:info@wpdevelop.com" target="_blank">'.__('Contact','wpdev-booking').'</a>\n\
                                      </div>';

                 ?>

                 <script type="text/javascript">
                     <?php { ?>
                               // var val1 = '<img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $selected_icon; ?>"><br />';
                               // jQuery('div.wrap div.icon32').html(val1);
                                jQuery('#ajax_working').before('<?php echo $support_links; ?>');
                               // jQuery('div.bookingpage h2').html( '<?php echo $selected_title . $settings_text ?>');
                     <?php }  ?>
                </script>

            <?php
        }

        //Content of the Add reservation page
        function content_of_reservation_page() {
            echo '<div id="ajax_working"></div>';
            echo '<div class="clear" style="margin:20px;"></div>';
            echo '<style type="text/css"> a.bktypetitlenew { margin-right:0px; } </style>';
            if( $this->wpdev_bk_pro !== false )  $this->wpdev_bk_pro->booking_types_pages('noedit');
            echo '<div class="clear" style="margin:20px;"></div>';

            echo '<div style="width:450px">';

            $bk_type = $this->get_default_type();
            if (isset($_GET['booking_id'])) {
                // debuge('Edit ' . $_GET['booking_id'] );
            }
            do_action('wpdev_bk_add_form',$bk_type, get_option( 'booking_client_cal_count'));
            echo '</div>';
        }

        //content of    S E T T I N G S     page  - actions runs
        function content_of_settings_page () {

            make_bk_action('wpdev_booking_settings_top_menu');

            ?> <div style="height:1px;clear:both;border-top:1px solid #bbc;"></div>  <?php
            ?> <div id="ajax_respond"></div> <?php
            make_bk_action('wpdev_booking_settings_show_content');

        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // S E T T I N G S     S U P P O R T   F U N C T I O N S  //////////////////////////////////////////////////////////////////////////////////////
        // Show top line menu
        function settings_menu_top_line() { 
            $version = 'free';
            if (class_exists('wpdev_bk_pro'))     $version = 'pro';
            if (class_exists('wpdev_bk_premium')) $version = 'premium';
            if (class_exists('wpdev_bk_hotel'))   $version = 'hotel';
            $selected_title = $_GET['tab']; 
  /*            ?>
<div style="height:1px;clear:both;"></div>

            <?php if ( ($_GET['tab'] == 'main') || (! isset($_GET['tab'])) ) { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
<a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=main" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('General settings', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'General-setting-64x64.png'; } ?></a>
            <?php if ($_GET['tab'] == 'form') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
<a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=form" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('Form fields and content', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'Form-fields-64x64.png'; } ?></a>
            <?php if ($_GET['tab'] == 'email') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
<a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=email" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('Emails', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'E-mail-64x64.png'; } ?></a>

<?php if ( ($version == 'free') || ($version == 'premium') || ($version == 'hotel') ) { ?>
            <?php if ($_GET['tab'] == 'paypal') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
 <a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=paypal" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('Payment and costs', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'Paypal-cost-64x64.png'; } ?></a>
            <?php
 }
if ( ($version == 'free') || ($version == 'hotel') ) {
if ($_GET['tab'] == 'hotel') { $slct_a = 'selected'; } else {$slct_a = '';} ?>
 <a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=hotel" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('Booking resources', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'Booking-resources-64x64.png'; } ?></a>
<?php if ($_GET['tab'] == 'filter') { $slct_a = 'selected'; } else {$slct_a = '';} ?>
 <a href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=filter" class="bk_top_menu <?php echo $slct_a; ?>"><?php $title = __('Season filers', 'wpdev-booking'); echo $title; if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = 'Season-64x64.png'; } ?></a>
<?php
 }

 /**/
            $is_only_icons = ! true;
            ?>
                <style type="text/css">
                     <?php if ($is_only_icons) echo ' #menu-wpdevplugin .nav-tab { padding:4px 2px 6px 32px !important; }'; ?>
                </style>
                 <div style="height:1px;clear:both;margin-top:20px;"></div>
                 <div id="menu-wpdevplugin">
                    <div class="nav-tabs-wrapper">
                        <div class="nav-tabs">

                                <?php $title = __('General', 'wpdev-booking');  $my_icon = 'General-setting-64x64.png'; $my_tab = 'main';  ?>
                                <?php if ( ($_GET['tab'] == 'main') || (! isset($_GET['tab'])) ) { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                <?php $title = __('Fields', 'wpdev-booking');  $my_icon = 'Form-fields-64x64.png'; $my_tab = 'form';  ?>
                                <?php if ($_GET['tab'] == 'form') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                <?php $title = __('Emails', 'wpdev-booking');  $my_icon = 'E-mail-64x64.png'; $my_tab = 'email';  ?>
                                <?php if ($_GET['tab'] == 'email') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                <?php if ( ($version == 'free') || ($version == 'premium') || ($version == 'hotel') ) { ?>

                                    <?php $title = __('Payments', 'wpdev-booking');  $my_icon = 'Paypal-cost-64x64.png'; $my_tab = 'paypal';  ?>
                                    <?php if ($_GET['tab'] == 'paypal') { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                    <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                <?php } ?>

                                <?php if ( ($version == 'free') || ($version == 'hotel') ) { ?>

                                    <?php $title = __('Resources', 'wpdev-booking');  $my_icon = 'Booking-resources-64x64.png'; $my_tab = 'hotel';  ?>
                                    <?php if ($_GET['tab'] == 'hotel') { $slct_a = 'selected'; } else {$slct_a = '';} ?>
                                    <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                    <?php $title = __('Filters', 'wpdev-booking');  $my_icon = 'Season-64x64.png'; $my_tab = 'filter';  ?>
                                    <?php if ($_GET['tab'] == 'filter') { $slct_a = 'selected'; } else {$slct_a = '';} ?>
                                    <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab tipcy" title="<?php echo __('Customization of','wpdev-booking') .' '.strtolower($title). ' '.__('settings','wpdev-booking'); ?>" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>

                                <?php } ?>

                                <?php if ( ($version == 'free')  ) { ?>
                                    <?php $title = __('Buy now', 'wpdev-booking');  $my_icon = 'shopping_trolley.png'; $my_tab = 'buy';  ?>
                                    <?php if ( ($_GET['tab'] == $my_tab)  ) { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                    <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>
                                <?php } elseif ( ($version !== 'hotel') && ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') === FALSE ) ) { ?>
                                    <?php $title = __('Upgrade', 'wpdev-booking');  $my_icon = 'shopping_trolley.png'; $my_tab = 'upgrade';  ?>
                                    <?php if ( ($_GET['tab'] == $my_tab)  ) { $slct_a = 'selected'; } else { $slct_a = ''; } ?>
                                    <?php if ($slct_a == 'selected') { $selected_title = $title; $selected_icon = $my_icon;  ?><span class="nav-tab nav-tab-active"><?php } else { ?><a class="nav-tab" href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking-option&tab=<?php echo $my_tab; ?>"><?php } ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php  if ($is_only_icons) echo '&nbsp;'; else echo $title; ?><?php if ($slct_a == 'selected') { ?></span><?php } else { ?></a><?php } ?>
                                <?php }
                                 //if ($_GET['tab'] == 'upgrade') {  $selected_title = __('Upgrade', 'wpdev-booking');  $selected_icon = ''; }
                                 //if ($_GET['tab'] == 'buy') {  $selected_title = __('Buy now', 'wpdev-booking');  $selected_icon = ''; }
                                 //background:none repeat scroll 0 0 #D54E21;color:#fff;text-shadow:0 -1px 0 #111111;
                                ?>

                        </div>
                    </div>
		</div>
                 <?php if (($_GET['tab'] == 'upgrade') || ($_GET['tab'] == 'buy')) {
                   $settings_text = '' ;
                 } else { $settings_text = ' ' . __('settings');   }
                 if ($version == 'free')
                    $support_links = '<div id="support_links">\n\
                        <a href="http://onlinebookingcalendar.com/features/" target="_blank">'.__('Features','wpdev-booking').'</a> |\n\
                        <a href="http://onlinebookingcalendar.com/wp-admin/" target="_blank">'.__('Premium Live Demo','wpdev-booking').'</a> |\n\
                        <a href="http://hotel.onlinebookingcalendar.com/wp-admin/" target="_blank">'.__('Hotel Edition Live Demo','wpdev-booking').'</a> |\n\
                        <a href="http://onlinebookingcalendar.com/faq/" target="_blank">'.__('FAQ','wpdev-booking').'</a> |\n\
                        <a href="mailto:info@wpdevelop.com" target="_blank">'.__('Contact','wpdev-booking').'</a> |\n\
                        <a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank">'.__('Buy now','wpdev-booking').'</a>\n\
                                      </div>';
                 else
                    $support_links = '<div id="support_links">\n\
                        <a class="live-tipsy" original-title="Its working  Ha ha" href="http://onlinebookingcalendar.com/faq/" target="_blank">'.__('FAQ','wpdev-booking').'</a> |\n\
                        <a href="mailto:info@wpdevelop.com" target="_blank">'.__('Contact','wpdev-booking').'</a>\n\
                                      </div>';

                 ?>

                 <script type="text/javascript">
                     <?php { ?>
                                var val1 = '<img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $selected_icon; ?>"><br />';
                                jQuery('div.wrap div.icon32').html(val1);
                                jQuery('div.bookingpage h2').after('<?php echo $support_links; ?>');
                                jQuery('div.bookingpage h2').html( '<?php echo $selected_title . $settings_text ?>');
                     <?php }  ?>
                </script><?php

        }

        // Show content of settings page . At free version just promo information
        function settings_menu_content() {


            if   ( ! isset($_GET['tab']) )   $this->settings_general_content();
                    $version = 'free';
                    if ($this->wpdev_bk_pro != false ) {
                        $version = 'pro';
                        if ($this->wpdev_bk_pro->wpdev_bk_premium != false)  {
                            $version = 'premium';
                            if ($this->wpdev_bk_pro->wpdev_bk_premium->wpdev_bk_hotel != false)  $version = 'hotel';
                        }
                    }
                    if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) $version = 'free';
            switch ($_GET['tab']) {

                case 'main':   $this->settings_general_content(); break;
                /*case 'faq' :   ?> <div> <div style="height:60px;width:100%;text-align:center;margin:15px auto;font-size:18px;line-height:32px;"><img style="padding:0px 20px 0;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/ajax-loader.gif"> <?php _e('Loading','wpdev-booking'); ?>... </div>
                                  <iframe id="faq" style="height:450px;width:100%;margin: -35px 0px 0px;" src="http://onlinebookingcalendar.com/faq/#content"></iframe></div>
                                <?php break;/**/
                case 'upgrade':

                    if ( ($version !== 'free') && ($version !== 'hotel') ) {
                    ?>
                    <div class="clear" style="height:20px;"></div>
                    <div id="ajax_working"></div>
                    <div id="poststuff" class="metabox-holder">
                        <?php $this->showUpgradeWindow($version); ?>
                    </div>

                    <?php } break;
                case 'buy':  
                    if ( ($version == 'free')   ) {
                    ?>
                    <div class="clear" style="height:20px;"></div>
                    <div id="ajax_working"></div>
                    <div id="poststuff" class="metabox-holder">
                        <?php $this->showBuyWidow(); ?>
                    </div>
                    <?php } break;

            }
            
            if( $this->wpdev_bk_pro !== false )  return;

            switch ($_GET['tab']) {

                case 'form':
                    $this->show_help();
                    ?>
<div style="clear:both;"></div>
<div style="margin:0px 5px auto;text-align:center;">
    <img style="margin:0px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/form_custom_wide.png">
</div>
<div style="clear:both;"></div>
                    <?php
                    return false;
                    break;

                case 'email':
                    $this->show_help();
                    ?>
<div style="clear:both;"></div>
<div style="margin:0px 5px auto;text-align:center;">
    <img style="margin:0px 0px 20px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/emeil_custom_wide.png" >
</div>
<div style="clear:both;"></div>
                    <?php
                    return false;
                    break;
                case 'paypal':
                    $this->show_help('premium');
                    ?>
<div style="clear:both;"></div>
<div style="margin:0px 5px auto;text-align:center;">
    <img style="margin:0px 0px 20px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/paypal_custom_wide.png" >
</div>
<div style="clear:both;"></div>
                    <?php
                    return false;
                    break;
                case 'hotel':
                    $this->show_help('hotel');
                    ?>
<div style="clear:both;"></div>
<div style="margin:0px 5px auto;text-align:center;">
    <img style="margin:0px 0px 20px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/bokking_resources.png" >
</div>
<div style="clear:both;"></div>
                    <?php
                    return false;
                    break;
                case 'filter':
                    $this->show_help('hotel');
                    ?>
<div style="clear:both;"></div>
<div style="margin:0px 5px auto;text-align:center;">
    <img style="margin:0px 0px 20px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/season_filter.png" >
</div>
<div style="clear:both;"></div>
                    <?php
                    return false;
                    break;
                default:
                    return true;
                    break;
            }

            return true;

        }

        // Show window for upgrading
        function showUpgradeWindow($version){
            ?>

                        <div class='meta-box-sortables ui-sortable' id="upgrade-box">
                            <div  id="upgrade-box-title" class="postbox gdrgrid"  ><!--div style="float:right;"><a href="#" onmousedown="javascript:document.getElementById('upgrade-box').style.display='none';"><img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/apple-close.png" /></a></div--> <div title="Click to toggle" class="handlediv"><br></div><h3 class='hndle'><span>Upgrade to <?php if ( ($version == 'pro') ) { ?>Premium /<?php } ?> Hotel Edtion versions</span></h3>

                                <div class="inside">

                                    <p>You can make <strong>upgrade</strong> to the <?php if ( ($version == 'pro') ) { ?><span style="font-weight:normal;">Booking Calendar Premium</span> or<?php } ?> <span style="font-weight:normal;">Booking Calendar Hotel Edition</span>, <strong>paying only difference</strong>: </p>
                                     <?php if ( ($version == 'pro') ) { ?>
                                    <p><span style="color:#FFAA11;font-weight:bold;">Booking Calendar Premium</span> features:</p>
                                    <p style="padding:0px 10px;">
                                        &bull; Bookings for <strong>specific time</strong>  in a day<br/>
                                        &bull; <strong>Online payment</strong> (PayPal support)<br/>
                                        &bull; <strong>Week booking</strong> or any other day range selection bookings<br/>

                                    </p>
                                    <?php } ?>
                                    <p><span style="color:#FF5500;font-weight:bold;">Booking Calendar Hotel Edition</span> features:</p>
                                    <p style="padding:0px 10px;">
                                            &bull; <strong>Multiple booking at the same day.</strong> Day will be availbale untill all items (rooms) are not reserved.<br/>
                                            &bull; <strong>Season filter</strong> flexible definition of days<br/>
                                            &bull; <strong>Availability</strong> Set for each booking resource (un)avalaible days.<br/>
                                            &bull; <strong>Rates</strong> Set higher costs for peak season or discounts for specific days.<br/>
                                    </p>
                                    <?php if ( ($version == 'pro') ) { ?>
                                        <p style="line-height:25px;text-align:center;padding-top:15px;"><a href="http://wpdevelop.com/upgrade-booking-calendar-professional/" target="_blank" class="buttonlinktext">Upgrade</a></p>
                                    <?php } else { ?>
                                        <p style="line-height:25px;text-align:center;padding-top:15px;"><a href="http://wpdevelop.com/upgrade-booking-calendar-premium/" target="_blank" class="buttonlinktext">Upgrade</a></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


            <?php
        }

        // Show window for purchase
        function showBuyWidow(){
            ?>
                <div class='meta-box'>
                    <div  class="postbox gdrgrid" > <h3 class='hndle'><span><?php _e('Professional / Premium / Hotel Edtion versions', 'wpdev-booking'); ?></span></h3>
                        <div class="inside">
                            <p class="sub"><?php _e("Main difference features", 'wpdev-booking'); ?></p>
                            <div class="table">
                                <table><tbody>
                                        <tr class="first">
                                            <td class="first b" style="width: 53px;"><b><?php _e("Features", 'wpdev-booking'); ?></b></td>
                                            <td class="t"></td>
                                            <td class="b options comparision" style="color:#11cc11;"><b><?php _e("Free", 'wpdev-booking'); ?></b></td>
                                            <td class="b options comparision" style="color:#f71;"><b><?php _e("Paid", 'wpdev-booking'); ?></b></td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b" ><?php _e("Functionality", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("all existing functionality", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b" ><?php _e("Multi booking", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("several booking for 1 day", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Time", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("enter the booking time", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Form", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("fields customization", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Email", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("email customization", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Range selection", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("selection fixed several days", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Payment", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<strong><?php _e("PayPal support", 'wpdev-booking'); ?></strong>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Season", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<strong><?php _e("avalaibility filters", 'wpdev-booking'); ?></strong>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Rates cost", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<strong><?php _e("depends from season", 'wpdev-booking'); ?></strong>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Advanced cost", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("Discounts / additional cost", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr class="">
                                            <td class="first b"><?php _e("Several forms", 'wpdev-booking'); ?></td>
                                            <td class="t i">(<?php _e("Several booking forms", 'wpdev-booking'); ?>)</td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;"></td>
                                            <td class="b options comparision" style="text-align:center;color: green; font-weight: bold;">&bull;</td>
                                        </tr>
                                        <tr>
                                            <td class="first b" ><?php _e("Price", 'wpdev-booking'); ?></td>
                                            <td class="t"><?php  ?></td>
                                            <td class="t options comparision" style="border-right:1px solid #ddd;"><?php _e("free", 'wpdev-booking'); ?></td>
                                            <td class="t options comparision"><?php _e("start", 'wpdev-booking'); ?> $119</td>
                                        </tr>
                                        <tr class="last">
                                            <td class="first b" ><?php _e("Live demo", 'wpdev-booking'); ?></td>
                                            <td class="t" colspan="3"> <a href="http://onlinebookingcalendar.com/wp-admin/" target="_blank"> Pro, Premium </a>,
                                                 <a href="http://hotel.onlinebookingcalendar.com/wp-admin/" target="_blank"> Hotel Edtion </a>
                                            </td>

                                        </tr>
                                        <tr class="last">
                                            <!--td class="first b"><span><?php _e("Purchase", 'wpdev-booking'); ?></span></td-->
                                            <td colspan="4" style="text-align:right;font-size: 18px;font-weight:normal;" class="t comparision"> <a class="buttonlinktext"  href="http://wpdevelop.com/booking-calendar-professional/" target="_blank"><?php _e("Buy now", 'wpdev-booking'); ?></a> </td>
                                        </tr>

                                    </tbody></table>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }

        // Show Settings content of main page
        function settings_general_content() {

            if ( isset( $_POST['start_day_weeek'] ) ) {
                $booking_skin  = $_POST['booking_skin'];

                $email_reservation_adress      = htmlspecialchars( str_replace('\"','"',$_POST['email_reservation_adress']));
                $email_reservation_adress      = str_replace("\'","'",$email_reservation_adress);

                $max_monthes_in_calendar =  $_POST['max_monthes_in_calendar'];
                $admin_cal_count  = $_POST['admin_cal_count'];
                $client_cal_count = $_POST['client_cal_count'];
                $start_day_weeek  = $_POST['start_day_weeek'];
                $new_booking_title= $_POST['new_booking_title'];
                $new_booking_title_time= $_POST['new_booking_title_time'];
                $booking_date_format = $_POST['booking_date_format'];
                $booking_date_view_type = $_POST['booking_date_view_type'];
                //$is_dif_colors_approval_pending = $_POST['is_dif_colors_approval_pending'];
                $is_use_hints_at_admin_panel = $_POST['is_use_hints_at_admin_panel'];
                $multiple_day_selections =  $_POST[ 'multiple_day_selections' ];
                $is_delete_if_deactive =  $_POST['is_delete_if_deactive']; // check
                $wpdev_copyright  = $_POST['wpdev_copyright'];             // check
                $is_use_captcha  = $_POST['is_use_captcha'];             // check
                $is_show_legend  = $_POST['is_show_legend'];             // check


                $unavailable_day0  = $_POST['unavailable_day0'];
                $unavailable_day1  = $_POST['unavailable_day1'];
                $unavailable_day2  = $_POST['unavailable_day2'];
                $unavailable_day3  = $_POST['unavailable_day3'];
                $unavailable_day4  = $_POST['unavailable_day4'];
                $unavailable_day5  = $_POST['unavailable_day5'];
                $unavailable_day6  = $_POST['unavailable_day6'];

                $user_role_booking      = $_POST['user_role_booking'];
                $user_role_addbooking   = $_POST['user_role_addbooking'];
                $user_role_settings     = $_POST['user_role_settings'];
                if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) {
                    $user_role_booking      = 'subscriber';
                    $user_role_addbooking   = 'subscriber';
                    $user_role_settings     = 'subscriber';
                }
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////





                update_option( 'booking_user_role_booking', $user_role_booking );
                update_option( 'booking_user_role_addbooking', $user_role_addbooking );
                update_option( 'booking_user_role_settings', $user_role_settings );

                update_option( 'booking_skin',$booking_skin);
                update_option( 'booking_email_reservation_adress' , $email_reservation_adress );
                update_option( 'booking_max_monthes_in_calendar' , $max_monthes_in_calendar );
                
                if (1*$admin_cal_count>12) $admin_cal_count = 12;  if (1*$admin_cal_count< 1) $admin_cal_count = 1;
                update_option( 'booking_admin_cal_count' , $admin_cal_count );
                if (1*$client_cal_count>12) $client_cal_count = 12;  if (1*$client_cal_count< 1) $client_cal_count = 1;
                update_option( 'booking_client_cal_count' , $client_cal_count );
                update_option( 'booking_start_day_weeek' , $start_day_weeek );
                update_option( 'booking_title_after_reservation' , $new_booking_title );
                update_option( 'booking_title_after_reservation_time' , $new_booking_title_time );
                update_option( 'booking_date_format' , $booking_date_format );
                update_option( 'booking_date_view_type' , $booking_date_view_type);
               // if (isset( $is_dif_colors_approval_pending ))   $is_dif_colors_approval_pending = 'On';
               // else                                            $is_dif_colors_approval_pending = 'Off';
               // update_option( 'booking_dif_colors_approval_pending' , $is_dif_colors_approval_pending );

                if (isset( $is_use_hints_at_admin_panel ))   $is_use_hints_at_admin_panel = 'On';
                else                                            $is_use_hints_at_admin_panel = 'Off';
                update_option( 'booking_is_use_hints_at_admin_panel' , $is_use_hints_at_admin_panel );


                if (isset( $multiple_day_selections ))   $multiple_day_selections = 'On';
                else                                     $multiple_day_selections = 'Off';
                update_option( 'booking_multiple_day_selections' , $multiple_day_selections );

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////

                if (isset( $unavailable_day0 ))            $unavailable_day0 = 'On';
                else                                       $unavailable_day0 = 'Off';
                update_option('booking_unavailable_day0' , $unavailable_day0 );
                if (isset( $unavailable_day1 ))            $unavailable_day1 = 'On';
                else                                       $unavailable_day1 = 'Off';
                update_option('booking_unavailable_day1' , $unavailable_day1 );
                if (isset( $unavailable_day2 ))            $unavailable_day2 = 'On';
                else                                       $unavailable_day2 = 'Off';
                update_option('booking_unavailable_day2' , $unavailable_day2 );
                if (isset( $unavailable_day3 ))            $unavailable_day3 = 'On';
                else                                       $unavailable_day3 = 'Off';
                update_option('booking_unavailable_day3' , $unavailable_day3 );
                if (isset( $unavailable_day4 ))            $unavailable_day4 = 'On';
                else                                       $unavailable_day4 = 'Off';
                update_option('booking_unavailable_day4' , $unavailable_day4 );
                if (isset( $unavailable_day5 ))            $unavailable_day5 = 'On';
                else                                       $unavailable_day5 = 'Off';
                update_option('booking_unavailable_day5' , $unavailable_day5 );
                if (isset( $unavailable_day6 ))            $unavailable_day6 = 'On';
                else                                       $unavailable_day6 = 'Off';
                update_option('booking_unavailable_day6' , $unavailable_day6 );

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (isset( $is_delete_if_deactive ))            $is_delete_if_deactive = 'On';
                else                                            $is_delete_if_deactive = 'Off';
                update_option('booking_is_delete_if_deactive' , $is_delete_if_deactive );

                if (isset( $wpdev_copyright ))                  $wpdev_copyright = 'On';
                else                                            $wpdev_copyright = 'Off';
                update_option( 'booking_wpdev_copyright' , $wpdev_copyright );
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                if (isset( $is_use_captcha ))                  $is_use_captcha = 'On';
                else                                           $is_use_captcha = 'Off';
                update_option( 'booking_is_use_captcha' , $is_use_captcha );

                if (isset( $is_show_legend ))                  $is_show_legend = 'On';
                else                                           $is_show_legend = 'Off';
                update_option( 'booking_is_show_legend' , $is_show_legend );


            } else {
                $booking_skin = get_option( 'booking_skin');
                $email_reservation_adress      = get_option( 'booking_email_reservation_adress') ;
                $max_monthes_in_calendar =  get_option( 'booking_max_monthes_in_calendar' );

                $admin_cal_count  = get_option( 'booking_admin_cal_count' );
                $new_booking_title= get_option( 'booking_title_after_reservation' );
                $new_booking_title_time= get_option( 'booking_title_after_reservation_time' );
                $booking_date_format = get_option( 'booking_date_format');
                $booking_date_view_type = get_option( 'booking_date_view_type');
                $client_cal_count = get_option( 'booking_client_cal_count' );
                $start_day_weeek  = get_option( 'booking_start_day_weeek' );
               // $is_dif_colors_approval_pending = get_option( 'booking_dif_colors_approval_pending' );
                $is_use_hints_at_admin_panel    = get_option( 'booking_is_use_hints_at_admin_panel' );
                $multiple_day_selections =  get_option( 'booking_multiple_day_selections' );
                $is_delete_if_deactive =  get_option( 'booking_is_delete_if_deactive' ); // check
                $wpdev_copyright  = get_option( 'booking_wpdev_copyright' );             // check
                $is_use_captcha  = get_option( 'booking_is_use_captcha' );             // check
                $is_show_legend  = get_option( 'booking_is_show_legend' );             // check


                $unavailable_day0 = get_option('booking_unavailable_day0' );
                $unavailable_day1 = get_option('booking_unavailable_day1' );
                $unavailable_day2 = get_option('booking_unavailable_day2' );
                $unavailable_day3 = get_option('booking_unavailable_day3' );
                $unavailable_day4 = get_option('booking_unavailable_day4' );
                $unavailable_day5 = get_option('booking_unavailable_day5' );
                $unavailable_day6 = get_option('booking_unavailable_day6' );

                $user_role_booking      = get_option( 'booking_user_role_booking' );
                $user_role_addbooking   = get_option( 'booking_user_role_addbooking' );
                $user_role_settings     = get_option( 'booking_user_role_settings' );
            }


            ?>
<div class="clear" style="height:20px;"></div>
<div id="ajax_working"></div>
<div id="poststuff" class="metabox-holder">

    <div  style="width:64%; float:left;margin-right:1%;">

        <div class='meta-box'>
            <div  class="postbox" > <h3 class='hndle'><span><?php _e('Settings', 'wpdev-booking'); ?></span></h3>
                <div class="inside">
                    <form  name="post_option" action="" method="post" id="post_option" >
                        <table class="form-table"><tbody>

                                <tr valign="top">
                                    <th scope="row"><label for="booking_skin" ><?php _e('Calendar skin', 'wpdev-booking'); ?>:</label></th>
                                    <td>
                                        <?php
                                            //TODO: Read the conatct from 2 folders and show results at this select box, aqrray with values and names
                                            // Create 2 more skins: one black for freee versions
                                            // One modern light/white for paid versions
                                           $dir_list = $this->dirList( array(  '/css/skins/', '/include/skins/' ) );
                                        ?>
                                        <select id="booking_skin" name="booking_skin" style="text-transform:capitalize;">
                                            <?php foreach ($dir_list as $value) {
                                                if($booking_skin == $value[1]) $selected_item =  'selected="SELECTED"';
                                                else $selected_item='';
                                                echo '<option '.$selected_item.' value="'.$value[1].'" >' .  $value[2] . '</option>';
                                            } ?>
                                        </select>
                                        <span class="description"><?php _e('Select the skin of booking calendar', 'wpdev-booking');?></span>
                                    </td>
                                </tr>


                                <tr valign="top">
                                    <th scope="row"><label for="admin_cal_count" ><?php _e('Admin email', 'wpdev-booking'); ?>:</label></th>
                                    <td><input id="email_reservation_adress"  name="email_reservation_adress" class="regular-text code" type="text" style="width:350px;" size="145" value="<?php echo $email_reservation_adress; ?>" /><br/>
                                        <span class="description"><?php printf(__('Type default %sadmin email%s for checking reservations', 'wpdev-booking'),'<b>','</b>');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="start_day_weeek" ><?php _e('Number of monthes', 'wpdev-booking'); ?>:</label></th>
                                    <td>
                                        <select id="max_monthes_in_calendar" name="max_monthes_in_calendar">

                                            <?php for ($mm = 1; $mm < 13; $mm++) { ?>
                                            <option <?php if($max_monthes_in_calendar == $mm .'m') echo "selected"; ?> value="<?php echo $mm; ?>m"><?php echo $mm ,' '; _e('month(s)', 'wpdev-booking'); ?></option>
                                            <?php } ?>

                                            <?php for ($mm = 1; $mm < 11; $mm++) { ?>
                                            <option <?php if($max_monthes_in_calendar == $mm .'y') echo "selected"; ?> value="<?php echo $mm; ?>y"><?php echo $mm ,' '; _e('year(s)', 'wpdev-booking'); ?></option>
                                            <?php } ?>

                                        </select>
                                        <span class="description"><?php _e('Select your maximum number of monthes at booking calendar', 'wpdev-booking');?></span>
                                    </td>
                                </tr>


                                <tr valign="top">
                                    <th scope="row"><label for="admin_cal_count" ><?php _e('Count of calendars', 'wpdev-booking'); ?>:</label><br><?php printf(__('at %sadmin%s booking page', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                    <td>
                                      <select id="admin_cal_count" name="admin_cal_count">
                                            <?php for ($mm = 1; $mm < 13; $mm++) { ?>
                                            <option <?php if($admin_cal_count == $mm ) echo "selected"; ?> value="<?php echo $mm; ?>"><?php echo $mm  ?></option>
                                            <?php } ?>
                                      </select>
                                      <span class="description"><?php printf(__('Type your number of calendars %sat admin booking page%s', 'wpdev-booking'),'<b>','</b>');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="client_cal_count" ><?php _e('Count of calendars', 'wpdev-booking'); ?>:</label><br><?php printf(__('at %sclient%s side view', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?></th>
                                    <td>
                                      <select id="client_cal_count" name="client_cal_count">
                                            <?php for ($mm = 1; $mm < 13; $mm++) { ?>
                                            <option <?php if($client_cal_count == $mm ) echo "selected"; ?> value="<?php echo $mm; ?>"><?php echo $mm  ?></option>
                                            <?php } ?>
                                      </select>
                                      <span class="description"><?php printf(__('Type your %sdefault count of calendars%s for inserting into post/page', 'wpdev-booking'),'<b>','</b>');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="start_day_weeek" ><?php _e('Start Day of week', 'wpdev-booking'); ?>:</label></th>
                                    <td>
                                        <select id="start_day_weeek" name="start_day_weeek">
                                            <option <?php if($start_day_weeek == '0') echo "selected"; ?> value="0"><?php _e('Sunday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '1') echo "selected"; ?> value="1"><?php _e('Monday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '2') echo "selected"; ?> value="2"><?php _e('Thuesday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '3') echo "selected"; ?> value="3"><?php _e('Wednesday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '4') echo "selected"; ?> value="4"><?php _e('Thursday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '5') echo "selected"; ?> value="5"><?php _e('Friday', 'wpdev-booking'); ?></option>
                                            <option <?php if($start_day_weeek == '6') echo "selected"; ?> value="6"><?php _e('Saturday', 'wpdev-booking'); ?></option>
                                        </select>
                                        <span class="description"><?php _e('Select your start day of the week', 'wpdev-booking');?></span>
                                    </td>
                                </tr>


                                <tr valign="top">
                                    <th scope="row"><label for="booking_date_format" ><?php _e('Date Format', 'wpdev-booking'); ?>:</label></th>
                                    <td>
                                    <fieldset>
                                        <?php
                                        $date_formats =   array( __('F j, Y'), 'Y/m/d', 'm/d/Y', 'd/m/Y' ) ;
                                        $custom = TRUE;
                                        foreach ( $date_formats as $format ) {
                                                echo "\t<label title='" . esc_attr($format) . "'>";
                                                echo "<input type='radio' name='booking_date_format' value='" . esc_attr($format) . "'";
                                                if ( get_option('booking_date_format') === $format ) {  echo " checked='checked'"; $custom = FALSE; }
                                                echo ' /> ' . date_i18n( $format ) . "</label> &nbsp;&nbsp;&nbsp;\n";
                                        }
                                        echo '<div style="height:7px;"></div>';
                                        echo '<label><input type="radio" name="booking_date_format" id="date_format_custom_radio" value="'. $booking_date_format .'"';
                                        if ( $custom )  echo ' checked="checked"';
                                        echo '/> ' . __('Custom', 'wpdev-booking') . ': </label>';?>
                                            <input id="booking_date_format_custom" class="regular-text code" type="text" size="45" value="<?php echo $booking_date_format; ?>" name="booking_date_format_custom" style="line-height:35px;"
                                                   onchange="javascript:document.getElementById('date_format_custom_radio').value = this.value;document.getElementById('date_format_custom_radio').checked=true;"
                                                   />
                                            <?php
                                        echo ' '. date_i18n( $booking_date_format ) . "\n";
                                        echo '&nbsp;&nbsp;';
                                        ?>
                                        <?php printf(__('Type your date format for showing in emeils and booking table. %sDocumentation on date formatting.%s', 'wpdev-booking'),'<br/><a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">','</a>');?>
                                    </fieldset>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="booking_date_view_type" ><?php _e('Dates view', 'wpdev-booking'); ?>:</label></th>
                                    <td>
                                        <select id="booking_date_view_type" name="booking_date_view_type">
                                            <option <?php if($booking_date_view_type == 'short') echo "selected"; ?> value="short"><?php _e('Short days view', 'wpdev-booking'); ?></option>
                                            <option <?php if($booking_date_view_type == 'wide') echo "selected"; ?> value="wide"><?php _e('Wide days view', 'wpdev-booking'); ?></option>
                                        </select>
                                        <span class="description"><?php _e('Select default type of dates view at the booking tables', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <!--tr valign="top">
                                    <th scope="row"><label for="is_dif_colors_approval_pending" ><?php _e('Diferent days color', 'wpdev-booking'); ?>:</label><br><?php _e('Aproved / pending days', 'wpdev-booking'); ?></th>
                                    <td><input id="is_dif_colors_approval_pending" type="checkbox" <?php if ($is_dif_colors_approval_pending == 'On') echo "checked"; ?>  value="<?php echo $is_dif_colors_approval_pending; ?>" name="is_dif_colors_approval_pending"/>
                                        <span class="description"><?php _e(' Check, if you want to show in diferent colors aproved days and pending for aproval days at client side.', 'wpdev-booking');?></span>
                                    </td>
                                </tr-->

                                <tr valign="top">
                                    <th scope="row"><label for="is_use_hints_at_admin_panel" ><?php _e('Show hints', 'wpdev-booking'); ?>:</label><br><?php _e('Show / hide hints', 'wpdev-booking'); ?></th>
                                    <td><input id="is_use_hints_at_admin_panel" type="checkbox" <?php if ($is_use_hints_at_admin_panel == 'On') echo "checked"; ?>  value="<?php echo $is_use_hints_at_admin_panel; ?>" name="is_use_hints_at_admin_panel"/>
                                        <span class="description"><?php _e(' Check, if you want to show help hints at the admin panel.', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="multiple_day_selections" ><?php _e('Multiple days selection', 'wpdev-booking'); ?>:</label><br><?php _e('at calendar', 'wpdev-booking'); ?></th>
                                    <td><input id="multiple_day_selections" type="checkbox" <?php if ($multiple_day_selections == 'On') echo "checked"; ?>  value="<?php echo $multiple_day_selections; ?>" name="multiple_day_selections"/>
                                        <span class="description"><?php _e(' Check, if you want have multiple days selection at calendar.', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="is_use_captcha" ><?php _e('CAPTCHA', 'wpdev-booking'); ?>:</label><br><?php _e('at booking form', 'wpdev-booking'); ?></th>
                                    <td><input id="is_use_captcha" type="checkbox" <?php if ($is_use_captcha == 'On') echo "checked"; ?>  value="<?php echo $is_use_captcha; ?>" name="is_use_captcha"/>
                                        <span class="description"><?php _e(' Check, if you want to activate CAPTCHA inside of booking form.', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="is_show_legend" ><?php _e('Show legend', 'wpdev-booking'); ?>:</label><br><?php _e('at booking calendar', 'wpdev-booking'); ?></th>
                                    <td><input id="is_show_legend" type="checkbox" <?php if ($is_show_legend == 'On') echo "checked"; ?>  value="<?php echo $is_show_legend; ?>" name="is_show_legend"/>
                                        <span class="description"><?php _e(' Check, if you want to show legend of dates under booking calendar.', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <tr valign="top"> <td colspan="2">
                                    <div style="width:100%;">
                                        <span style="color:#21759B;cursor: pointer;font-weight: bold;"
                                           onclick="javascript: jQuery('#togle_settings_thankyou').slideToggle('normal');"
                                           style="text-decoration: none;font-weight: bold;font-size: 11px;">
                                           + <span style="border-bottom:1px dashed #21759B;"><?php _e('Show settings of thank you message', 'wpdev-booking'); ?></span>
                                        </span>
                                    </div>

                                    <table id="togle_settings_thankyou" style="display:none;" class="hided_settings_table">
                                        <tr>
                                            <th>
                                            <label for="new_booking_title" style="font-size:12px;" ><?php _e('New reservation title', 'wpdev-booking'); ?>:</label><br/>
                                            <?php printf(__('%sshowing after%s booking', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?>
                                            </th>
                                            <td>
                                                <input id="new_booking_title" class="regular-text code" type="text" size="45" value="<?php echo $new_booking_title; ?>" name="new_booking_title" style="width:99%;"/>
                                                <span class="description"><?php printf(__('Type title of new reservation %safter booking has done by user%s', 'wpdev-booking'),'<b>','</b>');?></span>
                                            </td>
                                        </tr>
                                        <tr><th>
                                            <label for="new_booking_title" style=" font-weight: bold;font-size: 12px;" ><?php _e('Showing title time', 'wpdev-booking'); ?>:</label><br/>
                                            <?php printf(__('%snew reservation%s', 'wpdev-booking'),'<span style="color:#888;font-weight:bold;">','</span>'); ?>
                                            </th>
                                        <td>
                                            <input id="new_booking_title_time" class="regular-text code" type="text" size="45" value="<?php echo $new_booking_title_time; ?>" name="new_booking_title_time" />
                                            <span class="description"><?php printf(__('Type in miliseconds count of time for showing new reservation title', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>

               
                             
                                <tr valign="top"> <td colspan="2"> 
                                    <div style="width:100%;">
                                        <span style="color:#21759B;cursor: pointer;font-weight: bold;"
                                           onclick="javascript: jQuery('#togle_settings_unavailable').slideToggle('normal');"
                                           style="text-decoration: none;font-weight: bold;font-size: 11px;">
                                           + <span style="border-bottom:1px dashed #21759B;"><?php _e('Show settings of unavailable days of week', 'wpdev-booking'); ?></span>
                                        </span>
                                    </div>

                                    <table id="togle_settings_unavailable" style="display:none;" class="hided_settings_table">
                                        <tr valign="top">
                                            <th scope="row"><label for="is_dif_colors_approval_pending" ><?php _e('Unavailable days', 'wpdev-booking'); ?>:</label></th>
                                            <td>    <div style="float:left;width:100px;border:0px solid red;">
                                                    <input id="unavailable_day0" name="unavailable_day0" <?php if ($unavailable_day0 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day0; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Sunday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day1" name="unavailable_day1" <?php if ($unavailable_day1 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day1; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Monday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day2" name="unavailable_day2" <?php if ($unavailable_day2 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day2; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Thuesday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day3" name="unavailable_day3" <?php if ($unavailable_day3 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day3; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Wednesday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day4" name="unavailable_day4" <?php if ($unavailable_day4 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day4; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Thursday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day5" name="unavailable_day5" <?php if ($unavailable_day5 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day5; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Friday', 'wpdev-booking'); ?></span><br/>
                                                    <input id="unavailable_day6" name="unavailable_day6" <?php if ($unavailable_day6 == 'On') echo "checked"; ?>  value="<?php echo $unavailable_day6; ?>"  type="checkbox" />
                                                    <span class="description"><?php _e('Saturday', 'wpdev-booking'); ?></span>
                                                </div>
                                                <div style="float:left;width:auto;padding:0px 10px;style:0px solid red;">
                                                    <span class="description"><?php _e(' Check unavailable days for your visitors.', 'wpdev-booking');?></span></div>
                                            </td>
                                        </tr>
                                    </table>
                                  </td>
                                </tr>

                                <tr valign="top">
                                    <td colspan="2"><div style="width:100%;">
                                        <span style="color:#21759B;cursor: pointer;font-weight: bold;"
                                           onclick="javascript: jQuery('#togle_settings_useraccess').slideToggle('normal');"
                                           style="text-decoration: none;font-weight: bold;font-size: 11px;">
                                           + <span style="border-bottom:1px dashed #21759B;"><?php _e('Show settings of user access level to admin menu', 'wpdev-booking'); ?></span>
                                        </span>
                                    </div>

                                    <table id="togle_settings_useraccess" style="display:none;" class="hided_settings_table">
                                        <tr valign="top">

                                            <th scope="row"><label for="start_day_weeek" ><?php _e('Booking calendar', 'wpdev-booking'); ?>:</label><br><?php _e('access level', 'wpdev-booking'); ?></th>
                                            <td>
                                                <select id="user_role_booking" name="user_role_booking">
                                                    <option <?php if($user_role_booking == 'subscriber') echo "selected"; ?> value="subscriber" ><?php echo translate_user_role('Subscriber'); ?></option>
                                                    <option <?php if($user_role_booking == 'administrator') echo "selected"; ?> value="administrator" ><?php echo translate_user_role('Administrator'); ?></option>
                                                    <option <?php if($user_role_booking == 'editor') echo "selected"; ?> value="editor" ><?php echo translate_user_role('Editor'); ?></option>
                                                    <option <?php if($user_role_booking == 'author') echo "selected"; ?> value="author" ><?php echo translate_user_role('Author'); ?></option>
                                                    <option <?php if($user_role_booking == 'contributor') echo "selected"; ?> value="contributor" ><?php echo translate_user_role('Contributor'); ?></option>
                                                </select>
                                                <span class="description"><?php _e('Select user access level for this administration page', 'wpdev-booking');?></span>
                                            </td>
                                        </tr>


                                        <tr valign="top">
                                            <th scope="row"><label for="start_day_weeek" ><?php _e('Add booking', 'wpdev-booking'); ?>:</label><br><?php _e('access level', 'wpdev-booking'); ?></th>
                                            <td>
                                                <select id="user_role_addbooking" name="user_role_addbooking">
                                                    <option <?php if($user_role_addbooking == 'subscriber') echo "selected"; ?> value="subscriber" ><?php echo translate_user_role('Subscriber'); ?></option>
                                                    <option <?php if($user_role_addbooking == 'administrator') echo "selected"; ?> value="administrator" ><?php echo translate_user_role('Administrator'); ?></option>
                                                    <option <?php if($user_role_addbooking == 'editor') echo "selected"; ?> value="editor" ><?php echo translate_user_role('Editor'); ?></option>
                                                    <option <?php if($user_role_addbooking == 'author') echo "selected"; ?> value="author" ><?php echo translate_user_role('Author'); ?></option>
                                                    <option <?php if($user_role_addbooking == 'contributor') echo "selected"; ?> value="contributor" ><?php echo translate_user_role('Contributor'); ?></option>
                                                </select>
                                                <span class="description"><?php _e('Select user access level for this administration page', 'wpdev-booking');?></span>
                                            </td>
                                        </tr>


                                        <tr valign="top">
                                            <th scope="row"><label for="start_day_weeek" ><?php _e('Settings', 'wpdev-booking'); ?>:</label><br><?php _e('access level', 'wpdev-booking'); ?></th>
                                            <td>
                                                <select id="user_role_settings" name="user_role_settings">
                                                    <option <?php if($user_role_settings == 'subscriber') echo "selected"; ?> value="subscriber" ><?php echo translate_user_role('Subscriber'); ?></option>
                                                    <option <?php if($user_role_settings == 'administrator') echo "selected"; ?> value="administrator" ><?php echo translate_user_role('Administrator'); ?></option>
                                                    <option <?php if($user_role_settings == 'editor') echo "selected"; ?> value="editor" ><?php echo translate_user_role('Editor'); ?></option>
                                                    <option <?php if($user_role_settings == 'author') echo "selected"; ?> value="author" ><?php echo translate_user_role('Author'); ?></option>
                                                    <option <?php if($user_role_settings == 'contributor') echo "selected"; ?> value="contributor" ><?php echo translate_user_role('Contributor'); ?></option>
                                                </select>
                                                <span class="description"><?php _e('Select user access level for this administration page', 'wpdev-booking');?></span>
                    <?php if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) { ?> <br/><span class="description" style="font-weight: bold;">You do not allow to change this items because right now you test DEMO</span> <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2"><div style="border-bottom:1px solid #cccccc;"></div></td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="is_delete_if_deactive" ><?php _e('Delete booking data', 'wpdev-booking'); ?>:</label><br><?php _e('when plugin deactivated', 'wpdev-booking'); ?></th>
                                    <td><input id="is_delete_if_deactive" type="checkbox" <?php if ($is_delete_if_deactive == 'On') echo "checked"; ?>  value="<?php echo $is_delete_if_deactive; ?>" name="is_delete_if_deactive"/>
                                        <span class="description"><?php _e(' Check, if you want delete booking data during uninstalling plugin.', 'wpdev-booking');?></span>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row"><label for="wpdev_copyright" ><?php _e('Copyright notice', 'wpdev-booking'); ?>:</label></th>
                                    <td><input id="wpdev_copyright" type="checkbox" <?php if ($wpdev_copyright == 'On') echo "checked"; ?>  value="<?php echo $wpdev_copyright; ?>" name="wpdev_copyright"/>
                                        <span class="description"><?php printf(__(' Turn On/Off copyright %s notice at footer of site view.', 'wpdev-booking'),'wpdevelop.com');?></span>
                                    </td>
                                </tr>

                            </tbody></table>

                        <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save Changes', 'wpdev-booking'); ?>" name="Submit"/>
                        <div class="clear" style="height:10px;"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div style="width:35%; float:left;">
            <?php if( $this->wpdev_bk_pro == false ) { ?>
                <?php   $this->showBuyWidow();  ?>

            <?php } ?>
            <?php
                $version = 'free';
                if ($this->wpdev_bk_pro != false ) {
                    $version = 'pro';
                    if ($this->wpdev_bk_pro->wpdev_bk_premium != false)  {
                        $version = 'premium';
                        if ($this->wpdev_bk_pro->wpdev_bk_premium->wpdev_bk_hotel != false)  $version = 'hotel';
                    }
                }
                if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) $version = 'free';
                if ( ($version !== 'free') && ($version!== 'hotel') )
                {
         //               if ($this->wpdev_bk_pro->wpdev_bk_premium->wpdev_bk_hotel == false)  {
             ?>


                    <div class='meta-box-sortables ui-sortable' id="upgrade-box">
                        <div  id="upgrade-box-title" class="postbox gdrgrid closed" style="cursor:pointer !important;" onclick="javascript:jQuery('#upgrade-box-title').removeClass('closed');" ><!--div style="float:right;"><a href="#" onmousedown="javascript:document.getElementById('upgrade-box').style.display='none';"><img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/apple-close.png" /></a></div--> <div title="Click to toggle" class="handlediv"><br></div><h3 class='hndle'><span>Upgrade to <?php if ( ($version == 'pro') ) { ?>Premium /<?php } ?> Hotel Edtion versions</span></h3>
                            
                            <div class="inside">

                                <p>You can make <strong>upgrade</strong> to the <?php if ( ($version == 'pro') ) { ?><span style="font-weight:normal;">Booking Calendar Premium</span> or<?php } ?> <span style="font-weight:normal;">Booking Calendar Hotel Edition</span>, <strong>paying only difference</strong>: </p>
                                 <?php if ( ($version == 'pro') ) { ?>
                                <p><span style="color:#FFAA11;font-weight:bold;">Booking Calendar Premium</span> features:</p>
                                <p style="padding:0px 10px;">
                                    &bull; Bookings for <strong>specific time</strong>  in a day<br/>
                                    &bull; <strong>Online payment</strong> (PayPal support)<br/>
                                    &bull; <strong>Week booking</strong> or any other day range selection bookings<br/>
                                    
                                </p>
                                <?php } ?>
                                <p><span style="color:#FF5500;font-weight:bold;">Booking Calendar Hotel Edition</span> features:</p>
                                <p style="padding:0px 10px;">
                                        &bull; <strong>Multiple booking at the same day.</strong> Day will be availbale untill all items (rooms) are not reserved.<br/>
                                        &bull; <strong>Season filter</strong> flexible definition of days<br/>
                                        &bull; <strong>Availability</strong> Set for each booking resource (un)avalaible days.<br/>
                                        &bull; <strong>Rates</strong> Set higher costs for peak season or discounts for specific days.<br/>
                                </p>
                                <?php if ( ($version == 'pro') ) { ?>
                                    <p style="line-height:25px;text-align:center;padding-top:15px;"><a href="http://wpdevelop.com/upgrade-booking-calendar-professional/" target="_blank" class="buttonlinktext">Upgrade</a></p>
                                <?php } else { ?>
                                    <p style="line-height:25px;text-align:center;padding-top:15px;"><a href="http://wpdevelop.com/upgrade-booking-calendar-premium/" target="_blank" class="buttonlinktext">Upgrade</a></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

            <?php   } ?>

        <div class='meta-box'>
            <div  class="postbox gdrgrid" > <h3 class='hndle'><span><?php _e('Information', 'wpdev-booking'); ?></span></h3>
                <div class="inside">
                    <p class="sub"><?php _e("Info", 'wpdev-booking'); ?></p>
                    <div class="table">
                        <table><tbody>
                                <tr class="first">
                                    <td class="first b" style="width: 133px;"><?php _e("Version", 'wpdev-booking'); ?></td>
                                    <td class="t"><?php _e("release date", 'wpdev-booking'); ?>: <?php echo date ("d.m.Y", filemtime(__FILE__)); ?></td>
                                    <td class="b options" style="color: red; font-weight: bold;"><?php echo WPDEV_BK_VERSION; ?></td>
                                </tr>
                            </tbody></table>
                    </div>
                    <p class="sub"><?php _e("Links", 'wpdev-booking'); ?></p>
                    <div class="table">
                        <table><tbody>
                                <tr class="first">
                                    <td class="first b">Booking Calendar</td>
                                    <td class="t"><?php _e("developer plugin page", 'wpdev-booking'); ?></td>
                                    <td class="t options"><a href="http://wpdevelop.com/wp-plugins/booking-calendar/" target="_blank"><?php _e("visit", 'wpdev-booking'); ?></a></td>
                                </tr>
                                <tr>
                                    <td class="first b"><?php _e('Changelog', 'wpdev-booking'); ?></td>
                                    <td class="t"><?php _e("new features", 'wpdev-booking'); ?></td>
                                    <td class="t options"><a href="http://onlinebookingcalendar.com/changelog/" target="_blank"><?php _e("visit", 'wpdev-booking'); ?></a></td>
                                </tr>
                                <tr>
                                    <td class="first b"><a href="http://onlinebookingcalendar.com/demo/" target="_blank"><?php _e('Online Demo', 'wpdev-booking'); ?></a></td>
                                    <td class="t"><strong><?php _e("Pro and Premium", 'wpdev-booking'); ?></strong></td>
                                    <td class="t options"><a href="http://onlinebookingcalendar.com/wp-admin/" target="_blank"><?php _e("Admin panel", 'wpdev-booking'); ?></a></td>
                                </tr>
                                <tr>
                                    <td class="first b"><a href="http://hotel.onlinebookingcalendar.com/" target="_blank"><?php _e('Online Demo', 'wpdev-booking'); ?></a></td>
                                    <td class="t"><strong><?php _e("Hotel Edition", 'wpdev-booking'); ?></strong></td>
                                    <td class="t options"><a href="http://hotel.onlinebookingcalendar.com/wp-admin/" target="_blank"><?php _e("Admin panel", 'wpdev-booking'); ?></a></td>
                                </tr>
                                <tr>
                                    <td class="first b"><?php _e('WordPress Extend', 'wpdev-booking'); ?></td>
                                    <td class="t"><?php _e("wordpress plugin page", 'wpdev-booking'); ?></td>
                                    <td class="t options"><a href="http://wordpress.org/extend/plugins/booking" target="_blank"><?php _e("visit", 'wpdev-booking'); ?></a></td>
                                </tr>
                            </tbody></table>
                    </div>
                    <p class="sub"><?php _e("Author", 'wpdev-booking'); ?></p>
                    <div class="table">
                        <table><tbody>
                                <tr class="first">
                                    <td class="first b"><span><?php _e("Premium Support", 'wpdev-booking'); ?></span></td>
                                    <td class="t"><?php _e("special plugin customizations", 'wpdev-booking'); ?></td>
                                    <td class="t options"><a href="mailto:info@wpdevelop.com" target="_blank"><?php _e("email", 'wpdev-booking'); ?></a></td>
                                </tr>
                            </tbody></table>
                    </div>

                </div>
            </div>
        </div>


    </div>

            <?php do_action('wpdev_bk_general_settings_end') ?>
            <?php if( $this->wpdev_bk_pro === false )   $is_show_settings = $this->show_blank_advanced_settings(); ?>

</div>
            <?php

        }

        //Show blank Advanced settings
        function show_blank_advanced_settings() { return;
            ?>
<div class="clear" style="height:20px;"></div>

<div  style="width:99%; ">

    <div class='meta-box'>
        <div  class="postbox" > <h3 class='hndle'><span><?php _e('Advanced Settings', 'wpdev-booking'); ?></span></h3>
            <div class="inside">
            <?php $this->show_help(true); ?>
                <div style="clear:both;"></div>
                <div style="margin:0px 5px auto;text-align:center;">
                <!--img style="margin:0px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/range_selection_settings.png" -->
                    <img style="margin:0px 0px 20px auto;" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/help/range_selection_wide.png" >
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
            <?php
        }

        //Show help info
        function show_help($version = 'pro') {
            echo '<div id="no-reservations"  class="info_message textleft" style="font-size:12px;">';
            ?><div style="text-align:center;margin:10px auto;">
            <?php if($version == 'premium') { ?>
   <h2><?php printf(__('This functionality exist at the %sBooking Calendar%s %sPremium%s and %sHotel Edition%s', 'wpdev-booking'),'<span style="color:#fa1;">','</span>', '<a href="http://onlinebookingcalendar.com/wp-admin/" style="color:#FFAA11">','</a>','<a href="http://hotel.onlinebookingcalendar.com/wp-admin/" style="color:#FF5500;">','</a>'); ?></h2>
                <?php } elseif($version == 'hotel') { ?>
   <h2><?php printf(__('This functionality exist at the %sBooking Calendar%s %sHotel Edition%s', 'wpdev-booking'),'<span style="color:#f50;">','</span>', '<a href="http://hotel.onlinebookingcalendar.com/wp-admin/" style="color:#FF5500;">','</a>'); ?></h2>
                <?php } else { ?>
    <h2><?php printf(__('This functionality exist at the %sBooking Calendar%s %sProfessional%s, %sPremium%s and %sHotel Edition%s', 'wpdev-booking'),'<span style="color:#fa1;">','</span>','<a href="http://onlinebookingcalendar.com/wp-admin/" style="color:#11BB11">','</a>','<a href="http://onlinebookingcalendar.com/wp-admin/" style="color:#FFAA11">','</a>','<a href="http://hotel.onlinebookingcalendar.com/wp-admin/" style="color:#FF5500;">','</a>'); ?></h2>
                <?php } ?>
    <h2><?php printf(__('Check %sfeatures%s, test %sonline demo%s and %sbuy%s.', 'wpdev-booking'),
                    '<a href="http://onlinebookingcalendar.com/features/" target="_blank" style="color:#1155bb;text-decoration:underline;">', '</a>',
                    '<a href="http://onlinebookingcalendar.com/demo/" target="_blank" style="color:#1155bb;text-decoration:underline;">', '</a>',
                    '<a href="http://wpdevelop.com/booking-calendar-professional/" target="_blank"  style="color:#1155bb;text-decoration:underline;">', '</a>'
            ); ?></h2>
</div>
            <?php
            echo '</div><div style="clear:both;height:10px;"></div>';
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //   C L I E N T   S I D E
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        function get_booking_form_action($my_boook_type=1,$my_boook_count=1, $my_booking_form = 'standard'){

            $res = $this->add_booking_form_action($my_boook_type,$my_boook_count, 0, $my_booking_form );
            return $res;

        }

        //Show only calendar from action call - wpdev_bk_add_calendar
        function add_calendar_action($bk_type =1, $cal_count =1, $is_echo = 1) {

            $script_code = "<script type='text/javascript'>";
            $script_code .= " my_num_month = ".$cal_count.";";
            $my_boook_count = $cal_count;
            $script_code .= " my_book_type = ".$bk_type.";";
            $my_boook_type = $bk_type;
            $script_code .= "</script>";

            $start_script_code = "<script type='text/javascript'>";
            $start_script_code .= "  jWPDev(document).ready( function(){";
            $start_script_code .= "  var date_approved_par = new Array();";
            $start_script_code .= apply_filters('wpdev_booking_availability_filter', '', $bk_type);


            $start_script_code .= "  date2approve[". $bk_type. "] = [];";
            $dates_and_time_to_approve = $this->get_dates('0', $bk_type);
            $dates_to_approve = $dates_and_time_to_approve[0];
            $times_to_approve = $dates_and_time_to_approve[1];
            $i=-1;
            foreach ($dates_to_approve as $date_to_approve) {
                $i++;

                $td_class =   ($date_to_approve[1]+0). "-" . ($date_to_approve[2]+0). "-". $date_to_approve[0];

                $start_script_code .= " if (typeof( date2approve[". $bk_type. "][ '". $td_class . "' ] ) == 'undefined'){ ";
                $start_script_code .= " date2approve[". $bk_type. "][ '". $td_class . "' ] = [];} ";

                $start_script_code .= "  date2approve[". $bk_type. "][ '". $td_class . "' ][  date2approve[".$bk_type."]['".$td_class."'].length  ] = [".
                        ($date_to_approve[1]+0).", ". ($date_to_approve[2]+0).", ". ($date_to_approve[0]+0).", ".
                        ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                        "];";
            }


            $dates_and_time_to_approve = $this->get_dates('1',$my_boook_type);
            $dates_to_approve = $dates_and_time_to_approve[0];
            $times_to_approve = $dates_and_time_to_approve[1];
            $i=-1;
            foreach ($dates_to_approve as $date_to_approve) {
                $i++;

                $td_class =   ($date_to_approve[1]+0)."-".($date_to_approve[2]+0)."-".($date_to_approve[0]);

                $start_script_code .= " if (typeof( date_approved_par[ '". $td_class . "' ] ) == 'undefined'){ ";
                $start_script_code .= " date_approved_par[ '". $td_class . "' ] = [];} ";

                $start_script_code.=" date_approved_par[ '".$td_class."' ][  date_approved_par['".$td_class."'].length  ] = [".
                        ($date_to_approve[1]+0).",".($date_to_approve[2]+0).",".($date_to_approve[0]+0).", ".
                        ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                        "];";

            }

            $start_script_code .= apply_filters('wpdev_booking_show_rates_at_calendar', '', $bk_type);
            $start_script_code .= apply_filters('wpdev_booking_show_availability_at_calendar', '', $bk_type);
            
            $start_script_code .= "     init_datepick_cal('". $my_boook_type ."', date_approved_par, ".
                    $my_boook_count ." , ".
                    get_option( 'booking_start_day_weeek' ) . "); }); ";
            $start_script_code .= "</script>";

            $start_script_code = apply_filters('wpdev_booking_calendar', $start_script_code , $bk_type);

            $my_result = $script_code .' '
                    .  '<div style="clear:both;height:10px;"></div>'

                    . '<div id="calendar_booking'.$my_boook_type.'">&nbsp;</div><textarea rows="3" cols="50" id="date_booking'.$my_boook_type.'" name="date_booking'.$my_boook_type.'" style="display:none;"></textarea>' .

                    ' ' . $start_script_code ;

            if ( $is_echo )            echo $my_result;
            else                       return $my_result;


        }

        //Show booking form from action call - wpdev_bk_add_form
        function add_booking_form_action($bk_type =1, $cal_count =1, $is_echo = 1, $my_booking_form = 'standard') {
            $script_code = "<script type='text/javascript'>";
            $script_code .= " my_num_month = ".$cal_count.";";
            $my_boook_count = $cal_count;
            $script_code .= " my_book_type = ".$bk_type.";";
            $my_boook_type = $bk_type;
            $script_code .= "</script>";

            $start_script_code = "<script type='text/javascript'>";
            $start_script_code .= "  jWPDev(document).ready( function(){";


            $start_script_code .= "  date2approve[". $bk_type. "] = [];";
            $dates_and_time_to_approve = $this->get_dates('0', $bk_type);
            //$dates_and_time_to_approve = array(array(),array()); // Matteo customization
            $dates_to_approve = $dates_and_time_to_approve[0];
            $times_to_approve = $dates_and_time_to_approve[1];
            $i=-1;
            foreach ($dates_to_approve as $date_to_approve) {
                $i++;

                $td_class =   ($date_to_approve[1]+0). "-" . ($date_to_approve[2]+0). "-". $date_to_approve[0];

                $start_script_code .= " if (typeof( date2approve[". $bk_type. "][ '". $td_class . "' ] ) == 'undefined'){ ";
                $start_script_code .= " date2approve[". $bk_type. "][ '". $td_class . "' ] = [];} ";

                $start_script_code .= "  date2approve[". $bk_type. "][ '". $td_class . "' ][  date2approve[".$bk_type."]['".$td_class."'].length  ] = [".
                        ($date_to_approve[1]+0).", ". ($date_to_approve[2]+0).", ". ($date_to_approve[0]+0).", ".
                        ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                        "];";
            }

            $start_script_code .= "  var date_approved_par = [];";
            $start_script_code .= apply_filters('wpdev_booking_availability_filter', '', $bk_type);
            //$dates_approved = $this->get_dates('1',$my_boook_type);// [ Year, Month,Day ]...
            $dates_and_time_to_approve = $this->get_dates('1', $my_boook_type);
            $dates_approved =   $dates_and_time_to_approve[0];
            $times_to_approve = $dates_and_time_to_approve[1];
            $i=-1;
            foreach ($dates_approved as $date_to_approve) {
                $i++;

                $td_class =   ($date_to_approve[1]+0)."-".($date_to_approve[2]+0)."-".($date_to_approve[0]);

                $start_script_code .= " if (typeof( date_approved_par[ '". $td_class . "' ] ) == 'undefined'){ ";
                $start_script_code .= " date_approved_par[ '". $td_class . "' ] = [];} ";

                $start_script_code.=" date_approved_par[ '".$td_class."' ][  date_approved_par['".$td_class."'].length  ] = [".
                        ($date_to_approve[1]+0).",".($date_to_approve[2]+0).",".($date_to_approve[0]+0).", ".
                        ($times_to_approve[$i][0]+0).", ". ($times_to_approve[$i][1]+0).", ". ($times_to_approve[$i][2]+0).
                        "];";
            }
            
            $start_script_code .= apply_filters('wpdev_booking_show_rates_at_calendar', '', $bk_type);
            $start_script_code .= apply_filters('wpdev_booking_show_availability_at_calendar', '', $bk_type);


//echo $start_script_code; die;
            $start_script_code .= "     init_datepick_cal('". $my_boook_type ."', date_approved_par, ".
                    $my_boook_count ." , ".
                    get_option( 'booking_start_day_weeek' ) . "); }); ";
            $start_script_code .= "</script>";




            $my_result =  $script_code .' ' . $this->get__client_side_booking_content($my_boook_type, $my_booking_form ) . ' ' . $start_script_code ;

            $my_result = apply_filters('wpdev_booking_form', $my_result , $bk_type);
            if ( $is_echo )            echo $my_result;
            else                       return $my_result;


        }

        // Get form
        function get_booking_form($my_boook_type) {
            $my_form =  '<div style="text-align:left;">
                    <p>'.__('First Name (required)', 'wpdev-booking').':<br />  <span class="wpdev-form-control-wrap name'.$my_boook_type.'"><input type="text" name="name'.$my_boook_type.'" value="" class="wpdev-validates-as-required" size="40" /></span> </p>
                    <p>'.__('Last Name (required)', 'wpdev-booking').':<br />  <span class="wpdev-form-control-wrap secondname'.$my_boook_type.'"><input type="text" name="secondname'.$my_boook_type.'" value="" class="wpdev-validates-as-required" size="40" /></span> </p>
                    <p>'.__('Email (required)', 'wpdev-booking').':<br /> <span class="wpdev-form-control-wrap email'.$my_boook_type.'"><input type="text" name="email'.$my_boook_type.'" value="" class="wpdev-validates-as-email wpdev-validates-as-required" size="40" /></span> </p>
                    <p>'.__('Phone', 'wpdev-booking').':<br />            <span class="wpdev-form-control-wrap phone'.$my_boook_type.'"><input type="text" name="phone'.$my_boook_type.'" value="" size="40" /></span> </p>
                    <p>'.__('Details', 'wpdev-booking').':<br />          <span class="wpdev-form-control-wrap details'.$my_boook_type.'"><textarea name="details'.$my_boook_type.'" cols="40" rows="10"></textarea></span> </p>';
            $my_form .=  '<p>[captcha]</p>';
            $my_form .=  '<p><input type="button" value="'.__('Send', 'wpdev-booking').'" onclick="mybooking_submit(this.form,'.$my_boook_type.');" /></p>
                    </div>';

            return $my_form;
        }

        // Get content at client side of  C A L E N D A R
        function get__client_side_booking_content($my_boook_type = 1 , $my_booking_form = 'standard') {

            $nl = '<div style="clear:both;height:10px;"></div>';                                                            // New line
            $calendar  = '<div id="calendar_booking'.$my_boook_type.'">&nbsp;</div>';
            if(  $this->wpdev_bk_pro == false  )   $calendar .= '<div style="font-size:9px;text-align:left;">Powered by <a href="http://onlinebookingcalendar.com" target="_blank">Booking Calendar</a></div>';
            $calendar .= '<textarea rows="3" cols="50" id="date_booking'.$my_boook_type.'" name="date_booking'.$my_boook_type.'" style="display:none;"></textarea>';   // Calendar code
            if (get_option( 'booking_is_show_legend' ) == 'On') { //TODO: check here according legend
                $calendar .= '<div class="block_hints datepick">';
                $calendar .= '<div class="wpdev_hint_with_text"><div class="block_free datepick-days-cell"><a>#</a></div><div class="block_text">- '.__('Available','wpdev-booking') .'</div></div>';
                $calendar .= '<div class="wpdev_hint_with_text"><div class="block_booked date_approved">#</div><div class="block_text">- '.__('Booked','wpdev-booking') .'</div></div>';
                $calendar .= '<div class="wpdev_hint_with_text"><div class="block_pending date2approve">#</div><div class="block_text">- '.__('Pending','wpdev-booking') .'</div></div>';
                //$calendar .= '<div class="block_pending date_cleaning"></div><div class="block_text">- '.__('Cleaning','wpdev-booking') .'</div>';
                if ($this->wpdev_bk_pro !== false)
                    if ($this->wpdev_bk_pro->wpdev_bk_premium !== false)
                        $calendar .= '<div class="wpdev_hint_with_text"><div class="block_time timespartly">#</div><div class="block_text">- '.__('Partly booked','wpdev-booking') .'</div></div>';
                $calendar .= '</div><div class="wpdev_clear_hint"></div>';
            }
            $form = '<div id="booking_form_div'.$my_boook_type.'" class="booking_form_div">';

            if(  $this->wpdev_bk_pro !== false  )   $form .= $this->wpdev_bk_pro->get_booking_form($my_boook_type, $my_booking_form);         // Get booking form
            else                                    $form .= $this->get_booking_form($my_boook_type);

            // Insert calendar into form
            if ( strpos($form, '[calendar]') !== false ) { $form = str_replace('[calendar]', $calendar ,$form); }
            else                                         { $form = $calendar . $nl . $form ; }

            if ( strpos($form, '[captcha]') !== false ) {
                $captcha = $this->createCapthaContent($my_boook_type);
                $form =str_replace('[captcha]', $captcha ,$form);
            }

            $form = apply_filters('wpdev_booking_form_content', $form , $my_boook_type);
            // Add booking type field
            $form      .= '<input id="bk_type'.$my_boook_type.'" name="bk_type'.$my_boook_type.'" class="" type="hidden" value="'.$my_boook_type.'" /></div>';
            $submitting = '<div id="submiting'.$my_boook_type.'"></div><div class="form_bk_messages" id="form_bk_messages'.$my_boook_type.'" ></div>';

            $res = $form . $submitting;

            $my_random_id = time() * rand(0,1000);
            
            $return_form = '<div id="'.$my_random_id.'"><form name="booking_form'.$my_boook_type.'" class="booking_form" id="booking_form'.$my_boook_type.'"  method="post" action=""><div id="ajax_respond_insert'.$my_boook_type.'"></div>' .
                    $res . '</form></div>';
            // Check according already shown Booking Calendar  and set do not visible of it
            $return_form .= '<script type="text/javascript">
                                jWPDev(document).ready( function(){
                                    for (var i=0;i<visible_booking_id_on_page.length;i++){
                                      if ( visible_booking_id_on_page[i]=="booking_form_div'.$my_boook_type.'" ) {
                                          document.getElementById("'.$my_random_id.'").innerHTML = "'.__('Booking calendar for this booking resource are already at the page','wpdev-booking').'";
                                          jWPDev("#'.$my_random_id.'").fadeOut(5000);
                                          return;
                                      }
                                    }
                                    visible_booking_id_on_page[visible_booking_id_on_page.length]="booking_form_div'.$my_boook_type.'";
                                });
                            </script>';
            return $return_form;
        }

        // Replace MARK at post with content at client side   -----    [booking nummonths='1' type='1']
        function booking_shortcode($attr) {
            $my_boook_count = get_option( 'booking_client_cal_count' );
            $my_boook_type = 1;
            $my_booking_form = 'standard';
            if ( isset( $attr['nummonths'] ) ) {
                $my_boook_count = $attr['nummonths'];
            }
            if ( isset( $attr['type'] ) ) {
                $my_boook_type = $attr['type'];
            }
            if ( isset( $attr['form_type'] ) ) {
                $my_booking_form = $attr['form_type'];
            }
            $res = $this->add_booking_form_action($my_boook_type,$my_boook_count, 0 , $my_booking_form );
            return $res;
        }

        // Replace MARK at post with content at client side   -----    [booking nummonths='1' type='1']
        function booking_calendar_only_shortcode($attr) {
            $my_boook_count = get_option( 'booking_client_cal_count' );
            $my_boook_type = 1;
            if ( isset( $attr['nummonths'] ) ) {
                $my_boook_count = $attr['nummonths'];
            }
            if ( isset( $attr['type'] ) ) {
                $my_boook_type = $attr['type'];
            }
            $res = $this->add_calendar_action($my_boook_type,$my_boook_count, 0 );
            return $res;
        }




        // Head of Client side - including JS Ajax function
        function client_side_print_booking_head() {
            // Write calendars script
            $this->print_js_css(0);
        }

        // Write copyright notice if its saved
        function wp_footer() {
            if ( ( get_option( 'booking_wpdev_copyright' )  == 'On' ) && (! defined('WPDEV_COPYRIGHT')) ) {
                printf(__('%sPowered by wordpress plugins developed by %s', 'wpdev-booking'),'<span style="font-size:9px;text-align:center;margin:0 auto;">','<a href="http://www.wpdevelop.com" target="_blank">www.wpdevelop.com</a></span>','&amp;');
                define('WPDEV_COPYRIGHT',  1 );
            }
        }

        ///   A C T I V A T I O N   A N D   D E A C T I V A T I O N    O F   T H I S   P L U G I N  ///////////////////////////////////////////////////////////

        // Activate
        function wpdev_booking_activate() {
            if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) add_option( 'booking_admin_cal_count' ,'3');
            else                                                                       add_option( 'booking_admin_cal_count' ,'2');
            add_option( 'booking_skin', WPDEV_BK_PLUGIN_URL . '/css/skins/standard.css');
            add_option( 'booking_max_monthes_in_calendar', '1y');
            add_option( 'booking_client_cal_count', '1' );
            add_option( 'booking_start_day_weeek' ,'0');
            add_option( 'booking_title_after_reservation' , sprintf(__('Thank you for your online reservation. %s We will send confirmation of your booking as soon as possible.', 'wpdev-booking'), '<br/>') );
            add_option( 'booking_title_after_reservation_time' , '7000' );
            add_option( 'booking_date_format' , get_option('date_format') );
            add_option( 'booking_date_view_type', 'short');    // short / wide
            if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) add_option( 'booking_is_delete_if_deactive' ,'On'); // check
            else                                                                       add_option( 'booking_is_delete_if_deactive' ,'Off'); // check
            add_option( 'booking_dif_colors_approval_pending' , 'On' );
            add_option( 'booking_is_use_hints_at_admin_panel' , 'On' );
            add_option( 'booking_multiple_day_selections' , 'On');

            add_option('booking_unavailable_day0' ,'Off');
            add_option('booking_unavailable_day1' ,'Off');
            add_option('booking_unavailable_day2' ,'Off');
            add_option('booking_unavailable_day3' ,'Off');
            add_option('booking_unavailable_day4' ,'Off');
            add_option('booking_unavailable_day5' ,'Off');
            add_option('booking_unavailable_day6' ,'Off');

            if ( strpos($_SERVER['HTTP_HOST'],'onlinebookingcalendar.com') !== FALSE ) {
                add_option( 'booking_user_role_booking', 'subscriber' );
                add_option( 'booking_user_role_addbooking', 'subscriber' );
                add_option( 'booking_user_role_settings', 'subscriber' );
            } else {
                add_option( 'booking_user_role_booking', 'editor' );
                add_option( 'booking_user_role_addbooking', 'editor' );
                add_option( 'booking_user_role_settings', 'administrator' );
            }
            $blg_title = get_option('blogname'); $blg_title = str_replace('"', '', $blg_title);$blg_title = str_replace("'", '', $blg_title);

            add_option( 'booking_email_reservation_adress', htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_reservation_from_adress', htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_reservation_subject',__('New reservation', 'wpdev-booking'));
            add_option( 'booking_email_reservation_content',htmlspecialchars(sprintf(__('You need to approve new reservation %s for: %s Person detail information:%s Currently new booking is waiting for approval. Please visit the moderation panel%sThank you, %s', 'wpdev-booking'),'[bookingtype]','[dates]<br/><br/>','<br/> [content]<br/><br/>',' [moderatelink]<br/><br/>',$blg_title.'<br/>[siteurl]')));

            add_option( 'booking_email_approval_adress',htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_approval_subject',__('Your reservation has been approved', 'wpdev-booking'));
            add_option( 'booking_email_approval_content',htmlspecialchars(sprintf(__('Your reservation %s for: %s has been approved.%sThank you, %s', 'wpdev-booking'),'[bookingtype]','[dates]','<br/><br/>[content]<br/><br/>',$blg_title.'<br/>[siteurl]')));

            add_option( 'booking_email_deny_adress',htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_deny_subject',__('Your reservation has been declined', 'wpdev-booking'));
            add_option( 'booking_email_deny_content',htmlspecialchars(sprintf(__('Your reservation %s for: %s has been  canceled. %sThank you, %s', 'wpdev-booking'),'[bookingtype]','[dates]','<br/><br/>[denyreason]<br/><br/>[content]<br/><br/>',$blg_title.'<br/>[siteurl]')));

            add_option( 'booking_is_email_reservation_adress', 'On' );
            add_option( 'booking_is_email_approval_adress', 'On' );
            add_option( 'booking_is_email_deny_adress', 'On' );



            add_option('booking_widget_title', __('Booking form', 'wpdev-booking') );
            add_option('booking_widget_show', 'booking_form' );
            add_option('booking_widget_type', '1' );
            add_option('booking_widget_calendar_count',  '1');
            add_option('booking_widget_last_field','');

            add_option( 'booking_wpdev_copyright','Off' );
            add_option( 'booking_is_use_captcha' , 'Off' );
            add_option( 'booking_is_show_legend' , 'Off' );

            // Create here tables which is needed for using plugin
            global $wpdb;
            $charset_collate = '';
            if ( $wpdb->has_cap( 'collation' ) ) {
                if ( ! empty($wpdb->charset) ) $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
                if ( ! empty($wpdb->collate) ) $charset_collate .= " COLLATE $wpdb->collate";
            }

            $wp_queries = array();
            if ( ! $this->is_table_exists('booking') ) { // Cehck if tables not exist yet

                $wp_queries[] = "CREATE TABLE ".$wpdb->prefix ."booking (
                         booking_id bigint(20) unsigned NOT NULL auto_increment,
                         form text NOT NULL,
                         booking_type bigint(10) NOT NULL default 1,
                         PRIMARY KEY  (booking_id)
                        ) $charset_collate;";
            } elseif  ($this->is_field_in_table_exists('booking','form') == 0) {
                $simple_sql = "ALTER TABLE ".$wpdb->prefix ."booking ADD form TEXT NOT NULL AFTER booking_id";
                $wpdb->query($simple_sql);
            }

            if ( ! $this->is_table_exists('bookingdates') ) { // Cehck if tables not exist yet
                $wp_queries[] = "CREATE TABLE ".$wpdb->prefix ."bookingdates (
                         booking_id bigint(20) unsigned NOT NULL,
                         booking_date datetime NOT NULL default '0000-00-00 00:00:00',
                         approved bigint(20) unsigned NOT NULL default 0
                        ) $charset_collate;";


                if( $this->wpdev_bk_pro == false ) {
                    $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."booking ( form ) VALUES (
                         'text^name1^Jony~text^secondname1^Smith~text^email1^example-free@wpdevelop.com~text^phone1^8(038)458-77-77~textarea^details1^Reserve a room with sea view' );";
                }
            }

            if (count($wp_queries)>0) {
                foreach ($wp_queries as $wp_q)
                    $wpdb->query($wp_q);

                if( $this->wpdev_bk_pro == false ) {
                    $temp_id = $wpdb->insert_id;
                    $wp_queries_sub = "INSERT INTO ".$wpdb->prefix ."bookingdates (
                             booking_id,
                             booking_date
                            ) VALUES
                            ( ". $temp_id .", CURDATE()+ INTERVAL 2 day ),
                            ( ". $temp_id .", CURDATE()+ INTERVAL 3 day ),
                            ( ". $temp_id .", CURDATE()+ INTERVAL 4 day );";
                    $wpdb->query($wp_queries_sub);
                }
            }



            // if( $this->wpdev_bk_pro !== false )  $this->wpdev_bk_pro->pro_activate();
            make_bk_action('wpdev_booking_activation');
        }

        // Deactivate
        function wpdev_booking_deactivate() {

            $is_delete_if_deactive =  get_option( 'booking_is_delete_if_deactive' ); // check

            if ($is_delete_if_deactive == 'On') {
                // Delete here tables and options, which are needed for using plugin
                delete_option( 'booking_skin');
                delete_option( 'booking_max_monthes_in_calendar');
                delete_option( 'booking_admin_cal_count' );
                delete_option( 'booking_client_cal_count' );
                delete_option( 'booking_start_day_weeek' );
                delete_option( 'booking_title_after_reservation');
                delete_option( 'booking_title_after_reservation_time');
                delete_option( 'booking_date_format');
                delete_option( 'booking_date_view_type');
                delete_option( 'booking_is_delete_if_deactive' ); // check
                delete_option( 'booking_wpdev_copyright' );             // check
                delete_option( 'booking_is_use_captcha' );
                delete_option( 'booking_is_show_legend' );
                delete_option( 'booking_dif_colors_approval_pending'   );
                delete_option( 'booking_is_use_hints_at_admin_panel'  );
                delete_option( 'booking_multiple_day_selections' );

                delete_option('booking_unavailable_day0' );
                delete_option('booking_unavailable_day1' );
                delete_option('booking_unavailable_day2' );
                delete_option('booking_unavailable_day3' );
                delete_option('booking_unavailable_day4' );
                delete_option('booking_unavailable_day5' );
                delete_option('booking_unavailable_day6' );

                delete_option( 'booking_user_role_booking' );
                delete_option( 'booking_user_role_addbooking' );
                delete_option( 'booking_user_role_settings' );


                delete_option( 'booking_email_reservation_adress');
                delete_option( 'booking_email_reservation_from_adress');
                delete_option( 'booking_email_reservation_subject');
                delete_option( 'booking_email_reservation_content');

                delete_option( 'booking_email_approval_adress');
                delete_option( 'booking_email_approval_subject');
                delete_option( 'booking_email_approval_content');

                delete_option( 'booking_email_deny_adress');
                delete_option( 'booking_email_deny_subject');
                delete_option( 'booking_email_deny_content');

                delete_option( 'booking_is_email_reservation_adress'  );
                delete_option( 'booking_is_email_approval_adress'  );
                delete_option( 'booking_is_email_deny_adress'  );

                delete_option('booking_widget_title');
                delete_option('booking_widget_show');
                delete_option('booking_widget_type');
                delete_option('booking_widget_calendar_count');
                delete_option('booking_widget_last_field');

                global $wpdb;
                $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'booking');
                $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'bookingdates');

                make_bk_action('wpdev_booking_deactivation');
            }
        }

    }
}


$wpdev_bk = new wpdev_booking();


//  S u p p o r t    f u n c t i o n s       /////////////////////////////////////////////////////////////////////////////////////////////////////////

function get_booking_form_show() {
    return '<div style="text-align:left">
            <strong>'.__('First Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[name]</span><br/>
            <strong>'.__('Last Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[secondname]</span><br/>
            <strong>'.__('Email', 'wpdev-booking').'</strong>:<span class="fieldvalue">[email]</span><br/>
            <strong>'.__('Phone', 'wpdev-booking').'</strong>:<span class="fieldvalue">[phone]</span><br/>
            <strong>'.__('Details', 'wpdev-booking').'</strong>:<br /><span class="fieldvalue"> [details]</span>
            </div>';
}


function get_form_content ($formdata, $bktype =-1 ) {

    if ($bktype == -1) {
        if (function_exists('get__default_type')) $bktype = get__default_type();
        else $bktype=1;
    }
    if (function_exists ('get_booking_title')) $booking_form_show  = get_option( 'booking_form_show' );
    else                                       $booking_form_show  = get_booking_form_show();
    //debuge($booking_form_show, $formdata, $bktype);
    $formdata_array = explode('~',$formdata);
    $formdata_array_count = count($formdata_array);
    $email_adress='';
    $name_of_person = '';
    $secondname_of_person = '';
    $select_box_selected_items = array();
    $check_box_selected_items = array();
    $all_fields_array = array();
    $checkbox_values=array();
    for ( $i=0 ; $i < $formdata_array_count ; $i++) {
        $elemnts = explode('^',$formdata_array[$i]);
        //debuge($elemnts);
        $type = $elemnts[0];
        $element_name = $elemnts[1];
        $value = $elemnts[2];

        $count_pos = strlen( $bktype );
        //debuge(substr( $elemnts[1], 0, -1*$count_pos ))                ;
        $type_name = $elemnts[1];
        $type_name = str_replace('[]','',$type_name);
        if ($bktype == substr( $type_name,  -1*$count_pos ) ) $type_name = substr( $type_name, 0, -1*$count_pos ); // $type_name = str_replace($bktype,'',$elemnts[1]);
        if ( $type_name == 'email'   ) { $email_adress = $value;   }
        if ( $type_name == 'name'    ) { $name_of_person = $value; }
        if ( $type_name == 'secondname'    ) { $secondname_of_person = $value; }
        if ( $type_name == 'visitors') { $visitors_count = $value; }

        if ($type == 'checkbox') {

            if ($value == 'true')     { $value = __('yes', 'wpdev-booking'); }
            if ($value == 'false')    { $value = __('no', 'wpdev-booking'); }

            if ( ($value !='') && ( $value != __('no', 'wpdev-booking') ) )
                if ( is_array($checkbox_value[ str_replace('[]','',(string) $element_name) ]) ) {
                    $checkbox_value[ str_replace('[]','',(string) $element_name) ][] = $value;
                } else {
                    if ($value != __('yes', 'wpdev-booking') )
                        $checkbox_value[ str_replace('[]','',(string) $element_name) ] = array($value);
                    else
                        $checkbox_value[ str_replace('[]','',(string) $element_name) ] = 'checkbox';
                }

            $value = $value .' ' . '['. $type_name .']';
            
        }
        if ($type == 'select-one') { // add all select box selected items to return array
            $select_box_selected_items[$type_name] = $value;
        }

        if ($type == 'checkbox')  {
            $all_fields_array[ str_replace('[]','',(string) $element_name) ] = $checkbox_value[ str_replace('[]','',(string) $element_name) ];
            $check_box_selected_items[$type_name] = $checkbox_value[ str_replace('[]','',(string) $element_name) ];
        } else                      $all_fields_array[ str_replace('[]','',(string) $element_name) ] = $value;

        $booking_form_show = str_replace( '['. $type_name .']', $value ,$booking_form_show);
    }

    // Remove all shortcodes, which is not replaced early.
    $booking_form_show = preg_replace ('/[\s]{0,}\[[a-zA-Z0-9.,-_]{0,}\][\s]{0,}/', '', $booking_form_show);

    $return_array =   array('content' => $booking_form_show, 'email' => $email_adress, 'name' => $name_of_person, 'secondname' => $secondname_of_person , 'visitors' => $visitors_count ,'_all_' => $all_fields_array  ) ;

   foreach ($select_box_selected_items as $key=>$value) {
        if (! isset($return_array[$key])) {
            $return_array[$key] = $value;
        }
    }
    foreach ($check_box_selected_items as $key=>$value) {
        if (! isset($return_array[$key])) {
            $return_array[$key] = $value;
        }
    }
    //debuge($return_array);
    return $return_array ;

}


// this function is fixing bug with PHP4 - "Fatal error: Nesting level too deep - recursive dependency"
function show_booking_widget_php4($args) {
    extract($args);

    $booking_widget_title = get_option('booking_widget_title');
    $booking_widget_show  =  get_option('booking_widget_show');

    $booking_widget_type  =  get_option('booking_widget_type');
    if ($booking_widget_type === false)  $booking_widget_type=1;


    $booking_widget_calendar_count  =  get_option('booking_widget_calendar_count');
    $booking_widget_last_field  =  get_option('booking_widget_last_field');

    echo $before_widget;
    echo $before_title . htmlspecialchars_decode($booking_widget_title) . $after_title;

    echo "<div style='float:left;margin:10px 0px;' >";
    if ($booking_widget_show == 'booking_form') {
        do_action('wpdev_bk_add_form', $booking_widget_type , $booking_widget_calendar_count);
    } else {
        do_action('wpdev_bk_add_calendar', $booking_widget_type , $booking_widget_calendar_count);
    }

    if ($booking_widget_last_field !== '') echo '<br/>' . htmlspecialchars_decode($booking_widget_last_field);
    echo "</div>";

    echo $after_widget;
}


// A J A X     R e s p o n d e r   Real Ajax with jWPDev sender     //////////////////////////////////////////////////////////////////////////////////
function wpdev_bk_ajax_responder() {
    if (!function_exists ('adebug')) {
        function adebug() {
            $var = func_get_args();
            echo "<div style='text-align:left;background:#ffffff;border: 1px dashed #ff9933;font-size:11px;line-height:15px;font-family:'Lucida Grande',Verdana,Arial,'Bitstream Vera Sans',sans-serif;'><pre>";
            print_r ( $var );
            echo "</pre></div>";
        }
    }

    global $wpdb;

    // Change date format
    function change_date_format( $mydates ) {
//adebug($mydates);
        $mydates = explode(',',$mydates);
        $mydates_result = '';

        $date_format = get_option( 'booking_date_format');
        $time_format = get_option( 'booking_time_format');
        if ( $time_format !== false  ) $time_format = ' ' . $time_format;
        else                           $time_format='';

        if ($date_format == '') $date_format = "d.m.Y";

        foreach ($mydates as $dt) {
            $dt = trim($dt);
            $dta = explode(' ',$dt);
            $tms = $dta[1];
            $tms = explode(':' , $tms);
            $dta = $dta[0];
            $dta = explode('-',$dta);

            $date_format_now = $date_format . $time_format;
            if ($tms == array('00','00','00'))     $date_format_now = $date_format;

            //   H        M        S        M        D        Y
            //$mydates_result .= date($date_format_now, mktime($tms[0], $tms[1], $tms[2], $dta[1], $dta[2], $dta[0])) . ', ';
            $mydates_result .= date_i18n($date_format_now, mktime($tms[0], $tms[1], $tms[2], $dta[1], $dta[2], $dta[0])) . ', ';

            /*
           if ($is_day_before_month) {
                                                      // H  M  S     M        D        Y
            $mydates_result .= date($date_format, mktime(0, 0, 0, $dta[1], $dta[0], $dta[2])) . ', ';
           } else {
            $mydates_result .= date($date_format, mktime(0, 0, 0, $dta[0], $dta[1], $dta[2])) . ', ';
           }/**/
        }
//adebug($mydates_result);
        return substr($mydates_result,0,-2);
    }

    // Get dates 4 emeil
    function get_dates_str ($approved_id_str) {
        global $wpdb;
        $dates_approve = $wpdb->get_results(
                "SELECT DISTINCT booking_date FROM ".$wpdb->prefix ."bookingdates WHERE  booking_id IN ($approved_id_str) ORDER BY booking_date" );
        $dates_str = '';
        // loop with all dates which is selected by someone
        foreach ($dates_approve as $my_date) {
            /*$my_date = explode(' ',$my_date->booking_date);
                $my_date = explode('-',$my_date[0]);/**/
//adebug($my_date->booking_date);
            if ($dates_str != '') $dates_str .= ', ';
            $dates_str .= $my_date->booking_date;//$my_date[1] . '.' .$my_date[2] . '.' . $my_date[0];
        }
//adebug($dates_str);
        return $dates_str;
    }


    // Check if nowday is tommorow from previosday
    function is_next_day($nowday, $previosday) {

        $nowday_d = (date('m.d.Y',  mysql2date('U', $nowday ))  );
        $prior_day = (date('m.d.Y',  mysql2date('U', $previosday ))  );
        if ($prior_day == $nowday_d)    return true;                // if its the same date


        $previos_array = (date('m.d.Y',  mysql2date('U', $previosday ))  );
        $previos_array = explode('.',$previos_array);
        $prior_day =  date('m.d.Y' , mktime(0, 0, 0, $previos_array[0], ($previos_array[1]+1), $previos_array[2] ));


        if ($prior_day == $nowday_d)    return true;                // zavtra
        else                            return false;               // net
    }

    // Get days in short format view
    function get_dates_short_format( $days ){  // $days - string with comma seperated dates

        $days = explode(',', $days);

        $previosday = false;
        $result_string = '';
        $last_show_day = '';

        foreach ($days as $day) {
            $is_fin_at_end = false;
            if ($previosday !== false) {            // Not first day
                if ( is_next_day($day, $previosday) ) {
                    $previosday = $day;                        // Set previos day for next loop
                    $is_fin_at_end = true;
                } else {
                   if ($last_show_day !== $previosday) {      // check if previos day was show or no
                        $result_string .= ' - ' . change_date_format($previosday); // assign in needed format this day
                   }
                   $result_string .= ', ' . change_date_format($day); // assign in needed format this day
                   $previosday = $day;                        // Set previos day for next loop
                   $last_show_day = $day;
                }
            } else {                                 // First day
                $result_string = change_date_format($day); // assign in needed format first day
                $last_show_day = $day;
                $previosday = $day;                        // Set previos day for next loop
            }
        }

        if ($is_fin_at_end) {   $result_string .= ' - ' . change_date_format($day); } // assign in needed format this day

        return $result_string;
    }


    function createDateRangeArray($strDateFrom,$strDateTo) {

          $aryRange=array();
          $strDateFrom = explode('.', $strDateFrom);
          $strDateTo = explode('.', $strDateTo);
          $iDateFrom=mktime(1,0,0, ($strDateFrom[1]+0),     ($strDateFrom[0]+0),($strDateFrom[2]+0));
          $iDateTo=mktime(1,0,0,($strDateTo[1]+0),     ($strDateTo[0]+0), ($strDateTo[2]+0));

          if ($iDateTo>=$iDateFrom) {
            array_push($aryRange,date('d.m.Y',$iDateFrom)); // first entry

            while ($iDateFrom<$iDateTo) {
              $iDateFrom+=86400; // add 24 hours
              array_push($aryRange,date('d.m.Y',$iDateFrom));
            }
          }
          $aryRange = implode(', ', $aryRange);
          return $aryRange;
    }

    $action = $_POST['ajax_action'];
    switch ( $action ) :

        case  'INSERT_INTO_TABLE':

            $dates = $_POST[ "dates" ];
            $bktype = $_POST[  "bktype" ];
            $formdata = $_POST["form"];
            $my_booking_id = (int) $_POST["my_booking_id"];
            $is_approved_dates = '0';
//adebug($dates);

            if (strpos($dates,' - ')!== FALSE){
                $dates =explode(' - ', $dates );
//adebug($dates);
                $dates = createDateRangeArray($dates[0],$dates[1]);
            }
//adebug($dates);
            ///  CAPTCHA CHECKING   //////////////////////////////////////////////////////////////////////////////////////
            $the_answer_from_respondent = $_POST['captcha_user_input'];
            $prefix = $_POST['captcha_chalange'];
            if (! ( ($the_answer_from_respondent == '') && ($prefix == '') )) {
                $captcha_instance = new wpdevReallySimpleCaptcha();
                $correct = $captcha_instance->check($prefix, $the_answer_from_respondent);

                if (! $correct) {
                    $word = $captcha_instance->generate_random_word();
                    $prefix = mt_rand();
                    $captcha_instance->generate_image($prefix, $word);

                    $filename = $prefix . '.png';
                    $captcha_url = WPDEV_BK_PLUGIN_URL . '/js/captcha/tmp/' .$filename;
                    $ref = substr($filename, 0, strrpos($filename, '.'));
                    ?> <script type="text/javascript">
    document.getElementById('captcha_input<?php echo $bktype; ?>').value = '';
    // chnage img
    document.getElementById('captcha_img<?php echo $bktype; ?>').src = '<?php echo $captcha_url; ?>';
    document.getElementById('wpdev_captcha_challenge_<?php echo $bktype; ?>').value = '<?php echo $ref; ?>';
    document.getElementById('captcha_msg<?php echo $bktype; ?>').innerHTML =
        '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Your entered code is incorrect', 'wpdev-booking'); ?></div>';
    document.getElementById('submiting<?php echo $bktype; ?>').innerHTML ='';
    jWPDev('#captcha_input<?php echo $bktype; ?>')
    .fadeOut( 350 ).fadeIn( 300 )
    .fadeOut( 350 ).fadeIn( 400 )
    .animate( {opacity: 1}, 4000 )
    ;  // mark red border
    jWPDev(".wpdev-help-message div")
    .css( {'color' : 'red'} )
    .animate( {opacity: 1}, 10000 )
    .fadeOut( 2000 );   // hide message
    document.getElementById('captcha_input<?php echo $bktype; ?>').focus();    // make focus to elemnt

</script>
                    <?php
                    die();
                }
            }//////////////////////////////////////////////////////////////////////////////////////////////////////////


            $booking_form_show = get_form_content ($formdata, $bktype);
             

            if ($my_booking_id>0){                  // Edit exist booking
                // adebug($_POST);die;
                ?> <script type="text/javascript">
                        document.getElementById('ajax_working').innerHTML =
                                    '<div class="info_message ajax_message" id="ajax_message">\n\
                                        <div style="float:left;"><?php echo __('Updating...', 'wpdev-booking'); ?></div> \n\
                                        <div  style="float:left;width:80px;margin-top:-3px;">\n\
                                               <img src="'+wpdev_bk_plugin_url+'/img/ajax-loader.gif">\n\
                                        </div>\n\
                                    </div>';
                </script> <?php
                $update_sql = "UPDATE ".$wpdb->prefix ."booking AS bk SET bk.form='$formdata', bk.booking_type=$bktype WHERE bk.booking_id=$my_booking_id;";
                if ( false === $wpdb->query( $update_sql ) ) {
                    ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating exist booking in BD', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }

                // Check if dates already aproved or no
                $slct_sql = "SELECT approved FROM ".$wpdb->prefix ."bookingdates WHERE booking_id IN ($my_booking_id) LIMIT 0,1";
                $slct_sql_results  = $wpdb->get_results( $slct_sql );
                if ( count($slct_sql_results) > 0 ) { $is_approved_dates = $slct_sql_results[0]->approved; }
                
                $delete_sql = "DELETE FROM ".$wpdb->prefix ."bookingdates WHERE booking_id IN ($my_booking_id)";
                if ( false === $wpdb->query( $delete_sql ) ) {
                    ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating exist booking for deleting dates in BD', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }
                $booking_id = (int) $my_booking_id;       //Get ID  of reservation

            } else {                                // Add new booking

                $insert = "('$formdata',  $bktype)";
                if ( !empty($insert) )
                    if ( false === $wpdb->query("INSERT INTO ".$wpdb->prefix ."booking (form, booking_type) VALUES " . $insert) ) {
                        ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during inserting into BD', 'wpdev-booking'); ?></div>'; </script> <?php
                        die();
                    }

                // Make insertion into BOOKINGDATES
                $booking_id = (int) $wpdb->insert_id;       //Get ID  of reservation
            }
            $insert='';
            
            

            $sdform = $_POST['form'];
            $start_time = $end_time = '00:00:00';
            $my_dates = explode(", ",$dates);
//adebug($_POST);die;
            if ( strpos($sdform,'rangetime' . $bktype ) !== false ) {   // Get START TIME From form request
                $pos1 = strpos($sdform,'rangetime' . $bktype );  // Find start time pos
                $pos1 = strpos($sdform,'^',$pos1)+1;             // Find TIME pos
                $pos2 = strpos($sdform,'~',$pos1);               // Find TIME length
                if ($pos2 === false) $pos2 = strlen($sdform);
                $pos2 = $pos2-$pos1;
                $range_time = substr( $sdform, $pos1,$pos2)  ;

                 $range_time = explode('-',$range_time);
                 $start_time = explode(':',trim($range_time[0]));
                 $start_time[2]='01';
                 $end_time = explode(':',trim($range_time[1]));
                 $end_time[2]='02';
                 if ( count($my_dates) == 1 ) { // add end date if someone select only 1 day with time range
                        $my_dates[]=$my_dates[0];
                }
            } else {

                if ( strpos($sdform,'starttime' . $bktype ) !== false ) {   // Get START TIME From form request
                    $pos1 = strpos($sdform,'starttime' . $bktype );  // Find start time pos
                    $pos1 = strpos($sdform,'^',$pos1)+1;             // Find TIME pos
                    $pos2 = strpos($sdform,'~',$pos1);               // Find TIME length
                    if ($pos2 === false) $pos2 = strlen($sdform);
                    $pos2 = $pos2-$pos1;
                    $start_time = substr( $sdform, $pos1,$pos2)  ;
                    $start_time = explode(':',$start_time);
                    $start_time[2]='01';
                } else  $start_time = explode(':',$start_time);

                if ( strpos($sdform,'endtime' . $bktype ) !== false ) {    // Get END TIME From form request
                    $pos1 = strpos($sdform,'endtime' . $bktype );    // Find start time pos
                    $pos1 = strpos($sdform,'^',$pos1)+1;             // Find TIME pos
                    $pos2 = strpos($sdform,'~',$pos1);               // Find TIME length
                    if ($pos2 === false) $pos2 = strlen($sdform);
                    $pos2 = $pos2-$pos1;
                    $end_time = substr( $sdform, $pos1,$pos2)  ;

                    if ( count($my_dates) == 1 ) { // add end date if someone select only 1 day with time range
                        $my_dates[]=$my_dates[0];
                    }
                    $end_time = explode(':',$end_time);
                    $end_time[2]='02';
                } else  $end_time = explode(':',$end_time);

                if ( strpos($sdform,'durationtime' . $bktype ) !== false ) {    // Get END TIME From form request
                    $pos1 = strpos($sdform,'durationtime' . $bktype );    // Find start time pos
                    $pos1 = strpos($sdform,'^',$pos1)+1;             // Find TIME pos
                    $pos2 = strpos($sdform,'~',$pos1);               // Find TIME length
                    if ($pos2 === false) $pos2 = strlen($sdform);
                    $pos2 = $pos2-$pos1;
                    $end_time = substr( $sdform, $pos1,$pos2)  ;

                    if ( count($my_dates) == 1 ) { // add end date if someone select only 1 day with time range
                        $my_dates[]=$my_dates[0];
                    }
                    $end_time = explode(':',$end_time);

                    // Here we are get start time and add duration for end time
                    $new_end_time = mktime($start_time[0], $start_time[1]);
                    $new_end_time = $new_end_time + $end_time[0]*60*60 + $end_time[1]*60;
                    $end_time = date('H:i',$new_end_time);
                    $end_time = explode(':',$end_time);
                    $end_time[2]='02';
                }


            }

            make_bk_action('wpdev_booking_post_inserted', $booking_id, $bktype, str_replace('|',',',$dates), array($start_time, $end_time ) );
            $my_cost = apply_bk_filter('get_booking_cost_from_db', '', $booking_id);


            $i=0;
            foreach ($my_dates as $md) { // Set in dates in such format: yyyy.mm.dd
                $md = explode('.',$md);
                $my_dates[$i] = $md[2] . '.' . $md[1] . '.' . $md[0] ;
                $i++;
            }
            sort($my_dates); // Sort dates

            $my_dates4emeil = '';
            $i=0;
            foreach ($my_dates as $my_date) {
                $i++;          // Loop through all dates
                if (strpos($my_date,'.')!==false) {
                    $my_date = explode('.',$my_date);
                    if ($i == 1) {
                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $start_time[0], $start_time[1], $start_time[2] );
                    }elseif ($i == count($my_dates)) {
                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $end_time[0], $end_time[1], $end_time[2] );
                    }else {
                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], '00', '00', '00' );
                    }
                    $my_dates4emeil .= $date . ',';
                    if ( !empty($insert) ) $insert .= ', ';
                    $insert .= "('$booking_id', '$date', '$is_approved_dates' )";
                }
            }
            $my_dates4emeil = substr($my_dates4emeil,0,-1);
//adebug($my_dates4emeil);
            if ( !empty($insert) )
                if ( false === $wpdb->query("INSERT INTO ".$wpdb->prefix ."bookingdates (booking_id, booking_date, approved) VALUES " . $insert) ) {
                    ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during inserting into BD - Dates', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }

            if (function_exists ('get_booking_title')) $bk_title = get_booking_title( $bktype );
            else $bk_title = '';

            if ($my_booking_id>0){ // For editing exist booking
                

                    $mail_sender    =  htmlspecialchars_decode( get_option( 'booking_email_modification_adress') ) ;
                    $mail_subject   =  htmlspecialchars_decode( get_option( 'booking_email_modification_subject') );
                    $mail_body      =  htmlspecialchars_decode( get_option( 'booking_email_modification_content') );

                    if (function_exists ('get_booking_title')) $bk_title = get_booking_title( $bktype );
                    else $bk_title = '';

                    $booking_form_show = get_form_content ($formdata, $bktype);

                    $mail_body_to_send = str_replace('[bookingtype]', $bk_title, $mail_body);
                    if (get_option( 'booking_date_view_type') == 'short') $my_dates_4_send = get_dates_short_format( get_dates_str($booking_id) );
                    else                                                  $my_dates_4_send = change_date_format(get_dates_str($booking_id));
                    $mail_body_to_send = str_replace('[dates]',$my_dates_4_send , $mail_body_to_send);
                    $mail_body_to_send = str_replace('[content]', $booking_form_show['content'], $mail_body_to_send);
                    $mail_body_to_send = str_replace('[denyreason]', $denyreason, $mail_body_to_send);
                    $mail_body_to_send = str_replace('[name]', $booking_form_show['name'], $mail_body_to_send);
                    $mail_body_to_send = str_replace('[cost]', $my_cost, $mail_body_to_send);
                    if ( isset($booking_form_show['secondname']) ) $mail_body_to_send = str_replace('[secondname]', $booking_form_show['secondname'], $mail_body_to_send);
                    $mail_body_to_send = str_replace('[siteurl]', htmlspecialchars_decode( '<a href="'.get_option('siteurl').'">' . get_option('siteurl') . '</a>'), $mail_body_to_send);

                    $mail_subject = str_replace('[name]', $booking_form_show['name'], $mail_subject);
                    if ( isset($booking_form_show['secondname']) ) $mail_subject = str_replace('[secondname]', $booking_form_show['secondname'], $mail_subject);

                    $mail_recipient =  $booking_form_show['email'];

                    $mail_headers = "From: $mail_sender\n";
                    $mail_headers .= "Content-Type: text/html\n";

                    if (get_option( 'booking_is_email_modification_adress'  ) != 'Off')
                            @wp_mail($mail_recipient, $mail_subject, $mail_body_to_send, $mail_headers);

                    ?> <script type="text/javascript"> 
                        document.getElementById('ajax_message').innerHTML = '<?php echo __('Updated successfully', 'wpdev-booking'); ?>';
                        jWPDev('#ajax_message').fadeOut(1000);
                        document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Updated successfully', 'wpdev-booking'); ?></div>';
                        location.href='admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ;?>wpdev-booking&booking_type=<?php echo $bktype; ?>&booking_id_selection=<?php echo  $my_booking_id;?>';
                    </script> <?php
                    die();
            } else {// For inserting NEW booking
                    // Sending mail ///////////////////////////////////////////////////////
                    $mail_sender    =  htmlspecialchars_decode( get_option( 'booking_email_reservation_from_adress') ) ; //'"'. 'Booking sender' . '" <' . $booking_form_show['email'].'>';
                    $mail_recipient =  htmlspecialchars_decode( get_option( 'booking_email_reservation_adress') );//'"Booking receipent" <' .get_option('admin_email').'>';
                    $mail_subject   =  htmlspecialchars_decode( get_option( 'booking_email_reservation_subject') );
                    $mail_body      =  htmlspecialchars_decode( get_option( 'booking_email_reservation_content') );

                    $mail_body = str_replace('[bookingtype]', $bk_title, $mail_body);
                    if (get_option( 'booking_date_view_type') == 'short') $my_dates_4_send = get_dates_short_format( $my_dates4emeil );
                    else                                                  $my_dates_4_send = change_date_format($my_dates4emeil);
                    $mail_body = str_replace('[dates]',  $my_dates_4_send , $mail_body);
                    $mail_body = str_replace('[content]', $booking_form_show['content'], $mail_body);
                    $mail_body = str_replace('[name]', $booking_form_show['name'], $mail_body);
                    $mail_body = str_replace('[cost]', $my_cost, $mail_body);
                    $mail_body = str_replace('[siteurl]', htmlspecialchars_decode( '<a href="'.get_option('siteurl').'">' . get_option('siteurl') . '</a>'), $mail_body);
                    $mail_body = str_replace('[moderatelink]', htmlspecialchars_decode( 
                            '<a href="'.get_option('siteurl')  . '/wp-admin/admin.php?page='. WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME .'wpdev-booking&booking_type='.$bktype.'&moderate_id='. $booking_id .'">'
                            . __('here','wpdev-booking') . '</a>'), $mail_body);

                    if ( isset($booking_form_show['secondname']) ) $mail_body = str_replace('[secondname]', $booking_form_show['secondname'], $mail_body);

                    $mail_subject = str_replace('[name]', $booking_form_show['name'], $mail_subject);
                    if ( isset($booking_form_show['secondname']) ) $mail_subject = str_replace('[secondname]', $booking_form_show['secondname'], $mail_subject);

                    $mail_headers = "From: $mail_sender\n";
                    $mail_headers .= "Content-Type: text/html\n";

                    if ( strpos($mail_recipient,'[visitoremeil]') !== false ) { $mail_recipient = str_replace('[visitoremeil]',$booking_form_show['email'],$mail_recipient); }

                    if (get_option( 'booking_is_email_reservation_adress'  ) != 'Off')
                        @wp_mail($mail_recipient, $mail_subject, $mail_body, $mail_headers);
                    /////////////////////////////////////////////////////////////////////////

                     if (get_option( 'booking_is_email_newbookingbyperson_adress'  ) == 'On')  {

                            $mail_sender    =  htmlspecialchars_decode( get_option( 'booking_email_newbookingbyperson_adress') ) ; //'"'. 'Booking sender' . '" <' . $booking_form_show['email'].'>';
                            $mail_recipient =  $booking_form_show['email'];
                            $mail_subject   =  htmlspecialchars_decode( get_option( 'booking_email_newbookingbyperson_subject') );
                            $mail_body      =  htmlspecialchars_decode( get_option( 'booking_email_newbookingbyperson_content') );

                            $mail_body = str_replace('[bookingtype]', $bk_title, $mail_body);
                            if (get_option( 'booking_date_view_type') == 'short') $my_dates_4_send = get_dates_short_format( $my_dates4emeil );
                            else                                                  $my_dates_4_send = change_date_format($my_dates4emeil);
                            $mail_body = str_replace('[dates]',  $my_dates_4_send , $mail_body);
                            $mail_body = str_replace('[content]', $booking_form_show['content'], $mail_body);
                            $mail_body = str_replace('[name]', $booking_form_show['name'], $mail_body);
                            $mail_body = str_replace('[cost]', $my_cost, $mail_body);
                            $mail_body = str_replace('[siteurl]', htmlspecialchars_decode( '<a href="'.get_option('siteurl').'">' . get_option('siteurl') . '</a>'), $mail_body);
                            if ( isset($booking_form_show['secondname']) ) $mail_body = str_replace('[secondname]', $booking_form_show['secondname'], $mail_body);

                            $mail_subject = str_replace('[name]', $booking_form_show['name'], $mail_subject);
                            if ( isset($booking_form_show['secondname']) ) $mail_subject = str_replace('[secondname]', $booking_form_show['secondname'], $mail_subject);

                            $mail_headers = "From: $mail_sender\n";
                            $mail_headers .= "Content-Type: text/html\n";

                            if ( strpos($mail_recipient,'[visitoremeil]') !== false ) { $mail_recipient = str_replace('[visitoremeil]',$booking_form_show['email'],$mail_recipient); }

                            @wp_mail($mail_recipient, $mail_subject, $mail_body, $mail_headers);

                     }

                    ?>
<script type="text/javascript">
    document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div class=\"submiting_content\" ><?php echo get_option('booking_title_after_reservation'); ?></div>';
    jWPDev('.submiting_content').fadeOut(<?php echo get_option('booking_title_after_reservation_time'); ?>);
    setReservedSelectedDates('<?php echo $bktype; ?>');
</script>  <?php
                    do_action('wpdev_new_booking',$booking_id, $bktype, str_replace('|',',',$dates), array($start_time, $end_time ) ,$sdform );
            }
            die();
            break;

        case 'UPDATE_APPROVE' :


            $is_in_approved = $_POST[ "is_in_approved" ];
            $approved = $_POST[ "approved" ];
            $approved_id = explode('|',$approved);
            if ( (count($approved_id)>0) && ($approved_id !==false)) {
                $approved_id_str = join( ',', $approved_id);

                if ( false === $wpdb->query( "UPDATE ".$wpdb->prefix ."bookingdates SET approved = '1' WHERE booking_id IN ($approved_id_str)") ) {
                    ?>
<script type="text/javascript">
    document.getElementById('admin_bk_messages<?php echo $is_in_approved; ?>').innerHTML =
        '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating to DB', 'wpdev-booking'); ?></div>';
</script>
                    <?php
                    die();
                }

                $sql = "SELECT * FROM ".$wpdb->prefix ."booking as bk WHERE bk.booking_id IN ($approved_id_str)";

                $result = $wpdb->get_results( $sql );

                $mail_sender    =  htmlspecialchars_decode( get_option( 'booking_email_approval_adress') ) ; //'"'. 'Booking sender' . '" <' . $booking_form_show['email'].'>';
                $mail_subject   =  htmlspecialchars_decode( get_option( 'booking_email_approval_subject') );
                $mail_body      =  htmlspecialchars_decode( get_option( 'booking_email_approval_content') );

                foreach ($result as $res) {
                    // Sending mail ///////////////////////////////////////////////////////
                    if (function_exists ('get_booking_title')) $bk_title = get_booking_title( $res->booking_type );
                    else $bk_title = '';

                    $booking_form_show = get_form_content ($res->form, $res->booking_type);

                    $mail_body_to_send = str_replace('[bookingtype]', $bk_title, $mail_body);
                    if (get_option( 'booking_date_view_type') == 'short') $my_dates_4_send = get_dates_short_format( get_dates_str($res->booking_id) );
                    else                                                  $my_dates_4_send = change_date_format(get_dates_str($res->booking_id));
                    $mail_body_to_send = str_replace('[dates]', $my_dates_4_send , $mail_body_to_send);
                    $mail_body_to_send = str_replace('[content]', $booking_form_show['content'], $mail_body_to_send);
                    $mail_body_to_send = str_replace('[name]', $booking_form_show['name'], $mail_body_to_send);
                    if (isset($res->cost)) $mail_body_to_send = str_replace('[cost]', $res->cost, $mail_body_to_send);
                    $mail_body_to_send = str_replace('[siteurl]', htmlspecialchars_decode( '<a href="'.get_option('siteurl').'">' . get_option('siteurl') . '</a>'), $mail_body_to_send);

                    if ( isset($booking_form_show['secondname']) ) $mail_body_to_send = str_replace('[secondname]', $booking_form_show['secondname'], $mail_body_to_send);
                    $mail_subject1 = $mail_subject;
                    $mail_subject1 = str_replace('[name]', $booking_form_show['name'], $mail_subject1);
                    if ( isset($booking_form_show['secondname']) ) $mail_subject1 = str_replace('[secondname]', $booking_form_show['secondname'], $mail_subject1);


                    $mail_recipient =  $booking_form_show['email'];

                    $mail_headers = "From: $mail_sender\n";
                    $mail_headers .= "Content-Type: text/html\n";

                    if (get_option( 'booking_is_email_approval_adress'  ) != 'Off')
                        @wp_mail($mail_recipient, $mail_subject1, $mail_body_to_send, $mail_headers);
                    /////////////////////////////////////////////////////////////////////////
                }
                ?>
<script type="text/javascript">
    document.getElementById('ajax_message').innerHTML = '<?php echo __('Approved', 'wpdev-booking'); ?>';
    jWPDev('#ajax_message').fadeOut(1000);
    location.reload(true);
</script>
                <?php
                die();
            }
            break;

        case 'DELETE_APPROVE' :   // adebug($_POST); die();
            $is_in_approved = $_POST[ "is_in_approved" ];
            $approved = $_POST[ "approved" ];
            $denyreason = $_POST["denyreason"];
            $is_send_emeils = $_POST["is_send_emeils"];
            if ( ( $denyreason == __('Reason of cancellation here', 'wpdev-booking')) || ( $denyreason == 'Reason of cancel here') ) {
                $denyreason = '';
            }

            $approved_id = explode('|',$approved);
            if ( (count($approved_id)>0) && ($approved_id !=false) && ($approved_id !='')) {
                $approved_id_str = join( ',', $approved_id);

                $sql = "SELECT *    FROM ".$wpdb->prefix ."booking as bk
                                    WHERE bk.booking_id IN ($approved_id_str)";

                $result = $wpdb->get_results( $sql );

                $mail_sender    =  htmlspecialchars_decode( get_option( 'booking_email_deny_adress') ) ;
                $mail_subject   =  htmlspecialchars_decode( get_option( 'booking_email_deny_subject') );
                $mail_body      =  htmlspecialchars_decode( get_option( 'booking_email_deny_content') );

                foreach ($result as $res) {
                    // Sending mail ///////////////////////////////////////////////////////
                    if (function_exists ('get_booking_title')) $bk_title = get_booking_title( $res->booking_type );
                    else $bk_title = '';

                    $booking_form_show = get_form_content ($res->form, $res->booking_type);

                    $mail_body_to_send = str_replace('[bookingtype]', $bk_title, $mail_body);
                    if (get_option( 'booking_date_view_type') == 'short') $my_dates_4_send = get_dates_short_format( get_dates_str($res->booking_id) );
                    else                                                  $my_dates_4_send = change_date_format(get_dates_str($res->booking_id));
                    $mail_body_to_send = str_replace('[dates]',$my_dates_4_send , $mail_body_to_send);
                    $mail_body_to_send = str_replace('[content]', $booking_form_show['content'], $mail_body_to_send);
                    $mail_body_to_send = str_replace('[denyreason]', $denyreason, $mail_body_to_send);
                    $mail_body_to_send = str_replace('[name]', $booking_form_show['name'], $mail_body_to_send);
                    if (isset($res->cost)) $mail_body_to_send = str_replace('[cost]', $res->cost, $mail_body_to_send);
                    $mail_body_to_send = str_replace('[siteurl]', htmlspecialchars_decode( '<a href="'.get_option('siteurl').'">' . get_option('siteurl') . '</a>'), $mail_body_to_send);

                    if ( isset($booking_form_show['secondname']) ) $mail_body_to_send = str_replace('[secondname]', $booking_form_show['secondname'], $mail_body_to_send);
                    $mail_subject1 = $mail_subject;
                    $mail_subject1 = str_replace('[name]', $booking_form_show['name'], $mail_subject1);
                    if ( isset($booking_form_show['secondname']) ) $mail_subject1 = str_replace('[secondname]', $booking_form_show['secondname'], $mail_subject1);

                    $mail_recipient =  $booking_form_show['email'];

                    $mail_headers = "From: $mail_sender\n";
                    $mail_headers .= "Content-Type: text/html\n";
                    
                    if (get_option( 'booking_is_email_deny_adress'  ) != 'Off')
                        if ($is_send_emeils != 0 )
                            @wp_mail($mail_recipient, $mail_subject1, $mail_body_to_send, $mail_headers);
                    /////////////////////////////////////////////////////////////////////////
                }

                if ( false === $wpdb->query( "DELETE FROM ".$wpdb->prefix ."bookingdates WHERE booking_id IN ($approved_id_str)") ) {
                    ?> <script type="text/javascript"> document.getElementById('admin_bk_messages<?php echo $is_in_approved; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during deleting dates at DB', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }

                if ( false === $wpdb->query( "DELETE FROM ".$wpdb->prefix ."booking WHERE booking_id IN ($approved_id_str)") ) {
                    ?> <script type="text/javascript"> document.getElementById('admin_bk_messages<?php echo $is_in_approved; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during deleting reservation at DB', 'wpdev-booking'); ?></div>'; </script> <?php
                    die();
                }

                ?>
<script type="text/javascript">
    document.getElementById('ajax_message').innerHTML = '<?php echo __('Deleted', 'wpdev-booking'); ?>';
    jWPDev('#ajax_message').fadeOut(1000);
    location.reload(true);
</script>
                <?php
                die();

            }
            break;
        case 'UPDATE_REMARK':
            make_bk_action('wpdev_updating_remark');
            break;
        case 'DELETE_BK_FORM':
            make_bk_action('wpdev_delete_booking_form');
            break;
        default:
            if (function_exists ('wpdev_pro_bk_ajax')) wpdev_pro_bk_ajax();
            die();

        endswitch;

}

?>