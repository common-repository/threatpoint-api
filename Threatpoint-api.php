<?php
/*
    Plugin Name: ThreatPoint IP Reputation 
    Plugin URI: https://threatpoint.co.uk
    Description: Protect your WordPress Site from unwanted access attempts, by leveraging IP reputation data provided by the ThreatPoint IP reputation service. Malicious IP, High Risk IP, TOR, VPN, Geo IP. Use to stop brute force attacks - XMLRPC, WP-login and protect contact pages. 
    Author: ThreatPoint
    Version: 2.7
    Author URI: https://threatpoint.co.uk
    License: GPL-2.0+
    License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) or die( 'Unauthorised Access!' );


add_action( 'admin_menu', 'tp_api_add_admin_menu' );
add_action( 'admin_init', 'tp_api_settings_init' );

function tp_api_add_admin_menu(  ) {
    add_options_page( 'ThreatPoint IP Rep', 'ThreatPoint IP Rep', 'manage_options', 'ThreatPoint-api-page', 'tp_api_options_page' );
}

function tp_api_settings_init(  ) {
    register_setting( 'tpPlugin', 'tp_api_settings' );
    add_settings_section(
        'tp_api_tpPlugin_section',
        __( '', 'wordpress' ),
        'tp_api_settings_section_callback',
        'tpPlugin'
    );

    add_settings_field(
        'tp_api_text_field_0',
        __( 'API Key', 'wordpress' ),
        'tp_api_text_field_0_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_1',
        __( 'Country Blacklist', 'wordpress' ),
        'tp_api_select_field_1_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_4',
        __( 'Country Whitelist', 'wordpress' ),
        'tp_api_select_field_4_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

     add_settings_field(
        'tp_api_select_field_2',
        __( 'Redirection URL', 'wordpress' ),
        'tp_api_select_field_2_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_3',
        __( 'Reject IP Risk >=', 'wordpress' ),
        'tp_api_select_field_3_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

     add_settings_field(
        'tp_api_select_field_5',
        __( 'Reject Tor Exit Nodes', 'wordpress' ),
        'tp_api_select_field_5_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

      add_settings_field(
        'tp_api_select_field_6',
        __( 'Reject Anonymizer VPNs', 'wordpress' ),
        'tp_api_select_field_6_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
       
      add_settings_field(
        'tp_api_select_field_7',
        __( 'Pages to check (Comma separated list)', 'wordpress' ),
        'tp_api_select_field_7_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_8',
        __( 'Disable XMLRPC endpoint', 'wordpress' ),
        'tp_api_select_field_8_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_9',
        __( 'Enable Mail Notifications', 'wordpress' ),
        'tp_api_select_field_9_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_10',
        __( 'Email Address to Notify', 'wordpress' ),
        'tp_api_select_field_10_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_11',
        __( 'Auto Block Malicious IPs', 'wordpress' ),
        'tp_api_select_field_11_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_12',
        __( 'Allow specific bots', 'wordpress' ),
        'tp_api_select_field_12_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );
    
    add_settings_field(
        'tp_api_select_field_13',
        __( 'Bots to allow (Comma separated list)', 'wordpress' ),
        'tp_api_select_field_13_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

}

function tp_api_text_field_0_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_0]' value='<?php echo $options['tp_api_text_field_0']; ?>'>
    <?php echo '<b>&#8505 An API key is required - contact api@threatpoint.co.uk</b>'; ?>
    <?php
}

function tp_api_select_field_1_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_1]' value='<?php echo $options['tp_api_text_field_1']; ?>'>
     <?php echo '<b>&#8505 Countries to block, comma separated 2 char ISO codes.</b>'; ?>
    <?php
}

function tp_api_select_field_2_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_2]' value='<?php echo $options['tp_api_text_field_2']; ?>'>
     <?php echo '<b>&#8505 Redirection URL - This needs to be set to redirect the blocked access attempt.</b>'; ?>
    <?php
}

function tp_api_select_field_3_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_3]'>
        <option value='1' <?php selected( $options['tp_api_select_field_3'], 1 ); ?>>High</option>
        <option value='2' <?php selected( $options['tp_api_select_field_3'], 2 ); ?>>Consider</option>
        <option value='3' <?php selected( $options['tp_api_select_field_3'], 3 ); ?>>Low</option>
    </select>
     <?php echo '<b>&#8505 Reject IP risk based on rating.</b>'; ?>
    <?php
}

function tp_api_select_field_4_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_4]' value='<?php echo $options['tp_api_text_field_4']; ?>'>
    <?php echo '<b>&#8505 Countries to allow, comma separated 2 char ISO codes.</b>'; ?>
    <?php
}


function tp_api_select_field_5_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_5]'>
        <option value='1' <?php selected( $options['tp_api_select_field_5'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['tp_api_select_field_5'], 2 ); ?>>No</option>
    </select>
    <?php echo '<b>&#8505 Reject access attempts made from the Tor network.</b>'; ?>
    <?php
}

function tp_api_select_field_6_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_6]'>
        <option value='1' <?php selected( $options['tp_api_select_field_6'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['tp_api_select_field_6'], 2 ); ?>>No</option>
    </select>
    <?php echo '<b>&#8505 Reject access from VPN/Proxies (Paid and Free).</b>'; ?>
    <?php
}

function tp_api_select_field_7_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_7]' value='<?php echo $options['tp_api_text_field_7']; ?>'>
    <?php echo '<b>&#8505 Accepts slug name for custom pages (not admin) and is not case sensitive. i.e. contact,application-page. WP-Admin is protected by default and does not need to be included here.</b>'; ?>
    <?php
}

function tp_api_select_field_8_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_8]'>
        <option value='1' <?php selected( $options['tp_api_select_field_8'], 1 ); ?>>No</option>
        <option value='2' <?php selected( $options['tp_api_select_field_8'], 2 ); ?>>Yes</option>
    </select>
    <?php echo '<b>&#8505 XMLRPC.php is often enabled by default. This is a known attack vector and can be disabled. Requires write access to .htaccess</b>'; ?>
    <?php
}

function tp_api_select_field_9_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_9]'>
        <option value='1' <?php selected( $options['tp_api_select_field_9'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['tp_api_select_field_9'], 2 ); ?>>No</option>
    </select>
    <?php echo '<b>&#8505 Email Notifications use wp_mail to send.</b>'; ?>
    <?php
}

function tp_api_select_field_10_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_10]' value='<?php echo $options['tp_api_text_field_10']; ?>'>
    <?php echo '<b>&#8505 Enter a valid email address.</b>'; ?>
    <?php
}

function tp_api_select_field_11_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_11]'>
        <option value='1' <?php selected( $options['tp_api_select_field_11'], 1 ); ?>>No</option>
        <option value='2' <?php selected( $options['tp_api_select_field_11'], 2 ); ?>>Yes</option>
    </select>
    <?php echo '<b>&#8505 Block Malicious IPs - Malicious IPs are known botnets, malware, aggregator, c&cs seen realtime across the Threatpoint Network - Requires write access to .htaccess</b>'; ?>
    <?php
}

function tp_api_select_field_12_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_12]'>
        <option value='1' <?php selected( $options['tp_api_select_field_12'], 1 ); ?>>No</option>
        <option value='2' <?php selected( $options['tp_api_select_field_12'], 2 ); ?>>Yes</option>
    </select>
    <?php echo '<b>&#8505 Allow specific bots that might be otherwise blocked if using country controls. Enter bot names (csv) in the option below</b>'; ?>
    <?php
}

function tp_api_select_field_13_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_13]' value='<?php echo $options['tp_api_text_field_13']; ?>'>
    <?php echo '<b>&#8505 Accepts name for bots and is not case sensitive. i.e. googlebot, search.msn.com (bing)</b>'; ?>
    <?php
}

function tp_api_settings_section_callback(  ) {
    echo __( '<img src="https://threatpoint.co.uk/wp-content/uploads/2020/09/cropped-ThreatPoint_Logo-12.png" alt="ThreatPoint Cyber Security" style="margin-left:3%">', 'wordpress' ); 
    echo __( '<p></>', 'wordpress' ); 
    echo __( '<li><b>Enter the information in the sections below to complete the API configuration</b></li><br>', 'wordpress' );
    echo __( '<li><i><b>Email api@threatpoint.co.uk for an API key - 30 Day free trial. No sign up or credit card required.</b></i></li><br>', 'wordpress' );
    echo __( '<li><i><b>Documentation:- <a href="https://threatpoint.co.uk/documentation">ThreatPoint Documentation</a></b></i></li>', 'wordpress' );
}

function tp_api_options_page(  ) {
$options = get_option( 'tp_api_settings' );
$key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
$ipa = "notset";
$url = 'https://verifyb.threatpoint.co.uk:443/api/v1/resources/ipstats';
$arguments = array ('sslverify' => false,
                            'headers' => array('X-Api-Key' => $key));
$response = wp_remote_get( $url, $arguments);
                                if (is_wp_error( $response ) ) {
						
                                        echo 'Errors detected!';

                                }
				if (empty($key)){
					
					echo "Api key not set";

				}
					else {
                                                $body = wp_remote_retrieve_body( $response );
                                                $data = json_decode( $body );
						$output = '<table>';
						$output .= '<table border ="2" style="background-color:#FFFFFF">';
						$output .= '<tr><th>Date</th><th>Detail</th><th>IP</th><th>Total</th></tr>';	
						foreach( $data as $datapoint => $var) {
							$output .= '<tr>';
							foreach($var as $k => $v){
									$output .= '<td>' . $v . '</td>';
								
								   
									
							}
							$output .= '</tr>';
						}
						$output .= '</tr>';
					 }

				if ($key){
					 $output .= '</table>';
				}
    ?>
   <div class='wrap'>
    <form action='options.php' method='post'>

        <h2>ThreatPoint IP Reputation API Configuration</h2>

        <?php
        settings_fields( 'tpPlugin' );
        do_settings_sections( 'tpPlugin' );
        submit_button();
        ?>
         
	<?php if ($key){echo "Top 10 High Risk IP requests to this site"; echo $output;} ?>
    </form>
   </div>
   <br></br>
   <div class="flourish-embed flourish-map" data-src="visualisation/2253919" data-url="https://flo.uri.sh/visualisation/2253919/embed"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
    <?php
}

//function deactivate plugin
//when the plug is deactivated, remove entries from .htaccess
function deactivatetp(){

						require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/misc.php');
						$htaccess = get_home_path().".htaccess";
						$lines = array();
						insert_with_markers($htaccess, "ThreatPoint IP", $lines);


						insert_with_markers($htaccess, "ThreatPoint XMLRPC", $lines); 	


}

register_deactivation_hook( __FILE__, 'deactivatetp' );

//sync malicious IP addresses into .htaccess to protect from post requests
//modify .htaccess if enabled and malicious address found
function addips(){
$malicious = esc_attr( get_option('tp_api_settings')['tp_api_select_field_11']);
$key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
			if ($malicious == '2'){
			$url = 'https://verifyb.threatpoint.co.uk:443/api/v1/resources/mal';
			$arguments = array ('sslverify' => false, 
			    'headers' => array('X-Api-Key' => $key));
			    
			    
			$response = wp_remote_get( $url, $arguments);
				if (is_wp_error( $response ) ) {
      
					echo 'Errors detected!';
		
				}else {
						$body = wp_remote_retrieve_body( $response );
						$data = json_decode( $body );
		
        				require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/misc.php');
						$htaccess = get_home_path().".htaccess";
						$lines = array();
						$lines[] = "<Limit GET POST>";
						$lines[] = "Order Allow,Deny";
						$lines[] = "Allow from all";
						
						
						foreach( $data as $datapoint) {
						$ipa  = $datapoint->ipaddress;
						
						$lines[] = "Deny from ".$ipa;
						
			
						}
						$lines[] = "</Limit>";

						$lines[] = "<Files wp-login.php>";
						$lines[] = "Order Allow,Deny";
						$lines[] = "Allow from all";
						
						foreach( $data as $datapoint) {
						$ipa  = $datapoint->ipaddress;
						
						$lines[] = "Deny from ".$ipa;
						
			
						}
						
						$lines[] = "</Files>";
						if ($ipa != ''){
						insert_with_markers($htaccess, "ThreatPoint IP", $lines);
						}
					}
			}
			if ($malicious == '1'){
			
						$body = wp_remote_retrieve_body( $response );
						$data = json_decode( $body );
		
        				require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/misc.php');
						$htaccess = get_home_path().".htaccess";
						$lines = array();
						

						insert_with_markers($htaccess, "ThreatPoint IP", $lines);
					}
			
		}
		
add_action( 'update_option_tp_api_settings', 'addips' );
function disableXMLRPC(){		
//disable XMLRPC endpoint from 
$DisableXMLRPC = esc_attr( get_option('tp_api_settings')['tp_api_select_field_8']);

if ($DisableXMLRPC == '2'){
  	  		require_once(ABSPATH . 'wp-admin/includes/file.php');
			require_once(ABSPATH . 'wp-admin/includes/misc.php');
			$htaccess = get_home_path().".htaccess";
			$lines = array();
  	  		$lines[] ="<Files xmlrpc.php>";
			$lines[] ="order allow,deny";
			$lines[] ="deny from all";
			$lines[] ="</Files>";
			insert_with_markers($htaccess, "ThreatPoint XMLRPC", $lines); 	
  	}
  	
if ($DisableXMLRPC == '1'){
  	  		require_once(ABSPATH . 'wp-admin/includes/file.php');
			require_once(ABSPATH . 'wp-admin/includes/misc.php');
			$htaccess = get_home_path().".htaccess";
			$lines = array();
			insert_with_markers($htaccess, "ThreatPoint XMLRPC", $lines); 	
  	}  	
  	
  	
}
add_action( 'update_option_tp_api_settings', 'disableXMLRPC' );


add_action( 'login_head', 'threatpoint_ip_rep');
function threatpoint_ip_rep() {

	$key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
	$countryconfig = esc_attr( get_option('tp_api_settings')['tp_api_text_field_1']);
	$redirect = esc_attr( get_option('tp_api_settings')['tp_api_text_field_2']);
	$iprisk = esc_attr( get_option('tp_api_settings')['tp_api_select_field_3']);
	$countrywhite = esc_attr( get_option('tp_api_settings')['tp_api_text_field_4']);
    $tor = esc_attr( get_option('tp_api_settings')['tp_api_select_field_5']);
    $vpn = esc_attr( get_option('tp_api_settings')['tp_api_select_field_6']);
    $mailon = esc_attr( get_option('tp_api_settings')['tp_api_select_field_9']);
    $emailaddress = esc_attr( get_option('tp_api_settings')['tp_api_text_field_10']);
    
  	$isVpn = 'Vpn';
  	$isTor = 'Tor';
  
  	if ($iprisk == '1'){
      $ipriskn = 'High';
    }
  	if ($iprisk == '2'){
      $ipriskn = 'Consider';
    }
  	if ($iprisk == '3'){
      $ipriskn = 'Low';
    }
  	
	$url = 'https://verifyb.threatpoint.co.uk:443/api/v1/resources/ip?ipaddress=';
	$arguments = array ('sslverify' => false, 
			    'headers' => array('X-Api-Key' => $key));

	$ip = $_SERVER['REMOTE_ADDR'];

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	$url2 = $url . $ip;
	$response = wp_remote_get( $url2, $arguments);
	
	if (is_wp_error( $response ) ) {
      
		echo 'Errors detected!';
		
	} else {
		$body = wp_remote_retrieve_body( $response );
		//$data = json_decode( $body, true );
		//$body =  '"city": "Islington"';
		$data = json_decode($body);
		$ipa = $data->ipaddress;
		//print_r($body);
		//print_r($data);
		//print_r($ipa);	
	//	foreach( $data as $datapoint) {
			$ipa  = $data->ipaddress;
			$risk = $data->risk;
			$country = $data->country_code;
			$countryname = $data->country_name;
			$cityname = $data->city;
			//print_r($risk);
			//print_r($country);
			//print_r($countryname);	
			//print_r($cityname);	
			
			if ($ipriskn == 'High' and (strpos($risk, $ipriskn) !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
              if ($tor == '1' or $vpn == '1'){
              	if ($mailon =='1'){
              	$to = $emailaddress;
                $subject = 'IP Risk >= Consider access';
                $body = 'IP Risk >= Consider country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
              	}
              
				wp_redirect( $redirect);
                exit;
              }
			}
          	if ($ipriskn == 'Consider' and (strpos($risk, 'High') !==false or strpos($risk, 'Consider') !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
			  if ($tor == '1' or $vpn == '1'){
			  	if ($mailon =='1'){
			  	$to = $emailaddress;
                $subject = 'IP Risk >= Consider access';
                $body = 'IP Risk >= Consider country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
			  	}
			  
				wp_redirect( $redirect);
                exit;
              }
			}
          	if ($ipriskn == 'Low' and (strpos($risk, 'High') !==false or strpos($risk, 'Consider') !==false or strpos($risk, 'Low') !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
              if ($tor == '1' or $vpn == '1'){
              	if ($mailon =='1'){
              	$to = $emailaddress;
                $subject = 'IP Risk >= LOW access attempt';
                $body = 'IP Risk >= LOW country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
              	}
              
				wp_redirect( $redirect);
                exit;
              }
			}
            if ($tor == '1' and strpos($risk, $isTor) !==false) {
            	if ($mailon =='1'){
            	$to = $emailaddress;
                $subject = 'TOR access attempt';
                $body = 'TOR access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            	}
				wp_redirect( $redirect);
				exit;
			}
            if ($vpn == '1' and strpos($risk, $isVpn) !==false) {
            	if ($mailon =='1'){
            	$to = $emailaddress;
                $subject = 'VPN access attempt';
                $body = 'VPN access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            	}
				wp_redirect( $redirect);
				exit;
			}
			if ($countryconfig !='' and strpos($countryconfig, $country) !==false) {
				if ($mailon =='1'){
				$to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'Blacklisted country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
				$sent = @wp_mail($to,$subject,$body,$headers);
				}
				wp_redirect( $redirect);
				exit;
			}
			if ($countrywhite !='' and strpos($countrywhite, $country) ===false) {
				if ($mailon =='1'){
				$to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'Blacklisted country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
				wp_redirect( $redirect);
				exit;
			}
		}
		
//	}
	
}
add_action( 'wp_head', 'threatpoint_ip_rep2',1 );
function threatpoint_ip_rep2() {
 $pageList = esc_attr( get_option('tp_api_settings')['tp_api_text_field_7']);
 $pageArray =explode(',', $pageList); 

foreach ($pageArray as $value){
 if( is_page($value)){
	$key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
	$countryconfig = esc_attr( get_option('tp_api_settings')['tp_api_text_field_1']);
	$redirect = esc_attr( get_option('tp_api_settings')['tp_api_text_field_2']);
	$iprisk = esc_attr( get_option('tp_api_settings')['tp_api_select_field_3']);
	$countrywhite = esc_attr( get_option('tp_api_settings')['tp_api_text_field_4']);
    $tor = esc_attr( get_option('tp_api_settings')['tp_api_select_field_5']);
    $vpn = esc_attr( get_option('tp_api_settings')['tp_api_select_field_6']);
    $mailon = esc_attr( get_option('tp_api_settings')['tp_api_select_field_9']);
    $emailaddress = esc_attr( get_option('tp_api_settings')['tp_api_text_field_10']);
    $botYes = esc_attr( get_option('tp_api_settings')['tp_api_select_field_12']);
    $botList = esc_attr( get_option('tp_api_settings')['tp_api_text_field_13']);
  	$isVpn = 'Vpn';
  	$isTor = 'Tor';
  
  	if ($iprisk == '1'){
      $ipriskn = 'High';
    }
  	if ($iprisk == '2'){
      $ipriskn = 'Consider';
    }
  	if ($iprisk == '3'){
      $ipriskn = 'Low';
    }
      
  	if ($botYes == '2'){
  	
  		$botURL = 'https://verifyb.threatpoint.co.uk:443/api/v1/resources/iptoname?ipaddress=';
  		$botArgs = array ('sslverify' => false, 
			    'headers' => array('X-Api-Key' => $key));
		$newip = $_SERVER['REMOTE_ADDR'];

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$newip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		
		$botNewUrl = $botURL . $newip; 
		$botResponse = wp_remote_get( $botNewUrl, $botArgs);
		
		if (is_wp_error( $botResponse ) ) {
      
		echo 'Errors detected!';
		
		} else {
			$botBody = wp_remote_retrieve_body ($botResponse);
			$botData = json_decode($botBody);
			
				
			$botMatch = $botData->isMatch;
			$botFdns = $botData->forwarddns;
			$botRdns = $botData->reversedns;
			$botip = $botData->original_ip;
					
			}
		
  	}
  	if ($botYes == '1'){
  		
  		$botMatch = false;
		$botFdns =  null;
		$botRdns = null;
		$botip = null;
  	}
	$botArray =explode(',', $botList);
	$botNameMatch = false;
  	foreach ($botArray as $value){
		$pos = strpos($botFdns, $value);
		if ($pos === false)
		{
			//echo "Holy moly there is no match";
		}else{
			
			$botNameMatch = true;
			
		}
		if ($botMatch == "False"){
			$botNameMatch = false;
		}
	}
     	//echo "<p>bot name match value =".$botNameMatch."</p>";
	//exit; 
	
	$url = 'https://verifyb.threatpoint.co.uk:443/api/v1/resources/ip?ipaddress=';
	$arguments = array ('sslverify' => false, 
			    'headers' => array('X-Api-Key' => $key));

	$ip = $_SERVER['REMOTE_ADDR'];

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	$url2 = $url . $ip;
	$response = wp_remote_get( $url2, $arguments);
	
	if (is_wp_error( $response ) ) {
      
		echo 'Errors detected!';
		
	} else {
		$body = wp_remote_retrieve_body( $response );
		$data = json_decode ($body);
        
				
		//foreach( $data->data as $datapoint) {
			$ipa  = $data->ipaddress;
			$risk = $data->risk;
			$country = $data->country_code;
			$countryname = $data->country_name;
			$cityname = $data->city;
			
			
			if ($ipriskn == 'High' and (strpos($risk, $ipriskn) !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
              if ($tor == '1' or $vpn == '1'){
              	if ($mailon =='1'){
              	$to = $emailaddress;
                $subject = 'IP Risk High - access attempt';
                $body = 'IP Risk High - country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
				
				wp_redirect( $redirect);
                exit;
              }
			}
          	if ($ipriskn == 'Consider' and (strpos($risk, 'High') !==false or strpos($risk, 'Consider') !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
			  if ($tor == '1' or $vpn == '1'){
			  	if ($mailon =='1'){
			  	$to = $emailaddress;
                $subject = 'IP Risk >= Consider access attempt';
                $body = 'IP Risk >= Consider country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
			  
				wp_redirect( $redirect);
                exit;
              }
			}
          	if ($ipriskn == 'Low' and (strpos($risk, 'High') !==false or strpos($risk, 'Consider') !==false or strpos($risk, 'Low') !==false and (strpos($risk, $isTor) ===false and strpos($risk, $isVpn) ===false))) {
              if ($tor == '1' or $vpn == '1'){
              	if ($mailon =='1'){
              	$to = $emailaddress;
                $subject = 'IP Risk >= LOW access attempt';
                $body = 'IP Risk >= LOW country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
              		
				wp_redirect( $redirect);
                exit;
              }
			}
            if ($tor == '1' and strpos($risk, $isTor) !==false) {
            	if ($mailon =='1'){
            	$to = $emailaddress;
                $subject = 'TOR access attempt';
                $body = 'TOR access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
            	
				wp_redirect( $redirect);
				exit;
			}
            if ($vpn == '1' and strpos($risk, $isVpn) !==false) {
            	if ($mailon =='1'){
            	$to = $emailaddress;
                $subject = 'VPN access attempt';
                $body = 'VPN access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
            	
				wp_redirect( $redirect);
				exit;
			}
			if ($countryconfig !='' and strpos($countryconfig, $country) !==false and $botNameMatch ==false ) {
				if ($mailon =='1'){
				$to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'Blacklisted country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
				$sent = @wp_mail($to,$subject,$body,$headers);
				}
			 
				wp_redirect( $redirect);
				exit;
			}
			if ($countrywhite !='' and strpos($countrywhite, $country) ===false and $botNameMatch !=true) {
				if ($mailon =='1'){
				$to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'Blacklisted country access attempt from ip= ' .$ipa.' city= ' .$cityname.' country= ' .$countryname.' code= ' .$country.' detected and blocked by the ThreatPoint Security Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
                }
				
				
				wp_redirect( $redirect);
				exit;
			}
		}
		
	
  }	
 }
}
