jWPDev(document).ready( function(){
   jWPDev('.wpdev-validates-as-time').attr('alt','time');
   jWPDev('.wpdev-validates-as-time').setMask();
});

function write_js_validation(element, inp_value, bk_type) {
        function IsValidTime(timeStr) {
                // Checks if time is in HH:MM AM/PM format.
                // The seconds and AM/PM are optional.

                var timePat = /^(\d{1,2}):(\d{2})(\s?(AM|am|PM|pm))?$/;

                var matchArray = timeStr.match(timePat);
                if (matchArray == null) {
                    return false; //("<?php _e('Time is not in a valid format. Use this format HH:MM or HH:MM AM/PM'); ?>");
                }
                var hour = matchArray[1];
                var minute = matchArray[2];
                var ampm = matchArray[4];

                if (ampm=="") {ampm = null}

                if (hour < 0  || hour > 23) {
                    return  false; //("<?php _e('Hour must be between 1 and 12. (or 0 and 23 for military time)'); ?>");
                }
                if  (hour > 12 && ampm != null) {
                    return  false; //("<?php _e('You can not specify AM or PM for military time.'); ?>");
                }
                if (minute<0 || minute > 59) {
                    return  false; //("<?php _e('Minute must be between 0 and 59.'); ?>");
                }
                return true;
            }

        var valid_time = true;
        var my_message = message_time_error;  // Check time for correct fill

        // Check range time selectbox
        if (element.name.indexOf('rangetime') !== -1 ){
           //my_message =  message_rangetime_error;
           //valid_time = false;
            if( valid_time === true ) { // check start time for enterence into diapason
                       
                       //TODO: make PHP to JS functions
                       var my_rangetime = element.value.split('-');
                       my_rangetime[0] = my_rangetime[0].replace(/(^\s+)|(\s+$)/g, ""); // TRim
                       my_rangetime[1] = my_rangetime[1].replace(/(^\s+)|(\s+$)/g, ""); // TRim

                       if(typeof( checkTimeInside ) == 'function') {valid_time = checkTimeInside(my_rangetime[0], true, bk_type) ;}
                       if (element.value == '') valid_time = false;
                       if( valid_time === true ) {
                           if(typeof( checkTimeInside ) == 'function') {valid_time = checkTimeInside(my_rangetime[1], false, bk_type) ;}
                       }
                       if( valid_time !== true ) my_message = message_rangetime_error;
            }
        }


        if (element.name.indexOf('durationtime') !== -1 ){
           
           var mylocalstarttime = jWPDev("input[name=starttime"+bk_type+"]").val() ;
           if (mylocalstarttime == undefined) { mylocalstarttime = jWPDev("select[name=starttime"+bk_type+"]").val() ; }
           if (mylocalstarttime != undefined) {
                mylocalstarttime = mylocalstarttime.split(':');
                var d = new Date(1980, 1, 1, mylocalstarttime[0], mylocalstarttime[1], 0);
                var my_duration = inp_value.split(':');
                my_duration = my_duration[0]*60*60*1000 + my_duration[1]*60*1000;
                d.setTime(d.getTime() + my_duration);
                var my_hours = d.getHours(); if (my_hours < 10) my_hours = '0' + ( my_hours + '' );
                var my_minutes = d.getMinutes(); if (my_minutes < 10) my_minutes = '0' + ( my_minutes + '' );
                var my_end_time = ( my_hours + '' ) + ':' + ( my_minutes + '' ) ;
//alert(my_end_time);
                if( valid_time === true ) { // check end time for enterence into diapason
                       if(typeof( checkTimeInside ) == 'function') {valid_time = checkTimeInside(my_end_time, false, bk_type) ;}
                       if (element.value == '') valid_time = false;
                       if( valid_time !== true ) my_message = message_durationtime_error;
                }
           } else {
               // start time is not set so we can not check duration and end time
           }
        }



        // Check start and end time
        if ( ( element.className.indexOf('wpdev-validates-as-time') !== -1 ) ||  (element.name.indexOf('starttime') !== -1 ) || (element.name.indexOf('endtime') !== -1 ) )  {
            //var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            
            
            if (inp_value !== '' )  valid_time = IsValidTime(inp_value);
            if( valid_time === true ) // check start time for enterence into diapason
                   if ( element.name.indexOf('starttime') !== -1 ){
                       if(typeof( checkTimeInside ) == 'function') {valid_time = checkTimeInside(element.value, true, bk_type) ;}
                       if (element.value == '') valid_time = false;
                       if( valid_time !== true ) my_message = message_starttime_error;
                   }

            if( valid_time === true ) // check end time for enterence into diapason
                   if ( element.name.indexOf('endtime') !== -1 ){
                       if(typeof( checkTimeInside ) == 'function') {valid_time = checkTimeInside(element.value, false, bk_type) ;}
                       if (element.value == '') valid_time = false;
                       if( valid_time !== true ) my_message = message_endtime_error;
                   }


        }

        // Show message according not valid time
        if( valid_time !== true ) {
            jWPDev("[name='"+ element.name +"']")
                    .css( {'border' : '1px solid red'} )
                    .fadeOut( 350 )
                    .fadeIn( 500 )
                    .animate( {opacity: 1}, 4000 )
                    .animate({border : '1px solid #DFDFDF'},100)
            ;  // mark red border
            jWPDev("[name='"+ element.name +"']")
                    .after('<div class="wpdev-help-message">'+ my_message +'</div>'); // Show message
            jWPDev(".wpdev-help-message")
                    .css( {'color' : 'red'} )
                    .animate( {opacity: 1}, 10000 )
                    .fadeOut( 2000 );   // hide message
            element.focus();    // make focus to elemnt
            return true;
       }


        return false;
}


function wpdev_add_remark(id, text){
    document.getElementById("remark_row" + id ).style.display="none";

    var ajax_bk_message = 'Adding remark...';

    document.getElementById('ajax_working').innerHTML =
    '<div class="info_message ajax_message" id="ajax_message">\n\
        <div style="float:left;">'+ajax_bk_message+'</div> \n\
        <div  style="float:left;width:80px;margin-top:-3px;">\n\
               <img src="'+wpdev_bk_plugin_url+'/img/ajax-loader.gif">\n\
        </div>\n\
    </div>';

    var wpdev_ajax_path = wpdev_bk_plugin_url+'/' + wpdev_bk_plugin_filename ;
    
    jWPDev.ajax({                                           // Start Ajax Sending
        url: wpdev_ajax_path,
        type:'POST',
        success: function (data, textStatus){if( textStatus == 'success')   jWPDev('#ajax_respond').html( data );},
        error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
        // beforeSend: someFunction,
        data:{
            ajax_action : 'UPDATE_REMARK',
            remark_id : id,
            remark_text : text
        }
    });
    return false;

}

function showRemarkHint(id, text){

           jWPDev("#remarkhint" + id  ).tooltip( { //TODO I am changed here
                          tip:'#remarkhintcontent'+id,
                          predelay:0,
                          delay:0,
                          position:"top center",
                          offset:[2,0],
                          opacity:1
          });
}

function hideRemarkHint(id ){

}