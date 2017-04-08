<?php
namespace Controllers;

class Account extends Controller
{
    protected $per_page = 10;
    protected $user;
    protected $test;

    public function beforeRoute()
    {

        if(\Helpers\Check::is_admin()){
            die(header('Location: '.$this->base->get('BASE').'/admin/'));
        } elseif(\Helpers\Check::is_customer()){
            $this->user = \Models\Customer::find($_SESSION['customer_id']);
            $this->base->set('user', $this->user);
        }

    }

    public function afterRoute()
    {
        parent::afterRoute();
        echo \Template::instance()->render('frontend.php');
    }

    public function register()
    {
        \Helpers\Check::cannot_customer_login();

        if(isset($_POST['register'])){

            $rules = [
                'email' => 'required|max_len,50|valid_email',
                'password' => 'required|min_len,7',
                'confirmpassword' => 'required|min_len,7',
                'fname' => 'required|max_len,50|alpha_space',
                'lname' => 'required|max_len,50|alpha_space',
                'line_1' => 'required|max_len,50',
                'line_2' => 'required|max_len,50',
                'city' => 'required|max_len,50|alpha_space',
                'zipcode' => 'required|max_len,50',
                'state' => 'required|max_len,50|alpha_space'
            ];

            $gump = new \GUMP;
            $gump->validation_rules($rules);

            if($gump->run($_POST)){

                $phpass = $this->base->get('phpass');
                $recaptcha = $this->base->get('captcha');

                $captcha = $_POST['g-recaptcha-response'];
                $pass = $_POST['password'];
                $cpass = $_POST['confirmpassword'];

                if($recaptcha->verify($captcha)->isSuccess()){

                    if($pass == $cpass){

                        $passhash = $phpass->HashPassword($pass);
                        $_POST['password'] = $passhash;

                        try {

                            \Models\Customer::create($_POST);
                            $this->base->set('message', 'Your account has been created.');

                        } catch(\Exception $e){

                            $this->base->push('error', 'Email is in use');

                        }

                    } else {
                        $this->base->set('error', 'Passwords don\'t match');
                    }

                } else {

                    $this->base->set('error', 'Captcha Error');

                }

            } else {

                $this->base->set('error', $gump->get_readable_errors());

            }

        }

        $this->base->mset([
            'title' => 'User Registration',
            'content' => 'account/register.php'
        ]);
    }

    public function login()
    {
        \Helpers\Check::cannot_customer_login();

        if(isset($_POST['login'])){

            $email = $_POST['email'];
            $password = $_POST['password'];

            $find = \Models\Customer::where('email', '=', $email); //->firstOrFail();
            $count = $find->count();

            if($count > 0){

                $user = $find->first();
                $passHash = $user->password;

                if($this->base->get('phpass')->CheckPassword($password, $passHash)){
                    $_SESSION['customer_id'] = $user->id;
                    die(\Helpers\Check::cannot_customer_login());
                } else {
                    $this->base->set('error', 'Invalid email or password');
                }

            } else {
                $this->base->set('error', 'Invalid email or password');
            }

        }

        $this->base->mset([
            'title' => 'User Login',
            'content' => 'account/login.php'
        ]);

    }

    public function forgot()
    {

        \Helpers\Check::cannot_customer_login();

        if(isset($_POST['recover_account'])){

            $email = $_POST['email'];

            $user = \Models\Customer::where('email', $email);

            // user exists
            if($user->count() > 0){

                $user = $user->first();
                $mailer = $this->base->get('mailer');
                $reset_key = \Helpers\General::generate_random(30);

                $this->base->get('db')->transaction(function($db) use($user, $mailer, $reset_key){

                    /* insert reset key */
                    $user->resetkey = $reset_key;
                    $user->save();

                    /* mail reset key */
                    $this->base->set('fname', $user->fname);
                    $this->base->set('lname', $user->lname);
                    $this->base->set('email', $user->email);
                    $this->base->set('reset_key', $reset_key);

                    $mailer->addAddress($user->email, implode(' ', [$user->fname, $user->lname]));
                    $mailer->Subject = $this->base->get('SITENAME').' Password Reset';
                    $mailer->Body = \Template::instance()->render('emails/forgot.php');

                    if($mailer->send()){

                        $this->base->set('message', 'An email has been sent to your address');

                    } else {

                        $this->base->set('error', 'Failed to mail reset key. Please contact support.');

                    }

                });

            } else {

                $this->base->set('error', 'Email doesn\'t exist');

            }
        }

        $this->base->mset([
            'title' => 'Forgot Password',
            'content' => 'account/forgot.php'
        ]);

    }

    public function reset()
    {

        if(isset($_GET['email'], $_GET['reset_key'])){

            $email = $_GET['email'];
            $reset_key = $_GET['reset_key'];

            $user = \Models\Customer::where('email', $email)->where('resetkey', $reset_key)->first();

            if(!$user){

                $this->base->mset([
                    'title' => 'Forgot Password',
                    'content' => 'account/forgot.php',
                    'error' => 'Invalid email or reset key'
                ]);

                return;

            }

            if(isset($_POST['reset'])){

                $npass = $_POST['npass'];
                $cnpass = $_POST['cnpass'];

                $gump = new \GUMP;
                $gump->validation_rules([
                    'npass' => 'required|min_len,7',
                    'cnpass' => 'required|min_len,7'
                ]);
                $valid = $gump->run($_POST);

                /* not empty, >7 */
                if($valid){

                    /* passwords match */
                    if($npass == $cnpass){

                        $hasher = $this->base->get('phpass');
                        $npass_hash = $hasher->HashPassword($npass);

                        $user->resetkey = null;
                        $user->password = $npass_hash;
                        $user->save();

                        $this->base->set('message', 'Password updated');

                    } else {

                        $this->base->set('error', 'New passwords don\'t match');

                    }

                } else {

                    $this->base->set('error', $gump->get_readable_errors());

                }

            }

            $this->base->mset([
                'title' => 'Reset Password',
                'content' => 'account/reset.php'
            ]);

        } else {

            die(header('Location: '.$this->base->get('BASE').'/account/forgot'));

        }

    }
    public function index()
    {
        \Helpers\Check::can_customer_login();

        if(isset($_POST['edit'])){

            $user = $this->user;
            $gump = new \GUMP;
            $rules = [
                'email' => 'required|valid_email|max_len,50',
                'fname' => 'required',
                'lname' => 'required',
                'line_1' => 'required',
                'line_2' => 'required',
                'city' => 'required',
                'zipcode' => 'required',
                'state' => 'required'
            ];

            if(!empty($_POST['cpass'])){
                $rules['cpass'] = 'required';
                $rules['npass'] = 'required|min_len,7';
                $rules['cnpass'] = 'required|min_len,7';
                $gump->set_field_name('cpass', 'current password');
                $gump->set_field_name('npass', 'new password');
                $gump->set_field_name('cnpass', 'confirm new password');
            }

            $gump->set_field_name('fname', 'First Name');
            $gump->set_field_name('lname', 'Last Name');
            $gump->validation_rules($rules);
            $run = $gump->run($_POST);

            if($run != false){

                $user->email = $run['email'];
                $user->fname = $run['fname'];
                $user->lname = $run['lname'];
                $user->line_1 = $run['line_1'];
                $user->line_2 = $run['line_2'];
                $user->city = $run['city'];
                $user->zipcode = $run['zipcode'];
                $user->state = $run['state'];
                $user->save();

            } else {

                $this->base->set('error', $gump->get_readable_errors());

            }


            // user nak tukar password
            if(!empty($_POST['cpass'])){

                $cpass = $_POST['cpass'];
                $npass = $_POST['npass'];
                $cnpass = $_POST['cnpass'];

                // current password betul
                if($this->base->get('phpass')->CheckPassword($cpass, $this->user->password)){

                    // password baru sama
                    if($npass == $cnpass){

                        //if(strlen($npass) >= '7'){
                            $npasshash = $this->base->get('phpass')->HashPassword($npass);
                            $user->password = $npasshash;
                            $user->save();
                       // } else {
                         //   $this->base->set('error', 'Password must be 7 characters or longer');
                        //}
                    } else {
                        $this->base->set('error', 'New passwords don\'t match');
                    }
                } else {
                    $this->base->set('error', 'Current password does not match');
                }

            }

        }

        $this->base->mset([
            'title' => 'User Panel',
            'content' => 'account/main.php'
        ]);

    }

    public function cart()
    {
        \Helpers\Check::can_customer_login();

        $url = '';

        // find user's cart
        $findCart = \Models\CustomerCart::where('customer_id', $_SESSION['customer_id']);

        // get cart items
        $cartItems = $findCart->get();

        if(isset($_POST['save_cart'])){

            if(count($_POST['quantity']) == '0'){
                die(header('Location: '.$this->base->get('BASE').'/account/cart'));
            }

            $this->base->get('db')->transaction(function($db) use(&$url, $findCart){

                foreach($_POST['quantity'] as $itemid => $quantity){

                    /* invalid cart item id */
                    if($itemid == '0'){
                        continue;
                    }

                    $item = $findCart->where('id', $itemid)->first();
                    $product = \Models\Product::find($item->product_id);

                    /* qty in db */
                    $currentQty = $item->quantity;

                    /* no changes */
                    if($quantity == $currentQty || $quantity < '0'){
                        continue;
                    }

                    /* mintak lebih byk dari stock */
                    if($quantity > $product->stock){

                        $this->base->push('error', 'Not enough \''.$item->product->name.'\' in our stock');
                        continue;

                    }

                    /* qty 0, remove from table, re-add stock */
                    if($quantity == '0'){

                        $product->stock = ($product->stock + $item->quantity);
                        $product->save();

                        $item->delete();

                        continue;

                    }

                    $difference = ($currentQty - $quantity);

                    $item->quantity = $quantity;
                    $product->stock = ($product->stock + $difference);

                    $item->save();
                    $product->save();

                }

            });

            die(header('Location: '.$this->base->get('BASE').'/account/cart'));

        } elseif(isset($_POST['checkout'])){

            // add order -> add invoice -> add invoiceitems -> clear cart
            //$this->base->get('db')->transaction(function($db) use($findCart, $cartItems){
            $gateway = 'billplz'; //in_array($_POST['gateway'], ['billplz','paypal']) ? $_POST['gateway'] : 'billplz';

            try {

                $this->base->get('db')->beginTransaction();

                $amount = 0;

                // add order
                $order = new \Models\Order;
                $order->customer_id = $_SESSION['customer_id'];
                $order->save();
                $order_id = $order->id;

                // add invoice
                $invoice = new \Models\Invoice;
                $invoice->customer_id = $_SESSION['customer_id'];
                $invoice->order_id = $order_id;
                $invoice->gateway = $gateway;
                $invoice->save();
                $invoice_id = $invoice->id;

                // add invoiceitems
                foreach($cartItems as $cartItem){

                    $product = \Models\Product::find($cartItem->product_id)->first();
                    $amount += ($cartItem->quantity * $product->price);

                    $invoiceitem = new \Models\InvoiceItem;
                    $invoiceitem->invoice_id = $invoice_id;
                    $invoiceitem->product_id = $cartItem->product_id;
                    $invoiceitem->quantity = $cartItem->quantity;
                    $invoiceitem->save();

                }

                // clear cart
                $findCart->delete();

                $this->base->get('db')->commit();

                // checkout

                if($gateway == 'billplz'){

                    $gate = $this->base->get('gateway.billplz');
                    $res = $gate->create_bill([
                        'email' => $this->user->email,
                        'name' => $this->user->fname.' '.$this->user->lname,
                        'amount' => $amount * 100,
                        'callback_url' => $this->base->get('URL').'/hook/billplz?invoice_id='.$invoice_id,
                        'description' => 'Invoice #'.$invoice_id,
                        'redirect_url' => $this->base->get('URL').'/account/invoices/'.$param['invoice_id']
                    ]);

                    $res = json_decode($res);
                    $url .= $res->url;

                    (header('Location: '.$url));

                } else {

                }

            //});


            } catch(\Exception $e){

                $this->base->get('db')->rollBack();
            }

            die(header('Location: '.$url)); //.$this->base->get('BASE').'/account'));

        }

        $this->base->mset([
            'title' => 'User Cart',
            'content' => 'account/cart.php',
            'cartItems' => $cartItems,
            'itemCounter' => 0,
            'priceCounter' => number_format((float) 0, 2)
        ]);

    }

    public function orders($f3, $param)
    {
        \Helpers\Check::can_customer_login();

        if(isset($param['order_id'])){

            $order = \Models\Order::find($param['order_id']);

            if(!$order){
                $this->base->error(404);
            }

            $order = $order->first();

            $this->base->mset([
                'title' => 'View Order',
                'content' => 'account/order.php',
                'order' => $order
            ]);

        } else {

            $orders = new \Models\Order;
            $orders = $orders->where('customer_id', $_SESSION['customer_id']);

            $paginator = new \Kilte\Pagination\Pagination($orders->count(), $this->page, $this->per_page);
            $orders = $orders->offset($paginator->offset())->limit($paginator->limit())->get();
            $pages = $paginator->build();

            $this->base->mset([
                'title' => 'Order History',
                'content' => 'account/orders.php',
                'orders' => $orders,
                'pages' => $pages
            ]);

        }

    }

    public function invoices($f3, $param)
    {
        \Helpers\Check::can_customer_login();

        if(isset($param['invoice_id'])){

            $invoice = \Models\Invoice::find($param['invoice_id']);

            if(!$invoice){
                $this->base->error(404);
            }

            $invoice = $invoice->first();

            $this->base->mset([
                'title' => 'Viewing Invoice',
                'content' => 'account/invoice.php',
                'invoice' => $invoice
            ]);

        } else {

            $invoices = \Models\Invoice::where('customer_id', $_SESSION['customer_id']);
            $paginator = new \Kilte\Pagination\Pagination($invoices->count(), $this->page, $this->per_page);
            $invoices = $invoices->offset($paginator->offset())->limit($paginator->limit())->get();
            $pages = $paginator->build();

            $this->base->mset([
                'title' => 'User Invoices',
                'content' => 'account/invoices.php',
                'invoices' => $invoices,
                'pages' => $pages
            ]);

        }

    }

    public function payinvoice($f3, $param)
    {
        //dd($param);
        $gateway = $this->base->get('gateway.billplz');
        $amount = 0;
        $invoice = \Models\Invoice::find($param['invoice_id']);

        if(!$invoice){
            $this->base->error(404);
        }

        $invoice = $invoice->first();
        $invoiceitems = $invoice->items;

        foreach($invoiceitems as $item){

            $product = \Models\Product::find($item->product_id);
            $product_price = $product->price;
            $product_qty = $item->quantity;

            $amount += ($product_qty * $product_price);

        }

        $res = $gateway->create_bill([
            'email' => $this->user->email,
            'name' => $this->user->fname.' '.$this->user->lname,
            'amount' => $amount * 100,
            'callback_url' => $this->base->get('URL').'/hook/billplz?invoice_id='.$param['invoice_id'],
            'description' => 'Invoice #'.$param['invoice_id'],
            'redirect_url' => $this->base->get('URL').'/account/invoices/'.$param['invoice_id']
        ]);

        $res = json_decode($res);
        $url = $res->url;

        die(header('Location: '.$url));

    }

}
