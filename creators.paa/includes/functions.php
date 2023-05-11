<?php

//$dbhost = 'localhost';
//$dbusername = 'rentersh_administrator';
//$dbname = 'rentersh_rentershub';
//$dbpass = 'BR$SO-&ruzN$';

$dbhost = 'localhost';
$dbusername = 'root';
$dbname = 'paa';
$dbpass = '';


$link = $ctdb = $conn = new mysqli( $dbhost, $dbusername, $dbpass, $dbname);
if( $conn -> connect_error ) die( $conn -> connect_error);

date_default_timezone_set('Africa/Nairobi');

function queryMysql( $query ) {
	global $conn;
	$result = $conn -> query( $query );
	if ( !$result ) die( $conn -> error );
	return $result;
}
// if($table == "staffke") {
// 		$_SESSION["id"] = $id;
// 	} else if($table == "teachers") {
// 		$_SESSION["teacher_id"] = $id;
// 	} else if($table == "parents") {
// 		$_SESSION["parent_id"] = $id;
// 	} else if($table == "students") {
// 		$_SESSION["student_id"] = $id;
// 	}

function sanitizeString( $var ) {
	global $conn;
	$var = strip_tags( $var );
	$var = htmlentities( $var );
	$var = stripslashes( $var );
	return $conn -> real_escape_string( $var );
}

function clean($var) {
	global $ctdb;
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	return $ctdb -> real_escape_string($var);
}

function destroySession() {
	$_SESSION = array();
	if ( session_id() != "" || isset($_COOKIE[session_name()])) {
		setcookie( session_name(), '', time()-2592000, '/');
	}
	session_destroy();
}

function profileImage( $row_used ) {
	if ( $row_used['profile_img']) {
		$profile_image = "img/user_profile/".$row_used['profile_img'];
	}else{
		$profile_image = "img/icons8_Ninja_Head_96px.png";
	}

	return $profile_image;
}

function messageError($msg, $err){
    if(!empty($err)) echo "<div class='alert alert-warning alert-dismissible mb-10' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>
      <h5 class='alert-heading'>Error</h5>$err</div>";

    if(!empty($msg)) echo "<div class='alert alert-success alert-dismissible mb-10' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>
      <h5 class='alert-heading'>Message</h5>$msg</div>";
}



$rows_c = '';
function pagination($table){
	echo '<div class="row">
			<div class="col-md-10">';

				$limit = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;

				$result_c = queryMysql("SELECT * FROM $table LIMIT $start, $limit");
				$rows_c = $result_c -> fetch_all(MYSQLI_ASSOC);
				define('ROWS_TABLE', $rows_c);

				$result_c = queryMysql("SELECT * FROM $table");
				$total = $result_c -> num_rows;
				$pages = ceil( $total / $limit );

				if($page > 1) $Previous = $page - 1; else $Previous = 1;
				$Next = $page + 1;
				
				echo '<nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="trials.php?page='.$Previous.'" aria-label="Previous">
								<span aria-hidden="true">&laquo; Prev</span>
							</a>
						</li>';
						
						for($i = 1; $i <= $pages; $i++){
							echo '<li class="page-item"><a class="page-link" href="trials.php?page='.$i.'">'.$i.'</a></li>';
						}
						
						echo '<li class="page-item">
							<a class="page-link" href="trials.php?page='.$Next.'" aria-label="Next">
								<span aria-hidden="true">Next &raquo;</span>
							</a>
						</li>
						
					</ul>
					
				</nav>
			</div>
		</div><!-- div row -->';
}


//message api start
                        $shortcode = 'RENTERS_HUB'; // your sender ID
                        $apikey = 'b2e770cf7d98f07bbacd7b6074b0d0f7'; // your API Key
                        $partnerID = '4283'; // your partner ID
	                    function postSms($partnerID, $apikey, $shortcode, $mobile, $message) {
                        $url = 'https://quicksms.advantasms.com/api/services/sendsms/';
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, $url);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header

                        $curl_post_data = array(
                            //Fill in the request parameters with valid values
                            'partnerID' => $partnerID,
                            'apikey' => $apikey,
                            'mobile' => $mobile,
                            'message' => $message,
                            'shortcode' => $shortcode,
                            'pass_type' => 'plain', //bm5 {base64 encode} or plain
                        );
                        
                        // json encode the data
                        $data_string = json_encode($curl_post_data);

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // pass the JSON request body

                        $response = curl_exec($curl);
                        curl_close($curl);

                        return $response;
                    }
                    //message api end

function paginationBtn($url, $prev, $nxt, $pages){

	echo'<div class="row">
			<div class="col-md-10">
				
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="'.$url.'?page='.$prev.'" aria-label="Previous">
								<span aria-hidden="true">&laquo; Prev</span>
							</a>
						</li>';
						
						for($i = 1; $i <= $pages; $i++){
							echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
						}
						
						echo '<li class="page-item">
							<a class="page-link" href="'.$url.'?page='.$nxt.'" aria-label="Next">
								<span aria-hidden="true">Next &raquo;</span>
							</a>
						</li>
						
					</ul>
					
				</nav>
			</div>
		</div><!-- div row -->';

}

function queryMysqlInsert($sql, $data_types, $data_array ){
	global $link;
	if($stmt = $link -> prepare($sql)){
        $stmt -> bind_param( $data_types, ...$data_array);
        if($stmt -> execute()){ 
		//echo "<script>alert('Data Inserted Successfully!'); location.replace('?success'); </script>";
        	return true;

		} else {
		 	echo "Something went wrong. Please try again later."; 
		}
		
		 try {
            echo $stmt -> error;
        	$stmt -> close();
        	$link -> close();
        	
        } catch (Exception $e) {
        	echo $e;
        }

    } 
   
    
   
}

function queryMysqlUpdate($sql, $data_types, $data_array ){
	global $link;
	$stmt = $link->prepare($sql);
	/* BK: always check whether the prepare() succeeded */
	if ($stmt === false) {
		trigger_error($link->error, E_USER_ERROR);
		return;
	}
	//$id = 1;
	/* Bind our params */
	/* BK: variables must be bound in the same order as the params in your SQL.
	* Some people prefer PDO because it supports named parameter. */
	$stmt->bind_param($data_types, ...$data_array);

	/* Set our params */
	/* BK: No need to use escaping when using parameters, in fact, you must not, 
	* because you'll get literal '\' characters in your content. */
	//$content = $_POST['content'] ?: '';

	/* Execute the prepared Statement */
	/* BK: always check whether the execute() succeeded */
	if ($stmt->execute()) {
		return true;
	} else {
		trigger_error($stmt->error, E_USER_ERROR);
	}
	//printf("%d Row inserted.\n", $stmt->affected_rows);
}

function checkName($name, $type){
	$err = "";
	if(empty(trim($name))){
	 	$err = "<b style='color:red;font-size:20px'>*</b>"; 
	} 
	$length = mb_strlen($name);
	if(($length) > 0 && ($length)<=2 ){
		$err.="<b style='color:red; font-size:16px;'>Too short ".$type." !</b><br>"; 
	}
	if(($length) > 30) {
		$err.="<b style='color:red; font-size:16px;'>Too long ".$type."!</b><br>"; 
	}
	if (preg_match('/[^A-Za-z \'\-]/', $name)) {
		$err.="<b style='color:red; font-size:16px;'>Unaccepted characters in  ".$type."!</b><br>"; 
	}
	if (is_numeric($name)){
		$err.="<b style='color:red; font-size:16px;'>Use of numbers in  ".$type."</b><br>"; 
	}
	return $err;
}

function checkPhone($phone_no, $table){
	$err = "";
	if(empty(trim($_POST["phone_no"]))){
		$err .= "<b style='color:red;font-size:20px'>*</b>";  
	}  
		
	$length = mb_strlen($_POST['phone_no']);

	if(($length) > 10 ){
		$err .= "<b style='color:red; font-size:16px;'>".$phone_no." Must be 10 digits!</b><br>"; 
	}
	if(($length) >1 && ($length) < 10){
		$err .= "<b style='color:red; font-size:16px;'>".$phone_no." Must be 10 digits!</b><br>"; 
	}
	if (($length) == 10 && !is_numeric ($_POST['phone_no'])) {
		 $err .= "<b style='color:red; font-size:16px;'>".$phone_no." Only a number allowed!</b><br>"; 
		}
	if (($_POST['phone_no']) < 0) { 
		$err .= "<b style='color:red; font-size:16px;'>".$phone_no." is Invalid number!</b><br>"; 
	}

	$m = clean($_POST["phone_no"]);
	$qry = queryMysql("SELECT * FROM $table WHERE phone_no = '$m'");
	if(mysqli_num_rows($qry) >= 1){ 
		$err = "<b style='color:red;'><br>Mobile number already registered. </b>";
	}

	return $err;
}

?>