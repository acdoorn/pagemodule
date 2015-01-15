<?php namespace Acdoorn\Pagemodule;
use BaseController;
use View;
use Request;
class HomeController extends BaseController {

    protected $layout = 'pagemodule::layouts.base';

    public function showStart() 
    {
        $draftpages = Draftpage::all();
        $existingpages = array();
        $this->layout->menu = View::make('pagemodule::partials.menu');
        $this->layout->content = View::make('pagemodule::content.start')->with('draftpages', $draftpages)->with('pages', $existingpages);
    }

    public function showGeneral($draftpageid) 
    {    
        $type = Request::segment(3);
        if($type == 'draft') {
            $draft = Draftpage::findOrFail($draftpageid);
            $templates = Drafttemplate::all();
            $url = $draft->drafturl;
            $seoinfo = $draft->drafturl->draftseoinfo;
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
            $this->layout->content = View::make('pagemodule::content.general')->with('templates', $templates)->with('draft', $draft);
            $this->layout->content->google = View::make('pagemodule::examples.google')->with('draft', $draft)->with('url', $url)->with('seoinfo', $seoinfo);
        }
        if($type == 'page') {
            $page = Page::findOrFail($draftpageid);
            $templates = Template::all();
            $url = $page->url;
            $seoinfo = $page->url->seoinfo;
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
            $this->layout->content = View::make('pagemodule::content.general')->with('templates', $templates)->with('page', $page);
            $this->layout->content->google = View::make('pagemodule::examples.google')->with('page', $page)->with('url', $url)->with('seoinfo', $seoinfo);
        }
    }

    public function showContent($draftpageid) 
    {
        $type = Request::segment(3);
        $article = new Article;
        $news = new News;
        //template ophalen aan de hand van draftpage, template wordt in general aan draftpage gekoppeld.
        if($type == 'draft') {
            $draft = Draftpage::findOrFail($draftpageid);
            $template = $draft->drafttemplate;
            $x = 1;
            $articles = array();
            foreach($template->draftsections as $section) {
                $section->sectiontype;
                // var_dump($section->draftpages->articles);
            }
            $modules = Draftmodule::all();
            $this->layout->content = View::make('pagemodule::content.content')->with('draft', $draft)->with('template', $template)->with('modules', $modules)->with('article', $article)->with('news', $news);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
            // $this->layout->content->example = View::make('pagemodule::examples.example')->with('draft', $draft)->with('template', $template);
        }
        if($type == 'page') {
            $page = Page::findOrFail($draftpageid);
            $modules = Module::all();
            $this->layout->content = View::make('pagemodule::content.content')->with('templates', $templates)->with('page', $page);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
            // $this->layout->content->example = View::make('pagemodule::examples.example')->with('draft', $draft)->with('template', $template);
        }
    }
    
    public function showMenu($draftpageid) 
    {
        $type = Request::segment(3);
        $menus = Draftmenu::all();
        $menupositions = Draftmenuposition::all();
        $this->layout->head = View::make('pagemodule::partials.head');
        if($type == 'draft') {
            if($draft = Draftpage::findOrFail($draftpageid)) {
                $this->layout->content = View::make('pagemodule::content.menu')->with('draft', $draft)->with('menus', $menus)->with('menupositions', $menupositions);
                $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
                $this->layout->content->menuexample = View::make('pagemodule::examples.menu')->with('draft', $draft);
            }
            else {
                $this->layout->content = View::make('pagemodule::error.404notfound');
                $this->layout->menu = View::make('pagemodule::partials.menu');

            }
        }
        if($type == 'page') {
            if($page = Page::find($draftpageid)) {
                $this->layout->content = View::make('pagemodule::content.menu')->with('page', $page)->with('menus', $menus)->with('menuitems', $menuitems);
                $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
                $this->layout->content->menuexample = View::make('pagemodule::examples.menu')->with('page', $page)->with('menus', $menus);
            }
            else {
                $this->layout->content = View::make('pagemodule::error.404notfound');
                $this->layout->menu = View::make('pagemodule::partials.menu');
            }
        }
        
    }
    
    public function showSummary($draftpageid) 
    {
        $type = Request::segment(3);
        $this->layout->head = View::make('pagemodule::partials.head');
        if($type == 'draft') {
            $draft = Draftpage::findOrFail($draftpageid);
            $url = $draft->drafturl;
            $seoinfo = $draft->drafturl->draftseoinfo;
            $this->layout->content = View::make('pagemodule::content.summary')->with('draft', $draft);
            // $this->layout->content->general = View::make('pagemodule::examples.example')->with('draft', $draft);
            $this->layout->content->google = View::make('pagemodule::examples.google')->with('draft', $draft)->with('url', $url)->with('seoinfo', $seoinfo);
            // $this->layout->content->content = View::make('pagemodule::examples.general')->with('draft', $draft);
            $this->layout->content->menuexample = View::make('pagemodule::examples.menu')->with('draft', $draft);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);

        }
        if($type == 'page') {
            $page = Page::find($draftpageid);
            $this->layout->content = View::make('pagemodule::content.summary')->with('page', $page);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
        }
    }

}
