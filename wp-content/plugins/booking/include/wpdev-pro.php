<?php
/*
This is COMMERSIAL SCRIPT
We are do not guarantee correct work and support of Booking Calendar, if some file(s) was modified by someone else then wpdevelop.
If you want to have customization, please contact by email - info@wpdevelop.com
*/
if (!function_exists ('get_option')) { die('You do not have permission to direct access to this file !!!'); } 
if (file_exists(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-premium.php')) { require_once(WPDEV_BK_PLUGIN_DIR. '/include/wpdev-premium.php' ); }

// Load Country list
if (file_exists(WPDEV_BK_PLUGIN_DIR. '/languages/wpdev-country-list.php')) { require_once(WPDEV_BK_PLUGIN_DIR. '/languages/wpdev-country-list.php' ); }

if (!class_exists('wpdev_bk_pro')) {
    class wpdev_bk_pro   {

        var $current_booking_type;
        var $wpdev_bk_premium;
        var $current_edit_booking;
        var $countries_list;

        function wpdev_bk_pro() {
            $this->current_booking_type = 1;
            $this->current_edit_booking = false;

            add_bk_filter('get_bk_dates_sql', array(&$this, 'get_bk_dates_4_edit'));  // At hotel edition already edit it

            add_bk_action('show_remark_editing_field', array(&$this, 'show_remark_editing_field'));  // Show fields for editing
            add_bk_action('show_remark_hint', array(&$this, 'show_remark_hint'));                    // Show reamrk hints
            add_bk_action('wpdev_updating_remark', array(&$this, 'wpdev_updating_remark'));          // Ajax POST request for updating remark

            add_bk_action('wpdev_booking_settings_show_content', array(&$this, 'settings_menu_content'));

            add_action('wpdev_bk_js_define_variables', array(&$this, 'js_define_variables') );      // Write JS variables
            add_action('wpdev_bk_js_write_files', array(&$this, 'js_write_files') );

            add_bk_action('wpdev_booking_activation', array(&$this, 'pro_activate'));
            add_bk_action('wpdev_booking_deactivation', array(&$this, 'pro_deactivate'));

            if ( class_exists('wpdev_bk_premium')) {
                    $this->wpdev_bk_premium = new wpdev_bk_premium();
            } else { $this->wpdev_bk_premium = false; }

            global $wpdev_booking_country_list;
            $this->countries_list = $wpdev_booking_country_list;


/*            // ISO 3166-1 country names and codes from http://opencountrycodes.appspot.com/javascript
            $this->countries_list = array(
                                            "GB" => "United Kingdom",
                                            "AF" => "Afghanistan",
                                            "AX" => "Aland Islands",
                                            "AL" => "Albania",
                                            "DZ" => "Algeria",
                                            "AS" => "American Samoa",
                                            "AD" => "Andorra",
                                            "AO" => "Angola",
                                            "AI" => "Anguilla",
                                            "AQ" => "Antarctica",
                                            "AG" => "Antigua and Barbuda",
                                            "AR" => "Argentina",
                                            "AM" => "Armenia",
                                            "AW" => "Aruba",
                                            "AU" => "Australia",
                                            "AT" => "Austria",
                                            "AZ" => "Azerbaijan",
                                            "BS" => "Bahamas",
                                            "BH" => "Bahrain",
                                            "BD" => "Bangladesh",
                                            "BB" => "Barbados",
                                            "BY" => "Belarus",
                                            "BE" => "Belgium",
                                            "BZ" => "Belize",
                                            "BJ" => "Benin",
                                            "BM" => "Bermuda",
                                            "BT" => "Bhutan",
                                            "BO" => "Bolivia",
                                            "BA" => "Bosnia and Herzegovina",
                                            "BW" => "Botswana",
                                            "BV" => "Bouvet Island",
                                            "BR" => "Brazil",
                                            "IO" => "British Indian Ocean Territory",
                                            "BN" => "Brunei Darussalam",
                                            "BG" => "Bulgaria",
                                            "BF" => "Burkina Faso",
                                            "BI" => "Burundi",
                                            "KH" => "Cambodia",
                                            "CM" => "Cameroon",
                                            "CA" => "Canada",
                                            "CV" => "Cape Verde",
                                            "KY" => "Cayman Islands",
                                            "CF" => "Central African Republic",
                                            "TD" => "Chad",
                                            "CL" => "Chile",
                                            "CN" => "China",
                                            "CX" => "Christmas Island",
                                            "CC" => "Cocos (Keeling) Islands",
                                            "CO" => "Colombia",
                                            "KM" => "Comoros",
                                            "CG" => "Congo",
                                            "CD" => "Congo, The Democratic Republic of the",
                                            "CK" => "Cook Islands",
                                            "CR" => "Costa Rica",
                                            "CI" => "Côte d'Ivoire",
                                            "HR" => "Croatia",
                                            "CU" => "Cuba",
                                            "CY" => "Cyprus",
                                            "CZ" => "Czech Republic",
                                            "DK" => "Denmark",
                                            "DJ" => "Djibouti",
                                            "DM" => "Dominica",
                                            "DO" => "Dominican Republic",
                                            "EC" => "Ecuador",
                                            "EG" => "Egypt",
                                            "SV" => "El Salvador",
                                            "GQ" => "Equatorial Guinea",
                                            "ER" => "Eritrea",
                                            "EE" => "Estonia",
                                            "ET" => "Ethiopia",
                                            "FK" => "Falkland Islands (Malvinas)",
                                            "FO" => "Faroe Islands",
                                            "FJ" => "Fiji",
                                            "FI" => "Finland",
                                            "FR" => "France",
                                            "GF" => "French Guiana",
                                            "PF" => "French Polynesia",
                                            "TF" => "French Southern Territories",
                                            "GA" => "Gabon",
                                            "GM" => "Gambia",
                                            "GE" => "Georgia",
                                            "DE" => "Germany",
                                            "GH" => "Ghana",
                                            "GI" => "Gibraltar",
                                            "GR" => "Greece",
                                            "GL" => "Greenland",
                                            "GD" => "Grenada",
                                            "GP" => "Guadeloupe",
                                            "GU" => "Guam",
                                            "GT" => "Guatemala",
                                            "GG" => "Guernsey",
                                            "GN" => "Guinea",
                                            "GW" => "Guinea-Bissau",
                                            "GY" => "Guyana",
                                            "HT" => "Haiti",
                                            "HM" => "Heard Island and McDonald Islands",
                                            "VA" => "Holy See (Vatican City State)",
                                            "HN" => "Honduras",
                                            "HK" => "Hong Kong",
                                            "HU" => "Hungary",
                                            "IS" => "Iceland",
                                            "IN" => "India",
                                            "ID" => "Indonesia",
                                            "IR" => "Iran, Islamic Republic of",
                                            "IQ" => "Iraq",
                                            "IE" => "Ireland",
                                            "IM" => "Isle of Man",
                                            "IL" => "Israel",
                                            "IT" => "Italy",
                                            "JM" => "Jamaica",
                                            "JP" => "Japan",
                                            "JE" => "Jersey",
                                            "JO" => "Jordan",
                                            "KZ" => "Kazakhstan",
                                            "KE" => "Kenya",
                                            "KI" => "Kiribati",
                                            "KP" => "Korea, Democratic People's Republic of",
                                            "KR" => "Korea, Republic of",
                                            "KW" => "Kuwait",
                                            "KG" => "Kyrgyzstan",
                                            "LA" => "Lao People's Democratic Republic",
                                            "LV" => "Latvia",
                                            "LB" => "Lebanon",
                                            "LS" => "Lesotho",
                                            "LR" => "Liberia",
                                            "LY" => "Libyan Arab Jamahiriya",
                                            "LI" => "Liechtenstein",
                                            "LT" => "Lithuania",
                                            "LU" => "Luxembourg",
                                            "MO" => "Macao",
                                            "MK" => "Macedonia, The Former Yugoslav Republic of",
                                            "MG" => "Madagascar",
                                            "MW" => "Malawi",
                                            "MY" => "Malaysia",
                                            "MV" => "Maldives",
                                            "ML" => "Mali",
                                            "MT" => "Malta",
                                            "MH" => "Marshall Islands",
                                            "MQ" => "Martinique",
                                            "MR" => "Mauritania",
                                            "MU" => "Mauritius",
                                            "YT" => "Mayotte",
                                            "MX" => "Mexico",
                                            "FM" => "Micronesia, Federated States of",
                                            "MD" => "Moldova",
                                            "MC" => "Monaco",
                                            "MN" => "Mongolia",
                                            "ME" => "Montenegro",
                                            "MS" => "Montserrat",
                                            "MA" => "Morocco",
                                            "MZ" => "Mozambique",
                                            "MM" => "Myanmar",
                                            "NA" => "Namibia",
                                            "NR" => "Nauru",
                                            "NP" => "Nepal",
                                            "NL" => "Netherlands",
                                            "AN" => "Netherlands Antilles",
                                            "NC" => "New Caledonia",
                                            "NZ" => "New Zealand",
                                            "NI" => "Nicaragua",
                                            "NE" => "Niger",
                                            "NG" => "Nigeria",
                                            "NU" => "Niue",
                                            "NF" => "Norfolk Island",
                                            "MP" => "Northern Mariana Islands",
                                            "NO" => "Norway",
                                            "OM" => "Oman",
                                            "PK" => "Pakistan",
                                            "PW" => "Palau",
                                            "PS" => "Palestinian Territory, Occupied",
                                            "PA" => "Panama",
                                            "PG" => "Papua New Guinea",
                                            "PY" => "Paraguay",
                                            "PE" => "Peru",
                                            "PH" => "Philippines",
                                            "PN" => "Pitcairn",
                                            "PL" => "Poland",
                                            "PT" => "Portugal",
                                            "PR" => "Puerto Rico",
                                            "QA" => "Qatar",
                                            "RE" => "Réunion",
                                            "RO" => "Romania",
                                            "RU" => "Russian Federation",
                                            "RW" => "Rwanda",
                                            "BL" => "Saint Barthélemy",
                                            "SH" => "Saint Helena",
                                            "KN" => "Saint Kitts and Nevis",
                                            "LC" => "Saint Lucia",
                                            "MF" => "Saint Martin",
                                            "PM" => "Saint Pierre and Miquelon",
                                            "VC" => "Saint Vincent and the Grenadines",
                                            "WS" => "Samoa",
                                            "SM" => "San Marino",
                                            "ST" => "Sao Tome and Principe",
                                            "SA" => "Saudi Arabia",
                                            "SN" => "Senegal",
                                            "RS" => "Serbia",
                                            "SC" => "Seychelles",
                                            "SL" => "Sierra Leone",
                                            "SG" => "Singapore",
                                            "SK" => "Slovakia",
                                            "SI" => "Slovenia",
                                            "SB" => "Solomon Islands",
                                            "SO" => "Somalia",
                                            "ZA" => "South Africa",
                                            "GS" => "South Georgia and the South Sandwich Islands",
                                            "ES" => "Spain",
                                            "LK" => "Sri Lanka",
                                            "SD" => "Sudan",
                                            "SR" => "Suriname",
                                            "SJ" => "Svalbard and Jan Mayen",
                                            "SZ" => "Swaziland",
                                            "SE" => "Sweden",
                                            "CH" => "Switzerland",
                                            "SY" => "Syrian Arab Republic",
                                            "TW" => "Taiwan, Province of China",
                                            "TJ" => "Tajikistan",
                                            "TZ" => "Tanzania, United Republic of",
                                            "TH" => "Thailand",
                                            "TL" => "Timor-Leste",
                                            "TG" => "Togo",
                                            "TK" => "Tokelau",
                                            "TO" => "Tonga",
                                            "TT" => "Trinidad and Tobago",
                                            "TN" => "Tunisia",
                                            "TR" => "Turkey",
                                            "TM" => "Turkmenistan",
                                            "TC" => "Turks and Caicos Islands",
                                            "TV" => "Tuvalu",
                                            "UG" => "Uganda",
                                            "UA" => "Ukraine",
                                            "AE" => "United Arab Emirates",
                                            "GB" => "United Kingdom",
                                            "US" => "United States",
                                            "UM" => "United States Minor Outlying Islands",
                                            "UY" => "Uruguay",
                                            "UZ" => "Uzbekistan",
                                            "VU" => "Vanuatu",
                                            "VE" => "Venezuela",
                                            "VN" => "Viet Nam",
                                            "VG" => "Virgin Islands, British",
                                            "VI" => "Virgin Islands, U.S.",
                                            "WF" => "Wallis and Futuna",
                                            "EH" => "Western Sahara",
                                            "YE" => "Yemen",
                                            "ZM" => "Zambia",
                                            "ZW" => "Zimbabwe"
                                        );
/*
            $this->countries_list = array(
                                            "GB" => __( "United Kingdom", "wpdev-booking"),
                                            "AF" => __( "Afghanistan", "wpdev-booking"),
                                            "AX" => __( "Aland Islands", "wpdev-booking"),
                                            "AL" => __( "Albania", "wpdev-booking"),
                                            "DZ" => __( "Algeria", "wpdev-booking"),
                                            "AS" => __( "American Samoa", "wpdev-booking"),
                                            "AD" => __( "Andorra", "wpdev-booking"),
                                            "AO" => __( "Angola", "wpdev-booking"),
                                            "AI" => __( "Anguilla", "wpdev-booking"),
                                            "AQ" => __( "Antarctica", "wpdev-booking"),
                                            "AG" => __( "Antigua and Barbuda", "wpdev-booking"),
                                            "AR" => __( "Argentina", "wpdev-booking"),
                                            "AM" => __( "Armenia", "wpdev-booking"),
                                            "AW" => __( "Aruba", "wpdev-booking"),
                                            "AU" => __( "Australia", "wpdev-booking"),
                                            "AT" => __( "Austria", "wpdev-booking"),
                                            "AZ" => __( "Azerbaijan", "wpdev-booking"),
                                            "BS" => __( "Bahamas", "wpdev-booking"),
                                            "BH" => __( "Bahrain", "wpdev-booking"),
                                            "BD" => __( "Bangladesh", "wpdev-booking"),
                                            "BB" => __( "Barbados", "wpdev-booking"),
                                            "BY" => __( "Belarus", "wpdev-booking"),
                                            "BE" => __( "Belgium", "wpdev-booking"),
                                            "BZ" => __( "Belize", "wpdev-booking"),
                                            "BJ" => __( "Benin", "wpdev-booking"),
                                            "BM" => __( "Bermuda", "wpdev-booking"),
                                            "BT" => __( "Bhutan", "wpdev-booking"),
                                            "BO" => __( "Bolivia", "wpdev-booking"),
                                            "BA" => __( "Bosnia and Herzegovina", "wpdev-booking"),
                                            "BW" => __( "Botswana", "wpdev-booking"),
                                            "BV" => __( "Bouvet Island", "wpdev-booking"),
                                            "BR" => __( "Brazil", "wpdev-booking"),
                                            "IO" => __( "British Indian Ocean Territory", "wpdev-booking"),
                                            "BN" => __( "Brunei Darussalam", "wpdev-booking"),
                                            "BG" => __( "Bulgaria", "wpdev-booking"),
                                            "BF" => __( "Burkina Faso", "wpdev-booking"),
                                            "BI" => __( "Burundi", "wpdev-booking"),
                                            "KH" => __( "Cambodia", "wpdev-booking"),
                                            "CM" => __( "Cameroon", "wpdev-booking"),
                                            "CA" => __( "Canada", "wpdev-booking"),
                                            "CV" => __( "Cape Verde", "wpdev-booking"),
                                            "KY" => __( "Cayman Islands", "wpdev-booking"),
                                            "CF" => __( "Central African Republic", "wpdev-booking"),
                                            "TD" => __( "Chad", "wpdev-booking"),
                                            "CL" => __( "Chile", "wpdev-booking"),
                                            "CN" => __( "China", "wpdev-booking"),
                                            "CX" => __( "Christmas Island", "wpdev-booking"),
                                            "CC" => __( "Cocos (Keeling) Islands", "wpdev-booking"),
                                            "CO" => __( "Colombia", "wpdev-booking"),
                                            "KM" => __( "Comoros", "wpdev-booking"),
                                            "CG" => __( "Congo", "wpdev-booking"),
                                            "CD" => __( "Congo, The Democratic Republic of the", "wpdev-booking"),
                                            "CK" => __( "Cook Islands", "wpdev-booking"),
                                            "CR" => __( "Costa Rica", "wpdev-booking"),
                                            "CI" => __( "Côte d'Ivoire", "wpdev-booking"),
                                            "HR" => __( "Croatia", "wpdev-booking"),
                                            "CU" => __( "Cuba", "wpdev-booking"),
                                            "CY" => __( "Cyprus", "wpdev-booking"),
                                            "CZ" => __( "Czech Republic", "wpdev-booking"),
                                            "DK" => __( "Denmark", "wpdev-booking"),
                                            "DJ" => __( "Djibouti", "wpdev-booking"),
                                            "DM" => __( "Dominica", "wpdev-booking"),
                                            "DO" => __( "Dominican Republic", "wpdev-booking"),
                                            "EC" => __( "Ecuador", "wpdev-booking"),
                                            "EG" => __( "Egypt", "wpdev-booking"),
                                            "SV" => __( "El Salvador", "wpdev-booking"),
                                            "GQ" => __( "Equatorial Guinea", "wpdev-booking"),
                                            "ER" => __( "Eritrea", "wpdev-booking"),
                                            "EE" => __( "Estonia", "wpdev-booking"),
                                            "ET" => __( "Ethiopia", "wpdev-booking"),
                                            "FK" => __( "Falkland Islands (Malvinas)", "wpdev-booking"),
                                            "FO" => __( "Faroe Islands", "wpdev-booking"),
                                            "FJ" => __( "Fiji", "wpdev-booking"),
                                            "FI" => __( "Finland", "wpdev-booking"),
                                            "FR" => __( "France", "wpdev-booking"),
                                            "GF" => __( "French Guiana", "wpdev-booking"),
                                            "PF" => __( "French Polynesia", "wpdev-booking"),
                                            "TF" => __( "French Southern Territories", "wpdev-booking"),
                                            "GA" => __( "Gabon", "wpdev-booking"),
                                            "GM" => __( "Gambia", "wpdev-booking"),
                                            "GE" => __( "Georgia", "wpdev-booking"),
                                            "DE" => __( "Germany", "wpdev-booking"),
                                            "GH" => __( "Ghana", "wpdev-booking"),
                                            "GI" => __( "Gibraltar", "wpdev-booking"),
                                            "GR" => __( "Greece", "wpdev-booking"),
                                            "GL" => __( "Greenland", "wpdev-booking"),
                                            "GD" => __( "Grenada", "wpdev-booking"),
                                            "GP" => __( "Guadeloupe", "wpdev-booking"),
                                            "GU" => __( "Guam", "wpdev-booking"),
                                            "GT" => __( "Guatemala", "wpdev-booking"),
                                            "GG" => __( "Guernsey", "wpdev-booking"),
                                            "GN" => __( "Guinea", "wpdev-booking"),
                                            "GW" => __( "Guinea-Bissau", "wpdev-booking"),
                                            "GY" => __( "Guyana", "wpdev-booking"),
                                            "HT" => __( "Haiti", "wpdev-booking"),
                                            "HM" => __( "Heard Island and McDonald Islands", "wpdev-booking"),
                                            "VA" => __( "Holy See (Vatican City State)", "wpdev-booking"),
                                            "HN" => __( "Honduras", "wpdev-booking"),
                                            "HK" => __( "Hong Kong", "wpdev-booking"),
                                            "HU" => __( "Hungary", "wpdev-booking"),
                                            "IS" => __( "Iceland", "wpdev-booking"),
                                            "IN" => __( "India", "wpdev-booking"),
                                            "ID" => __( "Indonesia", "wpdev-booking"),
                                            "IR" => __( "Iran, Islamic Republic of", "wpdev-booking"),
                                            "IQ" => __( "Iraq", "wpdev-booking"),
                                            "IE" => __( "Ireland", "wpdev-booking"),
                                            "IM" => __( "Isle of Man", "wpdev-booking"),
                                            "IL" => __( "Israel", "wpdev-booking"),
                                            "IT" => __( "Italy", "wpdev-booking"),
                                            "JM" => __( "Jamaica", "wpdev-booking"),
                                            "JP" => __( "Japan", "wpdev-booking"),
                                            "JE" => __( "Jersey", "wpdev-booking"),
                                            "JO" => __( "Jordan", "wpdev-booking"),
                                            "KZ" => __( "Kazakhstan", "wpdev-booking"),
                                            "KE" => __( "Kenya", "wpdev-booking"),
                                            "KI" => __( "Kiribati", "wpdev-booking"),
                                            "KP" => __( "Korea, Democratic People's Republic of", "wpdev-booking"),
                                            "KR" => __( "Korea, Republic of", "wpdev-booking"),
                                            "KW" => __( "Kuwait", "wpdev-booking"),
                                            "KG" => __( "Kyrgyzstan", "wpdev-booking"),
                                            "LA" => __( "Lao People's Democratic Republic", "wpdev-booking"),
                                            "LV" => __( "Latvia", "wpdev-booking"),
                                            "LB" => __( "Lebanon", "wpdev-booking"),
                                            "LS" => __( "Lesotho", "wpdev-booking"),
                                            "LR" => __( "Liberia", "wpdev-booking"),
                                            "LY" => __( "Libyan Arab Jamahiriya", "wpdev-booking"),
                                            "LI" => __( "Liechtenstein", "wpdev-booking"),
                                            "LT" => __( "Lithuania", "wpdev-booking"),
                                            "LU" => __( "Luxembourg", "wpdev-booking"),
                                            "MO" => __( "Macao", "wpdev-booking"),
                                            "MK" => __( "Macedonia, The Former Yugoslav Republic of", "wpdev-booking"),
                                            "MG" => __( "Madagascar", "wpdev-booking"),
                                            "MW" => __( "Malawi", "wpdev-booking"),
                                            "MY" => __( "Malaysia", "wpdev-booking"),
                                            "MV" => __( "Maldives", "wpdev-booking"),
                                            "ML" => __( "Mali", "wpdev-booking"),
                                            "MT" => __( "Malta", "wpdev-booking"),
                                            "MH" => __( "Marshall Islands", "wpdev-booking"),
                                            "MQ" => __( "Martinique", "wpdev-booking"),
                                            "MR" => __( "Mauritania", "wpdev-booking"),
                                            "MU" => __( "Mauritius", "wpdev-booking"),
                                            "YT" => __( "Mayotte", "wpdev-booking"),
                                            "MX" => __( "Mexico", "wpdev-booking"),
                                            "FM" => __( "Micronesia, Federated States of", "wpdev-booking"),
                                            "MD" => __( "Moldova", "wpdev-booking"),
                                            "MC" => __( "Monaco", "wpdev-booking"),
                                            "MN" => __( "Mongolia", "wpdev-booking"),
                                            "ME" => __( "Montenegro", "wpdev-booking"),
                                            "MS" => __( "Montserrat", "wpdev-booking"),
                                            "MA" => __( "Morocco", "wpdev-booking"),
                                            "MZ" => __( "Mozambique", "wpdev-booking"),
                                            "MM" => __( "Myanmar", "wpdev-booking"),
                                            "NA" => __( "Namibia", "wpdev-booking"),
                                            "NR" => __( "Nauru", "wpdev-booking"),
                                            "NP" => __( "Nepal", "wpdev-booking"),
                                            "NL" => __( "Netherlands", "wpdev-booking"),
                                            "AN" => __( "Netherlands Antilles", "wpdev-booking"),
                                            "NC" => __( "New Caledonia", "wpdev-booking"),
                                            "NZ" => __( "New Zealand", "wpdev-booking"),
                                            "NI" => __( "Nicaragua", "wpdev-booking"),
                                            "NE" => __( "Niger", "wpdev-booking"),
                                            "NG" => __( "Nigeria", "wpdev-booking"),
                                            "NU" => __( "Niue", "wpdev-booking"),
                                            "NF" => __( "Norfolk Island", "wpdev-booking"),
                                            "MP" => __( "Northern Mariana Islands", "wpdev-booking"),
                                            "NO" => __( "Norway", "wpdev-booking"),
                                            "OM" => __( "Oman", "wpdev-booking"),
                                            "PK" => __( "Pakistan", "wpdev-booking"),
                                            "PW" => __( "Palau", "wpdev-booking"),
                                            "PS" => __( "Palestinian Territory, Occupied", "wpdev-booking"),
                                            "PA" => __( "Panama", "wpdev-booking"),
                                            "PG" => __( "Papua New Guinea", "wpdev-booking"),
                                            "PY" => __( "Paraguay", "wpdev-booking"),
                                            "PE" => __( "Peru", "wpdev-booking"),
                                            "PH" => __( "Philippines", "wpdev-booking"),
                                            "PN" => __( "Pitcairn", "wpdev-booking"),
                                            "PL" => __( "Poland", "wpdev-booking"),
                                            "PT" => __( "Portugal", "wpdev-booking"),
                                            "PR" => __( "Puerto Rico", "wpdev-booking"),
                                            "QA" => __( "Qatar", "wpdev-booking"),
                                            "RE" => __( "Réunion", "wpdev-booking"),
                                            "RO" => __( "Romania", "wpdev-booking"),
                                            "RU" => __( "Russian Federation", "wpdev-booking"),
                                            "RW" => __( "Rwanda", "wpdev-booking"),
                                            "BL" => __( "Saint Barthélemy", "wpdev-booking"),
                                            "SH" => __( "Saint Helena", "wpdev-booking"),
                                            "KN" => __( "Saint Kitts and Nevis", "wpdev-booking"),
                                            "LC" => __( "Saint Lucia", "wpdev-booking"),
                                            "MF" => __( "Saint Martin", "wpdev-booking"),
                                            "PM" => __( "Saint Pierre and Miquelon", "wpdev-booking"),
                                            "VC" => __( "Saint Vincent and the Grenadines", "wpdev-booking"),
                                            "WS" => __( "Samoa", "wpdev-booking"),
                                            "SM" => __( "San Marino", "wpdev-booking"),
                                            "ST" => __( "Sao Tome and Principe", "wpdev-booking"),
                                            "SA" => __( "Saudi Arabia", "wpdev-booking"),
                                            "SN" => __( "Senegal", "wpdev-booking"),
                                            "RS" => __( "Serbia", "wpdev-booking"),
                                            "SC" => __( "Seychelles", "wpdev-booking"),
                                            "SL" => __( "Sierra Leone", "wpdev-booking"),
                                            "SG" => __( "Singapore", "wpdev-booking"),
                                            "SK" => __( "Slovakia", "wpdev-booking"),
                                            "SI" => __( "Slovenia", "wpdev-booking"),
                                            "SB" => __( "Solomon Islands", "wpdev-booking"),
                                            "SO" => __( "Somalia", "wpdev-booking"),
                                            "ZA" => __( "South Africa", "wpdev-booking"),
                                            "GS" => __( "South Georgia and the South Sandwich Islands", "wpdev-booking"),
                                            "ES" => __( "Spain", "wpdev-booking"),
                                            "LK" => __( "Sri Lanka", "wpdev-booking"),
                                            "SD" => __( "Sudan", "wpdev-booking"),
                                            "SR" => __( "Suriname", "wpdev-booking"),
                                            "SJ" => __( "Svalbard and Jan Mayen", "wpdev-booking"),
                                            "SZ" => __( "Swaziland", "wpdev-booking"),
                                            "SE" => __( "Sweden", "wpdev-booking"),
                                            "CH" => __( "Switzerland", "wpdev-booking"),
                                            "SY" => __( "Syrian Arab Republic", "wpdev-booking"),
                                            "TW" => __( "Taiwan, Province of China", "wpdev-booking"),
                                            "TJ" => __( "Tajikistan", "wpdev-booking"),
                                            "TZ" => __( "Tanzania, United Republic of", "wpdev-booking"),
                                            "TH" => __( "Thailand", "wpdev-booking"),
                                            "TL" => __( "Timor-Leste", "wpdev-booking"),
                                            "TG" => __( "Togo", "wpdev-booking"),
                                            "TK" => __( "Tokelau", "wpdev-booking"),
                                            "TO" => __( "Tonga", "wpdev-booking"),
                                            "TT" => __( "Trinidad and Tobago", "wpdev-booking"),
                                            "TN" => __( "Tunisia", "wpdev-booking"),
                                            "TR" => __( "Turkey", "wpdev-booking"),
                                            "TM" => __( "Turkmenistan", "wpdev-booking"),
                                            "TC" => __( "Turks and Caicos Islands", "wpdev-booking"),
                                            "TV" => __( "Tuvalu", "wpdev-booking"),
                                            "UG" => __( "Uganda", "wpdev-booking"),
                                            "UA" => __( "Ukraine", "wpdev-booking"),
                                            "AE" => __( "United Arab Emirates", "wpdev-booking"),
                                            "GB" => __( "United Kingdom", "wpdev-booking"),
                                            "US" => __( "United States", "wpdev-booking"),
                                            "UM" => __( "United States Minor Outlying Islands", "wpdev-booking"),
                                            "UY" => __( "Uruguay", "wpdev-booking"),
                                            "UZ" => __( "Uzbekistan", "wpdev-booking"),
                                            "VU" => __( "Vanuatu", "wpdev-booking"),
                                            "VE" => __( "Venezuela", "wpdev-booking"),
                                            "VN" => __( "Viet Nam", "wpdev-booking"),
                                            "VG" => __( "Virgin Islands, British", "wpdev-booking"),
                                            "VI" => __( "Virgin Islands, U.S.", "wpdev-booking"),
                                            "WF" => __( "Wallis and Futuna", "wpdev-booking"),
                                            "EH" => __( "Western Sahara", "wpdev-booking"),
                                            "YE" => __( "Yemen", "wpdev-booking"),
                                            "ZM" => __( "Zambia", "wpdev-booking"),
                                            "ZW" => __( "Zimbabwe", "wpdev-booking")
                                        );/**/


            }

 // S U P P O R T       F u n c t i o n s    //////////////////////////////////////////////////////////////////////////////////////////////////

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


        // Get default booking form
        function get_default_form(){
            if ($this->wpdev_bk_premium == false)
               return '[calendar] \n\
\n\
<div style="text-align:left"> \n\
<p>'. __('First Name (required)', 'wpdev-booking').':<br />  [text* name] </p> \n\
\n\
<p>'. __('Last Name (required)', 'wpdev-booking').':<br />  [text* secondname] </p> \n\
\n\
<p>'. __('Email (required)', 'wpdev-booking').':<br />  [email* email] </p> \n\
\n\
<p>'. __('Phone', 'wpdev-booking').':<br />  [text phone] </p> \n\
\n\
<p>'. __('Visitors', 'wpdev-booking').':<br />  [select visitors "1" "2" "3" "4"] '. __('Children', 'wpdev-booking').': [checkbox children ""]</p> \n\
\n\
<p>'. __('Details', 'wpdev-booking').':<br /> [textarea details] </p> \n\
\n\
<p>[captcha]</p> \n\
\n\
<p>[submit "'. __('Send', 'wpdev-booking').'"]</p> \n\
</div>';

             else
               return  '[calendar] \n\
\n\
<div style="text-align:left"> \n\
<p>'. __('Start time', 'wpdev-booking').': [starttime]  '. __('End time', 'wpdev-booking').': [endtime]</p> \n\
\n\
<p>'. __('First Name (required)', 'wpdev-booking').':<br />  [text* name] </p> \n\
\n\
<p>'. __('Last Name (required)', 'wpdev-booking').':<br />  [text* secondname] </p> \n\
\n\
<p>'. __('Email (required)', 'wpdev-booking').':<br />  [email* email] </p> \n\
\n\
<p>'. __('Phone', 'wpdev-booking').':<br />  [text phone] </p> \n\
\n\
<p>'. __('Visitors', 'wpdev-booking').':<br />  [select visitors "1" "2" "3" "4"] '. __('Children', 'wpdev-booking').': [checkbox children ""]</p> \n\
\n\
<p>'. __('Details', 'wpdev-booking').':<br /> [textarea details] </p> \n\
\n\
<p>[captcha]</p> \n\
\n\
<p>[submit "'. __('Send', 'wpdev-booking').'"]</p> \n\
</div>';/**/
        }

        // Reset to Payment form
        function reset_to_default_form($form_type ){
            if ($form_type == 'payment')
               return '[calendar] \n\
\n\
<div style="text-align:left"> \n\
<p>'. __('Start time', 'wpdev-booking').': [starttime]  '. __('End time', 'wpdev-booking').': [endtime]</p> \n\
\n\
<p>'. __('First Name (required)', 'wpdev-booking').':<br />  [text* name] </p> \n\
\n\
<p>'. __('Last Name (required)', 'wpdev-booking').':<br />  [text* secondname] </p> \n\
\n\
<p>'. __('Email (required)', 'wpdev-booking').':<br />  [email* email] </p> \n\
\n\
<p>'. __('Address (required)', 'wpdev-booking').':<br />  [text* address] </p>  \n\
 \n\
<p>'. __('City(required)', 'wpdev-booking').':<br />  [text* city] </p>  \n\
 \n\
<p>'. __('Post code(required)', 'wpdev-booking').':<br />  [text* postcode] </p>  \n\
 \n\
<p>'. __('Country(required)', 'wpdev-booking').':<br />  [country] </p>  \n\
 \n\
<p>'. __('Phone', 'wpdev-booking').':<br />  [text phone] </p> \n\
\n\
<p>'. __('Visitors', 'wpdev-booking').':<br />  [select visitors "1" "2" "3" "4"] '. __('Children', 'wpdev-booking').': [checkbox children ""]</p> \n\
\n\
<p>'. __('Details', 'wpdev-booking').':<br /> [textarea details] </p> \n\
\n\
<p>[captcha]</p> \n\
\n\
<p>[submit "'. __('Send', 'wpdev-booking').'"]</p> \n\
</div>';
         }

        // Get default content form text
        function get_default_form_show(){
            if ($this->wpdev_bk_premium == false)
               return '<div style="text-align:left"> \n\
<strong>'. __('First Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[name]</span><br/>\n\
<strong>'. __('Last Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[secondname]</span><br/>\n\
<strong>'. __('Email', 'wpdev-booking').'</strong>:<span class="fieldvalue">[email]</span><br/>\n\
<strong>'. __('Phone', 'wpdev-booking').'</strong>:<span class="fieldvalue">[phone]</span><br/>\n\
<strong>'. __('Number of visitors', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [visitors]</span><br/>\n\
<strong>'. __('Children', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [children]</span><br/>\n\
<strong>'. __('Details', 'wpdev-booking').'</strong>:<br /><span class="fieldvalue"> [details]</span>\n\
</div>';
            else
               return '<div style="text-align:left"> \n\
<strong>'. __('Start time', 'wpdev-booking').'</strong>: <span class="fieldvalue">[starttime]</span> \n\
<strong>'. __('End time', 'wpdev-booking').'</strong>: <span class="fieldvalue">[endtime]</span><br/>\n\
<strong>'. __('First Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[name]</span><br/>\n\
<strong>'. __('Last Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[secondname]</span><br/>\n\
<strong>'. __('Email', 'wpdev-booking').'</strong>:<span class="fieldvalue">[email]</span><br/>\n\
<strong>'. __('Phone', 'wpdev-booking').'</strong>:<span class="fieldvalue">[phone]</span><br/>\n\
<strong>'. __('Number of visitors', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [visitors]</span><br/>\n\
<strong>'. __('Children', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [children]</span><br/>\n\
<strong>'. __('Details', 'wpdev-booking').'</strong>:<br /><span class="fieldvalue"> [details]</span>\n\
</div>';
        }

        // Reset to default payment content show
        function reset_to_default_form_show($form_type ){
            if ($form_type == 'payment')
               return '<div style="text-align:left"> \n\
<strong>'. __('Start time', 'wpdev-booking').'</strong>: <span class="fieldvalue">[starttime]</span> \n\
<strong>'. __('End time', 'wpdev-booking').'</strong>: <span class="fieldvalue">[endtime]</span><br/>\n\
<strong>'. __('First Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[name]</span><br/>\n\
<strong>'. __('Last Name', 'wpdev-booking').'</strong>:<span class="fieldvalue">[secondname]</span><br/>\n\
<strong>'. __('Email', 'wpdev-booking').'</strong>:<span class="fieldvalue">[email]</span><br/>\n\
<strong>'. __('Address', 'wpdev-booking').'</strong>:<span class="fieldvalue">[adress]</span><br/>\n\
<strong>'. __('City', 'wpdev-booking').'</strong>:<span class="fieldvalue">[city]</span><br/>\n\
<strong>'. __('Post code', 'wpdev-booking').'</strong>:<span class="fieldvalue">[postcode]</span><br/>\n\
<strong>'. __('Country', 'wpdev-booking').'</strong>:<span class="fieldvalue">[country]</span><br/>\n\
<strong>'. __('Phone', 'wpdev-booking').'</strong>:<span class="fieldvalue">[phone]</span><br/>\n\
<strong>'. __('Number of visitors', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [visitors]</span><br/>\n\
<strong>'. __('Children', 'wpdev-booking').'</strong>:<span class="fieldvalue"> [children]</span><br/>\n\
<strong>'. __('Details', 'wpdev-booking').'</strong>:<br /><span class="fieldvalue"> [details]</span>\n\
</div>'; }



        function get_bk_dates_4_edit($mysql, $bk_type, $approved) {

            if ( class_exists('wpdev_bk_hotel') ) { return; } // Already exist at that class

            global $wpdb;

            if (isset($_GET['booking_id'])) {
                $skip_bookings = ' AND bk.booking_id <>' .$_GET['booking_id'] . ' ';
            } else { $skip_bookings = ''; }

            if ($approved == 'all')
                  $sql_req =   "SELECT DISTINCT dt.booking_date

                     FROM ".$wpdb->prefix ."bookingdates as dt

                     INNER JOIN ".$wpdb->prefix ."booking as bk

                     ON    bk.booking_id = dt.booking_id

                     WHERE  dt.booking_date >= CURDATE()  AND bk.booking_type = $bk_type ".$skip_bookings."

                     ORDER BY dt.booking_date";

            else
                 $sql_req = "SELECT DISTINCT dt.booking_date

                     FROM ".$wpdb->prefix ."bookingdates as dt

                     INNER JOIN ".$wpdb->prefix ."booking as bk

                     ON    bk.booking_id = dt.booking_id

                     WHERE  dt.approved = $approved AND dt.booking_date >= CURDATE() AND bk.booking_type = $bk_type ".$skip_bookings."

                     ORDER BY dt.booking_date" ;
//debuge($sql_req);
            return $sql_req;
        }

        function get_booking_data($booking_id){
            global $wpdb;

            if (isset($booking_id)) $booking_id = ' WHERE  bk.booking_id = ' . $booking_id . ' ';
            else $booking_id = ' ';
                        $sql = "SELECT *

                        FROM ".$wpdb->prefix ."booking as bk

                        INNER JOIN ".$wpdb->prefix ."bookingdates as dt

                        ON    bk.booking_id = dt.booking_id
                        
                        ". $booking_id ."   ORDER BY dt.booking_date ASC ";

            $result = $wpdb->get_results( $sql );
            $return = array( 'dates'=>array());
            foreach ($result as $res) {
                $return['dates'][] = $res->booking_date;
            }
            $return['form'] = $res->form;
            $return['type'] = $res->booking_type;
            $return['approved'] = $res->approved;
            $return['id'] = $res->booking_id;

            // Parse data from booking form ////////////////////////////////////
            $bktype = $res->booking_type;
            $parsed_form = $res->form;
            $parsed_form = explode('~',$parsed_form);

            $parsed_form_results  = array();
//debuge($parsed_form);die;
            foreach ($parsed_form as $field) {
                $elemnts = explode('^',$field);
                $type = $elemnts[0];
                $element_name = $elemnts[1];
                $value = $elemnts[2];

                $count_pos = strlen( $bktype );
                //debuge(substr( $elemnts[1], 0, -1*$count_pos ))                ;
                $type_name = $elemnts[1];
                $type_name = str_replace('[]','',$type_name);
                if ($bktype == substr( $type_name,  -1*$count_pos ) ) $type_name = substr( $type_name, 0, -1*$count_pos );

                if ($type_name == 'email') { $email_adress = $value; }
                if ($type_name == 'name')  { $name_of_person = $value; }
                if ($type == 'checkbox') {
                    if ($value == 'true')   { $value = 'on'; }
                    else {
                        if (($value == 'false') || ($value == 'Off') || ( !isset($value) ) )  $value = '';
                    }
                }
                if (($type == 'endtime') || ($type == 'starttime')) {
                   //str_replace(':','',$value);
                }
                $element_name = str_replace('[]','',$element_name);
                if ( isset($parsed_form_results[$element_name]) ) {
                    if ($value !=='')
                        $parsed_form_results[$element_name]['value'] .= ',' . $value;
                } else
                    $parsed_form_results[$element_name] = array('value'=>$value, 'type'=> $type, 'element_name'=>$type_name );
            }
            $return['parsed_form'] = $parsed_form_results;
            ////////////////////////////////////////////////////////////////////
            $return['email'] = $email_adress;
            $return['name'] = $name_of_person;

///debuge($return);die;
            return $return;
        }

 //     R  E   M   A   R   K   S                      /////////////////////////////////////////////////////////////////////////////////////////

        function show_remark_editing_field( $old_id, $row, $style ='' ){
            
            ?> </td></tr><tr><td colspan="<?php if ($this->wpdev_bk_premium == false) echo '5'; else echo '6' ?>"  style="<?php echo $style; ?>" ><div style="display:none;width:100%;" id="remark_row<?php echo $old_id; ?>" >
                    <textarea id="remark_text<?php echo $old_id; ?>"  name="remark_text<?php echo $old_id; ?>" cols="2" rows="2" style="width:99%;margin:5px;"><?php echo $row['remark']; ?></textarea>
                    <input type="button" value="<?php _e('Cancel','wpdev-booking'); ?>" class="button alignright" style="margin:3px 7px 7px 5px;"  onclick='javascript:document.getElementById("remark_row<?php echo $old_id; ?>").style.display="none";' />
                    <input type="button" value="<?php _e('Save','wpdev-booking'); ?>" class="button alignright"   style="margin:3px 7px 7px 5px;"  onclick='javascript:wpdev_add_remark(<?php echo $old_id; ?>, document.getElementById("remark_text<?php echo $old_id; ?>").value);' />
                    <?php // debuge($row); ?>
               </div><?php
        }

        function show_remark_hint($old_id, $row){
             if ( trim($row['remark']) != '' ) {
                 $my_remark = str_replace('"','',$row['remark']);
                 $my_remark = str_replace("'",'',$my_remark);
                 $my_remark =trim($my_remark);
                 $my_remark = substr($my_remark,0,75) . '...';
                 ?>
                    <div class="remarkhint" style="margin:0px 0px 0px 0px;padding-left:0px;" id="remarkhint<?php echo $old_id ?>" onmouseover="javascript:showRemarkHint(<?php echo $old_id; ?>, '<?php echo ''; ?>' );" onmousedown="javascript:if (document.getElementById('remark_row<?php echo $old_id;?>').style.display=='block') document.getElementById('remark_row<?php echo $old_id;?>').style.display='none'; else document.getElementById('remark_row<?php echo $old_id;?>').style.display='block';" > <img src="<?php echo WPDEV_BK_PLUGIN_URL . '/img/';?>remark.png"/> </div>
                    <div id="remarkhintcontent<?php echo $old_id ?>" style="display:none;" class="tooltips"><?php echo $my_remark; ?></div>
        <?php
              } else { $my_remark=''; ?>
                    <div class="remarkhint" style="margin:0px 0px 0px 0px;padding-left:0px;display:none;" id="remarkhint<?php echo $old_id ?>" onmouseover="javascript:showRemarkHint(<?php echo $old_id; ?>, '<?php echo ''; ?>' );" onmousedown="javascript:if (document.getElementById('remark_row<?php echo $old_id;?>').style.display=='block') document.getElementById('remark_row<?php echo $old_id;?>').style.display='none'; else document.getElementById('remark_row<?php echo $old_id;?>').style.display='block';" > <img src="<?php echo WPDEV_BK_PLUGIN_URL . '/img/';?>remark.png"/> </div>
                    <div id="remarkhintcontent<?php echo $old_id ?>" style="display:none;" class="tooltips"><?php echo $my_remark; ?></div>
        <?php }
        }

        function wpdev_updating_remark(){
            $remark_id   = $_POST["remark_id"];
            $remark_text = $_POST["remark_text"];

             $my_remark = str_replace('"','',$remark_text);
             $my_remark = str_replace("'",'',$my_remark);
             $my_remark =trim($my_remark);
             $my_remark = substr($my_remark,0,75) . '...';

            global $wpdb;
                $update_sql = "UPDATE ".$wpdb->prefix ."booking AS bk SET bk.remark='$remark_text' WHERE bk.booking_id=$remark_id;";
                if ( false === $wpdb->query( $update_sql ) ) {
                    ?> <script type="text/javascript"> 
                        jWPDev('#ajax_message').removeClass('info_message');
                        jWPDev('#ajax_message').addClass('error_message');
                        document.getElementById('ajax_message').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during updating remarks in BD', 'wpdev-booking'); ?></div>';
                        jWPDev('#ajax_message').fadeOut(10000);
                    </script> <?php
                    die();
                }

                ?> <script type="text/javascript">
                    document.getElementById('ajax_message').innerHTML = '<?php echo __('Updated successfully', 'wpdev-booking'); ?>';
                    jWPDev('#ajax_message').fadeOut(5000);
                    document.getElementById('remarkhintcontent<?php echo $remark_id; ?>').innerHTML = '<?php echo $my_remark; ?>';
                    document.getElementById('remarkhint<?php echo $remark_id; ?>').style.display = 'block';
                </script> <?php
                die();
        }

 // C l i e n t     s i d e     f u n c t i o n s     /////////////////////////////////////////////////////////////////////////////////////////

        // Define JavaScript variables
        function js_define_variables(){
            ?>
                    <script  type="text/javascript">
                        var message_time_error = '<?php _e('Uncorrect date format', 'wpdev-booking'); ?>';
                    </script>
            <?php
        }

        // Write Js files
        function js_write_files(){
             ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/include/js/jquery.meio.mask.min.js"></script>  <?php
             ?> <script type="text/javascript" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/include/js/wpdev.bk.pro.js"></script>  <?php
         }

// B o o k i n g     T y p e s              //////////////////////////////////////////////////////////////////////////////////////////////////

        // Get booking types from DB
        function get_booking_types() {
            global $wpdb;
            $mysql = apply_bk_filter('get_bk_types_sql_4_top_row',  "SELECT booking_type_id as id, title FROM ".$wpdb->prefix ."bookingtypes  ORDER BY title");
            $types_list = $wpdb->get_results( $mysql );
            return $types_list;
        }

        function get_default_booking_resource_id(){
            global $wpdb;
            $mysql = "SELECT booking_type_id as id FROM  ".$wpdb->prefix ."bookingtypes ORDER BY id ASC LIMIT 1";
            $types_list = $wpdb->get_results( $mysql );
            if (count($types_list) > 0 ) $types_list = $types_list[0]->id;
            else $types_list =1;
            return $types_list;
        }

        // Show single menu Item
        function echoMenuItem( $title, $my_icon, $my_tab_id, $is_only_icons = 0){

            //$title = __('General', 'wpdev-booking');
            //$my_icon = 'General-setting-64x64.png';
            //$my_tab = 'main';
            
            $my_style = '';
            if ($is_only_icons == 0){ $my_style = 'style="padding:4px 14px 6px;"';}
            if ($is_only_icons == 1){ $my_style = 'style="padding:4px 5px 6px 32px;"';}


            if (    ($_GET['booking_type'] == $my_tab_id) ||
                    (  (! isset($_GET['booking_type'])) && ( (! isset($my_tab_id)) || ($my_tab_id==1)  )  )
               )  { $slct_a = 'selected'; }
            else  { $slct_a = ''; }


            //Start
            if ($slct_a == 'selected') {  $selected_title = $title;  $selected_icon = $my_icon;
                ?><span class="nav-tab nav-tab-active"  <?php echo $my_style; ?> ><?php
            } else {
                if ($my_tab_id == 'left')
                  {  ?><span class="nav-tab" <?php echo $my_style;  ?> style="cursor:finger;" 
                     onclick="javascript:var marg = document.getElementById('menu_items_slide').style.marginLeft;
                         marg = marg.replace('px'  ,'');
                         marg = ( marg +10 ) + 'px';
                         document.getElementById('menu_items_slide').style.marginLeft = marg;"
                     ><?php }
                elseif ($my_tab_id == 'right')
                  { ?><a class="nav-tab" <?php echo $my_style; ?> href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking&booking_type=<?php echo $my_tab_id; ?>"><?php }
                else
                  { ?><a class="nav-tab" <?php echo $my_style; ?> href="admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ; ?>wpdev-booking&booking_type=<?php echo $my_tab_id; ?>"><?php }
            }

            if ($is_only_icons !== 0) { // Image
                if ($is_only_icons == 1) echo '&nbsp;';
                ?><img class="menuicons" src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/<?php echo $my_icon; ?>"><?php
            }

            // Title
            if ($is_only_icons == 1) echo '&nbsp;';
            else echo $title;

            // End
            if (($slct_a == 'selected') || ($my_tab_id == 'left') || ($my_tab_id == 'right')) {
                ?></span><?php
            } else {
                ?></a><?php }
        }


        // Show line of adding new
        function booking_types_pages($is_edit = ''){

            $types_list = $this->get_booking_types();
            $selected_title = '';
            $bk_types_line ='';
            $selected_bk_typenew = '';
             if ( ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking')!==false) &&
                    ( strpos($_SERVER['REQUEST_URI'],'wpdev-booking.phpwpdev-booking-reservation')===false )
            ) {
                $my__style='background-color:#bbb !important;color:#fff;';
                if ( isset($_GET['booking_type'] ) ) if (($_GET['booking_type'] === 0) || ($_GET['booking_type'] === '0')) { $selected_title = __('all incoming reservations','wpdev-booking');$selected_bk_typenew = ' selected_bk_typenew '; $my__style='background-color:#4b4 !important;';}
                $bk_types_line .= '<div id="bktype'.'0'.'" class="bk_types'.$selected_class.'"><div style="float:left;width:auto;"><a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking'.'&booking_type='.'0'.'" class="bktypetitle" style="'.$my__style.'">' .  __('Incoming','wpdev-booking')  . '</a></div></div>';
                //$bk_types_line .='<div id="bktype_separator'.'0'.'" class="bk_types">  </div>';
            } /*
            ?><div style="height:auto;"> <?php
            foreach ($types_list as $bk_type ) {
                $selected_class = '';

                $default_id = $this->get_default_booking_resource_id();

                if ( isset($_GET['booking_type']) ) {
                    if ($_GET['booking_type'] == $bk_type->id) $selected_class = ' selected_bk_type ';
                } else {
                    if ($default_id == $bk_type->id) $selected_class = ' selected_bk_type ';
                }
                if ( $selected_class == ' selected_bk_type ' ) {
                    $selected_title = $bk_type->title;
                }
                if($is_edit == 'noedit') $subpage = '-reservation';
                else $subpage = '';

                $bk_types_line .= '<div id="bktype'.$bk_type->id.'" class="bk_types'.$selected_class.'"><div style="float:left;width:auto;"><a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking'.$subpage.'&booking_type='.$bk_type->id.'" class="bktypetitle">' .  $bk_type->title  . '</a></div>' . apply_bk_filter('get_bk_types_4_top_row', '', $bk_type);
                if ( ( $is_edit !== 'noedit')  )
                        $bk_types_line .=' <a href="#"  title="'. __('Delete', 'wpdev-booking') .'" style="text-decoration:none;" onclick="javascript:delete_bk_type('.$bk_type->id.');"><img src="'.WPDEV_BK_PLUGIN_URL.'/img/delete_type.png" width="8" height="8" style="padding-top:8px;" /></a>';
                if (   ( $is_edit !== 'noedit')   ) $bk_types_line .=' <a href="#"  title="'. __('edit', 'wpdev-booking') .'" style="text-decoration:none;" onclick="javascript:edit_bk_type('.$bk_type->id.');"><img src="'.WPDEV_BK_PLUGIN_URL.'/img/edit_type.png" width="8" height="8" style="padding-top:8px;" /></a>';
                $bk_types_line .='</div>';
                $bk_types_line .='<div  id="bktypeedit'.$bk_type->id.'" style="float:left;display:none;line-height:50px;">
                                    <input type="text" id="edit_bk_type'.$bk_type->id.'" name="edit_bk_type'.$bk_type->id.'" class="add_type_field" value="' . $bk_type->title . '" />
                                    <input  type="button" class="button-secondary" onclick="javascript:save_edit_bk_type('.$bk_type->id.');" value=" Edit " />
                                  </div>';
                $bk_types_line .='<div id="bktype_separator'.$bk_type->id.'" class="bk_types">  </div>';
            }
            //$bk_types_line = substr($bk_types_line, 0 , -2);

            echo '<span style="height:24px;border:0px solid red;padding-top:2px;" id="bk_types_line">' . $bk_types_line . '</span>';

            if ( $is_edit !== 'noedit')
                echo '<div style="float:left;height:50px;padding:0px;font-size:12px;font-weight:bold;line-height:50px;margin:0px;" id="bk_type_plus"><div style="float:left;width:250px;height:20px; padding:0px 3px; vertical-align:top;"><a href="#" onMouseDown="addBKTypes(\'Plus\');" style="border-color:#455;border:2px solid #899 ;padding:3px 13px 3px 13px;"   class="bktypetitle" >+ '.__('Add new booking resource', 'wpdev-booking').'  </a></div></div>';

            ?>
                 <div style="float:left;border:0px dotted green;display:none;line-height:50px;" id="bk_type_addbutton">
                    <input type="text" id="new_bk_type" name="new_bk_type" class="add_type_field"  value="" />
                    <input  type="button" class="button-secondary" onclick="javascript:add_bk_type();" value=" <?php _e('Add', 'wpdev-booking'); ?> " />
                </div>
             </div>
                      <?php /**/ ?>

                 
            <div style="height:auto;">
               <?php if ( $is_edit !== 'noedit') { ?>
                <div id="bktype0; ?>" class="topmenuitemborder  <?php echo $selected_bk_typenew; ?>">
                    <?php echo '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking'.$subpage.'&booking_type=0" class="bktypetitlenew tipcy" title="'. __('All incoming reservations','wpdev-booking').'" style="margin:0px;" >' .  '@'  . '</a>'; ?>
                </div>
                <div class="topmenuitemseparator" id="bk_types_line"></div>

            <?php } //            for ($i = 0; $i < 1; $i++)
      
            foreach ($types_list as $bk_type ) {
                

                $default_id = $this->get_default_booking_resource_id();
                
                $selected_bk_typenew = '';
                if ( isset($_GET['booking_type']) ) {
                           if ($_GET['booking_type'] == $bk_type->id) $selected_bk_typenew = ' selected_bk_typenew ';
                           if (($_GET['booking_type'] == '') && ($default_id == $bk_type->id)) $selected_bk_typenew = ' selected_bk_typenew ';
                } else {   if ($default_id == $bk_type->id)           $selected_bk_typenew = ' selected_bk_typenew '; }
                
                if ( $selected_bk_typenew == ' selected_bk_typenew ' )  $selected_title = $bk_type->title;
                
                if($is_edit == 'noedit') $subpage = '-reservation';
                else                     $subpage = '';


                ?>
                <div id="bktype<?php echo $bk_type->id; ?>" class="topmenuitemborder <?php echo $selected_bk_typenew; ?>">
                    <?php echo '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking'.$subpage.'&booking_type='.$bk_type->id.'" class="bktypetitlenew '.$selected_bk_typenew.' ">' .  $bk_type->title  . '</a>'; ?>
                    <?php if ( $is_edit !== 'noedit') echo ' <a href="#" class="bktype_edit tipcy"  title="'. __('Edit', 'wpdev-booking') .'" style="text-decoration:none;" onclick="javascript:edit_bk_type('.$bk_type->id.');"><img src="'.WPDEV_BK_PLUGIN_URL.'/img/edit_type.png" width="8" height="8"   /></a>'; ?>
                    <?php if ( $is_edit !== 'noedit') echo ' <a href="#" class="bktype_delete tipcy"  title="'. __('Delete', 'wpdev-booking') .'" style="text-decoration:none;" onclick="javascript:delete_bk_type('.$bk_type->id.');"><img src="'.WPDEV_BK_PLUGIN_URL.'/img/delete_type.png" width="8" height="8"   /></a>'; ?>
                    <?php if ( $is_edit !== 'noedit') echo apply_bk_filter('get_bk_types_4_top_row', '', $bk_type); ?>
                </div>
                <div  id="bktypeedit<?php echo $bk_type->id; ?>" style="float:left;display:none;line-height:32px;">
                        <input type="text" id="edit_bk_type<?php echo $bk_type->id; ?>" name="edit_bk_type<?php echo $bk_type->id; ?>" class="add_type_field" value="<?php echo $bk_type->title; ?>" />
                        <input  type="button" class="button-secondary" onclick="javascript:save_edit_bk_type(<?php echo $bk_type->id; ?>);" value=" Edit " />
                </div>
                <?php
            }

            if ( $is_edit !== 'noedit') {
            ?>  <div class="topmenuitemseparator"></div>
                <div class="topmenuitemborder topmenuitemborder_plus" id="bk_type_plus" style="">

                    <?php echo '<a class="bktypetitlenew tipcy" href="#" onMouseDown="addBKTypes(\'Plus\');" title="'.__('Add new booking resource', 'wpdev-booking').'"    >' .  '+'  . '</a>'; ?>
                </div>
                 <div style="float:left;border:0px dotted green;display:none;line-height:32px;" id="bk_type_addbutton">
                    <input type="text" id="new_bk_type" name="new_bk_type" class="add_type_field"  value="" />
                    <input  type="button" class="button-secondary" onclick="javascript:add_bk_type();" value=" <?php _e('Add', 'wpdev-booking'); ?> " />
                </div>
             <?php } ?>

            </div>


<?php /* ?>
                <style type="text/css">
                    #menu-wpdevplugin {
                    margin-right:20px;
                    margin-top:-3px;
                    position:relative;
                    width:auto;
                    }
                    #menu-wpdevplugin .nav-tabs-wrapper {
                    height:28px;
                    margin-bottom:-1px;
                    overflow:hidden;
                    width:100%;
                    }
                    #menu-wpdevplugin .nav-tabs {
                    float:left;
                    margin-left:0;
                    margin-right:-500px;
                    padding-left:10px;
                    padding-right:10px;
                    }
                    #menu-wpdevplugin .nav-tab {
                    -moz-border-radius:5px 5px 0 0;
                    -webkit-border-top-left-radius:5px;
                    -webkit-border-top-right-radius:5px;
                    border-color:#d5d5d5 #d5d5d5 #BBBBCC #d5d5d5;
                    border-style:solid;
                    border-width:1px 1px 0;
                    color:#C1C1C1;
                    display:inline-block;
                    font-size:12px;
                    line-height:16px;
                    margin:0 6px -1px 0;
                    padding:4px 14px 6px 32px;
                    text-decoration:none;
                    text-shadow:0 1px 0 #f1f1f1;
                    background:none repeat scroll 0 0 #F4F4F4;
                    background:url("../../wp-admin/images/gray-grad.png") repeat-x scroll left top #DFDFDF;
                    color:#464646;
                    font-weight:bold;
                    margin-bottom:0;
                    <?php if ($is_only_icons) echo 'padding:4px 2px 6px 32px;'; ?>
                    }
                    * html #menu-wpdevplugin .nav-tab { padding:4px 14px 5px 32px; }
                    #menu-wpdevplugin a.nav-tab:hover{
                    color:#d54e21 !important;
                    background-color: #e7e7e7 !important;
                    }
                    #menu-wpdevplugin .nav-tab-active {
                    background:none repeat scroll 0 0 #ECECEC;

                    border-color:#CCCCCC;
                    border-bottom-color:#aab;
                    background:none repeat scroll 0 0 #7A7A88;

                    text-shadow:0 -1px 0 #111111;
                    border-width:1px;
                    color:#FFFFFF;
                    }
                    .menuicons{
                        position: absolute;
                        height: 20px;
                        width: 20px;
                        margin: -2px 0pt 0pt -24px;
                    }
                    #support_links{
                        float:right;
                        margin:-20px 0px 0px 0px;
                        padding:0px;
                        font-size:10px;
                    }
                    #menu_items_slide{
                        overflow:hidden;
                        height:30px;
                        width:200px;
                        margin:0px;;
                    }
                 </style>
                 <div style="height:1px;clear:both;margin-top:20px;"></div>
                 <div id="menu-wpdevplugin">
                    <div class="nav-tabs-wrapper">
                        <div class="nav-tabs">

                                <?php  $this->echoMenuItem( __('<', 'wpdev-booking'), 'General-setting-64x64.png', 'left',0);  ?>
                                <?php  $this->echoMenuItem( __('>', 'wpdev-booking'), 'General-setting-64x64.png', 'right',0);  ?>
                            <span id="menu_items_slide">
                                <?php
                                foreach ($types_list as $bk_type ) {
                                    $this->echoMenuItem( $bk_type->title , 'General-setting-64x64.png', $bk_type->id,0);
                                }
                                ?>
                            </span>
                                
                                
                        </div>
                    </div>
                 </div>
<?php /**/ ?>
            <div class="clear topmenuitemseparatorv" style="height:0px;clear:both;" ></div>
            <script type="text/javascript">

                function delete_bk_type(type_id) {
                        var answer = confirm("<?php _e("Do you really want to delete this type?", 'wpdev-booking'); ?>");
                        if (! answer){
                            return false;
                        }

                        //Ajax adding new type to the DB
                        document.getElementById('ajax_working').innerHTML =
                        '<div class="info_message ajax_message" id="ajax_message" >\n\
                            <div style="float:left;"><?php _e('Deleting...', 'wpdev-booking'); ?></div> \n\
                            <div  style="float:left;width:80px;margin-top:-3px;">\n\
                                <img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/ajax-loader.gif">\n\
                            </div>\n\
                        </div>';

                        jWPDev.ajax({                                           // Start Ajax Sending
                            url: '<?php echo WPDEV_BK_PLUGIN_URL . '/' . WPDEV_BK_PLUGIN_FILENAME ; ?>',
                            type:'POST',
                            success: function (data, textStatus){ if( textStatus == 'success')   jWPDev('#ajax_respond').html( data )  },
                            error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
                            // beforeSend: someFunction,
                            data:{
                                ajax_action : 'DELETE_BK_TYPE',
                                type_id : type_id
                            }
                        });
                        return false;
                }

                function edit_bk_type(type_id) {
                    jWPDev('#bktype' + type_id ).css({'display':'none'});
                    jWPDev('#bktypeedit' + type_id ).css({'display':'block'});
                    
                }

                function save_edit_bk_type(type_id) {
                    var my_val = jWPDev('#edit_bk_type'+ type_id).val();
                    jWPDev('#bktype' + type_id +' a.bktypetitlenew').html(my_val);
                    jWPDev('#bktype' + type_id ).css({'display':'block'});
                    jWPDev('#bktypeedit' + type_id ).css({'display':'none'});

                    //Ajax adding new type to the DB
                    document.getElementById('ajax_working').innerHTML =
                    '<div class="info_message ajax_message" id="ajax_message" >\n\
                        <div style="float:left;"><?php _e('Saving...', 'wpdev-booking'); ?></div> \n\
                        <div  style="float:left;width:80px;margin-top:-3px;">\n\
                            <img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/ajax-loader.gif">\n\
                        </div>\n\
                    </div>';


                    jWPDev.ajax({                                           // Start Ajax Sending
                        url: '<?php echo WPDEV_BK_PLUGIN_URL . '/' . WPDEV_BK_PLUGIN_FILENAME ; ?>',
                        type:'POST',
                        success: function (data, textStatus){ if( textStatus == 'success')   jWPDev('#ajax_respond').html( data )  },
                        error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
                        // beforeSend: someFunction,
                        data:{
                            ajax_action : 'EDIT_BK_TYPE',
                            title : my_val,
                            type_id:type_id
                        }
                    });
                    return false;
                }

                function add_bk_type() {
                    var type_str = document.getElementById('new_bk_type').value;
                    if (type_str == '') return;
                    document.getElementById('new_bk_type').value = '';
                    //jWPDev('#bk_types_line').append('<div id="last_book_type" class="bk_types">' + type_str + '</div>' + '<div id="last_book_type_separator" class="bk_types"> | </div>' );
                    jWPDev('#bk_types_line').after(
                    '<div id="last_book_type" class="topmenuitemborder">' + type_str + '</div>'
                    //    + '<div id="last_book_type_separator" class="bk_types"> | </div>'
                    );
                    document.getElementById('bk_type_plus').style.display='block';
                    document.getElementById('bk_type_addbutton').style.display='none';

                        //Ajax adding new type to the DB
                        document.getElementById('ajax_working').innerHTML =
                        '<div class="info_message ajax_message" id="ajax_message" >\n\
                            <div style="float:left;"><?php _e('Saving...', 'wpdev-booking'); ?></div> \n\
                            <div  style="float:left;width:80px;margin-top:-3px;">\n\
                                <img src="<?php echo WPDEV_BK_PLUGIN_URL; ?>/img/ajax-loader.gif">\n\
                            </div>\n\
                        </div>';


                        jWPDev.ajax({                                           // Start Ajax Sending
                            url: '<?php echo WPDEV_BK_PLUGIN_URL . '/' . WPDEV_BK_PLUGIN_FILENAME ; ?>',
                            type:'POST',
                            success: function (data, textStatus){ if( textStatus == 'success')   jWPDev('#ajax_respond').html( data )  },
                            error:function (XMLHttpRequest, textStatus, errorThrown){ window.status = 'Ajax sending Error status:'+ textStatus; alert(XMLHttpRequest.status + ' ' + XMLHttpRequest.statusText); if (XMLHttpRequest.status == 500) { alert('Please check at this page according this error:' + ' http://onlinebookingcalendar.com/faq/#faq-13'); } },
                            // beforeSend: someFunction,
                            data:{
                                ajax_action : 'ADD_BK_TYPE',
                                title : type_str
                            }
                        });
                        return false;

                }
                function addBKTypes(param){
                    document.getElementById('bk_type_plus').style.display='none';
                    document.getElementById('bk_type_addbutton').style.display='block';
                    setTimeout(function ( ) {
                                jWPDev('#new_bk_type').focus();
                                }
                                ,100);

                }
                function bk_type_addbutton_press_key( e ) {
                        if ( 13 == e.which ) {
                                add_bk_type();
                                return false;
                        }
                };
                jWPDev('#bk_type_addbutton input.add_type_field').keypress( bk_type_addbutton_press_key );


                //var val1 = '<img src="<?php echo WPDEV_CP_PLUGIN_URL; ?>/img/subscriptions-128x128.png"><br />';
                //jQuery('div.wrap div.icon32').html(val1);
                jQuery('div.bookingpage h2').html( '<?php _e('Bookings', 'wpdev-booking'); echo ': '. $selected_title; ?>');

            </script>

            <?php
        }



 // P A R S E   F o r m                      //////////////////////////////////////////////////////////////////////////////////////////////////
        function get_booking_form($my_boook_type, $my_booking_form = 'standard'){
            if ($my_booking_form == 'standard') $booking_form  = get_option( 'booking_form' );
            else {
                 $booking_form  = get_option( 'booking_form' );
                 $booking_form = apply_bk_filter('wpdev_get_booking_form', $booking_form, $my_booking_form);
            }
            $this->current_booking_type = $my_boook_type;
            if (isset($_GET['booking_id']))  $this->current_edit_booking = $this->get_booking_data($_GET['booking_id']);
            else                             $this->current_edit_booking =  false;

            $return_res = $this->form_elements($booking_form);
            if (isset($_GET['booking_id'])) { $return_res .= '<input name="edit_booking_id"  id="edit_booking_id" type="hidden" value="'.$_GET['booking_id'].'">'; }
            
            if ( $my_booking_form != 'standard' ) { $return_res .= '<input name="booking_form_type'.$my_boook_type.'"  id="booking_form_type'.$my_boook_type.'" type="hidden" value="'.$my_booking_form.'">'; }

            if (isset($_GET['booking_id'])){
// debuge($this->current_edit_booking['dates']);
                ?>
<script type="text/javascript">
    jWPDev(document).ready(function(){
        timeout_DSwindow=setTimeout("setDaySelections()",1500);
    });

    function setDaySelections(){
// document.getElementById('date_booking1').style.display = 'block';
        clearTimeout(timeout_DSwindow);
        
        var bk_type = <?php echo $my_boook_type; ?>;
        var inst = jWPDev.datepick._getInst(document.getElementById('calendar_booking'+bk_type)); 
        inst.dates = [];  
        var original_array = []; var date;
            <?php foreach ($this->current_edit_booking['dates'] as $dt) {
                    $dt = trim($dt);
                    $dta = explode(' ',$dt);
                    $tms = $dta[1];
                    $tms = explode(':' , $tms);
                    $dta = $dta[0];
                    $dta = explode('-',$dta);
             ?>
                    date=new Date();
                    date.setFullYear( <?php echo $dta[0].', '.($dta[1]-1).', '.$dta[2]; ?> );    // get date
                    original_array.push( jWPDev.datepick._restrictMinMax(inst, jWPDev.datepick._determineDate(inst, date, null))  ); //add date
        <?php     } ?>
        for(var j=0; j < original_array.length ; j++) {       //loop array of dates
            if (original_array[j] != -1) inst.dates.push(original_array[j]);
        }
        dateStr = (inst.dates.length == 0 ? '' : jWPDev.datepick._formatDate(inst, inst.dates[0])); // Get first date
        for ( i = 1; i < inst.dates.length; i++)
             dateStr += jWPDev.datepick._get(inst, 'multiSeparator') +  jWPDev.datepick._formatDate(inst, inst.dates[i]);  // Gathering all dates
        jWPDev('#date_booking' + bk_type).val(dateStr); // Fill the input box
        jWPDev.datepick._notifyChange(inst);
        jWPDev.datepick._adjustInstDate(inst);
        jWPDev.datepick._showDate(inst);
        jWPDev.datepick._updateDatepick(inst);
    }
    //jWPDev('#ajax_message').fadeOut(1000);
    //location.reload(true);
</script>       <?php
            }
            
            return $return_res;
        }

                // Getted from script under GNU /////////////////////////////////////
                function form_elements($form, $replace = true) {
                        $types = 'text[*]?|email[*]?|time[*]?|textarea[*]?|select[*]?|checkbox[*]?|radio|acceptance|captchac|captchar|file[*]?|quiz';
                        $regex = '%\[\s*(' . $types . ')(\s+[a-zA-Z][0-9a-zA-Z:._-]*)([-0-9a-zA-Z:#_/|\s]*)?((?:\s*(?:"[^"]*"|\'[^\']*\'))*)?\s*\]%';
                        $regex_start_end_time = '%\[\s*(country[*]?|starttime[*]?|endtime[*]?)(\s*[a-zA-Z]*[0-9a-zA-Z:._-]*)([-0-9a-zA-Z:#_/|\s]*)*((?:\s*(?:"[^"]*"|\'[^\']*\'))*)?\s*\]%';
                        $submit_regex = '%\[\s*submit(\s[-0-9a-zA-Z:#_/\s]*)?(\s+(?:"[^"]*"|\'[^\']*\'))?\s*\]%';
                        if ($replace) {
                                $form = preg_replace_callback($regex, array(&$this, 'form_element_replace_callback'), $form);
                                // Start end time
                                $form = preg_replace_callback($regex_start_end_time, array(&$this, 'form_element_replace_callback'), $form);
                                // Submit button
                                $form = preg_replace_callback($submit_regex, array(&$this, 'submit_replace_callback'), $form);
                                return $form;
                        } else {
                                $results = array();
                                preg_match_all($regex, $form, $matches, PREG_SET_ORDER);
                                foreach ($matches as $match) {
                                        $results[] = (array) $this->form_element_parse($match);
                                }
                                return $results;
                        }
                }

                function form_element_replace_callback($matches) {
                        extract((array) $this->form_element_parse($matches)); // $type, $name, $options, $values, $raw_values
//debuge('1!!!!!', $type, $name, $options, $values, $raw_values);
                        if ( ($type == 'country') || ($type == 'country*') ) $name = $type . $name;
                        $name .= $this->current_booking_type ;

                        // Edit values
                        if (isset($_GET['booking_id'])) {
                          if (preg_match('/^(?:select|country|checkbox|radio)[*]?$/', $type)) {
                            $options[0] = 'default:' . $this->current_edit_booking['parsed_form'][$name]['value'];
                        //debuge($this->current_edit_booking);
                        //
if ($this->current_edit_booking['parsed_form'][$name]['type'] == 'checkbox') {
//debuge($this->current_edit_booking['parsed_form'][$name]);
//debuge($type, $name, $options, $values, $raw_values, $this->current_edit_booking);
}
                          } else {
                            if ( ($type == 'starttime') || ($type == 'starttime*') || ($type == 'endtime') || ($type == 'endtime*') )
                                $values[0] = $this->current_edit_booking['parsed_form'][$type . $this->current_booking_type ]['value'];
                            elseif ( ($type == 'country') || ($type == 'country*') )
                                $options[0] = $this->current_edit_booking['parsed_form'][$type . $this->current_booking_type ]['value'];
                            else
                                $values[0] = $this->current_edit_booking['parsed_form'][$name]['value'];
                          }
                        }
                        

                        if ($this->processing_unit_tag == $_POST['wpdev_unit_tag']) {
                                $validation_error = $_POST['wpdev_validation_errors']['messages'][$name];
                                $validation_error = $validation_error ? '<span class="wpdev-not-valid-tip-no-ajax">' . $validation_error . '</span>' : '';
                        } else {
                                $validation_error = '';
                        }

                        $atts = '';
                $options = (array) $options;

                $id_array = preg_grep('%^id:[-0-9a-zA-Z_]+$%', $options);
                if ($id = array_shift($id_array)) {
                    preg_match('%^id:([-0-9a-zA-Z_]+)$%', $id, $id_matches);
                    if ($id = $id_matches[1])
                        $atts .= ' id="' . $id . $this->current_booking_type .'"';
                }

                $class_att = "";
                $class_array = preg_grep('%^class:[-0-9a-zA-Z_]+$%', $options);
                foreach ($class_array as $class) {
                    preg_match('%^class:([-0-9a-zA-Z_]+)$%', $class, $class_matches);
                    if ($class = $class_matches[1])
                        $class_att .= ' ' . $class;
                }

                if (preg_match('/^email[*]?$/', $type))
                    $class_att .= ' wpdev-validates-as-email';
                if (preg_match('/^time[*]?$/', $type))
                    $class_att .= ' wpdev-validates-as-time';
                if (preg_match('/^starttime[*]?$/', $type))
                    $class_att .= ' wpdev-validates-as-time';
                if (preg_match('/^endtime[*]?$/', $type))
                    $class_att .= ' wpdev-validates-as-time';
                if (preg_match('/[*]$/', $type))
                    $class_att .= ' wpdev-validates-as-required';

                if (preg_match('/^checkbox[*]?$/', $type))
                    $class_att .= ' wpdev-checkbox';

                if ('radio' == $type)
                    $class_att .= ' wpdev-radio';

                if (preg_match('/^captchac$/', $type))
                    $class_att .= ' wpdev-captcha-' . $name;

                if ('acceptance' == $type) {
                    $class_att .= ' wpdev-acceptance';
                    if (preg_grep('%^invert$%', $options))
                        $class_att .= ' wpdev-invert';
                }

                if ($class_att)
                    $atts .= ' class="' . trim($class_att) . '"';

                        // Value.
                        if (($this->processing_unit_tag == $_POST['wpdev_unit_tag']) && (isset($this->processing_unit_tag))) {
                                if (isset($_POST['wpdev_mail_sent']) && $_POST['wpdev_mail_sent']['ok'])
                                        $value = '';
                                elseif ('captchar' == $type)
                                        $value = '';
                                else
                                        $value = $_POST[$name];
                        } else {
                                $value = $values[0];
                        }

                // Default selected/checked for select/checkbox/radio
                if (preg_match('/^(?:select|checkbox|radio)[*]?$/', $type)) {
                    $scr_defaults = array_values(preg_grep('/^default:/', $options));
                //debuge($scr_defaults);
                    preg_match('/^default:([0-9_:-\s]+)$/', $scr_defaults[0], $scr_default_matches);
                    $scr_default = explode('_', $scr_default_matches[1]);
                //debuge($scr_default);
                }

                if (preg_match('/^(?:country)[*]?$/', $type)) {
               // debuge($options);
                    $scr_defaults = array_values(preg_grep('/^default:/', $options));
              //  debuge($scr_defaults);
                    preg_match('/^default:([0-9a-zA-Z_:-\s]+)$/', $scr_defaults[0], $scr_default_matches);
                    $scr_default = explode('_', $scr_default_matches[1]);
                //debuge($scr_default);
                }


                        if ( ($type == 'starttime') || ($type == 'starttime*') )     $name = 'starttime' . $this->current_booking_type ;
                        if ( ($type == 'endtime') || ($type == 'endtime*') )         $name = 'endtime' . $this->current_booking_type ;

                        switch ($type) {
                                case 'starttime':  
                                case 'starttime*':
                                case 'endtime':
                                case 'endtime*':  
                                case 'time':
                                case 'time*':
                                case 'text':
                                case 'text*':
                                case 'email':
                                case 'email*':
                                case 'captchar':
                                        if (is_array($options)) {
                                                $size_maxlength_array = preg_grep('%^[0-9]*[/x][0-9]*$%', $options);
                                                if ($size_maxlength = array_shift($size_maxlength_array)) {
                                                        preg_match('%^([0-9]*)[/x]([0-9]*)$%', $size_maxlength, $sm_matches);
                                                        if ($size = (int) $sm_matches[1])
                                                                $atts .= ' size="' . $size . '"';
                                else
                                    $atts .= ' size="40"';
                                                        if ($maxlength = (int) $sm_matches[2])
                                                                $atts .= ' maxlength="' . $maxlength . '"';
                                                } else {
                                $atts .= ' size="40"';
                            }
                                        }
 
                                        $html = '<input type="text" name="' . $name . '" value="' . attribute_escape($value) . '"' . $atts . ' />';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                                        return $html;
                                        break;
                                case 'textarea':
                                case 'textarea*':
                                        if (is_array($options)) {
                                                $cols_rows_array = preg_grep('%^[0-9]*[x/][0-9]*$%', $options);
                                                if ($cols_rows = array_shift($cols_rows_array)) {
                                                        preg_match('%^([0-9]*)[x/]([0-9]*)$%', $cols_rows, $cr_matches);
                                                        if ($cols = (int) $cr_matches[1])
                                                                $atts .= ' cols="' . $cols . '"';
                                else
                                    $atts .= ' cols="40"';
                                                        if ($rows = (int) $cr_matches[2])
                                                                $atts .= ' rows="' . $rows . '"';
                                else
                                    $atts .= ' rows="10"';
                                                } else {
                                $atts .= ' cols="40" rows="10"';
                            }
                                        }
                                        $html = '<textarea name="' . $name . '"' . $atts . '>' . $value . '</textarea>';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                                        return $html;
                                        break;
                                case 'country':
                                case 'country*':
                                        
                                        $html = '';
                                        //debuge($values, $empty_select);
                                        foreach ($this->countries_list as $key => $value) {
                                            $selected = '';
                                            //debuge($key , $value, $scr_default, in_array($key , (array) $scr_default) );
                                            if ( in_array($key , (array) $scr_default)) $selected = ' selected="selected"';
                                            //if ($this->processing_unit_tag == $_POST['wpdev_unit_tag'] && ( $multiple && in_array($value, (array) $_POST[$name]) || ! $multiple && $_POST[$name] == $value)) $selected = ' selected="selected"';
                                            $html .= '<option value="' . attribute_escape($key) . '"' . $selected . '>' . $value . '</option>';
                                        }
                                        $html = '<select name="' . $name   . '"' . $atts . '>' . $html . '</select>';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                                        return $html;
                                        break;

                                case 'select':
                                case 'select*':
                        $multiple = (preg_grep('%^multiple$%', $options)) ? true : false;
                        $include_blank = preg_grep('%^include_blank$%', $options);

                                        if ($empty_select = empty($values) || $include_blank)
                                                array_unshift($values, '---');

                                        $html = '';
                //debuge($values, $empty_select);
                        foreach ($values as $key => $value) {
                            $selected = '';
                            //debuge($key , $value, $scr_default, in_array($value , (array) $scr_default) );
                            if ( in_array($value , (array) $scr_default))
                                $selected = ' selected="selected"';
                            if ($this->processing_unit_tag == $_POST['wpdev_unit_tag'] && (
                                    $multiple && in_array($value, (array) $_POST[$name]) ||
                                    ! $multiple && $_POST[$name] == $value))
                                $selected = ' selected="selected"';

                           // debuge($name, $atts);
                            if ( ($name == 'rangetime' . $this->current_booking_type ) && (strpos($atts,'hideendtime')!== false ) )
                                $html .= '<option value="' . attribute_escape($value) . '"' . $selected . '>' . substr($value,0, strpos($value,'-')) . '</option>';
                            elseif  ($name == 'rangetime' . $this->current_booking_type ) {
                                $time_format = get_option( 'booking_time_format');

                                $value_times = explode('-', $value);
                                $value_times[0] = trim($value_times[0]);
                                $value_times[1] = trim($value_times[1]);

                                $s_tm = explode(':', $value_times[0]);
                                $e_tm = explode(':', $value_times[1]);
                                
                                $s_tm = date_i18n($time_format, mktime($s_tm[0], $s_tm[1]));
                                $e_tm = date_i18n($time_format, mktime($e_tm[0], $e_tm[1]));
                                $t_delimeter = ' - ';
                                if (strpos($atts,'hideendtime')!== false ) {
                                   $e_tm = '';
                                   $t_delimeter = '';
                                }
                                $html .= '<option value="' . attribute_escape($value) . '"' . $selected . '>' . $s_tm . $t_delimeter . $e_tm . '</option>';
                            } else
                                $html .= '<option value="' . attribute_escape($value) . '"' . $selected . '>' . $value . '</option>';
                        }

                        if ($multiple)
                            $atts .= ' multiple="multiple"';

                                        $html = '<select name="' . $name . ($multiple ? '[]' : '') . '"' . $atts . '>' . $html . '</select>';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                                        return $html;
                                        break;
                    case 'checkbox':
                    case 'checkbox*':
                    case 'radio':
                        $multiple = (preg_match('/^checkbox[*]?$/', $type) && ! preg_grep('%^exclusive$%', $options)) ? true : false;
                        $html = '';

                        if (preg_match('/^checkbox[*]?$/', $type) && ! $multiple) $onclick = ' onclick="wpdevExclusiveCheckbox(this);"';

                        $defaultOn = (bool) preg_grep('%^default:on$%', $options);
                        $defaultOn = $defaultOn ? ' checked="checked"' : '';

                        $input_type = rtrim($type, '*');

                        foreach ($values as $key => $value) {
                            $checked = '';
                            $multi_values = str_replace('default:', '', $options[0]);
                            $multi_values_array = explode(',',$multi_values);

                            foreach ($multi_values_array as $mv) {
                                if ( ( trim($mv) == trim($value) ) && ($value !=='') ) $checked = ' checked="checked"';
                            }

                            if (in_array($key + 1, (array) $scr_default))
                                $checked = ' checked="checked"';
                            if ($this->processing_unit_tag == $_POST['wpdev_unit_tag'] && (
                                    $multiple && in_array($value, (array) $_POST[$name]) ||
                                    ! $multiple && $_POST[$name] == $value))
                                $checked = ' checked="checked"';
                            if (preg_grep('%^label[_-]?first$%', $options)) { // put label first, input last
                                $item = '<span class="wpdev-list-item-label">' . $value . '</span>&nbsp;';
                                $item .= '<input type="' . $input_type . '" name="' . $name . ($multiple ? '[]' : '') . '" value="' . attribute_escape($value) . '"' . $checked . $onclick . $defaultOn .  ' />';
                            } else {
                                $item = '<input type="' . $input_type . '" name="' . $name . ($multiple ? '[]' : '') . '" value="' . attribute_escape($value) . '"' . $checked . $onclick . $defaultOn . ' />';
                                $item .= '&nbsp;<span class="wpdev-list-item-label">' . $value . '</span>';
                            }
                            $item = '<span class="wpdev-list-item">' . $item . '</span>';
                            $html .= $item;
                        }

                        $html = '<span' . $atts . '>' . $html . '</span>';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
 //debuge($options, $values, $scr_default, $html);die;
                                        return $html;
                                        break;
                    case 'quiz':
                        if (count($raw_values) == 0 && count($values) == 0) { // default quiz
                            $raw_values[] = '1+1=?|2';
                            $values[] = '1+1=?';
                        }

                        $pipes = $this->get_pipes($raw_values);

                        if (count($values) == 0) {
                            break;
                        } elseif (count($values) == 1) {
                            $value = $values[0];
                        } else {
                            $value = $values[array_rand($values)];
                        }

                        $answer = $this->pipe($pipes, $value);
                        $answer = $this->canonicalize($answer);

                                        if (is_array($options)) {
                                                $size_maxlength_array = preg_grep('%^[0-9]*[/x][0-9]*$%', $options);
                                                if ($size_maxlength = array_shift($size_maxlength_array)) {
                                                        preg_match('%^([0-9]*)[/x]([0-9]*)$%', $size_maxlength, $sm_matches);
                                                        if ($size = (int) $sm_matches[1])
                                                                $atts .= ' size="' . $size . '"';
                                else
                                    $atts .= ' size="40"';
                                                        if ($maxlength = (int) $sm_matches[2])
                                                                $atts .= ' maxlength="' . $maxlength . '"';
                                                } else {
                                $atts .= ' size="40"';
                            }
                                        }

                        $html = '<span class="wpdev-quiz-label">' . $value . '</span>&nbsp;';
                        $html .= '<input type="text" name="' . $name . '"' . $atts . ' />';
                        $html .= '<input type="hidden" name="wpdev_quiz_answer_' . $name . '" value="' . wp_hash($answer, 'wpdev_quiz') . '" />';
                                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                                        return $html;
                        break;
                    case 'acceptance':
                        $invert = (bool) preg_grep('%^invert$%', $options);
                        $default = (bool) preg_grep('%^default:on$%', $options);

                        $onclick = ' onclick="wpdevToggleSubmit(this.form);"';
                        $checked = $default ? ' checked="checked"' : '';
                        $html = '<input type="checkbox" name="' . $name . '" value="1"' . $atts . $onclick . $checked . ' />';
                        return $html;
                        break;
                                case 'captchac':
                        if (! class_exists('ReallySimpleCaptcha')) {
                            return '<em>' . 'To use CAPTCHA, you need <a href="http://wordpress.org/extend/plugins/really-simple-captcha/">Really Simple CAPTCHA</a> plugin installed.' . '</em>';
                            break;
                        }

                                        $op = array();
                                        // Default
                                        $op['img_size'] = array(72, 24);
                                        $op['base'] = array(6, 18);
                                        $op['font_size'] = 14;
                                        $op['font_char_width'] = 15;

                                        $op = array_merge($op, $this->captchac_options($options));

                                        if (! $filename = $this->generate_captcha($op)) {
                                                return '';
                                                break;
                                        }
                                        if (is_array($op['img_size']))
                                                $atts .= ' width="' . $op['img_size'][0] . '" height="' . $op['img_size'][1] . '"';
                                        $captcha_url = trailingslashit($this->captcha_tmp_url()) . $filename;
                                        $html = '<img alt="captcha" src="' . $captcha_url . '"' . $atts . ' />';
                                        $ref = substr($filename, 0, strrpos($filename, '.'));
                                        $html = '<input type="hidden" name="wpdev_captcha_challenge_' . $name . '" value="' . $ref . '" />' . $html;
                                        return $html;
                                        break;
                    case 'file':
                    case 'file*':
                        $html = '<input type="file" name="' . $name . '"' . $atts . ' value="1" />';
                        $html = '<span class="wpdev-form-control-wrap ' . $name . '">' . $html . $validation_error . '</span>';
                        return $html;
                        break;
                        }
                }

                function submit_replace_callback($matches) {
                $atts = '';
                $options = preg_split('/[\s]+/', trim($matches[1]));

                $id_array = preg_grep('%^id:[-0-9a-zA-Z_]+$%', $options);
                if ($id = array_shift($id_array)) {
                    preg_match('%^id:([-0-9a-zA-Z_]+)$%', $id, $id_matches);
                    if ($id = $id_matches[1])
                        $atts .= ' id="' . $id . '"';
                }

                $class_att = '';
                $class_array = preg_grep('%^class:[-0-9a-zA-Z_]+$%', $options);
                foreach ($class_array as $class) {
                    preg_match('%^class:([-0-9a-zA-Z_]+)$%', $class, $class_matches);
                    if ($class = $class_matches[1])
                        $class_att .= ' ' . $class;
                }

                if ($class_att)
                    $atts .= ' class="' . trim($class_att) . '"';

                        if ($matches[2])
                                $value = $this->strip_quote($matches[2]);
                        if (empty($value))
                                $value = __('Send', 'wpdev-booking');
                        $ajax_loader_image_url =   WPDEV_BK_PLUGIN_URL . '/img/ajax-loader.gif';

                $html = '<input type="button" value="' . $value . '"' . $atts . ' onclick="mybooking_submit(this.form,'.$this->current_booking_type.');" />';
                $html .= ' <img class="ajax-loader" style="visibility: hidden;" alt="ajax loader" src="' . $ajax_loader_image_url . '" />';
                        return $html;
                }

                function form_element_parse($element) {
                        $type = trim($element[1]);
                        $name = trim($element[2]);
                        $options = preg_split('/[\s]+/', trim($element[3]));

                        preg_match_all('/"[^"]*"|\'[^\']*\'/', $element[4], $matches);
                        $raw_values = $this->strip_quote_deep($matches[0]);

                        if ( preg_match('/^(select[*]?|checkbox[*]?|radio)$/', $type) || 'quiz' == $type) {
                            $pipes = $this->get_pipes($raw_values);
                            $values = $this->get_pipe_ins($pipes);
                        } else {
                            $values =& $raw_values;
                        }

                        return compact('type', 'name', 'options', 'values', 'raw_values');
                }

                function strip_quote($text) {
                        $text = trim($text);
                        if (preg_match('/^"(.*)"$/', $text, $matches))
                                $text = $matches[1];
                        elseif (preg_match("/^'(.*)'$/", $text, $matches))
                                $text = $matches[1];
                        return $text;
                }

                function strip_quote_deep($arr) {
                        if (is_string($arr))
                                return $this->strip_quote($arr);
                        if (is_array($arr)) {
                                $result = array();
                                foreach ($arr as $key => $text) {
                                        $result[$key] = $this->strip_quote($text);
                                }
                                return $result;
                        }
                }

                function pipe($pipes, $value) {
                    if (is_array($value)) {
                        $results = array();
                        foreach ($value as $k => $v) {
                            $results[$k] = $this->pipe($pipes, $v);
                        }
                        return $results;
                    }

                    foreach ($pipes as $p) {
                        if ($p[0] == $value)
                            return $p[1];
                    }

                    return $value;
                }

                function get_pipe_ins($pipes) {
                    $ins = array();
                    foreach ($pipes as $pipe) {
                        $in = $pipe[0];
                        if (! in_array($in, $ins))
                            $ins[] = $in;
                    }
                    return $ins;
                }

                function get_pipes($values) {
                    $pipes = array();

                    foreach ($values as $value) {
                        $pipe_pos = strpos($value, '|');
                        if (false === $pipe_pos) {
                            $before = $after = $value;
                        } else {
                            $before = substr($value, 0, $pipe_pos);
                            $after = substr($value, $pipe_pos + 1);
                        }

                        $pipes[] = array($before, $after);
                    }

                    return $pipes;
                }

                function pipe_all_posted($contact_form) {
                    $all_pipes = array();

                    $fes = $this->form_elements($contact_form['form'], false);
                    foreach ($fes as $fe) {
                        $type = $fe['type'];
                        $name = $fe['name'];
                        $raw_values = $fe['raw_values'];

                        if (! preg_match('/^(select[*]?|checkbox[*]?|radio)$/', $type))
                            continue;

                        $pipes = $this->get_pipes($raw_values);

                        $all_pipes[$name] = array_merge($pipes, (array) $all_pipes[$name]);
                    }

                    foreach ($all_pipes as $name => $pipes) {
                        if (isset($this->posted_data[$name]))
                            $this->posted_data[$name] = $this->pipe($pipes, $this->posted_data[$name]);
                    }
                }
                ////////////////////////////////////////////////////////////////////////

 //  S e t t i n g s     p a g e s           //////////////////////////////////////////////////////////////////////////////////////////////////
        function settings_menu_content(){
                switch ($_GET['tab']) {

                   case 'form':
                    $this->compouse_form();
                    return false;
                    break;

                   case 'email':
                    $this->compouse_email();
                    return false;
                    break;

                 default:
                    return true;
                    break;
                }

        }

        function compouse_form(){ 


             if ( isset( $_POST['booking_form'] ) ) {

                 if (( ( isset($_POST['booking_form_new_name'])  )  && (! empty($_POST['booking_form_new_name'])) || ( ( isset($_GET['booking_form'])  ) && ($_GET['booking_form'] !== 'standard')  ) )/* && ($_POST['select_booking_form'] !== 'standard') /**/  ) {
                     make_bk_action('update_booking_form_at_settings');
                 } else {
                     $booking_form =  ($_POST['booking_form']);
                     $booking_form = str_replace('\"','"',$booking_form);
                     $booking_form = str_replace("\'","'",$booking_form);
                     //$booking_form = htmlspecialchars_decode($booking_form);
                     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                     if ( get_option( 'booking_form' ) !== false  )   update_option( 'booking_form' , $booking_form );
                     else                                             add_option('booking_form' , $booking_form );
                }
             }


             if ( isset($_GET['booking_form']) ) {

             } else {
                $booking_form  = get_option( 'booking_form' );
             }
             

             if ( isset( $_POST['booking_form_show'] ) ) {

                 $booking_form_show =  ($_POST['booking_form_show']);
                 $booking_form_show = str_replace('\"','"',$booking_form_show);
                 $booking_form_show = str_replace("\'","'",$booking_form_show);
                 ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 if ( get_option( 'booking_form_show' ) !== false  )   update_option( 'booking_form_show' , $booking_form_show );
                 else                                                  add_option('booking_form_show' , $booking_form_show );

             }else {

                $booking_form_show  = get_option( 'booking_form_show' );

             }


            ?>

                    <div class="clear" style="height:20px;"></div>
                    <div id="ajax_working"></div>
                    <div id="poststuff" class="metabox-holder">
                    <script type="text/javascript">
                        function reset_to_def_from(type) {
                            if (type == 'payment')
                               document.getElementById('booking_form').value = '<?php echo $this->reset_to_default_form('payment'); ?>';
                            else
                               document.getElementById('booking_form').value = '<?php echo $this->get_default_form(); ?>';
                        }
                        function reset_to_def_from_show(type) {
                            if (type == 'payment')
                                document.getElementById('booking_form_show').value = '<?php echo $this->reset_to_default_form_show('payment'); ?>';
                            else
                                document.getElementById('booking_form_show').value = '<?php echo $this->get_default_form_show(); ?>';
                        }
                    </script>
                    <div class='meta-box'><div  class="postbox" ><h3 class='hndle'><span><?php _e('Form fields', 'wpdev-booking'); ?></span></h3><div class="inside">
                                
                                

                                <form  name="post_option" action="" method="post" id="post_option" >
                                    <?php $booking_form_content = apply_bk_filter('show_select_box_for_several_forms', '');
                                    if (! empty($booking_form_content) )
                                        $booking_form = $booking_form_content;
                                    ?>
                                    <div style="float:left;margin:10px 0px;width:58%;">
                                        <textarea id="booking_form" name="booking_form" class="darker-border" style="width:100%;" rows="39"><?php echo htmlspecialchars($booking_form, ENT_NOQUOTES ); ?></textarea>
                                    </div>
                                    <div style="float:right;margin:10px 0px;width:40%;" class="code_description">
                                        <div style="border:1px solid #cccccc;margin-bottom:10px;">
                                          <span class="description" style="padding:5px;"><?php printf(__('%sGeneral shortcode fields rule for inserting field:%s', 'wpdev-booking'),'<strong>','</strong>');?></span><br/><br/>
                                          <span class="description"><?php printf( '<code>[shortcode_type* field_name "value"]</code>');?></span><br/>
                                          <span class="description"><?php printf(__('Parameters: ', 'wpdev-booking'));?></span><br/>
                                          <span class="description"><?php printf(__('%s - this symbol means that this field is Required (can be skipped)', 'wpdev-booking'),'<code>*</code>');?></span><br/>
                                          <span class="description"><?php printf(__('%s - field name, must be unique (can not skipped)', 'wpdev-booking'),'<code>field_name</code>');?></span><br/>
                                          <span class="description"><?php printf(__('%s - default value of field (can skipped)', 'wpdev-booking'),'<code>"value"</code>');?></span><br/><br/>
                                        </div>
                                        <div style="border:1px solid #cccccc;">
                                          <span class="description" style="padding:5px;"><?php printf(__('%sUse these shortcode types for inserting fields into form:%s', 'wpdev-booking'),'<strong>','</strong>');?></span><br/><br/>
                                          <span class="description"><?php printf(__('%s - calendar', 'wpdev-booking'),'<code>[calendar]</code>');?></span><br/>
                                          <span class="description"><?php printf(__('%s - CAPTCHA', 'wpdev-booking'),'<code>[captcha]</code>');?></span><br/>

                                          <span class="description"><?php printf(__('%s - text field. ', 'wpdev-booking'),'<code>[text]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %sJohn%s', 'wpdev-booking'),'[text firt_name "', '"]');?></span><br/>
                                          <?php if ($this->wpdev_bk_premium !== false) { ?>
                                          <span class="description"><?php printf(__('%s - start time field. ', 'wpdev-booking'),'<code>[starttime]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s. If you have already predefined times, you can also use this shortcode: %s', 'wpdev-booking'),'[starttime]', '[select starttime "12:00" "14:00"]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - end time field. ', 'wpdev-booking'),'<code>[endtime]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s. If you have already predefined times, you can also use this shortcode: %s', 'wpdev-booking'),'[endtime]', '[select endtime "16:00" "20:00"]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - start and end time field at one dropdown list. ', 'wpdev-booking'),'<code>[select rangetime]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('If you have already predefined times (start and end time), use this code: %s ', 'wpdev-booking'), '[select rangetime "10:00 - 12:00" "12:00 - 14:00" "14:00 - 16:00" "16:00 - 18:00" "18:00 - 20:00" ]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - duration time field. ', 'wpdev-booking'),'<code>[select durationtime]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('If you set already start time, you can set duration of time using this shortcode: %s. You do not requre endtime.', 'wpdev-booking'), '[select durationtime "00:30" "01:00" "01:30" "02:00" "02:30" "03:00" ]');?></span><br/>

                                          <?php } ?>
                                          <span class="description"><?php printf(__('%s - additional time field (as an additional property). Do not apply to the dividing day into sections. ', 'wpdev-booking'),'<code>[time]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[time my_tm]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - emeil field, ', 'wpdev-booking'),'<code>[email]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[email* my_email]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - select field, ', 'wpdev-booking'),'<code>[select]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[select my_slct "1" "2" "3"]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - checkbox field, ', 'wpdev-booking'),'<code>[checkbox]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[checkbox my_radio ""]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - textarea field, ', 'wpdev-booking'),'<code>[textarea]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[textarea my_details]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - countries list field, ', 'wpdev-booking'),'<code>[country]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %s ', 'wpdev-booking'),'[country]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - submit button, ', 'wpdev-booking'),'<code>[submit]</code>');?></span>
                                          <span class="description example-code"><?php printf(__('Example: %sSend%s ', 'wpdev-booking'),'[submit "', '"]');?></span><br/>

                                          <span class="description"><?php printf(__('%s - inserting new line, ', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span><br/>
                                          <span class="description"><?php printf(__('use any other HTML tags (carefully).', 'wpdev-booking'),'<code>','</code>');?></span><br/><br/>
                                        </div>
                                    </div>
                                    <div class="clear" style="height:1px;"></div>
                                    <input class="button-secondary" style="float:left;" type="button" value="<?php _e('Reset to default form', 'wpdev-booking'); ?>" onclick="javascript:reset_to_def_from();" name="reset_form"/>
                                    <?php  if ($this->wpdev_bk_premium !== false) { ?> 
                                    <input class="button-secondary" style="float:left; margin:0px 20px;" type="button" value="<?php _e('Reset to default Payment form', 'wpdev-booking'); ?>" onclick="javascript:reset_to_def_from('payment');" name="reset_form"/>
                                    <?php } ?>
                                    <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="Submit"/>
                                    <div class="clear" style="height:5px;"></div>

                                </form>
                     </div></div></div>


                    <div class='meta-box'><div  class="postbox" ><h3 class='hndle'><span><?php printf(__('Form content data showing at emails (%s-shortcode) and inside approval and reservation tables at booking calendar page', 'wpdev-booking'),'[content]'); ?></span></h3><div class="inside">
                                <form  name="post_option" action="" method="post" id="post_option" >
                                    <div style="float:left;margin:10px 0px;width:58%;">
                                    <textarea id="booking_form_show" name="booking_form_show" class="darker-border" style="width:100%;" rows="11"><?php echo htmlspecialchars($booking_form_show, ENT_NOQUOTES ); ?></textarea>
                                    </div>
                                    <div style="float:right;margin:10px 0px;width:40%;" class="code_description">
                                        <div style="border:1px solid #cccccc;margin-bottom:10px;">
                                          <span class="description"><?php printf(__('Use these shortcodes for customization: ', 'wpdev-booking'));?></span><br/><br/>
                                          <span class="description"><?php printf(__('%s - inserting data from fields of booking form, ', 'wpdev-booking'),'<code>[field_name]</code>');?></span><br/><br/>
                                          <span class="description"><?php printf(__('%s - inserting new line, ', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span><br/><br/>
                                          <span class="description"><?php printf(__('use any other HTML tags (carefully).', 'wpdev-booking'),'<code>','</code>');?></span><br/><br/>
                                        </div>
                                    </div>
                                    <div class="clear" style="height:1px;"></div>
                                    <input class="button-secondary" style="float:left;" type="button" value="<?php _e('Reset to default form content', 'wpdev-booking'); ?>" onclick="javascript:reset_to_def_from_show();" name="reset_form"/>
                                    <?php  if ($this->wpdev_bk_premium !== false) { ?>
                                    <input class="button-secondary" style="float:left; margin:0px 20px;" type="button" value="<?php _e('Reset to default Payment form content', 'wpdev-booking'); ?>" onclick="javascript:reset_to_def_from_show('payment');" name="reset_form"/>
                                    <?php } ?>
                                    <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="Submit"/>
                                    <div class="clear" style="height:5px;"></div>

                                </form>
                     </div></div></div>

                    </div>
         <?php
        }

        function compouse_email(){

             if ( isset( $_POST['email_reservation_adress'] ) ) {

                 $email_reservation_adress      = htmlspecialchars( str_replace('\"','"',$_POST['email_reservation_adress']));
                 $email_reservation_from_adress = htmlspecialchars( str_replace('\"','"',$_POST['email_reservation_from_adress']));
                 $email_reservation_subject     = htmlspecialchars( str_replace('\"','"',$_POST['email_reservation_subject']));
                 $email_reservation_content     = htmlspecialchars( str_replace('\"','"',$_POST['email_reservation_content']));

                 $email_reservation_adress      =  str_replace("\'","'",$email_reservation_adress);
                 $email_reservation_from_adress =  str_replace("\'","'",$email_reservation_from_adress);
                 $email_reservation_subject     =  str_replace("\'","'",$email_reservation_subject);
                 $email_reservation_content     =  str_replace("\'","'",$email_reservation_content);

                 $is_email_reservation_adress = $_POST['is_email_reservation_adress'];
                 if (isset( $is_email_reservation_adress ))         $is_email_reservation_adress = 'On';
                 else                                               $is_email_reservation_adress = 'Off';
                 update_option( 'booking_is_email_reservation_adress' , $is_email_reservation_adress );

                 if ( get_option( 'booking_email_reservation_adress' ) !== false  )      update_option( 'booking_email_reservation_adress' , $email_reservation_adress );
                 else                                                                    add_option('booking_email_reservation_adress' , $email_reservation_adress );
                 if ( get_option( 'booking_email_reservation_from_adress' ) !== false  ) update_option( 'booking_email_reservation_from_adress' , $email_reservation_from_adress );
                 else                                                                    add_option('booking_email_reservation_from_adress' , $email_reservation_from_adress );
                 if ( get_option( 'booking_email_reservation_subject' ) !== false  )     update_option( 'booking_email_reservation_subject' , $email_reservation_subject );
                 else                                                                    add_option('booking_email_reservation_subject' , $email_reservation_subject );
                 if ( get_option( 'booking_email_reservation_content' ) !== false  )     update_option( 'booking_email_reservation_content' , $email_reservation_content );
                 else                                                                    add_option('booking_email_reservation_content' , $email_reservation_content );
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 $email_approval_adress  = htmlspecialchars( str_replace('\"','"',$_POST['email_approval_adress']));
                 $email_approval_subject = htmlspecialchars( str_replace('\"','"',$_POST['email_approval_subject']));
                 $email_approval_content = htmlspecialchars( str_replace('\"','"',$_POST['email_approval_content']));

                 $email_approval_adress      =  str_replace("\'","'",$email_approval_adress);
                 $email_approval_subject     =  str_replace("\'","'",$email_approval_subject);
                 $email_approval_content     =  str_replace("\'","'",$email_approval_content);


                 $is_email_approval_adress = $_POST['is_email_approval_adress'];
                 if (isset( $is_email_approval_adress ))            $is_email_approval_adress = 'On';
                 else                                               $is_email_approval_adress = 'Off';
                 update_option( 'booking_is_email_approval_adress' , $is_email_approval_adress );

                 if ( get_option( 'booking_email_approval_adress' ) !== false  )         update_option( 'booking_email_approval_adress' , $email_approval_adress );
                 else                                                                    add_option('booking_email_approval_adress' , $email_approval_adress );
                 if ( get_option( 'booking_email_approval_subject' ) !== false  )        update_option( 'booking_email_approval_subject' , $email_approval_subject );
                 else                                                                    add_option('booking_email_approval_subject' , $email_approval_subject );
                 if ( get_option( 'booking_email_approval_content' ) !== false  )        update_option( 'booking_email_approval_content' , $email_approval_content );
                 else                                                                    add_option('booking_email_approval_content' , $email_approval_content );
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 $email_newbookingbyperson_adress  = htmlspecialchars( str_replace('\"','"',$_POST['email_newbookingbyperson_adress']));
                 $email_newbookingbyperson_subject = htmlspecialchars( str_replace('\"','"',$_POST['email_newbookingbyperson_subject']));
                 $email_newbookingbyperson_content = htmlspecialchars( str_replace('\"','"',$_POST['email_newbookingbyperson_content']));

                 $email_newbookingbyperson_adress      =  str_replace("\'","'",$email_newbookingbyperson_adress);
                 $email_newbookingbyperson_subject     =  str_replace("\'","'",$email_newbookingbyperson_subject);
                 $email_newbookingbyperson_content     =  str_replace("\'","'",$email_newbookingbyperson_content);


                 $is_email_newbookingbyperson_adress = $_POST['is_email_newbookingbyperson_adress'];
                 if (isset( $is_email_newbookingbyperson_adress ))            $is_email_newbookingbyperson_adress = 'On';
                 else                                               $is_email_newbookingbyperson_adress = 'Off';
                 update_option( 'booking_is_email_newbookingbyperson_adress' , $is_email_newbookingbyperson_adress );

                 if ( get_option( 'booking_email_newbookingbyperson_adress' ) !== false  )         update_option( 'booking_email_newbookingbyperson_adress' , $email_newbookingbyperson_adress );
                 else                                                                    add_option('booking_email_newbookingbyperson_adress' , $email_newbookingbyperson_adress );
                 if ( get_option( 'booking_email_newbookingbyperson_subject' ) !== false  )        update_option( 'booking_email_newbookingbyperson_subject' , $email_newbookingbyperson_subject );
                 else                                                                    add_option('booking_email_newbookingbyperson_subject' , $email_newbookingbyperson_subject );
                 if ( get_option( 'booking_email_newbookingbyperson_content' ) !== false  )        update_option( 'booking_email_newbookingbyperson_content' , $email_newbookingbyperson_content );
                 else                                                                    add_option('booking_email_newbookingbyperson_content' , $email_newbookingbyperson_content );
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 $email_deny_adress  = htmlspecialchars( str_replace('\"','"',$_POST['email_deny_adress']));
                 $email_deny_subject = htmlspecialchars( str_replace('\"','"',$_POST['email_deny_subject']));
                 $email_deny_content = htmlspecialchars( str_replace('\"','"',$_POST['email_deny_content']));

                 $email_deny_adress      =  str_replace("\'","'",$email_deny_adress);
                 $email_deny_subject     =  str_replace("\'","'",$email_deny_subject);
                 $email_deny_content     =  str_replace("\'","'",$email_deny_content);


                 $is_email_deny_adress = $_POST['is_email_deny_adress'];
                 if (isset( $is_email_deny_adress ))         $is_email_deny_adress = 'On';
                 else                                        $is_email_deny_adress = 'Off';
                 update_option( 'booking_is_email_deny_adress' , $is_email_deny_adress );

                 if ( get_option( 'booking_email_deny_adress' ) !== false  )             update_option( 'booking_email_deny_adress' , $email_deny_adress );
                 else                                                                    add_option('booking_email_deny_adress' , $email_deny_adress );
                 if ( get_option( 'booking_email_deny_subject' ) !== false  )            update_option( 'booking_email_deny_subject' , $email_deny_subject );
                 else                                                                    add_option('booking_email_deny_subject' , $email_deny_subject );
                 if ( get_option( 'booking_email_deny_content' ) !== false  )            update_option( 'booking_email_deny_content' , $email_deny_content );
                 else                                                                    add_option('booking_email_deny_content' , $email_deny_content );

                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                 $email_modification_adress  = htmlspecialchars( str_replace('\"','"',$_POST['email_modification_adress']));
                 $email_modification_subject = htmlspecialchars( str_replace('\"','"',$_POST['email_modification_subject']));
                 $email_modification_content = htmlspecialchars( str_replace('\"','"',$_POST['email_modification_content']));

                 $email_modification_adress      =  str_replace("\'","'",$email_modification_adress);
                 $email_modification_subject     =  str_replace("\'","'",$email_modification_subject);
                 $email_modification_content     =  str_replace("\'","'",$email_modification_content);


                 $is_email_modification_adress = $_POST['is_email_modification_adress'];
                 if (isset( $is_email_modification_adress ))         $is_email_modification_adress = 'On';
                 else                                        $is_email_modification_adress = 'Off';
                 update_option( 'booking_is_email_modification_adress' , $is_email_modification_adress );

                 if ( get_option( 'booking_email_modification_adress' ) !== false  )     update_option( 'booking_email_modification_adress' , $email_modification_adress );
                 else                                                                    add_option('booking_email_modification_adress' , $email_modification_adress );
                 if ( get_option( 'booking_email_modification_subject' ) !== false  )    update_option( 'booking_email_modification_subject' , $email_modification_subject );
                 else                                                                    add_option('booking_email_modification_subject' , $email_modification_subject );
                 if ( get_option( 'booking_email_modification_content' ) !== false  )    update_option( 'booking_email_modification_content' , $email_modification_content );
                 else                                                                    add_option('booking_email_modification_content' , $email_modification_content );

             } else {

                 $email_reservation_adress      = get_option( 'booking_email_reservation_adress') ;
                 $email_reservation_from_adress = get_option( 'booking_email_reservation_from_adress');
                 $email_reservation_subject     = get_option( 'booking_email_reservation_subject');
                 $email_reservation_content     = get_option( 'booking_email_reservation_content');
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 $email_newbookingbyperson_adress      = get_option( 'booking_email_newbookingbyperson_adress');
                 $email_newbookingbyperson_subject     = get_option( 'booking_email_newbookingbyperson_subject');
                 $email_newbookingbyperson_content     = get_option( 'booking_email_newbookingbyperson_content');
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 $email_approval_adress      = get_option( 'booking_email_approval_adress');
                 $email_approval_subject     = get_option( 'booking_email_approval_subject');
                 $email_approval_content     = get_option( 'booking_email_approval_content');
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 $email_deny_adress      = get_option( 'booking_email_deny_adress');
                 $email_deny_subject     = get_option( 'booking_email_deny_subject');
                 $email_deny_content     = get_option( 'booking_email_deny_content');
                 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                 $email_modification_adress      = get_option( 'booking_email_modification_adress');
                 $email_modification_subject     = get_option( 'booking_email_modification_subject');
                 $email_modification_content     = get_option( 'booking_email_modification_content');

                 $is_email_reservation_adress   = get_option( 'booking_is_email_reservation_adress' );
                 $is_email_newbookingbyperson_adress      = get_option( 'booking_is_email_newbookingbyperson_adress' );
                 $is_email_approval_adress      = get_option( 'booking_is_email_approval_adress' );
                 $is_email_deny_adress          = get_option( 'booking_is_email_deny_adress' );
                 $is_email_modification_adress          = get_option( 'booking_is_email_modification_adress' );


                 //$email_deny_adress = $email_approval_adress = $email_reservation_from_adress = $email_reservation_adress = htmlspecialchars('"Booking system" <' .get_option('admin_email').'>');

             }

            ?>

                    <div class="clear" style="height:20px;"></div>
                    <div id="ajax_working"></div>
                    <div id="poststuff" class="metabox-holder">


                        <div class='meta-box'>  <div  class="postbox"   ><div title="Click to toggle" class="handlediv"><br></div> <h3 class='hndle'><span><?php _e('Emails', 'wpdev-booking'); ?></span></h3> <div class="inside">

                            <form  name="post_option" action="" method="post" id="post_option" >
                        

                            <table class="form-table email-table" >
                                <tbody>
                                    <tr><td colspan="2" class="th-title">
                                            <div style="float:left;"><h2><?php _e('Email to "Admin" after booking at site', 'wpdev-booking'); ?></h2></div>
                                            <div style="float:right;font-weight: bold;"><label for="is_email_reservation_adress" ><?php _e('Active', 'wpdev-booking'); ?>: </label><input id="is_email_reservation_adress" type="checkbox" <?php if ($is_email_reservation_adress == 'On') echo "checked"; ?>  value="<?php echo $is_email_reservation_adress; ?>" name="is_email_reservation_adress"/></div>
                                        </td></tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('To', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_reservation_adress"  name="email_reservation_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_reservation_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s for checking reservations', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('From', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_reservation_from_adress" name="email_reservation_from_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_reservation_from_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s from where this emeil is sending', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                            <th scope="row"><label for="admin_cal_count" ><?php _e('Subject', 'wpdev-booking'); ?>:</label></th>
                                            <td><input id="email_reservation_subject" name="email_reservation_subject"  class="regular-text code" type="text" size="45" value="<?php echo $email_reservation_subject; ?>" />
                                                <span class="description"><?php printf(__('Type your email subject for %schecking booking%s. You can use these %s shortcodes.', 'wpdev-booking'),'<b>','</b>', '<code>[name]</code>, <code>[secondname]</code>');?></span>
                                            </td>
                                    </tr>

                                    <tr valign="top">
                                        <td colspan="2">
                                            <span class="description"><?php printf(__('Type your %semail message for checking booking%s at site. ', 'wpdev-booking'),'<b>','</b>');  ?></span>
                                              <textarea id="email_reservation_content" name="email_reservation_content" style="width:100%;" rows="2"><?php echo ($email_reservation_content); ?></textarea>
                                              <span class="description"><?php printf(__('Use this shortcodes: ', 'wpdev-booking'));?></span>
                                              <span class="description"><?php printf(__('%s - inserting name of person, who made booking (field %s requred at form for this bookmark), ', 'wpdev-booking'),'<code>[name]</code>','[text name]');?></span>
                                              <span class="description"><?php printf(__('%s - inserting dates of booking, ', 'wpdev-booking'),'<code>[dates]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting type of booking resource, ', 'wpdev-booking'),'<code>[bookingtype]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting detail person info, ', 'wpdev-booking'),'<code>[content]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting moderate link of new booking, ', 'wpdev-booking'),'<code>[moderatelink]</code>');?></span>
                                              <?php if ($this->wpdev_bk_premium != false) { ?><span class="description"><?php printf(__('%s - inserting cost of this booking, ', 'wpdev-booking'),'<code>[cost]</code>');?></span><?php } ?>
                                              <span class="description"><?php printf(__('%s - inserting new line', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span>
                                              <br/><?php echo (sprintf(__('For example: "You need to approve new reservation %s at dates: %s Person detail information:%s Thank you, Booking service."', 'wpdev-booking'),'[bookingtype]','[dates]&lt;br/&gt;&lt;br/&gt;','&lt;br/&gt; [content]&lt;br/&gt;&lt;br/&gt;')); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="form-table email-table" >
                                <tbody>
                                    <tr><td colspan="2"  class="th-title">
                                            <div style="float:left;"><h2><?php _e('Email to "Person" after new reservation is done by this person', 'wpdev-booking'); ?></h2></div>
                                            <div style="float:right;font-weight: bold;"><label for="is_email_newbookingbyperson_adress" ><?php _e('Active', 'wpdev-booking'); ?>: </label><input id="is_email_newbookingbyperson_adress" type="checkbox" <?php if ($is_email_newbookingbyperson_adress == 'On') echo "checked"; ?>  value="<?php echo $is_email_newbookingbyperson_adress; ?>" name="is_email_newbookingbyperson_adress"/></div>
                                        </td></tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('From', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_newbookingbyperson_adress"  name="email_newbookingbyperson_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_newbookingbyperson_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s from where this emeil is sending', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                            <th scope="row"><label for="admin_cal_count" ><?php _e('Subject', 'wpdev-booking'); ?>:</label></th>
                                            <td><input id="email_newbookingbyperson_subject"  name="email_newbookingbyperson_subject" class="regular-text code" type="text" size="45" value="<?php echo $email_newbookingbyperson_subject; ?>" />
                                                <span class="description"><?php printf(__('Type your email subject for %svisitor after creation new reservation%s. You can use these %s shortcodes.', 'wpdev-booking'),'<b>','</b>', '<code>[name]</code>, <code>[secondname]</code>');?></span>
                                            </td>
                                    </tr>

                                    <tr valign="top">
                                        <td colspan="2">
                                              <span class="description"><?php printf(__('Type your %semail message for visitor after creation new reservation%s at site', 'wpdev-booking'),'<b>','</b>');?></span>
                                              <textarea id="email_newbookingbyperson_content" name="email_newbookingbyperson_content" style="width:100%;" rows="2"><?php echo ($email_newbookingbyperson_content); ?></textarea>
                                              <span class="description"><?php printf(__('Use this shortcodes: ', 'wpdev-booking'));?></span>
                                              <span class="description"><?php printf(__('%s - inserting name of person, who made booking (field %s requred at form for this bookmark), ', 'wpdev-booking'),'<code>[name]</code>','[text name]');?></span>
                                              <span class="description"><?php printf(__('%s - inserting dates of booking, ', 'wpdev-booking'),'<code>[dates]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting type of booking resource, ', 'wpdev-booking'),'<code>[bookingtype]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting detail person info, ', 'wpdev-booking'),'<code>[content]</code>');?></span>
                                              <?php if ($this->wpdev_bk_premium != false) { ?><span class="description"><?php printf(__('%s - inserting cost of this booking, ', 'wpdev-booking'),'<code>[cost]</code>');?></span><?php } ?>
                                              <span class="description"><?php printf(__('%s - inserting new line', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span>
                                              <br/><?php echo (sprintf(__('For example: "Your reservation %s at dates: %s is processing now! Please, wait for the confirmation email. %sThank you, Booking service."', 'wpdev-booking'),'[bookingtype]', '[dates]','&lt;br/&gt;&lt;br/&gt;[content]&lt;br/&gt;&lt;br/&gt;')); ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table class="form-table email-table" >
                                <tbody>
                                    <tr><td colspan="2"  class="th-title">
                                            <div style="float:left;"><h2><?php _e('Email to "Person" after approval of booking', 'wpdev-booking'); ?></h2></div>
                                            <div style="float:right;font-weight: bold;"><label for="is_email_approval_adress" ><?php _e('Active', 'wpdev-booking'); ?>: </label><input id="is_email_approval_adress" type="checkbox" <?php if ($is_email_approval_adress == 'On') echo "checked"; ?>  value="<?php echo $is_email_approval_adress; ?>" name="is_email_approval_adress"/></div>
                                        </td></tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('From', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_approval_adress"  name="email_approval_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_approval_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s from where this emeil is sending', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                            <th scope="row"><label for="admin_cal_count" ><?php _e('Subject', 'wpdev-booking'); ?>:</label></th>
                                            <td><input id="email_approval_subject"  name="email_approval_subject" class="regular-text code" type="text" size="45" value="<?php echo $email_approval_subject; ?>" />
                                                <span class="description"><?php printf(__('Type your email subject for %sapproval of booking%s. You can use these %s shortcodes.', 'wpdev-booking'),'<b>','</b>', '<code>[name]</code>, <code>[secondname]</code>');?></span>
                                            </td>
                                    </tr>

                                    <tr valign="top">
                                        <td colspan="2">
                                              <span class="description"><?php printf(__('Type your %semail message for approval booking%s at site', 'wpdev-booking'),'<b>','</b>');?></span>
                                              <textarea id="email_approval_content" name="email_approval_content" style="width:100%;" rows="2"><?php echo ($email_approval_content); ?></textarea>
                                              <span class="description"><?php printf(__('Use this shortcodes: ', 'wpdev-booking'));?></span>
                                              <span class="description"><?php printf(__('%s - inserting name of person, who made booking (field %s requred at form for this bookmark), ', 'wpdev-booking'),'<code>[name]</code>','[text name]');?></span>
                                              <span class="description"><?php printf(__('%s - inserting dates of booking, ', 'wpdev-booking'),'<code>[dates]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting type of booking resource, ', 'wpdev-booking'),'<code>[bookingtype]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting detail person info, ', 'wpdev-booking'),'<code>[content]</code>');?></span>
                                              <?php if ($this->wpdev_bk_premium != false) { ?><span class="description"><?php printf(__('%s - inserting cost of this booking, ', 'wpdev-booking'),'<code>[cost]</code>');?></span><?php } ?>
                                              <span class="description"><?php printf(__('%s - inserting new line', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span>
                                              <br/><?php echo (sprintf(__('For example: "Your reservation %s at dates: %s has been approved.%sThank you, Booking service."', 'wpdev-booking'),'[bookingtype]', '[dates]','&lt;br/&gt;&lt;br/&gt;[content]&lt;br/&gt;&lt;br/&gt;')); ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="form-table email-table" >
                                <tbody>
                                    <tr><td colspan="2"  class="th-title">
                                            <div style="float:left;"><h2><?php _e('Email to "Person" after deny of booking', 'wpdev-booking'); ?></h2></div>
                                            <div style="float:right;font-weight: bold;"><label for="is_email_deny_adress" ><?php _e('Active', 'wpdev-booking'); ?>: </label><input id="is_email_approval_adress" type="checkbox" <?php if ($is_email_deny_adress == 'On') echo "checked"; ?>  value="<?php echo $is_email_deny_adress; ?>" name="is_email_deny_adress"/></div>
                                        </td></tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('From', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_deny_adress"  name="email_deny_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_deny_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s from where this emeil is sending', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                            <th scope="row"><label for="admin_cal_count" ><?php _e('Subject', 'wpdev-booking'); ?>:</label></th>
                                            <td><input id="email_deny_subject"  name="email_deny_subject" class="regular-text code" type="text" size="45" value="<?php echo $email_deny_subject; ?>" />
                                                <span class="description"><?php printf(__('Type your email subject for %sdeny of booking%s. You can use these %s shortcodes.', 'wpdev-booking'),'<b>','</b>', '<code>[name]</code>, <code>[secondname]</code>');?></span>
                                            </td>
                                    </tr>

                                    <tr valign="top">
                                        <td colspan="2">
                                              <span class="description"><?php printf(__('Type your %semail message for deny booking%s at site', 'wpdev-booking'),'<b>','</b>');?></span>
                                              <textarea id="email_deny_content" name="email_deny_content" style="width:100%;" rows="2"><?php echo ($email_deny_content); ?></textarea>
                                              <span class="description"><?php printf(__('Use this shortcodes: ', 'wpdev-booking'));?></span>
                                              <span class="description"><?php printf(__('%s - inserting name of person, who made booking (field %s requred at form for this bookmark), ', 'wpdev-booking'),'<code>[name]</code>','[text name]');?></span>
                                              <span class="description"><?php printf(__('%s - inserting dates of booking, ', 'wpdev-booking'),'<code>[dates]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting type of booking resource, ', 'wpdev-booking'),'<code>[bookingtype]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting detail person info', 'wpdev-booking'),'<code>[content]</code>');?></span>,
                                              <span class="description"><?php printf(__('%s - inserting reason of cancel booking', 'wpdev-booking'),'<code>[denyreason]</code>');?></span>,
                                              <?php if ($this->wpdev_bk_premium != false) { ?><span class="description"><?php printf(__('%s - inserting cost of this booking, ', 'wpdev-booking'),'<code>[cost]</code>');?></span><?php } ?>
                                              <span class="description"><?php printf(__('%s - inserting new line', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span>
                                              <br/><?php echo (   sprintf(__('For example: "Your reservation %s at dates: %s has been  canceled. %s Thank you, Booking service."', 'wpdev-booking'), '[bookingtype]' ,'[dates]' , '&lt;br/&gt;&lt;br/&gt;[denyreason]&lt;br/&gt;&lt;br/&gt;[content]&lt;br/&gt;&lt;br/&gt;')); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="form-table email-table" >
                                <tbody>
                                    <tr><td colspan="2"  class="th-title">
                                            <div style="float:left;"><h2><?php _e('Email to "Person" after modification of booking', 'wpdev-booking'); ?></h2></div>
                                            <div style="float:right;font-weight: bold;"><label for="is_email_modification_adress" ><?php _e('Active', 'wpdev-booking'); ?>: </label><input id="is_email_approval_adress" type="checkbox" <?php if ($is_email_modification_adress == 'On') echo "checked"; ?>  value="<?php echo $is_email_modification_adress; ?>" name="is_email_modification_adress"/></div>
                                        </td></tr>

                                    <tr valign="top">
                                        <th scope="row"><label for="admin_cal_count" ><?php _e('From', 'wpdev-booking'); ?>:</label></th>
                                        <td><input id="email_modification_adress"  name="email_modification_adress" class="regular-text code" type="text" size="45" value="<?php echo $email_modification_adress; ?>" />
                                            <span class="description"><?php printf(__('Type default %sadmin email%s from where this emeil is sending', 'wpdev-booking'),'<b>','</b>');?></span>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                            <th scope="row"><label for="admin_cal_count" ><?php _e('Subject', 'wpdev-booking'); ?>:</label></th>
                                            <td><input id="email_modification_subject"  name="email_modification_subject" class="regular-text code" type="text" size="45" value="<?php echo $email_modification_subject; ?>" />
                                                <span class="description"><?php printf(__('Type your email subject for %smodification of booking%s. You can use these %s shortcodes.', 'wpdev-booking'),'<b>','</b>', '<code>[name]</code>, <code>[secondname]</code>');?></span>
                                            </td>
                                    </tr>

                                    <tr valign="top">
                                        <td colspan="2">
                                              <span class="description"><?php printf(__('Type your %semail message for modification booking%s at site', 'wpdev-booking'),'<b>','</b>');?></span>
                                              <textarea id="email_modification_content" name="email_modification_content" style="width:100%;" rows="2"><?php echo ($email_modification_content); ?></textarea>
                                              <span class="description"><?php printf(__('Use this shortcodes: ', 'wpdev-booking'));?></span>
                                              <span class="description"><?php printf(__('%s - inserting name of person, who made booking (field %s requred at form for this bookmark), ', 'wpdev-booking'),'<code>[name]</code>','[text name]');?></span>
                                              <span class="description"><?php printf(__('%s - inserting dates of booking, ', 'wpdev-booking'),'<code>[dates]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting type of booking resource, ', 'wpdev-booking'),'<code>[bookingtype]</code>');?></span>
                                              <span class="description"><?php printf(__('%s - inserting detail person info', 'wpdev-booking'),'<code>[content]</code>');?></span>,
                                              <?php if ($this->wpdev_bk_premium != false) { ?><span class="description"><?php printf(__('%s - inserting cost of this booking, ', 'wpdev-booking'),'<code>[cost]</code>');?></span><?php } ?>
                                              <span class="description"><?php printf(__('%s - inserting new line', 'wpdev-booking'),'<code>&lt;br/&gt;</code>');?></span>
                                              <br/><?php echo (   sprintf(__('For example: "Your reservation %s at dates: %s has been  edited by administrator. %s Thank you, Booking service."', 'wpdev-booking'), '[bookingtype]' ,'[dates]' , '&lt;br/&gt;&lt;br/&gt;[content]&lt;br/&gt;&lt;br/&gt;')); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="clear" style="height:10px;"></div>
                            <input class="button-primary" style="float:right;" type="submit" value="<?php _e('Save', 'wpdev-booking'); ?>" name="Submit"/>
                            <div class="clear" style="height:10px;"></div>

                            </form>
                        

                   </div> </div> </div>

                    </div>

                    <!--script type="text/javascript">
                         jWPDev(document).ready(function(){

                                jWPDev('.postbox .handlediv').click( function(e) {
                                    
                                    if ( jWPDev(this + ':parent').hasClass('closed') ) jWPDev(this+ ':parent').removeClass('closed');
                                    else                                   jWPDev(this+ ':parent').addClass('closed');
                                } );
                         });
                </script-->

            <?php


        }


 //   A C T I V A T I O N   A N D   D E A C T I V A T I O N    O F   T H I S   P L U G I N  ///////////////////////////////////////////////////

        // Activate
        function pro_activate() {
               if ($this->wpdev_bk_premium == false) {
                    add_option( 'booking_form' , str_replace('\\n\\','',$this->get_default_form()));
                    add_option( 'booking_form_show' ,str_replace('\\n\\','',$this->get_default_form_show()));
               } else {
                    add_option( 'booking_form' , str_replace('\\n\\','', $this->reset_to_default_form('payment') ));
                    add_option( 'booking_form_show' ,str_replace('\\n\\','',$this->reset_to_default_form_show('payment') ));
               }
               update_option( 'booking_skin', WPDEV_BK_PLUGIN_URL . '/include/skins/premium-marine.css');

                $charset_collate = '';
                $wp_queries = array();
                global $wpdb;

                if ( ( ! $this->is_table_exists('bookingtypes')  )) { // Cehck if tables not exist yet
                        if ( $wpdb->has_cap( 'collation' ) ) {
                            if ( ! empty($wpdb->charset) )
                                $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
                            if ( ! empty($wpdb->collate) )
                                $charset_collate .= " COLLATE $wpdb->collate";
                        }
                        /** Create WordPress database tables SQL */
                        $wp_queries[] = "CREATE TABLE ".$wpdb->prefix ."bookingtypes (
                             booking_type_id bigint(20) unsigned NOT NULL auto_increment,
                             title varchar(200) NOT NULL default '',
                             PRIMARY KEY  (booking_type_id)
                            ) $charset_collate;";

                        $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."bookingtypes ( title ) VALUES ( '". __('Default', 'wpdev-booking') ."' );";
                        $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."bookingtypes ( title ) VALUES ( '". __('Appartment #1', 'wpdev-booking') ."' );";
                        $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."bookingtypes ( title ) VALUES ( '". __('Appartment #2', 'wpdev-booking') ."' );";
                        $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."bookingtypes ( title ) VALUES ( '". __('Appartment #3', 'wpdev-booking') ."' );";

                        $wp_queries[] = "INSERT INTO ".$wpdb->prefix ."booking ( form ) VALUES (
                         'text^starttime1^10:20~text^endtime1^15:40~text^name1^Victoria~text^secondname1^Smith~text^email1^victoria@wpdevelop.com~text^phone1^(044)458-77-88~select-one^visitors1^2~checkbox^children1[]^false~textarea^details1^Please, reserve an appartment with fresh flowers.' );";

                        foreach ($wp_queries as $wp_q)
                            $wpdb->query($wp_q);

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

                if  ($this->is_field_in_table_exists('booking','remark') == 0){ // Add remark field
                    $simple_sql = "ALTER TABLE ".$wpdb->prefix ."booking ADD remark TEXT NOT NULL DEFAULT ''";
                    $wpdb->query($simple_sql);
                }

            add_option( 'booking_email_newbookingbyperson_adress',htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_newbookingbyperson_subject',__('New reservation', 'wpdev-booking'));
            $blg_title = get_option('blogname'); $blg_title = str_replace('"', '', $blg_title);$blg_title = str_replace("'", '', $blg_title);
            add_option( 'booking_email_newbookingbyperson_content',htmlspecialchars(sprintf(__('Your reservation %s for: %s is processing now! Please, wait for the confirmation email. %sThank you, %s', 'wpdev-booking'),'[bookingtype]','[dates]','<br/><br/>[content]<br/><br/>',$blg_title.'<br/>[siteurl]')));
            add_option( 'booking_is_email_newbookingbyperson_adress', 'Off' );

            add_option( 'booking_email_modification_adress',htmlspecialchars('"Booking system" <' .get_option('admin_email').'>'));
            add_option( 'booking_email_modification_subject',__('Your reservation has been modificated', 'wpdev-booking'));
            $blg_title = get_option('blogname'); $blg_title = str_replace('"', '', $blg_title);$blg_title = str_replace("'", '', $blg_title);
            add_option( 'booking_email_modification_content',htmlspecialchars(sprintf(__('Your reservation %s for: %s has been  edited by administrator. %sThank you, %s', 'wpdev-booking'),'[bookingtype]','[dates]','<br/><br/>[content]<br/><br/>',$blg_title.'<br/>[siteurl]')));
            add_option( 'booking_is_email_modification_adress', 'On' );



        }

        //Decativate
        function pro_deactivate(){
            global $wpdb;

            delete_option( 'booking_form');
            delete_option( 'booking_form_show');

            delete_option( 'booking_email_modification_adress' );
            delete_option( 'booking_email_modification_subject');
            delete_option( 'booking_email_modification_content');
            delete_option( 'booking_is_email_modification_adress');

            delete_option( 'booking_email_newbookingbyperson_adress' );
            delete_option( 'booking_email_newbookingbyperson_subject');
            delete_option( 'booking_email_newbookingbyperson_content');
            delete_option( 'booking_is_email_newbookingbyperson_adress');

            $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'bookingtypes');

        }

    }
}


//  S u p p o r t    f u n c t i o n s       /////////////////////////////////////////////////////////////////////////////////////////////////////////

function get__default_type(){
            global $wpdb;
            $mysql = "SELECT booking_type_id as id FROM  ".$wpdb->prefix ."bookingtypes ORDER BY id ASC LIMIT 1";
            $types_list = $wpdb->get_results( $mysql );
            if (count($types_list) > 0 ) $types_list = $types_list[0]->id;
            else $types_list =1;
            return $types_list;

}


function get_booking_title( $type_id = 1){ 
    global $wpdb;
    $types_list = $wpdb->get_results( "SELECT title FROM ".$wpdb->prefix ."bookingtypes  WHERE booking_type_id =" . $type_id ); 
    if ($types_list)
        return $types_list[0]->title;
    else
        return '';
}


// A J A X     R e s p o n d e r   Real Ajax with jWPDev sender     //////////////////////////////////////////////////////////////////////////////////
function wpdev_pro_bk_ajax(){
    if (!function_exists ('adebug')) { function adebug() { $var = func_get_args(); echo "<div style='text-align:left;background:#ffffff;border: 1px dashed #ff9933;font-size:11px;line-height:15px;font-family:'Lucida Grande',Verdana,Arial,'Bitstream Vera Sans',sans-serif;'><pre>"; print_r ( $var ); echo "</pre></div>"; } }
    global $wpdb;

    $action = $_POST['ajax_action'];

    switch ($action) {
        case 'ADD_BK_TYPE':
            $title = $_POST[ "title" ];
            $wp_querie  = "INSERT INTO ".$wpdb->prefix ."bookingtypes (
             title
            ) VALUES (
             '".$title."'
            );";

            if ( false === $wpdb->query( $wp_querie ) ) {
                ?> <script type="text/javascript">document.getElementById('ajax_message').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during inserting into BD', 'wpdev-booking'); ?></div>'; jWPDev('#ajax_message').fadeOut(5000); </script> <?php
                die();
            } else {
                $newid = (int) $wpdb->insert_id;
                ?> <script type="text/javascript">
                    document.getElementById('ajax_message').innerHTML = '<?php echo __('Saved', 'wpdev-booking'); ?>';
                    document.getElementById('last_book_type').innerHTML = '<?php
                    //echo '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking&booking_type='.$newid.'"  class="bktypetitle">' . $title . '</a>  <a href="#" title="'. __('Delete', 'wpdev-booking') .'" style="text-decoration:none;" onclick="javascript:delete_bk_type('.$newid.');"><img src="'.WPDEV_BK_PLUGIN_URL.'/img/delete_type.png" width="8" height="8" /></a>' ;
                    echo '<a href="admin.php?page=' . WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking&booking_type='.$newid.'"  class="bktypetitlenew">' .  $title  . '</a>';
                            ?>';
                    jWPDev('#last_book_type').attr("id",'bktype<?php echo $newid; ?>');
                    //jWPDev('#last_book_type_separator').attr("id",'bktype_separator<?php echo $newid; ?>');
                    jWPDev('#ajax_message').fadeOut(1000);
                </script> <?php
                die();
            }

            break;

        case 'EDIT_BK_TYPE':
            $title = $_POST[ "title" ];
            $type_id = $_POST[ "type_id" ];

            $wp_querie  = "UPDATE ".$wpdb->prefix ."bookingtypes SET title='".$title."'  WHERE booking_type_id = $type_id";

            if ( false === $wpdb->query( $wp_querie ) ) {
                ?> <script type="text/javascript">document.getElementById('ajax_message').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during editing BD', 'wpdev-booking'); ?></div>'; jWPDev('#ajax_message').fadeOut(5000); </script> <?php
                die();
            } else {
                ?> <script type="text/javascript">
                    document.getElementById('ajax_message').innerHTML = '<?php echo __('Saved', 'wpdev-booking'); ?>';
                    jWPDev('#ajax_message').fadeOut(1000);
                </script> <?php
                die();
            }
            break;

        case 'DELETE_BK_TYPE':
            $type_id = $_POST['type_id'];

           $wp_querie = "DELETE FROM ".$wpdb->prefix ."bookingtypes WHERE booking_type_id = $type_id";

            if ( false === $wpdb->query( $wp_querie ) ) {
                ?> <script type="text/javascript">document.getElementById('ajax_message').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Error during deleting from BD', 'wpdev-booking'); ?></div>'; jWPDev('#ajax_message').fadeOut(5000); </script> <?php
            } else {
                ?> <script type="text/javascript">
                    document.getElementById('ajax_message').innerHTML = '<?php echo __('Deleted', 'wpdev-booking'); ?>';
                    jWPDev('#ajax_message').fadeOut(1000);
                    jWPDev('#bktype<?php echo $type_id; ?>' ).fadeOut(1000);
                    jWPDev('#bktype_separator<?php echo $type_id; ?>' ).fadeOut(1000);
                </script> <?php
            }
            die();

            break;
        default:
            break;
    }

}

?>
