<?

//http://2008.gr0w.com/articles/code/php_5_star_rating_system_using_hreview/

// User settings
$rater_ip_voting_restriction = true; // restrict ip address voting (true or false)
$rater_ip_vote_qty=1; // how many times an ip address can vote
$rater_already_rated_msg="You have already rated this item. You were allowed ".$rater_ip_vote_qty." vote(s).";
$rater_not_selected_msg="You have not selected a rating value.";
$rater_thankyou_msg="Thank you for voting.";
$rater_generic_text="this item"; // generic item text
$rater_end_of_line_char="\n"; // may want to change for different operating systems



if(!isset($rater_id)) $rater_id=1;
if(!isset($rater_item_name)) $rater_item_name=$rater_generic_text;


// DO NOT MODIFY BELOW THIS LINE
$rater_filename='ratings/item_'.$rater_id.".rating";
$rater_rating=0;
$rater_stars="";
$rater_stars_txt="";
$rater_rating=0;
$rater_votes=0;
$rater_msg="";

// Rating action
if(isset($_REQUEST["rate".$rater_id])){
 if(isset($_REQUEST["rating_".$rater_id])){
  while(list($key,$val)=each($_REQUEST["rating_".$rater_id])){
   $rater_rating=$val;
  }
  $rater_ip = getenv("REMOTE_ADDR"); 
  $rater_file=fopen($rater_filename,"a+");
  $rater_str="";
  $rater_str = rtrim(fread($rater_file, 1024*8),$rater_end_of_line_char);
  if($rater_str!=""){
   if($rater_ip_voting_restriction){
    $rater_data=explode($rater_end_of_line_char,$rater_str);
	$rater_ip_vote_count=0;
    foreach($rater_data as $d){
	 $rater_tmp=explode("|",$d);
	 $rater_oldip=str_replace($rater_end_of_line_char,"",$rater_tmp[1]);
	 if($rater_ip==$rater_oldip){
	  $rater_ip_vote_count++;
	 }
    }
	if($rater_ip_vote_count > ($rater_ip_vote_qty - 1)){
     $rater_msg=$rater_already_rated_msg;
	}else{
     fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
     $rater_msg=$rater_thankyou_msg;
	}
   }else{
    fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
    $rater_msg=$rater_thankyou_msg;
   }
  }else{
   fwrite($rater_file,$rater_rating."|".$rater_ip.$rater_end_of_line_char);
   $rater_msg=$rater_thankyou_msg;
  }
  fclose($rater_file);
 }else{
  $rater_msg=$rater_not_selected_msg;
 }
}

// Get current rating
if(is_file($rater_filename)){
 $rater_file=fopen($rater_filename,"r");
 $rater_str="";
 $rater_str = fread($rater_file, 1024*8);
 if($rater_str!=""){
  $rater_data=explode($rater_end_of_line_char,$rater_str);
  $rater_votes=count($rater_data)-1;
  $rater_sum=0;
  foreach($rater_data as $d){
   $d=explode("|",$d);
   $rater_sum+=$d[0];
  }
  $rater_rating=number_format(($rater_sum/$rater_votes), 2, '.', '');
 }
 fclose($rater_file);
}else{
 $rater_file=fopen($rater_filename,"w");
 fclose($rater_file);
}

// Assign star image
if ($rater_rating <= 0  ){$rater_stars = "./images/0-star.png";$rater_stars_txt="Not Rated";}
#if ($rater_rating >= 0.5){$rater_stars = "./img/05star.gif";$rater_stars_txt="0.5";}
if ($rater_rating >= 1  ){$rater_stars = "./images/1-star.png";$rater_stars_txt="1";}
#if ($rater_rating >= 1.5){$rater_stars = "./img/15star.gif";$rater_stars_txt="1.5";}
if ($rater_rating >= 2  ){$rater_stars = "./images/2-star.png";$rater_stars_txt="2";}
#if ($rater_rating >= 2.5){$rater_stars = "./img/25star.gif";$rater_stars_txt="2.5";}
if ($rater_rating >= 3  ){$rater_stars = "./images/3-star.png";$rater_stars_txt="3";}
#if ($rater_rating >= 3.5){$rater_stars = "./img/35star.gif";$rater_stars_txt="3.5";}
if ($rater_rating >= 4  ){$rater_stars = "./images/4-star.png";$rater_stars_txt="4";}
#if ($rater_rating >= 4.5){$rater_stars = "./img/45star.gif";$rater_stars_txt="4.5";}
if ($rater_rating >= 5  ){$rater_stars = "./images/5-star.png";$rater_stars_txt="5";}


// Output
echo '<div class="hreview">';
echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'?id='.$row['id'].'">';
echo '<h3 class="item">Rate <span class="fn">'.$rater_item_name.'</span></h3>';
echo '<div>';
echo '<span  class="rating"><img src="'.$rater_stars.'?x='.uniqid((double)microtime()*1000000,1).'" alt="'.$rater_stars_txt.' stars" /><br /> Average rating: '.$rater_stars_txt.'</span> from <span class="reviewcount"> '.$rater_votes.' votes</span>';
echo '</div>';
echo '<div>';
echo '<label for="rate5_'.$rater_id.'"><input type="radio" value="5" name="rating_'.$rater_id.'[]" id="rate5_'.$rater_id.'" />Excellent</label>';
echo '<label for="rate4_'.$rater_id.'"><input type="radio" value="4" name="rating_'.$rater_id.'[]" id="rate4_'.$rater_id.'" />Very Good</label>';
echo '<label for="rate3_'.$rater_id.'"><input type="radio" value="3" name="rating_'.$rater_id.'[]" id="rate3_'.$rater_id.'" />Good</label>';
echo '<label for="rate2_'.$rater_id.'"><input type="radio" value="2" name="rating_'.$rater_id.'[]" id="rate2_'.$rater_id.'" />Fair</label>';
echo '<label for="rate1_'.$rater_id.'"><input type="radio" value="1" name="rating_'.$rater_id.'[]" id="rate1_'.$rater_id.'" />Poor</label>';
echo '<input type="hidden" name="rs_id" value="'.$rater_id.'" />';
echo '<input type="submit" name="rate'.$rater_id.'" value="Rate" />';
echo '</div>';
if($rater_msg!="") echo "<div>".$rater_msg."</div>";
echo '</form>';
echo '</div>';
echo '<br />';

?>

