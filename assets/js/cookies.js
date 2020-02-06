/**
 * Script for cookies box that check if is ip is europe, via the api free service.
 * Starts after window load
 * CSS included
 */

//show cookie message
function cookieConsent(code) {

    //european union countries
    var countries = ['AD', 'AL', 'AT', 'AX', 'BA' ,'BE', 'BG', 'CH', 'CZ', 'HR', 'CY', 'CZ', 'DK', 'EE', 'ES', 'EU', 'FI', 'FO', 'FR', 'DE', 'GB', 'GG', 'GI', 'GR', 'HU', 'IE', 'IM', 'IS', 'IT', 'LI', 'LT', 'LU', 'LV', 'MC', 'MD', 'ME', 'MK', 'MT', 'NL', 'NO', 'PL', 'PT', 'RO', 'RS', 'SK', 'SI', 'SE', 'UK'];

    //if country is europe
    if (countries.indexOf(code) >= 0) {

        document.write('<div id="cookies">Google uses cookies to personalize ads on our web pages. <br><br><button id="accept">ACCEPT</button> <button id="decline">DECLINE</button> <a id="details" href="https://policies.google.com/technologies/cookies" target="_blank">Details</a> <a id="close">&times;</a></div>');

        //box styles
        document.getElementById('cookies').style.position = 'fixed';
        document.getElementById('cookies').style.zIndex = '99';
        document.getElementById('cookies').style.bottom = '18px';
        document.getElementById('cookies').style.right = '18px';
        document.getElementById('cookies').style.width = '365px';
        document.getElementById('cookies').style.background = 'rgba(0, 0, 0, 0.6)';
        document.getElementById('cookies').style.padding = '24px';
        document.getElementById('cookies').style.boxSizing = 'border-box';
        document.getElementById('cookies').style.color = 'white';
        document.getElementById('cookies').style.fontSize = '12pt';
        document.getElementById('cookies').style.fontFamily = 'sans-serif';
        document.getElementById('cookies').style.border = '1px solid white';

        //button styles
        document.getElementById('accept').style.color = 'rgba(0, 0, 0, 0.8)';
        document.getElementById('accept').style.padding = '9px';
        document.getElementById('accept').style.marginRight = '6%';
        document.getElementById('accept').style.fontSize = '10pt';
        document.getElementById('accept').style.fontWeight = '700';
        document.getElementById('accept').style.background = 'whitesmoke';
        document.getElementById('accept').style.border = '0';
        document.getElementById('accept').style.cursor = 'pointer';

        //button styles
        document.getElementById('decline').style.color = 'rgba(0, 0, 0, 0.8)';
        document.getElementById('decline').style.padding = '9px';
        document.getElementById('decline').style.fontSize = '10pt';
        document.getElementById('decline').style.fontWeight = '700';
        document.getElementById('decline').style.background = 'whitesmoke';
        document.getElementById('decline').style.border = '0';
        document.getElementById('decline').style.cursor = 'pointer';

        //button styles
        document.getElementById('details').style.color = 'lightblue';
        document.getElementById('details').style.float = 'right';

        //close styles
        document.getElementById('close').style.color = 'white';
        document.getElementById('close').style.padding = '5px';
        document.getElementById('close').style.width = '18px';
        document.getElementById('close').style.textAlign = 'center';
        document.getElementById('close').style.fontWeight = '700';
        document.getElementById('close').style.background = 'orangered';
        document.getElementById('close').style.position = 'absolute';
        document.getElementById('close').style.top = '0';
        document.getElementById('close').style.right = '0';
        document.getElementById('close').style.cursor = 'pointer';

        //responsive styles
        if(window.screen.width < 700) {

            document.getElementById('cookies').style.width = '100%';
            document.getElementById('cookies').style.bottom = '0';
            document.getElementById('cookies').style.right = '0';
            document.getElementById('cookies').style.border = '0';
            document.getElementById('cookies').style.padding = '12px';
            document.getElementById('cookies').style.borderTop = '2px solid white';
            document.getElementById('accept').style.fontSize = '12pt';
            document.getElementById('decline').style.fontSize = '12pt';
            document.getElementById('accept').style.marginRight = '8px';
        }

        //ON PRESS ACCEPT COOKIES
        document.getElementById("accept").addEventListener("click", function(){

            document.getElementById('cookies').style.display = 'none';
            acceptCookies();
        });

        //ON PRESS DECLINE COOKIES
        document.getElementById("decline").addEventListener("click", function(){

            document.getElementById('cookies').style.display = 'none';
            deleteAllCookies();
            denyCookies();
        });

        //ON PRESS CLOSE
        document.getElementById("close").addEventListener("click", function(){

            document.getElementById('cookies').style.display = 'none';
        })

    }

    //if country not be europe
    else {

        //put the cookies accept, prevents useless loading
        acceptCookies();
    }
}

function acceptCookies() {

    Set_Cookie('cookieConsent', true, '90', '/', window.location.hostname, '');
}

function denyCookies() {

    Set_Cookie('denyConsent', true, '90', '/', window.location.hostname, '');
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

function Set_Cookie(name, value, expires, path, domain, secure) {

    //set time, it's in milliseconds
    var today = new Date();
    today.setTime(today.getTime());

    //setup value variable to be in days
    if (expires)	{
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date(today.getTime() + (expires));

    document.cookie = name + "=" +escape(value) +
        ((expires) ? ";expires=" + expires_date.toGMTString() : "") +
        ((path) ? ";path=" + path : "") +
        ((domain) ? ";domain=" + domain : "") +
        ((secure) ? ";secure" : "");
}

function Get_Cookie(check_name) {

    //first we'll split this cookie up into name/value pairs
    var a_all_cookies = document.cookie.split(';');
    var a_temp_cookie = '';
    var cookie_name = '';
    var cookie_value = '';
    var b_cookie_found = false; //set boolean t/f default f

    for (i = 0; i < a_all_cookies.length; i++) {

        //now we'll split apart each name=value pair
        a_temp_cookie = a_all_cookies[i].split('=');

        //and trim left/right whitespace while we're at it
        cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

        //if the extracted name matches passed check_name
        if (cookie_name == check_name) {
            b_cookie_found = true;

            //we need to handle case where cookie has no value but exists
            if (a_temp_cookie.length > 1)	{
                cookie_value = unescape(a_temp_cookie[1].replace(/^\s+|\s+$/g, ''));
            }

            //note that in cases where cookie is initialized but no value
            return cookie_value;
            break;
        }
        a_temp_cookie = null;
        cookie_name = '';
    }
    if (!b_cookie_found) {
        return null;
    }
}

//this deletes the cookie when called
function Delete_Cookie(name, path, domain) {

    if (Get_Cookie(name)) document.cookie = name + "=" +
        ((path) ? ";path=" + path : "") +
        ((domain) ? ";domain=" + domain : "") +
        ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

//setup the data from the api
function cookies(data) {

    var code = data.country.code;
    cookieConsent(code);
}

//start cookies
if (!Get_Cookie('denyConsent') == false) {

    //stuff to do when decline is on user prefs
    //..or just do none..
}
else if (!Get_Cookie('cookieConsent') == true) {

    document.write('<script type="text/javascript" src="https://geographic.org/cookies.php"><\/script>');
    cookies();
}
