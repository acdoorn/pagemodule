<?php namespace Acdoorn\Pagemodule;
use BaseController;
use View;
use Redirect;
use Input;
class FormController extends BaseController {

	public function handleStart() {
		if(Input::get('newdraft')) {
			return $this->createBase();
		}
		elseif (Input::get('existingdraft') && Input::has('draft')) {
			$draftpageid = Input::get('draft')+1;
			return Redirect::to('/CMS/pagemodule/draft/'.$draftpageid.'/general')->with('draftpageid', $draftpageid);
		}
		elseif (Input::get('existingpage') && Input::has('page')) {
			$pageid = Input::get('page')+1;
			return Redirect::to('/CMS/pagemodule/page/'.$pageid.'/general')->with('pageid', $pageid);
		}
		else {
			return Redirect::to('/CMS/pagemodule/');
		}
	}

	public function createBase() {
		$draftpage = new Draftpage;
		$drafturl = new Drafturl;
		$draftseoinfo = new Draftseoinfo;

		$draftseoinfo->save();
		$drafturl->seoinfo_id = $draftseoinfo->id;
		$drafturl->save();
		$draftpage->url_id = $drafturl->id;
		$draftpage->save();
		return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/general')->with('draftpageid', $draftpage->id);
	}

	public function updateDraft($draft_id, $step) {
		switch($step) {
			case 'general':
				$draftpage = Draftpage::find($draft_id);
				$drafturl = $draftpage->drafturl;
				$draftseoinfo = $drafturl->draftseoinfo;
				$draftpage->name = Input::get('name');
				$draftpage->enabled = (Input::has('enabled') ? 1 : 0 );
				$draftpage->template_id = Input::get('template_id');
				if(Input::has('drafturl')) {
					$draftseoinfo->browsertitle = Input::get('drafturl')["draftseoinfo"]["browsertitle"];
					$draftseoinfo->keywords = Input::get('drafturl')["draftseoinfo"]["keywords"];
					$draftseoinfo->description = Input::get('drafturl')["draftseoinfo"]["description"];
					$draftseoinfo->google = Input::get('drafturl')["draftseoinfo"]["google"];
					$draftseoinfo->save();
					$drafturl->url = Input::get('drafturl')["URL"];
					$drafturl->save();
				}
				$draftpage->save();
				return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/general')->with('draftpageid', $draftpage->id);

			break;
			case 'content':
				$draftpage = Draftpage::find($draft_id);
				$template = $draftpage->drafttemplate;
				// var_dump(Input::get('section.0'));

				
				$x = 1;
				foreach($template->draftsections as $section) {
					$input = (INT)Input::get('section'.$x);
					if($input != 0){
						$module = Draftmodule::find($input);
						$fields = $module->draftfields;

		  				if($module->value == 'article') {
		  					$article = new Article;
					  		foreach($fields as $field) {
					  			$order = $field->order;
						  		$fieldtype = $field->draftfieldtype;
						  		$inputname = $field->name.$x;
						  		// var_dump(Input::all());
					  			if(Input::has($inputname) || Input::hasFile($inputname)){
				  					if($order == 1){
					  					$article->title = Input::get($inputname);
					  				}elseif($order == 2){
					  					$article->description = Input::get($inputname);
					  				}elseif($order == 3){
					  					if(Input::hasFile($inputname)){
								  			if(Input::file($inputname)->isValid()){
								  				$destinationPath = 'public/images/uploads/';
								  				$destPathv2= "/images/uploads/";
									  			$file = Input::file($inputname);
									  			$filename = $file->getClientOriginalName();
									  			$file->move($destinationPath, $filename);
									  			//image moven naar public path met $file = $file->move('images/uploads/',  $filename); 
									  			$article->image = $destPathv2.$filename;
									  			// echo '<img src="'.$destPathv2.$filename.'">';
									  		}
									  	}
								  		elseif(Input::has($inputname)) {
									  			$filename = Input::get($inputname);
									  			$article->image = $filename;
								  		}
					  				}
						  		}
					  		}
					  		echo 'Article:<br/>';
		  					$array = $article->getAttributes();
			  				foreach($array as $attribute) {
			  					echo $attribute . '<br/>';
			  				}
			  				if(!is_null($article->image)) {
			  					echo '<img src="'.$article->image.'"><br/>';
			  				}
			  				$article->madeby()->associate($module);
			  				$article->save();
			  				$section->articles()->sync(array($article->id => ['draftpage_id'=>$draftpage->id]));
			  			} elseif($module->value == 'news'){
			  				$news = new News;
					  		foreach($fields as $field) {
					  			$order = $field->order;
						  		$fieldtype = $field->draftfieldtype;
						  		$inputname = $field->name.$x;
					  			if(Input::has($inputname)){
				  					if($order == 1){
					  					$news->title = Input::get($inputname);
					  				}elseif($order == 2){
					  					$news->content = Input::get($inputname);
					  				}
						  		}
					  		}
					  		echo 'News:<br/>';
			  				foreach($news->getAttributes() as $attribute) {
			  					echo $attribute . '<br/>';
			  				}
			  				$news->madeby()->associate($module);
			  				$news->save();
			  				$section->news()->sync(array($news->id => ['draftpage_id'=>$draftpage->id]));
			  			}
					}
					$x++;
				}
				// return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/content')->with('draftpageid', $draftpage->id);
			break;
			case 'menu':

			break;
			case 'summary':

			break;
		}
	}

	public function updatepage($page_id, $step) {
		switch($step) {
			case 'general':
				$page = Page::find($page_id);
				$url = $page->url;
				$seoinfo = $url->seoinfo;
				$page->name(Input::get('name'));
				$page->enabled(Input::get('enabled'));
				$page->template_id(Input::get('template_id'));
				if(Input::has('url[seoinfo][browsertitle]') || Input::has('url[seoinfo][keywords]') || Input::has('url[seoinfo][description]') || Input::has('url[seoinfo][google]')) {
					$seoinfo->browsertitle = Input::get('url[seoinfo][browsertitle]');
					$seoinfo->keywords = Input::get('url[seoinfo][keywords]');
					$seoinfo->description = Input::get('url[seoinfo][description]');
					$seoinfo->google = Input::get('url[seoinfo][google]');
					$seoinfo->save();
				}
				if(Input::has('url[URL]')) {
					$url->url = Input::get('url[URL]');
					$url->save();
				}
				$page->save();
				return Redirect::to('/CMS/pagemodule/page/'.$draftpage->id.'/general')->with('pageid', $page->id);
			break;
			case 'content':

			break;
			case 'menu':

			break;
			case 'summary':

			break;
		}
	}
}
