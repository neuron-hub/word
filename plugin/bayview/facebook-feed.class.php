<?php
  /* File:       uki_facebook_wall_feed_v0.9.php
     Version:    0.9
     Author:     Fedil Grogan
     Date:       06/23/2011
     Copyright:  Fedil Grogan 2011
     Purpose:
     This is a class for grabbing facebook status updates and posting them on
     your own personal website. Please feel free to use as you wish. I do ask
     that you at least credit me since it is my work. Also donations are
     appreciated if you find good use for my code. You can send donations
     to ukneeqfng@aol.com on paypal.com.
  */

  class uki_facebook_wall_feed
  {
    private $fbID;
    private $fbWallFeed;
    private $appSecret;
    private $appID;
    private $count;

    function __construct($id, $appID, $appSecret, $count)
    {
      $this->fbID = $id;
      $this->appID = $appID;
      $this->appSecret = $appSecret;
      $this->count = $count;
      
      //echo "Initializing (" . $this->fbID . ")...<br />";
    }
    function get_fb_wall_feed()
    {
        //echo "Contacting FaceBook...<br />";
      $id = $this->fbID;
      $secret = $this->appSecret;
      $clientID = $this->appID;
      $count = $this->count;

      // Make call to get authentication token
      $token_url = "https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id=$clientID&client_secret=$secret";
      $cht = curl_init();
      curl_setopt($cht, CURLOPT_URL, $token_url);
      curl_setopt($cht, CURLOPT_RETURNTRANSFER, 1);
      $token = curl_exec($cht);
      curl_close($cht);
      
      // Now make call to get the wall feed
      $url = 'https://graph.facebook.com/'.$id.'/posts?limit='.$count.'0&'.$token;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $this->fbWallFeed = json_decode(curl_exec($ch), true);
      curl_close($ch);
      
    }
    function display_fb_wall_feed()
    {
      $fbFeed = $this->fbWallFeed["data"];
      echo "
        <div class=\"br-mid-title\">
            <div class=\"fb-tag\">
                <img src='".get_template_directory_uri()."/images/fb-tag.png' alt=''/>
            </div>
            <div class='br-mid-span'>
                <a href='https://www.facebook.com/".$this->fbID."' title='Bayview wildwood'>View All</a>
            </div>
          <div class=\"social-list\">";
      echo '<ul>';
      for ($i = 0; $i < count($fbFeed); $i++)
      {
        
          $fbMsg = (isset($fbFeed[$i]["message"]) ? $fbFeed[$i]["message"] :  $fbFeed[$i]["story"]);
          $fbMsg = strip_tags(html_entity_decode($fbMsg));
          if(strlen($fbMsg) > 40){
            $fbMsg = substr($fbMsg, 0, 40);
            $fbMsg .= '...';
          }
          $fbID = $fbFeed[$i]["from"]["id"];
          $fbName = $fbFeed[$i]["from"]["name"];
          $fbPhoto = "http://graph.facebook.com/$fbID/picture";
          $fbTime = $fbFeed[$i]["created_time"];
          $fbStoryID = $fbFeed[$i]["id"];
          $this->print_fb_post($fbStoryID, $fbPhoto, $fbID, $fbName, $fbMsg, $this->parse_fb_timestamp($fbTime));
        
      }
      echo '</ul>';
      echo "</div>
          </div>";
    }
    function print_fb_post($fbStoryID, $fbPhoto, $fbID, $fbName, $fbMsg, $postTime)
    {
      $commentLink = $this->fb_comment_link($fbStoryID);
      echo "
          <li> 
            <span><a href=\"http://www.facebook.com/profile.php?id=$fbID\"><img src=\"$fbPhoto\" alt=\"Facebook Profile Pic\" /></a></span>
            <div>
            <h4><span>$fbName@ bayview.wildwood</span></h4>
              <p>$fbMsg</p>
              
              <h6><span><img src='".get_template_directory_uri()."/images/icon01.png' alt='' /></span><a href=\"$commentLink\">View Summary</a></h6>
            </div>
          </li>";
    }
    
    function fb_comment_link($fbStoryID)
    {
      $link = "http://www.facebook.com/";
      $splitID = explode("_", $fbStoryID);
      $link .= $splitID[0] . "/posts/" . $splitID[1];
      return $link;
    }
    function parse_fb_timestamp($fbTime)
    {
      $timeStamp = explode("T", $fbTime);
      $dateStr = $timeStamp[0];

      $timeArr = explode(":", $timeStamp[1]);
      $timeHr = $timeArr[0] - 6;
      if ($timeHr < 0)
      {
        $timeHr = 24 + $timeHr;
      }
      $timeStr = $timeHr . ":" . $timeArr[1];

      return "Posted: $timeStr $dateStr";
    }
  }
?>

