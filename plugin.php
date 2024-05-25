<?php

class pluginAllinoneaccessibility extends Plugin {

	
	public function form() {
		global $L;

        $domain = $_SERVER['HTTP_HOST'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ada.skynettechnologies.us/check-website',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('domain' =>  $domain),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $settingURLObject = json_decode($response);
        echo '<script type="text/javascript">
document.addEventListener("DOMContentLoaded", (event) => {
    var buttons = document.getElementsByClassName("float-right");
    for (var i = 0; i < buttons.length; i++) {
        var button = buttons[i];
        button.style.display = "none";
    }
});</script>';

?>

<hr>
<style>
    .get-strated-btn, .get-strated-btn:hover {
        background-color: #2855d3;
        color: white;
        padding: 5px 5px;
        text-decoration: none;
    }

    .aioa-cancel-button {
        text-decoration: none;
        display: inline-block;
        vertical-align: middle;
        border: 2px solid #dd2755;
        border-radius: 4px 4px 4px 4px;
        background-color: #ea2362;
        box-shadow: 0px 0px 2px 0px #333333;
        color: #ffffff;
        text-align: center;
        box-sizing: border-box;
        padding: 10px;
    }
    .aioa-cancel-button:hover {
        border-color: #e21f4a;
        background-color: white;
        box-shadow: 0px 0px 2px 0px #333333;
    }

    .aioa-cancel-button:hover .mb-text {
        color: #e82757;
    }

</style>
<table class="form-table" style="max-width: 1440px;">
    <tr valign="top">
        <th colspan="2">
            All in One Accessibility widget improves website ADA compliance and browser experience for ADA, WCAG 2.1
            & 2.2, Section 508, California Unruh Act, Australian DDA, European EAA EN 301 549, UK Equality Act (EA),
            Israeli Standard 5568, Ontario AODA, Canada ACA, German BITV, France RGAA, Brazilian Inclusion Law (LBI
            13.146/2015), Spain UNE 139803:2012, JIS X 8341 (Japan), Italian Stanca Act and Switzerland DDA
            Standards without changing your website's existing code.

        </th>
    </tr>

    <tr valign="top">
        <th colspan="2" >
            <?php
            try{

                if(isset($settingURLObject->status) && $settingURLObject->status == 3)
                { ?>
                    <h3 style="color: #aa1111">It appears that you have already registered! Please click on the "Manage Subscription" button to renew your subscription.<br> Once your plan is renewed, please refresh the page.</h3>
                    <div style="text-align: left; width:100%; padding-bottom: 10px;"><a target="_blank" class="aioa-cancel-button"  href="<?php echo $settingURLObject->settinglink;?>">Manage Subscription</a></div>
                <?php }
                else if(isset($settingURLObject->status) && $settingURLObject->status > 0 && $settingURLObject->status < 3)
                {
                    ?>
                    <h2>Widget Preferences:</h2>
                    <div style="text-align: right; width:100%; padding-bottom: 10px;"><a target="_blank" class="aioa-cancel-button"  href="<?php echo $settingURLObject->manage_domain;?>">Manage Subscription</a></div>
                    <iframe id="aioamyIframe" width="100%" style="max-width: 1920px;" height="2900px"  src="<?php echo $settingURLObject->settinglink; ?>"></iframe>
                    <?php
                }
                else{
                    ?>
                    <iframe src="https://ada.skynettechnologies.us/trial-subscription?isframe=true&website=<?php echo $domain;?>&developer_mode=true" height="1100px;" width="80%" style="border: none;"></iframe>
                    <?php
                }
            } catch(Exception $e){}
        return $settingURLObject;
	}
	public function siteBodyBegin(){
		global $L;
	}
	public function siteBodyEnd(){
		$html = '<script src="'.HTML_PATH_PLUGINS.'bludit-allinoneaccessibility/js/allinoneaccessibility.js"></script>'.PHP_EOL;
		return $html;
	}
}
