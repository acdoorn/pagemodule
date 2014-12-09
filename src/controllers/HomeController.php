<?php namespace Acdoorn\Pagemodule;
use BaseController;
use View;
use Request;
class HomeController extends BaseController {

    protected $layout = 'pagemodule::layouts.base';

    public function showStart() 
    {
        $draftpages = Draftpage::all();
        $existingpages = Page::all();
        $this->layout->menu = View::make('pagemodule::partials.menu');
        $this->layout->content = View::make('pagemodule::content.start')->with('draftpages', $draftpages)->with('pages', $existingpages);
    }

    public function showGeneral($draftpageid) 
    {
        $type = Request::segment(3);
        $templates = Drafttemplate::all();
        if($type == 'draft') {
            $draft = Draftpage::find($draftpageid);
            $url = $draft->drafturl;
            $seoinfo = $draft->drafturl->draftseoinfo;
            $this->layout->content = View::make('pagemodule::content.general')->with('templates', $templates)->with('draft', $draft);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
            $this->layout->content->example = View::make('pagemodule::examples.google')->with('draft', $draft)->with('url', $url)->with('seoinfo', $seoinfo);
        }
        if($type == 'page') {
            $page = Page::find($draftpageid);
            $template = $page->template;
            $this->layout->content = View::make('pagemodule::content.general')->with('templates', $templates)->with('page', $page);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
            $this->layout->content->example = View::make('pagemodule::examples.google')->with('page', $page)->with('url', $url)->with('seoinfo', $seoinfo);
        }
    }

    public function showContent($draftpageid) 
    {
        $type = Request::segment(3);
        //template ophalen aan de hand van draftpage, template wordt in general aan draftpage gekoppeld.
        $content = Draftcontent::all();
        if($type == 'draft') {
            $draft = Draftpage::find($draftpageid);
            $template = $draft->drafttemplate;
            $this->layout->content = View::make('pagemodule::content.content')->with('draft', $draft)->with('template', $template)->with('content', $content);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
            $this->layout->content->example = View::make('pagemodule::examples.example')->with('draft', $draft)->with('template', $template);
        }
        if($type == 'page') {
            $page = Page::find($draftpageid);
            $this->layout->content = View::make('pagemodule::content.content')->with('templates', $templates)->with('page', $page);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
            $this->layout->content->example = View::make('pagemodule::examples.example')->with('draft', $draft)->with('template', $template);
        }
    }
    
    public function showMenu($draftpageid) 
    {
        $type = Request::segment(3);
        $menus = Draftmenu::all();
        $menuitems = Draftmenuitem::all();
        $this->layout->head = View::make('pagemodule::partials.head');
        if($type == 'draft') {
            $draft = Draftpage::find($draftpageid);
            $template = $draft->drafttemplate;
            $this->layout->content = View::make('pagemodule::content.menu')->with('draft', $draft)->with('menus', $menus)->with('menuitems', $menuitems);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
        }
        if($type == 'page') {
            $page = Page::find($draftpageid);
            $this->layout->content = View::make('pagemodule::content.menu')->with('page', $page)->with('menus', $menus)->with('menuitems', $menuitems);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
        }
        
    }
    
    public function showSummary($draftpageid) 
    {
        $type = Request::segment(3);
        $this->layout->head = View::make('pagemodule::partials.head');
        if($type == 'draft') {
            $draft = Draftpage::find($draftpageid);
            $template = $draft->drafttemplate;
            $this->layout->content = View::make('pagemodule::content.summary')->with('draft', $draft);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('draft', $draft);
        }
        if($type == 'page') {
            $page = Page::find($draftpageid);
            $this->layout->content = View::make('pagemodule::content.summary')->with('page', $page);
            $this->layout->menu = View::make('pagemodule::partials.menu')->with('page', $page);
        }
    }

}
