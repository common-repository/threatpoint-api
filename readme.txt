=== ThreatPoint IP Reputation ===
Contributors: threatpointuk
Donate link: https://threatpoint.co.uk/donate/
Tags: wp-admin,xmlrpc,ip,reputation,tor,vpn,proxy,malicious,requests,protection,risk,score,fraud,identity 
Requires at least: 3.5.2
Tested up to: 6.5.2
Requires PHP: 5.4
Stable tag: 2.7

== Description == 
This plugin protects WordPress Sites from unwanted malicious access attempts by leveraging IP reputation data provided by the ThreatPoint IP reputation service. 

== External Service == 
This plugin allows administrators to protect their WordPress Sites from unwanted access attempts by leveraging IP reputation data provided by the ThreatPoint IP reputation service. This plugin invokes a restAPI call to the ThreatPoint API, consumes the response and acts based on configuration options in the plugin. This allows ip reputation data to be placed in front of pages (wp-admin and custom pages for example) - without interrupting normal access.
To communicate with the restAPI an API KEY is required from ThreatPoint.

The plugin calls the rest API (requires an API KEY) at [this ThreatPoint api endpoint](https://verify.threatpoint.co.uk/api/v1/resources/)
The rest API is only passed the IP address from the client or X-Forwarded-For address(es) is present.
This external service is called during any login attempts to the admin page. The plugin allows any page to be protected by simply entering the slug name on the setting page in the correct field (comma separated). Any custom page can be protected in this manner.
An API key is required to utilise the service, although the plugin will operate without one it will not be able to pass the IP or call any data from the API. Your pages are NOT protected without a valid API key.

== Privacy Policy ==
The privacy policy for the api services is viewable here [privacy policy](https://threatpoint.co.uk/privacy-policy)
This plugin only passes IP information - no other PII is transferred. The IP address is analysed across the aggregated data within the ThreatPoint IP reputation service and a risk score with geo location information is returned to the plugin. Simple rules within the plugin dictate whether traffic should be allowed to continue as normal or be redirected to an information URL of your choice (set by through the plugin settings). The IP address is stored in the IP aggregated data and used as part of the consortium. No other data such as originating website is stored. Only the IP address and geo location information is held, with date, time and risk scores associated with the request.
 
== Plugin Features ==
* Detects activity and IP reputation from the following sources:
* Tor exit node traffic
* Proxy (paid)
* Proxy (free)
* VPN (paid)
* VPN (free)
* Known Malicious Behaviour (Consortium)
* Brute force detection
* API Documentation is available here: [documentation](https://threatpoint.co.uk/documentation)
* Video is here [youtube https://youtu.be/Mub-Oa24b10]
 
== Special Features ==
* Provide risk based decisions through configuration to allow an administrator the correct flow for their site.
* Consortium model of malicious IP's created from activity seen across the ThreatPoint network
* Detect and block bots, malware, trojans and aggregators as well as malicious human traffic

== Configuration Items ==
* API Key - An API key is required to access the IP reputation service as explained above - (info@threatpoint.co.uk)
* Country Blacklist - 2 Character ISO country code csv format. Country codes in this list will cause IP addresses from those countries to issue a redirection. Allows you to block access from countries
* Country Whitelist - 2 Character ISO country code csv format. Country codes in this list will cause only IP addressed from these countries to be allowed. All others will be redirected. Allow all from UK for example.
* Country Blacklist is evaluated first - it makes little sense to have both blacklists and whitelists set although it is a supported option due to demand.
* Redirection URL - The web page you wish traffic to be redirected to - please feel free to use [Redirection URL](https://threatpoint.co.uk/threatpoint-ip-failure)
* Reject IP Risk >= - Redirect IP risk scores marked as Consider or High. Allow low risk only if consider is selected. The risk score is created by the IP reputation service based on the source, location, previous use and history across the IP consortium (velocity, reputation, tor, vpn, proxy)
* Pages to protect - a comma separated list of custom pages that you want to use the IP reputation service
* Disable XMLRPC endpoint by adding entry to .htaccess
* Add malicious IP's directly to .htaccess to protect wp-login from brute force
 
== Localization ==
* English (default) - only language currently supported
 
== Feedback ==
* Many thanks for taking the time to look at the plugin
* Drop the ThreatPoint team a line [@threatuk](http://twitter.com/#!/threatuk) on Twitter
* Email questions or suggestions via (info@threatpoint.co.uk)
* Api key requests via info@threatpoint.co.uk
 
== Installation ==
 
1. Download plugin from WordPress! or manually upload the entire 'ThreatPoint-api' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The ThreatPoint-Api settings menu will appear
4. Fill in the API Key, Country Blacklist and/or Country Whitelist, Redirect URL and Risk level, Tor Exit Node check, Anonymous VPN check and pages to protect (Admin login is enabled by default).
5. Save the settings
6. Save the page
 
== Frequently Asked Questions ==
 
= Does this plugin work with newest WP versions and also older versions? =
Yes, this plugin works with 3.5.2 and above.
We tested on versions 3.5.2, 4.9.5 up to 5.5. As the plugin is simply a way of calling the api and consuming the response the plugin should function in most versions, although we tested mainly on the two versions listed.
 
= We have new feature suggestions for the configuration page, how do we contact you? =
Please send the ThreatPoint team an email at [info@threatpoint.co.uk]. We know that the risk decision process can vary - we are interested to hear feedback.
 
= Can I access the API documentation? =
Yes, please use the following link to the ThreatPoint API documentation: [documentation](https://threatpoint.co.uk/documentation)
 
== Screenshots ==
1. Configuration settings screen 4.9.5
2. Configuration settings screen 3.5.2
3. Malicious activity detected - redirect request 
 
== Changelog ==
= 2.7 =
Changed the process for calculating geo variables
= 2.6 =
Added support to allow bots past country blacklist rules
= 2.5 = 
* tested on 5.8
= 2.4 =
* Added support to show top 10 blocked IP addresses with geo information on the options page
= 2.3 =
* Updated logo
= 2.2 =
* Amended .htaccess rules
= 2.1 =
* New malicious IP configuration - real time checks against the ThreatPoint network, autopopulate .htaccess
* Brute force login support - GET/POST
* Updated XMLRC configuration to disable via .htaccess
= 2.0 =
* Fixed email settings
* Included IP address in email body
= 1.9 = 
* Amendment to layout - remove duplicate whitelist entry
= 1.8 =
* Added notification feature using wp_mail
* Added descriptors to each field
* Added Daiy IP reputation map
= 1.7 =
* Added feature to disable XMLRPC endpoint
* Cleaned up typo
= 1.6 =
* update to add action to set priority, where header is set before redirect
= 1.5 =
* included login to allow page name entry
* admin page now protected by default without needing to modify any page code
= 1.4 =
* Updated logic and options to include greater control over selection tree
= 1.3 =
* Amended issue in strpos when array is used
= 1.2 =
* Added check for empty values to avoid empty needle warning
= 1.1 =
* Added country whitelist configuration option
* Updated versions tested
* provided redirection link 
= 1.0 =
* Initial release
 
== Upgrade Notice ==
= 2.6 =
Allow bots that could have been blocked by country blacklists
= 2.4 =
IP History Table
= 2.3 = 
No code change
= 2.2 =
Amended .htaccess rules
= 2.1 =
Malicious IP configuration to stop brute force from bots, trojans, malware and aggregators
= 2.0 =
Update email settings and body
= 1.9 =
Typo fix on layout page
= 1.8 =
Update to include email notification support and IP rep chart
= 1.7 =
Update to include disabling of XMLRPC endpoint
= 1.6 =
Update to support themes that override wp_redirect actions on custom pages
= 1.5 =
Easily protect individual pages using the new page field - contact forms, email forms etc.
= 1.4 =
Greater granularity over branch login and checks
= 1.3 =
Code fix for arrays and local ip addresses with strpos
= 1.2 =
Minor code sanity check -strpos null value
= 1.1 =
Amended release to include additional configuration option
 
= 1.0 =
First release
 
== Translations ==
 
* English - default, currently the only language supported
 
== Contributors & Developers ==
* The ThreatPoint team are often asked to investigate attacks on web sites and other services. More often than not these attacks begin from IP addresses that should be considered before access is granted. The IP reputation API provides the intelligence to protect such services, simply and effective. The WordPress plugin framework allows this to be easily introduced into WordPress sites as an additional layer of protection.
* This is not a silver bullet, but it is a useful deterrent. Best efforts to redirect IP addresses based on IP reputation are made. The service should be used in conjunction with other layers of detection and with defined authentication and access rules as part of an overall security policy.
* ThreatPoint UK also provide email verification, device reputation, dark web monitoring and password monitoring services as part of the API service layer. Please contact info@threatpoint.co.uk to find out more about these additional services.
 
== Credits ==
* Many credits go to the fraud and analytics team at ThreatPoint UK and the team behind the API services
* Credits to numerous wordpress tutorials used to understand the plugin creation process. notably this article https://www.sitepoint.com/real-world-example-wordpress-plugin-development/
