<?php
/**
* RssBridgeAnimeUltime
* Returns Anime-Ultime's newest strips
*
* @name Anime-Ultime
* @homepage http://www.anime-ultime.net/index-0-1
* @description Returns Anime-Ultime's newest releases
* @maintainer Liandri
* @update 2015-02-01
*/
class AnimeUltimeBridge extends BridgeAbstract{
    
	private $request;
    
	public function collectData(array $param){
		$html = '';
        $html = file_get_html('http://www.anime-ultime.net/index-0-1') or $this->returnError('Nope.', 404);
		$table = $html->find('table.jtable tbody', 0);
		
		$i = 0;
		foreach ($table->find('tr') as $tab)
		{
		
		if ($i > 0){
			$item = new \Item();
			$item->name = 'Anime-Ultime';
			$item->title = $tab->find('td', 1)->find('a', 0)->getAttribute('innertext') . ' - ' . $tab->find('td', 2)->plaintext . ' [' . $tab->find('td', 4)->plaintext . ']';
			$item->content = $tab->find('td', 1)->find('a', 0)->getAttribute('innertext') . ' - ' . $tab->find('td', 2)->plaintext . ' [' . $tab->find('td', 4)->plaintext . ']';
			$item->id = 'http://www.anime-ultime.net/' . $tab->find('td', 1)->find('a', 0)->getAttribute('href');
			$item->uri = 'http://www.anime-ultime.net/' . $tab->find('td', 1)->find('a', 0)->getAttribute('href');
			$this->items[] = $item;
			}
		$i++;
		}
    }
	public function getName(){
		return 'Anime-Ultime';
	}

	public function getURI(){
		return 'http://www.anime-ultime.net/index-0-1';
	}

	public function getCacheDuration(){
		return 3600; // 1 hour
	}
}
