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
			// CMS/pagemodule/draft/{$draft_id}/general
			case 'general':
				return $this->handleGeneral($draft_id);
			break;
			// CMS/pagemodule/draft/{$draft_id}/content
			case 'content':
				return $this->handleContent($draft_id);
			break;
			// CMS/pagemodule/draft/{$draft_id}/menu
			case 'menu':
				return $this->handleMenu($draft_id);
			break;
			// CMS/pagemodule/draft/{$draft_id}/summary
			case 'summary':
			 	$article = Article::find(1);
			 	$article->delete();
			// No function yet
			break;
		}
	}

	public function updatepage($page_id, $step) {
		switch($step) {
			case 'general':
			// Outdated example for page update function:
			/*
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
				*/
			break;
			case 'content':

			break;
			case 'menu':

			break;
			case 'summary':

			break;
		}
	}


	// CMS/pagemodule/draft/{$draft_id}/general
	protected function handleGeneral($draft_id) {
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
	}

	// CMS/pagemodule/draft/{$draft_id}/content
	protected function handleContent($draft_id) {
		$draftpage = Draftpage::find($draft_id);
		$template = $draftpage->drafttemplate;
		$x = 1;
		foreach($template->draftsections as $section) {
			echo $x;
			$data = Input::all();
			$input = Input::get('section'.$x);
			if($input != 0){
				if($module = Draftmodule::find($input)) {
					$fields = $module->draftfields;
					$contenttemplate = Draftcontenttemplate::find((INT)Input::get('contenttemplates'.$x));
					switch($module->value) {
						// For all modules a case:
						case 'article':
							if(Input::has('article_id'.$x)) {
								$article = Article::find(Input::get('article_id'.$x));
							}else {
								$article = new Article;									
							}
							foreach($fields as $field) {
								$order = $field->order;
								$fieldtype = $field->draftfieldtype;
								$inputname = $field->name.$x;
								if(Input::has($inputname) || Input::hasFile($inputname)){
									if($order == 1){
										$article->name = Input::get($inputname);
									}elseif($order == 2){
										$article->description = Input::get($inputname);
									}elseif($order == 3){
										if(Input::hasFile($inputname)){
											if(Input::file($inputname)->isValid()){
												if(getimagesize(Input::file($inputname))) {
													$destinationPath = 'public/images/uploads/';
													$destPathv2= "/images/uploads/";
													$file = Input::file($inputname);
													$filename = $file->getClientOriginalName();
													$file->move($destinationPath, $filename);
										  			// Image moven naar public path met $file = $file->move('images/uploads/',  $filename); 
													$article->image = $destPathv2.$filename;
												}
											}
										}
										elseif(Input::has($inputname)) {
											$filename = Input::get($inputname);
											$article->image = $filename;
										}
									}
								}
							}
							/* Uncomment for testing creating articleobject */
					  		// echo 'Article:<br/>';
		  					// $array = $article->getAttributes();
			  				// foreach($array as $attribute) {
			  				// 	echo $attribute . '<br/>';
			  				// }

							if(!is_null($article->image)) {
								echo '<img src="'.$article->image.'"><br/>';
							}
							$article->madeby()->associate($module);
							$article->save();
							if($content = Draftcontent::where('draftpage_id', '=', $draftpage->id)->where('draftsection_id', '=', $section->id)->first())
							{
								$content->draftmodule()->associate($module);
								$content->article()->associate($article);
								$content->layout()->associate($contenttemplate);
								$content->save();
							}
							else {
								$content = new Draftcontent;
								$content->draftpage()->associate($draftpage);
								$content->draftsection()->associate($section);
								$content->draftmodule()->associate($module);
								$content->article()->associate($article);
								$content->layout()->associate($contenttemplate);
								$content->save();
							}
							$module = null;
						break;
						case 'news':
							if(Input::has('news_id'.$x)) {
								$news = News::find(Input::get('news_id'.$x));
							}else {
								$news = new News;									
							}
							foreach($fields as $field) {
								$order = $field->order;
								$fieldtype = $field->draftfieldtype;
								$inputname = $field->name.$x;
								if(Input::has($inputname) || Input::hasFile($inputname)){
									if($order == 1){
										$news->title = Input::get($inputname);
									}elseif($order == 2){
										$news->content = Input::get($inputname);
									}
								}
							}

		  					// Uncomment for testing creating newsobject
					  		// echo 'News:<br/>';
		  					// $array = $news->getAttributes();
			  				// foreach($array as $attribute) {
			  				// 	echo $attribute . '<br/>';
			  				// }

							$news->madeby()->associate($module);
							$news->save();
							if($content = Draftcontent::where('draftpage_id', '=', $draftpage->id)->where('draftsection_id', '=', $section->id)->first())
							{
								$content->draftmodule()->associate($module);
								$content->news()->associate($news);
								$content->layout()->associate($contenttemplate);
								$content->save();
							}
							else {
								$content = new Draftcontent();
								$content->draftpage()->associate($draftpage);
								$content->draftsection()->associate($section);
								$content->draftmodule()->associate($module);
								$content->news()->associate($news);
								$content->layout()->associate($contenttemplate);
								$content->save();
							}
							$module = null;
						break;
						case 'articlelist':
							if(Input::has('articlelist'.$x)) {
								$articlelist = Articlelist::find(1);
								if($content = Draftcontent::where('draftpage_id', '=', $draftpage->id)->where('draftsection_id', '=', $section->id)->first())
								{
									$content->draftmodule()->associate($module);
									$content->articlelist()->associate($articlelist);
									$content->layout()->associate($contenttemplate);
									$content->save();
								}
								else {
									$content = new Draftcontent;
									$content->draftpage()->associate($draftpage);
									$content->draftsection()->associate($section);
									$content->draftmodule()->associate($module);
									$content->articlelist()->associate($articlelist);
									$content->layout()->associate($contenttemplate);
									$content->save();
								}

							}
							$module = null;
						break;
						// Insert a case below with the module value from the database
						// Examples above
						/* EDITSPOT 4 */

						/* END OF EDITSPOT 4 */
					} // Check what module it is(switch)
				} // Check if module exists
			} // Check if input != 0
			$x++;
		} // End foreach section

		// Comment next line for testing
		return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/content')->with('draftpageid', $draftpage->id);
		// 
	}

	// CMS/pagemodule/draft/{$draft_id}/menu
	protected function handleMenu($draft_id) {
		$draftpage = Draftpage::find($draft_id);
		$data = Input::all();
		if(Input::has('newmenu')) {
			$menu = new Draftmenu();
			$menu->name = Input::get('newmenuname');
			$menuposition = Draftmenuposition::find(Input::get('menuposition'));
			$menu->draftmenuposition()->associate($menuposition);
			$menu->save();
			$menuid = $menu->id;
			$draftmenu = Draftmenu::find($menuid);
			$firstitem = Input::get('newmenu');
			$firstitem = json_decode($firstitem);
			$x = 1;
			if(is_array($firstitem)) {
				foreach($firstitem as $menuitem) {
					if($draftmenuitem = Draftmenuitem::find($menuitem->id)){
						$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					else {
						$newmenuitem = new Draftmenuitem;
						$newmenuitem->title = $draftpage->name;
						$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
						$newmenuitem->enabled = true;
						$newmenuitem->draftpage()->associate($draftpage);
						$newmenuitem->save();
						$newmenuitem->draftmenus()->attach($draftmenu->id);
						$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}	
				}
			}
			else {
				$firstitem = (INT) $firstitem;
				if($draftmenuitem = Draftmenuitem::find($firstitem)){
					$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
				}
				else {
					$newmenuitem = new Draftmenuitem;
					$newmenuitem->title = $draftpage->name;
					$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
					$newmenuitem->enabled = true;
					$newmenuitem->draftpage()->associate($draftpage);
					$newmenuitem->save();
					$newmenuitem->draftmenus()->attach($draftmenu->id);
					$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
				}	
			}
		}
		else {
			$menuid = Input::get('menu_id');
			$draftmenu = Draftmenu::find($menuid);
			$oldorder = Input::get('oldorder'.$menuid);
			$neworder = Input::get('neworder'.$menuid);
			if($neworder != $oldorder) {
				$oldorder = explode(',', $oldorder);
				$neworder = json_decode($neworder);
				$x = 1;
				foreach($neworder as $menuitem) {
					if($draftmenuitem = Draftmenuitem::find($menuitem->id)){
						$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					else {
						$newmenuitem = new Draftmenuitem;
						$newmenuitem->title = $draftpage->name;
						$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
						$newmenuitem->enabled = true;
						$newmenuitem->draftpage()->associate($draftpage);
						$newmenuitem->save();
						$newmenuitem->draftmenus()->attach($draftmenu->id);
						$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					if(isset($menuitem->children)) {
						$this->menuitemChildLoop($menuitem, (isset($newmenuitem) ? $newmenuitem->id : $menuitem->id), $draftmenu, $draftpage);
					}
					$x++;
				}	
			}
		}
		return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/menu')->with('draftpageid', $draftpage->id);
	}

	protected function menuitemChildLoop($menuitem, $parentid, $draftmenu, $draftpage) {
		$y = 1;
		foreach($menuitem->children as $child) {
			if($draftmenuitem = Draftmenuitem::find($child->id)){
				$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$y, 'parent'=>$parentid]);
			}
			else {
				$newchild = new Draftmenuitem;
				$newchild->title = $draftpage->name;
				$newchild->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
				$newchild->enabled = true;
				$newchild->draftpage()->associate($draftpage);
				$newchild->save();
				$newchild->draftmenus()->attach($draftmenu->id);
				$newchild->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$y, 'parent'=>$parentid]);
			}
			if(isset($child->children)){
				return $this->menuitemChildLoop($child, (isset($newchild) ? $newchild->id : $child->id), $draftmenu, $draftpage);
			}
			$y++;
		}
	}
}


/* SINGLE LEVEL MENU FUNCTION
	protected function handleMenu($draft_id) {
		$draftpage = Draftpage::find($draft_id);
		$data = Input::all();
		if(Input::has('newmenu')) {
			$menu = new Draftmenu();
			$menu->name = Input::get('newmenuname');
			$menuposition = Draftmenuposition::find(Input::get('menuposition'));
			$menu->draftmenuposition()->associate($menuposition);
			$menu->save();
			$menuid = $menu->id;
			$draftmenu = Draftmenu::find($menuid);
			$firstitem = Input::get('newmenu');
			$firstitem = json_decode($firstitem);

			$x = 1;
			if(is_array($firstitem)) {
				foreach($firstitem as $menuitem) {
					if($draftmenuitem = Draftmenuitem::find($menuitem->id)){
						$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					else {
						$newmenuitem = new Draftmenuitem;
						$newmenuitem->title = $draftpage->name;
						$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
						$newmenuitem->enabled = true;
						$newmenuitem->draftpage()->associate($draftpage);
						$newmenuitem->save();
						$newmenuitem->draftmenus()->attach($draftmenu->id);
						$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}	
				}
			}
			else {
				$firstitem = (INT) $firstitem;
				if($draftmenuitem = Draftmenuitem::find($firstitem)){
					$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
				}
				else {
					$newmenuitem = new Draftmenuitem;
					$newmenuitem->title = $draftpage->name;
					$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
					$newmenuitem->enabled = true;
					$newmenuitem->draftpage()->associate($draftpage);
					$newmenuitem->save();
					$newmenuitem->draftmenus()->attach($draftmenu->id);
					$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
				}	
			}
		}
		else {
			$menuid = Input::get('menu_id');
			$draftmenu = Draftmenu::find($menuid);
			$oldorder = Input::get('oldorder'.$menuid);
			$neworder = Input::get('neworder'.$menuid);
			if($neworder != $oldorder) {
				$oldorder = explode(',', $oldorder);
				$neworder = json_decode($neworder);
				$x = 1;
				foreach($neworder as $menuitem) {
					if($draftmenuitem = Draftmenuitem::find($menuitem->id)){
						$draftmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					else {
						$newmenuitem = new Draftmenuitem;
						$newmenuitem->title = $draftpage->name;
						$newmenuitem->alias = (Input::has('changename') ? Input::get('changename') : $draftpage->name);
						$newmenuitem->enabled = true;
						$newmenuitem->draftpage()->associate($draftpage);
						$newmenuitem->save();
						$newmenuitem->draftmenus()->attach($draftmenu->id);
						$newmenuitem->draftmenus()->updateExistingPivot($draftmenu->id, ['order'=>$x]);
					}
					$x++;
				}		
			}
		}
		return Redirect::to('/CMS/pagemodule/draft/'.$draftpage->id.'/menu')->with('draftpageid', $draftpage->id);
	}
	*/