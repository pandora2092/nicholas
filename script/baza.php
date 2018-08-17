<?$link = @mysql_pconnect('localhost','root', ''); 
if ($link) { 
    mysql_select_db('archive'); 
} else { 
    exit("Unable to connect to database.  Please try again later.\n"); 
}  

 
$data=file('box.csv'); 
if (is_array($data)) 
  { 
   foreach ($data as $string) 
      { 
       $temp=explode("|", $string); 
       $query="INSERT INTO `list` SET name='$temp[0]',code='$temp[1]',manuscript='$temp[2]',info='$temp[3]',bibliography='$temp[4]'"; 
       $result=mysql_query($query); 
      } 
   } 
?> 

