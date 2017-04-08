<?php
require 'vendor/autoload.php';

$f3 = Base::instance();

$f3->config('Config/config.ini');

/** database **/
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection(require 'Config/eloquent.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();

$f3->set('db', $capsule->getConnection());

/** uploader **/
$f3->set('fileStorage', new \Upload\Storage\FileSystem('assets/images', $overwrite = true));
$f3->set('fileValidation', [
    new \Upload\Validation\Mimetype(['image/bmp', 'image/gif', 'image/jpg', 'image/jpeg', 'image/tiff', 'image/png']),
    new \Upload\Validation\Size('5M')
]);

/** mailer **/
$mail = new PHPMailer;
$mail->SMTPDebug = $f3->get('smtp.debug');
$mail->isSMTP();
$mail->SMTPAuth = $f3->get('smtp.auth');
$mail->Host = $f3->get('smtp.host');
$mail->Port = $f3->get('smtp.port');
$mail->Username = $f3->get('smtp.user');
$mail->Password = $f3->get('smtp.pass');
$mail->SMTPSecure = $f3->get('smtp.scheme');
$mail->setFrom($f3->get('smtp.from_mail'), $f3->get('smtp.from_name'));
$mail->isHTML(true);

$f3->set('mailer', $mail);

/** captcha **/
$f3->set('captcha', new \ReCaptcha\ReCaptcha($f3->get('recaptcha.secret')));

/** password **/
$f3->set('phpass', new \Hautelook\Phpass\PasswordHash($f3->get('phpass.rounds'), $f3->get('phpass.portable')));

/** thumbnail **/
$thumb = new \Simplify\Thumb();
$thumb->setBaseDir(dirname(__file__).'/assets/images/')->setCachePath('cache/');

$f3->set('thumbs', $thumb);

/*$res = $thumb->load('image_1_1.jpg')
->resize(150, 150)
->cache()
->save();
  
dd($thumb, $res);
*/

/** gateways **/
$f3->set('gateway.billplz', new \Libraries\Gateways\Billplz(
    $f3->get('billplz.apikey'),
    $f3->get('billplz.collection'),
    $f3->get('billplz.sandbox')
));

$f3->set('gateway.paypal', \Omnipay\Omnipay::create('PayPal_Express'));

$f3->set('ONERROR', function($f3){
    die(\Template::instance()->render('error/general.php'));
});

$f3->run();