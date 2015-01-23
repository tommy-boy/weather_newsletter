<?
$subscriber = '';
$url = $_GET['url'];
$request = explode('/',$url);
if(!isset($_GET['subscriber'])){
    $subscriber == NULL;
} elseif(isset($_GET['subscriber']) && $_GET['subscriber'] == '0'){
    $subscriber == FALSE;
} else {
    $subscriber == NULL;
}

$config = array(
	'FA'=>(isset($_GET['FA']) && $_GET['FA'] == '0' ? $_GET['FA'] :1),
	'mode'=>'', // can be development or production
    'subscriber'=>$subscriber,
	'root'=>$_SERVER['DOCUMENT_ROOT'],
	//'www'=>$_SERVER['SERVER_NAME'],
	'www'=>'nocache.azcentral.com',
	'directory'=>'/email/newsletters/',
	'edata'=>array('eAge'=>(isset($_GET['eAge']) ? $_GET['eAge']:30),'eZip'=>(isset($_GET['eZip']) ? $_GET['eZip']:85016),'eGender'=>(isset($_GET['eGender']) ? $_GET['eGender']:'M')),
	'request_method'=>$_SERVER['REQUEST_METHOD'],
	'route'=>array('datatype'=>$request[0],'channel'=>$request[1],'type'=>$request[2]),
	'db'=>array(
			'connection' => 'mysql:host=calcutta.azcentral.com;dbname=digitalmedia',
			'emulatePrepare' => true,
			'username' => 'webuser',
			'password' => 'web*User',
			'charset' => 'utf8',
	),
	
	'options'=>array(
		'breaking'=>array(
			'news'=>array(
                'twitter'=>'azcentral',
                'facebook'=> 'azcentral',
                'title'=> 'Breaking News Now',
				'unsubscribe'=> 'NEW-BREAK',
				'editorialpromo'=> 'news-breaking.inc',
				'ad'=>'news/breaking_newsletter',
			),
			'sports'=>array(
                'twitter'=>'azcsports',
                'facebook'=> 'azcentralsports',
 				'title'=> 'Sports Breaking News',
				'unsubscribe'=> 'SPT-BREAKING',
				'editorialpromo'=> 'sports-breaking.inc',
				'ad'=>'sports/breaking_newsletter',
			
			),
		),
	
		'business'=>array(
			'twitter'=>'azcmoney',
			'facebook'=> 'azcentral',
			'editorialpromo'=> 'business-default.inc',
			'morning'=>array( 
				'title'=> 'Business News Now',
				'unsubscribe'=> 'BIZ-AZ',
				'ad'=>'money/news_newsletter',
			),
			'breaking'=>array( 
				'title'=> 'Breaking business news',
				'unsubscribe'=> '?',
				'ad'=>'money/news_newsletter',
			),
			'realestate'=>array( 
				'title'=> 'Real Estate Now',
				'unsubscribe'=> 'BIZ-AZ',
				'ad'=>'money/realestate_newsletter',
			),
			'noon'=>array( 
				'title'=> 'Daily Business Blast',
				'unsubscribe'=> 'BIZ-AZ',
				'ad'=>'money/news_newsletter',
			),
									
		),

		'community'=>array(
			'twitter'=>'azcentral',
			'facebook'=> 'azcentral',
			'editorialpromo'=> 'community-'.$request[2].'.inc',

			'ahwatukee'=>array( 
				'title'=> 'Ahwatukee News Now',
				'unsubscribe'=> 'NEW-AHWATUKEE',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'chandler'=>array( 
				'title'=> 'Chandler News Now',
				'unsubscribe'=> 'NEW-CHANDLER',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'gilbert'=>array( 
				'title'=> 'Gilbert News Now',
				'unsubscribe'=> 'NEW-GILBERT',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'glendale'=>array( 
				'title'=> 'Glendale News Now',
				'unsubscribe'=> 'NEW-GLENDALE',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'mesa'=>array( 
				'title'=> 'Mesa News Now',
				'unsubscribe'=> 'NEW-MESA',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'peoria'=>array( 
				'title'=> 'Peoria News Now',
				'unsubscribe'=> 'NEW-PEORIA',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'phoenix'=>array( 
				'title'=> 'Phoenix News Now',
				'unsubscribe'=> 'NEW-PHOENIX',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'pinal'=>array( 
				'title'=> 'Pinal County News Now',
				'unsubscribe'=> 'NEW-PINAL',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'scottsdale'=>array( 
				'title'=> 'Scottsdale News Now',
				'unsubscribe'=> 'NEW-NE',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'swvalley'=>array( 
				'title'=> 'SW Valley News Now',
				'unsubscribe'=> 'NEW-SOUTHWEST',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'surprise'=>array( 
				'title'=> 'Surprise News Now',
				'unsubscribe'=> 'NEW-SURPRISE',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
			'tempe'=>array( 
				'title'=> 'Tempe News Now',
				'unsubscribe'=> 'NEW-TEMPE',
				'ad'=>'news/local/communities_'.$request[2].'_newsletter',
			),
		),
		
		'news'=>array(
			'twitter'=>'azcentral',
			'facebook'=> 'azcentral',
				
			'top5'=>array( 
				'title'=> 'Top 5 Morning News',
				'unsubscribe'=> 'Top5',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'top_newsletter',
			),	
			'morning'=>array( 
				'title'=> 'News Now AM',
				'unsubscribe'=> 'NEW-FRONT',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news_morning_newsletter',
			),
			'noon'=>array( 
				'title'=> 'News Now at Noon',
				'unsubscribe'=> 'NEW-NOON',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news_noon_newsletter',
			),				
			'afternoon'=>array( 
				'title'=> 'News Now Afternoon',
				'unsubscribe'=> 'NEW-PM',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news_afternoon_newsletter',
			),
			'evening'=>array( 
				'title'=> 'News Now PM',
				'unsubscribe'=> 'NEW-PM',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news_evening_newsletter',
			),				
			'law'=>array( 
				'title'=> 'Arizona Law & Order',
				'unsubscribe'=> 'NEW-CRIME',
				'editorialpromo'=> 'news-crime.inc',
				'ad'=>'local/courts_law_and_order_newsletter',
			),
			'offbeat'=>array( 
				'title'=> 'Offbeat news',
				'unsubscribe'=> 'NEW-BUZZ',
				'editorialpromo'=> 'news-odd.inc',
				'ad'=>'news/unusual_newsletter',
			),
			'popular'=>array( 
				'title'=> 'Most Popular News',
				'unsubscribe'=> 'NEW-MOSTREAD',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news_mostread_newsletter',
			),
		),
            
        'foodhome'=>array(
			'twitter'=>'dothingsaz',
			'facebook'=> 'azcentral',
			'main'=>array( 
				'title'=> 'Food and Home',
				'unsubscribe'=> 'ENT-FOOD',
				'editorialpromo'=> 'thingstodo-fh.inc',
				'ad'=>'lifestyle/food/news_food_drink_newsletter',
			),
                                      
        ),

		'opinions'=>array(
            'twitter'=>'azcentral',
            'facebook'=> 'azcentral',
			'main'=>array(
				'title'=> 'azcentral opinions',
				'unsubscribe'=> 'NEW-BENSON',
				'editorialpromo'=> 'news-default.inc',
				'ad'=>'news/opinion_newsletter',
			),
		),

		'politics'=>array(
			'twitter'=>'azcinsider',
			'facebook'=> 'azcpolitics',
			'editorialpromo'=> 'politics-default.inc',
			'main'=>array( 
				'title'=> 'azcentral politics',
				'unsubscribe'=> 'NEW-POLITICS',
				'ad'=>'news/politics/local_newsletter',
			),
		),
		
		'slideshows'=>array(
			'top'=>array(
				'twitter'=>'azcentral',
				'facebook'=> 'azcentral',
				'title'=> 'Top slideshows of the week',
				'unsubscribe'=> 'GEN-SLIDESHOWS',
				'editorialpromo'=> 'slideshows-top.inc',
				'ad'=>'news/breaking/gallery_newsletter',
			),
		),		
		
		'sports'=>array(
			'twitter'=>'azcsports',
			'facebook'=> 'azcentralsports',
			'editorialpromo'=> 'sports-default.inc',
			
			'cardinals'=>array(
				'title'=> 'Arizona Cardinals Now',
				'unsubscribe'=> 'SPT-CARDS',
				'ad'=>'sports/football/nfl_cardinals_newsletter',
			),
			'suns'=>array(
				'title'=> 'Phoenix Suns Now',
				'unsubscribe'=> 'SPT-SUNS',
				'ad'=>'sports/basketball/nba_suns_newsletter',
				
			),
			'diamondbacks'=>array( 
				'title'=> 'Diamondbacks Now',
				'unsubscribe'=> 'SPT-DBACKS',
				'ad'=>'sports/baseball/mlb_diamondbacks_newsletter',
			),
			'coyotes'=>array( 
				'title'=> 'Phoenix Coyotes Now',
				'unsubscribe'=> 'SPT-COYOTES',
				'ad'=>'sports/hockey/nhl_coyotes_newsletter',
			
			),
			'asu'=>array( 
				'title'=> 'Sun Devils Now',
				'unsubscribe'=> 'SPT-ASUUPDATE',
				'ad'=>'sports/college/college_asu_newsletter',
			),
			'daily'=>array( 
				'title'=> 'Sports News Now',
				'unsubscribe'=> 'SPT-UPDATE',
				'ad'=>'sports/news_sports_newsletter',
			),
			'cactus'=>array( 
				'title'=> 'Cactus League Now',
				'unsubscribe'=> 'SPT-SPTUPDATE',
				'ad'=>'sports/baseball/mlb_diamondbacks_newsletter',
			),
			'prepsco'=>array( 
				'title'=> 'High School Sports',
				'unsubscribe'=> 'SPT-PREPSCO',
				'ad'=>'sports/highschool/preps_newsletter',
			),
			'prepsad'=>array( 
				'title'=> 'High School Sports',
				'unsubscribe'=> 'SPT-PREPSAD',
				'ad'=>'sports/highschool/preps_newsletter',
			),
		),

		'thingstodo'=>array(	
			'twitter'=>'dothingsaz',
			'facebook'=> 'azcentral',
			'weekend'=>array( 
				'title'=> 'Things to do this weekend',
				'unsubscribe'=> 'ENT-ZONE',
				'editorialpromo'=> 'thingstodo-weekend.inc',
				'ad'=>'lifestyle/events_ttd_newsletter',
			),
			'movies'=>array( 
				'title'=> 'This week in the movies',
				'twitter'=>'goodyk',
				'unsubscribe'=> 'ENT-SCREEN',
				'editorialpromo'=> 'thingstodo-movies.inc',
				'ad'=>'entertainment/movies/news_newsletter',
			),
			'dining'=>array( 
				'title'=> 'Dining with azcentral.com',
				'unsubscribe'=> 'ENT-DINING',
				'editorialpromo'=> 'thingstodo-dining.inc',
				'ad'=>'entertainment/dining_newsletter',
			),
			'celeb'=>array( 
				'twitter'=>'azccelebs',
				'title'=> 'Celebrity News Now',
				'unsubscribe'=> 'ENT-CELEB',
				'editorialpromo'=> 'thingstodo-celeb.inc',
				'ad'=>'entertainment/celebrity_newsletter',
			),
		),
            
        'travel'=>array(
			'twitter'=>'dothingsaz',
			'facebook'=> 'azcentral',

                'exploreaz'=>array(
				'title'=> 'Explore Arizona',
				'unsubscribe'=> 'ENT-CELEB',
				'editorialpromo'=> 'thingstodo-explore.inc',
				//'ad'=>'azcentral.com/newsletter/ent/dining_Flex_static',
			),                    
                ),

		'weather'=>array(
			'twitter'=>'arizona12news',
			'facebook'=> '12news',
			'main'=>array(
				'title'=> '12 News Weather Now',
				'unsubscribe'=> 'NEW-WEA',
				'editorialpromo'=> 'weather-default.inc',
				'ad'=> 'weather/forecasts_newsletter',
			),
		),
			
		'12news'=>array(
			'twitter'=>'arizona12news',
			'facebook'=> '12news',
			'insider'=>array(
				'title'=> '12 News Insider',
				'unsubscribe'=> '12N-Insider ',
				'editorialpromo'=> 'news-default.inc',
				'ad'=> '12news_insider',
			),
		),
		
	),

	'widgets'=>array(
		'breaking'=>array(
			'news'=>array(
				'MainArtBreaking'=>'http://www.azcentral.com/news/incs/newsletter_breakingnews.inc',
					'Blog'=>array(
							'id'=>array(390,380),
							'topper'=>'Columnists',
					),
					'Blog#'=>array(
							'id'=>array(419,385,394),
							'topper'=>'Insiders',
					),
			),
		
			'sports'=>array(
				'MainArtBreaking'=>'http://www.azcentral.com/news/incs/newsletter_breakingsports.inc',
					'Blog'=>array(
							'id'=>array(390,380),
							'topper'=>'Columnists',
					),
					'Blog#'=>array(
							'id'=>array(419,385,394),
							'topper'=>'Insiders',
					),
			),
		),
	
		'business'=>array(
			'noon'=>array(
				'MainArt'=>'http://www.azcentral.com/business/incs/business-top-media.inc',
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/business/incs/business-top-media.inc', 
					'src2'=>'http://www.azcentral.com/business/incs/business-rightrail-container.inc'
				),	
				/*'Blog'=>array(
					'id'=>array(391),
					'topper'=>'Business Insider',
				),*/
				'HeadlinesGeneric'=>array(
					'topper'=>'Consumer/Tech News',
					'src' =>'http://www.azcentral.com/business/incs/business-subsections-consumer.inc',
					'index'=>0,
					'number'=>5,
					'more'=>array(
						'url'=>'http://www.azcentral.com/business/consumer/more_business_consumer.html',
						'message'=>'More Consumer/Tech News',
						),
				),
			),
			'morning'=>array(
				'MainArt'=>'http://www.azcentral.com/business/incs/business-top-media.inc',
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/business/incs/business-top-media.inc', 
					'src2'=>'http://www.azcentral.com/business/incs/business-rightrail-container.inc'
				),
				/*'Blog'=>array(
					'id'=>array(391),
					'topper'=>'Business Insider',
				),*/
				'HeadlinesGeneric'=>array(
					'topper'=>'National & World News',
					'src' =>'http://www.azcentral.com/business/incs/business-rightrail-container.inc',
					'index'=>1,
					'number'=>5,
					'more'=>array(
						'url'=>'http://www.azcentral.com/business/more_worldeconomy.html',
						'message'=>'Read more national & world news',
					),
				),
			),
			'realestate'=>array(
				'HeadlinesGeneric'=>array(
					'topper'=>'Real Estate Headlines',
					'src' =>'http://www.azcentral.com/business/incs/business-voices-container.inc',
					'index'=>0,
					'number'=>5,
					'more'=>array(
						'url'=>'http://www.azcentral.com/business/realestate/realestate_more.html',
						'message'=>'More Real Estate News',
						),
				),
				'Blog'=>array(
					'id'=>array(389),
					'topper'=>'Business Insider',
				),

			),
		),

		'community'=>array(
			'phoenix'=>array(
				'MainArt'=>'http://www.azcentral.com/community/phoenix/incs/phoenix-top-media.inc',
				'Blog'=>array(
					'id'=>array(412),
					'topper'=>'Opinions',
				),
				'Blog#'=>array(
					'id'=>array(420),
					'topper'=>'Insider',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/phoenix/incs/phoenix-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/phoenix/incs/phoenix-top12.inc'
				),			
			),
			
			'ahwatukee'=>array(
				'MainArt'=>'http://www.azcentral.com/community/ahwatukee/incs/ahwatukee-top-media.inc',
				'Blog'=>array(
					'id'=>array(412),
					'topper'=>'Opinions',
				),
				'Blog#'=>array(
					'id'=>array(420),
					'topper'=>'Insider',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/ahwatukee/incs/ahwatukee-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/ahwatukee/incs/ahwatukee-top12.inc'
				),			
			),
			
			'chandler'=>array(
				'MainArt'=>'http://www.azcentral.com/community/chandler/incs/chandler-top-media.inc',
				'Blog'=>array(
					'id'=>array(405),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/chandler/incs/chandler-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/chandler/incs/chandler-top12.inc'
				),			
			),

			'gilbert'=>array(
				'MainArt'=>'http://www.azcentral.com/community/gilbert/incs/gilbert-top-media.inc',
				'Blog'=>array(
					'id'=>array(405),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/gilbert/incs/gilbert-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/gilbert/incs/gilbert-top12.inc'
				),			
			),

			'glendale'=>array(
				'MainArt'=>'http://www.azcentral.com/community/glendale/incs/glendale-top-media.inc',
				'Blog'=>array(
					'id'=>array(424),
					'topper'=>'Insider',
				),
				'Blog#'=>array(
					'id'=>array(400),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/glendale/incs/glendale-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/glendale/incs/glendale-top12.inc'
				),			
			),

			'mesa'=>array(
				'MainArt'=>'http://www.azcentral.com/community/mesa/incs/mesa-top-media.inc',
				'Blog'=>array(
					'id'=>array(405),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/mesa/incs/mesa-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/mesa/incs/mesa-top12.inc'
				),			
			),


			'peoria'=>array(
				'MainArt'=>'http://www.azcentral.com/community/peoria/incs/peoria-top-media.inc',
				'Blog'=>array(
					'id'=>array(424),
					'topper'=>'Insider',
				),
				'Blog#'=>array(
					'id'=>array(400),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/peoria/incs/peoria-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/peoria/incs/peoria-top12.inc'
				),			
			),

			'pinal'=>array(
				'MainArt'=>'http://www.azcentral.com/community/pinal/incs/pinal-top-media.inc',
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/pinal/incs/pinal-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/pinal/incs/pinal-top12.inc'
				),			
			),

			'scottsdale'=>array(
				'MainArt'=>'http://www.azcentral.com/community/scottsdale/incs/scottsdale-top-media.inc',
				'Blog'=>array(
					'id'=>array(401),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/scottsdale/incs/scottsdale-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/scottsdale/incs/scottsdale-top12.inc'
				),			
			),

			'swvalley'=>array(
				'MainArt'=>'http://www.azcentral.com/community/swvalley/incs/swvalley-top-media.inc',
				'Blog'=>array(
					'id'=>array(424),
					'topper'=>'Insider',
				),
				'Blog#'=>array(
					'id'=>array(400),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/swvalley/incs/swvalley-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/swvalley/incs/swvalley-top12.inc'
				),			
			),

			'surprise'=>array(
				'MainArt'=>'http://www.azcentral.com/community/surprise/incs/surprise-top-media.inc',
				'Blog'=>array(
					'id'=>array(424),
					'topper'=>'Insider',
				),
				'Blog#'=>array(
					'id'=>array(400),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/surprise/incs/surprise-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/surprise/incs/surprise-top12.inc'
				),			
			),

			'tempe'=>array(
				'MainArt'=>'http://www.azcentral.com/community/tempe/incs/tempe-top-media.inc',
				'Blog'=>array(
					'id'=>array(405),
					'topper'=>'Opinions',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/community/tempe/incs/tempe-top-media.inc', 
					'src2'=>'http://www.azcentral.com/community/tempe/incs/tempe-top12.inc'
				),			
			),


		),
            
        'foodhome'=>array(
               'main'=>array(
                       'MainArtExt'=>'http://www.azcentral.com/hfe/incs/fh-topstories.inc',
               ),                           
        ),

		'news'=>array(
			'morning'=>array(
				'MainArt'=>'http://www.azcentral.com/news/incs/news-top-media.inc',
				'Blog'=>array(
					'id'=>array(390,380),
					'topper'=>'columnists',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/news/incs/news-top-media.inc', 
					'src2'=>'http://www.azcentral.com/news/incs/news-sections-rightrail-more.inc'
				),			
			),
			'noon'=>array(
				'MainArt'=>'http://www.azcentral.com/news/incs/news-top-media.inc',
				'Blog'=>array(
					'id'=>array(390,380),
					'topper'=>'columnists',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/news/incs/news-top-media.inc', 
					'src2'=>'http://www.azcentral.com/news/incs/news-sections-rightrail-more.inc'
				),			
			),
			'afternoon'=>array(
				'MainArt'=>'http://www.azcentral.com/news/incs/news-top-media.inc',
				'Blog'=>array(
					'id'=>array(390,380),
					'topper'=>'columnists',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/news/incs/news-top-media.inc', 
					'src2'=>'http://www.azcentral.com/news/incs/news-sections-rightrail-more.inc'
				),			
			),
			'evening'=>array(
				'MainArt'=>'http://www.azcentral.com/news/incs/news-top-media.inc',
				'Blog'=>array(
					'id'=>array(390,380),
					'topper'=>'columnists',
				),
				'Headlines'=>array(
					'src1'=>'http://www.azcentral.com/news/incs/news-top-media.inc', 
					'src2'=>'http://www.azcentral.com/news/incs/news-sections-rightrail-more.inc'
				),			
			),
			
			'top5'=>array(
				'Top5'=>'http://www.azcentral.com/ic-projects/incs/newsletter-news-top5.inc',
				'Blog'=>array(
					'id'=>array(390,380),
					'topper'=>'Columnists',
				),
				'Blog#'=>array(
					'id'=>array(419,385,394),
					'topper'=>'Insiders',
				),
				
			),
			'law'=>array(
				'LawAndOrder'=>array(
					'src'=>'http://www.azcentral.com/news/incs/newsletter_lawandorder.inc',
					'topper'=>'Law & Order Top Stories',
					)
			),
			'offbeat'=>array(
				'HeadlinesGeneric'=>array(
					'topper'=>'Would you believe ...',
					'src' =>'http://www.azcentral.com/offbeat/incs/offbeat16.inc',
					'index'=>0,
					'number'=>10,
					'more'=>array(
						'url'=>'http://www.azcentral.com/offbeat/',
						'message'=>'More Offbeat News',
						),
				),
			),
			'popular'=>array(
				'MostPopular'=>array(
					'src'=>'http://www.azcentral.com/generated/top10-news.inc',
					'number'=>'10',
				)
			),
		),
		
		'opinions'=>array(
			'main'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/opinions/incs/opinions-showcase.inc',
				'Blog'=>array(
					'id'=>array(390,380,384,383,388),
					'topper'=>'Columnists',
				),

				'HeadlinesMainArt'=>array(
					'src1'=>'http://www.azcentral.com/opinions/incs/opinions-showcase.inc',
					'topper'=>'More opinions',
				),
				
				'Benson'=>array(
					'src'=>'http://www.azcentral.com/ic-projects/incs/ic-opinions-benson-mainimg.inc',
				),
				
				'HeadlinesGeneric'=>array(
					'topper'=>'Letters to the editor',
					'src' =>'http://www.azcentral.com/opinions/incs/opinions-editorial.inc',
					'index'=>1,
					'number'=>6,
					'more'=>array(
						'url'=>'http://www.azcentral.com/arizonarepublic/opinions/sendaletter.html',
						'message'=>'Send Us A letter',
					),
				),
			),
		),

		'politics'=>array(
			'main'=>array(
				'MainArt'=>'http://www.azcentral.com/ic-projects/incs/news-politics-topcontent.inc',
				'Blog'=>array(
					'id'=>array(386,419,387),
					'topper'=>'Insiders',
				),

				'HeadlinesPolitics'=>array(
					'src1'=>'http://www.azcentral.com/ic-projects/incs/news-politics-topcontent.inc', 
					'src2'=>'http://www.azcentral.com/ic-projects/incs/news-politics-middlecontent.inc',
					'src3'=>'http://www.azcentral.com/ic-projects/incs/news-politics-arizona.inc'
				),			
			
			),
		),
		
		'slideshows'=>array(
			'top'=>array(
				'Slideshows'=>array(
					'topper'=>'More slideshows',
					'src' =>'http://www.azcentral.com/news/incs/newsletter_topslideshows.inc',
					'more'=>array(
						'url'=>'http://www.azcentral.com/photo/',
						'message'=>'View all azcentral slideshows',
					),
				),
				'Blog'=>array(
					'id'=>array(425),
					'topper'=>'Behind the Lens',
				),
			),
			
		),
		
		'sports'=>array(
			'asu'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/sports/asu/incs/sports-asu-showcase.inc',
				'HeadlinesSports'=>array(
					'src1'=>'http://www.azcentral.com/sports/asu/incs/sports-asu-showcase.inc',
					'src2'=>'http://www.azcentral.com/sports/asu/incs/sports-asu-topright.inc',
					'more'=>'http://www.azcentral.com/sports/asu/more_asu_sports.html',
					),
				'Blog'=>array(
					'id'=>array(393),
					'topper'=>'ASU Insider',
				),

				'UpNext'=>'NULL',
			),
			'cardinals'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/sports/cardinals/incs/sports-cardinals-showcase.inc',
				'HeadlinesSports'=>array(
					'src1'=>'http://www.azcentral.com/sports/cardinals/incs/sports-cardinals-showcase.inc',
					'src2'=>'http://www.azcentral.com/sports/cardinals/incs/sports-cards-topright.inc',
					'more'=>'http://www.azcentral.com/sports/cardinals/more_cards_sports.html',
				),
				'Blog'=>array(
					'id'=>array(399),
					'topper'=>'Cardinals Insider',
				),

				'UpNext'=>'NULL',
			),
			'coyotes'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/sports/coyotes/incs/sports-coyotes-showcase.inc',
				'HeadlinesSports'=>array(
					'src1'=>'http://www.azcentral.com/sports/coyotes/incs/sports-coyotes-showcase.inc',
					'src2'=>'http://www.azcentral.com/sports/coyotes/incs/sports-coyotes-topright.inc',
					'more'=>'http://www.azcentral.com/sports/coyotes/more_coyotes_sports.html',
				),
				'Blog'=>array(
					'id'=>array(426),
					'topper'=>'Coyotes Insider',
				),
				'UpNext'=>'NULL',
			),
			'daily'=>array(
				'MainArtExt'=>'http://www.azcentral.com/sports/incs/sports-topstories.inc',
			),
			'diamondbacks'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/sports/diamondbacks/incs/sports-dbacks-showcase.inc',
				'HeadlinesSports'=>array(
					'src1'=>'http://www.azcentral.com/sports/diamondbacks/incs/sports-dbacks-showcase.inc',
					'src2'=>'http://www.azcentral.com/sports/diamondbacks/incs/sports-dbacks-topright.inc',
					'more'=>'http://www.azcentral.com/sports/diamondbacks/more_dbacks_sports.html',
				),
				'Blog'=>array(
					'id'=>array(396),
					'topper'=>'Dbacks Insider',
				),
				'UpNext'=>'NULL',
			),
			'suns'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/sports/suns/incs/sports-suns-showcase.inc',
				'HeadlinesSports'=>array(
					'src1'=>'http://www.azcentral.com/sports/suns/incs/sports-suns-showcase.inc',
					'src2'=>'http://www.azcentral.com/sports/suns/incs/sports-suns-topright.inc',
					'more'=>'http://www.azcentral.com/sports/suns/more_suns_sports.html',
				),
				'Blog'=>array(
					'id'=>array(397),
					'topper'=>'Suns Insider',
				),
				'UpNext'=>'NULL',
			),
			'prepsco'=>array(
			    'HeadlinesPreps'=>'http://www.azcentral.com/sports/preps/incs/newsletter-sports-highschool-coaches.inc',
				'HighSchoolSports'=>'http://www.azcentral.com/sports/preps/incs/newsletter-sports-highschool.inc',
			),
			'prepsad'=>array(
			    'HeadlinesPreps'=>'http://www.azcentral.com/sports/preps/incs/newsletter-sports-highschool-athdirs.inc',
				'HighSchoolSports'=>'http://www.azcentral.com/sports/preps/incs/newsletter-sports-highschool.inc',
			),
			
		),

		'thingstodo'=>array(
            'celeb'=>array(
			'MainArtExt'=>'http://www.azcentral.com/thingstodo/celeb/incs/ttd-celeb-showcase.inc',
             	'Hotlists'=>array(
                	'src'=>"http://www.azcentral.com/thingstodo/celeb/incs/ttd-celeb-ent.inc",
                    'title'=>'Photos & Video',
                )
            ),
                                        
			'dining'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/thingstodo/dining/incs/ttd-dining-showcase.inc',
				'HeadlinesGeneric'=>array(
					'topper'=>'More Dining Reviews',
					'src' =>'http://www.azcentral.com/thingstodo/dining/incs/ttd-dining-subsections.inc',
					'index'=>'0',
					'number'=>'5',
					'more'=>array(
						'url'=>'http://www.azcentral.com/thingstodo/dining/more-reviews.html',
						'message'=>'Read More Reviews',
						),
				),
				'HeadlinesMainArt'=>array(
					'src1'=>'http://www.azcentral.com/thingstodo/dining/incs/ttd-dining-showcase.inc',
					'topper'=>'More Dining News',
				),
				'Hotlists'=>array(
					'src'=>'http://www.azcentral.com/thingstodo/dining/incs/ttd-dining-ent.inc',
					'title'=>'Dining Hotlists',
				),			
			),
			
			'movies'=>array(
				'MainArtSimple'=>'http://www.azcentral.com/thingstodo/movies/incs/ttd-movies-showcase.inc',
				'Blog'=>array(
					'id'=>array(392),
					'topper'=>'Goodykoontz on Movies',
				),
				'HeadlinesGeneric'=>array(
					'topper'=>'More Reviews',
					'src' =>'http://www.azcentral.com/thingstodo/movies/incs/ttd-movies-subsections.inc',
					'index'=>0,
					'number'=>5,
					'more'=>array(
						'url'=>'http://www.azcentral.com/thingstodo/movies/more-reviews.html',
						'message'=>'Read More Reviews',
					),
				),
				'HeadlinesMainArt'=>array(
					'src1'=>'http://www.azcentral.com/thingstodo/movies/incs/ttd-movies-showcase.inc',
					'topper'=>'More Movie News',
				),
				'Hotlists'=>array(
					'src'=>'http://www.azcentral.com/thingstodo/movies/incs/ttd-movies-ent.inc',
					'title'=>'Movie Hotlists',
				),			
			),
                        
            'weekend'=>array(
                  'MainArtExt'=>'http://www.azcentral.com/thingstodo/incs/ttd-home-showcase.inc',
                            
             ),
	
		),
            
        'travel'=>array(
          'exploreaz'=>array(
			'MainArtExt'=>'http://www.azcentral.com/travel/incs/travel-topstories.inc',
			'Blog'=>array(
             	'id'=>array(431),
                'topper'=>'Now Departing',
				),
           ),                    
        ),
		
		'weather'=>array(
			'main'=>array(
				'MainArtWeather'=>array(
					'src'=>'http://nocache.azcentral.com/weather/generated/v8_weatherforecast.inc',
				),
			),
		),
		
		'12news'=>array(
            'insider'=>array(
                'MainArt'=>'http://nocache.azcentral.com/12news/insider/incs/12news-insider-mainart.inc',				
				'HeadlinesInsider'=>array(
					'src'=>'http://nocache.azcentral.com/rss/feeds/fullaccess/12news-insider.inc',
					'topper'=>'Community Focus',
					'index'=>0,
					'number'=>5,
					'more'=>array(
						'url'=>'http://www.azcentral.com/12-news/community/',
						'message'=>'More community focus',
					),
					
				),
				
				'HeadlinesHighlights'=>array(
					'src'=>'http://nocache.azcentral.com/12news/insider/incs/12news-highlights-temp.inc',
					'topper'=>'Programming Highlights',
					'index'=>0,
					'number'=>1,
					'more'=>array(
						'url'=>'http://www.azcentral.com/story/news/12-news/2014/04/07/12news-tv-listings/7438523/',
						'message'=>"What's on TV?",
					),
					
				),              
           		
			),	                           
        ),
	),
);

require_once($config['root'].$config['directory'].'classes/simple_html_dom.php');
require_once($config['root'].$config['directory'].'classes/App.php');

?>

