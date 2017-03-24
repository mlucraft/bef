// Highlighting range days at calendar
var td_mouse_over = '';

// Check is this day booked or no
function is_this_day_booked(bk_type, td_class, i){ // is is not obligatory parameter

    if ( ( jWPDev('#calendar_booking'+bk_type+' .cal4date-' + td_class).hasClass('date_user_unavailable') ) || ( jWPDev('#calendar_booking'+bk_type+' .cal4date-' + td_class).hasClass('datepick-unselectable') )){ // If we find some unselect option so then make no selection at all in this range
                     document.body.style.cursor = 'default';  return true;
    }

    //Check if in selection range are reserved days, if so then do not make selection
    if(typeof(date_approved[ bk_type ]) !== 'undefined')
        if(typeof(date_approved[ bk_type ][ td_class ]) !== 'undefined') { //alert(date_approved[ bk_type ][ td_class ][0][5]);
              for (var j=0; j < date_approved[ bk_type ][ td_class ].length ; j++) {
                    if ( ( date_approved[ bk_type ][ td_class ][j][3] == 0) &&  ( date_approved[ bk_type ][ td_class ][j][4] == 0) )  { document.body.style.cursor = 'default';  return true; }
                    if ( ( (date_approved[ bk_type ][ td_class ][j][5] * 1) == 2 ) && (i!=0)) { document.body.style.cursor = 'default';  return true; }
              }
        }

    if(typeof( date2approve[ bk_type ]) !== 'undefined')
        if(typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined') {
              for ( j=0; j < date2approve[ bk_type ][ td_class ].length ; j++) {
                    if ( ( date2approve[ bk_type ][ td_class ][j][3] == 0) &&  ( date2approve[ bk_type ][ td_class ][j][4] == 0) )  { document.body.style.cursor = 'default';  return true; }
                    if ( ( (date2approve[ bk_type ][ td_class ][j][5] * 1) == 2 ) && (i!=0)) { document.body.style.cursor = 'default';  return true; }
              }
        }

    return false;
}



function hoverDayPro(value, date, bk_type) {

    if (date == null) return;

    var i=0 ; var j=0;
    var td_class;
    var td_overs = new Array();
    var td_element=0;

    if (is_select_range == 1) {
        if ( date == null) { return; }

        jWPDev('.datepick-days-cell-over').removeClass('datepick-days-cell-over');                          // clear all selections
        if (range_start_day != -1) {
            if (date.getDay() !=  range_start_day) {
                date.setDate(date.getDate() -  ( date.getDay() -  range_start_day )  );
            }
        }
        for( i=0; i < days_select_count ; i++) {  
            td_class =  (date.getMonth()+1) + '-' + date.getDate() + '-' + date.getFullYear();

            if (   is_this_day_booked(bk_type, td_class, i)   ) return ;   // check if day is booked
            
            td_overs[td_overs.length] = '#calendar_booking'+bk_type+ ' .cal4date-' + td_class;              // add to array for later make selection by class
            date.setDate(date.getDate() + 1);                                                               // Add 1 day to current day
        }

        for ( i=0; i < td_overs.length ; i++) {                                                             // add class to all elements
            td_element = jWPDev( td_overs[i] );
            td_element.addClass('datepick-days-cell-over');
        }        
        return ;
    }



    if ( wpdev_bk_is_dynamic_range_selection ) {
        if ( date == null) { return; }
        jWPDev('.datepick-days-cell-over').removeClass('datepick-days-cell-over');                          // clear all selections

        var inst = jWPDev.datepick._getInst(document.getElementById('calendar_booking'+bk_type));

        if ( (inst.dates.length == 0) || (inst.dates.length>1)  ) {  // Initial HIGHLIGHTING days in Dynamic range selection mode depends from start day and minimum numbers of days
            var selceted_first_day = new Date();
            selceted_first_day.setFullYear(date.getFullYear(),(date.getMonth()), (date.getDate() ) );
            if (range_start_day_dynamic != -1) {
                if (date.getDay() !=  range_start_day_dynamic) {
                    selceted_first_day.setDate(date.getDate() -  ( date.getDay() -  range_start_day_dynamic )  );
                }
            } i=0;
            while(    ( i < days_select_count_dynamic ) ) {
               i++;
               td_class =  (selceted_first_day.getMonth()+1) + '-' + selceted_first_day.getDate() + '-' + selceted_first_day.getFullYear();
               if (   is_this_day_booked(bk_type, td_class, (i-1))   ) return ;   // check if day is booked
               td_overs[td_overs.length] = '#calendar_booking'+bk_type+ ' .cal4date-' + td_class;              // add to array for later make selection by class
               selceted_first_day.setFullYear(selceted_first_day.getFullYear(),(selceted_first_day.getMonth()), (selceted_first_day.getDate() + 1) );
            }
        }


        if (inst.dates.length == 1) {  // select start date in Dynamic range selection, after first days is selected
            var selceted_first_day = new Date();
            selceted_first_day.setFullYear(inst.dates[0].getFullYear(),(inst.dates[0].getMonth()), (inst.dates[0].getDate() ) );
            
            var is_check = true;
            i=0;
            while(  (is_check ) || ( i < days_select_count_dynamic ) ) {
               i++;
               td_class =  (selceted_first_day.getMonth()+1) + '-' + selceted_first_day.getDate() + '-' + selceted_first_day.getFullYear();

                if (   is_this_day_booked(bk_type, td_class, (i-1))   ) return ;   // check if day is booked

                td_overs[td_overs.length] = '#calendar_booking'+bk_type+ ' .cal4date-' + td_class;              // add to array for later make selection by class

                if (   ( date.getMonth() == selceted_first_day.getMonth() )  &&
                       ( date.getDate() == selceted_first_day.getDate() )  &&
                       ( date.getFullYear() == selceted_first_day.getFullYear() )
                ){ is_check =  false; }

                if ((selceted_first_day > date ) && ( i >= days_select_count_dynamic )) {
                    is_check =  false;
                }
                selceted_first_day.setFullYear(selceted_first_day.getFullYear(),(selceted_first_day.getMonth()), (selceted_first_day.getDate() + 1) );
            }
        }
        for ( i=0; i < td_overs.length ; i++) {                                                             // add class to all elements
            td_element = jWPDev( td_overs[i] );
            td_element.addClass('datepick-days-cell-over');
        }
        return ;
    }

   

}

// Make range select
function selectDayPro(all_dates,   bk_type){

     if(typeof( prepare_tooltip ) == 'function') { setTimeout("prepare_tooltip("+bk_type+");",1000); }

     var inst = jWPDev.datepick._getInst(document.getElementById('calendar_booking'+bk_type));
     var td_class;

     if ((is_select_range == 1) || (wpdev_bk_is_dynamic_range_selection == true) ) {  // Start range selections checking

        var internal_days_select_count = days_select_count;

        if ( all_dates.indexOf(' - ') != -1 ){                  // Dynamic selections
            var start_end_date = all_dates.split(" - ");
            if ( start_end_date[0] == start_end_date[1] ) {    // First click at day
              if (range_start_day_dynamic != -1) {             // Activated some specific week day start range selectiosn
                    var start_dynamic_date = start_end_date[0].split(".");
                    var real_start_dynamic_date=new Date();
                    real_start_dynamic_date.setFullYear( start_dynamic_date[2],  start_dynamic_date[1]-1,  start_dynamic_date[0] );    // get date of click

                    if (real_start_dynamic_date.getDay() !=  range_start_day_dynamic) {
                                real_start_dynamic_date.setDate(real_start_dynamic_date.getDate() -  ( real_start_dynamic_date.getDay() -  range_start_day_dynamic )  );

                                all_dates = jWPDev.datepick._formatDate(inst, real_start_dynamic_date );
                                all_dates += ' - ' + all_dates ;
                                jWPDev('#date_booking' + bk_type).val(all_dates); // Fill the input box
                        
                                // check this day for already booked
                                var selceted_first_day = new Date;
                                selceted_first_day.setFullYear(real_start_dynamic_date.getFullYear(),(real_start_dynamic_date.getMonth()), (real_start_dynamic_date.getDate() + 1) );
                                i=0;
                                while(    ( i < days_select_count_dynamic ) ) {
                                   i++;
                                   td_class =  (selceted_first_day.getMonth()+1) + '-' + selceted_first_day.getDate() + '-' + selceted_first_day.getFullYear();
                                   if (   is_this_day_booked(bk_type, td_class, (i))   ) {
                                               inst.dates=[];
                                               jWPDev.datepick._updateDatepick(inst);
                                               return false;   // check if day is booked
                                   } 
                                   selceted_first_day.setFullYear(selceted_first_day.getFullYear(),(selceted_first_day.getMonth()), (selceted_first_day.getDate() + 1) );
                                }

                                // Selection of the day
                                inst.cursorDate.setFullYear(real_start_dynamic_date.getFullYear(),(real_start_dynamic_date.getMonth()), (real_start_dynamic_date.getDate() ) );
                                inst.dates=[inst.cursorDate];
                                jWPDev.datepick._updateDatepick(inst);
                     }
              }  return false;
            } else {
                    var start_dynamic_date = start_end_date[0].split(".");
                    var real_start_dynamic_date=new Date();
                    real_start_dynamic_date.setFullYear( start_dynamic_date[2],  start_dynamic_date[1]-1,  start_dynamic_date[0] );    // get date

                    var end_dynamic_date = start_end_date[1].split(".");
                    var real_end_dynamic_date=new Date();
                    real_end_dynamic_date.setFullYear( end_dynamic_date[2],  end_dynamic_date[1]-1,  end_dynamic_date[0] );    // get date

                    internal_days_select_count = 2; // need to count how many days right now
                    
                    var temp_date_for_count = new Date();
                    
                    for( var j1=1; j1 < 365 ; j1++) {
                        temp_date_for_count = new Date();
                        temp_date_for_count.setFullYear(real_start_dynamic_date.getFullYear(),(real_start_dynamic_date.getMonth()), (real_start_dynamic_date.getDate() + j1) );

                        if ( (temp_date_for_count.getFullYear() == real_end_dynamic_date.getFullYear()) && (temp_date_for_count.getMonth() == real_end_dynamic_date.getMonth()) && (temp_date_for_count.getDate() == real_end_dynamic_date.getDate()) )  {
                            internal_days_select_count = j1;
                            j1=1000;
                        }
                    }
                    internal_days_select_count++;
                    all_dates =  start_end_date[0];
                    if (internal_days_select_count < days_select_count_dynamic ) internal_days_select_count = days_select_count_dynamic;
            }
        } // And Range selections checking


         var temp_is_select_range = is_select_range;
         is_select_range = 0;
         var temp_wpdev_bk_is_dynamic_range_selection = wpdev_bk_is_dynamic_range_selection;
         wpdev_bk_is_dynamic_range_selection = false;

       

        inst.dates = [];                                        // Emty dates in datepicker
        var all_dates_array;
        var date_array;
        var date;
        var date_to_ins;

        // Get array of dates
        if ( all_dates.indexOf(',') == -1 ) { all_dates_array = [all_dates];          }
        else                                { all_dates_array = all_dates.split(","); }

        var original_array = [];
        var isMakeSelection = false;

        if (! temp_wpdev_bk_is_dynamic_range_selection ) {
                // Gathering original (already selected dates) date array
                for( var j=0; j < all_dates_array.length ; j++) {                           //loop array of dates
                    all_dates_array[j] = all_dates_array[j].replace(/(^\s+)|(\s+$)/g, "");  // trim white spaces in date string

                    date_array = all_dates_array[j].split(".");                             // get single date array

                    date=new Date();
                    date.setFullYear( date_array[2],  date_array[1]-1,  date_array[0] );    // get date

                    if ( (date.getFullYear() == inst.cursorDate.getFullYear()) && (date.getMonth() == inst.cursorDate.getMonth()) && (date.getDate() == inst.cursorDate.getDate()) )  {
                        isMakeSelection = true;
                                if (range_start_day != -1) {
                                    if (inst.cursorDate.getDay() !=  range_start_day) {
                                        inst.cursorDate.setDate(inst.cursorDate.getDate() -  ( inst.cursorDate.getDay() -  range_start_day )  );
                                    }
                                }
                    }
                    //original_array.push( jWPDev.datepick._restrictMinMax(inst, jWPDev.datepick._determineDate(inst, date, null))  ); //add date
                }
        } else {
            // dynamic range selection
            isMakeSelection = true;
        }
        var isEmptySelection = false;
        if (isMakeSelection) {
                    var date_start_range = inst.cursorDate;

                    if (! temp_wpdev_bk_is_dynamic_range_selection ) {
                        original_array.push( jWPDev.datepick._restrictMinMax(inst, jWPDev.datepick._determineDate(inst, inst.cursorDate , null))  ); //add date
                    } else {
                        original_array.push( jWPDev.datepick._restrictMinMax(inst, jWPDev.datepick._determineDate(inst, real_start_dynamic_date , null))  ); //set 1st date from dynamic range
                        date_start_range = real_start_dynamic_date;
                    }
                    var dates_array = [];
                    var range_array = [];
                    var td;
                    // Add dates to the range array
                    for( var i=1; i < internal_days_select_count ; i++) {

                        dates_array[i] = new Date();
                        // dates_array[i].setDate( (date_start_range.getDate() + i) );

                        dates_array[i].setFullYear(date_start_range.getFullYear(),(date_start_range.getMonth()), (date_start_range.getDate() + i) );

                        td_class =  (dates_array[i].getMonth()+1) + '-'  +  dates_array[i].getDate() + '-' + dates_array[i].getFullYear();
                        td =  '#calendar_booking'+bk_type+' .cal4date-' + td_class;
                         if (jWPDev(td).hasClass('datepick-unselectable') ){ // If we find some unselect option so then make no selection at all in this range
                             isEmptySelection = true;
                        }

                        //Check if in selection range are reserved days, if so then do not make selection
                        if (   is_this_day_booked(bk_type, td_class, i)   ) isEmptySelection = true;
                        /////////////////////////////////////////////////////////////////////////////////////

                        date_to_ins =  jWPDev.datepick._restrictMinMax(inst, jWPDev.datepick._determineDate(inst, dates_array[i], null));

                        range_array.push( date_to_ins );
                    }

                    // check if some dates are the same in the arrays so the remove them from both
                    for( i=0; i < range_array.length ; i++) {
                        for( j=0; j < original_array.length ; j++) {       //loop array of dates

                        if ( (original_array[j] != -1) && (range_array[i] != -1) )
                            if ( (range_array[i].getFullYear() == original_array[j].getFullYear()) && (range_array[i].getMonth() == original_array[j].getMonth()) && (range_array[i].getDate() == original_array[j].getDate()) )  {
                                range_array[i] = -1;
                                original_array[j] = -1;
                            }
                        }
                    }

                    // Add to the dates array
                    for( j=0; j < original_array.length ; j++) {       //loop array of dates
                            if (original_array[j] != -1) inst.dates.push(original_array[j]);
                    }
                    for( i=0; i < range_array.length ; i++) {
                            if (range_array[i] != -1) inst.dates.push(range_array[i]);
                    }
        }  
        if (isEmptySelection) inst.dates=[];

        //jWPDev.datepick._setDate(inst, dates_array);
        if (! temp_wpdev_bk_is_dynamic_range_selection ) {
            jWPDev.datepick._updateInput('#calendar_booking'+bk_type);
        } else {
           if (isEmptySelection) jWPDev.datepick._updateInput('#calendar_booking'+bk_type);
           else {       // Dynamic range selections, transform days from jWPDev.datepick
                       dateStr = (inst.dates.length == 0 ? '' : jWPDev.datepick._formatDate(inst, inst.dates[0])); // Get first date
                        for ( i = 1; i < inst.dates.length; i++)
                             dateStr += jWPDev.datepick._get(inst, 'multiSeparator') +  jWPDev.datepick._formatDate(inst, inst.dates[i]);  // Gathering all dates
                        jWPDev('#date_booking' + bk_type).val(dateStr); // Fill the input box
           }
        }
        jWPDev.datepick._notifyChange(inst);
        jWPDev.datepick._adjustInstDate(inst);
        jWPDev.datepick._showDate(inst);
        //jWPDev.datepick._updateDatepick(inst);
         wpdev_bk_is_dynamic_range_selection = temp_wpdev_bk_is_dynamic_range_selection;
         is_select_range =temp_is_select_range;

     } else { // HERE WE WILL DISABLE ALL OPTIONS IN RANGE TIME INTERVALS FOR SINGLE DAYS SELECTIONS FOR THAT DAYS WHERE HOURS ALREADY BOOKED
         //here is not range selections
         if (multiple_day_selections == 0){   // Only single day selections here

                var current_single_day_selections  = all_dates.split('.');
                td_class =  (current_single_day_selections[1]*1) + '-' + (current_single_day_selections[0]*1) + '-' + (current_single_day_selections[2]*1);
                var times_array = [];

               jWPDev('select[name=rangetime' + bk_type + '] option:disabled').removeAttr('disabled');  // Make active all times

               var range_time_object = jWPDev('select[name=rangetime' + bk_type + '] option:first' ) ;
               if (range_time_object == undefined) return;  // WE DO NOT HAVE RANGE SELECTIONS AT THIS FORM SO JUST RETURN
                
               // Get dates and time from aproved dates
               if(typeof(date_approved[ bk_type ]) !== 'undefined')
               if(typeof(date_approved[ bk_type ][ td_class ]) !== 'undefined') {
                 if( ( date_approved[ bk_type ][ td_class ][0][3] != 0) ||  ( date_approved[ bk_type ][ td_class ][0][4] != 0) ) {
                     for ( i=0; i< date_approved[ bk_type ][ td_class ].length; i++){
                        h = date_approved[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
                        m = date_approved[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
                        s = date_approved[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
                        times_array[ times_array.length ] = [h,m,s];
                     }
                 }
               }

               // Get dates and time from pending dates
               if(typeof( date2approve[ bk_type ]) !== 'undefined')
               if(typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined')
                 if( ( date2approve[ bk_type ][ td_class ][0][3] != 0) ||  ( date2approve[ bk_type ][ td_class ][0][4] != 0) ) //check for time here
                   {  for ( i=0; i< date2approve[ bk_type ][ td_class ].length; i++){
                        h = date2approve[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
                        m = date2approve[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
                        s = date2approve[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
                        times_array[ times_array.length ] = [h,m,s];
                      }
                   }


                    times_array.sort();
                    var my_time_value = '';var j;
                    for ( var i=0; i< times_array.length; i++){  // s = 2 - end time,   s = 1 - start time
                       s = parseInt( times_array[i][2] );

                       if ( i > 0 ) {

                            if ( s == 2 )
                                {  my_range_time = times_array[i-1][0] + ':' + times_array[i-1][1] + ' - ' + times_array[i][0] + ':' + times_array[i][1]  ;

                                   my_time_value = jWPDev('select[name=rangetime' + bk_type + '] option');
                                   for ( j=0; j< my_time_value.length; j++){
                                      if (my_time_value[j].value == my_range_time ) {  // Mark as disable this option
                                           jWPDev('select[name=rangetime' + bk_type + '] option:eq('+j+')').attr('disabled', 'disabled'); // Make disable some options
                                           if(  jWPDev('select[name=rangetime' + bk_type + '] option:eq('+j+')').attr('selected')  ){  // iF THIS ELEMENT IS SELECTED SO REMOVE IT FROM THIS TIME
                                               jWPDev('select[name=rangetime' + bk_type + '] option:eq('+j+')').removeAttr('selected');
                                           }

                                      }
                                   }
                                }

                       }

                    }






         }
     }

 }


// Times

function isDayFullByTime(bk_type, td_class ) {

   var times_array = [];

   // Get dates and time from aproved dates
   if(typeof(date_approved[ bk_type ]) !== 'undefined')
   if(typeof(date_approved[ bk_type ][ td_class ]) !== 'undefined') {
     if( ( date_approved[ bk_type ][ td_class ][0][3] != 0) ||  ( date_approved[ bk_type ][ td_class ][0][4] != 0) ) {
         for ( i=0; i< date_approved[ bk_type ][ td_class ].length; i++){
            h = date_approved[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
            m = date_approved[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
            s = date_approved[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
            times_array[ times_array.length ] = [h,m,s];
         }
     }
   }

   // Get dates and time from pending dates
   if(typeof( date2approve[ bk_type ]) !== 'undefined')
   if(typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined')
     if( ( date2approve[ bk_type ][ td_class ][0][3] != 0) ||  ( date2approve[ bk_type ][ td_class ][0][4] != 0) ) //check for time here
       {  for ( i=0; i< date2approve[ bk_type ][ td_class ].length; i++){
            h = date2approve[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
            m = date2approve[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
            s = date2approve[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
            times_array[ times_array.length ] = [h,m,s];
          }
       }

    times_array.sort();

    for ( var i=0; i< times_array.length; i++){  // s = 2 - end time,   s = 1 - start time
       s = parseInt( times_array[i][2] );

       if  (i == 0)
            if  (s !== 2)  { return false; } // Its not start at the start of day

       if ( i > 0 ) {

            if ( s == 1 )
                if  ( !( ( times_array[i-1][0] == times_array[i][0] ) &&  ( times_array[i-1][1] == times_array[i][1] ) ) ) {
                        return false; // previos time is not equal to current so we have some free interval
                }

       }

       if (i == ( times_array.length-1))
               if (s !== 1)   { return false; } // Its not end  at the end of day

    }
    return true;
}


function hoverDayTime(value, date, bk_type) {  

    if (date == null) return;

    var i=0 ; var h ='' ; var m ='' ; var s='';
    var td_class;


   // Gathering information hint for tooltips ////////////////////////////////
   var tooltip_time = '';
   var times_array = [];
   td_class =  (date.getMonth()+1) + '-' + date.getDate() + '-' + date.getFullYear();

   // Get dates and time from aproved dates
   if(typeof(date_approved[ bk_type ]) !== 'undefined')
   if(typeof(date_approved[ bk_type ][ td_class ]) !== 'undefined') {
     if( ( date_approved[ bk_type ][ td_class ][0][3] != 0) ||  ( date_approved[ bk_type ][ td_class ][0][4] != 0) ) {
         for ( i=0; i< date_approved[ bk_type ][ td_class ].length; i++){
            h = date_approved[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
            m = date_approved[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
            s = date_approved[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
            times_array[ times_array.length ] = [h,m,s];
         }
     }
   }

   // Get dates and time from pending dates
   if(typeof( date2approve[ bk_type ]) !== 'undefined')
   if(typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined')
     if( ( date2approve[ bk_type ][ td_class ][0][3] != 0) ||  ( date2approve[ bk_type ][ td_class ][0][4] != 0) ) //check for time here
       {  for ( i=0; i< date2approve[ bk_type ][ td_class ].length; i++){
            h = date2approve[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
            m = date2approve[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
            s = date2approve[ bk_type ][ td_class ][i][5]; if (s == 2) s = '02';
            times_array[ times_array.length ] = [h,m,s];
          }
       }

//alert(times_array);
   // Time availability
   if (typeof( hover_day_check_global_time_availability ) == 'function') { times_array = hover_day_check_global_time_availability( date, bk_type ,times_array); }

    times_array.sort();
// if (times_array.length>0) alert(times_array);
    for ( i=0; i< times_array.length; i++){  // s = 2 - end time,   s = 1 - start time
       s = parseInt( times_array[i][2] );
       if (s == 2) { if (tooltip_time == '') tooltip_time = '&nbsp;&nbsp;&nbsp;&nbsp;...&nbsp;&nbsp;&nbsp; - ';  }      // End time and before was no dates so its start from start of date
       if ( (tooltip_time == '') && (times_array[i][0]=='00') && (times_array[i][1]=='00') )
           tooltip_time = '&nbsp;&nbsp;&nbsp;&nbsp;...&nbsp;&nbsp;&nbsp;';  //start date at the midnight
       else if ( (i == ( times_array.length-1)) && (times_array[i][0]=='23') && (times_array[i][1]=='59') )
        tooltip_time += ' &nbsp;&nbsp;&nbsp;&nbsp;... ';
       else /**/
        tooltip_time += times_array[i][0] + ':' + times_array[i][1];
       if (s == 1) { tooltip_time += ' - '; if (i == ( times_array.length-1)) tooltip_time += ' &nbsp;&nbsp;&nbsp;&nbsp;... ';  }
       if (s == 2) { tooltip_time += '<br/>'; } /**/
    }

    // jWPDev( '#calendar_booking'+bk_type+' td.cal4date-'+td_class )  // TODO: continue working here, check unshow times at full booked days
    if ( tooltip_time.indexOf("undefined") > -1 ) {  tooltip_time = ''; }
    if(typeof( getDayPrice4Show ) == 'function') { tooltip_time = getDayPrice4Show(bk_type, tooltip_time, td_class); }  //TODO I am changed here
    if(typeof( getDayAvailability4Show ) == 'function') { tooltip_time = getDayAvailability4Show(bk_type, tooltip_time, td_class); }  //TODO I am changed here

    jWPDev( '#demotip'+bk_type ).html( tooltip_time );
    ////////////////////////////////////////////////////////////////////////

}


function isTimeTodayGone(myTime, sort_date_array){

    if (( sort_date_array[0][0] == wpdev_bk_today[0] ) && ( sort_date_array[0][1] == wpdev_bk_today[1]  ) && ( sort_date_array[0][2] == wpdev_bk_today[2]  )) {
        var mytime_value = myTime.split(":");
        mytime_value = mytime_value[0]*60 + parseInt(mytime_value[1]);

        var current_time_value = wpdev_bk_today[3]*60 + parseInt(wpdev_bk_today[4]);

        if ( current_time_value  > mytime_value ) return true;

    }

    return false;
}


var start_time_checking_index;
// Function check start and end time at selected days
function checkTimeInside( mytime, is_start_time, bk_type ) {

    // Check time availability for global filters
    if(typeof( check_entered_time_to_global_availability_time ) == 'function') { if (! check_entered_time_to_global_availability_time(mytime, is_start_time, bk_type) ) return false; }

    var my_dates_str = document.getElementById('date_booking'+ bk_type ).value;                 // GET DATES From TEXTAREA

    var date_array = my_dates_str.split(", ");
    if (date_array.length == 2) { // This recheck is need for editing booking, with single day 
        if (date_array[0]==date_array[1]) {
            date_array = [ date_array[0] ];
        }
    }

    var temp_elemnt;  var td_class; var sort_date_array = []; var work_date_array = []; var times_array = []; var is_check_for_time;

    for (var i=0; i< date_array.length; i++) {  // Get SORTED selected days array
        temp_elemnt = date_array[i].split(".");
        sort_date_array[i] = [ temp_elemnt[2], temp_elemnt[1] + '', temp_elemnt[0] + '' ]; // [2009,7,1],...
    }
    sort_date_array.sort();                                                                   // SORT    D a t e s
    for (i=0; i< sort_date_array.length; i++) {                                  // trnasform to integers
        sort_date_array[i] = [ parseInt(sort_date_array[i][0]*1), parseInt(sort_date_array[i][1]*1), parseInt(sort_date_array[i][2]*1) ]; // [2009,7,1],...
    }

    if (is_start_time) {
        if ( isTimeTodayGone(mytime, sort_date_array) )  return false;
    }
    //  CHECK FOR BOOKING INSIDE OF     S E L E C T E D    DAY RANGE AND FOR TOTALLY BOOKED DAYS AT THE START AND END OF RANGE
    work_date_array =  sort_date_array;
    for (var j=0; j< work_date_array.length; j++) {
        td_class =  work_date_array[j][1] + '-' + work_date_array[j][2] + '-' + work_date_array[j][0];

        if ( (j==0) || (j == (work_date_array.length-1)) ) is_check_for_time = true;         // Check for time only start and end time
        else                                               is_check_for_time = false;

        // Get dates and time from pending dates
        if(typeof( date2approve[ bk_type ]) !== 'undefined') {
          if ( (typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined') ) {
             if (! is_check_for_time) { return false; } // its mean that this date is booked inside of range selected dates
             if( ( date2approve[ bk_type ][ td_class ][0][3] != 0) ||  ( date2approve[ bk_type ][ td_class ][0][4] != 0) ) {
                 // Evrything good - some time is booked check later
             } else {  return false; } // its mean that this date tottally booked
          }
        }

        // Get dates and time from pending dates
        if(typeof( date_approved[ bk_type ]) !== 'undefined') {
          if ( (typeof( date_approved[ bk_type ][ td_class ]) !== 'undefined') ) {
             if (! is_check_for_time) { return false; } // its mean that this date is booked inside of range selected dates
             if( ( date_approved[ bk_type ][ td_class ][0][3] != 0) ||  ( date_approved[ bk_type ][ td_class ][0][4] != 0) ) {
                 // Evrything good - some time is booked check later
             } else {  return false; } // its mean that this date tottally booked
          }
        }
    }  ///////////////////////////////////////////////////////////////////////////////////////////////////////


     // Check    START   OR    END   time for time no in correct fee range
     if (is_start_time ) work_date_array =  sort_date_array[0] ;
     else                work_date_array =  sort_date_array[sort_date_array.length-1] ;

     td_class =  work_date_array[1] + '-' + work_date_array[2] + '-' + work_date_array[0];

        // Get dates and time from pending dates
        if(typeof( date2approve[ bk_type ]) !== 'undefined')
          if(typeof( date2approve[ bk_type ][ td_class ]) !== 'undefined')
              for ( i=0; i< date2approve[ bk_type ][ td_class ].length; i++){
                h = date2approve[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
                m = date2approve[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
                s = date2approve[ bk_type ][ td_class ][i][5];
                times_array[ times_array.length ] = [h,m,s];
              }

        // Get dates and time from pending dates
        if(typeof( date_approved[ bk_type ]) !== 'undefined')
          if(typeof( date_approved[ bk_type ][ td_class ]) !== 'undefined')
              for ( i=0; i< date_approved[ bk_type ][ td_class ].length; i++){
                h = date_approved[ bk_type ][ td_class ][i][3]; if (h < 10) h = '0' + h;if (h == 0) h = '00';
                m = date_approved[ bk_type ][ td_class ][i][4]; if (m < 10) m = '0' + m;if (m == 0) m = '00';
                s = date_approved[ bk_type ][ td_class ][i][5];
                times_array[ times_array.length ] = [h,m,s];
              }


        times_array.sort();                     // SORT TIMES

        var times_in_day = [];                  // array with all times
        var times_in_day_interval_marks = [];   // array with time interval marks 1- stsrt time 2 - end time


        for ( i=0; i< times_array.length; i++){  s = times_array[i][2];         // s = 2 - end time,   s = 1 - start time
           // Start close interval
           if ( (s == 2) &&  (i == 0) ) { times_in_day[ times_in_day.length ] = 0; times_in_day_interval_marks[times_in_day_interval_marks.length]=1; }
           // Normal
           times_in_day[ times_in_day.length ] = times_array[i][0] * 60 + parseInt(times_array[i][1]);
           times_in_day_interval_marks[times_in_day_interval_marks.length]=s;
           // End close interval
           if ( (s == 1) &&  (i == (times_array.length-1)) ) { times_in_day[ times_in_day.length ] = (24*60);  times_in_day_interval_marks[times_in_day_interval_marks.length]=2; }
        }

        // Get time from entered time
        var mytime_value = mytime.split(":");
        mytime_value = mytime_value[0]*60 + parseInt(mytime_value[1]);

//alert('My time:'+ mytime_value + '  List of times: '+ times_in_day + '  Saved indexes: ' + start_time_checking_index + ' Days: ' + sort_date_array ) ;

        var start_i = 0;
        if (start_time_checking_index != undefined)
            if (start_time_checking_index[0] != undefined)
                if ( (! is_start_time) && (sort_date_array.length == 1) ) { start_i = start_time_checking_index[0]; /*start_i++;*/ }
        i=start_i;

        // Main checking inside a day
        for ( i=start_i; i< times_in_day.length; i++){
            if (is_start_time ) {
                if ( mytime_value > times_in_day[i] ){
                    // Its Ok, lets Loop to next item
                } else if ( mytime_value == times_in_day[i] ) {
                    if (times_in_day_interval_marks[i] == 1 ) { return false;     //start time is begin with some other interval
                    } else {
                        if ( (i+1) <= (times_in_day.length-1) ) {
                            if ( times_in_day[i+1] <= mytime_value ) return false;  //start time  is begin with next elemnt interval
                            else  {                                                 // start time from end of some other
                                if (sort_date_array.length > 1)
                                    if ( (i+1) <= (times_in_day.length-1) ) return false;   // Its mean that we make end booking at some other day then this and we have some booking time at this day after start booking  - its wrong
                                start_time_checking_index = [i, td_class,mytime_value];
                                return true;
                            }
                        }
                        if (sort_date_array.length > 1)
                            if ( (i+1) <= (times_in_day.length-1) ) return false;   // Its mean that we make end booking at some other day then this and we have some booking time at this day after start booking  - its wrong
                        start_time_checking_index = [i, td_class,mytime_value];
                        return true;                                            // start time from end of some other
                    }
                } else  if ( mytime_value < times_in_day[i] ) {
                    if (times_in_day_interval_marks[i] == 2 ){ return false;     // start time inside of some interval
                    } else {
                        if (sort_date_array.length > 1)
                            if ( (i+1) <= (times_in_day.length-1) ) return false;   // Its mean that we make end booking at some other day then this and we have some booking time at this day after start booking  - its wrong
                        start_time_checking_index = [i, td_class,mytime_value];
                        return true;
                    }
                }
            } else {
                if (sort_date_array.length == 1) {

                   if (start_time_checking_index !=undefined)
                       if (start_time_checking_index[2]!=undefined)

                            if ( ( start_time_checking_index[2] == times_in_day[i] ) && ( times_in_day_interval_marks[i] == 2) ) {    // Good, because start time = end of some other interval and we need to get next interval for current end time.
                            } else if ( times_in_day[i] < mytime_value ) return false;                 // some interval begins before end of curent "end time"
                            else {
                                if (start_time_checking_index[2]>= mytime_value) return false;  // we are select only one day and end time is earlythe starttime its wrong
                                return true;                                                    // if we selected only one day so evrything is fine and end time no inside some other intervals
                            }
                } else {
                    if ( times_in_day[i] < mytime_value ) return false;                 // Some other interval start before we make end time in the booking at the end day selection
                    else                                  return true;
                }

            }
        }

        if (is_start_time )  start_time_checking_index = [i, td_class,mytime_value];
        else {
           if (start_time_checking_index !=undefined)
               if (start_time_checking_index[2]!=undefined)
                    if ( (sort_date_array.length == 1) && (start_time_checking_index[2]>= mytime_value) ) return false;  // we are select only one day and end time is earlythe starttime its wrong
        }
        return true;
}