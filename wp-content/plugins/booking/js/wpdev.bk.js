    var date_approved = [];
    var date2approve = [];
    //var tooltips = [];
    var is_all_days_available = [];
    var avalaibility_filters = [];
    var is_show_cost_in_tooltips = false;
    var is_show_availability_in_tooltips = false;
    var global_avalaibility_times = [];  // Time availability
    // Initialisation
    function init_datepick_cal(bk_type,  date_approved_par, my_num_month, start_day ){

            var cl = document.getElementById('calendar_booking'+ bk_type);if (cl == null) return; // Get calendar instance and exit if its not exist

            date_approved[ bk_type ] = date_approved_par;

            function click_on_cal_td(){
                if(typeof( selectDayPro ) == 'function') {selectDayPro(  bk_type);}
            }

            function selectDay(date) {
                jWPDev('#date_booking' + bk_type).val(date);
                if(typeof( selectDayPro ) == 'function') {selectDayPro( date, bk_type);}
            }

            function hoverDay(value, date){ 

                if(typeof( hoverDayTime ) == 'function') {hoverDayTime(value, date, bk_type);}

                if ( (location.href.indexOf('admin.php?page=booking/wpdev-booking.phpwpdev-booking')==-1) ||
                     (location.href.indexOf('admin.php?page=booking/wpdev-booking.phpwpdev-booking-reservation')>0) )
                { // Do not show it (range) at the main admin page
                    if(typeof( hoverDayPro ) == 'function')  {hoverDayPro(value, date, bk_type);}
                }
                //if(typeof( hoverAdminDay ) == 'function')  { hoverAdminDay(value, date, bk_type); }
             }

            function applyCSStoDays(date ){


                if (typeof( is_this_day_available ) == 'function') {
                    var is_day_available = is_this_day_available( date, bk_type);
                    if (! is_day_available) {return [false, 'cal4date-' + class_day +' date_user_unavailable'];}
                }

                // Time availability
                if (typeof( check_global_time_availability ) == 'function') {check_global_time_availability( date, bk_type );}

                var class_day = (date.getMonth()+1) + '-' + date.getDate() + '-' + date.getFullYear();
                //var class_day_previos = (date.getMonth()+1) + '-' + (date.getDate()-1) + '-' + date.getFullYear();
                var th=0;
                var tm=0;
                var ts=0;
                var time_return_value = false;
                // Select dates which need to approve, its exist only in Admin
                if(typeof(date2approve[ bk_type ]) !== 'undefined')
                   if(typeof(date2approve[ bk_type ][ class_day ]) !== 'undefined') {
                      th = date2approve[ bk_type ][ class_day ][0][3];
                      tm = date2approve[ bk_type ][ class_day ][0][4];
                      ts = date2approve[ bk_type ][ class_day ][0][5];
                      if ( ( th == 0 ) && ( tm == 0 ) && ( ts == 0 ) )
                          return [false, 'cal4date-' + class_day +' date2approve']; // Orange
                      else {
                          time_return_value = [true, 'cal4date-' + class_day +' date2approve timespartly']; // Times
                          if(typeof( isDayFullByTime ) == 'function') {
                              if ( isDayFullByTime(bk_type, class_day ) ) return [false, 'cal4date-' + class_day +' date2approve']; // Orange
                          }
                      }                          
                   }

                //select Approved dates
                if(typeof(date_approved[ bk_type ]) !== 'undefined')
                  if(typeof(date_approved[ bk_type ][ class_day ]) !== 'undefined') {
                      th = date_approved[ bk_type ][ class_day ][0][3];
                      tm = date_approved[ bk_type ][ class_day ][0][4];
                      ts = date_approved[ bk_type ][ class_day ][0][5];
                      if ( ( th == 0 ) && ( tm == 0 ) && ( ts == 0 ) )
                        return [false, 'cal4date-' + class_day +' date_approved']; //Blue or Grey in client
                      else {
                        time_return_value = [true,  'cal4date-' + class_day +' date_approved timespartly']; // Times
                        if(typeof( isDayFullByTime ) == 'function') {
                            if ( isDayFullByTime(bk_type, class_day ) ) return [false, 'cal4date-' + class_day +' date_approved']; // Blue or Grey in client
                        }
                      }
                  }

                /*if(typeof(date2approve[ bk_type ]) !== 'undefined')
                   if(typeof(date2approve[ bk_type ][ class_day_previos ]) !== 'undefined')
                     return [false, 'cal4date-' + class_day +' date_cleaning']; //Cleaning

                if(typeof(date_approved[ bk_type ]) !== 'undefined')
                  if(typeof(date_approved[ bk_type ][ class_day_previos ]) !== 'undefined')
                     return [false, 'cal4date-' + class_day +' date_cleaning']; //Cleaning/**/


                for (var i=0; i<user_unavilable_days.length;i++) {
                    if (date.getDay()==user_unavilable_days[i])   return [false, 'cal4date-' + class_day +' date_user_unavailable'];
                }
                
                

                if ( time_return_value !== false )  return time_return_value;
                else                                return [true, 'cal4date-' + class_day ];
            }

            function changeMonthYear(year, month){ 
                if(typeof( prepare_tooltip ) == 'function') {
                    setTimeout("prepare_tooltip("+bk_type+");",1000);
                }
                if(typeof( prepare_highlight ) == 'function') {
                 setTimeout("prepare_highlight();",1000);
                }
            }
            // Configure and show calendar
            jWPDev('#calendar_booking'+ bk_type).datepick(
                    {beforeShowDay: applyCSStoDays,
                        onSelect: selectDay,
                        onHover:hoverDay,
                        onChangeMonthYear:changeMonthYear,
                        showOn: 'both',
                        multiSelect: multiple_day_selections,
                        numberOfMonths: my_num_month,
                        stepMonths: 1,
                        prevText: '<<',
                        nextText: '>>',
                        dateFormat: 'dd.mm.yy',
                        changeMonth: false, 
                        changeYear: false,
                        minDate: 0, maxDate: booking_max_monthes_in_calendar, //'1Y',
                        showStatus: false,
                        multiSeparator: ', ',
                        closeAtTop: false,
                        firstDay:start_day,
                        gotoCurrent: false,
                        hideIfNoPrevNext:true,
                        rangeSelect:wpdev_bk_is_dynamic_range_selection,
                        useThemeRoller :false // ui-cupertino.datepick.css
                    }
            );

            //jWPDev('td.datepick-days-cell').bind('click', 'selectDayPro');
            if(typeof( prepare_tooltip ) == 'function') {setTimeout("prepare_tooltip("+bk_type+");",1000);}
    }


    //   A D M I N    Highlight dates when mouse over
    function highlightDay(td_class, bk_color){
       //jWPDev('.'+td_class).css({'background-color' : bk_color });
       //jWPDev('.'+td_class + ' a').css({'background-color' : bk_color });

       jWPDev('td a').removeClass('admin_calendar_selection');
       if (bk_color == '#ff0000')
            jWPDev('td.'+td_class + ' a').addClass('admin_calendar_selection');

       jWPDev('td').removeClass('admin_calendar_selection');
       if (bk_color == '#ff0000')
            jWPDev('td.'+td_class + '').addClass('admin_calendar_selection');

       
    }


    // A D M I N    Run this function at Admin side when click at Approve button
    function bookingApprove(is_delete, is_in_approved){
        var checkedd = jWPDev(".booking_appr"+is_in_approved+":checked");
        id_for_approve = "";

        // get all IDs
        checkedd.each(function(){
            var id_c = jWPDev(this).attr('id');
            id_c = id_c.substr(13,id_c.length-13)
            id_for_approve += id_c + "|";
        });

        //delete last "|"
        id_for_approve = id_for_approve.substr(0,id_for_approve.length-1);

        var denyreason ;
        if (is_delete ==1) {
            if (is_in_approved==0) {denyreason= jWPDev('#denyreason').val();}
            else                   {denyreason= jWPDev('#cancelreason').val();}
        } else {denyreason = '';}



        if (id_for_approve!='') {

            var wpdev_ajax_path = wpdev_bk_plugin_url+'/' + wpdev_bk_plugin_filename ;

            var ajax_type_action='';
            if (is_delete) {ajax_type_action =  'DELETE_APPROVE';var ajax_bk_message = 'Deleting...';}
            else           {ajax_type_action =  'UPDATE_APPROVE';var ajax_bk_message = 'Updating...';};

            document.getElementById('ajax_working').innerHTML =
            '<div class="info_message ajax_message" id="ajax_message">\n\
                <div style="float:left;">'+ajax_bk_message+'</div> \n\
                <div  style="float:left;width:80px;margin-top:-3px;">\n\
                       <img src="'+wpdev_bk_plugin_url+'/img/ajax-loader.gif">\n\
                </div>\n\
            </div>';
            
            var is_send_emeils = 1;
            if (is_delete == 2 ) is_send_emeils = 0;
            jWPDev.ajax({                                           // Start Ajax Sending
                url: wpdev_ajax_path,
                type:'POST',
                success: function (data, textStatus){if( textStatus == 'success')   jWPDev('#ajax_respond').html( data );},
                error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
                // beforeSend: someFunction,
                data:{
                    ajax_action : ajax_type_action,
                    approved : id_for_approve,
                    is_in_approved : is_in_approved,
                    is_send_emeils : is_send_emeils,
                    denyreason: denyreason
                }
            });
            return false;
        }
        return true;
    }


    // Scroll to script
    function makeScroll(object_name) {
         var targetOffset = jWPDev( object_name ).offset().top;
         jWPDev('html,body').animate({scrollTop: targetOffset}, 1000);
    }

    // Aftre reservation action is done
    function setReservedSelectedDates( bk_type ){

        var sel_dates = jWPDev('#calendar_booking'+bk_type).datepick('getDate');

        for( var i =0; i <sel_dates.length; i++) {
          var class_day2 = (sel_dates[i].getMonth()+1) + '-' + sel_dates[i].getDate() + '-' + sel_dates[i].getFullYear();
          date_approved[ bk_type ][ class_day2 ] = [ (sel_dates[i].getMonth()+1) ,  sel_dates[i].getDate(),  sel_dates[i].getFullYear(),0,0,0];
        }

        jWPDev('#calendar_booking'+bk_type).datepick('refresh');

        document.getElementById('date_booking'+bk_type).value = ''; // Set textarea date booking to ''

        var is_admin = 0;
        if (location.href.indexOf('booking.php') != -1 ) {is_admin = 1;}
        if (is_admin == 0) {
            // Get calendar from the html and insert it before form div, which will hide after btn click
            jWPDev('#calendar_booking'+bk_type).insertBefore("#booking_form_div"+bk_type);
            document.getElementById("booking_form_div"+bk_type).style.display="none";
            makeScroll('#calendar_booking'+bk_type);
        } else {location.reload(true);}
    }

    //Admin function s for checking all checkbos in one time
    function setCheckBoxInTable(el_stutus, el_class){
         jWPDev('.'+el_class).attr('checked', el_stutus);
    }

    
    function mybooking_submit( submit_form , bk_type){

        function showErrorMessage( element , errorMessage) {

            jWPDev("[name='"+ element.name +"']")
                    .fadeOut( 350 ).fadeIn( 300 )
                    .fadeOut( 350 ).fadeIn( 400 )
                    .animate( {opacity: 1}, 4000 )
            ;  // mark red border
            jWPDev("[name='"+ element.name +"']")
                    .after('<div class="wpdev-help-message">'+ errorMessage +'</div>'); // Show message
            jWPDev(".wpdev-help-message")
                    .css( {'color' : 'red'} )
                    .animate( {opacity: 1}, 10000 )
                    .fadeOut( 2000 );   // hide message
            element.focus();    // make focus to elemnt
            return;

        }

        var count = submit_form.elements.length;
        var formdata = '';
        var inp_value;
        var element;

        // Serialize form here
        for (i=0; i<count; i++)   {
            element = submit_form.elements[i];
            
            if ( (element.type !=='button') && (element.type !=='hidden') && ( element.name !== ('date_booking' + bk_type) )   ) {           // Skip buttons and hidden element - type
                
                if (element.type !=='checkbox') {inp_value = element.value;}                      // if checkbox so then just check checked
                else                            {
                    if (element.value == '') inp_value = element.checked;
                    else {
                        if (element.checked) inp_value = element.value;
                        else inp_value = '';
                    }
                }
                
                

                if ( element.className.indexOf('wpdev-validates-as-required') !== -1 ){             // Validation Check --- Requred fields
                    if ( inp_value == '')  {showErrorMessage( element , message_verif_requred);return;}
                }

                if ( element.className.indexOf('wpdev-validates-as-email') !== -1 ){                // Validation Check --- Email correct filling field
                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    if(reg.test(inp_value) == false) {showErrorMessage( element , message_verif_emeil);return;}
                }

                if(typeof( write_js_validation ) == 'function') {if (write_js_validation(element, inp_value, bk_type )) return;}
                if ( element.name !== ('captcha_input' + bk_type) ) {
                    if (formdata !=='') formdata +=  '~';                                                // next field element
                    formdata += element.type + '^' + element.name + '^' + inp_value ;                    // element attr
                }
            }
        }
        
        //Show message if no selected days
        if (document.getElementById('date_booking' + bk_type).value == '') {
            alert(message_verif_selectdts);
            return;
        }

        if (false) { // Customization for Thomas
            var my_dates = document.getElementById('date_booking' + bk_type).value;
            var my_dates_array = my_dates.split(',');
            if (my_dates_array.length == 1) {
                var singledate = my_dates_array[0];
                singledate = singledate.split('.');
                var my_date = singledate[0]*1;
                var my_month = singledate[1]*1;
                var my_year = singledate[2]*1;
                
                var selceted_first_day = new Date();
                selceted_first_day.setFullYear(my_year,(my_month -1), my_date );
                var week_day =  selceted_first_day.getDay();
                if (( week_day == 0 ) || ( week_day == 5 ) || ( week_day == 6 ) ) { // Sun, Fri, Sat
                    alert('Please, select one additional day for booking!');
                    return;
                }
            } 
        }

        // Cpatch  verify
        var captcha = document.getElementById('wpdev_captcha_challenge_' + bk_type);
        if (captcha != null) {
            form_submit_send( bk_type, formdata, captcha.value, document.getElementById('captcha_input' + bk_type).value );
        } else
            form_submit_send( bk_type, formdata,'','' );
        return;
    }


    //<![CDATA[
    function form_submit_send( bk_type, formdata, captcha_chalange, user_captcha ){

            document.getElementById('submiting' + bk_type).innerHTML =
                '<div style="height:20px;width:100%;text-align:center;margin:15px auto;"><img src="'+wpdev_bk_plugin_url+'/img/ajax-loader.gif"><//div>';

            var my_booking_id = 0;
            var my_booking_form = '';
            if (document.getElementById('booking_form_type' + bk_type) != undefined)
                my_booking_form =document.getElementById('booking_form_type' + bk_type).value;

            if (location.href.indexOf('&booking_id=')>=0) {
                var params = location.href.split('?');
                params = params[1].split('&');
                var pp;
                for(var iii = 0; iii < params.length; iii++){
                    pp = params[iii].split('=');
                    if (pp[0]=='booking_id') my_booking_id = pp[1];
                }
            }

            // Ajax POST here
            jWPDev.ajax({                                           // Start Ajax Sending
                url: wpdev_bk_plugin_url+ '/' + wpdev_bk_plugin_filename,
                type:'POST',
                success: function (data, textStatus){if( textStatus == 'success')   jWPDev('#ajax_respond_insert' + bk_type).html( data ) ;},
                error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
                // beforeSend: someFunction,
                data:{
                    ajax_action : 'INSERT_INTO_TABLE',
                    bktype: document.getElementById('bk_type' + bk_type).value ,
                    dates: document.getElementById('date_booking' + bk_type).value ,
                    form: formdata,
                    captcha_chalange:captcha_chalange,
                    captcha_user_input: user_captcha,
                    my_booking_id:my_booking_id,
                    booking_form_type:my_booking_form
                }
            });
    }
    //]]>

    // Prepare to show tooltips
    function prepare_tooltip(myParam){   
           var tooltip_day_class_4_show = " .timespartly";
           if ((is_show_cost_in_tooltips) || (is_show_availability_in_tooltips)) {
               tooltip_day_class_4_show = " .datepick-days-cell";  // each day
           }

          // Show tooltip at each day if time availability filter is set
          if(typeof( global_avalaibility_times[myParam]) != "undefined") {
              if (global_avalaibility_times[myParam].length>0)  tooltip_day_class_4_show = " .datepick-days-cell";  // each day
          }
 
          jWPDev("#calendar_booking" + myParam + tooltip_day_class_4_show ).tooltip( { //TODO I am changed here
                          tip:'#demotip'+myParam,
                          predelay:500,
                          delay:0,
                          position:"top center",
                          offset:[2,0],
                          opacity:1
          });
          //    tooltips[myParam] = jWPDev("#calendar_booking" + myParam+ " .timespartly").tooltip( { tip:'#demotip'+myParam, predelay:500, api:true  });
          //    tooltips[myParam].show();
    }

    // Hint labels inside of input boxes
    jWPDev(document).ready( function(){
        
            jWPDev('div.inside_hint').click(function(){
                    jWPDev(this).css('visibility', 'hidden').siblings('.has-inside-hint').focus();
            });

            jWPDev('input.has-inside-hint').blur(function() {
                if ( this.value == '' )
                    jWPDev(this).siblings('.inside_hint').css('visibility', '');
            }).focus(function(){
                    jWPDev(this).siblings('.inside_hint').css('visibility', 'hidden');
            });
    });



function openModalWindow(content_ID){
    //alert('!!!' + content);
    jWPDev('.modal_content_text').attr('style','display:none;')
    document.getElementById( content_ID ).style.display = 'block';
    var buttons = {};//{ "Ok": wpdev_bk_dialog_close };
    jWPDev("#wpdev-bk-dialog").dialog( {
            autoOpen: false,
            width: 700,
            height: 300,
            buttons:buttons,
            draggable:false,
            hide: 'slide',
            resizable: false,
            modal: true,
            title: '<img src="'+wpdev_bk_plugin_url+ '/img/calendar-16x16.png" align="middle" style="margin-top:1px;"> Booking Calendar'
    });
    jWPDev("#wpdev-bk-dialog").dialog("open");
}

function wpdev_bk_dialog_close(){
    jWPDev("#wpdev-bk-dialog").dialog("close");
}


function wpdev_togle_box(boxid){
    if ( jWPDev( '#' + boxid ).hasClass('closed') ) jWPDev('#' + boxid).removeClass('closed');
    else                                            jWPDev('#' + boxid).addClass('closed');
}