<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract;
use App\Models\Ads;
use App\Models\Banners;
use App\Models\Brands;
use App\Models\Settings;
use Crypt;
use Carbon\Carbon; 
use App\Models\User;
use App\Models\Senders;
use App\Models\Plugins;
use App\Models\Categories;
use App\Models\ProductImages;
use App\Models\Products;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schedule;

class Helper //implements HelperContract
{    

            public $emailConfig = [
                           'ss' => 'smtp.gmail.com',
                           'se' => 'uwantbrendacolson@gmail.com',
                           'sp' => '587',
                           'su' => 'uwantbrendacolson@gmail.com',
                           'spp' => 'kudayisi',
                           'sa' => 'yes',
                           'sec' => 'tls'
                       ];     
                        
             public $signals = ['okays'=> ["login-status" => "Sign in successful",            
                     "add-sender-status" => "Sender added!",
                     "update-profile-status" => "Profile updated!",
                     "new-tracking-status" => "Tracking added!",
                     "tracking-status" => "Tracking updated!",
                     "remove-tracking-status" => "Tracking removed!",
                     "contact-status" => "Message sent! Our customer service representatives will get back to you shortly.",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
					 "add-sender-status-error" => "There was a problem adding sender.",
					 "update-status-error" => "There was a problem updating the account, please contact support.",
					 "contact-status-error" => "There was a problem sending your message, please contact support.",
                     "tracking-status-error" => "Tracking info does not exist!",
                    ]
                   ];
 
             public $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
             public $nums = '0123456789';



        public $psSecretKey = "sk_test_6fd50bf759cd1e058c01d3b186cbd16cae2ab05b";
        

     
   

    public $contactInfo = [
        'email' => "info@epic-trade.com",
        'phone' => "[Your phone number]",
        'address' => "Australia 29, 2003, OATLEY New South Wales 2223"
    ];

    public $predictionFee = 200;


    public $faqs = [
        [
            'title' => "Buying",
            'data' => [
                [
                  'question' => "How do you buy predictions?",
                  'answer' => "<p>To buy predictions, you have to <a href='signup'>Sign up</a> first. After that, you then fund your wallet with points.</p>"
                              ."<p>After funding your account, navigate to <a href='/'>home page</a>. </p>"
                              ."<p>On the home page, predictions are displayed in 2 major places; <b>Winning Tips</b> and <b>other Tips</b> sections.</p>"
                              ."<p>Each of the 2 sections above are <i>slides</i>, allowing you to browse through all the available predictions for each day, with ease!</p>"
                              ."<p>Predictions are grouped by seller. Click on the desired seller's card. You would then be redirected to the <b>seller's profile page</b>.</p>"
                              ."<p>On the seller's page, you would find useful information about the seller; the seller's win ratio, ongoing predictions and predictions for previous days.</p>"
                              ."<p>You would see a <b>Buy now</b> button beside an available prediction. Click on it to complete the transaction!</p>"
                ],
                [
                    'question' => "How do you fund your wallet, to buy predictions?",
                    'answer' => "<p>To fund wallet, first navigate to your <a href='dashboard'>Dashboard</a>. After that, you then fund your wallet with points.</p>"
                                ."<p>Under the <b>Quick Links</b>, click on Fund wallet. <i class='fa fa-info-circle'></i> <b>1 prediction</b> costs <b>1 point</b>. 1 point = <b>&#8358;200</b>.</p>"
                                ."<p><i class='fa fa-info-circle'></i> The minimum amount of points that you can buy is 5 points (<b>&#8358;1,000</b>).</p>"
                                ."<p>On the page, tell us how many points you want, then click on <b>Click here to fund wallet</b>.</p>"
                                ."<p>If successful, a modal would be displayed, showing you instructions on how to make payment.</p>"
                                ."<p>Once admins confirm your payment, your wallet would be credited with points!</p>"
                ],
                [
                    'question' => "What happens when you buy prediction and it casts?",
                    'answer' => "<p>Though we don't guarantee the success of any prediction,  we firmly believe in our <b>verified sellers</b>; some have confidently given us <b>80% success rate</b> on their predictions!</p>"
                                ."<p>But this is football, <b>anything can happen</b>. If you purchase a prediction and the game is lost, 1 point is returned from escrow and refunded back to your wallet.</p>"
                ],
                [
                    'question' => "Where can you find predictions that you have purchased?",
                    'answer' => "<p>When you purchase a prediction, they can be accessed from either your <a href='dashboard'>dashboard</a> or <a href='my-predictions'>My Predictions</a> pages.</p>"
                               ."<p>On both pages, the predictions are displayed in a smart table. This table allows you to search for your predictions using any keyword (date, club name, free or not, etc).</p>"
                               ."<p>These tables are divided into 2 tabs; 
                                 <ol>
                                   <li><b>Predictions Purchased</b>: Here you'll find all the predictions that you've bought with points.</li>
                                   <li><b>Predictions for Sale</b>: Here you'll find all the predictions that you've posted for sale, along with the ones for free.</li>
                                 </ol>
                               .</p>"
                ],
           ]
        ],
        [
            'title' => "Selling",
            'data' => [
                [
                    'question' => "what do you need to know to start selling predictions?",
                    'answer' => "<p>If you're interested in selling predictions on <a href='/'>our platform</a>, here are a couple of things you must be aware of:</p>"
                               ."<p>1. <b>Free Game</b>: Each day you post predictions for sale, you must also post at least 1 free prediction. <b>We will not display the predictions of sellers who fail to do this</b>.</p>"
                               ."<p>2. <b>Pricing and Commissions</b>: <ul>"
                               ."<li><p >Buyers are charged <b>1 point</b> per prediction.</p></li>"
                               ."<li><p >1 point is equivalent to <b>&#8358;200</b>.</p></li>"
                               ."<li><p ><a href='/'>Safebets NG</a> deducts 50% (<b>&#8358;100</b>) per sale, as commission for selling on our platform.</p></li>"
                              
                               ."</ul></p>"
                               ."<p>3. <b>Prediction Outcomes</b>: <ul>"
                                ."<li><p >If a prediction is won, all your buyers points would be transferred from escrow to your wallet</p></li>"
                                ."<li><p >If a prediction is lost, all your buyers points would be transferred from escrow back to their individual wallets</p></li>"
                               ."</ul></p>"
                ],
                [
                  'question' => "how do you sell predictions?",
                  'answer' => "<p>To post a prediction for sale, first navigate to your <a href='dashboard'>Dashboard</a>. After that, you then post your prediction.</p>"
                              ."<p>Under the <b>Quick Links</b>, click on <b>Sell Predictions</b>. Alternatively, you can go to <a href='predictions'>My Predictions</a> page, and click on <b>Sell Predictions</b>.</p>"
                              ."<p><i class='fa fa-info-circle'></i> Uploading of predictions are done <b>manually and one-by-one, via the form provided</b>. This was done to reduce the number of 'unsure' predictions on our platform. Better to post 3 sure predictions than to load our buyers with over 20+ random ones!</p>"
                              ."<p>On the page, fill the form provided with the details of the prediction , then click on <b>Add prediction</b> to submit.</p>"
               ],
               [
                'question' => "how do you track sales for each prediction?",
                'answer' => "<p>You can track sales on each prediction from the <b>My Predictions</b> page</p>."
                            ."<p>Go to <a href='my-predictions'>My Predictions</a> page.</p>"
                            ."<p>On the list for each prediction, the total number of users who purchased your predictions would be displayed (in real-time, so its always updated).</p>"
               ],
               [
                    'question' => "how do you withdraw your sales?",
                    'answer' => "<p>To withdraw funds from <a href='/'>Safebets NG</a>, a few requirements must be met: <ul>"
                               ."<li><p >1. You must complete your KYC before you can withdraw.</p></li>"
                               ."<li><p >To complete your KYC, Send an email titled <b>safebets kyc</b> to <a href='mailto:support@safebets.com.ng'>support@safebets.com.ng</a></b> using <b>your login email</b>.</p></li>"
                               ."<li><p ><b>Email must contain a copy of your ID.</b> Acceptable IDs:<b> Voters Card, NIN</b>. <i>Name on ID must match name on dashboard</i>.</p></li>"
                               ."<li><p >2. Minimum amount to withdraw <b>&#8358;2,000.00</b>.</p></li>"
                               ."</ul></p>"
                               ."<p>Navigate to your <a href='dashboard'>Dashboard</a>.</p>"
                               ."<p>Under the <b>Quick Links</b>, click on Withdraw.</p>"
                               ."<p>Enter the amount you want to withdraw. Also provide a Whatsapp number where admins can reach you, to process your withdrawal.</p>"
                               ."<p>Click on <b>Withdraw funds</b></p>"
                               ."<p></p>"
               ],
           ]
        ]
    ];

    public $productStatuses = [
        ['label' => "In Stock", 'value' => "in-stock"],
        ['label' => "Out of Stock", 'value' => "out-of-stock"],
        ['label' => "Unavailable", 'value' => "unavailable"],
    ];

    public $paymentModes = [
        ['label' => "Cash", 'value' => "cash"],
        ['label' => "Transfer/POS", 'value' => "transfer-pos"],
    ];

    public $contactDetails = [
        'address' => "Test Address<br> Lagos State, NG<br>",
        'phone' => "08012345678",
        'email' => "info@ukporunique.com",
    ];

    public $months =  [
        [
            'label' => 'January',
            'value' => '01',
            'days' => 31,
        ],
        [
            'label' => 'February',
            'value' => '02',
            'days' => 29,
        ],
        [
            'label' => 'March',
            'value' => '03',
            'days' => 31,
        ],
        [
            'label' => 'April',
            'value' => '04',
            'days' => 30,
        ],
        [
            'label' => 'May',
            'value' => '05',
            'days' => 31,
        ],
        [
            'label' => 'June',
            'value' => '06',
            'days' => 30,
        ],
        [
            'label' => 'July',
            'value' => '07',
            'days' => 31,
        ],
        [
            'label' => 'August',
            'value' => '08',
            'days' => 31,
        ],
        [
            'label' => 'September',
            'value' => '09',
            'days' => 30,
        ],
        [
            'label' => 'October',
            'value' => '10',
            'days' => 31,
        ],
        [
            'label' => 'November',
            'value' => '11',
            'days' => 30,
        ],
        [
            'label' => 'December',
            'value' => '12',
            'days' => 31,
        ],
    ];

    public $testProducts = [
        [
           'id' => '1',
           'slug' => 'jacket-suiting-blazer',
           'category' => 'women',
           'title' => 'Jacket Suiting Blazer',
           'images' => [['url' => 'images/products/thumbnails/item1.jpg']],
            'description' => '',
           'price' => '40',
           'status' => 'ok'
        ],
        [
            'id' => '2',
            'slug' => 'gap-graphic-cuffed',
            'category' => 'women',
            'title' => 'Gap Graphic Cuffed',
            'images' => [['url' => 'images/products/thumbnails/item2.jpg']],
            'description' => '',
            'price' => '18.5',
            'status' => 'ok'
         ],
         [
            'id' => '3',
            'slug' => 'womens-lauren-dress',
            'category' => 'women',
            'title' => 'Women\'s Lauren Dress',
            'images' => [['url' => 'images/products/thumbnails/item3.jpg']],
            'description' => '',
            'price' => '30',
            'status' => 'ok'
         ],
         [
            'id' => '4',
            'slug' => 'jacket-lauren-blazer',
            'category' => 'women',
            'title' => 'Jacket Lauren Blazer',
            'images' => [['url' => 'images/products/thumbnails/item4.jpg']],
            'description' => '',
            'price' => '40',
            'status' => 'ok'
         ],
         [
            'id' => '5',
            'slug' => 'jacket-suiting-blazer-2',
            'category' => 'women',
            'title' => 'Jacket Suiting Blazer',
            'images' => [['url' => 'images/products/thumbnails/item5.jpg']],
            'description' => '',
            'price' => '18.5',
            'status' => 'ok'
         ],
         [
            'id' => '6',
            'slug' => 'women-spahyr-dress',
            'category' => 'women',
            'title' => 'Women\'s Spahyr Dress',
            'images' => [['url' => 'images/products/thumbnails/item6.jpg']],
            'description' => '',
            'price' => '30',
            'status' => 'ok'
         ],
       
    ];


    
    public $deletedUser = [
      'id' => '',
      'fname' => 'User',
      'lname' => 'Deleted',
      'phone' => 'default',
      'email' => 'default@safebets.com.ng',
      'username' => 'deleted',
      'wallet' => [],
      'gender' => '',
      'role' => 'deleted',
      'avatar' => '',
      'status' => 'deleted',
      'verified' => 'no',
      'complete_signup' => 'no',
    ];

    public $DEFAULT_DATE_FORMAT = "jS F, Y";


   
/***********************************************************************************/
       function isValidUser($u)
       {
         $ret = false;

         if(isset($u) && $u->status === 'ok')
         {
           $ret = true;
         }
         return $ret;
       }

       function getValidUser()
       {
        //function to check for valid user (auth and role based)
        $ret = ['user' => null, 'check' => false];
        $check = Auth::check();
        
        if($check)
        {
            $temp = Auth::user();

            if($this->isValidUser($temp)){
                $ret['check'] = $check;
                $ret['user'] = $temp;
            }
        }

        return $ret;
       }

         function getFaqs()
         {
            return $this->faqs;
         }
         

           function symfonySendMail($data){
            
              $email = (new Email())
               ->from(new Address($data['se'],$data['sn']))
               ->to($data['to'])
               //->cc('cc@example.com')
               //->bcc('bcc@example.com')
               //->replyTo('fabien@example.com')
               //->priority(Email::PRIORITY_HIGH)
               ->subject($data['subject'])
               //->text('Sending emails is fun again!')
               ->html($data['htmlContent']);
               $dsn = "smtp://{$data['su']}:{$data['spp']}@{$data['ss']}:{$data['sp']}";
              
              $transport = Transport::fromDsn($dsn);
              $mailer = new Mailer($transport);
              $mailer->send($email);
           }

           function getEmailContent($emailData = [ 'type' => '', 'data' => [] ])
           {
             $ret = '';
             $type = $emailData['type']; $data = $emailData['data'];

             if( $type === 'forgot-password' && (isset($data['username']) && isset($data['link'])) )
             {
                $username = $data['username']; $link = $data['link'];
                $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Hello $username!</h4>
                <p style="">Please click the button below to reset password:</p>
                <a href="$link" style="padding: 8px 15px; background: #ff7600; border: 1px solid transparent; color: #fff; margin: 0 5px; min-width: 110px; text-align: center; position: relative; line-height: 26px; font-weight: 700;">Reset Password</a>
                <p style="">If that doesn't work, copy and paste the link below to your browser:</p>
                <a href="$link" style="">$link</a>
             </div>
EOD;
             }
             else if($type === 'event-reminder' && (isset($data['evt']) && isset($data['body'])))
             {
               $evt = $data['evt']; $title = $evt['title']; $pic = $evt['pic'];
               $location = $evt['location']; $sd = $evt['start_date']; $ed = $evt['end_date'];
               $body = $data['body']; $url = url('event').'?xf='.$evt['slug'];

               $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Reminder on our event: $title</h4>
                
                <img src="$pic" style="margin-top: 10px; width: 100px; height: 100px; border-radius: 10px;"/>
                
                <div style="margin-top: 10px;">
                  $body
                </div>
                <p style="margin-top: 10px;">
                Event Info:<br>
                <ul>
                  <li>Location: <b>$location</b></li> 
                  <li>Start date: <b>$sd</b></li> 
                  <li>End date: <b>$ed</b></li> 
                  <li>Location: <b></b></li> 
                </ul>
                </p>

                <div style="margin-top: 10px;">
                 <p> To view more, please visit <a href="$url">the event's page</a>. </p>
                 <p>If you cant click the link above, here it is: $url</p>

                </div>
             </div>
EOD;

             }
             else if($type === 'donation-alert' && (isset($data['fname']) && isset($data['lname']) && isset($data['email']) && isset($data['amount'])))
             {
               $f = $data['fname']; $l = $data['lname']; $e = $data['email'];
               $a = number_format($data['amount'],2);

               $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Donation received on the website:</h4>
               
                <p style="margin-top: 10px;">
                Donation Info:<br>
                <ul>
                  <li>Full name: <b>$f $l</b></li> 
                  <li>Email address: <b>$e</b></li> 
                  <li>Amount donated: <b>&#8358;$a</b></li> 
                </ul>
                </p>

                <div style="margin-top: 10px;">
                 <p>Please visit the admin center to confirm or delete this donation, depending on whether the actual funds have been received or not.</p>

                </div>
             </div>
EOD;

             }
             else if( $type === 'sales-alert' && (isset($data['username']) && isset($data['ticket'])) )
             {
                $username = $data['username']; $t = $data['ticket'];
                $home = $p['home_club']['club_name']; $away = $p['away_club']['club_name'];  $prediction = $p['prediction_category'];

                $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Someone just bought your bet slip!</h4>
                <p style="">Username: <b>$username</b></p>
      
                
                <p style="">We're very excited that you are making sales! We wish you nothing but the best outcome on every prediction.</p>
                <p style="">
                Important points to note:<br>
                <ul>
                  <li>All sales made from this transaction are secured in escrow, pending full time for the match</li> 
                  <li>If all the predictions in this bet slip wins, escrowed funds would be transferred to your wallet.</li>
                  <li>If at least 1 prediction loses, escrowed funds would be transferred back to the buyer's wallet.</li>
                  <li>The outcome of each of your predictions determines your rating on our platform. <i>Sellers with the highest ratings would be marketed to our users the most</i></li>
                </ul>
                </p>
             </div>
EOD;
             }
             else if($type === 'verify-school-signup' && (isset($data['link']) && isset($data['name'])))
             {
                $name = $data['name']; 
                $ret = <<<EOD
                <div style="padding: 10px;">
                <h4 style="">Welcome to AdmissionBOOX!</h4>
                <p style="">Hello $name,<br> We are excited to get you started. First, you need to verify your account. Just click the button below:</p>
                <a href="$link" style="padding: 8px 15px; background: #ff7600; border: 1px solid transparent; color: #fff; margin: 0 5px; min-width: 110px; text-align: center; position: relative; line-height: 26px; font-weight: 700;">Verify Account</a>
                <p style="">If that doesn't work, copy and paste the link below to your browser:</p>
                <a href="$link" style="">$link</a>
             </div>
EOD;
             }

             else if($type === 'contact-school' && (isset($data['contactName']) && isset($data['contactEmail'])) && isset($data['contactMessage']) && isset($data['schoolName']))
             {
                $name = $data['contactName']; $email = $data['contactEmail']; $msg = $data['contactMessage']; $schoolName = $data['schoolName'];
                $ret = <<<EOD
                <div style="padding: 10px;">
                   <h4 style="">New message for $schoolName</h4>
                   <p style="">Name: <strong>$name,</strong></p>
                   <p style="">Email address: <strong>$email</strong></p>
                   <blockquote style=" background: rgba(0, 0, 0, 0.02); padding: 20px; margin: 0 0 20px; font-size: 16px; line-height: 28px; color: #707070; border-left: 5px solid #eeeeee;">
                     $msg
                   </blockquote>
                </div>
EOD;
             }

             return $ret;
           }

           function cloudinaryUploadImage($file)
           {
             $url = Cloudinary::uploadFile($file->getRealPath())->getSecurePath();
             return $url;
           }

           function getCloudinaryImageFromUrl($url)
           {
            $ret = "";
             if(strlen($url) > 0)
             {
                $urlArr = explode('/',$url);
                if(isset($urlArr[7]) && strlen($urlArr[7] > 0))
                {
                   $filename = $urlArr[7];
                   $filenameArr = explode('.',$filename);
                   $ret = $filenameArr[0];
                }
             }
             
             
             return $ret;
           }

           function getCloudinaryImage($public_id)
           {
            $url = Cloudinary::getUrl($public_id);
            return $url;
           }

           function cloudinaryRemoveImage($public_id)
           {
              try {
                // Delete image from Cloudinary using its public ID
                Cloudinary::destroy($public_id);
              } catch (\Exception $e) {
                // Handle exception if deletion from Cloudinary fails
                return $e->__toString();
              }
           }
           
 
          function createUser($data)
          {
           
              $ret = User::create(['fname' => $data['fname'], 
                                                     'lname' => $data['lname'], 
                                                     'email' => $data['email'], 
                                                     'username' => $data['username'], 
                                                     'phone' => $data['phone'], 
                                                     'role' => $data['role'], 
                                                     'bday' => $data['bday'], 
                                                     'tier' => $data['tier'], 
                                                     'avatar' => $data['avatar'], 
                                                     'gender' => $data['gender'], 
                                                     'status' => $data['status'], 
                                                    'verified' => $data['verified'], 
                                                    'complete_signup' => $data['complete_signup'], 
                                                     'password' => bcrypt($data['password']), 
                                                     'remember_token' => "default",
                                                     'reset_code' => "default"
                                                     ]);
                                                     
               return $ret;
          }
           
           function getUser($email)
           {
           	$ret = [];
               $u = User::where('email',$email)
                        ->orWhere('username',$email)
			            ->orWhere('id',$email)->first();
 
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       $temp['phone'] = $u->phone;
                       $temp['email'] = $u->email; 
                       $temp['username'] = $u->username; 
                       $temp['gender'] = $u->gender; 
                       $temp['role'] = $u->role; 
                       $temp['bday'] = $u->bday; 
                       $temp['tier'] = $u->tier; 
                       $temp['avatar'] = $u->avatar; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['complete_signup'] = $u->complete_signup; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format($this->DEFAULT_DATE_FORMAT);  
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   function getUsers($id="all")
           {
           	$ret = [];
               if($id == "all") $uu = User::where('role','admin')->orWhere('role','user')->orderBy('created_at','desc')->get();
               else if($id == "admins")$uu = User::where('role','admin')->orWhere('role','su')->orderBy('created_at','desc')->get();
               else $uu = User::where('role',$id)->orderBy('created_at','desc')->get();
 
              if($uu != null)
               {
				  foreach($uu as $u)
				    {
                       $temp = $this->getUser($u->id);
                       array_push($ret,$temp); 
				    }
               }                          
                                                      
                return $ret;
           }	  

           function updateUser($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['email']))
               {
               	$u = User::where('email', $data['email'])
                         ->orWhere('username', $data['email'])
                          ->orWhere('id', $data['email'])->first();
 
                        if($u != null)
                        {
							$payload = [];
                            if(isset($data['fname'])) $payload['fname'] = $data['fname'];
                            if(isset($data['lname'])) $payload['lname'] = $data['lname'];
                            if(isset($data['password'])) $payload['password'] = $data['password'];
                            if(isset($data['gender'])) $payload['gender'] = $data['gender'];
                            if(isset($data['role'])) $payload['role'] = $data['role'];
                            if(isset($data['bday'])) $payload['bday'] = $data['bday'];
                            if(isset($data['tier'])) $payload['tier'] = $data['tier'];
                            if(isset($data['username'])) $payload['username'] = $data['username'];
                            if(isset($data['avatar'])) $payload['avatar'] = $data['avatar'];
                            if(isset($data['status'])) $payload['status'] = $data['status'];
                            if(isset($data['verified'])) $payload['verified'] = $data['verified'];
                            if(isset($data['complete_signup'])) $payload['complete_signup'] = $data['complete_signup'];
                           
                        	$u->update($payload);
                             $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

           function removeUser($id)
           {
               $p = User::where('id',$id)->first();

               if($p != null) $p->delete();
           }

           function createPlugin($data)
           {
               $ret = Plugins::create([
                   'name' => $data['name'],
                   'value' => $data['value'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getPlugins($data=['mode' => 'all'])
           {
               $ret = [];
               if($data['mode'] === 'all') $plugins = Plugins::where('id','>','0')->orderBy('created_at','desc')->get();
               else if($data['mode'] === 'active') $plugins = Plugins::where('status','ok')->orderBy('created_at','desc')->get();
               else $plugins = Plugins::where('status',$data['mode'])->orderBy('created_at','desc')->get();

               if($plugins != null)
               {
                  foreach($plugins as $p)
                  {
                      $temp = $this->getPlugin($p->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getPlugin($id)
           {
               $ret = [];
               $p = Plugins::where('id',$id)->first();

               if($p != null)
               {
                   $ret['id'] = $p->id;
                   $ret['name'] = $p->name;
                   $ret['value'] = $p->value;
                   $ret['status'] = $p->status;
                   $ret['date'] = $p->created_at->format($this->DEFAULT_DATE_FORMAT);  
               }

               return $ret;
           }

           function updatePlugin($data)
           {
            $ret = [];
            $p = Plugins::where('id',$data['id'])->first();
            
            if($p != null)
            {
                $p->update([
                    'name' => $data['name'],
                    'value' => $data['value'],
                    'status' => $data['status']
                ]);
            }
           }

           function removePlugin($id)
           {
               $p = Plugins::where('id',$id)->first();

               if($p != null) $p->delete();
           }

           function createSetting($data)
           {
               $ret = Settings::create([
                   'name' => $data['name'],
                   'value' => $data['value'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getSettings($data=['mode' => 'all'])
           {
               $ret = [];
               if($data['mode'] === 'all') $settings = Settings::where('id','>','0')->orderBy('created_at','desc')->get();
               else $settings = Settings::where('status',$data['mode'])->orderBy('created_at','desc')->get();

               if($settings != null)
               {
                  foreach($settings as $s)
                  {
                      $temp = $this->getSetting($s->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getSetting($id)
           {
               $ret = [];
               $p = Settings::where('id',$id)
                            ->orWhere('name',$id)->first();

               if($p != null)
               {
                   $ret['id'] = $p->id;
                   $ret['name'] = $p->name;
                   $ret['value'] = $p->value;
                   $ret['status'] = $p->status;
                   $ret['date'] = $p->created_at->format($this->DEFAULT_DATE_FORMAT);  
               }

               return $ret;
           }

           function updateSetting($data)
           {
            $ret = [];
            $p = Settings::where('id',$data['xf'])->first();
            
            if($p != null)
            {
                $payload = [];
                if(isset($data['name'])) $payload['name'] = $data['name'];
                if(isset($data['value'])) $payload['value'] = $data['value'];
                if(isset($data['status'])) $payload['status'] = $data['status'];

                $p->update($payload);
            }
           }

           function removeSetting($id)
           {
               $p = Settings::where('id',$id)->first();

               if($p != null) $p->delete();
           }
          
           function hasKey($arr,$key) 
           {
           	$ret = false; 
               if( isset($arr[$key]) && $arr[$key] != "" && $arr[$key] != null ) $ret = true; 
               return $ret; 
           }

           function getPasswordResetCode($user)
           {
           	$u = $user; 
               
               if($u != null)
               {
               	//We have the user, create the code
                   $code = bcrypt(rand(125,999999)."rst".$u->id);
               	$u->update(['reset_code' => $code]);
               }
               
               return $code; 
           }
           
           function verifyPasswordResetCode($code)
           {
           	$u = User::where('reset_code',$code)->first();
               
               if($u != null)
               {
               	//We have the user, delete the code
               	$u->update(['reset_code' => 'default']);
               }
               
               return $u; 
           }	
           
           
           function createSender($data)
           {
               $ret = Senders::create([
                   'ss' => $data['ss'],
                   'sp' => $data['sp'],
                   'sa' => $data['sa'],
                   'sec' => $data['sec'],
                   'su' => $data['su'],
                   'spp' => $data['spp'],
                   'sn' => $data['sn'],
                   'se' => $data['se'],
                   'current' => $data['current'],
                   'type' => $data['type'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getSenders()
           {
               $ret = [];
               $senders = Senders::where('id','>','0')->orderBy('created_at','desc')->get();

               if($senders != null)
               {
                  foreach($senders as $s)
                  {
                      $temp = $this->getSender($s->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }



           function getSender($id)
           {
               $ret = [];
               $s = Senders::where('id',$id)->first();

               if($s != null)
               {
                   $ret['id'] = $s->id;
                   $ret['ss'] = $s->ss;
                   $ret['sp'] = $s->sp;
                   $ret['sa'] = $s->sa;
                   $ret['sec'] = $s->sec;
                   $ret['su'] = $s->su;
                   $ret['spp'] = $s->spp;
                   $ret['sn'] = $s->sn;
                   $ret['se'] = $s->se;
                   $ret['current'] = $s->current;
                   $ret['status'] = $s->status;
                   $ret['date'] = $s->created_at->format($this->DEFAULT_DATE_FORMAT);
               }

               return $ret;
           }

           function getCurrentSender()
           {
            $ret = [];
            $s = Senders::where('current','yes')->first();

            if($s != null)
            {
                $ret = $this->getSender($s->id);
            }

            return $ret;
           }

           function clearCurrentSender()
           {
            $ret = [];
            $list = Senders::where('current','yes')->get();

            if($list != null)
            {
                foreach($list as $s) $s->update(['current' => 'no']);
            }

            return $ret;
           }

           function updateSender($data)
           {
            $ret = [];
            $a = Senders::where('id',$data['xf'])->first();
            
            if($a != null)
            {
                $payload = [];
                if(isset($data['status'])) $payload['status'] = $data['status'];
                if(isset($data['current'])) $payload['current'] = $data['current'];

                $a->update($payload);
            }
           }

           function removeSender($id)
           {
               $s = Senders::where('id',$id)->first();

               if($s != null) $s->delete();
           }

           function createAd($data)
           {
               $ret = Ads::create([
                   'name' => $data['name'],
                   'value' => $data['value'],
                   'image' => $data['image'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getAds($data=['mode' => 'all'])
           {
               $ret = [];
               if($data['mode'] === 'all') $ads = Ads::where('id','>','0')->orderBy('created_at','desc')->get();
               else $ads = Ads::where('status',$data['mode'])->orderBy('created_at','desc')->get();

               if($ads != null)
               {
                  foreach($ads as $a)
                  {
                      $temp = $this->getAd($a->id);
                      array_push($ret,$temp);
                  }
               }

               return $ret;
           }

           function getAd($id)
           {
               $ret = [];
               $a = Ads::where('id',$id)->first();

               if($a != null)
               {
                   $ret['id'] = $a->id;
                   $ret['name'] = $a->name;
                   $ret['image'] = $a->image;
                   $ret['value'] = $a->value;
                   $ret['status'] = $a->status;
                   $ret['date'] = $a->created_at->format($this->DEFAULT_DATE_FORMAT);  
               }

               return $ret;
           }

           function updateAd($data)
           {
            $ret = [];
            $a = Ads::where('id',$data['id'])->first();
            
            if($a != null)
            {
                $a->update([
                    'status' => $data['status']
                ]);
            }
           }

           function removeAd($id)
           {
               $a = Ads::where('id',$id)->first();

               if($a != null) $a->delete();
           }

           

           function createBanner($data)
           {
               $ret = Banners::create([
                   'title' => $data['title'],
                   'subtitle' => $data['subtitle'],
                   'image' => $data['image'],
                   'points' => $data['points'],
                   'description' => $data['description'],
                   'btn_url_1' => $data['btn_url_1'],
                   'btn_text_1' => $data['btn_text_1'],
                   'btn_url_2' => $data['btn_url_2'],
                   'btn_text_2' => $data['btn_text_2'],
                   'status' => $data['status']
               ]);

               return $ret;
           }

           function getBanners()
           {
             $ret = [];
            $banners = Banners::where('id','>','0')->orderBy('created_at','desc')->get();
            
             if($banners != null)
              {
               
                   foreach($banners as $b)
                   {
                       $temp = $this->getBanner($b->id);
                       array_push($ret,$temp);
                   }
              }

            return $ret;
           }
 
           function getBanner($id="")
           {

             $ret = [];
               $a = Banners::where('id',$id)->first();

               if($a != null)
               {
                $ret['id'] = $a->id;
                $ret['title'] = $a->title;
                $ret['subtitle'] = $a->subtitle;
                $imgArr = explode('|',$a->image);
                shuffle($imgArr);
                $ret['image'] = $imgArr[0];
                $ret['points'] = $a->points;
                $ret['description'] = $a->description;
                $ret['btn_url_1'] = $a->btn_url_1;
                $ret['btn_text_1'] = $a->btn_text_1;
                $ret['btn_url_2'] = $a->btn_url_2;
                $ret['btn_text_2'] = $a->btn_text_2;
                $ret['status'] = $a->status;
                $ret['date'] = $a->created_at->format($this->DEFAULT_DATE_FORMAT);  
               }

               return $ret;
           }

           function updateBanner($data)
           {  
             $ret = 'error'; 

             if(isset($data['xf']))
              {
                 $w = Banners::where('id', $data['xf'])->first();

                 if($w != null)
                 {
                    $payload = [];
                    if(isset($data['status'])) $payload['status'] = $data['status'];
                
                    $w->update($payload);
                    $ret = "ok";
                }                                    
             }                                 
              return $ret;                               
            } 

           function removeBanner($id)
           {
               $a = Banners::where('id',$id)->first();

               if($a != null) $a->delete();
           }

           function isValidPassword($data=['user_id'=> '','pass' => ''])
           {
              $ret = false;
              $u = User::where('id',$data['user_id'])->first();

              if($u !== null)
              {
                $ret = bcrypt($data['pass']) === $u->password;
              }

              return $ret;
           }

           function deleteAccount($user_id)
           {

            $u = User::where('id',$user_id)->first();

            if($u !== null)
            {
               //replace all references of user info with $deletedUser 
               $payload = $this->deletedUser;
               $payload['id'] = $user_id;
               $u->update($payload);
            }
           }

           function getDays()
           {
            $ret = [
                'today' => Carbon::today()->format($this->DEFAULT_DATE_FORMAT),
                'yesterday' => Carbon::yesterday()->format($this->DEFAULT_DATE_FORMAT),
                'tomorrow' => Carbon::tomorrow()->format($this->DEFAULT_DATE_FORMAT),
            ];

            return $ret;
           }
          

/***********************************************************************************
 * Add custom helper functions here
***********************************************************************************/

//PRODUCTS
function createProduct($data)
{
    $ret = Products::create([
        'title' => $data['title'],
        'slug' => $data['slug'],
        'category' => $data['category'],
        'brand' => $data['brand'],
        'description' => $data['description'],
        'price' => $data['price'],
        'status' => $data['status'],
    ]);

    return $ret;
}

function getProducts($options = [])
{
  $ret = []; $data = null;

  if(isset($options['status']))
  {
    $data = Products::where('status',$options['status'])->orderBy('created_at','desc')->get();
  }
  else
  {
     $data = Products::where('id','>','0')->orderBy('created_at','desc')->get();
  }


 
  if($data != null)
   {
    
        foreach($data as $c)
        {
            $temp = $this->getProduct($c->id,$options);
            array_push($ret,$temp);
        }
   }

 return $ret;
}

function getProduct($id="",$options=[])
{

  $ret = [];
    $c = Products::where('id',$id)
         ->orWhere('slug',$id)->first();

    if($c != null)
    {
     $ret['id'] = $c->id;
     $ret['title'] = $c->title;
     $ret['slug'] = $c->slug;
     $ret['description'] = $c->description;
     $ret['images'] = $this->getProductImages($c->slug);
     $ret['price'] = $c->price;
     $ret['category'] = $this->getCategory($c->category);
     $ret['brand'] = $this->getBrand($c->brand);
     $ret['date'] = $c->created_at->format($this->DEFAULT_DATE_FORMAT);  
    }

    return $ret;
}

function updateProduct($data)
{  
  $ret = 'error'; 

  if(isset($data['xf']))
   {
      $c = Products::where('id', $data['xf'])
                   ->orWhere('slug',$data['xf'])->first();

      if($c != null)
      {
         $payload = [];
         if(isset($data['status'])) $payload['status'] = $data['status'];
     
         $c->update($payload);
         $ret = "ok";
     }                                    
  }                                 
   return $ret;                               
 } 

 function getSliderProducts()
 {
    $ret = [
        'popular' => [],
		'specials' => [],
		'featured' => [],
    ];
    $products = $this->getProducts();
    $pc = count($products);

    if($pc < 6)
    {
         for($i = 0; $i < $pc; $i++)
         {
            //Popular
            array_push($ret['popular'],$products[$i]);

            //Specials
            array_push($ret['specials'],$products[$i]);

            //Featured
            array_push($ret['featured'],$products[$i]);
         }

         for($i=$pc; $i < count($this->testProducts); $i++)
         {
             //Popular
             array_push($ret['popular'],$this->testProducts[$i]);

             //Specials
             array_push($ret['specials'],$this->testProducts[$i]);
 
             //Featured
             array_push($ret['featured'],$this->testProducts[$i]);
         }
    }
    else
    {
        shuffle($products);
        for($i = 0; $i < 6; $i++)
         {
            //Popular
            array_push($ret['popular'],$products[$i]);

            //Specials
            array_push($ret['specials'],$products[$i]);

            //Featured
            array_push($ret['featured'],$products[$i]);
         }
    }
   return $ret;
 }

function removeProduct($id)
{
    $a = Products::where('id', $id)
    ->orWhere('slug',$id)->first();

    if($a != null) $a->delete();
}

//PRODUCT IMAGES
function createProductImage($data)
{
    $ret = ProductImages::create([
        'product_slug' => $data['product_slug'],
        'url' => $data['url'],
    ]);

    return $ret;
}

function getProductImages($product="",$options = [])
{
  $ret = []; $data = null;

     $data = ProductImages::where('product_slug',$product)->orderBy('created_at','desc')->get();


 
  if($data != null)
   {
    
        foreach($data as $c)
        {
            $temp = $this->getProductImage($c->id,$options);
            array_push($ret,$temp);
        }
   }

 return $ret;
}

function getProductImage($id="",$options=[])
{

  $ret = [];
    $c = ProductImages::where('id',$id)->first();

    if($c != null)
    {
     $ret['id'] = $c->id;
     $ret['product_slug'] = $c->product_slug;
     $ret['url'] = $c->url;
     $ret['date'] = $c->created_at->format($this->DEFAULT_DATE_FORMAT);  
    }

    return $ret;
}


function removeProductImage($id)
{
    $a = ProductImages::where('id', $id);

    if($a != null) $a->delete();
}

//CATEGORIES
function createCategory($data)
{
    $ret = Categories::create([
        'title' => $data['title'],
        'slug' => $data['slug'],
        'img' => $data['img'],
    ]);

    return $ret;
}

function getCategories()
{
  $ret = [];
 $data = Categories::where('id','>','0')->orderBy('created_at','desc')->get();
 
  if($data != null)
   {
    
        foreach($data as $c)
        {
            $temp = $this->getCategory($c->id);
            array_push($ret,$temp);
        }
   }

 return $ret;
}

function getCategory($id="")
{

  $ret = [];
    $c = Categories::where('id',$id)
         ->orWhere('slug',$id)->first();

    if($c != null)
    {
     $ret['id'] = $c->id;
     $ret['title'] = $c->title;
     $ret['slug'] = $c->slug;
     $ret['img'] = $c->img;
     $ret['product_count'] = 0; //TODO
     $ret['date'] = $c->created_at->format($this->DEFAULT_DATE_FORMAT);  
    }

    return $ret;
}


function removeCategory($id)
{
    $a =  $c = Categories::where('id',$id)
    ->orWhere('slug',$id)->first();

    if($a != null) $a->delete();
}

//BRANDS
function createBrand($data)
{
    $ret = Brands::create([
        'title' => $data['title'],
        'slug' => $data['slug'],
        'img' => $data['img'],
    ]);

    return $ret;
}

function getBrands()
{
  $ret = [];
 $data = Brands::where('id','>','0')->orderBy('created_at','desc')->get();
 
  if($data != null)
   {
    
        foreach($data as $c)
        {
            $temp = $this->getBrand($c->id);
            array_push($ret,$temp);
        }
   }

 return $ret;
}

function getBrand($id="")
{

  $ret = [];
    $c = Brands::where('id',$id)
         ->orWhere('slug',$id)->first();

    if($c != null)
    {
     $ret['id'] = $c->id;
     $ret['title'] = $c->title;
     $ret['slug'] = $c->slug;
     $ret['img'] = $c->img;
     $ret['product_count'] = 0; //TODO
     $ret['date'] = $c->created_at->format($this->DEFAULT_DATE_FORMAT);  
    }

    return $ret;
}

function removeBrand($id)
{
    $a = $c = Brands::where('id',$id)
    ->orWhere('slug',$id)->first();

    if($a != null) $a->delete();
}




/*******************************************************************************
 * Reusable Funtions
 ******************************************************************************/
		  
           function getCurrentBanner()
           {
             $ret = $this->getBanners();

             shuffle($ret);
             $temp = [];
             if(count($ret) > 0) $temp = $ret[0];
             return $temp;
           }

          

         
            function bomb($payload=[
                'sender' => '',
                'subject' => '',
                'to' => '',
                'body' => '',
                'sname' => ''
            ])
{
  $v = isset($payload['subject']) && isset($payload['sname']) && isset($payload['email']) && isset($payload['body']);
$ret = 'error';

  if($v)
  { 
     $emailContent = $payload['body'];

        $emailPayload = $payload['sender'] === 'current' ? $this->getCurrentSender() : $this->getSender($payload['sender']);
     
          $emailPayload['to'] = $payload['email'];
            $emailPayload['htmlContent'] = $emailContent;
            $emailPayload['subject'] = $payload['subject'];
            $emailPayload['sn'] = $payload['sname'];
      
           $this->symfonySendMail($emailPayload);
      
      $ret = 'ok';
  }

   return $ret;
}
 
function paginateData($data=[],$itemsPerPage=5)
{
    $ret = [];
    $numPages = $this->numPages($data,$itemsPerPage);
    $ctr = 0;

    if($numPages > 0)
    {
       for($i = 0; $i < $numPages; $i++)
       {
          $temp = [];
          for($j = 0; $j < $itemsPerPage; $j++)
          {
             array_push($temp,$data[$ctr]);
             if($ctr >= count($data)) break;
             ++$ctr;
          }
          array_push($ret,$temp);
       }
    }
    
    return $ret;
}
           
          


       
/*************************************************************************************** */

           function generateRandomNumber($length=2,$type='alphanumeric')
           {
            $container = $this->chars;
            if($type === 'numeric') $container = $this->nums;
            $result = ''; $temp = []; $temp3 = [];
            for ($i = $length; $i > 0; --$i)
            {
               $temp2 = rand(1,strlen($container)-1);
               if(strlen($container) > $temp2)
               {
                $result .= $container[$temp2];
               } 
            }
            return $result;
          }



          function numPages($data,$itemsPerPage=7)
           {
             return ceil(count($data) / $itemsPerPage);
           }


          function prevPage($data,$currentPage)
          {
            $ret = [];

            if ($currentPage > 1) {
                --$currentPage;
                $ret = $this->changePage($data,$currentPage);
            }
          }

          function nextPage($data,$currentPage)
          {
            $ret = [];

            if ($currentPage < $this->numPages($data)) {
                ++$currentPage;
                $ret = $this->changePage($data,$currentPage);
            }
          }

          function changePage($data=[],$currentPage=1,$itemsPerPage=7)
          {
            $ret = []; $numPages = $this->numPages($data);
           

            if ($currentPage < 1) $currentPage = 1;
            if ($currentPage > $numPages) $currentPage = $numPages;

            $temp = [];

            if($currentPage > 0)
            {
                for($i = ($currentPage - 1) * $itemsPerPage; $i < ($currentPage * $itemsPerPage) && $i < count($data); $i++)
                {
                    
                    array_push($ret,$data[$i]);
                }
            }
            
            return $ret;
          }

          

          function calculateRating($reviews)
          {
            //dd($reviews);
            $ret = [
                'rating' => 0,
                'environment' => 0,
                'service' => 0,
                'price' => 0
            ];

            foreach($reviews as $r)
            {
               $ret['environment'] += $r['environment'];
               $ret['service'] += $r['service'];
               $ret['price'] += $r['price'];
            }

            $ret['rating'] = (($ret['environment'] + $ret['service'] + $ret['price']) / 20) / 3; 
            
            return $ret;
          }

         

         

           function callAPI($data) 
           {
           	//form query string
               
              $validation = isset($data['url']) || isset($data['method']) || 
              ($data['method'] === "POST" && isset($data['body']));

			   if($validation)
			   { 
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
                 ]);

                 $headers = isset($data['headers']) ? $data['headers'] : [];

                 if($data['method'] === 'POST'){
                    $res = $client->request($data['method'], $data['url'],[
                        'json' => $data['body'],
                        'headers' => $headers
                    ]);
                 }
                 else{
                    $res = $client->request(
                        $data['method'], $data['url'],[
                            'headers' => $headers
                        ]);
                 }
			     
			  
                 $ret = $res->getBody()->getContents(); 
			 
			     $rett = json_decode($ret);
			    }
                else{
				    $ret = json_encode(["status" => "ok","message" => "Validation"]);
			   }
			    
              return $ret; 
           }

           function getSenders2(){
            $ret = $this->callAPI([
                'method' => 'GET',
                'url' => 'http://x1.infinityfreeapp.com/api/senders.php?type=senders'
            ]);

            return $ret;
           }
		          
}
?>