<?php

use Carbon\Carbon;
use App\Lib\SendSms;
use App\Models\Frontend;
use App\Models\Advertise;
use App\Models\Extension;
use App\Models\SmsTemplate;
use App\Models\EmailTemplate;
use PHPMailer\PHPMailer\SMTP;
use App\Models\GeneralSetting;
use App\Lib\GoogleAuthenticator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


function sidebarVariation()
{

    /// for sidebar
    $variation['sidebar'] = 'bg_img';

    //for selector
    $variation['selector'] = 'capsule--rounded';

    //for overlay
    $variation['overlay'] = 'overlay--indigo';

    //Opacity
    $variation['opacity'] = 'overlay--opacity-8'; // 1-10

    return $variation;
}

function systemDetails()
{
    $system['name'] = 'Ceeyit';
    $system['version'] = '1.0';
    return $system;
}

function getLatestVersion()
{
    $param['purchasecode'] = env("PURCHASECODE");
    $param['website'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'] . ' - ' . env("APP_URL");
    $url = 'https://license.viserlab.com/updates/version/' . systemDetails()['name'];
    // $result = curlPostContent($url, $param);
    // if ($result) {
    //     return $result;
    // } else {
    return null;
    // }
}


function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}


function shortDescription($string, $length = 120)
{
    return Illuminate\Support\Str::limit($string, $length);
}


function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



//moveable
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location, $filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}


function activeTemplate($asset = false)
{
    $general = GeneralSetting::first(['active_template']);
    $template = $general->active_template;
    $sess = session()->get('template');
    if (trim($sess)) {
        $template = $sess;
    }
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
    $general = GeneralSetting::first(['active_template']);
    $template = $general->active_template;
    $sess = session()->get('template');
    if (trim($sess)) {
        $template = $sess;
    }
    return $template;
}


function loadReCaptcha()
{
    $reCaptcha = Extension::where('act', 'google-recaptcha2')->where('status', 1)->first();
    return $reCaptcha ? $reCaptcha->generateScript() : '';
}


function loadAnalytics()
{
    $analytics = Extension::where('act', 'google-analytics')->where('status', 1)->first();
    return $analytics ? $analytics->generateScript() : '';
}

function loadTawkto()
{
    $tawkto = Extension::where('act', 'tawk-chat')->where('status', 1)->first();
    return $tawkto ? $tawkto->generateScript() : '';
}


function loadFbComment()
{
    $comment = Extension::where('act', 'fb-comment')->where('status', 1)->first();
    return  $comment ? $comment->generateScript() : '';
}

function loadCustomCaptcha($height = 46, $width = '300px', $bgcolor = '#003', $textcolor = '#abc')
{
    $textcolor = '#' . GeneralSetting::first()->base_color;
    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
    if (!$captcha) {
        return 0;
    }
    $code = rand(100000, 999999);
    $char = str_split($code);
    $ret = '<link href="https://fonts.googleapis.com/css?family=Henny+Penny&display=swap" rel="stylesheet">';
    $ret .= '<div style="height: ' . $height . 'px; line-height: ' . $height . 'px; width:' . $width . '; text-align: center; background-color: ' . $bgcolor . '; color: ' . $textcolor . '; font-size: ' . ($height - 20) . 'px; font-weight: bold; letter-spacing: 20px; font-family: \'Henny Penny\', cursive;  -webkit-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;  display: flex; justify-content: center;">';
    foreach ($char as $value) {
        $ret .= '<span style="    float:left;     -webkit-transform: rotate(' . rand(-60, 60) . 'deg);">' . $value . '</span>';
    }
    $ret .= '</div>';
    $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
    $ret .= '<input type="hidden" name="captcha_secret" value="' . $captchaSecret . '">';
    return $ret;
}


function captchaVerify($code, $secret)
{
    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
    $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
    if ($captchaSecret == $secret) {
        return true;
    }
    return false;
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getAmount($amount, $length = 0)
{
    if (0 < $length) {
        return round($amount + 0, $length);
    }
    return $amount + 0;
}

function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet)
{

    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$wallet&choe=UTF-8";
}

//moveable
function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//moveable
function curlPostContent($url, $arr = null)
{
    if ($arr) {
        $params = http_build_query($arr);
    } else {
        $params = '';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function inputTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function str_slug($title = null)
{
    return \Illuminate\Support\Str::slug($title);
}

function str_limit($title = null, $length = 10)
{
    return \Illuminate\Support\Str::limit($title, $length);
}

//moveable
function getIpInfo()
{
    $ip = $_SERVER["REMOTE_ADDR"];

    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);


    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}

//moveable
function osBrowser()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $osPlatform = "Unknown OS Platform";
    $osArray = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $osPlatform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browserArray = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $osPlatform;
    $data['browser'] = $browser;

    return $data;
}

function siteName()
{
    $general = GeneralSetting::first();
    $sitname = str_word_count($general->sitename);
    $sitnameArr = explode(' ', $general->sitename);
    if ($sitname > 1) {
        $title = "<span>$sitnameArr[0] </span> " . str_replace($sitnameArr[0], '', $general->sitename);
    } else {
        $title = "<span>$general->sitename</span>";
    }

    return $title;
}


//moveable
function getTemplates()
{

    return null;
}


function getPageSections($arr = false)
{

    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    return asset('assets/images/default.png');
}

function notify($user, $type, $shortCodes = null)
{
    sendEmail($user, $type, $shortCodes);
    sendSms($user, $type, $shortCodes);
}



function sendSms($user, $type, $shortCodes = [])
{
    $general = GeneralSetting::first(['sn', 'sms_api', 'sms_config']);
    $smsTemplate = SmsTemplate::where('act', $type)->where('sms_status', 1)->first();
    $gateway = $general->sms_config->name;
    $sendSms = new SendSms;
    if ($general->sn == 1 && $smsTemplate) {
        $template = $smsTemplate->sms_body;
        foreach ($shortCodes as $code => $value) {
            $template = shortCodeReplacer('{{' . $code . '}}', $value, $template);
        }
        $message = shortCodeReplacer("{{message}}", $template, $general->sms_api);
        $message = shortCodeReplacer("{{name}}", $user->username, $message);
        $sendSms->$gateway($user->mobile, $general->sitename, $message, $general->sms_config);
    }
}

function sendEmail($user, $type = null, $shortCodes = [])
{
    $general = GeneralSetting::first();


    $emailTemplate = EmailTemplate::where('act', $type)->where('email_status', 1)->first();

    if ($general->en != 1 || !$emailTemplate) {
        return;
    }


    $message = shortCodeReplacer("{{name}}", $user->username, $general->email_template);
    $message = shortCodeReplacer("{{message}}", $emailTemplate->email_body, $message);

    if (empty($message)) {
        $message = $emailTemplate->email_body;
    }

    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;



    if ($config->name == 'php') {
        sendPhpMail($user->email, $user->username, $emailTemplate->subj, $message);
    } else if ($config->name == 'smtp') {

        sendSmtpMail($config, $user->email, $user->username, $general->email_from,  $general->sitename, $emailTemplate->subj, $message);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $user->email, $user->username, $emailTemplate->subj, $message, $general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $user->email, $user->username, $emailTemplate->subj, $message, $general);
    }
}


function sendPhpMail($receiver_email, $receiver_name, $subject, $message)
{
    $general = GeneralSetting::first();
    $headers = "From: $general->sitename <$general->email_from> \r\n";
    $headers .= "Reply-To: $general->sitename <$general->email_from> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email, $subject, $message, $headers);
}


function sendSmtpMail($config, $receiver_email, $receiver_name, $email_from, $sitename, $subject, $message)
{
    $mail = new PHPMailer(true);

    $generala = GeneralSetting::first();


    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = $config->host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $config->username;
        $mail->Password   = $config->password;
        if ($config->enc == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port       = $config->port;
        $mail->CharSet = 'UTF-8';
        //Recipients

        $mail->setFrom($generala->email_from, $sitename);
        $mail->addAddress($receiver_email, $receiver_name);
        $mail->addReplyTo($generala->email_from, $sitename);
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendSendGridMail($config, $receiver_email, $receiver_name, $subject, $message, $general)
{
    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom($general->email_from, $general->sitetitle);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email, $receiver_name);
    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        // echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}


function sendMailjetMail($config, $receiver_email, $receiver_name, $subject, $message, $general)
{
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $general->email_from,
                    'Name' => $general->sitetitle,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


function getPaginate($paginate = 20)
{
    return $paginate;
}

function paginateLinks($data, $design = 'admin.partials.paginate')
{
    return $data->appends(request()->all())->links($design);
}


function menuActive($routeName, $type = null)
{
    if ($type == 3) {
        $class = 'side-menu--open';
    } elseif ($type == 2) {
        $class = 'sidebar-submenu__open';
    } else {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


function imagePath()
{
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw' => [
            'path' => 'assets/images/verify/withdraw'
        ],
        'deposit' => [
            'path' => 'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
        'size' => '36x36',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['course'] = [
        'path' => 'assets/course/thumbnail/',
        'thumb_size' => '360x270',
        'preview_size' => '1280x850',
        'preview_video_path' => 'assets/course/preview_video/'
    ];
    $data['lecture'] = [
        'path' => 'assets/course/lecture/',
        'file_path' => 'assets/course/file/'
    ];
    $data['profile'] = [
        'user' => [
            'path' => 'assets/images/user/profile',
            'size' => '350x300'
        ],
        'admin' => [
            'path' => 'assets/admin/images/profile',
            'size' => '400x400'
        ]
    ];
    return $data;
}


function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        }
    }
    return $printAmount;
}


function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

//moveable
function sendGeneralEmail($email, $subject, $message, $receiver_name = '')
{

    $general = GeneralSetting::first();


    if ($general->en != 1 || !$general->email_from) {
        return;
    }


    $message = shortCodeReplacer("{{message}}", $message, $general->email_template);
    $message = shortCodeReplacer("{{name}}", $receiver_name, $message);

    $config = $general->mail_config;

    info(json_encode($config));

    if ($config->name == 'php') {
        sendPhpMail($email, $receiver_name, $general->email_from, $subject, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $email, $receiver_name, $general->email_from, $general->sitename, $subject, $message);
    }
}

function getContent($data_keys, $singleQuery = false, $limit = null, $orderById = false)
{
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $data_keys)->orderBy('id', 'desc')->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $data_keys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $data_keys)->orderBy('id', 'desc')->get();
        }
    }
    return $content;
}


function gatewayRedirectUrl($type = false)
{

    if (session('payment')) {
        session()->forget('payment');
        return 'user.home';
    } elseif ($type) {
        return 'user.deposit.history';
    } else {
        return 'user.deposit';
    }
}

function verifyG2fa($user, $code, $secret = null)
{
    $ga = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    $oneCode = $ga->getCode($secret);
    $userCode = $code;
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}

function ratings($number)
{
    $html = '';
    $review = floor($number);
    $extra = abs($number - $review);
    $extraDone = 0;
    for ($i = 1; $i <= 5; $i++) {
        if ($review < $i) {
            if ($extra > 0 && $extraDone == 0) {
                $html .= '<i class="las la-star-half-alt fill"></i>';
                $extraDone = 1;
            } else {
                $html .= '<i class="lar la-star"></i>';
            }
        } else {
            $html .= '<i class="las la-star fill"></i>';
        }
    }
    return $html;
}


function uploadLecture($file, $old = null)
{
    $gnl = GeneralSetting::first();
    $directory = date("Y") . "/" . date("m") . "/" . date("d");
    $location = 'assets/course/lecture/' . $directory;
    ftpConfig($gnl);
    $driver = Storage::disk('custom-ftp');
    if (!empty($old)) {
        if (!removeFile('assets/course/lecture/' . $old)) {
            removeFtpFile($old, $driver);
        }
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    if ($gnl->select_storage == 1) {
        makeDirectory($location);
        $file->move($location, $filename);
    } else {
        makeDirectoryFtp($location, $driver);
        $driver->put($location . '/' . $filename,  fopen($file, 'r+'));
    }
    return  $directory . '/' . $filename;
}

function makeDirectoryFtp($location, $driver)
{
    if ($driver->exists($location)) {
        return true;
    }
    $driver->makeDirectory($location);
}


function removeFtpFile($file, $driver)
{
    $path = 'assets/contributor/files/' . $file;
    if ($driver->exists($path)) {
        $driver->delete($path);
    }
}

function ftpConfig($gnl)
{
    Config::set('filesystems.disks.custom-ftp.driver', 'ftp');
    Config::set('filesystems.disks.custom-ftp.host', @$gnl->ftp->host);
    Config::set('filesystems.disks.custom-ftp.username', @$gnl->ftp->username);
    Config::set('filesystems.disks.custom-ftp.password', @$gnl->ftp->password);
    Config::set('filesystems.disks.custom-ftp.port', @$gnl->ftp->port);
    Config::set('filesystems.disks.custom-ftp.root', @$gnl->ftp->root_path);
}


function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}

function number_format_short($n, $precision = 1)
{
    if ($n < 900) {
        // 0 - 900
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        // 0.9k-850k
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        // 0.9m-850m
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    // Remove unecessary zeroes after decimal.

    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return $n_format . $suffix;
}

function queryBuild($key, $value)
{
    $queries = request()->query();
    if (count($queries) > 0) {
        $delimeter = '&';
    } else {
        $delimeter = '?';
    }
    if (request()->has($key)) {
        $url = request()->getRequestUri();
        $pattern = "\?$key";
        $match = preg_match("/$pattern/", $url);
        if ($match != 0) {
            return  preg_replace('~(\?|&)' . $key . '[^&]*~', "\?$key=$value", $url);
        }
        $filteredURL = preg_replace('~(\?|&)' . $key . '[^&]*~', '', $url);
        return  $filteredURL . $delimeter . "$key=$value";
    }

    return  request()->getRequestUri() . $delimeter . "$key=$value";
}

function advertisements($size)
{
    $ad = Advertise::where('resolution', $size)->where('status', 1)->inRandomOrder()->first();
    if (!empty($ad)) {
        if ($ad->type == 1) {
            return  '<a class="advert d-block" data-advertid="' . $ad->id . '"  target="_blank" href="' . $ad->redirect_url . '"><img src="' . getImage('assets/images/advertisement/' . $ad->ad_image) . '" alt="image" class="w-100"></a>';
        }
        if ($ad->type == 2) {
            return '<div class="advert" data-advertid="' . $ad->id . '">"' . $ad->script . '"</div>';
        }
    } else {
        return '';
    }
}
