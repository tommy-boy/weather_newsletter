<? 
$widgets = App::$config->widgets->$channel->$type;
$i = 0;
foreach($widgets as $key => $value){
	if($i === 0) { $widget = $key; $url = $value; break; }
}
switch($widget){
	case "HeadlinesGeneric":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget->src,'ul li a');
		$subject = sanHTML($subjectsanitize);		
	break;

	case "LawAndOrder":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget->src,'a');
		$subject = sanHTML($subjectsanitize);		
	break;

	case "MainArt":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'div.callout a.headline');
		$subject = sanHTML($subjectsanitize);	
	break;

	case "MainArtBreaking":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'a');
		$subject = sanHTML($subjectsanitize);
	break;
	
	case "MainArtExt":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'ul li a');
		$subject = sanHTML($subjectsanitize);
	break;

	case "MainArtSimple":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'span.title a',$channel);
		$subject = sanHTML($subjectsanitize);
	break;
	
	case "MainArtWeather":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget->src,'a');
		$subject = sanHTML($subjectsanitize);		
	break;
	
	case "MostPopular":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget->src,'a');
		$subject = sanHTML($subjectsanitize);
	break;

	case "Slideshows":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget->src,'a');
		$subject = sanHTML($subjectsanitize);
	break;

	case "Top5":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'a');
		$subject = sanHTML($subjectsanitize);
	break;	
	
	case "HeadlinesPreps":
		$subjectsanitize = Subject::getSubject(self::$config->widgets->$channel->$type->$widget,'span.subject',$channel);
		$subject = sanHTML($subjectsanitize);
	break;
}

?>