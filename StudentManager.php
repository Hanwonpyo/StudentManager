<?	
class Student
{
	var $name;
	var $age;
	var $school;
	function __construct($name, $age, $school)
	{
		$this->name=$name;
		$this->age=$age;
		$this->school=$school;	
	}
	function get_name() {
		return $this->name;
	}
	function get_age() {
		return $this->age;
	}
	function get_school() {
		return $this->school;
	}
}
$Menu=$_POST['Menu'];
$Name=$_POST['name'];
$Age=$_POST['age'];
$School=$_POST['school'];\

$S = array(new Student(Name,Age,School));

$fp="input.txt";
$temp;
$null;
if(strcmp($Menu,"Add")==0) {
	$handle = fopen($fp,"a+");
	fwrite($handle, $Name);
	fwrite($handle, " ");
	fwrite($handle, $Age);
	fwrite($handle, " ");
	fwrite($handle, $School);
	fwrite($handle, "@");
	echo("Complete<br>");
}
else if(strcmp($Menu,"Delete")==0) {
	$k=0;
	$handle=fopen($fp,"r");
	while(!feof($handle)) {
		$buffer=fgetc($handle);
		if($buffer=='@') {
			$str=explode(" ",$temp);
			array_push($S,new Student($str[0],$str[1],$str[2]));
			$temp=$null;
		}
		else {
			$temp=$temp.$buffer;
		}
	}
	fclose($handle);
	$handle = fopen($fp,"w+");
	for($i=1;$i<strlen($S);$i++) {
		if(strcmp($Name,$S[$i]->get_name())==0) {
			$k=$i;
			echo "Delete Complete<br>";
			break;
		}
	}
	if($k==0) {
		echo "Delete Fail<br>";
	}
	else {
		for($i=1;$i<strlen($S);$i++) {
			if($k==$i) continue;
			else {
				fwrite($handle,$S[$i]->name);
				fwrite($handle," ");
				fwrite($handle,$S[$i]->age);
				fwrite($handle," ");
				fwrite($handle,$S[$i]->school);
				fwrite($handle,"@");
			}
		}
	}

}

else if(strcmp($Menu,"List")==0) {
	$handle = fopen($fp,"r");
	while(!feof($handle)) {
		$buffer=fgetc($handle);
		$S[$i]->check=1;
		if($buffer=='@') {
			echo "<br>";
		}
		else
			echo $buffer;
	}
}
else if(strcmp($Menu,"Sort")==0) {
	$temp=$null;
	$handle = fopen($fp,"r");
	while(!feof($handle)) {
		$buffer=fgetc($handle);
		if($buffer=='@') {
			$str=explode(" ",$temp);
			array_push($S,new Student($str[0],$str[1],$str[2]));
			$temp=$null;
		}
		else {
			$temp=$temp.$buffer;
		}
	}
	for($i=1;$i<strlen($S);$i++) {
		for($j=$i+1;$j<strlen($S);$j++) {
			if(($S[$i]->name)>($S[$j]->name)) {
				$c=$S[$i]->name;
				$S[$i]->name=$S[$j]->name;
				$S[$j]->name=$c;
				$c=$S[$i]->age;
				$S[$i]->age=$S[$j]->age;
				$S[$j]->age=$c;
				$c=$S[$i]->school;
				$S[$i]->school=$S[$j]->school;
				$S[$j]->school=$c;
			}
		}
	}
	fclose($handle);
	$handle = fopen($fp,"w+");
	for($i=1;$i<strlen($S);$i++) {
		fwrite($handle,$S[$i]->name);
		fwrite($handle," ");
		fwrite($handle,$S[$i]->age);
		fwrite($handle," ");
		fwrite($handle,$S[$i]->school);
		fwrite($handle,"@");
	}
}
else {
	echo "Thank you for using this ^^";
	exit;
}

echo("<br><a href='./menu.html'>Back Page</a>");

?>

