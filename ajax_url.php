<?php 
include "db.php";
extract($_POST);

if(isset($action) && $action=="get_title_and_thumbnail"){
    $str = file_get_contents($url);
    if(strlen($str)>0)
    {
        $str = trim(preg_replace('/\s+/', ' ', $str));
        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); 
        $web_title=$title[1];
        //for image thumbnail
        preg_match('/<img[^>]+>/i',$str, $imgTags); 
        preg_match('/src="([^"]+)/i',$imgTags[0], $imgage);
        
        $ImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
        $img=$ImageSrc;
    }
    if(sizeof($img)!=0){
        $img=implode("",$img);
    }
    if(!empty($url)){
        if($img!==""){
            $insert_data_query="INSERT INTO `sj_url_data` (`Url`,`Webpage_Title`,`Thumnail_Image`) VALUES('$url','$web_title','$img')";
        }else{
            $insert_data_query="INSERT INTO `sj_url_data` (`Url`,`Webpage_Title`) VALUES('$url','$web_title')";
        }
        if(mysqli_query($conn,$insert_data_query)){
            $last_id = mysqli_insert_id($conn); 
            $html="
            <tr>
                <td>$last_id</td>
                <td>$url</td>
                <td>$web_title</td>
                <td>$img</td>
            </tr>
            ";
            echo $html;
        }else{
            echo "Error! Cannot update your data.. Please try again";
        }
        
    }
}
function compress_image($tempPath, $originalPath, $imageQuality){
  
    // Get image info 
    $imgInfo = getimagesize($tempPath); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($tempPath); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($tempPath); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($tempPath); 
            break; 
        default: 
            $image = imagecreatefromjpeg($tempPath); 
    } 
     
    // Save image 
    imagejpeg($image, $originalPath, $quality);    
    // Return compressed image 
    return $originalPath; 
}
?>