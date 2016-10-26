<?PHP
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class functions
{
    var $admin_email;
    var $from_address;
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    var $error_message;
    
    //-----Initialization -------
    function functions()
    {
        $this->sitename = 'http://sulley.cah.ucf.edu/~dig4530c_009/';
        $this->rand_key = 'qSRcVS6DrTzrPvr';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsite($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function CheckLogin()
    {
        if(isset($_COOKIE['user_email_cookie']))
        {
            if(!$this->DBLogin())
            {
                $this->HandleError("Database login failed!");
                return false;
            }

            $email = $_COOKIE['user_email_cookie'];
            $qry = "Select * from $this->tablename where email='$email'";
            $result = mysql_query($qry,$this->connection);
            
            if(!$result || mysql_num_rows($result) <= 0)
            {
                $this->HandleError("Error logging in.");
                return false;
            }
            
            $row = mysql_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_firstName']  = $row['firstName'];
            $_SESSION['user_lastName']  = $row['lastName'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION['user_email'] = $row['email'];

            return true; 
        }
        else
        {
        	return false;
        }
    }

    function Login()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $loginCheck = $_POST['loginCheck'];
        
        if(!isset($_SESSION))
        {
        	session_start(); 
        }

        if(!$this->CheckLoginInDB($email,$password))
        {
            return false;
        }

        if($loginCheck == "value1")
        {
            setcookie('user_email_cookie', $email, time() + 172800, '/'); // 172800 = 2 days
        }

        return true;
    }

    function RegisterUser()
    {
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserEmail($formvars))
        {
            return false;
        }

        $this->SendAdminEmail($formvars);
        
        return true;
    }

    function LogOut()
    {
        if(isset($_COOKIE['user_email_cookie']))
        {
            setcookie('user_email_cookie', '', time() - 172800, '/');
        }
        else
        {
            session_start();
            
            $sessionvar = $this->GetLoginSessionVar();
        
            $_SESSION[$sessionvar]=NULL;
        
            unset($_SESSION[$sessionvar]);
        }
    }

    function DeleteAccount()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }

        if(empty($_POST['delPassword']))
        {
            $this->HandleError("Password field is empty!");
            return false;
        }
        
        $formvars = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$formvars))
        {
            return false;
        }
        
        $delpwd = trim($_POST['delPassword']);
        
        if(!$this->DeleteAccountInDB($formvars, $delpwd))
        {
            return false;
        }

        if(false == $this->SendDeletedAccount($formvars))
        {
            return false;
        }

        return true;
    }

    function Featured()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $sql = 'SELECT * FROM products WHERE featured = "Y"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Favorites()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $sql = 'SELECT * FROM products WHERE featured = "Y"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Cameras()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $sql = 'SELECT * FROM products WHERE category = "camera"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Microphones()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $sql = 'SELECT * FROM products WHERE category = "microphones"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Headphones()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $sql = 'SELECT * FROM products WHERE category = "headphones"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Software()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        $sql = 'SELECT * FROM products WHERE category = "software"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        }
    }

    function Accessories()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        $sql = 'SELECT * FROM products WHERE category = "accessories"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        } 
    }

    function Audio()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        $sql = 'SELECT * FROM products WHERE package = "audio"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        } 
    }

    function Video()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        $sql = 'SELECT * FROM products WHERE package = "video"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        } 
    }

    function Deluxe()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        $sql = 'SELECT * FROM products WHERE deluxe = "y"';
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            while($row = mysql_fetch_array($result)){
                echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;
            }
        } 
    }

    function focus($res)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   

        $sku = $res;
        $sql = "Select * from products where sku='$sku'";
        $result = mysql_query($sql,$this->connection);
        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            $row = mysql_fetch_assoc($result);

            echo '<div class="col span_2_of_12">'
            ,    '</div>'
            ,    '<div class="col span_4_of_12">'
            ,    '<div class="products">'
            ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
            ,    '</div>'
            ,    '</div>'
            ,    '<div class="col span_4_of_12">'
            ,    '<div class ="productname" id="productname1">' . $row['productname'] . '</div>'
            ,    '<hr>'
            ,    '<div class="products">'
            ,    '<img src="img/5stars.png" height="23" width="99" alt="gopro hero 5 image">'
            ,    '</div>'
            ,    '<div class="products">' . $row['description'] . '</div>'
            ,    '<div class="products">' . $row['sku'] . '</div>'
            ,    '<div class="products">' . $row['stock'] . '</div>'
            ,    '<div class="products">' . $row['price'] . '</div>'
            ,    '<div class="products">'
            ,    '<a href="#"><button type="button">ADD TO CART</button></a>'
            ,    '</div>'
            ,    '</div>'
            ,    '<div class="col span_2_of_12">'
            ,    '</div>'
            ;
        }    
    }

    
	function search($query){
		if(!$this->DBLogin())
            {
                $this->HandleError("Database login failed!");
                return false;
            }

		$min_length = 2;
		// you can set minimum length of the query if you want
     
		if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
			
			$query = htmlspecialchars($query); 
			// changes characters used in html to their equivalents, for example: < to &gt;
         
			$query = mysql_real_escape_string($query);
			// makes sure nobody uses SQL injection
         
			$raw_results = mysql_query("SELECT * FROM products
				WHERE (`productname` LIKE '%".$query."%') OR (`description` LIKE '%".$query."%')") or die(mysql_error());
             
			// * means that it selects all fields, you can also write: `id`, `title`, `text`
         
			// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
			// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
			// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
			
			if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
				while($row = mysql_fetch_array($raw_results)){
				// $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

                    echo '<div class="col span_4_of_12">'
                ,    '<div class="products">'
                ,    '<a href="singleproduct.php?search=' . $row["sku"] . '">'
                ,    '<img src="' . $row['image'] . '" height="280" width="280" alt="' . $row['sku'] . '">'
                ,    '</a>'
                ,    '</div>'
                ,    '<div class ="productname" id="productname"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['productname'] . '</a></div>'
                ,    '<div class ="productprice" id="productcat"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['category'] . '</a></div>'
                ,    '<div class ="productprice" id="productprice"><a href="singleproduct.php?search=' . $row["sku"] . '">' . $row['price'] . '</a></div>'
                ,    '</div>'
                ;

				}
             
			}
			else{ // if there is no matching rows do following
				echo '<div class="col span_4_of_12">'
            ,     '<p>No results</p>'
            ,     '</div>';
			}
         
		}
		else{ // if query length is less than minimum
			echo "Minimum length is ".$min_length;
		}
	}
	
	

    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function DBLogin()
    {
        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }

    function CheckLoginInDB($email,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        } 

        $qry = "Select * from $this->tablename where email='$email' and password='$password'";
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The email or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_firstName']  = $row['firstName'];
        $_SESSION['user_lastName']  = $row['lastName'];
        $_SESSION['user_password'] = $row['password'];
        $_SESSION['user_email'] = $row['email'];
        
        return true;
    }

    function ValidateRegistrationSubmission()
    {
        $validator = new FormValidator();
        $validator->addValidation("firstName","req","Please fill in your first name");
        $validator->addValidation("lastName","req","Please fill in your last name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("password","req","Please fill in Password");
        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['firstName'] = $_POST['firstName'];
        $formvars['lastName'] = $_POST['lastName'];
        $formvars['email'] = $_POST['email'];
        $formvars['password'] = $_POST['password'];
    }

    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }

        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
             
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }

        return true;
    }

    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $formvars[$fieldname];
        $qry = "select email from $this->tablename where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }

        return true;
    }

    function InsertIntoDB(&$formvars)
    {
        $insert_query = 
        	'insert into '.$this->tablename.'(
                firstName,
                lastName,
                email,
                password,
                access
            )
            values(
            "' . $formvars['firstName'] . '",
            "' . $formvars['lastName'] . '",
            "' . $formvars['email'] . '",
            "' . $formvars['password'] . '",
            "customer"
            )';

        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        

        return true;
    }

    function SendUserEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['firstName'],$formvars['lastName']);
        
        $mailer->Subject = "Welcome to Stream Alley!";

        $mailer->From = "Stream Alley";        
        
        $mailer->Body ="Hello ".$formvars['firstName']."\r\n\r\n".
        "Welcome! Your registration with Stream Alley is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Stream Alley Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$formvars['firstName']." ".$formvars['lastName'];

        $mailer->From = "Stream Alley";         
        
        $mailer->Body ="A new user registered with Stream Alley"."\r\n".
        "Name: ".$formvars['firstName']." ".$formvars['lastName']."\r\n".
        "Email address: ".$formvars['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

    function DeleteAccountInDB($formvars, $delpwd)
    {
        $email = $formvars['email'];

        if($delpwd != $formvars['password'])
        {
            $this->HandleDBError("Password does not match!");
            return false;
        }
        
        $qry = "Delete From $this->tablename where email='$email'";
        
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }

    function SendDeletedAccount($formvars)
    {
        $email = $formvars['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$formvars['firstName'],$formvars['lastName']);
        
        $mailer->Subject = "Your Account for Stream Alley has been Deleted";

        $mailer->From = "Stream Alley";
        
        $mailer->Body ="Hello ".$formvars['firstName']."\r\n\r\n".
        "Your profile with Stream Alley has been deleted. \r\n".
        "We hope you consider joining us again soon. \r\n".
        "\r\n".
        "Regards,\r\n".
        "The Stream Alley Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }  
}
?>